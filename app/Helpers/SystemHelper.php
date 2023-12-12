<?php

use Illuminate\Support\Facades\Auth;

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
