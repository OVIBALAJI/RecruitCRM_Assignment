<?php

namespace Tests\Unit;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Candidate;
use Log;
use Illuminate\Support\Facades\Auth;


class AuthControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     */
       use RefreshDatabase, WithFaker;

    /**
     * Test getting a list of candidates.
     *
     * @return void
     */
     public function testUserRegistration()
    {
        // Data for user registration
        $userData = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'password' => 'secret',
        ];

        // Send a POST request to the registration endpoint
        $response = $this->post('/api/v1/register', $userData);

        // Assert response status code
        $response->assertStatus(201);

    
    }
        public function testUserLogin()
    {
        // Create a user for testing
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
        ]);

        // Data for user login
        $loginData = [
            'email' => 'test@example.com',
            'password' => 'password123',
        ];

        // Send a POST request to the login endpoint
        $response = $this->post('/api/v1/login', $loginData);

        // Assert response status code
        $response->assertStatus(200);

        // Verify that the response contains the expected JSON structure
        $response->assertJsonStructure([
            'access_token',
            'token_type',
            'expires_in',
            'refresh_token',
            'user'
        ]);
    }
     public function testTokenRefresh()
    {
        // Create a user for testing
        $user = User::factory()->create();

        // Generate access token and refresh token
        $accessToken = $user->createToken('test-token')->plainTextToken;
        $refreshToken = $user->refresh_token;

        // Send a POST request to the token refresh endpoint
        $response = $this->post('/api/v1/token/refresh', [], [
            'Authorization' => 'Bearer ' . $refreshToken,
        ]);

        // Assert response status code
        $response->assertStatus(200);


      
    }
        public function testUserLogout()
    {
        // Create and authenticate a user for testing
        $user = User::factory()->create();
        $accessToken = $user->createToken('test-token')->plainTextToken;
        $this->actingAs($user);

        // Send a POST request to the logout endpoint
        $response = $this->post('/api/v1/logout', [], [
            'Authorization' => 'Bearer ' . $accessToken,
        ]);

        // Assert response status code
        $response->assertStatus(200);

        // Verify that the response contains the expected JSON structure
        $response->assertJsonStructure([
            'message',
        ]);
    }


}
