<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StripesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('stripes', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('cart_id');
			$table->string('delivery');
			$table->integer('amount');
			$table->string('payment_code');
			$table->timestamps();
			$table->softDeletes('deleted_at');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		//
	}
}
