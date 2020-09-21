<?php
/**
 * Created by Monali Samal.
 * User: monali samal <monalisamal@globussoft.in>
 * Date: 3/6/2018
 * Time: 11:45 AM
 */

namespace App\Modules\Admin\Controllers;

use App\Modules\Admin\Models\DBClass;
use App\Modules\Admin\Models\Proxy;

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
use PDF;
use DataTables;
use Maatwebsite\Excel;
use App\User;

class ProxyController extends Controller
{
    /**
     * @Desc: showProxies
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since  31/5/ 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function ProxiesTable()
    {

        return view("Admin::Proxy.Proxies", ['proxyConfig' => $this->getProxyConfiguration()]);
    }

    public function getProxyConfiguration()
    {
        /* get config details from proxies_config table */
        $_db = new DBClass();
        $proxyConfig = $_db->selectQuery('proxies_config', ['rawQuery' => '1=1']);
        if (!empty($proxyConfig)) {
            $proxyConfig = $proxyConfig[0];
        }
        return $proxyConfig;
    }

    public function saveProxyConfiguration(Request $request)
    {

        /* get config details from proxies_config table */
        $_db = new DBClass();
        $proxyConfig = $_db->selectQuery('proxies_config', ['rawQuery' => '1=1']);
        if (!empty($proxyConfig)) {
            $proxyConfig = $proxyConfig[0];
            $updated = $_db->updateQuery('proxies_config', ['rawQuery' => 'proxy_config_id = ?', 'bindParams' => [$proxyConfig['proxy_config_id']]], ['proxy_option' => $request['proxy_type']]);
        } else {
            $inserted = $_db->insert('proxies_config', ['proxy_option' => $request['proxy_type']]);
        }

        $proxyType = ($request['proxy_type'] == 1) ? 'stored db proxies' : (($request['proxy_type'] == 2) ? 'data center ips (Luminati)' : 'residential ips (Luminati)');
        if ($updated || $inserted) {
            echo json_encode(['status' => 200, 'message' => 'Media fetching script will run through ' . $proxyType . ' .']);
        } else {
            echo json_encode(['status' => 400, 'message' => 'Something went wrong, please try after sometime.']);
        }
    }

    /**
     * @Desc: showProxiesAjaxDatables
     * @return mixed
     * @since   31/5/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function ProxiesAjaxDatables()
    {
        $objProxyModel = new Proxy();
        $proxyDetails = $objProxyModel->getAllProxies();

        $proxies = new Collection();
        $proxyDetails = json_decode(json_encode($proxyDetails), true);

        $i = 0;
        foreach ($proxyDetails as $proxy) {
            if ($proxy['working_status'] == "A") {
                $style = 'btn-success btn-sm';
                $statement = 'Active';
            } else if ($proxy['working_status'] == "I") {
                $style = 'btn-danger btn-sm';
                $statement = 'Inactive';
            } else {
                $style = 'btn-info btn-sm';
                $statement = 'Suspended';
            }
            $id = $proxy['proxy_id'];
//
            $proxies->push([
                'check' => '<input type="checkbox" class="sub_chk" data-id ="' . $proxy['proxy_id'] . '" name="checkbox" value="' . $proxy['proxy_id'] . '">',
                'proxy_id' => ++$i,
                'ip' => $proxy['ip'],
                'port' => $proxy['port'],
                'username' => ($proxy['username'] != '') ? $proxy['username'] : '-',
                'password' => ($proxy['password'] != '') ? $proxy['password'] : '-',
                'proxy_hit_count' => $proxy['proxy_hit_count'],
                'execution_time' => $proxy['execution_time'],
                'last_used_at' => $this->convertUT($proxy['last_used_at']),
                'working_status' => '<a data-id ="' . $id . '" class="changeStatus ' . $style . '" style="cursor:pointer;">' . $statement . '</a>',
                'delete' => '<span data-pid="' . $id . '" class="deleteProxy" title="Delete Proxies." data-placement="top"> <a class="btn btn-sm" style="margin-left: 10%;">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
                                            </span>'

            ]);

        }

        return DataTables::of($proxies)->rawColumns(['check', 'working_status', 'delete'])->make(true);

    }


    /**
     * @Desc: deleteProxyAjaxHandler
     * @param Request $req
     * @since   31 /5 /2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function deleteProxyAjaxHandler(Request $req)
    {
        if ($req->isMethod('post')) {
            $proxy_id = $req->input('proxyId');
            $objModelProxy = new Proxy();
            $deletedProxy = $objModelProxy->deleteProxy(['rawQuery' => 'proxy_id = ?', 'bindParams' => [$proxy_id]]);
            if ($deletedProxy)
                echo json_encode(['status' => 200, 'msg' => 'Record has been successfully deleted']);
            else
                echo json_encode(['status' => 400, 'msg' => 'Some Error Occurred Error. Please reload the page and try again.']);
        }
    }


    /**
     * @Desc: convertUT
     * @param $ptime
     * @return string
     * @since  31/5/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */

    public function convertUT($ptime)
    {
        if ($ptime == 0) {
            return '-';
        }
        $difftime = time() - $ptime;
        $afterFlag = '';

        if ($difftime < 1) {
            return '0 secs';

        }

        $timeArr = array(365 * 24 * 60 * 60 => 'year',
            30 * 24 * 60 * 60 => 'month',
            24 * 60 * 60 => 'day',
            60 * 60 => 'hour',
            60 => 'min',
            1 => 'sec'
        );
        $timeArr_plural = array('year' => 'years',
            'month' => 'months',
            'day' => 'days',
            'hour' => 'hours',
            'min' => 'mins',
            'sec' => 'secs'
        );

        foreach ($timeArr as $secs => $str) {
            $d = $difftime / $secs;
            if ($d >= 1) {
                $r = round($d);
                return $afterFlag . $r . ' ' . ($r > 1 ? $timeArr_plural[$str] : $str);
            }
        }
    }


    /**
     * @Desc: changeProxyStatusAjaxHandler
     * @param Request $request
     * @since   31/5/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function changeProxyStatusAjaxHandler(Request $request)
    {
        if ($request->isMethod('post')) {
            $proxyId = $request->input('id');
            $status = $request->input('status');
            $objProxiesModel = new Proxy();
            $where = [
                'rawQuery' => 'proxy_id = ?',
                'bindParams' => [$proxyId]
            ];
            $changedStatus = $objProxiesModel->updateProxy($where, ['working_status' => $status]);
            if ($changedStatus)
                echo json_encode(['status' => 200, 'message' => 'Action Performed Successfully.']);
            else
                echo json_encode(['status' => 400, 'message' => 'Some Error Occurred. Please reload the page and try again.']);
        }

    }

    /**
     * @Desc: addProxy
     * @param Request $request
     * @since  31/5/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */

    public function addProxy(Request $request)
    {
        if ($request->isMethod('post')) {
            $result = $request->input('formData');
            $ip = $request->input('ip');
            $objModelProxy = new Proxy();

            if ($result[2]['value'] == "privateProxy") {
                $AddProxy['proxy_type'] = 'private';
                $AddProxy['username'] = $result[3]['value'];
                $AddProxy['password'] = $result[4]['value'];
            } else if ($result[2]['value'] == "publicProxy") {
                $AddProxy['proxy_type'] = 'public';
                $AddProxy['username'] = '';
                $AddProxy['password'] = '';
            }
            $where = [
                'rawQuery' => 'ip = ?',
                'bindParams' => [$result[0]['value']]
            ];
            $findQuery = json_decode($objModelProxy->getPRoxyDetails($where));
            if (count($findQuery) > 0) {
                return json_encode(['status' => 400, 'message' => 'This proxy has already taken!!']);
            } else {

                $AddProxy = [
                    'ip' => $result[0]['value'],
                    'port' => $result[1]['value'],
                    'proxy_type' => ($result[2]['value'] == "privateProxy") ? 'private' : 'public',
                    'username' => ($result[2]['value'] == "privateProxy") ? $result[3]['value'] : '',
                    'password' => ($result[2]['value'] == "privateProxy") ? $result[4]['value'] : '',
                    'busy_status' => 'F',
                    'working_status' => 'A',
                    'proxy_hit_count' => 0,
                    'execution_time' => 0,
                    'last_used_at' => time(),
                ];
                $addedProxy = $objModelProxy->addProxy($AddProxy);
                if ($addedProxy)
                    echo json_encode(['status' => 200, 'message' => ' NewProxy  has been added successfully. ']);
                else
                    echo json_encode(['status' => 400, 'message' => 'Some Error occurred. Please reload the page and try again later']);
            }
        }

    }


