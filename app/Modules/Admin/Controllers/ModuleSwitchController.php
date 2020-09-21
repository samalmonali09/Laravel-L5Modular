<?php
/**
 * Created by Monali Samal.
 * User: monali samal <monalisamal@globussoft.in>
 * Date: 3/6/2018
 * Time: 11:45 AM
 */

namespace App\Modules\Admin\Controllers;


use App\Modules\Admin\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

class ModuleSwitchController extends Controller
{


    public function moduleStatus(Request $request)
    {
        if ($request->isMethod('post')) {

            $webConfigPath = base_path() . '/config/module_switch.php';
            $apiConfigPath = base_path() . '/../api/config/module_switch.php';
            $fileContent = "<?php
            return [
                'module_switch_status'=>'" . $request->all()['module_switch'] . "'
            ];";
            file_put_contents($webConfigPath, $fileContent);
            if (file_exists($apiConfigPath)) {

                file_put_contents($apiConfigPath, $fileContent);
            } else
                die('path not found');
        }

        $status = config('module_switch.module_switch_status');
        $url = env('APP_URL') . '/' . config('whitebanner.banner_img_url');

        return view("Admin::ModuleSwitch.ModuleSwitch", ['status' => $status, 'image' => $url]);
    }


    public function whiteBannerImage(Request $request)
    {
        if ($request->isMethod('post')) {
            $receiveImage = $request->file('file');
            $num = rand(1000, 9999);
            $uploadedImage = 'banner_img' . '/' . time() . $num . '.' . $receiveImage->getClientOriginalExtension();

            request()->file->move(public_path('/banner_img'), $uploadedImage);
            $webConfigPath = base_path() . '/config/whitebanner.php';
            $apiConfigPath = base_path() . '/../api/config/whitebanner.php';

//            $apiConfigPath = base_path() . '. . /api/public/banner_img';
            $fileContent = "<?php
            return [
                'banner_img_url'=>'" . $uploadedImage . "'

            ];";
            file_put_contents($webConfigPath, $fileContent);
            file_put_contents($apiConfigPath, $fileContent);
            if ($uploadedImage) {
                echo json_encode([
                    'status' => 200,
                    'msg' => 'Image has been uploaded.',
                    'data' => env('APP_URL') . '/' . $uploadedImage
                ]);
            } else {
                echo json_encode([
                    'status' => 400,
                    'msg' => 'Sorry, there was a    n error uploading your file.'
                ]);
            }


        }

    }


//    public function moduleStatusGILR(Request $request)
//    {
////        dd($request->all());
//        if ($request->isMethod('post')) {
//
//            $webConfigPath = base_path() . '/config/module_switchGILR.php';
//            $apiConfigPath = base_path() . '/../api/config/module_switchGILR.php';
//            $fileContent = "<?php
//            return [
//                'module_switch_statusGILR'=>'" . $request->all()['module_switchGILR'] . "'
//            ];";
//            file_put_contents($webConfigPath, $fileContent);
//            if (file_exists($apiConfigPath)) {
//
//                file_put_contents($apiConfigPath, $fileContent);
//            } else
//                die('path not found');
//        }
//
//        $status = config('module_switchGILR.module_switch_statusGILR');
////       $url = env('APP_URL') . '/' . config('whitebanner.banner_img_url');
//
//        return view("Admin::ModuleSwitch.ModuleSwitchGILR", ['status' => $status]);
//    }


    public function moduleStatusAUTOIG(Request $request)
    {
//        dd($request->all());
        if ($request->isMethod('post')) {

            $webConfigPath = base_path() . '/config/module_switchAUTOIG.php';
            $apiConfigPath = base_path() . '/../api/config/module_switchAUTOIG.php';
            $fileContent = "<?php
            return [
                'module_switch_statusAUTOIG'=>'" . $request->all()['module_switchAUTOIG'] . "'
            ];";
            file_put_contents($webConfigPath, $fileContent);
            if (file_exists($apiConfigPath)) {

                file_put_contents($apiConfigPath, $fileContent);
            } else
                die('path noteasdfasdf');
        }

        $status = config('module_switchAUTOIG.module_switch_statusAUTOIG');
//       $url = env('APP_URL') . '/' . config('whitebanner.banner_img_url');

        return view("Admin::ModuleSwitch.ModuleSwitchAUTOIG", ['status' => $status]);
    }


