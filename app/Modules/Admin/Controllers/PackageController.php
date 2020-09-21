<?php


namespace App\Modules\Admin\Controllers;

//use App\Modules\Admin\Models\Admin;

use App\Modules\Admin\Models\Package;
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

class PackageController extends Controller
{
    public function datatablePackage()

    {

        $data = DB::table('packages')->get();

        return view('Admin::package/datatable', ['data' => $data]);

    }

    public function getPostsPackage()

    {


        $data = DB::table('packages')->get();
        $data = json_decode(json_encode($data), true);

        $usersDetails = new Collection();
        foreach ($data as $key => $users) {

            if ($users['package_status'] == 0)
                $package_status = '<button data-packageId="' . $users['package_id'] . '" data-status="1"
                           class="btn-sm btn-danger buttonStatus" style="cursor:pointer;">Inactive</button></td>';

            else
                $package_status = '<button data-packageId="' . $users['package_id'] . '" data-status="0"
                       class="btn btn-sm btn-success buttonStatus " style="cursor:pointer;">Active</button></td>';

            $usersDetails->push([
                'package_id' => $users['package_id'],
                'package_name' => $users['package_name'],
                'package_for' => $users['package_for'],
                'quantity' => $users['quantity'],
                'price' => $users['price'],
                'package_type' => $users['package_type'],
                'plan_id' => $users['plan_id'],
                'package_status' => $package_status,


            ]);
        }
        return DataTables::of($usersDetails)->rawColumns(['package_status'])->make(true);


    }



    public function changeStatus(Request $request)
    {
        if ($request->isMethod('post')) {
            $adminObjModel = new Package();

            $whereForUpdate = ['rawQuery' => 'package_id = ?', 'bindParams' => [$request->input('packageId')]];
            $conforMessage = $request->input('dataChangeststus');
            if ($conforMessage == 'ok!') {

                $dataToUpdate = ['package_status' => $request->input('status')];

                $updated = $adminObjModel->updatePackages($whereForUpdate, $dataToUpdate);
                if ($updated)
                    echo json_encode(['status' => 200, 'message' => 'Status changed successfully']);
                else
                    echo json_encode(['status' => 400, 'message' => 'Something went wrong, please try again.']);
            }
        } else {
            echo json_encode(['status' => 401, 'message' => 'Request not allowed, Only post request is allowed']);
        }

    }




