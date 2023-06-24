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



            <section id="blog_list">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="head-label">
                                    <h4 class="card-title">@lang('feature')</h4>
                                </div>
                                <div class="text-right">
                                    <div class="form-group">
                                        <button class="btn btn-outline-primary button_modal" type="button"
                                            id="button_add"><span><i class="fa fa-plus"></i>@lang('add')</span>
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
                                            <th>@lang('category')</th>
                                            <th>@lang('title')</th>
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


            <section id="blog_form" class="d-none">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="" method="POST" id="Submit_Form" class="Submit_blogs"
                                    enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-6">
                                            <input type="hidden" name="id" id="id">
                                            <div class="form-group">
                                                <label for="">@lang('category')</label>
                                                <select name="category_id" id="category_id" class="form-control">
                                                    <option value="">@lang('select')</option>
                                                    @foreach ($categories as $item)
                                                        <option value="{{ $item->id }}"> {{ $item->name }} </option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-6 text-right">
                                            <button type="submit" class="btn btn-primary">@lang('add')</button>
                                            <button type="button"
                                                class="btn btn-warning show_blogs">@lang('show_blogs')</button>
                                        </div>
                                    </div>

                                    <div class="row">
                                        @foreach (locales() as $key => $value)
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="title_{{ $key }}">@lang('title')
                                                        @lang($value)</label>
                                                    <input type="text" class="form-control"
                                                        id="title_{{ $key }}"
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
                                                    <label for="info_{{ $key }}">@lang('short_description')
                                                        @lang($value)</label>
                                                    <textarea name="info_{{ $key }}" class="form-control" id="info_{{ $key }}" cols="30"
                                                        rows="3"></textarea>
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="row">
                                        @foreach (locales() as $key => $value)
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="description_{{ $key }}">@lang('description')
                                                        @lang($value)</label>
                                                    <textarea name="description_{{ $key }}" class="ckeditor form-control" id="description_{{ $key }}"></textarea>
                                                    <div class="invalid-feedback"></div>
                                                </div>

                                            </div>
                                        @endforeach
                                    </div>

                                    <div id="aks-file-upload"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>

    </div>
@endsection
@section('js')
@endsection
@section('scripts')
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script src="https://unpkg.com/aksfileupload@1.0.0/dist/aksFileUpload.min.js"></script>

    <script type="text/javascript">
        $(function() {
            $("#aks-file-upload").aksFileUpload({
                fileUpload: "#blog_cover",
                input: "#blog_cover",
                fileType: ["svg", "jpg", "jpeg", "png"],
                dragDrop: true,
                maxSize: "90 GB",
                multiple: true,
                maxFile: 2,
                maxFileError: "File exceeds upload limit. - Max limit:",
                maxSizeError: "File exceeds size. - Max limit:",
                fileTypeError: "Disallowed file format.",
                label: '<img src="{{ asset('dashboard/app-assets/images/svg/upload.png') }}" style="width: 60px; height: 60px;" />', // استبدل مسار الصورة SVG هنا وحدد العرض والارتفاع المناسبين
                beforeUpload: function(files) {
                    var lastTwoFiles = files.slice(-2); // الحصول على آخر ملفين فقط
                    return lastTwoFiles;
                }
            });
        });
    </script>




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
                url: '{{ route('blog.getData', app()->getLocale()) }}',

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
                    data: 'images',
                    name: 'images'
                },
                {
                    data: 'category',
                    name: 'category'
                },
                {
                    data: 'title_text',
                    name: 'title'
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
            $('#blog_list').addClass('d-none');
            $('#blog_form').removeClass('d-none');
            $('#Submit_Form').attr('method', 'POST');
            $('#Submit_Form').attr('action', '{{ route('blog.store') }}');
        });
        $(document).on('click', '.show_blogs', function(event) {
            $('#blog_form').addClass('d-none');
            $('#blog_list').removeClass('d-none');
        });


        $(document).on('click', '.btn_edit', function(event) {
            deleteModal();
            event.preventDefault();
            $('#blog_list').addClass('d-none');
            $('#blog_form').removeClass('d-none');
            $('#Submit_Form').attr('method', 'POST');
            $('#Submit_Form').attr('action', '{{ route('blog.update') }}');
            var button = $(this)
            var id = button.data('id');
            $('#id').val(id);
            $('#category_id').val(button.data('category_id')).trigger('change');
            @foreach (locales() as $key => $value)
                $('#info_{{ $key }}').val(button.data('info_{{ $key }}'))
                $('#title_{{ $key }}').val(button.data('title_{{ $key }}'))
                CKEDITOR.instances['description_{{ $key }}'].setData(button.data(
                    'description_{{ $key }}'));
            @endforeach

        });



        $('.Submit_blogs').on('submit', function(event) {
            $('.search_input').val("").trigger("change")
            event.preventDefault();
            var data = new FormData(this);
            let url = $(this).attr('action');
            var method = $(this).attr('method');
            $('input').removeClass('is-invalid');
            $('select').removeClass('is-invalid');
            $('textarea').removeClass('is-invalid');
            $('.invalid-feedback').text('');
            @foreach (locales() as $key => $value)
                var description_{{ $key }} = CKEDITOR.instances['description_{{ $key }}']
                    .getData();
                data.append('description_{{ $key }}', description_{{ $key }});
            @endforeach
            $.ajax({
                type: method,
                cache: false,
                contentType: false,
                processData: false,
                url: url,
                data: data,

                beforeSend: function() {},
                success: function(result) {
                    $('#modal_System').modal('hide');
                    $('#Submit_Form').trigger("reset");
                    toastr.success('@lang('done_successfully')', '', {
                        rtl: isRtl
                    });
                    $('#blog_form').addClass('d-none');
                    $('#blog_list').removeClass('d-none');
                    table.draw()
                },
                error: function(data) {
                    if (data.status === 422) {
                        var response = data.responseJSON;
                        $.each(response.errors, function(key, value) {
                            toastr.error(value);
                            var str = (key.split("."));
                            if (str[1] === '0') {
                                key = str[0] + '[]';
                            }
                            $('[name="' + key + '"], [name="' + key + '[]"]').addClass(
                                'is-invalid');
                            $('[name="' + key + '"], [name="' + key + '[]"]').closest(
                                '.form-group').find('.invalid-feedback').html(value[0]);
                        });
                    } else {
                        toastr.error('@lang('something_wrong')', '', {
                            rtl: isRtl
                        });
                    }
                }
            });
        });
    </script>
@endsection
