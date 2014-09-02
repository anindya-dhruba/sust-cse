<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table)
		{
			$table->increments('id');
			$table->string('full_name', 40);
			$table->string('nick_name', 20)->nullable();
			$table->integer('role_id')->unsigned();
			$table->string('email', 40);
			$table->string('password');
			$table->string('reg', 15)->nullable();
			$table->string('fathers_name', 40)->nullable();
			$table->string('mothers_name', 40)->nullable();
			$table->integer('batch_id')->unsigned()->nullable();
			$table->enum('gender', ['Male', 'Female'])->nullable();
			$table->string('phone', 20)->nullable();
			$table->string('mobile', 20)->nullable();
			$table->string('alt_email')->nullable();
			$table->string('website', 100)->nullable();
			$table->string('religion', 20)->nullable();
			$table->string('nationality', 30)->nullable();
			$table->date('date_of_birth')->nullable();
			$table->string('place_of_birth')->nullable();
			$table->enum('marital_status', ['Single', 'Married', 'Divorced'])->default('Single')->nullable();
			$table->enum('blood_group', ['A', 'B', 'AB', 'O'])->nullable();
			$table->enum('blood_type', ['+ve', '-ve'])->nullable();
			$table->string('current_employment')->nullable();
			$table->text('employment_history')->nullable();
			$table->text('present_address')->nullable();
			$table->text('permanent_address')->nullable();
			$table->longtext('about')->nullable();
			$table->string('designation')->nullable();
			$table->string('tagname')->nullable();
			$table->string('contact_room', 50)->nullable();
			$table->longtext('academic_background')->nullable();
			$table->longtext('prof_exp')->nullable();
			$table->longtext('awards_and_honors')->nullable();
			$table->text('interests')->nullable();
			$table->enum('status', ['Current', 'On Leave', 'Not Available'])->nullable();
			$table->longtext('publications')->nullable();
			$table->longtext('journal_papers')->nullable();
			$table->longtext('conference_papers')->nullable();
			$table->string('remember_token');
			$table->timestamps();

			$table->foreign('role_id')
					->references('id')->on('roles')
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
		Schema::drop('users');
	}

}