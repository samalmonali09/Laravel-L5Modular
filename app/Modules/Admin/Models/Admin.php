<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class Admin
{
    /**
     * @Desc insertGetId data  in datatable
     * @param $fillable
     * @since29/jan/  2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function registerdata($fillable)
    {
        $result = DB::table('users')->insertGetId($fillable);
        if ($result) {
            return ($result);

        } else {
            return 0;
        }
    }
//    public function deleteUsers($where)
//    {
//        try {
//            $result = DB::table('users')
//                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
//                ->delete();
//            if ($result)
//                return $result;
//            else
//                return 0;
//        } catch (QueryException $e) {
//            return 0;
//        }
//    }



//    public function getUsersDatabase($where)
//    {
//        $selectCols = array('id');
//        try {
//            $res = DB::table('users')
//                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
//                ->select($selectCols)
//                ->get();
//            return $res;
//        } catch (QueryException $e) {
//            return $e->getMessage();
//        }
//    }
    /**
     * @Desc fetch data  models
     * @param $userid
     * @return int
     * @since  29/jan/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    // here $select used for total data  insert
    public function fetchid($userid,$select = ['*'])
    {
        $result = DB::table('users')->whereId($userid)->select($select)->first();
        if ($result) {
//        die('here');
            return $result;
        } else {
            return 0;
        }
    }


    /**
     * @Desc updateUserWhere used in pending userscontroller
     * @param $where
     * @param $data
     * @since  2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function updateUserWhere($where, $data)
    {

        try {
            $result = DB::table('packages')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->update($data);
            return $result;
        } catch (QueryException $e) {
            echo $e->getMessage();
        }
    }


    /**
     * @Desc:used For AvailableUser in UserController*
     * @param $where
     * @param $data
     * @return mixed
     * @since  2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function AvailableDataUpdate($where, $data)
    {

        try {
            $result = DB::table('users')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->update($data);
            return $result;
        } catch (QueryException $data) {
            echo $data->getMessage();
        }
    }


    /**
     ** @Desc:satusChange in available users
     * @param $data
     * @return mixed
     * @since 29/jan/ 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function DataUpdate($where, $data)
    {
        try {
            $result = DB::table('users')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->update($data);

            return $result;
        } catch (QueryException $e) {
            echo $e->getMessage();
        }
    }


    /**
     * @Desc
     * @param $change password  model users tabel
     * @return int
     * @since  2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function userPasswordChange($change)
    {
        $result = DB::table('users')->where('id', Auth::id())->update($change);
        if ($result) {
            return $result;
        } else {
            return 0;
        }

    }

    public function EditUpdate($change)
    {
        $result = DB::table('users')->where('id', Auth::id())->update($change);
        if ($result) {
            return $result;
        } else {
            return 0;
        }

    }

    public function updateUserDetails($where, $data)
    {
        try {
            $result = DB::table('users')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->update($data);
            return ($result) ? $result : 0;
        } catch (QueryException $e) {
            dd($e->getMessage());
            return 0;
        }

    }


    /**
     * @Desc   OrderUpdate in users tabel
     * @param $data
     * @return mixed
     * @since  29/jan/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function OrderUpdate($where, $data)
    {
        try {
            $result = DB::table('users')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->update($data);

            return $result;
        } catch (QueryException $e) {
            echo $e->getMessage();
        }
    }


    /**
     * @Desc updateEdit used in userscontroller
     * @param $data
     * @since 29/jan/ 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function updateEdit($where, $data)
    {
        try {
            $result = DB::table('users')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->update($data);
            return $result;
        } catch (QueryException $e) {
            echo $e->getMessage();
        }
    }


    /**
     * @Desc TotalAllUsersWhere display in dashbord  page
     * @param array $column
     * @return mixed
     * @since 29/jan/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function getUserDetails($where, $selectCols = ['*'])
    {
        try {
            $result = DB::table('users')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->select($selectCols)
                ->get();
            return $result;
        } catch (QueryException $e) {
            echo $e->getMessage();
        }
    }

    public function getTransctionDetails($where, $selectCols = ['*'])
    {
        try {
            $result = DB::table('transactions')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->join('users', 'users.id', '=', 'transactions.user_id')
                ->select($selectCols)
                ->get();
            return $result;
        } catch (QueryException $e) {
            echo $e->getMessage();
        }
    }
    /**
     * @Desc TotalAllOrderWhere dispaly in dashbord page
     * @param array $column
     * @since 29/jan/ 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    // User For AdminController and  Orders Controller

    public function getOrdersDetails($where, $column = ['*'])
    {
        try {
            $result = DB::table('orders')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->join('users', 'users.id', '=', 'orders.user_id')
                ->select($column)
//                ->order_by($datetime)
                ->get();

            return $result;
        } catch (QueryException $e) {
            echo $e->getMessage();
        }
    }
    /**
     * @Desc: getAllFilterUsers models functionality  ....
     * @param $where
     * @param $sortingOrder
     * @param $iDisplayStart
     * @return int
     * @since 5 feb 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function getAllFilterUsers($where, $sortingOrder, $iDisplayStart, $iDisplayLength)
    {

        try {
            if ($iDisplayLength < 0) {
                $result = DB::table('users')
                    ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
//                    ->join('plans', 'plans.plan_id', '=', 'orders.plan_id')
                    ->orderBy($sortingOrder[0], $sortingOrder[1])
                    ->select(['*'])
                    ->get();
            } else {
                $result = DB::table('users')
                    ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
//                    ->join('plans', 'plans.plan_id', '=', 'orders.plan_id')
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
//            echo $exc->getMessage();
            return 2;
        }
    }


    public function getUserDetailsDatabase($where)
    {
        $selectCols = array('id');
        try {
            $res = DB::table('users')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->select($selectCols)
                ->get();
            return $res;
        } catch (QueryException $e) {
            return $e->getMessage();
        }
    }

    public function updateUser()
    {
        try {
            $where = func_get_arg(0);
            $data = func_get_arg(1);
            $result = DB::table('users')
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
//            return $exc->getMessage();

        }
    }


    public function fetchUsers($id, $select = ['*'])
    {
        $result = DB::table('users')->where('id', $id)->join('orders', 'orders.order_id', '=', 'orders.comment_id')->select($select)->first();
        if ($result) {
            return $result;
        } else {
            return 0;
        }
    }


    public function getTransction($select = ['*'])
    {
        $result = DB::table($this->table)
            ->select($select)
            ->get();
        return $result;
    }


    public function addUsers($data)
    {
        try {

            $result = DB::table('users')->insertGetId($data);
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
     * @Desc: getRecurringDetails
     * @param $where
     * @param array $selectCols
     * @return mixed
     * @since   16.7.2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function getRecurringDetails($where, $selectCols = ['*'])
    {
        try {
            $result = DB::table('recurring_profiles')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->select($selectCols)
                ->get();
            return $result;
        } catch (QueryException $e) {
            echo $e->getMessage();
        }
    }






    /**
     * @Desc:deleteUsers
     * @return string
     * @since 24/7/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function deleteUsers()
    {
        if (func_num_args() > 0) {
            $where = func_get_arg(0);
            try {
                $result = DB::table('users')
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

}

