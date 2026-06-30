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
        Schema::table('offices', function (Blueprint $table) {
            $table->string('type')->default('branch')->after('name'); // head_office, branch_office
            $table->string('image')->nullable()->after('type');
            $table->text('address')->change(); // Make sure address is text
            $table->text('office_hours')->nullable()->after('email');
            $table->string('map_link')->nullable()->after('longitude');
            $table->text('transportation')->nullable()->after('map_link');
            $table->text('directions')->nullable()->after('transportation');
            $table->text('parking_info')->nullable()->after('directions');
            $table->string('appointment_link')->nullable()->after('parking_info');
            $table->boolean('is_headquarters')->default(false)->after('appointment_link');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('offices', function (Blueprint $table) {
            $table->dropColumn([
                'type',
                'image',
                'office_hours',
                'map_link',
                'transportation',
                'directions',
                'parking_info',
                'appointment_link',
                'is_headquarters',
            ]);
        });
    }
};
