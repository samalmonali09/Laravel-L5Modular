
<?php $__env->startSection('AUTOIG','active open'); ?>
<?php $__env->startSection('UserActiveAutoig','active open'); ?>
<?php $__env->startSection('pageheadcontent'); ?>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <style>

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

        @media  only screen
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

<?php $__env->stopSection(); ?>


<?php $__env->startSection('pagecontent'); ?>
    <!-- BEGIN PAGE HEADER-->

    <h3 class="page-title" style="color: #225e8b">
        Activity Logs
    </h3>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="/admin/activity-LogsAutoig">Activity Logs</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <i class="fa fa-thumbs-up"></i>AUTOIG

            </li>
        </ul>
    </div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        <div class="col-md-12">
            <div class="note note-danger" hidden>
                <p>
                    NOTE: The below datatable is not connected to a real database so the filter and sorting is just
                    simulated for demo purposes only.
                </p>
            </div>
            <!-- Begin: life time stats -->

            <section class="content_wrap pricingtable">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab-container">

                    <div class="col-lg-4 col-md-4 col-sm-5 col-xs-4 ">
                        <form class="example" style="margin:auto;max-width:350px;margin-bottom: 10px;">
                            <input placeholder="Search.." name="searchKey" type="text" value="">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                        <div class="col-lg-12" style="padding: 5px 15px 15px 15px !important;color: #333;
                                        font-size: 15px;font-weight: 600;">
                            <span class="pull-left">Username</span><span class="pull-right">Device ID</span>
                        </div>
                        <div class="col-lg-12 bhoechie-tab-menu" id="boxscroll"
                             style="padding: 0px; overflow: hidden;" tabindex="1">
                            <div class="list-group">
                                <?php if(isset($recentActivity)): ?>
                                    <?php $__currentLoopData = $recentActivity; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a href="javascript:;" data-activity_id="<?php echo e($value['activity_id']); ?>"
                                           id="activityList<?php echo e($value['activity_id']); ?>"
                                           data-message="<?php echo e($value['message']); ?>"
                                           class="list-group-item <?php if($key==0): ?> active <?php endif; ?>">
                                            <span class="pull-left"><?php if($value['username'] && $value['username'] !=""): ?><?php echo e($value['username']); ?><?php else: ?>
                                                    Guest <?php endif; ?><br><span
                                                        class="custom_email copy_device_id" title="copy email"
                                                        data-title="Copy email"
                                                        data-value="<?php echo e($value['email']); ?>"><?php echo e($value['email']); ?></span></span><span
                                                    class="pull-right copy_device_id" title="copy device id"
                                                    data-title="Copy device id"
                                                    data-value="<?php echo e($value['device_id']); ?>"><?php echo e($value['device_id']); ?></span>
                                        </a>
                                        <input type="text" id="copyText<?php echo e($value['device_id']); ?>"
                                               value="<?php echo e($value['device_id']); ?>"
                                               style="position: absolute; left: -9999px;">
                                        <input type="text" id="copyText<?php echo e($value['email']); ?>"
                                               value="<?php echo e($value['email']); ?>"
                                               style="position: absolute; left: -9999px;">
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <input type="text" id="first_activity_id"
                                           value="<?php if(isset($recentActivity[0])): ?> <?php echo e($recentActivity[0]['activity_id']); ?> <?php endif; ?>"
                                           hidden>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 bhoechie-tab" style="padding: 0;">
                        <h4 style="text-align: center;background: #4997cd;padding: 11px 0;margin: 0;color: #fff;font-weight: 400;">
                            Activity&nbsp;&nbsp;<i class="fa fa-refresh refreshActivityList"
                                                   style="cursor:pointer;"></i></h4>
                        <!-- flight section -->
                        <div class="bhoechie-tab-content active" id="boxscroll2" style="overflow: hidden;"
                             tabindex="2">
                            <center>
                                <!-- <h4>Activity</h4>-->
                                <div id="timeline">
                                    <div class="row timeline-movement timeline-movement-top">
                                        <div class="timeline-badge timeline-future-movement">
                                        </div>
                                    </div>
                                    <?php if(isset($recentMessage)): ?>
                                        <?php $__currentLoopData = $recentMessage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($key % 2== 0): ?>
                                                <div class="row timeline-movement">
                                                    <div class="timeline-badge">
                                                        <i class="glyphicon glyphicon-dot custom_dot"></i>
                                                    </div>
                                                    <div class="col-sm-6  timeline-item">
                                                        <div class="row">
                                                            <div class="col-sm-10 col-sm-offset-1">
                                                                <div class="timeline-panel credits">
                                                                    <ul class="timeline-panel-ul">
                                                                        <li style="background-color: #003A55;
                                                                          padding: 10px;"><span
                                                                                    class="importo"><?php echo e($msg['type']); ?></span>
                                                                            <?php if(isset($msg['visit_duration']) && $msg['visit_duration'] != ""): ?>
                                                                                <small class="text-muted pull-right"><i
                                                                                            class="glyphicon glyphicon-time"></i><?php echo e($msg['visit_duration']); ?>

                                                                                </small>
                                                                            <?php endif; ?>
                                                                        </li>
                                                                        <li style="padding: 10px;"><span
                                                                                    class="causale"><?php echo e($msg['message']); ?></span>
                                                                        </li>
                                                                        
                                                                    </ul>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6  timeline-item">
                                                        <div class="row">
                                                            <div class="col-sm-8">

                                                                <p class="custom_date_right"><?php echo e(date("d-m-Y h:i:s", $msg['timestamp_of_action'])); ?>


                                                                    <span
                                                                            style="font-size: 12px;color: #808080;"><?php if(isset($msg['time'])): ?> <?php echo e(date("h:i:sa"),$msg['time']); ?> <?php endif; ?></span>
                                                                </p>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php else: ?>
                                                <div class="row timeline-movement">
                                                    <div class="timeline-badge">
                                                        <i class="glyphicon glyphicon-dot custom_dot"></i>
                                                    </div>
                                                    <div class="col-sm-6  timeline-item">
                                                        <div class="row">
                                                            <div class="col-sm-9 col-sm-offset-3">
                                                                <p class="custom_date_left"><?php echo e(date("d-m-Y h:i:s", $msg['timestamp_of_action'])); ?>

                                                                    
                                                                    <span
                                                                            style="font-size: 12px;color: #808080;"><?php if(isset($msg['time'])): ?> <?php echo e(date("h:i:sa"), $msg['time']); ?> <?php endif; ?></span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6  timeline-item">
                                                        <div class="row">
                                                            <div class="col-sm-10 col-sm-offset-1">
                                                                <div class="timeline-panel credits">
                                                                    <ul class="timeline-panel-ul">
                                                                        <li style="background-color: #003A55;
