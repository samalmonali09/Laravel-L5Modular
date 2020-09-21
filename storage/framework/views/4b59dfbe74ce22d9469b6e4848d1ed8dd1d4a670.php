




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
    <?php echo $__env->make('Admin::Layouts.headcontent', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->yieldContent('pageheadcontent'); ?>

    
        
          
            
        

        
            
        

    
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
                        
                        <span class="username username-hide-on-mobile">
                            <?php echo e(\Illuminate\Support\Facades\Session::get('admin')['username']); ?>

                            </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            
                            
                            <a href="/admin/myProfile"><i class="icon-user"></i> My
                                Profile </a>
                        </li>

                        <li class="divider">
                        </li>
                        
                            
                            
                        
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

                <li class="<?php echo $__env->yieldContent('dashboard'); ?>">
                    <a href="/admin/dashboard">
                        <i class="icon-home"></i>
                        <span class="title">Dashboard</span>
                        <span class="selected"></span>
                    </a>
                </li>

                
                <li class="<?php echo $__env->yieldContent('GILE'); ?>">
                    <a href="javascript:;">
                        <i class="fa fa-heart"></i>
                        
                        <span class="title">Get Instant Likes EN</span>
                        <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="<?php echo $__env->yieldContent('GILEMU'); ?>">
                            <a href="/admin/manageUser/GILE">
                                <i class="fa fa-users"></i>
                                Manage Users</a>
                        </li>
                        <li class="<?php echo $__env->yieldContent('GILEMO'); ?>">
                            <a href="/admin/manageOrders/GILE">
                                <i class="icon-basket"></i>
                                Manage Orders</a>
                        </li>
                        <li>
                        <li class="<?php echo $__env->yieldContent('GILEMP'); ?>">
                        <a href="/admin/managePackage/GILE">
                            <i class="fa fa-list" aria-hidden="true"></i>

                            Manage Packages</a>
                        </li>

                        <li>
                        <li class="<?php echo $__env->yieldContent('GILEMTH'); ?>">
                        <a href="/admin/manageTransaction/GILE">
                            <i class="fa fa-history" aria-hidden="true"></i>
                            Transaction History</a>
                        </li>
                        <li class="<?php echo $__env->yieldContent('GILEFN'); ?>">
                            <a href="/admin/flash-message">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i>
                                Flash News
                            </a>
                        </li>
                        
                            
                                
                                
                            
                        


                    </ul>
                </li>



                <li class="<?php echo $__env->yieldContent('GIL'); ?>">
                    <a href="javascript:;">
                        <i class="fa fa-heart"></i>
                        
                        <span class="title"> Instant Likes</span>
                        <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="<?php echo $__env->yieldContent('ILMU'); ?>">
                            <a href="/admin/manageUser/Instant">
                                <i class="fa fa-users"></i>
                                Manage Users</a>
                        </li>
                        <li class="<?php echo $__env->yieldContent('ILMO'); ?>">
                            <a href="/admin/manageOrders/Instant">
                                <i class="icon-basket"></i>
                                Manage Orders</a>
                        </li>
                        <li>
                        <li class="<?php echo $__env->yieldContent('ILMP'); ?>">
                            <a href="/admin/managePackage/Instant">
                                <i class="fa fa-list" aria-hidden="true"></i>

                                Manage Packages</a>
                        </li>

                        <li>
                        <li class="<?php echo $__env->yieldContent('IMT'); ?>">
                            <a href="/admin/manageTransaction/Instant">
                                <i class="fa fa-history" aria-hidden="true"></i>
                                Transaction History</a>
                        </li>
                        <li class="<?php echo $__env->yieldContent('ILFN'); ?>">
                            
                            <a href="/admin/flash-messageInstant">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i>
                                Flash News GIL
                            </a>
                        </li>
                        
                            
                                
                                
                            
                        

                    </ul>
                </li>

                
                <li class="<?php echo $__env->yieldContent('GILR'); ?>">
                    <a href="javascript:;">
                        <i class="fa fa-heartbeat "></i>
                        <span class="title">Get Instant Likes Ru</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="<?php echo $__env->yieldContent('GILRMU'); ?>">
                            <a href="/admin/manageUser/GILR">
                                <i class="fa fa-user-plus"></i>
                                Manage Users</a>
                        </li>
                        <li class="<?php echo $__env->yieldContent('GILRMO'); ?>">
                            <a href="/admin/manageOrders/GILR">
                                <i class="icon-basket"></i>
                                Manage Orders</a>
                        </li>
                        <li CLASS="<?php echo $__env->yieldContent('GILRMP'); ?>">
                            <a href="/admin/managePackage/GILR">
                                <i class="fa fa-list-alt"></i>
                                Manage Packages</a>
                        </li>
                        <li class="<?php echo $__env->yieldContent('GILRMTH'); ?>">
                            <a href="/admin/manageTransaction/GILR">
                                <i class="fa fa-list-alt"></i>
                                Transaction History
                            </a>
                        </li>

                        <li class="<?php echo $__env->yieldContent('Module2'); ?>">
                            <a href="/admin/module-statusGILR">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i>
                                Module Switch
                            </a>
                        </li>

                        <li class="<?php echo $__env->yieldContent('UserActive'); ?>">
                            <a href="/admin/activity-logs">
                                <i class="fa fa-list"aria-hidden="true"></i>
                                Activity Logs
                            </a>
                        </li>

                    </ul>
                </li>


                
                <li class="<?php echo $__env->yieldContent('GIVE'); ?>">
                    <a href="javascript:;">
                        <i class="fa fa-play-circle-o "></i>
                        <span class="title">Get Instant Views EN</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="<?php echo $__env->yieldContent('GIVEMU'); ?>">
                            <a href="/admin/manageUser/GIVE">
                                <i class="fa fa-user-plus"></i>
                                Manage Users</a>
                        </li>
                        <li class="<?php echo $__env->yieldContent('GIVEMO'); ?>">
                            <a href="/admin/manageOrders/GIVE">
                                <i class="icon-basket"></i>
                                Manage Orders</a>
                        </li>
                        <li CLASS="<?php echo $__env->yieldContent('GIVEMP'); ?>">
                            <a href="/admin/managePackage/GIVE">
                                <i class="fa fa-list-alt"></i>
                                Manage Packages</a>
                        </li>
                        <li class="<?php echo $__env->yieldContent('GIVEMTH'); ?>">
                            <a href="/admin/manageTransaction/GIVE">
                                <i class="fa fa-list-alt"></i>
                                Transaction History
                            </a>
                        </li>


                        <li class="<?php echo $__env->yieldContent('Module'); ?>">
                            <a href="/admin/module-status">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i>
                                Module Switch
                            </a>
                        </li>


                    </ul>
                        </li>



                <li class="<?php echo $__env->yieldContent('GIVR'); ?>">
                    <a href="javascript:;">
                        <i class="fa fa-video-camera"></i>
                        <span class="title">Get Instant Views Ru</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="<?php echo $__env->yieldContent('GIVRMU'); ?>">
                            <a href="/admin/manageUser/GIVR">
                                <i class="fa fa-user-plus"></i>
                                Manage Users</a>
                        </li>
                        <li class="<?php echo $__env->yieldContent('GIVRMO'); ?>">
                            <a href="/admin/manageOrders/GIVR">
                                <i class="icon-basket"></i>
                                Manage Orders</a>
                        </li>
                        <li class="<?php echo $__env->yieldContent('GIVRMP'); ?>">
                            <a href="/admin/managePackage/GIVR">
                                <i class="fa fa-list-alt"></i>
                                Manage Packages</a>
                        </li>
                        <li class="<?php echo $__env->yieldContent('GIVRTH'); ?>">
                            <a href="/admin/manageTransaction/GIVR">
                                <i class="fa fa-list-alt"></i>
                                Transaction History
                            </a>
                        </li>

                        <li class="<?php echo $__env->yieldContent('ModuleGIVR'); ?>">
                            <a href="/admin/ModuleSwitchGIVR">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i>
                                Module Switch
                            </a>
                        </li>
                        <li class="<?php echo $__env->yieldContent('UserActiveGivr'); ?>">
                            <a href="/admin/activity-LogsGivr">
                                <i class="fa fa-list" aria-hidden="true"></i>
                                Activity Logs
                            </a>
                        </li>


                        <li class="<?php echo $__env->yieldContent('tutorialimg'); ?>">
                            <a href="/admin/add-tutorials">
                                <i class="fa fa-video-camera"></i>
                                Tutorial
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li class="<?php echo $__env->yieldContent('AUTOIG'); ?>">
                <a href="javascript:;">
                    <i class="fa fa-thumbs-up"></i>
                    <span class="title">AUTOIG</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li class="<?php echo $__env->yieldContent('AUTOIGMU'); ?>">
                        <a href="/admin/manageUser/AUTOIG">
                            <i class="fa fa-user-plus"></i>
                            Manage Users</a>
                    </li>
                    <li class="<?php echo $__env->yieldContent('AUTOIGO'); ?>">
                        <a href="/admin/manageOrders/AUTOIG">
                            <i class="icon-basket"></i>
                            Manage Orders</a>
                    </li>
                    <li class="<?php echo $__env->yieldContent('AUTOIGMP'); ?>">
                        <a href="/admin/managePackage/AUTOIG">
                            <i class="fa fa-list-alt"></i>
                            Manage Packages</a>
                    </li>

                    <li class="<?php echo $__env->yieldContent('AUTOIGTH'); ?>">
                        <a href="/admin/manageTransaction/AUTOIG">
                            <i class="fa fa-list-alt"></i>
                            Transaction History
                        </a>
                    </li>

                    <li>
                    <li class="<?php echo $__env->yieldContent('SPAUTOIG'); ?>">
                        <a href="/admin/SubscriptionDatatable">
                            <i class="fa fa-list-alt"></i>
                            Subscription Packages</a>
                    </li>

                    <li class="<?php echo $__env->yieldContent('SPOFILE'); ?>">
                        
                        <a href="/admin/ProfileDatatTable">
                                <i class="fa fa-instagram"></i>
                            Autolike Profile</a>
                    </li>
                    <li class="<?php echo $__env->yieldContent('PAYMENT'); ?>">
                        
                        <a href="/admin/PaymentDatable">
                            <i class="fa fa-list-alt"></i>
                            Payment History</a>
                    </li>
                    <li class="<?php echo $__env->yieldContent('Niche'); ?>">
                        
                        <a href="/admin/NicheTable">
                            <i class="fa fa-list-alt"></i>
                            Niche </a>
                    </li>
                    
                        
                            
                            
                        
                    

                    
                        
                            
                            
                        
                    

                    <li class="<?php echo $__env->yieldContent('switch'); ?>">
                        <a href="/admin/SettingSwitch">
                            <i class="fa fa-cog"  style="font-size:19px"aria-hidden="true"></i>
                            Settings
                        </a>
                    </li>


                    <li class="<?php echo $__env->yieldContent('UserActiveAutoig'); ?>">
                        <a href="/admin/activity-LogsAutoig">
                            <i class="fa fa-list"aria-hidden="true"></i>
                            Activity Logs
                        </a>
                    </li>

                </ul>
                </li>
                
                <li class="<?php echo $__env->yieldContent('INSTASTAT'); ?>">
                    <a href="javascript:;">
                        <i class="fa fa-instagram"></i>
                        <span class="title">INSTASTATS</span>
                        <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="<?php echo $__env->yieldContent('STAT'); ?>">
                            <a href="/admin/manageUser/INSTASTAT">
                                <i class="fa fa-user-plus"></i>
                                Manage Users</a>
                        </li>
                        <li class="<?php echo $__env->yieldContent('STATO'); ?>">
                            <a href="/admin/manageOrders/INSTASTAT">
                                <i class="icon-basket"></i>
                                Manage Orders</a>
                        </li>
                        <li class="<?php echo $__env->yieldContent('STATP'); ?>">
                            <a href="/admin/managePackage/INSTASTAT">
                                <i class="fa fa-list-alt"></i>
                                Manage Packages</a>
                        </li>
                        <li class="<?php echo $__env->yieldContent('IMAGE'); ?>">
                            <a href="/admin/AddBanner">
                                <i class="fa fa-picture-o"></i>
                                 Stats AdBanner </a>
                        </li>
                        <li class="<?php echo $__env->yieldContent('Boost'); ?>">
                            <a href="/admin/viralBoost">
                                <i class="fa fa-picture-o"></i>
                                 ViralBoost Banner </a>
                        </li>
                        <li class="<?php echo $__env->yieldContent('Instgram'); ?>">
                            <a href="/admin/InstgarmTable">
                                <i class="fa fa-instagram"></i>
                                Instagram Profile </a>
                        </li>
                        <li class="<?php echo $__env->yieldContent('INSTASTMTH'); ?>">
                            <a href="/admin/manageTransaction/INSTASTAT">
                                <i class="fa fa-list-alt"></i>
                                Transaction History
                            </a>

                    </ul>
                </li>




                <li class="<?php echo $__env->yieldContent('TrendApp'); ?>">
                    <a href="javascript:;">
                        <i class="fa fa-slack"></i>
                        <span class="title">Trending Hashtags</span>
                        <span class="arrow "></span>

                    </a>

                    <ul class="sub-menu">
                        <li class="<?php echo $__env->yieldContent('Hashtag'); ?>">
                            <a href="/admin/UploadImage">
                                <i class="fa fa-picture-o"></i>
                                Ad Banner</a>
                        </li>

                        <li class="<?php echo $__env->yieldContent('Hashtag1'); ?>">
                            <a href="/admin/flashMessageTrending">
                                <i class="fa fa-gift"></i>
                               Gift Message</a>
                        </li>
                    </ul>
                </li>


                <li class="<?php echo $__env->yieldContent('Comments'); ?>">
                    <a href="/admin/commentTable">
                        <i class="fa fa-comments"></i>
                        <span class="title">Manage Comments</span>
                    </a>
                    
                </li>
            <li class="<?php echo $__env->yieldContent('Proxy3'); ?>">
                <a href="/admin/ProxiesTable">
                    <i class="fa fa-list"></i>
                    <span class="title">Manage Proxy</span>
                </a>
                
            </li>

                <li class="<?php echo $__env->yieldContent('Plan2'); ?>">
                    <a href="/admin/PlanDatatable">
                        <i class="fa fa-clipboard"></i>
                        <span class="title">Manage Plan</span>
                    </a>
                    
                </li>



            </ul>
            <!-- END SIDEBAR MENU -->
        </div>
    </div>
    <!-- END SIDEBAR -->
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <?php echo $__env->yieldContent('pagecontent'); ?>
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
        

    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->



<!-- END JAVASCRIPTS -->

<?php echo $__env->make('Admin::Layouts.footerscripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->yieldContent('pagescripts'); ?>


</body>
<!-- END BODY -->
</html>

