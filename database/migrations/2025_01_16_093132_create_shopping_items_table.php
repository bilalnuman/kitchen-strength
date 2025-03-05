<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('shopping_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('ingredient_id')->constrained()->onDelete('cascade'); 
            $table->integer('quantity')->nullable()->default(1);
            $table->unique(['user_id', 'ingredient_id']);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('shopping_items');
    }
};

