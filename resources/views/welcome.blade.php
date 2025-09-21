<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'E-Commerce Platform') }} - Welcome</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <style>
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 100px 0;
        }
        .feature-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            border-radius: 15px;
        }
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        .stats-section {
            background: #f8f9fa;
            padding: 80px 0;
        }
        .stat-item {
            text-align: center;
            padding: 30px;
        }
        .stat-number {
            font-size: 3rem;
            font-weight: bold;
            color: #667eea;
        }
        .cta-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 80px 0;
        }
        .btn-custom {
            padding: 15px 30px;
            font-size: 1.1rem;
            border-radius: 50px;
            transition: all 0.3s ease;
        }
        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }
        .section-title {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 2rem;
            text-align: center;
        }
        .section-subtitle {
            font-size: 1.2rem;
            color: #6c757d;
            text-align: center;
            margin-bottom: 3rem;
        }
    </style>
</head>
<body>
    <div id="app">
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
            <div class="container">
                <a class="navbar-brand text-primary" href="{{ url('/') }}">
                    <i class="bi bi-shop me-2"></i>E-Commerce Platform
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('categories.index') }}">
                                <i class="bi bi-grid me-1"></i>Categories
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('subcategories.index') }}">
                                <i class="bi bi-collection me-1"></i>Subcategories
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('products.index') }}">
                                <i class="bi bi-box-seam me-1"></i>Products
                            </a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="hero-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h1 class="display-4 fw-bold mb-4">Welcome to Our E-Commerce Platform</h1>
                        <p class="lead mb-4">A comprehensive Laravel-based e-commerce solution with full CRUD operations for categories, subcategories, and products. Manage your inventory with ease and style.</p>
                        <div class="d-flex gap-3 flex-wrap">
                            <a href="{{ route('products.index') }}" class="btn btn-light btn-custom">
                                <i class="bi bi-eye me-2"></i>View Products
                            </a>
                            <a href="{{ route('categories.index') }}" class="btn btn-outline-light btn-custom">
                                <i class="bi bi-plus-circle me-2"></i>Manage Categories
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 text-center">
                        <i class="bi bi-shop display-1 text-white-50"></i>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="py-5">
            <div class="container">
                <h2 class="section-title">Platform Features</h2>
                <p class="section-subtitle">Everything you need to manage your e-commerce business</p>
                
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6">
                        <div class="card feature-card h-100">
                            <div class="card-body text-center p-4">
                                <div class="mb-3">
                                    <i class="bi bi-grid-3x3-gap text-primary" style="font-size: 3rem;"></i>
                                </div>
                                <h5 class="card-title">Category Management</h5>
                                <p class="card-text">Organize your products with a hierarchical category system. Create, edit, and manage categories with ease.</p>
                                <a href="{{ route('categories.index') }}" class="btn btn-outline-primary">Manage Categories</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-6">
                        <div class="card feature-card h-100">
                            <div class="card-body text-center p-4">
                                <div class="mb-3">
                                    <i class="bi bi-collection text-success" style="font-size: 3rem;"></i>
                                </div>
                                <h5 class="card-title">Subcategory System</h5>
                                <p class="card-text">Create detailed subcategories under main categories for better product organization and navigation.</p>
                                <a href="{{ route('subcategories.index') }}" class="btn btn-outline-success">Manage Subcategories</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-6">
                        <div class="card feature-card h-100">
                            <div class="card-body text-center p-4">
                                <div class="mb-3">
                                    <i class="bi bi-box-seam text-warning" style="font-size: 3rem;"></i>
                                </div>
                                <h5 class="card-title">Product Management</h5>
                                <p class="card-text">Complete product management with images, pricing, descriptions, and detailed categorization.</p>
                                <a href="{{ route('products.index') }}" class="btn btn-outline-warning">Manage Products</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="stats-section">
            <div class="container">
                <h2 class="section-title">Platform Statistics</h2>
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="stat-item">
                            <div class="stat-number">{{ \App\Models\Category::count() }}</div>
                            <div class="stat-label">Categories</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="stat-item">
                            <div class="stat-number">{{ \App\Models\Subcategory::count() }}</div>
                            <div class="stat-label">Subcategories</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="stat-item">
                            <div class="stat-number">{{ \App\Models\Product::count() }}</div>
                            <div class="stat-label">Products</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="stat-item">
                            <div class="stat-number">{{ \App\Models\Image::count() }}</div>
                            <div class="stat-label">Images</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-dark text-white py-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <h5><i class="bi bi-shop me-2"></i>E-Commerce Platform</h5>
                        <p class="text-light">A modern Laravel-based e-commerce solution built with modern web technologies.</p>
                    </div>
                    <div class="col-lg-6">
                        <h6 class="text-white">Quick Links</h6>
                        <div class="d-flex flex-wrap gap-3">
                            <a href="{{ route('categories.index') }}" class="text-light text-decoration-none">Categories</a>
                            <a href="{{ route('subcategories.index') }}" class="text-light text-decoration-none">Subcategories</a>
                            <a href="{{ route('products.index') }}" class="text-light text-decoration-none">Products</a>
                        </div>
                    </div>
                </div>
                <hr class="my-4">
                <div class="text-center text-light">
                    <p>&copy; {{ date('Y') }} E-Commerce Platform.</p>
                </div>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>