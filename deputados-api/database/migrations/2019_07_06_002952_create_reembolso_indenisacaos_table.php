<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReembolsoIndenisacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reembolso_indenisacaos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('mes');
            $table->float('total_reembolsado', 8, 2);          

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
        Schema::dropIfExists('reembolso_indenisacaos');
    }
}
