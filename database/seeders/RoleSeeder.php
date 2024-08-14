<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('roles')->insert(
            [
                [
                    'role_name' => 'Admin',
                ],
                [
                    'role_name' => 'Patient',
                ],
                [
                    'role_name' => 'Doctor',
                ],
                [
                    'role_name' => 'Nurse',
                ],
            ]
        );
    }
}
