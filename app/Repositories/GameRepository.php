<?php

namespace App\Repositories;

use App\Game;
use App\Invitation;
use App\Role;
use App\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class GameRepository implements GameRepositoryInterface
{
	/**
	 * Retrieve all records of a model
	 *
	 * @return mixed
	 */
	public function getAll()
	{
		return Game::all();
	}

	/**
	 * Retrieve single record of a model by id
	 *
	 * @param $id
	 *
	 * @return mixed
	 */
	public function find($id)
	{
		return Game::findOrFail($id);
	}

	/**
	 * Retrieve all users associated with a game
	 * Exclude Admin user for prototype
	 *
	 * @param $id
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|mixed|static[]
	 */
	public function participants($id)
	{
		$game = Game::find($id);

		return $game->users()->whereNotIn('user_id', [1])->get();
	}

	/**
	 * Retrieve all users assigned as game master
	 *
	 * @return mixed
	 */
	public function getGameMasters()
	{
		$games = Game::all();

		$gameMasterIDs = $games->pluck('game_master_id')->toArray();

		$gameMasters = User::with('games')
			->whereIn('id', $gameMasterIDs)
			->get();

		return $gameMasters->toArray();
	}

	/**
	 * Check if user is a game master
	 *
	 * @return boolean
	 */
	public function isGameMaster()
	{
		$games = Game::all();

		foreach ($games as $game) {
			foreach ($game->users as $user) {
				if ($game->game_master_id == $user->id) {
					return true;
				}
			}
		}

		return false;
	}

	/**
	 * Retrieve all active game records
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|static[]
	 */
	public function activeGames()
	{
		$user = User::find(Auth::user()->id);

		$games = $user->games->where('game_started', '=', true)
			->where('game_completed', '=', false)
			->all();

		if ($games) return collect($games);

		return collect([]);
	}

	/**
	 * Check if game is active
	 *
	 * @param $id
	 * @return boolean
	 */
	public function isActive($id)
	{
		$currentGame = Game::where([
			'id' => $id,
			'game_started' =>true,
			'game_completed' => false,
		])->first();

		if ($currentGame != null) return true;

		return false;
	}

	/**
	 * Retrieve all completed game records
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|static[]
	 */
	public function completedGames()
	{
		$games = Game::where('game_completed', '=', true)->get();

		if ($games) return collect($games);

		return collect([]);
	}

	/**
	 * Check if game is completed
	 *
	 * @param $id
	 * @return boolean
	 */
	public function isCompleted($id)
	{
		$completedGames = $this->completedGames();

		$currentGame = Game::where([
			'id' => $id,
			'game_completed' => true,
		])->first();

		foreach($completedGames as $game)
		{
			if ($game->id == $currentGame->id) return true;
		}

		return false;
	}

	/**
	 * Retrieve all deleted game records
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|static[]
	 */
	public function deletedGames()
	{
		$games = Game::onlyTrashed()->get();

		if ($games) return collect($games);

		return collect([]);
	}

	/**
	 * Retrieve all inactive games with no player relationship
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|static[]
	 */
	public function inactiveGames()
	{
		$games = Game::whereHas('invitations', function($query) {
			$query->where('accepted', '=', false);
		})
			->where('game_started', '=', false)
			->where('game_completed', '=', false)
			->get();

		if ( !empty($games) ) return collect($games);

		return collect([]);
	}

	/**
	 * Retrieve all inactive games with a player relationship
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|static[]
	 */
	public function joinedGames()
	{
		$user = User::find(Auth::user()->id);

		$games = $user->games->where('game_started', '=', false)
			->where('game_completed', '=', false)
			->all();

		if ($games) return collect($games);

		return collect([]);
	}

	/**
	 * Check if a game can be joined by a user
	 * from an invitation
	 *
	 * @param $token
	 * @param $email
	 *
	 * @return bool
	 */
	public function canJoin($token, $email)
	{
		$invitation = Invitation::where('email', $email)
			->where('token', $token)
			->first();

		if ($invitation->accepted == false) {
			return true;
		}

		return false;
	}

	/**
	 * Check if a game has been joined by a user
	 *
	 * @param $id
	 * @return bool
	 */
	public function hasJoined($id)
	{
		$user = User::find(Auth::user()->id);

		return $user->games()->where('user_id', $user->id)
			->where('game_id', $id)
			->exists();
	}

	/**
	 * Retrieve all games ready to be started
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|static[]
	 */
	public function startGames()
	{
		$games = Game::where([
				'game_started' => false,
				'game_completed' => false,
			])
			->whereColumn('players_active', '=','player_count_max')
			->get();

		if ($games) return collect($games);

		return collect([]);
	}

	/**
	 * Retrieve the number of active players for a given record
	 *
	 * @param $id
	 * @return mixed
	 */
	public function numberOfActivePlayers($id)
	{
		return Game::where('id', $id)
			->pluck('players_active')
			->toArray();
	}
	
	/**
	 * Retrieve the number of players related to a given record
	 * Exclude Admin user for prototype
	 *
	 * @param $id
	 *
	 * @return mixed
	 */
	public function getGameUsersCount($id)
	{
		$game = Game::find($id);

		return $game->users()->whereNotIn('user_id', [1])->count();
	}

	/**
	 * Calculate the number of players outstanding for a given record
	 *
	 * @param $id
	 * @return mixed
	 */
	public function numberOfPlayersOutstanding($id)
	{
		$activePlayers = $this->numberOfActivePlayers($id);

		$maxPlayers = Game::where('id', $id)
			->pluck('player_count_max')
			->toArray();

		$activePlayers = implode('', $activePlayers);
		$maxPlayers = implode('', $maxPlayers);

		$playersOutstanding = $maxPlayers - $activePlayers;

		return $playersOutstanding;
	}

	/**
	 * Check if a game record has reached max players
	 *
	 * @param $id
	 * @return boolean
	 */
	public function hasMaxPlayers($id)
	{
		$playersOutstanding = $this->numberOfPlayersOutstanding($id);

		if ($playersOutstanding == 0) return true;

		return false;
	}

	/**
	 * Retrieve the number of invitations related to a game
	 *
	 * @param $id
	 * @return int
	 */
	public function countInvitations($id)
	{
		$game = $this->find($id);

		return $game->invitations()->count('invitation_id');
	}

	/**
	 * Delete a record of the model
	 *
	 * @param $id
	 * @return mixed
	 */
	public function delete($id)
	{
		$game = $this->find($id);

		return $game->delete();
	}

	/**
	 * Store a new instance of the model
	 *
	 * @param $data
	 * @return mixed
	 */
	public function store($data)
	{
		return Game::create([
			'game_master_id' => $data['game_master_id'],
			'name' => $data['name'],
			'players_active' => $data['players_active'],
			'player_count_max' => $data['player_count_max'],
			'game_started' => $data['game_started'],
			'game_completed' => $data['game_completed'],
			'length' => $data['length'],
			'uuid' => $data['uuid']
		]);
	}

	/**
	 * Update a record of a model
	 *
	 * @param $data
	 * @return mixed
	 */
	public function update($data)
	{
		return Game::where('id', $data['game_id'])
			->update([
				'game_master_id' => $data['game_master_id'],
				'name' => $data['name'],
				'length' => $data['length'],
				'players_active' => $data['players_active'],
				'player_count_max' => $data['player_count_max'],
				'game_started' => $data['game_started'],
				'game_completed' => $data['game_completed'],
			]);
	}

	/**
	 * Update players_active column on games table
	 *
	 * @param $data
	 *
	 * @return mixed
	 */
	public function updateActivePlayers($data)
	{
		return Game::where('id', $data['game_id'])
			->update([
				'players_active' => $data['players_active']
			]);
	}

	/**
	 * Update game_started column on games table
	 *
	 * @param $data
	 *
	 * @return mixed
	 */
	public function updateGameStarted($data)
	{
		return Game::where('id', $data['game_id'])
			->update([
				'game_started' => $data['game_started']
			]);
	}
}