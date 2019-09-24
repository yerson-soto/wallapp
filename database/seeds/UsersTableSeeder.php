<?php

use Faker\Provider\zh_TW\DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'role' => 'user',
            'name' => 'Michael',
            'surname' => 'Diaz',
            'username' => 'michael_83',
            'email' => 'michael@michael.com',
            'password' => bcrypt('michael'),
            'image' => 'default.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('users')->insert([
            'role' => 'user',
            'name' => 'George',
            'surname' => 'Brea',
            'username' => 'george_26',
            'email' => 'george@george.com',
            'password' => bcrypt('george'),
            'image' => 'default.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
