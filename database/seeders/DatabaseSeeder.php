<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'career' => 'Ing_computation',
        ]);

        Role::create([
            'name' => 'admin',
        ]);
        Role::create([
            'name' => 'student',
        ]);
        Role::create([
            'name' => 'teacher',
        ]);

        $user->assignRole('admin');
    }
}
