<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRedeSocialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rede_socials', function (Blueprint $table) {
            $table->integer('id')->unique();
            $table->string('nome');
            $table->string('url');
            $table->integer('deputado_id');

            $table->timestamps();
             
            $table->foreign('deputado_id')->references('id')
            ->on('deputados')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rede_socials');
    }
}
