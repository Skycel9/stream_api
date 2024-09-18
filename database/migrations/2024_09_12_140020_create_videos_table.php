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
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->longText("description");
            $table->unsignedBigInteger("miniature");
            $table->unsignedBigInteger("category_id"); //Foreign key
            $table->unsignedBigInteger("author_id"); // Foreign key
            $table->timestamps();

            $table->foreign("miniature")->references("id")->on("attachments")->onDelete(null);
            $table->foreign("category_id")->references("id")->on("categories")->onDelete(null);
            $table->foreign("author_id")->references("id")->on("users")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
