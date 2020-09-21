<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class Payment extends Model
{


    /**
     * @Desc:: getPaymentDetails
     * @param $where
     * @param array $column
     * @return mixed
     * @since  17/7/ 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function getPaymentDetails($where, $column = ['*'])
    {
        try {
            $result = DB::table('recurring_profiles')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->select($column)
                ->get();

            return $result;
        } catch (QueryException $e) {
            echo $e->getMessage();
        }
    }


    /**
     * @Desc: getAllFilterPayment
     * @param $where
     * @param $sortingOrder
     * @param $iDisplayStart
     * @param $iDisplayLength
     * @return int
     * @since  17/7/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function getAllFilterPayment($where, $sortingOrder, $iDisplayStart, $iDisplayLength)
    {

        try {
            if ($iDisplayLength < 0) {
                $result = DB::table('recurring_profiles')
                    ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                    ->orderBy($sortingOrder[0], $sortingOrder[1])
                    ->select(['*'])
                    ->get();
            } else {
                $result = DB::table('recurring_profiles')
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
     * @Desc: fetchAutolikes
     * @param $profile_id
     * @param array $select
     * @return int
     * @since   17/7/ 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function fetchAutolikes($profile_id, $select = ['*'])
    {
        $result = DB::table('recurring_profiles')
            ->where('profile_id',$profile_id)
            ->leftjoin('subscription_packages', 'subscription_packages.sub_package_id', '=', 'recurring_profiles.sub_package_id')
            ->select($select)
            ->first();
        if ($result) {
            return $result;
        } else {
            return 0;
        }
    }


    public function deletePayment($where)
    {
        try {
            $result = DB::table('recurring_profiles')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->delete();
            if ($result)
                return $result;
            else
                return 0;
        } catch (QueryException $e) {
            return 0;
        }
    }


}