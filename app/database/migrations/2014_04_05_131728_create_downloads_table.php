<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDownloadsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('downloads', function($table)
		{
			$table->increments('id');
			$table->string('caption');
			$table->string('url');
			$table->enum('type', array('Syllabus', 'Student List', 'Teacher List', 'Stuff List', 'Other'));
			$table->longtext('details');
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
		Schema::drop('downloads');
	}

}
