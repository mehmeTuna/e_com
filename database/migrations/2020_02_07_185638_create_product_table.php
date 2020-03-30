<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->float('price', 4, 2);
            $table->longText('features')->nullable();
            $table->longText('description')->nullable();
            $table->bigInteger('numberOfProduct')->nullable()->default(1000);
            $table->bigInteger('categoryId');
            $table->boolean('active')->nullable()->default(1);
            $table->char('name', 250);
            $table->longText('card_text')->nullable();
            $table->longText('img')->nullable();
            $table->longText('images')->nullable();
            $table->longText('stores')->nullable();
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
        Schema::dropIfExists('product');
    }
}
