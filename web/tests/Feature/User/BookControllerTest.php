<?php

declare(strict_types=1);

namespace Tests\Feature\User;

use App\User;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
    protected $testUser;

    public function setup(): void
    {
        parent::setup();

        $this->artisan('migrate');
        $this->seed('TestDataSeeder');

        $this->testUser = User::find(1);
    }

    /**
     * @test
     */
    public function redirectLogin(): void
    {
        $response = $this->get(route('books.index'));
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function index(): void
    {
        // ログイン状態
        $this->actingAs($this->testUser);

        $response = $this->get(route('books.index'));
        $response->assertStatus(200);
        $response->assertViewIs('book.home');
        $response->assertSee('books');
    }

    /**
     * @test
     */
    public function search(): void
    {
        // ログイン状態
        $this->actingAs($this->testUser);

        $response = $this->get(route('books.search'));
        $response->assertStatus(200);
        $response->assertViewIs('book.home');
        $response->assertSee('books');
        $response->assertSee('keyword');
    }

    /**
     * @test
     */
    public function show(): void
    {
        // ログイン状態
        $this->actingAs($this->testUser);

        $response = $this->get(route('books.show', ['book' => 1]));
        $response->assertStatus(200);
        $response->assertViewIs('book.show');
        $response->assertSee('user');
        $response->assertSee('book');
        $response->assertSeeText('単体');
    }

    /**
     * @test
     */
    public function showBookParamError(): void
    {
        $this->markTestSkipped('TODO: bookパラメータがnullの場合エラー');

        // ログイン状態
        $this->actingAs($this->testUser);

        $response = $this->get(route('books.show', ['book' => null]));
        $response->assertStatus(302);
        $response->assertViewIs('book.home');
    }
}
