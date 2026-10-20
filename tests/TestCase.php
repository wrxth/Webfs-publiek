<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function formData(array $data): array
    {
        $token = 'test-token';

        $this->withSession(['_token' => $token]);

        return ['_token' => $token] + $data;
    }
}
