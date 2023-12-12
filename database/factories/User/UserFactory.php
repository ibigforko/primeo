<?php

namespace Database\Factories\User;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User\User;

class UserFactory extends Factory
{
    protected $model = User::class;
    public String $password = "secret";
    
    public function definition()
    {
        return [
            'role' => $this->faker->randomElement(User::$roles),
            'language' => $this->faker->randomElement(User::$langs),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => $this->faker->dateTimeBetween('-1 years', 'now'),
            'phone' => $this->faker->phoneNumber,
            'average_salary' => $this->faker->randomFloat(2, 10000, 15000),
            'position' => $this->faker->randomElement(User::$positions),
            'address' => $this->faker->streetAddress,
            'country' => $this->faker->country,
            'postal_code' => $this->faker->postcode,
            'city' => $this->faker->city,
            'house_number' => $this->faker->buildingNumber,
            'apartment_number' => $this->faker->randomElement([$this->faker->buildingNumber]),
            'is_mailing_address_different' => $is_mailing = $this->faker->boolean,
            'mailing_address' => $is_mailing ? $this->faker->streetAddress : null,
            'mailing_country' => $is_mailing ? $this->faker->country : null,
            'mailing_postal_code' => $is_mailing ? $this->faker->postcode : null,
            'mailing_city' => $is_mailing ? $this->faker->city : null,
            'mailing_house_number' => $is_mailing ? $this->faker->buildingNumber : null,
            'mailing_apartment_number' => $is_mailing ? $this->faker->randomElement([$this->faker->buildingNumber]) : null,
            'password' => $this->password,
        ];
    }
}