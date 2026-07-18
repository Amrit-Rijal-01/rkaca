@extends('admin.layouts.app')

@section('title', 'Events')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item active">Events</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">All Events</h5>
                <a href="{{ route('admin.events.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add New Event
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
                    <table class="table table-striped" id="eventsTable">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th>Featured</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($events as $event)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <strong>{{ $event->title }}</strong>
                                            <br>
                                            <small class="text-muted">{{ Str::limit($event->short_description, 80) }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($event->type)
                                        <span class="badge bg-info">{{ ucfirst($event->type) }}</span>
                                    @else
                                        <span class="text-muted">No type</span>
                                    @endif
                                </td>
                                <td>
                                    @if($event->location)
                                        <i class="fas fa-map-marker-alt text-muted"></i> {{ $event->location }}
                                    @else
                                        <span class="text-muted">No location</span>
                                    @endif
                                </td>
                                <td>
                                    @if($event->status === 'active')
                                        <span class="badge bg-success">Active</span>
                                    @elseif($event->status === 'draft')
                                        <span class="badge bg-warning">Draft</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    @if($event->is_featured)
                                        <span class="badge bg-primary">
                                            <i class="fas fa-star"></i> Featured
                                        </span>
                                    @else
                                        <span class="text-muted">No</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.events.show', $event) }}" class="btn btn-sm btn-outline-info" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this event?')">
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
    $('#eventsTable').DataTable({
        responsive: true,
        order: [[3, 'desc']],
        columnDefs: [
            { orderable: false, targets: [5] }
        ]
    });
});
</script>
@endpush
