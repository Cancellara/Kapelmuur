<?php

namespace Tests;

use App\Model\Shop\Shop;
use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function createUser($data)
    {
        return factory(User::class)->create($data);
    }

    public function createShop($data)
    {
        return factory(Shop::class)->create($data);
    }
}
