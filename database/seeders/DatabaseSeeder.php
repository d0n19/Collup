<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        
        $cats = ['Web Development', 'Mobile Apps', 'AI & Machine Learning', 'Game Dev', 'Blockchain'];
        foreach ($cats as $cat) {
            Category::create(['name' => $cat, 'slug' => str($cat)->slug()]);
        }

       
        User::factory()->create([
            'name' => 'Founder Demo',
            'email' => 'founder@example.com',
            'password' => Hash::make('password'),
            'bio' => 'Looking for rockstars to build the next big thing.',
            'is_premium' => true
        ]);

        User::factory()->create([
            'name' => 'Dev Demo',
            'email' => 'dev@example.com',
            'password' => Hash::make('password'),
            'bio' => 'Fullstack developer skilled in Laravel and React.',
            'skills' => 'Laravel, React, Tailwind'
        ]);

        User::factory(10)->create();
    }
}
