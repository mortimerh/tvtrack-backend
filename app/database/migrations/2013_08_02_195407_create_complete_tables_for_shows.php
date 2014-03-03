<?php

use Illuminate\Database\Migrations\Migration;

class CreateCompleteTablesForShows extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shows', function($table){
			$table->increments('id');
			$table->string('name');
			$table->integer('tvdb_id')->nullable()->unsigned()->unique();
			$table->integer('tvrage_id')->nullable()->unsigned()->unique();
		});
		Schema::create('show_meta', function($table){
			$table->integer('show_id')->unsigned()->unique();
			$table->foreign('show_id')->references('id')->on('shows');
			$table->string('status');
			$table->date('start_date');
			$table->date('end_date');
			$table->string('origin_country');
			$table->integer('runtime')->unsigned();
		});
		Schema::create('episodes', function($table){
			$table->increments('id');
			$table->integer('show_id')->unsigned();
			$table->foreign('show_id')->references('id')->on('shows');
			$table->integer('episode_no')->unsigned();
			$table->integer('season_no')->unsigned();
			$table->string('name');
			$table->date('airdate');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('show_meta');
		Schema::dropIfExists('episodes');
		Schema::dropIfExists('shows');
	}

}