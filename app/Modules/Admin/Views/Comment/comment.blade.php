{{--/**--}}
{{--* Created by Monali Samal.--}}
{{--* User: monali samal <monalisamal@globussoft.in>-}}
{{--* Date: 3/6/2018--}}
{{--* Time: 11:15 AM--}}
{{--*/--}}


@extends('Admin::Layouts.adminlayout')
@section('Comments','active open')

@section('pageheadcontent')
    {{--<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">--}}

    {{--<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">--}}
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    {{--<link href="/GAIA/assets/admin/layout/css/toastr.css" rel="stylesheet" type="text/css"/>--}}



    <style>

        #editUserModal input {
            padding: 8px;

        }


    </style>
@endsection

@section('pagecontent')



    <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title" style="color: #074c66">
        Manage Comments
    </h3>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="/admin/commentTable">Manage Comment</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="/admin/commentTable">Manage comments</a>
            </li>
        </ul>
    </div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        <div class="col-md-12">
            <div class="note note-danger" hidden>
                <p>
                    NOTE: The below datatable is not connected to a real database so the filter and sorting is just
                    simulated for demo purposes only.
                </p>
            </div>
            <!-- Begin: life time stats -->
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-shopping-cart"></i>Comment  Listing
                    </div>
                    <div class="actions">

                        <a href="/admin/addingComments">

                            <button class="btn blue pull-right" data-toggle="modal"
                                    data-target="#addOrders" onclick="resetForm()"><i class="fa fa-plus-circle"></i>
                                AddComments

                            </button>
                        </a>

                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-container">

                        <table class="table table-responsive table-striped table-bordered table-hover"
                               id="datatable_ajax">
                            <thead>
                                <th width="10%" style="color: #020d10">
                                    ID&nbsp;
                                </th>
                                <th width="30%" style="color: #020c0f">
                                    Comments Group
                                </th>
                                <th width="20%" style="color: #010b0d">
                                    Status
                                </th>
                                <th width="15%" style="color: #010b0d">
                                    Edit
                                </th>
                                <th width="15%" style="color: #010b0d">
                                    Delete
                                </th>

                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{--Edit Modal--}}
    <div id="editUserModal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            {{--<div class="modal-content">--}}
            <div class="modal-header">
                @if(Session::has('message'))
                    @if(session('status')=='Success')
                        <div style="color:green;"><b>{{session('status')}}</b> {{Session::get('message')}} <a
                                    href="/admin/commentTable">Go Back</a></div>
                    @elseif(session('status')=='Error')
                        <div style="color:red;"><b>{{session('status')}}</b> {{Session::get('message')}}</div>
                    @endif
                @endif

                <div class="modal-content">
                    <div class="modal-header" style="background-color: #4b95ab;color: #fff;text-align: center;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">EditComment</h4>

                    </div>
                    <div class="modal-body">
                        <form class="form" role="form" id="edit_usernameForm">
                            <div class="form-group">
                                <label for="">Comment Group</label>
                                <p><input type="text" name="comment_group_name" id="comment_group_name" required
                                          placeholder="comment_group_name"></p>
                            </div>
                            Comment:
                            <div class="form-group">
                                <textarea type="text" name="comments" id="comments", rows="10" cols="55" required
                                          placeholder="comments"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <div class="modal-header">

                            <a href="/admin/commentTable" class="btn btn-primary btn-flat btn-ripple"
                               data-dismiss="modal"
                               id="edit_cancelButton" > Go Back
                            </a>
                            <button type="button" class="btn btn-primary updateGeneralInfo"><span>Save Changes </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT-->
@endsection
@section('pagescripts')

    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

    {{--<!-- Bootstrap JavaScript -->--}}
    <script type="text/javascript">

        $(document).ready(function () {
            toastr.options.positionClass = 'toast-top-center';
            toastr.options.progressBar = true;
            toastr.options.preventDuplicates = true;
            toastr.options.closeButton = true;

            $('input[type="search"]').css({'height': '5px'});


            $('#datatable_ajax').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "/admin/comment/databaseData",


                "columns": [
                    {data: 'comment_group_id', name: 'comment_group_id'},
                    {data: 'comment_group_name', name: 'comment_group_name'},
                    {data: 'status', name: 'status'},
                    {data: 'edit', name: 'edit'},
                    {data: 'delete', name: 'delete'},
                ],
                order: [[0, 'desc']]

            });


            $(document.body).on('click', '.changeStatus', function () {
                console.log("button status is clicked");
                var data = $(this);
                var ButtonStatus = data.hasClass('btn-success') ? '0' : '1';
                var remz = confirm('Are you sure want to change ? ');
                if (remz) {
                    $.ajax({
                        url: '/admin/satusCommnents',
                        dataType: 'json',
                        type: 'post',
                        data: {comment_group_id: $(this).attr('data-Id'), status: ButtonStatus},
                        success: function (response) {
                            console.log(response);
                            if (response['status'] == 200) {
                                if (ButtonStatus == 0) {
                                    data.removeClass('btn-success');
                                    data.children().removeClass('fa-check-circle-o');
                                    data.addClass('btn-danger');
                                    data.children().addClass('fa-times-circle-o');
                                } else {
                                    data.removeClass('label-danger');
                                    data.children().removeClass('fa-times-circle-o');
                                    data.addClass('btn-success');
                                    data.children().addClass('fa-check-circle-o');
                                    data.removeClass('btn-danger');
                                }
                                toastr.success(response.message);
                            } else {
                            }
                        }
                    });
                }
            });


            $('#editUserModal').on('hidden.bs.modal', function (e) {
                $('#editUserModal').modal('hide').find("input[name=comments],input[name=comment_group_name]").val('').end();
            });


            $(document.body).on('click', '#deleteCommnet', function () {
                var obj = $(this);
                var comment_group_id = $(this).attr('data-id');
                console.log(comment_group_id);
                var remz = confirm('Are you sure want to delete ?');
                if (remz) {
                    $.ajax({
                        url: '/admin/deleteComments',
                        type: 'post',
                        datatype: 'json',
                        data: {
                            comment_group_id: comment_group_id
                        },
                        success: function (response) {
                            response = $.parseJSON(response);
                            if (response['status'] == '200') {
                                toastr.success(response.message);
                                obj.parent().parent().parent().remove();
                            }
                            else {
                                console.log(response.message);
                            }
                        }
                    });
                }
            });

            $(document).on('click', '.editUserdetails', function () {
                console.log(' data Continue --------------------=======================', $(this).attr('data-id'));
               comment_group_id = $(this).attr('data-id');
                $.ajax({
                    url: '/admin/editComments',
                    dataType: 'json',
                    type: 'post',
                    data: {comment_group_id: comment_group_id},
                    success: function (res) {
                        console.log(res);
                        var userDetails = res.data;
                        if (res['status'] == 200) {
                            $('#datatable_ajax').DataTable().ajax.reload();
                            $('#comment_group_name').val(userDetails.comment_group_name);
                            $('#comments').text(userDetails.comments);
                            var strarray = JSON.parse(userDetails.comments.split(','));
                            console.log(strarray);
                            $('#comments').html('');
                            for (var i = 0; i < strarray.length; i++) {
                                $('#comments').append(strarray[i] + '\n');

                            }
                        } else {
                            toastr.error(res.msg, {timeOut: 4000});
                        }
                    }

                });
            });


            $(document).on('click', '.updateGeneralInfo', function () {
//                var  comment_group_id = $(this).attr('data-id');
                var allComments = [];
                $.each($('#comments'), function (i, v) {
                    allComments.push($(v).val());
//                    console.log('-------------------',allComments);
                });
                $.ajax({
                    url: '/admin/updateComments',
                    dataType: 'json',
                    type: 'post',
                    data: {
                        'comment_group_name': $('#comment_group_name').val(),
                        'comments': $('#comments').val(),
//                        'comments': allComments,
                        'comment_group_id': comment_group_id,
                    },
                    success: function (res) {
                        if (res['status'] == 200) {
                            toastr.success(res.message);
                            $('#datatable_ajax').DataTable().ajax.reload();
                            $('#editUserModal').modal('hide');
                        } else if (res['status'] == 201) {
                            toastr.warning(res.message, {timeOut: 2000});
                        } else
                            toastr.error(res.message, {timeOut: 2000});
                    }

                });
            });


            $(document).on('click', '#edit_cancelButton', function () {
                $('#editUserModal').modal('hide').find("input[name=comments],input[name=comment_group_name]").val('').end();
            });


            // $('#editUserModal').on('hidden.bs.modal', function (e) {
            //     $('#datatable_ajax').DataTable().ajax.reload();
            //     $('#editUserModal').modal('hide').find("input[name=comments],input[name=comment_group_name]").val('').end();
            // });
        });
    </script>


@endsection







