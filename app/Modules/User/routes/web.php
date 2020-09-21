<?php

Route::group(['module' => 'User', 'middleware' => ['web'], 'namespace' => 'App\Modules\User\Controllers'], function () {

    Route::get('/checkout/{checkoutToken}', 'PaymentController@checkout');
    Route::post('/checkout/{checkoutToken}', 'PaymentController@checkout');

    Route::get('/autolikes-checkout/success/{token}', 'PaymentController@success');
    Route::get('/autolikes-checkout/error/{token}', 'PaymentController@error');

    Route::get('/addoncheckout/{checkoutToken}', 'PaymentController@addoncheckout');
    Route::post('/addoncheckout/{checkoutToken}', 'PaymentController@addoncheckout');


    Route::get('/gilr/checkout/{checkoutToken}', 'PaymentController@gilrCheckout');    ////order fir gilr
    Route::post('/gilr/checkout/{checkoutToken}', 'PaymentController@gilrCheckout');

    Route::get('/give/checkout/{checkoutToken}', 'PaymentController@gilrCheckout');   //order fir give
    Route::post('/give/checkout/{checkoutToken}', 'PaymentController@gilrCheckout');

    Route::get('/givr/checkout/{checkoutToken}', 'PaymentController@givrCheckout');   //order for give
    Route::post('/givr/checkout/{checkoutToken}', 'PaymentController@givrCheckout');

    Route::get('/gilr/free-package-order/{checkoutToken}', 'PaymentController@addFreepackageOrder');// for give and gilr
    Route::get('/givr/free-package-order/{checkoutToken}', 'PaymentController@addFreepackageOrderGIVR'); // only for givr

    Route::get('/gilr/paymentSuccess', function () {
        return view('User::Payment.gilr_success');
    });
    Route::get('/paymentSuccess', function () {
        return view('User::Payment.success');
    });

    Route::get('/paymentErr', function () {
        return view('User::Payment.error');
    });

    Route::get('/imgUploading', 'PaymentController@imgUploading');
    Route::post('/imgUploading', 'PaymentController@imgUploading');

    Route::get('/searchList', function () {
        return view('User::demo.searchlist');
    });

});
