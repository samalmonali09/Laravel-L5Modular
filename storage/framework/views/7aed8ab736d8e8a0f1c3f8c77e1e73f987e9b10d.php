







<?php $__env->startSection('INSTASTAT','active open'); ?>
<?php $__env->startSection('STATP','active open'); ?>

<?php $__env->startSection('pageheadcontent'); ?>
    <!-- add extra css required for this page only -->

    <link rel="stylesheet" href="/GAIA/assets/datatables/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="/GAIA/assets/datatables/css/dataTables.bootstrap.css"/>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('pagecontent'); ?>
    <!-- BEGIN PAGE HEADER-->

    <h3 class="page-title" style="color: #0d3625">
        Manage Package
    </h3>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="/admin/managePackage/INSTASTAT">INSTASTAT</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="/admin/managePackage/INSTASTAT">Manage Packages</a>
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
                        <i class="fa fa-shopping-cart"></i>Packages Listing
                    </div>
                    <div class="actions">

                        <div style="float: right">

                            <a href="/admin/AddingPackages/INSTASTAT">

                                <button class="btn green pull-right" data-toggle="modal"
                                        data-target="#addOrders" onclick="resetForm()"><i class="fa fa-plus-circle"></i>
                                    AddPackages

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
                            <select class="table-group-action-input form-control input-inline input-small input-sm"
                                    title="Select">
                                <option value="">Select...</option>
                                
                                <option value="inactive">inactive</option>
                                <option value="active">active</option>
                                <option value="Remove_orders">Remove</option>

                            </select>
                            <button class="btn btn-sm blue table-group-action-submit" title="submit"><i
                                        class="fa fa-check"></i></button>
                        </div>


                        <table class="table table-responsive table-striped table-bordered table-hover"
                               id="datatable_ajax">
                            <thead>
                            <tr role="row" class="heading">
                                <th width="5%"><input type="checkbox" id="groupCheckbox"></th>

                                <th width="10%">
                                    Id
                                </th>
                                <th width="25%">
                                    Package Name
                                </th>
                                <th width="15%">
                                    Price
                                </th>

                                <th width="15%">
                                    Package Status
                                </th>

                                <th width="15%">
                                    PackageType
                                </th>
                                <th widt="10%">
                                    Actions
                                </th>

                            </tr>
                            <tr role="row" class="filter">
                                <td>

                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm"
                                           title="search_package_id"
                                           name="search_package_id">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm"
                                           title="search_package_name"
                                           name="search_package_name">
                                </td>

                                <td>
                                    <div class="margin-bottom-5">
                                        <input type="text" class="form-control form-filter input-sm"
                                               title="search_price_from"
                                               name="search_price_from" placeholder="From"/>
                                    </div>
                                    <input type="text" class="form-control form-filter input-sm"
                                           :title="search_price_to"
                                           name="search_price_to" placeholder="To"/>
                                </td>
                                <td>
                                    <select name="search_package_status" class="form-control form-filter input-sm">
                                        <option value="">select...</option>
                                        <option value="0">inactive</option>
                                        <option value="1">active</option>
                                    </select>
                                </td>

                                <td>
                                    <select name="search_package_type" class="form-control form-filter input-sm"
                                            title="search_package_type">
                                        <option value="">select...</option>
                                        <option value="0">likes</option>
                                        <option value="1">followers</option>
                                        <option value="2">random comments</option>
                                        <option value="3">custom comments</option>
                                        <option value="4">views</option>
                                        <option value="5">story views</option>
                                        <option value="6">live video views</option>
                                    </select>
                                </td>
                                <td>
                                    <div class="margin-bottom-5">
                                        <button class="btn btn-xs yellow filter-submit margin-bottom" title="search"><i
                                                    class="fa fa-search"></i>
                                        </button>
                                        <button class="btn btn-xs red filter-cancel" title="refresh"><i
                                                    class="fa fa-refresh"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-filter input-sm"
                                           name="method" value="INSTASTAT" style="display: none;">
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



    
    <div id="editUserModal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            
            <div class="modal-header">
                <div class="modal-content">
                    <div class="modal-header" style="background: #1e8d8f; color: #fff;text-align: center;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Edit Packages</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form" role="form" id="edit_usernameForm">
                            <div class="form-group floating-label col-md-6">
                                <label for="package_name" style="color: black">Package Name:</label>
                                <input class="form-control" id="package_name" type="text" name="package_name" required
                                       title="package_name"
                                       value="<?php echo e(old('package_name')); ?>">
                                <div class="error" style="color:red"><?php echo e($errors->first('package_name')); ?></div>
                            </div>

                            <div class="form-group floating-label col-md-6">
                                <label for="package_type" style="color: black">Package Type:</label>
                                <select class="form-control packagedata" name="package_type" id="package_type"
                                        title="package_type">
                                    <option value="" selected>Select Plan</option>
                                    <option value="0" type="0">likes</option>
                                    <option value="1" type="1">followers</option>
                                    <option value="2" type="2">random comments</option>
                                    <option value="3" type="3">custom comments</option>
                                    <option value="4" type="4">views</option>
                                    <option value="5" type="5">story views</option>
                                    <option value="6" type="6">live video views</option>
                                </select>
                                <div class="error" style="color:red"><?php echo e($errors->first('package_type')); ?></div>
                            </div>


                            <div class="form-group floating-label col-md-6">
                                <label for="package_status" style="color: black">Package Status:</label>
                                <select class="form-control" name="package_status" id="package_status"
                                        title="package_status">
                                    <option value="0">inactive</option>
                                    <option value="1">active</option>
                                </select>
                                <div class="error" style="color:red"><?php echo e($errors->first('package_status')); ?></div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group floating-label col-md-6">
                                    <label for="quantity " style="color: black">Quantity:</label>

                                    <input class="form-control" id="quantity_package" type="number" name="quantity"
                                           min="1" max="" required title="quantity"
                                           value="<?php echo e(old('quantity')); ?>">
                                    <div class="error" style="color:red"><?php echo e($errors->first('quantity')); ?></div>


                                </div>

                                <div class="form-group floating-label col-md-6">
                                    <label for="price" style="color: black"><i class="fa fa-dollar"></i>Price:</label>
                                    <input class="form-control" id="price_package" type="number" name="price" min="1"
                                           max="" step="any" required title="price"
                                           value="<?php echo e(old('price')); ?>">
                                    <div class="error" style="color:red"><?php echo e($errors->first('price')); ?></div>

                                </div>

                                <div class="form-group floating-label">
                                    <label for="demo1" style="color: black">Plan_Name</label>
                                    <select class="form-control select2 plan_name_edit packageType" name="plan_name"
                                            id="plan_id" title="plan_name" title="plan_name"
                                            id="planValue" required>
                                        <option value="" selected>Select Plan</option>

                                    </select>
                                    <div class="error" style="color:red"><?php echo e($errors->first('plan_type')); ?></div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <div class="modal-header">

                            <button type="button" class="btn btn-warning btn-ripple" data-dismiss="modal"
                                    id="edit_cancelButton"><i class="fa fa-arrow-circle-left"></i> Back to List
                            </button>
                            <button type="button" class="btn btn-success  updateGeneralInfo"><span>Save Changes </span>
                            </button>
                        </div>
                    </div>
                </div>


            </div>
            
        </div>
    </div>


    
    <div id="showDetails" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" style="margin: 5% 18%;">
            <div class="modal-content">
                <div class="modal-header"
                     style="background: #1e8d8f; color: #fff;text-align: center;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">More Packages Details</h4>
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
                                        <label> <b>Package For : </b></label>&nbsp; <span
                                                id="package_fordetails"></span>
                                    </td>

                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <label> <b>Package Name : </b></label>&nbsp; <span
                                                id="package_nameDetails"></span>
                                    </td>

                                </tr>

                                <tr>
                                    <td colspan="2">
                                        <label> <b>package Type : </b></label>&nbsp; <span
                                                id="package_typedetails"></span>
                                    </td>

                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <label> <b>Price : </b></label><i class="fa fa-dollar"></i>&nbsp; <span
                                                id="price"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <label><b>Quantity : </b></label>&nbsp; <span id="quantity"></span>
                                    </td>

                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <label><b>Package Status : </b></label>&nbsp; <span
                                                id="package_statusDetails"></span>
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
            grid.setAjaxParam("method", "INSTASTAT");

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
                            "url": "/admin/packageAjaxHandler" // ajax source
                        },
                        "order": [
                            [1, "desc"]
                        ]// set first column as a default sort by asc
                    }
                });
                grid.setAjaxParam("method", "INSTASTAT");
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
                grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
                    e.preventDefault();
                    var action = $(".table-group-action-input", grid.getTableWrapper());
                    if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                        grid.setAjaxParam("customActionType", "group_action");
                        grid.setAjaxParam("customActionName", action.val());
                        grid.setAjaxParam("packageId", grid.getSelectedRows());
                        grid.setAjaxParam("method", "INSTASTAT");
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


        $(document).on('click', '.filter-cancel', function () {
            grid.setAjaxParam("method", "INSTASTAT");
            $('#datatable_ajax').DataTable().ajax.reload();

        })
        $(document).ready(function () {

// ChangeStatus Action  fuctionality in javascript ****************************
            $(document.body).on('click', '.changeStatus', function () {
                var obj = $(this);
                var ButtonStatus = obj.hasClass('label-success') ? '0' : '1';
                console.log("button status is clicked");

                var remz = confirm('Are you sure to changeStatus ');
                if (remz) {

                    $.ajax({
                        url: '/admin/satusChangePackage',
                        dataType: 'json',
                        type: 'post',
                        data: {package_id: $(this).attr('data-Id'), package_status: ButtonStatus},
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
// js for checkbox ******************************
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


            var package_id;
            $(document.body).on('click', '#deleteCommnet', function () {
                var obj = $(this);
                var package_id = $(this).attr('data-id');
                console.log(package_id);
                var remz = confirm('Are you sure want to delete ?');
                if (remz) {
                    $.ajax({
                        url: '/admin/DeleteAjaxHandelerPackageDetails',
                        type: 'post',
                        datatype: 'json',
                        data: {
                            package_id: package_id
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


            // js For Edit Packages  Functionality **************************************
            var package_id;
            $(document).on('click', '.editUserdetails', function (data) {
                console.log(' data Continue --------------------=======================', $(this).attr('data-id'));
                package_id = $(this).attr('data-id');

                var selectedValues = [];
                $.ajax({
                    url: '/admin/getPackagesEdit',
                    dataType: 'json',
                    type: 'post',
                    data: {package_id: package_id},

                    success: function (res) {

                        console.log('==========', res);
                        var userDetails = res.data;
                        if (res['status'] == 200) {

                            $('#package_name').val(userDetails.package_name);
                            $('#package_type').val(userDetails.package_type);
                            $('#package_status').val(userDetails.package_status);
                            $('#package_for').val(userDetails.package_for);
                            $('#quantity_package').val(userDetails.quantity);
                            $('#price_package').val(userDetails.price);
                            $(".plan_name_edit :selected").val(userDetails.plan_name);

                            var optionList = '';
                            $.each(res.planDetails, function (i, value) {
                                optionList += '<option value="' + value.plan_id + '">' + value.plan_name + '</option>';
                                // $(".plan_name_edit").append('<option value="' + value.plan_id + '">' + value.plan_name + '</option>');
                            });
                            testing($(".packagedata option:selected").attr('type'), userDetails.plan_id);
                            // $(".plan_name_edit").html(optionList);
                            // $('.packageType option[value=' + userDetails.plan_id + ']').attr("selected", "selected");
                        } else {
                            toastr.error(res.msg, {timeOut: 4000});
                        }
                    }

                });
            });


            $('#editUserModal').on('hidden.bs.modal', function () {
                $(this).find('form').trigger('reset');
            });
            // js For Update Functionality *************************************
            $(document).on('click', '.updateGeneralInfo', function () {
                testing($(".plan_name_edit option:selected").attr('type'))


                $.ajax({
                    url: '/admin/getUpdatePackagedata',
                    dataType: 'json',
                    type: 'post',
                    data: {
                        'package_name': $('#package_name').val(),
                        'package_type': $('#package_type').val(),
                        'package_status': $('#package_status').val(),
                        'package_for': $('#package_for').val(),
                        'quantity': $('#quantity_package').val(),
                        'price': $('#price_package').val(),
                        // 'plan_name': $('.plan_name_edit :selected').text(),
                        'plan_id': $('#plan_id').val(),

                        'package_id': package_id,
                    },
                    success: function (res) {
                        if (res['status'] == 200) {
                            toastr.success(res.message);
                            grid.setAjaxParam("method", "INSTASTAT");
                            $('#datatable_ajax').DataTable().ajax.reload();
                            $('#editUserModal').modal('hide');


                        } else if (res['status'] == 201) {
                            toastr.warning(res.message, {timeOut: 2000});
                        } else
                            toastr.error(res.message, {timeOut: 2000});
                    }

                });

            });


// js for show details  Functionality  ************************************************
            var package_id;
            $(document.body).on('click', '.show-details', function (e) {
                e.preventDefault();
                package_id = $(this).attr('data-id');

                $.ajax({
                    url: '/admin/getMorePackagesDetails',
                    dataType: 'json',
                    type: 'post',
                    data: {
                        'price': $('#price').val(),
                        'quantity': $('#quantity').val(),
                        'plan_id': $('#plan_id ').val(),
                        'package_id': package_id,
                    },
                    success: function (res) {
                        console.log(res);
                        if (res['status'] == 200) {
                            $('#price').text(res.userDetails.price);
                            $('#package_fordetails').text(res.userDetails.package_for);
                            $('#package_nameDetails').text(res.userDetails.package_name);
                            $('#package_typedetails').text(res.userDetails.package_type);
                            $('#package_statusDetails').text(res.userDetails.package_status);
                            $('#quantity').text(res.userDetails.quantity);

                        } else {
                            toastr.Success(res.msg, {timeOut: 4000});
                        }
                    }

                });
            });

        });

        function testing(selectedtype, selectedPlanId = '') {
            console.log('__', selectedtype)
            $.ajax({
                url: '/admin/GetAddPackages',
                dataType: 'json',
                type: 'post',
                data: {type: selectedtype},
                success: function (response) {

                    if (response['status'] == 200) {
                        var data = '';
                        $.each(response.data, function (index, value) {
                            if (value.plan_id == selectedPlanId)
                                data += '<option value="' + value.plan_id + '" selected>' + value.plan_name + '</option>';
                            else
                                data += '<option value="' + value.plan_id + '">' + value.plan_name + '</option>';
                        });
                        $(".packageType").empty().append(data)
                    }
                }
            })

        }


        $(".packagedata").change(function () {
            testing($(".packagedata option:selected").attr('type'))
        });
        $('#editUserModal').on('hidden.bs.modal', function () {
            $(this).find('form').trigger('reset');
        })



    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin::Layouts.adminlayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>