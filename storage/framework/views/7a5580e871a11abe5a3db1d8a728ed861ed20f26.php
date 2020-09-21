







<?php $__env->startSection('pageheadcontent'); ?>
    <!-- add extra css required for this page only -->
<?php $__env->startSection('GIVE','active open'); ?>
<?php $__env->startSection('GIVEMU','active open'); ?>

<link rel="stylesheet" href="/GAIA/assets/datatables/css/jquery.dataTables.min.css"/>
<link rel="stylesheet" href="/GAIA/assets/datatables/css/dataTables.bootstrap.css"/>



<style>

    #editUserModal input{
        padding: 5px;
    }
    .link-width {
        max-width: 140px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
</style>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('pagecontent'); ?>
    <!-- BEGIN PAGE HEADER-->

    <h3 class="page-title" style="color: #225e8b">
        Manage Users
    </h3>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="/admin/manageUser/GIVE">Manage Users</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="/admin/manageUser/GIVE"><i class="fa fa-eye"></i>Get Instant Views English</a>
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
                        <i class="fa fa-shopping-cart"></i>User Listing
                    </div>
                    <div class="actions">

                        <div style="float: right">
                            <a href="/admin/AddingUser/GIVE">

                                <button class="btn blue pull-right" data-toggle="modal" title="adduser" title="AddUser"
                                        data-target="#addOrders" onclick="resetForm()"><i class="fa fa-plus-circle"></i>
                                    AddUser

                                </button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-container">
                        <div class="table-actions-wrapper">
									<span>
									</span>
                            <select class="table-group-action-input form-control input-inline input-small input-sm " title="select">
                                <option value="">Select...</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="delete">Delete</option>


                            </select>
                            <button class="btn btn-sm blue table-group-action-submit" title="submit"><i
                                        class="fa fa-check"></i></button>
                        </div>
                        <div class="table-container">

                            <table class="table table-responsive table-striped table-bordered table-hover"
                                   id="datatable_ajax">
                                <thead>
                                <tr role="row" class="heading">
                                    <th width="5%"><input type="checkbox" id="groupCheckbox"></th>

                                    <th width="10%">
                                        ID
                                    </th>
                                    <th width="20%">
                                        Username
                                    </th>
                                    <th width="15%">
                                        Email
                                    </th>
                                    <th width="20%">
                                        Created
                                    </th>

                                    <th width="15%">
                                        Status
                                    </th>

                                    <th width="15%">
                                        Actions
                                    </th>

                                </tr>
                                <tr role="row" class="filter">
                                    <td>

                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-filter input-sm" name="search_id" title="search_id">
                                    </td>

                                    <td>
                                        <input type="text" class="form-control form-filter input-sm" title="search_username"
                                               name="search_username">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-filter input-sm" title="search_email"
                                               name="search_email">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-filter input-sm" title="search_created_at" disabled
                                               name="search_created_at">
                                    </td>
                                    <td>
                                        <select name="search_status" class="form-control form-filter input-sm" title="search_status">
                                            <option value="">select...</option>
                                            <option value="0">Pending</option>
                                            <option value="1">Active</option>
                                            <option value="2">Inactive</option>
                                        </select>
                                    </td>

                                    <td>
                                        <div class="margin-bottom-5">
                                            <button class="btn btn-xs yellow filter-submit margin-bottom" title="search"><i
                                                        class="fa fa-search"></i>
                                            </button>
                                            <button class="btn btn-xs red filter-cancel" title="refresh"><i class="fa fa-refresh"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-filter input-sm"
                                               name="method" value="GIVE" style="display: none;">

                                    </td>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- End: life time stats -->


        <div id="showDetails" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" style="margin: 5% 18%;">
                <div class="modal-content">
                    <div class="modal-header"
                         style="background: #4b95ab; color: #fff;text-align: center;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">More Users Details</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-md-12">
                                <table class="table table-responsive table-hover" id="viewTable">
                                    <tbody>
                                    <tr>
                                        <td colspan="2">
                                            <label> <b>Username : </b></label>&nbsp; <span
                                                    id="username"></span>
                                        </td>
                                    <tr>
                                        <td colspan="2">
                                            <label> <b>Registered Through : </b></label>&nbsp; <span
                                                    id="registered_through"></span>
                                        </td>

                                    <tr>
                                        <td colspan="2">
                                            <label><b>Email : </b></label>&nbsp; <span id="email"></span>

                                        </td>
                                    </tr>


                                    <tr>
                                        <td colspan="2">
                                            <label><b>Status : </b></label>&nbsp; <span id="status"></span>
                                        </td>

                                    </tr>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


        
        
        <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">

                        <div class="modal-header"
                             style="background: linear-gradient(-45deg, #095166, #095166); color: #fff;">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Edit Users</h4>
                        </div>


                    </div>
                    <div class="modal-body" style="min-height: 260px;">
                        <div role="tabpanel">
                            
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#uploadTab"  id="updateEditProfile"aria-controls="uploadTab"
                                                                          role="tab" data-toggle="tab"

                                                                          style="color: #030307">Update Profile</a>

                                </li>
                                <li role="presentation"><a href="#browseTab"   id="ResetPassword"aria-controls="browseTab" role="tab"

                                                           data-toggle="tab" style="color: #030307">Reset Password</a>

                                </li>
                            </ul>
                            
                            <div class="tab-content">
                                <!-- Update Profile -->
                                <div role="tabpanel" class="tab-pane active" id="uploadTab">


                                    <tr>
                                        <td colspan="2">
                                            User Name:
                                        </td>
                                        <td colspan="2">
                                            <strong><input type="text" class="form-control" name="username"
                                                           id="usernameId" placeholder="User Name"
                                                           required/> </strong>
                                            <div class="error" style="color:red"><?php echo e($errors->first('username')); ?></div>


                                        </td>
                                    </tr>
                                    <br>
                                    <tr>
                                        <td colspan="2">
                                            Email:
                                        </td>
                                        <td colspan="2">

                                            <strong><input type="email" name="Email" autocomplete="off"
                                                           id="emailId" placeholder="Email" required
                                                           class="form-control"/></strong>
                                            <div class="error" style="color:red"><?php echo e($errors->first('Email')); ?></div>


                                        </td>
                                    </tr>
                                    <div class="col-md-12">
                                        <div class="pull-right" style="display: inline-flex;margin-top:15px;">
                                            <button type="button" class="btn btn-warning  Closebutton" title="close" data-dismiss="modal">
                                                Close
                                            </button>
                                            <button type="button" class="btn btn-success updateGeneralInfo" title="save" value="Validate">
                                                <span>Save Changes </span>
                                            </button>
                                        </div>

                                    </div>
                                </div>

                                <!-- Update Password -->
                                <div role="tabpanel" class="tab-pane" id="browseTab">
                                    <div class="form-group">
                                        <label class="">New Password</label>

                                        <div class="input-group">
                                            <div class="input-group-addon"><span class="fa fa-lock"></span>
                                            </div>
                                            <input type="password" class="form-control" id="newPassword" required
                                                   name="newpassword" placeholder="New Password"
                                                   value=""/>
                                        </div>
                                        <span style="color: red" id="newPasswordError"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="">Confirm NewPassword</label>

                                        <div class="input-group">
                                            <div class="input-group-addon"><span
                                                        class="fa fa-unlock-alt"></span>
                                            </div>
                                            <input type="password" class="form-control"
                                                   id="confirm_password"
                                                   name="confirm_password" required
                                                   placeholder="Confirm New Password" value=""/>
                                        </div>
                                        <span style="color: red" id="conformNewPasswordError"></span>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="pull-right" style="display: inline-flex;">
                                            <button type="button" class="btn btn-warning  Closebutton" title="close" data-dismiss="modal">
                                                Close
                                            </button>
                                            <button type="button" class="btn btn-success  passwordSave" title="save" value="Validate" >
                                                <span>Save Changes</span>
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT-->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pagescripts'); ?>
    <!-- add extra js for this page only -->

 <script>
        jQuery(document).ready(function () {
            TableAjax.init();
        });
    </script>



    <script type="text/javascript">
        $(document).ready(function () {
            toastr.options.positionClass = 'toast-top-center';
            toastr.options.progressBar = true;
            toastr.options.preventDuplicates = true;
            toastr.options.closeButton = true;
            grid.setAjaxParam("method", "GIVE");

            $('input[type="search"]').css({'height': '5px'});

        });

        var grid;
        var TableAjax = function () {

            var handleRecords = function () {

                 grid = new Datatable();

                grid.init({
                    src: $("#datatable_ajax"),
                    onSuccess: function (grid, response) {
                        // grid:        grid object
                        // response:    json object of server side ajax response
                        // execute some code after table records loaded
                    },
                    onError: function (grid) {
                        // execute some code on network or other general error
                    },
                    onDataLoad: function (grid) {
                        // execute some code on ajax data load
                    },
                    loadingMessage: 'Loading...',
                    dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options

                        // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                        // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js).
                        // So when dropdowns used the scrollable div should be removed.
                        //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",

                        "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

                        "lengthMenu": [
                            [10, 20, 50, 100, 150, -1],
                            [10, 20, 50, 100, 150, "All"] // change per page values here
                        ],
                        "pageLength": 10, // default record count per page
                        "ajax": {
                            "url": "/admin/manageAjaxHandler" // ajax source
                        },
                        "order": [
                            [1, "asc"]
                        ]// set first column as a default sort by asc
                    }
                });

                grid.setAjaxParam("method", "GIVE");
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
                // handle group actionsubmit button click
                grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
                    e.preventDefault();
                    var action = $(".table-group-action-input", grid.getTableWrapper());
                    if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                        grid.setAjaxParam("customActionType", "group_action");
                        grid.setAjaxParam("customActionName", action.val());
                        grid.setAjaxParam("id", grid.getSelectedRows());
                        grid.setAjaxParam("method", "GIVE");
                        grid.getDataTable().ajax.reload();
                        grid.clearAjaxParams();
                        $('#groupCheckbox').parent().removeClass('checked');

                    } else if (action.val() == "") {
                        Metronic.alert({
                            type: 'danger',
                            icon: 'warning',
                            message: 'Please select an action',
                            container: grid.getTableWrapper(),
                            place: 'prepend'
                        });
                    } else if (grid.getSelectedRowsCount() === 0) {
                        Metronic.alert({
                            type: 'danger',
                            icon: 'warning',
                            message: 'No record selected',
                            container: grid.getTableWrapper(),
                            place: 'prepend'
                        });
                    }
                });
            }

            return {

                init: function () {

//                    initPickers();
                    handleRecords();
                }

            };


        }();


        $(document).on('click','.filter-cancel',function () {
            grid.setAjaxParam("method", "GIVE");
            $('#datatable_ajax').DataTable().ajax.reload();

        })


