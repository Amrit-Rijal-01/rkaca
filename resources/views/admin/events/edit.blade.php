@extends('admin.layouts.app')

@section('title', 'Edit Event')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.events.index') }}">Events</a></li>
    <li class="breadcrumb-item active">Edit Event</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Edit Event: {{ $event->title }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.events.update', $event) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Event Title <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        id="title" name="title" value="{{ old('title', $event->title) }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="slug" class="form-label">Slug</label>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                        id="slug" name="slug" value="{{ old('slug', $event->slug) }}">
                                    <div class="form-text">Leave empty to auto-generate from title</div>
                                    @error('slug')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="short_description" class="form-label">Event Summary <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description" name="short_description"
                                        rows="3" required>{{ old('short_description', $event->short_description) }}</textarea>
                                    <div class="form-text">Brief summary for previews and listings</div>
                                    @error('short_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="pdf_file" class="form-label">PDF Document</label>
                                    @if ($event->pdf_file)
                                        <div class="mb-2">
                                            <a href="{{ Storage::url($event->pdf_file) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-file-pdf me-1"></i> View Current PDF
                                            </a>
                                            <div class="form-text">Current PDF file</div>
                                        </div>
                                    @endif
                                    <input type="file" class="form-control @error('pdf_file') is-invalid @enderror"
                                        id="pdf_file" name="pdf_file" accept=".pdf,application/pdf">
                                    <div class="form-text">Upload a new PDF to replace the current one</div>
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
                                        <option value="draft"
                                            {{ old('status', $event->status) === 'draft' ? 'selected' : '' }}>Draft
                                        </option>
                                        <option value="active"
                                            {{ old('status', $event->status) === 'active' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="inactive"
                                            {{ old('status', $event->status) === 'inactive' ? 'selected' : '' }}>Inactive
                                        </option>
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
                                        <option value="conference"
                                            {{ old('type', $event->type) === 'conference' ? 'selected' : '' }}>Conference
                                        </option>
                                        <option value="workshop"
                                            {{ old('type', $event->type) === 'workshop' ? 'selected' : '' }}>Workshop
                                        </option>
                                        <option value="seminar"
                                            {{ old('type', $event->type) === 'seminar' ? 'selected' : '' }}>Seminar
                                        </option>
                                        <option value="webinar"
                                            {{ old('type', $event->type) === 'webinar' ? 'selected' : '' }}>Webinar
                                        </option>
                                        <option value="networking"
                                            {{ old('type', $event->type) === 'networking' ? 'selected' : '' }}>Networking
                                        </option>
                                        <option value="training"
                                            {{ old('type', $event->type) === 'training' ? 'selected' : '' }}>Training
                                        </option>
                                        <option value="other"
                                            {{ old('type', $event->type) === 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="start_date" class="form-label">Event Start Date <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                                        id="event_date" name="start_date" value="{{ old('start_date', $event->start_date ? $event->start_date->format('Y-m-d') : '') }}" required>
                                    @error('start_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="end_date" class="form-label">Event End Date <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                                        id="end_date" name="end_date" value="{{ old('end_date', $event->end_date ? $event->end_date->format('Y-m-d') : '') }}" required>
                                    @error('end_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="start_time" class="form-label">Event Start Time <span
                                            class="text-danger">*</span></label>
                                    <input type="time" class="form-control @error('start_time') is-invalid @enderror"
                                        id="event_date" name="start_time" value="{{ old('start_time', $event->start_time ? $event->start_time->format('H:i') : '') }}" required>
                                    @error('start_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="end_time" class="form-label">Event End Time <span
                                            class="text-danger">*</span></label>
                                    <input type="time" class="form-control @error('end_time') is-invalid @enderror"
                                        id="event_date" name="end_time" value="{{ old('end_time', $event->end_time ? $event->end_time->format('H:i') : '') }}" required>
                                    @error('end_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="location" class="form-label">Location</label>
                                    <input type="text" class="form-control @error('location') is-invalid @enderror"
                                        id="location" name="location" value="{{ old('location', $event->location) }}">
                                    @error('location')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="venue" class="form-label">Venue</label>
                                    <input type="text" class="form-control @error('venue') is-invalid @enderror"
                                        id="venue" name="venue" value="{{ old('venue', $event->venue) }}">
                                    @error('venue')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="max_attendees" class="form-label">Max Attendees</label>
                                    <input type="number"
                                        class="form-control @error('max_attendees') is-invalid @enderror"
                                        id="max_attendees" name="max_attendees"
                                        value="{{ old('max_attendees', $event->max_attendees) }}" min="1">
                                    @error('max_attendees')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror"
                                        id="price" name="price" value="{{ old('price', $event->price) }}"
                                        step="0.01" min="0">
                                    <div class="form-text">Leave empty for free events</div>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="registration_url" class="form-label">Registration URL</label>
                                    <input type="url"
                                        class="form-control @error('registration_url') is-invalid @enderror"
                                        id="registration_url" name="registration_url"
                                        value="{{ old('registration_url', $event->registration_url) }}">
                                    @error('registration_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="contact_email" class="form-label">Contact Email</label>
                                    <input type="email"
                                        class="form-control @error('contact_email') is-invalid @enderror"
                                        id="contact_email" name="contact_email"
                                        value="{{ old('contact_email', $event->contact_email) }}">
                                    @error('contact_email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="featured_image" class="form-label">Featured Image</label>
                                    @if ($event->featured_image)
                                        <div class="mb-2">
                                            <img src="{{ Storage::url($event->featured_image) }}" alt="Current Image"
                                                class="img-thumbnail" style="max-width: 200px;">
                                            <div class="form-text">Current image</div>
                                        </div>
                                    @endif
                                    <input type="file"
                                        class="form-control @error('featured_image') is-invalid @enderror"
                                        id="featured_image" name="featured_image" accept="image/*">
                                    <div class="form-text">Upload a new image to replace the current one</div>
                                    @error('featured_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_featured"
                                            name="is_featured" value="1"
                                            {{ old('is_featured', $event->is_featured) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_featured">
                                            Featured Event
                                        </label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_virtual"
                                            name="is_virtual" value="1"
                                            {{ old('is_virtual', $event->is_virtual) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_virtual">
                                            Virtual Event
                                        </label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="meta_title" class="form-label">Meta Title</label>
                                    <input type="text" class="form-control @error('meta_title') is-invalid @enderror"
                                        id="meta_title" name="meta_title"
                                        value="{{ old('meta_title', $event->meta_title) }}">
                                    @error('meta_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="meta_description" class="form-label">Meta Description</label>
                                    <textarea class="form-control @error('meta_description') is-invalid @enderror" id="meta_description"
                                        name="meta_description" rows="3">{{ old('meta_description', $event->meta_description) }}</textarea>
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
                                    <div>
                                        <a href="{{ route('admin.events.show', $event) }}" class="btn btn-info me-2">
                                            <i class="fas fa-eye"></i> View Event
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save"></i> Update Event
                                        </button>
                                    </div>
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
