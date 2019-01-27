<?php

namespace Tests\Feature\UserCases\Register;

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
}