$(document).ready(function () {


    function validateEmail(email) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

        return re.test(email);
    }
    function validateUsername(username) {
        // var nameRegex = /^[a-zA-Z0-9]+$/;
        // var nameRegex = /^[a-zA-Z0-9_]+$/;
        var nameRegex = /^[A-Za-z_-][A-Za-z0-9_-]*$/;



        return nameRegex.test(username);
    }


// ChangeStatus Action  fuctionality in javascript ****************************

        $(document.body).on('click', '.changeStatus', function () {
            console.log("button status is clicked");
            var data = $(this);

            var ButtonStatus = data.hasClass('label-success')?'2':'1';
            var remz = confirm('Are you sure to changeStatus ');
            if (remz) {

                $.ajax({
                    url: '/admin/satusChange',
                    dataType: 'json',
                    type: 'post',
                    data: {id: $(this).attr('data-Id'), status: ButtonStatus},
                    success: function (response) {
                        console.log(response);
                        if (response['status'] == 200) {

                            if (data.hasClass('label-warning'))
                                data.removeClass('label-warning');

                            if (ButtonStatus == 2) {
                                data.removeClass('label-success');
                                data.addClass('label-danger');
                                data.text('Inactive');
                            } else {
                                data.removeClass('label-danger');
                                data.addClass('label-success');
                                data.text('Active');
                            }
                            toastr.success(response.message);

                        } else {



                        }
                    }
                });
            }
        });

    var id;
    $(document.body).on('click', '#deleteCommnet', function () {
        var obj = $(this);
        var id = $(this).attr('data-id');
        console.log(id);
        var remz = confirm('Are you sure want to delete ?');
        if (remz) {
            $.ajax({
                url: '/admin/DeleteAjaxHandeler',
                type: 'post',
                datatype: 'json',
                data: {
                    id: id
                },
                success: function (response) {
                    response = $.parseJSON(response);
                    if (response['status'] == '200') {
                        obj.parent().parent().parent().remove();
                        toastr.success(response.message);

                    }
                    else {
                        console.log(response.message);
                    }
                }
            });
        }
    });
        // js for groubox functionality  ...
        $('#groupCheckbox').click(function () {
            if (this.checked) {
                console.log("grp checkbox is already checked");
                $('.orderCheckBox').each(function () {
                    this.checked = true;
                    $(this).parent().addClass('checked');

                });
            } else {
                console.log("not checked");
                $('.orderCheckBox').each(function () {
                    this.checked = false;
                    $(this).parent().removeClass('checked');
                });
            }

        });

        // js for extra details functionality ...
        var userId;
        $(document.body).on('click', '.show-details', function (e) {
            e.preventDefault();
            userId = $(this).attr('data-id');

            $.ajax({
                url: '/admin/getMoreUsersDetails',
                dataType: 'json',
                type: 'post',
                data: {
                    'registered_through': $('#registered_through').val(),
                    'rated_app': $('#rated_app').val(),
                    'device_type': $('#device_type ').val(),
                    'userId': userId,
                },
                success: function (res) {
                    console.log(res);
                    if (res['status'] == 200) {

                        $('#registered_through').text(res.userDetails.registered_through);
                        $('#email').text(res.userDetails.email);
                        $('#username').text(res.userDetails.username);
                        $('#status').text(res.userDetails.status);
                    } else {
                        toastr.error(res.msg, {timeOut: 4000});
                    }
                }

            });
        });
        // js for  edit users functionality
        var userId;

        $(document).on('click', '.editUserdetails', function () {
            console.log(' data Continue --------------------=======================', $(this).attr('data-id'));
            userId = $(this).attr('data-id');
            var email = document.getElementById('emailId').value;
            var username = document.getElementById('usernameId').value;

            $.ajax({
                url: '/admin/getEditUser',
                dataType: 'json',
                type: 'post',
                data: {userId: userId},

                success: function (res) {

                    console.log(res);
                    var userDetails = res.data;
                    if (res['status'] == 200) {
                        $('#usernameId').val(userDetails.username);
                        $('#emailId').val(userDetails.email);


                    } else {
                           toastr.error(res.msg, {timeOut: 4000});
                    }
                }

            });
        });
        //js for  update functionality ...
//
    var userId;
    $(document).on('click', '.updateGeneralInfo', function () {
        // if ($('#newPassword').val() == $('#confirm_password').val()) {
        // } else {
        //     toastr.error("New password and confirm password didn't match.", {timeOut: 2000});
        //     return false;
        // }

        var validated = validateEmail($('#emailId').val());
        if (!validated) {
            toastr.error("Entered email is not valid email.");
            return false;
        }
        var validateduser = validateUsername($('#usernameId').val());
        if (!validateduser) {
            toastr.error("Entered Valid user name");
            return false;
        }

        $.ajax({
            url: '/admin/getUpdateAjax',
            dataType: 'json',
            type: 'post',
            data: {
                'username': $('#usernameId').val(),
                'email': $('#emailId').val(),
                'registered_through':3,

                // 'password': $('#newPassword').val(),
                //'confirm_password': $('#confirm_password').val(),
//                    'Conforpassword': $('#conformNewPassword').val(),
                'userId': userId,
            },
            success: function (res) {
                console.log(res);
                if (res['status'] == 200) {
                    grid.setAjaxParam("method", "GIVE");
                    $('#datatable_ajax').DataTable().ajax.reload();
                    $('#editUserModal').modal('hide');
                    toastr.success(res.message);

                    // .find("input[name=newpassword],input[name=confirm_password]").val('').end();

                } else if (res['status'] == 201) {

                    toastr.warning(res.message, {timeOut: 2000});
                } else
                    toastr.error(res.message, {timeOut: 2000});

            }

        });

    });
    $(document).on('click', '.passwordSave', function () {
        if ($('#newPassword').val() == $('#confirm_password').val()) {
        } else {
            toastr.error("New password and confirm password didn't match.", {timeOut: 2000});
            return false;
        }
        $.ajax({
            url: '/admin/getUpdatePasswordAjaxHandler',
            dataType: 'json',
            type: 'post',
            data: {
                'password': $('#newPassword').val(),
                'userId': userId,
            },
            success: function (res) {
                console.log(res);
                if (res['status'] == 200) {
                    grid.setAjaxParam("method", "GIVE");
                    $('#datatable_ajax').DataTable().ajax.reload();
                    $('#editUserModal').modal('hide');
                    toastr.success(res.message);
                    // .find("input[name=newpassword],input[name=confirm_password]").val('').end();

                } else if (res['status'] == 201) {

                    toastr.warning(res.message, {timeOut: 2000});
                } else
                    toastr.error(res.message, {timeOut: 2000});

            }

        });

    });


    $(document).on('click', '.Closebutton', function () {
        $('#editUserModal').modal('hide').find("input[name=newpassword],input[name=confirm_password]").val('').end();

    });



    $('#editUserModal').on('hidden.bs.modal', function (e) {
        // $('#min_quantity').val('');
        $('#editUserModal').modal('hide').find("input[name=newpassword],input[name=confirm_password]").val('').end();
        // $('#AddNewPlan').find("sinput[name=plan_name],input[name=plan_name_code],input[name=supplier_server_Id],input[name=min_quantity],input[name=max_quantity],input[name=buying_price],input[name=selling_price]").val('')
    });


});

        $('#updateEditProfile').click(function () {
            $('.passwordSave').css('display', 'none');
            $('.updateGeneralInfo').css('display', 'block');
        });

        $('#ResetPassword').click(function () {
            $('.updateGeneralInfo').css('display', 'none');
            $('.passwordSave').css('display', 'block');
        });

        $("#editUserModal").on('shown.bs.modal', function (e) {
            // $('.passwordSave').css('display', 'none');
            $('.updateGeneralInfo').css('display', 'block');
        });

    </script>

<?php $__env->stopSection(); ?>





<?php echo $__env->make('Admin::Layouts.adminlayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>