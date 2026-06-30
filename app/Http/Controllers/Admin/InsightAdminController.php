<?php

namespace App\Http\Controllers\Admin;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Models\Insight;
use App\Models\InsightCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class InsightAdminController extends Controller
{
    public function index()
    {
        $insights = Insight::with('insightCategory')
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $categories = InsightCategory::active()->orderBy('sort_order')->get();

        return view('admin.insights.index', compact('insights', 'categories'));
    }

    public function create()
    {
        $categories = InsightCategory::active()->orderBy('sort_order')->get();

        return view('admin.insights.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:insights',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'category_slug' => 'nullable|string|exists:insight_categories,slug',
            'type' => 'nullable|string|in:article,whitepaper,report,infographic,video,podcast,webinar',
            'author' => 'nullable|string|max:255',
            'published_at' => 'nullable|date',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published,archived',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
            'read_time' => 'nullable|integer|min:1',
            'meta_description' => 'nullable|string|max:500',
            'tags' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['is_featured'] = $request->has('is_featured');
        $data['is_active'] = $request->has('is_active') ? true : false;

        // Set default values
        if (! isset($data['is_active'])) {
            $data['is_active'] = true;
        }
        if (! isset($data['sort_order'])) {
            $data['sort_order'] = Insight::max('sort_order') + 1;
        }

        // Convert tags string to array
        if ($data['tags']) {
            $data['tags'] = array_map('trim', explode(',', $data['tags']));
        } else {
            $data['tags'] = null;
        }

        // Handle file upload
        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('insights', 'public');
        }

        Insight::create($data);
        $this->renderInsights();

        return redirect()->route('admin.insights.index')
            ->with('success', 'Insight created successfully.');
    }

    public function show(Insight $insight)
    {
        return view('admin.insights.show', compact('insight'));
    }

    public function edit(Insight $insight)
    {
        $categories = InsightCategory::active()->orderBy('sort_order')->get();

        return view('admin.insights.edit', compact('insight', 'categories'));
    }

    public function update(Request $request, Insight $insight)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:insights,slug,'.$insight->id,
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'category_slug' => 'nullable|string|exists:insight_categories,slug',
            'type' => 'nullable|string|in:article,whitepaper,report,infographic,video,podcast,webinar',
            'author' => 'nullable|string|max:255',
            'published_at' => 'nullable|date',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published,archived',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
            'read_time' => 'nullable|integer|min:1',
            'meta_description' => 'nullable|string|max:500',
            'tags' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['is_featured'] = $request->has('is_featured');
        $data['is_active'] = $request->has('is_active') ? true : false;

        // Convert tags string to array
        if ($data['tags']) {
            $data['tags'] = array_map('trim', explode(',', $data['tags']));
        } else {
            $data['tags'] = null;
        }

        // Handle file upload
        if ($request->hasFile('featured_image')) {
            if ($insight->featured_image) {
                Storage::disk('public')->delete($insight->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('insights', 'public');
        }

        $insight->update($data);
        $this->renderInsights();

        return redirect()->route('admin.insights.index')
            ->with('success', 'Insight updated successfully.');
    }

    public function destroy(Insight $insight)
    {
        // Delete associated image
        if ($insight->featured_image) {
            Storage::disk('public')->delete($insight->featured_image);
        }

        $insight->delete();
        $this->renderInsights();

        return redirect()->route('admin.insights.index')
            ->with('success', 'Insight deleted successfully.');
    }

    // Category Management Methods
    public function categories()
    {
        $categories = InsightCategory::orderBy('sort_order')->get();

        return view('admin.insights.categories', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:insight_categories',
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data = $request->all();
        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);
        $data['is_active'] = $request->has('is_active');

        InsightCategory::create($data);
        $this->renderCategories();

        return redirect()->route('admin.insights.categories')
            ->with('success', 'Category created successfully.');
    }

    public function updateCategory(Request $request, InsightCategory $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:insight_categories,slug,'.$category->id,
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data = $request->all();
        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);
        $data['is_active'] = $request->has('is_active');

        $category->update($data);
        $this->renderCategories();

        return redirect()->route('admin.insights.categories')
            ->with('success', 'Category updated successfully.');
    }

    public function destroyCategory(InsightCategory $category)
    {
        // Check if category has insights
        if ($category->insights()->count() > 0) {
            return redirect()->route('admin.insights.categories')
                ->with('error', 'Cannot delete category that has insights associated with it.');
        }

        $category->delete();
        $this->renderCategories();

        return redirect()->route('admin.insights.categories')
            ->with('success', 'Category deleted successfully.');
    }

    public function toggleCategoryStatus(InsightCategory $category)
    {
        $category->update(['is_active' => ! $category->is_active]);

        return redirect()->route('admin.insights.categories')
            ->with('success', 'Category status updated successfully.');
    }

    public function toggleStatus(Insight $insight)
    {
        $insight->update(['is_active' => ! $insight->is_active]);

        return redirect()->route('admin.insights.index')
            ->with('success', 'Insight status updated successfully.');
    }

    public function toggleFeatured(Insight $insight)
    {
        $insight->update(['is_featured' => ! $insight->is_featured]);

        return redirect()->route('admin.insights.index')
            ->with('success', 'Insight featured status updated successfully.');
    }

    public function renderInsights()
    {
        $featuredInsights = Insight::where('is_featured', true)
            ->where('status', 'published')
            ->take(3)
            ->get();
        $recentInsights = Insight::where('is_featured', false)
            ->orderBy('published_at', 'desc')
            ->limit(6)
            ->get();

        Helper::putCache('insights.featured', view('admin.template.insights.featured', compact('featuredInsights'))->render());
        Helper::putCache('insights.recent', view('admin.template.insights.recent', compact('recentInsights'))->render());
        Helper::putCache('home.insights', view('admin.template.home.insights', compact('recentInsights'))->render());
    }

    public function renderCategories()
    {
        $categories = InsightCategory::active()
            ->orderBy('sort_order')
            ->get()
            ->map(function ($category) {
                $category->insights_count = Insight::published()
                    ->byCategory($category->slug)
                    ->count();

                return $category;
            });
        Helper::putCache('insights.categories', view('admin.template.insights.categories', compact('categories'))->render());
    }
}
