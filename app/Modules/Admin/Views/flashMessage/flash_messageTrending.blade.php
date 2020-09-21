@extends('Admin::Layouts.adminlayout')
@section('TrendApp','active')
@section('Hashtag1','active')

@section('pagecontent')
    <!-- BEGIN PAGE HEADER-->

    <link rel="shortcut icon" href="favicon.ico"/>

    <style>
        textarea {
            resize: both;
        }

        .onoffswitch {
            position: relative;
            width: 130px !important;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
        }

        .onoffswitch-checkbox {
            display: none;
        }

        .onoffswitch-label {
            display: block;
            overflow: hidden;
            cursor: pointer;
            border: 2px solid #999999;
            border-radius: 20px;
        }

        .onoffswitch-inner {
            display: block;
            width: 200%;
            margin-left: -100%;
            -moz-transition: margin 0.3s ease-in 0s;
            -webkit-transition: margin 0.3s ease-in 0s;
            -o-transition: margin 0.3s ease-in 0s;
            transition: margin 0.3s ease-in 0s;
        }

        .onoffswitch-inner:before, .onoffswitch-inner:after {
            display: block;
            float: left;
            width: 50%;
            height: 30px;
            padding: 0;
            line-height: 30px;
            font-size: 14px;
            color: white;
            font-family: Trebuchet, Arial, sans-serif;
            font-weight: bold;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        .onoffswitch-inner:before {
            content: "ON";
            padding-left: 10px;
            background-color: #2FCCFF;
            color: #FFFFFF;
        }

        .onoffswitch-inner:after {
            content: "OFF";
            padding-right: 10px;
            background-color: #EEEEEE;
            color: #999999;
            text-align: right;
        }

        .onoffswitch-switch {
            display: block;
            width: 18px;
            margin: 6px;
            background: #FFFFFF;
            border: 2px solid #999999;
            border-radius: 20px;
            position: absolute;
            top: 0;
            bottom: 0;
            right: 56px;
            -moz-transition: all 0.3s ease-in 0s;
            -webkit-transition: all 0.3s ease-in 0s;
            -o-transition: all 0.3s ease-in 0s;
            transition: all 0.3s ease-in 0s;
        }

        .onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-inner {
            margin-left: 0;
        }

        .onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-switch {
            right: 0px;
        }

        [type="checkbox"] + label {
            position: relative;
            padding-left: 0px;
            cursor: pointer;
            display: block;
            height: 34px;
            line-height: 25px;
            font-size: 13px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -khtml-user-select: none;
            -ms-user-select: none;
        }

        [type="checkbox"]:checked + label::before {
            display: none;
        }

        [type="checkbox"] + label::before, [type="checkbox"]:not(.filled-in) + label::after {

            display: none;
        }

        .row {
            margin-left: -6px !important;
        }

        input[type="color"] {
            width: 45px;
            height: 20px;
        }


    </style>

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
    <h3 class="page-title" style="color: #06738b">
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
               type="checkbox"></form>
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
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <form method="post">
                                <div class="form-group ">
                                    <label for="summary-ckeditor">Body</label>
                                    <textarea name="summary" required class="form-control"
                                              id="summary-ckeditor">{{$data}}</textarea>
                                </div>
                                <div class="row">
                                    <div>
                                        {{--<div style="position:relative; display:inline-block">--}}

                                            {{--BackGround ColorPiker: <input type="color" class="btn btn-secondary"--}}
                                                                          {{--id="backgroudId" name="BGCOL"--}}
                                                                          {{--value={{$bgColor}} />--}}
                                        {{--</div>--}}
                                        {{--<div style="position:relative; display:inline-block">--}}

                                            {{--Title ColorPiker: <input type="color" class="btn btn-secondary" id="titleId"--}}
                                                                     {{--name="TTLCOL" value={{$ttlColor}} />--}}

                                        {{--</div>--}}
                                        {{--<div style="position:relative; display:inline-block">--}}

                                            {{--Paragraph ColorPiker: <input type="color" class="btn btn-secondary" id="pId"--}}
                                                                         {{--name="CONTCOL" value={{$pColor}} />--}}

                                        {{--</div>--}}
                                        <div style="position:relative; display:inline-block">
                                            <span>BackGround ColorPiker:</span><input type="color" id="backgroudId" name="BGCOL" value={{$bgColor}} >
                                        </div>
                                        <div style="position:relative; display:inline-block"><span>

                                            Title ColorPiker:</span><input type="color"  id="titleId"
                                                                           name="TTLCOL" value={{$ttlColor}} />

                                        </div>
                                        {{--<input type="color" name="fcolor" value={{$bgColor}} >--}}
                                        <div style="position:relative; display:inline-block"><span>

                                            Paragraph ColorPiker: </span><input type="color"  id="pId"
                                                                                name="CONTCOL" value={{$pColor}} />

                                        </div>
                                    </div>
                                </div>
                                <button type="button" id="submit" class="btn btn-success">Submit</button>
                            </form>

                        </div>
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
        var backgroudVal;
        var titleVal;
        var paraVal;
        var content;
        $(document.body).on('click', '#submit', function () {
            var gift_icon_content = CKEDITOR.instances['summary-ckeditor'].getData();
            var backgroudVal = $('#backgroudId').val();
            var titleVal = $('#titleId').val();
            var paraVal = $('#pId').val();
            $.ajax({
                url: "/admin/flashMessageTrending",
                type: "post",
                dataType: "json",
                data: {
                    backgroudVal: backgroudVal,
                    titleVal: titleVal,
                    paraVal: paraVal,
                    gift_icon_content: gift_icon_content
                },
                success: function (response) {
                    toastr.success(response.message, {timeOut: 3000});
                }
            });
        });

        $(document.body).on('click', '#preview', function () {
            window.myVar = '{{ env('APP_URL') }}';
            window.open("/gift_icon_eng.html", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=500,left=500,width=600, height=600", location.reload(true));
        });


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
                url: '/admin/flashmessageStatusTrending',
                dataType: 'json',
                type: 'post',
                data: {
                    'registered_through': message
                },


            })

        });
    </script>
@endsection




