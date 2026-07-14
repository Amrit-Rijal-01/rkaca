<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Dashboard') - {{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <style>
        :root {
            --sidebar-width: 280px;
            --sidebar-bg: #1e293b;
            --sidebar-bg-hover: #334155;
            --sidebar-text: #cbd5e1;
            --sidebar-text-active: #ffffff;
            --sidebar-accent: #3b82f6;
            --sidebar-accent-hover: #2563eb;
            --sidebar-border: #374151;
        }

        .sidebar {
            position: fixed;
            top: 56px;
            left: 0;
            width: var(--sidebar-width);
            height: calc(100vh - 56px);
            background: var(--sidebar-bg);
            border-right: 1px solid var(--sidebar-border);
            overflow-y: auto;
            transition: all 0.3s ease;
            z-index: 1000;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: var(--sidebar-bg);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: var(--sidebar-border);
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: #4b5563;
        }

        .sidebar .nav-link {
            color: var(--sidebar-text);
            padding: 0.875rem 1.5rem;
            margin: 0.125rem 0.75rem;
            border-radius: 0.75rem;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            font-weight: 500;
            border: none;
            position: relative;
            overflow: hidden;
        }

        .sidebar .nav-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 3px;
            background: var(--sidebar-accent);
            transform: scaleY(0);
            transition: transform 0.2s ease;
        }

        .sidebar .nav-link:hover {
            color: var(--sidebar-text-active);
            background: var(--sidebar-bg-hover);
            transform: translateX(2px);
        }

        .sidebar .nav-link.active {
            color: var(--sidebar-text-active);
            background: linear-gradient(135deg, var(--sidebar-accent), var(--sidebar-accent-hover));
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .sidebar .nav-link.active::before {
            transform: scaleY(1);
        }

        .sidebar .nav-link i {
            width: 20px;
            text-align: center;
            margin-right: 0.75rem;
            font-size: 1rem;
        }

        .sidebar-heading {
            color: #64748b;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 1.5rem 1.5rem 0.5rem;
            margin: 0;
            border-bottom: 1px solid var(--sidebar-border);
            margin-bottom: 0.5rem;
        }

        .sidebar-brand {
            padding: 1.5rem;
            border-bottom: 1px solid var(--sidebar-border);
            margin-bottom: 1rem;
        }

        .sidebar-brand h5 {
            color: var(--sidebar-text-active);
            margin: 0;
            font-weight: 700;
            font-size: 1.25rem;
        }

        .sidebar-brand .text-muted {
            color: var(--sidebar-text) !important;
            font-size: 0.875rem;
        }

        .nav-item .badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 10px;
            margin-left: auto;
        }

        .badge.bg-purple {
            background-color: #8b5cf6 !important;
        }

        .main-content {
            margin-left: 0;
            transition: margin-left 0.3s ease;
            min-height: calc(100vh - 56px);
            width: 100%;
            overflow-x: hidden;
        }

        @media (min-width: 768px) {
            .main-content {
                margin-left: var(--sidebar-width);
                width: calc(100% - var(--sidebar-width));
            }
        }

        @media (max-width: 767.98px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }
        }

        .card-stats {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .card-stats .card-body {
            padding: 1.5rem;
        }

        .stats-icon {
            font-size: 2.5rem;
            opacity: 0.8;
        }

        /* Additional responsive fixes */
        .container-fluid {
            padding-left: 0;
            padding-right: 0;
            max-width: 100%;
            overflow-x: hidden;
        }

        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            max-width: 100%;
            overflow-x: auto;
        }

        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        /* Content wrapper for proper padding */
        .content-wrapper {
            padding: 1rem;
            max-width: 100%;
            overflow-x: hidden;
        }

        @media (min-width: 768px) {
            .content-wrapper {
                padding: 2rem;
            }
        }

        /* Fix for horizontal scrolling */
        .row {
            margin-left: 0;
            margin-right: 0;
        }

        .col,
        .col-md-6,
        .col-lg-6,
        .col-xl-3,
        .col-xl-4,
        .col-xl-6,
        .col-xl-8,
        .col-xl-12 {
            padding-left: 0.75rem;
            padding-right: 0.75rem;
        }

        /* Responsive tables */
        .table-responsive {
            border: none;
            box-shadow: none;
        }

        /* Form improvements */
        .form-control,
        .form-select {
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--sidebar-accent);
            box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.15);
        }

        /* Button improvements */
        .btn {
            border-radius: 0.375rem;
            font-weight: 500;
            transition: all 0.2s ease-in-out;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        /* Card spacing improvements */
        .card-body {
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        /* Mobile optimizations */
        @media (max-width: 768px) {
            .d-flex.justify-content-between {
                flex-direction: column;
                gap: 1rem;
            }

            .btn-toolbar {
                flex-direction: column;
                gap: 0.5rem;
            }

            .btn-group {
                width: 100%;
            }

            .btn-group .btn {
                flex: 1;
            }
        }

        /* Hide horizontal scrollbar */
        body {
            overflow-x: hidden;
        }

        html,
        body {
            max-width: 100%;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.25rem;
        }

        .breadcrumb {
            background: none;
            padding: 0;
            margin: 0;
        }

        .breadcrumb-item a {
            text-decoration: none;
            color: #6b7280;
        }

        .breadcrumb-item a:hover {
            color: var(--sidebar-accent);
        }

        .breadcrumb-item.active {
            color: #374151;
        }

        /* Summernote Fullscreen Fix */
        .note-editor.fullscreen {
            z-index: 99999 !important;
            background-color: #ffffff !important;
        }

        .note-editor.fullscreen .note-editable {
            background-color: #ffffff !important;
        }
    </style>
    <!-- Summernote CSS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">

    @stack('styles')
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid" style="padding-left:10px;">
            <!-- Mobile sidebar toggle -->
            <button class="btn btn-outline-light d-md-none me-2" type="button" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>

            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-cogs me-2"></i>Admin Panel
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user me-1"></i>{{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('home') }}" target="_blank">
                                    <i class="fas fa-external-link-alt me-2"></i>View Site
                                </a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid" style="margin-top: 56px;">
        <div class="row">
            <!-- Sidebar -->
            <div class="sidebar d-md-block">
                @include('admin.partials.sidebar')
            </div>

            <!-- Main content -->
            <main class="main-content">
                <div class="content-wrapper">
                    <!-- Breadcrumb -->
                    @hasSection('breadcrumb')
                        <nav aria-label="breadcrumb" class="pt-3">
                            <ol class="breadcrumb">
                                @yield('breadcrumb')
                            </ol>
                        </nav>
                    @endif

                    <div
                        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        {{-- <h1 class="h2">@yield('page-title', 'Dashboard')</h1> --}}
                        <div class="btn-toolbar mb-2 mb-md-0">
                            @yield('page-actions')
                        </div>
                    </div>

                    <!-- Alert Messages -->
                    {{-- @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif --}}

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <!-- Summernote JS -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>

    <script>
        // Initialize DataTables
        $(document).ready(function() {
            $('.data-table').DataTable({
                responsive: true,
                order: [
                    [0, "desc"]
                ],
                pageLength: 25,
                scrollX: false,
                autoWidth: false,
                columnDefs: [{
                        responsivePriority: 1,
                        targets: 0
                    },
                    {
                        responsivePriority: 2,
                        targets: -1
                    },
                    {
                        responsivePriority: 3,
                        targets: 2
                    }
                ],
                language: {
                    search: "Search:",
                    lengthMenu: "Show _MENU_ entries",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    paginate: {
                        first: "First",
                        last: "Last",
                        next: "Next",
                        previous: "Previous"
                    }
                },
                dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
                    '<"row"<"col-sm-12"tr>>' +
                    '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>'
            });

            // Mobile sidebar toggle
            $('#sidebarToggle').on('click', function() {
                $('.sidebar').toggleClass('show');
            });

            // Close sidebar when clicking outside on mobile
            $(document).on('click', function(e) {
                if ($(window).width() < 768) {
                    if (!$(e.target).closest('.sidebar, #sidebarToggle').length) {
                        $('.sidebar').removeClass('show');
                    }
                }
            });
        });

        // Delete confirmation
        function confirmDelete(message = 'Are you sure you want to delete this item?') {
            return confirm(message);
        }
    </script>

    @stack('scripts')
</body>

</html>
