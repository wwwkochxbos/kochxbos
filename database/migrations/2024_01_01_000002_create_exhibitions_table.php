<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exhibitions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->string('banner_image')->nullable();
            $table->string('thumbnail')->nullable();
            $table->enum('status', ['now', 'soon', 'past'])->default('soon');
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });

        Schema::create('artist_exhibition', function (Blueprint $table) {
            $table->id();
            $table->foreignId('artist_id')->constrained()->onDelete('cascade');
            $table->foreignId('exhibition_id')->constrained()->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('artist_exhibition');
        Schema::dropIfExists('exhibitions');
    }
};
