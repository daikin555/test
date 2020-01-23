<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
	public function up()
	{
		Schema::create('items', function (Blueprint $table) {
			$table->increments('id');
			$table->text('item_name');
			$table->text('item_desc');
			$table->integer('item_price');
			$table->string('item_stock');
			$table->dateTime('item_created');
			$table->dateTime('item_modified');
			$table->softDeletes('item_delete');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('admins');
	}
}