    public function EmergencyStatusAutoIg(Request $request)
    {
        if ($request->isMethod('post')) {

            $webConfigPath = base_path() . '/config/EmergencySwitch.php';
            $apiConfigPath = base_path() . '/../api/config/EmergencySwitch.php';
            $fileContent = "<?php
            return [
                'Emergency_switch_Autoig'=>'" . $request->all()['EmergencySwitch'] . "'
            ];";
            file_put_contents($webConfigPath, $fileContent);
            if (file_exists($apiConfigPath)) {

                file_put_contents($apiConfigPath, $fileContent);
            } else
                die('path noteasdfasdf');
        }

        $status = config('EmergencySwitch.Emergency_switch_Autoig');
        return view("Admin::ModuleSwitch.EmergencyAutoig", ['status' => $status]);
    }


    public function GiftIcon(Request $request)
    {
        if ($request->isMethod('post')) {

            $webConfigPath = base_path() . '/config/GiftIcon.php';
            $apiConfigPath = base_path() . '/../api/config/GiftIcon.php';
            $fileContent = "<?php
            return [
                'Gift_Icon_Autoig'=>'" . $request->all()['GiftIcon'] . "'
            ];";
            file_put_contents($webConfigPath, $fileContent);
            if (file_exists($apiConfigPath)) {

                file_put_contents($apiConfigPath, $fileContent);
            } else
                die('path noteasdfasdf');
        }
        $status = config('GiftIcon.Gift_Icon_Autoig');
        return view("Admin::ModuleSwitch.GiftIcon", ['status' => $status]);

    }


