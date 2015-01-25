<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUloginsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ulogins', function($table)
		{
		    // первичный ключ с автоинкрементом
		    $table->increments('id')->nullable();
			$table->integer('user_id');

                        $table->string('first_name',255);
                        $table->string('last_name',255);
                        $table->string('email',255);
                        $table->string('nickname',255);
                        $table->string('bdate',255);
                        $table->integer('sex');
                        $table->string('phone',255);
                        $table->text('photo');
                        $table->text('photo_big');
                        $table->string('city',255);
                        $table->string('country',255);
                        $table->string('network',255);
                        $table->string('profile',255);
                        $table->string('uid',255);
                        $table->string('identity',255)->unique();;
                        $table->string('manual',255);
                        $table->integer('verified_email');

                        $table->boolean('active')->nullable();
                        
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
		Schema::drop('ulogins');
	}

}
