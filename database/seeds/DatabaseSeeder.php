<?php

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
        DB::table('users')->insert([
            'name' => 'admin',
            'password' => '$2y$10$PaCKCPvZJG5lYLlqttLVleIwx2UPmXBMuB7IcEXhEkhlYEApKCsSW',
            'created_at' => '2020-01-01 05:05:05',
            'updated_at' => '2020-01-01 05:05:05',
        ]);
        DB::table('user_infos')->insert([
            'user_id' => '1',
            'name'=>'مدیر',
            'family'=>'سامانه',
            'birthday'=>'2020-01-01 05:05:05',
            'created_at' => '2020-01-01 05:05:05',
            'updated_at' => '2020-01-01 05:05:05',
        ]);
        DB::table('oauth_clients')->insert([
            'name' => 'Vira Personal Access Client',
            'secret' => 'fKK5Bw8Bap8xpvGSc1ztK7WQSmecYRm4zwIF7hbO',
            'redirect' => 'http://localhost',
            'personal_access_client' => '1',
            'password_client' => '0',
            'revoked' => '0',
            'created_at' => '2020-01-01 05:05:05',
            'updated_at' => '2020-01-01 05:05:05',
        ]);
        DB::table('oauth_clients')->insert([
            'name' => 'Vira Password Grant Client',
            'secret' => 'be9k9dzqKPspEVdd6wbseUwAERnd7ePXfM7rlpKj',
            'redirect' => 'http://localhost',
            'personal_access_client' => '0',
            'password_client' => '1',
            'revoked' => '0',
            'created_at' => '2020-01-01 05:05:05',
            'updated_at' => '2020-01-01 05:05:05',
        ]);
        foreach (['administrator', 'secretariat' ,'employee'] as $key=>$value) {
            DB::table('permissions')->insert([
                'name' => $value,
                'created_at' => '2020-01-01 05:05:05',
                'updated_at' => '2020-01-01 05:05:05',
            ]);
            DB::table('user_permissions')->insert([
                'user_id' => '1',
                'permission_id' => $key+1,
            ]);
        }
        foreach (['Home', 'Product'] as $key=>$value) {
            DB::table('page_templates')->insert([
                'name' => $value,
                'route' => $value,
            ]);
        }
        foreach (['English', 'Farsi'] as $key=>$value) {
            DB::table('page_languages')->insert([
                'name' => $value,
            ]);
        }
    }
}
