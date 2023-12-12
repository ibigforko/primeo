<?php

namespace App\Models\System;

use App\Core\Model;

class Log extends Model
{   
    protected $table = 'system_logs';

    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        "id",
        "user_id", //NULLABLE
        "function", //NULLABLE
        "ip", //NULLABLE
        "status", //NULLABLE
        "url", //NULLABLE
        "data", //NULLABLE
        "info", //NULLABLE
        "created_at", //NULLABLE
        "updated_at", //NULLABLE
    ];

    protected $casts = [
        "id" => "integer",
        "user_id" => "integer",
        "function" => "string",
        "ip" => "string",
        "status" => "string",
        "url" => "string",
        "data" => "array",
        "info" => "string",
        "created_at" => "datetime",
        "updated_at" => "datetime"
    ];
    

    // STATUSES CONSTANTS
    public const SUCCESS = "success";
    public const WARNING = "warning";
    public const ATTEMPT = "attempt";
    public const ERROR = "error";

    /**
     * A list of all statuses.
     *
     * @var array
     */
    public static $statuses = [
        self::SUCCESS,
        self::WARNING,
        self::ATTEMPT,
        self::ERROR
    ];
}