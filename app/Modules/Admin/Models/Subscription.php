<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class Subscription extends Model
{


    /**
     * @Desc: getAllFiltersubscription
     * @param $where
     * @param $sortingOrder
     * @param $iDisplayStart
     * @param $iDisplayLength
     * @return int
     * @since  11/7/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function getAllFiltersubscription($where, $sortingOrder, $iDisplayStart, $iDisplayLength)
    {

        try {
            if ($iDisplayLength < 0) {
                $result = DB::table('subscription_packages')
                    ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                    ->orderBy($sortingOrder[0], $sortingOrder[1])
                    ->select(['*'])
                    ->get();
            } else {
                $result = DB::table('subscription_packages')
                    ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                    ->orderBy($sortingOrder[0], $sortingOrder[1])
                    ->skip($iDisplayStart)->take($iDisplayLength)
                    ->select(['*'])
                    ->get();
            }
            if ($result)
                return $result;
            else
                return 0;
        } catch (QueryException $exc) {
            return 2;
        }

    }


    /**
     * @Desc: getsubscriptionDetails
     * @param $where
     * @param array $column
     * @return mixed
     * @since  11/7/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function getsubscriptionDetails($where, $column = ['*'])
    {
        try {
            $result = DB::table('subscription_packages')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->select($column)
                ->get();

            return $result;
        } catch (QueryException $e) {
            echo $e->getMessage();
        }
    }


    public function deletepSubcription()
    {
        if (func_num_args() > 0) {
            $where = func_get_arg(0);
            try {
                $result = DB::table('subscription_packages')
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

    /**
     * @Desc: updateStatus
     * @param $where
     * @param $data
     * @return mixed
     * @since 11/7/ 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function updateStatus($where, $data)
    {

        try {
            $result = DB::table('subscription_packages')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->update($data);
            return $result;
        } catch (QueryException $data) {
            echo $data->getMessage();
        }
    }


    /**
     * @Desc: Fetchsubscription
     * @param $sub_package_id
     * @param array $select
     * @return int
     * @since  11/7/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function Fetchsubscription($sub_package_id, $select=['*'])
    {
        $result = DB::table('subscription_packages')->where('sub_package_id',$sub_package_id)->select($select)->first();
        if ($result) {
            return $result;
        } else {
            return 0;
        }
    }


    /**
     * @Desc:deletepSubcription
     * @return string
     * @since 11/7/ 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
//    public function deletepSubcription()
//    {
//        if (func_num_args() > 0) {
//            $where = func_get_arg(0);
//            try {
//                $result = DB::table('subscription_packages')
//                    ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
//                    ->delete();
//                return $result;
//            } catch (\Exception $e) {
//                return $e->getMessage();
//            }
//        } else {
//            throw new Exception('Argument Not Passed');
//        }
//    }


    /**
     * @Desc: fetchSubcriptionId
     * @param $sub_package_id
     * @param array $select
     * @return int
     * @since  11/7/ 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function fetchSubcriptionId($sub_package_id, $select=['*'])
    {
        $result = DB::table('subscription_packages')->where('sub_package_id',$sub_package_id)->select($select)->first();
        if ($result) {
            return $result;
        } else {
            return 0;
        }
    }


    /**
     * @Desc: updateSubcription
     * @param $where
     * @param $data
     * @return mixed
     * @since 11/7/ 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function updateSubcription($where, $data)
    {
        try {
            $result = DB::table('subscription_packages')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->update($data);
            return $result;
        } catch (QueryException $data) {
            echo $data->getMessage();
        }
    }


    /**
     * @Desc: addSubscription
     * @param $data
     * @return int
     * @since  11/7/ 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function addSubscription($data)
    {
        try {

            $result = DB::table('subscription_packages')->insertGetId($data);
            if ($result) {
                return $result;

            } else {
                return 0;
            }
        } catch (QueryException $e) {
            echo $e->getMessage();
        }
    }




}



