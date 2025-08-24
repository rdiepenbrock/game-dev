<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameInvitationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_invitation', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('invitation_id')->unsigned();
			$table->integer('game_id')->unsigned();

			$table->foreign('invitation_id')
				->references('id')
				->on('invitations');

			$table->foreign('game_id')
				->references('id')
				->on('games');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('game_invitation', function(Blueprint $table) {
			$table->dropForeign(['invitation_id', 'game_id']);
		});

		Schema::dropIfExists('game_invitation');
    }
}
