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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('restrict');
            $table->string('about_title_uz', 255);
            $table->string('about_title_ru', 255)->nullable();
            $table->string('about_title_en', 255)->nullable();
            $table->string('section_number', 10);
            $table->string('section_title_uz', 255);
            $table->string('section_title_ru', 255)->nullable();
            $table->string('section_title_en', 255)->nullable();
            $table->boolean('is_active')->nullable()->default(true);
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
        Schema::dropIfExists('abouts');
    }
};
