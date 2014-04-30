<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacultyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('faculty', function($table)
		{
			$table->integer('user_id')->unsigned();
			$table->string('designation');
			$table->string('alt_email');
			$table->string('phone', 20);
			$table->string('mobile', 20);
			$table->string('contact_room', 50);
			$table->longtext('academic_background');
			$table->longtext('prof_exp');
			$table->longtext('awards_and_honors');
			$table->text('interests');
			$table->string('website', 20);
			$table->text('present_address');
			$table->text('permanent_address');
			$table->longtext('about');
			
			$table->enum('status', array('Current', 'On Leave', 'Not Available'));
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
		Schema::drop('faculty');
	}

}
