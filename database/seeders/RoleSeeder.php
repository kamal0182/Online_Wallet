<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Role::factory()->count(10)->create();
        User::factory(10)->create();

        Role::create([
        'name'=> 'user',
        'decription' =>  'this is user'
       ]);
    }
}
