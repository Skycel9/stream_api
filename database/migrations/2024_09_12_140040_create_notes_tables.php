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
        Schema::create('notes_tables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id"); //Foreign key
            $table->unsignedBigInteger("video_id"); //Foreign key
            $table->decimal("value", 8, 1);
            $table->timestamps();

            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->foreign("video_id")->references("id")->on("videos")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes_tables');
    }
};
