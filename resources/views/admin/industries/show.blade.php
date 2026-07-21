@extends('admin.layouts.app')

@section('title', 'Industry Details')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.industries.index') }}">Industries</a></li>
    <li class="breadcrumb-item active">{{ $industry->name }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">{{ $industry->title ?: $industry->name }}</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="text-muted">Industry Name</h6>
                            <p class="fw-bold">{{ $industry->name }}</p>
                        </div>
                        @if ($industry->title)
                            <div class="col-md-6">
                                <h6 class="text-muted">Display Title</h6>
                                <p>{{ $industry->title }}</p>
                            </div>
                        @endif
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="text-muted">Slug</h6>
                            <p><code>{{ $industry->slug }}</code></p>
                        </div>
                        @if ($industry->category)
                            <div class="col-md-6">
                                <h6 class="text-muted">Category</h6>
                                <span class="badge bg-secondary">{{ $industry->category }}</span>
                            </div>
                        @endif
                    </div>

                    @if ($industry->description)
                        <div class="mb-4">
                            <h6 class="text-muted">Brief Description</h6>
                            <div class="bg-light p-3 rounded">
                                {{ $industry->description }}
                            </div>
                        </div>
                    @endif

                    @if ($industry->content)
                        <div class="mb-4">
                            <h6 class="text-muted">Detailed Content (Summernote)</h6>
                            <div class="bg-light p-3 rounded note-editable">
                                {!! $industry->content !!}
                            </div>
                        </div>
                    @endif

                    @if ($industry->meta_title || $industry->meta_description)
                        <div class="mb-4">
                            <h6 class="text-muted">SEO Information</h6>
                            @if ($industry->meta_title)
                                <p class="mb-1"><strong>Meta Title:</strong> {{ $industry->meta_title }}</p>
                            @endif
                            @if ($industry->meta_description)
                                <p class="mb-0"><strong>Meta Description:</strong> {{ $industry->meta_description }}</p>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Status & Metadata -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-info-circle me-2"></i>Status & Metadata
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold text-muted">Status</label>
                            <p class="mb-0">
                                @if ($industry->status === 'active')
                                    <span class="badge bg-success fs-6">
                                        <i class="fas fa-check-circle me-1"></i>Active
                                    </span>
                                @else
                                    <span class="badge bg-secondary fs-6">
                                        <i class="fas fa-pause-circle me-1"></i>Inactive
                                    </span>
                                @endif
                            </p>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold text-muted">Sort Order</label>
                            <p class="mb-0">{{ $industry->sort_order }}</p>
                        </div>

                        @if ($industry->is_featured)
                            <div class="col-12">
                                <span class="badge bg-warning fs-6 text-dark">
                                    <i class="fas fa-star me-1"></i>Featured Industry
                                </span>
                            </div>
                        @endif

                        <div class="col-12">
                            <label class="form-label fw-semibold text-muted">Created</label>
                            <p class="mb-0 small text-muted">{{ $industry->created_at->format('M d, Y \a\t g:i A') }}</p>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold text-muted">Last Updated</label>
                            <p class="mb-0 small text-muted">{{ $industry->updated_at->format('M d, Y \a\t g:i A') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Featured Image -->
            @if ($industry->featured_image)
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom py-3">
                        <h5 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-image me-2"></i>Featured Image
                        </h5>
                    </div>
                    <div class="card-body p-4 text-center">
                        <img src="{{ Storage::url($industry->featured_image) }}" alt="{{ $industry->name }}"
                            class="img-fluid rounded shadow-sm" style="max-height: 200px;">
                    </div>
                </div>
            @endif

            <!-- Action Buttons -->
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.industries.edit', $industry) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>Edit Industry
                        </a>

                        <a href="{{ route('admin.industries.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-list me-2"></i>All Industries
                        </a>

                        @if ($industry->status === 'active')
                            <a href="{{ route('industryDetails', $industry->slug) }}" class="btn btn-outline-info" target="_blank">
                                <i class="fas fa-external-link-alt me-2"></i>View on Website
                            </a>
                        @endif

                        <hr class="my-3">

                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                            data-bs-target="#deleteModal">
                            <i class="fas fa-trash me-2"></i>Delete Industry
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Industry</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">Are you sure you want to delete the industry "<strong>{{ $industry->name }}</strong>"?</p>
                    <p class="text-danger small mt-2 mb-0">This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form method="POST" action="{{ route('admin.industries.destroy', $industry) }}" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete Industry</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
