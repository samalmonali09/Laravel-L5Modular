<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class Order
{

    /**
     * @Desc:registerdata functionality
     * @param $fillable
     * @return int
     * @since 9 feb 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function registerdata($fillable)
    {
        $result = DB::table('orders')->insertGetId($fillable);
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
     * @since 9 feb 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */

    public function getOrdersDetails($where, $column = ['*'])
    {
        try {
            $result = DB::table('orders')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->select($column)
                ->join('users', 'users.id', '=', 'orders.user_id')
                ->join('packages', 'packages.package_id', '=', 'orders.package_id')

                ->get();

            return $result;
        } catch (QueryException $e) {
            echo $e->getMessage();
        }
    }

    public function fetchComments($order_id, $select = ['*'])
    {
        $result = DB::table('orders')->where('order_id',$order_id)
            ->leftjoin('comments','comments.comment_id', '=', 'orders.comment_id')
            ->select($select)->first();
//        dd($result);
        if ($result) {
            return $result;
        } else {
            return 0;
        }
    }


    /**
     * @Desc:getAllFilterOrders
     * @param $where
     * @param $sortingOrder
     * @param $iDisplayStart
     * @param $iDisplayLength
     * @return int
     * @since 9 feb  2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function getAllFilterOrders($where, $sortingOrder, $iDisplayStart, $iDisplayLength)
    {

        try {
            if ($iDisplayLength < 0) {
                $result = DB::table('orders')
                    ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                    ->join('users', 'users.id', '=', 'orders.user_id')
                    ->join('packages', 'packages.package_id', '=', 'orders.package_id')
                    ->leftjoin('comments', 'comments.comment_id', '=', 'orders.comment_id')
                    ->orderBy($sortingOrder[0], $sortingOrder[1])
//                    ->select(['*'])
                    ->select('orders.*', 'orders.status', 'users.email', 'packages.package_id', 'packages.price','packages.package_name','packages.package_type','comments.comments')
                    ->get();
            } else {
                $result = DB::table('orders')
                    ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                    ->join('users', 'users.id', '=', 'orders.user_id')
                    ->join('packages', 'packages.package_id', '=', 'orders.package_id')
                    ->leftjoin('comments', 'comments.comment_id', '=', 'orders.comment_id')
                    ->orderBy($sortingOrder[0], $sortingOrder[1])
                    ->skip($iDisplayStart)->take($iDisplayLength)
//                     ->select(['*'])
                    ->select('orders.*', 'orders.status', 'users.email', 'packages.package_id', 'packages.price', 'packages.package_name','packages.package_type','comments.comments')
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
     * @Desc:fetchOrderId
     * @param $order_id
     * @param array $select
     * @return int
     * @since  9 feb 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function fetchOrderId($order_id ,$select = ['*'])
    {
        $result = DB::table('orders')->where('orders.order_id',$order_id)
            ->leftjoin('transactions', 'transactions.tx_id', '=', 'orders.tx_id')
//            ->leftjoin('users', 'users.id', '=', 'orders.user_id')
            ->select($select)->first();
        if ($result) {
            return $result;
        } else {
            return 0;
        }
    }


    public function fetchcomments45($comments, $select = ['*'])
    {
        $result = DB::table('comments')->where('comments',$comments)->select($select)->first();
        if ($result) {
            return $result;
        } else {
            return 0;
        }
    }








    /**
     * @Desc:getOrderDtetailsDatabase
     * @param $where
     * @return string
     * @since  2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function getOrderDetailsDatabase($where)
    {
        $selectCols = array('order_id');
        try {
            $res = DB::table('orders')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->select($selectCols)
                ->get();
            return $res;
        } catch (QueryException $e) {
            return $e->getMessage();
        }
    }


    /**
     * @Desc:deleteOrders functionality
     * @param $where
     * @return int
     * @since  2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function deleteOrders($where)
{
    try {
        $result = DB::table('orders')
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
     * @DescL getOrderStatus
     * @param $where
     * @param array $selectedColumns
     * @return int|string
     * @since   10 feb 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function getOrderStatus($where, $selectedColumns = ['*'])
    {
        if (!isset($selectedColumns)) {
            $selectedColumns = ['orders.*', 'orders.status', 'users.email', 'packages.package_id', 'packages.price', 'packages.package_name'];
        }
        try {
            $result = DB::table('orders')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->join('users', 'users.id', '=', 'orders.user_id')
                ->join('packages', 'packages.package_id', '=', 'orders.package_id')
                ->select($selectedColumns)
                ->get();
            if ($result)
                return $result;
            else
                return 0;
        } catch (QueryException $exc) {
            return $exc->getMessage();

        }
    }

    /**
     * @Desc updateOrder table
     * @return int
     * @since   10 feb 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function updateOrder()
    {
        try {
            $where = func_get_arg(0);
            $data = func_get_arg(1);
            $result = DB::table('orders')
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



    public function insertOrderID()
    {
        if (func_num_args() > 0) {
            $data = func_get_arg(0);

            $id = DB::table('orders')->insertGetId($data);

            if ($id)
                return $id;
            else
                return 0;
        }
    }


    public function getOrderDetailsID($where, $selectedColumns = [])
    {
        if (empty($selectedColumns)) {
            $selectedColumns = ['*'];
        }
        try {
            $result = DB::table('orders')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->select($selectedColumns)
                ->get();
            if ($result)
                return $result;
            else
                return 0;
        } catch (QueryException $exc) {
            return $exc->getMessage();
        }
    }

}

//
//$result = DB::table('comment')
//    ->join('reply', 'comment.id', '=', 'reply.comment_id')
//    ->select('comment.comment','comment.user_name','comment.user_image','comment.movie_id', 'comment.user_id',

//
//$result1 = DB::table('orders')->where('order_id',$order_id)
//    ->join('comments', 'comments.comments_id', '=', 'orders.comment_id')
//    ->select('comments.comments','comments.comments_id','orders.order_id','orders.user_id')->get();
//dd($result1);