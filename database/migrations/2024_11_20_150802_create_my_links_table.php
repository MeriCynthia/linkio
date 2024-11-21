<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('my_links', function (Blueprint $table) {
        $table->id('mylink_id');
        $table->unsignedBigInteger('user_id'); // Pastikan kolom user_id ada
        $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        $table->integer('total_views')->default(0);
        $table->integer('total_clicks')->default(0);
        $table->timestamps();
    });
}


    public function down()
    {
        Schema::dropIfExists('my_links');
    }
};