<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('menus')->delete();
        
        DB::table('menus')->insert(array (
            0 => 
            array (
                'id' => '6d3b6726-ffca-41f4-b9d0-6924a98f98c6',
                'menugroup_id' => '40b228fb-8825-4104-9aa2-f5ee05de10ff',
                'menu_label' => 'Functions',
                'menu_icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
<path fill-rule="evenodd" d="M14.243 5.757a6 6 0 10-.986 9.284 1 1 0 111.087 1.678A8 8 0 1118 10a3 3 0 01-4.8 2.401A4 4 0 1114 10a1 1 0 102 0c0-1.537-.586-3.07-1.757-4.243zM12 10a2 2 0 10-4 0 2 2 0 004 0z" clip-rule="evenodd" />
</svg>',
                'menu_desc' => 'Link menuju halaman Managements Functions',
                'menu_order' => 1,
                'route' => '/managements/functions',
                'action_id' => 'ea65f82a-8168-4f12-9f51-38ea5e0777de',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => NULL,
                'created_at' => '2022-02-10 16:06:24',
                'updated_at' => '2022-02-10 16:06:24',
            ),
            1 => 
            array (
                'id' => 'f828587f-8db2-4e3a-9b1a-3bbf068a8349',
                'menugroup_id' => '40b228fb-8825-4104-9aa2-f5ee05de10ff',
                'menu_label' => 'Controllers',
                'menu_icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
<path fill-rule="evenodd" d="M9 3a1 1 0 012 0v5.5a.5.5 0 001 0V4a1 1 0 112 0v4.5a.5.5 0 001 0V6a1 1 0 112 0v5a7 7 0 11-14 0V9a1 1 0 012 0v2.5a.5.5 0 001 0V4a1 1 0 012 0v4.5a.5.5 0 001 0V3z" clip-rule="evenodd" />
</svg>',
                'menu_desc' => 'Link menuju halaman Managements Controllers',
                'menu_order' => 2,
                'route' => '/managements/controllers',
                'action_id' => '84eeb23c-797b-462b-a930-d1a5c0ef7f8e',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => NULL,
                'created_at' => '2022-02-10 16:10:21',
                'updated_at' => '2022-02-10 16:10:21',
            ),
            2 => 
            array (
                'id' => '768b7b31-9b73-45fe-acac-2bf4b6a1bfec',
                'menugroup_id' => '40b228fb-8825-4104-9aa2-f5ee05de10ff',
                'menu_label' => 'Modules',
                'menu_icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
<path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd" />
<path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z" />
</svg>',
                'menu_desc' => 'Link menuju halaman Managements Modules',
                'menu_order' => 3,
                'route' => '/managements/modules',
                'action_id' => '6ff65182-9c4e-4f9c-8c83-caf7bff2084a',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => NULL,
                'created_at' => '2022-02-10 16:14:03',
                'updated_at' => '2022-02-10 16:14:03',
            ),
            3 => 
            array (
                'id' => '769ff10a-b1fe-4c47-af77-f6faf4b2a486',
                'menugroup_id' => '40b228fb-8825-4104-9aa2-f5ee05de10ff',
                'menu_label' => 'Roles',
                'menu_icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
<path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
</svg>',
                'menu_desc' => 'Link menuju halaman Managements Roles',
                'menu_order' => 4,
                'route' => '/managements/roles',
                'action_id' => '36e55eda-ffc4-47d4-89ec-e589e1abcb9c',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => NULL,
                'created_at' => '2022-02-10 16:14:54',
                'updated_at' => '2022-02-10 16:14:54',
            ),
            4 => 
            array (
                'id' => '47d2a211-3404-409d-8a68-05edc10607f1',
                'menugroup_id' => '40b228fb-8825-4104-9aa2-f5ee05de10ff',
                'menu_label' => 'Permissions',
                'menu_icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
<path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
</svg>',
                'menu_desc' => 'Link menuju halaman Managements Permissions',
                'menu_order' => 5,
                'route' => '/managements/permissions',
                'action_id' => '8ce25b64-fff9-4991-b71e-2b426fb03386',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => NULL,
                'created_at' => '2022-02-10 16:16:09',
                'updated_at' => '2022-02-10 16:16:09',
            ),
            5 => 
            array (
                'id' => '7fc11271-5412-462d-b7e2-8b7477e5dde9',
                'menugroup_id' => '40b228fb-8825-4104-9aa2-f5ee05de10ff',
                'menu_label' => 'User',
                'menu_icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
</svg>',
                'menu_desc' => 'Link menuju halaman Managements Users',
                'menu_order' => 6,
                'route' => '/managements/user',
                'action_id' => '36e55eda-ffc4-47d4-89ec-e589e1abcb9c',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => NULL,
                'created_at' => '2022-02-10 16:17:28',
                'updated_at' => '2022-02-10 16:17:28',
            ),
            6 => 
            array (
                'id' => '94daea0e-5702-4a45-aefb-249e06335793',
                'menugroup_id' => '40b228fb-8825-4104-9aa2-f5ee05de10ff',
                'menu_label' => 'Menu Group',
                'menu_icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
</svg>',
                'menu_desc' => 'Link menuju halaman Managements Menu Group',
                'menu_order' => 7,
                'route' => '/managements/menugroups',
                'action_id' => '191abd70-5092-4210-bcbb-0b6238522274',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => '2022-02-10 16:18:52',
                'updated_at' => '2022-02-10 16:31:31',
            ),
            7 => 
            array (
                'id' => '4c6578d0-bb6b-4190-bc49-1eff83d5917d',
                'menugroup_id' => '40b228fb-8825-4104-9aa2-f5ee05de10ff',
                'menu_label' => 'Menu',
                'menu_icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
</svg>',
                'menu_desc' => 'Link menuju halaman Managements Menu',
                'menu_order' => 8,
                'route' => '/managements/menus',
                'action_id' => '58c0dfe3-e3ce-42f0-8458-561772f2ad11',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => NULL,
                'created_at' => '2022-02-10 16:35:13',
                'updated_at' => '2022-02-10 16:35:13',
            ),
        ));
        
        
    }
}