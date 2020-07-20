<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarioTipoUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario_tipo_usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nome_token');
            $table->foreignId('idtipousuario')->constrained('tipo_usuarios');;
            $table->foreignId('idusuario')->constrained('users');;
            $table->string('estado_del')->default('1');
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
        Schema::dropIfExists('usuario_tipo_usuarios');
    }
}
