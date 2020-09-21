<?php
/**
 * Created by Monali Samal.
 * User: Monali Samal<monalisamal@globussift.in>
 * Date: 3/21/2018
 * Time: 10:46 AM
 */

namespace App\Modules\Admin\Models;



use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;


class Plan
{
    /**
     * @Desc deletepPlan
     * @return string
     * @since  22 march  2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
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
     * @Desc: updatePlan
     * @param $where
     * @param $data
     * @return mixed
     * @since  22 march 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function updatePlan($where, $data)
    {

        try {
            $result = DB::table('plans')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->update($data);
            return $result;
        } catch (QueryException $data) {
            echo $data->getMessage();
        }
    }

    public function getPlanDetails($where, $column = ['*'])
    {
        try {
            $result = DB::table('plans')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->select($column)
                ->get();

            return $result;
        } catch (QueryException $e) {
            echo $e->getMessage();
        }
    }


    public function getPlanDetails1($where, $column = ['*'])
    {
        try {
            $result = DB::table('plans')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->select($column)
                ->get();

            return $result;
        } catch (QueryException $e) {
            echo $e->getMessage();
        }
    }
    public function getPlanDetailsdta($where, $column = ['*'])
    {
        try {
            $result = DB::table('plans')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->select($column)
                ->get();

            return $result;
        } catch (QueryException $e) {
            echo $e->getMessage();
        }
    }


    public function getAllFilterPlans($where, $sortingOrder, $iDisplayStart, $iDisplayLength)
    {

        try {
            if ($iDisplayLength < 0) {
                $result = DB::table('plans')
                    ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                    ->orderBy($sortingOrder[0], $sortingOrder[1])
                    ->select(['*'])
                    ->get();
            } else {
                $result = DB::table('plans')
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


    public function fetchPlanId($plan_id, $select=['*'])
    {
        $result = DB::table('plans')->where('plan_id',$plan_id)->select($select)->first();
        if ($result) {
            return $result;
        } else {
            return 0;
        }
    }



    public function fetchid($plan_id,$select = ['*'])
    {
        $result = DB::table('plans')->whereId($plan_id)->select($select)->first();
        if ($result) {
//        die('here');
            return $result;
        } else {
            return 0;
        }
    }
    public function addPlan($data)
    {
        try {

            $result = DB::table('plans')->insertGetId($data);
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