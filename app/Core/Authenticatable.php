<?php
namespace App\Core;

use Illuminate\Foundation\Auth\User;
use App\Models\User\ResettingToken;

class Authenticatable extends User
{
    public static function table(?String $text = null): ?String
    {
        $table = (new static)->getTable() ?? null;

        return $text ? str_replace("{t}", $table, $text) : $table;
    }

    public function generateResettingToken():? ResettingToken
    {
        return ResettingToken::create([
            "user_id" => $this->id,
            "user_email" => $this->email,
            "token" => sha1(time())
        ]) ?? null;
    }
}