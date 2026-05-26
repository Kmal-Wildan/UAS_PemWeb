@php
    $userName = auth()->user()->name ?? session('user_name', 'Pengguna');
    $userRole = auth()->user()->role ?? session('role', 'user');
    $isAdmin = $userRole === 'admin';
@endphp

<header class="app-navbar">
    <div class="d-flex align-items-center gap-3">
        <button class="btn btn-link sidebar-toggle d-lg-none p-0" id="sidebarToggle" type="button">
            <i class="bi bi-list fs-4"></i>
        </button>
        <div>
            <h1 class="page-title mb-0">@yield('page-title', 'Dashboard')</h1>
            <p class="page-subtitle mb-0">@yield('page-subtitle', 'Selamat datang di aplikasi')</p>
        </div>
    </div>

    <div class="d-flex align-items-center gap-3">
        <div class="navbar-search d-none d-md-block">
            <i class="bi bi-search"></i>
            <input type="text" class="form-control form-control-sm" placeholder="Cari menu..." id="globalSearch" disabled>
        </div>

        <div class="dropdown">
            <button class="btn btn-light dropdown-toggle user-dropdown" type="button" data-bs-toggle="dropdown">
                <span class="user-avatar">{{ strtoupper(substr($userName, 0, 1)) }}</span>
                <span class="d-none d-sm-inline">{{ $userName }}</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow">
                <li>
                    <span class="dropdown-item-text text-muted small">
                        <i class="bi bi-person-badge me-1"></i>
                        {{ $isAdmin ? 'Admin' : 'User' }}
                    </span>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-left me-2"></i>Keluar
                    </a>
                </li>
            </ul>
        </div>
    </div>
</header>
