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
        Schema::create('leave', function (Blueprint $table) {
            $table->string('leaveID', 10)->primary();
            $table->string('studentID', 10);
            $table->set('type', ['sick', 'other'])->default('sick');
            $table->set('severity', ['critical', 'mild'])->default('mild');
            $table->string('symptoms')->nullable();
            $table->string('allergies')->nullable();
            $table->string('reason')->nullable();
            $table->integer('days')->nullable();
            $table->text('description')->nullable();
            $table->set('status', ['approved', 'rejected', 'pending'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave');
    }
};
