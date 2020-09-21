<?php
/**
 * Created by Monali Samal.
 * User: monali samal <monalisamal@globussoft.in>
 * Date: 3/6/2018
 * Time: 11:45 AM
 */

namespace App\Modules\Admin\Controllers;

use App\Modules\Admin\Models\Comment;
use App\Modules\Admin\Models\CommentsGroups;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
//use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;

//use  Validator;

use users;
use DataTables;
use App\User;

class CommentController extends Controller
{

    /**
     * @Desc ::commentTable
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since  7 march   2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function commentTable(Request $request)
    {
        $data = DB::table('comments_groups')->get();
//        dd($data);
        return view('Admin::Comment/comment', ['data' => $data]);

    }

    /**
     * @Desc databaseComment
     * @return mixed
     * @since 7 march  2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function databaseComment()
    {
        $data = DB::table('comments_groups')->get();
        $data = json_decode(json_encode($data), true);

        $usersDetails = new Collection();
        foreach ($data as $key => $user) {
            $status = '';
            if ($user['status'] == 0) {
                $status = '<button data-id="' . $user['comment_group_id'] . '" data-status="1"
                           class="changeStatus btn btn-xs btn-ripple btn-flat btn-danger" style="cursor:pointer;"><i class="fa fa-times-circle-o"></i></button></td>';
            } else if ($user['status'] == 1) {
                $status = '<button data-id="' . $user['comment_group_id'] . '" data-status="0"
                       class="changeStatus  btn btn-xs btn-ripple btn-flat btn-success" style="cursor:pointer;"><i class="fa fa-check-circle-o "></i></button></td>';
            }
            $usersDetails->push([
                'comment_group_id' => $user['comment_group_id'],
                'comment_group_name' => $user['comment_group_name'],
                'status' => $status,
                'edit' => '<button class="btn-sm btn-default editUserdetails" title="Edit" data-id="' . $user['comment_group_id'] . '"  data-target="#editUserModal" class="modal-body" data-toggle="modal"><i class="icon-pencil""></i></button>',
                'delete' => ' <a href="javascript:;"><i class=" fa fa-trash" title="Delete" id="deleteCommnet" data-id=' . $user['comment_group_id'] . '></i></a>',

            ]);
        }
        return DataTables::of($usersDetails)->rawColumns(['edit', 'delete', 'status', 'update'])->make(true);

    }


    /**
     * @Desc:commentStatusChangeAjaxHandel
     * @param Request $request
     * @since  7 march 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function commentStatusChangeAjaxHandel(Request $request)
    {

        if ($request->isMethod('post')) {
            $admindataparse = new Comment();
            $whereForUpdate = ['rawQuery' => 'comment_group_id = ?', 'bindParams' => [$request->input('comment_group_id')]];
            $dataToUpdate = ['status' => $request->input('status')];
            $updated = $admindataparse->commentUpdate($whereForUpdate, $dataToUpdate);
            if ($updated)
                echo json_encode(['status' => 200, 'message' => 'Action Performed Successfully']);
            else echo json_encode(['status' => 400, 'message' => 'Something went wrong, please try again.']);
        } else {

            echo json_encode(['status' => 401, 'message' => 'Request not allowed, Only post request is allowed']);
        }

    }

//

    /**
     * @Desc: deleteCommnetFunctionality
     * @param Request $request
     * @since 7 march  2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function deleteCommnetFunctionality(Request $request)
    {
        if ($request->isMethod('post')) {
            $comment_group_id = $request->input('comment_group_id');
            $objModelComment = new Comment();
            $objModelGroup = new Comment();
            $whereForDelete = array(
                'rawQuery' => 'comment_group_id = ?',
                'bindParams' => [$comment_group_id]
            );
            $deletedCommentGroup = $objModelGroup->deleteCommentGroupWhere($whereForDelete);
            $deletedComment = $objModelComment->deleteCommentWhere($whereForDelete);
            if ($deletedComment || $deletedCommentGroup) {
                echo json_encode(array('status' => '200', 'message' => 'Comment has been successfully deleted'));
            } else {
                echo json_encode(array('status' => '400', 'message' => 'error'));
            }
        }
    }


    /**
     * @Desc:EditAjaxHandlerComment
     * @param Request $request
     * @since  7 march 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function EditAjaxHandlerComment(Request $request)
    {
        if ($request->isMethod('post')) {
            $comment_group_id = $request->input('comment_group_id');

            $objcommentModel = new Comment();

            $whereForDelete = array(
                'rawQuery' => 'comments_groups.comment_group_id = ?',
                'bindParams' => [$comment_group_id]
            );
            $commentDetailsGRoup = $objcommentModel->fetchcomment($whereForDelete);
            $commentDetailsGRoup = json_decode(json_encode($commentDetailsGRoup), true);
            $commentResult['comments'] = json_decode($commentDetailsGRoup['comments']);

            if ($commentDetailsGRoup)
                echo json_encode(['status' => 200, 'msg' => 'User details found.', 'data' => $commentDetailsGRoup]);
            else
                echo json_encode(['status' => 400, 'msg' => 'User details not found.']);
        } else {
            echo json_encode(['status' => 401, 'msg' => 'Request couldnt be completed,Only post method is allowed.']);
        }

    }


    /**
     * @Desc: updateAjaxHandler
     * @param Request $request
     * @since 7 march 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function updateAjaxHandler(Request $request)
    {

        if ($request->isMethod('post')) {
            $validator= Validator::make($request->all(), [
//                'comments' => 'required',
                'comment_group_name' => 'required',
                    'comments' => 'required|regex:/^[\x00-\x7F]*$/',


            ]);
            if ($validator->fails()) {
                echo json_encode(['status' => 400, 'message' => array_values(json_decode($validator->messages(),true))[0][0]]);
                die;
            }

            $postData = $request->all();
            $admindataparse = new Comment();
            $comments = $request->input('comments') ? json_encode(preg_split('/\r\n|\r|\n/', $request->input('comments'))) : json_encode([]);
            $comm_group_name = $request->input('comment_group_name');
            $updateData = array('comments.comments' => $comments, 'comments_groups.comment_group_name' => $comm_group_name);
            $whereForUpdate = ['rawQuery' => 'comments_groups.comment_group_id = ?', 'bindParams' => [$postData['comment_group_id']]];
            unset($postData['comment_group_id']);
            $updated = $admindataparse->updateComments($whereForUpdate, $updateData);
            if ($updated)
                echo json_encode(['status' => 200, 'message' => 'Updated successfully.']);
            else if ($updated == 0)
                echo json_encode(['status' => 201, 'message' => 'You have made no changes to save.']);
            else
                echo json_encode(['status' => 400, 'message' => 'Something went wrong, please try again.']);
        } else {
            echo json_encode(['status' => 401, 'message' => 'Request not allowed, Only post request is allowed']);
        }

    }


    /**
     * @Desc: addingComments
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @since 7 march 2018
     * @author Monali Samal (monalisamal@globussoft.in)
     */
    public function addingComments(Request $request)
    {
        $data = $request->input('comments');
        if ($request->isMethod('post')) {

            $rules = [
                'comment_group_name' => 'required',
                'comments' => 'required'
            ];
            $message = [
                'comment_group_name' => 'Please Enter Group Name',
                'comments' => 'Please enter something'
//
            ];
            $validator = validator::make($request->input(), $rules, $message);
            if ($validator->fails()) {
                return back()->WithErrors($validator)->WithInput();
            }

//            $result = json_decode(json_encode($result), true);
            $data = json_decode(json_encode($data), true);

            foreach ($data as $key => $user) {

                $fillable = array();
                $fillable['comments'] = $request->input('comments') ? json_encode(preg_split('/\r\n|\r|\n/', $request->input('comments')[0])) : json_encode([]);

                $fillable['comment_group_name'] = $request->input('comment_group_name');
                $fillable['added_at'] =time();
                $fillable['user_id '] =Session::get('admin')['id'];


                $dataToInsert = ['comment_group_name' => $fillable['comment_group_name']];

                $result = DB::table('comments_groups')->insertGetId($dataToInsert);
                $insertedId = $result;
                $dataToInsertInComment = ['comment_group_id' => $insertedId, 'comments' => $fillable['comments'],'added_at'=>$fillable['added_at']];
                $resultOfComment = DB::table('comments')->insertGetId($dataToInsertInComment);
                array_push($dataToInsert, $resultOfComment);
//

            }
            if ($resultOfComment) {
                return redirect('/admin/addingComments')->with('status', 'Comment store  sucessfully');
            } else {
                return back('/admin/addingComments');
            }
        }
        return view('Admin::Comment/addingComment');
    }


}






