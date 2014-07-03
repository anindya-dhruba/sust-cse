<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('menus', function($table)
		{
			$table->increments('id');
			$table->integer('page_id')->unsigned()->nullable();
			$table->string('page_icon')->default('fa-th-large');
			$table->enum('page_location', array('top', 'side'));
			$table->integer('parent_id');
			$table->integer('order');

			$table->foreign('page_id')
					->references('id')->on('pages')
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
		Schema::drop('menus');
	}

}
