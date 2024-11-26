<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('text_block', function (Blueprint $table) {
            $table->id('textblock_id'); // Sesuaikan primary key
            $table->unsignedBigInteger('mylink_id'); // Relasi ke tabel my_links
            $table->string('title')->nullable();
            $table->string('font')->default('Arial'); // Font default
            $table->string('alignment')->default('left'); // Alignment default
            $table->boolean('bold')->default(false);
            $table->boolean('italic')->default(false);
            $table->string('color')->default('#000000'); // Default warna hitam
            $table->timestamps();

            // Relasi foreign key
            $table->foreign('mylink_id')->references('mylink_id')->on('my_links')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('text_block');
    }
};
