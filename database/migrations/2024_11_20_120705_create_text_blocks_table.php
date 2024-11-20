<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTextBlocksTable extends Migration
{
    public function up()
    {
        Schema::create('text_blocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mylink_id'); // Relasi ke tabel mylink
            $table->string('title')->nullable();
            $table->string('font')->default('Arial');
            $table->string('alignment')->default('left');
            $table->boolean('bold')->default(false);
            $table->boolean('italic')->default(false);
            $table->string('color')->default('#000000');
            $table->timestamps();

            $table->foreign('mylink_id')->references('id')->on('mylinks')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('text_blocks');
    }
}
