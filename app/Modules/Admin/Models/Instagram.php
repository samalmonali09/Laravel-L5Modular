<?php


namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class Instagram extends Model
{

    protected $table = 'instagram_accounts';


    /**
     * @Desc:getAllFilterInstagramDetails
     * @param $where
     * @param $sortingOrder
     * @param $iDisplayStart
     * @param $iDisplayLength
     * @return int
     * @since 11/10/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function getAllFilterInstagramDetails($where, $sortingOrder, $iDisplayStart, $iDisplayLength)
    {

        try {
            if ($iDisplayLength < 0) {
                $result = DB::table('instagram_accounts')
                    ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                    ->orderBy($sortingOrder[0], $sortingOrder[1])
                    ->select(['*'])

                    ->get();
            } else {
                $result = DB::table('instagram_accounts')
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
     * @Desc:getInstagramDetails
     * @param $where
     * @param array $column
     * @return mixed
     * @since 11/10/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function getInstagramDetails($where, $column = ['*'])
    {
        try {
            $result = DB::table('instagram_accounts')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->select($column)
                ->get();

            return $result;
        } catch (QueryException $e) {
            echo $e->getMessage();
        }
    }


    /**
     * @Desc:getInstaUserDetails
     * @param $where
     * @param array $column
     * @return mixed
     * @since 11/10/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function getInstaUserDetails($where, $column = ['*'])
    {
        try {
            $result = DB::table('instagram_accounts')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->select($column)
                ->get();

            return $result;
        } catch (QueryException $e) {
            echo $e->getMessage();
        }
    }


    /**
     * @Desc:fetchAutolikes
     * @param $profile_id
     * @param array $select
     * @return int
     * @since 11/10/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function fetchAutolikes($profile_id, $select = ['*'])
    {
        $result = DB::table('instagram_accounts')
            ->where('instagram_accounts_id',$profile_id)
            ->select($select)
            ->first();
        if ($result) {
            return $result;
        } else {
            return 0;
        }
    }


    /**
     * @Desc:getPaymentDetails
     * @param $where
     * @param array $select
     * @return mixed
     * @since 11/10/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function getPaymentDetails($where, $select = ['*'])
    {
        try {
            $result = DB::table('instagram_accounts')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->select($select)
                ->get();

            return $result;
        } catch (QueryException $e) {
            echo $e->getMessage();
        }
    }


    /**
     * @Desc:fetchExtraDetails
     * @param $instagram_accounts_id
     * @param array $select
     * @return int
     * @since 11/10/2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function fetchExtraDetails($instagram_accounts_id, $select = ['*'])
    {
        $result = DB::table('instagram_accounts')
            ->where('instagram_accounts_id',$instagram_accounts_id)
            ->select($select)
            ->first();
        if ($result) {
            return $result;
        } else {
            return 0;
        }
    }

    public function addInstagram($data)
    {
        try {

            $result = DB::table('instagram_accounts')->insertGetId($data);
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