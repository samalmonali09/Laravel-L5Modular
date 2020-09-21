<?php namespace App\Modules\User\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Admin\Models\Package;
use App\Modules\User\Models\Order;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Modules\User\Models\Transaction;


class PaymentController extends Controller
{

    public function checkout(Request $request, $checkoutToken)
    {
        if ($request->isMethod('post')) {
            //Hitting api for storing transaction details and adding orders.
            $url = env('API_URL') . '/autoig/placeOrder';
            $transactionData = $request->all();
            $transactionData['checkout_token'] = $checkoutToken;

            $curlResponse = curlUsingPost($url, $transactionData);
            if ($curlResponse->code == 200) {
                $orderDetails = [
                    'orderId' => $curlResponse->data,
                    'itemName' => $transactionData['item_name'],
                    'txnId' => $transactionData['txn_id'],
                    'amount' => $transactionData['mc_gross']
                ];
                return redirect('/paymentSuccess')->with(['data' => $orderDetails]);
            } else {
                return redirect('/paymentErr')->with(['status' => 400, 'message' => 'Some error occurred in placing orders or query execution. 
                Don\'t worry, its not you, its us. Please contact us for refund, if your transaction is already made']);
            }


        } else {

            if (isset($request->all()['quaderno_error_message'])) {
                return redirect('/paymentErr')->with(['status' => 400, 'message' => 'checkout_token issue: ' . $request->all()['quaderno_error_message']]);
            }

            try {

                $decoded = JWT::decode($checkoutToken, env('JWT_KEY'), array('HS256'));
                $decoded = json_decode(json_encode($decoded), true);

            } catch (\Exception $e) {
                return redirect('/paymentErr')->with(['status' => 400, 'message' => 'checkout_token issue: ' . $e->getMessage()]);
            }
            $paypalToken = $decoded;
//            $decoded = array_merge($decoded,$item_number);

            unset($paypalToken['package_details']);
            unset($paypalToken['item_number']);
            $paypalToken = JWT::encode($paypalToken, env('JWT_KEY'));

            return view('User::Payment.checkout', ['encoded' => $paypalToken, 'decoded' => $decoded, 'checkout_token' => $checkoutToken]);
        }
    }

    public function autolikesCheckout(Request $request, $checkoutToken)
    {
        if ($request->isMethod('post')) {

            //Hitting api for storing transaction details and adding orders.
            $url = env('API_URL') . '/autoig/placeOrder';
            $transactionData = $request->all();
            $transactionData['checkout_token'] = $checkoutToken;

            $curlResponse = curlUsingPost($url, $transactionData);

            if ($curlResponse->code == 200) {
                $orderDetails = [
                    'orderId' => $curlResponse->data,
                    'itemName' => $transactionData['item_name'],
                    'txnId' => $transactionData['txn_id'],
                    'amount' => $transactionData['mc_gross']
                ];
                return redirect('/paymentSuccess')->with(['data' => $orderDetails]);
            } else {
                return redirect('/paymentErr')->with(['status' => 400, 'message' => 'Some error occurred in placing orders or query execution. 
                Don\'t worry, its not you, its us. Please contact us for refund, if transaction is already made']);
            }

        } else {
            if (isset($request->all()['quaderno_error_message'])) {
                return redirect('/paymentErr')->with(['status' => 400, 'message' => 'checkout_token issue: ' . $request->all()['quaderno_error_message']]);
            }

//            try {
//                $decoded = JWT::decode($checkoutToken, env('JWT_KEY'), array('HS256'));
//                $decoded = json_decode(json_encode($decoded), true);
//
//            } catch (\Exception $e) {
//                return redirect('/paymentErr')->with(['status' => 400, 'message' => 'checkout_token issue: ' . $e->getMessage()]);
//            }
//            $paypalToken = $decoded;
//            $decoded = array_merge($decoded,$item_number);

//            unset($paypalToken['package_details']);
//            unset($paypalToken['item_number']);

            $paypalToken = [
                "iat" => time(),
                "amount" => 700,
                "description" => "saurabh is testing quaderno Instagram_username: saurabh_bond speed_frequency: as fast as possible... Dont worry we will get the other custom information also",
                "subscription_unit" => 'D',
                "subscription_duration" => 1
            ];

            $paypalToken = JWT::encode($paypalToken, env('JWT_KEY_SANDBOX'));

            return view('User::Payment.autolikescheckout', ['encoded' => $paypalToken, 'checkout_token' => $checkoutToken]);
        }

    }

