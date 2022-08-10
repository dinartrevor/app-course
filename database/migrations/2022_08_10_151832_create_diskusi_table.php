<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiskusiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diskusi', function (Blueprint $table) {
            $table->id();
            $table->integer("idSiswa")->nullable();
            $table->integer("idMentor")->nullable();
            $table->integer("idCourse")->nullable();
            $table->string("dataPertanyaan")->nullable();
            $table->string("dataJawaban")->nullable();
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
        Schema::dropIfExists('diskusi');
    }
}
