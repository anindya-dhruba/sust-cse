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
			$table->string('nick_name', 20);
			$table->string('email', 40);
			$table->string('password');
			$table->integer('role_id')->unsigned();
			$table->timestamps();

			$table->foreign('role_id')
					->references('id')->on('roles')
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