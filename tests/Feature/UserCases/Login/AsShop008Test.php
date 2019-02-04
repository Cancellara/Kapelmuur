<?php

namespace Tests\Feature\UserCases\Login;

use App\Model\Shop\ShopType;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AsShop008Test extends TestCase
{
    use RefreshDatabase;

    /** @test  */
    public function it_test_that_a_login_page_exists()
    {
        $this->get('/login')
            ->assertStatus(200);
    }

    /** @test  */
    public function it_test_that_an_existing_and_active_shop_can_login()
    {
        $this->seed('ShopTypeSeeder');

        $shopType = ShopType::first()->id;
        $email = 'maildeprueba@mail.es';
        $pass = 'password';

        $shop =  $this->createShop( [
            'name' => 'name1',
            'cif' => 'A11111111',
            'email' => $email,
            'password' => bcrypt($pass),
            'active' => 1,
            'activation_code' => 'code',
            'shop_type' => $shopType,
        ]);

        $this->post('/loginShop', [
            'email' => $email,
            'password' => $pass,
        ])->assertRedirect('/shop/controlPanel');

        $this->assertTrue(Auth::guard('shop')->check());


    }

    /** @test */
    public function it_test_that_system_validate_credentials()
    {
        $this->seed('ShopTypeSeeder');

        $shopType = ShopType::first()->id;
        $email = 'maildeprueba@mail.es';
        $pass = 'password';

        $shop =  $this->createShop( [
            'name' => 'name1',
            'cif' => 'A11111111',
            'email' => $email,
            'password' => bcrypt($pass),
            'active' => 1,
            'activation_code' => 'code',
            'shop_type' => $shopType,
        ]);

        $this->post('login', [
            'email' => $email,
            'password' => 'otrapass',
        ]);

        $this->assertFalse(Auth::guard('shop')->check());
    }

    /** @test */
    public function it_test_that_an_inactive_sshop_cannot_login()
    {
        $this->seed('ShopTypeSeeder');

        $shopType = ShopType::first()->id;
        $email = 'maildeprueba@mail.es';
        $pass = 'password';

        $shop = $this->createShop([
            'name' => 'name1',
            'cif' => 'A11111111',
            'email' => $email,
            'password' => bcrypt($pass),
            'active' => 0,
            'activation_code' => 'code',
            'shop_type' => $shopType,
        ]);

        $this->post('login', [
            'email' => $email,
            'password' => $pass,
        ])->assertSessionHas('errorMessage');

        $this->assertFalse(Auth::guard('shop')->check());
}

    /** @test */
    public function it_test_that_a_logued_shop_can_logout()
    {
        $this->seed('ShopTypeSeeder');

        $shopType = ShopType::first()->id;
        $email = 'maildeprueba@mail.es';
        $pass = 'password';

        $shop = $this->createShop([
            'name' => 'name1',
            'cif' => 'A11111111',
            'email' => $email,
            'password' => bcrypt($pass),
            'active' => 0,
            'activation_code' => 'code',
            'shop_type' => $shopType,
        ]);

        $this->actingAs($shop)->post('logout')->assertRedirect('/');

        $this->assertFalse(Auth::guard('shop')->check());

    }

    /** @test */
    public function it_test_that_a_logued_shop_cannot_see_login_page()
    {
        $this->seed('ShopTypeSeeder');

        $shopType = ShopType::first()->id;
        $email = 'maildeprueba@mail.es';
        $pass = 'password';

        $shop = $this->createShop([
            'name' => 'name1',
            'cif' => 'A11111111',
            'email' => $email,
            'password' => bcrypt($pass),
            'active' => 0,
            'activation_code' => 'code',
            'shop_type' => $shopType,
        ]);

        $this->actingAs($shop)->get('login')->assertRedirect('/');
    }

    /** @test */
    public function it_test_that_a_guest_cannot_see_shop_control_panel()
    {
        $this->get('shop/controlPanel')
            ->assertStatus(302)
            ->assertRedirect('/login');
    }

    /** @test */
    public function it_test_that_a_active_user_cannot_see_shop_control_panel()
    {
        $email = 'maildeprueba@mail.es';
        $pass = 'password';

        $user = $this->createUser(['email' => $email,
            'password' => bcrypt($pass),
            'active' => 1,]);

        $this->actingAs($user)->get('/shop/controlPanel')
            ->assertStatus(302);
    }

    /** @test */
    public function it_test_that_a_inactive_user_cannot_see_shop_control_panel()
    {
        $email = 'maildeprueba@mail.es';
        $pass = 'password';

        $user = $this->createUser(['email' => $email,
            'password' => bcrypt($pass),
            'active' => 0,]);

        $this->actingAs($user)->get('/shop/controlPanel')
            ->assertStatus(302);
    }
}
