@php
    $userRole = auth()->user()->role ?? session('role', 'user');
    $isAdmin = $userRole === 'admin';
    $currentRoute = request()->route()?->getName() ?? '';
@endphp

<aside class="app-sidebar" id="appSidebar">
    <div class="sidebar-brand">
        <i class="bi bi-grid-1x2-fill brand-icon"></i>
        <span class="brand-text">{{ config('app.name', 'UAS PEMWEB') }}</span>
    </div>

    <nav class="sidebar-nav">
        <p class="sidebar-label">Menu Utama</p>
        <ul class="nav flex-column">
            @if($isAdmin)
                {{-- Menu Admin --}}
                <li class="nav-item">
                    <a href="{{ route('dashboard.admin') }}"
                       class="nav-link {{ str_starts_with($currentRoute, 'dashboard.admin') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2"></i>
                        <span>Dashboard Admin</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('data.index') }}"
                       class="nav-link {{ str_starts_with($currentRoute, 'data.') ? 'active' : '' }}">
                        <i class="bi bi-database"></i>
                        <span>Data Utama</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('laporan.index') }}"
                       class="nav-link {{ str_starts_with($currentRoute, 'laporan.') ? 'active' : '' }}">
                        <i class="bi bi-file-earmark-bar-graph"></i>
                        <span>Laporan</span>
                    </a>
                </li>
            @else
                {{-- Menu User (read-only) --}}
                <li class="nav-item">
                    <a href="{{ route('dashboard.user') }}"
                       class="nav-link {{ str_starts_with($currentRoute, 'dashboard.user') ? 'active' : '' }}">
                        <i class="bi bi-house-door"></i>
                        <span>Dashboard User</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('data.index') }}"
                       class="nav-link {{ str_starts_with($currentRoute, 'data.') ? 'active' : '' }}">
                        <i class="bi bi-eye"></i>
                        <span>Lihat Data</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('laporan.index') }}"
                       class="nav-link {{ str_starts_with($currentRoute, 'laporan.') ? 'active' : '' }}">
                        <i class="bi bi-file-text"></i>
                        <span>Lihat Laporan</span>
                    </a>
                </li>
            @endif
        </ul>

        <p class="sidebar-label mt-4">Akun</p>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{ route('logout') }}"
                   class="nav-link text-danger"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-left"></i>
                    <span>Keluar</span>
                </a>
            </li>
        </ul>
    </nav>

    <div class="sidebar-footer">
        <div class="role-badge {{ $isAdmin ? 'role-admin' : 'role-user' }}">
            <i class="bi {{ $isAdmin ? 'bi-shield-check' : 'bi-person' }}"></i>
            {{ $isAdmin ? 'Administrator' : 'User' }}
        </div>
    </div>
</aside>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>
