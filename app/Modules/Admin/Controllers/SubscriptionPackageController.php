<?php


namespace App\Modules\Admin\Controllers;

use App\Modules\Admin\Models\Subscription;
use App\Modules\Admin\Models\Plan;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use users;
use DataTables;

class SubscriptionPackageController extends Controller
{


    /**
     * @Desc: SubscriptionDatatable
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since 10/7/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function SubscriptionDatatable(Request $request)
    {
        $data = DB::table('subscription_packages')->get();
        return view('Admin::Subscription/SubscriptionPackage', ['data' => $data]);
    }


    /**
     * @Desc: SubscriptionAjaxHandeler
     * @param Request $request
     * @since  10/7/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function SubscriptionAjaxHandeler(Request $request)
    {
        $requestParam = $request->all();
        $objUserModel = new Subscription();
        $whereCond = [
            'rawQuery' => '1',
        ];


        $iTotalRecords = count($objUserModel->getsubscriptionDetails($whereCond));
        $iTotalFilteredRecords = $iTotalRecords;
        $iDisplayLength = intval($requestParam['length']);
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        $iDisplayStart = intval($requestParam['start']);
        $sEcho = intval($requestParam['draw']);

        $records = array();
        $records["data"] = array();
        $columns = array(
            'subscription_packages.sub_package_id',
            'subscription_packages.sub_package_name',
            'subscription_packages.sub_package_type',
            'subscription_packages.quantity',
            'subscription_packages.status',
        );
        $sortingOrder = "";
//        if (isset($requestParam['order'])) {
//            $sortingOrder = [$columns[$requestParam['order'][0]['column'] - 1], $requestParam['order'][0]['dir']];
//        }

        if (isset($requestParam['order']) && $requestParam['order'][0]['column'] != 0) {
            $sortingOrder = [$columns[$requestParam['order'][0]['column'] - 1], $requestParam['order'][0]['dir']];
        }else{
            $sortingOrder = [$columns[$requestParam['order'][0]['column']], $requestParam['order'][0]['dir']];
        }


        // Filtering datatable code
        $filteringRules = [];
        if (isset($requestParam['action']) && $requestParam['action'] == 'filter' && $requestParam['action'][0] != 'filter_cancel') {
            if ($requestParam['search_sub_package_id'] != '') {
                $filteringRules[] = "(subscription_packages.sub_package_id LIKE '%" . $requestParam['search_sub_package_id'] . "%' )";
            }
            if ($requestParam['search_sub_package_name'] != '') {
                $filteringRules[] = "(subscription_packages.sub_package_name LIKE '%" . $requestParam['search_sub_package_name'] . "%' )";
            }
            if ($requestParam['search_sub_package_type'] != '') {
                $filteringRules[] = "(subscription_packages.sub_package_type LIKE '%" . $requestParam['search_sub_package_type'] . "%' )";
            }

            if ($requestParam['search_quantity'] != '') {
                $filteringRules[] = "(subscription_packages.quantity LIKE '%" . $requestParam['search_quantity'] . "%' )";
            }
            if ($requestParam['search_status'] != '') {
                $filteringRules[] = "(subscription_packages.status LIKE '%" . $requestParam['search_status'] . "%' )";
            }
            if (!empty($filteringRules)) {
                $whereCond['rawQuery'] .= " AND " . implode(" AND ", $filteringRules);
            }
        }

        $result = $objUserModel->getAllFiltersubscription($whereCond, $sortingOrder, $iDisplayStart, $iDisplayLength);
        $result = json_decode(json_encode($result), true);

        foreach ($result as $key => $value) {

            $details = ' <a href="javascript:;" class="show-details" data-toggle="modal"  title="Details" data-target="#showDetails" data-id="' . $value['sub_package_id'] . '">
                                           <button class="btn btn-xs btn-dark">Details</button>
                                           </a>
                                             <a href="javascript:;" class="editUserdetails" title="Edit" data-toggle="modal" data-target="#editUserModal" data-id="' . $value['sub_package_id'] . '">
                                              <button class="btn btn-xs btn-dark"> <i class="fa fa-pencil-square-o"></i></button>
                                           </a>
                                           <a href="javascript:;"><i class="fa fa-trash" title="Delete" id="deleteCommnet" data-id=' . $value['sub_package_id'] . '></i></a>
                                         
                                           ';

            $sub_package_type = '';
            if ($value['sub_package_type'] == 0) {
                $sub_package_type = '<i class="fa fa-heart"></i>&nbsp; autolikes';
            } else if ($value['sub_package_type'] == 1) {
                $sub_package_type = '<i class="fa  fa-thumb-tack"></i>&nbsp; autoviews';
            }
            $status = '';
            if ($value['status'] == 0) {
                $status = '<a data-id="' . $value['sub_package_id'] . '" data-status="1"
                           class="changeStatus label label-danger" style="cursor:pointer;">Inactive</a>';
            } else if ($value['status'] == 1) {
                $status = '<a data-id="' . $value['sub_package_id'] . '" data-status="0"
                       class="changeStatus label label-success" style="cursor:pointer;">Active</a>';
            }
            $records['data'][] = array(
//                '<input type="checkbox" class="orderCheckBox" name="sub_package_id[]" value="' . $value['sub_package_id'] . '">',
                $value['sub_package_id'],
                $value['sub_package_name'],
                $value['quantity'],
                $sub_package_type,
                $status,
                $details

            );
        }
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords; //$iTotalFilteredRecords
        echo json_encode($records, true);
    }


    /**
     * @Desc: satusChangeSubscription
     * @param Request $request
     * @since  10/7/ 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function satusChangeSubscription(Request $request)
    {
        if ($request->isMethod('post')) {
            $admindataparse = new Subscription();
            $whereForUpdate = ['rawQuery' => 'sub_package_id = ?', 'bindParams' => [$request->input('sub_package_id')]];
            $dataToUpdate = ['status' => $request->input('status')];
            $updated = $admindataparse->updateStatus($whereForUpdate, $dataToUpdate);

            if ($updated)
                echo json_encode(['status' => 200, 'message' => ' Successfully changed subscription status']);
            else echo json_encode(['status' => 400, 'message' => 'Something went wrong, please try again.']);

        } else {

            echo json_encode(['status' => 401, 'message' => 'Request not allowed, Only post request is allowed']);
        }

    }


    /**
     * @Desc: showExtraDetailsAjaxHAndler
     * @param Request $request
     * @since  10/7/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function showExtraDetailsAjaxHAndler(Request $request)
    {
        if ($request->isMethod('post')) {
            $objPackages = new Subscription();
            $select = [DB::raw('CASE   
         WHEN sub_package_type = 0 THEN \'autolikes\'
         WHEN sub_package_type = 1 THEN \'autoviews\'
         END  as sub_package_type'),
                DB::raw('CASE  
         WHEN  status = 0 THEN \'inactive\'
         WHEN status = 1 THEN \'active\'
         END  as  status'),

                DB::raw('CASE WHEN sub_package_for=1 THEN \'Get Instant Likes Eng\'
                 WHEN sub_package_for=2 THEN \'Get Instant Likes Ru\'
                  WHEN  sub_package_for=3 THEN \'Get Instant Views Eng\'
                  WHEN  sub_package_for=4 THEN \' Get instant views RU\'
                  WHEN sub_package_for=5 THEN \' AUTOIG subscriptions\'
                  WHEN sub_package_for=6 THEN \' Instastats\' END as sub_package_for
                  '),

                'sub_package_name', 'quantity'];
            $userDetails = $objPackages->Fetchsubscription($request->input('sub_package_id'), $select);
            $userDetails = json_decode(json_encode($userDetails), true);

            if (isset($userDetails) && !empty($userDetails))
                echo json_encode(['status' => 200, 'msg' => 'Details Fetch Sucessfully .', 'userDetails' => $userDetails]);
            else
                echo json_encode(['status' => 400, 'msg' => 'Subcription details not found.']);
        } else {
            echo json_encode(['status' => 401, 'msg' => 'Request couldnt be completed,Only post method is allowed.']);
        }


    }


    /**
     * @Desc: deleteAjaxHandlersubscription
     * @param Request $request
     * @since  10/7/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function deleteAjaxHandlersubscription(Request $request)
    {
        if ($request->isMethod('post')) {
            $sub_package_id = $request->input('sub_package_id');
            $objModelpackage = new Subscription();
            $whereForDelete = array(
                'rawQuery' => 'sub_package_id = ?',
                'bindParams' => [$sub_package_id]
            );
            $objModelpackage = $objModelpackage->deletepSubcription($whereForDelete);
            if ($objModelpackage) {
                echo json_encode(array('status' => '200', 'message' => 'Subcription  has been successfully deleted'));
            } else {
                echo json_encode(array('status' => '400', 'message' => 'error'));
            }
        }
    }


    /**
     * @Desc: EditAjaxHandlerSubscription
     * @param Request $request
     * @since 11/7/ 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */

