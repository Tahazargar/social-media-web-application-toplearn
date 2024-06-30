<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerTest extends TestCase
{
    use WithFaker;

    /** @test **/
    public function login_authenticates_and_redirects_user()
    {
        $user = User::factory()->create();
        $response = $this->post(route('login'), [
            'username' => $user->name,
            'password' => 'password'
        ]);
        $response->assertRedirect(route('home'));
        // $this->assertAuthenticatedAs($user);
    }
}
