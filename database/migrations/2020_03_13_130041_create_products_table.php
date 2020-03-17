<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->integer('category_id')->unsigned(10);
            $table->integer('brand_id')->unsigned(10);
            $table->text('desc');
            $table->text('content');
            $table->integer('price');
            $table->string('image');
            $table->tinyInteger('hot')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->foreign('category_id')->references('id')
                    ->on('categories')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')
                    ->on('brands')->onDelete('cascade');
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
        Schema::dropIfExists('products');
    }
}
