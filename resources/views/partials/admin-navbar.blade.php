@php
    $type = \Request::segment(2);
    $isDashboard = $type === 'dashboard';
    $isCatalogShow = $type === 'product';
    $menus = collect([
        (object) [
            'key' => 'dashboard',
            'link' => route('dashboard'),
            'icon' => asset('images/ic_chart_pie.svg'),
            'title' => trUc('dashboard')
        ],
        (object) [
            'key' => 'staff',
            'link' => route('staff.index'),
            'icon' => asset('images/ic_user_heart.svg'),
            'title' => trUc('staff')
        ],
        (object) [
            'key' => 'finance',
            'link' => route('finance.index'),
            'icon' => asset('images/ic_report_money.svg'),
            'title' => trUc('finance')
        ],
    ]);
@endphp
<div class="collapse navbar-collapse" id="sidebar-menu">
    <ul class="navbar-nav pt-lg-3">
        @foreach ($menus as $menu)
            <li class="nav-item">
                <a class="nav-link @if($type === $menu->key) active @endif" href="{{ $menu->link }}" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                        <img src="{{ $menu->icon }}" alt="menu {{ $menu->key }}">
                    </span>
                    <span class="nav-link-title">
                        {{ $menu->title }}
                    </span>
                </a>
            </li>
        @endforeach
    </ul>
</div>