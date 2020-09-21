<?php
/**
 * Created by Monali Samal.
 * User: monali samal <monalisamal@globussoft.in>
 * Date: 4/9/2018
 * Time: 1:48 AM
 */

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class Banner extends Model
{

    protected $table = 'banners';


    /**
     * @Desc: addImage
     * @param $data
     * @return int
     * @since 12/4/ 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function addImageToDB($data)
    {
        try {
//            dd($data);
            $result = DB::table('banners')->insertGetId($data);
            if ($result) {
                return $result;

            } else {
                return 0;
            }
        } catch (QueryException $e) {
            echo $e->getMessage();
        }
    }


    /**
     * @Desc:getOneBannerDetails
     * @return mixed
     * @since 10 may 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function getOneBannerDetails()
    {
        return DB::table('banners')
            ->first();

    }

    /**
     * @Desc: fetchQuery
     * @param $where
     * @param array $column
     * @return array
     * @throws \Exception
     * @since  12/4/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function fetchQuery1()
    {
        try {
            $result = DB::table('banners')->get();

            $data = [];
            foreach ($result as $key => $value) {
                $data['banner_image'] = $value->banner_image;
                $data['banner_url'] = $value->banner_url;

            }
//dd($data);

            return $data ? $data : [];
        } catch (QueryException $e) {
            echo $e->getMessage();
        }

    }


    /**
     * @Desc: updateImage
     * @param $where
     * @param $data
     * @return mixed
     * @since 12/4/ 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function updateImageIos($where, $data)
    {

//        dd($where, $data);
        try {
            $result = DB::table('banners')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->update($data);
            return $result;
        } catch (QueryException $data) {
            echo $data->getMessage();
        }
    }


    /**
     * @Desc: updateImageAnd
     * @param $where
     * @param $data
     * @return mixed
     * @since 12/4/ 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function updateImageAnd($where, $data)
    {

        try {
            $result = DB::table('banners')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->update($data);
            return $result;
        } catch (QueryException $data) {
            echo $data->getMessage();
        }
    }
    /**
     * @Desc: deleteImageWhere
     * @return string
     * @since   12/4 / 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function deleteImageWhere()
    {
        if (func_num_args() > 0) {
            $where = func_get_arg(0);
            try {
                $result = DB::table('banners')
                    ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                    ->delete();
                return $result;
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        } else {
            throw new Exception('Argument Not Passed');
        }
    }


    
    public function fetchQuery($where, $column = ['*'])
    {
        if (func_num_args() > 0) {
            try {
                $result = DB::table($this->table)
                    ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                    ->select($column)
                    ->get();

                return $result ? $result : [];
            } catch (QueryException $e) {
                echo $e->getMessage();
            }
        } else {
            throw new \Exception('Argument not passed');
        }
    }

}