<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->increments('id');
			$table->uuid('uuid', 36)->unique();
            $table->integer('game_master_id')->unsigned();
            $table->string('name');
            $table->string('length');
			$table->integer('players_active');
            $table->integer('player_count_max');
            $table->boolean('game_started');
            $table->boolean('game_completed');
            $table->timestamps();
            $table->softDeletes();

			$table->foreign('game_master_id')
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
		Schema::table('games', function(Blueprint $table) {
			$table->dropForeign(['game_master_id']);
		});

        Schema::dropIfExists('games');
    }
}
