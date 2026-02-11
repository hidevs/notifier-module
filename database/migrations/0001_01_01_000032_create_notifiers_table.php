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
        Schema::create('notifiers', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->string('user_id')->index()->nullable();
            $table->string('provider_slug');
            $table->foreign('provider_slug')->on('providers')->references('slug');
            $table->string('status')->index();
            $table->timestamp('read_at')->nullable();
            $table->boolean('systematic')->default(false);
            $table->jsonb('response')->nullable();
            $table->text('message')->nullable();
            $table->jsonb('request')->nullable();
            $table->jsonb('exception')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifiers');
    }
};
