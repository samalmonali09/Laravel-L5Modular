<?php

namespace App\Modules\Admin\Controllers;

use App\Modules\Admin\Models\Instagram;
use App\Modules\Admin\Models\Order;

//use App\Modules\Admin\Models\Admin;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Null_;
use users;
use DataTables;


class InstagramController extends Controller
{
    protected $instaURL, $guzzleObj, $pageInfo, $header_for_insta_api;


    /**
     * InstagramController constructor.
     */
//    public function __construct()
//    {
//        $this->pageInfo = array(
////            'route' => Route::current()->uri,
//            'name' => '',
//            'parentName' => ''
//        );
//        $this->instaURL = 'https://www.instagram.com/';
//        $this->guzzleObj = new Client();
//        $this->header_for_insta_api = ['headers' => ['Cookie' => 'ig_pr=1']];
//    }

    public function InstgarmTable(Request $request)
    {
        $data = DB::table('instagram_accounts')->get();
        return view('Admin::Instagram/InstagramProfile', ['data' => $data]);


    }


    /**
     * @Desc:InstagramAjaxHandeler
     * @param Request $request
     * @since 26/10/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function InstagramAjaxHandeler(Request $request)
    {

        $requestParam = $request->all();
        $objectModel = new Instagram();

        $whereCond = ['rawQuery' => 1,
        ];

        $iTotalRecords = count($objectModel->getInstagramDetails($whereCond));
        $iTotalFilteredRecords = $iTotalRecords;
        $iDisplayLength = intval($requestParam['length']);
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        $iDisplayStart = intval($requestParam['start']);
        $sEcho = intval($requestParam['draw']);

        $record = array();

        $record["data"] = array();

        $columns = array(
            'instagram_accounts.instagram_accounts_id',
            'instagram_accounts.account_username',
            'instagram_accounts.proxy_ip',
            'instagram_accounts.proxy_port',
            'instagram_accounts.account_session_details'


        );
        $sortingOrder = "";
        if (isset($requestParam['order'])) {
            $sortingOrder = [$columns[$requestParam['order'][0]['column'] - 1], $requestParam['order'][0]['dir']];
        }
        $filteringRules = [];

        if (isset($requestParam['action']) && $requestParam['action'] == 'filter' && $requestParam['action'][0] != 'filter_cancel') {

            if ($requestParam['search_instagram_accounts_id'] != '') {
                $filteringRules[] = "(instagram_accounts.instagram_accounts_id LIKE '%" . $requestParam['search_instagram_accounts_id'] . "%' )";
            }
            if ($requestParam['search_account_username'] != '') {
                $filteringRules[] = "(instagram_accounts.account_username LIKE '%" . $requestParam['search_account_username'] . "%')";
            }
            if ($requestParam['search_proxy_ip'] != '') {
                $filteringRules[] = "(instagram_accounts.proxy_ip LIKE '%" . $requestParam['search_proxy_ip'] . "%')";
            }

            if ($requestParam['search_proxy_port'] != '') {
                $filteringRules[] = "(instagram_accounts.proxy_port LIKE '%" . $requestParam['search_proxy_port'] . "%')";
            }
            if ($requestParam['search_account_session_details'] != '') {
                $filteringRules[] = "(instagram_accounts.account_session_details LIKE '%" . $requestParam['search_proxy_port'] . "%')";
            }
            if (!empty($filteringRules)) {
                $whereCond['rawQuery'] .= " AND " . implode(" AND ", $filteringRules);
            }

        }
        $result = $objectModel->getAllFilterInstagramDetails($whereCond, $sortingOrder, $iDisplayStart, $iDisplayLength);
        $result = json_decode(json_encode($result), true);


        foreach ($result as $key => $value) {
            $details = ' <a href="javascript:;" class="show-details" data-toggle="modal"  title="Details" data-target="#showDetails" data-id="' . $value['instagram_accounts_id'] . '">
                                           <button class="btn btn-xs btn-primary">Details</button>
                                           </a> &nbsp;&nbsp;
                                           <a href="javascript:;"><i class="fa fa-trash" title="Delete" id="deleteCommnet" data-id=' . $value['instagram_accounts_id'] . '></i></a>
                                           <a href="javascript:;" class="editUserdetails" title="Edit" data-toggle="modal" data-target="#editUserModal" data-id="' . $value['instagram_accounts_id'] . '">
                                              <i class="fa fa-pencil"></i></span>
                                           </a>
                                           ';
            $account_session_details = '';
            if ($value['account_session_details'] == null) {
                $account_session_details = '<span><i class="fa  fa-times-circle animated  font-red"></i> </span>';
            } else
                $account_session_details = '<span>&nbsp;<i class="fa fa-check-circle font-green"></i>&nbsp; </span>';


            $account_username = '<p><a class="btn btn-xs default text-case link-width" href="https://instagram.com/' . $value['account_username'] . '/" target="_blank"><i style="font-size:10px" class="fa fa-instagram"></i>&nbsp;' . $value['account_username'] . '</a></p>';

            $records['data'][] = array(
                $value['instagram_accounts_id'],
                $account_username,
                $value['proxy_ip'],
                $value['proxy_port'],
                $account_session_details,
                $details,
            );
        }
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords; //$iTotalFilteredRecords
        echo json_encode($records, true);

    }


    /**
     * @Desc:AddInstagram
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @since 26/10/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function AddInstagram(Request $request)
    {
        if ($request->isMethod('post')) {
            $fillable = array();
            $fillable['status'] = "1";
            $fillable['account_userId'] = '0';
            $fillable['account_username'] = $request->input('account_username');
            $fillable['account_password'] = $request->input('account_password');
            $fillable['proxy_ip'] = $request->input('proxy_ip');
            $fillable['proxy_port'] = $request->input('proxy_port');
            $fillable['proxy_username'] = $request->input('proxy_username');
            $fillable['proxy_password'] = $request->input('proxy_password');
            $objModelplan = new Instagram();
            $result = $objModelplan->addInstagram($fillable);
            if ($result) {
                return back()->with('planMsg', 'Account  has been added successfully.');
            } else {
                return back()->with('planMsg', 'Something went wrong, please try after sometime.');
            }
        }
        return view('Admin::Instagram/AddInstagram');
    }


    /**
     * @Desc:NewAccount
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @since 30/10/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function NewAccount(Request $request)
    {
        if ($request->isMethod('post')) {

            $rules= [
                'account_username' => 'required',
                'account_password' => 'required|min:6',
                'proxy_ip' => 'required',
                'proxy_port' => 'required|min:4',
                'proxy_username' => 'required',
                'proxy_password' => 'required'
            ];
            $message = [
                'account_username' => 'Please Enter Instagram Username',
                'account_password' => 'Please Enter Instagram Account Password',
                'proxy_ip' => 'Please Enter Instagram Proxy_ip',
                'proxy_port' => 'Please Enter Instagram Proxy_port',
                'proxy_username' => 'Please Enter Instagram proxy_username',
                'proxy_password' => 'Please Enter Instagram proxy_password',
            ];


            $validator = validator::make($request->input(), $rules, $message);
            if ($validator->fails()) {
                return back()->WithErrors($validator)->WithInput();
            }
            $data = array();
            $data['account_userId'] = '0';
            $data['account_username'] = $request->input('account_username');
            $data['account_password'] = $request->input('account_password');
            $data['account_session_details'] = '0';
            $data['account_browser_details'] = '0';
            $data['proxy_ip'] = $request->input('proxy_ip');
            $data['proxy_port'] = $request->input('proxy_port');
            $data['proxy_username'] = $request->input('proxy_username');
            $data['proxy_password'] = $request->input('proxy_password');
            $objectModel = new Instagram();
            $result = $objectModel->addInstagram($data);
            if ($result) {
                return back()->with('planMsg', 'Account has been Added Successfully');
            } else {
                return back()->with('planMsg', 'Something Went Worng');
            }
        }
        return view('Admin::Instagram/NewaddInstagram');

    }


    /**
     * @Desc:packageAjaxHandlerinstgram
     * @param Request $request
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @since 26/10/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function packageAjaxHandlerinstgram(Request $request)
    {
        $method = $request->input('method');
        switch ($method) {
            case "getInstaMedia":
                $requestData = $request->all();
                $instaMediaData = $this->getInstaMedia($requestData);
                $responseData['message'] = $instaMediaData->message;
                $responseData['status'] = $instaMediaData->status;
                if ($instaMediaData->status == 'success') {
//                    dd($instaMediaData);
                    $responseData['postCount'] = $instaMediaData->count;
                    if (isset($instaMediaData->userDetails)) $responseData['userDetails'] = $instaMediaData->userDetails;
                    if ($requestData['type'] != 1) {
                        $responseData['instaMedia'] = $instaMediaData->media;
                        $responseData['end_cursor'] = $instaMediaData->media['page_info']['has_next_page'] ? $instaMediaData->media['page_info']['end_cursor'] : null;
                    } else $responseData['instaMedia'] = $instaMediaData->userDetails;
                }
                return $responseData;
                break;

            case "getTopSearch":
                $requestData = $request->all();
                $url = $this->instaURL . 'web/search/topsearch/?query=' . $request->input('keyWord');
                $client = $this->guzzleObj;
                $response = $client->request('GET', $url);
                if ($response->getStatusCode() == 200) {
                    $stringBody = (string)$response->getBody();
                    $GuzzleResponse = \GuzzleHttp\json_decode($stringBody);
                }

                $responseData['message'] = 'Data Found';
                $responseData['status'] = 'success';
                $responseData['topSearch'] = $GuzzleResponse;
                return $responseData;
                break;


        }
    }

    /**
     * @Desc:getInstaMedia
     * @param $requestData
     * @return \stdClass
     * @since 26/10/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function getInstaMedia($requestData)
    {
        try {
            $client = $this->guzzleObj;
            $instaID = $requestData['action'] == 'more' ? $requestData['instaID'] : null;
            $end_cursor = $requestData['action'] == 'more' ? $requestData['end_cursor'] : null;
            $instaDetails = new \stdClass();
            $instaDetails->message = 'Data Found';
            $instaDetails->status = 'success';

            $instaScrape = new InstagramScrape();
            if (!$instaID) {
                /* use cURL to get the user Insta media by Scraping. */
                $instaUserPost = $instaScrape->instaScrapePage(str_replace(' ', '+', trim($requestData['userName'])));
                $instaDetails->userDetails = $instaUserPost;
                $instaID = $instaUserPost['id'];
                $instaDetails->count = $instaUserPost['edge_owner_to_timeline_media']['count'];
                $instaDetails->media = $instaUserPost['edge_owner_to_timeline_media'];
            }

            if ($requestData['type'] != 1) {
                $mediaDetails = $instaScrape->getMoreMediaDetails($instaID, $end_cursor, ($requestData['type'] == 4 ? '50' : '12'));
                $instaDetails->count = $mediaDetails['data']['user']['edge_owner_to_timeline_media']['count'];
                $instaDetails->media = $mediaDetails['data']['user']['edge_owner_to_timeline_media'];
            }


            // older codes....... using GuzzleHTTP....
