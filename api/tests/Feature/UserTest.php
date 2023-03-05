<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_users_list(): void
    {
        User::factory(20)->create();

        $response = $this->get('/users');

        $response->assertStatus(200);
        $response->assertJsonCount(20, "data");
    }

    public function test_the_users_show_details(): void
    {

        $user = User::factory(1)->create()->first();

        $response = $this->get('/users/'.$user->id);

        $response->assertStatus(200);
        $response->assertJsonIsObject("weather");
    }
}
