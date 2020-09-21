<?php

namespace App\Modules\Admin\Controllers;

use App\Modules\Admin\Models\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
//use Yajra\Datatables\Datatables;
use users;
use DataTables;
use App\User;

//class UserController extends Controller
class TransactionsController extends Controller
{

    /**
     * @Desc:manageTransaction functionality ..
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since   7 feb 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function manageTransaction($method)
    {
        if ($method === 'GILE') {
            return view('Admin::Transaction/managetransactionsGILE');
        } else if ($method === 'GILR') {
            return view('Admin::Transaction/managetransactionsGILR');
        } else if ($method === 'GIVE') {
            return view('Admin::Transaction/managetransactionsGIVE');
        } else if ($method === 'GIVR') {
            return view('Admin::Transaction/managetransactionsGIVR');
        } else if ($method === 'INSTASTAT') {
            return view('Admin::Transaction/managetransactionsInstaStart');
        } else if ($method === 'Instant') {
            return view('Admin::Transaction/managetransactionsInstant');
        } else if ($method === 'AUTOIG') {
            return view('Admin::Transaction/managetransactionsaAutoig');
        }


    }


    /**
     * @Desc:TransactionAjaxHandeler functionality
     * @param Request $request
     * @since  7 feb  2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function TransactionAjaxHandeler(Request $request)
    {
        $requestParam = $request->all();
        $objUserModel = new Transaction();
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
                    'rawQuery' => '1 and  users.registered_through=7',
                ];

                break;
//            default:
//
//                break;
        }

        //GET TOTAL NUMBER OF NEW ORDERS
        $iTotalRecords = count($objUserModel->getTransactionDetails($whereCond));
        $iTotalFilteredRecords = $iTotalRecords;

        $iDisplayLength = intval($requestParam['length']);
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        $iDisplayStart = intval($requestParam['start']);
        $sEcho = intval($requestParam['draw']);

        $records = array();
        $records["data"] = array();

        $columns = array(
//            'orders.tx_id',
            'transactions.tx_id',
            'transactions.payer_email',
            'users.email',
            'transactions.transaction_id',
            'transactions.amount',
            'transactions.payment_time',
            'transactions.payment_status',
        );
        $sortingOrder = "";
        if (isset($requestParam['order']) && $requestParam['order'][0]['column'] != 0) {
            $sortingOrder = [$columns[$requestParam['order'][0]['column'] - 1], $requestParam['order'][0]['dir']];
        } else {
            $sortingOrder = [$columns[$requestParam['order'][0]['column']], $requestParam['order'][0]['dir']];
        }


        if (isset($requestParam["customActionType"]) && $requestParam["customActionType"] == "group_action") {
            if ($requestParam['customActionName'] != '' && !empty($requestParam['insUserId'])) {
                $insUsersId = $requestParam['insUserId'];
            }
        }

// Filtering datatable code
        $filteringRules = [];
        if (isset($requestParam['action']) && $requestParam['action'] == 'filter' && $requestParam['action'][0] != 'filter_cancel') {
            if ($requestParam['search_tx_id'] != '') {
//                $filteringRules[] = "(orders.tx_id LIKE '%" . $requestParam['search_tx_id'] . "%' )";
                $filteringRules[] = "(transactions.tx_id LIKE '%" . $requestParam['search_tx_id'] . "%' )";
            }
            if ($requestParam['search_payer_email'] != '') {
                $filteringRules[] = "(transactions.payer_email LIKE '%" . $requestParam['search_payer_email'] . "%' )";
            }
            if ($requestParam['search_email'] != '') {
                $filteringRules[] = "(users.email LIKE '%" . $requestParam['search_email'] . "%' )";
            }
            if ($requestParam['search_transaction_id'] != '') {
                $filteringRules[] = "(transactions.transaction_id LIKE '%" . $requestParam['search_transaction_id'] . "%' )";
            }

            if ($requestParam['search_amount_from'] && $requestParam['search_amount_to'] != '') {
                $filteringRules[] = 'transactions.amount between ' . $requestParam['search_amount_from'] . ' and ' . $requestParam['search_amount_to'];
            }

            if ($requestParam['search_payment_time'] != '') {
                $filteringRules[] = "(transactions.payment_time LIKE '%" . $requestParam['search_payment_time'] . "%' )";
            }

            if ($requestParam['search_payment_status'] != '') {
                $filteringRules[] = "(transactions.payment_status LIKE '%" . $requestParam['search_payment_status'] . "%' )";
            }
//
            if (!empty($filteringRules)) {
                $whereCond['rawQuery'] .= " AND " . implode(" AND ", $filteringRules);
            }
        }


        $result = $objUserModel->getAllFilterTransaction($whereCond, $sortingOrder, $iDisplayStart, $iDisplayLength);
        $result = json_decode(json_encode($result), true);


        foreach ($result as $key => $value) {
            $details = ' <a href="javascript:;" class="show-details" data-toggle="modal" data-target="#showDetails" data-id="' . $value['order_id'] . '">
                                             <span>&nbsp;</span>
                                           </a>';

//
//            $payment_status = '';
//            if ($value['payment_status']=='success') {
//                $payment_status = '<span class="label label-success"><i class="fa  fa-spin fa-check"></i>&nbsp; success</span>';
//            } else if ($value['payment_status']=='Completed') {
//                $payment_status = '<span class="label label-primary"><i class="fa fa-spin fa-refresh"></i>&nbsp; Completed</span>';
//            }


            if ($value['amount'] == null) {
                $value['amount'] = 0;
            }
            $amount = "$" . $value['amount'];
            $tx_mode = '';
            if ($value['tx_mode'] == 0) {
                $tx_mode = '<span class="label label-info"><i class="fa  fa-spin fa-paypal"></i>&nbsp; paypal order</span>';

            }

            $payment_time = $this->convertEpoachToDateTime($value['payment_time']);
            $records['data'][] = array(
//                '<input type="checkbox" class="orderCheckBox" name="userId[]" value="' . $value['order_id'] . '">',
                $value['tx_id'],
                '<p class="link-width" title="' . $value['payer_email'] . '"><i style="font-size:10px" class="fa fa-envelope"></i>&nbsp;' . $value['payer_email'] . '</p>',
                '<p class="link-width" title="' . $value['email'] . '"><i style="font-size:10px" class="fa fa-envelope"></i>&nbsp;' . $value['email'] . '</p>',

                '<a target=_blank class="show-details" data-toggle="modal" data-target="#showDetails" class="fa-fa-paper-plane" data-id="' . $value['order_id'] . '" style="color:#0b7eff;">' . $value['transaction_id'] . ' </a>',
//                 $tx_mode,
                $amount,
//                $value['tx_code'],
                $payment_time,
//                $payment_status,
                $value['payment_status'],
                $details
            );
        }

        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords; //$iTotalFilteredRecords

        echo json_encode($records, true);


    }

    /**
     * @Desc:getMoreTransactionDetails ajax
     * @param Request $request
     * @since 12 march  2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function getMoreTransactionDetails(Request $request)
    {

        if ($request->isMethod('post')) {
            $objAdminModel = new Transaction();


            $select = [
                DB::raw('CASE 
                WHEN tx_type=0 THEN \'single order\'
                WHEN tx_type=1 THEN \'subscription\'
                END as transactions.tx_type'),

                DB:: raw('CASE
                WHEN tx_mode=0 THEN \'paypal order \'
                END as transactions.tx_mode'),
                'transactions.amount', 'transactions.autolikes_id', 'transactions.payment_status', 'transactions.payer_email', 'orders.order_url', 'transactions.pending_reason', 'transactions.extra_details'];

            $userDetails = $objAdminModel->fetchTransactionId($request->input('tx_id'), $select);
//            dd($select);

            $userDetails = json_decode(json_encode($userDetails), true);

            if (isset($userDetails) && !empty($userDetails))

                echo json_encode(['status' => 200, 'msg' => 'Details Fetch Sucessfully .', 'userDetails' => $userDetails]);
            else
                echo json_encode(['status' => 400, 'msg' => 'Payment details not found.']);
        } else {
            echo json_encode(['status' => 401, 'msg' => 'Request couldnt be completed,Only post method is allowed.']);
        }
    }


    /**
     * @Desc:convertEpoachToDateTime
     * @param Request $request
     * @since 20 march  2018
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



