<?php

use Illuminate\Database\Seeder;

class CafesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cafes')->insert([
            'id' => 'CFE1s620170213061958',
            'owner_id' => 'OWN12920170213060758',
            'name' => 'Cafe ku',
            'description' => 'Kafe Pertama',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_by' => 1
        ]);
    }
}
