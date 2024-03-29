<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['name' => 'admin','display_name' => 'Quảng trị hệ thống'],
            ['name' => 'guest','display_name' => 'Khách hàng'],
            ['name' => 'developer','display_name' => 'Phát triển hệ thống'],
            ['name' => 'admin','content' => 'Chỉnh sủa nội dung'],
        ]);
    }
}
