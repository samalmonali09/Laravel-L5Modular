



<?php $__env->startSection('headcontent'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('dashboard','active open'); ?>

<?php $__env->startSection('pagecontent'); ?>
    <h3 class="page-title" style="color: #19658b">
        Dashboard
        <small></small>
    </h3>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="/admin/dashboard">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a class="application" href="/admin/dashboard ">Dashboard</a>
            </li>
        </ul>


        <div class="theme-panel hidden-xs hidden-sm">
            <div class="toggler">
            </div>
            <div class="toggler-close">
            </div>
            <div class="theme-options">
                <div class="theme-option theme-colors clearfix">
            <span>
            </span>
                    <ul>
                    </ul>
                </div>
                
                <div class="theme-option registeredThrough">
                    <span><a style="cursor: pointer; color: #fff;" value="1" data-status="1">Get Instant Likes
                            EN</a></span>

                </div>
                <div class="theme-option registeredThrough">

                    <span><a style="cursor: pointer; color: #fff;" value=2
                             data-status="2">Get Instant Likes RU</a></span>

                </div>
                <div class="theme-option registeredThrough">

                    <span><a style="cursor: pointer; color: #fff;" value=3
                             data-status="3">Get Instant Views EN</a></span>

                </div>
                <div class="theme-option registeredThrough">

                    <span><a style="cursor: pointer; color: #fff;" value=4
                             data-status="4">Get Instant Views RU</a></span>

                </div>
                <div class="theme-option registeredThrough">

                    <span><a style="cursor: pointer; color: #fff;" value=5 data-status="5">AUTOIG</a></span>

                </div>

                <div class="theme-option registeredThrough">

                    <span><a style="cursor: pointer; color: #fff;" value=6 data-status="6">Insta-stats</a></span>

                </div>
                <div class="theme-option registeredThrough">

                    <span><a style="cursor: pointer; color: #fff;" value=6 data-status="7">  Instant Likes</a></span>

                </div>


            </div>
        </div>


    </div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN DASHBOARD STATS -->
    <div class="row">


        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat blue-madison">
                <div class="visual">
                    <i class="fa fa-users"></i>
                </div>
                <div class="details">
                    <div class="number" id="totalUsers">
                        <?php echo e($usersCount[0]['totalUsers']); ?>

                    </div>
                    <div class="desc">
                        Total Users
                    </div>
                </div>
                <a class="more redirectUser" href="javascript:;">
                    &nbsp;
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat green-haze">
                <div class="visual">
                    <i class="fa fa-user-plus"></i>
                </div>
                <div class="details">
                    <div class="number" id="activeUsers">
                        <?php echo e($usersCount[0]['activeUsers']); ?>

                    </div>
                    <div class="desc">
                        Active Users
                    </div>
                </div>
                <a class="more" href="javascript:;">
                    &nbsp;
                </a>
            </div>
        </div>


        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat red-haze">
                <div class="visual">
                    <i class="fa fa-user-plus"></i>
                </div>
                <div class="details">
                    <div class="number" id="pendingUsers">
                        <?php echo e($usersCount[0]['pendingUsers']); ?>

                    </div>
                    <div class="desc">
                        Pending Users
                    </div>
                </div>
                <a class="more" href="javascript:;">
                    &nbsp;
                    
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat purple-plum">
                <div class="visual">
                    <i class="fa fa-user-plus"></i>
                </div>
                <div class="details">
                    <div class="number" id="updated_at">
                        <?php echo e($usersCount[0]['updated_at']); ?>

                    </div>
                    <div class="desc">
                        New Users
                    </div>
                </div>
                <a class="more" href="javascript:;">
                    &nbsp;
                    
                </a>
            </div>
        </div>
            </div>

    <div class="clearfix">
        <div class="row">

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat green-jungle">
                    <div class="visual">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <div class="details">
                        <div class="number" id="totalOrders">
                            <?php echo e($OrdersCount[0]['totalOrders']); ?>

                        </div>
                        <div class="desc">
                            Total Orders
                        </div>
                    </div>
                    <a class="more redirectOrder" href="javascript:;">
                        &nbsp;
                        
                    </a>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <div class="dashboard-stat yellow-gold">
                    <div class="visual">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <div class="details">
                        <div class="number" id="pending">
                            <?php echo e($OrdersCount[0]['pending']); ?>

                        </div>
                        <div class="desc">
                            Pending Orders
                        </div>
                    </div>
                    <a class="more" href="javascript:;">
                        &nbsp;
                    </a>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <div class="dashboard-stat blue">
                    <div class="visual">
                        <i class="fa fa-briefcase "></i>
                    </div>
                    <div class="details">
                        <div class="number" id="processing">
                            <?php echo e($OrdersCount[0]['processing']); ?>

                        </div>
                        <div class="desc">
                            Processing Orders
                        </div>
                    </div>
                    <a class="more" href="javascript:;">
                        
                        &nbsp
                    </a>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <div class="dashboard-stat blue-chambray">
                    <div class="visual">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <div class="details">
                        <div class="number" id="completed">
                            <?php echo e($OrdersCount[0]['completed']); ?>

                        </div>
                        <div class="desc">
                            Completed Orders
                        </div>
                    </div>
                    <a class="more" href="javascript:;">
                        
                        &nbsp
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat yellow-casablanca">
                    <div class="visual">
                        <i class="fa fa-globe"></i>
                    </div>
                    <div class="details">
                        <div class="number" id="added_time">
                            <?php echo e($OrdersCount[0]['added_time']); ?>

                        </div>
                        <div class="desc">
                            New Orders
                        </div>
                    </div>
                    <a class="more" href="javascript:;">
                        
                        &nbsp
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix">
        <div class="row">


            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 totalMoney">
                <div class="dashboard-stat red-pink">
                    <div class="visual">
                        <i class="fa fa-dollar"></i>
                    </div>
                    <div class="details">
                        <div class="number" id="amount">
                            $
                            <?php echo e($transctionMoney[0]['amount']); ?>

                        </div>
                        <div class="desc">
                            Total Money
                        </div>
                    </div>
                    <a class="more redirectTransction" href="javascript:;">
                        &nbsp;
                        
                    </a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 todaysIncome">
                <div class="dashboard-stat green">
                    <div class="visual">
                        <i class="fa fa-paypal"></i>
                    </div>
                    <div class="details">
                        <div class="number" id="payment_time">
                            <?php echo e($transctionMoney[0]['payment_time']); ?>

                        </div>
                        <div class="desc">
                            Today's Income
                        </div>
                    </div>
                    <a class="more" href="javascript:;">
                        &nbsp
                        
                    </a>
                </div>
            </div>


            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 Subscriptions" hidden>
                <div class="dashboard-stat blue-dark">
                    <div class="visual">
                        <i class="fa fa-user-plus"></i>
                    </div>
                    <div class="details">
                        
                            
                        
                        <div class="number" id="totalrecurring">
                            <?php echo e($recurringMoney[0]['totalrecurring']); ?>

                        </div>
                        <div class="desc">
                            Total Subscriptions
                        </div>
                    </div>
                    <a class="more redirectSubcription" href="javascript:;">
                        &nbsp;
                        
                    </a>
                </div>
            </div>


            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 activeSubscriptions" hidden>
                <div class="dashboard-stat blue-soft">
                    <div class="visual">
                        <i class="fa fa-globe"></i>
                    </div>
                    <div class="details">
                        
                            
                        
                        <div class="number" id="ActiveReq">
                            <?php echo e($recurringMoney[0]['ActiveReq']); ?>

                            
                        </div>
                        <div class="desc">
                            Active Subscriptions
                        </div>
                    </div>
                    <a class="more" href="javascript:;">
                        &nbsp;
                        
                    </a>
                </div>
            </div>

        </div>
    </div>

    <!-- END DASHBOARD STATS -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pagescripts'); ?>
    <script type="text/javascript">


        //        $(document).ready(function () {
        //            $('div.row').find('a.redirectUser').remove();
        //            $('div.row').append('<li class="redirectUser"><i class="fa fa-angle-right"></i><span class=" ">' + Appliction[registeredThrough - 1] + '</span></li>');
        //        });
        $(document.body).on('click', '.registeredThrough span', function () {
//            $(this).find('a').attr('data-status');
            var registeredThrough = $(this).children().attr('data-status');
            var application = $(this).children().attr('value');
            var redirectUrl = ['GILE', 'GILR', 'GIVE', 'GIVR', 'AUTOIG', 'INSTASTAT','Instant'];
            var Appliction = ['Get Instant Like En', 'Get Instant Like Ru', 'Get Instant Views En', 'Get Instant Views Ru', 'AUTOIG', 'InstaStat','Get Instant Likes']
            $.ajax({
                url: '/admin/dashboarAjaxHandler',
                dataType: 'json',
                type: 'post',
                data: {
                    'registered_through': registeredThrough
                },

                success: function (response) {

                    if (response['status'] == 200) {
                        $('#totalUsers').text(response.data[0].totalUsers?response.data[0].totalUsers:0);
                        $('#activeUsers').text(response.data[0].activeUsers?response.data[0].activeUsers:0);
                        $('#pendingUsers').text(response.data[0].pendingUsers?response.data[0].pendingUsers:0);
                        $('#updated_at').text(response.data[0].updated_at?response.data[0].updated_at:0);
                        $('#totalOrders').text(response.order[0].totalOrders?response.order[0].totalOrders:0);
                        $('#pending').text(response.order[0].pending?response.order[0].pending:0);
                        $('#processing').text(response.order[0].processing?response.order[0].processing:0);
                        $('#completed').text(response.order[0].completed?response.order[0].completed:0);
                        $('#added_time').text(response.order[0].added_time?response.order[0].added_time:0);
                        $('#amount').text(response.payment[0].amount?response.payment[0].amount:0);
                        $('#payment_time').text(response.payment[0].payment_time?response.payment[0].payment_time:0);
                        //   $('.Subscriptions').text(response.payment[0].payment_time);

                        $('#ActiveReq').text(response.sub[0].ActiveReq ? response.sub[0].ActiveReq : 0);
                        $('#totalrecurring').text(response.sub[0].totalrecurring ? response.sub[0].totalrecurring : 0);



                        console.log('updated_at', response.data[0].updated_at);
                        //Redirect for view more option

                        $('.redirectUser').attr('href', '<?php echo e(env('APP_URL1')); ?>/admin/manageUser/' + redirectUrl[registeredThrough - 1]);
                        $('.redirectOrder').attr('href', '<?php echo e(env('APP_URL1')); ?>/admin/manageOrders/' + redirectUrl[registeredThrough - 1]);
                        $('.redirectTransction').attr('href', '<?php echo e(env('APP_URL1')); ?>/admin/manageTransaction/' + redirectUrl[registeredThrough - 1]);
                        $('.redirectSubcription').attr('href', '<?php echo e(env('APP_URL1')); ?>/admin/PaymentDatable/');

                        $('ul.page-breadcrumb').find('li.app-lication').remove();
                        $('ul.page-breadcrumb').append('<li class="app-lication"><i class="fa fa-angle-right"></i><span class=" ">' + Appliction[registeredThrough - 1] + '</span></li>');

                        $('.redirectUser').html('View More <i class="m-icon-swapright m-icon-white"></i>');
                        $('.redirectOrder').html('View More <i class="m-icon-swapright m-icon-white"></i>');
                        $('.redirectTransction').html('View More <i class="m-icon-swapright m-icon-white"></i>');
                        $('.redirectSubcription').html('View More <i class="m-icon-swapright m-icon-white"></i>');


                        if (registeredThrough == 5) {
                            $('.Subscriptions').show();
                            $('.activeSubscriptions').show();
                            $('.totalMoney').removeClass('col-lg-6');
                            $('.totalMoney').removeClass('col-md-6');
                            $('.totalMoney').addClass('col-lg-3');
                            $('.totalMoney').addClass('col-md-3');
                            $('.todaysIncome').removeClass('col-lg-6');
                            $('.todaysIncome').removeClass('col-md-6');
                            $('.todaysIncome').addClass('col-lg-3');
                            $('.todaysIncome').addClass('col-md-3');



                        } else {
                            $('.Subscriptions').hide();
                            $('.activeSubscriptions').hide();
                            $('.totalMoney').removeClass('col-lg-3');
                            $('.totalMoney').removeClass('col-md-3');
                            $('.totalMoney').addClass('col-lg-6');
                            $('.totalMoney').addClass('col-md-6');
                            $('.todaysIncome').removeClass('col-lg-3');
                            $('.todaysIncome').removeClass('col-md-3');
                            $('.todaysIncome').addClass('col-lg-6');
                            $('.todaysIncome').addClass('col-md-6');
                        }
                    }

                }

            });
        });


    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin::Layouts.adminlayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>