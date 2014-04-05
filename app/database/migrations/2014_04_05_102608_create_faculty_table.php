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
			$table->string('designation', 40);
			$table->string('contact_email', 40);
			$table->string('contact_mobile', 20);
			$table->string('contact_room', 50);
			$table->longtext('education');
			$table->longtext('prof_exp');
			$table->longtext('honors');
			$table->longtext('research');
			$table->longtext('interests');
			$table->longtext('bio');
			$table->string('cv')->nullable();
			$table->text('home_address');
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
