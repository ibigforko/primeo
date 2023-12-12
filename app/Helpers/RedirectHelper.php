<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use App\Models\User\User;
use App\Core\Response;

/**
*
* @param string $key
* @param integer $status

* @return JsonResponse
*/
function responseWithLang(String $key = "main.shared.wrong", Int $status = 500, ?String $locale = null): JsonResponse
{
    return response()->json([
        Response::STATUS_CODE => $status,
        Response::SUCCESS => $status === 200,
        Response::MESSAGE => __($key, [], $locale ?? Auth::user()?->language ?? User::$default_language)
    ], $status);
}

/**
*
* @param string $message
* @param integer $status

* @return JsonResponse
*/
function responseWithMessage(String $message, Int $status = 200): JsonResponse
{
    return response()->json([
        Response::STATUS_CODE => $status,
        Response::SUCCESS => $status === 200,
        Response::MESSAGE => $message
    ], $status);
}

/**
*
* @param array $errors
* @param integer $status

* @return JsonResponse
*/
function responseWithErrors($errors, Int $status = 422): JsonResponse
{
    return response()->json([
        Response::STATUS_CODE => $status,
        Response::SUCCESS => false,
        Response::ERRORS => $errors
    ], $status);
}

/**
*
* @param array $data
* @param integer $status

* @return JsonResponse
*/
function responseWithPayload($data, $status = 200): JsonResponse
{
    return response()->json([
        Response::STATUS_CODE => $status,
        Response::SUCCESS => $status === 200 || $status === 201,
        Response::PAYLOAD => $data
    ], $status);
}