<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameVersionLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_version_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('game_id');
            $table->string('version');
            $table->text('description');
            $table->float('app_size');
            $table->json('promotional'); // type(img, video), placeholder, url, desc
            $table->enum('status', ['pending', 'reviewed', 'published', 'denied'])->default('pending');
            $table->timestamps();

            $table->foreign('game_id')->references('id')->on('games');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game_version_logs');
    }
}
