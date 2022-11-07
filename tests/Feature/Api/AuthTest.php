<?php

namespace Tests\Feature\Api;

use App\Models\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class AuthTest extends TestCase
{   
    use RefreshDatabase;


    /** @test */
    public function it_provides_token_to_a_valid_user()
    {
        User::factory()->create([
            'email' => 'foo@mail.com',
            'password' => bcrypt('password')
        ]);

        $response = $this->post('/api/auth/login', [
            'email' => 'foo@mail.com',
            'password' => 'password'
        ]);

        $response->assertStatus(200);
        $response->assertSeeText('status');
        $response->assertSeeText('message');
        $response->assertSeeText('token');
    }

    /** @test */
    public function it_does_not_provide_token_with_wrong_credentials() {
        User::factory()->create([
            'email' => 'foo@mail.com',
            'password' => bcrypt('password')
        ]);
    
        $response = $this->post('/api/auth/login', [
            'email' => 'foo@mail.com',
            'password' => 'WRONG-PASSWORD'
        ]);
    
        $response->assertStatus(401);
        $response->assertSeeText('Credenciales invalidas');
    }

    /** @test */
    public function email_field_is_required() {
    
        $response = $this->post('/api/auth/login', [
            'email' => null,
            'password' => 'password'
        ]);
    
        $response->assertStatus(422);
        $response->assertJson([
            [
                'email' => [
                    'El campo email es obligatorio.'
                ]
            ]
        ]);
    }

    /** @test */
    public function email_value_must_be_a_valid_email_address() {
       
    
        $response = $this->post('/api/auth/login', [
            'email' => 'foo',
            'password' => 'password'
        ]);
    
        $response->assertStatus(422);
        $response->assertJson([
            [
                'email' => [
                    'El campo email debe ser una dirección de correo válida.'
                ]
            ]
        ]);
    }

    /** @test */
    public function password_field_is_required() {
       
        $response = $this->post('/api/auth/login', [
            'email' => 'foo@mail.com',
            'password' => null,
        ]);
    
        $response->assertStatus(422);
        $response->assertJson([
            [
                'password' => [
                    'El campo password es obligatorio.'
                ]
            ]
        ]);
    }
}
