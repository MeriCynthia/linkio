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
        $table->unsignedBigInteger('user_id');
        $table->integer('total_views')->default(0);
        $table->integer('total_clicks')->default(0);
        $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        $table->timestamps();        
    });
}

    public function down()
    {
        Schema::dropIfExists('my_links');
    }
};