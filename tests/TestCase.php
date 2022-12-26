<?php

namespace WendellAdriel\ModelCompleted\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            \WendellAdriel\ModelCompleted\Providers\ModelCompletedServiceProvider::class,
        ];
    }
}
