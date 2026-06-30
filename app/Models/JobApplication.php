<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_opening_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'cover_letter',
        'resume_path',
        'portfolio_url',
        'linkedin_profile',
        'expected_salary',
        'available_start_date',
        'status',
        'notes',
        'additional_info',
    ];

    protected $casts = [
        'expected_salary' => 'decimal:2',
        'available_start_date' => 'date',
        'additional_info' => 'array',
    ];

    public function jobOpening()
    {
        return $this->belongsTo(JobOpening::class);
    }

    public function getFullNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function getResumeUrlAttribute()
    {
        return $this->resume_path ? asset('storage/'.$this->resume_path) : null;
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeUnderReview($query)
    {
        return $query->where('status', 'under_review');
    }
}
