{{--Created by  Monali Samal
      * @author Monali Samal (monalisamal@globussoft.in)
--}}




<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    @include('Admin::Layouts.headcontent')
    @yield('pageheadcontent')

    {{--<style>--}}
        {{--.collapse i{--}}
          {{--color: #fff !important;--}}
            {{--font-size: 25px !important;--}}
        {{--}--}}

        {{--.collapse .sub-menu i{--}}
            {{--font-size: 17px !important;--}}
        {{--}--}}

    {{--</style>--}}
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->


{{--<body class="page-md page-header-fixed page-sidebar-fixed page-quick-sidebar-over-content  ">--}}

<body class="page-md page-header-fixed page-quick-sidebar-over-content  ">

<!-- BEGIN HEADER -->
<div class="page-header md-shadow-z-1-i navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="/admin/dashboard">
                <img src="/GAIA/assets/logo/gaia.png" height="30px;" width="130px;" alt="logo" class="logo-default"
                     style="margin-top: 8px;"/>
            </a>
            <div class="menu-toggler sidebar-toggler hide">
            </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
           data-target=".navbar-collapse">
        </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <!-- BEGIN NOTIFICATION DROPDOWN -->


                <!-- BEGIN TODO DROPDOWN -->

                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                       data-close-others="true">
                        {{--<img alt="" class="img-circle" src="/GAIA/assets/admin/layout/img/avatar3_small.jpg"/>--}}
                        <span class="username username-hide-on-mobile">
                            {{\Illuminate\Support\Facades\Session::get('admin')['username']}}
                            </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            {{--<a href="extra_profile.html">--}}
                            {{--<i class="icon-user"></i> My Profile </a>--}}
                            <a href="/admin/myProfile"><i class="icon-user"></i> My
                                Profile </a>
                        </li>

                        <li class="divider">
                        </li>
                        {{--<li>--}}
                            {{--<a href="/admin/lock">--}}
                            {{--<i class="icon-lock"></i> Lock Screen </a>--}}
                        {{--</li>--}}
                        <li>
                            <a href="/admin/logout"><i class="icon-key "></i> Log
                                out</a>
                        </li>
                    </ul>
                </li>
                <!-- END USER LOGIN DROPDOWN -->
                <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <!-- END QUICK SIDEBAR TOGGLER -->
            </ul>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar-wrapper">
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <div class="page-sidebar navbar-collapse collapse">

            <ul class="page-sidebar-menu page-sidebar-menu-light" data-keep-expanded="false" data-auto-scroll="true"
                data-slide-speed="200">
                <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                <li class="sidebar-toggler-wrapper">
                    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                    <div class="sidebar-toggler">
                    </div>
                    <!-- END SIDEBAR TOGGLER BUTTON -->
                </li>

                <li class="@yield('dashboard')">
                    <a href="/admin/dashboard">
                        <i class="icon-home"></i>
                        <span class="title">Dashboard</span>
                        <span class="selected"></span>
                    </a>
                </li>

                {{--<li>--}}
                <li class="@yield('GILE')">
                    <a href="javascript:;">
                        <i class="fa fa-heart"></i>
                        {{--<img src="/GAIA/assets/logo/gilr.jpg" height="20px;" width="28px;">--}}
                        <span class="title">Get Instant Likes EN</span>
                        <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="@yield('GILEMU')">
                            <a href="/admin/manageUser/GILE">
                                <i class="fa fa-users"></i>
                                Manage Users</a>
                        </li>
                        <li class="@yield('GILEMO')">
                            <a href="/admin/manageOrders/GILE">
                                <i class="icon-basket"></i>
                                Manage Orders</a>
                        </li>
                        <li>
                        <li class="@yield('GILEMP')">
                        <a href="/admin/managePackage/GILE">
                            <i class="fa fa-list" aria-hidden="true"></i>

                            Manage Packages</a>
                        </li>

                        <li>
                        <li class="@yield('GILEMTH')">
                        <a href="/admin/manageTransaction/GILE">
                            <i class="fa fa-history" aria-hidden="true"></i>
                            Transaction History</a>
                        </li>
                        <li class="@yield('GILEFN')">
                            <a href="/admin/flash-message">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i>
                                Flash News
                            </a>
                        </li>
                        {{--<li class="@yield('Module')">--}}
                            {{--<a href="/admin/module-status">--}}
                                {{--<i class="fa fa-file-text-o" aria-hidden="true"></i>--}}
                                {{--Module Switch--}}
                            {{--</a>--}}
                        {{--</li>--}}


                    </ul>
                </li>



                <li class="@yield('GIL')">
                    <a href="javascript:;">
                        <i class="fa fa-heart"></i>
                        {{--<img src="/GAIA/assets/logo/gilr.jpg" height="20px;" width="28px;">--}}
                        <span class="title"> Instant Likes</span>
                        <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="@yield('ILMU')">
                            <a href="/admin/manageUser/Instant">
                                <i class="fa fa-users"></i>
                                Manage Users</a>
                        </li>
                        <li class="@yield('ILMO')">
                            <a href="/admin/manageOrders/Instant">
                                <i class="icon-basket"></i>
                                Manage Orders</a>
                        </li>
                        <li>
                        <li class="@yield('ILMP')">
                            <a href="/admin/managePackage/Instant">
                                <i class="fa fa-list" aria-hidden="true"></i>

                                Manage Packages</a>
                        </li>

                        <li>
                        <li class="@yield('IMT')">
                            <a href="/admin/manageTransaction/Instant">
                                <i class="fa fa-history" aria-hidden="true"></i>
                                Transaction History</a>
                        </li>
                        <li class="@yield('ILFN')">
                            {{--<a href="/admin/flash-message">--}}
                            <a href="/admin/flash-messageInstant">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i>
                                Flash News GIL
                            </a>
                        </li>
                        {{--<li class="@yield('Module')">--}}
                            {{--<a href="/admin/module-status">--}}
                                {{--<i class="fa fa-file-text-o" aria-hidden="true"></i>--}}
                                {{--Module Switch--}}
                            {{--</a>--}}
                        {{--</li>--}}

                    </ul>
                </li>

                {{--<li>--}}
                <li class="@yield('GILR')">
                    <a href="javascript:;">
                        <i class="fa fa-heartbeat "></i>
                        <span class="title">Get Instant Likes Ru</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="@yield('GILRMU')">
                            <a href="/admin/manageUser/GILR">
                                <i class="fa fa-user-plus"></i>
                                Manage Users</a>
                        </li>
                        <li class="@yield('GILRMO')">
                            <a href="/admin/manageOrders/GILR">
                                <i class="icon-basket"></i>
                                Manage Orders</a>
                        </li>
                        <li CLASS="@yield('GILRMP')">
                            <a href="/admin/managePackage/GILR">
                                <i class="fa fa-list-alt"></i>
                                Manage Packages</a>
                        </li>
                        <li class="@yield('GILRMTH')">
                            <a href="/admin/manageTransaction/GILR">
                                <i class="fa fa-list-alt"></i>
                                Transaction History
                            </a>
                        </li>

                        <li class="@yield('Module2')">
                            <a href="/admin/module-statusGILR">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i>
                                Module Switch
                            </a>
                        </li>

                        <li class="@yield('UserActive')">
                            <a href="/admin/activity-logs">
                                <i class="fa fa-list"aria-hidden="true"></i>
                                Activity Logs
                            </a>
                        </li>

                    </ul>
                </li>


                {{--<li>--}}
                <li class="@yield('GIVE')">
                    <a href="javascript:;">
                        <i class="fa fa-play-circle-o "></i>
                        <span class="title">Get Instant Views EN</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="@yield('GIVEMU')">
                            <a href="/admin/manageUser/GIVE">
                                <i class="fa fa-user-plus"></i>
                                Manage Users</a>
                        </li>
                        <li class="@yield('GIVEMO')">
                            <a href="/admin/manageOrders/GIVE">
                                <i class="icon-basket"></i>
                                Manage Orders</a>
                        </li>
                        <li CLASS="@yield('GIVEMP')">
                            <a href="/admin/managePackage/GIVE">
                                <i class="fa fa-list-alt"></i>
                                Manage Packages</a>
                        </li>
                        <li class="@yield('GIVEMTH')">
                            <a href="/admin/manageTransaction/GIVE">
                                <i class="fa fa-list-alt"></i>
                                Transaction History
                            </a>
                        </li>


                        <li class="@yield('Module')">
                            <a href="/admin/module-status">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i>
                                Module Switch
                            </a>
                        </li>


                    </ul>
                        </li>



                <li class="@yield('GIVR')">
                    <a href="javascript:;">
                        <i class="fa fa-video-camera"></i>
                        <span class="title">Get Instant Views Ru</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="@yield('GIVRMU')">
                            <a href="/admin/manageUser/GIVR">
                                <i class="fa fa-user-plus"></i>
                                Manage Users</a>
                        </li>
                        <li class="@yield('GIVRMO')">
                            <a href="/admin/manageOrders/GIVR">
                                <i class="icon-basket"></i>
                                Manage Orders</a>
                        </li>
                        <li class="@yield('GIVRMP')">
                            <a href="/admin/managePackage/GIVR">
                                <i class="fa fa-list-alt"></i>
                                Manage Packages</a>
                        </li>
                        <li class="@yield('GIVRTH')">
                            <a href="/admin/manageTransaction/GIVR">
                                <i class="fa fa-list-alt"></i>
                                Transaction History
                            </a>
                        </li>

                        <li class="@yield('ModuleGIVR')">
                            <a href="/admin/ModuleSwitchGIVR">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i>
                                Module Switch
                            </a>
                        </li>
                        <li class="@yield('UserActiveGivr')">
                            <a href="/admin/activity-LogsGivr">
                                <i class="fa fa-list" aria-hidden="true"></i>
                                Activity Logs
                            </a>
                        </li>


                        <li class="@yield('tutorialimg')">
                            <a href="/admin/add-tutorials">
                                <i class="fa fa-video-camera"></i>
                                Tutorial
                            </a>
                        </li>
                    </ul>
                </li>
                {{--<li>--}}
                <li class="@yield('AUTOIG')">
                <a href="javascript:;">
                    <i class="fa fa-thumbs-up"></i>
                    <span class="title">AUTOIG</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li class="@yield('AUTOIGMU')">
                        <a href="/admin/manageUser/AUTOIG">
                            <i class="fa fa-user-plus"></i>
                            Manage Users</a>
                    </li>
                    <li class="@yield('AUTOIGO')">
                        <a href="/admin/manageOrders/AUTOIG">
                            <i class="icon-basket"></i>
                            Manage Orders</a>
                    </li>
                    <li class="@yield('AUTOIGMP')">
                        <a href="/admin/managePackage/AUTOIG">
                            <i class="fa fa-list-alt"></i>
                            Manage Packages</a>
                    </li>

                    <li class="@yield('AUTOIGTH')">
                        <a href="/admin/manageTransaction/AUTOIG">
                            <i class="fa fa-list-alt"></i>
                            Transaction History
                        </a>
                    </li>

                    <li>
                    <li class="@yield('SPAUTOIG')">
                        <a href="/admin/SubscriptionDatatable">
                            <i class="fa fa-list-alt"></i>
                            Subscription Packages</a>
                    </li>

                    <li class="@yield('SPOFILE')">
                        {{--<a href="/admin/SubscriptionDatatable">--}}
                        <a href="/admin/ProfileDatatTable">
                                <i class="fa fa-instagram"></i>
                            Autolike Profile</a>
                    </li>
                    <li class="@yield('PAYMENT')">
                        {{--<a href="/admin/SubscriptionDatatable">--}}
                        <a href="/admin/PaymentDatable">
                            <i class="fa fa-list-alt"></i>
                            Payment History</a>
                    </li>
                    <li class="@yield('Niche')">
                        {{--<a href="/admin/SubscriptionDatatable">--}}
                        <a href="/admin/NicheTable">
                            <i class="fa fa-list-alt"></i>
                            Niche </a>
                    </li>
                    {{--<li class="@yield('Module3')">--}}
                        {{--<a href="/admin/module-statusAUTOIG">--}}
                            {{--<i class="fa fa-file-text-o" aria-hidden="true"></i>--}}
                            {{--Module Switch--}}
                        {{--</a>--}}
                    {{--</li>--}}

                    {{--<li class="@yield('Emergency')">--}}
                        {{--<a href="/admin/Emergency-SwitchAUTOIG">--}}
                            {{--<i class="fa fa-file-text-o" aria-hidden="true"></i>--}}
                            {{--Emergency Switch--}}
                        {{--</a>--}}
                    {{--</li>--}}

                    <li class="@yield('switch')">
                        <a href="/admin/SettingSwitch">
                            <i class="fa fa-cog"  style="font-size:19px"aria-hidden="true"></i>
                            Settings
                        </a>
                    </li>


                    <li class="@yield('UserActiveAutoig')">
                        <a href="/admin/activity-LogsAutoig">
                            <i class="fa fa-list"aria-hidden="true"></i>
                            Activity Logs
                        </a>
                    </li>

                </ul>
                </li>
                {{--<li>--}}
                <li class="@yield('INSTASTAT')">
                    <a href="javascript:;">
                        <i class="fa fa-instagram"></i>
                        <span class="title">INSTASTATS</span>
                        <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="@yield('STAT')">
                            <a href="/admin/manageUser/INSTASTAT">
                                <i class="fa fa-user-plus"></i>
                                Manage Users</a>
                        </li>
                        <li class="@yield('STATO')">
                            <a href="/admin/manageOrders/INSTASTAT">
                                <i class="icon-basket"></i>
                                Manage Orders</a>
                        </li>
                        <li class="@yield('STATP')">
                            <a href="/admin/managePackage/INSTASTAT">
                                <i class="fa fa-list-alt"></i>
                                Manage Packages</a>
                        </li>
                        <li class="@yield('IMAGE')">
                            <a href="/admin/AddBanner">
                                <i class="fa fa-picture-o"></i>
                                 Stats AdBanner </a>
                        </li>
                        <li class="@yield('Boost')">
                            <a href="/admin/viralBoost">
                                <i class="fa fa-picture-o"></i>
                                 ViralBoost Banner </a>
                        </li>
                        <li class="@yield('Instgram')">
                            <a href="/admin/InstgarmTable">
                                <i class="fa fa-instagram"></i>
                                Instagram Profile </a>
                        </li>
                        <li class="@yield('INSTASTMTH')">
                            <a href="/admin/manageTransaction/INSTASTAT">
                                <i class="fa fa-list-alt"></i>
                                Transaction History
                            </a>

                    </ul>
                </li>




                <li class="@yield('TrendApp')">
                    <a href="javascript:;">
                        <i class="fa fa-slack"></i>
                        <span class="title">Trending Hashtags</span>
                        <span class="arrow "></span>

                    </a>

                    <ul class="sub-menu">
                        <li class="@yield('Hashtag')">
                            <a href="/admin/UploadImage">
                                <i class="fa fa-picture-o"></i>
                                Ad Banner</a>
                        </li>

                        <li class="@yield('Hashtag1')">
                            <a href="/admin/flashMessageTrending">
                                <i class="fa fa-gift"></i>
                               Gift Message</a>
                        </li>
                    </ul>
                </li>


                <li class="@yield('Comments')">
                    <a href="/admin/commentTable">
                        <i class="fa fa-comments"></i>
                        <span class="title">Manage Comments</span>
                    </a>
                    {{--</ul>--}}
                </li>
            <li class="@yield('Proxy3')">
                <a href="/admin/ProxiesTable">
                    <i class="fa fa-list"></i>
                    <span class="title">Manage Proxy</span>
                </a>
                {{--</ul>--}}
            </li>

                <li class="@yield('Plan2')">
                    <a href="/admin/PlanDatatable">
                        <i class="fa fa-clipboard"></i>
                        <span class="title">Manage Plan</span>
                    </a>
                    {{--</ul>--}}
                </li>



            </ul>
            <!-- END SIDEBAR MENU -->
        </div>
    </div>
    <!-- END SIDEBAR -->
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
            @yield('pagecontent')
        </div>
    </div>
    <!-- END CONTENT -->
    <!-- BEGIN QUICK SIDEBAR -->

    <!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="page-footer-inner">
        <?php echo date('Y');?> &copy; GAIA.
        {{--<p id="timezone"></p>--}}

    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->



<!-- END JAVASCRIPTS -->

@include('Admin::Layouts.footerscripts')
@yield('pagescripts')


</body>
<!-- END BODY -->
</html>

