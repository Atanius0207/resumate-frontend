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
        Schema::create('cv_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name'); 
            $table->string('slug')->unique(); 
            
            $table->string('thumbnail')->nullable(); 
            $table->string('file_path')->nullable(); 
            
            $table->text('description')->nullable(); 
            $table->string('category')->index(); 
            $table->json('tags')->nullable(); 
            
            $table->enum('type', ['free', 'pro'])->default('free'); 
            $table->unsignedBigInteger('price')->default(0);
            
            $table->json('form_schema')->nullable();
            
            $table->boolean('is_active')->default(true); 
            $table->boolean('is_new')->default(true);
            $table->boolean('is_ats_friendly')->default(true); 
            
            $table->unsignedInteger('total_downloads')->default(0); 
            $table->decimal('rating', 3, 2)->default(0.00); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cv_templates');
    }
};
