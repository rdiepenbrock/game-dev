<?php

namespace App\Traits;

use App\Game;
use App\User;
use App\UserAttribute;
use GuzzleHttp\Client;

trait GameMechanics
{
	public function contestEvents($game_id)
	{
		//http://host/<contestId>/events
	}

	public function playerEvents($gameUUID, $userUUID)
	{
		//http://host/<contestId>/events/<player>

		$client = new Client(['base_uri' => 'http://engine:8080/']);
		$request = $client->request('GET', $gameUUID.'/eventsFor/'.$userUUID);
		$responses = json_decode($request->getBody()->getContents(), true);

		foreach($responses as $response)
		{
			$data = base64_decode($response["Event"]["Data"], true);
			$data = json_decode($data);

			foreach($data->Item as $key => $value)
			{
				switch ($key) {
					case "ContestId":
						$contestId = $value;
						break;
					case "Hunter":
						$hunterId = $value;
						break;
					case "Target":
						$targetId = $value;
						break;
				}
			}

			$contest = Game::where('uuid', $contestId)->first();
			$hunterAttributes = UserAttribute::where('uuid', $hunterId)->first();
			$targetAttributes = UserAttribute::where('uuid', $targetId)->first();
			$hunterUsername = $hunterAttributes->user()->pluck('username')->first();
			$targetUsername = $targetAttributes->user()->pluck('username')->first();

			$data = [
				'contest' => $contest,
				'hunterAttributes' => $hunterAttributes,
				'targetAttributes' => $targetAttributes,
				'hunterUsername' => $hunterUsername,
				'targetUsername' => $targetUsername
			];

			return $data;
		}
	}
}