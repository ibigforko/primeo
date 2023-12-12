<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class RegisteredController extends Controller
{
    public function store(RegisterRequest $request): JsonResponse
    {
        return responseWithPayload($request->register(), 201);
    }
}