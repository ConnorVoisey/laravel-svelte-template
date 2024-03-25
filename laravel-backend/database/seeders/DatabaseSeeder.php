<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            RolesAndPermissions::class,
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Test Admin',
            'email' => 'admin@test.test',
        ])->assignRole('admin');

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@test.test',
        ])->assignRole('user');
    }
}
