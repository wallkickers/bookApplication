<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 開発用
        // $this->call(InitialDataSeeder::class);

        // テスト用
        $this->call(TestDataSeeder::class);
    }
}
