<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class Package extends Model
{
    protected static $_instance = null;

    public static function getInstance()
    {
        if (!is_object(self::$_instance))
            self::$_instance = new Package();
        return self::$_instance;
    }
    /**
     * @Desc registerdata functionality
     * @param $fillable
     * @return int
     * @since  13 feb 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function registerdata($fillable)
    {
        $result = DB::table('packages')->insertGetId($fillable);
        if ($result) {
            return ($result);

        } else {
            return 0;
        }
    }


    /**
     * @Desc: getPackagesDetails functionality
     * @param $where
     * @param array $column
     * @return mixed
     * @since 13 feb  2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function getPackagesDetails($where, $column = ['*'])
    {
        try {
            $result = DB::table('packages')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->select($column)
//                ->order_by($datetime)
                ->get();
//                ->count();

            return $result;
        } catch (QueryException $e) {
            echo $e->getMessage();
        }
    }


    /**
     * @Desc: getAllFilterPackages functionality
     * @param $where
     * @param $sortingOrder
     * @param $iDisplayStart
     * @param $iDisplayLength
     * @return int
     * @since 13 feb   2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function getAllFilterPackages($where, $sortingOrder, $iDisplayStart, $iDisplayLength)
    {

        try {
            if ($iDisplayLength < 0) {
                $result = DB::table('packages')
                    ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                    ->orderBy($sortingOrder[0], $sortingOrder[1])
                    ->select(['*'])
                    ->get();
            } else {
                $result = DB::table('packages')
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
     * @Desc:fetchPackageId functionality
     * @param $package_id
     * @param array $select
     * @return int
     * @since 13 feb  2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function fetchPackageId($where, $select = ['*'])
    {
        $result = DB::table('packages')
            ->join('plans', 'plans.plan_id', '=', 'packages.plan_id')
//            ->join('plans', 'plans.package_name', '=', 'packages.package_id')
            ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
            ->select($select)
            ->first();
        if ($result) {
            return $result;
        } else {
            return 0;
        }
    }


    /**
     * @Desc getPackagesDetailsDatabase
     * @param $where
     * @return string
     * @since  14 feb 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function getPackagesDetailsDatabase($where)
    {
        $selectCols = array('package_id');
        try {
            $res = DB::table('packages')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->select($selectCols)
                ->get();
            return $res;
        } catch (QueryException $e) {
            return $e->getMessage();
        }
    }


    /**
     * @Desc deletePackages
     * @param $where
     * @return int
     * @since  14 feb 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function deletePackages($where)
    {
        try {
            $result = DB::table('packages')
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

    public function updateEdit($where, $data)
    {
        try {
            $result = DB::table('packages')
//                ->join('plans', 'plans.plan_id', '=', 'packages.plan_id')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->update($data);
            return ($result) ? $result : 0;
        } catch (QueryException $e) {
            echo $e->getMessage();
        }
    }
    /**
     * @Desc:getPackagesDatabase
     * @param $where
     * @return string
     * @since  16 feb 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function getPackagesDatabase($where)
    {
        $selectCols = array('package_id');
        try {
            $res = DB::table('packages')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->select($selectCols)
                ->get();
            return $res;
        } catch (QueryException $e) {
            return $e->getMessage();
        }
    }


    /**
     * @Desc: updatePackages  funtionality
     * @return int
     * @since   16 feb   2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function updatePackages()
    {
        try {
            $where = func_get_arg(0);
            $data = func_get_arg(1);
            $result = DB::table('packages')
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







    public function UpdatePackage($where, $data)
    {

        try {
            $result = DB::table('packages')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->update($data);
            return $result;
        } catch (QueryException $data) {
            echo $data->getMessage();
        }
    }


    public function addPackages($data)
    {
        try {

            $result = DB::table('packages')->insertGetId($data);
            if ($result) {
                return $result;

            } else {
                return 0;
            }
        } catch (QueryException $e) {
            echo $e->getMessage();
        }
    }




    public function fetchPackageIdUpdate($package_id, $select=['*'])
    {
        $result = DB::table('packages')->where('package_id',$package_id)->select($select)->first();
        if ($result) {
            return $result;
        } else {
            return 0;
        }
    }





    /**
     * @Desc:deleteUsers
     * @return string
     * @since 24/7/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function deletePackage()
    {
        if (func_num_args() > 0) {
            $where = func_get_arg(0);
            try {
                $result = DB::table('packages')
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



