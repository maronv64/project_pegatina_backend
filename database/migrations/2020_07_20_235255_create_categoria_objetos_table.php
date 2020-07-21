<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriaObjetosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categoria_objetos', function (Blueprint $table) {
            $table->id();
            $table->string('nome_token');
            $table->foreignId('idcategoria')->constrained('categorias');
            $table->foreignId('idobjeto')->constrained('objetos');
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
        Schema::dropIfExists('categoria_objetos');
    }
}
