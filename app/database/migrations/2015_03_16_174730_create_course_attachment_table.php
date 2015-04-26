<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseAttachmentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('course_attachment', function(Blueprint $table)
		{
			$table->increments('id')->index();
			$table->integer('course_notice_id')->unsigned();
			$table->string('file_name');
			$table->string('file_url');
			$table->timestamps();

			$table->foreign('course_notice_id')
				->references('id')->on('course_notice')
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
		Schema::drop('course_attachment');
	}

}
