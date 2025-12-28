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
        Schema::create('database_notifications', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->string('sender')->nullable()->index();
            $table->string('receiver')->index();
            $table->string('group')->index();
            $table->string('title');
            $table->string('message')->nullable();
            $table->string('link')->nullable();
            $table->string('type')->index();
            $table->jsonb('metadata')->default('[]');
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('database_notifications');
    }
};
