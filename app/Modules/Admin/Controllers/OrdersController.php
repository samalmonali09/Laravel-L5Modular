<?php

namespace App\Modules\Admin\Controllers;

use App\Modules\Admin\Models\Order;

//use App\Modules\Admin\Models\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use users;
use DataTables;


class OrdersController extends Controller
{

    /**
     * @Desc:manageOrders functionality
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since 5 feb  2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function manageOrders($method)
    {
        if ($method === 'GILE') {
            return view('Admin::Order/manageOrderGILE');
        } else if ($method === 'GILR') {
            return view('Admin::Order/manageOrderGILR');
        } else if ($method === 'GIVE') {
            return view('Admin::Order/manageOrderGIVE');
        } else if ($method === 'GIVR') {
            return view('Admin::Order/manageOrderGIVR');
        } else if ($method === 'AUTOIG') {
            return view('Admin::Order/manageOrderAutoIG');
        } else if ($method === 'INSTASTAT') {
            return view('Admin::Order/manageOrderINSTASTATS');
        }   else if ($method === 'Instant') {
            return view('Admin::Order/manageOrderInstant');
        }

    }

    /**
     * @Desc:orderAjaxHandler Functionality
     * @param Request $request
     * @since 5 feb 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function orderAjaxHandler(Request $request)
    {
        $requestParam = $request->all();
        $objUserModel = new Order();

        $whereCond = [
            'rawQuery' => '1',
        ];
        $method = $request->input('method');

        switch ($method) {
            case 'GILE':
                $whereCond = [
                    'rawQuery' => '1 and users.registered_through=1',
                ];
                break;

            case'GILR':
                $whereCond = [
                    'rawQuery' => '1 and   users.registered_through=2'
                ];
                break;
            case 'GIVE':
                $whereCond = [
                    'rawQuery' => ' 1 and  users.registered_through=3',
                ];
                break;
            case 'GIVR':
                $whereCond = [
                    'rawQuery' => '1 and  users.registered_through=4',
                ];
                break;
            case 'AUTOIG':
                $whereCond = [
                    'rawQuery' => '1 and  users.registered_through =5',
                ];
                break;
            case 'INSTASTAT':
                $whereCond = [
                    'rawQuery' => '1 and users.registered_through=6',
                ];

                break;
            case 'Instant':
                $whereCond = [
                    'rawQuery' => '1 and users.registered_through=7',
                ];

                break;

        }

        //GET TOTAL NUMBER OF NEW ORDERS
        $iTotalRecords = count($objUserModel->getOrdersDetails($whereCond));
        $iTotalFilteredRecords = $iTotalRecords;

        $iDisplayLength = intval($requestParam['length']);
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        $iDisplayStart = intval($requestParam['start']);
        $sEcho = intval($requestParam['draw']);

        $records = array();
        $records["data"] = array();

        $columns = array(
            'orders.order_id',
            'users.email',
            'orders.order_url',
            'packages.price',
            'orders.quantity',
            'orders.added_time',
            'packages.package_name',
            'orders.status',
        );
        $sortingOrder = "";
        if (isset($requestParam['order'])) {
            $sortingOrder = [$columns[$requestParam['order'][0]['column'] - 1], $requestParam['order'][0]['dir']];
        }
/// Select Multiple recorde cancel ,hold , remove orders  functionality   ,,,,,,
///
        if (isset($requestParam["customActionType"]) && $requestParam["customActionType"] == "group_action") {
            if ($requestParam['customActionName'] != '' && !empty($requestParam['orderId'])) {
                $orderIds = $requestParam['orderId'];

                if ($requestParam['customActionName'] == 'Remove_orders') {
                    $messages = array();
                    $count = 1;
                    foreach ($orderIds as $key => $orderId) {
                        $username = $objUserModel->getOrderDetailsDatabase(['rawQuery' => 'order_id=?', 'bindParams' => [$orderId]]);
                        $queryResult = $objUserModel->deleteOrders(['rawQuery' => 'order_id=?', 'bindParams' => [$orderId]]);

                        if ($queryResult) {
                            $messages[0] = $count . ' Order has been Deleted . <br>';
//                            $messages[$key + 1] = '<span style="margin-left: 5%">Profile:&nbsp;&nbsp; <i class="fa fa-instagram"><b>&nbsp;' . $username[0]->order_id . '</b></i></span> <br>';
                            $count++;
                        } else {
                            $messages[$key + 1] = 'There is a problem in deleting # ' . $username[0]->order_id . ' profile. <br>';
                        }
                    }
                    $records["customActionStatus"] = "OK";
                    $records["customActionMessage"] = $messages;

                } else if ($requestParam['customActionName'] == 'cancel_order') {

                    $messages = array();
                    $count = 1;
                    foreach ($orderIds as $key => $orderId) {
                        $username = $objUserModel->getOrderDetailsDatabase(['rawQuery' => 'order_id=?', 'bindParams' => [$orderId]]);
                        $result = $objUserModel->updateOrder(['rawQuery' => 'order_id=?', 'bindParams' => [$orderId]], ['status' => 5]);

                        if ($result) {
                            $messages[0] = $count . "Order Has been cancelled. <br>";
//                            $messages[$key + 1] = '<span style="margin-left: 5%">Profile:&nbsp;&nbsp; <i class="fa fa-instagram"><b>&nbsp;' . $username[0]->order_id . '</b></i></span> <br>';
                            $count++;
                        } else {
                            $messages[$key + 1] = 'There is a problem in Cancel ' . $username[0]->order_id . ' profile. <br>';
                        }
                    }
                    $records["customActionStatus"] = "OK";
                    $records["customActionMessage"] = $messages;

                } else if ($requestParam['customActionName'] == 'reAdd_order') {
                    $messages = array();
                    $count = 0;
                    foreach ($orderIds as $key1 => $orderId) {
//                        $messages[0] = $count . " <span>orders re-added<table style='margin-left: 5%'><tr><th># OrderId </th>";
                        $orderDetails = $objUserModel->getOrderDetailsID(['rawQuery' => 'order_id=?', 'bindParams' => [$orderId]]);
                        if ($orderDetails) {
                            unset($orderDetails[0]->order_id);

                            $data = [];
                            foreach ($orderDetails[0] as $key => $value) {
                                $data[$key] = $value;
                            }
                            $data['status'] = 0;
                            $data['start_time'] = time();
                            $data['added_time'] = time();
                            // $data['start_count'] = 0;
                            $data['package_id'] = 27; //
                            $data['quantity'] = 0;
//                            $price = $data['price'];


                            $rollback = false;
                            $successFlag = false;

                            $orderInsert = $objUserModel->insertOrderID($data);
                            if ($orderInsert) {
                                ++$count;
                                $messages[0] = $count . "Order Has been restarted . <br>";
//                                $messages[0] = $count . " <span>orders re-added<table style='margin-left: 5%'><tr><th># OrderId </th></tr></span>";
                                $messages[$key1 + 1] = '<tr><td>' . $orderId . ' </td><td>&nbsp;</td><td>' . $orderInsert . '</td></tr>';
                            } else {
                                $rollback = true;
                                $messages[$key1 + 1] = "error in re-add order " . $orderId . " please retry.";
                            }
                            if ($rollback) {
                                break;
                            }
                        } else {
                            $messages[$key1 + 1] = "This order ID #" . $orderId . " is invalid.";
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
            if ($requestParam['search_order_id'] != '') {
                $filteringRules[] = "(order_id LIKE '%" . $requestParam['search_order_id'] . "%' )";
            }
            if ($requestParam['search_Email'] != '') {
                $filteringRules[] = "( users.email LIKE '%" . $requestParam['search_Email'] . "%' )";
            }
            if ($requestParam['search_Package'] != '') {
                $filteringRules[] = "( packages.package_name LIKE '%" . $requestParam['search_Package'] . "%' )";
            }

            if ($requestParam['search_price_from'] && $requestParam['search_price_to'] != '') {
                $filteringRules[] = 'packages.price between ' . $requestParam['search_price_from'] . ' and ' . $requestParam['search_price_to'];
            }

            if ($requestParam['search_order_url'] != '') {
                $filteringRules[] = "(orders.order_url LIKE '%" . $requestParam['search_order_url'] . "%' )";
            }
            if ($requestParam['search_quantity'] != '') {
                $filteringRules[] = "(orders.quantity LIKE '%" . $requestParam['search_quantity'] . "%' )";
            }

            if ($requestParam['search_Date'] != '') {
                $filteringRules[] = "(orders.added_time LIKE '%" . $requestParam['search_Date'] . "%' )";
            }

            if ($requestParam['search_status'] != '') {
                $filteringRules[] = "(orders.status LIKE '%" . $requestParam['search_status'] . "%' )";
            }
//
            if (!empty($filteringRules)) {
                $whereCond['rawQuery'] .= " AND " . implode(" AND ", $filteringRules);
//                            $iTotalFilteredRecords = count($objUserModel->getInsUserAutolikesOrderHistory($whereUserById));
            }
        }


        $result = $objUserModel->getAllFilterOrders($whereCond, $sortingOrder, $iDisplayStart, $iDisplayLength);
        $result = json_decode(json_encode($result), true);


        foreach ($result as $key => $value) {
            $commnets = '';
//            if ($result['package_type'] == 3) {
            if ($value['package_type'] == 3) {
                $commnets = '<a href="javascript:;"  style="float:left;" class=" btn  btn-xs btn-green comment_history" class="" data-toggle="modal" data-target="#Comment_history" data-id="' . $value['order_id'] . '">
                                            <i class="fa fa-comment" style="color: #616161;" title="Comments"></i></span>
                                           </a> ';
           }

            $details = ' <a href="javascript:;" style="float:left;" class="show-details" data-toggle="modal"data-target="#showDetails" title="Details" data-id="' . $value['order_id'] . '">
                                            <button class="btn btn-xs btn-primary">Details</button></a>
                                           </a>'. $commnets;



            $status = '';
            if ($value['status'] == 0) {
                $status = '<span class="label label-warning"><i class="fa fa-spin fa-refresh"></i>&nbsp; pending</span>';
            } else if ($value['status'] == 1) {
                $status = '<span class="label label-success"><i class="fa fa-check-circle"></i>&nbsp; queue</span>';
            } else if ($value['status'] == 2) {
                $status = '<span class="label label-danger"><i class="fa  fa-refresh"></i>&nbsp; processing</span>';
            } else if ($value['status'] == 3) {
                $status = '<span class="label label-primary"><i class="fa fa-ban"></i>&nbsp; completed</span>';
            } else if ($value['status'] == 4) {
                $status = '<span class="label label-info"><i class="fa fa-ban"></i>&nbsp; refunded</span>';
            } else if ($value['status'] == 5) {
                $status = '<span class="label label-danger"><i class="fa fa-ban"></i>&nbsp; cancelled</span>';
            } else if ($value['status'] == 6) {
                $status = '<span class="label label-primary"><i class="fa   fa-ban"></i>&nbsp; failed</span>';
            }


            $price = '$' . $value['price'];
            $package_name = $value['package_name'];


//            $added_time = date('d/m/Y H:i:s', $value['added_time']);
            $added_time = $this->convertEpoachToDateTime($value['added_time']);
            $records['data'][] = array(
                '<input type="checkbox" class="orderCheckBox" name="userId[]" value="' . $value['order_id'] . '">',
                $value['order_id'],
                '<p class="link-width" title="' . $value['email'] . '"><i style="font-size:10px" class="fa fa-envelope"></i>&nbsp;' . $value['email'] . '</p>',
                '<div class="link-width" ><i class="fa fa-link"></i><a target=_blank  href="' . $value['order_url'] . '">&nbsp;' . $value['order_url'] . '</a></div>',
                $price,
                $value['quantity'],
                $added_time,
                $package_name,
                $status,
                $details,
//                $commnets
            );
        }


        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords; //$iTotalFilteredRecords


        echo json_encode($records, true);

    }


    /**
     * @Desc getMoreOrderDetails
     * @param Request $request
     * @since  29 jan  2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function getMoreOrderDetails(Request $request)
    {

        if ($request->isMethod('post')) {
//            $postData = $request->all();
//            $objAdminModel = new Admin();
            $objAdminModel = new Order();

            $select = [DB::raw('CASE   
         WHEN   orders.status = 0 THEN \'pending\'
         WHEN   orders.status = 1 THEN \'queue\'
         WHEN   orders.status = 2 THEN \'processing\'
         WHEN   orders.status = 3 THEN \'completed\'
         WHEN  orders.status = 4 THEN \'refunded\'
         WHEN   orders.status = 5 THEN \'cancelled\'
         WHEN   orders.status = 6 THEN \'failed\'
         END  as  	status '),
                DB::raw('CASE   
         WHEN   url_type = 0 THEN \'profile link\'
         WHEN   url_type = 1 THEN \' post link \'
         END  as  	url_type '),
                'orders.order_url', 'start_count','orders.quantity','end_count','transactions.transaction_id','transactions.payer_email'];

//            'order_url', 'start_count', 'quantity_done', 'comments.comments', 'comments.comment_id', 'end_count'];
            $userDetails = $objAdminModel->fetchOrderId($request->input('order_id'), $select);
            $userDetails = json_decode(json_encode($userDetails), true);
            if (isset($userDetails) && !empty($userDetails))

                echo json_encode(['status' => 200, 'msg' => 'Details Fetch Sucessfully .', 'userDetails' => $userDetails]);
            else
                echo json_encode(['status' => 400, 'msg' => 'User details not found.']);
        } else {
            echo json_encode(['status' => 401, 'msg' => 'Request couldnt be completed,Only post method is allowed.']);
        }
    }


    /**
     * @Desc:convertEpoachToDateTime
     * @param $dateTime
     * @return string
     * @since 16 march  2018
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

    public function ShowExtraDetailsAjaxHandelerOrderComments(Request $request)
    {
        if ($request->isMethod('post')) {

            $objectOrders = new Order();
            $order_id = $request->input('order_id');
            $where = array(
                'rawQuery' => 'order_id = ?',
                'bindParams' => [$order_id]
            );
            $select = ['comments.comments'];
            $OrderDetails = $objectOrders->fetchComments($request->input('order_id'), $select);
            $OrderDetails = json_decode(json_encode($OrderDetails), true);
            if (isset($OrderDetails) && !empty($OrderDetails))
                echo json_encode(['status' => 200, 'msg' => ' CommentDetails Fetch Sucessfully .', 'userDetails' => $OrderDetails]);
            else
                echo json_encode(['status' => 400, 'msg' => 'Comments details not found.']);
        } else {
            echo json_encode(['status' => 401, 'msg' => 'Request couldnt be completed,Only post method is allowed.']);
        }
    }

}





