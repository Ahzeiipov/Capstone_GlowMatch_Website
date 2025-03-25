<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('setting')->insert([
            'id_setting' => 1,
            'nama_company' => 'GlowMatch',
            'address' => 'CADT',
            'tipe_note' => 1, 
            'discount' => 5,
            'path_logo' => '/img/logo.png',
        ]);
    }
}
