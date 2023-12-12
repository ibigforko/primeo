<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User\User;
use App\Core\Migration;

return new class extends Migration
{
    protected $model = User::class;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->increments('id');
            $table->enum('role', User::$roles)->default(User::$default_role);
            $table->enum('language', User::$langs)->default(User::$default_language);
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone')->nullable();
            $table->decimal('average_salary', 8, 2)->nullable();
            $table->enum('position', User::$positions);
            $table->text('address');
            $table->string('country');
            $table->string('postal_code');
            $table->string('city');
            $table->string('house_number');
            $table->string('apartment_number')->nullable();
            $table->boolean('is_mailing_address_different')->default(false);
            $table->text('mailing_address')->nullable();
            $table->string('mailing_country')->nullable();
            $table->string('mailing_postal_code')->nullable();
            $table->string('mailing_city')->nullable();
            $table->string('mailing_house_number')->nullable();
            $table->string('mailing_apartment_number')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->boolean("is_active")->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->index('role');
            $table->index('first_name');
            $table->index('last_name');
            $table->index('email');
            $table->index('email_verified_at');
            $table->index('is_active');
            $table->index('created_at');
            $table->index('updated_at');
            $table->index('deleted_at');
        }); 
        
        User::factory()
            ->create([
                'email' => 'test@test.com'
            ]);
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