<?php

namespace App\Modules\Admin\Controllers;

use App\Modules\Admin\Models\Admin;
use App\Modules\Admin\Models\DBClass;
use App\Modules\Admin\Models\manage;

use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Session;
//use Yajra\Datatables\Datatables;
use Illuminate\Validation\Rule;
use users;
use DataTables;
use App\User;

//class UserController extends Controller
class UserController extends Controller
{
    /**
     * @param Request $request
     * @since 29/jan 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function addUser(Request $request, $appName)
    {

        if ($request->isMethod('post')) {
            global $dbstoragedata;
            if ($appName === "GILE") {
                $dbstoragedata = "1";
            } elseif ($appName === "GILR") {
                $dbstoragedata = "2";
            } elseif ($appName === "GIVE") {
                $dbstoragedata = "3";
            } elseif ($appName === "GIVR") {
                $dbstoragedata = "4";
            } elseif ($appName == "AUTOIG") {
                $dbstoragedata = "5";
            } elseif ($appName == "INSTASTAT") {
                $dbstoragedata = "6";
            } elseif ($appName == "Instant") {
                $dbstoragedata = "7";
            }

            $rules = [
                'email' => ['required', Rule::unique('users')->where('registered_through', $dbstoragedata)],
                'username' => ['required', 'regex:/^[a-zA-Z0-9_.-]*$/', Rule::unique('users')->where('registered_through', $dbstoragedata)],
//                'username' => 'required', 'regex:/^[a-zA-Z0-9]*([a-zA-Z][0-9]|[0-9][a-zA-Z])[a-zA-Z0-9]*$/',
//                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
            ];
            $message = [
                'username' => 'Please Enter username',
                'email' => 'Please Enter valid email',
                'password' => 'Please Enter password',
            ];

            $validator = validator::make($request->input(), $rules, $message);
            if ($validator->fails()) {
                return back()->WithErrors($validator)->WithInput();
            }
            try {
                $fillable = array();
                $fillable['username'] = $request->input('username');
                $fillable['user_free_package'] = 0;
                $fillable['device_id'] = 0;
                $fillable['registered_through'] = $dbstoragedata;
                $fillable['email'] = $request->input('email');
                $fillable['password'] = Hash::make($request->input('password'));
                $fillable['device_type'] = 0;
                $fillable['rated_app'] = 0;
                $fillable['role'] = "1";
                $fillable['status'] = 0;
                $fillable['created_at'] = time();;
                $fillable['updated_at'] = time();;

                $objModelUsers = new Admin();
                $result = $objModelUsers->addUsers($fillable);
//            dd($result);
                if ($result) {
                    return back()->with('UserMsg', 'NewUser  has been added successfully.');
                } else {
                    return back()->with('UserMsg', 'Something went wrong, please try after sometime.');

                }
            } catch (QueryException $exc) {
                dd($exc->getMessage());
            }

        }
        return view('Admin::Users/adduser', ['appName' => $appName]);

    }


    /**
     * @Desc:satusChange in available users
     * @param Request $request
     * @since 29/jan 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function satusChange(Request $request)
    {
        if ($request->isMethod('post')) {

            $admindataparse = new Admin();
            $whereForUpdate = ['rawQuery' => 'id = ?', 'bindParams' => [$request->input('id')]];

            $dataToUpdate = ['status' => $request->input('status')];
            $updated = $admindataparse->AvailableDataUpdate($whereForUpdate, $dataToUpdate);

            if ($updated)

                echo json_encode(['status' => 200, 'message' => ' Action Performed Successfully']);
            else echo json_encode(['status' => 400, 'message' => 'Something went wrong, please try again.']);

        } else {

            echo json_encode(['status' => 401, 'message' => 'Request not allowed, Only post request is allowed']);
        }

    }


    /**
     * @Desc :getUserDetails functionality
     * @since 29/jan/ 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */

    public function getEditAjaxHandeler(Request $request)
    {
        if ($request->isMethod('post')) {

            $objAdminModel = new Admin();
            $userDetails = $objAdminModel->fetchid($request->input('userId'));
            $userDetails = json_decode(json_encode($userDetails), true);
            if ($userDetails)
                echo json_encode(['status' => 200, 'msg' => 'User details found.', 'data' => $userDetails]);
            else
                echo json_encode(['status' => 400, 'msg' => 'User details not found.']);
        } else {
            echo json_encode(['status' => 401, 'msg' => 'Request couldnt be completed,Only post method is allowed.']);
        }

    }

