<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            //
            $table->string('handphone')->nullable();
            $table->string('alamat_pickup')->nullable();
            $table->string('avatar')->nullable();
            $table->string('nomer_rekening')->nullable();
            $table->enum('nama_bank',['bca','bri','mandiri', 'bni'])->default('bca');
            $table->enum('roles',['admin','user','tolak'])->default('user');
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
