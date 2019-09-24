<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'user_id' => DB::table('users')->orderBy('id', 'asc')->value('id'),
            'history' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem modi suscipit',
            'image' => 'landscape.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('posts')->insert([
            'user_id' => DB::table('users')->orderBy('id', 'desc')->value('id'),
            'history' => 'Lorem ipsum rem modi suscipit. Dolor sit amet, consectetur adipisicing elit.',
            'image' => 'shopping.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
