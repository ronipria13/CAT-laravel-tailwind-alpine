<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleplayTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('roleplay')->delete();
        
        DB::table('roleplay')->insert(array (
            0 => 
            array (
                'id' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'user_id' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'type' => 'core',
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => '87067462-2a32-4d42-9904-7afa22e8d167',
                'user_id' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'role_id' => 'bcd0b4ce-2cf8-4fc4-af88-4573c59a2377',
                'type' => 'core',
                'created_by' => 'superadmin',
                'updated_by' => 'superadmin',
                'created_at' => '2022-02-12 15:10:46',
                'updated_at' => '2022-02-12 15:10:46',
            ),
            2 => 
            array (
                'id' => '9d370b3f-a4cc-4e27-90d3-bd8866a0db17',
                'user_id' => '9104e031-2976-4d68-99f3-1d57214beb18',
                'role_id' => 'bcd0b4ce-2cf8-4fc4-af88-4573c59a2377',
                'type' => 'core',
                'created_by' => 'superadmin',
                'updated_by' => 'superadmin',
                'created_at' => '2022-02-12 16:01:47',
                'updated_at' => '2022-02-12 16:01:47',
            ),
        ));
        
        
    }
}