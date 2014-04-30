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
			$table->string('designation');
			$table->string('office_phone', 20);
			$table->string('mobile', 20);
			$table->text('present_address');
			$table->text('permanent_address');
			$table->longtext('academic_background');
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
