<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
	/**
	 * Retrieve all records of a model
	 *
	 * @return mixed
	 */
	public function getAll();

	/**
	 * Retrieve single record from a model by id
	 *
	 * @param $id
	 * @return mixed
	 */
	public function find($id);

	/**
	 * Retrieve single record of a model by email
	 *
	 * @param $email
	 * @return mixed
	 */
	public function findByEmail($email);

	/**
	 * Retrieve a single record from a model by provider id
	 *
	 * @param $provider_id
	 * @return mixed
	 */
	public function getUserByProviderId($provider_id);

	/**
	 * Retrieve an authenticated username
	 *
	 * @return mixed
	 */
	public function username();

	/**
	 * Store a new instance of the model
	 *
	 * @param $data
	 * @return mixed
	 */
	public function storeUserWithProvider($data);

    /**
     * Check if user has attributes
     *
     * @param $id
     *
     * @return boolean
     */
	public function hasUserAttributes($id);

    /**
     * Store user attributes for a given user model
     *
     * @param $data
     * @return mixed
     */
    public function storeUserAttributes($data);

    /**
     * Update user avatar for a given user model
     *
     * @param $data
     * @return mixed
     */
    public function updateUserAvatar($data);

	/**
	 * Retrieve a picture for a given user
	 *
	 * @param $id
	 * @return mixed
	 */
	public function getPicture($id);

	/**
	 * Retrieve a uuid for a given user
	 *
	 * @param $id
	 * @return mixed
	 */
	public function getUUID($id);
}