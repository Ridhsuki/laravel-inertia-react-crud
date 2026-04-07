<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesTableSeeder::class,
            PermissionsTableSeeder::class,
            UserTableSeeder::class,
        ]);

        $user = User::where('email', 'admin@gmail.com')->first();

        Post::factory(10)->create([
            'user_id' => $user->id
        ]);
    }
}
