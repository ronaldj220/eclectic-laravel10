<?php

namespace Database\Seeders;

use App\Models\Role_Has_User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleHasUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role_Has_User::create([
            'fk_user' => 1,
            'fk_role' => 1
        ]);
        Role_Has_User::create([
            'fk_user' => 2,
            'fk_role' => 2
        ]);
        Role_Has_User::create([
            'fk_user' => 3,
            'fk_role' => 3
        ]);
        Role_Has_User::create([
            'fk_user' => 4,
            'fk_role' => 4
        ]);
        Role_Has_User::create([
            'fk_user' => 5,
            'fk_role' => 2
        ]);
    }
}
