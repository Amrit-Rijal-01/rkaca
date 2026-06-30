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
        Schema::table('insights', function (Blueprint $table) {
            $table->boolean('is_featured')->default(false)->after('status');
            $table->integer('sort_order')->default(0)->after('is_featured');
            $table->integer('read_time')->nullable()->after('sort_order'); // in minutes
            $table->text('meta_description')->nullable()->after('read_time');
            $table->json('tags')->nullable()->after('meta_description');
            $table->string('category_slug')->nullable()->after('category');
            $table->boolean('is_active')->default(true)->after('sort_order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('insights', function (Blueprint $table) {
            $table->dropColumn([
                'is_featured',
                'sort_order',
                'read_time',
                'meta_description',
                'tags',
                'category_slug',
                'is_active',
            ]);
        });
    }
};
