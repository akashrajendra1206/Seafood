<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $data = array(
		['id' => 1, 'name' => 'Avni','dob' =>'2018-03-21','gender' =>'f','email' =>'admin@gmail.com', 'password' =>'$2y$10$N0f37aVPwu.JY7VqydWc/OhPtiA0fGw.4m/8RF/bReSanvCnVXJ3G', 'image' =>'null', 'address' =>'Devgad', 'city_id' =>1, 'state_id' =>1, 'country_id' => 1, 'user_type' =>0,'contact_number' =>9867453212, 'activation_code' =>'', 'reset_password_code' =>'null', 'status' =>1],
		);
		DB::table('user')->insert($data);
    
    }
}