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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('user_id')->nullable();
            $table->integer('image_id')->nullable(true);
            $table->integer('status_id');
            $table->string('title');
            $table->text('description');
            $table->text("note")->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task');
    }
};
