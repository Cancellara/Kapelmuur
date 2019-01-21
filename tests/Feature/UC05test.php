<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UC05test extends TestCase
{
    use RefreshDatabase;

    /** @test  */
    public function it_test_that_an_user_register_page_exists()
    {
        $this->get('user/register')
            ->assertStatus(200)
            ->assertSee('reg');
    }

    /** @test  */
    public function it_test_that_somebody_can_register_as_a_user()
    {
        //Petición
        $this->post('user/register', [
            'name' => 'Miguel',
            'surname' => 'Ruiz',
            'email' => 'miguelintxi@gmail.com',
            'password' => '111111',
            'password_confirmation' => '111111'
        ])->assertRedirect('/')
            ->assertStatus(302)
            ->assertSee('email');

        //Usuario registrado en BBDD
        $this->assertDatabaseHas('users', [
            'name' => 'Miguel',
            'active' => 0]);
    }

    /** @test  */
    public function it_test_that_register_form_is_validated()
    {
        $this->post('user/register', [
            'name' => 'Miguel',
            'surname' => 'Ruiz',
            'email' => 'miguelintxi@gmail.com',
            'password' => '11',
            'password_confirmation' => '11'
        ])->assertSessionHasErrors(['password']);
    }

    /** @test  */
    public function it_test_that_a_an_user_can_be_activated()
    {
        $code = '1234456';
        $email = 'emiliodeprueba@gmail.com';
        $uri = 'user/register/verify/' . $code;

        $this -> createUser([
                'email' => $email,
                'activation_code' => $code]
        );

        $this->assertDatabaseHas('users', [
            'email' => $email,
            'active' => 0]);

        $this->get($uri)
            ->assertRedirect('/user/login');

        $this->assertDatabaseHas('users', [
            'email' => $email,
            'active' => 1]);
    }
}
