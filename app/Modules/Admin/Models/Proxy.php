<?php


namespace App\Modules\Admin\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class Proxy
{


    /**
     * @Desc :: getPRoxyDetails
     * @param $where
     * @param array $selectCols
     * @return mixed
     * @since 10 march   2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function getPRoxyDetails($where, $selectCols = ['*'])
    {
        try {
            $result = DB::table('proxies')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->select($selectCols)
                ->get();
            return $result;
        } catch (QueryException $e) {
            echo $e->getMessage();
        }
    }


    /**
     * @Desc: getAllFilterProxy
     * @param $where
     * @param $sortingOrder
     * @param $iDisplayStart
     * @param $iDisplayLength
     * @return int
     * @since    10 march 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function getAllFilterProxy($where, $sortingOrder, $iDisplayStart, $iDisplayLength)
    {

        try {
            if ($iDisplayLength < 0) {
                $result = DB::table('proxies')
                    ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                    ->orderBy($sortingOrder[0], $sortingOrder[1])
                    ->select(['*'])
                    ->get();
            } else {
                $result = DB::table('proxies')
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
     * @Desc:  deleteproxy
     * @return string
     * @since   10 march 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function deleteproxy()
    {
        if (func_num_args() > 0) {
            $where = func_get_arg(0);
            try {
                $result = DB::table('proxies')
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
     * @Desc : updateProxy
     * @param $where
     * @param $data
     * @return mixed
     * @since  10 march  2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function updateProxy($where, $data)
    {

        try {
            $result = DB::table('proxies')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->update($data);
            return $result;
        } catch (QueryException $data) {
            echo $data->getMessage();
        }
    }




    public function addProxy($data)
    {
        try {

            $result = DB::table('proxies')->insertGetId($data);
            if ($result) {
                return $result;

            } else {
                return 0;
            }
        } catch (QueryException $e) {
            echo $e->getMessage();
        }
    }


    public function AddProxyUpdate($data)
    {
        try {
            $initialCount = DB::table('proxies')->count();
            $result = DB::table('proxies')
                ->insert($data);
            if ($result) {
                $finalCount = DB::table('proxies')->count();
                $totalInsertedRows = $finalCount - $initialCount;
                return $totalInsertedRows;
            } else {
                return 0;
            }
        } catch (\Exception $e) {
            return 0;
        }
    }



    public function addProxyText($data)
    {
        try {
            $initialCount = DB::table('proxies')->count();
            $result = DB::table('proxies')
                ->insert($data);
            if ($result) {
                $finalCount = DB::table('proxies')->count();
                $totalInsertedRows = $finalCount - $initialCount;
                return $totalInsertedRows;
            } else {
                return 0;
            }
        } catch (\Exception $e) {
            return 0;
        }
    }


//    --------------------------------------------------------------

    public function getAllProxies()
    {
        $result = DB::table('proxies')
            ->select()
            ->get();
        return $result;
    }





    public function updateMultipleRows()
    {
        if (func_num_args() > 0) {
            $columnName = func_get_arg(0);
            $data = func_get_arg(1);
            try {

                $initialCount = DB::table('proxies')->count();
                $result = DB::insert("INSERT INTO proxies (" . $columnName . ") VALUES " . $data . " ON DUPLICATE KEY UPDATE ip=VALUES(ip),port=VALUES(port),proxy_type=VALUES(proxy_type),username=VALUES(username),password=VALUES(password),location=VALUES(location)");
                if ($result) {
                    $finalCount = DB::table('proxies')->count();
                    $totalInsertedRows = $finalCount - $initialCount;
                    return $totalInsertedRows;
                } else {
                    return 0;
                }
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        } else {
            throw new \Exception('Argument Not Passed');
        }
    }


//--------------------------------------










    public function updatedTotalRow()
    {
        if (func_num_args() > 0) {
            $columnName = func_get_arg(0);
            $data = func_get_arg(1);
            try {

                $initialCount = DB::table('proxies')->count();
                $result = DB::table('proxies');
//                $result = DB::insert("INSERT INTO proxies (" . $columnName . ") VALUES " . $data . " ON DUPLICATE KEY UPDATE ip=VALUES(ip),port=VALUES(port),proxy_type=VALUES(proxy_type),username=VALUES(username),password=VALUES(password),location=VALUES(location)");
                if ($result) {
                    $finalCount = DB::table('proxies')->count();
                    $totalInsertedRows = $finalCount - $initialCount;
                    return $totalInsertedRows;
                } else {
                    return 0;
                }
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        } else {
            throw new \Exception('Argument Not Passed');
        }
    }

    public $fillable = ['proxy_id','ip','port','username','password','location','proxy_type','busy_status','working_status','execution_time','proxy_hit_count','last_used_at'];

}
