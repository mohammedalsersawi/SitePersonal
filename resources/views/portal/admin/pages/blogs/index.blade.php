@extends('layouts.admin.app')
@section('title')
    @lang('Categoryes')
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
                        <h2 class="content-header-title float-left mb-0">@lang('Categoryes')</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">@lang('home')</a>
                                </li>
                                <li class="breadcrumb-item"><a href="">@lang('Categoryes')</a>
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
                            <div class="card-body">
                                <form action="{{ route('blog.store') }}" method="POST" id="Submit_Form"
                                    class="Submit_System" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-6">
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
        $(document).ready(function() {
            CKEDITOR.replace('wysiwyg-editor', {
                removePlugins: 'uploadimage,image,flash,iframe,filebrowser,uploadfile',
                // Other CKEditor configuration options if needed
            });
        });

        $(function() {
            $("#aks-file-upload").aksFileUpload({
                fileUpload: "#blog_cover",
                fileType: ["svg", "jpg", "jpeg", "png"],
                dragDrop: true,
                maxSize: "90 GB",
                multiple: true,
                maxFile: 2,
                maxFileError: "File exceeds upload limit. - Max limit:",
                maxSizeError: "File exceeds size. - Max limit:",
                fileTypeError: "Disallowed file format.",
                label: '<img src="{{ asset('dashboard/app-assets/images/svg/upload.png') }}" style="width: 60px; height: 60px;" />', // استبدل مسار الصورة SVG هنا وحدد العرض والارتفاع المناسبين
            });
        });
    </script>




    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // var table = $('#datatable').DataTable({
        //     processing: true,
        //     serverSide: true,
        //     "oLanguage": {
        //         @if (app()->isLocale('ar'))
        //             "sEmptyTable": "ليست هناك بيانات متاحة في الجدول",
        //             "sLoadingRecords": "جارٍ التحميل...",
        //             "sProcessing": "جارٍ التحميل...",
        //             "sLengthMenu": "أظهر _MENU_ مدخلات",
        //             "sZeroRecords": "لم يعثر على أية سجلات",
        //             "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
        //             "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
        //             "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
        //             "sInfoPostFix": "",
        //             "sSearch": "ابحث:",
        //             "oAria": {
        //                 "sSortAscending": ": تفعيل لترتيب العمود تصاعدياً",
        //                 "sSortDescending": ": تفعيل لترتيب العمود تنازلياً"
        //             },
        //         @endif // "oPaginate": {"sPrevious": '<-', "sNext": '->'},
        //         "oPaginate": {
        //             // remove previous & next text from pagination
        //             "sPrevious": '&nbsp;',
        //             "sNext": '&nbsp;'
        //         }
        //     },
        //     ajax: {
        //         url: '{{ route('category.getData', app()->getLocale()) }}',

        //         data: function(d) {
        //             d.key = $('#s_key').val();
        //         }
        //     },
        //     columns: [{
        //             data: 'DT_RowIndex',
        //             name: 'DT_RowIndex',
        //             orderable: false,
        //             searchable: false
        //         },
        //         {
        //             data: 'name_text',
        //             name: 'name'
        //         },
        //         {
        //             data: 'status',
        //             name: 'status'
        //         },
        //         {
        //             data: 'action',
        //             name: 'action',
        //             orderable: false,
        //             searchable: false
        //         },
        //     ]

        // });


        // $(document).on('click', '#button_add', function(event) {
        //     deleteModal();
        //     event.preventDefault();
        //     $('#Submit_Form').attr('method', 'POST');
        //     $('#Submit_Form').attr('action', '{{ route('category.store') }}');
        // });


        // $(document).on('click', '.btn_edit', function(event) {
        //     deleteModal();
        //     event.preventDefault();
        //     $('#Submit_Form').attr('method', 'POST');
        //     $('#Submit_Form').attr('action', '{{ route('category.update') }}');
        //     var button = $(this)
        //     var id = button.data('id');
        //     $('#id').val(id);
        //     @foreach (locales() as $key => $value)
        //         $('#name_{{ $key }}').val(button.data('name_{{ $key }}'))
        //     @endforeach

        // });
    </script>
@endsection
