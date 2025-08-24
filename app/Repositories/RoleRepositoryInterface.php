<?php

namespace App\Repositories;

interface RoleRepositoryInterface
{
	/**
	 * Retrieve all records of a model
	 *
	 * @return mixed
	 */
	public function getAll();

	/**
	 * Retrieve single record of a model by id
	 *
	 * @param $id
	 * @return mixed
	 */
	public function find($id);

	/**
	 * Retrieve role by name
	 *
	 * @param $name
	 * @return mixed
	 */
	public function getByName($name);

	/**
	 * Retrieve all users with the role of player
	 *
	 * @return mixed
	 */
	public function getPlayers();

	/**
	 * Check if user has player role
	 *
	 * @return boolean
	 */
	public function hasPlayerRole();

	/**
	 * Retrieve user with the role of admin
	 *
	 * @return mixed
	 */
	public function getAdmin();

	/**
	 * Check if user is admin role
	 *
	 * @return boolean
	 */
	public function isAdmin();
}