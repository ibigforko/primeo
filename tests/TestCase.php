<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Database\Factories\User\UserFactory;
use Faker\Factory as FakerFactory;
use Faker\Generator as Faker;
use App\Models\User\User;
use App\Core\Response;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;

    protected ?Faker $faker = null;
    protected ?String $clientIP = null;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutMiddleware(ThrottleRequests::class);

        $this->faker = FakerFactory::create();
        $this->clientIP = $this->faker->ipv4;

        $this->serverVariables = ['REMOTE_ADDR' => $this->clientIP];
    }

    protected function tearDown(): void
    {
        $this->faker = null;
        $this->clientIP = null;

        parent::tearDown();
    }

    public function autorization(Callable $callback): void
    {
        $user = User::factory()->create();
        $response = $this->withHeaders([
            "Authorization" => "Basic ".base64_encode($user->email.':'.(new UserFactory())->password),
        ])->post(route("v1.auth.login"));

        $response->assertJsonPayload([
            "bearerToken"
        ]);

        $response->assertStatus(200);

        $callback($response[Response::PAYLOAD]['bearerToken'], $user);
    }
}
