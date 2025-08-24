<?php

namespace App\Repositories;

interface GameRepositoryInterface
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
	 * Retrieve all users associated with a game
	 * Exclude Admin user for prototype
	 *
	 * @param $id
	 *
	 * @return mixed
	 */
	public function participants($id);

	/**
	 * Retrieve all users assigned as game master
	 *
	 * @return mixed
	 */
	public function getGameMasters();

	/**
	 * Check if user is a game master
	 *
	 * @return boolean
	 */
	public function isGameMaster();

	/**
	 * Retrieve all active game records
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|static[]
	 */
	public function activeGames();

	/**
	 * Check if game is active
	 *
	 * @param $id
	 * @return boolean
	 */
	public function isActive($id);

	/**
	 * Retrieve all completed game records
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|static[]
	 */
	public function completedGames();

	/**
	 * Check if game is completed
	 *
	 * @param $id
	 * @return boolean
	 */
	public function isCompleted($id);

	/**
	 * Retrieve all deleted game records
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|static[]
	 */
	public function deletedGames();


	/**
	 * Retrieve all inactive game records
	 * from games not yet started
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|static[]
	 */
	public function inactiveGames();

	/**
	 * Retrieve all inactive games with a user relationship
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|static[]
	 */
	public function joinedGames();

	/**
	 * Check if a game can be joined by a user
	 * from an invitation
	 *
	 * @param $token
	 * @param $email
	 * @return bool
	 */
	public function canJoin($token, $email);

	/**
	 * Check if a game has been joined by a user
	 *
	 * @param $id
	 * @return bool
	 */
	public function hasJoined($id);

	/**
	 * Retrieve all games ready to be started
	 *
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|static[]
	 */
	public function startGames();

	/**
	 * Retrieve the number of active players for a given record
	 *
	 * @param $id
	 * @return mixed
	 */
	public function numberOfActivePlayers($id);

	/**
	 * Retrieve the number of players related to a given record
	 * Exclude Admin user for prototype
	 *
	 * @param $id
	 * @return mixed
	 */
	public function getGameUsersCount($id);

	/**
	 * Calculate the number of players outstanding for a given record
	 *
	 * @param $id
	 * @return mixed
	 */
	public function numberOfPlayersOutstanding($id);

	/**
	 * Check if a game record has reached max players
	 *
	 * @param $id
	 * @return boolean
	 */
	public function hasMaxPlayers($id);

	/**
	 * Retrieve the number of invitations related to a game
	 *
	 * @param $id
	 * @return int
	 */
	public function countInvitations($id);

	/**
	 * Delete a record of the model
	 *
	 * @param $id
	 * @return mixed
	 */
	public function delete($id);

	/**
	 * Store a new instance of the model
	 *
	 * @param $data
	 * @return mixed
	 */
	public function store($data);

	/**
	 * Update a record of a model
	 *
	 * @param $data
	 * @return mixed
	 */
	public function update($data);
	
	/**
	 * Update players_active column on games table
	 *
	 * @param $data
	 * @return mixed
	 */
	public function updateActivePlayers($data);

	/**
	 * Update game_started column on games table
	 *
	 * @param $data
	 * @return mixed
	 */
	public function updateGameStarted($data);
}