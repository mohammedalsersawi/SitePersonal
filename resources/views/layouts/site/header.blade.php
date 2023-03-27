<header id="header">
    <div class="d-flex flex-column">
        <div class="profile">
            <div class="social-links mt-3 text-center">
                @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <a class="linkedin" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                        data-language="{{ $localeCode }}">{{ $properties['native'] }}</a>
                @endforeach
            </div>
        </div>
        <div class="profile">
            <img src="{{ asset('uploads/'.$my_name->image->filename) }}" alt="" style="width: 120px; height: 120px; border-radius: 50%;">
            <h1 class="text-light"><a href="index.html">@isset($my_name){{ $my_name->name }}@endisset</a></h1>
            <div class="social-links mt-3 text-center">
                @foreach ($social as $i)
                <a href="{{ $i->url }}" class="{{ $i->name }}"><i class="bx bxl-{{ $i->name }}"></i></a>
                @endforeach

            </div>
        </div>

        <nav id="navbar" class="nav-menu navbar">
            <ul>
                <li><a href="#hero" class="nav-link scrollto active"><i class="bx bx-home"></i>
                        <span>@lang('home')</span></a></li>
                <li><a href="#about" class="nav-link scrollto"><i class="bx bx-user"></i> <span>@lang('about')</span></a>
                </li>
                <li><a href="#resume" class="nav-link scrollto"><i class="bx bx-file-blank"></i>
                        <span>@lang('resume')</span></a></li>
                <li><a href="#skills" class="nav-link scrollto"><i class="bx bx-file-blank"></i>
                        <span>@lang('skills')</span></a></li>
                <li><a href="#services" class="nav-link scrollto"><i class="bx bx-server"></i>
                        <span>@lang('services')</span></a></li>
                <li><a href="#contact" class="nav-link scrollto"><i class="bx bx-envelope"></i>
                        <span>@lang('contact')</span></a></li>
            </ul>
        </nav><!-- .nav-menu -->
    </div>
</header>
