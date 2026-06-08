@php
    use Illuminate\Support\Facades\Route;
@endphp
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

    <!-- ! Hide app brand if navbar-full -->
    <div class="app-brand demo">
        <a href="{{route('dashboard')}}" class="app-brand-link">
            <img src="{{asset('assets/img/favicon/steklograd.png')}}" alt="Logo" class="app-brand-logo demo size-15">
            <span class="app-brand-text demo menu-text fw-bold ms-2">{{config('variables.templateName')}}</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="icon-base bx bx-chevron-left icon-sm d-flex align-items-center justify-content-center"></i>
        </a>
    </div>

    <div class="menu-divider mt-0"></div>
    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">

        @foreach ($menuData[0]->menu as $menu)
            @if (isset($menu->menuHeader))
                <li class="menu-header font-medium text-uppercase">
                    <span class="menu-header-text">{{ __($menu->menuHeader) }}</span>
                </li>
            @else
                <li class="menu-item ">
                    <a href="{{ isset($menu->route) ? route($menu->route) : 'javascript:void(0);' }}"
                       class="menu-link  ">

                        <div class="text-base @if(request()->routeIs($menu->route))text-brand-primary @endif">{{ isset($menu->name) ? __($menu->name) : '' }}</div>
                    </a>
                </li>
            @endif
        @endforeach
    </ul>

</aside>
