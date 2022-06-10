<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
	$data = array(
	['id' => 1, 'state_id' => 1, 'name' => 'Guntur'],
	['id' => 2, 'state_id' => 1, 'name' => 'Kadappa'],
	['id' => 3, 'state_id' => 2, 'name' => 'Papumpare'],
	['id' => 4, 'state_id' => 2, 'name' => 'Lower Subanshiri'],
	['id' => 5, 'state_id' => 3, 'name' => 'Odalguri'],
	['id' => 6, 'state_id' => 3, 'name' => 'Tangla'],
	['id' => 7, 'state_id' => 4, 'name' => 'Pathna'],
	['id' => 8, 'state_id' =>4, 'name' => 'Buxar'],
	['id' => 9, 'state_id' => 5, 'name' => 'Akshardham'],
	['id' => 10, 'state_id' => 5, 'name' => 'Qutub minar'],
	['id' => 11, 'state_id' => 6, 'name' => 'Pune'],
	['id' => 12, 'state_id' => 6, 'name' => 'Mumbai']);
	DB::table('city')->insert($data);
		 	 
    }
}
