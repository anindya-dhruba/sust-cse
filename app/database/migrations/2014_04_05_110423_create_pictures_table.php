<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePicturesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pictures', function($table)
		{
			$table->increments('id');
			$table->string('caption');
			$table->string('url');
			$table->string('file_url');
			$table->boolean('is_public');
			$table->longtext('details');
			$table->integer('album_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->timestamps();

			$table->foreign('album_id')
					->references('id')->on('albums')
					->onUpdate('cascade')
					->onDelete('cascade');
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
		Schema::drop('pictures');
	}

}
