<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenugroupsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('menugroups')->delete();
        
        DB::table('menugroups')->insert(array (
            0 => 
            array (
                'id' => '40b228fb-8825-4104-9aa2-f5ee05de10ff',
                'menugroup_label' => 'Managements',
                'menugroup_desc' => 'Menu yang menampilkan link fitur-fitur dalam module managements',
                'menugroup_order' => 1,
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => NULL,
                'created_at' => '2022-02-10 07:55:05',
                'updated_at' => '2022-02-10 07:55:05',
            ),
            1 => 
            array (
                'id' => '0acdc906-d7f9-43e4-ba50-b767477c5b16',
                'menugroup_label' => 'Data',
                'menugroup_desc' => 'Menu yang menampilkan link fitur-fitur dalam module data',
                'menugroup_order' => 2,
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => '2022-02-10 16:36:15',
                'updated_at' => '2022-02-12 09:00:15',
            ),
        ));
        
        
    }
}