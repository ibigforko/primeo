<?php
namespace App\Core;

class Response
{
    public const STATUS_CODE = 'status_code';
    public const SUCCESS = 'success';

    public const PAYLOAD = 'payload';
    public const MESSAGE = 'message';
    public const ERRORS = 'errors';

    public static Array $payload = [
        self::STATUS_CODE,
        self::SUCCESS,
        self::PAYLOAD
    ];

    public static Array $message = [
        self::STATUS_CODE,
        self::SUCCESS,
        self::MESSAGE
    ];

    public static Array $errors = [
        self::STATUS_CODE,
        self::SUCCESS,
        self::ERRORS
    ];
}