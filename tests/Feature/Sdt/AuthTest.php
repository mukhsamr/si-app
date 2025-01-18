<?php

namespace Tests\Feature\Sdt;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class AuthTest extends TestCase
{
    protected $token;

    public function setUp(): void
    {
        parent::setUp();

        Artisan::call("migrate:fresh --seed --path=database/migrations/sdt --database=sdt");
        $this->login();
    }

    private function login()
    {
        $response = $this->postJson('/api/sdt/auth/login', [
            'username' => 'Amrullah',
            'password' => 'password',
        ]);

        $this->token = $response->json('token');
    }

    public function test_logout()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->postJson('/api/sdt/auth/logout');

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Success logout',
                'token' => null
            ]);
    }

    public function test_user()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->getJson('/api/sdt/auth/user');

        $response->assertStatus(200)
            ->assertJson([
                'user' => [
                    'username' => 'Amrullah',
                    'role' => 'operator'
                ]
            ]);
    }
}
