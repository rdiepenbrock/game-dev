<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

	/**
	 * The columns that can be mass assigned
	 *
	 * @var array
	 */
	protected $fillable = [
		'username', 'email', 'password', 'provider_id', 'provider',
	];

    /**
     * The columns that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
		'remember_token', 'password'
    ];

    protected $rules = [

	];

	/**
	 * User has many attributes
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function userAttributes()
	{
		return $this->hasOne(UserAttribute::class);
	}

	/**
	 * User can belong to many games
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
    public function games()
	{
		return $this->belongsToMany(Game::class);
	}

	/**
	 * User can belong to many roles
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function roles()
	{
		return $this->belongsToMany(Role::class);
	}
}
