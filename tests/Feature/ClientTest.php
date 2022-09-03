<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientTest extends TestCase
{
    public function test_client_list()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 46|bZHo0GovhYD5vBQIl2m4E0Nn5gPZSuerlieFGrmr',
        ])->get('/api/clinet/list');

        $response->assertStatus(200);
    }

    public function test_single_client()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 46|bZHo0GovhYD5vBQIl2m4E0Nn5gPZSuerlieFGrmr',
        ])->get('/api/clinet/single/1');

        $response->assertStatus(200);
    }

}
