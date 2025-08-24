<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Game extends Model
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
	 * Games can belong to many invitations
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function invitations()
	{
		return $this->belongsToMany(Invitation::class);
	}

	/**
	 * Games can belong to many users
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
    public function users()
	{
		return $this->belongsToMany(User::class);
	}
}
