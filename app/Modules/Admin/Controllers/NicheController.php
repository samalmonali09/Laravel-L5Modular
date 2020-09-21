<?php


namespace App\Modules\Admin\Controllers;

use App\Modules\Admin\Models\Niche;
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

class NicheController extends Controller
{

    /**
     * @Desc: NicheTable
     * @param Request $request
     * @since  23/7/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function NicheTable(Request $request)
    {
        $data = DB::table('niches')->get();
        $status = (isset($data[0]) && isset($data[0]->status)) ? $data[0]->status : 0;
        return view('Admin::Niche/Niche', ['data' => $data, 'status' => $status]);
    }

    /**
     * @Desc: NicheAjaxHandler
     * @param Request $request
     * @since  23/7/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function NicheAjaxHandler(Request $request)
    {
        {
            $requestParam = $request->all();
            $objUserModel = new Niche();
            $whereCond = [
                'rawQuery' => '1',
            ];


            $iTotalRecords = count($objUserModel->getnichesDetails($whereCond));
            $iTotalFilteredRecords = $iTotalRecords;
            $iDisplayLength = intval($requestParam['length']);
            $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
            $iDisplayStart = intval($requestParam['start']);
            $sEcho = intval($requestParam['draw']);

            $records = array();
            $records["data"] = array();

            $columns = array(
                'niches.niche_id',
                'niches.niche',
                'niches.total_account',
                'niches.status',
            );
            $sortingOrder = "";
//            if (isset($requestParam['order'])) {
//                $sortingOrder = [$columns[$requestParam['order'][0]['column'] - 1], $requestParam['order'][0]['dir']];
//            }

            if (isset($requestParam['order']) && $requestParam['order'][0]['column'] != 0) {
                $sortingOrder = [$columns[$requestParam['order'][0]['column'] - 1], $requestParam['order'][0]['dir']];
            }else{
                $sortingOrder = [$columns[$requestParam['order'][0]['column']], $requestParam['order'][0]['dir']];
            }



            // Filtering datatable code
            $filteringRules = [];
            if (isset($requestParam['action']) && $requestParam['action'] == 'filter' && $requestParam['action'][0] != 'filter_cancel') {
                if ($requestParam['search_niche_id'] != '') {
                    $filteringRules[] = "(niches.niche_id LIKE '%" . $requestParam['search_niche_id'] . "%' )";
                }
                if ($requestParam['search_niche'] != '') {
                    $filteringRules[] = "(niches.niche LIKE '%" . $requestParam['search_niche'] . "%' )";
                }
                if ($requestParam['search_total_account'] != '') {
                    $filteringRules[] = "(niches.total_account LIKE '%" . $requestParam['search_total_account'] . "%' )";
                }
                if ($requestParam['search_status'] != '') {
                    $filteringRules[] = "(niches.status LIKE '%" . $requestParam['search_status'] . "%' )";
                }
                if (!empty($filteringRules)) {
                    $whereCond['rawQuery'] .= " AND " . implode(" AND ", $filteringRules);
                }
            }


            $result = $objUserModel->getAllFilterniches($whereCond, $sortingOrder, $iDisplayStart, $iDisplayLength);
            $result = json_decode(json_encode($result), true);

            foreach ($result as $key => $value) {

                $details = ' <a href="javascript:;"><button class="btn btn-xs btn-blue"  title="Delete" id="deleteCommnet" data-id=' . $value['niche_id'] . '><i class="fa fa-trash"></i>Delete</button></a>
                             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" class="editUserdetails" data-toggle="modal" title="Edit" data-target="#editUserModal" data-id="' . $value['niche_id'] . '">
                              <button class="btn btn-xs btn-info">Edit</button></span>
                              </a>';


                $status = '';
                if ($value['status'] == 0) {
                    $status = '<a data-id="' . $value['niche_id'] . '" data-status="1"
                           class="changeStatus label label-danger" style="cursor:pointer;">hide</a>';
                } else if ($value['status'] == 1) {
                    $status = '<a data-id="' . $value['niche_id'] . '" data-status="0"
                       class="changeStatus label label-success" style="cursor:pointer;">show</a>';
                }


                $records['data'][] = array(
//                    '<input type="checkbox" class="orderCheckBox" name="niche_id[]" value="' . $value['niche_id'] . '">',
                    $value['niche_id'],
                    $value['niche'],
                    $value['total_account'],
                    $status,
                    $details

                );
            }
            $records["draw"] = $sEcho;
            $records["recordsTotal"] = $iTotalRecords;
            $records["recordsFiltered"] = $iTotalRecords; //$iTotalFilteredRecords
            echo json_encode($records, true);
        }
    }


    /**
     * @Desc: buttonChangeAjax
     * @param Request $request
     * @since  23/7/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function buttonChangeAjax(Request $request)
    {
        if ($request->isMethod('post')) {
            $admindataparse = new Niche();
            $whereForUpdate = ['rawQuery' => 'niche_id = ?', 'bindParams' => [$request->input('niche_id')]];
            $dataToUpdate = ['status' => $request->input('status')];
            $updated = $admindataparse->updateNicheStatus($whereForUpdate, $dataToUpdate);
            if ($updated)
                echo json_encode(['status' => 200, 'message' => ' Action Performed Sucessfully']);
            else echo json_encode(['status' => 400, 'message' => 'Something went wrong, please try again.']);

        } else {

            echo json_encode(['status' => 401, 'message' => 'Request not allowed, Only post request is allowed']);
        }

    }


    /**
     * @Desc: EditAjaxHandlerNiche
     * @param Request $request
     * @since  23/7/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function EditAjaxHandlerNiche(Request $request)
    {
        if ($request->isMethod('post')) {
            $objPlanModel = new Niche();
            $userDetails = $objPlanModel->fetchNicheId($request->input('niche_id'));
            $userDetails = json_decode(json_encode($userDetails), true);
            if ($userDetails)
                echo json_encode(['status' => 200, 'msg' => 'Niche details found.', 'data' => $userDetails]);
            else
                echo json_encode(['status' => 400, 'msg' => 'Niche details not found.']);
        } else {
            echo json_encode(['status' => 401, 'msg' => 'Request couldnt be completed,Only post method is allowed.']);
        }

    }

    /**
     * @Desc: UpdateAjaxHandelerNiche
     * @param Request $request
     * @since  23/7/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function UpdateAjaxHandelerNiche(Request $request)
    {
        {
            if ($request->isMethod('post')) {
                $validator = Validator::make($request->all(), [
                    'niche' => 'required',
                    'status' => 'required',
                    'total_account' => 'required|regex:/^\d*(\.\d{1,2})?$/',
                ]);
                if ($validator->fails()) {
                    echo json_encode(['status' => 400, 'message' => array_values(json_decode($validator->messages(), true))[0][0]]);
                    die;
                }
                $postData = $request->all();
                $admindataparse = new Niche();
                $whereForUpdate = ['rawQuery' => 'niche_id = ?', 'bindParams' => [$postData['niche_id']]];
                unset($postData['niche_id']);
                $updated = $admindataparse->updateNichedetails($whereForUpdate, $postData);
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
    }

    /**
     * @Desc: deleteAjaxHandlerNiche
     * @param Request $request
     * @since  23/7/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function deleteAjaxHandlerNiche(Request $request)
    {
        if ($request->isMethod('post')) {
            $niche_id = $request->input('niche_id');
            $objModelNiche = new Niche();
            $whereForDelete = array(
                'rawQuery' => 'niche_id = ?',
                'bindParams' => [$niche_id]
            );
            $objModelNiche = $objModelNiche->deleteNiche($whereForDelete);
            if ($objModelNiche) {
                echo json_encode(array('status' => '200', 'message' => 'Niche  has been successfully deleted'));
            } else {
                echo json_encode(array('status' => '400', 'message' => 'error'));
            }
        }
    }

    /**
     * @Desc: switchActionAjax
     * @param Request $request
     * @since  23/7/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function switchActionAjax(Request $request)
    {
        if ($request->isMethod('post')) {
            $niche_id = $request->input('niche_id');
            $bjectModelNiche = new Niche();
            $updated = $bjectModelNiche->updateNichedetails2(['status' => $niche_id]);
            if ($updated) {
                echo json_encode(array('status' => '200', 'message' => 'Niche  has been successfully hide', 'nicheData' => $niche_id));
            } else {
                echo json_encode(array('status' => '400', 'message' => 'error'));
            }
        }
    }


    /**
     * @Desc: AddNiche
     * @param Request $request
     * @since  23/7/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function AddNiche(Request $request)
    {
        if ($request->isMethod('post')) {

            $rules = [
                'niche' => 'required',
            ];
            $message = [
                'niche' => 'Please Enter plan_name',
            ];
            $validator = validator::make($request->input(), $rules, $message);
            if ($validator->fails()) {
                return back()->WithErrors($validator)->WithInput();
            }

            $fillable = array();
            $fillable['niche'] = $request->input('niche');
            $fillable['total_account'] = "0";
            $fillable['status'] = "1";
            $objModelniche = new Niche();
            $result = $objModelniche->addNiche($fillable);
            if ($result) {
                return back()->with('planMsg', 'Niche has been added successfully.');
            } else {
                return back()->with('planMsg', 'Something went wrong, please try after sometime.');

            }
        }
        return view('Admin::Niche/AddNiche');


    }

    public function test(Request $request)
    {
//        dd();
        return $request->all();
    }

}