<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu" aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
<h1 class="navbar-brand navbar-brand-autodark">
    {{-- <a href="{{ URL::to('/') }}">
        <img src="{{ asset('images/logo-white.svg') }}" style="height: 70px" width="100" alt="Tabler" class="navbar-brand-image">
    </a> --}}
</h1>
<div class="navbar-nav flex-row d-lg-none">
    <div class="nav-item dropdown">
        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
            <span class="avatar avatar-sm" style="background: white;">{{ substr(auth()->user()->name, 0, 1) }}</span>
                <div class="d-none d-xl-block ps-2">
                <div>{{ ucwords(auth()->user()->name) }}</div>
                {{-- <div class="mt-1 small text-secondary">UI Designer</div> --}}
            </div>
        </a>
        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            {{-- <a href="#" class="dropdown-item">Status</a>
            <a href="./profile.html" class="dropdown-item">Profile</a>
            <a href="#" class="dropdown-item">Feedback</a>
            <div class="dropdown-divider"></div>
            <a href="./settings.html" class="dropdown-item">Settings</a> --}}
            <a href="{{route('logout')}}" class="dropdown-item" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
        </div>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</div>