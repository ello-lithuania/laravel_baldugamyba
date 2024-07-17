<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Enums\RoleEnum;
use App\Models\Category;
use App\Models\Provider;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('test123'),
            'role' => RoleEnum::ADMIN->value
        ]);

        User::factory(40)->create();

        $categories = [
            'Virtuvės baldų gamyba',
            'Nestandartinių baldų gamyba',
            'Spintų gamyba',
            'Minkštų baldų gamyba',
            'Lovų gamyba',
            'Baldų dažymas',
            'Stalų gamyba',
            'Laiptų pakopų gamyba',
            'Biuro baldų gamyba',
            'Miegamojo baldų gamyba',
            'Baldų projektavimas, dizaineriai',
            // Add more categories as needed
        ];

        // Loop through the categories and insert them into the database
        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }


        Provider::factory(10)->create();

        foreach(Provider::all() as $provider) {
            $provider->categories()->attach(Category::inRandomOrder()->first());
        }
    }
}
