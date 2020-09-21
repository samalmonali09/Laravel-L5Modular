<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class Transaction extends Model
{

    public function registerdata($fillable)
    {
        $result = DB::table('users')->insertGetId($fillable);
        if ($result) {
            return ($result);

        } else {
            return 0;
        }
    }


    /**
     * @Desc:getTransactionDetails functionality
     * @param $where
     * @param array $column
     * @return mixed
     * @since  2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function getTransactionDetails($where, $column = ['*'])
    {
        try {
            $result = DB::table('transactions')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->select($column)
                ->leftjoin('users', 'users.id', '=', 'transactions.user_id')
                ->get();

            return $result;
        } catch (QueryException $e) {
            echo $e->getMessage();
        }
    }


    /**
     * @Desc:getAllFilterTransaction functionality
     * @param $where
     * @param $sortingOrder
     * @param $iDisplayStart
     * @param $iDisplayLength
     * @return int
     * @since  7  feb 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function getAllFilterTransaction($where, $sortingOrder, $iDisplayStart, $iDisplayLength)
    {

        try {
            if ($iDisplayLength < 0) {
                $result = DB::table('transactions')
                    ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                    ->orderBy($sortingOrder[0], $sortingOrder[1])
                    ->join('users', 'users.id', '=', 'transactions.user_id')
                    ->join('orders', 'orders.tx_id', '=', 'transactions.tx_id')
                    ->join('packages', 'packages.package_id', '=', 'transactions.package_id')
//                    ->select('transactions.*','transactions.amount')
//                    ->select(['*'])
                    ->select(['*', 'transactions.amount as amount'])
                    ->get();

            } else {
                $result = DB::table('transactions')
                    ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                    ->orderBy($sortingOrder[0], $sortingOrder[1])
                    ->skip($iDisplayStart)->take($iDisplayLength)
                    ->join('users', 'users.id', '=', 'transactions.user_id')
                    ->join('orders', 'orders.tx_id', '=', 'transactions.tx_id')
                    ->join('packages', 'packages.package_id', '=', 'transactions.package_id')
//                    ->select('transactions.*','transactions.amount')
//                    ->select(['*'])
                    ->select(['*', 'transactions.amount as amount'])
                    ->get();
            }
            if ($result)
                return $result;
            else
                return 0;
        } catch (QueryException $exc) {
            echo $exc->getMessage();
            die;
//            return 2;
        }
    }

    /**
     * @Desc:fetchTransactionId functionality
     * @param $tx_id
     * @param array $select
     * @return int
     * @since 8  feb 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function fetchTransactionId($tx_id, $select = ['*'])
    {
        $result = DB::table('transactions')
//            ->where('transactions.tx_id',$tx_id)
            ->where('orders.order_id', $tx_id)
            ->join('orders', 'orders.tx_id', '=', 'transactions.tx_id')
            ->select(['*'])->first();
        if ($result) {
            return $result;
        } else {
            return 0;
        }
    }
}



