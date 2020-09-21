<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class DBClass
{
    public static $_instance = null;

    public static function getInstance()
    {
        if (!is_object(self::$_instance))
            self::$_instance = new DBClass();
        return self::$_instance;
    }

    public function getCount($table, $where)
    {
        try {
            $result = DB::table($table)
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->count();
            return ($result) ? $result : 0;
        } catch (QueryException $e) {
//            return $e->getMessage();
            return 0;
        }
    }

    public function insert($table, $data)
    {
        try {
            $result = DB::table($table)->insertGetId($data);
            return $result;
        } catch (\Exception $e) {
            dd($e->getMessage());
            return 0;
        }
    }

    public function insertMultipleData($table, $data)
    {
        try {
            $result = DB::table($table)->insert($data);
            return $result;
        } catch (\Exception $e) {
            dd($e->getMessage());
            return 0;
        }
    }

    public function selectQuery($table, $where, $selectedColumns = ['*'])
    {
        try {
            $result = DB::table($table)
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->select($selectedColumns)
                ->get();

            return ($result) ? json_decode($result, true) : [];
        } catch (QueryException $e) {
            return $e->getMessage();
            return [];
        }

    }

    public function selectQueryBySort($table, $where, $selectedColumns = ['*'], $limit = 2147483647, $sortingArr)
    {
        try {
            $result = DB::table($table)
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->select($selectedColumns)
                ->ORDERBY($sortingArr['column'], $sortingArr['order'])
                ->LIMIT($limit)
                ->get();

            return ($result) ? json_decode($result, true) : [];
        } catch (QueryException $e) {
            return $e->getMessage();
            return [];
        }

    }

    public function selectQueryWithJoin($table, $tableToJoin, $onRelation1, $onRelation2, $where, $selectCols = ['*'])
    {
        try {
            $result = DB::table($table)
                ->join($tableToJoin, $onRelation1, $onRelation2)
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->select($selectCols)
                ->get();
            return ($result) ? json_decode($result, true) : [];
        } catch (QueryException $e) {
            return $e->getMessage();
            return [];
        }

    }

    public function selectQueryWithLeftJoinBySort($table, $tableToJoin, $onRelation1, $onRelation2, $where, $selectCols = ['*'], $limit = 2147483647, $sortingArr)  // 2147483647 :- max value of int
    {
        try {
            $result = DB::table($table)
                ->leftJoin($tableToJoin, $onRelation1, $onRelation2)
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->select($selectCols)
                ->ORDERBY($sortingArr['column'], $sortingArr['order'])
                ->LIMIT($limit)
                ->get();
            return ($result) ? json_decode($result, true) : [];
        } catch (QueryException $e) {
            return $e->getMessage();
            return [];
        }

    }

    /**
     * Update rows
     * @return string
     * @throws Exception
     * @since 04-07-2018
     * @author Saurabh Kumar <saurabh.kumar@globussoft.com>
     */
    public function updateQuery($table, $where, $data)
    {
        try {
            $result = DB::table($table)
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->update($data);
            return ($result) ? 1 : 2;
        } catch (\Exception $e) {
            dd($e->getMessage());
            return 0;

        }
    }

    /**
     * Update rows
     * @return string
     * @throws Exception
     * @since 01-08-2018 12:30 AM Midnight
     * @author Saurabh Kumar <saurabh.kumar@globussoft.com>
     */
    public function updateQueryWithJoin($table, $tableToJoin, $onRelation1, $onRelation2, $where, $data)
    {
        try {
            $result = DB::table($table)
                ->join($tableToJoin, $onRelation1, $onRelation2)
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->update($data);
            return ($result) ? 1 : 2;
        } catch (\Exception $e) {
            dd($e->getMessage());
            return 0;

        }
    }

    public function increment($table, $where, $columnName)
    {
        try {
            DB::table($table)
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->increment($columnName);
        } catch (QueryException $e) {
            return $e->getMessage();
        }
    }

    public function deleteQueryWithJoin($table, $tableToJoin, $onRelation1, $onRelation2, $where)
    {
        try {
            $result = DB::table($table)
                ->leftJoin($tableToJoin, $onRelation1, $onRelation2)
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->delete();
            return ($result) ? 1 : 0;
        } catch (\Exception $e) {
//            dd($e->getMessage());
            return 0;

        }

    }

}