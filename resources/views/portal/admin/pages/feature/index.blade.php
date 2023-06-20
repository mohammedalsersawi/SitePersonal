@extends('layouts.admin.app')
@section('title')
    @lang('Countrys')
@endsection
@section('styles')
    <link type="text/css" rel="stylesheet" href="https://unpkg.com/aksfileupload@1.0.0/dist/aksFileUpload.min.css">

    <style>
        input[type="checkbox"] {
            transform: scale(1.5);
        }

        #aks-file-upload {
            border: 5px solid rgb(216, 216, 228);
            padding: 10px;
            border-radius: 10px;

        }
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">@lang('feature')</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">@lang('home')</a>
                                </li>
                                <li class="breadcrumb-item"><a href="">@lang('feature')</a>
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
                                    <h4 class="card-title">@lang('feature')</h4>
                                </div>
                                <div class="text-right">
                                    <div class="form-group">
                                        <button class="btn btn-outline-primary button_modal" type="button" id="button_add"
                                            data-toggle="modal" data-target="#modal_System"><span><i
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
                                            <th>@lang('cover')</th>
                                            <th>@lang('title')</th>
                                            <th>@lang('info')</th>
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
    <div class="modal fade" id="modal_System" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">@lang('add')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="" id="Submit_Form" class="Submit_System" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" id="id" name="id">
                            @foreach (locales() as $key => $value)
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="title_{{ $key }}">@lang('title') @lang($value)</label>
                                        <input type="text" class="form-control" id="title_{{ $key }}"
                                            placeholder="@lang('title') @lang($value)"
                                            name="title_{{ $key }}">
                                        <div class="invalid-feedback"></div>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row">
                            @foreach (locales() as $key => $value)
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="info_{{ $key }}">@lang('info') @lang($value)</label>
                                        <textarea class="form-control" id="info_{{ $key }}" name="info_{{ $key }}"
                                            placeholder="@lang('info') @lang($value)" cols="30" rows="3"></textarea>
                                        <div class="invalid-feedback"></div>

                                    </div>
                                </div>
                            @endforeach
                        </div>


                        <div class="row">

                        </div>

                        <div id="aks-file-upload"></div>
                        <p class="d-none" id="uploadfile" type="json"></p>




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
    </div>
@endsection
@section('js')
@endsection
@section('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/25.0.0/classic/ckeditor.js"></script>
    <script src="https://unpkg.com/aksfileupload@1.0.0/dist/aksFileUpload.min.js"></script>

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
                url: '{{ route('feature.getData', app()->getLocale()) }}',

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
                    data: 'image',
                    name: 'image'
                },
                {
                    data: 'title_text',
                    name: 'title'
                },
                {
                    data: 'info_text',
                    name: 'info'
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



        $(document).on('click', '#button_add', function(event) {
            deleteModal();
            event.preventDefault();
            $('#Submit_Form').attr('method', 'POST');
            $('#Submit_Form').attr('action', '{{ route('feature.store') }}');
        });
        $(document).on('click', '.btn_edit', function(event) {
            deleteModal();
            event.preventDefault();
            $('#Submit_Form').attr('method', 'POST');
            $('#Submit_Form').attr('action', '{{ route('feature.update') }}');
            var button = $(this)
            var id = button.data('id');
            $('#id').val(id);

            $('#url').val(button.data('url'));
            @foreach (locales() as $key => $value)
                $('#info_{{ $key }}').val(button.data('info_{{ $key }}'))
                $('#title_{{ $key }}').val(button.data('title_{{ $key }}'))
                $('#button_{{ $key }}').val(button.data('button_{{ $key }}'))
            @endforeach
        });


        $(function() {
            $("#aks-file-upload").aksFileUpload({
                fileUpload: "#feature_cover",
                fileType: ["svg"],
                dragDrop: true,
                maxSize: "90 GB",
                multiple: false,
                maxFile: 1,
                maxFileError: "File exceeds upload limit. - Max limit:",
                maxSizeError: "File exceeds size. - Max limit:",
                fileTypeError: "Disallowed file format.",
                label: '<img src="{{ asset('dashboard/app-assets/images/svg/upload.png') }}" style="width: 60px; height: 60px;" />', // استبدل مسار الصورة SVG هنا وحدد العرض والارتفاع المناسبين
            });
        });
    </script>
@endsection
