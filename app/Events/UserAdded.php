<?php

namespace App\Events;

use App\Game;
use App\User;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserAdded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

	/**
	 * New instance of the game model
	 *
	 * @var Game
	 */
    public $game;

    /**
	 * New instance of the user model
	 *
	 * @var User
	 */
	public $user;
	
	/**
	 * UserAdded constructor
	 *
	 * @param Game $game
	 * @param User $user
	 * @param $userUUID
	 */
	public function __construct(Game $game, User $user, $userUUID)
	{
		$this->game = $game;
		$this->user = $user;
		$this->userUUID = $userUUID;
	}

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
