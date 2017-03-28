<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CafeBranchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cafe_branches')->insert([
            'id' => 'CFBksJ20170213062317',
            'cafe_id' => 'CFE1s620170213061958',
            'location_id' => '3509030',
            'address' => 'Kasiyan Timur',
            'phone' => '08980192222',
            'open_hours' => '18.00 WIB',
            'close_hours' => '23.00 WIB',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_by' => 1
        ]);
    }
}
