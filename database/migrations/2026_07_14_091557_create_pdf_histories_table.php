<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tracks every PDF export of a diagnosis result — a registered-user-only
 * feature. Guests are blocked at the policy/service layer before a row
 * would ever be created here.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pdf_export_histories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('diagnosis_session_id')->constrained('diagnosis_sessions')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()
                ->comment('Exports always belong to an authenticated user');
            $table->string('file_path', 255);
            $table->string('file_name', 150);
            $table->unsignedInteger('file_size_bytes')->nullable();
            $table->timestamp('exported_at');
            $table->timestamps();

            $table->index('diagnosis_session_id');
            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pdf_export_histories');
    }
};