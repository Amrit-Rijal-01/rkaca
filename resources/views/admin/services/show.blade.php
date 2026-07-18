@extends('admin.layouts.app')

@section('title', 'View Service')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.services.index') }}">Services</a></li>
<li class="breadcrumb-item active">{{ $service->title }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">{{ $service->title }}</h5>
                    <div>
                        <span class="badge bg-{{ $service->status === 'active' ? 'success' : 'secondary' }}">
                            {{ ucfirst($service->status) }}
                        </span>
                        @if($service->is_featured ?? false)
                            <span class="badge bg-primary">Featured</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        @if($service->featured_image)
                            <div class="mb-4">
                                <img src="{{ Storage::url($service->featured_image) }}" alt="{{ $service->title }}"
                                     class="img-fluid rounded" style="max-height: 400px; width: 100%; object-fit: cover;">
                            </div>
                        @endif

                        <div class="mb-4">
                            <h6 class="text-muted mb-2">Service Description</h6>
                            <p class="lead">{{ $service->description }}</p>
                        </div>

                        @if($service->content)
                            <div class="mb-4">
                                <h6 class="text-muted mb-2">Detailed Content</h6>
                                <div class="border rounded p-3" style="background-color: #f8f9fa;">
                                    {!! nl2br(e($service->content)) !!}
                                </div>
                            </div>
                        @endif

                        @if($service->features && is_array($service->features))
                            <div class="mb-4">
                                <h6 class="text-muted mb-2">Key Features</h6>
                                <div class="border rounded p-3" style="background-color: #f0f8ff;">
                                    <ul class="mb-0">
                                        @foreach($service->features as $feature)
                                            <li>{{ $feature }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        @if($service->subServices && $service->subServices->isNotEmpty())
                            <div class="mb-4">
                                <h6 class="text-muted mb-2">Child Sub-Services</h6>
                                <div class="border rounded p-3" style="background-color: #f8f9ff;">
                                    <ul class="mb-0">
                                        @foreach($service->subServices as $subService)
                                            <li class="mb-2">
                                                <a href="{{ route('admin.services.show', $subService->id) }}"><strong>{{ $subService->title }}</strong></a> 
                                                <span class="badge bg-{{ $subService->status === 'active' ? 'success' : 'secondary' }} btn-sm">{{ ucfirst($subService->status) }}</span>
                                                <p class="text-muted mb-0 small">{{ $subService->description }}</p>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        @if($service->benefits && is_array($service->benefits))
                            <div class="mb-4">
                                <h6 class="text-muted mb-2">Benefits</h6>
                                <div class="border rounded p-3" style="background-color: #f5f5f5;">
                                    <ul class="mb-0">
                                        @foreach($service->benefits as $benefit)
                                            <li>{{ $benefit }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Service Details</h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-borderless table-sm">
                                    <tr>
                                        <td><strong>Category:</strong></td>
                                        <td>
                                            @if($service->category ?? false)
                                                <span class="badge bg-info">{{ ucfirst(str_replace('-', ' ', $service->category)) }}</span>
                                            @else
                                                <span class="text-muted">Not categorized</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Type:</strong></td>
                                        <td>
                                            @if($service->is_sub_service)
                                                <span class="badge bg-warning text-dark">Sub-Service</span>
                                            @else
                                                <span class="badge bg-info">Main Service</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @if($service->is_sub_service)
                                    <tr>
                                        <td><strong>Parent Service:</strong></td>
                                        <td>
                                            @if($service->parent)
                                                <a href="{{ route('admin.services.show', $service->parent->id) }}">{{ $service->parent->title }}</a>
                                            @else
                                                <span class="text-muted">None</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td><strong>Starting Price:</strong></td>
                                        <td>{{ $service->price ?? 'Contact for quote' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Duration:</strong></td>
                                        <td>{{ $service->duration ?? 'Varies' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Sort Order:</strong></td>
                                        <td>{{ $service->sort_order ?? 0 }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Icon:</strong></td>
                                        <td>
                                            @if($service->icon)
                                                <i class="{{ $service->icon }} me-2"></i>{{ $service->icon }}
                                            @else
                                                <span class="text-muted">No icon</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Created:</strong></td>
                                        <td>{{ $service->created_at->format('M d, Y g:i A') }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Updated:</strong></td>
                                        <td>{{ $service->updated_at->format('M d, Y g:i A') }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Slug:</strong></td>
                                        <td><code>{{ $service->slug }}</code></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        @if($service->meta_title ?? $service->meta_description ?? false)
                            <div class="card mt-3">
                                <div class="card-header">
                                    <h6 class="card-title mb-0">SEO Information</h6>
                                </div>
                                <div class="card-body">
                                    @if($service->meta_title ?? false)
                                        <div class="mb-3">
                                            <strong>Meta Title:</strong><br>
                                            <small class="text-muted">{{ $service->meta_title }}</small>
                                        </div>
                                    @endif
                                    @if($service->meta_description ?? false)
                                        <div>
                                            <strong>Meta Description:</strong><br>
                                            <small class="text-muted">{{ $service->meta_description }}</small>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <hr>
                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Services
                    </a>
                    <div>
                        <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Edit Service
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
                <p>Are you sure you want to delete this service?</p>
                <p><strong>{{ $service->title }}</strong></p>
                <p class="text-muted">This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('admin.services.destroy', $service) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Service</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
