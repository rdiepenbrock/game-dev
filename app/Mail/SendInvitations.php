<?php

namespace App\Mail;

use App\Invitation;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;

class SendInvitations extends Mailable
{
    use Queueable, SerializesModels;

	/**
	 * The invitation instance
	 *
	 * @var \App\Invitation
	 */
    protected $invitation;

	/**
	 * SendInvitations constructor.
	 *
	 * @param \App\Invitation                           $invitation
	 * @param 											$games
	 */
	public function __construct(Invitation $invitation, $games)
	{
		$this->games = $games;
		$this->invitation = $invitation;
	}

	/**
	 * Build the message
	 *
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return \App\Mail\SendInvitations
	 */
    public function build(Request $request)
    {
    	$game_name = $this->games->name;
    	$subject = 'Join ['.$game_name.'] and capture your friends';

    	//dd($request->url());
        return $this->markdown('emails.send_invitations')
			->subject($subject)
			->with([
				'domain' => $request->url(),
				'game' => $this->games,
				'token' => $this->invitation->token
			]);
    }
}
