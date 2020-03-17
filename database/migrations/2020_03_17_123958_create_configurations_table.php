<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configurations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->default('admin');
            $table->string('password')->default(md5('admin'));
            $table->string('text')->nullable();;
            $table->string('address')->nullable();;
            $table->text('map_address')->nullable();;
            $table->string('phone')->nullable();;
            $table->string('email')->nullable();;
            $table->string('facebook')->nullable();;
            $table->string('description')->nullable();
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
        Schema::dropIfExists('configurations');
    }
}
