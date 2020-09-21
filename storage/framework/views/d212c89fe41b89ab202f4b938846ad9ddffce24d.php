








<?php $__env->startSection('AUTOIG','active open'); ?>
<?php $__env->startSection('SPOFILE','active open'); ?>

<?php $__env->startSection('pageheadcontent'); ?>
    <!-- add extra css required for this page only -->

    <link rel="stylesheet" href="/GAIA/assets/datatables/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="/GAIA/assets/datatables/css/dataTables.bootstrap.css"/>
    <style>
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

    <h3 class="page-title" style="color: #0d3625">
        Autolike Profile
    </h3>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="/admin/ProfileDatatTable">AUTOIG</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="/admin/ProfileDatatTable">AutoLikes Profile</a>
            </li>
        </ul>
    </div>
    <!-- END PAGE HEADER-->
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
                        <i class="fa fa-instagram"></i>Auttolikes Profile
                    </div>
                    <div class="actions">
                        <div style="float: right">
                            
                            
                            
                            
                            
                            
                        </div>
                    </div>
                </div>
                <div class="portlet-body">

                    <div class="table-container">
                        <div class="portlet-body">
                            <div class="table-actions-wrapper btn btn-sm default" >
									<span>
									</span>

                                <select class="table-group-action-input form-control input-inline input-small input-sm" title="select">
                                    <option value="">Select...</option>
                                    <option value="cancel_order">Cancel</option>
                                    <option value="paused_order">Paused</option>
                                    <option value="Restart">Restart</option>
                                    <option value="Reset_TotalCounter">Reset Total Counter</option>
                                    <option value="Reset_DailyCounter">Reset Daily Counter</option>
                                    <option value="Remove">Remove</option>
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
                                        <th width=5%" style="color: #020d10">
                                            id
                                        </th>
                                        <th width="10%" style="color: #020c0f">
                                            Insta Username
                                        </th>
                                        <th width="10%" style="color: #020c0f">
                                            Profile Image
                                        </th>
                                        <th width="10%" style="color: #010b0d">
                                            Quantity
                                        </th>
                                        <th width="10%" style="color: #010b0d">
                                            Post
                                        </th>
                                        <th width="10%" style="color: #010b0d">
                                            Daily Post
                                        </th>
                                        <th width="10%" style="color: #010b0d">
                                            Start Date
                                        </th>
                                        <th width="10%" style="color: #010b0d">
                                            LastCheck
                                        </th>
                                        <th width="10%" style="color: #010b0d">
                                            Status
                                        </th>
                                        <th width="10%" style="color: #010b0d">
                                            Action
                                        </th>
                                    <tr role="row" class="filter">

                                        <td>

                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-filter input-sm" title="search_autolikes_id"
                                                   name="search_autolikes_id">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-filter input-sm" title="search_sub_insta_username"
                                                   name="search_sub_insta_username">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-filter input-sm" title="search_profile_image"
                                                   name="search_profile_image">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-filter input-sm" title="search_quantity"
                                                   name="search_quantity">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-filter input-sm" title="search_post_done"
                                                   name="search_post_done" disabled>
                                        </td>

                                        <td>
                                            <input type="text" class="form-control form-filter input-sm" title="search_daily_post_done"
                                                   name="search_daily_post_done " disabled>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-filter input-sm" title="search_created_at"
                                                   name="search_created_at" disabled>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-filter input-sm" title="search_last_checked_time"
                                                   name="search_last_checked_time" disabled>
                                        </td>

                                        <td>
                                            <select name="search_status" class="form-control form-filter input-sm">
                                                <option value="">select...</option>
                                                <option value="0">pending</option>
                                                <option value="1">running</option>
                                                <option value="2">finished</option>
                                                <option value="3">cancelled</option>
                                                <option value="4">stopped</option>
                                                <option value="5">paused</option>
                                                <option value="6">suspended</option>
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
        </div>
    </div>


    <div id="editUserModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header" style="background: linear-gradient(-45deg, #095166, #095166); color: #fff;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Autolikes Profile</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-11">
                            <form id="editProfileForm">
                                <table class="table table-responsive table-hover" id="viewTable">
                                    <tbody>
                                    <tr>
                                        <td colspan="2">
                                            insta_username:
                                        </td>
                                        <td colspan="2">
                                            <strong><input type="text" class="form-control" name="insta_username"
                                                           id="insta_username" placeholder="insta_username"/> </strong>
                                            <div class="error" style="color:red"><?php echo e($errors->first('insta_username')); ?></div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            Quantity:
                                        </td>
                                        <td colspan="2">
                                            <strong><input type="text" class="form-control" name="quantity"
                                                           id="quantity1" placeholder="quantity"/> </strong>
                                            <div class="error" style="color:red"><?php echo e($errors->first('quantity')); ?></div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            Post Limit:
                                        </td>
                                        <td colspan="2">
                                            <strong><input type="text" class="form-control" name="post_limit"
                                                           id="post_limit1" placeholder="post_limit"
                                                /> </strong>
                                            <div class="error" style="color:red"><?php echo e($errors->first('post_limit')); ?></div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            Post Done:
                                        </td>
                                        <td colspan="2">
                                            <strong><input type="text" class="form-control" name="post_done"
                                                           id="post_done" placeholder="post_done"/> </strong>
                                            <div class="error" style="color:red"><?php echo e($errors->first('post_done')); ?></div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            Daily Post Done:
                                        </td>
                                        <td colspan="2">
                                            <strong><input type="text" class="form-control" name="daily_post_done"
                                                           id="daily_post_done" placeholder="daily_post_done"/> </strong>
                                            <div class="error" style="color:red"><?php echo e($errors->first('daily_post_done')); ?></div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            Daily Post Limit:
                                        </td>
                                        <td colspan="2">
                                            <strong><input type="text" class="form-control" name="daily_post_limit"
                                                           id="daily_post_limit" placeholder="daily_post_limit"
                                                           required/> </strong>
                                            <div class="error" style="color:red"><?php echo e($errors->first('daily_post_limit')); ?></div>

                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="background: linear-gradient(-45deg, #095166, #5e8050); color: #fff;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" title="close">Close</button>
                    <button type="button" class="btn btn-success  updateGeneralInfo" title="save"><span>Save Changes </span>
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>







    

    <div id="showDetails" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" style="margin: 5% 18%;">
            <div class="modal-content">
                <div class="modal-header"
                     style="background: #1e4f66; color: #fff;text-align: center;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">More Autolikes Details</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-2">
                            <img id="avatar" src="/images/avatar.png" class="img-circle"/>
                        </div>
                        <div class="col-md-10">
                            <table class="table table-responsive table-hover" id="viewTable">
                                <tbody>
                                <tr>

                                <tr>
                                    <td colspan="2">
                                        <label> <b>Sub PackageName: </b></label>&nbsp; <span
                                                id="sub_package_name"></span>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="2">
                                        <label> <b>Quantity: </b></label>&nbsp; <span
                                                id="quantity"></span>
                                    </td>
                                <tr>
                                </tr>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <label> <b>Paypal Profile id:</b>&nbsp;<i class="fa fa-dollar"></i></label>&nbsp; <span
                                                id="paypal_profile_id"></span>
                                    </td>
                                </tr>

                                
                                    
                                        
                                                

                                    
                                

                                <tr>
                                    <td colspan="2">
                                        <label> <b>Email: </b><i class="fa fa-envelope"></i></label>&nbsp; <span
                                                id="email"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <label> <b>Username: </b><i class="fa fa-user"></i></label>&nbsp; <span
                                                id="username"></span>
                                    </td>
                                </tr>
                                <tr>
                                <tr>
                                    
                                    
                                    
                                    
                                </tr>

                                <tr>
                                    <td colspan="2">
                                        <label><b>Post :</b></label>&nbsp; <span
                                                id="post_done1"></span>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <label><b>Post Limit :</b></label>&nbsp; <span
                                                id="post_limitdata"></span>
                                </tr>

                                <tr>
                                    <td colspan="2">
                                        <label><b>Message :</b></label>&nbsp; <span
                                                id="message"></span>
                                </tr>
                                </td>

                                
                                
                                
                                
                                



                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                


                                
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

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

    
    
    
    

    
    
    
    
    
    
    
    
    
    
    
    
    
    

    <!-- END PAGE CONTENT-->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pagescripts'); ?>
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

                        "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

                        "lengthMenu": [
                            [10, 20, 50, 100, 150, -1],
                            [10, 20, 50, 100, 150, "All"] // change per page values here
                        ],
                        "pageLength": 10, // default record count per page
                        "ajax": {
                            "url": "/admin/AutolikesAjaxHandeler" // ajax source
                        },

