<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvolutionsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {

		if (!Schema::connection('graphview')->hasTable('evolutions')) {
			Schema::connection('graphview')->create('evolutions', function (Blueprint $table) {

				$table->char('suid', 16)->nullable()->primary();

				$table->char('belongs_to', 16)->nullable()->default(null);
				$table->binary('evolutions')->nullable()->default(null);

				$table->timestamps();

			});
		}
	}

	/**
	 * Reverse the evolutions.
	 *
	 * @return void
	 */
	public function down() {
		Schema::connection('graphview')->dropIfExists('evolutions');
	}
}
