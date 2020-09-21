<?php
/**
 * Created by Monali Samal.
 * User: monali samal <monalisamal@globussoft.in>
 * Date: 13/10/2018
 * Time: 11:59 AM
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

class AutoigBannerController extends Controller
{


    public  function UploadImageAutoig(Request $request){
//        dd($request->all());

        $whereForAnd = [
            'rawQuery' => 'banner_for = ? and banner_device = 1',
            'bindParams' => [5]
        ];
        $objPlanModel = new Banner();
        $iosBannerDetails = json_decode($objPlanModel->fetchQuery($whereForAnd), true);


//        dd($iosBannerDetails);
        return view('Admin::ModuleSwitch.switchsettings', ['iosBanner' => $iosBannerDetails]);


    }

    public function imageupdateAutoig(Request $request){
        if ($request->isMethod('post')) {
            $dir = public_path() . '/assets/images/Autoig_img';
            $filename = time() . '_' . basename($_FILES['file']['name']);
            $filePath = $dir . '/' . $filename;
            $whereCondition = ['rawQuery' => 'banner_id = ?', 'bindParams' => [$request['bannerId']]];
            $objModelImage = new Banner();
            if (move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
                $dataToUpdate = [
                    'banner_image' => env('APP_URL1') . '/assets/images/Autoig_img/' . $filename,
                    'banner_url' => $request['bannerUrl'],
                    'banner_for' => '5',
                    'banner_device' => '1',
                ];
                $updated = $objModelImage = $objModelImage->updateImageIos($whereCondition, $dataToUpdate);
                echo json_encode(['status' => 200, 'msg' => 'image uploaded in banner', 'data' => $filename]);
            } else {
                echo json_encode(['status' => 400, 'msg' => 'some error occurred', 'data' => null]);

            }
        }
    }


    public function insertImageBannerAutoig(Request $request)
    {
        if ($request->isMethod('post')) {
            $dir = public_path() . '/assets/images/Autoig_img';
            $filename = time() . '_' . basename($_FILES['file']['name']);
            $filePath = $dir . '/' . $filename;
            $banner_url = $request['bannerUrl'];
            if (move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
                echo " file uploaded";
                $objModelImage = new Banner();
                $dataInsertTo = [
                    'banner_image' => env('APP_URL1') . '/assets/images/Autoig_img/' . $filename,
                    'banner_url' => $request['bannerUrl'],
                    'banner_for' => '5',
                    'banner_device' => '1',
                ];
                $insertdb = $objModelImage->addImageToDB($dataInsertTo);
//                dd($dataInsertTo);
                if ($insertdb) {
                    echo json_encode(['status' => 200, 'msg' => 'image uploaded in Android', 'data' => $filename]);
                } else {
                    echo json_encode(['status' => 400, 'msg' => 'some error occurred', 'data' => null]);
                }
            }
        } else {
            echo " file not uploaded";
        }
    }

    public function singleImageAutoig(Request $request)
    {
        if ($request->isMethod('post')) {
            $receiveImage = $request->file('file');
            $num = rand(1000, 9999);
            $uploadedImage = date('d_m') . '_' . time() . $num . '.' . $receiveImage->getClientOriginalExtension();
            request()->file->move(public_path('assets/images/Autoig_img'), $uploadedImage);
            if ($uploadedImage) {
                echo json_encode([
                    'status' => 200,
                    'msg' => 'Image has been uploaded.',
                    'data' => env('APP_URL1') . '/assets/images/Autoig_img/' . $uploadedImage
                ]);
            } else {
                echo json_encode([
                    'status' => 400,
                    'msg' => 'Sorry, there was an error uploading your file.'
                ]);
            }
        }

    }

    public function deleteAjaxHandlerImageAutoig(Request $request)
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



}