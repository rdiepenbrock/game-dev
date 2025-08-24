<?php

namespace App\Traits;

use App\User;
use App\Role;
use Illuminate\Support\Facades\Auth;

trait attachRoles
{
	/**
	 * Attach admin role to user
	 *
	 * @param $id
	 * @return mixed
	 */
	public function adminRole($id)
	{
		$currentUser = User::find($id);

		$hasRole = $currentUser->roles()->where('user_id', $id)->exists();
		if ($hasRole) return;

		$role = Role::where('name', 'admin')->first();

		return $currentUser->roles()->attach($role->id);
	}

	/**
	 * Attach player role to user
	 *
	 * @param $id
	 * @return mixed
	 */
	public function playerRole($id)
	{
		$currentUser = User::find($id);

		$hasRole = $currentUser->roles()->where('user_id', $id)->exists();
		if ($hasRole) return;

		$role = Role::where('name', 'player')->first();

		return $currentUser->roles()->attach($role->id);

	}
}