<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Validation\ValidationException;
use App\Exceptions\Auth\UnavailableException;
use Illuminate\Support\Facades\RateLimiter;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User\User;

class AuthenticatedSessionController extends Controller
{
    /**
     * Get the rate limiting throttle key for the request.
     *
     * @return string
     */
    public function throttleKey(Request $request)
    {
        return Str::lower($request->input('email')).'|'.$request->ip();
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @return void
     */
    public function ensureIsNotRateLimited(Request $request)
    {
        if(!RateLimiter::tooManyAttempts($this->throttleKey($request), 5)):
            return;
        endif;

        event(new Lockout($request));

        $seconds = RateLimiter::availableIn($this->throttleKey($request));

        return responseWithMessage(lang('auth.throttle', null, [
            'seconds' => $seconds,
            'minutes' => ceil($seconds / 60),
        ], 422));
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param Request $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $this->ensureIsNotRateLimited($request);

            if(! Auth::guard('web')->attempt([
                'email' => $request->getUser(), 
                'password' => $request->getPassword()
            ])):
                RateLimiter::hit($this->throttleKey($request));
                
                return responseWithLang("auth.failed", 422);
            endif;

            if(auth()->user()?->is_active !== true):
                throw new UnavailableException();
            endif;
    
            RateLimiter::clear($this->throttleKey($request));

            return responseWithPayload(when(Auth::user(), function (User $user) {
                return [
                   "bearerToken"  => $user->createToken('authToken')?->plainTextToken
                ];
            }));
        }catch(ValidationException $v){
            return responseWithErrors($v->errors());
        }catch(UnavailableException $u){
            return responseWithLang("auth.unavailable", 403);
        }
    }

    /**
     * Destroy an authenticated session.
     *
     * @param Request $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request): JsonResponse
    {
        $bearerToken = $request->bearerToken();
        $token = PersonalAccessToken::findToken($bearerToken);
        
        return $token->delete()
            ? responseWithLang("auth.logout_success", 200)
            : responseWithLang("auth.logout_failed", 422);
    }
}
