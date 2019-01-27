<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('cif');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string("activation_code")->nullable();
            $table->boolean('active');
            $table->integer('shop_type')->unsigned()->default(1);
            $table->rememberToken();
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
        Schema::dropIfExists('shops');
    }
}
