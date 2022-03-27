<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('roles')->delete();
        
        DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'role_name' => 'Superadmin',
                'role_desc' => 'Super Administrator merupakan akun dimana user bisa melakukan melakukan konfigurasi sistem secara penuh.',
                'type' => 'core',
                'created_by' => 'admin',
                'updated_by' => NULL,
                'created_at' => '2022-01-26 03:40:14',
                'updated_at' => '2022-01-26 03:40:14',
            ),
            1 => 
            array (
                'id' => 'bcd0b4ce-2cf8-4fc4-af88-4573c59a2377',
                'role_name' => 'Admin',
                'role_desc' => 'Administrator merupakan akun yang bisa melakukan konfigurasi dan mengelola semua data terkait proses bisnis sistem/aplikasi.',
                'type' => 'core',
                'created_by' => 'superadmin',
                'updated_by' => NULL,
                'created_at' => '2022-01-26 03:43:25',
                'updated_at' => '2022-02-12 18:01:59',
            ),
        ));
        
        
    }
}