    public function addoncheckout(Request $request, $checkoutToken)
    {
        if ($request->isMethod('post')) {

            //Hitting api for storing transaction details and adding orders.
            $url = env('API_URL') . '/autoig/storeAddOnServiceOrder';
            $transactionData = $request->all();
            $transactionData['checkout_token'] = $checkoutToken;
//            dd($transactionData);

            $curlResponse = curlUsingPost($url, $transactionData);
//            dd($curlResponse);

            if ($curlResponse->code == 200) {
                $orderDetails = [
//                    'orderId' => $curlResponse->data,
                    'itemName' => $transactionData['item_name'],
                    'txnId' => $transactionData['txn_id'],
                    'amount' => $transactionData['mc_gross']
                ];
                return redirect('/paymentSuccess')->with(['addon_data' => $orderDetails]);
            } else {
                return redirect('/paymentErr')->with(['status' => 400, 'message' => 'Some error occurred in placing orders or query execution. 
                Don\'t worry, its not you, its us. Please contact us for refund, if transaction is already made']);
            }

        } else {
            if (isset($request->all()['quaderno_error_message'])) {
                return redirect('/paymentErr')->with(['status' => 400, 'message' => 'checkout_token issue: ' . $request->all()['quaderno_error_message']]);
            }

            try {
                $decoded = JWT::decode($checkoutToken, env('JWT_KEY_SANDBOX'), array('HS256'));
                $decoded = json_decode(json_encode($decoded), true);

            } catch (\Exception $e) {
                return redirect('/paymentErr')->with(['status' => 400, 'message' => 'checkout_token issue: ' . $e->getMessage()]);
            }
            $paypalToken = $decoded;
            unset($paypalToken['item_number']);
            $paypalToken = JWT::encode($paypalToken, env('JWT_KEY_SANDBOX'));

//            dd($decoded);

            return view('User::Payment.addoninvoice', ['encoded' => $paypalToken, 'decoded' => $decoded, 'checkout_token' => $checkoutToken]);
        }
    }

    public function success(Request $request, $checkoutToken)
    {

//        dd($request->all());
        $url = env('API_URL') . '/autoig/confirmPayment';
        $transactionData['token'] = $request->all()['token'];
        $transactionData['checkout_token'] = $checkoutToken;
//        dd($transactionData);

        $curlResponse = curlUsingPost($url, $transactionData);
//        dd($curlResponse);

        if ($curlResponse->code == 200) {
            $checkoutDetails = JWT::decode($checkoutToken, env('JWT_KEY_SANDBOX'), array('HS256'));
            $checkoutDetails = json_decode(json_encode($checkoutDetails), true);
            $orderDetails = [
                'profile_id' => $curlResponse->data['profile_id'],
                'profile_image' => $checkoutDetails['profile_image'],
                'description' => $checkoutDetails['description'],
                'paypal_profile_id' => $curlResponse->data['paypal_profile_id'],
                'price' => $checkoutDetails['price'],
                'billing_cycle' => $checkoutDetails['billing_cycle']
            ];
            return redirect('/paymentSuccess')->with(['subscription_data' => $orderDetails]);
        } else {
            return redirect('/paymentErr')->with(['status' => 400, 'message' => 'Please contact us for refund, if the transaction is already made. ERROR:' . $curlResponse->message]);
        }
        //Some error occurred in placing orders or query execution.  Don't worry, its not you, its us.

//        dd("error", $request->all()['token'], $checkoutToken);

    }

    public function error(Request $request, $checkoutToken)
    {
        return redirect('/paymentErr')->with(['status' => 400, 'message' => 'Please contact us for refund, if the transaction is already made. ERROR:']);

    }

    public function paymentSuccess(Request $request)
    {

        if ($request->isMethod('post')) {
            dd($request->all());
        }
        dd("success", $request->all());

    }

    public function imgUploading(Request $request)
    {

        if ($request->isMethod('post')) {

            dd($request->all());

        } else {

            return view('User::demo.base64imguploading');
        }
    }

