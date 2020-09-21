@extends('Admin::Layouts.adminlayout')

@section('GIVR','active open')
@section('tutorialimg', 'active open')

@section('pageheadcontent')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
   .list-card{
       box-shadow: 0 0 20px rgba(0,0,0,0.2); margin-bottom: 10px;
   }
        .action-icon{
            font-size: 25px !important;
            padding: 10px;
        }

        #editUserModal input {
            padding: 5px;
        }

        .link-width {
            max-width: 140px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /*Activity logs CSS*/

        /*        Media query */

        @media only screen
        and (min-device-width: 320px)
        and (max-device-width: 480px) {

            .custom_label {
                text-align: left !important;
                margin-top: 1%;
            }

            #boxscroll {
                height: 800px !important;
                overflow-y: auto;

            }

            .user-profile {
                padding: 70px 0 0 !important;
            }
        }

        /*        Ends*/
        .custom_sub_btn {
            text-align: center;
            margin: 4% 0;
        }

        .custom_label {
            text-align: right;
            margin-top: 1%;
        }

        .feeds li:hover {
            background: none;
        }

        .white-box {
            background-color: transparent;
            padding: 0px 0px;
            margin-bottom: 15px;
            color: #fff;
        }

        button.close {
            padding: 0;
            cursor: pointer;
            background: transparent;
            border: 0;
            -webkit-appearance: none;
            margin-top: -5%;
        }

        /*        Banner Style*/

        .color-1-bg {
            background: #6baba1 !important;
        }

        .color-1-font,
        .color1-price {
            color: #6baba1 !important;
        }

        .color-2-bg {
            background: #e0a32e !important;
        }

        .color-2-font,
        .color-2-price {
            color: #e0a32e !important;
        }

        .color-3-bg {
            background: #e7603b !important;
        }

        .color-3-font,
        .color-3-price {
            color: #e7603b !important;
        }

        .color-4-bg {
            background: #9ca780 !important;
        }

        .color-4-font,
        .color-4-price {
            color: #9ca780 !important;
        }

        .color-5-bg {
            background: #0970a7 !important;
        }

        .color-5-font,
        .color-5-price {
            color: #0970a7 !important;
        }

        .white-box {
            background-color: transparent;
            padding: 0px 0px;
            margin-bottom: 15px;
            color: #fff;
        }

        button.close {
            padding: 0;
            cursor: pointer;
            background: transparent;
            border: 0;
            -webkit-appearance: none;
            margin-top: -5%;
        }

        /*        Banner Style*/

        .color-1-bg {
            background: #6baba1 !important;
        }

        .color-1-font,
        .color1-price {
            color: #6baba1 !important;
        }

        .color-2-bg {
            background: #e0a32e !important;
        }

        .color-2-font,
        .color-2-price {
            color: #e0a32e !important;
        }

        .color-3-bg {
            background: #e7603b !important;
        }

        .color-3-font,
        .color-3-price {
            color: #e7603b !important;
        }

        .color-4-bg {
            background: #9ca780 !important;
        }

        .color-4-font,
        .color-4-price {
            color: #9ca780 !important;
        }

        .color-5-bg {
            background: #0970a7 !important;
        }

        .color-5-font,
        .color-5-price {
            color: #0970a7 !important;
        }

        /*        Pricing table Css*/

        .buybutton {
            background-color: #fff;
            border: none;
            color: #000;
            padding: 7px 30px;
            text-align: center;
            text-decoration: none;
            font-size: 15px;
            border-radius: 3px;
            border: 1px solid gray;
        }

        .renew {
            background-color: #DB3B5E;
            border: none;
            color: #fff !important;
            padding: 5px 60px;
            text-align: center;
            text-decoration: none;
            font-size: 15px;
            border-radius: 5px;
        }

        .buybutton:hover {
            color: #000;
        }

        .renew:hover {
            color: #000;
        }

        .boxdisplay {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 1%;
        }

        .boxdisplay .col-lg-3,
        .col-lg-4 {
            margin-bottom: 15px;
        }

        .mrg-bottm-15 {
            margin-bottom: 15px;
        }

        .mrg-bottm-15 button {
            border-radius: 5px;
        }

        .mrg-bottm-15 .badge {
            background-color: #fff;
            color: #1f1f1f;
        }

        .pricingtable a {
            color: #07405a;
        }

        .pricingtable .text-danger {
            font-size: 18px;
            font-weight: 400;
            color: #db3b5e !important;
        }

        #LatestOrders .modal-header {

            border: none !important;
        }

        /*        Tabs style*/

        /*  bhoechie tab */
        div.bhoechie-tab-container {
            z-index: 10;
            background-color: #ffffff;
            padding: 0 !important;
            border-radius: 4px;
            -moz-border-radius: 4px;
            /*  border:1px solid #ddd;*/
            margin-top: 20px;
            /*  margin-left: 50px;*/
            -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
            box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
            -moz-box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
            background-clip: padding-box;
            opacity: 0.97;
            filter: alpha(opacity=97);
        }

        div.bhoechie-tab-menu {
            padding-right: 0;
            padding-left: 0;
            padding-bottom: 0;
        }

        div.bhoechie-tab-menu div.list-group {
            margin-bottom: 0;
        }

        div.bhoechie-tab-menu div.list-group > a {
            margin-bottom: 0;
        }

        div.bhoechie-tab-menu div.list-group > a .glyphicon,
        div.bhoechie-tab-menu div.list-group > a .fa {
            color: #3C4451;
        }

        div.bhoechie-tab-menu div.list-group > a:first-child {
            border-top-right-radius: 0;
            -moz-border-top-right-radius: 0;
        }

        div.bhoechie-tab-menu div.list-group > a:last-child {
            border-bottom-right-radius: 0;
            -moz-border-bottom-right-radius: 0;
        }

        div.bhoechie-tab-menu div.list-group > a.active,
        div.bhoechie-tab-menu div.list-group > a.active .glyphicon,
        div.bhoechie-tab-menu div.list-group > a.active .fa {
            background-color: #003A55;
            /*background-image: #003A55;*/
            color: #ffffff;
        }

        div.bhoechie-tab-menu div.list-group > a.active:after {
            content: '';
            position: absolute;
            left: 100%;
            top: 50%;
            margin-top: -13px;
            border-left: 0;
            border-bottom: 13px solid transparent;
            border-top: 13px solid transparent;
            border-left: 10px solid #5A55A3;
        }

        div.bhoechie-tab-content {
            background-color: #ffffff;
            /* border: 1px solid #eeeeee; */
            padding-left: 20px;
            padding-top: 10px;
        }

        div.bhoechie-tab div.bhoechie-tab-content:not(.active) {
            display: none;
        }

        .custom_img {
            border-radius: 50%;
            display: inline-block;
        }

        #boxscroll {
            height: 800px;
            box-shadow: 4px 0 5px -2px #888;
            overflow-y: auto;

        }

        #boxscroll a {
            overflow-x: hidden;
            width: 100%;
        }

        .nicescroll-cursors {
            background-color: rgba(0, 0, 0, 0.3) !important;
        }

        #boxscroll2 {
            height: 800px;
            overflow-y: auto;

        }

        #boxscroll2 #timeline {
            overflow-x: hidden;
        }

        /*        Tooltip*/

        /*        Time line CSS*/

        #timeline {
            list-style: none;
            position: relative;
        }

        #timeline:before {
            top: 0;
            bottom: 0;
            position: absolute;
            content: " ";
            width: 2px;
            background-color: #4997cd;
            left: 50%;
            margin-left: -1.5px;
        }

        #timeline .clearFix {
            clear: both;
            height: 0;
        }

        #timeline .timeline-badge {
            color: #fff;
            width: 20px;
            height: 20px;
            font-size: 1.2em;
            text-align: center;
            position: absolute;
            top: 20px;
            left: 52%;
            margin-left: -25px;
            background-color: #4997cd;
            z-index: 100;
            border-top-right-radius: 50%;
            border-top-left-radius: 50%;
            border-bottom-right-radius: 50%;
            border-bottom-left-radius: 50%;
        }

        #timeline .timeline-badge span.timeline-balloon-date-day {
            font-size: 1.4em;
        }

        #timeline .timeline-badge span.timeline-balloon-date-month {
            font-size: .7em;
            position: relative;
            top: -10px;
        }

        #timeline .timeline-badge.timeline-filter-movement {
            background-color: #ffffff;
            font-size: 1.7em;
            height: 35px;
            margin-left: -18px;
            width: 35px;
            top: 40px;
        }

        #timeline .timeline-badge.timeline-filter-movement a span {
            color: #4997cd;
            font-size: 1.3em;
            top: -1px;
        }

        #timeline .timeline-badge.timeline-future-movement {
            background-color: #ffffff;
            height: 35px;
            width: 35px;
            font-size: 1.7em;
            top: -16px;
            margin-left: -18px;
        }

        #timeline .timeline-badge.timeline-future-movement a span {
            color: #4997cd;
            font-size: .9em;
            top: 2px;
            left: 1px;
        }

        #timeline .timeline-movement {
            border-bottom: dashed 1px #4997cd;
            position: relative;
        }

        #timeline .timeline-movement.timeline-movement-top {
            height: 60px;
        }

        #timeline .timeline-movement .timeline-item {
            padding: 20px 0;
        }

        #timeline .timeline-movement .timeline-item .timeline-panel {
            border: 1px solid #d4d4d4;
            border-radius: 3px;
            background-color: #FFFFFF;
            color: #666;
            /*padding: 10px;*/
            position: relative;
            -webkit-box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);
            box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);
        }

        #timeline .timeline-movement .timeline-item .timeline-panel .timeline-panel-ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        #timeline .timeline-movement .timeline-item .timeline-panel.credits .timeline-panel-ul {
            text-align: justify;
        }

        #timeline .timeline-movement .timeline-item .timeline-panel.credits .timeline-panel-ul li {
            color: #666;
        }

        #timeline .timeline-movement .timeline-item .timeline-panel.credits .timeline-panel-ul li span.importo {
            color: #fff;
            font-size: 1.3em;
        }

        #timeline .timeline-movement .timeline-item .timeline-panel.debits .timeline-panel-ul {
            text-align: left;
        }

        #timeline .timeline-movement .timeline-item .timeline-panel.debits .timeline-panel-ul span.importo {
            color: #fff;
            font-size: 1.3em;
        }

        #timeline .text-muted {
            color: #fff !important;
            margin-top: 1%;
        }

        .custom_dot {
            width: 10px;
            height: 10px;
            background-color: #fff;
            border-radius: 50%;
            top: -10%;
        }

        .custom_date_right {
            font-size: 16px;
            color: #003a55;
            font-weight: 600;
            text-align: left;
            margin-left: 35px;
        }

        .custom_date_left {
            font-size: 16px;
            color: #003a55;
            font-weight: 600;
            text-align: right;
            margin-right: 35px;
        }

        form.example input[type=text] {
            padding: 10px;
            font-size: 14px;
            border: 1px solid #d1cece;
            float: left;
            width: 80%;
            background: #fff;
        }

        form.example button {
            float: left;
            width: 20%;
            padding: 10px;
            background: #fff;
            color: #232121;
            font-size: 14px;
            border: 1px solid #d1cece;
            border-left: none;
            cursor: pointer;
        }

        /*
        form.example button:hover {
            background: #0b7dda;
        }
        */

        form.example::after {
            content: "";
            clear: both;
            display: table;
        }

        .custom_email {
            font-size: 11px;
            /*color: #fff;*/
        }

        .tooltip {
            position: relative;
            display: inline-block;
        }

        .tooltip .tooltiptext {
            visibility: hidden;
            width: 140px;
            background-color: #555;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 5px;
            position: absolute;
            z-index: 1;
            bottom: 150%;
            left: 50%;
            margin-left: -75px;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .tooltip .tooltiptext::after {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: #555 transparent transparent transparent;
        }

        .tooltip:hover .tooltiptext {
            visibility: visible;
            opacity: 1;
        }

    </style>

@endsection

@section('pagecontent')
    <div>
        <h4 style="text-align: center;background: #4997cd;padding: 11px 0;margin: 20px 0px;color: #fff;font-weight: 400;">
            Video Tutorials&nbsp;&nbsp;<i class="fa fa-video-camera" style="cursor:pointer;"></i></h4>
        <form class="example" style="margin:auto;max-width:70%;margin-bottom: 10px;">
            <input placeholder="Paste URL.." name="searchKey" id="url" type="text" value="">
            <button type="submit" id="addURL"><i class="fa fa-plus"></i> Add</button>
        </form>
        <div class="col-md-10 col-md-offset-1 card"
             id="boxscroll2"
             style="box-shadow: 0 0 20px rgba(0,0,0,0.2);padding: 10px 30px;height: 450px; overflow-y: scroll">
            @foreach($data as $d)
                <div class="row list-card" id="row-{{ $d['id'] }}">
                    <div class="col-md-12"
                         style="padding: 20px 0px;">
                        <div class="col-md-2">
                            <a href="{{ $d['link'] }}"
                               target="_blank"
                               rel="noopener noreferrer"
                               id="thumbnail-link-{{ $d['id'] }}">
                                <img src="{{ $d['thumbnail'] }}"
                                     id="thumbnail-{{ $d['id'] }}"
                                     width="120"
                                     height="90">
                            </a>
                        </div>
                        <div class="col-md-8"
                             style="text-align: justify">
                        <span>
                            <strong>
                                <a href="{{ $d['link'] }}"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   id="title-{{ $d['id'] }}">
                                    {{ $d['title'] }}
                                </a>
                            </strong>
                        </span>
                            <p id="description-{{ $d['id'] }}">{{ $d['description'] }}...</p>
                        </div>
                        <div class="col-md-2">
                            <div style="padding: 15px 0px">
                                <span>
                                    <a onclick="showEditModal({{ $d['id'] }})"
                                       style="cursor: pointer">
                                        <i class="fa fa-pencil action-icon"
                                           aria-hidden="true"></i>
                                    </a>
                                </span>
                                <span>
                                    <a class="delete-url"
                                       onclick="deleteTutorial({{ $d['id'] }})"
                                       style="cursor: pointer">
                                        <i class="fa fa-trash action-icon"
                                           aria-hidden="true"
                                           style="color: #e00202;" ></i>
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            {{--<div class="row list-card"  >--}}
                {{--<div class="col-md-12" style="padding: 20px 0px;">--}}
                    {{--<div class="col-md-2">--}}
                        {{--<img src="https://i.ytimg.com/vi/_Ubmc1if318/default.jpg">--}}
                    {{--</div>--}}
                    {{--<div class="col-md-8" style="text-align: justify">--}}
                        {{--<span><strong>INSTAGRAM POWERLIKES  - LIVE CASE STUDY - GO VIRAL ON IG IN 2019 &amp; BEYOND!</strong></span>--}}

                        {{--<p> ★1ST POWER LIKES VIDEO→https://www.youtube.com/watch?v=N2tR_F7Vu5M--}}
                            {{--Another heavily requested live, viral case study of me using power likes and Engageme....--}}
                        {{--</p>--}}


                    {{--</div>--}}
                    {{--<div class="col-md-2">--}}
                        {{--<div style="padding: 15px 0px">--}}
                            {{--<span><i class="fa fa-pencil action-icon" aria-hidden="true"></i></span>--}}
                            {{--<span><i class="fa fa-trash action-icon" aria-hidden="true" style="color: #e00202;" ></i></span>--}}
                        {{--</div>--}}

                        {{--&nbsp;--}}

                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="row list-card"  >--}}
                {{--<div class="col-md-12" style="padding: 20px 0px;">--}}
                    {{--<div class="col-md-2">--}}
                        {{--<img src="https://i.ytimg.com/vi/_Ubmc1if318/default.jpg">--}}
                    {{--</div>--}}
                    {{--<div class="col-md-8" style="text-align: justify">--}}
                        {{--<span><strong>INSTAGRAM POWERLIKES  - LIVE CASE STUDY - GO VIRAL ON IG IN 2019 &amp; BEYOND!</strong></span>--}}

                        {{--<p> ★1ST POWER LIKES VIDEO→https://www.youtube.com/watch?v=N2tR_F7Vu5M--}}
                            {{--Another heavily requested live, viral case study of me using power likes and Engageme....--}}
                        {{--</p>--}}


                    {{--</div>--}}
                    {{--<div class="col-md-2">--}}
                        {{--<div style="padding: 15px 0px">--}}
                            {{--<span><i class="fa fa-pencil action-icon" aria-hidden="true"></i></span>--}}
                            {{--<span><i class="fa fa-trash action-icon" aria-hidden="true" style="color: #e00202;" ></i></span>--}}
                        {{--</div>--}}

                        {{--&nbsp;--}}

                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="row list-card"  >--}}
                {{--<div class="col-md-12" style="padding: 20px 0px;">--}}
                    {{--<div class="col-md-2">--}}
                        {{--<img src="https://i.ytimg.com/vi/_Ubmc1if318/default.jpg">--}}
                    {{--</div>--}}
                    {{--<div class="col-md-8" style="text-align: justify">--}}
                        {{--<span><strong>INSTAGRAM POWERLIKES  - LIVE CASE STUDY - GO VIRAL ON IG IN 2019 &amp; BEYOND!</strong></span>--}}

                        {{--<p> ★1ST POWER LIKES VIDEO→https://www.youtube.com/watch?v=N2tR_F7Vu5M--}}
                            {{--Another heavily requested live, viral case study of me using power likes and Engageme....--}}
                        {{--</p>--}}


                    {{--</div>--}}
                    {{--<div class="col-md-2">--}}
                        {{--<div style="padding: 15px 0px">--}}
                            {{--<span><i class="fa fa-pencil action-icon" aria-hidden="true"></i></span>--}}
                            {{--<span><i class="fa fa-trash action-icon" aria-hidden="true" style="color: #e00202;" ></i></span>--}}
                        {{--</div>--}}

                        {{--&nbsp;--}}

                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="row list-card"  >--}}
                {{--<div class="col-md-12" style="padding: 20px 0px;">--}}
                    {{--<div class="col-md-2">--}}
                        {{--<img src="https://i.ytimg.com/vi/_Ubmc1if318/default.jpg">--}}
                    {{--</div>--}}
                    {{--<div class="col-md-8" style="text-align: justify">--}}
                        {{--<span><strong>INSTAGRAM POWERLIKES  - LIVE CASE STUDY - GO VIRAL ON IG IN 2019 &amp; BEYOND!</strong></span>--}}

                        {{--<p> ★1ST POWER LIKES VIDEO→https://www.youtube.com/watch?v=N2tR_F7Vu5M--}}
                            {{--Another heavily requested live, viral case study of me using power likes and Engageme....--}}
                        {{--</p>--}}


                    {{--</div>--}}
                    {{--<div class="col-md-2">--}}
                        {{--<div style="padding: 15px 0px">--}}
                            {{--<span><i class="fa fa-pencil action-icon" aria-hidden="true"></i></span>--}}
                            {{--<span><i class="fa fa-trash action-icon" aria-hidden="true" style="color: #e00202;" ></i></span>--}}
                        {{--</div>--}}

                        {{--&nbsp;--}}

                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}


        </div>


        {{-- Modal--}}

        <div id="edit" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header" style="background: linear-gradient(-45deg, #095166, #095166); color: #fff;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Edit URL</h4>
                    </div>
                    <div class="modal-body">

                        <form class="example" style="margin:auto;max-width:70%;margin-bottom: 10px;">
                            <input placeholder="Paste URL.." name="searchKey" type="text" id="editURL" value="">
                            <input type="hidden" id="editID" value="">
                        </form>

                    </div>
                    <div class="modal-footer" style="background: linear-gradient(-45deg, #095166, #5e8050); color: #fff;">

                        <button type="button" class="btn btn-success" onclick="updateURL()" title="Update"><span>Update</span>
                        </button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>


    </div>
@endsection

@section('pagescripts')

    <script src="/GAIA/assets/global/scripts/jquery.nicescroll.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.6/dist/loadingoverlay.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <script>

        $(document).ready(function () {

            $("#boxscroll2").niceScroll({
                cursorborder: "",
                cursorcolor: "#00F",
                boxzoom: false
            });

            $('#addURL').click(function(e) {
                e.preventDefault();
                getDetails();
            });

            $("#edit").on('hidden.bs.modal', function (e) {
                // $('.passwordSave').css('display', 'none');
                //console.log('Cleared');
                $('#editURL').val('');
                $('#editID').val('');
            });

        });

        function getDetails() {
            const $url = $('#url');
            const url = $url.val();
            //console.log(url);
            if (url === null || url === undefined || url === '') {
                $url.focus();
                swal('Enter a Valid URL First!');
            } else {
                $.ajax({
                    url: '/admin/getDetailsAJAXHandler',
                    type: 'get',
                    dataType: 'json',
                    data: {
                        url: url
                    },
                    success: (response) => {
                        //console.log();
                        if (response['status'] === 'SUCCESS') {
                            const div = `
                                    <div class="row list-card"
                                         id="row-${response['id']}">
                                        <div class="col-md-12"
                                             style="padding: 20px 0px;">
                                            <div class="col-md-2">
                                                <a href="${response['link']}"
                                                   target="_blank"
                                                   rel="noopener noreferrer"
                                                   id="thumbnail-link-${response['id']}">
                                                    <img src="${response['thumbnail']}"
                                                         id="thumbnail-${response['id']}"
                                                         width="120"
                                                         height="90">
                                                </a>
                                            </div>
                                            <div class="col-md-8"
                                                 style="text-align: justify">
                                            <span>
                                                <strong>
                                                    <a href="${response['link']}"
                                                       target="_blank"
                                                       rel="noopener noreferrer"
                                                       id="title-${response['id']}">
                                                        ${response['title']}
                                                    </a>
                                                </strong>
                                            </span>
                                                <p id="description-${response['id']}">
                                                    ${response['description']}...
                                                </p>
                                            </div>
                                            <div class="col-md-2">
                                                <div style="padding: 15px 0px">
                                                <span>
                                                    <a onclick="showEditModal(${response['id']})"
                                                       style="cursor: pointer;">
                                                        <i class="fa fa-pencil action-icon"
                                                           aria-hidden="true"></i>
                                                    </a>
                                                </span>
                                                    <span>
                                                    <a class="delete-url"
                                                       onclick="deleteTutorial(${response['id']})"
                                                       style="cursor: pointer;">
                                                    <i class="fa fa-trash action-icon"
                                                       aria-hidden="true"
                                                       style="color: #e00202;" ></i>
                                                </a>
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                `;
                            $('#boxscroll2').prepend(div);
                            swal('Video Added!', {
                                icon: 'success'
                            });
                        } else if (response['status'] === 'EXISTS'){
                            swal('Video already present in database!', {
                                icon: 'warning'
                            });
                        } else {
                            swal('Invalid Link!', {
                                icon: 'error'
                            });
                        }
                        $('#url').val('');
                    },
                    error: (response) => {
                        console.log(response);
                        swal('Unknown error occured! Contact Support.', {
                            icon: 'error'
                        });
                    }
                });
            }
        }
        function showEditModal(id) {
            $.ajax({
                url: '/admin/getTutorialUrlAJAXHandler',
                type: 'get',
                dataType: 'json',
                data: {
                    id: id
                },
                success: (response) => {
                    if (response['status'] === 'SUCCESS') {
                        $('#editURL').val(response['link']);
                        $('#editID').val(id);
                        $('#edit').modal('show');
                    } else {
                        swal('Something bad happened! Try again.');
                    }
                },
                error: (response) => {
                    console.log(response);
                    swal('Unknown error occured! Contact Support.', {
                        icon: 'error'
                    });
                }
            });
        }

        function updateURL() {
            const id = $('#editID').val();
            $.ajax({
                url: '/admin/updateURLAJAXHandler',
                type: 'get',
                dataType: 'json',
                data: {
                    id: id,
                    link: $('#editURL').val()
                },
                success: (response) => {
                    if (response['status'] === 'SUCCESS') {
                        $('#edit').modal('hide');
                        $('#thumbnail-' + id).attr('src', response['thumbnail']);
                        $('#title-' + id).text(response['title']);
                        $('#description-' + id).text(response['description']);
                        $('#title-' + id).attr('href', response['link']);
                        $('#thumbnail-link-' + id).attr('href', response['link']);
                        swal('Video URL changed successfully!', {
                            icon: 'success'
                        });
                    } else {
                        if (response['status'] === 'EXISTS'){
                            $('#edit').modal('hide');
                            swal('No changes made.', {
                                icon: 'info'
                            });
                        } else {
                            $('#edit').modal('hide');
                            swal('Invalid Link!', {
                                icon: 'error'
                            })
                        }
                    }
                },
                error: (response) => {
                    console.log(response);
                    $('#edit').modal('hide');
                    swal('Unknown error occured! Contact Support.', {
                        icon: 'error'
                    });
                }
            });
        }

        function deleteTutorial(id) {
            swal({
                title: "Are you sure?",
                //text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: '/admin/deleteVideoAJAXHandler',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: id
                        },
                        success: (response) => {
                            if (response['status'] === 'SUCCESS') {
                                $('#row-' + id).remove();
                                swal("Video has been deleted!", {
                                    icon: "success",
                                });
                            } else {
                                swal("Unable to delete Video!", {
                                    icon: "warning",
                                });
                            }
                        }
                    });
                }// else {
                //     swal("Your imaginary file is safe!");
                // }
            })
        }

    </script>
@endsection