//            if (!$instaID) {
//                /* use Guzzle to get the user Insta media posts. */
//                $url = $this->instaURL . str_replace(' ', '+', trim($requestData['userName'])) . '/?__a=1';
//                $response = $client->request('GET', $url);
//                if ($response->getStatusCode() == 200) {
//                    $stringBody = (string)$response->getBody();
//                    $GuzzleResponse = \GuzzleHttp\json_decode($stringBody);
////                    dd($GuzzleResponse);
//                    $instaDetails->userDetails = $GuzzleResponse->graphql->user;
//                    $instaID = $GuzzleResponse->graphql->user->id;
//                    $instaDetails->count = $GuzzleResponse->graphql->user->edge_owner_to_timeline_media->count;
//                }
//
//            }
////            dd($instaDetails);
//            if ($requestData['type'] != 1) {
//                $url = $this->instaURL . 'graphql/query/?query_hash=472f257a40c653c64c666ce877d59d2b&variables={"id":"' . $instaID . '","first":' . ($requestData['type'] == 4 ? '500' : '12') . ',"after":"' . $end_cursor . '"}';
//                $response = $client->request('GET', $url, $this->header_for_insta_api);
//                if ($response->getStatusCode() == 200) {
//                    $stringBody = (string)$response->getBody();
//                    $GuzzleResponse = \GuzzleHttp\json_decode($stringBody);
//                    if (isset($instaDetails->userDetails)) unset($instaDetails->userDetails->media);
////                    dd('second', $GuzzleResponse);
//                    $instaDetails->count = $GuzzleResponse->data->user->edge_owner_to_timeline_media->count;
//                    $instaDetails->media = $GuzzleResponse->data->user->edge_owner_to_timeline_media;
//                }
//            }


//        } catch (ClientException $e) {
//            $instaDetails->message = 'Error in finding your Instagram account';
//            $instaDetails->status = 'error';
        } catch (\Exception $e) {
            $instaDetails->message = 'Error in finding your Instagram account';
            $instaDetails->status = 'error';
        }
        if ($requestData['type'] == 4) {
            $viewMedia = [];
//            dd($instaDetails, $instaDetails->media['edges']);
            foreach ($instaDetails->media['edges'] as $key => $node) {
                if ($node['node']['__typename'] == 'GraphVideo') array_push($viewMedia, $node);
            }
            $instaDetails->media['edges'] = $viewMedia;
        }
//        dd($instaDetails);
        return $instaDetails;
    }


}