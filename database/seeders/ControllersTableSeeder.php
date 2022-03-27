<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ControllersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('controllers')->delete();
        
        DB::table('controllers')->insert(array (
            0 => 
            array (
                'id' => '23307e10-81a5-45a2-b8aa-e2976d384584',
                'controller_name' => 'Functions',
                'controller_desc' => 'Controller untuk mengelola data functions',
                'type' => 'core',
                'created_by' => 'admin',
                'updated_by' => NULL,
                'created_at' => '2022-01-25 14:46:00',
                'updated_at' => '2022-01-25 14:46:00',
            ),
            1 => 
            array (
                'id' => '2a110160-d7f6-4849-b3a9-ec6c271f5c5c',
                'controller_name' => 'Controllers',
                'controller_desc' => 'Controller untuk mengelola data controllers',
                'type' => 'core',
                'created_by' => 'admin',
                'updated_by' => 'admin',
                'created_at' => '2022-01-25 14:46:19',
                'updated_at' => '2022-01-25 15:34:51',
            ),
            2 => 
            array (
                'id' => '2a6c620e-24c1-4455-a647-cd7f1fe41646',
                'controller_name' => 'Modules',
                'controller_desc' => 'Controller untuk mengelola data modules',
                'type' => 'core',
                'created_by' => 'admin',
                'updated_by' => NULL,
                'created_at' => '2022-01-25 15:35:26',
                'updated_at' => '2022-01-25 15:35:26',
            ),
            3 => 
            array (
                'id' => '1b56c9c6-7055-4197-9f85-857c0f64210f',
                'controller_name' => 'Actions',
                'controller_desc' => 'Controller untuk mengelola data actions',
                'type' => 'core',
                'created_by' => 'admin',
                'updated_by' => NULL,
                'created_at' => '2022-01-25 15:35:48',
                'updated_at' => '2022-01-25 15:35:48',
            ),
            4 => 
            array (
                'id' => 'cf0d168e-94c8-42d1-95e1-d019c544cd75',
                'controller_name' => 'Permissions',
                'controller_desc' => 'Controller untuk mengelola data permissions',
                'type' => 'core',
                'created_by' => 'admin',
                'updated_by' => NULL,
                'created_at' => '2022-01-25 15:36:23',
                'updated_at' => '2022-01-25 15:36:23',
            ),
            5 => 
            array (
                'id' => '0c21105b-5fe8-47f2-a58f-03e5a3151ba3',
                'controller_name' => 'Roles',
                'controller_desc' => 'Controller untuk mengelola data roles',
                'type' => 'core',
                'created_by' => 'admin',
                'updated_by' => NULL,
                'created_at' => '2022-01-25 15:36:46',
                'updated_at' => '2022-01-25 15:36:46',
            ),
            6 => 
            array (
                'id' => '8c3697e8-6c90-464e-879e-bc2ff3f0f72b',
                'controller_name' => 'Menugroups',
                'controller_desc' => 'Controller untuk mengelola data menu group',
                'type' => 'core',
                'created_by' => 'superadmin',
                'updated_by' => NULL,
                'created_at' => '2022-02-10 16:20:54',
                'updated_at' => '2022-02-10 16:20:54',
            ),
            7 => 
            array (
                'id' => 'c5927319-f5c2-4190-bc44-af9b5b64c952',
                'controller_name' => 'Menus',
                'controller_desc' => 'Controller untuk mengola data menu',
                'type' => 'core',
                'created_by' => 'superadmin',
                'updated_by' => NULL,
                'created_at' => '2022-02-10 16:21:50',
                'updated_at' => '2022-02-10 16:21:50',
            ),
            8 => 
            array (
                'id' => 'a9ef3aba-5db4-4bd6-8d58-34874a5842e3',
                'controller_name' => 'User',
                'controller_desc' => 'Controller untuk mengelola data user',
                'type' => 'core',
                'created_by' => 'admin',
                'updated_by' => 'superadmin',
                'created_at' => '2022-01-25 15:37:48',
                'updated_at' => '2022-02-12 08:21:38',
            ),
        ));
        
        
    }
}