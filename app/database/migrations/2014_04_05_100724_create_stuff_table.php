<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStuffTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('stuff', function($table)
		{
			$table->integer('user_id')->unsigned();
			$table->string('designation', 40);
			$table->string('mobile', 20);
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
		Schema::drop('stuff');
	}

}