    /**
     * @Desc getUpdatEdit
     * @since 5/feb/ 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */

    public function getUpdateEdit(Request $request)
    {
        if ($request->isMethod('post')) {
            $postData = $request->all();
            $admindataparse = new Admin();
            $whereForUpdate = ['rawQuery' => 'id = ?', 'bindParams' => [$postData['userId']]];
            unset($postData['userId']);
            $updated = $admindataparse->updateEdit($whereForUpdate, $postData);
            if ($updated)
                echo json_encode(['status' => 200, 'message' => 'Updated successfully.']);
            else
                echo json_encode(['status' => 400, 'message' => 'Something went wrong, please try again.']);
        } else
            echo json_encode(['status' => 401, 'message' => 'Request not allowed, Only post request is allowed']);
    }


    /**
     * @Desc:manageUserData functionality
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since 5 feb  2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function manageUserData($method)
    {
        if ($method === 'GILE') {
            return view('Admin::Users/manageUserGILE');
        } else if ($method === 'GILR') {
            return view('Admin::Users/manageUserGILR');
        } else if ($method === 'GIVE') {
            return view('Admin::Users/manageUserGIVE');
        } else if ($method === 'GIVR') {
            return view('Admin::Users/manageUserGIVR');
        } else if ($method === 'AUTOIG') {
            return view('Admin::Users/manageUserAutoIG');
        } else if ($method === 'INSTASTAT') {
            return view('Admin::Users/manageUserInstaStart');
        } else if ($method === 'GILE') {
            return view('Admin::Users/manageFlashNews');
        } else if ($method === 'Instant') {
            return view('Admin::Users/manageUserInstant');
        }

    }


    /**
     * @Desc:manageAjaxHandler  functionality .
     * @param Request $request
     * @since 5 feb 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function manageAjaxHandler(Request $request)
    {
        $requestParam = $request->all();
        $objUserModel = new Admin();
        $whereCond = [
            'rawQuery' => 'role = 1',
        ];


        $method = $request->input('method');

        switch ($method) {
            case'GILE':
                $whereCond = [
                    'rawQuery' => 'role = 1 and registered_through=1',
                ];
                break;

            case'GILR':
                $whereCond = [
                    'rawQuery' => 'role=1 and registered_through=2'
                ];
                break;
            case'GIVE':
                $whereCond = [
                    'rawQuery' => 'role = 1 and registered_through = 3',
                ];
                break;
            case'GIVR':
                $whereCond = [
                    'rawQuery' => 'role = 1 and registered_through = 4',
                ];
                break;
            case'AUTOIG':
                $whereCond = [
                    'rawQuery' => 'role = 1 and registered_through = 5',
                ];
                break;
            case 'INSTASTAT':
                $whereCond = [
                    'rawQuery' => 'role = 1 and registered_through = 6',
                ];

                break;
            case 'Instant':
                $whereCond = [
                    'rawQuery' => 'role = 1 and registered_through = 7',
                ];

                break;
            default:

                break;
        }


        //GET TOTAL NUMBER OF NEW ORDERS
        $iTotalRecords = count($objUserModel->getUserDetails($whereCond));
        $iTotalFilteredRecords = $iTotalRecords;

        $iDisplayLength = intval($requestParam['length']);
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        $iDisplayStart = intval($requestParam['start']);
        $sEcho = intval($requestParam['draw']);

        $records = array();
        $records["data"] = array();

        $columns = array(
            'users.id',
            'users.username',
            'users.email',
            'users.created_at',
            'users.status',
            'users.registered_through',
        );

        $sortingOrder = "";
        if (isset($requestParam['order'])) {
            $sortingOrder = [$columns[$requestParam['order'][0]['column'] - 1], $requestParam['order'][0]['dir']];
        }

        if (isset($requestParam["customActionType"]) && $requestParam["customActionType"] == "group_action") {
            if ($requestParam['customActionName'] != '' && !empty($requestParam['id'])) {
                $insUsersId = $requestParam['id'];

                if ($requestParam['customActionName'] == 'inactive') {
                    $messages = array();
                    $count = 1;
                    foreach ($insUsersId as $key => $UsersId) {
                        $username = $objUserModel->getUserDetailsDatabase(['rawQuery' => 'id=?', 'bindParams' => [$UsersId]]);
                        $result = $objUserModel->updateUser(['rawQuery' => 'id=?', 'bindParams' => [$UsersId]], ['status' => 2]);

                        if ($result) {
                            $messages[0] = $count . "  User status has been Inactive. <br>";
//                            $messages[$key + 1] = '<span style="margin-left: 5%">Id&nbsp;&nbsp; <i class="fa fa-instagram"><b>&nbsp;' . $username[0]->id . '</b></i></span> <br>';
                            $count++;
                        } else {
                            $messages[$key + 1] = 'There is a problem in Cancel ' . $username[0]->id . ' profile. <br>';
                        }
                    }
                    $records["customActionStatus"] = "OK";
                    $records["customActionMessage"] = $messages;

                } elseif ($requestParam['customActionName'] == 'active') {
                    $messages = array();
                    $count = 1;
                    foreach ($insUsersId as $key => $UsersId) {
                        $username = $objUserModel->getUserDetailsDatabase(['rawQuery' => 'id=?', 'bindParams' => [$UsersId]]);
                        $result = $objUserModel->updateUser(['rawQuery' => 'id=?', 'bindParams' => [$UsersId]], ['status' => 1]);

                        if ($result) {
                            $messages[0] = $count . "  User status has been Active. <br>";
//                            $messages[$key + 1] = '<span style="margin-left: 5%">Id:&nbsp;&nbsp; <i class="fa fa-times"><b>&nbsp;' . $username[0]->id . '</b></i></span> <br>';
                            $count++;
                        } else {
                            $messages[$key + 1] = 'There is a problem in Cancel ' . $username[0]->id . ' profile. <br>';
                        }
                    }
                    $records["customActionStatus"] = "OK";
                    $records["customActionMessage"] = $messages;
                } elseif ($requestParam['customActionName'] == 'delete') {
                    $messages = array();
                    $count = 1;
                    foreach ($insUsersId as $key => $UsersId) {
                        $username = $objUserModel->getUserDetailsDatabase(['rawQuery' => 'id=?', 'bindParams' => [$UsersId]]);
                        $result = $objUserModel->deleteUsers(['rawQuery' => 'id=?', 'bindParams' => [$UsersId]]);

                        if ($result) {
                            $messages[0] = $count . "  User  has been Deleted. <br>";
//                            $messages[$key + 1] = '<span style="margin-left: 5%">Id:&nbsp;&nbsp; <i class="fa fa-times"><b>&nbsp;' . $username[0]->id . '</b></i></span> <br>';
                            $count++;
                        } else {
                            $messages[$key + 1] = 'There is a problem in Cancel ' . $username[0]->id . ' profile. <br>';
                        }
                    }
                    $records["customActionStatus"] = "OK";
                    $records["customActionMessage"] = $messages;
                }

            }
        }

        $filteringRules = [];
        if (isset($requestParam['action']) && $requestParam['action'] == 'filter' && $requestParam['action'][0] != 'filter_cancel') {
            if ($requestParam['search_id'] != '') {
                $filteringRules[] = "(users.id LIKE '%" . $requestParam['search_id'] . "%' )";
            }

            if ($requestParam['search_username'] != '') {
                $filteringRules[] = "(users.username LIKE '%" . $requestParam['search_username'] . "%' )";
            }

            if ($requestParam['search_email'] != '') {
                $filteringRules[] = "(users.email LIKE '%" . $requestParam['search_email'] . "%' )";
            }

            if ($requestParam['search_created_at'] != '') {
                $filteringRules[] = "(users.created_at  LIKE '%" . $requestParam['search_created_at'] . "%' )";
            }

            if ($requestParam['search_status'] != '') {
                $filteringRules[] = "(users.status LIKE '%" . $requestParam['search_status'] . "%' )";
            }
            if (!empty($filteringRules)) {
                $whereCond['rawQuery'] .= " AND " . implode(" AND ", $filteringRules);
            }
        }

        $result = $objUserModel->getAllFilterUsers($whereCond, $sortingOrder, $iDisplayStart, $iDisplayLength);
        $result = json_decode(json_encode($result), true);


        foreach ($result as $key => $value) {


            $details = ' <a href="javascript:;" style="margin-left:10px;" class="show-details" data-toggle="modal" title="Details" data-target="#showDetails" data-id="' . $value['id'] . '">
                                        <button class="btn btn-xs btn-primary"><i class="fa fa-eye"></i></button>&nbsp;

                                           </a>';
            $details = $details . '<a href="javascript:;" class="editUserdetails" style="margin-left: -4%;" data-toggle="modal" title="Edit" data-target="#editUserModal" data-id="' . $value['id'] . '" xmlns="http://www.w3.org/1999/html">
                                            <button class="btn btn-xs btn-info"><i class="fa fa-pencil-square-o "></i></button>
                                           </a>';
            $details = $details . '<a href="javascript:;"><button class="btn btn-xs btn-dark" id="deleteCommnet" title="Delete" data-id=' . $value['id'] . '><i class="fa fa-trash"></i></button></a>';

            $edit = ' <a href="javascript:;" class="editUserdetails" data-toggle="modal"data-target="#editUserModal" data-id="' . $value['id'] . '">
                                             <i class="fa fa-pencil-square-o"></i></span>
                                           </a>';
            $delete = '<a href="javascript:;"><i class="fa fa-trash" id="deleteCommnet"  data-id=' . $value['id'] . '></i></a>';

            $status = '';
            if ($value['status'] == 2) {
                $status = '<a data-id="' . $value['id'] . '" data-status="1"
                           class="changeStatus label label-danger" style="cursor:pointer;">Inactive</a></td>';
            } else if ($value['status'] == 1) {
                $status = '<a data-id="' . $value['id'] . '" data-status="2"
                       class="changeStatus label label-success" style="cursor:pointer;">Active</a></td>';
            } else if ($value['status'] == 0) {
                $status = '<a data-id="' . $value['id'] . '" data-status="0"
                       class="changeStatus label label-warning" style="cursor:pointer;">Pending</a></td>';
            }
            $created_at = $this->convertEpoachToDateTime($value['created_at']);
            $records['data'][] = array(
                '<input type="checkbox" id="groupCheckbox" class="orderCheckBox" name="userId[]" value="' . $value['id'] . '">',
                $value['id'],
                $value['username'],
                '<p class="link-width" title="' . $value['email'] . '"><i style="font-size:10px" class="fa fa-envelope"></i>&nbsp;' . $value['email'] . '</p>',
                $created_at,
                $status,
                $details,
                $edit,
                $delete,
            );
        }
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords; //$iTotalFilteredRecords
        echo json_encode($records, true);

    }


    /**
     * @Desc getMoreUsersDetails
     * @param Request $request
     * @since 14 feb 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */

