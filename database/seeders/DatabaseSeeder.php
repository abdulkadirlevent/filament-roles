<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    const IMAGE_URL = 'https://source.unsplash.com/random/200x200/?img=1';
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);
        $this->command->info('User Seeder.');
        $this->call(PermissionsSeeder::class);
        $this->command->info('Permissions Seeder.');

        Category::factory()->count(20)->create();
        $this->command->info('Categories created.');

    }
}
