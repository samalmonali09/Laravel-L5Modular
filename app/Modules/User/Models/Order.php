<?php

namespace App\Modules\User\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Laravel\Lumen\Auth\Authorizable;

class Order extends Model {

    //

    private static $_instance = null;

    public static function getInstance()
    {
        if (!is_object(self::$_instance))  //or if( is_null(self::$_instance) ) or if( self::$_instance == null )
            self::$_instance = new Order();
        return self::$_instance;
    }
    public function insertOrder($orderDetails)
    {
        if (func_num_args() > 0) {

            $data = func_get_arg(0);
            try {
                $result= DB::table('orders')
                    ->insertGetId($orderDetails);
                if ($result){
                    return $result;
                }else return 0;
            } catch (QueryException $e) {
                dd($e->getMessage());
                apiResponse(400, 'Something went wrong, please try after sometime.', $e->getMessage(), null);
            }
        }
    }


}