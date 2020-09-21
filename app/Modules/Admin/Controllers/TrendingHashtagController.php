<?php
/**
 * Created by Monali Samal.
 * User: monali samal <monalisamal@globussoft.in>
 * Date: 4/9/2018
 * Time: 11:45 AM
 */

namespace App\Modules\Admin\Controllers;

use App\Modules\Admin\Models\Banner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
//use Yajra\Datatables\Datatables;
use Image;
use  Validator;
use users;
use DataTables;
use App\User;

class TrendingHashtagController extends Controller
{


    /**
     * @Desc:UploadImage
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     * @since 24/9/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public  function UploadImage(Request $request){

        $whereForIos = [
            'rawQuery' => 'banner_for = ? and banner_device = 2',
            'bindParams' => [8]
        ];
        $objPlanModel = new Banner();
        $iosBannerDetails = json_decode($objPlanModel->fetchQuery($whereForIos), true);

        return view('Admin::Banner.trendappBanner', ['iosBanner' => $iosBannerDetails]);

//        return view('Admin::Banner.trendappBanner');

    }


    /**
     * @Desc:singleImageHashtag
     * @param Request $request
     * @since 24/9/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function singleImageHashtag(Request $request)
    {
        if ($request->isMethod('post')) {
            $receiveImage = $request->file('file');
            $num = rand(1000, 9999);
            $uploadedImage = date('d_m') . '_' . time() . $num . '.' . $receiveImage->getClientOriginalExtension();
            request()->file->move(public_path('assets/images/hastag_img'), $uploadedImage);
            if ($uploadedImage) {
                echo json_encode([
                    'status' => 200,
                    'msg' => 'Image has been uploaded.',
                    'data' => env('APP_URL1') . '/assets/images/hastag_img/' . $uploadedImage
                ]);
            } else {
                echo json_encode([
                    'status' => 400,
                    'msg' => 'Sorry, there was an error uploading your file.'
                ]);
            }
        }

    }

    /**
     * @Desc:insertImageBanner
     * @param Request $request
     * @since 24/9/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function insertImageBanner(Request $request)
    {
        if ($request->isMethod('post')) {
            $dir = public_path() . '/assets/images/hastag_img';
            $filename = time() . '_' . basename($_FILES['file']['name']);
            $filePath = $dir . '/' . $filename;
            $banner_url = $request['bannerUrl'];
            if (move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
                echo " file uploaded";

                $objModelImage = new Banner();
                $dataInsertTo = [
                    'banner_image' => env('APP_URL1') . '/assets/images/hastag_img/' . $filename,
                    'banner_url' => $request['bannerUrl'],
                    'banner_for' => '8',
                    'banner_device' => '2',
                ];
                $insertdb = $objModelImage->addImageToDB($dataInsertTo);
                if ($insertdb) {
                    echo json_encode(['status' => 200, 'msg' => 'image uploaded in Ios', 'data' => $filename]);
                } else {
                    echo json_encode(['status' => 400, 'msg' => 'some error occurred', 'data' => null]);

                }
            }

        } else {

            echo " file not uploaded";
        }
    }


    /**
     * @Desc:deleteAjaxHandlerImage
     * @param Request $request
     * @since 24/9/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function deleteAjaxHandlerImage(Request $request)
    {
        if ($request->isMethod('post')) {
            $banner_id = $request->input('banner_id');
            $objModelImage = new Banner();
            $whereForDelete = array(
                'rawQuery' => 'banner_id = ?',
                'bindParams' => [$banner_id]
            );
            $objModelImage = $objModelImage->deleteImageWhere($whereForDelete);
            if ($objModelImage) {
                echo json_encode(array('status' => '200', 'message' => 'Image  has been successfully deleted'));
            } else {
                echo json_encode(array('status' => '400', 'message' => 'Error'));
            }
        }
    }


    /**
     * @Desc:imageupdate
     * @param Request $request
     * @since 24/9/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function imageupdate(Request $request){
        if ($request->isMethod('post')) {
            $dir = public_path() . '/assets/images/hastag_img';
            $filename = time() . '_' . basename($_FILES['file']['name']);
            $filePath = $dir . '/' . $filename;
            $whereCondition = ['rawQuery' => 'banner_id = ?', 'bindParams' => [$request['bannerId']]];
            $objModelImage = new Banner();
            if (move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
                $dataToUpdate = [
                    'banner_image' => env('APP_URL1') . '/assets/images/hastag_img/' . $filename,
                    'banner_url' => $request['bannerUrl'],
                    'banner_for' => '8',
                    'banner_device' => '2',
                ];
                $updated = $objModelImage = $objModelImage->updateImageIos($whereCondition, $dataToUpdate);
                echo json_encode(['status' => 200, 'msg' => 'image uploaded in bannerIos', 'data' => $filename]);
            } else {
                echo json_encode(['status' => 400, 'msg' => 'some error occurred', 'data' => null]);

            }
        }
    }

}