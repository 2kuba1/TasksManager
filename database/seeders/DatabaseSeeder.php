<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $roles = ['user', 'manager', 'admin'];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        Task::factory(10)->create();
    }
}
