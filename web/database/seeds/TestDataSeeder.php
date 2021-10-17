<?php

declare(strict_types=1);

use App\Admin;
use App\Book;
use App\Company;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestDataSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $company = factory(Company::class)->create();

            $admin = factory(Admin::class)->create(
                [
                    'company_id' => $company->id,
                ]
            );

            $user = factory(User::class)->create(
                [
                    'id' => 1,
                    'name' => '田中',
                    'email' => 'tanaka@example.com',
                    'company_id' => $company->id,
                ]
            );

            // nameが「田中」
            for ($i=0; $i<5; $i++) {
                factory(User::class)->create(
                    [
                        'name' => '単体' . $i,
                        'company_id' => $company->id,
                    ]
                );
            }

            factory(Book::class)->create(
                [
                    'book_name' => '単体',
                    'user_id' => $user->id,
                ]
            );
        });
    }
}