    public function test()
    {
        return view('User::demo.listview');
    }

//************checkout for gilr  and give**************
    public function gilrCheckout(Request $request, $checkoutToken)
    {
        if ($request->isMethod('post')) {

            if (Session::has('purchaseDetails')) {
                $data = Session::get('purchaseDetails');
                $key = env('JWT_KEY');               // create access TOKEN
                $data1 = JWT::decode($checkoutToken, $key, array('HS256'));
                $transaction = $request->all();
                $transactionDetails = [];
                $transactionDetails['tx_type'] = 0;
                $transactionDetails['tx_mode'] = 0;
                $transactionDetails['transaction_id'] = $transaction['txn_id'];
                $transactionDetails['user_id'] = $data['users_id'];
                if (isset($data['media_image_url']) && !empty($data['media_image_url'])) {

                    if (isset($data['link']) && !empty($data['link'])) {
                        $transactionDetails['order_url'] = $data['link'];
                    } elseif (isset($data['media_url']) && !empty($data['media_url'])) {
                        $transactionDetails['order_url'] = $data['media_url'];
                    } elseif ($data['username'] && $data['package_type'] == 1 or $data['package_type'] == 5 or $data['package_type'] == 6) {   //for followers,story and live views

                        $transactionDetails['order_url'] = 'https://www.instagram.com/' . $data['username'];
                    }

                } else {
                    $transactionDetails['order_url'] = 'https://www.instagram.com/' . $data['username'];
                }
                $transactionDetails['amount'] = $transaction['payment_gross'];
                $transactionDetails['payer_email'] = $transaction['payer_email'];
                $transactionDetails['payment_status'] = $transaction['payment_status'];
                $transactionDetails['payment_type'] = $transaction['payment_type'];
                $transactionDetails['device_id'] = 2;
                $transactionDetails['payment_time'] = time();
                $transactionDetails['package_id'] = $data['package_id'];
                $objmodeluser = Transaction::getInstance();
                $user_transaction_details = $objmodeluser->insertTransaction($transactionDetails);
                if ($user_transaction_details) {
                    $orderData = $request->all();
                    $orderDetails = [];
                    $orderDetails['user_id'] = $data['users_id'];
                    $orderDetails['tx_id'] = $user_transaction_details;
                    $orderDetails['package_id'] = $data['package_id'];
                    $orderDetails['package_type'] = $data['package_type'];
                    if ($data['package_type'] == 1 or $data['package_type'] == 5 or $data['package_type'] == 6) {
                        $orderDetails['order_url'] = 'https://www.instagram.com/' . $data['username'];
                        $orderDetails['url_type'] = 0;


                    } else {
                        if (isset($data['media_image_url']) && !empty($data['media_image_url'])) {

                            if (isset($data['link']) && !empty($data['link'])) {
                                $orderDetails['order_url'] = $data['link'];
                                $orderDetails['url_type'] = 1;
                            } else {
                                $orderDetails['url_type'] = 1;
                                if (isset($data['media_url']) && !empty($data['media_url']) && $data['package_type'] != 1 or $data['package_type'] != 5 or $data['package_type'] != 6) {

                                    $orderDetails['order_url'] = $data['media_url'];
                                } else
                                    $orderDetails['order_url'] = 'https://www.instagram.com/' . $data['username'];

                            }
                        }
                    }
//                    $orderDetails['url_type'] = 1;
//                    if (isset($data['likes_count']) && !empty($data['likes_count'])) {
//
//                        $orderDetails['start_count'] = $data['likes_count'];
//                    }
                    if ($data['package_type'] == 0) {
                        $orderDetails['start_count'] = $data['likes_count'];
                    }
                    if ($data['package_type'] == 3) {
                        $orderDetails['start_count'] = $data['comments_count'];
                    }
                    if ($data['package_type'] == 1) {
                        $orderDetails['start_count'] = $data['followed_by'];
                    }
                    if ($data['package_type'] == 4) {
                        $orderDetails['start_count'] = $data['video_view_count'];
                    }
                    $orderDetails['end_count'] = 0;
                    $orderDetails['quantity'] = $data['quantity'];
                    $orderDetails['amount'] = $transaction['payment_gross'];
                    if (isset($data['comments']) && !empty($data['comments'])) {    // checking if comments package

                        $data_comments = str_replace("','", '","', $data['comments']);
                        $data_comments = str_replace("['", '["', $data_comments);
                        $data_comments = str_replace("']", '"]', $data_comments);
                        $comments = [];
                        $comments['comments'] = $data_comments;
                        $comments['comment_group_id'] = 0;
                        $comments['user_id'] = $data['users_id'];
                        $comments['added_at'] = time();

                        $objmodeluser = Transaction::getInstance();
                        $insertComments = $objmodeluser->insertComments($comments);
                        $orderDetails['comment_id'] = $insertComments;
                    }
                    $orderDetails['start_time'] = time();
                    $orderDetails['added_time'] = time();
                    $orderDetails['updated_time'] = time();
                    $orderDetails['status'] = 0;
                    $orderDetails['plan_id'] = $data['plan_id'];
                    $objmodeluser = Order::getInstance();
                    $user_order_history = $objmodeluser->insertOrder($orderDetails);
                    if ($user_order_history) {
                        return redirect('/gilr/paymentSuccess')->with(['data' => $data, 'user_transaction_details' => $user_transaction_details]);

                    }
                } else {
                    dd('something went wrong at transaction');

                }
            } else {
                dd('something went wrong at checkout');
            }
        }
        try {

            $key = env('JWT_KEY');
            $data = JWT::decode($checkoutToken, env('JWT_KEY'), array('HS256'));     // sending user details as a TOKEN
            $data = json_decode(json_encode($data), true);
            Session::put('purchaseDetails', $data);
            if ($data['package_for'] == 5) {
                $package_for = 'App AutoIg';
            } elseif ($data['package_for'] == 1) {
                $package_for = 'App GIL - EN';
            } elseif ($data['package_for'] == 2) {
                $package_for = 'App GIL - RU';
            } elseif ($data['package_for'] == 3) {
                $package_for = 'App GIV - EN';
            } elseif ($data['package_for'] == 4) {
                $package_for = 'App GIV - RU';
            } elseif ($data['package_for'] == 6) {
                $package_for = 'App Insta Stats';
            }
            $desc_quantity = $data['quantity'];
            $findData = ['package_type'];
            $getPackage = Package::getInstance()->getPackagesDetails([    //get package id
                'rawQuery' => 'package_id = ? ',
                'bindParams' => [$data['package_id']]
            ], $findData);

            if ($getPackage[0]->package_type == 0) {
                $type = 'L';
            } elseif ($getPackage[0]->package_type == 1) {
                $type = 'F';
            } elseif ($getPackage[0]->package_type == 2 or $getPackage[0]->package_type == 3) {
                $type = 'C';
            } elseif ($getPackage[0]->package_type == 4 or $getPackage[0]->package_type == 5 or $getPackage[0]->package_type == 6) {
                $type = 'V';
            }


        } catch (\Exception $e) {
            dd($e->getMessage(), 'error');
            return redirect('/paymentErr')->with(['status' => 400, 'message' => 'checkout_token issue: ' . $e->getMessage()]);
        }
        if ($data['package_type'] == 0 or $data['package_type'] == 2 or $data['package_type'] == 3 or $data['package_type'] == 4) {
//            $url=$data['username'];
            $url = $data['media_url'];
        } else {
            $url = $data['username'];

        }
        $description = $package_for . ' ' . '-' . ' ' . $desc_quantity . $type . ' ' . 'points'.'-'.'url:'.$url;
        $paypalToken = $data;
        unset($paypalToken['package_details']);
        unset($paypalToken['item_number']);
        $key = env('JWT_KEY');
        $paypalToken = JWT::encode($paypalToken, $key);
        $iat = time();
        $token = array(
            "currency" => 'USD',
            "description" => $description,
            "item_number" => '1',
            "item_link" => $url,
            'subscription_unit' => 'M',
            'subscription_duration' => 1,
            "amount" => $data['price'] * 100,
            "iat" => $iat,
        );
        $encoded_jwt = JWT::encode($token, $key);
        if (isset($data['username']) && !empty($data['username'])) {

//            ini_set('memory_limit', '1024M');
//
//            $result = $this->curlUsingGet('https://instagram.com/' . $data['username']);
//            if ($result != '' || $result != null) {
//                $profileDetails = explode('window._sharedData = ', $result);
//                if (count($profileDetails) > 1) {
//                    $profileDetailsJson = explode(';</script>', $profileDetails[1]);
//                    $profileDetailsArr = json_decode($profileDetailsJson[0], TRUE);
//                    if (isset($profileDetailsArr['entry_data']['ProfilePage']) && !empty($profileDetailsArr['entry_data']['ProfilePage'])) {
//                        $result1 = $profileDetailsArr['entry_data']['ProfilePage'][0];
            $data2 = [];
            $data2['followed_by'] = $data['followers_count'];
            $data2['following'] = $data['following'];
            $data2['isPrivate'] = $data['isPrivate'];
            $data2['full_name'] = $data['full_name'];
            $data2['profile_image'] = $data['display_url'];
            $data2['media_image_url'] = $data['display_url'];
            $data = array_merge($data, $data2);

            Session::put('purchaseDetails', $data);
            return view('User::Payment.gilr_checkout', ['encoded' => $paypalToken, 'encoded_jwt' => $encoded_jwt, 'data' => $data, 'checkoutToken' => $checkoutToken]);

//                    } else
//                        apiResponse('401', 'User not found', 'null', 'null');
//
//
//                }
//                return null;
//            }
//
//            return view('User::Payment.gilr_checkout', ['encoded' => $paypalToken, 'encoded_jwt' => $encoded_jwt, 'data' => $data, 'checkoutToken' => $checkoutToken]);
//            die;

        }

        return view('User::Payment.gilr_checkout', ['encoded' => $paypalToken, 'encoded_jwt' => $encoded_jwt, 'data' => $data, 'checkoutToken' => $checkoutToken]);
    }

