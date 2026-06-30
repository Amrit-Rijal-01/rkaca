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
        Schema::table('events', function (Blueprint $table) {
            $table->enum('type', ['webinar', 'workshop', 'conference', 'training'])->default('webinar')->after('slug');
            $table->time('start_time')->nullable()->after('start_date');
            $table->time('end_time')->nullable()->after('end_date');
            $table->decimal('price', 10, 2)->nullable()->after('location');
            $table->decimal('early_bird_price', 10, 2)->nullable()->after('price');
            $table->string('registration_link')->nullable()->after('early_bird_price');
            $table->boolean('is_featured')->default(false)->after('registration_link');
            $table->boolean('is_free')->default(false)->after('is_featured');
            $table->string('recording_link')->nullable()->after('is_free');
            $table->string('resources_link')->nullable()->after('recording_link');
            $table->text('short_description')->nullable()->after('description');
            $table->string('venue_type')->nullable()->after('location'); // online, physical, hybrid
            $table->integer('max_participants')->nullable()->after('venue_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn([
                'type', 'start_time', 'end_time', 'price', 'early_bird_price',
                'registration_link', 'is_featured', 'is_free', 'recording_link',
                'resources_link', 'short_description', 'venue_type', 'max_participants',
            ]);
        });
    }
};
