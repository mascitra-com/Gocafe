<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # Owner
        DB::table('users')->insert([
            'email' => 'owner@owner.com',
            'password' => bcrypt('owner'),
            'role' => 'owner',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        # Staff
        DB::table('users')->insert([
            'email' => 'staff@staff.com',
            'password' => bcrypt('staff'),
            'role' => 'staff',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
