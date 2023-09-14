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
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete()
                ->restrictOnUpdate()
                ;
            $table->foreignId('book_id')
                ->constrained('books')
                ->cascadeOnDelete()
                ->restrictOnUpdate()
                ;
            $table->tinyInteger('rating');
            $table->text('content')
                ->collation('utf8mb4_0900_ai_ci')
                ->nullable()
                ;
            $table->timestamps();
            $table->softDeletes();
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
