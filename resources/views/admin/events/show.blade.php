@extends('admin.layouts.app')

@section('title', 'Event Details')
@section('page-title', 'Event Details')

@section('page-actions')
    <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-warning">
        <i class="fas fa-edit me-2"></i>Edit Event
    </a>
    <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i>Back to Events
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-calendar-alt me-2"></i>Event Information
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <h6 class="text-primary fw-bold mb-3">Basic Information</h6>

                            <div class="mb-3">
                                <strong class="text-dark d-block mb-1">Title:</strong>
                                <p class="text-muted mb-0">{{ $event->title }}</p>
                            </div>

                            <div class="mb-3">
                                <strong class="text-dark d-block mb-1">Status:</strong>
                                <span class="badge bg-{{ $event->status === 'active' ? 'success' : ($event->status === 'draft' ? 'warning' : 'danger') }} px-3 py-2">
                                    {{ ucfirst($event->status) }}
                                </span>
                            </div>

                            <div class="mb-3">
                                <strong class="text-dark d-block mb-1">Location:</strong>
                                <p class="text-muted mb-0">
                                    <i class="fas fa-map-marker-alt me-1"></i>{{ $event->location ?: 'Not specified' }}
                                </p>
                            </div>

                            @if($event->capacity)
                            <div class="mb-3">
                                <strong class="text-dark d-block mb-1">Capacity:</strong>
                                <p class="text-muted mb-0">
                                    <i class="fas fa-users me-1"></i>{{ number_format($event->capacity) }} attendees
                                </p>
                            </div>
                            @endif

                            @if($event->price)
                            <div class="mb-3">
                                <strong class="text-dark d-block mb-1">Price:</strong>
                                <p class="text-muted mb-0">
                                    <i class="fas fa-dollar-sign me-1"></i>${{ number_format($event->price, 2) }}
                                </p>
                            </div>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <h6 class="text-primary fw-bold mb-3">Schedule</h6>

                            <div class="mb-3">
                                <strong class="text-dark d-block mb-1">Event Date:</strong>
                                <p class="text-muted mb-0">
                                    <i class="fas fa-calendar me-1"></i>{{ $event->event_date ? $event->event_date->format('F j, Y') : 'Not scheduled' }}
                                </p>
                            </div>

                            @if($event->start_time)
                            <div class="mb-3">
                                <strong class="text-dark d-block mb-1">Start Time:</strong>
                                <p class="text-muted mb-0">
                                    <i class="fas fa-clock me-1"></i>{{ $event->start_time->format('g:i A') }}
                                </p>
                            </div>
                            @endif

                            @if($event->end_time)
                            <div class="mb-3">
                                <strong class="text-dark d-block mb-1">End Time:</strong>
                                <p class="text-muted mb-0">
                                    <i class="fas fa-clock me-1"></i>{{ $event->end_time->format('g:i A') }}
                                </p>
                            </div>
                            @endif

                            <div class="mb-3">
                                <strong class="text-dark d-block mb-1">Created:</strong>
                                <p class="text-muted mb-0">
                                    <i class="fas fa-calendar-plus me-1"></i>{{ $event->created_at->format('F j, Y \a\t g:i A') }}
                                </p>
                            </div>

                            <div class="mb-3">
                                <strong class="text-dark d-block mb-1">Last Updated:</strong>
                                <p class="text-muted mb-0">
                                    <i class="fas fa-edit me-1"></i>{{ $event->updated_at->format('F j, Y \a\t g:i A') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    @if($event->pdf_file)
                    <div class="mt-4">
                        <h6 class="text-primary fw-bold mb-3">
                            <i class="fas fa-file-pdf text-danger me-1"></i>PDF Document
                        </h6>
                        <div class="mb-3" style="height: 85vh; min-height: 500px; border: 1px solid #dee2e6; border-radius: 0.375rem; overflow: hidden; background: #fff;">
                            <iframe src="{{ Storage::url($event->pdf_file) }}" width="100%" height="100%" style="border: none;"></iframe>
                        </div>
                        <div class="text-center mt-2">
                            <a href="{{ Storage::url($event->pdf_file) }}" target="_blank" class="btn btn-outline-primary">
                                <i class="fas fa-file-download me-2"></i>Download PDF Document
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            @if($event->image)
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Event Image</h6>
                </div>
                <div class="card-body p-0">
                    <img src="{{ Storage::url($event->image) }}"
                         alt="{{ $event->title }}"
                         class="img-fluid w-100"
                         style="max-height: 300px; object-fit: cover;">
                </div>
            </div>
            @endif

            <!-- Actions Card -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-cogs me-2"></i>Actions
                    </h6>
                </div>
                <div class="card-body p-4">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>Edit Event
                        </a>

                        @if($event->status === 'draft')
                        <form method="POST" action="{{ route('admin.events.update', $event) }}" class="d-inline">
                            @csrf
                            @method('PUT')
                            @foreach($event->toArray() as $key => $value)
                                @if($key !== 'status' && !is_array($value))
                                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                @endif
                            @endforeach
                            <input type="hidden" name="status" value="published">
                            <button type="submit" class="btn btn-success w-100">
                                <i class="fas fa-eye me-2"></i>Publish Event
                            </button>
                        </form>
                        @elseif($event->status === 'published')
                        <form method="POST" action="{{ route('admin.events.update', $event) }}" class="d-inline">
                            @csrf
                            @method('PUT')
                            @foreach($event->toArray() as $key => $value)
                                @if($key !== 'status' && !is_array($value))
                                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                @endif
                            @endforeach
                            <input type="hidden" name="status" value="draft">
                            <button type="submit" class="btn btn-warning w-100">
                                <i class="fas fa-eye-slash me-2"></i>Unpublish Event
                            </button>
                        </form>
                        @endif

                        <form method="POST" action="{{ route('admin.events.destroy', $event) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100"
                                    onclick="return confirmDelete('Are you sure you want to delete this event?')">
                                <i class="fas fa-trash me-2"></i>Delete Event
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
