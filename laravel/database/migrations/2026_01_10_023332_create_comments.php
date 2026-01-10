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
        Schema::create('comments', function (Blueprint $table) {
            $table->id(); // PK id
            $table->string('name'); // name (This stores the comment text) [cite: 24]
            
            // FK user_id (Who wrote the comment?) [cite: 26]
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            
            // This creates 'commentable_id' and 'commentable_type' automatically [cite: 25, 27]
            $table->morphs('commentable'); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
