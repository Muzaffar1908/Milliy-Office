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
        Schema::create('mains', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('restrict');
            $table->string('title_uz', 255);
            $table->string('title_ru', 255)->nullable()->nullable();
            $table->string('title_en', 255)->nullable()->nullable();
            $table->longText('description_uz');
            $table->longText('description_ru')->nullable();
            $table->longText('description_en')->nullable();
            $table->string('youtobe_id', 255)->nullable();
            $table->string('background_image', 255)->nullable()->default('main');
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
        Schema::dropIfExists('mains');
    }
};
