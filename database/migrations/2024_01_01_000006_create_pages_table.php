<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('body')->nullable();
            $table->string('template')->default('default');
            $table->timestamps();
        });

        Schema::create('press_items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('source')->nullable();
            $table->string('url')->nullable();
            $table->string('image')->nullable();
            $table->date('published_at')->nullable();
            $table->text('excerpt')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('press_items');
        Schema::dropIfExists('pages');
    }
};
