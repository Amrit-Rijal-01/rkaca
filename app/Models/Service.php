<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'body',
        'category',
        'status',
        'sort_order',
        'is_featured',
        'parent_id',
        'is_sub_service',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'parent_id' => 'integer',
        'is_sub_service' => 'boolean',
        'sort_order' => 'integer',
        'is_featured' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function parent()
    {
        return $this->belongsTo(Service::class, 'parent_id');
    }

    public function subServices()
    {
        return $this->hasMany(Service::class, 'parent_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    public function scopeTopLevel($query)
    {
        return $query->where('is_sub_service', false)->whereNull('parent_id');
    }

    public function getAllDescendantIds()
    {
        $ids = [];
        foreach ($this->subServices as $subService) {
            $ids[] = $subService->id;
            $ids = array_merge($ids, $subService->getAllDescendantIds());
        }

        return $ids;
    }

    public static function getHierarchy($excludeIds = [])
    {
        $topLevelServices = self::whereNull('parent_id')
            ->whereNotIn('id', $excludeIds)
            ->ordered()
            ->get();

        $hierarchy = [];
        foreach ($topLevelServices as $service) {
            self::buildHierarchyTree($service, 0, $excludeIds, $hierarchy);
        }

        return collect($hierarchy);
    }

    private static function buildHierarchyTree($service, $depth, $excludeIds, &$hierarchy)
    {
        $service->depth = $depth;
        $hierarchy[] = $service;

        $children = $service->subServices()
            ->whereNotIn('id', $excludeIds)
            ->ordered()
            ->get();

        foreach ($children as $child) {
            self::buildHierarchyTree($child, $depth + 1, $excludeIds, $hierarchy);
        }
    }
}
