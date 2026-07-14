<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Key-value store for the Administrator's "System Settings" module
 * (e.g. site name, contact email, minimum training cases required per
 * disease before it's eligible for diagnosis, PDF footer text, etc.).
 * Grouped + typed so the UI can render an appropriate form control.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key', 100)->unique();
            $table->text('value')->nullable();
            $table->string('type', 20)->default('string')->comment('string | integer | boolean | json');
            $table->string('group', 50)->default('general');
            $table->string('description', 255)->nullable();
            $table->timestamps();

            $table->index('group');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};