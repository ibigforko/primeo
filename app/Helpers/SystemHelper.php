<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use App\Models\System\Log;
use Illuminate\Support\Str;
use App\Core\Model;
use App\Models\User\Setting;
use Illuminate\Database\Eloquent\Model as EloquentModel;

/**
 * Log writting for controllers.
 *
 * @param String $status
 * @param String|null $info
 * @param String|null $function
 * @param mixed $data
 */
function createLog(String $status = Log::SUCCESS, ?String $info = null, ?String $function = null, $data = null): void
{
    $defaultFunction = function (): String
    {
        $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, $limit = 3)[$limit-1];

        return ($backtrace['class'] ?? ""). "@" .($backtrace['function'] ?? "");
    };

    Log::create([
        "user_id" => Auth::user()->id ?? null,
        "function" => $function ?? $defaultFunction(),
        "ip" => Request::ip(),
        "status" => $status,
        "url" => Request::url(),
        "data" => json_encode(($data ?? Request::all()), true),
        "info" => $info ? strval($info) : null
    ]);
}

/**
 * Log writting function.
 *
 * @param String $function
 * @param String $status
 * @param $info
 * 
 * @return void
 */
function writeLog(String $function, String $status = Log::SUCCESS, $info = null): void
{
    Log::create([
        "user_id" => Auth::user()->id ?? null,
        "function" => $function,
        "ip" => Request::ip(),
        "status" => $status,
        "url" => Request::url(),
        "data" => json_encode(Request::all(), true),
        "info" => $info ? strval($info) : null
    ]);
}

/**
 * Translates words.
 * 
 * @param string $key
 * @param string|null $locale
 * @param array|null $replace

 * @return string|array|null
 */
function lang(String $key = "main.shared.wrong", ?String $locale = null, ?Array $replace = null)
{
    return __($key, $replace ?? [], $locale ?? Auth::user()?->language);
}

/**
 * This function is used for mapping data, it's alternative to optional function.
 *
 * @param mixed $item
 * @param Callable $successCallback
 * @param Callable|null $failCallback
 * 
 * @return mixed
 */
function when($item, Callable $successCallback, ?Callable $failCallback = null)
{
    return $item != null
        ? $successCallback($item)
        : ($failCallback ? $failCallback() : null);
}
