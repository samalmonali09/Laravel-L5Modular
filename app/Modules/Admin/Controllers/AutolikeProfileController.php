<?php


namespace App\Modules\Admin\Controllers;

use App\Modules\Admin\Models\Autolike;
use App\Modules\Admin\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use users;
use DataTables;

class AutolikeProfileController extends Controller
{

    public function ProfileDatatTable(Request $request)
    {
        $data = DB::table('autolikes_orders')->get();
        return view('Admin::Autolike/AutolikeProfile', ['data' => $data]);
    }

    /**
     * @Desc: AutolikesAjaxHandeler
     * @param Request $request
     * @since 12/7/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function AutolikesAjaxHandeler(Request $request)
    {
        $requestParam = $request->all();
        $objUserModel = new Autolike();
        $whereCond = [
            'rawQuery' => '1',
        ];


        $iTotalRecords = count($objUserModel->getAutolikesDetails($whereCond));
        $iTotalFilteredRecords = $iTotalRecords;
        $iDisplayLength = intval($requestParam['length']);
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        $iDisplayStart = intval($requestParam['start']);
        $sEcho = intval($requestParam['draw']);

        $records = array();
        $records["data"] = array();

        $columns = array(
            'autolikes_orders.autolikes_id',
            'autolikes_orders.insta_username',
            'autolikes_orders.profile_image',
            'subscription_packages.quantity',
            'autolikes_orders.post_limit',
            'autolikes_orders.post_done',
            'autolikes_orders.daily_post_limit',
            'autolikes_orders.daily_post_done',
            'autolikes_orders.created_at',
            'autolikes_orders.last_checked_time',
            'autolikes_orders.status',
        );
        $sortingOrder = "";
        if (isset($requestParam['order'])) {
            $sortingOrder = [$columns[$requestParam['order'][0]['column'] - 1], $requestParam['order'][0]['dir']];
        }

        if (isset($requestParam["customActionType"]) && $requestParam["customActionType"] == "group_action") {
            if ($requestParam['customActionName'] != '' && !empty($requestParam['AutolikeId'])) {
                $orderIds = $requestParam['AutolikeId'];
                if ($requestParam['customActionName'] == 'cancel_order') {

                    $messages = array();
                    $count = 1;
                    foreach ($orderIds as $key => $AutolikeId) {
                        $username = $objUserModel->getAutolikesDetailsProfile(['rawQuery' => 'autolikes_id=?', 'bindParams' => [$AutolikeId]]);
                        $result = $objUserModel->UpdateAutolikes(['rawQuery' => 'autolikes_id=?', 'bindParams' => [$AutolikeId]], ['status' => 3]);

                        if ($result) {
                            $messages[0] = $count . "account Has been cancelled. <br>";
//                            $messages[$key + 1] = '<span style="margin-left: 5%">Profile:&nbsp;&nbsp; <i class="fa fa-instagram"><b>&nbsp;' . $username[0]->autolikes_id . '</b></i></span> <br>';
                            $count++;
                        } else {
                            $messages[$key + 1] = 'There is a problem in Cancel ' . $username[0]->autolikes_id . ' profile. <br>';
                        }
                    }
                    $records["customActionStatus"] = "OK";
                    $records["customActionMessage"] = $messages;
                }else if ($requestParam['customActionName'] == 'paused_order') {

                    $messages = array();
                    $count = 1;
                    foreach ($orderIds as $key => $autolikeId) {
                        $username = $objUserModel->getAutolikesDetailsProfile(['rawQuery' => 'autolikes_id=?', 'bindParams' => [$autolikeId]]);
                        $result = $objUserModel->UpdateAutolikes(['rawQuery' => 'autolikes_id=?', 'bindParams' => [$autolikeId]], ['status' => 5]);

                        if ($result) {
                            $messages[0] = $count . "Profile Has been paused. <br>";
//                            $messages[$key + 1] = '<span style="margin-left: 5%">Profile:&nbsp;&nbsp; <i class="fa fa-paused"><b>&nbsp;' . $username[0]->autolikes_id . '</b></i></span> <br>';
                            $count++;
                        } else {
                            $messages[$key + 1] = 'There is a problem in paused ' . $username[0]->autolikes_id . ' profile. <br>';
                        }
                    }
                    $records["customActionStatus"] = "OK";
                    $records["customActionMessage"] = $messages;
                }else if($requestParam['customActionName']=='Restart_order'){

                    $messages=array();
                    $count=1;
                    foreach ($orderIds as $key=>$autolikeId){
                        $username=$objUserModel->getAutolikesDetailsProfile(['rawQuery'=>'autolikes_id=?','bindParams'=>[$autolikeId]]);
                        $result=$objUserModel->UpdateAutolikes(['rawQuery'=>'autolikes_id','bindParams'=>[$autolikeId]],['status'=> 1]);

                        if($result){
                            $messages[0]=$count. "Profile Has been Running.<br>";
//                            $messages[$key + 1] = '<span style="margin-left: 5%">Profile:&nbsp;&nbsp; <i class="fa fa-paused"><b>&nbsp;' . $username[0]->autolikes_id . '</b></i></span> <br>';
                          $count++;

                        }else{
                            $messages[$key+1]='There is a Problem in Restart'.$username[0]->autolikes_id.'profile.<br>';
                        }
                    }

                    $records["customActionStatus"]="OK";
                    $records["customActionMessage"]=$messages;
                } else if ($requestParam['customActionName'] == 'Remove') {

                    $messages = array();
                    $count = 1;
                    foreach ($orderIds as $key => $autolikeId) {
                        $username = $objUserModel->getAutolikesDetailsProfile(['rawQuery' => 'autolikes_id=?', 'bindParams' => [$autolikeId]]);
                        $result = $objUserModel->deleteAutolikes(['rawQuery' => 'autolikes_id=?', 'bindParams' => [$autolikeId]]);

                        if ($result) {
                            $messages[0] = $count . "Order Has been Deleted. <br>";
//                            $messages[$key + 1] = '<span style="margin-left: 5%">Profile:&nbsp;&nbsp; <i class="fa fa-instagram"><b>&nbsp;' . $username[0]->package_id . '</b></i></span> <br>';
                            $count++;
                        } else {
                            $messages[$key + 1] = 'There is a problem in Deleted ' . $username[0]->autolikes_id . ' profile. <br>';
                        }
                    }
                    $records["customActionStatus"] = "OK";
                    $records["customActionMessage"] = $messages;

                }else if ($requestParam['customActionName']=='Reset_TotalCounter'){

                    $messages=array();
                    $count=1;
                    foreach ($orderIds as $key=> $autolikeId){
                        $username=$objUserModel->getAutolikesDetailsProfile(['rawQuery'=>'autolikes_id','bindParams'=>[$autolikeId]]);
                        $result=$objUserModel->UpdateAutolikes(['rawQuery'=>'autolikes_id=?','bindParams'=>[$autolikeId]],['reset_counter_time' => time(),'post_done'=>0,'post_fetch_count'=>0,'daily_post_done'=>0]);
                        if ($result) {
                            $messages[0] = $count . "Profile Has been updated. <br>";
//                            $messages[$key + 1] = '<span style="margin-left: 5%">Profile:&nbsp;&nbsp; <i class="fa fa-instagram"><b>&nbsp;' . $username[0]->autolikes_id . '</b></i></span> <br>';
                            $count++;
                        } else {
                            $messages[$key + 1] = 'There is a problem in Updated ' . $username[0]->autolikes_id . ' profile. <br>';
                        }


                    }
                    $records["customActionStatus"] = "OK";
                    $records["customActionMessage"] = $messages;

                }else if($requestParam['customActionName']=='Reset_DailyCounter'){

                    $messages=array();
                    $count=1;
                    foreach ($orderIds as $key=>$autolikeId){
                        $username=$objUserModel->getAutolikesDetailsProfile(['rawQuery'=>'autolikes_id','bindParams'=>[$autolikeId]]);
                        $result=$objUserModel->UpdateAutolikes(['rawQuery'=>'autolikes_id=?','bindParams'=>[$autolikeId]],['daily_post_done'=>0,'reset_counter_time'=>time()]);

                        if($result){
                            $messages[0]=$count."Profile Has been Reset Daily Counter.<br>";
//                            $messages[$key + 1] = '<span style="margin-left: 5%">Profile:&nbsp;&nbsp; <i class="fa fa-instagram"><b>&nbsp;' . $username[0]->autolikes_id . '</b></i></span> <br>';
                             $count++;
                        }else{
                            $messages[$key + 1] = 'There is a problem in Updated ' . $username[0]->autolikes_id . ' profile. <br>';
                        }
                    }
                    $records["customActionStatus"] = "OK";
                    $records["customActionMessage"] = $messages;
                }
            }
        }

        // Filtering datatable code
        $filteringRules = [];
        if (isset($requestParam['action']) && $requestParam['action'] == 'filter' && $requestParam['action'][0] != 'filter_cancel') {
            if ($requestParam['search_autolikes_id'] != '') {
                $filteringRules[] = "(autolikes_orders.autolikes_id LIKE '%" . $requestParam['search_autolikes_id'] . "%' )";
            }
            if ($requestParam['search_sub_insta_username'] != '') {
                $filteringRules[] = "(autolikes_orders.insta_username LIKE '%" . $requestParam['search_sub_insta_username'] . "%' )";
            }
            if ($requestParam['search_profile_image'] != '') {
                $filteringRules[] = "(autolikes_orders.profile_image LIKE '%" . $requestParam['search_profile_image'] . "%' )";
            }
            if ($requestParam['search_quantity'] != '') {
                $filteringRules[] = "(subscription_packages.quantity LIKE '%" . $requestParam['search_quantity'] . "%' )";

            }
            if ($requestParam['search_created_at'] != '') {
                $filteringRules[] = "(autolikes_orders.created_at LIKE '%" . $requestParam['search_created_at'] . "%' )";
            }
            if ($requestParam['search_last_checked_time'] != '') {
                $filteringRules[] = "(autolikes_orders.last_checked_time LIKE '%" . $requestParam['search_last_checked_time'] . "%' )";
            }
            if ($requestParam['search_status'] != '') {
                $filteringRules[] = "(autolikes_orders.status LIKE '%" . $requestParam['search_status'] . "%' )";
            }
            if (!empty($filteringRules)) {
                $whereCond['rawQuery'] .= " AND " . implode(" AND ", $filteringRules);
            }
        }

        $result = $objUserModel->getAllFilterAutolikes($whereCond, $sortingOrder, $iDisplayStart, $iDisplayLength);
        $result = json_decode(json_encode($result), true);

        foreach ($result as $key => $value) {
//
//
            $details = ' <a href="javascript:;" class="show-details" data-toggle="modal" data-target="#showDetails" title="Details" data-id="' . $value['autolikes_id'] . '">
                                            <i class="fa fa-eye"></i></span>
                                           </a> &nbsp;&nbsp;
                                           <a href="javascript:;"><i class="fa fa-trash" id="deleteCommnet"  title="Delete" data-id=' . $value['autolikes_id'] . '></i></a>                                          
                                           <a href="javascript:;" class="editUserdetails" data-toggle="modal" title="Edit" data-target="#editUserModal" data-id="' . $value['autolikes_id'] . '">
                                              <i class="fa fa-pencil"></i></span>
                                           </a>                                        
                                           ';


            $created_at = $this->convertEpoachToDateTime($value['created_at']);
            $last_checked_time = $this->convertEpoachToDateTime($value['last_checked_time']);

            $status = '';
            if ($value['status'] == 0) {
                $status = '<span class="label label-warning"><i class="fa fa-clock-o"></i>&nbsp; pending</span>';
            } else if ($value['status'] == 1) {
                $status = '<span class="label label-success"><i class="fa fa-spin fa-refresh"></i>&nbsp; running</span>';
            } else if ($value['status'] == 2) {
                $status = '<span class="label label-danger"><i class="fa  fa-check"></i>&nbsp; finished</span>';
            } else if ($value['status'] == 3) {
                $status = '<span class="label label-primary"><i class="fa fa-times"></i>&nbsp; cancelled</span>';
            } else if ($value['status'] == 4) {
                $status = '<span class="label label-info"><i class="fa fa-ban"></i>&nbsp; refunded</span>';
            } else if ($value['status'] == 5) {
                $status = '<span class="label label-info"><i class="fa fa-pause"></i>&nbsp; paused</span>';
            } else if ($value['status'] == 6) {
                $status = '<span class="label label-primary"><i class="fa fa-ban"></i>&nbsp; suspended</span>';
            }
            $post = $value['post_done'] . ' / ' . $value['post_limit'];
            $DailyPost = $value['daily_post_done'] . ' / ' . $value['daily_post_limit'];
            $insta_username = '<p><a class="btn btn-xs default text-case link-width" href="https://instagram.com/' . $value['insta_username'] . '/" target="_blank"><i style="font-size:10px" class="fa fa-instagram"></i>&nbsp;' . $value['insta_username'] . '</a></p>';

            $records['data'][] = array(
                '<input type="checkbox" class="orderCheckBox" name="autolikesid[]" value="' . $value['autolikes_id'] . '">',
                $value['autolikes_id'],
                $insta_username,
                '<div class="text-center"><img src="'.$value['profile_image'].'" style="width:50px; border-radius:50%; border: 1px solid;"></div>',
                $value['quantity'],
                $post,
                $DailyPost,
                $created_at,
                $last_checked_time,
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
     * @Desc: ShowDetailsAjaxHandlerAutolike
     * @param Request $request
     * @since 18/7/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function  ShowDetailsAjaxHandlerAutolike(Request $request)
    {
        if ($request->isMethod('post')) {
                 $objPackageModel = new Autolike();
                 $select =['subscription_packages.sub_package_name','subscription_packages.quantity','profile_image','recurring_profiles.paypal_profile_id','insta_username','message','post_limit','post_done','last_delivered_link','last_checked_time','users.email','users.username'];
                 $userDetails = $objPackageModel->fetchAutolikes($request->input('autolikes_id'), $select);
//            dd($userDetails);
                 $userDetails = json_decode(json_encode($userDetails), true);
                 if (isset($userDetails) && !empty($userDetails))
                     echo json_encode(['status' => 200, 'msg' => 'Details Fetch Sucessfully .', 'userDetails' => $userDetails]);
                 else
                     echo json_encode(['status' => 400, 'msg' => 'Autolikes  details not found.']);
             } else {
                 echo json_encode(['status' => 401, 'msg' => 'Request couldnt be completed,Only post method is allowed.']);
             }
         }



    /**
     * @Desc: ViewAllAutoLikesProfile
     * @param Request $request
     * @since  18/7/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
//    public  function  ViewAllAutoLikesProfile(Request $request)
//    {
//         if($request->isMethod('post')){
//
//             $objOrderModel=new Autolike();
//              $select=['orders.order_url','autolikes_orders'];
//             $userDetails = $objOrderModel->FetechAutolikesOrder($request->input('autolikes_id'), $select);
//             $userDetails = json_decode(json_encode($userDetails), true);
//             if (isset($userDetails) && !empty($userDetails))
//                 echo json_encode(['status' => 200, 'msg' => 'Details Fetch Sucessfully .', 'userDetails' => $userDetails]);
//             else
//                 echo json_encode(['status' => 400, 'msg' => 'Autolikes  details not found.']);
//         } else {
//             echo json_encode(['status' => 401, 'msg' => 'Request couldnt be completed,Only post method is allowed.']);
//         }
//
//     }




    /**
     * @Desc: EditAjaxHandlerAutolike
     * @param Request $request
     * @since  18/7/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
     public  function EditAjaxHandlerAutolike(Request  $request)
     {
         if ($request->isMethod('post')) {
                 $objPlanModel = new Autolike();
                 $userDetails = $objPlanModel->FetechAutolikesOrder($request->input('autolikes_id'));
                 $userDetails = json_decode(json_encode($userDetails), true);
                 if ($userDetails)
                     echo json_encode(['status' => 200, '`msg' => 'Autolikes Profile details found.', 'data' => $userDetails]);
                 else
                     echo json_encode(['status' => 400, 'msg' => 'Autolikes Profile details not found.']);
             } else {
                 echo json_encode(['status' => 401, 'msg' => 'Request couldnt be completed,Only post method is allowed.']);
             }
         }

    /**
     * @Desc: UpdateAjaxHandelerAutolikes
     * @param Request $request
     * @since  18/7/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function UpdateAjaxHandelerAutolikes(Request $request)
    {

            if ($request->isMethod('post')) {
                $validator= Validator::make($request->all(), [
                    'insta_username' => 'required',
                    'quantity' => 'required',
                    'post_limit' => 'required|regex:/^\d+(,\d{1,2})?$/',
                    'post_done' => 'required|regex:/^\d+(,\d{1,2})?$/',
                    'daily_post_done' => 'required|regex:/^\d+(,\d{1,2})?$/',
                    'daily_post_limit' => 'required|regex:/^\d+(,\d{1,2})?$/',
                ]);
                if ($validator->fails()) {
                    echo json_encode(['status' => 400, 'message' => array_values(json_decode($validator->messages(),true))[0][0]]);
                    die;
                }

                $postData = $request->all();
                $admindataparse = new Autolike();
                $whereForUpdate = ['rawQuery' => 'autolikes_id = ?', 'bindParams' => [$postData['autolikes_id']]];
                unset($postData['autolikes_id']);
                $updated = $admindataparse->updateAutolikesProfile($whereForUpdate, $postData);
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
     * @Desc: deleteAjaxHandler
     * @param $dateTime
     * @return string
     * @since 16/8/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function deleteAjaxHandler(Request $request)
    {
        if ($request->isMethod('post')) {
            $autolikes_id = $request->input('autolikes_id');
            $objModelOrder = new Autolike();
            $whereForDelete = array(
                'rawQuery' => 'autolikes_id = ?',
                'bindParams' => [$autolikes_id]
            );
            $objModelOrder = $objModelOrder->deleteAutolikes($whereForDelete);
            if ($objModelOrder) {
                echo json_encode(array('status' => '200', 'message' => 'Record has been successfully deleted'));
            } else {
                echo json_encode(array('status' => '400', 'message' => 'error'));
            }
        }
    }



    public function ViewAllAutoLikesProfile(Request $forUserId)
    {
        $where = array('rawQuery' => 'user_id=?', 'bindParams' => [$forUserId->input('forUserId')]);
       dd($forUserId);
        $objPackageModel = new Order();
        $orderDetails = $objPackageModel->getAllOrdersDetails($where);
//        dd($where,$orderDetails);
        if ($orderDetails) {
            echo json_encode(['status' => '200', 'message' => 'Details Fetch Sucessfully', 'data' => $orderDetails]);
        } else {
            echo json_encode(['status' => '400', 'message' => 'something went wrong']);
        }
    }





    /**
     * @Desc: convertEpoachToDateTime
     * @param $dateTime
     * @return string
     * @since 7/12/2018
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

}