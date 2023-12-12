<?php

namespace App\Core;

use Illuminate\Database\Migrations\Migration as ParentMigration;

class Migration extends ParentMigration
{
    protected ?String $tableName = null;

    public function __construct()
    {
        $this->model = $this->model ?? null;
        $this->tableName = $this->model ? $this->model::table() : null;
    }

    public function __destruct()
    {
        $this->tableName = null;
    }
}