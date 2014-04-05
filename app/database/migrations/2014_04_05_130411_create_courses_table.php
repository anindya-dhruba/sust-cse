<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('courses', function($table)
		{
			$table->increments('id');
			$table->string('course_no', 20);
			$table->string('title');
			$table->string('credit', 1);
			$table->integer('prerequisite')->unsigned()->nullable();
			$table->enum('type', array('Major', 'Minor'));
			$table->enum('semester', array('1/1', '1/2', '2/1', '2/2', '3/1', '3/2', '4/1', '4/2'));
			$table->longtext('details');
			$table->timestamps();

			$table->foreign('prerequisite')
					->references('id')->on('courses')
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
		Schema::drop('courses');
	}

}
