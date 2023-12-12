<?php

namespace App\Core;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    public static function table(?String $text = null): ?String
    {
        $table = (new static)->getTable() ?? null;

        return $text ? str_replace("{t}", $table, $text) : $table;
    }
}