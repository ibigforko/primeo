<?php

namespace App\Models\User;

use App\Core\Model;

class ResettingToken extends Model
{
    protected $table = 'users_resetting_tokens';
    
    protected $primaryKey = 'id';
    protected $keyType = 'integer';

    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        "id",
        "user_id",
        "user_email",
        "token",
        "send", //FALSE
        "active", //TRUE
        "created_at", //NULLABLE
        "updated_at", //NULLABLE
    ];
    
    protected $casts = [
        "id" => "integer",
        "user_id" => "integer",
        "user_email" => "string",
        "token" => "string",
        "send" => "boolean",
        "active" => "boolean",
        "created_at" => "datetime",
        "updated_at" => "datetime",
    ];
    
    /**
     * ResettingToken route binding parameters.
     *
     * @param $value
     * @param $field
     * 
     * @return ResettingToken
     */
    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where($field ?? 'token', $value)
                    ->where("active", true)
                    ->where('created_at', '>', \Carbon\Carbon::now()->subHours(4)->toDateTimeString())
                    ->firstOrFail();
    }
}