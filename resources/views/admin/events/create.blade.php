@extends('admin.layouts.app')

@section('title', 'Create Event')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.events.index') }}">Events</a></li>
    <li class="breadcrumb-item active">Create Event</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Create New Event</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
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
                                    <label for="short_description" class="form-label">Event Summary <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description" name="short_description"
                                        rows="3" required>{{ old('short_description') }}</textarea>
                                    <div class="form-text">Brief summary for previews and listings</div>
                                    @error('short_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="pdf_file" class="form-label">PDF Document</label>
                                    <input type="file" class="form-control @error('pdf_file') is-invalid @enderror"
                                        id="pdf_file" name="pdf_file" accept=".pdf,application/pdf">
                                    <div class="form-text">Upload a PDF document for the event content</div>
                                    @error('pdf_file')
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
                                    <label for="type" class="form-label">Event Type</label>
                                    <select class="form-select @error('type') is-invalid @enderror" id="type"
                                        name="type">
                                        <option value="">Select Type</option>
                                        <option value="webinar" {{ old('type') === 'webinar' ? 'selected' : '' }}>Webinar
                                        </option>
                                        <option value="conference" {{ old('type') === 'conference' ? 'selected' : '' }}>
                                            Conference</option>
                                        <option value="workshop" {{ old('type') === 'workshop' ? 'selected' : '' }}>
                                            Workshop</option>
                                        <option value="seminar" {{ old('type') === 'seminar' ? 'selected' : '' }}>Seminar
                                        </option>
                                        <option value="networking" {{ old('type') === 'networking' ? 'selected' : '' }}>
                                            Networking</option>
                                        <option value="other" {{ old('type') === 'other' ? 'selected' : '' }}>Other
                                        </option>
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="start_date" class="form-label">Event Start Date <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                                        id="event_date" name="start_date" value="{{ old('start_date') }}" required>
                                    @error('start_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="end_date" class="form-label">Event End Date <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                                        id="end_date" name="end_date" value="{{ old('end_date') }}" required>
                                    @error('end_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="start_time" class="form-label">Event Start Time <span
                                            class="text-danger">*</span></label>
                                    <input type="time" class="form-control @error('start_time') is-invalid @enderror"
                                        id="event_date" name="start_time" value="{{ old('start_time') }}" required>
                                    @error('start_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="end_time" class="form-label">Event End Time <span
                                            class="text-danger">*</span></label>
                                    <input type="time" class="form-control @error('end_time') is-invalid @enderror"
                                        id="event_date" name="end_time" value="{{ old('end_time') }}" required>
                                    @error('end_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>




                                <div class="mb-3">
                                    <label for="location" class="form-label">Location</label>
                                    <input type="text" class="form-control @error('location') is-invalid @enderror"
                                        id="location" name="location" value="{{ old('location') }}">
                                    @error('location')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="registration_url" class="form-label">Registration URL</label>
                                    <input type="url"
                                        class="form-control @error('registration_url') is-invalid @enderror"
                                        id="registration_url" name="registration_url"
                                        value="{{ old('registration_url') }}">
                                    @error('registration_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="featured_image" class="form-label">Featured Image</label>
                                    <input type="file"
                                        class="form-control @error('featured_image') is-invalid @enderror"
                                        id="featured_image" name="featured_image" accept="image/*">
                                    @error('featured_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_featured"
                                            name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_featured">
                                            Featured Event
                                        </label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="meta_title" class="form-label">Meta Title</label>
                                    <input type="text" class="form-control @error('meta_title') is-invalid @enderror"
                                        id="meta_title" name="meta_title" value="{{ old('meta_title') }}">
                                    @error('meta_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
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
                                    <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Back to Events
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Create Event
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
    </script>
@endpush
