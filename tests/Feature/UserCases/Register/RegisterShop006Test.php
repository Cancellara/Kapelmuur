<?php

namespace Tests\Feature\UserCases\Register;

use App\Model\Shop\ShopType;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterShop006Test extends TestCase
{
    use RefreshDatabase;

    /** @test  */
    public function it_test_that_a_user_register_page_exists()
    {
        $text = trans('auth.shop');
        $this->get('register')
            ->assertStatus(200)
            ->assertSee($text);
    }

    /** @test */
    public function it_test_that_the_shop_register_form_is_validated()
    {
        $this->post('/registerShop', [
            'name' => 'name1',
            'cif' => '111111111111',
            'email' => 'aaaaa',
            'password' => '111111',
            'password_confirmation' => '111221',
        ])->assertSessionHasErrors(['cif', 'email', 'password']);

    }

    /** @test */
    public function it_test_that_a_guest_can_register_as_shop()
    {
        $this->seed('ShopTypeSeeder');
        $text = trans('shop/typeSelection.header');

        $this->post('/registerShop', [
            'name' => 'name1',
            'cif' => 'A11111111',
            'email' => 'tiendadeprueba1@tienda.es',
            'password' => '111111',
            'password_confirmation' => '111111',
            'accept_conditions' => true
        ])->assertRedirect('/shop/typeSelection');

        $this->assertDatabaseHas('shops', [
            'email' => 'tiendadeprueba1@tienda.es',
            'active' => 0]);

    }

    /** @test */
    public function it_test_that_a_shop_can_activate_its_account()
    {
        $this->seed('ShopTypeSeeder');
        $code = 'testcode';
        $shopType = ShopType::first()->id;

        $this->createShop( [
            'name' => 'name1',
            'cif' => 'A11111111',
            'email' => 'tiendadeprueba1@tienda.es',
            'password' => '111111',
            'activation_code' => $code,
            'shop_type' => $shopType,
        ]);

        $this->assertDatabaseHas('shops', ['email' => 'tiendadeprueba1@tienda.es',
            'active' => 0,
            'activation_code' => $code]);

        $this->get('/verify/shop/'.$code)
            ->assertRedirect('/')
            ->assertSessionHas('confirmMessage');;

        $this->assertDatabaseHas('shops', ['email' => 'tiendadeprueba1@tienda.es',
            'active' => 1,
            'activation_code' => null]);
    }

    /** @test */
    public function it_test_that_an_invalid_activation_code_redirect_return_error()
    {
        $this->seed('ShopTypeSeeder');
        $code = 'testcode';
        $shopType = ShopType::first()->id;

        $this->createShop( [
            'name' => 'name1',
            'cif' => 'A11111111',
            'email' => 'tiendadeprueba1@tienda.es',
            'password' => '111111',
            'activation_code' => $code,
            'shop_type' => $shopType,
        ]);

        $this->get('/verify/shop/codigonovalido')
            ->assertRedirect('/')
            ->assertSessionHas('errorMessage');

    }

    /** @test */
    public function it_test_that_only_an_inactive_shop_can_see_type_selection_page()
    {
        $this->seed('ShopTypeSeeder');
        $shopType = ShopType::first()->id;

        $this->get('/shop/typeSelection')
            ->assertRedirect('/');

        $shop =  $this->createShop( [
            'name' => 'name1',
            'cif' => 'A11111111',
            'email' => 'tiendadeprueba1@tienda.es',
            'password' => '111111',
            'active' => 1,
            'activation_code' => 'code',
            'shop_type' => $shopType,
        ]);

        $this->actingAs($shop)->get('/shop/typeSelection')
            ->assertRedirect('/');

        $shop->active = 0;
        $shop->save();

        $this->actingAs($shop)->get('/shop/typeSelection')
            ->assertStatus(302);
    }


}