    public function givrCheckout(Request $request, $checkoutToken)
    {
        if ($request->isMethod('post')) {

            if (Session::has('purchaseDetails')) {
                $data = Session::get('purchaseDetails');
                $key = env('JWT_KEY');               // create access TOKEN
                $data1 = JWT::decode($checkoutToken, $key, array('HS256'));
                $transaction = $request->all();
                $transactionDetails = [];
                $transactionDetails['tx_type'] = 0;
                $transactionDetails['tx_mode'] = 0;
                $transactionDetails['transaction_id'] = $transaction['txn_id'];
                $transactionDetails['user_id'] = $data['users_id'];
                if (isset($data['media_image_url']) && !empty($data['media_image_url'])) {

                    if (isset($data['link']) && !empty($data['link'])) {
                        $transactionDetails['order_url'] = $data['link'];
                    } elseif (isset($data['media_url']) && !empty($data['media_url'])) {
                        $transactionDetails['order_url'] = $data['media_url'];
                    } elseif ($data['username'] && $data['package_type'] == 1 or $data['package_type'] == 5 or $data['package_type'] == 6) {   //for followers,story and live views

                        $transactionDetails['order_url'] = 'https://www.instagram.com/' . $data['username'];
                    }

                } else {
                    $transactionDetails['order_url'] = 'https://www.instagram.com/' . $data['username'];
                }
                $transactionDetails['amount'] = $transaction['payment_gross'];
                $transactionDetails['payer_email'] = $transaction['payer_email'];
                $transactionDetails['payment_status'] = $transaction['payment_status'];
                $transactionDetails['payment_type'] = $transaction['payment_type'];
                $transactionDetails['device_id'] = 2;
                $transactionDetails['payment_time'] = time();
                $transactionDetails['package_id'] = $data['package_id'];
                $objmodeluser = Transaction::getInstance();
                $user_transaction_details = $objmodeluser->insertTransaction($transactionDetails);
                if ($user_transaction_details) {
                    $orderData = $request->all();
                    $orderDetails = [];
                    $orderDetails['user_id'] = $data['users_id'];
                    $orderDetails['tx_id'] = $user_transaction_details;
                    $orderDetails['package_id'] = $data['package_id'];
                    $orderDetails['package_type'] = $data['package_type'];
                    if ($data['package_type'] == 1 or $data['package_type'] == 5 or $data['package_type'] == 6) {
                        $orderDetails['order_url'] = 'https://www.instagram.com/' . $data['username'];
                        $orderDetails['url_type'] = 0;


                    } else {
                        if (isset($data['media_image_url']) && !empty($data['media_image_url'])) {

                            if (isset($data['link']) && !empty($data['link'])) {
                                $orderDetails['order_url'] = $data['link'];
                                $orderDetails['url_type'] = 1;
                            } else {
                                $orderDetails['url_type'] = 1;
                                if (isset($data['media_url']) && !empty($data['media_url']) && $data['package_type'] != 1 or $data['package_type'] != 5 or $data['package_type'] != 6) {

                                    $orderDetails['order_url'] = $data['media_url'];
                                } else
                                    $orderDetails['order_url'] = 'https://www.instagram.com/' . $data['username'];

                            }
                        }
                    }
//                    $orderDetails['url_type'] = 1;
//                    if (isset($data['likes_count']) && !empty($data['likes_count'])) {
//
//                        $orderDetails['start_count'] = $data['likes_count'];
//                    }
                    if ($data['package_type'] == 0) {
                        $orderDetails['start_count'] = $data['likes_count'];
                    }
                    if ($data['package_type'] == 3) {
                        $orderDetails['start_count'] = $data['comments_count'];
                    }
                    if ($data['package_type'] == 1) {
                        $orderDetails['start_count'] = $data['followed_by'];
                    }
                    if ($data['package_type'] == 4) {
                        $orderDetails['start_count'] = $data['video_view_count'];
                    }
                    $orderDetails['end_count'] = 0;
                    $orderDetails['quantity'] = $data['quantity'];
                    $orderDetails['amount'] = $transaction['payment_gross'];
                    if (isset($data['comments']) && !empty($data['comments'])) {    // checking if comments package

                        $data_comments = str_replace("','", '","', $data['comments']);
                        $data_comments = str_replace("['", '["', $data_comments);
                        $data_comments = str_replace("']", '"]', $data_comments);
                        $comments = [];
                        $comments['comments'] = $data_comments;
                        $comments['comment_group_id'] = 0;
                        $comments['user_id'] = $data['users_id'];
                        $comments['added_at'] = time();

                        $objmodeluser = Transaction::getInstance();
                        $insertComments = $objmodeluser->insertComments($comments);
                        $orderDetails['comment_id'] = $insertComments;
                    }
                    $orderDetails['start_time'] = time();
                    $orderDetails['added_time'] = time();
                    $orderDetails['updated_time'] = time();
                    $orderDetails['status'] = 0;
                    $orderDetails['plan_id'] = $data['plan_id'];
                    $objmodeluser = Order::getInstance();
                    $user_order_history = $objmodeluser->insertOrder($orderDetails);
                    if ($user_order_history) {
                        return redirect('/gilr/paymentSuccess')->with(['data' => $data, 'user_transaction_details' => $user_transaction_details]);

                    }
                } else {
                    dd('something went wrong at transaction');

                }
            } else {
                dd('something went wrong at checkout');
            }
        }
        try {

            $key = env('JWT_KEY');
            $data = JWT::decode($checkoutToken, env('JWT_KEY'), array('HS256'));     // sending user details as a TOKEN
            $data = json_decode(json_encode($data), true);
            Session::put('purchaseDetails', $data);
            if ($data['package_for'] == 5) {
                $package_for = 'App AutoIg';
            } elseif ($data['package_for'] == 1) {
                $package_for = 'App GIL - EN';
            } elseif ($data['package_for'] == 2) {
                $package_for = 'App GIL - RU';
            } elseif ($data['package_for'] == 3) {
                $package_for = 'App GIV - EN';
            } elseif ($data['package_for'] == 4) {
                $package_for = 'App GIV - RU';
            } elseif ($data['package_for'] == 6) {
                $package_for = 'App Insta Stats';
            }
            $desc_quantity = $data['quantity'];
            $findData = ['package_type'];
            $getPackage = Package::getInstance()->getPackagesDetails([    //get package id
                'rawQuery' => 'package_id = ? ',
                'bindParams' => [$data['package_id']]
            ], $findData);

            if ($getPackage[0]->package_type == 0) {
                $type = 'L';
            } elseif ($getPackage[0]->package_type == 1) {
                $type = 'F';
            } elseif ($getPackage[0]->package_type == 2 or $getPackage[0]->package_type == 3) {
                $type = 'C';
            } elseif ($getPackage[0]->package_type == 4 or $getPackage[0]->package_type == 5 or $getPackage[0]->package_type == 6) {
                $type = 'V';
            }


        } catch (\Exception $e) {
            dd($e->getMessage(), 'error');
            return redirect('/paymentErr')->with(['status' => 400, 'message' => 'checkout_token issue: ' . $e->getMessage()]);
        }
        if ($data['package_type'] == 0 or $data['package_type'] == 2 or $data['package_type'] == 3 or $data['package_type'] == 4) {
//            $url=$data['username'];
            $url = $data['media_url'];
        } else {
            $url = $data['username'];

        }
        $description = $package_for . ' ' . '-' . ' ' . $desc_quantity . $type . ' ' . 'points'.'-'.'url:'.$url;
        $paypalToken = $data;
        unset($paypalToken['package_details']);
        unset($paypalToken['item_number']);
        $key = env('JWT_KEY');
        $paypalToken = JWT::encode($paypalToken, $key);
        $iat = time();
        $token = array(
            "currency" => 'USD',
            "description" => $description,
            "item_number" => '1',
            "item_link" => $url,
            'subscription_unit' => 'M',
            'subscription_duration' => 1,
            "amount" => $data['price'] * 100,
            "iat" => $iat,
        );
        $encoded_jwt = JWT::encode($token, $key);
        if (isset($data['username']) && !empty($data['username'])) {


            $data2 = [];
            $data2['followed_by'] = $data['followers_count'];
            $data2['following'] = $data['following'];
            $data2['isPrivate'] = $data['isPrivate'];
            $data2['full_name'] = $data['full_name'];
            $data2['profile_image'] = $data['display_url'];
            $data2['media_image_url'] = $data['display_url'];
            $data = array_merge($data, $data2);

            Session::put('purchaseDetails', $data);
            return view('User::Payment.givr_checkout', ['encoded' => $paypalToken, 'encoded_jwt' => $encoded_jwt, 'data' => $data, 'checkoutToken' => $checkoutToken]);

//                    } else
//                        apiResponse('401', 'User not found', 'null', 'null');
//
//
//                }
//                return null;
//            }
//
//            return view('User::Payment.gilr_checkout', ['encoded' => $paypalToken, 'encoded_jwt' => $encoded_jwt, 'data' => $data, 'checkoutToken' => $checkoutToken]);
//            die;

        }

        return view('User::Payment.givr_checkout', ['encoded' => $paypalToken, 'encoded_jwt' => $encoded_jwt, 'data' => $data, 'checkoutToken' => $checkoutToken]);
    }


