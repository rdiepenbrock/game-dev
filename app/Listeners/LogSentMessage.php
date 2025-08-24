<?php

namespace App\Listeners;

use Illuminate\Mail\Events\MessageSending;

class LogSentMessage
{
	/**
	 * LogSentMessage constructor.
	 *
	 * @return void
	 */
	public function __construct()
	{

	}

	/**
	 * Handle the event
	 *
	 * @param \Illuminate\Mail\Events\MessageSending $event
	 */
	public function handle(MessageSending $event)
	{

	}
}