    public function SettingSwitch(Request $request)
    {
        if ($request->isMethod('post')) {
            if ($request->input('time') == 30) {
                $time = $request->input('time');
            } else {
                $time = $request->input('time') * 60;
            }
            $webConfigPath = base_path() . '/config/GiftIcon.php';
            $apiConfigPath = base_path() . '/../api/config/GiftIcon.php';
            $webConfigPath1 = base_path() . '/config/EmergencySwitch.php';
            $apiConfigPath1 = base_path() . '/../api/config/EmergencySwitch.php';
            $webConfigPath2 = base_path() . '/config/module_switchAUTOIG.php';
            $apiConfigPath2 = base_path() . '/../api/config/module_switchAUTOIG.php';
            $webConfigPath3 = base_path() . '/config/Activity_tracker.php';
            $apiConfigPath3 = base_path() . '/../api/config/Activity_tracker.php';


            if (isset($request->all()['Activity_tracker']) && !empty($request->all()['Activity_tracker'])) {
                $fileContent3 = "<?php
            return [
                'Activity_TrackerAUTOIG'=>'" . $request->all()['Activity_tracker'] . "',
                                'time'=>'" . $time . "'

            ];";

                file_put_contents($webConfigPath3, $fileContent3);
                if (file_exists($apiConfigPath3)) {

                    file_put_contents($apiConfigPath3, $fileContent3);
                } else
                    die('path noteasdfasdf');
            }

            if (isset($request->all()['GiftIcon']) && !empty($request->all()['GiftIcon'])) {
                $fileContent = "<?php
            return [
                'Gift_Icon_Autoig'=>'" . $request->all()['GiftIcon'] . "'
            ];";

                file_put_contents($webConfigPath, $fileContent);
                if (file_exists($apiConfigPath)) {

                    file_put_contents($apiConfigPath, $fileContent);
                } else
                    die('path noteasdfasdf');
            }

            if (isset($request->all()['EmergencySwitch']) && !empty($request->all()['EmergencySwitch'])) {
                $fileContent1 = "<?php
            return [
               'Emergency_switch_Autoig'=>'" . $request->all()['EmergencySwitch'] . "'

            ];";
                file_put_contents($webConfigPath1, $fileContent1);

                if (file_exists($apiConfigPath1)) {

                    file_put_contents($apiConfigPath1, $fileContent1);
                } else
                    die('path noteasdfasdf');

            }

            if (isset($request->all()['module_switchAUTOIG']) && !empty($request->all()['module_switchAUTOIG'])) {
                $fileContent2 = "<?php
            return [
                'module_switch_statusAUTOIG'=>'" . $request->all()['module_switchAUTOIG'] . "'

            ];";
                file_put_contents($webConfigPath2, $fileContent2);

                if (file_exists($apiConfigPath2)) {

                    file_put_contents($apiConfigPath2, $fileContent2);
                } else
                    die('path noteasdfasdf');
            }

        }

        $gifticon = config('GiftIcon.Gift_Icon_Autoig');
        $emergencySwitch = config('EmergencySwitch.Emergency_switch_Autoig');
        $moduleswitch = config('module_switchAUTOIG.module_switch_statusAUTOIG');
        $Tracker = config('Activity_tracker.Activity_TrackerAUTOIG');
//        $Tracker1 = config('Activity_tracker.time')/600000 .' min';
        if (config('Activity_tracker.time') == '30') {
            $Tracker1 = config('Activity_tracker.time') . ' sec';
        } else {
            $Tracker1 = config('Activity_tracker.time') / 60 . ' min';
        }
//        if($Tracker1 == '0 min'){
//            $timedata='Select Time';
//        }else{
//            $timedata=$Tracker1;
//        }

        $whereForAnd = [
            'rawQuery' => 'banner_for = ? and banner_device = 1',
            'bindParams' => [5]
        ];
//dd($timedata);
        $objPlanModel = new Banner();
        $iosBannerDetails = json_decode($objPlanModel->fetchQuery($whereForAnd), true);
        return view("Admin::ModuleSwitch.switchsettings", ['gifticon' => $gifticon, 'time' => $Tracker1, 'emergencySwitch' => $emergencySwitch, 'moduleswitch' => $moduleswitch, 'Tracker' => $Tracker, 'iosBanner' => $iosBannerDetails]);

    }


