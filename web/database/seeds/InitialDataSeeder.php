<?php

use Illuminate\Database\Seeder;

class InitialDataSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Admin::class)->create(
            [
                'name' => 'admin',
                'email' => 'admin@a.com',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            ]
        );

        factory(App\User::class)->create(
            [
                'name' => 'user',
                'email' => 'user@u.com',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            ]
        );

        factory(App\Slack::class)->create(
            [
                'name' => 'applicationNotification',
                'icon' => ':fire:',
                'channel' => 'slack_with_you',
                'url' => 'https://hooks.slack.com/services/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'
            ]
        );
    }
}
