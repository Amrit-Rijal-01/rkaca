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
        Schema::table('services', function (Blueprint $table) {
            $table->json('features')->nullable(); // For the bullet point features list
            $table->json('benefits')->nullable(); // For additional benefits
            $table->string('category')->nullable(); // For grouping services
            $table->text('detailed_description')->nullable(); // For longer descriptions
            $table->json('sub_services')->nullable(); // For detailed sub-service sections
            $table->boolean('is_featured')->default(false);
            $table->string('svg_icon')->nullable(); // For storing SVG icon code
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->string('duration')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn([
                'features',
                'benefits',
                'category',
                'detailed_description',
                'sub_services',
                'is_featured',
                'svg_icon',
                'meta_title',
                'meta_description',
                'price',
                'duration',
            ]);
        });
    }
};
