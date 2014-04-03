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
			$table->increments('id', 11);
			$table->string('reg', 15);
			$table->string('fullName', 40);
			$table->string('nickName', 20);
			$table->string('fatherName', 40);
			$table->string('motherName', 40);
			$table->string('email', 50);
			$table->string('password');
			$table->enum('gender', array('male', 'female'));
			$table->string('religion', 20);
			$table->string('nationality', 20);
			$table->date('dateOfBirth');
			$table->string('placeOfBirth');
			$table->enum('maritalStatus', array('single', 'married', 'divorced'));
			$table->enum('bloodGroup', array('A', 'B', 'AB', 'O'));
			$table->enum('bloodType', array('+ve', '-ve'));
			$table->text('homeAddress');
			$table->text('bio');
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
