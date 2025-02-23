<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Admin panel</title>
    
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background-color: #f8f9fa;
        }
        .admin-sidebar {
            width: 250px;
            background: #343a40;
            min-height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            padding: 1rem;
        }
        .admin-sidebar .nav-link {
            color: rgba(255,255,255,.75);
            padding: .75rem 1rem;
            margin-bottom: .25rem;
            border-radius: .375rem;
        }
        .admin-sidebar .nav-link:hover {
            color: #fff;
            background: rgba(255,255,255,.1);
        }
        .admin-sidebar .nav-link.active {
            color: #fff;
            background: rgba(255,255,255,.1);
        }
        .admin-sidebar .nav-link i {
            width: 1.25rem;
            margin-right: .5rem;
            text-align: center;
        }
        .admin-content {
            margin-left: 250px;
            padding: 2rem;
        }
        .admin-header {
            background: #fff;
            border-bottom: 1px solid #dee2e6;
            padding: 1rem 2rem;
            margin: -2rem -2rem 2rem;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <aside class="admin-sidebar">
        <div class="d-flex align-items-center mb-4 text-white">
            <i class="fas fa-user-shield fa-2x me-2"></i>
            <h5 class="mb-0">Admin Panel</h5>
        </div>
        
        <nav class="nav flex-column">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <a href="{{ route('admin.documents.index') }}" class="nav-link {{ request()->routeIs('admin.documents.*') ? 'active' : '' }}">
                <i class="fas fa-file-pdf"></i> Dokumenti
            </a>
            <a href="{{ route('admin.news.index') }}" class="nav-link {{ request()->routeIs('admin.news.*') ? 'active' : '' }}">
                <i class="fas fa-newspaper"></i> Vesti
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="admin-content">
        <header class="admin-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">@yield('title')</h4>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-danger">
                    <i class="fas fa-sign-out-alt"></i> Odjava
                </button>
            </form>
        </header>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
    @stack('scripts')
</body>
</html>
