<?php
/**
 * Created by Monali Samal
 * User: Monali Samal <monalisamal@globussoft.in>
 * Date: 3/21/2018
 * Time: 10:34 AM
 */


namespace App\Modules\Admin\Controllers;

use App\Modules\Admin\Models\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
//use Yajra\Datatables\Datatables;
use  Validator;

use users;
use DataTables;
use Maatwebsite\Excel;
use App\User;

class PlansController extends Controller
{


    /**
     * @Desc deleteAjaxHandler
     * @param Request $request
     * @since   22 march  2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function deleteAjaxHandler(Request $request)
    {
        if ($request->isMethod('post')) {
            $plan_id = $request->input('plan_id');
            $objModelPlan = new Plan();
            $whereForDelete = array(
                'rawQuery' => 'plan_id = ?',
                'bindParams' => [$plan_id]
            );
            $objModelPlan = $objModelPlan->deletepPlan($whereForDelete);
            if ($objModelPlan) {
                echo json_encode(array('status' => '200', 'message' => 'Plan  has been successfully deleted'));
            } else {
                echo json_encode(array('status' => '400', 'message' => 'error'));
            }
        }
    }


    /**
     * @Desc: PlanDatatable
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since  23 march  2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function PlanDatatable(Request $request)
    {
        $data = DB::table('plans')->get();
        return view('Admin::Plan/Plan', ['data' => $data]);
    }

    /**
     * @Desc: PlanAjaxHandeler
     * @param Request $request
     * @since  23 march  2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function PlanAjaxHandeler(Request $request)
    {

        $requestParam = $request->all();
        $objUserModel = new Plan();
        $whereCond = [
            'rawQuery' => '1',
        ];


        $iTotalRecords = count($objUserModel->getPlanDetails($whereCond));
        $iTotalFilteredRecords = $iTotalRecords;
        $iDisplayLength = intval($requestParam['length']);
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        $iDisplayStart = intval($requestParam['start']);
        $sEcho = intval($requestParam['draw']);

        $records = array();
        $records["data"] = array();

        $columns = array(
            'plans.plan_id',
            'plans.supplier_server_Id',
            'plans.plan_name',
            'plans.min_quantity',
            'plans.max_quantity',
            'plans.buying_price',
            'plans.selling_price',
            'plans.plan_type',
            'plans.status',
        );
        $sortingOrder = "";
        if (isset($requestParam['order'])) {
            $sortingOrder = [$columns[$requestParam['order'][0]['column'] - 1], $requestParam['order'][0]['dir']];
        }

        // Filtering datatable code
        $filteringRules = [];
        if (isset($requestParam['action']) && $requestParam['action'] == 'filter' && $requestParam['action'][0] != 'filter_cancel') {
            if ($requestParam['search_plan_id'] != '') {
                $filteringRules[] = "(plans.plan_id LIKE '%" . $requestParam['search_plan_id'] . "%' )";
            }
            if ($requestParam['search_supplier_server_Id'] != '') {
                $filteringRules[] = "(plans.supplier_server_Id LIKE '%" . $requestParam['search_supplier_server_Id'] . "%' )";
            }
            if ($requestParam['search_plan_name'] != '') {
                $filteringRules[] = "(plans.plan_name LIKE '%" . $requestParam['search_plan_name'] . "%' )";
            }
            if ($requestParam['search_min_quantity'] != '') {
                $filteringRules[] = "(plans.min_quantity LIKE '%" . $requestParam['search_min_quantity'] . "%' )";
            }

            if ($requestParam['search_max_quantity'] != '') {
                $filteringRules[] = "(plans.max_quantity LIKE '%" . $requestParam['search_max_quantity'] . "%' )";
            }
            if ($requestParam['search_buying_price_from'] && $requestParam['search_buying_price_to'] != '') {
                $filteringRules[] = 'plans.buying_price between ' . $requestParam['search_buying_price_from'] . ' and ' . $requestParam['search_buying_price_to'];
            }

            if ($requestParam['search_selling_price_from'] && $requestParam['search_selling_price_to'] != '') {
                $filteringRules[] = 'plans.selling_price between ' . $requestParam['search_selling_price_from'] . ' and ' . $requestParam['search_selling_price_to'];
            }


            if ($requestParam['search_plan_type'] != '') {
                $filteringRules[] = "(plans.plan_type LIKE '%" . $requestParam['search_plan_type'] . "%' )";
            }
            if ($requestParam['search_status'] != '') {
                $filteringRules[] = "(plans.status LIKE '%" . $requestParam['search_status'] . "%' )";
            }
            if (!empty($filteringRules)) {
                $whereCond['rawQuery'] .= " AND " . implode(" AND ", $filteringRules);
            }
        }


        $result = $objUserModel->getAllFilterPlans($whereCond, $sortingOrder, $iDisplayStart, $iDisplayLength);
        $result = json_decode(json_encode($result), true);

        foreach ($result as $key => $value) {

            $details = ' <a href="javascript:;" class="show-details" data-toggle="modal" data-target="#showDetails" title="Detail" data-id="' . $value['plan_id'] . '">
                                           <button class="btn btn-xs btn-dark"><i class="fa fa-expand"></i></button>
                                           </a> &nbsp;
                                           <a href="javascript:;" class="editUserdetails" data-toggle="modal"  title="Edit" data-target="#editUserModal" data-id="' . $value['plan_id'] . '">
                                              <button class="btn btn-xs btn-dark"><i class="fa fa-pencil-square-o"></i></button> 
                                           </a>             
                                           <a href="javascript:;"><i class="fa fa-trash" id="deleteCommnet"  title="Delete" data-id=' . $value['plan_id'] . '></i></a>                                          
         
                                           ';


            $plan_type = '';
            if ($value['plan_type'] == 0) {
                $plan_type = '<i class="fa fa-heart"></i>&nbsp; Instagram Likes';
            } else if ($value['plan_type'] == 1) {
                $plan_type = '<i class="fa  fa-thumbs-up"></i>&nbsp; Instagram Followers';
            } else if ($value['plan_type'] == 2) {
                $plan_type = '<i class="fa  fa-comments"></i>&nbsp; Instagram Random Comments';
            } else if ($value['plan_type'] == 3) {
                $plan_type = '<i class="fa  fa-comment"></i>&nbsp; Custom Comments';
            } else if ($value['plan_type'] == 4) {
                $plan_type = '<i class="fa fa-eye"></i>&nbsp; Instagram Views';
            } else if ($value['plan_type'] == 5) {
                $plan_type = '<i class="fa fa-video-camera"></i>&nbsp;  story views';
            } else if ($value['plan_type'] == 6) {
                $plan_type = '<i class="fa fa-video-camera"></i>&nbsp; live video views;';
            } else if ($value['plan_type'] == 7) {
                $plan_type = '<i class="fa fa-eye"></i>&nbsp; Impressions;';
            }


            $supplier_server_Id = '';
            if ($value['supplier_server_Id'] == 1) {
                $supplier_server_Id = '<i class="fa fa-heart"></i>&nbsp; igerslike';
            } else if ($value['supplier_server_Id'] == 2) {
                $supplier_server_Id = '<i class="fa  fa-thumbs-o-up"></i>&nbsp; cheapbulksocial';
            } else if ($value['supplier_server_Id'] == 3) {
                $supplier_server_Id = '<i class="fa  fa-compass"></i>&nbsp; socialpanel24';
            } else if ($value['supplier_server_Id'] == 4) {
                $supplier_server_Id = '<i class="fa  fa-comment"></i>&nbsp; socialnator';
            } else if ($value['supplier_server_Id'] == 5) {
                $supplier_server_Id = '<i class="fa  fa-user"></i>&nbsp; Followiz';
            } else if ($value['supplier_server_Id'] == 6) {
                $supplier_server_Id = '<i class="fa  fa-compass"></i>&nbsp; top4smm';
            } else if ($value['supplier_server_Id'] == 7) {
                $supplier_server_Id = '<i class="fa  fa-compass"></i>&nbsp; KAMH';
            }

            $status = '';
            if ($value['status'] == 0) {
                $status = '<a data-id="' . $value['plan_id'] . '" data-status="1"
                           class="changeStatus label label-danger" style="cursor:pointer;">Inactive</a>';
            } else if ($value['status'] == 1) {
                $status = '<a data-id="' . $value['plan_id'] . '" data-status="0"
                       class="changeStatus label label-success" style="cursor:pointer;">Active</a>';
            }
            $buying_price = "$" . $value['buying_price'];
            $selling_price = "$" . $value['selling_price'];
            $records['data'][] = array(
//                '<input type="checkbox" class="orderCheckBox" name="planId[]" value="' . $value['plan_id'] . '">',
                $value['plan_id'],
                $supplier_server_Id,
                $value['plan_name'],
                $value['min_quantity'],
                $value['max_quantity'],
                $buying_price,
                $selling_price,
                $plan_type,
                $status,
                $details,
            );
        }

        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords; //$iTotalFilteredRecords
        echo json_encode($records, true);

    }

    /**
     * @Desc: satusChangePlan
     * @param Request $request
     * @since    23 march 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function satusChangePlan(Request $request)
    {
        if ($request->isMethod('post')) {
            $admindataparse = new Plan();
            $whereForUpdate = ['rawQuery' => 'plan_id = ?', 'bindParams' => [$request->input('plan_id')]];
            $dataToUpdate = ['status' => $request->input('status')];
            $updated = $admindataparse->updatePlan($whereForUpdate, $dataToUpdate);
            if ($updated)
                echo json_encode(['status' => 200, 'message' => ' Action Performed Sucessfully']);
            else echo json_encode(['status' => 400, 'message' => 'Something went wrong, please try again.']);
        } else {
            echo json_encode(['status' => 401, 'message' => 'Request not allowed, Only post request is allowed']);
        }

    }

    /**
     * @Desc: getMorePlanDetails
     * @param Request $request
     * @since     23 march 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function getMorePlanDetails(Request $request)
    {
        if ($request->isMethod('post')) {
            $objAdminModel = new Plan();
            $select = [DB::raw('CASE 
         WHEN plan_type = 0 THEN \'Instagram Likes\'
         WHEN plan_type = 1 THEN \'Instagram Followers\'
         WHEN plan_type = 2 then \'Instagram Random Comments\'
         WHEN plan_type = 3 then \'Custom Comments\'
         WHEN plan_type = 4 then \'Instagram Views  \'
         WHEN plan_type = 5 then \'story views  \'
         WHEN plan_type = 6 then \'live video views  \'
         WHEN plan_type = 7 then \'Impressions   \'
         END  as plan_type'),
                DB::raw('CASE  
                WHEN  status = 0 THEN \'inactive\'
         WHEN status = 1 THEN \'active\'
         END  as  status'),
                DB::raw('CASE  
                WHEN supplier_server_Id = 1 THEN \'igerslike\'
         WHEN supplier_server_Id = 2 THEN \'cheapbulksocial\'
         WHEN supplier_server_Id = 3 THEN \' socialpanel24\'
         WHEN supplier_server_Id = 4 THEN \'socialnator\'
         WHEN supplier_server_Id = 5 THEN \'followiz\'
         WHEN supplier_server_Id = 6 THEN \'top4smm\'
         WHEN supplier_server_Id = 7 THEN \'KAMH\'
         END  as supplier_server_Id'),
                'plan_name_code', 'plan_name', 'min_quantity', 'max_quantity', 'buying_price', 'selling_price'];
            $userDetails = $objAdminModel->fetchPlanId($request->input('plan_id'), $select);
            $userDetails = json_decode(json_encode($userDetails), true);

            if (isset($userDetails) && !empty($userDetails))
                echo json_encode(['status' => 200, 'msg' => 'Details Fetch Sucessfully .', 'userDetails' => $userDetails]);
            else
                echo json_encode(['status' => 400, 'msg' => 'Plans details not found.']);
        } else {
            echo json_encode(['status' => 401, 'msg' => 'Request couldnt be completed,Only post method is allowed.']);
        }

    }

    /**
     * @Desc: EditAjaxHandlerPlan
     * @param Request $request
     * @since  23 march  2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function EditAjaxHandlerPlan(Request $request)
    {

        if ($request->isMethod('post')) {
            $objPlanModel = new Plan();
            $userDetails = $objPlanModel->fetchPlanId($request->input('plan_id'));
            $userDetails = json_decode(json_encode($userDetails), true);
            if ($userDetails)
                echo json_encode(['status' => 200, 'msg' => 'Plans details found.', 'data' => $userDetails]);
            else
                echo json_encode(['status' => 400, 'msg' => 'Plans details not found.']);
        } else {
            echo json_encode(['status' => 401, 'msg' => 'Request couldnt be completed,Only post method is allowed.']);
        }

    }


    /**
     * @Desc: UpdateAjaxHandeler
     * @param Request $request
     * @since 23 march   2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function UpdateAjaxHandeler(Request $request)
    {
        if ($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
                'plan_name' => 'required',
                'plan_type' => 'required',
                'plan_name_code' => 'required|regex:/^\d*(\.\d{1,2})?$/',
                'supplier_server_Id' => 'required',
                'min_quantity' => 'required|regex:/^\d+(,\d{1,2})?$/',
                'max_quantity' => 'required|regex:/^\d+(,\d{1,2})?$/',
                'buying_price' => 'required|regex:/^\d*(\.\d{1,2})?$/',
                'selling_price' => 'required|regex:/^\d*(\.\d{1,2})?$/',
            ]);
            if ($validator->fails()) {
                echo json_encode(['status' => 400, 'message' => array_values(json_decode($validator->messages(), true))[0][0]]);
                die;
            }

            $postData = $request->all();
            $admindataparse = new Plan();
            $whereForUpdate = ['rawQuery' => 'plan_id = ?', 'bindParams' => [$postData['plan_id']]];
            unset($postData['plan_id']);
            $updated = $admindataparse->updatePlan($whereForUpdate, $postData);
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
     * @Desc:AddPlan
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @since   23 march  2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function AddPlan(Request $request)
    {
        if ($request->isMethod('post')) {
            global $dbstoragedata;
            global $dbDemodata;

            $data = $request->input('plan_type');
            if ($data === "Instagram Likes") {
                $dbDemodata = "0";
            } elseif ($data === "Instagram Followers") {
                $dbDemodata = "1";
            } elseif ($data === "Instagram Random Comments") {
                $dbDemodata = "2";
            } elseif ($data === "custom comments") {
                $dbDemodata = "3";
            } elseif ($data === "Instagram Views") {
                $dbDemodata = "4";
            } elseif ($data === "story views") {
                $dbDemodata = "5";
            } elseif ($data === "live video views") {
                $dbDemodata = "6";
            } elseif ($data === "Impressions") {
                $dbDemodata = "7";

            }

            $insert = $request->input('supplier_server_Id');
            if ($insert === "igerslike") {
                $dbstoragedata = "1";
            } elseif ($insert === "cheapbulksocial") {
                $dbstoragedata = "2";
            } elseif ($insert === "socialpanel24") {
                $dbstoragedata = "3";
            } elseif ($insert === "socialnator") {
                $dbstoragedata = "4";
            } elseif ($insert === "followiz") {
                $dbstoragedata = "5";
            } elseif ($insert === "top4smm") {
                $dbstoragedata = "6";
            } elseif ($insert === "KAMH") {
                $dbstoragedata = "7";
            }
            $rules = [
//                'plan_name' => 'required|regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[~!^(){}<>%@#&*+=_-])[^\s$`,.\/\\;:\'"|]{8,40}$/',
                'plan_name' => 'required',
//                'plan_name' => 'required|regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[~!^(){}<>%@#&*+=_-])[^\s$`,.\/\\;:\'"|]{8,40}$/',
                'plan_type' => 'required',
                'plan_name_code' => 'required',
                'supplier_server_Id' => 'required',
                'min_quantity' => 'required|regex:/^\d+(,\d{1,2})?$/',
                'max_quantity' => 'required|regex:/^\d+(,\d{1,2})?$/',
                'buying_price' => 'required|regex:/^\d*(\.\d{1,2})?$/',
                'selling_price' => 'required|regex:/^\d*(\.\d{1,2})?$/',
            ];
            $message = [
                'plan_name' => 'Please Enter plan_name',
                'min_quantity' => 'Please Enter min_quantity',
                'plan_type' => 'Please Enter plan_type',
                'max_quantity' => 'Please Enter max_quantity',
                'supplier_server_Id' => 'Please Enter supplier_server_Id',
                'plan_name_code' => 'Please Enter plan_name_code',
                'buying_price' => 'Please Enter buying_price',
                'selling_price' => 'Please Enter selling_price',
            ];
            $validator = validator::make($request->input(), $rules, $message);
            if ($validator->fails()) {
                return back()->WithErrors($validator)->WithInput();
            }
            $fillable = array();
            $fillable['plan_name'] = $request->input('plan_name');
            $fillable['min_quantity'] = $request->input('min_quantity');
            $fillable['max_quantity'] = $request->input('max_quantity');
            $fillable['plan_name_code'] = $request->input('plan_name_code');
            $fillable['buying_price'] = $request->input('buying_price');
            $fillable['selling_price'] = $request->input('selling_price');
            $fillable['supplier_server_Id'] = $dbstoragedata;
            $fillable['plan_type'] = $dbDemodata;
            $fillable['status'] = "1";
            $objModelplan = new Plan();
            $result = $objModelplan->addPlan($fillable);
            if ($result) {
                return back()->with('planMsg', 'Plan  has been added successfully.');
            } else {
                return back()->with('planMsg', 'Something went wrong, please try after sometime.');

            }
        }
        return view('Admin::Plan/addPlan');


    }


}
