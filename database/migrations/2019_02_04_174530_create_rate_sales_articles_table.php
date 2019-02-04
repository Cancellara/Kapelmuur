<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRateSalesArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rate_sales_articles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('max_article_value');
            $table->integer('percentage');
            $table->integer('shop_type')->unsigned();
            $table->timestamps();
            $table->foreign('shop_type')
                ->references('id')
                ->on('shop_types')
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
        Schema::dropIfExists('rate_sales_articles');
    }
}
