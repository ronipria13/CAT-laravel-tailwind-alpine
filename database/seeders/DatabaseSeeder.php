<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        set_time_limit(999999);
        $this->call(UsersTableSeeder::class);
        $this->call(ControllersTableSeeder::class);
        $this->call(FunctionsTableSeeder::class);
        $this->call(ModulesTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(ActionsTableSeeder::class);
        $this->call(MenugroupsTableSeeder::class);
        $this->call(MenusTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(RoleplayTableSeeder::class);
    }
}
