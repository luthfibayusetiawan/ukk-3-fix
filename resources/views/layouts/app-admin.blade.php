<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') - Lapcare Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #3498db;
            --primary-dark: #2980b9;
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

        .admin-layout {
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
        }

        .sidebar-brand p {
            font-size: 0.8rem;
            color: #95a5a6;
        }

        .sidebar-menu {
            list-style: none;
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
            background-color: rgba(52, 152, 219, 0.1);
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
        /* MAIN CONTENT */
        .main-content {
            margin-left: 280px;
            width: calc(100% - 280px);
        }

        .topbar {
            background-color: #fff;
            padding: 20px 30px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .topbar h1 {
            font-size: 1.8rem;
            color: #2c3e50;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .content {
            padding: 30px;
            min-height: calc(100vh - 80px);
        }

        /* RESPONSIVE */
        @media (max-width: 991.98px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                height: 100vh;
                width: 280px;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                z-index: 1000;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                width: 100%;
            }

            .topbar {
                padding: 15px 20px;
            }

            .topbar h1 {
                font-size: 1.3rem;
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

            .user-info {
                gap: 10px;
            }
        }

        @media (max-width: 575.98px) {
            .topbar h1 {
                font-size: 1.1rem;
            }

            .content {
                padding: 20px;
            }

            .user-info {
                gap: 8px;
            }

            .user-avatar {
                width: 35px;
                height: 35px;
                font-size: 0.9rem;
            }
        }

        /* SCROLLBAR */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.3);
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
            color: #3498db;
        }
    </style>
    @stack('styles')
    @yield('extra-css')
</head>
<body>
    <div class="admin-layout">
        <!-- SIDEBAR OVERLAY (Mobile) -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <!-- SIDEBAR -->
        <aside class="sidebar">
            <div class="sidebar-brand">
                <h3><i class="fas fa-comments"></i> Lapcare</h3>
                <p>Admin Panel</p>
            </div>

            <ul class="sidebar-menu">
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                       class="@if(request()->routeIs('admin.dashboard')) active @endif">
                        <i class="fas fa-chart-pie"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.aspirasi.index') }}"
                       class="@if(request()->routeIs('admin.aspirasi.*')) active @endif">
                        <i class="fas fa-list"></i>
                        <span>Data Aspirasi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.kategori.index') }}"
                       class="@if(request()->routeIs('admin.kategori.*')) active @endif">
                        <i class="fas fa-tag"></i>
                        <span>Kategori</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.siswa.index') }}"
                       class="@if(request()->routeIs('admin.siswa.*')) active @endif">
                        <i class="fas fa-users"></i>
                        <span>Data Siswa</span>
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
        </aside>

        <!-- MAIN CONTENT -->
        <div class="main-content">
            <!-- TOPBAR -->
            <div class="topbar">
                <div style="display: flex; align-items: center;">
                    <button class="toggle-sidebar" id="toggleSidebar">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1>@yield('page-title', 'Dashboard')</h1>
                </div>
                <div class="user-info">
                    <span>{{ session('username', 'Admin') }}</span>
                    <div class="user-avatar">
                        {{ strtoupper(substr(session('username', 'A'), 0, 1)) }}
                    </div>
                </div>
            </div>

            <!-- CONTENT -->
            <div class="content">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong>
                        <ul style="margin: 0;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.querySelector('.sidebar');
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
            document.querySelectorAll('.sidebar-footer button, .sidebar-footer a').forEach(btn => {
                btn.addEventListener('click', function() {
                    sidebar.classList.remove('show');
                    overlay.classList.remove('show');
                });
            });
        });
    </script>
    
    @stack('scripts')
    @yield('extra-js')
</body>
</html>