<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('events', function($table)
		{
			$table->increments('id');
			$table->string('title');
			$table->string('url');
			$table->boolean('is_public');
			$table->longtext('event');
			$table->date('start_date');
			$table->date('end_date');
			$table->integer('user_id')->unsigned();
			$table->timestamps();

			$table->foreign('user_id')
					->references('id')->on('users')
					->onUpdate('cascade')
					->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('events');
	}

}
