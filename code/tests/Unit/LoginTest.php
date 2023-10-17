<?php

namespace Tests\Unit;
use App\Models\User;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

     public function test_user_can_view_a_login_form()
    {
        $response = $this->get('/login');

        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }

    public function test_duplication_login_form()
    {
        $user1 = User::make([
            'name'=>'Jhone Snow',
            'email'=>'jhone@gmail.com',
            'password'=>'jhone#123'
        ]);
        $user2 = User::make([
            'name'=>'Dary Snow',
            'email'=>'dary@gmail.com',
            'password'=>'jhone#123'
        ]);

        $this->assertTrue($user1->name != $user2->name);
    }

    public function test_user_cannot_view_a_login_form_when_authenticated()
    {
        $user = User::factory()->create();

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticatedAs($user);
    }
}
