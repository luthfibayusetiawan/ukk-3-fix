<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - Lapcare Siswa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    @stack('styles')
    
    <style>
        :root {
            --primary-color: #0066ff;
            --primary-dark: #0052cc;
            --sidebar-bg: #2c3e50;
            --text-light: #ecf0f1;
            --danger-color: #e74c3c;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f6fa;
            color: #2c3e50;
        }

        .siswa-layout {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 280px;
            background-color: var(--sidebar-bg);
            color: var(--text-light);
            padding: 20px 0;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .sidebar-brand {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 20px;
        }

        .sidebar-brand h3 {
            font-size: 1.5rem;
            color: var(--primary-color);
            margin-bottom: 5px;
            font-weight: 700;
        }

        .sidebar-brand p {
            font-size: 0.8rem;
            color: #95a5a6;
        }

        .sidebar-menu {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .sidebar-menu li {
            margin: 0;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            color: var(--text-light);
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }

        .sidebar-menu a:hover {
            background-color: rgba(0, 102, 255, 0.1);
            border-left-color: var(--primary-color);
            padding-left: 25px;
        }

        .sidebar-menu a.active {
            background-color: var(--primary-color);
            border-left-color: #fff;
            color: #fff;
        }

        .sidebar-menu i {
            width: 25px;
            margin-right: 15px;
            text-align: center;
        }

        .sidebar-menu span {
            font-size: 0.95rem;
        }

        .sidebar-footer {
            position: absolute;
            bottom: 20px;
            left: 0;
            right: 0;
            padding: 0 20px;
        }

        .sidebar-footer a {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 12px;
            background-color: rgba(231, 76, 60, 0.2);
            color: #ecf0f1;
            text-decoration: none;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .sidebar-footer a:hover {
            background-color: var(--danger-color);
        }

        /* TOGGLE BUTTON */
        .toggle-sidebar {
            display: none;
            background: none;
            border: none;
            color: #2c3e50;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0;
            margin-right: 15px;
        }

        .toggle-sidebar:hover {
            color: var(--primary-color);
        }

        /* MAIN CONTENT */
        .main-content {
            flex: 1;
            margin-left: 280px;
            display: flex;
            flex-direction: column;
        }

        /* TOP BAR */
        .topbar {
            background-color: #fff;
            padding: 20px 30px;
            border-bottom: 1px solid #ecf0f1;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .topbar h1 {
            font-size: 1.5rem;
            color: #2c3e50;
            margin: 0;
            font-weight: 600;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background-color: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 1.2rem;
        }

        .user-name {
            font-weight: 500;
            color: #2c3e50;
        }

        /* CONTENT AREA */
        .content {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
        }

        /* RESPONSIVE */
        @media (max-width: 1199px) {
            .sidebar {
                width: 250px;
            }

            .main-content {
                margin-left: 250px;
            }

            .topbar {
                padding: 15px 20px;
            }

            .content {
                padding: 20px;
            }
        }

        @media (max-width: 991px) {
            .sidebar {
                width: 200px;
            }

            .main-content {
                margin-left: 200px;
            }

            .topbar h1 {
                font-size: 1.2rem;
            }

            .sidebar-brand h3 {
                font-size: 1.2rem;
            }
        }

        @media (max-width: 575px) {
            .sidebar {
                width: 100%;
                margin-left: -100%;
                transition: margin-left 0.3s ease;
                z-index: 1000;
            }

            .sidebar.show {
                margin-left: 0;
            }

            .main-content {
                margin-left: 0;
            }

            .topbar {
                padding: 10px 15px;
            }

            .topbar h1 {
                font-size: 1.2rem;
            }

            .content {
                padding: 15px;
            }

            .sidebar-menu a span {
                font-size: 0.85rem;
            }

            .toggle-sidebar {
                display: flex !important;
                align-items: center;
                justify-content: center;
            }

            .sidebar-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 999;
                opacity: 0;
                transition: opacity 0.3s ease;
            }

            .sidebar-overlay.show {
                display: block;
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <div class="siswa-layout">
        <!-- SIDEBAR OVERLAY (Mobile) -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <!-- SIDEBAR -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-brand">
                <h3>Lapcare</h3>
                <p>Siswa</p>
            </div>

            <ul class="sidebar-menu">
                <li>
                    <a href="{{ route('siswa.dashboard') }}" class="@if(request()->routeIs('siswa.dashboard')) active @endif">
                        <i class="fas fa-th-large"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('siswa.aspirasi.index') }}" class="@if(request()->routeIs('siswa.aspirasi.index') || request()->routeIs('siswa.aspirasi.show')) active @endif">
                        <i class="fas fa-list"></i>
                        <span>Aspirasi Saya</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('siswa.aspirasi.create') }}" class="@if(request()->routeIs('siswa.aspirasi.create')) active @endif">
                        <i class="fas fa-plus-circle"></i>
                        <span>Tambah Aspirasi</span>
                    </a>
                </li>
            </ul>

            <div class="sidebar-footer">
                <form action="{{ route('logout') }}" method="POST" style="width: 100%;">
                    @csrf
                    <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="fas fa-sign-out-alt" style="margin-right: 10px;"></i>
                        <span>Logout</span>
                    </a>
                </form>
            </div>
        </div>

        <!-- MAIN CONTENT -->
        <div class="main-content">
            <!-- TOP BAR -->
            <div class="topbar">
                <div style="display: flex; align-items: center;">
                    <button class="toggle-sidebar" id="toggleSidebar">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1>@yield('page-title', 'Dashboard')</h1>
                </div>
                <div class="user-info">
                    <span class="user-name">{{ session('nama', 'Siswa') }}</span>
                    <div class="user-avatar">{{ strtoupper(substr(session('nama', 'S'), 0, 1)) }}</div>
                </div>
            </div>

            <!-- CONTENT -->
            <div class="content">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-exclamation-circle me-2"></i>Error!</strong>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const toggleBtn = document.getElementById('toggleSidebar');
            const overlay = document.getElementById('sidebarOverlay');

            // Toggle sidebar on button click
            toggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('show');
                overlay.classList.toggle('show');
            });

            // Close sidebar when overlay is clicked
            overlay.addEventListener('click', function() {
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
            });

            // Close sidebar when menu item is clicked
            document.querySelectorAll('.sidebar-menu a').forEach(link => {
                link.addEventListener('click', function() {
                    sidebar.classList.remove('show');
                    overlay.classList.remove('show');
                });
            });

            // Close sidebar when logout is clicked
            document.querySelectorAll('.sidebar-footer a').forEach(link => {
                link.addEventListener('click', function() {
                    sidebar.classList.remove('show');
                    overlay.classList.remove('show');
                });
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>