    public function getMoreUsersDetails(Request $request)
    {
        if ($request->isMethod('post')) {
            $objAdminModel = new Admin();
            $select = [DB::raw('CASE   
         WHEN registered_through = 1 THEN \'Get Instant Likes En\'
         WHEN registered_through = 2 THEN \'Get instant Likes Ru\'
         WHEN registered_through = 3 then \'Get instant Views En\'
         WHEN registered_through = 4 then \'Get Insant views RU\'
         WHEN registered_through = 5 then \'AUTOIG \'
         WHEN registered_through = 6 then \'INSTASTATS\'
         WHEN registered_through = 7 then \'Instant\'
         END  as registered_through'),
                DB::raw('CASE 
          WHEN rated_app=0 THEN \'not rated\'
          WHEN rated_app=1 THEN\'rated app\'
          WHEN rated_app=2 THEN\'rated and got free package\'
          END as rated_app'),
                DB::raw('CASE 
                WHEN device_type=0 THEN \'web(admin)\'
                WHEN device_type=1 THEN \'android \'
                WHEN device_type=2 THEN \'iOS\' END as device_type'),
                DB::raw('CASE 
                WHEN status=0 THEN \' pending \'
                WHEN status=1 THEN \'active\'
                WHEN status=2 THEN \'inactive \'
                WHEN status=3 THEN \'rejected \'
                END as status'),
                'username', 'email', 'created_at'];

            $userDetails = $objAdminModel->fetchid($request->input('userId'), $select);
            $userDetails = json_decode(json_encode($userDetails), true);
            if (isset($userDetails) && !empty($userDetails))
                echo json_encode(['status' => 200, 'msg' => 'Details Fetch Sucessfully .', 'userDetails' => $userDetails]);
            else
                echo json_encode(['status' => 400, 'msg' => 'User details not found.']);
        } else {
            echo json_encode(['status' => 401, 'msg' => 'Request couldnt be completed,Only post method is allowed.']);
        }
    }


    public function editAjaxhandlerUser(Request $request)
    {
        if ($request->isMethod('post')) {
            $objAdminModel = new Admin();
            $userDetails = $objAdminModel->fetchid($request->input('userId'));
            $userDetails = json_decode(json_encode($userDetails), true);
            //dd($userDetails);
            if ($userDetails)
                echo json_encode(['status' => 200, 'msg' => 'User details Found sucessfully.', 'data' => $userDetails]);
            else
                echo json_encode(['status' => 400, 'msg' => 'User details not found.']);
        } else {
            echo json_encode(['status' => 401, 'msg' => 'Request couldnt be completed,Only post method is allowed.']);
        }


    }

    public function getUpdateAjaxHandler(Request $request)
    {
        if ($request->isMethod('post')) {

            $postData = $request->all();
            $edited_user_id = $postData['userId'];
            $password = Hash::make($request->input('password'));
            $admindataparse = new Admin();
            $whereForUpdate = ['rawQuery' => 'id = ?', 'bindParams' => [$postData['userId']]];

            if ($request->input('password'))
                $postData['password'] = Hash::make($request->input('password'));
            unset($postData['userId']);
            $validator = Validator::make($request->all(), [
//                'username' => 'required|min:4|unique:users,username,'.$edited_user_id, 'regex:/^[a-zA-Z0-9]*([a-zA-Z][0-9]|[0-9][a-zA-Z])[a-zA-Z0-9]*$/',
//                'email' => 'required|string|email|max:255|unique:users,email,'.$edited_user_id,//
//
                'username' => ['required', 'min:4', Rule::unique('users')->ignore($edited_user_id)->where('registered_through', $postData['registered_through'])],
                'email' => ['required', Rule::unique('users')->ignore($edited_user_id)->where('registered_through', $postData['registered_through'])],


            ]);
            if ($validator->fails()) {
                echo json_encode(['status' => 400, 'message' => array_values(json_decode($validator->messages(), true))[0][0]]);
                die;
            }
            $updated = $admindataparse->updateEdit($whereForUpdate, $postData);
            if ($updated) {
                echo json_encode(['status' => 200, 'message' => 'successfully saved.']);
            } else if ($updated == 0) {
                echo json_encode(['status' => 201, 'message' => 'You have made no changes to save.']);
            } else
                echo json_encode(['status' => 400, 'message' => 'Something went wrong, please try again.']);
        } else {
            echo json_encode(['status' => 401, 'message' => 'Request not allowed, Only post request is allowed']);
        }
    }


    public function getUpdatePasswordAjaxHandler(Request $request)
    {
        if ($request->isMethod('post')) {


            $postData = $request->all();
            $password = Hash::make($request->input('password'));

            $admindataparse = new Admin();
            $whereForUpdate = ['rawQuery' => 'id = ?', 'bindParams' => [$postData['userId']]];

            if ($request->input('password'))
                $postData['password'] = Hash::make($request->input('password'));
            unset($postData['userId']);

            $updated = $admindataparse->updateEdit($whereForUpdate, $postData);
            if ($updated) {
                echo json_encode(['status' => 200, 'message' => 'Updated successfully Update Users.']);
            } else if ($updated == 0) {
                echo json_encode(['status' => 201, 'message' => 'You have made no changes to save.']);
            } else
                echo json_encode(['status' => 400, 'message' => 'Something went wrong, please try again.']);
        } else {
            echo json_encode(['status' => 401, 'message' => 'Request not allowed, Only post request is allowed']);
        }
    }

    /**
     * @Desc:DeleteAjaxHandeler
     * @param Request $request
     * @since: 24/7/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function DeleteAjaxHandeler(Request $request)
    {
        if ($request->isMethod('post')) {
            $id = $request->input('id');
            $objModelAdmin = new Admin();
            $whereForDelete = array(
                'rawQuery' => 'id = ?',
                'bindParams' => [$id]
            );
            $objModelAdmin = $objModelAdmin->deleteUsers($whereForDelete);
            if ($objModelAdmin) {
                echo json_encode(array('status' => '200', 'message' => 'user  has been successfully deleted'));
            } else {
                echo json_encode(array('status' => '400', 'message' => 'error'));
            }
        }
    }

    /**
     * @Desc: convertEpoachToDateTime
     * @param $dateTime
     * @return string
     * @since   20 june  2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function convertEpoachToDateTime($dateTime)
    {
        if ($dateTime == 0) {
            return '-';
        }
        $indivisual = time() - $dateTime;
        $data = '';
        if ($indivisual < 1) {
            return '0 secs';
        }
        $Timevalue = array(365 * 24 * 60 * 60 => 'year',
            30 * 24 * 60 * 60 => 'month',
            24 * 60 * 60 => 'day',
            60 * 60 => 'hour',
            60 => 'min',
            1 => 'sec'
        );
        $DateTimeEpoch = array('year' => 'years',
            'month' => 'months',
            'day' => 'days',
            'hour' => 'hours',
            'min' => 'mins',
            'sec' => 'secs'
        );

        foreach ($Timevalue as $secs => $str) {
            $datePerDay = $indivisual / $secs;
            if ($datePerDay >= 1) {
                $roundPerDay = round($datePerDay);
                return $data . $roundPerDay . ' ' . ($roundPerDay > 1 ? $DateTimeEpoch[$str] : $str);
            }
        }
    }

//for GILR
    /**
     * @Desc:activityLogs
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since 29/9/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function activityLogs(Request $request)
    {
        /* Fetch the list of recent users or device_id */
        $_db = new DBClass();
        if (isset($request['searchKey']) && $request['searchKey'] != "") {
            $recentActivities = $_db->selectQueryBySort('activities', ['rawQuery' => "username LIKE '%" . $request['searchKey'] . "%' or email  LIKE '%" . $request['searchKey'] . "%' or device_id  LIKE '%" . $request['searchKey'] . "%' or user_id  LIKE '%" . $request['searchKey'] . "%'"], ['*'], '100', ['column' => 'updated_at', 'order' => 'desc']);
        } else {
            $recentActivities = $_db->selectQueryBySort('activities', ['rawQuery' => '1=1'], ['*'], '100', ['column' => 'updated_at', 'order' => 'desc']);
        }

        $recentMessage = [];
        if (!empty($recentActivities)) {
            $recentMessage = $recentActivities[0]['message'];
            $recentMessage = json_decode($recentMessage, true);
        }

        return view('Admin::Users.activitylog', ['recentActivity' => $recentActivities, 'recentMessage' => $recentMessage]);
    }



    public function getActivityDetails(Request $request)
    {
        $activity_id = json_decode($request->all()['activity_id']);

        $_db = new DBClass();
        $activityDetails = $_db->selectQuery('activities', ['rawQuery' => 'activity_id = ?', 'bindParams' => [$activity_id]], ['*']);

        $recentMessage = [];
        if (!empty($activityDetails)) {
            $recentMessage = $activityDetails[0]['message'];
            $recentMessage = json_decode($recentMessage, true);
        }
        echo json_encode(['status' => 200, 'message' => $recentMessage]);
    }

    public function activityLogsAjaxHandler()
    {
        /* Fetch the list of recent users or device_id */
        $_db = new DBClass();
        $recentActivities = $_db->selectQueryBySort('activities', ['rawQuery' => '1=1'], ['*'], '100', ['column' => 'updated_at', 'order' => 'desc']);

        if (!empty($recentActivities)) {
            echo json_encode(['status' => 200, 'activityLists' => $recentActivities]);
        } else {
            echo json_encode(['status' => 400, 'activityLists' => []]);
        }
    }


//for Autoig
    public function activityLogsAutoig(Request $request)
    {
        $_db = new DBClass();
        if (isset($request['searchKey']) && $request['searchKey'] != "") {
            $recentActivities = $_db->selectQueryBySort('activities_autoig', ['rawQuery' => "username LIKE '%" . $request['searchKey'] . "%' or email  LIKE '%" . $request['searchKey'] . "%' or device_id  LIKE '%" . $request['searchKey'] . "%' or user_id  LIKE '%" . $request['searchKey'] . "%'"], ['*'], '100', ['column' => 'updated_at', 'order' => 'desc']);
        } else {
            $recentActivities = $_db->selectQueryBySort('activities_autoig', ['rawQuery' => '1=1'], ['*'], '100', ['column' => 'updated_at', 'order' => 'desc']);
        }

        $recentMessage = [];
        if (!empty($recentActivities)) {
            $recentMessage = $recentActivities[0]['message'];
            $recentMessage = json_decode($recentMessage, true);
        }

        return view('Admin::Users.activitylogAutoig', ['recentActivity' => $recentActivities, 'recentMessage' => $recentMessage]);
    }


    public function getActivityDetailsAutoig(Request $request)
    {

        $activity_id = json_decode($request->all()['activity_id']);

        $_db = new DBClass();

        $activityDetails = $_db->selectQuery('activities_autoig', ['rawQuery' => 'activity_id = ?', 'bindParams' => [$activity_id]], ['*']);


        $recentMessage = [];
        if (!empty($activityDetails)) {
            $recentMessage = $activityDetails[0]['message'];
            $recentMessage = json_decode($recentMessage, true);

        }

        echo json_encode(['status' => 200, 'message' => $recentMessage]);
    }


    public function activityLogsAjaxHandlerAutoig()
    {

        $_db = new DBClass();
        $recentActivities = $_db->selectQueryBySort('activities_autoig', ['rawQuery' => '1=1'], ['*'], '100', ['column' => 'updated_at', 'order' => 'desc']);

//      dd($recentActivities);
        if (!empty($recentActivities)) {
            echo json_encode(['status' => 200, 'activityList' => $recentActivities]);

        } else {
            echo json_encode(['status' => 400, 'activityLists' => []]);
        }

    }


//for GIVR
    public function activityLogsGivr(Request $request)
    {
        $_db = new DBClass();
        if (isset($request['searchKey']) && $request['searchKey'] != "") {

            $recentActivities = $_db->selectQueryBySort('activities_givr', ['rawQuery' => "username LIKE '%" . $request['searchKey'] . "%' or email  LIKE '%" . $request['searchKey'] . "%' or device_id  LIKE '%" . $request['searchKey'] . "%' or user_id  LIKE '%" . $request['searchKey'] . "%'"], ['*'], '100', ['column' => 'updated_at', 'order' => 'desc']);

        } else {
            $recentActivities = $_db->selectQueryBySort('activities_givr', ['rawQuery' => '1=1'], ['*'], '100', ['column' => 'updated_at', 'order' => 'desc']);
        }
        $recentMessage = [];
        if (!empty($recentActivities)) {
            $recentMessage = $recentActivities[0]['message'];
            $recentMessage = json_decode($recentMessage, true);
        }

        return view('Admin::Users.activityLogGivr', ['recentActivity' => $recentActivities, 'recentMessage' => $recentMessage]);
    }



    public function getActivityDetailsGivr(Request $request)
    {
        $activity_id = json_decode($request->all()['activity_id']);

        $_db = new DBClass();

        $activityDetails = $_db->selectQuery('activities_givr', ['rawQuery' => 'activity_id = ?', 'bindParams' => [$activity_id]], ['*']);


        $recentMessage = [];
        if (!empty($activityDetails)) {
            $recentMessage = $activityDetails[0]['message'];
            $recentMessage = json_decode($recentMessage, true);

        }

        echo json_encode(['status' => 200, 'message' => $recentMessage]);
    }



    public function activityLogsAjaxHandlerGivr()
    {
        $_db = new DBClass();
        $recentActivities = $_db->selectQueryBySort('activities_givr', ['rawQuery' => '1=1'], ['*'], '100', ['column' => 'updated_at', 'order' => 'desc']);

        if (!empty($recentActivities)) {
            echo json_encode(['status' => 200, 'activityList' => $recentActivities]);

        } else {
            echo json_encode(['status' => 400, 'activityLists' => []]);
        }

    }

}



