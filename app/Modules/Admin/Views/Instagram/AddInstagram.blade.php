{{--/**--}}
{{--* Created by Monali Samal.--}}
{{--* User: Monali Samal<monalisamal@globussoft.in>--}}
{{--* Date: 3/19/2018--}}
{{--* Time: 10:53 AM--}}
{{--*/--}}


@extends('Admin::Layouts.adminlayout')
@section('INSTASTAT','active open')
@section('Instgram','active open')




@section('pagecontent')


    <style>
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

        /*        Pricing table Css*/

        .price {
            list-style-type: none;
            border: 1px solid #eee;
            margin: 0;
            padding: 0;
            -webkit-transition: 0.3s;
            transition: 0.3s;
        }

        .price:hover {
            box-shadow: 0 8px 12px 0 rgba(0, 0, 0, 0.2)
        }

        .price .header {
            background-color: #111;
            color: white;
            font-size: 25px;
        }

        .price li {
            border-bottom: 1px solid #ADADAE;
            padding: 17px;
            text-align: center;
            color: #fff;
            background: #9ea1ad;
        }

        .price .grey {
            background-color: #6a6f84;
            font-size: 20px;
            height: 60px;
        }

        .buybutton {
            background-color: #1FBA9B;
            border: none;
            color: white;
            padding: 4px 38px;
            text-align: center;
            text-decoration: none;
            font-size: 18px;
        }

        .buybutton:hover {
            color: #000;
        }

        .boxdisplay {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 1%;
            margin-right: 5%;
        }

        .boxdisplay .col-lg-3, .col-lg-4 {
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

        /* Posts Css */

        .new-deal {
            width: 100%;
            padding: 15px 0;
        }

        .new-deal .item-slide {
            height: 240px;
            margin: 15px 0;
            position: relative;
            overflow: hidden;
            transition: all .5s ease;
            width: 240px;
            -moz-transition: all .5s ease;
            -webkit-transition: all .5s ease;
        }

        .new-deal .slide-hover {
            position: absolute;
            height: 100%;
            width: 100%;
            left: -100%;
            background: rgba(0, 0, 0, .5);
            top: 0;
            transition: all .5s ease;
            -moz-transition: all .5s ease;
            -webkit-transition: all .5s ease;
            -moz-border-radius: 5px;
            border-radius: 5px;
            -webkit-border-radius: 5px;
        }

        .new-deal .item-slide:hover .slide-hover {
            left: 0px;
        }

        .new-deal img {
            max-width: 100%;
        }

        .text-wrap {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            color: #fff;
            /*            background: rgba(0, 0, 0, .5);*/
            z-index: 999;
            transition: all .5s ease;
            -moz-transition: all .5s ease;
            -webkit-transition: all .5s ease;
        }

        .text-wrap i {
            font-size: 20px;
        }

        .text-wrap1 {
            position: absolute;
            top: 38.5%;
            left: 0;
            width: 100%;
            color: #fff;
            /*            background: rgba(0, 0, 0, .5);*/
            z-index: 999;
            transition: all .5s ease;
            -moz-transition: all .5s ease;
            -webkit-transition: all .5s ease;
            text-align: center;
        }

        .text-wrap1 i {
            font-size: 20px;
            opacity: 0.8;
        }

        .text-wrap h4 {
            padding: 0 5px;
        }

        .box-img {
            width: 100%;
            float: left;
            -moz-border-radius: 5px;
            border-radius: 5px;
            -webkit-border-radius: 5px;
            overflow: hidden;
            border: 1px solid #ccc;
        }

        .text-wrap .desc {
            width: 50%;
            float: left;
            padding: 0 5px;
        }

        .text-wrap p {
            padding: 15px;
            font-size: 15px;
            text-align: center;
            font-weight: normal;
            text-shadow: 2px 2px 3px #000;
        }

        .text-wrap .desc h4 {
            margin: 0px;
            font: 400 17px/21px "Roboto";
        }

        .text-wrap .desc h3 {
            margin: 0px;
            font: 400 32px/36px "Roboto";
        }

        .new-deal .item-slide:hover .text-wrap {
            background: none
        }

        .book-now-c {
            float: right;
            padding: 10px;
        }

        .book-now-c a {
            background: #029a8b;
            color: #fff;
            padding: 5px;
            border-radius: 5px;
            margin-top: 0px;
            float: left;
            min-width: 101px;
            text-align: center;
            font-size: 16px;
        }

        .new-deal .item-slide:hover .box-img .text-wrap {
            bottom: -100%;
        }

        /*Posts css Ends */

        .confiramorder {
            display: none;
        }

        #LatestOrders .modal-dialog {
            margin: 15% auto;
        }

        .error {
            color: red;
        }

        .tick:before {
            content: "\2713";
            color: darkgreen;
        }

        /*  Comment CSS  STRAT    */
        .holder {
            width: 290px;
            /*margin: 39px auto;*/
            margin: 0 auto;
            font-family: arial, sans serif;
            font-size: 12px;
            z-index: 9999999;
        }

        .box {
            float: left;
            width: 240px;
            /*            background-image: -webkit-linear-gradient(bottom left, #484747 10%, #434343);*/
            padding: 5px;
            border-radius: 32px 0px 0px 32px;
            box-shadow: 0 1px 1px #999;
            -webkit-animation: slidein 0.5s;
            border: 1px solid #454343;
        }

        .user-pic {
            float: left;
            width: 25px;
            height: 25px;
            margin-top: 4%;
        }

        .user-pic img {
            border-radius: 100%;
            box-shadow: 0 0 20px 0 #fff;
            /*            -webkit-animation: turnpic 1s infinite alternate;*/
        }

        .user-pic img:hover {
            -webkit-animation-play-state: paused;
            -webkit-filter: sepia(100%);
            cursor: move;
        }

        .comment-box {
            float: left;
            width: 200px;
            margin-left: 3px;
        }

        .comment-box textarea {
            width: 205px;
            height: 35px;
            padding: 8px;
            margin: 5px 0 3px 0;
            border: 1px solid #3b3a3a;
            box-shadow: inset 0 0 8px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            font-family: 'arial', 'sans serif';
            background: #111010;
        }

        @-webkit-keyframes turnpic {
            0% {
                -webkit-transform: rotate(45deg);
            }
            50% {
                -webkit-transform: rotate(50deg);
            }
            100% {
                -webkit-transform: rotate(55deg);
            }
        }

        @-webkit-keyframes slidein {
            from {
                margin-left: 100%;
                width: 300%
            }
            to {
                margin-left: 0%;
                width: 100%;
            }
        }

        .comment-count {
            background-color: white;
            border-radius: 50%;
            color: #e63316;
            font-size: 15px;
            font-weight: bold;
            height: 100%;
            margin-top: 10px;
            padding-top: 3px;
        }

        textarea {
            resize: none;
        }

        /*  Comment CSS  END    */

        /*CSS for top-search start*/
        ._etpgz {
            background-color: #d4edea;
            border: 7px black;
            /*height: 0px;*/
            margin-top: 10px;
            max-height: 200px;
            overflow-x: hidden;
            overflow-y: auto;
        }

        ._etpgz :hover {
            background-color: #bebebe;
            /*overflow-y: scroll;*/
        }

        ._o92vn {
            -webkit-box-direction: normal;
            align-items: center;
            border-bottom: solid 1px #6d6980;
            cursor: pointer;
            display: flex;
            margin-right: 0;
            padding: 5px 20px;
            white-space: nowrap;
            width: 100%;
        }

        ._fehpt {
            border-radius: 30px;
            height: 30px;
            margin: 0 10px 0 0;
            width: 30px;
        }

        ._lv0uf, ._2ph7c {
            font-size: 14px;
            text-align: left;
            width: 0;
        }

        ._b01op {
            display: inline-block;
            font-weight: 600;
            /*line-height: 22px;*/
            /*margin-bottom: -4px;*/
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            width: 190px;
        }

        ._4el3l {
            display: inline-block;
            margin-left: 5px;
            /*margin-top: 4px;*/
        }

        .coreSpriteVerifiedBadgeSmall {
            background-image: url(/assets/images/instaIcons.png);
            background-position: -394px -114px;
            height: 18px;
            width: 18px;
        }

        ._2ph7c {
            font-weight: 300;
            line-height: 22px;
            overflow: hidden;
            text-overflow: ellipsis;
            color: #999;
        }

        /* width */
        ._etpgz::-webkit-scrollbar {
            width: 5px;
        }

        /* Track */
        ._etpgz::-webkit-scrollbar-track {
            box-shadow: inset 0px 0 5px grey;
            border-radius: 1px;
        }

        /* Handle */
        ._etpgz::-webkit-scrollbar-thumb {
            background: #a9a9a7;
            border-radius: 10px;
        }

        /* Handle on hover */
        ._etpgz::-webkit-scrollbar-thumb:hover {
            background: #e75577;
        }

        /*CSS for top-search end*/

    </style>
    <h1 class="page-title" style="color:#0a4063">Add <Instagram></Instagram></h1>
    <div class="row" style="min-height:470px;">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                </div>
                <div class="panel-body" style="color: rebeccapurple">

                    @if (session('packageMsg'))
                        <div class="alert alert-success">
                            {{ session('packageMsg') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                        <div class="modal-content buylikesmodal">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                {{--<h4 class="modal-title" style="text-align: center;color:#fff ;">Buy {{$name}} </h4>--}}
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-6 offset-lg-4">
                                        <img src="/assets/images/instagram.png" width="150px">
                                    </div>
                                    <div class="col-lg-8 offset-lg-2">
                                        <div class="form-group" style="text-align:center;color: #000;">
                                            <label class="message">Enter Instagram Username</label>
                                            <input type="text" class="form-control" name="username" autocomplete="off" id="username"
                                                   placeholder="Instagram User Name">

                                            <div class="_etpgz">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 offset-lg-2">
                                        <div class="form-group">
                                            <button class="btn btn-success usernameBtn" style="width: 100%;" data-toggle="modal">
                                                Submit &nbsp;
                                                <i class="fa fa-spinner fa-spin" style="font-size:24px;display:none;"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>

    {{--<div class="modal-content confiramorder" style="border: 5px solid #1fba9b;">--}}
        {{--<!-- Modal Header -->--}}
        {{--<div class="modal-header" style="background-color: #1fba9b;">--}}
            {{--<h4 class="modal-title" style="text-align: center;color:#fff;">Confirrm Order </h4>--}}
            {{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
        {{--</div>--}}
        {{--<!-- Modal body -->--}}
        {{--<div class="modal-body">--}}
            {{--<div class="row">--}}
                {{--<div class="boxdisplay">--}}
                    {{--<label>Make sure Profile is public until order is completed</label>--}}
                    {{--<img src="assets/images/logo-icon.png" class="img-circle profile_pic"--}}
                         {{--style="height:150px;width:150px;">--}}
                {{--</div>--}}
                {{--<div class="col-lg-8 offset-lg-2">--}}
                    {{--<div class="form-group" style="text-align:center;color: #000;">--}}
                        {{--<label>Confirm currrent Account</label><br>--}}
                        {{--<button class="btn confirmAccount btn-success confirmsubmit" data-dismiss="modal"--}}
                                {{--data-package>YES--}}
                        {{--</button>--}}
                        {{--<button class="btn confirmAccount btn-danger notconfirmed">NO</button>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="row">--}}
                {{--<div class="col-lg-12 boxdisplay userAccnStats">--}}
                    {{--<div class="col-lg-4">--}}
                        {{--<div class="col-lg-12"--}}
                             {{--style="text-align: center;background: #E56969;color:#fff;padding:10px;">--}}
                            {{--Posts <br> <span>889</span></div>--}}
                    {{--</div>--}}
                    {{--<div class="col-lg-4">--}}
                        {{--<div class="col-lg-12"--}}
                             {{--style="text-align: center;background: #C1558B;color:#fff;padding:10px;">--}}
                            {{--Followers <br> <span>89789</span></div>--}}
                    {{--</div>--}}
                    {{--<div class="col-lg-4">--}}
                        {{--<div class="col-lg-12"--}}
                             {{--style="text-align: center;background: #8A49A1;color:#fff;padding:10px;">--}}
                            {{--Following <br> <span>90987</span></div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

    {{--</div>--}}

    {{--</div>--}}
    {{--</div>--}}



    <div class="modal-content confiramorder" style="border: 5px solid #1fba9b;">
        <!-- Modal Header -->
        <div class="modal-header" style="background-color: #1fba9b;">
            <h4 class="modal-title" style="text-align: center;color:#fff;">Confirrm Order </h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
            <div class="row">
                <div class="boxdisplay">
                    <label>Make sure Profile is public until order is completed</label>
                    <img src="assets/images/logo-icon.png" class="img-circle profile_pic"
                         style="height:150px;width:150px;">
                </div>
                <div class="col-lg-8 offset-lg-2">
                    <div class="form-group" style="text-align:center;color: #000;">
                        <label>Confirm currrent Account</label><br>
                        <button class="btn confirmAccount btn-success confirmsubmit" data-dismiss="modal"
                                data-package>YES
                        </button>
                        <button class="btn confirmAccount btn-danger notconfirmed">NO</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 boxdisplay userAccnStats">
                    <div class="col-lg-4">
                        <div class="col-lg-12"
                             style="text-align: center;background: #E56969;color:#fff;padding:10px;">
                            Posts <br> <span>889</span></div>
                    </div>
                    <div class="col-lg-4">
                        <div class="col-lg-12"
                             style="text-align: center;background: #C1558B;color:#fff;padding:10px;">
                            Followers <br> <span>89789</span></div>
                    </div>
                    <div class="col-lg-4">
                        <div class="col-lg-12"
                             style="text-align: center;background: #8A49A1;color:#fff;padding:10px;">
                            Following <br> <span>90987</span></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection


@section('pagescripts')
    <script type="text/javascript">

        $(document).ready(function () {

        });




        $(document).on('keyup', '#username', function (e) {
            userName = $(this).val();
            if ($.trim(userName) !== '') {
                if (e.which === 13) {
                    getUsersInstaMedias(userName, 'usernameBtn');
                } else {
                    $.ajax({
                        url: '/admin/packageAjaxHandlerinstgram',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            method: 'getTopSearch',
                            keyWord: userName
                        }
                    }).success(function (response) {
                        if (response.topSearch) {
                            let option = '';
                            $.each(response.topSearch.users, function (i, v) {
                                option += '<div class="_o92vn topSearch"><img class="_fehpt" src="' + v.user.profile_pic_url + '">' +
                                    '<div class="_poxna"><div class="_lv0uf"><span class="_b01op instaUserName">' + v.user.username + '</span>' +
                                    (v.user.is_verified ? '<div class="_4el3l coreSpriteVerifiedBadgeSmall"></div>' : '') +
                                    '</div><span class="_2ph7c full_name">' + v.user.full_name + '</span></div></div>';
                            });
                            if ($.trim(userName) !== '') {
                                $('._etpgz').html(option);
                                $('.usernameBtn').hide()
                            }
                        }
                    });
                }
            } else {
                remove_top_search();
            }
        });




        // js for Count the Million Value
        function prettifyNumber(value) {
            var thousand = 1000;
            var million = 1000000;
            var billion = 1000000000;
            var trillion = 1000000000000;
            if (value < thousand) {
                return String(value);
            }

            if (value >= thousand && value <= 1000000) {
                return Math.round(value / thousand) + 'k';
            }

            if (value >= million && value <= billion) {
                return Math.round(value / million) + 'M';
            }

            if (value >= billion && value <= trillion) {
                return Math.round(value / billion) + 'B';
            }

            else {
                return Math.round(value / trillion) + 'T';
            }
        }


    </script>

    <script>
        let userName = null, instaID = null, end_cursor = null, userInstaData = null, userInstaMedia = null;

        $(document).on('keyup', '#username', function (e) {
            userName = $(this).val();
            if ($.trim(userName) !== '') {
                if (e.which === 13) {
                    $('#submitbuylikes').click();
                } else {
                    $.ajax({
                        url: '/admin/packageAjaxHandlerinstgram',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            method: 'getTopSearch',
                            keyWord: userName
                        }
                    }).success(function (response) {
                        if (response.topSearch) {
                            let option = '';
                            $.each(response.topSearch.users, function (i, v) {
                                option += '<div class="_o92vn topSearch"><img class="_fehpt" src="' + v.user.profile_pic_url + '">' +
                                    '<div class="_poxna"><div class="_lv0uf"><span class="_b01op instaUserName">' + v.user.username + '</span>' +
                                    (v.user.is_verified ? '<div class="_4el3l"><img src="/assets/images/InstaIcons.jpg" width="18" height="18"></div>' : '') +
                                    '</div><span class="_2ph7c full_name">' + v.user.full_name + '</span></div></div>';
                            });
                            if ($.trim(userName) !== '') {
                                $('.username-options').html(option);
                                $('.usernameBtn').hide()
                            }
                        }
                    });
                }
            } else {
                remove_top_search();
            }
        });
    </script>
    <script>

        // remove the search list, if click outside of search list
        $(document).mouseup(function (e) {
            let container = $(".username-options");
            if (!$("#username").is(e.target) // if the target of the click isn't the username input field...
                && !container.is(e.target) // ... nor the target is container ...
                && container.has(e.target).length === 0) // ... nor a descendant of the top-search options
            {
                remove_top_search();
            }
        });
    </script>
    <script>
        //select the user from the searched list
        $(document).on('click', '.topSearch', function () {
            $('#username').val($(this).find('.instaUserName').text()).focus();
            remove_top_search();
        });


        $(document).on('click', '.usernameBtn, .more', function () {
            userName = $('#username').val();
            if (!userName) {
                $('#username').focus();
                return false;
            } else {
                let action = $(this).hasClass('more') ? 'more' : $(this).hasClass('usernameBtn') ? 'usernameBtn' : '';
                if (action === 'more') $('.more').attr('disabled', true);
                $('.' + action).find('.fa.fa-spinner.fa-spin').show();
                getUsersInstaMedias(userName, action);
            }
        });

        $(document).on('click', '.buybutton', function () {
            $('#LatestOrders').modal('show');
            packageDetails = $(this).parent().siblings('input')[0].dataset;
//                console.log(packageDetails);
        });


        $(document).mouseup(function (e) {
//                console.log('mouseUP', e.target);
//                console.log('mouseUP',e.target);
            let container = $("._etpgz");
            if (!$("#username").is(e.target) // if the target of the click isn't the username input field...
                && !container.is(e.target) // ... nor the target is container ...
                && container.has(e.target).length === 0) // ... nor a descendant of the top-search options
            {
                remove_top_search();
            }
        });


        $(document).on('click','.confirmAccount' ,function() {

            if($(this).hasClass('notconfirmed')){

                $(".confiramorder").hide();
                $(".buylikesmodal").show();

            }else if($(this).hasClass('confirmsubmit')){
                if(urlName.type==1){

                    let postData={
                        'shortCode':[userInstaData.userName],
                        'imageUrl':[userInstaData.profile_pic_url_hd],
                        'start_count': [userInstaData.edge_followed_by.count],
                        'comm'

                    }
                }
            }

        })


    </script>
    <script>
        function remove_top_search() {
            $('.username').html('');
            $('.usernameBtn').show();
        }

        function getUsersInstaMedias(userName,action) {

            $.ajax({
                url:'/admin//admin/packageAjaxHandlerinstgram',
                type:'POST',
                dataType: 'json',
                data:{
                    method:'getInstaMedia',
                    action:action,
                    userName:userName,
                    type:urlName.type,
                    instaID:instaID,
                    end_cursor:end_cursor
                }

            }).success(function (response) {
                $('.fa.fa-spinner.fa-spin').hide();
                if(response.status==='success'){
                    if(response.instaMedia){
                        end_cursor=response.end_cursor;
                        userInstaMedia=response.instaMedia.edges;
                        if(action==='usernameBtn'){

                      userInstaData=response.userDetails;
                      $('.confirmorder').show();
                      $('.buylikesmodal').hide();
                      
                      instaID=response.userDetails.id;
                      
                      $('.profile_pic').attr('src',response.userDetails.profile_pic_url_hd);
                      $.each($('.userAccnStats').find('span'),function (i,v) {
                          if(i===0)$(v).text(prettifyNumber(response.postCount));
                          if(i===1)$(v).text(prettifyNumber(response.userDetails.edge_followed_by.count));
                          if(i===2) $(v).text(prettifyNumber(response.userDetails.edgefollw.count));
                          
                      });



                        }else if(action==='more'){
                            $('.more').attr('disabled',false);
                        }
                    }


                }else if(response.status==='error'){

                    let message=$('.message').text();
                    $('.message').addClass('error').text(response.message);
                    setTimeout(function () {
                        $('.message').removeClass('error').text(message);
                    },3000);
                }

            });



        }



    </script>

@endsection