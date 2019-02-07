<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_values', function (Blueprint $table) {
            $table->integer('article')->unsigned();
            $table->integer('attribute')->unsigned();
            $table->integer('value')->unsigned();
            $table->timestamps();
            $table->primary(['article', 'attribute', 'value']);
            $table->foreign('article')
                ->references('id')
                ->on('articles')
                ->onDelete('cascade')
                ->nullable();
            $table->foreign('attribute')
                ->references('id')
                ->on('attributes')
                ->onDelete('cascade')
                ->nullable();
            $table->foreign('value')
                ->references('id')
                ->on('attribute_values')
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
        Schema::dropIfExists('article_values');
    }
}
