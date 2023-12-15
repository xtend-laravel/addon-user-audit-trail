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
        Schema::create('user_audit_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_audit_trail_id');
            $table->string('event');
            $table->string('route')->nullable();
            $table->json('data')->nullable();
            $table->json('exception')->nullable();
            $table->integer('visits_nb')->default(0);
            $table->timestamp('last_visited_at')->nullable();
            $table->integer('last_visit_duration')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_audit_events');
    }
};
