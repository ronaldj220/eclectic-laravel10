<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Role::create(
            [
                'id' => 2,
                'role' => 'karyawan'
            ]
        );
        Role::create(
            [
                'id' => 3,
                'role' => 'direksi'
            ]
        );
        Role::create(
            [
                'id' => 4,
                'role' => 'finance'
            ]
        );
    }
}
