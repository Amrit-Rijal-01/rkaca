<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NavigationSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_slug',
        'page_title',
        'route_name',
        'icon_class',
        'description',
        'preview_image',
        'tags',
        'metadata',
        'is_active',
        'sort_order',
        'quick_links',
    ];

    protected $casts = [
        'metadata' => 'array',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'quick_links' => 'array',
    ];

    /**
     * Scope to get only active navigation items
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to order by sort order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('page_title');
    }

    /**
     * Get all active navigation items for sidebar
     */
    public static function getSidebarNavigation()
    {
        return static::active()->ordered()->get();
    }

    /**
     * Get tags as array
     */
    public function getTagsArrayAttribute()
    {
        if (empty($this->tags)) {
            return [];
        }

        return array_map('trim', explode(',', $this->tags));
    }

    /**
     * Get preview image URL
     */
    public function getPreviewImageUrlAttribute()
    {
        if (empty($this->preview_image)) {
            // Return default image
            return 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?ixlib=rb-4.0.3&q=85&fm=jpg&crop=entropy&cs=srgb&w=300&h=120';
        }

        // If it's a full URL, return as is
        if (filter_var($this->preview_image, FILTER_VALIDATE_URL)) {
            return $this->preview_image;
        }

        // If it's a local file path, return asset URL
        return asset('storage/'.$this->preview_image);
    }

    /**
     * Get formatted services for data-services attribute
     */
    public function getServicesJsonAttribute()
    {
        $defaultServices = [
            ['title' => 'Professional Services', 'icon' => 'fas fa-briefcase'],
            ['title' => 'Expert Consultation', 'icon' => 'fas fa-handshake'],
            ['title' => 'Strategic Planning', 'icon' => 'fas fa-chart-line'],
        ];

        if (isset($this->metadata['services']) && is_array($this->metadata['services'])) {
            return json_encode($this->metadata['services']);
        }

        return json_encode($defaultServices);
    }
}