padding: 10px;"><span class="importo"><?php echo e($msg['type']); ?></span>
                                                                            <?php if(isset($msg['visit_duration']) && $msg['visit_duration'] != ""): ?>
                                                                                <small class="text-muted pull-right"><i
                                                                                            class="glyphicon glyphicon-time "></i><?php echo e($msg['visit_duration']); ?>

                                                                                </small>
                                                                            <?php endif; ?>
                                                                        </li>
                                                                        <li style="padding: 10px;"><span
                                                                                    class="causale"><?php echo e($msg['message']); ?> </span>
                                                                        </li>
                                                                        
                                                                    </ul>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </div>
                            </center>
                        </div>

                    </div>
                </div>

            </section>
        </div>


    </div>
    <!-- END PAGE CONTENT-->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pagescripts'); ?>
    <!-- add extra js for this page only -->

    
    <script src="/GAIA/assets/global/scripts/jquery.nicescroll.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.6/dist/loadingoverlay.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    
    
    
    
    
    
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function () {

            var activity_id = $('#first_activity_id').val();

            $("div.bhoechie-tab-menu>div.list-group>a").click(function (e) {
                e.preventDefault();
                $(this).siblings('a.active').removeClass("active");
                $(this).addClass("active");
                activity_id = $(this).attr('data-activity_id');
                // $(".custom_email").css("color","#333 !important");
                var index = $(this).index();
                // $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
                // $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
            });

            var nice = $("html").niceScroll();  // The document page (body)
            $("#div1").html($("#div1").html() + ' ' + nice.version);
            $("#boxscroll").niceScroll({cursorborder: "", cursorcolor: "#00F", boxzoom: false}); // First scrollable DIV

            $("#boxscroll2").niceScroll({cursorborder: "", cursorcolor: "#00F", boxzoom: false});  // Second scrollable DIV
            $("#boxframe").niceScroll("#boxscroll3", {
                cursorcolor: "#0F0",
                cursoropacitymax: 0.7,
                boxzoom: true,
                touchbehavior: true
            });  // This is an IFrame (iPad compatible)

            $('.list-group-item').click(function () {
                let activityId = $(this).attr('data-activity_id');
                let msg = $(this).attr('data-message');
                msg = JSON.parse(msg);
                $('#timeline').html(createActivityDiv(msg));
                //
                // $("#boxscroll2").LoadingOverlay("show", {
                //     background: "rgba(165, 190, 100, 0.5)"
                // });
                //
                // $("#boxscroll2").LoadingOverlay("hide");
                //
                // $("#boxscroll2").LoadingOverlay("show");

            });

            var iScrollPos = 0, scrolled = false;
            $('#boxscroll2').scroll(function (e) {
                e.preventDefault();
                let iCurScrollPos = $(this).scrollTop();

                if (iCurScrollPos < iScrollPos) {
                    if (!scrolled) {
                        scrolled = true;

                        $.ajax({
                            url: '/admin/getActivityDetailsAutoig',
                            type: 'get',
                            dataType: 'json',
                            data: {activity_id: JSON.stringify(activity_id)},
                            beforeSend: function () {
                                $("#boxscroll2").LoadingOverlay("show", {
                                    background: "rgba(165, 190, 100, 0.5)"
                                });
                            },
                            complete: function () {
                                $("#boxscroll2").LoadingOverlay("hide");

                            },
                            success: function (response) {
                                $("#boxscroll2").LoadingOverlay("hide");
                                if (response['status'] == 200) {
                                    if (response['message'] != []) {
                                        $('#timeline').html(createActivityDiv(response.message));
                                        $('#activityList' + activity_id).attr('data-message', JSON.stringify(response.message));

                                    }
                                }
                            },
                            error: function (xhr, status, err) {
                                $("#boxscroll2").LoadingOverlay("hide");
                            }

                        });
                        /* this code is to prevent ajax firing multiple times on srolling --Saurabh*/
                        setTimeout(function () {
                            scrolled = false;
                        }, 5000);

                    }
                }
                iScrollPos = iCurScrollPos;
            });

            $(document.body).click('.custom_email',function () {
                $.ajax({
                   url:'/admin/activityLogsAjaxHandlerAutoig',
                    type: 'get',
                    dataType: 'json',

                    beforeSend: function () {
                        $("#boxscroll").LoadingOverlay("show", {
                            background: "rgba(165, 190, 100, 0.5)"
                        });
                    },
                    complete: function () {
                        $("#boxscroll").LoadingOverlay("hide");
                    },
                    success: function (response) {
                        $("#boxscroll").LoadingOverlay("hide");

                        if (response['status'] == 200) {

                            if (response['activityLists'] != []) {
                                let html = '<div class="list-group">';
                                console.log('--------activityLists----------', response['activityLists']);
                                console.log('--------activityLists----------', response.activityLists);
                                response = JSON.parse(response);
                                console.log('--------activityLists----------', activityLists);
                                $.each(response.activityLists, function (i, o) {
                                    // console.log('----normal---', o.message);
                                    // console.log('---both----', JSON.stringify(JSON.parse(o.message)));
                                    // console.log('----parsed---', JSON.parse(o.message));
                                    // console.log('---stringify----', JSON.stringify(o.message));
                                    // return false;
                                    o.username = (o.username != null) ? o.username : "Guest";
                                    o.email = (o.email != null) ? o.email : "";
                                    // o.message = JSON.parse(JSON.stringify(o.message));

                                    html += '<a href="javascript:;" data-activity_id="' + o.activity_id + '" id="activityList' + o.activity_id + '" data-message="' + o.message + '" class="list-group-item"> <span class="pull-left">' + o.username + '<br><span class="custom_email">' + o.email + '</span></span><span class="pull-right">' + o.device_id + '</span> </a>'

                                });
                                html += '</div>';

                                $('#boxscroll').html(html);
                            }

                        }
                    }
                });

            });




            $('.refreshActivityList').click(function () {
                $.ajax({
                    url: '/admin/activityLogsAjaxHandlerAutoig',
                    type: 'get',
                    dataType: 'json',
                    beforeSend: function () {
                        $("#boxscroll").LoadingOverlay("show", {
                            background: "rgba(165, 190, 100, 0.5)"
                        });
                    },
                    complete: function () {
                        $("#boxscroll").LoadingOverlay("hide");

                    },
                    success: function (response) {
                        $("#boxscroll").LoadingOverlay("hide");
                        if (response['status'] == 200) {
                            console.log(response);
                            if (response['activityLists'] != []) {
                                let html = '<div class="list-group">';
                                console.log('--------activityLists----------', response['activityLists']);
                                console.log('--------activityLists----------', response.activityLists);
                                response = JSON.parse(response);
                                console.log('--------activityLists----------', activityLists);
                                $.each(response.activityLists, function (i, o) {
                                    // console.log('----normal---', o.message);
                                    // console.log('---both----', JSON.stringify(JSON.parse(o.message)));
                                    // console.log('----parsed---', JSON.parse(o.message));
                                    // console.log('---stringify----', JSON.stringify(o.message));
                                    // return false;
                                    o.username = (o.username != null) ? o.username : "Guest";
                                    o.email = (o.email != null) ? o.email : "";
                                    // o.message = JSON.parse(JSON.stringify(o.message));


                                    html += '<a href="javascript:;" data-activity_id="' + o.activity_id + '" id="activityList' + o.activity_id + '" data-message="' + o.message + '" class="list-group-item"> <span class="pull-left">' + o.username + '<br><span class="custom_email">' + o.email + '</span></span><span class="pull-right">' + o.device_id + '</span> </a>'

                                });
                                html += '</div>';

                                $('#boxscroll').html(html);
                            }
                        }
                    },
                    error: function (xhr, status, err) {
                        $("#boxscroll").LoadingOverlay("hide");
                    }
                });
            });


            function createActivityDiv(msg) {
                let html = '<div class="row timeline-movement timeline-movement-top">' +
                    '<div class="timeline-badge timeline-future-movement">' +
                    '</div>' +
                    '</div>';


                let d = new Date();

                var today = new Date();
                var dd = today.getDate();

                var mm = today.getMonth() + 1;
                var yyyy = today.getFullYear();
                today = dd + '-' + mm + '-' + yyyy;
                let time2='';

                console.log('sdfs', msg)
                $.each(msg, function (i, o) {
                    if( o.visit_duration==''){
                        time2= '<small class="text-muted pull-right"><i class="glyphicon"></i>' + o.visit_duration + '</small>'


                    }else {
                        time2= '<small class="text-muted pull-right"><i class="glyphicon glyphicon-time"></i>' + o.visit_duration + '</small>'

                    }
                    console.log('>>>>>>>', o);
                    if (i % 2 == 0) {

                        html += '<div class="row timeline-movement">' +
                            '                                                    <div class="timeline-badge">' +
                            '                                                        <i class="glyphicon glyphicon-dot custom_dot"></i>' +
                            '                                                    </div>' +
                            '                                                    <div class="col-sm-6  timeline-item">' +
                            '                                                        <div class="row">' +
                            '                                                            <div class="col-sm-10 col-sm-offset-1">' +
                            '                                                                <div class="timeline-panel credits">' +
                            '                                                                    <ul class="timeline-panel-ul">' +
                            '                                                                        <li style="background-color: #003A55;' +
                            '                                                                          padding: 10px;"><span' +
                            '                                                                                    class="importo">' + o.type + '</span>'  +
                            '                                                                               '+time2 +
                            '                                                                        </li>' +
                            '                                                                        <li style="padding: 10px;"><span' +
                            '                                                                                    class="causale">' + o.message + '</span>' +
                            '                                                                        </li>' +
                            '                                                                        ' +
                            '                                                                    </ul>' +
                            '                                                                </div>' +
                            '                                                            </div>' +
                            '                                                        </div>' +
                            '                                                    </div>' +
                            '                                                    <div class="col-sm-6  timeline-item">' +
                            '                                                        <div class="row">' +
                            '                                                            <div class="col-sm-8">' +
                            '                                                                <p class="custom_date_right">' + today + '<span style="font-size: 12px;color: #808080;">' + timeTotime(o.timestamp_of_action) + '</span>' +
                            '                                                                </p>' +
                            '                                                            </div>' +
                            '                                                        </div>' +
                            '                                                    </div>' +
                            '                                                </div>';

                    } else {

                        html += '<div class="row timeline-movement">' +
                            '                                                    <div class="timeline-badge">' +
                            '                                                        <i class="glyphicon glyphicon-dot custom_dot"></i>' +
                            '                                                    </div>' +
                            '                                                    <div class="col-sm-6  timeline-item">' +
                            '                                                        <div class="row">' +
                            '                                                            <div class="col-sm-9 col-sm-offset-3">' +
                            '                                                                <p class="custom_date_left">' + today + '<span' +
                            '                                                                            style="font-size: 12px;color: #808080;">' + timeTotime(o.timestamp_of_action) + '</span>' +
                            '                                                                </p>' +
                            '                                                            </div>' +
                            '                                                        </div>' +
                            '                                                    </div>' +
                            '                                                    <div class="col-sm-6  timeline-item">' +
                            '                                                        <div class="row">' +
                            '                                                            <div class="col-sm-10 col-sm-offset-1">' +
                            '                                                                <div class="timeline-panel credits">' +
                            '                                                                    <ul class="timeline-panel-ul">' +
                            '                                                                        <li style="background-color: #003A55; padding: 10px;"><span class="importo">' + o.type + '</span>' +
                            '                                                                               '+time2 +
                            '                                                                        </li>' +
                            '                                                                        <li style="padding: 10px;"><span' +
                            '                                                                                    class="causale">' + o.message + ' </span>' +
                            '                                                                        </li>' +
                            '                                                                        ' +
                            '                                                                    </ul>' +
                            '                                                                </div>' +
                            '                                                            </div>' +
                            '                                                        </div>' +
                            '                                                    </div>' +
                            '                                                </div>';

                    }
                });

                return html;
            }

            if (location.search.split('searchKey=')[1] == undefined) {
                $('input[name="searchKey"]').val('');
            } else
                $('input[name="searchKey"]').val(decodeURIComponent(location.search.split('searchKey=')[1]));

            $('[data-toggle="tooltip"]').tooltip();

            $(".copy_device_id").tooltip({
                content: $(this).attr('data-title'),
                show: {
                    effect: "slideDown",
                    delay: 250
                }
            });
            $('.copy_device_id').mouseover(function () {
                $(this).tooltip({content: $(this).attr('data-title')});
                $(this).tooltip("open");
            });
            $('.copy_device_id').click(function () {
                let clickedDeviceId = $(this).attr('data-value');
                let copyText = document.getElementById("copyText" + clickedDeviceId);

                console.log('----------copy text ----------', copyText);
                copyText.select();
                document.execCommand("copy");
                $(this).tooltip({content: "Copied: " + clickedDeviceId});
                $(this).tooltip("open");
            });

        });



        function timeTotime(time) {
            var date = new Date(time * 1000);
// Hours part from the timestamp
            var hours = date.getHours();
// Minutes part from the timestamp
            var minutes = "0" + date.getMinutes();
// Seconds part from the timestamp
            var seconds = "0" + date.getSeconds();

// Will display time in 10:30:23 format
            var formattedTime = hours + ':' + minutes.substr(-2) + ':' + seconds.substr(-2);
            return formattedTime
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin::Layouts.adminlayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>