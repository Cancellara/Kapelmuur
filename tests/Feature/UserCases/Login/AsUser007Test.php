<?php

namespace Tests\Feature\UserCases\Login;

use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AsUser007Test extends TestCase
{
    use RefreshDatabase;

    /** @test  */
    public function it_test_that_a_login_page_exists()
    {
        $this->get('/login')
            ->assertStatus(200);
    }

    /** @test  */
    public function it_test_that_an_existing_and_active_user_can_login()
    {
        $email = 'maildeprueba@mail.es';
        $pass = 'password';

        $this->createUser([
            'email' => $email,
            'password' => bcrypt($pass),
            'active' => 1,
        ]);

        $this->post('login', [
            'email' => $email,
            'password' => $pass,
        ])->assertRedirect('/user/controlPanel');

        $this->assertTrue(Auth::check());


    }

    /** @test */
    public function it_test_that_system_validate_credentials()
    {
        $email = 'maildeprueba@mail.es';
        $pass = 'password';

        $this->createUser([
            'email' => $email,
            'password' => bcrypt($pass),
            'active' => 1,
        ]);

        $this->post('login', [
            'email' => $email,
            'password' => 'otrapass',
        ]);

        $this->assertFalse(Auth::check());
    }

    /** @test */
    public function it_test_that_an_inactive_user_cannot_login()
    {
        $email = 'maildeprueba@mail.es';
        $pass = 'password';

        $this->createUser([
            'email' => $email,
            'password' => bcrypt($pass),
            'active' => 0,
        ]);

        $this->post('login', [
            'email' => $email,
            'password' => $pass,
        ])->assertSessionHas('errorMessage');

        $this->assertFalse(Auth::check());

    }

    /** @test */
    public function it_test_that_a_logued_user_can_logout()
    {
        $email = 'maildeprueba@mail.es';
        $pass = 'password';

        $user = $this->createUser(['email' => $email,
            'password' => bcrypt($pass),
            'active' => 0,]);

        $this->actingAs($user)->post('logout')->assertRedirect('/');

        $this->assertFalse(Auth::check());
    }

    /** @test */
    public function it_test_that_a_logued_user_cannot_see_login_page()
    {
        $email = 'maildeprueba@mail.es';
        $pass = 'password';

        $user = $this->createUser(['email' => $email,
            'password' => bcrypt($pass),
            'active' => 0,]);

        $this->actingAs($user)->get('login')->assertRedirect('/');
    }

    /** @test */
    public function it_test_that_a_guest_cannot_see_user_control_panel()
    {
        $this->get('user/controlPanel')
            ->assertStatus(302)
            ->assertRedirect('/login');
    }


    /* TESTEADAS MANUALMENTE
    public function it_test_that_a_active_shop_cannot_see_user_control_panel()
    {
        $email = 'maildeprueba@mail.es';
        $pass = 'password';

        $this->seed('ShopTypeSeeder');

        $shop = $this->createShop(['email' => $email,
            'password' => bcrypt($pass),
            'active' => 1,]);

        $this->actingAs($shop)->get('/user/controlPanel')
            ->assertStatus(302);
    }


    public function it_test_that_a_inactive_shop_cannot_see_user_control_panel()
    {
        $email = 'maildeprueba@mail.es';
        $pass = 'password';

        $this->seed('ShopTypeSeeder');

        $shop = $this->createShop(['email' => $email,
            'password' => bcrypt($pass),
            'active' => 0,]);

        $this->actingAs($shop)->get('/user/controlPanel')
            ->assertStatus(302);
    }
    */

}
