<?php

namespace App\Modules\User\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Laravel\Lumen\Auth\Authorizable;

class Transaction extends Model {

    //

    private static $_instance = null;

    public static function getInstance()
    {
        if (!is_object(self::$_instance))  //or if( is_null(self::$_instance) ) or if( self::$_instance == null )
            self::$_instance = new Transaction();
        return self::$_instance;
    }
    public function insertTransaction($transactionDetails)
    {
        if (func_num_args() > 0) {

            $data = func_get_arg(0);
            try {
                $result= DB::table('transactions')
                    ->insertGetId($transactionDetails);
             if ($result){
                 return $result;
             }else return 0;
            } catch (QueryException $e) {
                dd($e->getMessage());
                apiResponse(400, 'Something went wrong, please try after sometime.', $e->getMessage(), null);
            }
        }
    }

    /**
     * @Desc update user free package status after getting free package
     * @param $where
     * @param $data
     * @return int
     * @author Sibasankar Bhoi (sibasankarbhoi@globussoft.in)
     * @since 11-June-2018
     */
    public function updatefreepackageUser($where, $data){

        try {
            $result = DB::table('users')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->update($data);
            return ($result) ? $result : 0;
        } catch (QueryException $e) {
            echo $e->getMessage();
            return 0;
        }
    }



    public function insertComments($comments)
    {
        try {
            $user_order_history = DB::table('comments')->insertGetId($comments);

            return $user_order_history;

        } catch (\Exception $exc) {
            dd($exc->getMessage());
            die;
        }
    }

}