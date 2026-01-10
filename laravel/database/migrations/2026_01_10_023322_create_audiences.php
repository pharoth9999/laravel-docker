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
        Schema::create('audiences', function (Blueprint $table) {
            $table->id(); // PK id
            $table->string('name'); // name [cite: 13]
            
            // FK article_id linked to articles table [cite: 14]
            $table->foreignId('article_id')->constrained('articles')->cascadeOnDelete();
            
            // FK user_id linked to users table [cite: 15]
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audiences');
    }
};
