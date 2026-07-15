<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Insight extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'category',
        'category_slug',
        'type',
        'author',
        'published_at',
        'status',
        'is_featured',
        'sort_order',
        'read_time',
        'meta_description',
        'tags',
        'is_active',
    ];

    protected $casts = [
        'published_at' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'tags' => 'array',
    ];

    /**
     * Get published insights
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
            ->where('is_active', true)
            ->whereNotNull('published_at');
    }

    /**
     * Get active insights
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get featured insights
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Get insights by category
     */
    public function scopeByCategory($query, $categorySlug)
    {
        return $query->where('category_slug', $categorySlug);
    }

    /**
     * Relationship with category
     */
    public function insightCategory()
    {
        return $this->belongsTo(InsightCategory::class, 'category_slug', 'slug');
    }

    /**
     * Auto-generate slug from title
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;

        if (! $this->slug) {
            $this->attributes['slug'] = Str::slug($value);
        }
    }

    /**
     * Get formatted published date
     */
    public function getFormattedPublishedDateAttribute()
    {
        return $this->published_at ? $this->published_at->format('M d, Y') : null;
    }

    /**
     * Get read time text
     */
    public function getReadTimeTextAttribute()
    {
        if (! $this->read_time) {
            return null;
        }

        return $this->read_time.' min read';
    }

    /**
     * Get excerpt or auto-generate from content
     */
    public function getExcerptAttribute($value)
    {
        if ($value) {
            return $value;
        }

        if ($this->content && str_ends_with(strtolower($this->content), '.pdf')) {
            return 'Read the PDF document: '.$this->title;
        }

        // Auto-generate excerpt from content
        return Str::limit(strip_tags($this->content), 160);
    }
}
