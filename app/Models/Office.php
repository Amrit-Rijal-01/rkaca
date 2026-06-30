<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'type',
        'image',
        'address',
        'city',
        'state',
        'country',
        'postal_code',
        'phone',
        'email',
        'office_hours',
        'latitude',
        'longitude',
        'map_link',
        'transportation',
        'directions',
        'parking_info',
        'appointment_link',
        'is_headquarters',
        'status',
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'is_headquarters' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeHeadquarters($query)
    {
        return $query->where('is_headquarters', true);
    }

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/'.$this->image);
        }

        return asset('images/default-office.jpg');
    }

    public function getTypeDisplayAttribute()
    {
        return ucwords(str_replace('_', ' ', $this->type));
    }
}
