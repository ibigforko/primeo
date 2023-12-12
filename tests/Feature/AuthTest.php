<?php

namespace Tests\Feature;

use Database\Factories\User\UserFactory;
use App\Models\User\ResettingToken;
use App\Models\User\User;
use Tests\TestCase;

class AuthTest extends TestCase
{
    public function test_login()
    {
        $user = User::factory()->create();

        $response = $this->withHeaders([
            'Authorization' => 'Basic ' . base64_encode($user->email.':'.(new UserFactory())->password)
        ])->post(route('v1.auth.login'));

        $response->assertJsonPayload([
            "bearerToken"
        ]);
        $response->assertStatus(200);

        $this->assertDatabaseHas('personal_access_tokens', [
            'tokenable_id' => $user->id,
            'tokenable_type' => User::class
        ]);
    }

    public function test_logout()
    {
        $this->autorization(function (String $bearerToken, User $user) 
        {
            $response = $this->withToken($bearerToken)->post(route('v1.auth.logout'));

            $response->assertJsonMessage();
            $response->assertStatus(200);
            
            $this->assertDatabaseMissing('personal_access_tokens', [
                'tokenable_id' => $user->id,
                'tokenable_type' => User::class
            ]);
        });
    }
    
    public function test_register()
    {
        $response = $this->post(route('v1.auth.register'), [
            'language' => $language = $this->faker->randomElement(User::$langs),
            'first_name' => $first_name = $this->faker->words(3, true),
            'last_name' => $last_name = $this->faker->words(3, true),
            'email' => $email = $this->faker->unique()->safeEmail,
            'phone' => $phone = $this->faker->phoneNumber,
            'average_salary' => $average_salary = $this->faker->randomFloat(2, 10000, 15000),
            'position' => $position = $this->faker->randomElement(User::$positions),
            'address' => $address = $this->faker->streetAddress,
            'country' => $country = $this->faker->country,
            'postal_code' => $postal_code = $this->faker->postcode,
            'city' => $city = $this->faker->city,
            'house_number' => $house_number = $this->faker->buildingNumber,
            'apartment_number' => $apartment_number = $this->faker->randomElement([$this->faker->buildingNumber]),
            'is_mailing_address_different' => $is_mailing_address_different = $this->faker->boolean,
            'mailing_address' => $mailing_address = $is_mailing_address_different ? $this->faker->streetAddress : null,
            'mailing_country' => $mailing_country = $is_mailing_address_different ? $this->faker->country : null,
            'mailing_postal_code' => $mailing_postal_code = $is_mailing_address_different ? $this->faker->postcode : null,
            'mailing_city' => $mailing_city = $is_mailing_address_different ? $this->faker->city : null,
            'mailing_house_number' => $mailing_house_number = $is_mailing_address_different ? $this->faker->buildingNumber : null,
            'mailing_apartment_number' => $mailing_apartment_number = $is_mailing_address_different ? $this->faker->randomElement([$this->faker->buildingNumber]) : null,
            'password' => (new UserFactory())->password,
            'password_confirmation' => (new UserFactory())->password,
        ]);
        
        $response->assertJsonPayload([
            "id",
            "role",
            "language",
            "first_name",
            "last_name",
            "email",
            "email_verified_at",
            "phone",
            "average_salary",
            "position",
            "address",
            "country",
            "postal_code",
            "city",
            "house_number",
            "apartment_number",
            "is_mailing_address_different",
            "mailing_address",
            "mailing_country",
            "mailing_postal_code",
            "mailing_city",
            "mailing_house_number",
            "mailing_apartment_number",
            "is_active",
            "created_at",
            "updated_at",
            "deleted_at"
        ]);
        $response->assertStatus(201);

        $this->assertDatabaseHas(User::table(), [
            'language' => $language,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'phone' => $phone,
            'average_salary' => $average_salary,
            'position' => $position,
            'address' => $address,
            'country' => $country,
            'postal_code' => $postal_code,
            'city' => $city,
            'house_number' => $house_number,
            'apartment_number' => $apartment_number,
            'is_mailing_address_different' => $is_mailing_address_different,
            'mailing_address' => $mailing_address,
            'mailing_country' => $mailing_country,
            'mailing_postal_code' => $mailing_postal_code,
            'mailing_city' => $mailing_city,
            'mailing_house_number' => $mailing_house_number,
            'mailing_apartment_number' => $mailing_apartment_number
        ]);
    }

    public function test_reset()
    {
        $this->autorization(function (String $bearerToken, User $user)
        {
            $oldPassword = $user->password;

            $response = $this->post(route('v1.auth.reset.store'), [
                "email" => $user?->email
            ]);

            $response->assertJsonMessage();
            $response->assertStatus(200);
            
            $this->assertDatabaseHas(ResettingToken::table(), [
                "user_email" => $user?->email,
                "active" => true
            ]);

            $response = $this->post(route('v1.auth.reset.update', [
                "token" => ResettingToken::where("user_email", $user->email)->first()?->token, // TODO: Sending token to email
                "password" => $new_password = "secret2",
                "password_confirmation" => $new_password
            ]));
            
            $response->assertJsonMessage();
            $response->assertStatus(200);

            $this->assertDatabaseHas(ResettingToken::table(), [
                "user_email" => $user?->email,
                "active" => false
            ]);
            $this->assertDatabaseMissing(User::table(), [
                "id" => $user->id,
                "password" => $oldPassword
            ]);
        });
    }
}