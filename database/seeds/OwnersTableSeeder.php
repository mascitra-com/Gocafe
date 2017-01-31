<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class OwnersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('owners')->insert([
            'id' => 'OWN'.random_int(100, 999).date('Ymdhis'),
            'user_id' => 1,
            'first_name' => 'Owner',
            'last_name' => 'Cafe',
            'address' => 'Jl. Bangka',
            'gender' => '0',
            'birthdate' => Carbon::createFromDate(1994, 9, 7, 'GMT'),
            'email' => 'info@owner.com',
            'created_by' => 1
        ]);
    }
}
