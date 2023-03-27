<section id="skills" class="skills section-bg">
    <div class="container">
        <div class="section-title">
            <h2>@lang('skills')</h2>
            <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit
                sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias
                ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>
        <div class="row skills-content">
            <div class="row">
                @foreach ($skills as $iteam)
                <div class="col-6">
                    <div class="progress">
                        <span class="skill">{{ $iteam->name }} <i class="val">{{ $iteam->percentage }}%</i></span>
                        <div class="progress-bar-wrap">
                            <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="{{ $iteam->percentage }}" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    </div>
</section>
