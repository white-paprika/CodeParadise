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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255) //55 - for google
                ->collation('utf8mb4_0900_ai_ci')
                ->unique()
                ->index()
                ; 
            $table->text('description')
                ->collation('utf8mb4_0900_ai_ci')
                ;
            $table->decimal('price', 7, 2)
                ->index()
                ;
            $table->string('path', 191)
                ->collation('utf8mb4_0900_ai_ci')
                ->nullable()
                ;
            $table->unsignedBigInteger('items_in_stock')
                ->default(0)
                ->index()
                ;
            $table->year('release_year')
                ->index();
            $table->string('translator', 60)
                ->nullable()
                ->collation('utf8mb4_0900_ai_ci')
                ;
            $table->foreignId('genre_id')
                ->constrained('genres')
                ->cascadeOnDelete()
                ->restrictOnUpdate()
                ;
            
            $table->timestamps();
            // $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
