<?php
/**
 * Created by Monali Samal.
 * User: monali samal <monalisamal@globussoft.in>
 * Date: 3/6/2018
 * Time: 10:45 AM
 */

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class Comment extends Model
{

    protected $table = 'comments';

    protected static $_instance = null;

    public static function getInstance()
    {
        if (!is_object(self::$_instance))
            self::$_instance = new Comment();
        return self::$_instance;
    }

    /**
     * @Desc commentUpdate
     * @param $where
     * @param $data
     * @return mixed
     * @since  7 march 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function commentUpdate($where, $data)
    {

        try {
            $result = DB::table('comments_groups')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->update($data);
            return $result;
        } catch (QueryException $data) {
            echo $data->getMessage();
        }
    }


    /**
     * @Desc deleteCommentGroupWhere
     * @return string
     * @since 7 march  2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function deleteCommentGroupWhere()
    {
        if (func_num_args() > 0) {
            $where = func_get_arg(0);
            try {
                $result = DB::table('comments_groups')
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
     * @Desc:deleteCommentWhere
     * @return string
     * @since 7 march  2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function deleteCommentWhere()
    {
        if (func_num_args() > 0) {
            $where = func_get_arg(0);
            try {
                $result = DB::table('comments')
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
     * @Desc: fetchcomment
     * @param $where
     * @param array $select
     * @return int
     * @since  7 march 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function fetchcomment($where, $select = ['*'])
    {
        $result = DB::table('comments')
            ->join('comments_groups', 'comments_groups.comment_group_id', '=', 'comments.comment_group_id')
            ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
            ->select($select)
            ->first();
//        dd($result);
        if ($result) {
//        die('here');
            return $result;
        } else {
            return 0;
        }
    }


    /**
     * @Desc: updateComment
     * @param $where
     * @param $data
     * @return int
     * @since  7 march 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function updateComment($where, $data)
    {
        try {
            $result = DB::table('comments')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->leftjoin('comments_groups', 'comments_groups.comment_group_id', '=', 'comments.comment_group_id')
                ->update($data);
            return ($result) ? $result : 0;
        } catch (QueryException $e) {
            echo $e->getMessage();
        }
    }

    public function updateComments($where, $data)
    {
        if (func_num_args() > 0) {

            try {
                $result = DB::table($this->table)
                    ->join('comments_groups', 'comments_groups.comment_group_id', '=', $this->table . '.comment_group_id')
                    ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                    ->update($data);
                return $result ? $result : [];
            } catch (\Exception $e) {
                throw new \Exception($e->getMessage());
            }
        } else {
            throw new \Exception("argument not passed.");
        }
    }

    /**
     * @Desc
     * @param $x
     * @return mixed
     * @since 7 /3/ 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function insertdata($x)
    {
        $result = DB::table('comments')->insertGetId($x);
        if ($result) {
            return $result;
        } else {
            dd('error');
        }
    }


    /**
     * @Desc insertGetIdCommentGrp
     * @param $demo
     * @return int
     * @since   7 march 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function insertGetIdCommentGrp($demo)
    {
        $result = DB::table('comments_groups')
            ->insertGetId($demo);
        if ($result) {
            return ($result);

        } else {
            return 0;
        }
    }

    public function getComments($where, $selectedCols = ['*'])
    {
        if (func_num_args() > 0) {
            try {
                $result = DB::table($this->table)
                    ->join('comments_groups', 'comments_groups.comment_group_id', '=', $this->table . '.comment_group_id')
                    ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                    ->select($selectedCols)
                    ->get();

                return $result ? $result : [];
            } catch (\Exception $e) {
                throw new \Exception($e->getMessage());
            }
        } else {
            throw new \Exception("argument not passed.");
        }
    }

    public function insertComments($commentData)
    {
        if (func_num_args() > 0) {
            try {
                $result = DB::table($this->table)->insertGetId($commentData);
                return $result ? $result : [];
            } catch (\Exception $e) {
                throw new \Exception($e->getMessage());
            }
        } else {
            throw new \Exception("argument not passed.");
        }
    }

    public function addNewComment()
    {
        if (func_num_args() > 0) {
            $data = func_get_arg(0);
            try {
                $result = DB::table($this->table)->insertGetId($data);
                return $result;
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        } else {
            throw new Exception('Argument Not Passed');
        }
    }

}