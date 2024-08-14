<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $patientPassword = Hash::make('patient');
        $adminPassword = Hash::make('admin');
        //
        DB::table('users')->insert([
            [
                'role_id' => 1,
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => $adminPassword,
            ],
            [
                'role_id' => 2,
                'name' => 'patient',
                'email' => 'patient@gmail.com',
                'password' => $patientPassword,
            ]
        ]);
        // User::create();
    }
}