    public function curlUsingGet($url, $headers = '')
    {

        ini_set('max_execution_time', 600);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if (!empty($headers))
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        $curl_scraped_page = curl_exec($ch);
//        if (isset($headers) && !empty($headers)){
//            dd($headers,$curl_scraped_page);
//        }
        if (curl_errno($ch) > 0) {
            print_r(curl_error($ch));
        }
        curl_close($ch);
        return $curl_scraped_page;
    }


//************only free package order for both GILR and GIVE************
    public function addFreepackageOrder(Request $request, $checkoutToken)
    {
        try {
            $key = env('JWT_KEY');
            $decoded = JWT::decode($checkoutToken, $key, array('HS256'));
            $findData = ['package_id', 'quantity', 'plan_id'];
            $getPackage = Package::getInstance()->getPackagesDetails([
                'rawQuery' => 'price = ? and package_type = ? and package_for=?',
                'bindParams' => [0, $decoded->package_type, $decoded->package_for]
            ], $findData);
            if (count($getPackage) > 0) {
//        $getPackage = Package::getInstance()->getPackagesDetails(['rawQuery' => 'price = ?', 'bindParams' => [0]], ['package_type' => $decoded->package_type]);
                $package_id = $getPackage[0]->package_id;
                $quantity = $getPackage[0]->quantity;
                $plan_id = $getPackage[0]->plan_id;
                $transactionDetails = [];
                $transactionDetails['tx_type'] = 0;
                $transactionDetails['tx_mode'] = 0;
                $transactionDetails['transaction_id'] = $decoded->transaction_id;
                $transactionDetails['user_id'] = $decoded->user_id;
                $transactionDetails['order_url'] = $decoded->media_url;
                $transactionDetails['amount'] = 0;
                $transactionDetails['payer_email'] = $decoded->email;
                $transactionDetails['payment_status'] = 'success';
                $transactionDetails['payment_type'] = 'instant';
                $transactionDetails['device_id'] = $decoded->register_through;
                $transactionDetails['device_id'] = $decoded->device_id;
                $transactionDetails['payment_time'] = time();
                $transactionDetails['package_id'] = $package_id;
                $transactionDetails['ip_address'] = $decoded->ip_address;
                $objmodeluser = \App\Modules\User\Models\Transaction::getInstance();
                $user_transaction_details = $objmodeluser->insertTransaction($transactionDetails);
                if (isset($user_transaction_details)) {

                    $orderDetails = [];
                    $orderDetails['user_id'] = $decoded->user_id;
                    $orderDetails['tx_id'] = $user_transaction_details;
                    $orderDetails['package_id'] = $package_id;
                    $orderDetails['package_type'] = $decoded->package_type;
                    $orderDetails['order_url'] = $decoded->media_url;
                    $orderDetails['url_type'] = 1;
                    $orderDetails['start_count'] = $decoded->likes_count;
                    $orderDetails['end_count'] = 0;
                    $orderDetails['quantity'] = $quantity;
                    $orderDetails['start_time'] = time();
                    $orderDetails['added_time'] = time();
                    $orderDetails['updated_time'] = time();
                    $orderDetails['status'] = 0;
                    $orderDetails['plan_id'] = $plan_id;

                    $objmodeluser = \App\Modules\User\Models\Order::getInstance();
                    $user_order_history = $objmodeluser->insertOrder($orderDetails);
                    if ($user_order_history) {
                        $objmodeluser = \App\Modules\User\Models\Transaction::getInstance();
                        if (isset($decoded->rated_app) && !empty($decoded->rated_app)) {
                            $user_order_history = $objmodeluser->updatefreepackageUser(['rawQuery' => 'id = ?', 'bindParams' => [$decoded->user_id]], ['rated_app' => 2]);
                        } else
//                        if ($decoded->user_free_package && !empty($decoded->user_free_package)) {
//                            $user_order_history = $objmodeluser->updatefreepackageUser(['rawQuery' => 'id = ?', 'bindParams' => [$decoded->user_id]], ['user_free_package' => 1]);
//                        }
                            $user_order_history = $objmodeluser->updatefreepackageUser(['rawQuery' => 'id = ?', 'bindParams' => [$decoded->user_id]], ['user_free_package' => 1]);

                        return redirect('/gilr/paymentSuccess')->with(['data' => $user_order_history, 'user_transaction_details' => $user_transaction_details]);

                    }
                }
            } else
                dd('package not found');

        } catch (QueryException $e) {

            dd($e);
        }
    }

