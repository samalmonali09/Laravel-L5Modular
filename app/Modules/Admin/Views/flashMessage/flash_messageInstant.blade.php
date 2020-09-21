{{--/**--}}
{{--* Created by Monali Samal--}}
{{--* User: Monalisamal@globussoft.in<MONALI SAMAL>--}}
{{--* Date: 5/2/2018--}}
{{--* Time: 11:59 AM--}}
{{--*/--}}


@extends('Admin::Layouts.adminlayout')
@section('GIL','active')
@section('ILFN','active')

@section('pagecontent')
    <!-- BEGIN PAGE HEADER-->

@section('pagecontent')
    <!-- BEGIN PAGE HEADER-->

    <link rel="shortcut icon" href="favicon.ico"/>

    @if (session('status'))
        <div class="alert alert-info">
            {{ session('status') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-success">
            {{ session('error') }}
        </div>
    @endif
    <h3 class="page-title"  style="color: #06738b">
        Flash Message
        <small>Popup screen for mobile</small>
    </h3>
    <form class="pull-right">
        <p class="onmsg" style="background: #49c6f5;
           padding: 10px;
           color: #fff;
           box-shadow: 0px 0px 5px #000000;
           position: absolute;
           margin-top: -4%;margin-left:1%;"></p>

        <label for="flip-checkbox-1">Flash Message Status</S>:</label>
        <input data-role="flipswitch" value="{{$msg_status}}" name="flip-checkbox-1" id="checkbox" class="make-switch"
               type="checkbox">    </form>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    <div class="portlet-body">
        <div class="tabs-left row">
            <div class="col-md-12 col-xs-12">
                {{--@if (session('status'))--}}
                {{--<div class="alert alert-info">--}}
                {{--{{ session('status') }}--}}
                {{--</div>--}}
                {{--@endif--}}
                {{--@if (session('error'))--}}
                {{--<div class="alert alert-success">--}}
                {{--{{ session('error') }}--}}
                {{--</div>--}}
                {{--@endif--}}
                <div class="row" >
                    <div class="col-lg-12">
                        <div class="row">
                            <form method="post" >
                                <div class="form-group ">
                                    <label for="summary-ckeditor">Body</label>
                                    <textarea name="summary" required class="form-control"  id="summary-ckeditor">{{$data}}</textarea>
                                </div>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- END PAGE CONTENT-->
@endsection
@section('pagescripts')
    {{--<script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>--}}
    <script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
    <script>

        CKEDITOR.replace('summary-ckeditor');
        $('.onmsg').hide();
        if ($("#checkbox").val() == 'ON') {
            $('#checkbox').prop('checked', true);
        }


        $('#checkbox').on('switchChange.bootstrapSwitch', function (e, data) {
            var message = ''

            if (this.checked) {
                message = 'ON'
                $('.onmsg').show();
                setTimeout(function () {
                    $('.onmsg').hide();
                }, 2000)
                $(".onmsg").html("<b>pop-up</b> will be displayed in app ");

            } else {
                message = 'OFF'
                $('.onmsg').show();
                setTimeout(function () {
                    $('.onmsg').hide();
                }, 2000)

                $(".onmsg").html("app will open without  <b>pop-up</b>");

            }
            $.ajax({
                url: '/admin/flash-message-Instastatus',
                dataType: 'json',
                type: 'post',
                data: {
                    'registered_through': message
                },


            })

        });
    </script>
@endsection





