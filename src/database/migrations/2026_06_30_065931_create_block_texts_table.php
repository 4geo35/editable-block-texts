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
        Schema::create('block_texts', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("textable_id")->nullable();
            $table->string("textable_type")->nullable();

            $table->text("text")->nullable();
            $table->dateTime("use_markdown")->nullable();

            $table->unsignedBigInteger("priority")->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('block_texts');
    }
};
