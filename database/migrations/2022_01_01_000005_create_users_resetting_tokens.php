<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User\ResettingToken;
use App\Core\Migration;

return new class extends Migration
{
    protected $model = ResettingToken::class;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->bigInteger("user_id");
            $table->string('user_email');
            $table->string('token');
            $table->boolean('send')->default(false);
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->index('user_id');
            $table->index('user_email');
            $table->index('token');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->tableName);
    }
};