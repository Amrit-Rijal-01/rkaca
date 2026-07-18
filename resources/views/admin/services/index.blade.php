@extends('admin.layouts.app')

@section('title', 'Services')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item active">Services</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">All Services</h5>
                <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add New Service
                </a>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-striped" id="servicesTable">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Type</th>
                                <th>Parent Service</th>
                                <th>Status</th>
                                <th>Featured</th>
                                <th>Sort Order</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($services as $service)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">

                                        <div>
                                            <strong>{{ $service->title }}</strong>
                                            <br>
                                            <small class="text-muted">{{ Str::limit($service->description, 50) }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($service->category)
                                        <span class="badge bg-secondary">{{ ucfirst($service->category) }}</span>
                                    @else
                                        <span class="text-muted">No category</span>
                                    @endif
                                </td>
                                <td>
                                    @if($service->is_sub_service)
                                        <span class="badge bg-warning text-dark">Sub-Service</span>
                                    @else
                                        <span class="badge bg-info">Main Service</span>
                                    @endif
                                </td>
                                <td>
                                    @if($service->is_sub_service && $service->parent)
                                        <a href="{{ route('admin.services.show', $service->parent->id) }}">{{ $service->parent->title }}</a>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td>
                                    @if($service->status === 'active')
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    @if($service->is_featured)
                                        <span class="badge bg-primary">
                                            <i class="fas fa-star"></i> Featured
                                        </span>
                                    @else
                                        <span class="text-muted">No</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark">{{ $service->sort_order ?? 0 }}</span>
                                </td>
                                <td>{{ $service->created_at->format('M d, Y') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.services.show', $service) }}" class="btn btn-sm btn-outline-info" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this service?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#servicesTable').DataTable({
        responsive: true,
        order: [[6, 'asc']], // Sort by sort order
        columnDefs: [
            { orderable: false, targets: [8] } // Disable sorting on actions column
        ]
    });
});
</script>
@endpush
