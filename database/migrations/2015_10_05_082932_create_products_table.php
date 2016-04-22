<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up()
    {
        Schema::create('products', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('sku')->unique();
            $table->bigInteger('price')->nullable();
            $table->string('unit_of_measure')->nullable();
            $table->text('content')->nullable();
            $table->text('attr')->nullable();
            $table->text('cats')->nullable();
            $table->string('images')->nullable();
            $table->string('price_currency')->default('RUR');
            $table->timestamp('published_at')->nullable();
            $table->boolean('published')->default(false);
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
		Schema::drop('products');
	}

}
