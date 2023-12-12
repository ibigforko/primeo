<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Auth\AuthenticationException;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Schema;
use App\Models\System\Log;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of reported errors.
     *
     * @var array
     */
    protected $reportErrors = [
        400,
        401,
        403,
        404,
        405,
        419,
        422,
        500,
        502,
        503,
        504
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Get user language from request.
     * 
     * @param \Illuminate\Http\Request $request
     *
     * @return String|null
     */
    protected function userLanguageFromRequest($request):? String
    {
        return PersonalAccessToken::findToken($request->bearerToken())?->tokenable()->first()?->language ?? null;
    }

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
        $this->renderable(function (AuthenticationException $e, $request) {
            if ($request->is('api/*')):
                return responseWithLang('auth.unauthenticated', 401);
            endif;
        });
    }

    /**
     * Prepare exception for rendering.
     *
     * @param \Illuminate\Http\Request $request
     * @param  \Throwable  $e
     * 
     * @return \Throwable
     */
    public function render($request, Throwable $e)
    {
        $response = parent::render($request, $e);

        if(app()->environment(['production']) && $e instanceof UnauthorizedHttpException):
            return $response;
        endif;
        
        if(app()->environment(['production']) && in_array($response->getStatusCode(), $this->reportErrors)):
            return responseWithLang("main.shared.wrong", $response->getStatusCode(), $this->userLanguageFromRequest($request));
        endif;

        if(app()->environment(['production'])):
            return responseWithMessage($e->getMessage(), 500);
        endif;

        return $response;
    }

    /**
     * Write exception to logs table.
     *
     * @param  \Throwable  $e
     * @return void
     */
    public function report(Throwable $e): void
    {
        if(Schema::hasTable(Log::table())):
            Log::create([
                "user_id" => auth()->user()?->id ?? null,
                "function" => "{$e->getFile()}:{$e->getLine()}",
                "ip" => request()->ip(),
                "status" => Log::ERROR,
                "url" => request()->url(),
                "data" => json_encode(request()->all(), true),
                "info" => strlen($e->getMessage()) > 0 
                    ? $e->getMessage() 
                    : (array_key_exists($e->getCode(), __('error'))
                        ? __("error.{$e->getCode()}.title")
                        : null)
            ]);
        endif;

        parent::report($e);
    }
}
