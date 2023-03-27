@extends('layouts.site.app')
@section('css')
    <link href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
@endsection
@section('Hero')
    <section id="hero" class="d-flex flex-column justify-content-center align-items-center">
        <div class="hero-container" data-aos="fade-in">
            <h1>{{ $my_name->name }}</h1>
            <p>@lang('Im') <span class="typed"
                    data-typed-items="@foreach ($jobs as $i)
                {{ $i->name }}, @endforeach"></span></p>
        </div>
    </section>
@endsection
@section('content')
    @include('portal.site.sections.about')

    @include('portal.site.sections.facts')

    @include('portal.site.sections.skills')

    @include('portal.site.sections.resume')



    @include('portal.site.sections.services')

    @include('portal.site.sections.contact')
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.js"
        integrity="sha512-6DC1eE3AWg1bgitkoaRM1lhY98PxbMIbhgYCGV107aZlyzzvaWCW1nJW2vDuYQm06hXrW0As6OGKcIaAVWnHJw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function() {
            $('.mailformsumite').on('submit', function(event) {
                event.preventDefault();
                var data = new FormData(this);
                let url = $(this).attr('action');
                var method = $(this).attr('method');
                $('input').removeClass('is-invalid');
                $('textarea').removeClass('is-invalid');
                $('.invalid-feedback').removeClass('');
                $.ajax({
                    type: method,
                    cache: false,
                    contentType: false,
                    processData: false,
                    url: url,
                    data: data,
                    beforeSend: function() {},
                    success: function(result) {
                        let timerInterval
                        Swal.fire({
                            title: '@lang('send_ajax')',
                            html: 'I will close in <b></b> milliseconds.',
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading()
                                const b = Swal.getHtmlContainer().querySelector('b')
                                timerInterval = setInterval(() => {
                                    b.textContent = Swal.getTimerLeft()
                                }, 100)
                            },
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        }).then((result) => {
                            /* Read more about handling dismissals below */
                            if (result.dismiss === Swal.DismissReason.timer) {}
                        })
                        $('.mailformsumite').trigger("reset");
                        $('input').removeClass('is-invalid');
                        $('textarea').removeClass('is-invalid');
                    },
                    error: function(data) {
                        if (data.status === 422) {
                            var response = data.responseJSON;
                            $.each(response.errors, function(key, value) {
                                var str = (key.split("."));
                                if (str[1] === '0') {
                                    key = str[0] + '[]';
                                }
                                $('[name="' + key + '"], [name="' + key + '[]"]')
                                    .addClass(
                                        'is-invalid');
                                $('[name="' + key + '"], [name="' + key + '[]"]')
                                    .closest(
                                        '.form-group').find('.invalid-feedback').html(
                                        value[0]);
                            });
                        } else {

                        }
                    }
                });
            });
        });
    </script>
@endsection
