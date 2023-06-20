<li class="nav-item has-sub  " style="">
    <a class="d-flex align-items-center" href="#">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="feather feather-pie-chart">
            <path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path>
            <path d="M22 12A10 10 0 0 0 12 2v10z"></path>
        </svg>
        <span class="menu-title text-truncate" data-i18n="Charts">@lang('General_Settings')</span></a>
    <ul class="menu-content">
        <li class="nav-item {{ request()->routeIs('menu.index') ? 'active' : '' }} ">
            <a class="d-flex align-items-center" href="{{ route('menu.index') }}">
                <i data-feather="file-text"></i><span class="menu-title text-truncate">@lang('Menu')</span>
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('slider.index') ? 'active' : '' }} ">
            <a class="d-flex align-items-center" href="{{ route('slider.index') }}">
                <i data-feather="file-text"></i><span class="menu-title text-truncate">@lang('slider')</span>
            </a>
        </li>

    </ul>
</li>


<li class="nav-item has-sub  " style="">
    <a class="d-flex align-items-center" href="#">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="feather feather-pie-chart">
            <path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path>
            <path d="M22 12A10 10 0 0 0 12 2v10z"></path>
        </svg>
        <span class="menu-title text-truncate" data-i18n="Charts">@lang('Categoryes')</span></a>
    <ul class="menu-content">
        <li class="nav-item {{ request()->routeIs('category.index') ? 'active' : '' }} ">
            <a class="d-flex align-items-center" href="{{ route('category.index') }}">
                <i data-feather="file-text"></i><span class="menu-title text-truncate">@lang('Categoryes')</span>
            </a>
        </li>


    </ul>
</li>

<li class="nav-item has-sub  " style="">
    <a class="d-flex align-items-center" href="#">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="feather feather-pie-chart">
            <path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path>
            <path d="M22 12A10 10 0 0 0 12 2v10z"></path>
        </svg>
        <span class="menu-title text-truncate" data-i18n="Charts">@lang('feature')</span></a>
    <ul class="menu-content">
        <li class="nav-item {{ request()->routeIs('feature.index') ? 'active' : '' }} ">
            <a class="d-flex align-items-center" href="{{ route('feature.index') }}">
                <i data-feather="file-text"></i><span class="menu-title text-truncate">@lang('feature')</span>
            </a>
        </li>


    </ul>
</li>



