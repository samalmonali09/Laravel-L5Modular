
{{--/**--}}
{{--* Created by Monali Samal.--}}
{{--* User: Monali Samal--}}
{{--* Date: 16/7/2018--}}
{{--* Time: 1:10 PM--}}
{{--*/--}}


@extends('Admin::Layouts.adminlayout')
@section('AUTOIG','active open')
@section('PAYMENT','active open')

@section('pageheadcontent')
    <!-- add extra css required for this page only -->
    <link rel="stylesheet" href="/GAIA/assets/datatables/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="/GAIA/assets/datatables/css/dataTables.bootstrap.css"/>
@endsection


@section('pagecontent')
    <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title" style="color: #0d3625">
        Payment History
    </h3>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="/admin/PaymentDatable">AUTOIG</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="/admin/PaymentDatable">Payment History</a>
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
                        <i class="fa fa-dollar"></i> Payment History
                    </div>
                    <div class="actions">
                        <div style="float: right">
                            {{--<a href="/admin/AddSubcription">--}}
                                {{--<button class="btn green pull-right" data-toggle="modal"--}}
                                        {{--data-target="#addOrders" onclick="resetForm()"><i class="fa fa-plus-circle"></i>--}}
                                    {{--Add Subcription--}}
                                {{--</button>--}}
                            {{--</a>--}}
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-container">
                        <table class="table table-responsive table-striped table-bordered table-hover"
                               id="datatable_ajax">
                            <thead>
                            <tr role="row" class="heading">
                                {{--<th width="5%"><input type="checkbox" id="groupCheckbox"></th>--}}

                                <th width="10%">
                                    Id
                                </th>
                                <th width="15%">
                                    Paypal Id
                                </th>
                                <th width="15%">
                                    Price
                                </th>
                                <th width="15%">
                                    Billing Period
                                </th>
                                <th width="15%">
                                    Created Time
                                </th>
                                <th width="10%">
                                    Profile Status
                                </th>
                                <th widt="20%">
                                    Actions
                                </th>
                            </tr>

                            <tr role="row" class="filter">
                                {{--<td>--}}

                                {{--</td>--}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" title="search_profile_id"
                                           name="search_profile_id">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" title="search_paypal_profile_id"
                                           name="search_paypal_profile_id">
                                </td>

                                <td>
                                    <input type="text" class="form-control form-filter input-sm" title="search_price"
                                           name="search_price">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" title="search_billing_period"
                                           name="search_billing_period">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" title="search_created_at" disabled
                                           name="search_created_at">
                                </td>
                                <td>
                                    <select name="search_profile_status" class="form-control form-filter input-sm" title="search_profile_status">
                                        <option value="">select...</option>
                                        <option value="0">Pending</option>
                                        <option value="1">Active</option>
                                        <option value="2">Cancelled</option>
                                        <option value="3">Suspended</option>
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



    {{--Edit Modal--}}


    {{--Modal For Extra Details --}}
    <div id="showDetails" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" style="margin: 5% 18%;">
            <div class="modal-content">
                <div class="modal-header"
                     style="background: rgb(22,99,84); color: #fff;text-align: center;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">More Payment Details</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-responsive table-hover" id="viewTable">
                                <tbody>
                                <tr>
                                    <td colspan="2">
                                        <label> <b>SubPackagName : </b></label>&nbsp; <span
                                                id="sub_package_name"></span>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="2">
                                        <label> <b>Quantity : </b></label>&nbsp; <span id="quantity"></span>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="2">
                                        <label> <b>Price : </b></label>&nbsp; <i class="fa fa-dollar"></i>&nbsp;&nbsp;<span id="price"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <label> <b>BillingPeriod : </b></label>&nbsp; <span id="billing_period"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <label> <b>Profile Status : </b></label>&nbsp; <span
                                                id="profile_status"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <label> <b>SubPackage Type : </b></label>&nbsp; <span
                                                id="sub_package_type"></span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" title="close">Cancel</button>
                </div>
            </div>
        </div>
    </div>



    <!-- END PAGE CONTENT-->
@endsection

@section('pagescripts')
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

                        "columnDefs": [
                            {orderable: true, targets: 1},
                            // {orderable: false, targets: -1}
                        ],


                        "lengthMenu": [
                            [10, 20, 50, 100, 150, -1],
                            [10, 20, 50, 100, 150, "All"] // change per page values here
                        ],
                        "pageLength": 10, // default record count per page
                        "ajax": {
                            "url": "/admin/PaymentAjaxHandler" // ajax source
                        },
                        "order": [
                            [1, "desc"]
                        ]// set first column as a default sort by asc
                    }
                });
//                grid.setAjaxParam("method", "AUTOIG");
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
                grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
                    e.preventDefault();
                    var action = $(".table-group-action-input", grid.getTableWrapper());
                    if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                        grid.setAjaxParam("customActionType", "group_action");
                        grid.setAjaxParam("customActionName", action.val());
                        grid.setAjaxParam("packageId", grid.getSelectedRows());
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

//                    initPickers();
                    handleRecords();
                }
            };
        }();

        $(document).ready(function () {
// js for checkbox ******************************
//             $('#groupCheckbox').click(function () {
//                 if (this.checked) {
//                     console.log("grp checkbox is already checked");
//                     $('.orderCheckBox').each(function () {
//                         this.checked = true;
//                         $(this).parent().addClass('checked');
//
//                     });
//                 } else {
//                     console.log("not checked");
//                     $('.orderCheckBox').each(function () {
//                         this.checked = false;
//                         $(this).parent().removeClass('checked');
//                     });
//                 }
//
//             });
            $(document.body).on('click', '#deleteCommnet', function () {
                var obj = $(this);
                var profile_id = $(this).attr('data-id');
                console.log(profile_id);
                var remz = confirm('Are you sure want to delete ?');
                if (remz) {
                    $.ajax({
                        url: '/admin/deleteAjaxHandlerPayment',
                        type: 'post',
                        datatype: 'json',
                        data: {
                            profile_id: profile_id
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
                var profile_id = $(this).attr('data-id');
                $.ajax({
                    url: '/admin/PaymentExtraDetailsAjaxHAndler',
                    dataType: 'json',
                    type: 'post',
                    data: {
                        'sub_package_name': $('#sub_package_name').val(),
                        'billing_period': $('#billing_period ').val(),
                        'sub_package_type': $('#sub_package_type ').val(),
                        'quantity': $('#quantity ').val(),
                        'price': $('#price ').val(),
                        'profile_status ': $('#profile_status').val(),
                        'sub_package_type ': $('#sub_package_type').val(),
                        'profile_id': profile_id,
                    },
                    success: function (res) {
                        console.log(res);
                        if (res['status'] == 200) {
                            $('#sub_package_name').text(res.userDetails.sub_package_name);
                            $('#billing_period').text(res.userDetails.billing_period);
                            $('#sub_package_type').text(res.userDetails.sub_package_type);
                            $('#price').text(res.userDetails.quantity ?res.userDetails.price : 0);
                            $('#quantity').text(res.userDetails.quantity ?res.userDetails.quantity : 0);

                            $('#profile_status').text(res.userDetails.profile_status);
                            $('#sub_package_type').text(res.userDetails.sub_package_type);

                        } else {
                            toastr.Success(res.msg, {timeOut: 4000});
                        }
                    }

                });
            });



        });

    </script>

@endsection
