<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FunctionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('functions')->delete();
        
        DB::table('functions')->insert(array (
            0 => 
            array (
                'id' => '1198c41f-c120-465e-ab12-8cae427886e2',
                'function_name' => 'index',
                'function_desc' => 'Fungsi dasar yang menampilkan view halaman web',
                'type' => 'core',
                'created_by' => 'admin',
                'updated_by' => NULL,
                'created_at' => '2022-01-25 08:53:02',
                'updated_at' => '2022-01-25 08:53:02',
            ),
            1 => 
            array (
                'id' => '7ac18b68-6097-4a7e-8fee-05f123c4ab76',
                'function_name' => 'store',
                'function_desc' => 'Fungsi dasar yang menangani insert data',
                'type' => 'core',
                'created_by' => 'admin',
                'updated_by' => NULL,
                'created_at' => '2022-01-25 09:01:07',
                'updated_at' => '2022-01-25 09:01:07',
            ),
            2 => 
            array (
                'id' => '5a8d195f-c2f6-4a2d-a662-89a67a8eeb81',
                'function_name' => 'show',
                'function_desc' => 'Fungsi dasar yang menampilkan detail dari sebuah data',
                'type' => 'core',
                'created_by' => 'admin',
                'updated_by' => NULL,
                'created_at' => '2022-01-25 09:07:09',
                'updated_at' => '2022-01-25 09:07:09',
            ),
            3 => 
            array (
                'id' => 'a6b0e0ce-502b-4215-a138-676983b8ed6c',
                'function_name' => 'update',
                'function_desc' => 'Fungsi dasar yang menangani proses update data',
                'type' => 'core',
                'created_by' => 'admin',
                'updated_by' => NULL,
                'created_at' => '2022-01-25 09:09:56',
                'updated_at' => '2022-01-25 09:09:56',
            ),
            4 => 
            array (
                'id' => 'c3df7867-afe2-49a9-b2b0-4d84137c2913',
                'function_name' => 'destroy',
                'function_desc' => 'Fungsi dasar untuk menangani proses hapus data',
                'type' => 'core',
                'created_by' => 'admin',
                'updated_by' => 'admin',
                'created_at' => '2022-01-25 09:30:41',
                'updated_at' => '2022-01-25 13:52:11',
            ),
            5 => 
            array (
                'id' => '0fbbbe9e-2b78-43a0-835d-0803f12f1136',
                'function_name' => 'showall',
                'function_desc' => 'Fungsi dasar untuk menampilkan semua data yang terkait dalam controller',
                'type' => 'core',
                'created_by' => 'admin',
                'updated_by' => 'admin',
                'created_at' => '2022-01-26 09:21:30',
                'updated_at' => '2022-02-01 17:20:19',
            ),
        ));
        
        
    }
}