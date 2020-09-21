<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class Autolike
{


    /**
     * @Desc: getAllFilterAutolikes
     * @param $where
     * @param $sortingOrder
     * @param $iDisplayStart
     * @param $iDisplayLength
     * @return int
     * @since    12/7/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function getAllFilterAutolikes($where, $sortingOrder, $iDisplayStart, $iDisplayLength)
    {

        try {
            if ($iDisplayLength < 0) {
                $result = DB::table('autolikes_orders')
                    ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                    ->orderBy($sortingOrder[0], $sortingOrder[1])
                    ->join('subscription_packages', 'subscription_packages.sub_package_id', '=', 'autolikes_orders.sub_package_id')
                    ->select('autolikes_orders.*', 'subscription_packages.quantity')
                    ->get();
            } else {
                $result = DB::table('autolikes_orders')
                    ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                    ->join('subscription_packages', 'subscription_packages.sub_package_id', '=', 'autolikes_orders.sub_package_id')
                    ->orderBy($sortingOrder[0], $sortingOrder[1])
                    ->skip($iDisplayStart)->take($iDisplayLength)
                    ->select('autolikes_orders.*', 'subscription_packages.quantity')
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
     * @Desc: getAutolikesDetails
     * @param $where
     * @param array $column
     * @return mixed
     * @since  18/7/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function getAutolikesDetails($where, $column = ['*'])
    {
        try {
            $result = DB::table('autolikes_orders')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->select($column)
                ->get();

            return $result;
        } catch (QueryException $e) {
            echo $e->getMessage();
        }
    }


    /**
     * @Desc: getAutolikesDetailsProfile
     * @param $where
     * @return string
     * @since  18/7/ 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function getAutolikesDetailsProfile($where)
    {
        $selectCols = array('autolikes_id');
        try {
            $result = DB::table('autolikes_orders')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->select($selectCols)
                ->get();
            return $result;
        } catch (QueryException $e) {
            return $e->getMessage();
        }
    }


    /**
     * @Desc: deleteAutolikes
     * @param $where
     * @return int
     * @since 18/7/ 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function deleteAutolikes($where)
    {
        try {
            $result = DB::table('autolikes_orders')
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


    /**
     * @Desc: UpdateAutolikes
     * @return int
     * @since  18/7/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function UpdateAutolikes()
    {

        try {
            $where = func_get_arg(0);
            $data = func_get_arg(1);
            $result = DB::table('autolikes_orders')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->update($data);

            if ($result == 0) {
                return 2;
            } else if ($result) {
                return 1;
            } else {
                return 0;
            }
        } catch (QueryException $exc) {
            return 0;

        }
    }


    /**
     * @Desc: fetchAutolikes
     * @param $autolikes_orders
     * @param array $select
     * @return int
     * @since   18/7/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function fetchAutolikes($autolikes_orders, $select = ['*'])
    {
        $result = DB::table('autolikes_orders')
            ->where('autolikes_id',$autolikes_orders)
            ->leftjoin('subscription_packages', 'subscription_packages.sub_package_id', '=', 'autolikes_orders.sub_package_id')
            ->leftjoin('recurring_profiles', 'recurring_profiles.sub_package_id', '=', 'autolikes_orders.sub_package_id')
            ->leftjoin('users', 'users.id', '=', 'autolikes_orders.by_user_id')

            ->select($select)
            ->first();
        if ($result) {
            return $result;
        } else {
            return 0;
        }
    }


    /**
     * @Desc: FetechAutolikesOrder
     * @param $autolikes_orders
     * @param array $select
     * @return int
     * @since   18/7/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function FetechAutolikesOrder($autolikes_orders, $select = ['*'])
    {
        $result = DB::table('autolikes_orders')
            ->where('autolikes_id',$autolikes_orders)
            ->join('subscription_packages', 'subscription_packages.sub_package_id', '=', 'autolikes_orders.sub_package_id')
            ->select($select)
            ->first();
        if ($result) {
            return $result;
        } else {
            return 0;
        }
    }


    public function deletepPlan()
    {
        if (func_num_args() > 0) {
            $where = func_get_arg(0);
            try {
                $result = DB::table('plans')
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
     * @Desc: updateAutolikesProfile
     * @param $where
     * @param $data
     * @return mixed
     * @since 18/7/ 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function updateAutolikesProfile($where, $data)
    {
        try {
            $result = DB::table('autolikes_orders')
                ->join('subscription_packages', 'subscription_packages.sub_package_id', '=', 'autolikes_orders.sub_package_id')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->update($data);
            return $result;
        } catch (QueryException $data) {
            echo $data->getMessage();
        }
    }



}