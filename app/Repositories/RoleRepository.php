<?php

namespace App\Repositories;

use App\Role;
use App\User;
use Illuminate\Support\Facades\Auth;

class RoleRepository implements RoleRepositoryInterface
{
	/**
	 * Retrieve all records of a model
	 *
	 * @return mixed
	 */
	public function getAll()
	{
		return Role::all();
	}

	/**
	 * Retrieve single record of a model by id
	 *
	 * @param $id
	 * @return mixed
	 */
	public function find($id)
	{
		return Role::findOrFail($id);
	}

	/**
	 * Retrieve role by name
	 *
	 * @param $name
	 * @return mixed
	 */
	public function getByName($name)
	{
		return Role::where('name', $name)
			->pluck('name');
	}

	/**
	 * Retrieve all users with the role of player
	 *
	 * @return mixed
	 */
	public function getPlayers()
	{
		$roles = Role::with('users')->where('name', '=','player')->get();

		foreach($roles as $role)
		{
			return $role->users;
		}
	}

	/**
	 * Check if user has player role
	 *
	 * @return boolean
	 */
	public function hasPlayerRole()
	{
		$user = User::find(Auth::user()->id);
		$role = $user->roles()->where('name', '=', 'player')->first();

		if ( $role && ($role->pivot->user_id == $user->id) ) return true;

		return false;
	}

	/**
	 * Retrieve all users with the role of admin
	 *
	 * @return mixed
	 */
	public function getAdmin()
	{
		$roles = Role::with('users')->where('name', '=','admin')->get();

		foreach($roles as $role)
		{
			return $role->users;
		}
	}

	/**
	 * Check if user is admin role
	 *
	 * @return boolean
	 */
	public function isAdmin()
	{
		$user = User::find(Auth::user()->id);
		$role = $user->roles()->where('name', '=', 'admin')->first();

		if ( $role && ($role->pivot->user_id == $user->id) ) return true;

		return false;
	}
}