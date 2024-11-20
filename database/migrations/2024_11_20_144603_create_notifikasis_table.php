<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotifikasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifikasis', function (Blueprint $table) {
            $table->string('notifikasi_id')->primary();
            $table->unsignedBigInteger('user_id'); // Kolom relasi ke user
            $table->timestamp('timestamp');
            $table->string('judul');
            $table->text('content');
            $table->foreign('user_id')->references('user_id')->on('users'); // Relasi ke tabel users
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifikasis');
    }
}
