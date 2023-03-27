@extends('layouts.admin.app')
@section('title')
    @lang('about')
@endsection
@section('styles')
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">@lang('area')</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">@lang('home')</a>
                                </li>
                                <li class="breadcrumb-item"><a href="">@lang('area')</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">

            <section id="">
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="table-responsive card-datatable" style="padding: 20px">
                                <form action="{{ route('about.store') }}" method="Post" id="about_submit">
                                    <input type="hidden" name="id" id="id">
                                    @csrf
                                    <div class="row">
                                        @foreach (locales() as $key => $value)
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="name_{{ $key }}">@lang('name')
                                                        @lang($value)</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="@lang('name') @lang($value)"
                                                        name="name_{{ $key }}" id="name_{{ $key }}">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="age">@lang('age')
                                                        </label>
                                                    <input type="text" class="form-control"
                                                        placeholder="@lang('age')"
                                                        name="age" id="age">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="row">
                                        @foreach (locales() as $key => $value)
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="about_{{ $key }}">@lang('about')
                                                        @lang($value)</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="@lang('about') @lang($value)"
                                                        name="about_{{ $key }}" id="about_{{ $key }}">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="row">
                                        @foreach (locales() as $key => $value)
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="freelance_{{ $key }}">@lang('freelance')
                                                        @lang($value)</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="@lang('freelance') @lang($value)"
                                                        name="freelance_{{ $key }}"
                                                        id="freelance_{{ $key }}">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="row">
                                        @foreach (locales() as $key => $value)
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="degree_{{ $key }}">@lang('degree')
                                                        @lang($value)</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="@lang('degree') @lang($value)"
                                                        name="degree_{{ $key }}" id="degree_{{ $key }}">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="row">
                                        @foreach (locales() as $key => $value)
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="city_{{ $key }}">@lang('city')
                                                        @lang($value)</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="@lang('city') @lang($value)"
                                                        name="city_{{ $key }}" id="city_{{ $key }}">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="birthday_{{ $key }}">@lang('birthday')
                                                        @lang($value)</label>
                                                    <input type="date" class="form-control" lang="en"
                                                        placeholder="@lang('birthday') @lang($value)"
                                                        name="birthday"
                                                        id="birthday">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="website">@lang('website')</label>
                                                <input type="text" class="form-control" placeholder="website"
                                                    name="website" id="website">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="email">@lang('email')</label>
                                                <input type="text" class="form-control" placeholder="email"
                                                    name="email" id="email">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="phone">@lang('phone')</label>
                                                <input type="text" class="form-control" placeholder="phone"
                                                    name="phone" id="phone">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        @foreach (locales() as $key => $value)
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="description_{{ $key }}">@lang('description')
                                                        @lang($value)</label>
                                                    <textarea class="form-control" name="description_{{ $key }}" id="description_{{ $key }}"
                                                        cols="30" rows="2"></textarea>
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="value">@lang('name') @lang($value)</label>
                                                <input type="file" class="form-control"
                                                    name="image">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                </div>
                                    <div class="text-right">
                                        <div class="form-group">
                                            <button class="btn btn-outline-primary button_modal"><span><i
                                                        class="fa fa-plus"></i>@lang('add')</span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/25.0.0/classic/ckeditor.js"></script>
    <script>
        $('#about_submit').submit(function(e) {
            e.preventDefault();
            var data = new FormData(this);
            let url = $(this).attr('action');
            var method = $(this).attr('method');
            $.ajax({
                type: method,
                cache: false,
                contentType: false,
                processData: false,
                url: url,
                data: data,
                success: function(response) {
                    if (response.success == 200) {
                        toastr.success('@lang('editd')', '', {});
                        lodeconstants();
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log(xhr.responseText);
                }
            });
        });


        $(document).ready(function() {
            $.ajax({
                url: "{{ route('about.getData') }}",
                type: 'get',
                success: function(response) {
                    @foreach (locales() as $key => $value)
                        $('#name_{{ $key }}').val(response.data.name.{{ $key }});
                        $('#about_{{ $key }}').val(response.data.about.{{ $key }});
                        $('#description_{{ $key }}').val(response.data.description
                            .{{ $key }});
                        $('#freelance_{{ $key }}').val(response.data.freelance
                            .{{ $key }});
                        $('#degree_{{ $key }}').val(response.data.degree
                            .{{ $key }});
                        $('#city_{{ $key }}').val(response.data.city.{{ $key }});
                    @endforeach
                    $('#email').val(response.data.email);
                    $('#phone').val(response.data.phone);
                    $('#website').val(response.data.website);
                    $('#birthday').val(response.data.birthday);
                    $('#age').val(response.data.age);
                    $('#id').val(response.data.id);

                }
            });
        });

        // $(document).ready(function() {
        //     $(document).on('click', '.edit_btn', function(event) {
        //         event.preventDefault();
        //         $('input').removeClass('is-invalid');
        //         $('.invalid-feedback').text('');
        //         var button = $(this)
        //         var uuid = button.data('uuid');
        //         $('#uuid').val(uuid);
        //         @foreach (locales() as $key => $value)
        //             $('#edit_name_{{ $key }}').val(button.data('name_{{ $key }}'))
        //         @endforeach

        //     });
        // });
    </script>
@endsection
