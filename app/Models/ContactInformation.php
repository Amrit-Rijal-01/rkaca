<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class ContactInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'address',
        'latitude',
        'longitude',
        'phone',
        'email',
        'website',
        'social_media_links',
        'map_embed_url',
        'google_maps_link',
        'business_hours',
        'additional_info',
        'is_active',
    ];

    protected $casts = [
        'social_media_links' => 'array',
        'business_hours' => 'array',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the active contact information
     */
    public static function getActive()
    {
        return self::where('is_active', true)->first();
    }

    /**
     * Get formatted business hours
     */
    public function getFormattedBusinessHours()
    {
        if (! $this->business_hours) {
            return [];
        }

        return $this->business_hours;
    }

    /**
     * Get social media links as collection
     */
    public function getSocialMediaLinks()
    {
        return collect($this->social_media_links ?? []);
    }

    protected static function booted()
    {
        static::saved(function () {
            Cache::forget('contact_info');
            Cache::remember('contact_info', 60 * 60 * 24, function () {
                return ContactInformation::first();
            });
        });

        static::deleted(function () {
            Cache::forget('contact_info');
        });
    }
}
