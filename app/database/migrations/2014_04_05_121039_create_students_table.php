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
			$table->enum('gender', array('Male', 'Female'))->nullable();
			$table->string('religion', 20);
			$table->string('nationality', 30)->default('Bangladeshi');
			$table->date('date_of_birth')->nullable();
			$table->string('place_of_birth');
			$table->enum('marital_status', array('Single', 'Married', 'Divorced'))->default('Single');
			$table->enum('blood_group', array('A', 'B', 'O'))->nullable();
			$table->enum('blood_type', array('+ve', '-ve'))->nullable();
			$table->text('home_address');
			$table->longtext('bio');
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
