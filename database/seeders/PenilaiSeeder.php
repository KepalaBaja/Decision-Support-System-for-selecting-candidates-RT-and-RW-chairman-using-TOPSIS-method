<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenilaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        \App\Models\Penilai::insert([
            [
                'name'=>'Penilai 1',
                'email'=>'penilai_1@gmail.com',
                'password'=>bcrypt('12345'),
                'created_at'=>\Carbon\Carbon::now('Asia/Jakarta')
            ],
            [
                'name'=>'Penilai 2',
                'email'=>'penilai_2@gmail.com',
                'password'=>bcrypt('12345'),
                'created_at'=>\Carbon\Carbon::now('Asia/Jakarta')
            ],
            [
                'name'=>'Penilai 3',
                'email'=>'penilai_3@gmail.com',
                'password'=>bcrypt('12345'),
                'created_at'=>\Carbon\Carbon::now('Asia/Jakarta')
            ],
            [
                'name'=>'Penilai 4',
                'email'=>'penilai_4@gmail.com',
                'password'=>bcrypt('12345'),
                'created_at'=>\Carbon\Carbon::now('Asia/Jakarta')
            ],
            [
                'name'=>'Penilai 5',
                'email'=>'penilai_5@gmail.com',
                'password'=>bcrypt('12345'),
                'created_at'=>\Carbon\Carbon::now('Asia/Jakarta')
            ],
            
        ]);
    }
}