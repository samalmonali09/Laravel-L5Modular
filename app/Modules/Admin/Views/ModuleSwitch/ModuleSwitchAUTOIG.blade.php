@extends('Admin::Layouts.adminlayout')
@section('AUTOIG','active open')
@section('Module3','active open')

@section('pageheadcontent')
    <!-- add extra css required for this page only -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

    <style>

        div.checker, div.checker span, div.checker input {
            height: 100% !important;
        }

        .toggle-on.btn {
            /*padding-right: 0 !important;*/
            padding-top: 10px;
        }

        .toggle-off.btn {
            /*padding-left: 0 !important;*/
            padding-top: 10px;
        }

        .checker {
            float: right;
            right: 40px;
        }

        .btn-file {
            position: relative;
            overflow: hidden;
        }

        .btn-file input[type=file] {
            position: absolute;
            top: 0;
            right: 0;
            min-width: 100%;
            min-height: 100%;
            font-size: 100px;
            text-align: right;
            filter: alpha(opacity=0);
            opacity: 0;
            outline: none;
            background: white;
            cursor: inherit;
            display: block;
        }

        #img-upload {
            width: 40%;

        }

    </style>



@endsection

@section('pagecontent')

    <h3 class="page-title" style="color: #0d3625">
        Module Switch

    </h3>

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="/admin/module-statusAUTOIG">Module Switch </a>
            </li>
        </ul>
    </div>
    {{--<div class="col-md-4 col-md-offset-4">--}}
    {{--<div class="card" style="margin: 15px; border:1px solid #ccc; padding: 20px; font-size: 16px;">--}}

    {{--Black Hat Module <input data-toggle="toggle" type="checkbox" id="checkbox" style="float: right;">--}}
    {{--</div>--}}
    {{--</div>--}}


    <div class="col-md-4 col-md-offset-4">
        <div class="card" style="margin: 15px; border:1px solid #ccc; padding: 20px; font-size: 16px;">

            Black Hat Module <input data-toggle="toggle" type="checkbox" id="checkbox" style="float: right;">
        </div>
    </div>

    <div class="col-md-4 col-md-offset-4">
        {{--<div class="card" style="margin: 15px; border:1px solid #ccc; padding: 20px; font-size: 16px;">--}}
        <p class="onmsg" style="background: #104d40;
        display: none;
        padding: 10px;
        color: #fff;
        box-shadow: 0px 0px 5px #000000;
        position: absolute;
        margin-top: -38%;margin-right: -109%;"></p><br>
        {{--<label for="flip-checkbox-1">Status</S>:</label>--}}

    </div>

    {{--<div class="col-md-4 col-md-offset-4 card1" style="margin-top: 10px;">--}}
    {{--<h4 style="margin-left: 13px; font-weight: bold;">White Hat Banner</h4>--}}
    {{--<div class="card1" style="margin: 15px; border:1px solid #ccc; padding: 20px 20px 10px; font-size: 16px;">--}}
    {{--<div class="form-group">--}}
    {{--<label>Upload Image</label>--}}
    {{--<div class="input-group">--}}
    {{--<span class="input-group-btn">--}}
    {{--<span class="btn btn-default btn-file">--}}
    {{--Browse… <input type="file" id="imgInp">--}}
    {{--</span>--}}
    {{--</span>--}}
    {{--<input type="text" class="form-control" readonly>--}}
    {{--</div>--}}
    {{--<img id='img-upload' src="{{$image}}"/>--}}
    {{--</div>--}}
    {{--<hr>--}}
    {{--<a class="btn btn-success saveButton">Save</a>--}}
    {{--</div>--}}

    {{--</div>--}}


@endsection

@section('pagescripts')

    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="/GAIA/assets/admin/pages/scripts/toastr.js" type="text/javascript"></script>

    <script>
        $(document).ready(function () {
            toastr.options.positionClass = 'toast-top-center';
            toastr.options.progressBar = true;
            toastr.options.preventDuplicates = true;
            toastr.options.closeButton = true;

            $('input[type="search"]').css({'height': '5px'});
            $('.toggle').removeClass('btn-primary');


        });


        if ('{{$status}}' === 'ON') {
            $('#checkbox').prop("checked", true);
        }

        $(document).ready(function () {
            $(document).on('change', '.btn-file :file', function () {
                var input = $(this),
                    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                input.trigger('fileselect', [label]);
            });

            $('.btn-file :file').on('fileselect', function (event, label) {

                var input = $(this).parents('.input-group').find(':text'),
                    log = label;

                if (input.length) {
                    input.val(log);
                } else {
                    if (log) alert(log);
                }

            });
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#img-upload').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#imgInp").change(function () {
                readURL(this);
            });

//            $('#checkbox').on('switchChange.bootstrapSwitch', function (e, data) {
            $("#checkbox").change(function () {
                var message = ''

                if (this.checked) {
                    message = 'ON'
                    $('.onmsg').show();
                    setTimeout(function () {
                        $('.onmsg').hide();
                    }, 2000)
                    $(".onmsg").html("<b>pop-up</b> will be displayed in app ");
                    console.log('++++++++++++')
                    niche_id = 1;

                } else {
                    console.log('______________')
                    message = 'OFF'
                    $('.onmsg').show();
                    setTimeout(function () {
                        $('.onmsg').hide();
                    }, 2000)
                    niche_id = 0;
                    $(".onmsg").html("app will OFF  <b>pop-up</b>");

                }
                $.ajax({
                    url: '/admin/module-statusAUTOIG',
                    dataType: 'json',
                    type: 'post',
                    data: {
                        'module_switchAUTOIG': message
                    },


                })

            });



        });
    </script>
@endsection
