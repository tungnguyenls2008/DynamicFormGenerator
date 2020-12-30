@extends('layouts.app')

@section('title', 'Danh sách hồ sơ')

@section('content')
    <div class="card">
        <div class="card-header bg-primary text-light">
            <div class="row">
                <h3 class="col-9">Create Form</h3>
                <a href="{{ route('form.index') }}" class="col-3 btn btn-primary">Quay lại</a>
            </div>
        </div>
        <div class="card-body">
            <div id="form_builder"></div>
            <div id="form_display"></div>
            {{-- <form> --}}
            {{--            <form method="POST" id="createForm" action="{{ route("form.store") }}">--}}
            {{--                @csrf--}}

            {{--                <div class="form-group row">--}}
            {{--                    <div class="col-6">--}}
            {{--                        <label for="name">Tên hồ sơ:</label>--}}
            {{--                        <input type="text" name="name" id="name" class="form-control">--}}
            {{--                    </div>--}}
            {{--                    <div class="col-6">--}}
            {{--                        <label for="info">Mô tả:</label>--}}
            {{--                        <textarea name="info" id="info" class="form-control"></textarea>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--                <div class="row">--}}
            {{--                    <button class="btn btn-primary col-4">Tạo form hồ sơ</button>--}}
            {{--                </div>--}}
            {{--                <div class="formData">--}}
            {{--                </div>--}}
            {{--                <div class="row">--}}
            {{--                    <button type="button" class="col-4 btn btn-primary" id="add"> Thêm</button>--}}
            {{--                </div>--}}
            {{--            </form>--}}
        </div>
    </div>

    <!-- Laravel Javascript Validation -->
    {{-- <script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\FormValidationRequest', '#createForm') !!} --}}
    <script>
        jQuery(function ($) {
            var options = {
                i18n: {
                    locale: 'vi-VN'
                },
                onSave: function (e) {
                    //do save json to db here
                    var data = form_builder.actions.getData('json')
                    //alert(data)
                    e.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });


                    jQuery.ajax({
                        url: "{{URL::route('saveJsonFromFormBuilder')}}",
                        method: 'post',
                        data: {
                            json_form: data
                        },
                        success: function (result) {
                            console.log(result)
                        }
                    });


                },
            };
            var form_builder = $(document.getElementById('form_builder')).formBuilder(options);
            var data = form_builder.formData
        });
    </script>
    {{--    <script>--}}
    {{--        $(document).ready(function () {--}}
    {{--            var count = 1;--}}
    {{--            var element = '<select id="element" class="form-control">'--}}
    {{--            element += '<option>---Loại dữ liệu---</option>'--}}
    {{--            element += '<option value="input">Ô nhập liệu</option>'--}}
    {{--            element += '<option value="select">Lựa chọn</option>'--}}
    {{--            element += '<option value="textarea">Ô nhập văn bản</option>'--}}
    {{--            element += '<option value="file">File Upload</option>'--}}
    {{--            element += '</select>'--}}


    {{--            dynamic_field(count, element);--}}

    {{--            $(document).on('click', '#add', function () {--}}
    {{--                count++;--}}
    {{--                dynamic_field(count, element);--}}
    {{--            })--}}

    {{--            $(document).on('click', '#remove', function () {--}}
    {{--                count--;--}}
    {{--                $(this).closest('.fieldDetails').remove();--}}
    {{--            })--}}

    {{--            function dynamic_field(number, element) {--}}
    {{--                var html = '<div class="row border m-2 p-2 fieldDetails">';--}}
    {{--                if (number > 1) {--}}
    {{--                    html += '<div class="col-12 row"><button type="button" class="offset-8 col-4 btn btn-danger" id="remove"> Hủy </button></div>';--}}
    {{--                }--}}
    {{--                html += '<div class="col-12">' + element + '</div>';--}}
    {{--                $('.formData').append(html);--}}
    {{--            }--}}

    {{--            $(document).on('change', '#element', function () {--}}

    {{--                if ($(this).closest('.fieldDetails').find(".fieldType").length) {--}}
    {{--                    $(this).closest('.fieldDetails').find(".fieldType").remove();--}}
    {{--                }--}}
    {{--                var type = $(this).val();--}}
    {{--                if (type == "input") {--}}
    {{--                    var types = '<select id="type" name="field_type[]" class="form-control">'--}}
    {{--                    types += '<option>---Loại dữ liệu---</option>'--}}
    {{--                    types += '<option value="text">Văn bản ngắn</option>'--}}
    {{--                    types += '<option value="password">Mật khẩu</option>'--}}
    {{--                    types += '<option value="email">Email</option>'--}}
    {{--                    types += '<option value="number">Số</option>'--}}
    {{--                    types += '<option value="time">Thời gian</option>'--}}
    {{--                    types += '<option value="checkbox">Checkbox</option>'--}}
    {{--                    types += '<option value="radio">Radio</option>'--}}
    {{--                    types += '</select>'--}}

    {{--                    var html = '<div class="col row fieldType">';--}}
    {{--                    html += '<div class="col-4"><label>Tên dữ liệu:</label><input type="text" name="field_name[]" id="field_name" class="form-control"></div>';--}}
    {{--                    html += '<div class="col-4"><label>Nhãn dữ liệu:</label><input type="text" name="field_label[]" id="field_label" class="form-control"></div>';--}}
    {{--                    html += '<div class="col-4"><label>Loại dữ liệu:</label>' + types + '</div>';--}}
    {{--                    html += '</div>';--}}
    {{--                } else if (type == "textarea") {--}}
    {{--                    var html = '<div class="col row fieldType">';--}}
    {{--                    html += '<div class="col-4"><label>Tên dữ liệu:</label><input type="text" name="field_name[]" id="field_name" class="form-control"></div>';--}}
    {{--                    html += '<div class="col-4"><label>Nhãn dữ liệu:</label><input type="text" name="field_label[]" id="field_label" class="form-control"></div>';--}}
    {{--                    html += '<div class="col-4"><label>Loại dữ liệu:</label><input type="text" class="form-control disable" name="field_type[]" value="textarea" readonly></div>';--}}
    {{--                    html += '</div>';--}}

    {{--                } else if (type == "select") {--}}
    {{--                    var html = '<div class="col row fieldType">'--}}
    {{--                    html += '<div class="col-4"><label>Tên dữ liệu:</label><input type="text" name="field_name[]" id="field_name" class="form-control"></div>';--}}
    {{--                    html += '<div class="col-4"><label>Nhãn dữ liệu:</label><input type="text" name="field_label[]" id="field_label" class="form-control"></div>';--}}
    {{--                    html += '<div class="col-4"><label>Loại dữ liệu:</label><input type="text" class="form-control disable" name="field_type[]" value="select" readonly></div>';--}}
    {{--                    html += '</div>';--}}
    {{--                } else if (type == "file") {--}}
    {{--                    var file_types = '<select id="file_type" name="field_type[]" class="form-control">'--}}
    {{--                    file_types += '<option>---Loại file---</option>'--}}
    {{--                    file_types += '<option value="video">Video</option>'--}}
    {{--                    file_types += '<option value="image">Hình ảnh</option>'--}}
    {{--                    file_types += '<option value="document">Tài liệu</option>'--}}
    {{--                    file_types += '</select>'--}}
    {{--                    var html = '<div class="col row fieldType">'--}}
    {{--                    html += '<div class="col-4"><label>Loại file:</label>' + file_types + '</div>';--}}
    {{--                    html += '<div class="col-4"><label>Nội dung file:</label><input type="text" name="field_name[]" id="field_name" class="form-control"></div>';--}}
    {{--                    html += '<div class="col-4"><input type="text" name="field_label[]" id="field_label" class="form-control" hidden></div>';--}}
    {{--                    // html += '<div class="col-4"><label>File:</label><input type="file" class="form-control disable" name="field_type[]" value="file" readonly></div>';--}}
    {{--                    html += '</div>';--}}
    {{--                }--}}
    {{--                $(this).closest('.fieldDetails').append(html);--}}

    {{--                if (type == "select") {--}}
    {{--                    var html = '<div class="col-12 row optionButton"><button type="button" id="addOption" class="btn btn-primary m-3">Thêm tùy chọn</button></div>';--}}
    {{--                    $(this).closest('.fieldDetails').find('.fieldType').append(html);--}}
    {{--                }--}}
    {{--            })--}}

    {{--            $(document).on('change', '#type', function () {--}}
    {{--                if ($(this).val() == "radio") {--}}
    {{--                    var html = '<div class="col-12 row optionButton"><button type="button" id="addOption" class="btn btn-primary m-3">Thêm tùy chọn</button></div>';--}}
    {{--                    $(this).closest('.fieldDetails').find('.fieldType').append(html);--}}
    {{--                }--}}
    {{--            });--}}

    {{--            $(document).on('click', '#addOption', function () {--}}
    {{--                var name = $(this).closest('.fieldDetails').find("#field_name").val();--}}

    {{--                if (name != "") {--}}
    {{--                    var html = '<div class="col-12 row m-1 p-1 border fieldOption">'--}}
    {{--                    html += '<div class="col-4"><label>Giá trị:</label><input type="text" class="form-control" name="' + name + '-value[]"></div>'--}}
    {{--                    html += '<div class="col-4"><label>Nhãn:</label><input type="text" class="form-control" name="' + name + '-label[]"></div>'--}}
    {{--                    html += '<div class="offset-2 col-2"><button type="button" class="btn btn-danger mt-4" id="removeOption">Hủy bỏ</div>'--}}
    {{--                    html += '</div>'--}}

    {{--                    $(this).closest('.fieldType').find('.optionButton').append(html);--}}
    {{--                } else {--}}
    {{--                    alert("Hãy nhập tên bộ hồ sơ!");--}}
    {{--                }--}}
    {{--            });--}}

    {{--            $(document).on('click', '#removeOption', function () {--}}
    {{--                $(this).closest('.fieldOption').remove();--}}
    {{--            });--}}
    {{--            // $(document).on('submit', '#createForm',function(e){--}}
    {{--            //     e.preventDefault();--}}
    {{--            //     $.ajax({--}}
    {{--            //         url : '{{ route("form.store") }}',--}}
    {{--            //         type: 'POST',--}}
    {{--            //         data : {--}}
    {{--            //             "_token": "{{ csrf_token() }}",--}}
    {{--            //             "data": $(this).serialize(),--}}
    {{--            //         },--}}
    {{--            //         dataType : 'json',--}}
    {{--            //         success : function(data){--}}
    {{--            //             alert("form submited");--}}
    {{--            //         }--}}
    {{--            //     });--}}
    {{--            // });--}}
    {{--        });--}}
    {{--    </script>--}}
@endsection
