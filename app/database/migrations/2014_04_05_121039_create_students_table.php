<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('students', function($table)
		{
			$table->integer('user_id')->unsigned();
			$table->string('reg', 15);
			$table->string('fathers_name', 40);
			$table->string('mothers_name', 40);
			$table->integer('batch_id')->unsigned();
			$table->enum('gender', array('Male', 'Female'));
			$table->string('phone', 20);
			$table->string('mobile', 20);
			$table->string('alt_email');
			$table->string('website', 20);
			$table->string('religion', 20);
			$table->string('nationality', 30);
			$table->date('date_of_birth')->nullable();
			$table->string('place_of_birth');
			$table->enum('marital_status', array('Single', 'Married', 'Divorced'))->default('Single');
			$table->enum('blood_group', array('A', 'B', 'AB', 'O'));
			$table->enum('blood_type', array('+ve', '-ve'));
			$table->string('current_employment');
			$table->text('employment_history');
			$table->text('thesis');
			$table->string('clg_name');
			$table->string('clg_exam_name', 20);
			$table->string('clg_passing_year', 5);
			$table->string('clg_board_name', 10);
			$table->string('clg_result', 10);
			$table->string('scl_name');
			$table->string('scl_exam_name', 20);
			$table->string('scl_passing_year', 5);
			$table->string('scl_board_name', 10);
			$table->string('scl_result', 10);
			$table->text('present_address');
			$table->text('permanent_address');
			$table->longtext('about');
			$table->timestamps();

			$table->foreign('user_id')
					->references('id')->on('users')
					->onUpdate('cascade')
					->onDelete('cascade');
			$table->foreign('batch_id')
					->references('id')->on('batches')
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
		Schema::drop('students');
	}

}
