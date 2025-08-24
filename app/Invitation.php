<?php

namespace App;

use App\Game;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invitation extends Model
{
	use SoftDeletes;

	/**
	 * The columns that should be mutated to dates
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at'];

	/**
	 * The columns that cannot be assigned
	 *
	 * @var array
	 */
	protected $guarded = ['id'];

	/**
	 * Invitations belong to many games
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function games()
	{
		return $this->belongsToMany(Game::class);
	}

	/**
	 * Scope a query to only include accepted invitations
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeAccepted($query)
	{
		return $query->where('accepted', true);
	}

	/**
	 * Scope a query to only include invitations by email
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param 										$email
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeHasEmail($query, $email)
	{
		return $query->where('email', $email);
	}

	/**
	 * Scope a query to only include invitations by token
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param 										$token
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeHasToken($query, $token)
	{
		return $query->where('token', $token);
	}
}
