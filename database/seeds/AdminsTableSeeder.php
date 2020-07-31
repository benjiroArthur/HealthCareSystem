<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = factory(App\Admin::class, 2)
            ->create()
            ->each(function ($user) {
                $user->user()->create([
                    'role_id' => 1,
                    'email' => $user->email,
                    'email_verified_at' => now(),
                    'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                    'remember_token' => \Str::random(10),
                    'profile_updated' => 1,
                ]);
            });
    }
}
