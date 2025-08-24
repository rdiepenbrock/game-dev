<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('game_id')->unsigned();
            $table->integer('user_id')->unsigned();

			$table->foreign('game_id')
				->references('id')
				->on('games');

			$table->foreign('user_id')
				->references('id')
				->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('game_user', function(Blueprint $table) {
			$table->dropForeign(['game_id', 'user_id']);
		});

        Schema::dropIfExists('game_player');
    }
}
