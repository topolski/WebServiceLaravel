<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSefoviTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sefovi', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('naziv');
			$table->text('opis')->nullable();
			$table->string('cena');
            $table->string('mimeType');
			$table->integer('idKategorija');
			$table->string('boja')->nullable();
			$table->string('brava')->nullable();
			$table->string('ubrava')->nullable();
			$table->string('zabravljivanje')->nullable();
			$table->string('tip')->nullable();
			$table->string('sv');
			$table->string('ss');
			$table->string('sd');
			$table->string('uv')->nullable();
			$table->string('us')->nullable();
			$table->string('ud')->nullable();
			$table->string('police')->nullable();
			$table->string('tezina');
			$table->string('zapremina')->nullable();
			$table->timestamps();
		});

        DB::statement("ALTER TABLE sefovi ADD slika MEDIUMBLOB NOT NULL");
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sefovi');
	}

}
