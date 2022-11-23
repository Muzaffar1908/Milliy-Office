<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('address_uz', 255);
            $table->string('address_ru', 255)->nullable();
            $table->string('address_en', 255)->nullable();
            $table->string('phone', 15)->unique();
            $table->string('email', 255)->unique();
            $table->dateTime('started_at');
            $table->dateTime('stopped_at');
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
        Schema::dropIfExists('contacts');
    }
};
