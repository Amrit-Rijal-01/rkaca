<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOpening extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'department',
        'location',
        'job_type',
        'overview',
        'responsibilities',
        'requirements',
        'benefits',
        'category',
        'salary_min',
        'salary_max',
        'application_deadline',
        'status',
        'is_featured',
        'sort_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'salary_min' => 'decimal:2',
        'salary_max' => 'decimal:2',
        'application_deadline' => 'date',
    ];

    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('is_featured', 'desc')
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc');
    }

    public function getFormattedSalaryAttribute()
    {
        if ($this->salary_min && $this->salary_max) {
            return 'NPR '.number_format($this->salary_min).' - '.number_format($this->salary_max);
        } elseif ($this->salary_min) {
            return 'NPR '.number_format($this->salary_min).'+';
        }

        return 'Negotiable';
    }

    public function getResponsibilitiesArrayAttribute()
    {
        return explode('
', $this->responsibilities);
    }

    public function getRequirementsArrayAttribute()
    {
        return explode('
', $this->requirements);
    }

    public function getBenefitsArrayAttribute()
    {
        return $this->benefits ? explode("\n", $this->benefits) : [];
    }
}
