<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([

            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => 111,
                'created_at' => Carbon::now(),
            ]

        ]);
    }
}
