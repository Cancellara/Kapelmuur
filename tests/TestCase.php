<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function createUser($data)
    {
        return factory(User::class)->create($data);
    }
}
