<?php

Route::get('/', function () {
    return redirect('/admin/login');
});

Route::get('/admin', function () {
    return redirect('/admin/login');
});

Route::view('/admin/instastats-api', 'Admin::api.instastatsapi');
Route::group(['module' => 'Admin', 'middleware' => ['web'], 'namespace' => 'App\Modules\Admin\Controllers'], function () {

    Route::get('admin/adBanner', function () {
        return view('Admin::package.adbanner');
    });

    Route::get('/admin/register', 'AdminController@registration');
    Route::post('/admin/register', 'AdminController@registration');
    Route::get('/admin/activation/{token}', 'AdminController@adminLogin');
    Route::get('/admin/login', 'AdminController@adminLogin');
    Route::post('/admin/login', 'AdminController@adminLogin');
    Route::get('/admin/resetpassword/{token}', 'AdminController@resetPassword');
    Route::post('/admin/resetpassword/{token}', 'AdminController@resetPassword');
    Route::get('/admin/forgotpassword', 'AdminController@forgotPassword');
    Route::post('/admin/forgotpassword', 'AdminController@forgotPassword');


    Route::group(/**
     * @Desc route for AdminController
     * @since 7 jan 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
        ['middleware' => 'auth:admin'], function () {
        Route::get('/admin/dashboard', 'AdminController@adminDashboard');
        Route::post('/admin/dashboard', 'AdminController@adminDashboard');
        Route::post('/admin/dashboarAjaxHandler', 'AdminController@dashboardAjaxHandler');
        Route::get('/admin/logout', 'AdminController@adminLogout');
        Route::post('/admin/logout', 'AdminController@adminLogout');
        Route::get('/admin/resetpassword', 'AdminController@resetPassword');
        Route::post('/admin/resetpassword', 'AdminController@resetPassword');
        Route::get('/admin/myProfile', 'AdminController@myProfile');
        Route::post('/admin/myProfile', 'AdminController@myProfile');
        Route::get('/admin/lock', 'AdminController@lock');
        Route::post('/admin/lock', 'AdminController@lock');
        Route::get('/admin/editAccount/{id}', 'AdminController@editAccount');
        Route::post('/admin/editAccount/{id}', 'AdminController@editAccount');
        Route::get('/admin/edit-records', 'AdminController@indexdata');
        Route::get('/admin/edit/{id}', 'AdminController@showdata');
        Route::post('/admin/edit/{id}', 'AdminController@editdata');
        Route::get('/admin/delete-records', 'AdminController@deleteuser');
        Route::get('/admin/delete/{id}', 'AdminController@destroydata');
        Route::get('/admin/datatable', ['uses' => 'AdminController@datatable']);
        Route::get('/admin/datatable/getposts', ['as' => 'datatable.getposts', 'uses' => 'AdminController@getPosts']);
        Route::get('/admin/changePassword', 'AdminController@changePassword');
        Route::post('/admin/changePassword', 'AdminController@changePassword');
        Route::get('/admin/update_user_status/{uid}', 'AdminController@update_user_status');


        /**
         * @Desc route for UserController
         * @since 29/jan/ 2018
         * @author Monali Samal (monalisamal@globussoft.in)
         */
        Route::get('/admin/AddingUser/{appName?}', 'UserController@addUser');
        Route::Post('/admin/AddingUser/{appName?}', 'UserController@addUser');
        Route::get('/admin/availableUser', 'UserController@availableUser');
        Route::Post('/admin/availableUser', 'UserController@availableUser');
        Route::get('/admin/availableUser/databaseData', 'UserController@databaseData');
        Route::get('/admin/satusChange', 'UserController@satusChange');
        Route::post('/admin/satusChange', 'UserController@satusChange');

        /**
         * @Desc route for manageUser functionality route  in UserController
         * @since 29/jan/ 2018
         * @author Monali Samal (monalisamal@globussoft.in)
         */
        Route::get('testing', function () {
            return view('Admin::Users.manageFlashNews');
        });
        Route::get('/admin/manageUser', 'UserController@manageUserData');
        Route::get('/admin/manageUser/{method}', 'UserController@manageUserData');
        Route::post('/admin/manageUser/{method}', 'UserController@manageUserData');
        Route::post('/admin/manageAjaxHandler', 'UserController@manageAjaxHandler');
        Route::post('/admin/getMoreUsersDetails', 'UserController@getMoreUsersDetails');
        Route::get('/admin/getEditUser', 'UserController@editAjaxhandlerUser');
        Route::post('/admin/getEditUser', 'UserController@editAjaxhandlerUser');
        Route::get('/admin/pendingUser', 'UserController@pendingUser');
        Route::get('/admin/pendingUser/dataInput', 'UserController@dataInput');
        Route::get('/admin/pendingStatus', 'UserController@pendingStatus');
        Route::post('/admin/pendingStatus', 'UserController@pendingStatus');
        Route::get('/admin/delete', 'UserController@delete');
        Route::get('/admin/delete/{id}', 'UserController@destroy');
        Route::post('/admin/DeleteAjaxHandeler', 'UserController@DeleteAjaxHandeler');
        Route::post('/admin/getUpdatePasswordAjaxHandler', 'UserController@getUpdatePasswordAjaxHandler');
        Route::post('/admin/getUpdateAjax', 'UserController@getUpdateAjaxHandler');


        /**
         * @Desc route for OrderController
         * @since 29/jan/ 2018
         * @author Monali Samal (monalisamal@globussoft.in)
         * //         */
        Route::get('/admin/manageOrders/{method}', 'OrdersController@manageOrders');
        Route::post('/admin/manageOrders/{method}', 'OrdersController@manageOrders');
        Route::post('/admin/orderAjaxHandler', 'OrdersController@orderAjaxHandler');
        Route::post('/admin/getMoreOrderDetails', 'OrdersController@getMoreOrderDetails');
        Route::post('/admin/ShowOrderComments', 'OrdersController@ShowExtraDetailsAjaxHandelerOrderComments');


        /**
         * @Desc route for Transaction History
         * @since 8/FEB/ 2018
         * @author Monali Samal (monalisamal@globussoft.in)
         */
        Route::get('/admin/manageTransaction', 'TransactionsController@manageTransaction');
        Route::get('/admin/manageTransaction/{method}', 'TransactionsController@manageTransaction');
        Route::post('/admin/manageTransaction/{method}', 'TransactionsController@manageTransaction');
        Route::post('/admin/TransactionAjaxHandeler', 'TransactionsController@TransactionAjaxHandeler');
        Route::post('/admin/getMoreTransactionDetails', 'TransactionsController@getMoreTransactionDetails');


        /**
         * @Desc route for PackageController
         * @since 13/FEB/ 2018
         * @author Monali Samal (monalisamal@globussoft.in)
         */
        Route::get('/admin/managePackage', 'PackageController@managePackage');
        Route::get('/admin/managePackage/{method}', 'PackageController@managePackage');
        Route::post('/admin/managePackage/{method}', 'PackageController@managePackage');
        Route::post('/admin/packageAjaxHandler', 'PackageController@packageAjaxHandler');
        Route::post('/admin/getMorePackagesDetails', 'PackageController@getMorePackagesDetails');
        Route::get('/admin/getPackagesEdit', 'PackageController@getPackagesEdit');
        Route::post('/admin/getPackagesEdit', 'PackageController@getPackagesEdit');
        Route::post('/admin/getUpdatePackagedata', 'PackageController@getUpdatePackagedata');
        Route::get('/admin/satusChangePackage', 'PackageController@satusChangePackage');
        Route::post('/admin/satusChangePackage', 'PackageController@satusChangePackage');
        Route::get('/admin/AddingPackages/{appPackage?}', 'PackageController@addingPackages');
        Route::post('/admin/AddingPackages/{appPackage?}', 'PackageController@addingPackages');
        Route::post('/admin/DeleteAjaxHandelerPackageDetails', 'PackageController@DeleteAjaxHandelerPackageDetails');

        Route::get('/admin/GetAddPackages', 'PackageController@GetAddPackages');
        Route::post('/admin/GetAddPackages', 'PackageController@GetAddPackages');


        /**
         * @Desc route for CommentController
         * @since 8/march/ 2018
         * @author Monali Samal (monalisamal@globussoft.in)
         */
        Route::get('/admin/commentTable', 'CommentController@commentTable');
        Route::post('/admin/commentTable', 'CommentController@commentTable');
        Route::get('/admin/comment/databaseData', 'CommentController@databaseComment');
        Route::get('/admin/satusCommnents', 'CommentController@commentStatusChangeAjaxHandel');
        Route::post('/admin/satusCommnents', 'CommentController@commentStatusChangeAjaxHandel');
        Route::post('/admin/deleteComments', 'CommentController@deleteCommnetFunctionality');
        Route::get('/admin/editComments', 'CommentController@EditAjaxHandlerComment');
        Route::post('/admin/editComments', 'CommentController@EditAjaxHandlerComment');
        Route::post('/admin/updateComments', 'CommentController@updateAjaxHandler');
        Route::get('/admin/addingComments', 'CommentController@addingComments');
        Route::post('/admin/addingComments', 'CommentController@addingComments');


        /**
         * @Desc route for ProxyController
         * @since 10/march/ 2018
         * @author Monali Samal (monalisamal@globussoft.in)
         */
        Route::get('/admin/ProxiesTable', 'ProxyController@ProxiesTable');
        Route::post('/admin/ProxiesTable', 'ProxyController@ProxiesTable');
        Route::get('/admin/ProxiesAjaxDatables', 'ProxyController@ProxiesAjaxDatables');
        Route::post('/admin/ProxiesAjaxDatables', 'ProxyController@ProxiesAjaxDatables');
        Route::get('/admin/deleteProxyAjaxHandler', 'ProxyController@deleteProxyAjaxHandler');
        Route::post('/admin/deleteProxyAjaxHandler', 'ProxyController@deleteProxyAjaxHandler');
        Route::get('/admin/changeProxyStatusAjaxHandler', 'ProxyController@changeProxyStatusAjaxHandler');
        Route::post('/admin/changeProxyStatusAjaxHandler', 'ProxyController@changeProxyStatusAjaxHandler');
        Route::get('/admin/addProxy', 'ProxyController@addProxy');
        Route::post('/admin/addProxy', 'ProxyController@addProxy');
        Route::post('/admin/ProxiesIntoDB', 'ProxyController@ProxiesIntoDB');
        Route::get('/admin/TextFileIntoDB', 'ProxyController@TextFileIntoDB');
        Route::post('/admin/TextFileIntoDB', 'ProxyController@TextFileIntoDB');

        Route::get('/admin/myproductsDeleteAll', 'ProxyController@deleteAll');
        Route::post('/admin/myproductsDeleteAll', 'ProxyController@deleteAll');

        Route::get('/saveProxyConfiguration', 'ProxyController@saveProxyConfiguration');

        /**
         * @Desc route for FlashmessageController
         * @since 10/may/ 2018
         * @author Monali Samal (monalisamal@globussoft.in)
         */
        Route::get('/admin/flash-message', 'FlashmessageController@flashMessage');
        Route::post('/admin/flash-message', 'FlashmessageController@flashMessage');
        Route::post('/admin/flash-message-status', 'FlashmessageController@flashMessage');
        Route::get('/admin/flash-messageInstant', 'FlashmessageController@flashMessageInstant');
        Route::post('/admin/flash-messageInstant', 'FlashmessageController@flashMessageInstant');
        Route::post('/admin/flash-message-Instastatus', 'FlashmessageController@flashmessageStatusInsant');


        /**
         * @Desc route for PlansController
         * @since 23/march/ 2018
         * @author Monali Samal (monalisamal@globussoft.in)
         */
        Route::get('/admin/PlanDatatable', 'PlansController@PlanDatatable');
        Route::post('/admin/PlanDatatable', 'PlansController@PlanDatatable');
        Route::post('/admin/PlanAjaxHandeler', 'PlansController@PlanAjaxHandeler');
        Route::get('/admin/satusChangePlan', 'PlansController@satusChangePlan');
        Route::post('/admin/satusChangePlan', 'PlansController@satusChangePlan');
        Route::post('/admin/getMorePlanDetails', 'PlansController@getMorePlanDetails');
        Route::get('/admin/EditAjaxHandlerPlan', 'PlansController@EditAjaxHandlerPlan');
        Route::post('/admin/EditAjaxHandlerPlan', 'PlansController@EditAjaxHandlerPlan');
        Route::post('/admin/UpdateAjaxHandeler', 'PlansController@UpdateAjaxHandeler');
        Route::post('/admin/deleteAjaxHandler', 'PlansController@deleteAjaxHandler');
        Route::get('/admin/AddPlan', 'PlansController@AddPlan');
        Route::post('/admin/AddPlan', 'PlansController@AddPlan');


        /**
         * @Desc route for BannerController
         * @since 23/may/ 2018
         * @author Monali Samal (monalisamal@globussoft.in)
         */
        Route::get('/admin/AddBanner', 'BannerController@imagesUpload');
        Route::post('/admin/AddBanner', 'BannerController@imagesUpload');
        Route::get('/admin/AddToDatabase', 'BannerController@imageDatabase');
        Route::post('/admin/AddToDatabase', 'BannerController@imageDatabase');
        Route::get('/admin/singleimage', 'BannerController@singleimage');
        Route::post('/admin/singleimage', 'BannerController@singleimage');
        Route::get('/admin/singleImageAndroid', 'BannerController@singleImageAndroid');
        Route::post('/admin/singleImageAndroid', 'BannerController@singleImageAndroid');
        Route::get('/admin/imageupdateForIOS', 'BannerController@imageupdateForIOS');
        Route::post('/admin/imageupdateForIOS', 'BannerController@imageupdateForIOS');
        Route::post('/admin/deleteAjaxHandlerImageIOS', 'BannerController@deleteAjaxHandlerImageIOS');
        Route::post('/admin/deleteAjaxHandlerImageAndroid', 'BannerController@deleteAjaxHandlerImageAndroid');
        Route::post('/admin/insertImage', 'BannerController@insertImage');
        Route::post('/admin/InserImageAndroid', 'BannerController@InserImageAndroid');
        Route::get('/admin/InstaStartsBanner', 'BannerController@InstaStartsBanner');
        Route::get('/admin/InstagramAccount', 'InstagramAutolikeController@singleImageAndroid');
        Route::post('/admin/InstagramAccount', 'InstagramAutolikeController@singleImageAndroid');


        /**
         * @Desc route for ViralBoostController
         * @since 28/may/ 2018
         * @author Monali Samal (monalisamal@globussoft.in)
         */

        Route::get('/admin/viralBoost', 'ViralBoostController@imagesUploadBoost');
        Route::post('/admin/viralBoost', 'ViralBoostController@imagesUploadBoost');
        Route::get('/admin/AddToDatabase', 'ViralBoostController@imageDatabase');
        Route::post('/admin/AddToDatabase', 'ViralBoostController@imageDatabase');
        Route::get('/admin/singleimageBoost', 'ViralBoostController@singleimage');
        Route::post('/admin/singleimageBoost', 'ViralBoostController@singleimage');
        Route::get('/admin/singleImageAndroidBoost', 'ViralBoostController@singleImageAndroid');
        Route::post('/admin/singleImageAndroidBoost', 'ViralBoostController@singleImageAndroid');
        Route::get('/admin/imageupdateForIOSBoost', 'ViralBoostController@imageupdateForIOS');
        Route::post('/admin/imageupdateForIOSBoost', 'ViralBoostController@imageupdateForIOS');
        Route::post('/admin/deleteAjaxHandlerImageIOSBoost', 'ViralBoostController@deleteAjaxHandlerImageIOS');
        Route::post('/admin/deleteAjaxHandlerImageAndroidBoost', 'ViralBoostController@deleteAjaxHandlerImageAndroid');
        Route::post('/admin/insertImageBoost', 'ViralBoostController@insertImage');
        Route::post('/admin/InserImageAndroidBoost', 'ViralBoostController@InserImageAndroid');
        Route::get('/admin/InstaStartsBannerBoost', 'ViralBoostController@InstaStartsBanner');















        /**
         * @Desc route for TrendingHashtagController
         * @since 24/sep/ 2018
         * @author Monali Samal (monalisamal@globussoft.in)
         */

        Route::get('/admin/UploadImage', 'TrendingHashtagController@UploadImage');
        Route::post('/admin/UploadImage', 'TrendingHashtagController@UploadImage');

        Route::get('/admin/singleImageHashtag', 'TrendingHashtagController@singleImageHashtag');
        Route::post('/admin/singleImageHashtag', 'TrendingHashtagController@singleImageHashtag');

        Route::get('/admin/insertImageBanner', 'TrendingHashtagController@insertImageBanner');
        Route::post('/admin/insertImageBanner', 'TrendingHashtagController@insertImageBanner');

        Route::get('/admin/imageupdate', 'TrendingHashtagController@imageupdate');
        Route::post('/admin/imageupdate', 'TrendingHashtagController@imageupdate');

        Route::post('/admin/deleteAjaxHandlerImage', 'TrendingHashtagController@deleteAjaxHandlerImage');


        Route::get('/admin/flashMessageTrending', 'FlashmessageController@flashMessageTrending');
        Route::post('/admin/flashMessageTrending', 'FlashmessageController@flashMessageTrending');
        Route::post('/admin/flashmessageStatusTrending', 'FlashmessageController@flashmessageStatusTrending');



        Route::get('/admin/UploadImageAutoig', 'AutoigBannerController@UploadImageAutoig');
        Route::post('/admin/UploadImageAutoig', 'AutoigBannerController@UploadImageAutoig');
        Route::post('/admin/imageupdateAutoig', 'AutoigBannerController@imageupdateAutoig');
        Route::post('/admin/imageupdateAutoig', 'AutoigBannerController@imageupdateAutoig');
        Route::get('/admin/insertImageBannerAutoig', 'AutoigBannerController@insertImageBannerAutoig');
        Route::post('/admin/insertImageBannerAutoig', 'AutoigBannerController@insertImageBannerAutoig');
        Route::get('/admin/singleImageAutoig', 'AutoigBannerController@singleImageAutoig');
        Route::post('/admin/singleImageAutoig', 'AutoigBannerController@singleImageAutoig');
        Route::post('/admin/deleteAjaxHandlerImageAutoig', 'AutoigBannerController@deleteAjaxHandlerImageAutoig');




        /**
         * @Desc route for ModuleSwitchController
         * @since 28/may/ 2018
         * @author Monali Samal (monalisamal@globussoft.in)
         */

        Route::get('/admin/module-status', 'ModuleSwitchController@moduleStatus');
        Route::post('/admin/module-status', 'ModuleSwitchController@moduleStatus');
        Route::post('/whiteBannerImage', 'ModuleSwitchController@whiteBannerImage');
        Route::get('/admin/module-statusGILR', 'ModuleSwitchController@moduleStatusGILR');
        Route::Post('/admin/module-statusGILR', 'ModuleSwitchController@moduleStatusGILR');
        Route::get('/admin/module-statusAUTOIG', 'ModuleSwitchController@moduleStatusAUTOIG');
        Route::post('/admin/module-statusAUTOIG', 'ModuleSwitchController@moduleStatusAUTOIG');
        Route::get('/admin/Emergency-SwitchAUTOIG', 'ModuleSwitchController@EmergencyStatusAutoIg');
        Route::Post('/admin/Emergency-SwitchAUTOIG', 'ModuleSwitchController@EmergencyStatusAutoIg');
        Route::get('/admin/GiftIcon-Autoig', 'ModuleSwitchController@GiftIcon');
        Route::Post('/admin/GiftIcon-Autoig', 'ModuleSwitchController@GiftIcon');
        Route::get('/admin/SettingSwitch', 'ModuleSwitchController@SettingSwitch');
        Route::Post('/admin/SettingSwitch', 'ModuleSwitchController@SettingSwitch');

        Route::get('/admin/ModuleSwitchGIVR', 'ModuleSwitchController@ModuleSwitchGIVR');
        Route::post('/admin/ModuleSwitchGIVR', 'ModuleSwitchController@ModuleSwitchGIVR');
        Route::post('/admin/GIVRImageProfile', 'ModuleSwitchController@GIVRImageProfile');


        Route::get('/admin/ActivityTrackerGILR', 'ModuleSwitchController@ActivityTrackerGILR');
        Route::post('/admin/ActivityTrackerGILR', 'ModuleSwitchController@ActivityTrackerGILR');

        Route::get('/admin/ActivityTrackerGIVR', 'ModuleSwitchController@ActivityTrackerGIVR');
        Route::post('/admin/ActivityTrackerGIVR', 'ModuleSwitchController@ActivityTrackerGIVR');

        /**
         * @Desc route for SubscriptionPackageController
         * @since 12/july/ 2018
         * @author Monali Samal (monalisamal@globussoft.in)
         */
        Route::get('/admin/SubscriptionDatatable', 'SubscriptionPackageController@SubscriptionDatatable');
        Route::post('/admin/SubscriptionDatatable', 'SubscriptionPackageController@SubscriptionDatatable');
        Route::post('/admin/SubscriptionAjaxHandeler', 'SubscriptionPackageController@SubscriptionAjaxHandeler');
        Route::post('/admin/satusChangeSubscription', 'SubscriptionPackageController@satusChangeSubscription');
        Route::get('/admin/AddSubcription', 'SubscriptionPackageController@AddSubcription');
        Route::post('/admin/AddSubcription', 'SubscriptionPackageController@AddSubcription');
        Route::post('/admin/showExtraDetailsAjaxHAndler', 'SubscriptionPackageController@showExtraDetailsAjaxHAndler');
        Route::post('/admin/deleteAjaxHandlersubscription', 'SubscriptionPackageController@deleteAjaxHandlersubscription');
        Route::get('/admin/EditAjaxHandlerSubscription', 'SubscriptionPackageController@EditAjaxHandlerSubscription');
        Route::post('/admin/EditAjaxHandlerSubscription', 'SubscriptionPackageController@EditAjaxHandlerSubscription');
        Route::post('/admin/UpdateAjaxHandelerSubscription', 'SubscriptionPackageController@UpdateAjaxHandelerSubscription');

        Route::get('/admin/GetAddSubscriptionPackages', 'SubscriptionPackageController@GetAddSubscriptionPackages');
        Route::post('/admin/GetAddSubscriptionPackages', 'SubscriptionPackageController@GetAddSubscriptionPackages');



        /**
         * @Desc route for AutolikeProfileController
         * @since 20/july/ 2018
         * @author Monali Samal (monalisamal@globussoft.in)
         */
        Route::get('/admin/ProfileDatatTable', 'AutolikeProfileController@ProfileDatatTable');
        Route::post('/admin/ProfileDatatTable', 'AutolikeProfileController@ProfileDatatTable');
        Route::post('/admin/AutolikesAjaxHandeler', 'AutolikeProfileController@AutolikesAjaxHandeler');
        Route::post('/admin/ShowDetailsAjaxHandlerAutolike', 'AutolikeProfileController@ShowDetailsAjaxHandlerAutolike');
        Route::post('/admin/ViewAllAutoLikesProfile', 'AutolikeProfileController@ViewAllAutoLikesProfile');
        Route::get('/admin/EditAjaxHandlerAutolike', 'AutolikeProfileController@EditAjaxHandlerAutolike');
        Route::post('/admin/EditAjaxHandlerAutolike', 'AutolikeProfileController@EditAjaxHandlerAutolike');
        Route::post('/admin/UpdateAjaxHandelerAutolikes', 'AutolikeProfileController@UpdateAjaxHandelerAutolikes');
        Route::post('/admin/deleteAjaxHandlerAutolikes', 'AutolikeProfileController@deleteAjaxHandler');


        /**
         * @Desc route for PaymentHistoryController
         * @since 20/july/ 2018
         * @author Monali Samal (monalisamal@globussoft.in)
         */
        Route::get('/admin/PaymentDatable', 'PaymentHistoryController@PaymentDatable');
        Route::post('/admin/PaymentDatable', 'PaymentHistoryController@PaymentDatable');
        Route::post('/admin/PaymentAjaxHandler', 'PaymentHistoryController@PaymentAjaxHandler');
        Route::post('/admin/PaymentExtraDetailsAjaxHAndler', 'PaymentHistoryController@PaymentExtraDetailsAjaxHAndler');
        Route::post('/admin/deleteAjaxHandlerPayment', 'PaymentHistoryController@deleteAjaxHandlerPayment');








        /**
         * @Desc route for NicheController
         * @since 21/july/ 2018
         * @author Monali Samal (monalisamal@globussoft.in)
         */
        Route::get('/admin/NicheTable', 'NicheController@NicheTable');
        Route::post('/admin/NicheTable', 'NicheController@NicheTable');
        Route::post('/admin/NicheAjaxHandler', 'NicheController@NicheAjaxHandler');
        Route::post('/admin/buttonChangeAjax', 'NicheController@buttonChangeAjax');
        Route::get('/admin/EditAjaxHandlerNiche', 'NicheController@EditAjaxHandlerNiche');
        Route::post('/admin/EditAjaxHandlerNiche', 'NicheController@EditAjaxHandlerNiche');
        Route::post('/admin/UpdateAjaxHandelerNiche', 'NicheController@UpdateAjaxHandelerNiche');
        Route::post('/admin/deleteAjaxHandlerNiche', 'NicheController@deleteAjaxHandlerNiche');
        Route::post('/admin/switchActionAjax', 'NicheController@switchActionAjax');
        Route::get('/admin/AddNiche', 'NicheController@AddNiche');
        Route::post('/admin/AddNiche', 'NicheController@AddNiche');

        Route::get('/admin/addNichemodel', 'NicheController@addNichemodel');
        Route::post('/admin/addNichemodel', 'NicheController@addNichemodel');




        /* Routes for activity tracker */
        Route::get('/admin/activity-logs', 'UserController@activityLogs');
        Route::get('/admin/getActivityDetails', 'UserController@getActivityDetails');
        Route::get('/admin/activityLogsAjaxHandler', 'UserController@activityLogsAjaxHandler');

        Route::get('/admin/activity-LogsAutoig', 'UserController@activityLogsAutoig');
        Route::get('/admin/getActivityDetailsAutoig', 'UserController@getActivityDetailsAutoig');
        Route::get('/admin/activityLogsAjaxHandlerAutoig', 'UserController@activityLogsAjaxHandlerAutoig');

//activity logs for GIVR
        Route::get('/admin/activity-LogsGivr', 'UserController@activityLogsGivr');
        Route::get('/admin/getActivityDetailsGivr', 'UserController@getActivityDetailsGivr');
        Route::get('/admin/activityLogsAjaxHandlerGivr', 'UserController@activityLogsAjaxHandlerGivr');



        /**
         * @Desc route for InstagramController
         * @since 16/11/ 2018
         * @author Monali Samal (monalisamal@globussoft.in)
         */
        Route::get('/admin/InstgarmTable', 'InstagramController@InstgarmTable');
        Route::post('/admin/InstgarmTable', 'InstagramController@InstgarmTable');
        Route::post('/admin/InstagramAjaxHandeler', 'InstagramController@InstagramAjaxHandeler');
        Route::get('/admin/AddInstagram', 'InstagramController@AddInstagram');
        Route::post('/admin/AddInstagram', 'InstagramController@AddInstagram');
        Route::post('/admin/packageAjaxHandlerinstgram', 'InstagramController@packageAjaxHandlerinstgram');


        Route::get('/admin/NewAccount', 'InstagramController@NewAccount');
        Route::post('/admin/NewAccount', 'InstagramController@NewAccount');




        /**
         * @Desc route for TutorialsController
         * @since 16/11/ 2018
         * @author Monali Samal (monalisamal@globussoft.in)
         */
        Route::get('/admin/add-tutorials','TutorialsController@showTutorials');
        Route::get('/admin/getDetailsAJAXHandler','TutorialsController@getDetails');
        Route::get('/admin/getTutorialUrlAJAXHandler','TutorialsController@getTutorialUrl');
        Route::get('/admin/updateURLAJAXHandler','TutorialsController@updateURL');
        Route::post('/admin/deleteVideoAJAXHandler','TutorialsController@deleteVideo');



    });
    Route::post('/admin/test', 'NicheController@test');
});




