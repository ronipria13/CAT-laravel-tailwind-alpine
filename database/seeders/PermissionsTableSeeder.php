<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('permissions')->delete();
        
        DB::table('permissions')->insert(array (
            0 => 
            array (
                'id' => 'a85addaa-a6cc-4cfd-802f-380e27949dc3',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'action_id' => 'ea65f82a-8168-4f12-9f51-38ea5e0777de',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 'ae95daf8-4a2c-4c56-b86a-b3c27cd83106',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'action_id' => '6029c8eb-9d58-45c7-8018-34bc92447d12',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 'e338a93f-d44f-4edd-a875-957b914338ce',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'action_id' => '61043b31-c667-4854-a06d-f87a293215f5',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 'c58db58b-676d-4695-97d5-9afa048dfd48',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'action_id' => 'dc66e8e5-2196-4b1a-aa9e-74defec16d2d',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => '3bfea278-d94a-454b-9fd3-c8df32b7d211',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'action_id' => 'c6aeb7a5-77d7-481a-a8db-348738847519',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => '153c4eb5-62fa-4d9d-8598-9e675c63d86d',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'action_id' => 'b48596f8-97fb-4ba1-a905-c7360ff02770',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => '9a8235b2-c1d4-4847-93cb-5cccdb2420a5',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'action_id' => '84eeb23c-797b-462b-a930-d1a5c0ef7f8e',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 'c87de7a5-ff89-4e50-afd5-36f6de4b4754',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'action_id' => 'aa74f684-5de2-4849-b2e7-8f57fffa271b',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => '51cd6b96-264f-4daa-b538-104e7419520a',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'action_id' => '972418c7-0aee-4b82-abd9-88a3b1a41c7f',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => '737456e5-fd0f-4040-b3b2-a4601b8e5237',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'action_id' => '17dcf572-a236-4aef-8dc0-a6e0a72c43e9',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => '192c7f63-fa36-4315-bf82-62c476ebde54',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'action_id' => 'bc539feb-d022-46ca-bcc7-f922afe3332c',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => '43bff4d3-feac-4716-bf4a-49d4fceabe5f',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'action_id' => '84b3e7c5-9037-4256-9ff9-87249cccf4d6',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id' => '6687710d-f6ee-4e97-a046-257c8fa6d7b0',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'action_id' => '6ff65182-9c4e-4f9c-8c83-caf7bff2084a',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'id' => '2037fe58-5134-4b40-8b48-dfe942bf6297',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'action_id' => 'dc81dd0c-4f43-4866-b2b7-45d3b4eeb693',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'id' => '38684fb5-836d-405a-baca-83e27a3987e1',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'action_id' => 'ae73534e-7eaa-404d-9610-0bd9193af9c8',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'id' => '43e4f93c-6731-486a-937c-fb948c9899e2',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'action_id' => '940d3953-2559-473c-afff-4b957281b690',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            16 => 
            array (
                'id' => '1c9f44ec-47c0-47a6-bf06-e95c49484ac5',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'action_id' => 'ecc32be4-b76e-419f-be53-bd0890055890',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'id' => '6c42346b-5666-4fcc-beae-921ca6e44472',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'action_id' => '83e36714-1b1f-43db-9f66-65998ad3426b',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            18 => 
            array (
                'id' => '124d745b-51b9-48b9-a1b8-96de5d9f27ab',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'action_id' => 'fd29f8ba-23f2-49fb-8a74-bcba3ecd16a6',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            19 => 
            array (
                'id' => 'fc0aa546-04b9-4e1c-9e65-96774f5fb150',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'action_id' => 'ed5bea0b-7129-46eb-91ee-0e5e57558f24',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            20 => 
            array (
                'id' => 'ba054b3d-2cd3-44b8-a33d-c5c80a04f02d',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'action_id' => '7a63c53b-7f06-4af8-935e-817e5af05062',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            21 => 
            array (
                'id' => '1745a025-e694-4b42-b554-296ef1cb9b5a',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'action_id' => '533f185b-2596-43a9-befd-61f4a39bfcd1',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            22 => 
            array (
                'id' => '417e818e-cd04-4a28-a403-e3cd9b82c1d5',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'action_id' => 'bf772d73-2ebe-40b9-ad70-37b5e12a6876',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            23 => 
            array (
                'id' => '24be51e6-0f08-4538-8ee9-8ea91a294e23',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'action_id' => '29b6f488-054a-48aa-a27f-c2fda7fb1142',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            24 => 
            array (
                'id' => 'ba92c479-458c-4a00-9ddb-b75503f7facb',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'action_id' => '85aca5e2-d66a-4927-bb26-d2940214f150',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            25 => 
            array (
                'id' => '1bdafc83-2b44-43b1-99d6-9c93b3f8ff83',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'action_id' => '3c4f498c-af99-4966-8398-b8b845bbc769',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            26 => 
            array (
                'id' => '08f7381b-475c-4f39-9d79-58ed518a9e4b',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'action_id' => 'd06b776d-36e9-4351-acfa-01744ef20d50',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            27 => 
            array (
                'id' => 'ec88b566-dd0c-423a-8891-e6640a7aade7',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'action_id' => '185c54cf-c7ec-4fdb-941b-08db060518bf',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            28 => 
            array (
                'id' => '62b605b7-fc20-4f3d-8c7b-ba6a6ba6bbab',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'action_id' => '1341d90e-145c-4467-8098-0eaa4fbf2bb4',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            29 => 
            array (
                'id' => '4ad16b81-df71-49ca-9fbe-69b63e68b3a8',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'action_id' => '36e55eda-ffc4-47d4-89ec-e589e1abcb9c',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            30 => 
            array (
                'id' => 'c801f122-2389-489a-9316-1efae3e30152',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'action_id' => '27a0cf62-feb7-409e-8293-a1e8427aa933',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            31 => 
            array (
                'id' => '9f22c7dc-9d07-4056-a46c-505fbde9ea4c',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'action_id' => 'a8c63ff7-0bc8-43b0-a243-38db33c9b2c7',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            32 => 
            array (
                'id' => '65296cfa-f5f0-4197-8304-97d4957b9417',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'action_id' => '7e3d0346-3465-44c6-a53b-5e8efaa2bf5f',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            33 => 
            array (
                'id' => 'a4a64db3-3b5f-4ed7-ae58-e2bbbfc1a03c',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'action_id' => '6a445882-a7b6-4732-ad6e-bb10469a5874',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            34 => 
            array (
                'id' => '3db686c7-a2d6-4245-95f4-f3d030235eb9',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'action_id' => '9161d272-ff9c-4d7a-88c9-c2e8e06aee0b',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            35 => 
            array (
                'id' => '2f88a8d8-e367-48f4-ba51-7ef95e219bd2',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'action_id' => '8ce25b64-fff9-4991-b71e-2b426fb03386',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            36 => 
            array (
                'id' => 'e5fa0d6b-4cd4-47ad-a1c0-cfbbfa18e51e',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'action_id' => '70fb3d19-abf7-47e1-a3e0-0d7b9f6a1af2',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            37 => 
            array (
                'id' => '86e64975-67d9-4390-95d4-a7eaf95f52cd',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'action_id' => 'ca1ed818-d960-46be-bac6-73c78c34e34a',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            38 => 
            array (
                'id' => 'bd872ee8-2bb3-451d-b8dd-51bc8232e1f2',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'action_id' => '30312482-9cc1-41be-95cd-1f7b5e444ff3',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            39 => 
            array (
                'id' => '8b491b97-d6f8-4242-a95a-f92c81c8c2c0',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'action_id' => 'd63aca0b-6a2e-474b-8817-c6b8ea090df5',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            40 => 
            array (
                'id' => '726f88cb-08da-487a-a4e7-859ef9633f36',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'action_id' => '191abd70-5092-4210-bcbb-0b6238522274',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            41 => 
            array (
                'id' => '9701f65c-138f-4cda-9a7a-4a522e7c8f47',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'action_id' => 'f866d0df-04e8-494e-84f6-a56a4b660b44',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            42 => 
            array (
                'id' => '20174b69-985d-48b9-9564-45220b2b4578',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'action_id' => 'fc6c5106-0e08-4e5e-ab88-eec42a398865',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            43 => 
            array (
                'id' => 'f9b7c12f-e118-45ad-ba37-39c9a9fd6dd6',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'action_id' => '7826c456-c50e-4997-aad4-1009688a507c',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            44 => 
            array (
                'id' => '2568a065-095f-45a1-91b3-60b830e477d4',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'action_id' => '7b28d968-a204-4231-bbe2-07c0763ed0c8',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            45 => 
            array (
                'id' => 'e571832e-f751-446c-b423-37ab7af60e95',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'action_id' => '47b4fe27-2c5f-421c-8962-27419b0a3f5c',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            46 => 
            array (
                'id' => '89893580-06cc-4361-83db-6043a631e1ff',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'action_id' => '58c0dfe3-e3ce-42f0-8458-561772f2ad11',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            47 => 
            array (
                'id' => 'f1551cac-8ca6-4cce-84cc-942ece446fed',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'action_id' => '0796eaef-2e71-42d5-83a9-682c7a2bd673',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            48 => 
            array (
                'id' => '6c4ec1d1-89d3-4a42-a2e8-bd5e5c7a9634',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'action_id' => 'ab0d0e09-a745-45a1-b009-0f917e1d4488',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            49 => 
            array (
                'id' => '21dd5e7a-ebcf-4c91-bf5d-fabf98455750',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'action_id' => 'c14b818d-34a2-45fe-8288-e9135f39c163',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            50 => 
            array (
                'id' => '35c3d80a-3647-4002-95e0-4a11e875c8b6',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'action_id' => 'bd19890b-cef6-472b-ab8d-ca1af20157b2',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            51 => 
            array (
                'id' => 'd1fed700-3462-49d8-a6ee-f0f7d9f87dfc',
                'role_id' => 'e4510500-70b4-44a9-968c-3e66fecc6fb9',
                'action_id' => 'dc35ef5c-4ba1-47cf-baa8-89a100982224',
                'type' => 'core',
                'created_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'updated_by' => '296c478c-3e40-4d05-83f5-a1e97e92aaf5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}