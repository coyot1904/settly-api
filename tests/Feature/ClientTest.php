<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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

    public function test_add_client()
    {
        Storage::fake('local');
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 46|bZHo0GovhYD5vBQIl2m4E0Nn5gPZSuerlieFGrmr',
        ])->post('/api/clinet/add/' , ['name' => 'test' , 'email' => 'email@mail.com' , 'image' => UploadedFile::fake()->image('avatar.jpg')]);

        $response->assertStatus(200);
    }

    public function test_edit_client()
    {
        Storage::fake('local');
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 46|bZHo0GovhYD5vBQIl2m4E0Nn5gPZSuerlieFGrmr',
        ])->post('/api/clinet/edit/' , ['name' => 'test' , 'email' => 'email@mail.com' , 'image' => UploadedFile::fake()->image('avatar.jpg') , 'id' => 1]);

        $response->assertStatus(200);
    }

}
