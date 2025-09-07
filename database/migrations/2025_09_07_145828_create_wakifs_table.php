<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('wakifs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wakaf_id')->nullable();
            $table->foreign('wakaf_id')->references('id')->on('wakafs')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('nama');
            $table->boolean('hide_name')->default(false);
            $table->string('no_hp');
            $table->string('email');
            $table->integer('nominal');
            $table->string('deskripsi');

            $table->string('reference_id')->nullable();
            $table->string('status')->nullable();
            $table->dateTime('paid_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wakifs');
    }
};
