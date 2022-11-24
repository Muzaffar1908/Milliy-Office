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
        Schema::create('administrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('restrict');
            $table->foreignId('pos_id')->constrained('positions')->onDelete('restrict');
            $table->string('user_image')->nullable()->default('upload/config/default_user.png');
            $table->string('full_name_uz');
            $table->string('full_name_ru')->nullable();
            $table->string('full_name_en')->nullable();
            $table->string('email', 255)->unique();
            $table->string('phone', 15)->unique();
            $table->string('title_uz', 255);
            $table->string('title_ru', 255)->nullable();
            $table->string('title_en', 255)->nullable();
            $table->longText('biography_uz');
            $table->longText('biography_ru')->nullable();
            $table->longText('biography_en')->nullable();
            $table->longText('responsibilities_uz');
            $table->longText('responsibilities_ru')->nullable();
            $table->longText('responsibilities_en')->nullable();
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
        Schema::dropIfExists('administrations');
    }
};
