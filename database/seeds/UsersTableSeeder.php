<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$admin = Role::where('name', 'admin')->first();

    	$user = new User();
    	$user->username = 'admin';
    	$user->email = 'admin@elic.io';
    	$user->password = bcrypt('admin123');
    	$user->save();

        $user->roles()->attach($admin);
    }
}
