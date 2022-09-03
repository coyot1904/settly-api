<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_register()
    {
        $response = $this->json('POST', '/api/register', ['email' => 'coyot1904@yahoo.com' , 'password' => 'ghorob' , 'name' => 'keyvan' , 'surname' => 'mozaffari']);

        $response->assertStatus(200);
    }

    public function test_login()
    {
        $response = $this->json('POST', '/api/login', ['email' => 'coyot1904@yahoo.com' , 'password' => 'ghorob']);

        $response->assertStatus(200);
    }

    public function test_user()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 46|bZHo0GovhYD5vBQIl2m4E0Nn5gPZSuerlieFGrmr',
        ])->get('/api/user');

        $response->assertStatus(200);
    }

}
