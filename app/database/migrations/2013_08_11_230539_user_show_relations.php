<?php

use Illuminate\Database\Migrations\Migration;

class UserShowRelations extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users_has_shows', function($table){
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');
			$table->integer('show_id')->unsigned();
			$table->foreign('show_id')->references('id')->on('shows');
			$table->timestamps();
		});
		Schema::create('users_has_episodes', function($table){
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');
			$table->integer('episode_id')->unsigned();
			$table->foreign('episode_id')->references('id')->on('episodes');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('users_has_shows');
		Schema::dropIfExists('users_has_episodes');
	}

}