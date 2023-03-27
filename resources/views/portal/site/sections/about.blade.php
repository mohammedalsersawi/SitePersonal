<section id="about" class="about">
    <div class="container">

        <div class="section-title">
            <h2>@lang('about')</h2>
            @isset($data_about)
                <p>{{ $data_about->about }}.</p>
            @endisset

        </div>

        <div class="row">
            <div class="col-lg-4" data-aos="fade-right">
                <img src="{{ asset('assets/img/profile-img.jpg') }}" class="img-fluid" alt="">
            </div>
            <div class="col-lg-8 pt-4 pt-lg-0 content" data-aos="fade-left">
                <h3>@foreach ($about_job as $i )
                    {{ $i->name }}
                @endforeach</h3>
                {{-- <p class="fst-italic">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                    labore et dolore
                    magna aliqua.
                </p> --}}
                <br>
                <div class="row">
                    <div class="col-lg-6">
                        <ul>
                            <li><i class="bi bi-chevron-right"></i> <strong>@lang('birthday') :</strong> <span>
                                    @isset($data_about)
                                        @if (app()->isLocale('ar'))
                                            {{ \Carbon\Carbon::parse($data_about->birthday)->locale('ar')->isoFormat('Do MMMM YYYY') }}
                                        @else
                                            {{ \Carbon\Carbon::parse($data_about->birthday)->format('j F Y') }}
                                        @endif
                                    @endisset
                                </span></li>
                            <li><i class="bi bi-chevron-right"></i> <strong>@lang('website') :</strong>
                                <span>
                                    @isset($data_about)
                                        {{ $data_about->website }}
                                    @endisset
                                </span>
                            </li>
                            <li><i class="bi bi-chevron-right"></i> <strong>@lang('phone') :</strong> <span>
                                    @isset($data_about)
                                        {{ $data_about->phone }}
                                    @endisset </span></li>
                            <li><i class="bi bi-chevron-right"></i> <strong>@lang('City') :</strong> <span>
                                    @isset($data_about)
                                        {{ $data_about->city }}
                                    @endisset
                                </span></li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <ul>
                            <li><i class="bi bi-chevron-right"></i> <strong>@lang('age') :</strong> <span>
                                    @isset($data_about)
                                        @if (app()->isLocale('ar'))
                                            {{ number_format($data_about->age, 0, '.', ',') }}
                                        @else
                                            {{ $data_about->age }}
                                        @endif
                                    @endisset

                                </span></li>
                            <li><i class="bi bi-chevron-right"></i> <strong>@lang('degree') :</strong>
                                <span>
                                    @isset($data_about)
                                        {{ $data_about->degree }}
                                    @endisset
                                </span>
                            </li>
                            <li><i class="bi bi-chevron-right"></i> <strong>@lang('email') :</strong>
                                <span>
                                    @isset($data_about)
                                        {{ $data_about->email }}
                                    @endisset
                                </span>
                            </li>
                            <li><i class="bi bi-chevron-right"></i> <strong>@lang('freelance') :</strong>
                                <span>
                                    @isset($data_about)
                                        {{ $data_about->freelance }}
                                    @endisset
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
                <p>
                    @isset($data_about)
                        {{ $data_about->description }}.
                    @endisset
                </p>
            </div>
        </div>

    </div>
</section>
