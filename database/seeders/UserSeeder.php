<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            [
                'name' => 'test11u',
                'email' => 'test11u@test.com',
                'password' => Hash::make('umarche5678'),
                'created_at' =>  '2021/11/11 11:11:11',
            ],[
                'name' => 'test22u',
                'email' => 'test22u@test.com',
                'password' => Hash::make('umarche5678'),
                'created_at' =>  '2021/11/11 11:11:11',
            ]
        ]);
    }
}
