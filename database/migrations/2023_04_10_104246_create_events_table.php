<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('ev_date')->nullable();
            $table->string('ev_time')->nullable();
            $table->string('ev_title')->nullable();
            $table->longText('ev_interests')->nullable();
            $table->string('ev_location')->nullable();
            $table->longText('ev_description')->nullable();
            $table->integer('max_capacity')->nullable();
            $table->string('ev_offer')->nullable();
            $table->string('ev_image')->nullable();
            $table->string('ev_buddies')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};