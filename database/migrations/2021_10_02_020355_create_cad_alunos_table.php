<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCadAlunosTable extends Migration
{
    public function up()
    {
        Schema::create('cad_alunos', function (Blueprint $table) {
            $table->id();
            $table->string('nome',55);
            $table->string('telefone',55)->nullable();
            $table->string('email',80)->default('none@nonevalue.none');
            $table->date('data_nascimento',10)->default("1999-01-01");
            $table->string('genero',9)->default("Masculino");
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('cad_alunos');
    }
}
