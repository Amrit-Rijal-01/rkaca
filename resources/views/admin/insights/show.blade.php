@extends('admin.layouts.app')

@section('title', 'View Insight')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.insights.index') }}">Insights</a></li>
<li class="breadcrumb-item active">{{ $insight->title }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">{{ $insight->title }}</h5>
                    <div>
                        <span class="badge bg-{{ $insight->status === 'published' ? 'success' : ($insight->status === 'draft' ? 'warning' : 'secondary') }}">
                            {{ ucfirst($insight->status) }}
                        </span>
                        @if($insight->is_featured)
                            <span class="badge bg-primary">Featured</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        @if($insight->featured_image)
                            <div class="mb-4">
                                <img src="{{ Storage::url($insight->featured_image) }}" alt="{{ $insight->title }}"
                                     class="img-fluid rounded" style="max-height: 400px; width: 100%; object-fit: cover;">
                            </div>
                        @endif

                        <div class="mb-4">
                            <h6 class="text-muted mb-2">Content Summary</h6>
                            <p class="lead">{{ $insight->summary ?? 'No summary provided.' }}</p>
                        </div>

                        <div class="mb-4">
                            <h6 class="text-muted mb-2">Full Content</h6>
                            @if ($insight->content && str_ends_with(strtolower($insight->content), '.pdf'))
                                <div class="mb-3" style="height: 85vh; min-height: 500px; border: 1px solid #dee2e6; border-radius: 0.375rem; overflow: hidden; background: #fff;">
                                    <iframe src="{{ asset('storage/' . $insight->content) }}" width="100%" height="100%" style="border: none;"></iframe>
                                </div>
                                <div class="text-center mt-2">
                                    <a href="{{ asset('storage/' . $insight->content) }}" target="_blank" class="btn btn-outline-primary">
                                        <i class="fas fa-file-download me-2"></i>Download PDF Document
                                    </a>
                                </div>
                            @else
                                <div class="border rounded p-3" style="background-color: #f8f9fa;">
                                    {!! nl2br(e($insight->content)) !!}
                                </div>
                            @endif
                        </div>

                        @if($insight->key_takeaways)
                            <div class="mb-4">
                                <h6 class="text-muted mb-2">Key Takeaways</h6>
                                <div class="border rounded p-3" style="background-color: #f0f8ff;">
                                    {!! nl2br(e($insight->key_takeaways)) !!}
                                </div>
                            </div>
                        @endif

                        @if($insight->references)
                            <div class="mb-4">
                                <h6 class="text-muted mb-2">References</h6>
                                <div class="border rounded p-3" style="background-color: #f5f5f5;">
                                    {!! nl2br(e($insight->references)) !!}
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Insight Details</h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-borderless table-sm">
                                    <tr>
                                        <td><strong>Author:</strong></td>
                                        <td>{{ $insight->author ?? 'Not specified' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Category:</strong></td>
                                        <td>
                                            @if($insight->category)
                                                <span class="badge bg-info">{{ ucfirst(str_replace('-', ' ', $insight->category)) }}</span>
                                            @else
                                                <span class="text-muted">Not categorized</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Type:</strong></td>
                                        <td>
                                            @if($insight->type)
                                                <span class="badge bg-secondary">{{ ucfirst(str_replace('-', ' ', $insight->type)) }}</span>
                                            @else
                                                <span class="text-muted">Not specified</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Reading Time:</strong></td>
                                        <td>{{ $insight->reading_time ?? 'Not calculated' }}</td>
                                    </tr>

                                    <tr>
                                        <td><strong>Published Date:</strong></td>
                                        <td>
                                            @if($insight->published_at)
                                                {{ $insight->published_at->format('M d, Y') }}
                                            @else
                                                <span class="text-muted">Not published</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Created:</strong></td>
                                        <td>{{ $insight->created_at->format('M d, Y g:i A') }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Updated:</strong></td>
                                        <td>{{ $insight->updated_at->format('M d, Y g:i A') }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Slug:</strong></td>
                                        <td><code>{{ $insight->slug }}</code></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        @if($insight->meta_title || $insight->meta_description)
                            <div class="card mt-3">
                                <div class="card-header">
                                    <h6 class="card-title mb-0">SEO Information</h6>
                                </div>
                                <div class="card-body">
                                    @if($insight->meta_title)
                                        <div class="mb-3">
                                            <strong>Meta Title:</strong><br>
                                            <small class="text-muted">{{ $insight->meta_title }}</small>
                                        </div>
                                    @endif
                                    @if($insight->meta_description)
                                        <div>
                                            <strong>Meta Description:</strong><br>
                                            <small class="text-muted">{{ $insight->meta_description }}</small>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <hr>
                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('admin.insights.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Insights
                    </a>
                    <div>
                        <a href="{{ route('admin.insights.edit', $insight) }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Edit Insight
                        </a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this insight?</p>
                <p><strong>{{ $insight->title }}</strong></p>
                <p class="text-muted">This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('admin.insights.destroy', $insight) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Insight</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
