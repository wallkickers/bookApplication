<?php

declare(strict_types=1);

namespace tests\Tests\Unit;

use Tests\TestCase;
use App\Services\Admin\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserServiceTest extends TestCase
{
    public function setup(): void
    {
        parent::setup();

        $this->artisan('migrate');
        $this->seed('TestDataSeeder');
    }

    public function testBasicTest()
    {
        $this->assertTrue(true);
    }
}
