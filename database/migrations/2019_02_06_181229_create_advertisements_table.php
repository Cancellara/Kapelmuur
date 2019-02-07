<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->increments('id');
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->integer('shop')->unsigned();
            $table->integer('category')->unsigned();
            $table->timestamps();
            $table->foreign('category')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade')
                ->nullable();
            $table->foreign('shop')
                ->references('id')
                ->on('shops')
                ->onDelete('cascade')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertisements');
    }
}
