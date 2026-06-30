<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'type',
        'description',
        'short_description',
        'location',
        'venue_type',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'price',
        'early_bird_price',
        'registration_link',
        'is_featured',
        'is_free',
        'recording_link',
        'resources_link',
        'max_participants',
        'featured_image',
        'status',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'is_featured' => 'boolean',
        'is_free' => 'boolean',
        'price' => 'decimal:2',
        'early_bird_price' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeUpcoming($query)
    {
        return $query->where('start_date', '>=', now());
    }

    public function scopePast($query)
    {
        return $query->where('start_date', '<', now());
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function getFormattedDateAttribute()
    {
        return $this->start_date->format('j M');
    }

    public function getFormattedTimeAttribute()
    {
        if ($this->start_time && $this->end_time) {
            return $this->start_time->format('g:i A').' - '.$this->end_time->format('g:i A');
        }

        return null;
    }

    public function getDisplayPriceAttribute()
    {
        if ($this->is_free) {
            return 'Free';
        }

        if ($this->early_bird_price && $this->early_bird_price < $this->price) {
            return "NPR {$this->price} (Early Bird: NPR {$this->early_bird_price})";
        }

        return $this->price ? "NPR {$this->price}" : null;
    }

    public function getImageUrlAttribute()
    {
        return $this->featured_image ? asset('storage/'.$this->featured_image) : null;
    }
}
