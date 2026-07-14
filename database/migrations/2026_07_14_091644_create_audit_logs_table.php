<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * System-wide audit trail for the Administrator's "Audit Logs" module.
 * Generic/polymorphic by design (auditable_type + auditable_id) so any
 * current or future model can be audited without new tables — covers
 * disease/symptom edits, knowledge base changes, training case
 * validation, role/permission changes, etc.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete()
                ->comment('NULL for system/automated actions');
            $table->string('action', 50)->comment('e.g. created, updated, deleted, validated, exported');
            $table->string('auditable_type', 150)->nullable();
            $table->string('auditable_id', 36)->nullable()->comment('Stored as string to support both UUID and bigint PKs');
            $table->json('old_values')->nullable();
            $table->json('new_values')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent', 255)->nullable();
            $table->timestamps();

            $table->index(['auditable_type', 'auditable_id'], 'audit_logs_auditable_index');
            $table->index('user_id');
            $table->index('action');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};