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
        Schema::create('event_attendees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('attendee_id');
            $table->enum('attendee_status', ['confirmed', 'pending', 'declined']);
            $table->unsignedBigInteger('attendee_invited_by');
            $table->foreign('event_id')->references('id')->on('events');
            $table->foreign('attendee_id')->references('id')->on('users');
            $table->foreign('attendee_invited_by')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_attendees');
    }
};