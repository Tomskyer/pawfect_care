<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->count(10)
            ->create();

        DB::table('users')->insert([
            'name' => 'admin1',
            'email' => 'admin1@admin.com',
            'password' => Hash::make('password'),
            'postcode' => 'st42eh',
            'role' => '3',
        ]);

        DB::table('users')->insert([
            'name' => 'owner1',
            'email' => 'owner1@owner.com',
            'password' => Hash::make('password'),
            'postcode' => 'st33eh',
            'role' => '1',
        ]);

        DB::table('users')->insert([
            'name' => 'carer1',
            'email' => 'carer1@carer.com',
            'password' => Hash::make('password'),
            'postcode' => 'st44eh',
            'role' => '2',
            'carer_verified' => 'true',
        ]);
    }
}
