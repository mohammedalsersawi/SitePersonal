@extends('layouts.admin.app')
@section('title')
    @lang('Countrys')
@endsection
@section('styles')
    <style>
        input[type="checkbox"] {
            transform: scale(1.5);
        }
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">@lang('Countrys')</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">@lang('home')</a>
                                </li>
                                <li class="breadcrumb-item"><a href="">@lang('Countrys')</a>
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
                            <div class="card-header">
                                <div class="head-label">
                                    <h4 class="card-title">@lang('Countrys')</h4>
                                </div>
                                <div class="text-right">
                                    <div class="form-group">
                                        <button class="btn btn-outline-primary button_modal" type="button"
                                            data-toggle="modal" data-target="#full-modal-stem"><span><i
                                                    class="fa fa-plus"></i>@lang('add')</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form id="search_form">
                                    <div class="row">
                                        <div class="col-3" style="margin-top: 20px">

                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="table-responsive card-datatable" style="padding: 20px">
                                <table class="table" id="datatable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>@lang('name')</th>
                                            <th>@lang('status')</th>
                                            <th>@lang('status')</th>
                                            <th style="width: 225px;">@lang('actions')</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="full-modal-stem" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">@lang('add')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('services.store') }}" method="POST" id="add_model_form" class="add-mode-form">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            @foreach (locales() as $key => $value)
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="name_{{ $key }}">@lang('name') @lang($value)</label>
                                        <input type="text" class="form-control"
                                            placeholder="@lang('name') @lang($value)"
                                            name="name_{{ $key }}" id="">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @foreach (locales() as $key => $value)
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="key_{{ $key }}">@lang('name') @lang($value)</label>
                                        <textarea name="description_{{ $key }}" class="form-control"
                                            placeholder="@lang('description') @lang($value)" id="" cols="30" rows="3"></textarea>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        {{-- <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="value">@lang('name') @lang($value)</label>
                                    <input type="file" class="form-control" name="image">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div> --}}

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="value">icon</label>
                                    <input type="text" class="form-control"
                                        placeholder="icon name" name="icon"  id="icon">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('close')</button>
                        <button type="submit" class="btn btn-primary">@lang('add')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">@lang('edit')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('services.update') }}" method="POST" id="form_edit" class=""
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id" class="form-control" />
                    <div class="modal-body">
                        <div class="row">
                            @foreach (locales() as $key => $value)
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="name_{{ $key }}">@lang('name') @lang($value)</label>
                                        <input type="text" class="form-control"
                                            placeholder="@lang('name') @lang($value)"
                                            name="name_{{ $key }}" id="name_{{ $key }}">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @foreach (locales() as $key => $value)
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="key_{{ $key }}">@lang('name') @lang($value)</label>
                                        <textarea name="description_{{ $key }}" class="form-control"
                                            placeholder="@lang('description') @lang($value)" id="description_{{ $key }}" cols="30"
                                            rows="3"></textarea>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
{{--
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="value">@lang('name') @lang($value)</label>
                                    <input type="file" class="form-control" name="image">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div> --}}


                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="value">icon</label>
                                    <input type="text" class="form-control"
                                        placeholder="icon name" name="icon"  id="icon">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('close')</button>
                        <button class="btn btn-primary">@lang('save changes')</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
    </div>
    <!-- Modal -->
@endsection
@section('js')
@endsection
@section('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/25.0.0/classic/ckeditor.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            "oLanguage": {
                @if (app()->isLocale('ar'))
                    "sEmptyTable": "ليست هناك بيانات متاحة في الجدول",
                    "sLoadingRecords": "جارٍ التحميل...",
                    "sProcessing": "جارٍ التحميل...",
                    "sLengthMenu": "أظهر _MENU_ مدخلات",
                    "sZeroRecords": "لم يعثر على أية سجلات",
                    "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
                    "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
                    "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
                    "sInfoPostFix": "",
                    "sSearch": "ابحث:",
                    "oAria": {
                        "sSortAscending": ": تفعيل لترتيب العمود تصاعدياً",
                        "sSortDescending": ": تفعيل لترتيب العمود تنازلياً"
                    },
                @endif // "oPaginate": {"sPrevious": '<-', "sNext": '->'},
                "oPaginate": {
                    // remove previous & next text from pagination
                    "sPrevious": '&nbsp;',
                    "sNext": '&nbsp;'
                }
            },
            ajax: {
                url: '{{ route('services.getData', app()->getLocale()) }}',

                data: function(d) {
                    d.key = $('#s_key').val();
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'name_text',
                    name: 'name_text'
                },
                {
                    data: 'description_text',
                    name: 'description_text'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]

        });

        //Edit
        $(document).ready(function() {
            $(document).on('click', '.edit_btn', function(event) {
                event.preventDefault();
                $('input').removeClass('is-invalid');
                $('.invalid-feedback').text('');
                var button = $(this)
                var id = button.data('id');
                $('#id').val(id);
                $('#icon').val(button.data('icon'));
                @foreach (locales() as $key => $value)
                    console.log(button.data('name_{{ $key }}'));
                    $('#name_{{ $key }}').val(button.data('name_{{ $key }}'));
                    $('#description_{{ $key }}').val(button.data(
                        'description_{{ $key }}'))
                @endforeach



            });
        });
    </script>
@endsection
