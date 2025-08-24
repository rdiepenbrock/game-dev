<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAttributesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_attributes', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->uuid('uuid', 36)->unique();
			$table->string('picture')->nullable();
			$table->timestamps();

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
		Schema::table('user_attributes', function(Blueprint $table) {
			$table->dropForeign(['user_id']);
		});

		Schema::dropIfExists('user_attributes');
	}
}