    /**
     * @Desc managePackage functionality ..........
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since 23 feb  2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function managePackage($method)
        {
            if ($method === 'GILE') {
                return view('Admin::package/mangePackageAjax');
            } else if ($method === 'GILR') {
                return view('Admin::package/mangePackageGILR');
            } else if ($method === 'GIVE') {
                return view('Admin::package/mangePackageGIVE');
            } else if ($method === 'GIVR') {
                return view('Admin::package/mangePackageGIVR');
            } else if ($method === 'AUTOIG') {
                return view('Admin::package/mangePackageAUTOIG');
            } else if ($method === 'INSTASTAT') {
                return view('Admin::package/mangePackageInstaStat');
            } else if ($method === 'Instant') {
                return view('Admin::package/managePackageInstant');
            }
        }

    /**
     * @Desc packageAjaxHandler
     * @param Request $request
     * @since  13 feb  2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function packageAjaxHandler(Request $request)
    {

        $requestParam = $request->all();
        $objUserModel = new Package();
        $whereCond = [
            'rawQuery' => '1',
        ];


        $method = $request->input('method');

        switch ($method) {
            case 'GILE':
                $whereCond = [
                    'rawQuery' => '1 and package_for=1',
                ];
                break;

            case'GILR':
                $whereCond = [
                    'rawQuery' => '1 and  package_for=2'
                ];
                break;
            case 'GIVE':
                $whereCond = [
                    'rawQuery' => ' 1 and package_for=3',
                ];
                break;
            case 'GIVR':
                $whereCond = [
                    'rawQuery' => '1 and package_for=4',
                ];
                break;
            case 'AUTOIG':
                $whereCond = [
                    'rawQuery' => '1 and package_for =5',
                ];
                break;
            case 'INSTASTAT':
                $whereCond = [
                    'rawQuery' => '1 and package_for=6',
                ];

                break;


            case 'Instant':
                $whereCond = [
                    'rawQuery' => '1 and package_for=7',
                ];

                break;

        }

        $iTotalRecords = count($objUserModel->getPackagesDetails($whereCond));
        $iTotalFilteredRecords = $iTotalRecords;
        $iDisplayLength = intval($requestParam['length']);
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        $iDisplayStart = intval($requestParam['start']);
        $sEcho = intval($requestParam['draw']);

        $records = array();
        $records["data"] = array();

        $columns = array(
            'packages.package_id',
            'packages.package_name',
            'packages.package_type',
            'packages.package_for',
            'packages.package_status',
            'packages.quantity',
            'packages.price',
            'packages.plan_id',
        );
        $sortingOrder = "";
        if (isset($requestParam['order'])) {
            $sortingOrder = [$columns[$requestParam['order'][0]['column'] - 1], $requestParam['order'][0]['dir']];
        }


        if (isset($requestParam["customActionType"]) && $requestParam["customActionType"] == "group_action") {
            if ($requestParam['customActionName'] != '' && !empty($requestParam['packageId'])) {
                $packageIds = $requestParam['packageId'];

                if ($requestParam['customActionName'] == 'Remove_orders') {

                    $messages = array();
                    $count = 1;
                    foreach ($packageIds as $key => $packageId) {
                        $username = $objUserModel->getPackagesDatabase(['rawQuery' => 'package_id=?', 'bindParams' => [$packageId]]);
                        $result = $objUserModel->deletePackages(['rawQuery' => 'package_id=?', 'bindParams' => [$packageId]]);

                        if ($result) {
                            $messages[0] = $count . "Package Has been Deleted. <br>";
                            $count++;
                        } else {
                            $messages[$key + 1] = 'There is a problem in Deleted ' . $username[0]->package_id . ' profile. <br>';
                        }
                    }
                    $records["customActionStatus"] = "OK";
                    $records["customActionMessage"] = $messages;

                } else if($requestParam['customActionName']=='inactive'){

                    $messages=array();
                    $count=1;
                    foreach ($packageIds as $key=>$packageId){
                        $username=$objUserModel->getPackagesDetailsDatabase(['rawQuery'=>'package_id=?','bindParams'=>[$packageId]]);
                        $result=$objUserModel->updatePackages(['rawQuery'=>'package_id=?','bindParams'=>[$packageId]],['package_status' => 0]);
                        if ($result) {
                            $messages[0] = $count . "Package status Has been Inactive. <br>";
                            $count++;

//
                        }else{
                            $messages[$key+1]='There is a Problem in Active'.$username[0]->package_id.'profile.<br>';

                        }

                    }
                    $records["customActionStatus"]="OK";
                    $records["customActionMessage"]=$messages;
                } else if($requestParam['customActionName']=='active'){

                    $messages=array();
                    $count=1;
                    foreach ($packageIds as $key=>$packageId){
                        $username=$objUserModel->getPackagesDetailsDatabase(['rawQuery'=>'package_id=?','bindParams'=>[$packageId]]);
                        $result=$objUserModel->updatePackages(['rawQuery'=>'package_id=?','bindParams'=>[$packageId]],['package_status'=>1]);

                        if ($result) {
                            $messages[0] = $count . "Package Status Has been Active. <br>";
//                            $messages[$key + 1] = '<span style="margin-left: 5%">Profile:&nbsp;&nbsp; <i class="fa fa-instagram"><b>&nbsp;' . $username[0]->package_id . '</b></i></span> <br>';
                            $count++;
                        }else{
                            $messages[$key+1]='There is a Problem In  Inactive'.$username[0]->package_id.'profile.<br>';
                        }
                    }
                }
            }
        }

// Filtering datatable code
        $filteringRules = [];
        if (isset($requestParam['action']) && $requestParam['action'] == 'filter' && $requestParam['action'][0] != 'filter_cancel') {
            if ($requestParam['search_package_id'] != '') {
                $filteringRules[] = "(packages.package_id LIKE '%" . $requestParam['search_package_id'] . "%' )";
            }
            if ($requestParam['search_package_name'] != '') {
                $filteringRules[] = "(packages.package_name LIKE '%" . $requestParam['search_package_name'] . "%' )";
            }
            if ($requestParam['search_price_from'] && $requestParam['search_price_to'] != '') {
                $filteringRules[] = 'packages.price between ' . $requestParam['search_price_from'] . ' and ' . $requestParam['search_price_to'];
            }


            if ($requestParam['search_package_status'] != '') {
                $filteringRules[] = "(packages.package_status LIKE '%" . $requestParam['search_package_status'] . "%' )";
            }
            if ($requestParam['search_package_type'] != '') {
                $filteringRules[] = "(packages.package_type LIKE '%" . $requestParam['search_package_type'] . "%' )";
            }
            if (!empty($filteringRules)) {
                $whereCond['rawQuery'] .= " AND " . implode(" AND ", $filteringRules);
            }
        }

//         SWITCHCASE UER FOR  PACKAGE_FOR

        $result = $objUserModel->getAllFilterPackages($whereCond, $sortingOrder, $iDisplayStart, $iDisplayLength);
        $result = json_decode(json_encode($result), true);


        foreach ($result as $key => $value) {



            $details = ' <a href="javascript:;" class="show-details" data-toggle="modal"  title="Details" data-target="#showDetails" data-id="' . $value['package_id'] . '">
                                           <button class="btn btn-xs btn-info"><i class="fa fa-eye"></i></button>&nbsp;
                                           </a>';

            $details = $details . '<a href="javascript:;" class="editUserdetails" style="margin-left: -4%;" title="Edit" data-toggle="modal" data-target="#editUserModal" data-id="' . $value['package_id'] . '">
                                        
                                            <button class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o "></i></button>
                                           </a>';


            $details = $details . '<a href="javascript:;"><button class="btn btn-xs btn-dark"  title="Delete" id="deleteCommnet" data-id=' . $value['package_id'] . '><i class="fa fa-trash"></i></button></a>';


            $edit = '<a href="javascript:;" class="editUserdetails" data-toggle="modal" data-target="#editUserModal" data-id="' . $value['package_id'] . '">
                                               <i class="fa fa-pencil-square-o "></i>Edit</span>
                                           </a>';

            $delete = '<a href="javascript:;"><i class="fa fa-trash" id="deleteCommnet" data-id=' . $value['package_id'] . '></i></a>';


            $package_type = '';
            if ($value['package_type'] == 0) {
                $package_type = '<span><i class="fa   fa-heart"></i>&nbsp; likes </span>';
            } else if ($value['package_type'] == 1) {
                $package_type = '<span><i class="fa  fa-user"></i>&nbsp; followers</span>';
            } else if ($value['package_type'] == 2) {
                $package_type = '<span><i class="fa  fa-comments"></i>&nbsp; random comments</span>';
            } else if ($value['package_type'] == 3) {
                $package_type = '<span><i class="fa  fa-comment"></i>&nbsp; custom comments</span>';
            } else if ($value['package_type'] == 4) {
                $package_type = '<span><i class="fa fa-eye"></i>&nbsp; views</span>';
            } else if ($value['package_type'] == 5) {
                $package_type = '<span><i class="fa fa-play-circle"></i>&nbsp; story views</span>';
            } else if ($value['package_type'] == 6) {
                $package_type = '<span><i class="fa fa-eye-slash"></i>&nbsp; live video views</span>';
            }




            $package_status = '';
            if ($value['package_status'] == 0) {
                $package_status = '<a data-id="' . $value['package_id'] . '" data-status="1"
                           class="changeStatus label label-danger" style="cursor:pointer;">Inactive</a></td>';
            } else if ($value['package_status'] == 1) {
                $package_status = '<a data-id="' . $value['package_id'] . '" data-status="0"
                       class="changeStatus label label-success" style="cursor:pointer;">Active</a></td>';
            }




            $price = "$" . $value['price'];
            $records['data'][] = array(
                '<input type="checkbox" class="orderCheckBox" name="userId[]" value="' . $value['package_id'] . '">',
                $value['package_id'],
                $value['package_name'],
                $price,
                $package_status,
                $package_type,
                $details,
                $edit,
                $delete
            );
        }
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords; //$iTotalFilteredRecords
        echo json_encode($records, true);


    }
    /**
     * @Desc getMorePackagesDetails
     * @param Request $request
     * @since 13 Feb  2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function getMorePackagesDetails(Request $request)
    {
        if ($request->isMethod('post')) {
            $objAdminModel = new Package();
            $select = [DB::raw('CASE   
 
           WHEN package_for = 1 THEN \'Get Instant Likes En\'
         WHEN package_for = 2 THEN \'Get Instant Likes Ru\'
         WHEN package_for = 3 then \'Get Instant Views En\'
         WHEN package_for = 4 then \'Get Instant Views Ru\'
         WHEN package_for = 5 then \'AUTOIG \'
         WHEN package_for = 6 then \'instaSTATS\'
         WHEN package_for = 7 then \'Instant\'
         END  as package_for'),
                DB::raw('CASE  
                WHEN package_status = 0 THEN \'inactive\'
         WHEN package_status = 1 THEN \'active\'
         END  as package_status'),


                DB::raw('CASE  
                WHEN package_type = 0 THEN \'likes\'
         WHEN package_type = 1 THEN \'followers\'
         WHEN package_type = 2 THEN \' random comments\'
         WHEN package_type = 3 THEN \'custom comments\'
         WHEN package_type = 4 THEN \' views\'
         WHEN package_type = 5 THEN \' story views\'
         WHEN package_type = 6 THEN \' live video views\'
         END  as package_type'),

                'quantity', 'package_name','packages.plan_id', 'price'];
            $userDetails = $objAdminModel->fetchPackageIdUpdate($request->input('package_id'), $select);
            $userDetails = json_decode(json_encode($userDetails), true);
            if (isset($userDetails) && !empty($userDetails))
                echo json_encode(['status' => 200, 'msg' => 'Details Fetch Sucessfully .', 'userDetails' => $userDetails]);
            else
                echo json_encode(['status' => 400, 'msg' => 'User details not found.']);
        } else {
            echo json_encode(['status' => 401, 'msg' => 'Request couldnt be completed,Only post method is allowed.']);
        }

    }



    public function getPackagesEdit(Request $request)
    {
        if ($request->isMethod('post')) {
            $pacakgeId = $request->input('package_id');
            $objAdminModel = new Package();
            $whereForEdit = array(
                'rawQuery' => 'packages.package_id = ?',
                'bindParams' => [$pacakgeId]
            );
            $userDetails = $objAdminModel->fetchPackageId($whereForEdit);
            $userDetails = json_decode(json_encode($userDetails), true);

            $objModelOfPlan = new Plan();
            $planDetails = $objModelOfPlan->getPlanDetails(['rawQuery' => 'status =1']);
            $planDetails = json_decode(json_encode($planDetails), true);
            if ($userDetails)
                echo json_encode(['status' => 200, 'msg' => 'Package details found.', 'data' => $userDetails,'planDetails'=>$planDetails]);
            else
                echo json_encode(['status' => 400, 'msg' => 'Package details not found.']);
        } else {
            echo json_encode(['status' => 401, 'msg' => 'Request couldnt be completed,Only post method is allowed.']);
        }
    }

    /**
     * @Desc getUpdatePackagedata functionality ,
     * @param Request $request
     * @since  24 feb 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
//    public function getUpdatePackagedata(Request $request)
//    {
//        if ($request->isMethod('post')) {
//            $postData = $request->all();
//            $edited_user_id=$postData['package_id'];
//
//            $validator= Validator::make($request->all(), [
//                'package_name' => 'required',
//                'package_type' => 'required',
//                'package_status' => 'required',
////                'plan_name' => 'required|not_in:Select Plan'.$edited_user_id,
//                'quantity' => 'required|regex:/^\d+(,\d{1,2})?$/',
//                'price' => 'required|regex:/^\d*(\.\d{1,2})?$/',
//            ]);
//            if ($validator->fails()) {
//                echo json_encode(['status' => 400, 'message' => array_values(json_decode($validator->messages(),true))[0][0]]);
//                die;
//            }
//            $admindataparse = new Package();
//            $whereForUpdate = ['rawQuery' => 'package_id = ?', 'bindParams' => [$postData['package_id']]];
//            unset($postData['package_id']);
//            $updated = $admindataparse->updateEdit($whereForUpdate, $postData);
//            if ($updated)
//                echo json_encode(['status' => 200, 'message' => 'Updated successfully.']);
//            else if ($updated == 0)
//                echo json_encode(['status' => 201, 'message' => 'You have made no changes to save.']);
//            else
//                echo json_encode(['status' => 400, 'message' => 'Something went wrong, please try again.']);
//        } else {
//            echo json_encode(['status' => 401, 'message' => 'Request not allowed, Only post request is allowed']);
//        }
//    }


    public function getUpdatePackagedata(Request $request)
    {
        if ($request->isMethod('post')) {
            $postData = $request->all();
            $edited_user_id=$postData['package_id'];

            $validator= Validator::make($request->all(), [
                'package_name' => 'required',
                'package_type' => 'required',
                'package_status' => 'required',
//                'plan_name' => 'required|not_in:Select Plan'.$edited_user_id,
                'quantity' => 'required|regex:/^\d+(,\d{1,2})?$/',
                'price' => 'required|regex:/^\d*(\.\d{1,2})?$/',
            ]);
//            dd($postData['plan_name']=='Select Plan');
            if ($validator->fails()) {
                echo json_encode(['status' => 400, 'message' => array_values(json_decode($validator->messages(),true))[0][0]]);
                die;
            }
//            $postData = $request->all();
            $admindataparse = new Package();
            $whereForUpdate = ['rawQuery' => 'package_id = ?', 'bindParams' => [$postData['package_id']]];
            unset($postData['package_id']);
            $updated = $admindataparse->updateEdit($whereForUpdate, $postData);
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

    public function satusChangePackage(Request $request)
    {
        if ($request->isMethod('post')) {

            $admindataparse = new Package();
            $whereForUpdate = ['rawQuery' => 'package_id = ?', 'bindParams' => [$request->input('package_id')]];
            $dataToUpdate = ['package_status' => $request->input('package_status')];
            $updated = $admindataparse->UpdatePackage($whereForUpdate, $dataToUpdate);

            if ($updated)

                echo json_encode(['status' => 200, 'message' => ' Action Performed Successfully']);
            else echo json_encode(['status' => 400, 'message' => 'Something went wrong, please try again.']);

        } else {

            echo json_encode(['status' => 401, 'message' => 'Request not allowed, Only post request is allowed']);
        }

    }



    /**
     * @Desc AddingPackages functionality
     * @param Request $request
     * @param string $appPackage
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @since   19 march 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */

