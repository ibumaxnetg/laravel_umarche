<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('owners')->insert([
            [
                'name' => 'test11o',
            'email' => 'test11o@test.com',
            'password' => Hash::make('umarche5678'),
            'created_at' =>  '2021/11/11 11:11:11',
            ],[
            'name' => 'test22o',
            'email' => 'test22o@test.com',
            'password' => Hash::make('umarche5678'),
            'created_at' =>  '2021/11/11 11:11:11',
            ],[
            'name' => 'test33o',
            'email' => 'test33o@test.com',
            'password' => Hash::make('umarche5678'),
            'created_at' =>  '2021/11/11 11:11:11',
            ],
        ]);

    }
}
