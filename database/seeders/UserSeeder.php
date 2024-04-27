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
            ->count(20)
            ->create();

        DB::table('users')->insert([
            'name' => 'admin1',
            'email' => 'admin1@admin.com',
            'password' => Hash::make('adminadmin'),
            'postcode' => 'st33eh',
            'role' => '3',
        ]);
    }
}
