<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeputadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deputados', function (Blueprint $table) {
            $table->integer('id')->unique();
            $table->string('name'); 
            $table->integer('gasto_mensal')->nullable();           
             
            
            $table->timestamps(); 

            $table->foreign('gasto_mensal')->references('id')
            ->on('reembolso_indenisacaos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deputados');
    }
}
