<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersdataTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('usersdata', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name',100 );
			$table->string('postcode', 7);
			$table->string('prefecture', 255);
			$table->string('city', 255);
			$table->string('block', 255);
			$table->string('phone_number', 20);
			$table->softDeletes('data_delete');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}
}
