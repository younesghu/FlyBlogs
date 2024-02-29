<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Blog;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    public function run(): void
    {
        \App\Models\User::factory(1)->create([
            'name' => 'younes',
            'email' => 'younes@test',
            'password' => 'younes2024@@',
        ]);
        \App\Models\User::factory(1)->create();
        Blog::factory(9)->create(['user_id' => 1]);



        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
