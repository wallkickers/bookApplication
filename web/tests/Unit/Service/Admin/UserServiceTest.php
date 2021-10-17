<?php

declare(strict_types=1);

namespace tests\Tests\Unit;

use App\Services\Admin\UserService;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    public function setup(): void
    {
        parent::setup();

        $this->artisan('migrate');
        $this->seed('TestDataSeeder');

        $this->target = new UserService();
    }

    /**
     * @test
     */
    public function searchByKeywordHitUser()
    {
        $keyword = '単体';

        $result = $this->target->searchByKeyword($keyword);
        $this->assertInstanceOf(Builder::class, $result);

        $users = $result->get();
        foreach ($users as $user) {
            $this->assertTrue(strpos($user->name, $keyword) !== false);
        }

    }

    /**
     * @test
     */
    public function searchByKeywordNoHitUser()
    {
        $keyword = '試験';

        $result = $this->target->searchByKeyword($keyword);
        $this->assertInstanceOf(Builder::class, $result);

        $users = $result->get();
        $this->assertTrue($users->isEmpty());
    }

    /**
     * @test
     */
    public function searchByKeywordKeywordIsEmpty()
    {
        $keyword = '';

        $result = $this->target->searchByKeyword($keyword);
        $this->assertInstanceOf(Builder::class, $result);

        $users = $result->get();
        $this->assertTrue(User::all() == $users);
    }

    /**
     * @test
     */
    public function findByUserId()
    {
        $userId = 1;
        $result = $this->target->{__FUNCTION__}($userId);
        $this->assertInstanceOf(User::class, $result);
        $this->assertSame('田中', $result->name);
    }

    /**
     * @test
     */
    public function deleteByUserId()
    {
        $userId = 1;
        $result = $this->target->{__FUNCTION__}($userId);
        $this->assertTrue($result);
        $this->assertNull(User::find($userId));
    }
}
