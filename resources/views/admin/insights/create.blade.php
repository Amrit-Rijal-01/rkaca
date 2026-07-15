@extends('admin.layouts.app')

@section('title', 'Create Insight')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.insights.index') }}">Insights</a></li>
    <li class="breadcrumb-item active">Create Insight</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Create New Insight</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.insights.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        id="title" name="title" value="{{ old('title') }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="slug" class="form-label">Slug</label>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                        id="slug" name="slug" value="{{ old('slug') }}">
                                    <div class="form-text">Leave empty to auto-generate from title</div>
                                    @error('slug')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="excerpt" class="form-label">Summary</label>
                                    <textarea class="form-control @error('excerpt') is-invalid @enderror" id="excerpt" name="excerpt" rows="3">{{ old('excerpt') }}</textarea>
                                    @error('excerpt')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="content" class="form-label">PDF Document <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control @error('content') is-invalid @enderror" id="content" name="content" accept="application/pdf" required>
                                    @error('content')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Please upload a PDF document. Max size: 2MB.</div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select @error('status') is-invalid @enderror" id="status"
                                        name="status">
                                        <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft
                                        </option>
                                        <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>
                                            Published</option>
                                        <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>
                                            Inactive</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="author" class="form-label">Author <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('author') is-invalid @enderror"
                                        id="author" name="author" value="{{ old('author', auth()->user()->name) }}"
                                        required>
                                    @error('author')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="category" class="form-label">Category</label>
                                    <select class="form-select @error('category') is-invalid @enderror" id="category"
                                        name="category">
                                        <option value="">Select Category</option>
                                        <option value="market-trends"
                                            {{ old('category') === 'market-trends' ? 'selected' : '' }}>
                                            Market Trends</option>
                                        <option value="industry-analysis"
                                            {{ old('category') === 'industry-analysis' ? 'selected' : '' }}>
                                            Industry Analysis</option>
                                        <option value="technology"
                                            {{ old('category') === 'technology' ? 'selected' : '' }}>
                                            Technology</option>
                                        <option value="research" {{ old('category') === 'research' ? 'selected' : '' }}>
                                            Research</option>
                                        <option value="best-practices"
                                            {{ old('category') === 'best-practices' ? 'selected' : '' }}>
                                            Best Practices</option>
                                        <option value="case-study"
                                            {{ old('category') === 'case-study' ? 'selected' : '' }}>
                                            Case Study</option>
                                        <option value="thought-leadership"
                                            {{ old('category') === 'thought-leadership' ? 'selected' : '' }}>
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
                                        <option value="article" {{ old('type') === 'article' ? 'selected' : '' }}>Article
                                        </option>
                                        <option value="whitepaper" {{ old('type') === 'whitepaper' ? 'selected' : '' }}>
                                            Whitepaper
                                        </option>
                                        <option value="report" {{ old('type') === 'report' ? 'selected' : '' }}>Report
                                        </option>
                                        <option value="infographic" {{ old('type') === 'infographic' ? 'selected' : '' }}>
                                            Infographic</option>
                                        <option value="video" {{ old('type') === 'video' ? 'selected' : '' }}>Video
                                        </option>
                                        <option value="podcast" {{ old('type') === 'podcast' ? 'selected' : '' }}>Podcast
                                        </option>
                                        <option value="webinar" {{ old('type') === 'webinar' ? 'selected' : '' }}>Webinar
                                        </option>
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>



                                <div class="mb-3">
                                    <label for="published_at" class="form-label">Published Date</label>
                                    <input type="datetime-local"
                                        class="form-control @error('published_at') is-invalid @enderror" id="published_at"
                                        name="published_at" value="{{ old('published_at') }}">
                                    @error('published_at')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="featured_image" class="form-label">Featured Image</label>
                                    <input type="file"
                                        class="form-control @error('featured_image') is-invalid @enderror"
                                        id="featured_image" name="featured_image" accept="image/*">
                                    <div class="form-text">Recommended resolution: 1200x675 pixels (16:9 aspect ratio).</div>
                                    @error('featured_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_featured"
                                            name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_featured">
                                            Featured Insight
                                        </label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_active"
                                            name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">
                                            Active (visible on public site)
                                        </label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="meta_description" class="form-label">Meta Description</label>
                                    <textarea class="form-control @error('meta_description') is-invalid @enderror" id="meta_description"
                                        name="meta_description" rows="3">{{ old('meta_description') }}</textarea>
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
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Create Insight
                                    </button>
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

        // Set published date to current date/time when status is changed to published
        document.getElementById('status').addEventListener('change', function() {
            const publishedAtField = document.getElementById('published_at');
            if (this.value === 'published' && !publishedAtField.value) {
                const now = new Date();
                const localDateTime = new Date(now.getTime() - now.getTimezoneOffset() * 60000);
                publishedAtField.value = localDateTime.toISOString().slice(0, 16);
            }
        });
    </script>
@endpush
