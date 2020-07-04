<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttrsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('attrs', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('slug');
			$table->string('value');
			$table->tinyInteger('status')->default(1)->comment('1 là Hiện, 0 là Ẩn');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('attrs');
	}
}
