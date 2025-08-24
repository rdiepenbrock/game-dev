<?php

namespace App\Traits;

use App\Game;
use App\User;

trait gameUser
{
	/**
	 * Associate game with user
	 *
	 * @param $game_id
	 * @param  $user_id
	 *
	 * @return mixed
	 */
	public function gameUserRelation($game_id, $user_id)
	{
		$currentUser = User::find($user_id);

		$hasUser = $currentUser->games()->where('user_id', $user_id)
			->where('game_id', $game_id)
			->exists();

		if ($hasUser) return;

		return $currentUser->games()->attach($game_id);
	}
}