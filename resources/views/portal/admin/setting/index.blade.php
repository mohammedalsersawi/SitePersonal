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
                        <h2 class="content-header-title float-left mb-0">@lang('Menu')</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">@lang('home')</a>
                                </li>
                                <li class="breadcrumb-item"><a href="">@lang('Menu')</a>
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
                                    <h4 class="card-title">@lang('Menu')</h4>
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
                                            <th>@lang('name')</th>
                                            <th>@lang('category')</th>
                                            <th>@lang('Main_Iteam')</th>
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
                <form action="" method="" id="Submit_Form" class="Submit_System">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" id="id" name="id">
                            @foreach (locales() as $key => $value)
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="key_{{ $key }}">@lang('name') @lang($value)</label>
                                        <input type="text" class="form-control" id="name_{{ $key }}"
                                            placeholder="@lang('name') @lang($value)"
                                            name="name_{{ $key }}">
                                        <div class="invalid-feedback"></div>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category_id">@lang('category')</label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option value="0">@lang('select')</option>
                                        @foreach ($categories as $item)
                                        <option value="{{ $item->id }}"> {{ $item->name }} </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="parent_id">@lang('Main_Iteam')</label>
                                    <select name="parent_id" id="parent_id" class="form-control">
                                        <option value="0">@lang('select')</option>
                                        @foreach ($menus as $itemm)
                                            <option value="{{ $itemm->id }}"> {{ $itemm->name }} </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="show_place">@lang('show_place')</label>
                                    <select name="show_place" id="show_place" class="form-control">
                                        <option value="header_menu" @if (isset($item) && $item['show_place'] == 'header_menu') selected @endif>
                                            القائمة العلوية</option>
                                        <option value="footer_menu1" @if (isset($item) && $item['show_place'] == 'footer_menu1') selected @endif>
                                            (معلومات) القائمة السفلية</option>
                                        <option value="footer_menu2" @if (isset($item) && $item['show_place'] == 'footer_menu2') selected @endif>
                                            (الدورات التدريبية) القائمة السفلية</option>
                                        <option value="footer_portal" @if (isset($item) && $item['show_place'] == 'footer_portal') selected @endif>
                                            (داخل المنصة) القائمة السفلية</option>
                                        <option value="social_menu" @if (isset($item) && $item['show_place'] == 'social_menu') selected @endif>
                                            التواصل الاجتماعي</option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="order">@lang('sort')</label>
                                    <input type="text" class="form-control" placeholder="@lang('sort')"
                                        name="order" id="order">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">@lang('link')</label>
                                    <input type="text" class="form-control" placeholder="@lang('link')"
                                        name="link" id="link">
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
    </div>
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
                url: '{{ route('menu.getData', app()->getLocale()) }}',

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
                    name: 'name'
                },
                {
                    data: 'category',
                    name: 'category'
                },
                {
                    data: 'parent',
                    name: 'parent'
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
            $('#Submit_Form').attr('action', '{{ route('menu.store') }}');
        });
        $(document).on('click', '.btn_edit', function(event) {
            deleteModal();
            event.preventDefault();
            $('#Submit_Form').attr('method', 'POST');
            $('#Submit_Form').attr('action', '{{ route('menu.update') }}');
            var button = $(this)
            var id = button.data('id');
            $('#id').val(id);
            $('#show_place').val(button.data('show_place'));
            $('#link').val(button.data('link'));
            $('#order').val(button.data('order'));
            $('#show_place').val(button.data('show_place')).trigger('change');
            $('#category_id').val(button.data('category_id')).trigger('change');
            $('#parent_id').val(button.data('parent_id')).trigger('change');
            @foreach (locales() as $key => $value)
                $('#name_{{ $key }}').val(button.data('name_{{ $key }}'))
            @endforeach

        });
    </script>
@endsection
