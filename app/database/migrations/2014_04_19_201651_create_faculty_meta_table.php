<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacultyMetaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('faculty_meta', function($table)
		{
			$table->increments('id');
			$table->longtext('type', array('Publication', 'Journal Papers', 'Conference Papers'));
			$table->longtext('details');
			$table->integer('user_id')->unsigned();
			$table->integer('reaseach_area_id')->unsigned();
			$table->timestamps();

			$table->foreign('user_id')
						->references('id')->on('users')
						->onUpdate('cascade')
						->onDelete('cascade');
			$table->foreign('reaseach_area_id')
						->references('id')->on('research_areas')
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
		Schema::drop('faculty_meta');
	}

}