//  Excel File Into DB

    /**
     * @Desc ProxiesIntoDB Excel Shit
     * @param Request $request
     * @since  5 April  2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function ProxiesIntoDB(Request $request)
    {

        if ($request->hasFile('excel_file')) {


            $path = $request->file('excel_file')->getRealPath();
            $data = \Excel::load($path)->get();
            $validator = Validator::make($request->all(), [
                'excel_file' => 'required|mimes:xls,xlsx',
            ]);
            if ($validator->fails()) {
                echo json_encode(['status' => 400, 'message' => array_values(json_decode($validator->messages(), true))[0][0]]);
                die;
            }

            if ($data->count()) {
                $objModelProxy = new Proxy();
                $dataForAddProxy = "";

                foreach ($data as $key => $value) {
                    if (empty($value->ip)) break;
                    $ip = trim($value->ip);
                    $port = trim($value->port);
                    $username = trim($value->username);
                    $password = trim($value->password);
                    $location = trim($value->loc);
                    $dataForAddProxy .= "('$ip','$port','private','$username','$password','$location','F','A',0,0,0),";
//                    $dataForAddProxy .= "('$ip','$port','private','$username','$password','$location','F','A',0,0,".time()."),";
                }
                if (!empty($dataForAddProxy)) {
                    $columnName = 'ip,port,proxy_type,username,password,location,busy_status,working_status,proxy_hit_count,execution_time,last_used_at';
                    $addedProxy = $objModelProxy->updateMultipleRows($columnName, rtrim($dataForAddProxy, ','));
                    if ($addedProxy) {
                        echo json_encode(['status' => 200, 'message' => "$addedProxy new proxies has been imported."]);
                    } else
                        echo json_encode(['status' => 400, 'message' => "No new proxies to add."]);
                }
            }
        } else {
            echo json_encode(['status' => 400, 'message' => 'Request data does not have any files to import.']);
        }


    }


    public function TextFileIntoDB(Request $request)
    {
        if ($request->hasFile('text_file')) {
            $path = $request->file('text_file')->getRealPath();


            $validator = Validator::make($request->all(), [
                'text_file' => 'required|mimes:txt',
            ]);
            if ($validator->fails()) {
                echo json_encode(['status' => 400, 'message' => array_values(json_decode($validator->messages(), true))[0][0]]);
                die;
            }
            $Textfile = fopen($path, "r") or die("file cannot open");

            $resultdata = [];
            while (!feof($Textfile)) {
                $resultdata[] = fgets($Textfile);
            }

            $objModelProxy = new Proxy();
            foreach ($resultdata as $key => $value) {
                $Columns = explode(":", $value);
                if (count($Columns) > 1) {
                    $where = [
                        'rawQuery' => 'ip = ?',
                        'bindParams' => [trim($Columns[0])]
                    ];
                    $findQuery = json_decode($objModelProxy->getPRoxyDetails($where));
                    if (count($findQuery) > 0) {
                        return json_encode(['status' => 400, 'message' => 'This proxy has already taken!!']);
                    } else {
                        $AddProxy = [
                            'ip' => trim($Columns[0]),
                            'port' => trim($Columns[1]),
                            'proxy_type' => 'private',
                            'username' => (count($Columns) > 2) ? trim($Columns[2]) : '',
                            'password' => (count($Columns) > 2) ? trim($Columns[4]) : '',
                            'busy_status' => 'F',
                            'working_status' => 'A',
                            'proxy_hit_count' => 0,
                            'execution_time' => 0,
                            'last_used_at' => 0,
                        ];
                        $addedProxy = $objModelProxy->addProxy($AddProxy);
//                    if ($addedProxy) {
//                        echo json_encode(['status' => 200, 'message' => "New proxies has been imported."]);
//                    } else
//                        echo json_encode(['status' => 400, 'message' => "No new proxies to add."]);
                    }
                }
            }
            if ($addedProxy) {
                return json_encode(['status' => 200, 'message' => "New proxies has been imported."]);
            } else {
                return json_encode(['status' => 400, 'message' => "No new proxies to add."]);
            }

        } else {
            echo json_encode(['status' => 400, 'message' => 'Request data does not have any files to import.']);

        }
    }


    public function deleteAll(Request $request)
    {
        if ($request->isMethod('post')) {
            $proxy_id = $request->proxy_id;
            $proxy_ids = explode(',', $proxy_id);
            $objModelProxy = new Proxy();

            foreach ($proxy_ids as $k => $val) {
                DB::table("proxies")->where('proxy_id', $val)->delete();
            }
            return response()->json(['success' => "Proxy Deleted successfully."]);
        }
    }


}


















