<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('roles', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 20);
			$table->boolean('adminMenu')->default(0);
			$table->boolean('news')->default(0);
			$table->boolean('events')->default(0);
			$table->boolean('pages')->default(0);
			$table->boolean('faculty')->default(0);
			$table->boolean('students')->default(0);
			$table->boolean('staff')->default(0);
			$table->boolean('menus')->default(0);
			$table->boolean('batches')->default(0);
			$table->boolean('albums')->default(0);
			$table->boolean('pictures')->default(0);
			$table->boolean('sliders')->default(0);
			$table->boolean('courses')->default(0);
			$table->boolean('faqs')->default(0);
			$table->boolean('researches')->default(0);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('roles');
	}

}
