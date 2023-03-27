<section id="facts" class="facts">
    <div class="container">
        <div class="section-title">
            <h2>@lang('facts')</h2>
            {{-- <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit
                sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias
                ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p> --}}
        </div>
        <div class="row no-gutters">
            @foreach ($data_fact as $iteam)
                <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch" data-aos="fade-up">
                    <div class="count-box">
                        <i class="{{ $iteam->icon }}"></i>
                        <span data-purecounter-start="0" data-purecounter-end="{{ $iteam->value }}"
                            data-purecounter-duration="1" class="purecounter"></span>
                        <p><strong>{{ $iteam->key }}</strong> </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
