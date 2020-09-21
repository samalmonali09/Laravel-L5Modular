<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class Niche extends Model
{


    public function getnichesDetails($where, $column = ['*'])
    {
        try {
            $result = DB::table('niches')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->select($column)
                ->get();

            return $result;
        } catch (QueryException $e) {
            echo $e->getMessage();
        }
    }


    public function getAllFilterniches($where, $sortingOrder, $iDisplayStart, $iDisplayLength)
    {

        try {
            if ($iDisplayLength < 0) {
                $result = DB::table('niches')
                    ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                    ->orderBy($sortingOrder[0], $sortingOrder[1])
                    ->select(['*'])
                    ->get();
            } else {
                $result = DB::table('niches')
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


    public function updateNicheStatus($where, $data)
    {

        try {
            $result = DB::table('niches')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->update($data);
            return $result;
        } catch (QueryException $data) {
            echo $data->getMessage();
        }
    }

    public function fetchNicheId($niche_id, $select = ['*'])
    {
        $result = DB::table('niches')->where('niche_id', $niche_id)->select($select)->first();
        if ($result) {
            return $result;
        } else {
            return 0;
        }
    }


    public function updateNichedetails($where, $data)
    {
        try {
            $result = DB::table('niches')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->update($data);
            return $result;
        } catch (QueryException $data) {
            echo $data->getMessage();
        }
    }

    public function updateNichedetails2($data)
    {
        try {
            $result = DB::table('niches')
                ->update($data);

            return $result;
        } catch (QueryException $data) {
            echo $data->getMessage();
        }
    }

    public function deleteNiche()
    {
        if (func_num_args() > 0) {
            $where = func_get_arg(0);
            try {
                $result = DB::table('niches')
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


    public function updateNicheWhere()
    {
        if (func_num_args() > 0) {
            $data = func_get_arg(1);
            $where = func_get_arg(0);
            try {
                $result = DB::table('niches')
                    ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                    ->tosql();
//                    ->update($data);
//                dd($result)
                return $result;
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        } else {
            throw new \Exception('Argument Not Passed');
        }
    }

    public function addNiche($data)
    {
        try {

            $result = DB::table('niches')->insertGetId($data);
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

