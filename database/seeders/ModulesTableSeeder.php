<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModulesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('modules')->delete();
        
        DB::table('modules')->insert(array (
            0 => 
            array (
                'id' => 'c6011ac2-7e80-482e-9ffd-b565a18288aa',
                'module_name' => 'Managements',
                'module_desc' => 'Modul yang berisikan pengaturan dasar template aplikasi',
                'type' => 'core',
                'created_by' => 'admin',
                'updated_by' => 'admin',
                'created_at' => '2022-01-25 16:36:40',
                'updated_at' => '2022-01-26 06:48:12',
            ),
            1 => 
            array (
                'id' => 'ece4e113-2f54-41fb-bc7b-f6ee87f52894',
                'module_name' => 'Data',
                'module_desc' => 'Modul yang digunakan sebagai pengelola data master pada sebuah proses bisnis',
                'type' => 'core',
                'created_by' => 'admin',
                'updated_by' => NULL,
                'created_at' => '2022-02-06 08:57:38',
                'updated_at' => '2022-02-06 08:57:38',
            ),
        ));
        
        
    }
}