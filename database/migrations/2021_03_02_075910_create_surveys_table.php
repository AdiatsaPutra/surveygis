<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->string('lattitude');
            $table->string('longtitude');
            $table->string('namalokasi');
            $table->string('kategori');
            $table->string('rt');
            $table->string('rw');
            $table->string('kelurahan');
            $table->string('kecamatan');
            $table->string('pic1');
            $table->string('pic2');
            $table->string('telp1');
            $table->string('telp2');
            $table->string('namasurveyor');
            $table->string('tanggal');
            $table->string('fotolokasi1');
            $table->string('fotolokasi2');
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
        Schema::dropIfExists('surveys');
    }
}
