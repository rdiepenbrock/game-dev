<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('invitations', function (Blueprint $table) {
			$table->increments('id');
			$table->string('token', 16)->unique();
			$table->string('email');
            $table->boolean('accepted')->default(false);
            $table->boolean('declined')->default(false);
			$table->timestamps();
			$table->softDeletes();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::dropIfExists('invitations');
    }
}
