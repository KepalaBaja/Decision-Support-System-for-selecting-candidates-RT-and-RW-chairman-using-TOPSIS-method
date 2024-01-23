<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::insert([
            [
                'name'=>'User',
                'email'=>'user@gmail.com',
                'password'=>bcrypt('12345'),
                'created_at'=>\Carbon\Carbon::now('Asia/Jakarta')
            ]
        ]);
    }
}