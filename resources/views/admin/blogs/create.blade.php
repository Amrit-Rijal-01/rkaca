@extends('admin.layouts.app')

@section('title', 'Create Blog')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.blogs.index') }}">Blogs</a></li>
    <li class="breadcrumb-item active">Create Blog</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Create New Blog</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
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
                                    <label for="excerpt" class="form-label">Excerpt</label>
                                    <textarea class="form-control @error('excerpt') is-invalid @enderror" id="excerpt" name="excerpt" rows="3">{{ old('excerpt') }}</textarea>
                                    @error('excerpt')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="content" class="form-label">Content <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="15"
                                        required>{{ old('content') }}</textarea>
                                    @error('content')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
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
                                    <label for="published_at" class="form-label">Published Date</label>
                                    <input type="date" class="form-control @error('published_at') is-invalid @enderror"
                                        id="published_at" name="published_at" value="{{ old('published_at') }}">
                                    @error('published_at')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="featured_image" class="form-label">Featured Image</label>
                                    <input type="file" class="form-control @error('featured_image') is-invalid @enderror"
                                        id="featured_image" name="featured_image" accept="image/*">
                                    @error('featured_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">
                                        <span class="text-info fw-medium"><i class="fas fa-info-circle me-1"></i>Recommended best fit: <strong>1200 × 630 px</strong> (16:9 aspect ratio). JPG or PNG, max 2MB.</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Back to Blogs
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Create Blog
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
