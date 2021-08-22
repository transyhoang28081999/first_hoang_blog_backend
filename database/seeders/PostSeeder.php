<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'title'=> 'China',
            'description'=> 'Description of China',
            'user_id' => 1
        ]);
        DB::table('posts')->insert([
            'title'=> 'Vietnam',
            'description'=> 'Description of China',
            'user_id' => 1
        ]);
    }
}
