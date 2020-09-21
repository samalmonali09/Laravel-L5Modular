<?php

namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class FlashmessageController extends Controller
{

//    public function flashMessage(Request $request)
//    {
//        if ($request->isMethod('post')) {
//            try {
////                $file = fopen(public_path() . '/flash_message.html', 'w');
//                $file = fopen( public_path() . '/assets/flashnews.html', 'w');
//
//                $htmlcontents = '<!DOCTYPE html> <html> <head> <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/> <script src="https://use.fontawesome.com/ea6440a4bf.js"></script> <style> .close_btn { float: right; color: #1abc9c; font-size: 30px; /*position: relative;*/ right: 0; top: 0; }
//
// .main_bg { border: 3px solid #179078; border-radius: 10px; padding: 5px; width: 97%; /* margin-left: 20%; */ /* margin-right: 20%; */ margin: 4% auto; } </style> </head>
//
//<body>
//
//<div class="main_bg"> ';
//                $htmlcontents .= $request->all()['summary'];
//                $htmlcontents .= ' <div style="padding: 30px;"> </div> </div></body> <script> function closeModal() { console.log("hello anupriya"); } </script> </html>';
//
//                fwrite($file, $htmlcontents);
//                fclose($file);
//                return Redirect::back()->with(['status' => 'Popup Summary stored Succesfully'])->withInput();
//            } catch (\Exception $exc) {
//                dd($exc->getMessage());
//                $response = ['code' => 500, 'message' => 'Internal Server Error,fetch user details', 'data' => null];
//            }
//
//        }
//        $file = fopen(public_path() . '/assets/flashnews.html', 'r');
////        dd($file);
//        $data = fread($file, filesize(public_path() . '/assets/flashnews.html'));
//
//        $msg_status = config('flash_message.flashnews');
//
//        return view("Admin::flashMessage.flash_message", ['data' => $data, 'msg_status' => $msg_status]);
//
//    }


    /**
     * @Desc creating flash message for app
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since 19 march 2018
     * @author Sibasankar Bhoi (sibasankarbhoi@globussoft.in)
     */
    public function flashMessage(Request $request)
    {
        if ($request->isMethod('post')) {
            try {
                $htmlcontents = '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
 <script src="https://use.fontawesome.com/ea6440a4bf.js"></script>
  <style> .close_btn { float: right; color: #1abc9c; font-size: 30px; /*position: relative;*/ right: 0; top: 0; }

 .main_bg { border: 3px solid #179078; border-radius: 10px; padding: 5px; width: 97%; /* margin-left: 20%; */ /* margin-right: 20%; */ margin: 4% auto; } </style> 
 
<div class="main_bg"> <a href="javascript:;" onclick="closeModal()" class="pull-right close_btn"><i class="fa fa-times-circle"></i></a> ';

                $htmlcontents .= $request->all()['summary'];
                $htmlcontents .= ' <div style="padding: 30px;"> </div> </div> <script> function closeModal() { console.log("hello anupriya"); } </script>';
                $doc = new \DOMDocument();
                $doc->loadHTML($htmlcontents);
                $imgs = $doc->getElementsByTagName('img');
                if($imgs->length >0 ){
                    foreach ($imgs as $img) {
                        $img->setAttribute('class', 'img-responsive');
                    }
                }
                $htmlcontents = $doc->saveHTMLFile(public_path() . '/flash_message.html');
                return Redirect::back()->with(['status' => 'Popup Summary stored Succesfully'])->withInput();
            } catch (\Exception $exc) {
                dd($exc->getMessage());
                $response = ['code' => 500, 'message' => 'Internal Server Error,fetch user details', 'data' => null];
            }
        }
        $file = fopen(public_path() . '/flash_message.html', 'r');
        $data = fread($file, filesize(public_path() . '/flash_message.html'));
        $msg_status = config('flash_message.flashnews');
        return view("Admin::flashMessage.flash_message", ['data' => $data, 'msg_status' => $msg_status]);
//        return view("Admin::flashMessage.flash_messageInstant", ['data' => $data, 'msg_status' => $msg_status]);

    }



    /**
     * @Desc: flashmessageStatus
     * @param Request $request
     * @since  2/5/2018 2018
     * @author Sibasankar Bhoi (sibasankarbhoi@globussoft.in)
     */
    public function flashmessageStatus(Request $request)
    {
        dd($request->all()['registered_through']);
        $webConfigPath = base_path() . '/config/flash_message.php';
        $apiConfigPath = base_path() . '/../api/config/flash_message.php';

        $fileContent = "<?php
            return [
                'flashnews'=>'" . $request->all()['registered_through'] . "'
            ];";

        file_put_contents($webConfigPath, $fileContent);

        if (file_exists($apiConfigPath)) {

            file_put_contents($apiConfigPath, $fileContent);
        } else
            die('path noteasdfasdf');

    }



    /**
     * @Desc flashMessage For Get Instants  app.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since   2/5/ 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function flashMessageInstant(Request $request)
    {
        if ($request->isMethod('post')) {
            try {
                $htmlcontents = '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
 <script src="https://use.fontawesome.com/ea6440a4bf.js"></script>
  <style> .close_btn { float: right; color: #1693bc; font-size: 30px; /*position: relative;*/ right: 0; top: 0; }

 .main_bg { border: 3px solid #1693bc; border-radius: 10px; padding: 5px; width: 97%; /* margin-left: 20%; */ /* margin-right: 20%; */ margin: 4% auto; } </style> 
 
<div class="main_bg"> <a href="javascript:;" onclick="closeModal()" class="pull-right close_btn"><i class="fa fa-times-circle"></i></a> ';

                $htmlcontents .= $request->all()['summary'];
                $htmlcontents .= ' <div style="padding: 30px;"> </div> </div> <script> function closeModal() { console.log("hello anupriya"); } </script>';
                $doc = new \DOMDocument();
                $doc->loadHTML($htmlcontents);
                $imgs = $doc->getElementsByTagName('img');
                if($imgs->length >0 ){
                    foreach ($imgs as $img) {
                        $img->setAttribute('class', 'img-responsive');
                    }
                }
                $htmlcontents = $doc->saveHTMLFile(public_path() . '/flash_message.html');
                return Redirect::back()->with(['status' => 'Popup Summary stored Succesfully'])->withInput();
            } catch (\Exception $exc) {
                dd($exc->getMessage());
                $response = ['code' => 500, 'message' => 'Internal Server Error,fetch user details', 'data' => null];
            }
        }
        $file = fopen(public_path() . '/flash_message.html', 'r');
        $data = fread($file, filesize(public_path() . '/flash_message.html'));
        $msg_status = config('instant_likes_flashnews.flashnews');
        return view("Admin::flashMessage.flash_messageInstant", ['data' => $data, 'msg_status' => $msg_status]);

    }

    public function flashmessageStatusInsant(Request $request)
    {dd('stop');
        $webConfigPath = base_path() . '/config/instant_likes_flashnews.php';
        $apiConfigPath = base_path() . '/../api/config/instant_likes_flashnews.php';
        $fileContent = "<?php
            return [
                'flashnews'=>'" . $request->all()['registered_through'] . "'
            ];";


        file_put_contents($webConfigPath, $fileContent);

        if (file_exists($apiConfigPath)) {

            file_put_contents($apiConfigPath, $fileContent);
        } else
            die('path noteasdfasdf');

    }


    public function flashMessageTrending(Request $request)

    {
        if ($request->isMethod('post')) {
            $bgColor = 'background-color:' . $request->all()['backgroudVal'];
            $ttlColor = 'color:' . $request->all()['titleVal'];
            $prhColor = 'color:' . $request->all()['paraVal'];
            try {
//                $file = fopen(public_path() . '/flash_message.html', 'w');
//                $file = fopen(public_path() . '/gift_icon_eng.html', 'w');
                $file = fopen(public_path() . '/flash_messageTrend.html', 'w');
                $htmlcontents = '<html><head><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/> <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script src="https://use.fontawesome.com/ea6440a4bf.js"></script>
    <style>
         p {
            ' . $prhColor . ';
        }
        h3 {
            text-align: center;
            ' . $ttlColor . ';
        } h2 {
            text-align: center;
            ' . $ttlColor . ';
        } h1 {
            text-align: center;
            ' . $ttlColor . ';
        }
    </style></head><body style="' . $bgColor . ';"><div><div style="padding: 30px; ' . $bgColor . ';">';
                $htmlcontents .= $request->all()['gift_icon_content'];
                $htmlcontents .= '</div></div></body></html>';
                fwrite($file, $htmlcontents);
                fclose($file);
                return json_encode([
                    'status' => 200,
                    'message' => 'gift icon content changed successfully'
                ]);
            } catch (\Exception $exc) {
                dd($exc->getMessage());
                $response = ['code' => 500, 'message' => 'Internal Server Error,fetch user details', 'data' => null];
            }
        }
//        $file = fopen(public_path() . '/gift_icon_eng.html', 'r');
        $file = fopen(public_path() . '/flash_messageTrend.html', 'r');
//        $data = fread($file, filesize(public_path() . '/gift_icon_eng.html'));
        $data = fread($file, filesize(public_path() . '/flash_messageTrend.html'));
        $msg_status = config('Trending_flashnews.flashnews');
        $bgColor = $this->extractContent($data, 'color:', ';');
        return view("Admin::flashMessage.flash_messageTrending", ['data' => $data,'bgColor' => $bgColor[4], 'pColor' => $bgColor[0], 'ttlColor' => $bgColor[1],'msg_status' => $msg_status]);


    }

    public function flashmessageStatusTrending(Request $request)
    {
        $webConfigPath = base_path() . '/config/Trending_flashnews.php';
        $apiConfigPath = base_path() . '/../api/config/Trending_flashnews.php';
        $fileContent = "<?php
            return [
                'flashnews'=>'" . $request->all()['registered_through'] . "'
            ];";


        file_put_contents($webConfigPath, $fileContent);

        if (file_exists($apiConfigPath)) {

            file_put_contents($apiConfigPath, $fileContent);
        } else
            die('path noteasdfasdf');

    }


    public function extractContent($str, $start, $end)
    {
        $lastPos = 0;
        $positions = array();
        $color = array();

        while (($lastPos = strpos($str, $start, $lastPos)) !== false) {
            $positions[] = $lastPos;
            $lastPos = $lastPos + strlen($start);
        }
        $newStr = $str;
        foreach ($positions as $value) {
            $newStr = substr($str, strpos($str, $start));
            array_push($color, substr($str, $value, strpos($newStr, $end)));
        }
        foreach ($color as $k => $val) {
            $color[$k] = explode(":", $val)[1];
        }
        return $color;
    }


}