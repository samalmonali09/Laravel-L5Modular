<?php

namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Admin\Models\Tutorial;
use Illuminate\Http\Request;

class TutorialsController extends Controller {

    public function showTutorials() {

        $data = Tutorial::all()->toArray();
        $data = array_reverse($data);
        return view('Admin::Tutorials.tutorials')->with('data', $data);

    }

    public function getDetails(Request $request) {

        $url = $request->url;
        $data = $this->getURLDetails($url);
        if (empty($data)) {
            return response()->json(['status' => 'FAIL']);
        }
        if (Tutorial::where('title','=',$data['title'])->exists()) {
            return response()->json(['status' => 'EXISTS']);
        } else {
            $tutorial = Tutorial::create($data);
            if ($tutorial) {
                return response()->json(
                    [
                        'status' => 'SUCCESS',
                        'id' => $tutorial->id,
                        'title' => $data['title'],
                        'link' => $data['link'],
                        'thumbnail' => $data['thumbnail'],
                        'description' => $data['description']
                    ],
                    200,
                    [
                        'Content-type'=> 'application/json; charset=utf-8'
                    ],
                    JSON_UNESCAPED_UNICODE
                    );
            } else {
                return response()->json(['status' => 'FAIL']);
            }
        }

    }

    private function getURLDetails($url) {
        $domainName = '';
        $videoID = '';
        $shortURL = false;
        if (strpos($url, 'www.') !== false) {
            preg_match('#https://www.(.*).com#', $url, $temp);
            $domainName .= $temp[1];
        } else {
            if (strpos($url, 'youtu.be') !== false) {
                $domainName .= 'youtube';
                $shortURL = true;
            } elseif (strpos($url, 'vimeo') !== false) {
                $domainName .= 'vimeo';
            }
        }
        $data = array();
        $data['link'] = $url;
        switch ($domainName) {
            case 'youtube': if ($shortURL) {
                                $value = explode('be/', $url);
                                $videoID .= $value[1];
                            } else {
                                $value = explode('v=', $url);
                                $videoID .= substr($value[1], 0, 11);
                            }
                            $youtubeData = $this->scrapeYoutube($videoID);
                            //Title might contain characters from different encoding
                            //Convert Encoding to UTF-8
                            $data['title'] = mb_convert_encoding(
                                $youtubeData['items'][0]['snippet']['title'],
                                'UTF-8',
                                'auto'
                            );
                            $data['thumbnail'] = $youtubeData['items'][0]['snippet']['thumbnails']['standard']['url'];
                            //Description might contain characters from different encoding
                            //Convert Encoding to UTF-8
                            $data['description'] = mb_convert_encoding(
                                substr($youtubeData['items'][0]['snippet']['description'], 0, 255),
                                'UTF-8',
                                'auto'
                            );
                            break;
            case 'vimeo':   $vimeoData = $this->scrapeVimeo($url);
                            if (empty($vimeoData) || !isset($vimeoData[0]['thumbnailUrl'])) {
                                return array();
                            }
                            $data['title'] = mb_convert_encoding(
                                $vimeoData[0]['name'],
                                'UTF-8',
                                'auto'
                            );
                            preg_match('#src0=(.*)&src1#', $vimeoData[0]['thumbnailUrl'], $thumbnail);
                            $data['thumbnail'] = htmlspecialchars(urldecode($thumbnail[1]));
                            $data['description'] = mb_convert_encoding(
                                $vimeoData[0]['description'],
                                'UTF-8',
                                'auto'
                            );
                            break;
            default:        return array();
        }
        return $data;
    }

    public function getTutorialUrl(Request $request) {
        $id = $request->id;
        $data = Tutorial::find($id);
        if ($data) {
            return response()->json([
                'status' => 'SUCCESS',
                'link' => $data->link
            ]);
        } else {
            return response()->json(['status' => 'FAIL']);
        }
    }

    public function updateURL(Request $request) {
        $id = $request->id;
        $link = $request->link;
        $data = Tutorial::find($id);
        $newData = $this->getURLDetails($link);
        if (empty($newData)) {
            return response()->json(['status' => 'FAIL']);
        }
        if ($data->title === $newData['title']) {
            return response()->json(['status' => 'EXISTS']);
        }
        if ($data) {
            $data->title = $newData['title'];
            $data->link = $link;
            $data->thumbnail = $newData['thumbnail'];
            $data->description = $newData['description'];
            if ($data->save()) {
                return response()->json([
                    'status' => 'SUCCESS',
                    'title' => $data->title,
                    'link' => $data->link,
                    'thumbnail' => $data->thumbnail,
                    'description' => $data->description
                ]);
            } else {
                return response()->json(['status' => 'FAIL']);
            }
        } else {
            return response()->json(['status' => 'FAIL']);
        }
    }

    public function deleteVideo(Request $request) {
        if (Tutorial::destroy($request->id)) {
            return response()->json(['status' => 'SUCCESS']);
        } else {
            return response()->json(['status' => 'FAIL']);
        }
    }

    private function scrapeYoutube($id) {

        $apiKey = 'AIzaSyC2IQYOQwZBksqVbaKIp6NiBQcQ1de3g0E';
        $url = 'https://www.googleapis.com/youtube/v3/videos?id=' . $id . '&key=' . $apiKey . '&part=snippet';;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_FOLLOWLOCATION => 1,
            CURLOPT_VERBOSE => 0,
            CURLOPT_SSL_VERIFYPEER => false
        ));
        $youtube_source = curl_exec($curl);
        if (curl_errno($curl)) {
            die('Scrape error:' . curl_error($curl));
        }
        curl_close($curl);
        return json_decode($youtube_source, true);
    }

    private function scrapeVimeo($url) {

        $curl = curl_init($url);
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_SSL_VERIFYPEER => FALSE,
            CURLOPT_SSL_VERIFYHOST => FALSE,
            CURLOPT_FOLLOWLOCATION => TRUE
        ));
        $vimeo_source = curl_exec($curl);
        if (curl_errno($curl)) {
            dd('Scrape error:' . curl_error($curl));
        }
        curl_close($curl);
        if (preg_match('#<script type="application\/ld\+json">\n(.*)<\/script>#', $vimeo_source, $list)){
            return json_decode($list[1], true);
        } else {
            return array();
        }
    }
}