    public function EditAjaxHandlerSubscription(Request $request)
    {
        if ($request->isMethod('post')) {
            $objPlanModel = new Subscription();
            $userDetails = $objPlanModel->fetchSubcriptionId($request->input('sub_package_id'));
            $userDetails = json_decode(json_encode($userDetails), true);
            $objModelOfPlan = new Plan();
            $planDetails = $objModelOfPlan->getPlanDetails(['rawQuery' => 'status =1']);
            $planDetails = json_decode(json_encode($planDetails), true);
//            if ($userDetails['views_price']==null) {
//                $userDetails['views_price'] = '-------';
//            }
//
            if ($userDetails)
                echo json_encode(['status' => 200, 'msg' => 'Package details found.', 'planDetails' => $planDetails, 'data' => $userDetails]);
            else
                echo json_encode(['status' => 400, 'msg' => 'Package details not found.']);
        } else {
            echo json_encode(['status' => 401, 'msg' => 'Request couldnt be completed,Only post method is allowed.']);
        }

    }


    /**
     * @Desc: UpdateAjaxHandelerSubscription
     * @param Request $request
     * @since 11/7/ 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function UpdateAjaxHandelerSubscription(Request $request)
    {
        if ($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
                'sub_package_name' => 'required',
                'sub_package_type' => 'required',
                'quantity' => 'required|regex:/^\d+(,\d{1,2})?$/',
//                'views_price' => 'required|regex:/^\d*(\.\d{1,2})?$/',
            ]);
            if ($validator->fails()) {
                echo json_encode(['status' => 400, 'message' => array_values(json_decode($validator->messages(), true))[0][0]]);
                die;
            }

            $postData = $request->all();


            $views_price=$request->input('views_price');
            $daily_details=array_filter($request->input('daily_details'));
            $weekly_details=array_filter($request->input('weekly_details'));
            $monthly_details=array_filter($request->input('monthly_details'));

            $postData['daily_details'] = ($daily_details)?json_encode([$daily_details]):null;
            $postData['weekly_details'] = ($weekly_details)?json_encode([$weekly_details]):null;
            $postData['monthly_details'] = ($monthly_details)?json_encode([$monthly_details]):null;
            $postData['views_price'] = ($views_price) ? ($views_price) : null;


            $admindataparse = new Subscription();
            $whereForUpdate = ['rawQuery' => 'sub_package_id = ?', 'bindParams' => [$postData['sub_package_id']]];
            unset($postData['sub_package_id']);
            $updated = $admindataparse->updateSubcription($whereForUpdate, $postData);
            if ($updated)
                echo json_encode(['status' => 200, 'message' => 'Updated successfully.']);
            else if ($updated == 0)
                echo json_encode(['status' => 201, 'message' => 'You have made no changes to save.']);
            else
                echo json_encode(['status' => 400, 'message' => 'Something went wrong, please try again.']);
        } else {
            echo json_encode(['status' => 401, 'message' => 'Request not allowed, Only post request is allowed']);
        }

    }


    /**
     * @Desc: AddSubcription
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since  11 /7/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function AddSubcription(Request $request)
    {
        if ($request->isMethod('post')) {
            $rules = [
                'sub_package_name' => 'required',
                'quantity' => 'required|regex:/^\d+(,\d{1,2})?$/',
                'sub_package_type' => 'required',
            ];
            $message = [
                'sub_package_name' => 'Please Enter package_name',
                'quantity' => 'Please Enter quantity',
                'sub_package_type' => 'Please Enter sub_package_type',

            ];

            $validator = validator::make($request->input(), $rules, $message);
            if ($validator->fails()) {
                return back()->WithErrors($validator)->WithInput();
            }
            $fillable = array();
            $data = [];
            $fillable['sub_package_name'] = $request->input('sub_package_name');
            $fillable['quantity'] = $request->input('quantity');
            $fillable['sub_package_type'] = 0;
            $fillable['sub_package_for'] = 5;
            $fillable['status'] = 0;
            $fillable['created_at'] = time();

//            if (isset($request->all()['coupon_question'])) {
//
//                $rules = [
//                    'views_per_post' => 'required|regex:/^\d*(\.\d{1,2})?$/',
//                    'views_plan_id' => 'required',
//                    'views_price' => 'required|regex:/^\d*(\.\d{1,2})?$/',
//                ];
//                $message = [
//                    'views_per_post' => 'Please Enter views_per_post',
//                    'views_plan_id' => 'Please Enter views_plan_id',
//                    'views_price' => 'Please Enter views_price',
//                ];
//                $validator = validator::make($request->input(), $rules, $message);
//                if ($validator->fails()) {
//                    return back()->WithErrors($validator)->WithInput()->with('errorDiv3','coupon_question');
//                }
//
//                $fillable['views_per_post'] = $request->input('views_per_post');
//                $fillable['views_plan_id'] = $request->input('views_plan_id');
//                $fillable['views_price'] = $request->input('views_price');
//
//            }


            if (isset($request->all()['coupon_question'])) {

                $rules = [
                    'views_per_post' => 'required|regex:/^\d*(\.\d{1,2})?$/',
                    'views_plan_id' => 'required',
                    'views_price' => 'required|regex:/^\d*(\.\d{1,2})?$/',
                ];
                $message = [
                    'views_per_post' => 'Please Enter views_per_post',
                    'views_plan_id' => 'Please Enter views_plan_id',
                    'views_price' => 'Please Enter views_price',
                ];
                $validator = validator::make($request->input(), $rules, $message);
                if ($validator->fails()) {
                    return back()->WithErrors($validator)->WithInput()->with('errorDiv3', 'coupon_question');
                }

                $fillable['views_per_post'] = $request->input('views_per_post');
                $fillable['views_plan_id'] = $request->input('views_plan_id');
                $fillable['views_price'] = $request->input('views_price');
                if ($request->input('views_price') == 0) {
                    $fillable['sub_package_type'] = 2;
                    $fillable['auto_views'] = null;


                } else {

                    $fillable['auto_views'] = 'on';    // if not selected  views click then it will be Off In Database
                }
            }


            if (empty($request->all()['coupon_question']) && !isset($request->all()['coupon_question'])) {

                $fillable['auto_views'] = 'off';

            }
            $dailyDetails = new Collection();

            if (isset($request->all()['daily_details'])) {

                $rules = [
                    'daily_billing_frequency' => 'required|regex:/^\d+(,\d{1,2})?$/',
                    'daily_post_limit' => 'required|regex:/^\d+(,\d{1,2})?$/',
                    'daily_daily_post_limit' => 'required|regex:/^\d+(,\d{1,2})?$/',
                    'plan_id' => 'required|regex:/^\d*(\.\d{1,2})?$/',
                    'daily_price' => 'required|regex:/^\d*(\.\d{1,2})?$/',
                ];
                $message = [
                    'daily_billing_frequency' => 'Please Enter daily_billing_frequency',
                    'daily_post_limit' => 'Please Enter daily_post_limit',
                    'daily_daily_post_limit' => 'Please Enter daily_daily_post_limit',
                    'plan_id' => 'Please Enter plan_id',
                    'daily_price' => 'Please Enter daily_price',
                ];

                $validator = validator::make($request->input(), $rules, $message);
                if ($validator->fails()) {
                    return back()->WithErrors($validator)->WithInput()->with('errorDiv','daily');
                }

                $dailyDetails->push([
                    'billing_frequency' => $request->input('daily_billing_frequency'),
                    'billing_period' => 'Day',
                    'price' => $request->input('daily_price'),
                    'post_limit' => $request->input('daily_post_limit'),
                    'daily_post_limit' => $request->input('daily_daily_post_limit'),
                    'plan_id' => $request->input('plan_id'),
                ]);
                $fillable['daily_details'] = json_encode($dailyDetails);
            }


            $weeklyDetails = new Collection();
            if (isset($request->all()['weekly_details'])) {
                $rules = [
                    'weekly_billing_frequency' => 'required|regex:/^\d+(,\d{1,2})?$/',
                    'weekly_post_limit' => 'required|regex:/^\d+(,\d{1,2})?$/',
                    'weekly_daily_post_limit' => 'required|regex:/^\d+(,\d{1,2})?$/',
                    'weekly_plan_id' => 'required|regex:/^\d*(\.\d{1,2})?$/',
                    'weekly_price' => 'required|regex:/^\d*(\.\d{1,2})?$/',
                ];
                $message = [
                    'weekly_billing_frequency' => 'Please Enter weekly_billing_frequency',
                    'weekly_post_limit' => 'Please Enter weekly_post_limit',
                    'weekly_daily_post_limit' => 'Please Enter weekly_daily_post_limit',
                    'weekly_plan_id' => 'Please Enter weekly_plan_id',
                    'weekly_price' => 'Please Enter weekly_price',
                ];

                $validator = validator::make($request->input(), $rules, $message);
                if ($validator->fails()) {
                    return back()->WithErrors($validator)->WithInput()->with('errorDiv1','weekly');
                }
                $weeklyDetails->push([
                    'billing_frequency' => $request->input('weekly_billing_frequency'),
                    'billing_period' => 'Week',
                    'price' => $request->input('weekly_price'),
                    'post_limit' => $request->input('weekly_post_limit'),
                    'daily_post_limit' => $request->input('weekly_daily_post_limit'),
                    'plan_id' => $request->input('weekly_plan_id'),
                ]);
                $fillable['weekly_details'] = json_encode($weeklyDetails);
            }


            $mothlyDetails = new Collection();
            if (isset($request->all()['monthly_details'])) {

                $rules = [
                    'monthly_billing_frequency' => 'required|regex:/^\d+(,\d{1,2})?$/',
                    'monthly_post_limit' => 'required|regex:/^\d+(,\d{1,2})?$/',
                    'monthly_daily_post_limit' => 'required|regex:/^\d+(,\d{1,2})?$/',
                    'monthly_plan_id' => 'required|regex:/^\d*(\.\d{1,2})?$/',
                    'monthly_price' => 'required|regex:/^\d*(\.\d{1,2})?$/',
                ];
                $message = [
                    'monthly_billing_frequency' => 'Please Enter monthly_billing_frequency',
                    'monthly_post_limit' => 'Please Enter monthly_post_limit',
                    'monthly_daily_post_limit' => 'Please Enter monthly_daily_post_limit',
                    'monthly_plan_id' => 'Please Enter monthly_plan_id',
                    'monthly_price' => 'Please Enter monthly_price',
                ];

                $validator = validator::make($request->input(), $rules, $message);
                if ($validator->fails()) {
                    return back()->WithErrors($validator)->WithInput()->with('errorDiv2','monthly');
                }
                $mothlyDetails->push([
                    'billing_frequency' => $request->input('monthly_billing_frequency'),
                    'billing_period' => 'Month',
                    'price' => $request->input('monthly_price'),
                    'post_limit' => $request->input('monthly_post_limit'),
                    'daily_post_limit' => $request->input('monthly_daily_post_limit'),
                    'plan_id' => $request->input('monthly_plan_id'),

                ]);
                $fillable['monthly_details'] = json_encode($mothlyDetails);
            }

//           dd($fillable);
            $objModelpackage = new Subscription();
            $result = $objModelpackage->addSubscription($fillable);
//            if ($result) {
//                echo json_encode(['status' => 200, 'message' => 'Added Subscription to the table and it is ready for use']);
//            } else {
//                echo json_encode(['error' => 400, 'message' => 'Some Error occurred. Please reload the page and try again later']);
//
//            }


            if ($result) {
                return redirect('/admin/AddSubcription')->with('packageMsg', 'SubScription Package  has been added successfully.');
            } else {
                return back('/admin/AddSubcription')->with('packageMsg', 'Something went wrong, please try after sometime.');

            }
        }


        // Update plans TableS
        $objModelOfPlan = new Plan();
        $planDetails = $objModelOfPlan->getPlanDetails(['rawQuery' => 'status =1']);
        $planDetails = json_decode(json_encode($planDetails), true);

        return view('Admin::Subscription/AddSubscription', ['plans' => $planDetails]);
    }

    /**
     * @Desc:GetAddSubscriptionPackages
     * @param Request $request
     * @since /9/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function GetAddSubscriptionPackages(Request $request)
    {
//        dd($request->all());
        if ($request->isMethod('post')) {
            $planype = $request->input('type');

            $objectmodel = new Plan();
            $whereForget = array(
                'rawQuery' => 'plan_type = ?',
                'bindParams' => [$planype]
            );
            $packageDetails = $objectmodel->getPlanDetails($whereForget);
            if (count($packageDetails)) {
                echo json_encode(array('status' => '200', 'message' => 'plans details', 'data' => $packageDetails));
            } else {
                echo json_encode(array('status' => '400', 'message' => 'not found', 'data' => null));
            }
        }
    }




}





