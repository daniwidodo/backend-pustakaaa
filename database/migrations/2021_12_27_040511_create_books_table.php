<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('isbn');
            $table->string('penulis');
            $table->string('jumlah_halaman');
            $table->string('foto_depan');
            $table->string('foto_belakang');
            $table->string('foto_sisi_atas');
            $table->string('foto_sisi_bawah');
            $table->string('foto_sisi_bukaan');
            $table->string('foto_sisi_punggung');
            $table->enum('penawaran',['review','terima','tolak'])->default('review');
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
        Schema::dropIfExists('books');
    }
}
