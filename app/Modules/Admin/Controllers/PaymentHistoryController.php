<?php


namespace App\Modules\Admin\Controllers;

use App\Modules\Admin\Models\Autolike;
use App\Modules\Admin\Models\Order;
use App\Modules\Admin\Models\Payment;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use users;
use DataTables;

class PaymentHistoryController extends Controller
{

    /**
     * @Desc: PaymentDatable
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since   17/7/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function   PaymentDatable(Request $request)
    {
        $data = DB::table('recurring_profiles')->get();
        return view('Admin::Payment/PaymentHistory', ['data' => $data]);


    }


    /**
     * @Desc: PaymentAjaxHandler
     * @param Request $request
     * @since  17/7/ 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public  function  PaymentAjaxHandler(Request $request)
     {
    $requestParam = $request->all();
    $objUserModel = new Payment();
    $whereCond = [
        'rawQuery' => '1',
    ];


    $iTotalRecords = count($objUserModel->getPaymentDetails($whereCond));
    $iTotalFilteredRecords = $iTotalRecords;
    $iDisplayLength = intval($requestParam['length']);
    $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
    $iDisplayStart = intval($requestParam['start']);
    $sEcho = intval($requestParam['draw']);

    $records = array();
    $records["data"] = array();

    $columns = array(
        'recurring_profiles.profile_id',
        'recurring_profiles.paypal_profile_id',
        'recurring_profiles.price',
        'recurring_profiles.billing_period',
        'recurring_profiles.created_at',
        'recurring_profiles.profile_status',
    );
    $sortingOrder = "";
//    if (isset($requestParam['order'])) {
//        $sortingOrder = [$columns[$requestParam['order'][0]['column'] - 1], $requestParam['order'][0]['dir']];
//    }


        if (isset($requestParam['order']) && $requestParam['order'][0]['column'] != 0) {
            $sortingOrder = [$columns[$requestParam['order'][0]['column'] - 1], $requestParam['order'][0]['dir']];
        }else{
            $sortingOrder = [$columns[$requestParam['order'][0]['column']], $requestParam['order'][0]['dir']];
        }


        // Filtering datatable code
    $filteringRules = [];
    if (isset($requestParam['action']) && $requestParam['action'] == 'filter' && $requestParam['action'][0] != 'filter_cancel') {
        if ($requestParam['search_profile_id'] != '') {
            $filteringRules[] = "(recurring_profiles.profile_id LIKE '%" . $requestParam['search_profile_id'] . "%' )";
        }
        if ($requestParam['search_paypal_profile_id'] != '') {
            $filteringRules[] = "(recurring_profiles.paypal_profile_id LIKE '%" . $requestParam['search_paypal_profile_id'] . "%' )";
        }
        if ($requestParam['search_price'] != '') {
            $filteringRules[] = "(recurring_profiles.price LIKE '%" . $requestParam['search_price'] . "%' )";
        }
        if ($requestParam['search_billing_period'] != '') {
            $filteringRules[] = "(recurring_profiles.billing_period LIKE '%" . $requestParam['search_billing_period'] . "%' )";
        }
        if ($requestParam['search_created_at'] != '') {
            $filteringRules[] = "(recurring_profiles.created_at LIKE '%" . $requestParam['search_created_at'] . "%' )";
        }
        if ($requestParam['search_profile_status'] != '') {
            $filteringRules[] = "(recurring_profiles.profile_status LIKE '%" . $requestParam['search_profile_status'] . "%' )";
        }
        if (!empty($filteringRules)) {
            $whereCond['rawQuery'] .= " AND " . implode(" AND ", $filteringRules);
        }
    }

    $result = $objUserModel->getAllFilterPayment($whereCond, $sortingOrder, $iDisplayStart, $iDisplayLength);
    $result = json_decode(json_encode($result), true);

    foreach ($result as $key => $value) {
//
        $details = ' <a href="javascript:;" class="show-details" data-toggle="modal" title="Detail" data-target="#showDetails" data-id="' . $value['profile_id'] . '" xmlns="http://www.w3.org/1999/html">
                      <button class="btn btn-xs btn-info">Details</button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;"><button class="fa fa-trash" id="deleteCommnet"  title="Delete" data-id=' . $value['profile_id'] . '></button></a>';
//        $details = ' <a href="javascript:;" class="show-details" data-toggle="modal" data-target="#showDetails" title="Details" data-id="' . $value['profile_id'] . '">
//                                            <i class="fa fa-eye"></i></span>
//                                           </a> &nbsp;&nbsp;
//                                           <a href="javascript:;"><i class="fa fa-trash" id="deleteCommnet"  title="Delete" data-id=' . $value['profile_id'] . '></i></a>
//
//                                           ';

        $status = '';
        if ($value['profile_status'] == 0) {
            $status = '<span class="label label-warning"><i class="fa fa-spin fa-refresh"></i>&nbsp; Pending</span>';
        } else if ($value['profile_status'] == 1) {
            $status = '<span class="label label-success"><i class="fa fa-check-circle"></i>&nbsp; Active</span>';
        } else if ($value['profile_status'] == 2) {
            $status = '<span class="label label-danger"><i class="fa  fa-refresh"></i>&nbsp; Cancelled</span>';
        } else if ($value['profile_status'] == 3) {
            $status = '<span class="label label-primary"><i class="fa fa-ban"></i>&nbsp; Suspended</span>';
        }



        $created_at = $this->convertEpoachToDateTime($value['created_at']);

        $records['data'][] = array(
//            '<input type="checkbox" class="orderCheckBox" name="profile_id[]" value="' . $value['profile_id'] . '">',
            $value['profile_id'],
            $value['paypal_profile_id'],
            '<p class="link-width" title="' . $value['price'] . '"><i style="font-size:10px" class="fa fa-dollar"></i>&nbsp;' . $value['price'] . '</p>',
            $value['billing_period'],
            $created_at,
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
     * @Desc: PaymentExtraDetailsAjaxHAndler
     * @param Request $request
     * @since   16/7/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function PaymentExtraDetailsAjaxHAndler(Request $request)
    {

            if ($request->isMethod('post')) {
                $objPackages = new payment();
                $select = [DB::raw('CASE  
         WHEN  profile_status = 0 THEN \'Pending\'
         WHEN profile_status = 1 THEN \'Active\'
         WHEN profile_status = 2 THEN \'Cancelled\'
         WHEN profile_status = 3 THEN \'Suspended\'
         END  as  profile_status'),
                    'subscription_packages.sub_package_name', 'price', 'subscription_packages.quantity','recurring_profiles.sub_package_type','billing_period','recurring_profiles.sub_package_type'];
                $userDetails = $objPackages->fetchAutolikes($request->input('profile_id'), $select);
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
     * @Desc: deleteAjaxHandlerPayment
     * @param Request $request
     * @since   24/8/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function deleteAjaxHandlerPayment(Request $request)
    {
        if ($request->isMethod('post')) {
            $profile_id = $request->input('profile_id');
            $objModelOrder = new payment();
            $whereForDelete = array(
                'rawQuery' => 'profile_id = ?',
                'bindParams' => [$profile_id]
            );
            $objModelOrder = $objModelOrder->deletePayment($whereForDelete);
            if ($objModelOrder) {
                echo json_encode(array('status' => '200', 'message' => 'Record has been successfully deleted'));
            } else {
                echo json_encode(array('status' => '400', 'message' => 'error'));
            }
        }
    }







    /**
     * @Desc: convertEpoachToDateTime
     * @param $dateTime
     * @return string
     * @since   17/7/2018
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