//                        "columns": [
//                            {
//                                "render": function (data, type, JsonResultRow, meta) {
//                                    return '<img src="Content/'+JsonResultRow.ImageAddress+'">';
//                                }
//                            }
//                        ],
                        "order": [
                            [1, "desc"]
                        ]// set first column as a default sort by asc
                    }


                });
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
                grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
                    e.preventDefault();
                    var action = $(".table-group-action-input", grid.getTableWrapper());
                    if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                        grid.setAjaxParam("customActionType", "group_action");
                        grid.setAjaxParam("customActionName", action.val());
                        grid.setAjaxParam("AutolikeId", grid.getSelectedRows());
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

        $(document).ready(function () {
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




            $(document.body).on('click', '#deleteCommnet', function () {
                var obj = $(this);
                var autolikes_id = $(this).attr('data-id');
                console.log(autolikes_id);
                var remz = confirm('Are you sure want to delete ?');
                if (remz) {
                    $.ajax({
                        url: '/admin/deleteAjaxHandlerAutolikes',
                        type: 'post',
                        datatype: 'json',
                        data: {
                            autolikes_id: autolikes_id
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


            $(document.body).on('click', '.show-details', function () {
                var autolikes_id = $(this).attr('data-id');
                console.log('++++++++++++++');
                $.ajax({
                    url: '/admin/ShowDetailsAjaxHandlerAutolike',
                    dataType: 'json',
                    type: 'post',
                    data: {
                        'sub_package_name': $('#sub_package_name').val(),
                        'paypal_profile_id': $('#paypal_profile_id').val(),
                        'quantity': $('#quantity').val(),
                        // 'insta_username': $('#insta_username1').val(),
                        'email': $('#email').val(),
                         'username': $('#username').val(),
                        'last_checked_time': $('#last_checked_time1').val(),
                        'post_done': $('#post_done1').val(),
                        'last_delivered_link': $('#last_delivered_link').val(),
                        'message': $('#message').val(),
                        'post_limit': $('#post_limitdata').val(),
                        'autolikes_id': autolikes_id,
                    },
                    success: function (res) {
                        console.log(res);

                        var trHTML = '';
                        var profile_image = res.userDetails.profile_image;

                        if (res['status'] == 200) {
                            //condition in Terenary Opertor

                            res.userDetails['profile_image'] != null ? $('#avatar').attr('src', profile_image) : res.userDetails['profile_image'] == null ? $('#avatar').attr('src', '/images/avatar.png') : '';

                            //condition in if /else
                            // if (res.userDetails['profile_image'] != null) {
                            //
                            //     $('#avatar').attr('src', profile_image);
                            // } else if (res.userDetails['profile_image'] == null) {
                            //     $('#avatar').attr('src', '/images/avatar.png');
                            // }
                            $('#paypal_profile_id').text(res.userDetails.paypal_profile_id);
                            // $('#profile_image').text(res.userDetails.profile_image);

                            $('#sub_package_name').text(res.userDetails.sub_package_name);
                            $('#quantity').text(res.userDetails.quantity);
                            // $('#insta_username1').attr('href', res.userDetails.insta_username);
                            // $('#insta_username1').text(res.userDetails.insta_username);
                            $('#email').text(res.userDetails.email);
                            $('#username').text(res.userDetails.username);
                            $('#last_checked_time1').text(res.userDetails.last_checked_time);
                            $('#last_delivered_link').text(res.userDetails.last_delivered_link);
                            $('#post_done1').text(res.userDetails.post_done);
                            $('#post_limitdata').text(res.userDetails.post_limit);
                            $('#message').text(res.userDetails.message);
                        } else {
                            toastr.Success(res.msg, {timeOut: 4000});
                        }
                    }

                });
            });




            $(document.body).on('click', '.showorderDetails', function () {
                var autolikes_id = $(this).attr('data-id');
                var order_id = $(this).attr('data-id');
                console.log('++++++++++++++');
                $.ajax({
                    url: '/admin/ViewAllAutoLikesProfile',
                    dataType: 'json',
                    type: 'post',
                    data: {
                        'order_id': order_id,
                        'autolikes_id': autolikes_id,
                    },
                    success: function (res) {
                        console.log(res);
                        if (res['status'] == 200) {
                            var order_url = '';
                            var status = '';
                            $.each(res, function (index, value) {
                                console.log('-----------------------', status);
                                order_url += '<tr><td>' + autolikes_id + '.' + '</td><td><a target="_blank" href="https://instagram.com/' + value.order_url + '">https://www.instagram.com/' + value.order_url + '</a>' + '<td>' + value.status + '</td></li>';
//
                            });
                            $('#tableorders').html('').append(order_url, status);


//                            $('#order_url').attr('href', res.userDetails.order_url);
//                            $('#order_url').text(res.userDetails.order_url);
                        } else {
                            toastr.Success(res.msg, {timeOut: 4000});
                        }
                    }

                });
            });
            var autolikes_id;
            $(document).on('click', '.editUserdetails', function () {
                console.log(' data Continue --------------------=======================', $(this).attr('data-id'));
                autolikes_id = $(this).attr('data-id');
                $.ajax({
                    url: '/admin/EditAjaxHandlerAutolike',
                    dataType: 'json',
                    type: 'post',
                    data: {autolikes_id: autolikes_id},

                    success: function (res) {

                        console.log(res);
                        var userDetails = res.data;
                        if (res['status'] == 200) {

                            $('#insta_username').val(userDetails.insta_username);
                            $('#post_limit1').val(userDetails.post_limit);
                            $('#quantity1').val(userDetails.quantity);
                            $('#post_done').val(userDetails.post_done);
                            $('#daily_post_done').val(userDetails.daily_post_done);
                            $('#daily_post_limit').val(userDetails.daily_post_limit);
                        } else {
                            toastr.error(res.msg, {timeOut: 4000});
                        }
                    }

                });
            });



            var autolikes_id;
            $(document).on('click', '.updateGeneralInfo', function () {

                $.ajax({
                    url: '/admin/UpdateAjaxHandelerAutolikes',
                    dataType: 'json',
                    type: 'post',
                    data: {
                        'insta_username': $('#insta_username').val(),
                        'post_limit': $('#post_limit1').val(),
                        'post_done': $('#post_done').val(),
                        'daily_post_done': $('#daily_post_done').val(),
                        'daily_post_limit': $('#daily_post_limit').val(),
                        'quantity': $('#quantity1').val(),
                        'autolikes_id': autolikes_id,
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


        });

    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin::Layouts.adminlayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>