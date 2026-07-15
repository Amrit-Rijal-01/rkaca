@extends('admin.layouts.app')

@section('title', 'View Post')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 text-gray-800">{{ $post->title }}</h1>
            <p class="text-muted">Post details and content</p>
        </div>
        <div>
            <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-warning me-2">
                <i class="fas fa-edit me-2"></i>Edit Post
            </a>
            <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to Posts
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Post Content -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Post Content</h5>
                </div>
                <div class="card-body">
                    @if ($post->thumbnail)
                        <div class="mb-4 text-center">
                            <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}"
                                class="img-fluid rounded shadow-sm" style="aspect-ratio: 16 / 9; width: 100%; max-height: 480px; object-fit: cover;">
                        </div>
                    @endif

                    @if ($post->excerpt)
                        <div class="mb-4">
                            <h6 class="text-muted">Excerpt:</h6>
                            <p class="lead">{!! $post->excerpt !!}</p>
                        </div>
                    @endif

                    <div class="post-content">
                        @if ($post->content && str_ends_with(strtolower($post->content), '.pdf'))
                            <div class="mb-3"
                                style="height: 85vh; min-height: 500px; border: 1px solid #dee2e6; border-radius: 0.375rem; overflow: hidden; background: #fff;">
                                <iframe src="{{ asset('storage/' . $post->content) }}" width="100%" height="100%"
                                    style="border: none;"></iframe>
                            </div>
                            <div class="text-center mt-2">
                                <a href="{{ asset('storage/' . $post->content) }}" target="_blank"
                                    class="btn btn-outline-primary">
                                    <i class="fas fa-file-download me-2"></i>Download PDF Document
                                </a>
                            </div>
                        @else
                            {!! $post->content !!}
                        @endif
                    </div>
                </div>
            </div>

            <!-- Tags -->
            @if ($post->tags->count() > 0)
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title mb-0">Tags</h6>
                    </div>
                    <div class="card-body">
                        @foreach ($post->tags as $tag)
                            <span class="badge bg-secondary me-1 mb-1">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <div class="col-lg-4">
            <!-- Post Details -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="card-title mb-0">Post Details</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Status:</strong>
                        <span class="badge {{ $post->status === 'published' ? 'bg-success' : 'bg-warning' }} ms-2">
                            {{ ucfirst($post->status) }}
                        </span>
                    </div>

                    <div class="mb-3">
                        <strong>Featured:</strong>
                        <span class="badge {{ $post->is_featured ? 'bg-info' : 'bg-secondary' }} ms-2">
                            {{ $post->is_featured ? 'Yes' : 'No' }}
                        </span>
                    </div>

                    <div class="mb-3">
                        <strong>Slug:</strong>
                        <code>{{ $post->slug }}</code>
                    </div>

                    <div class="mb-3">
                        <strong>Created:</strong>
                        <div class="text-muted">{{ $post->created_at->format('M j, Y g:i A') }}</div>
                    </div>

                    <div class="mb-3">
                        <strong>Last Updated:</strong>
                        <div class="text-muted">{{ $post->updated_at->format('M j, Y g:i A') }}</div>
                    </div>

                    @if ($post->published_at)
                        <div class="mb-3">
                            <strong>Published:</strong>
                            <div class="text-muted">{{ $post->published_at->format('M j, Y g:i A') }}</div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Author -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="card-title mb-0">Author</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar-circle bg-primary text-white me-3">
                            {{ substr($post->author->name, 0, 2) }}
                        </div>
                        <div>
                            <div class="fw-bold">{{ $post->author->name }}</div>
                            <div class="text-muted small">{{ $post->author->email }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Category -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="card-title mb-0">Category</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        @if ($post->category->icon)
                            <i class="{{ $post->category->icon }} me-2 text-primary"></i>
                        @endif
                        <div>
                            <div class="fw-bold">{{ $post->category->name }}</div>
                            @if ($post->category->description)
                                <div class="text-muted small">{{ $post->category->description }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mb-0">Actions</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>Edit Post
                        </a>

                        @if ($post->status === 'published')
                            <button type="button" class="btn btn-secondary" onclick="changeStatus('draft')">
                                <i class="fas fa-archive me-2"></i>Mark as Draft
                            </button>
                        @else
                            <button type="button" class="btn btn-success" onclick="changeStatus('published')">
                                <i class="fas fa-globe me-2"></i>Publish Post
                            </button>
                        @endif

                        <button type="button" class="btn btn-danger" onclick="deletePost()">
                            <i class="fas fa-trash me-2"></i>Delete Post
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hidden forms for actions -->
    <form id="statusForm" action="{{ route('admin.posts.update', $post) }}" method="POST" style="display: none;">
        @csrf
        @method('PUT')
        <input type="hidden" name="status" id="statusInput">
        <input type="hidden" name="title" value="{{ $post->title }}">
        <input type="hidden" name="content" value="{{ $post->content }}">
        <input type="hidden" name="author_id" value="{{ $post->author_id }}">
        <input type="hidden" name="category_id" value="{{ $post->category_id }}">
    </form>

    <form id="deleteForm" action="{{ route('admin.posts.destroy', $post) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
@endsection

@push('styles')
    <style>
        .avatar-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .post-content {
            line-height: 1.8;
            font-size: 1.1rem;
        }
    </style>
@endpush

@push('scripts')
    <script>
        function changeStatus(status) {
            if (confirm(`Are you sure you want to ${status === 'published' ? 'publish' : 'unpublish'} this post?`)) {
                document.getElementById('statusInput').value = status;
                document.getElementById('statusForm').submit();
            }
        }

        function deletePost() {
            if (confirm('Are you sure you want to delete this post? This action cannot be undone.')) {
                document.getElementById('deleteForm').submit();
            }
        }
    </script>
@endpush
