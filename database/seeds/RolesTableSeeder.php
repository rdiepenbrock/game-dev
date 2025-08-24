<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('roles')->insert([
			['name' => 'admin'],
			['name' => 'player'],
			//['name' => 'game master']
		]);
    }
}
