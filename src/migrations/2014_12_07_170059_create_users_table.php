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
		    // первичный ключ с автоинкрементом
		    $table->increments('id');
		    
		    $table->string('name',255);
		    $table->string('lastname',255);
		    $table->string('surname',255);

		    $table->string('email',255)->unique();

		    $table->string('password',255);

		    $table->boolean('active');

		    $table->timestamps();		    
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
