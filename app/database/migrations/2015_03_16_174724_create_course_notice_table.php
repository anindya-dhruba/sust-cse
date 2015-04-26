<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseNoticeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('course_notice', function(Blueprint $table)
		{
			$table->increments('id')->index();
			$table->integer('course_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->string('title');
			$table->string('url');
			$table->longtext('notice');
			$table->timestamps();

			$table->foreign('course_id')
				->references('id')->on('courses')
				->onUpdate('cascade')
				->onDelete('cascade');

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
		Schema::drop('course_notice');
	}

}
