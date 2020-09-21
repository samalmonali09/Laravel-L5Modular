<?php

namespace App\Modules\manage\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;


class manage extends Model {


    /**
     * @Desc:AvailableDataUpdate
     * @param $where
     * @param $data
     * @return mixed
     * @since  2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function AvailableDataUpdate($where, $data){

        try{
            $result = DB::table('users')
                ->whereRaw($where['rawQuery'],isset($where['bindParams'])?$where['bindParams']:array())
                ->update($data);
            return $result;
        }catch (QueryException $data){
            echo $data->getMessage();
        }
    }


    /**
     * @Desc:DataUpdate
     * @param $where
     * @param $data
     * @param $Columns
     * @return mixed
     * @since  2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function DataUpdate($where, $data, $Columns){
        try{
            $result =DB::table('users')
                ->whereRaw($where['rawQuery'],isset($where['bindParams'])?$where['bindParams']:array())
                ->update($data)
                ->select($Columns);

            return $result;
        }catch(QueryException $e){
            echo $e->getMessage();
        }
    }

}
