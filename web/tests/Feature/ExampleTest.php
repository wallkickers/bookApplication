<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        // $response = $this->get('/');

        // // dd($response = $this);

        // $response->assertStatus(200);

        // // $response->dumpHeaders();

        // // $response->dump();

        $response = $this->json('GET', '/sample');
        // dd($response);

        //テストデータが二つ存在するとする
        $first = factory(App\User::class)->create();
        $second = factory(App\User::class)->create();
        $first->save();
        $second->save();

        //テスト開始
        $this->visit('/sample')
        ->see('佐賀県')
        ->see($first->id)->see($first->name)
        ->see($second->id)->see($second->name);

        // $response
        //     ->assertStatus(200)
        //     ->assertJson([
        //         'view' => "welcome",
        //     ]);

    // $this->visit('/sample')//  掲示板のトップページにアクセスしてみる
    // ->see('佐賀県'); //           「掲示板」という文字列が見える
    // ->see('新規投稿')//         「新規投稿」という文字列もある
    // ->click('新規投稿')//        新規投稿リンクをクリックしてみる
    // ->seePageIs('/boards/new')// 新規投稿ページに遷移する
    // ->see('新規記事投稿');//     新規投稿ページには「新規記事投稿」という文字列がある
    }
}
