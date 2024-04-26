<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('services')->insert([
            'name' => 'Walking'
        ]);

        DB::table('services')->insert([
            'name' => 'Boarding'
        ]);

        DB::table('services')->insert([
            'name' => 'Sitting' 
        ]);

        DB::table('services')->insert([
            'name' => 'Taxi'
        ]);
    }
}
