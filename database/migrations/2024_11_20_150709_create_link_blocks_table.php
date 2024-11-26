<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('link_blocks', function (Blueprint $table) {
            $table->id('link_block_id');
            $table->unsignedBigInteger('mylink_id');
            $table->foreign('mylink_id')->references('mylink_id')->on('my_links')->onDelete('cascade');
            $table->string('link_title');
            $table->string('url');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('link_blocks');
    }
};