    public function addFreepackageOrderGIVR(Request $request, $checkoutToken)
    {
        try {
            $key = env('JWT_KEY');
            $decoded = JWT::decode($checkoutToken, $key, array('HS256'));
            $findData = ['package_id', 'quantity', 'plan_id'];
            $getPackage = Package::getInstance()->getPackagesDetails([
                'rawQuery' => 'price = ? and package_type = ? and package_for=?',
                'bindParams' => [0, $decoded->package_type, $decoded->package_for]
            ], $findData);
            if (count($getPackage) > 0) {
//        $getPackage = Package::getInstance()->getPackagesDetails(['rawQuery' => 'price = ?', 'bindParams' => [0]], ['package_type' => $decoded->package_type]);
                $package_id = $getPackage[0]->package_id;
                $quantity = $getPackage[0]->quantity;
                $plan_id = $getPackage[0]->plan_id;
                $transactionDetails = [];
                $transactionDetails['tx_type'] = 0;
                $transactionDetails['tx_mode'] = 0;
                $transactionDetails['transaction_id'] = $decoded->transaction_id;
                $transactionDetails['user_id'] = $decoded->user_id;
                $transactionDetails['order_url'] = $decoded->media_url;
                $transactionDetails['amount'] = 0;
                $transactionDetails['payer_email'] = $decoded->email;
                $transactionDetails['payment_status'] = 'success';
                $transactionDetails['payment_type'] = 'instant';
                $transactionDetails['device_id'] = $decoded->register_through;
                $transactionDetails['device_id'] = $decoded->device_id;
                $transactionDetails['payment_time'] = time();
                $transactionDetails['package_id'] = $package_id;
                $transactionDetails['ip_address'] = $decoded->ip_address;
                $objmodeluser = \App\Modules\User\Models\Transaction::getInstance();
                $user_transaction_details = $objmodeluser->insertTransaction($transactionDetails);
                if (isset($user_transaction_details)) {

                    $orderDetails = [];
                    $orderDetails['user_id'] = $decoded->user_id;
                    $orderDetails['tx_id'] = $user_transaction_details;
                    $orderDetails['package_id'] = $package_id;
                    $orderDetails['package_type'] = $decoded->package_type;
                    $orderDetails['order_url'] = $decoded->media_url;
                    $orderDetails['url_type'] = 1;
                    $orderDetails['start_count'] = $decoded->likes_count;
                    $orderDetails['end_count'] = 0;
                    $orderDetails['quantity'] = $quantity;
                    $orderDetails['start_time'] = time();
                    $orderDetails['added_time'] = time();
                    $orderDetails['updated_time'] = time();
                    $orderDetails['status'] = 0;
                    $orderDetails['plan_id'] = $plan_id;

                    $objmodeluser = \App\Modules\User\Models\Order::getInstance();
                    $user_order_history = $objmodeluser->insertOrder($orderDetails);
                    if ($user_order_history) {
                        $objmodeluser = \App\Modules\User\Models\Transaction::getInstance();
                        if (isset($decoded->rated_app) && !empty($decoded->rated_app)) {
                            $user_order_history = $objmodeluser->updatefreepackageUser(['rawQuery' => 'id = ?', 'bindParams' => [$decoded->user_id]], ['rated_app' => 0, 'user_free_package' => 0]);
                        } else
//                        if ($decoded->user_free_package && !empty($decoded->user_free_package)) {
//                            $user_order_history = $objmodeluser->updatefreepackageUser(['rawQuery' => 'id = ?', 'bindParams' => [$decoded->user_id]], ['user_free_package' => 1]);
//                        }
                            $user_order_history = $objmodeluser->updatefreepackageUser(['rawQuery' => 'id = ?', 'bindParams' => [$decoded->user_id]], ['user_free_package' => 1]);

                        return redirect('/gilr/paymentSuccess')->with(['data' => $user_order_history, 'user_transaction_details' => $user_transaction_details]);

                    }
                }
            } else
                dd('package not found');

        } catch (QueryException $e) {

            dd($e);
        }
    }

}