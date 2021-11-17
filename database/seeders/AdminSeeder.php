<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('admins')->insert([
            [
            'name' => 'test11a',
            'email' => 'test11a@test.com',
            'password' => Hash::make('umarche5678'),
            'created_at' =>  '2021/11/11 11:11:11',
        ],[
            'name' => 'test22a',
            'email' => 'test22a@test.com',
            'password' => Hash::make('umarche5678'),
            'created_at' =>  '2021/11/11 11:11:11',
        ],[
            'name' => 'test33a',
            'email' => 'test33a@test.com',
            'password' => Hash::make('umarche5678'),
            'created_at' =>  '2021/11/11 11:11:11',
        ],
        ]);
    }
}
