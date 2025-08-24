<?php

namespace App\Events;

use App\Game;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UsersShuffled
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

	/**
	 * New instance of the game model
	 *
	 * @var Game
	 */
	public $game;

	/**
	 * UsersShuffled constructor
	 *
	 * @param Game $game
	 * @param $seed
	 */
	public function __construct(Game $game, $seed)
	{
		$this->game = $game;
		$this->seed = $seed;
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
