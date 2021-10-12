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
                    'company_id' => $company->id,
                ]
            );

            factory(Book::class)->create(
                [
                    'user_id' => $user->id
                ]
            );
        });
    }
}
