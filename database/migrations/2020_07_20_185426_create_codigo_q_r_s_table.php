<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCodigoQRSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codigo_q_r_s', function (Blueprint $table) {
            $table->id();
            $table->string('nome_token');
            $table->foreignId('iduser')->constrained('users');
            $table->string('dato');
            $table->string('estado');
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
        Schema::dropIfExists('codigo_q_r_s');
    }
}
