<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevelopersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('developers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('country');
            $table->string('company_name');
            $table->dateTime('registration_date');
            $table->dateTime('approval_date')->nullable();
            $table->json('bank_account')->nullable(); //type, bank name, bank account number
            $table->string('company_pic_url')->nullable();
            $table->string('company_address');
            $table->string('company_website')->nullable();
            $table->json('social_media')->nullable();
            $table->string('company_description')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('developers');
    }
}
