<?php

namespace App\Traits;

use App\Game;
use App\Invitation;

trait gameInvitation
{
	/**
	 * Associate game with invitation
	 *
	 * @param $game_id
	 * @param  $invitation_id
	 *
	 * @return mixed
	 */
	public function gameInviteRelation($game_id, $invitation_id)
	{
		$game = Game::find($game_id);

		$hasInvite = $game->invitations()->where('game_id', $game->id)
			->where('invitation_id', $invitation_id)
			->exists();

		if ($hasInvite) return;

		return $game->invitations()->attach($invitation_id);
	}
}