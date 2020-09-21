<?php

namespace App\Modules\Admin\Controllers;

use App\Modules\Admin\Models\Admin;
use function FastRoute\TestFixtures\all_options_cached;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use users;
use DataTables;

class AdminController extends Controller
{
    /**
     * @Desc registration
     * @since 29/jan/ 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function registration(Request $request)
    {
        if (Session::has('admin')) {
            return back()->with('status', "You need to Logout first");
        }
        if ($request->isMethod('post')) {
            global $dbInfo;
            global $dbData;
            global $dbstorage;
            global $dbDevice;
            //  global $dbAction;
            $rules = [
                'firstname' => 'required|max:15|min:3|',
                'lastname' => 'required|max:15|min:3|',
                'username' => 'required|min:4|unique:users|regex:/^[A-Za-z\s]+$/',
                'email' => 'required|email',
                'password' => 'required',
                'status' => 'required',
                'device_id' => 'required',
                'user_free_package' => 'required',
                'rated_app' => 'required',
                'device_type' => 'required',

            ];

            $message = [
                'firstname.required' => 'enter your firstname',
                'lastname.required' => 'enter your lastname',
                'username.required' => 'enter your username',
                'email.required' => 'enter Your  email',
                'password.required' => 'enter Your password',
                'device_id.required' => 'enter Your device_id',
                'user_free_package.required' => 'enter Your user_free_package',
                'rated_app.required' => 'enter Your rated_app',
                'registered_through.required' => 'enter Your registered_through',
                'device_type.required' => 'enter Your device_type',
            ];

            $validator = validator::make($request->input(), $rules, $message);
            if ($validator->fails()) {
                return back()->WithErrors($validator)->WithInput();
            } else {
                $info = $request->input('status');
                if ($info === "pending") {
                    $dbInfo = "0";
                } elseif ($info === "active") {
                    $dbInfo = "1";
                } elseif ($info === "inactive") {
                    $dbInfo = "2 ";
                } elseif ($info === "rejected") {
                    $dbInfo = "3";
                } elseif ($info == "deleted") {
                    $dbInfo = "4";
                }
                $data = $request->input('rated_app');
                if ($data === "not rated") {
                    $dbData = "0";
                } elseif ($data === "rated app") {
                    $dbData = "1";
                } elseif ($data === "rated and got free package") {
                    $dbData = "2";
                }
                $insert = $request->input('registered_through');
                if ($insert === "Get Instant Likes English") {
                    $dbstorage = "1";
                } elseif ($insert === "Get Instant Likes Russian") {
                    $dbstorage = "2";
                } elseif ($insert === "Get Instant Views English") {
                    $dbstorage = "3";
                } elseif ($insert === "Get Instant Views Russian") {
                    $dbInsert = "4";
                } elseif ($insert == "AutoIG App with subscriptions + manual orders") {
                    $dbstorage = "5";
                }

                $device = $request->input('device_type');
                if ($device === "web(admin)") {
                    $dbDevice = "0";
                } elseif ($device === "android") {
                    $dbDevice = "1";

                } elseif ($device === "iOS") {
                    $dbDevice = "2";
                }
                $fillable = array();
                $fillable['firstname'] = $request->input('firstname');
                $fillable['lastname'] = $request->input('lastname');
                $fillable['email'] = $request->input('email');
                $fillable['username'] = $request->input('username');
                $fillable['password'] = Hash::make($request->input('password'));
                $fillable['role'] = "0";
//                $fillable['role'] = "admin";
                $fillable['status'] = $dbInfo;
                $fillable['device_id'] = $request->input('device_id');
                $fillable['user_free_package'] = $request->input('user_free_package');
                $fillable['rated_app'] = $dbData;
                $fillable['registered_through'] = $dbstorage;
                $fillable['device_type'] = $dbDevice;
                $fillable['activation_otp'] = str_random(6);


                $objectmodeluser = new Admin();
                $result = $objectmodeluser->registerdata($fillable);
                $activation_otp = str_random(6);
                $email_id = "yogeshglobussoft@gmail.com";
                $message = ($request->message);
                $from = new \SendGrid\Email(null, "useradmin_project@support.in");
                $subject = " SendGrid PHP Library!";
                $to = new \SendGrid\Email(null, $email_id);
                $content = new \SendGrid\Content("text/plain", "<!DOCTYPE html>
<html lang=\"en-US\">
<head>
    <meta charset=\"utf-8\">
</head>
<body>

<h2>Verify Your Email Address</h2>
<h2>this is the mail</h2>


<div>
    Thanks for creating an account with the verification demo app.
<a href=" . "http://gaia.globusdemos.com/admin/activation/" . $activation_otp . ">Link</a>

</div>

</body>
</html>");
                $mail = new \SendGrid\Mail($from, $subject, $to, $content);
                $apiKey = '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';
                $sg = new \SendGrid($apiKey);
                $response = $sg->client->mail()->send()->post($mail);
                echo "mail send succesfully !";

                if ($request) {
                    return redirect('/admin/login')->with('status', 'Registration sucessfully');
                } else {
                    return back('/admin/register');
                }
            }
        }
        return view('Admin::admin/register');
    }


    /**
     * @Desc adminLogin Functionality
     * @param Request $request
     * @since 29 jan  2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function adminLogin(Request $request)
    {


        if (Session::has('admin')) {
            return back()->with('status', "You need to Logout first");
        }
        if ($request->isMethod('post')) {
            $rules = [
                'email' => 'required|email',
                'password' => 'required|min:6',
            ];
            $message = [
                'email.required' => 'Enter a correct email',
                'password.required' => 'Enter your correct password',

            ];

            $validator = validator::make($request->input(), $rules, $message);
            if ($validator->fails()) {
                return back()->WithErrors($validator)->WithInput();
            } else {
                //$remember=$request->input('remember');// useed for remember me chaeck box
                $email = $request->input('email');
                $password = $request->input('password');
//                if (Auth::attempt(['email' => $email, 'password' => $password, 'role' => 'admin'])) {
                if (Auth::attempt(['email' => $email, 'password' => $password])) {

                    //  if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
//                    $objmodel = new Admin();
//                    $userdata = $objmodel->fetchid(Auth::id());


                    $userdata = json_decode(Auth::User(), true);
                    $sessionName = 'admin';
                    Session::put($sessionName, $userdata);
//
                    if (Auth::user()->role == '0') {

                        return redirect("/admin/dashboard")->with('status', 'welcome!');
                    } else {
                        return redirect("/admin/login")->with('status', 'You are not authorized');
                    }
                    //}
                } else {
                    return back()->with('error', 'Please Provide Valid Credentials..!!');
                }
            }
        }

        return view("Admin::admin.login");

    }


    /**
     * @Desc:AdminDashboard Functionality
     * @param Request $request
     * @since 29/jan 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */


