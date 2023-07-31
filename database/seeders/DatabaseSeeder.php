<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::truncate();

        for($i=1; $i<=3; $i++) {
            User::factory()->create([
                'name' => 'user' . $i,
                'email' => 'test'. $i. '@mail.com',
                'password' => '123123123',
            ]);
        }
    }
}
