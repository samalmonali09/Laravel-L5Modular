











<?php $__env->startSection('Plan2','active open'); ?>

<?php $__env->startSection('pageheadcontent'); ?>
    <!-- add extra css required for this page only -->

    <link rel="stylesheet" href="/GAIA/assets/datatables/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="/GAIA/assets/datatables/css/dataTables.bootstrap.css"/>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('pagecontent'); ?>
    <!-- BEGIN PAGE HEADER-->

    <h3 class="page-title" style="color: #0d3625">
        Manage Plans
    </h3>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                
            </li>

            <li>
                <i class="fa fa-home"></i>
                <a href="/admin/PlanDatatable">Manage Plan</a>
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
                        <i class="fa fa-shopping-cart"></i>Plan Listing
                    </div>
                    <div class="actions">

                        <div style="float: right">

                            <a href="/admin/AddPlan">

                                <button class="btn blue-chambray pull-right" data-toggle="modal" title="AddPlan"
                                        data-target="#addOrders" onclick="resetForm()"><i class="fa fa-plus-circle"></i>
                                    AddPlan

                                </button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-container">
                        <table class="table table-responsive table-striped table-bordered table-hover"
                               id="datatable_ajax">
                            <thead>
                            <tr role="row" class="heading">
                                
                                <th width=5%" style="color: #020d10">
                                    plan_id
                                </th>
                                <th width="10%" style="color: #020c0f">
                                    SupplierServerId
                                </th>
                                <th width="10%" style="color: #020c0f">
                                    PlanName
                                </th>
                                <th width="10%" style="color: #010b0d">
                                    MinQuantity
                                </th>
                                <th width="10%" style="color: #010b0d">
                                    MaxQuantity
                                </th>
                                <th width="10%" style="color: #010b0d">
                                    BuyingPrice
                                </th>
                                <th width="10%" style="color: #010b0d">
                                    SellingPrice
                                </th>
                                <th width="10%" style="color: #010b0d">
                                    PlanType
                                </th>
                                <th width="10%" style="color: #010b0d">
                                    Status
                                </th>
                                <th width="15%" style="color: #010b0d">
                                    Action
                                </th>
                            <tr role="row" class="filter">
                                
                                
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" title="search_plan_id"
                                           name="search_plan_id">
                                </td>
                                <td>
                                    <select name="search_supplier_server_Id" class="form-control form-filter input-sm"
                                            title="search_supplier_server_Id">
                                        <option value="">select...</option>
                                        <option value="1">igerslike</option>
                                        <option value="2">cheapbulksocial</option>
                                        <option value="3">socialpanel24</option>
                                        <option value="4">socialnator</option>
                                        <option value="5">followiz</option>
                                        <option value="6">top4smm</option>
                                        <option value="7">KAMH</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm"
                                           title="search_plan_name"
                                           name="search_plan_name">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm"
                                           title="search_min_quantity"
                                           name="search_min_quantity">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm"
                                           title="search_max_quantity"
                                           name="search_max_quantity">
                                </td>
                                <td>
                                    <div class="margin-bottom-5">
                                        <input type="text" class="form-control form-filter input-sm"
                                               title="search_buying_price_from"
                                               name="search_buying_price_from" placeholder="From"/>
                                    </div>
                                    <input type="text" class="form-control form-filter input-sm"
                                           title="search_buying_price_to"
                                           name="search_buying_price_to" placeholder="To"/>
                                </td>

                                <td>
                                    <div class="margin-bottom-5">
                                        <input type="text" class="form-control form-filter input-sm"
                                               title="search_selling_price_from"
                                               name="search_selling_price_from" placeholder="From"/>
                                    </div>
                                    <input type="text" class="form-control form-filter input-sm"
                                           title="search_selling_price_to"
                                           name="search_selling_price_to" placeholder="To"/>
                                </td>

                                <td>
                                    <select name="search_plan_type" class="form-control form-filter input-sm"
                                            title="search_plan_type">
                                        <option value="">select...</option>
                                        <option value="0">Instagram Likes</option>
                                        <option value="1">Instagram Followers</option>
                                        <option value="2">Instagram Random Comments</option>
                                        <option value="3"> Custom Comments</option>
                                        <option value="4">Instagram Views</option>
                                        <option value="5">story views</option>
                                        <option value="6"> live video views</option>
                                        <option value="7"> Impressions</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="search_status" class="form-control form-filter input-sm"
                                            title="search_status">
                                        <option value="">select...</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </td>

                                <td>
                                    <div class="margin-bottom-5">
                                        <button class="btn btn-xs blue filter-submit margin-bottom" title="search"><i
                                                    class="fa fa-search"></i>
                                        </button>
                                        <button class="btn btn-xs red filter-cancel" title="refresh"><i
                                                    class="fa fa-refresh"></i>
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


    <div id="showDetails" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" style="margin: 5% 18%;">
            <div class="modal-content">
                <div class="modal-header"
                     style="background: rgba(10,64,99,1); color: #fff;text-align: center;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">More Plan Details</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-2" id="avatar">
                        </div>
                        <div class="col-md-12">
                            <table class="table table-responsive table-hover" id="viewTable">
                                <tbody>
                                <tr>
                                    <td colspan="2">
                                        <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Supplier
                                                Server Id : </b></label>&nbsp; <span
                                                id="supplier_server_Id_Plan"></span>
                                    </td>

                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <b>PlanName Code (server api type) : </b></label>&nbsp; <span
                                                id="plan_name_code_plan"></span>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="2">
                                        <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <b>Plan Name : </b></label>&nbsp; <span id="plan_name_plan"></span>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="2">
                                        <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <b>Plan Type : </b></label>&nbsp; <span id="plan_type_plan"></span>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="2">
                                        <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <b>Min Quantity : </b></label>&nbsp; <span
                                                id="min_quantity_plan"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <b>Max Quantity : </b></label>&nbsp; <span
                                                id="max_quantity_plan"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Status
                                                : </b></label>&nbsp; <span id="status_plan"></span>
                                    </td>

                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Buying
                                                Price : </b></label>&nbsp;&nbsp;<i class="fa fa-dollar"></i> <span
                                                id="buying_price_plan"></span>
                                    </td>

                                </tr>

                                <tr>
                                    <td colspan="2">
                                        <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Selling
                                                Price : </b></label>&nbsp;&nbsp;<i class="fa fa-dollar"></i> <span
                                                id="selling_price_plan"></span>
                                    </td>

                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" title="close">Back To Plan
                    </button>
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
                    <h4 class="modal-title">Edit Plans</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-11">
                            <form id="editProfileForm">
                                <table class="table table-responsive table-hover" id="viewTable">
                                    <tbody>
                                    <tr>
                                        <td colspan="2">
                                            Plan Name:
                                        </td>
                                        <td colspan="2">
                                            <strong><input type="text" class="form-control" name="plan_name"
                                                           id="plan_name_demo" placeholder="plan_name"/></strong>
                                            <div class="error" style="color:red"><?php echo e($errors->first('plan_name')); ?></div>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="2">
                                            Plan Name Code
                                        </td>
                                        <td colspan="2">
                                            <strong><input type="text" class="form-control" name="plan_name_code"
                                                           id="plan_name_code" placeholder="plan_name_code"/></strong>
                                            <div class="error" style="color:red"><?php echo e($errors->first('plan_name_code')); ?></div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            Min Quantity:
                                        </td>
                                        <td colspan="2">
                                            <strong><input type="text" class="form-control" name="min_quantity"
                                                           id="min_quantity_demo" placeholder="min_quantity"/> </strong>
                                            <div class="error"
                                                 style="color:red"><?php echo e($errors->first('min_quantity')); ?></div>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="2">
                                            Max Quantity:
                                        </td>
                                        <td colspan="2">
                                            <strong><input type="text" class="form-control" name="max_quantity"
                                                           id="max_quantity_demo" placeholder="max_quantity"/> </strong>
                                            <div class="error"
                                                 style="color:red"><?php echo e($errors->first('max_quantity')); ?></div>

                                        </td>

                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            Buying Price <i class="fa fa-dollar"></i>:
                                        </td>
                                        <td colspan="2">
                                            <strong><input type="text" class="form-control"
                                                           name="buying_price"
                                                           id="buying_price_demo" placeholder=""/></strong>
                                            <div class="error"
                                                 style="color:red"><?php echo e($errors->first('buying_price')); ?></div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            Selling Price <i class="fa fa-dollar"></i>:
                                        </td>
                                        <td colspan="2">
                                            <strong><input type="text" class="form-control"
                                                           name="selling_price"
                                                           id="selling_price_demo" placeholder=""/></strong>
                                            <div class="error"
                                                 style="color:red"><?php echo e($errors->first('selling_price')); ?></div>


                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            Plan Type:
                                        </td>
                                        <td colspan="2">
                                            <strong> <select class="form-control col-md-3" name="plan_type"
                                                             id="plan_type_demo">
                                                    <option value="0">Instagram Likes</option>
                                                    <option value="1">Instagram Followers</option>
                                                    <option value="2">Instagram Random Comments</option>
                                                    <option value="3">Instagram Custom Comment</option>
                                                    <option value="4">Instagram Views</option>
                                                    <option value="5">story views</option>
                                                    <option value="6">live video views</option>
                                                    <option value="7">Impressions</option>
                                                </select></strong>
                                            <div class="error" style="color:red"><?php echo e($errors->first('plan_type')); ?></div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            Supplier Server Id:
                                        </td>
                                        <td colspan="2">
                                            <strong> <select class="form-control col-md-3" name="supplier_server_Id"
                                                             id="supplier_server_Id_demo">
                                                    <option value="1">igerslike</option>
                                                    <option value="2">cheapbulksocial</option>
                                                    <option value="3">socialpanel24</option>
                                                    <option value="4">socialnator</option>
                                                    <option value="5">followiz</option>
                                                    <option value="6">top4smm</option>
                                                    <option value="7">KAMH</option>
                                                </select></strong>
                                            <div class="error"
                                                 style="color:red"><?php echo e($errors->first('supplier_server_Id')); ?></div>

                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="background: linear-gradient(-45deg, #095166, #5e8050); color: #fff;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success  updateGeneralInfo" title="save">
                        <span>Save Changes </span>
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>


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
            toastr.options.icon = true;
            $('input[type="search"]').css({'height': '5px'});

        });
        var grid;
        var TableAjax = function () {

            var handleRecords = function (e) {

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
                            "url": "/admin/PlanAjaxHandeler" // ajax source
                        },
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
                        grid.setAjaxParam("plan_id", grid.getSelectedRows());
                        grid.getDataTable().ajax.reload();
                        grid.clearAjaxParams();
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
                    handleRecords();
                }

            };
        }();
        //To Disable Warning Yajara DataTables

        //        $.fn.dataTable.ext.errMode = 'none';
        //
        //        $('#table').on('error.dt', function (e, settings, techNote, message) {
        //            console.log('An error has been reported by DataTables: ', message);
        //        });


        $(document.body).on('click', '.changeStatus', function () {
            var obj = $(this);

            var ButtonStatus = obj.hasClass('label-success') ? '0' : '1';
            console.log("button status is clicked");
            var remz = confirm('Are you sure to changeStatus ');
            if (remz) {
                $.ajax({
                    url: '/admin/satusChangePlan',
                    dataType: 'json',
                    type: 'post',
                    data: {plan_id: $(this).attr('data-Id'), status: ButtonStatus},
                    success: function (response) {
                        console.log(response);
                        if (response['status'] == 200) {
                            if (ButtonStatus == 0) {
                                obj.removeClass('label-success');
                                obj.addClass('label-danger');
                                obj.text('Inactive');
                            } else {
                                obj.removeClass('label-danger');
                                obj.addClass('label-success');
                                obj.text('Active');
                            }
                            toastr.success(response.message);

                        } else {
                        }
                    }
                });
            }
        });


        $(document.body).on('click', '#deleteCommnet', function () {
            var obj = $(this);
            var plan_id = $(this).attr('data-id');
            console.log(plan_id);
            var remz = confirm('Are you sure want to delete ?');
            if (remz) {
                $.ajax({
                    url: '/admin/deleteAjaxHandler',
                    type: 'post',
                    datatype: 'json',
                    data: {
                        plan_id: plan_id
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
            plan_id = $(this).attr('data-id');
            console.log('++++++++++++++');
            $.ajax({
                url: '/admin/getMorePlanDetails',
                dataType: 'json',
                type: 'post',
                data: {
                    'plan_id': plan_id,
                },
                success: function (res) {
                    console.log(res);
                    if (res['status'] == 200) {
                        $('#supplier_server_Id_Plan').text(res.userDetails.supplier_server_Id);
                        $('#plan_name_code_plan').text(res.userDetails.plan_name_code);
                        $('#plan_name_plan').text(res.userDetails.plan_name);
                        $('#plan_type_plan').text(res.userDetails.plan_type);
                        $('#min_quantity_plan').text(res.userDetails.min_quantity);
                        $('#max_quantity_plan').text(res.userDetails.max_quantity);
                        $('#buying_price_plan').text(res.userDetails.buying_price);
                        $('#selling_price_plan').text(res.userDetails.selling_price);
                        $('#status_plan').text(res.userDetails.status);
                    } else {
                        toastr.Success(res.msg, {timeOut: 4000});
                    }
                }
            });
        });


        var plan_id;
        $(document).on('click', '.editUserdetails', function () {
            console.log(' data Continue --------------------=======================', $(this).attr('data-id'));
            plan_id = $(this).attr('data-id');
            $.ajax({
                url: '/admin/EditAjaxHandlerPlan',
                dataType: 'json',
                type: 'post',
                data: {plan_id: plan_id},
                success: function (res) {
                    console.log(res);
                    var userDetails = res.data;
                    if (res['status'] == 200) {
                        $('#plan_name_demo').val(userDetails.plan_name);
                        $('#plan_name_code').val(userDetails.plan_name_code);
                        $('#plan_type_demo').val(userDetails.plan_type);
                        $('#supplier_server_Id_demo').val(userDetails.supplier_server_Id);
                        $('#min_quantity_demo').val(userDetails.min_quantity);
                        $('#max_quantity_demo').val(userDetails.max_quantity);
                        $('#buying_price_demo').val(userDetails.buying_price);
                        $('#selling_price_demo').val(userDetails.selling_price);
                    } else {
                        toastr.error(res.msg, {timeOut: 4000});
                    }
                }
            });
        });


        var plan_id;
        $(document).on('click', '.updateGeneralInfo', function () {
            $.ajax({
                url: '/admin/UpdateAjaxHandeler',
                dataType: 'json',
                type: 'post',
                data: {
                    'plan_name': $('#plan_name_demo').val(),
                    'plan_name_code': $('#plan_name_code').val(),
                    'plan_type': $('#plan_type_demo').val(),
                    'supplier_server_Id': $('#supplier_server_Id_demo').val(),
                    'min_quantity': $('#min_quantity_demo').val(),
                    'max_quantity': $('#max_quantity_demo').val(),
                    'buying_price': $('#buying_price_demo').val(),
                    'selling_price': $('#selling_price_demo').val(),
                    'plan_id': plan_id,
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
        $(document).reday(function () {
            $('.filter-cancel').on('click', function () {
                $('#datatable_ajax').DataTable().ajax.reload();
            })


        })

        $('#editUserModal').on('hidden.bs.modal', function (e) {
            $('#editUserModal').modal('hide').find("input[name=plan_name],input[name=plan_type],input[name=plan_name_code],input[name=supplier_server_Id],input[name=min_quantity],input[name=max_quantity],input[name=buying_price],input[name=selling_price]").val('').end();
        });

        // $('#groupCheckbox').click(function () {
        //     if (this.checked) {
        //         console.log("grp checkbox is already checked");
        //         $('.orderCheckBox').each(function () {
        //             this.checked = true;
        //             $(this).parent().addClass('checked');
        //         });
        //     } else {
        //         console.log("not checked");
        //         $('.orderCheckBox').each(function () {
        //             this.checked = false;
        //             $(this).parent().removeClass('checked');
        //         });
        //     }
        //
        // });


    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin::Layouts.adminlayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>