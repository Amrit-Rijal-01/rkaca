@extends('admin.layouts.app')

@section('title', 'Edit Insight')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.insights.index') }}">Insights</a></li>
    <li class="breadcrumb-item active">Edit Insight</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Edit Insight: {{ $insight->title }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.insights.update', $insight) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Insight Title <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        id="title" name="title" value="{{ old('title', $insight->title) }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="slug" class="form-label">Slug</label>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                        id="slug" name="slug" value="{{ old('slug', $insight->slug) }}">
                                    <div class="form-text">Leave empty to auto-generate from title</div>
                                    @error('slug')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="excerpt" class="form-label">Summary</label>
                                    <textarea class="form-control @error('excerpt') is-invalid @enderror" id="excerpt" name="excerpt" rows="4">{{ old('excerpt', $insight->excerpt) }}</textarea>
                                    <div class="form-text">Brief summary for previews and listings</div>
                                    @error('excerpt')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                 <div class="mb-3">
                                     <label for="content" class="form-label">PDF Document</label>
                                     @if ($insight->content && str_ends_with(strtolower($insight->content), '.pdf'))
                                         <div class="mb-2">
                                             <a href="{{ asset('storage/' . $insight->content) }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                                                 <i class="fas fa-file-pdf text-danger me-1"></i>View Current PDF
                                             </a>
                                         </div>
                                     @endif
                                     <input type="file" class="form-control @error('content') is-invalid @enderror"
                                         id="content" name="content" accept="application/pdf">
                                     @error('content')
                                         <div class="invalid-feedback">{{ $message }}</div>
                                     @enderror
                                     <div class="form-text">Upload a new PDF to replace the current one. Max size: 2MB.</div>
                                 </div>

                                <div class="mb-3">
                                    <label for="key_takeaways" class="form-label">Key Takeaways</label>
                                    <textarea class="form-control @error('key_takeaways') is-invalid @enderror" id="key_takeaways" name="key_takeaways"
                                        rows="6">{{ old('key_takeaways', $insight->key_takeaways) }}</textarea>
                                    <div class="form-text">Main points and conclusions</div>
                                    @error('key_takeaways')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="references" class="form-label">References</label>
                                    <textarea class="form-control @error('references') is-invalid @enderror" id="references" name="references"
                                        rows="4">{{ old('references', $insight->references) }}</textarea>
                                    <div class="form-text">Sources and references used</div>
                                    @error('references')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select @error('status') is-invalid @enderror" id="status"
                                        name="status">
                                        <option value="draft"
                                            {{ old('status', $insight->status) === 'draft' ? 'selected' : '' }}>Draft
                                        </option>
                                        <option value="published"
                                            {{ old('status', $insight->status) === 'published' ? 'selected' : '' }}>
                                            Published</option>
                                        <option value="archived"
                                            {{ old('status', $insight->status) === 'archived' ? 'selected' : '' }}>Archived
                                        </option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="category" class="form-label">Category</label>
                                    <select class="form-select @error('category') is-invalid @enderror" id="category"
                                        name="category">
                                        <option value="">Select Category</option>
                                        <option value="market-trends"
                                            {{ old('category', $insight->category) === 'market-trends' ? 'selected' : '' }}>
                                            Market Trends</option>
                                        <option value="industry-analysis"
                                            {{ old('category', $insight->category) === 'industry-analysis' ? 'selected' : '' }}>
                                            Industry Analysis</option>
                                        <option value="technology"
                                            {{ old('category', $insight->category) === 'technology' ? 'selected' : '' }}>
                                            Technology</option>
                                        <option value="research"
                                            {{ old('category', $insight->category) === 'research' ? 'selected' : '' }}>
                                            Research</option>
                                        <option value="best-practices"
                                            {{ old('category', $insight->category) === 'best-practices' ? 'selected' : '' }}>
                                            Best Practices</option>
                                        <option value="case-study"
                                            {{ old('category', $insight->category) === 'case-study' ? 'selected' : '' }}>
                                            Case Study</option>
                                        <option value="thought-leadership"
                                            {{ old('category', $insight->category) === 'thought-leadership' ? 'selected' : '' }}>
                                            Thought Leadership</option>
                                    </select>
                                    @error('category')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="type" class="form-label">Insight Type</label>
                                    <select class="form-select @error('type') is-invalid @enderror" id="type"
                                        name="type">
                                        <option value="">Select Type</option>
                                        <option value="article"
                                            {{ old('type', $insight->type) === 'article' ? 'selected' : '' }}>Article
                                        </option>
                                        <option value="whitepaper"
                                            {{ old('type', $insight->type) === 'whitepaper' ? 'selected' : '' }}>Whitepaper
                                        </option>
                                        <option value="report"
                                            {{ old('type', $insight->type) === 'report' ? 'selected' : '' }}>Report
                                        </option>
                                        <option value="infographic"
                                            {{ old('type', $insight->type) === 'infographic' ? 'selected' : '' }}>
                                            Infographic</option>
                                        <option value="video"
                                            {{ old('type', $insight->type) === 'video' ? 'selected' : '' }}>Video</option>
                                        <option value="podcast"
                                            {{ old('type', $insight->type) === 'podcast' ? 'selected' : '' }}>Podcast
                                        </option>
                                        <option value="webinar"
                                            {{ old('type', $insight->type) === 'webinar' ? 'selected' : '' }}>Webinar
                                        </option>
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="author" class="form-label">Author</label>
                                    <input type="text" class="form-control @error('author') is-invalid @enderror"
                                        id="author" name="author" value="{{ old('author', $insight->author) }}">
                                    @error('author')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="reading_time" class="form-label">Reading Time</label>
                                    <input type="text"
                                        class="form-control @error('reading_time') is-invalid @enderror"
                                        id="reading_time" name="reading_time"
                                        value="{{ old('reading_time', $insight->reading_time) }}"
                                        placeholder="e.g., 5 min read">
                                    @error('reading_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="mb-3">
                                    <label for="published_at" class="form-label">Published Date</label>
                                    <input type="datetime-local"
                                        class="form-control @error('published_at') is-invalid @enderror"
                                        id="published_at" name="published_at"
                                        value="{{ old('published_at', $insight->published_at ? $insight->published_at->format('Y-m-d\TH:i') : '') }}">
                                    @error('published_at')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="featured_image" class="form-label">Featured Image</label>
                                    @if ($insight->featured_image)
                                        <div class="mb-2">
                                            <img src="{{ Storage::url($insight->featured_image) }}" alt="Current Image"
                                                class="img-thumbnail" style="max-width: 200px;">
                                            <div class="form-text">Current image</div>
                                        </div>
                                    @endif
                                    <input type="file"
                                        class="form-control @error('featured_image') is-invalid @enderror"
                                        id="featured_image" name="featured_image" accept="image/*">
                                    <div class="form-text">Upload a new image to replace the current one. Recommended resolution: 1200x675 pixels (16:9 aspect ratio).</div>
                                    @error('featured_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_featured"
                                            name="is_featured" value="1"
                                            {{ old('is_featured', $insight->is_featured) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_featured">
                                            Featured Insight
                                        </label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_active"
                                            name="is_active" value="1"
                                            {{ old('is_active', $insight->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">
                                            Active (visible on public site)
                                        </label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="meta_description" class="form-label">Meta Description</label>
                                    <textarea class="form-control @error('meta_description') is-invalid @enderror" id="meta_description"
                                        name="meta_description" rows="3">{{ old('meta_description', $insight->meta_description) }}</textarea>
                                    @error('meta_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('admin.insights.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Back to Insights
                                    </a>
                                    <div>
                                        <a href="{{ route('admin.insights.show', $insight) }}" class="btn btn-info me-2">
                                            <i class="fas fa-eye"></i> View Insight
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save"></i> Update Insight
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Auto-generate slug from title
        document.getElementById('title').addEventListener('input', function() {
            const title = this.value;
            const slug = title.toLowerCase()
                .replace(/[^a-z0-9 -]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .trim('-');
            document.getElementById('slug').value = slug;
        });
    </script>
@endpush
