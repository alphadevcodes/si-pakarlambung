<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

/**
 * One row per diagnosis attempt (Step 1 personal info), for BOTH guests
 * and registered users — user_id is nullable to distinguish them, avoiding
 * a duplicated "guest_diagnosis_sessions" table (DRY). The UUID primary key
 * doubles as the unguessable public token a guest uses to view their own
 * result page without authentication or exposing other users' data.
 *
 * "Saved Diagnosis" / "User Diagnosis History" are simply rows here where
 * user_id IS NOT NULL — no separate table needed.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('diagnosis_sessions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete()
                ->comment('NULL for guest diagnoses');
            $table->string('full_name', 150);
            $table->string('gender', 10);
            $table->unsignedTinyInteger('age');
            $table->string('occupation', 100)->nullable();
            $table->text('address')->nullable();
            $table->string('phone_number', 20)->nullable();
            $table->text('medical_history')->nullable();
            $table->text('additional_notes')->nullable();
            $table->string('status', 20)->default('pending')
                ->comment('pending | completed');
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent', 255)->nullable();
            $table->timestamp('diagnosed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['user_id', 'created_at'], 'diagnosis_sessions_user_created_index');
            $table->index('status');
        });

        DB::statement("ALTER TABLE diagnosis_sessions ADD CONSTRAINT chk_diagnosis_sessions_age CHECK (age BETWEEN 0 AND 120)");
        DB::statement("ALTER TABLE diagnosis_sessions ADD CONSTRAINT chk_diagnosis_sessions_gender CHECK (gender IN ('male', 'female'))");
        DB::statement("ALTER TABLE diagnosis_sessions ADD CONSTRAINT chk_diagnosis_sessions_status CHECK (status IN ('pending', 'completed'))");
    }

    public function down(): void
    {
        Schema::dropIfExists('diagnosis_sessions');
    }
};