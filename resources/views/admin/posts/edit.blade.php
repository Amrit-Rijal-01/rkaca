@extends('admin.layouts.app')

@section('title', 'Edit Post')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 text-gray-800">Edit Post</h1>
            <p class="text-muted">Update blog post details</p>
        </div>
        <div>
            <a href="{{ route('admin.posts.show', $post) }}" class="btn btn-info me-2">
                <i class="fas fa-eye me-2"></i>View Post
            </a>
            <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to Posts
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data"
                id="postForm">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Post Details</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        id="title" name="title" value="{{ old('title', $post->title) }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="slug" class="form-label">Slug <small class="text-muted">(leave empty to
                                            auto-generate)</small></label>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                        id="slug" name="slug" value="{{ old('slug', $post->slug) }}">
                                    @error('slug')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="excerpt" class="form-label">Excerpt</label>
                                    <textarea class="form-control @error('excerpt') is-invalid @enderror" id="excerpt" name="excerpt" rows="3"
                                    placeholder="Brief description of the post...">{!! old('excerpt', $post->excerpt) !!}</textarea>
                                    @error('excerpt')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="content" class="form-label">PDF Document</label>
                                    @if($post->content && str_ends_with(strtolower($post->content), '.pdf'))
                                        <div class="mb-2">
                                            <a href="{{ asset('storage/' . $post->content) }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                                                <i class="fas fa-file-pdf me-2"></i>View Current PDF
                                            </a>
                                            <span class="text-muted ms-2">(Upload a new PDF to replace the current one)</span>
                                        </div>
                                    @endif
                                    <input type="file" class="form-control @error('content') is-invalid @enderror" id="content" name="content" accept="application/pdf">
                                    @error('content')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Upload a new PDF document if you want to replace the current one. Max size: 2MB.</div>
                                </div>

                                <div class="mb-3">
                                    <label for="thumbnail" class="form-label">Thumbnail Image</label>
                                    @if ($post->thumbnail)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="Current thumbnail"
                                                class="img-thumbnail" style="max-width: 200px;">
                                            <div class="form-text">Current thumbnail</div>
                                        </div>
                                    @endif
                                    <input type="file" class="form-control @error('thumbnail') is-invalid @enderror"
                                        id="thumbnail" name="thumbnail" accept="image/*">
                                    @error('thumbnail')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">
                                        Upload a new image to replace the current one (JPEG, PNG, JPG, GIF, SVG). Max size: 2MB.<br>
                                        <span class="text-info fw-medium"><i class="fas fa-info-circle me-1"></i>Recommended best fit: <strong>1200 × 630 px</strong> (16:9 aspect ratio)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <!-- Publish Settings -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Publish Settings</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select @error('status') is-invalid @enderror" id="status"
                                        name="status">
                                        <option value="draft"
                                            {{ old('status', $post->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                                        <option value="published"
                                            {{ old('status', $post->status) === 'published' ? 'selected' : '' }}>Published
                                        </option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="published_at" class="form-label">Publish Date</label>
                                    <input type="datetime-local"
                                        class="form-control @error('published_at') is-invalid @enderror" id="published_at"
                                        name="published_at"
                                        value="{{ old('published_at', $post->published_at ? $post->published_at->format('Y-m-d\TH:i') : '') }}">
                                    @error('published_at')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured"
                                        value="1" {{ old('is_featured', $post->is_featured) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_featured">
                                        Featured Post
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Author & Category -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Author & Category</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="author_id" class="form-label">Author <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select @error('author_id') is-invalid @enderror" id="author_id"
                                        name="author_id" required>
                                        <option value="">Select Author</option>
                                        @foreach ($authors as $author)
                                            <option value="{{ $author->id }}"
                                                {{ old('author_id', $post->author_id) == $author->id ? 'selected' : '' }}>
                                                {{ $author->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('author_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="category_id" class="form-label">Category <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select @error('category_id') is-invalid @enderror"
                                        id="category_id" name="category_id" required>
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Tags -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Tags</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-0">
                                    <label class="form-label">Select Tags</label>
                                    <div
                                        style="max-height: 200px; overflow-y: auto; border: 1px solid #dee2e6; border-radius: 0.375rem; padding: 0.5rem;">
                                        @foreach ($tags as $tag)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="tags[]"
                                                    value="{{ $tag->id }}" id="tag_{{ $tag->id }}"
                                                    {{ in_array($tag->id, old('tags', $post->tags->pluck('id')->toArray())) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="tag_{{ $tag->id }}">
                                                    {{ $tag->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="card">
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>Update Post
                                    </button>
                                    <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Auto-generate slug from title (only if slug is empty)
        document.getElementById('title').addEventListener('input', function() {
            const title = this.value;
            const slugField = document.getElementById('slug');

            // Only auto-generate if slug field is empty
            if (slugField.value === '') {
                const slug = title.toLowerCase()
                    .replace(/[^\w\s-]/g, '') // Remove special characters
                    .replace(/\s+/g, '-') // Replace spaces with hyphens
                    .replace(/-+/g, '-') // Replace multiple hyphens with single hyphen
                    .trim();

                slugField.value = slug;
            }
        });
    </script>
@endpush
