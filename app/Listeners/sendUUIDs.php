<?php

namespace App\Listeners;

use GuzzleHttp\Client;

class sendUUIDs
{
	/**
	 * Handle the game created event.
	 *
	 * @param $event
	 *
	 * @return string
	 */
    public function gameCreated($event)
	{
    	$gameUUID = $event->game->uuid;

    	$client = new Client();
		$client->post('http://gotcha-engine:8080/command', [
    		'json' => [
				'_Case' => 'CreateContest',
				'Item' => $gameUUID
			]
		]);
	}
	
	/**
	 * Handle the game started event.
	 *
	 * @param  Event  $event
	 *
	 * @return string
	 */
	public function gameStarted($event)
	{
		$gameUUID = $event->game->uuid;

		$client = new Client();
		$client->post('http://gotcha-engine:8080/command', [
			'json' => [
				'_Case' => 'Start',
				'Item' => $gameUUID
			]
		]);
	}

	/**
	 * Handle the user added event
	 *
	 * @param $event
	 *
	 * @return string
	 */
	public function userAdded($event)
	{
		$gameUUID = $event->game->uuid;
		$userUUID = $event->userUUID;

		$client = new Client();
		$client->post('http://gotcha-engine:8080/command', [
			'json' => [
				'_Case' => 'AddPlayer',
				'Item' => [
					'ContestId' => $gameUUID,
					'Player' => $userUUID,
				]
			]
		]);
	}
	
	/**
	 * Handle the user captured event.
	 *
	 * @param $event
	 *
	 * @return string
	 */
	public function userCaptured($event)
	{
		$gameUUID = $event->game->uuid;
		$hunterUUID = $event->userUUID->toArray();
		$targetUUID = $event->taget->userUUID;

		$client = new Client();
		$client->post('http://gotcha-engine:8080/command', [
			'json' => [
				'_Case' => 'Capture',
				'Item' => [
					'ContestId' => $gameUUID,
					'Hunter' => $hunterUUID,
					'Target' => $targetUUID,
				]
			]
		]);
	}
	
	/**
	 * Handle the user dropped event.
	 *
	 * @param $event
	 *
	 * @return string
	 */
	public function userDropped($event)
	{
		$gameUUID = $event->game->uuid;
		$userUUID = $event->userUUID->toArray();

		$client = new Client();
		$client->post('http://gotcha-engine:8080/command', [
			'json' => [
				'_Case' => 'DropPlayer',
				'Item' => [
					'ContestId' => $gameUUID,
					'Player' => $userUUID,
				]
			]
		]);
	}
	
	/**
	 * Handle the users shuffled event.
	 *
	 * @param $event
	 *
	 */
	public function usersShuffled($event)
	{
		$gameUUID = $event->game->uuid;
		$seed = $event->seed;

		$client = new Client();
		$client->post('http://gotcha-engine:8080/command', [
			'json' => [
				'_Case' => 'Shuffle',
				'Item' => [
					'ContestId' => $gameUUID,
					'Seed' => $seed,
				]
			]
		]);
	}
	
	/**
	 * Register the listeners for the subscriber
	 *
	 * @param $events
	 */
    public function subscribe($events)
	{
		$events->listen(
			'App\Events\GameCreated',
			'App\Listeners\sendUUIDs@gameCreated'
		);
		
		$events->listen(
			'App\Events\GameStarted',
			'App\Listeners\sendUUIDs@gameStarted'
		);
		
		$events->listen(
			'App\Events\UserAdded',
			'App\Listeners\sendUUIDs@userAdded'
		);
		
		$events->listen(
			'App\Events\UserCaptured',
			'App\Listeners\sendUUIDs@userCaptured'
		);
		
		$events->listen(
			'App\Events\UserDropped',
			'App\Listeners\sendUUIDs@userDropped'
		);
		
		$events->listen(
			'App\Events\UsersShuffled',
			'App\Listeners\sendUUIDs@usersShuffled'
		);
	}
}
