<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\Reset\UpdateRequest;
use App\Http\Requests\Auth\Reset\StoreRequest;
use App\Http\Controllers\Controller;
use App\Models\User\ResettingToken;
use Illuminate\Http\JsonResponse;
use App\Models\User\User;

class ResetController extends Controller
{
    public function store(StoreRequest $request): JsonResponse
    {
        return when(User::where("email", $request->email)->first(), function (User $user): JsonResponse
        {
            return (bool) $user->generateResettingToken() 
                ? responseWithLang("auth.reset.token.success", 200)
                : responseWithLang("auth.reset.token.failed", 500);
        }, fn() => responseWithLang('auth.not_found_user', 404));
    }
    
    public function update(ResettingToken $token, UpdateRequest $request): JsonResponse
    {
        return when(User::find($token->user_id), function (User $user) use ($request, $token): JsonResponse
        {
            return $user->update([
                "password" => $request->password
            ]) && $token->update([
                "active" => false
            ]) ? responseWithLang("auth.reset.password.success", 200)
            : responseWithLang("auth.reset.password.failed", 500);
        }, fn() => responseWithLang());
    }
}