    public function addingPackages(Request $request ,$appPackage)
    {
        if ($request->isMethod('post')) {
            global $dbstoragedata;
            global $dbDemodata;
            $data = $request->input('package_type');
            if ($data === "likes") {
                $dbDemodata = "0";
            } elseif ($data === "followers") {
                $dbDemodata = "1";
            } elseif ($data === "random comments") {
                $dbDemodata = "2";
            } elseif ($data === "custom comments") {
                $dbDemodata = "3";
            } elseif ($data === "views") {
                $dbDemodata = "4";
            } elseif ($data === "story views") {
                $dbDemodata = "5";
            } elseif ($data === "live video views") {
                $dbDemodata = "6";
            }

//            $insert = $request->input('package_for');
            if ($appPackage === "GILE") {
                $dbstoragedata = "1";
            } elseif ($appPackage === "GILR") {
                $dbstoragedata = "2";
            } elseif ($appPackage === "GIVE") {
                $dbstoragedata = "3";
            } elseif ($appPackage === "GIVR") {
                $dbstoragedata = "4";
            } elseif ($appPackage == "AUTOIG") {
                $dbstoragedata = "5";
            } elseif ($appPackage == "instaSTAT") {
                $dbstoragedata = "6";
            } elseif ($appPackage == "Instant") {
                $dbstoragedata = "7";
            }

            $rules = [
                'package_name' => 'required',
                'plan_id' => 'required',
                'package_type' => 'required',
                'price' => 'required|regex:/^\d*(\.\d{1,2})?$/',
                'quantity' => 'required|regex:/^\d+(,\d{1,2})?$/',
            ];
            $message = [
                'package_name' => 'Please Enter package_name',
                'plan_id' => 'Please Enter plan_id',
                'price' => 'Please Enter price',
                'package_type' => 'Please Enter package_type',
                'quantity' => 'Please Enter quantity',
            ];
            $validator = validator::make($request->input(), $rules, $message);
            if ($validator->fails()) {
                return back()->WithErrors($validator)->WithInput();
            }
            $fillable = array();
            $fillable['package_name'] = $request->input('package_name');
            $fillable['plan_id'] = $request->input('plan_id');
            $fillable['price'] = $request->input('price');
            $fillable['package_for'] = $dbstoragedata;
            $fillable['quantity'] = $request->input('quantity');
            $fillable['package_type'] = $dbDemodata;
            $fillable['package_status'] = 1;
            $objModelPackages = new Package();
            $result = $objModelPackages->addPackages($fillable);
//           dd($result);
            if ($result) {
                return back()->with('packageMsg', 'Package  has been added successfully.');

//                return redirect('/admin/AddingPackages/{appPackage?}')->with('packageMsg', 'Package  has been added successfully.');
            } else {
                return back('/admin/AddingPackages/{appPackage?}')->with('packageMsg', 'Something went wrong, please try after sometime.');

            }

        }

        $objModelOfPlan = new Plan();
        $planDetails = $objModelOfPlan->getPlanDetails(['rawQuery' => 'status =1']);
        $planDetails = json_decode(json_encode($planDetails), true);


        return view('Admin::package/addPackage', ['appPackage' => $appPackage, 'plans' => $planDetails]);
    }






    /**
     * @Desc:DeleteAjaxHandelerPackage
     * @param Request $request
     * @since 25/7/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function DeleteAjaxHandelerPackageDetails(Request $request)
    {
        if ($request->isMethod('post')) {
            $package_id = $request->input('package_id');
            $objModelPackage = new Package();
            $whereForDelete = array(
                'rawQuery' => 'package_id = ?',
                'bindParams' => [$package_id]
            );
            $objModelPackage = $objModelPackage->deletePackage($whereForDelete);
            if ($objModelPackage) {
                echo json_encode(array('status' => '200', 'message' => 'Record has been successfully deleted'));
            } else {
                echo json_encode(array('status' => '400', 'message' => 'error'));
            }
        }
    }



    public function GetAddPackages(Request $request)
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





