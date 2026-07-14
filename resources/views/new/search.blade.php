@extends('new.layouts.sidebar')

@push('seo')
    {!! \App\Helpers\SeoHelper::meta('Search Results' . (empty($query) ? '' : ' for "' . $query . '"'), 'Search results for your queries on our site. Find services, industries, blogs, and insights.', 'search, query') !!}
@endpush

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <div class="search-header mb-4">
                    <h1 class="display-5 font-weight-bold">Search Results</h1>
                    <div class="search-form mt-3">
                        <form method="GET" action="{{ route('search.page') }}" class="d-flex">
                            <input type="text" name="q" value="{{ $query }}"
                                class="form-control form-control-lg me-2"
                                placeholder="Search for services, industries, insights..." style="border-radius: 25px;">
                            <button type="submit" class="btn btn-primary btn-lg px-4" style="border-radius: 25px;">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <div id="search-results">
                    @if (!empty($query))
                        <div class="text-center">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <p class="mt-2">Searching for "{{ $query }}"...</p>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-search fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">Enter a search term to get started</h4>
                            <p class="text-muted">Search through our services, industries, insights, blogs, events, and
                                career opportunities.</p>
                        </div>
                    @endif
                </div>

                <div id="search-content" style="display: none;">
                    <!-- Results will be populated here -->
                </div>
            </div>
        </div>
    </div>

    <style>
        .search-result-item {
            border: 1px solid #e9ecef;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
            background: white;
        }

        .search-result-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-color: #007bff;
        }

        .search-result-category {
            background: #007bff;
            color: white;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            display: inline-block;
            margin-bottom: 10px;
        }

        .search-result-title {
            color: #333;
            font-weight: 600;
            margin-bottom: 8px;
            text-decoration: none;
        }

        .search-result-title:hover {
            color: #007bff;
            text-decoration: none;
        }

        .search-result-description {
            color: #666;
            margin-bottom: 0;
            line-height: 1.5;
        }

        .search-result-icon {
            color: #007bff;
            margin-right: 10px;
            width: 20px;
        }

        .no-results {
            text-align: center;
            padding: 40px 20px;
            color: #666;
        }

        .search-stats {
            color: #666;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const query = '{{ $query }}';
            if (query && query.length >= 2) {
                performSearch(query);
            }
        });

        function performSearch(query) {
            const resultsContainer = document.getElementById('search-results');
            const contentContainer = document.getElementById('search-content');

            fetch(`/api/search?q=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    resultsContainer.style.display = 'none';
                    contentContainer.style.display = 'block';

                    if (data.success && data.results.length > 0) {
                        displayResults(data);
                    } else {
                        displayNoResults(query);
                    }
                })
                .catch(error => {
                    console.error('Search error:', error);
                    resultsContainer.style.display = 'none';
                    contentContainer.style.display = 'block';
                    contentContainer.innerHTML = `
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    An error occurred while searching. Please try again.
                </div>
            `;
                });
        }

        function displayResults(data) {
            const contentContainer = document.getElementById('search-content');

            let resultsHtml = `
        <div class="search-stats">
            Found ${data.total_results} results for "${data.query}"
        </div>
    `;

            data.results.forEach(result => {
                resultsHtml += `
            <div class="search-result-item">
                <span class="search-result-category">${result.category}</span>
                <div class="d-flex align-items-start">
                    <i class="${result.icon} search-result-icon"></i>
                    <div class="flex-grow-1">
                        <a href="${result.url}" class="search-result-title h5">${result.title}</a>
                        <p class="search-result-description">${result.description}</p>
                    </div>
                </div>
            </div>
        `;
            });

            contentContainer.innerHTML = resultsHtml;
        }

        function displayNoResults(query) {
            const contentContainer = document.getElementById('search-content');
            contentContainer.innerHTML = `
        <div class="no-results">
            <i class="fas fa-search fa-3x text-muted mb-3"></i>
            <h4>No results found for "${query}"</h4>
            <p>Try searching with different keywords or check the spelling.</p>
            <div class="mt-4">
                <h6>Search suggestions:</h6>
                <ul class="list-unstyled">
                    <li><a href="/services" class="text-decoration-none">Browse all Services</a></li>
                    <li><a href="/industries" class="text-decoration-none">Browse all Industries</a></li>
                    <li><a href="/insights" class="text-decoration-none">Browse all Insights</a></li>
                    <li><a href="/blogs" class="text-decoration-none">Browse all Blogs</a></li>
                </ul>
            </div>
        </div>
    `;
        }
    </script>
@endsection
