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

class StatsAdBanner extends Controller
{


    /**
     * @Desc: imagesUpload
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since  12/4/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
        
    public function imagesAddstarts(Request $request)
        
        
    {
        $whereForAnd = [
            'rawQuery' => 'banner_for = ? and banner_device = 1',
            'bindParams' => [6]
        ];
        $whereForIos = [
            'rawQuery' => 'banner_for = ? and banner_device = 2',
            'bindParams' => [6]
        ];
        $objPlanModel = new Banner();
        $androidBannerDetails = json_decode($objPlanModel->fetchQuery($whereForAnd), true);
        $iosBannerDetails = json_decode($objPlanModel->fetchQuery($whereForIos), true);
//        dd($androidBannerDetails,$iosBannerDetails);

        return view('Admin::Banner.AdBanner', ['androidBanner' => $androidBannerDetails, 'iosBanner' => $iosBannerDetails]);

    }


    /**
     * @Desc: singleimage
     * @param Request $request
     * @since  12/4/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function singleimage(Request $request)
    {

        if ($request->isMethod('post')) {
//dd($request->all());
            $receiveImage = $request->file('file');
            $num = rand(1000, 9999);
            $uploadedImage = date('d_m') . '_' . time() . $num . '.' . $receiveImage->getClientOriginalExtension();
            //         dd($uploadedImage);

            request()->file->move(public_path('assets/images/bannerIos'), $uploadedImage);
            if ($uploadedImage) {
                echo json_encode([
                    'status' => 200,
                    'msg' => 'Image has been uploaded.',
                    'data' => env('APP_URL1') . '/assets/images/bannerIos/' . $uploadedImage
                ]);
            } else {
                echo json_encode([
                    'status' => 400,
                    'msg' => 'Sorry, there was an error uploading your file.'
                ]);
            }




        }

    }







///  update Image for Ios
    public function imageupdateForIOS(Request $request){

        if ($request->isMethod('post')) {
            $dir = public_path() . '/assets/images/bannerIos';
            $filename = time() . '_' . basename($_FILES['file']['name']);
            $filePath = $dir . '/' . $filename;
            $whereCondition = ['rawQuery' => 'banner_id = ?', 'bindParams' => [$request['bannerId']]];
            $objModelImage = new Banner();


            if (move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
                $dataToUpdate = [
                    'banner_image' => env('APP_URL1') . '/assets/images/bannerIos/' . $filename,
                    'banner_url' => $request['bannerUrl'],
                    'banner_for' => '6',
                    'banner_device' => '1',
                ];

                $updated = $objModelImage = $objModelImage->updateImageIos($whereCondition, $dataToUpdate);


                echo json_encode(['status' => 200, 'msg' => 'image uploaded in bannerIos', 'data' => $filename]);
            } else {
                echo json_encode(['status' => 400, 'msg' => 'some error occurred', 'data' => null]);

            }

        }



    }
//    }


    /**
     * @Desc: singleImageAndroid
     * @param Request $request
     * @since 12/4/ 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function singleImageAndroid(Request $request)
    {
        if ($request->isMethod('post')) {
            $dir = public_path() . '/assets/images/bannerAndroid';
            $filename = time() . '_' . basename($_FILES['file']['name']);
            $filePath = $dir . '/' . $filename;
            $whereCondition = ['rawQuery' => 'banner_id = ?', 'bindParams' => [$request['bannerId']]];
            $objModelImage = new Banner();


            if (move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
                $dataToUpdate = [
                    'banner_image' => env('APP_URL1') . '/assets/images/bannerAndroid/' . $filename,
                    'banner_url' => $request['bannerUrl'],
                    'banner_for' => '6',
                    'banner_device' => '1',
                ];

                $updated = $objModelImage = $objModelImage->updateImageAnd($whereCondition, $dataToUpdate);


                echo json_encode(['status' => 200, 'msg' => 'image uploaded in Android', 'data' => $filename]);
            } else {
                echo json_encode(['status' => 400, 'msg' => 'some error occurred', 'data' => null]);

            }

        }

    }

    /**
     * @Desc: deleteAjaxHandlerImage
     * @param Request $request
     * @since   12/4/ 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function deleteAjaxHandlerImageIOS(Request $request)
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
     * @Desc:-insertImage Ios functionality
     * @param Request $request
     * @since 14/4/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function insertImage(Request $request)
    {
        if ($request->isMethod('post')) {

            $dir = public_path() . '/assets/images/bannerIos';
            $filename = time() . '_' . basename($_FILES['file']['name']);
            $filePath = $dir . '/' . $filename;
            $banner_url = $request['bannerUrl'];
            if (move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
                echo " file uploaded";

                $objModelImage = new Banner();


                $dataInsertTo = [
                    'banner_image' => env('APP_URL1') . '/assets/images/bannerIos/' . $filename,
                    'banner_url' => $request['bannerUrl'],
                    'banner_for' => '6',
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
     * @Desc->InserImageAndroid functionality Android
     * @param Request $request
     * @since  2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function InserImageAndroid(Request $request)
    {

        if ($request->isMethod('post')) {

            $dir = public_path() . '/assets/images/bannerAndroid';
            $filename = time() . '_' . basename($_FILES['file']['name']);
            $filePath = $dir . '/' . $filename;
            $banner_url = $request['bannerUrl'];

            if (move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
                echo " file uploaded";

                $objModelImage = new Banner();
                $dataInsertTo = [
                    'banner_image' => env('APP_URL1') . '/assets/images/bannerAndroid/' . $filename,
                    'banner_url' => $request['bannerUrl'],
                    'banner_for' => '6',
                    'banner_device' => '1',
                ];
                $insertdb = $objModelImage->addImageToDB($dataInsertTo);
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

    /**
     * @Desc:---deleteAjaxHandlerImageAndroid
     * @param Request $request
     * @since   14/4/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function deleteAjaxHandlerImageAndroid(Request $request)
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
     * @Desc: InstaStartsBanner
     * @param Request $request
     * @since  10 may 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function InstaStartsBanner(Request $request)
    {
        if ($request->isMethod('get')) {

            $objectModalImage = new Banner();

            $bannerDetails = $objectModalImage->getOneBannerDetails();
//            dd($bannerDetails);
            $bannerDetails = json_decode(json_encode($bannerDetails), true);
//            dd(json_encode($bannerDetails));
            if ($bannerDetails)
                echo json_encode(['status' => 200, 'message' => 'Banner details', 'data' => ['banner_image' => $bannerDetails['banner_image'], 'banner_url' => $bannerDetails['banner_url']]]);
            else echo json_encode(['status' => 400, 'message' => 'Something went wrong, please try again.']);

        } else {

            echo json_encode(['status' => 401, 'message' => 'Request not allowed, Only post request is allowed']);
        }

    }





    function uploadImageToStoragePath($image, $folderName = null, $fileName = null, $imageWidth = 1024, $imageHeight = 1024)
    {
        $destinationFolder = '/assets/images/bannerIos';
        if ($folderName != '') {
            $folderNames = explode('_', $folderName);
            $folderPath = implode('/', array_map(function ($value) {
                return $value;
            }, $folderNames));
            $destinationFolder .= $folderPath . '/';
        }
        $destinationPath = public_path($destinationFolder);
        if (!File::exists($destinationPath)) File::makeDirectory($destinationPath, 0777, true, true);
        $filename = ($fileName != '') ? $fileName : $folderName . '_' . time() . '.jpg';

        $imageResult = Image::make($image)->resize($imageWidth, $imageHeight, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath . $filename, imageQuality($image));
        dd($imageResult);
//        if ($imageResult)
        $image->move($destinationPath,$filename);
        return $filename;
















//        return false;
    }
}




