<?php

namespace App\Models\System;

use App\Core\Model;

class Session extends Model
{
    protected $table = 'system_sessions';

    protected $primaryKey = 'id';
    protected $keyType = 'string';

    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        "id",
        "user_id", //NULLABLE
        "ip_address", //NULLABLE
        "user_agent", //NULLABLE
        "payload",
        "last_activity"
    ];

    protected $casts = [
        "last_activity" => "datetime",
    ];
}