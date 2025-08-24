<?php

namespace App\Traits;

use Carbon\Carbon;

trait createCookie
{
	/**
	 * Create a session cookie
	 *
	 * @return \Symfony\Component\HttpFoundation\Cookie
	 */
	public function gotchaCookie()
	{
		$dateTime = Carbon::now();

		$cookie = cookie('gotcha', Auth()->user()->username, $dateTime->toCookieString());

		return $cookie;
	}
}