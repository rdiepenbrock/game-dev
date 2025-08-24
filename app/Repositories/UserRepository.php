<?php

namespace App\Repositories;

use App\User;
use App\UserAttribute;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserRepositoryInterface
{
	/**
	 * Retrieve all records of a model
	 *
	 * @return mixed
	 */
	public function getAll()
	{
		return User::all();
	}

	/**
	 * Retrieve single record of a model by id
	 *
	 * @param $id
	 * @return mixed
	 */
	public function find($id)
	{
		return User::findOrFail($id);
	}

	/**
	 * Retrieve single record of a model by email
	 *
	 * @param $email
	 * @return mixed
	 */
	public function findByEmail($email)
	{
		return User::where('email', '=', $email)->first();
	}

	/**
	 * Retrieve a single record from a model by provider id
	 *
	 * @param $provider_id
	 * @return mixed
	 */
	public function getUserByProviderId($provider_id)
	{
		return User::where('provider_id', $provider_id)->first();
	}

	/**
	 * Retrieve an authenticated username
	 *
	 * @return mixed
	 */
	public function username()
	{
		$user = Auth::user();
		return $user->username;
	}

    /**
     * Store a new instance of the model
     *
     * @param $data
     * @return mixed
     */
    public function storeUserWithProvider($data)
    {
        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $data['password'],
            'provider' => $data['provider'],
            'provider_id' => $data['provider_id']
        ]);
    }

    /**
     * Check if user has attributes
     *
     * @param $id
     *
     * @return boolean
     */
    public function hasUserAttributes($id)
    {
        $user = $this->find($id);

        if ($user->userAttributes()->where('user_id', $user->id)->exists())
        {
            return true;
        }

        return false;
    }

    /**
     * Store user attributes for a given user model
     *
     * @param $data
     * @return mixed
     */
    public function storeUserAttributes($data)
    {
        return UserAttribute::create([
            'user_id' => $data['user_id'],
            'uuid' => $data['uuid'],
            'picture' => $data['picture'],
        ]);
    }

    /**
     * Update user avatar for a given user model
     *
     * @param $data
     * @return mixed
     */
    public function updateUserAvatar($data)
    {
        return UserAttribute::where('user_id', $data['user_id'])
            ->update([
                'picture' => $data['picture'],
            ]);
    }

	/**
	 * Retrieve a picture for a given user
	 *
	 * @param $id
	 * @return mixed
	 */
	public function getPicture($id)
	{
		return UserAttribute::where('user_id', $id)
			->pluck('picture')
            ->first();
	}

	/**
	 * Retrieve a user's UUID
	 *
	 * @param $id
	 * @return mixed
	 */
	public function getUUID($id)
	{
		return UserAttribute::where('user_id', $id)
			->pluck('uuid')
            ->first();
	}
}