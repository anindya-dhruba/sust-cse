<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacultyResearchTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('faculty_research', function($table)
		{
			$table->integer('user_id')->unsigned();
			$table->integer('research_id')->unsigned();

			$table->foreign('user_id')
						->references('id')->on('users')
						->onUpdate('cascade')
						->onDelete('cascade');
			$table->foreign('research_id')
						->references('id')->on('researches')
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
		Schema::drop('faculty_research');
	}

}
