<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --sidebar-width: 250px;
        }
        
        .admin-sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: #2c3e50;
            padding: 1rem;
            color: white;
        }
        
        .admin-content {
            margin-left: var(--sidebar-width);
            padding: 2rem;
        }
        
        .sidebar-brand {
            padding: 1rem;
            margin-bottom: 2rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 0.8rem 1rem;
            margin: 0.2rem 0;
            border-radius: 5px;
            transition: all 0.3s;
        }
        
        .nav-link:hover,
        .nav-link.active {
            background: rgba(255,255,255,0.1);
            color: white;
        }
        
        .nav-link i {
            width: 20px;
            text-align: center;
            margin-right: 10px;
        }
        
        .admin-header {
            background: white;
            padding: 1rem 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }
        
        .logout-btn {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            padding: 0.8rem 1rem;
            display: block;
            margin-top: auto;
            border-top: 1px solid rgba(255,255,255,0.1);
        }
        
        .logout-btn:hover {
            color: white;
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="admin-sidebar d-flex flex-column">
        <div class="sidebar-brand">
            <h5 class="mb-0">Dom Duško Radović</h5>
            <small>Admin Panel</small>
        </div>
        
        <nav class="nav flex-column mb-auto">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <a href="{{ route('admin.documents.index') }}" class="nav-link {{ request()->routeIs('admin.documents.*') ? 'active' : '' }}">
                <i class="fas fa-file-pdf"></i> Dokumenti
            </a>
            <a href="#" class="nav-link">
                <i class="fas fa-newspaper"></i> Vesti
            </a>
        </nav>
        
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn btn btn-link w-100 text-start">
                <i class="fas fa-sign-out-alt"></i> Odjavi se
            </button>
        </form>
    </div>

    <main class="admin-content">
        <div class="admin-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">@yield('title')</h4>
            <div>
                <span class="text-muted">Dobrodošli,</span>
                <span class="ms-1">{{ Auth::guard('admin')->user()->name }}</span>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
