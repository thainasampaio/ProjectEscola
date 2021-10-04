<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCadTurmasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cad_turmas', function (Blueprint $table) {
            $table->id();
            $table->date('ano');
            $table->boolean('nivel'); //0 = fundamental, 1 = médio
            $table->integer('serie'); //1-9
            $table->unsignedInteger('turno'); //1 = manha, 2 = tarde, 3 = noite
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
        Schema::dropIfExists('cad_turmas');
    }
}