    public function adminDashboard(Request $request)
    {
        if (Session()->has('admin')) {

            $objModelUser = new Admin();
            $whereCond = ['rawQuery' => 'role = ?', 'bindParams' => [1]];
            $selectCols = DB::raw(' sum(case when status = 2 then 1 else 0 end) as inactiveUsers,
            sum(case when status =1 then 1 else 0 end) as activeUsers,
            sum(case when status = 0 then 1 else 0 end) as pendingUsers,
            sum(case when role = 1 then 1 else 0 end) as totalUsers,
            sum(case when updated_at  >= unix_timestamp()-86400 then 1 else 0 end) as updated_at


            ');

            $usersCount = $objModelUser->getUserDetails($whereCond, $selectCols);
            $usersCount = json_decode(json_encode($usersCount), true);

            $objModelordes = new Admin();
            $whereAllOrder = array(
                'rawQuery' => '1'
            );
            $column = DB::raw(' sum(case when orders.status = 2 then 1 else 0 end) as processing,
            sum(case when orders.status =1 then 1 else 0 end) as queue,
            count(case when orders.status = 0 then 1 else 0 end) as pending,
            count(case when orders.status = 1 then 1 else 0 end) as totalOrders,
            sum(case when orders.status = 3 then 1 else 0 end) as completed,
            sum(case when orders.added_time  >= unix_timestamp()-86400 then 1 else 0 end) as added_time
            ');
            $OrdersCount = $objModelordes->getOrdersDetails($whereAllOrder, $column);
            $OrdersCount = json_decode(json_encode($OrdersCount), true);


            $objModelUser = new Admin();
            $whereAllTransction = ['rawQuery' => '1'];
            $selectCols = DB::raw('sum(case when payment_time >= unix_timestamp()-86400 then 1 else 0 end) as payment_time,
                             sum(amount) as amount');


            $transctionMoney = $objModelUser->getTransctionDetails($whereAllTransction, $selectCols);
            $transctionMoney = json_decode(json_encode($transctionMoney), true);


            $objectSubscription=new Admin();
            $whereAllSubscription=['rawQuery'=>'1'];
            $selectColoumn=DB::raw('sum(case when profile_status =1 then 1 else 0 end) as ActiveReq,count(case when recurring_profiles.profile_status = 1 then 1 else 0 end) as totalrecurring');

            $recurringMoney = $objectSubscription->getRecurringDetails($whereAllSubscription, $selectColoumn);
            $recurringMoney = json_decode(json_encode($recurringMoney), true);


            return view('Admin::admin.dashboard', ['usersCount' => $usersCount, 'OrdersCount' => $OrdersCount, 'transctionMoney' => $transctionMoney,'recurringMoney'=>$recurringMoney]);
        } else
            return back();
    }

    public function dashboardAjaxHandler(Request $request)
    {

        $registered_through = $request->input('registered_through');

        $objModelUser = new Admin();

        $whereCond = ['rawQuery' => 'role = ? and registered_through = ?', 'bindParams' => [1, $registered_through]];

        $selectCols = DB::raw(' sum(case when status = 2 then 1 else 0 end) as inactiveUsers,
            sum(case when status =1 then 1 else 0 end) as activeUsers,
            sum(case when status = 0 then 1 else 0 end) as pendingUsers,
            sum(case when role = 1 then 1 else 0 end) as totalUsers,
            sum(case when updated_at  >= unix_timestamp()-86400 then 1 else 0 end) as updated_at


            ');
        $usersCount = $objModelUser->getUserDetails($whereCond, $selectCols);
        $usersCount = json_decode(json_encode($usersCount), true);

        $whereAllOrder = ['rawQuery' => 'users.registered_through = ? ', 'bindParams' => [$registered_through]];
        $column = DB::raw(' sum(case when orders.status = 2 then 1 else 0 end) as processing,
            sum(case when orders.status =1 then 1 else 0 end) as queue,
            sum(case when orders.status = 0 then 1 else 0 end) as pending,
            count(case when orders.status = 1 then 1 else 0 end) as totalOrders,
            sum(case when orders.status = 3 then 1 else 0 end) as completed,
            sum(case when orders.added_time >= unix_timestamp()-86400 then 1 else 0 end) as added_time
            ');
        $OrdersCount = $objModelUser->getOrdersDetails($whereAllOrder, $column);
        $OrdersCount = json_decode(json_encode($OrdersCount), true);


        $whereAllTransction = ['rawQuery' => 'users.registered_through=?', 'bindParams' => [$registered_through]];
        $selectCols = DB::raw('sum(case when payment_time >= unix_timestamp()-86400 then 1 else 0 end) as payment_time,
                             sum( amount ) as amount');

        $transctionMoney = $objModelUser->getTransctionDetails($whereAllTransction, $selectCols);
        $transctionMoney = json_decode(json_encode($transctionMoney), true);
//        dd('hello 2', $transctionMoney);


        $objectSubscription=new Admin();
        $whereAllSubscription=['rawQuery'=>'1'];
        $selectColoumn=DB::raw('sum(case when profile_status =1 then 1 else 0 end) as ActiveReq,count(case when recurring_profiles.profile_status = 1 then 1 else 0 end) as totalrecurring');




        $recurringMoney = $objectSubscription->getRecurringDetails($whereAllSubscription, $selectColoumn);
        $recurringMoney = json_decode(json_encode($recurringMoney), true);



        echo json_encode(['status' => 200, 'message' => 'details found', 'data' => $usersCount, 'order' => $OrdersCount, 'payment' => $transctionMoney,'sub'=>$recurringMoney]);

    }


    /**
     **@Desc:AdminLogout Functionality
     * @since   29/jan/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function adminLogout()
    {
        Session::flush();
//        Session::f
        return redirect('/admin/login');
    }


    /**
     * @Desc forgotPassword
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @since 29/jan   2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function forgotPassword(Request $request)
    {
//        $validator = Validator::make($request->all(), [
//            'email' => 'required|email'
//        ]);

//
//        request()->validate([
//            'email' => 'required|email',
//
//            'password' => 'required',
//        ],
//            ['email.email'=>'Invalid email code.']);

//        if ($request->isMethod('post')) {

        $email = $request->input('email');

        $fillable = array();
        $fillable['token'] = str_random(30);
        $admin = new Admin();
        $pd_reset_token = str_random(30);
        $email_id = "yogeshglobussoft@gmail.com";

        $message = ($request->message);
        $from = new \SendGrid\Email(null, "useradmin_project@support.in");
        $subject = " Forgot Password!";
        $to = new \SendGrid\Email(null, $email_id);
        $content = new \SendGrid\Content("text/html", "<!DOCTYPE html>
<html lang=\"en-US\">
<head>
    <meta charset=\"utf-8\">
</head>
<body>
<h2>Verify Your Email Address</h2>
<h2>this is the mail</h2>
<div>
    Thanks for creating an account with the verification demo app.
    <a href=" . "http://gaia.globusdemos.com/admin/resetpassword/" . $pd_reset_token . ">Link</a>

</div>
</body>
</html>");

        $mail = new \SendGrid\Mail($from, $subject, $to, $content);
        $apiKey = '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';
        $sg = new \SendGrid($apiKey);
        $response = $sg->client->mail()->send()->post($mail);
//        dd($response);

        $result = DB::table('users')->where('role', 0)->update(['pd_reset_token' => $pd_reset_token]);


//        }
//        return redirect('/admin/login');

        return redirect('/admin/login')->with(['status' => "Please check your mail for Reset Password link"]);

    }

    /**
     * @param $pd_reset_token
     * @since 15 jan 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function resetPassword(Request $request, $pd_reset_token)
    {
        if ($request->isMethod('post')) {

            $change = array();
            $change['password'] = $request->input('password');
            $change['confirmpassword'] = Hash::make($request->input('confirmpassword'));

            $admin = new Admin();

            $result = DB::table('users')->where('pd_reset_token', $pd_reset_token)->update(['password' => $change['confirmpassword'], 'pd_reset_token' => ""]);

            return redirect('/admin/login');
            if ($result) {

                return view('Admin::admin/login')->with('status', 'password sucessfuly changed');
            }
        }
        return view('Admin::admin/resetpassword');
    }

    /**
     * @Desc
     * @param Request $request
     * @since  28 jan 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */


    public function myProfile(Request $request)
    {
        return view('Admin::admin/myProfile', ['data' => Session::get('admin')]);
    }

    /**
     * @Desc Delete data
     * @since  2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function deleteuser()
    {
        $users = DB::select('select * from packages');
    }

    public function destroydata($package_id)
    {
        DB::delete('delete from packages where package_id = ?', [$package_id]);

        return redirect('/admin/datatable');
    }

    /**
     * @Desc changePassword user
     * @Class changePassword
     * @param Request $request
     * @since 29jan 2018
     * @author Monalisamal (monalisamal@globussoft.in)
     */

    public function changePassword(Request $request)
    {
        if ($request->isMethod('post')) {
            $rules = [
                'password' => 'required|min:6',
                'newpassword' => 'required|min:6',
                'confirmpassword' => 'required|min:6',
            ];
            $message = [
                'password.required' => 'enter current password',
                'newpassword.required' => 'enter new password',
                'confirmpassword.required' => 'enter Conform New Password is same as New Password',

            ];

            $validator = validator::make($request->input(), $rules, $message);
            if ($validator->fails()) {
                return back()->WithErrors($validator)->WithInput();
            }
            $oldpassword = $request->input('password');
            $newpassword = $request->input('newpassword');
            $confirmpassword = $request->input('confirmpassword');
            $result = DB::table('users')->where('id', Auth::id())->first();
            $changepassword = $result->password;

            if (Hash::check($oldpassword, $changepassword)) {
                if ($newpassword != $confirmpassword) {
                    return json_encode(['status' => 'Password Changed Successfully']);
                }
                $change = array();
                $change['password'] = Hash::make($request->input('confirmpassword'));
                $objectmodeluser = new Admin();
                $result = $objectmodeluser->userPasswordChange($change);
                if ($result) {
                    return back()->with('status', 'Password Changed Successfully');
//                    return json_encode(['status' => 'Password Changed Successfully']);

                    return json_encode(['status' => 200]);
                }


            }
            return back()->with('error', 'Old password must be same with current password');

        }
//        return json_encode(['status' => 400]);
        return view('Admin::admin/changePassword');

    }


    /**
     * @Desc lock
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since 19 feb  2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function lock(Request $request)
    {
        return view('Admin::admin/lock');

    }


    /**
     * @Desc editAccount
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since 19 feb  2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function editAccount(Request $request, $id)
    {

        if ($request->isMethod('post')) {
            $rules = [
                'email' => 'required|email',
                'firstname' => 'required',
                'lastname' => 'required',
            ];
            $message = [
                'email.required' => 'enter a correct email',
                'firstname.required' => 'enter your first name',
                'lastname.required' => 'enter your last name',

            ];

            $validator = validator::make($request->input(), $rules, $message);
            if ($validator->fails()) {
                
                return back()->WithErrors($validator)->WithInput();
            } else

            $firstname = $request->all()['firstname'];
            $lastname = $request->all()['lastname'];
            $email = $request->all()['email'];
            $username = $request->all()['username'];
            $result = DB::table('users')->whereId($id)->update(['firstname' => $firstname, 'lastname' => $lastname, 'email' => $email, 'username' => $username]);
//            $ergfeg = DB::table('users')->whereId($id)->first();
            if ($result) {
                Session::put('admin.username',$username);
                return back()->with('status', ' Profile Updated successfully');
            }
        }
        $result = DB::table('users')->whereId($id)->first();
        return view('Admin::admin/edit', ['result' => $result]);


    }


}