    /**
     * @Desc:ModuleSwitchGIVR
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since 23/10/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function ModuleSwitchGIVR(Request $request)
    {
        if ($request->isMethod('post')) {

            $webConfigPath = base_path() . '/config/module_switchGIVR.php';
            $apiConfigPath = base_path() . '/../api/config/module_switchGIVR.php';

            $fileContent = "<?php
            return [
                'module_switch_statusGIVR'=>'" . $request->all()['module_switchGIVR'] . "'
            ];";

            file_put_contents($webConfigPath, $fileContent);
            if (file_exists($apiConfigPath)) {
                file_put_contents($apiConfigPath, $fileContent);
            } else
                die('path noteasdfasdf');
        }
        $status = config('module_switchGIVR.module_switch_statusGIVR');

        $Tracker1 = config('Activity_trackerGIVR.Activity_trackerGIVR');


        if (config('Activity_trackerGIVR.time') < '60' && config('Activity_trackerGIVR.time') != 0) {
            $Time1 = config('Activity_trackerGIVR.time') . ' sec';
        } elseif (config('Activity_trackerGIVR.time') >= '60' && config('Activity_trackerGIVR.time') < '3600') {
            $Time1 = config('Activity_trackerGIVR.time') / 60 . ' min';
        } else if (config('Activity_trackerGIVR.time') == '0') {
            $Time1 = 'Select Time';
        } else
            $Time1 = config('Activity_trackerGIVR.time') / 3600 . ' hour';
        return view("Admin::ModuleSwitch.ModuleSwitchGIVR", ['status' => $status, 'time' => $Time1, 'Tracker' => $Tracker1]);


    }


//    public function ActivityTrackerGILR(Request $request)
//    {
////        dd($request->all());
//        if ($request->isMethod('post')) {
////            $time=$request->input('time') *60;
//            if ($request->input('time') == '0') {
//                $time = 0;
//            } else {
//                $timeData = explode(" ", $request->input('time'));
//                if ($timeData[1] == 'sec') {
//                    $time = $timeData[0];
//                } elseif ($timeData[1] == 'min') {
//                    $time = $timeData[0] * 60;
//                } else
//                    $time = $timeData[0] * 3600;
//            }
//            $webConfigPath = base_path() . '/config/Activity_trackerGILR.php';
//            $apiConfigPath = base_path() . '/../api/config/Activity_trackerGILR.php';
//            $fileContent = "<?php
//            return [
//                'Activity_TrackerGILR'=>'" . $request->all()['Activity_trackerGILR'] . "',
//                                'time'=>'" . $time . "'
//            ];";
//            file_put_contents($webConfigPath, $fileContent);
//            if (file_exists($apiConfigPath)) {
//
//                file_put_contents($apiConfigPath, $fileContent);
//            } else
//                die('path noteasdfasdf');
//        }
//
//        $status = config('Activity_TrackerGILR.Activity_TrackerGILR');
//        $Tracker1 = config('Activity_TrackerGILR.Activity_TrackerGILR');
////        $Time1 = config('Activity_TrackerGILR.time')/60 .' min';
//
//
//        if (config('Activity_TrackerGILR.time')< '60') {
//            $Time1 = config('Activity_TrackerGILR.time') . ' sec';
//        } elseif(config('Activity_TrackerGILR.time') >= '60' && config('Activity_TrackerGILR.time') <= '3600') {
//            $Time1 = config('Activity_TrackerGILR.time') / 60 . ' min';
//        } else {
//            $Time1 = config('Activity_TrackerGILR.time') / 3600 . ' hour';
//        }
////       $url = env('APP_URL') . '/' . config('whitebanner.banner_img_url');
//
//        return view("Admin::ModuleSwitch.ModuleSwitchGILR", ['status' => $status, 'time' => $Time1, 'Tracker' => $Tracker1]);
//
//    }

    public function ActivityTrackerGIVR(Request $request)
    {
        if ($request->isMethod('post')) {
            if ($request->input('time') == '0') {
                $time = 0;
            } else {
                $timeData = explode(" ", $request->input('time'));
                if ($timeData[1] == 'sec') {
                    $time = $timeData[0];
                } elseif ($timeData[1] == 'min') {
                    $time = $timeData[0] * 60;
                } else
                    $time = $timeData[0] * 3600;
            }

            $webConfigPath = base_path() . '/config/Activity_trackerGIVR.php';
            $apiConfigPath = base_path() . '/../api/config/Activity_trackerGIVR.php';
            $fileContent = "<?php
            return [
                'Activity_trackerGIVR'=>'" . $request->all()['Activity_trackerGIVR'] . "',
                                'time'=>'" . $time . "'
            ];";

            file_put_contents($webConfigPath, $fileContent);
            if (file_exists($apiConfigPath)) {

                file_put_contents($apiConfigPath, $fileContent);
            } else
                die('api path not found');
        }

        $status = config('Activity_trackerGIVR.Activity_trackerGIVR');
        $Tracker1 = config('Activity_trackerGIVR.Activity_trackerGIVR');


        if (config('Activity_trackerGIVR.time') < '60') {
            $Time1 = config('Activity_trackerGIVR.time') . ' sec';
        } elseif (config('Activity_trackerGIVR.time') >= '60' && config('Activity_trackerGIVR.time') < '3600') {
            $Time1 = config('Activity_trackerGIVR.time') / 60 . ' min';
        } else if (config('Activity_trackerGIVR.time') == '0') {
            $Time1 = 'Select Time';
        } else
            $Time1 = config('Activity_trackerGIVR.time') / 3600 . ' hour';
//dd($Tracker1);
        return view("Admin::ModuleSwitch.ModuleSwitchGIVR", ['status' => $status, 'time' => $Time1, 'Tracker' => $Tracker1]);

    }


    public function ActivityTrackerGILR(Request $request)
    {
        if ($request->isMethod('post')) {
            if ($request->input('time') == '0') {
                $time = 0;
            } else {
                $timeData = explode(" ", $request->input('time'));
                if ($timeData[1] == 'sec') {
                    $time = $timeData[0];
                } elseif ($timeData[1] == 'min') {
                    $time = $timeData[0] * 60;
                } else
                    $time = $timeData[0] * 3600;
            }

            $webConfigPath = base_path() . '/config/Activity_trackerGILR.php';
            $apiConfigPath = base_path() . '/../api/config/Activity_trackerGILR.php';
            $fileContent = "<?php
            return [
                'Activity_trackerGILR'=>'" . $request->all()['Activity_trackerGILR'] . "',
                                'time'=>'" . $time . "'
            ];";
            file_put_contents($webConfigPath, $fileContent);
            if (file_exists($apiConfigPath)) {

                file_put_contents($apiConfigPath, $fileContent);
            } else
                die('api path not found');
        }

        $status = config('Activity_trackerGILR.Activity_trackerGILR');
        $Tracker1 = config('Activity_trackerGILR.Activity_trackerGILR');


        if (config('Activity_trackerGILR.time') < '60'&& config('Activity_trackerGILR.time') != 0) {
            $Time1 = config('Activity_trackerGILR.time') . ' sec';
        } elseif (config('Activity_trackerGILR.time') >= '60' && config('Activity_trackerGILR.time') <= '3600') {
            $Time1 = config('Activity_trackerGILR.time') / 60 . ' min';
        } else
            $Time1 = config('Activity_trackerGILR.time') / 3600 . ' hour';

        return view("Admin::ModuleSwitch.ModuleSwitchGILR", ['status' => $status, 'time' => $Time1, 'Tracker' => $Tracker1]);

    }

//

    public function moduleStatusGILR(Request $request)
    {
        if ($request->isMethod('post')) {

            $webConfigPath = base_path() . '/config/module_switchGILR.php';
            $apiConfigPath = base_path() . '/../api/config/module_switchGILR.php';

            $fileContent = "<?php
            return [
                'module_switch_statusGILR'=>'" . $request->all()['module_switchGILR'] . "'
            ];";

            file_put_contents($webConfigPath, $fileContent);
            if (file_exists($apiConfigPath)) {
                file_put_contents($apiConfigPath, $fileContent);
            } else
                die('path noteasdfasdf');
        }
        $status = config('module_switchGILR.module_switch_statusGILR');
        $Tracker1 = config('Activity_trackerGILR.Activity_trackerGILR');


        if (config('Activity_trackerGILR.time') < '60' && config('Activity_trackerGILR.time') != 0) {
            $Time1 = config('Activity_trackerGILR.time') . ' sec';
        } elseif (config('Activity_trackerGILR.time') >= '60' && config('Activity_trackerGILR.time') < '3600') {
            $Time1 = config('Activity_trackerGILR.time') / 60 . ' min';
        } else if (config('Activity_trackerGILR.time') == '0') {
            $Time1 = 'Select Time';
        } else
            $Time1 = config('Activity_trackerGILR.time') / 3600 . ' hour';

//        dd($Tracker1);
        return view("Admin::ModuleSwitch.ModuleSwitchGILR", ['status' => $status, 'time' => $Time1, 'Tracker' => $Tracker1]);


    }


}















