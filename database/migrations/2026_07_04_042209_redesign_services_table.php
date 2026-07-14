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
            // Drop old columns
            $table->dropColumn([
                'content',
                'detailed_description',
                'features',
                'benefits',
                'sub_services',
                'price',
                'duration',
                'featured_image',
                'icon',
                'svg_icon',
            ]);

            // Add new body column
            $table->mediumText('body')->nullable()->after('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->longText('content')->nullable();
            $table->text('detailed_description')->nullable();
            $table->json('features')->nullable();
            $table->json('benefits')->nullable();
            $table->json('sub_services')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->string('duration')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('icon')->nullable();
            $table->string('svg_icon')->nullable();
            $table->dropColumn('body');
        });
    }
};
