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
        Schema::create('user_audit_trail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->ipAddress()->nullable();
            $table->string('country')->nullable();
            $table->json('device')->nullable();
            $table->json('location')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_audit_trail');
    }
};
