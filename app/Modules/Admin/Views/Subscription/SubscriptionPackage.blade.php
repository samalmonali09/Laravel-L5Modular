
{{--/**--}}
{{--* Created by Monali Samal.--}}
{{--* User: Monali Samal--}}
{{--* Date: 2/23/2018--}}
{{--* Time: 1:10 PM--}}
{{--*/--}}


@extends('Admin::Layouts.adminlayout')
@section('AUTOIG','active open')
@section('SPAUTOIG','active open')

@section('pageheadcontent')
    <!-- add extra css required for this page only -->
    <link rel="stylesheet" href="/GAIA/assets/datatables/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="/GAIA/assets/datatables/css/dataTables.bootstrap.css"/>
@endsection


@section('pagecontent')
    <!-- BEGIN PAGE HEADER-->

    <h3 class="page-title" style="color: #0d3625">
        Subscription Package
    </h3>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="/admin/SubscriptionDatatable">AUTOIG</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="/admin/SubscriptionDatatable">Subscription Packages</a>
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
                        <i class="fa fa-shopping-cart"></i> Subscription Packages Listing
                    </div>
                    <div class="actions">
                        <div style="float: right">
                            <a href="/admin/AddSubcription">
                                <button class="btn green pull-right" data-toggle="modal"
                                        data-target="#addOrders" onclick="resetForm()"><i class="fa fa-plus-circle"></i>
                                    Add Subcription
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
                                {{--<th width="5%"><input type="checkbox" id="groupCheckbox"></th>--}}

                                <th width="10%">
                                    Id
                                </th>
                                <th width="25%">
                                    SubPackage Name
                                </th>
                                <th width="15%">
                                    Quantity
                                </th>
                                <th width="20%">
                                    SubPackageType
                                </th>
                                <th width="15%">
                                    Status
                                </th>
                                <th widt="10%">
                                    Actions
                                </th>
                            </tr>
                            <tr role="row" class="filter">
                                {{--<td>--}}

                                {{--</td>--}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" title="search_sub_package_id"
                                           name="search_sub_package_id">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" title="search_sub_package_name"
                                           name="search_sub_package_name">
                                </td>

                                <td>
                                    <input type="text" class="form-control form-filter input-sm" title="search_quantity"
                                           name="search_quantity">
                                </td>
                                <td>
                                    <select name="search_sub_package_type" class="form-control form-filter input-sm" title="search_sub_package_type">
                                        <option value="">select...</option>
                                        <option value="0">autolikes </option>
                                        <option value="1">autoviews</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="search_status" class="form-control form-filter input-sm" title="search_status">
                                        <option value="">select...</option>
                                        <option value="0">inactive</option>
                                        <option value="1">active</option>
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

    <div id="showDetails" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" style="margin: 5% 18%;">
            <div class="modal-content">
                <div class="modal-header"
                     style="background: rgba(10,64,99,1); color: #fff;text-align: center;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">More Subcription Details</h4>
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
                                        <label> <b>SubPackag Name : </b></label>&nbsp; <span
                                                id="sub_package_name"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <label> <b>SubPackage Type : </b></label>&nbsp; <span
                                                id="sub_package_type"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <label> <b>Quantity : </b></label>&nbsp; <span id="quantity"></span>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="2">
                                        <label> <b>Status : </b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span
                                                id="status"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <label> <b>Sub Package: </b></label>&nbsp;&nbsp;&nbsp; <span
                                                id="sub_package_for"></span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
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
                    <h4 class="modal-title">Edit Subscription package</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-11">
                            <form id="editProfileForm">
                                <table class="table table-responsive table-hover" id="viewTable">
                                    <tbody>
                                    <tr>
                                        <td colspan="2">
                                            SubPackage Name:
                                        </td>
                                        <td colspan="2">
                                            <strong><input type="text" class="form-control" name="sub_package_name"
                                                           id="sub_package_name1" placeholder="sub_package_name"/>
                                            </strong>
                                            <div class="error"
                                                 style="color:red">{{ $errors->first('sub_package_name') }}</div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            Quantity:
                                        </td>
                                        <td colspan="2">
                                            <strong><input type="text" class="form-control" name="quantity"
                                                           id="quantity1" placeholder="quantity"/> </strong>
                                            <div class="error" style="color:red">{{ $errors->first('quantity') }}</div>

                                        </td>
                                    </tr>

                                    <tr>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-4">
                                                    <input class="packageType" type="checkbox" id="daily"
                                                           name="daily_details"/>
                                                    <label for="daily" for="DailyPost">Daily</label>
                                                </div>


                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group floating-label col-md-10">
                                                    <div>
                                                        @if(($errors->first('daily_price') !== "") ||($errors->first('daily_billing_frequency') !== "") || ($errors->first('daily_post_limit') !== "") || ($errors->first('daily_daily_post_limit') !== "") || ($errors->first('plan_id') !== ""))
                                                            checked @endif
                                                        <div id="dailyDetails"
                                                             class="form-group floating-label col-md-12" hidden>
                                                            <div class="form-group floating-label">
                                                                <label class="control-label" style="color: black"
                                                                       for=""><i
                                                                            class="fa fa-dollar"></i>Price:&nbsp;&nbsp;&nbsp;</label>
                                                                <input type="text" class="form-control"
                                                                       name="daily_price" id="price" min="1" max=""
                                                                       placeholder="" value=""/>
                                                                <div class="error"
                                                                     style="color:red">{{ $errors->first('daily_price')}}</div>
                                                            </div>
                                                            <div class="form-group floating-label col-md-6 offset-md-6">
                                                                <label class="control-label" style="color: black"
                                                                       for="">Billing Frequency: [Day]</label>
                                                                <input type="text" class="form-control"
                                                                       name="daily_billing_frequency" min="1" max=""
                                                                       id="billing_frequency"
                                                                       placeholder=""
                                                                       value=""/>
                                                                <div class="error"
                                                                     style="color:red">{{ $errors->first('daily_billing_frequency') }}</div>
                                                            </div>
                                                            <div class="form-group floating-label col-md-6">
                                                                <label class="control-label" style="color: black"
                                                                       for="">Billing_period:&nbsp;&nbsp;</label>
                                                                <input type="text" class="form-control"
                                                                       name="billing_period" id="billing_period"
                                                                       min="1" max="" placeholder=""
                                                                       value=""/>
                                                                <div class="error"
                                                                     style="color:red">{{ $errors->first('billing_period') }}</div>
                                                            </div>


                                                            <div class="form-group floating-label col-md-6">
                                                                <label class="control-label" style="color: black"
                                                                       for="">PostLimit:&nbsp;&nbsp;</label>
                                                                <input type="text" class="form-control"
                                                                       name="daily_post_limit" id="post_limit"
                                                                       min="1" max="" placeholder=""
                                                                       value=""/>
                                                                <div class="error"
                                                                     style="color:red">{{ $errors->first('daily_post_limit') }}</div>
                                                            </div>
                                                            <div class="form-group floating-label col-md-6">
                                                                <label class="control-label" style="color: black"
                                                                       for="">Daily_post_limit:&nbsp;&nbsp;</label>
                                                                <input type="text" class="form-control"
                                                                       name="daily_daily_post_limit" min="1" max=""
                                                                       id="daily_post_limit"
                                                                       placeholder=""
                                                                       value=""/>
                                                                <div class="error"
                                                                     style="color:red">{{ $errors->first('daily_daily_post_limit') }}</div>
                                                            </div>

                                                            <div class="form-group floating-label">
                                                                <label for="demo1"
                                                                       style="color: black">Plan_Name</label>
                                                                <select class="form-control select2 plan_name_edit packageType"
                                                                        name="daily_plan_id"
                                                                        id="plan_id" title="plan_name" title="plan_name"
                                                                        id="planValue" required>
                                                                    <option value="" selected>Select Plan</option>

                                                                </select>
                                                                <div class="error"
                                                                     style="color:red">{{ $errors->first('plan_type') }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        {{--</div>--}}

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-4">
                                                    <input class="packageType" type="checkbox" id="weekly"
                                                           name="weekly_details"/>
                                                    <label for="weekly" for="WeeklyPost">Weekly</label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group floating-label col-md-10">
                                                    <div>
                                                        <div id="weeklyDetails"
                                                             class="form-group floating-label col-md-12"
                                                             hidden>
                                                            <div class="form-group floating-label">
                                                                <label class="control-label" style="color: black"
                                                                       for=""><i
                                                                            class="fa fa-dollar"></i>Price:&nbsp;&nbsp;&nbsp;</label>
                                                                <input type="text" class="form-control"
                                                                       name="weekly_price"
                                                                       id="weeklyprice"
                                                                       min="1" max=""
                                                                       step="any" placeholder=""
                                                                       value="{{old('weekly_price')}}"/>
                                                                <div class="error"
                                                                     style="color:red">{{ $errors->first('weekly_price') }}</div>
                                                            </div>

                                                            <div class="form-group floating-label col-md-6">
                                                                <label class="control-label" style="color: black"
                                                                       for="">Billing
                                                                    Frequency: [Week]</label>
                                                                <input type="text" class="form-control"
                                                                       name="weekly_billing_frequency"
                                                                       min="1" max
                                                                       id="weeklybilling_frequency"
                                                                       value="{{old('weekly_billing_frequency')}}"
                                                                       placeholder=""/>
                                                                <div class="error"
                                                                     style="color:red">{{ $errors->first('weekly_billing_frequency') }}</div>


                                                            </div>
                                                            <div class="form-group floating-label col-md-6">
                                                                <label class="control-label" style="color: black"
                                                                       for="">Billing_period:&nbsp;&nbsp;</label>
                                                                <input type="text" class="form-control"
                                                                       name="weeklybilling_period" id="weeklybilling_period"
                                                                       min="1" max="" placeholder=""
                                                                       value=""/>
                                                                <div class="error"
                                                                     style="color:red">{{ $errors->first('weeklybilling_period') }}</div>
                                                            </div>

                                                            <div class="form-group floating-label col-md-6">
                                                                <label class="control-label" style="color: black"
                                                                       for="">PostLimit:&nbsp;&nbsp;</label>
                                                                <input type="text" class="form-control"
                                                                       name="weekly_post_limit"
                                                                       id="weeklypost_limit"
                                                                       min="1" max="" placeholder=""
                                                                       value="{{old('weekly_post_limit')}}"/>
                                                                <div class="error"
                                                                     style="color:red">{{ $errors->first('weekly_post_limit') }}</div>

                                                            </div>

                                                            <div class="form-group floating-label col-md-6">
                                                                <label class="control-label" style="color: black"
                                                                       for="">Daily_post_limit:&nbsp;&nbsp;</label>
                                                                <input type="text" class="form-control"
                                                                       name="weekly_daily_post_limit"
                                                                       min="1" max=""
                                                                       id="weeklydaily_post_limit"
                                                                       value="{{old('weekly_daily_post_limit')}}"
                                                                       placeholder=""/>
                                                                <div class="error"
                                                                     style="color:red">{{ $errors->first('weekly_daily_post_limit') }}</div>


                                                            </div>
                                                            <div class="form-group floating-label">
                                                                <label for="demo1"
                                                                       style="color: black">Plan_Name</label>
                                                                <select class="form-control select2 weeklyplan_name_edit weeklpackageType"
                                                                        name="weekly_plan_id"
                                                                        id="weeklyplan_id" title="plan_name"
                                                                        title="plan_name"
                                                                        id="planValue" required>
                                                                    <option value="" selected>Select Plan</option>
                                                                </select>
                                                                <div class="error"
                                                                     style="color:red">{{ $errors->first('plan_type') }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>


                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="col-md-4">
                                                        <input class="packageType" type="checkbox" id="monthly"
                                                               name="monthly_details"/>
                                                        <label for="monthly" for="MonthlyPost">Monthly</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group floating-label col-md-10">
                                                        <div>
                                                            <div id="monthlyDetails"
                                                                 class="form-group floating-label col-md-12"
                                                                 hidden>
                                                                <div class="form-group floating-label">
                                                                    <label class="control-label"
                                                                           style="color: black" for=""><i
                                                                                class="fa fa-dollar"></i>Price:&nbsp;&nbsp;&nbsp;</label>
                                                                    <input type="text" class="form-control"
                                                                           name="monthly_price"
                                                                           id="monthlyprice" min="1" max=""
                                                                           value="{{old('monthly_price')}}"
                                                                           step="any" placeholder=""/>
                                                                    <div class="error"
                                                                         style="color:red">{{ $errors->first('monthly_price') }}</div>


                                                                </div>

                                                                <div class="form-group floating-label col-md-6">
                                                                    <label class="control-label"
                                                                           style="color: black" for="">Billing
                                                                        Frequency: [Month]</label>
                                                                    <input type="text" class="form-control"
                                                                           name="monthly_billing_frequency" min="1"
                                                                           max=""
                                                                           value="{{old('monthly_billing_frequency')}}"
                                                                           id="monthlybilling_frequency"
                                                                           placeholder=""/>
                                                                    <div class="error"
                                                                         style="color:red">{{ $errors->first('monthly_billing_frequency') }}</div>


                                                                </div>

                                                                <div class="form-group floating-label col-md-6">
                                                                    <label class="control-label" style="color: black"
                                                                           for="">Billing_period:&nbsp;&nbsp;</label>
                                                                    <input type="text" class="form-control"
                                                                           name="monthlybilling_period" id="monthlybilling_period"
                                                                           min="1" max="" placeholder=""
                                                                           value=""/>
                                                                    <div class="error"
                                                                         style="color:red">{{ $errors->first('monthlybilling_period') }}</div>
                                                                </div>

                                                                <div class="form-group floating-label col-md-6">
                                                                    <label class="control-label"
                                                                           style="color: black"
                                                                           for="">PostLimit:&nbsp;&nbsp;</label>
                                                                    <input type="text" class="form-control"
                                                                           name="monthly_post_limit"
                                                                           id="monthlypost_limit"
                                                                           min="1" max="" placeholder=""
                                                                           value="{{old('monthly_post_limit')}}"/>
                                                                    <div class="error"
                                                                         style="color:red">{{ $errors->first('monthly_post_limit') }}</div>

                                                                </div>

                                                                <div class="form-group floating-label col-md-6">
                                                                    <label class="control-label"
                                                                           style="color: black" for="">Daily_post_limit:&nbsp;&nbsp;</label>
                                                                    <input type="text" class="form-control"
                                                                           name="monthly_daily_post_limit" min="1"
                                                                           max=""
                                                                           value="{{old('monthly_daily_post_limit')}}"
                                                                           id="monthlydaily_post_limit"
                                                                           placeholder=""/>
                                                                    <div class="error"
                                                                         style="color:red">{{ $errors->first('monthly_daily_post_limit') }}</div>


                                                                </div>

                                                                <div class="form-group floating-label">
                                                                    <label for="demo1"
                                                                           style="color: black">Plan_Name</label>
                                                                    <select class="form-control select2 monthlyplan_name_edit   monthlypackageType"
                                                                            name="monthly_plan_id"
                                                                            id="monthlyplan_id" title="plan_name"
                                                                            title="plan_name"
                                                                            id="planValue" required>
                                                                        <option value="" selected>Select Plan
                                                                        </option>

                                                                    </select>
                                                                    <div class="error"
                                                                         style="color:red">{{ $errors->first('plan_type') }}</div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>



                                    <tr>
                                        <td colspan="2">
                                            Views Price:
                                        </td>
                                        <td colspan="2">
                                            <strong><input type="text" class="form-control" name="views_price"
                                                           id="views_price1" placeholder="views_price"/> </strong>
                                            <div class="error"
                                                 style="color:red">{{ $errors->first('views_price') }}</div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            SubPackage Type:
                                        </td>
                                        <td colspan="2">
                                            <strong> <select class="form-control col-md-3" name="sub_package_type"
                                                             id="sub_package_type1">
                                                    <option value="0">autolikes</option>
                                                    <option value="1">autoviews</option>
                                                </select></strong>
                                            <div class="error"
                                                 style="color:red">{{ $errors->first('sub_package_type') }}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            Status
                                        </td>
                                        <td colspan="2">
                                            <strong><select class="form-control col-md-3" name="status" id="status1">
                                                    <option value="0">inactive</option>
                                                    <option value="1">active</option>
                                                </select></strong>
                                            <div class="error" style="color:red">{{ $errors->first('status') }}</div>


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
                    <button type="button" class="btn btn-success  updateGeneralInfo" title="save">
                        <span>Save Changes </span>
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
    </div>
    {{--Modal For Extra Details --}}
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
                            "url": "/admin/SubscriptionAjaxHandeler" // ajax source
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

            $(document.body).on('click', '.changeStatus', function () {
                var obj = $(this);
                var ButtonStatus = obj.hasClass('label-success') ? '0' : '1';
                console.log("button status is clicked");
                var remz = confirm('Are you sure to changeStatus ');
                if (remz) {
                    $.ajax({
                        url: '/admin/satusChangeSubscription',
                        dataType: 'json',
                        type: 'post',
                        data: {sub_package_id: $(this).attr('data-Id'), status: ButtonStatus},
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

            var sub_package_id;
            $(document).on('click', '.editUserdetails', function () {
                console.log(' data Continue --------------------=======================', $(this).attr('data-id'));
                sub_package_id = $(this).attr('data-id');
                $.ajax({
                    url: '/admin/EditAjaxHandlerSubscription',
                    dataType: 'json',
                    type: 'post',
                    data: {sub_package_id: sub_package_id},

                    success: function (res) {

                        console.log(res);
                        console.log('********************', userDetails);
                        if (res['status'] == 200) {

                            console.log('=========', res.data);
                            var userDetails = res.data;


                            $('#sub_package_name1').val(userDetails.sub_package_name);
                            $('#sub_package_type1').val(userDetails.sub_package_type);
                            $('#quantity1').val(userDetails.quantity);
                            // $('#views_price1').val(userDetails.views_price);
                            $('#status1').val(userDetails.status);


                            // if (userDetails.views_price === '') {
                            //     $('#views_price1').val('---------');
                            // } else {
                            //     $('#views_price1').val(userDetails.views_price);
                            //
                            // }
                            console.log('&&&&&&999999999999999999----&&&&&', JSON.parse(userDetails.daily_details))
                            var allDetails = JSON.parse(userDetails.daily_details);
                            if (userDetails.daily_details === '') {
                                $('#daily').val('---------');
                            } else {
                                console.log('+++++++++++++', userDetails[0])
                                $.each(allDetails, function (i, v) {
                                    console.log(v.price);
                                    $("#billing_frequency").val(v.billing_frequency);
                                    $("#billing_period").val(v.billing_period);
                                    $("#post_limit").val(v.post_limit);
                                    $("#price").val(v.price);
                                    $("#plan_id").val(v.plan_id);
                                    $("#daily_post_limit").val(v.daily_post_limit);
                                    var optionList = '';
                                    $.each(res.planDetails, function (i, value) {
                                        // $(".plan_name_edit").append('<option value="' + value.plan_id + '">' + value.plan_name + '</option>');

                                        optionList += '<option value="' + value.plan_id + '">' + value.plan_name + '</option>';
                                    });
                                    $(".plan_name_edit").html(optionList);
                                    $('.packageType option[value=' + userDetails.plan_id + ']').attr("selected", "selected");
                                });
                                $('#dailyDetails').show();
                                $('#daily').attr('checked', true).parent().addClass('checked');
                            }

                            var WeeklyDetails = JSON.parse(userDetails.weekly_details);
                            if (userDetails.weekly_details === '') {
                                $('#weekly').val('-----------');
                            } else {
                                $.each(WeeklyDetails, function (i, v) {
                                    $("#weeklybilling_frequency").val(v.billing_frequency);
                                    $("#weeklybilling_period").val(v.billing_period);
                                    $("#weeklypost_limit").val(v.post_limit);
                                    $("#weeklyprice").val(v.price);
                                    $("#weeklyplan_id").val(v.plan_id);
                                    $("#weeklydaily_post_limit").val(v.daily_post_limit);
                                    var weekplanList = '';
                                    $.each(res.planDetails, function (i, value) {
                                        weekplanList += '<option value="' + value.plan_id + '">' + value.plan_name + '</option>';
                                    });
                                    $(".weeklyplan_name_edit").html(weekplanList);

                                    $('.weeklypackageType option[value=' + userDetails.plan_id + ']').attr("selected", "selected");

                                });

                                $('#weeklyDetails').show();
                                $('#weekly').attr('checked', true).parent().addClass('checked');

                            }



                            var MonthlyDetails = JSON.parse(userDetails.monthly_details);
                            if (userDetails.monthly_details === '') {
                                $('#monthly').val('-----------');
                            } else {
                                $.each(MonthlyDetails, function (i, v) {
                                    $('#monthlybilling_frequency').val(v.billing_frequency);
                                    $("#monthlybilling_period").val(v.billing_period);
                                    $('#monthlypost_limit').val(v.post_limit);
                                    $('#monthlyprice').val(v.price);
                                    $('#monthlyplan_id').val(v.plan_id);
                                    $('#monthlydaily_post_limit').val(v.daily_post_limit);


                                    var monthplanList = '';
                                    $.each(res.planDetails, function (i, value) {
                                        monthplanList += '<option value="' + value.plan_id + '">' + value.plan_name + '</option>';
                                    });
                                    $(".monthlyplan_name_edit").html(monthplanList);

                                    $('.monthlypackageType option[value=' + userDetails.plan_id + ']').attr("selected", "selected");

                                });
                                $('#monthlyDetails').show();
                                $('#monthly').attr('checked', true).parent().addClass('checked');
                            }

                        }
                    }

                });
            });

            $(document).ready(function () {

                $('#editUserModal').on('hidden.bs.modal', function (e) {

                    $('#daily').attr('checked', true).parent().removeClass('checked');
                    $("#billing_frequency").val(''),
                        $("#billing_period").val(''),
                        $("#price").val(''),
                        $("#post_limit").val(''),
                        $("#daily_post_limit").val(''),
                        $("#plan_id").val(''),

                        $('#dailyDetails').hide();

                    $('#weekly').attr('checked', true).parent().removeClass('checked');
                    $("#weeklybilling_frequency").val(''),
                        $("#weeklybilling_period").val(''),
                        $("#weeklyprice").val(''),
                        $("#weeklypost_limit").val(''),
                        $("#weeklydaily_post_limit").val(''),
                        $("#weeklyplan_id").val(''),
                        $('#weeklyDetails').hide();

                    $('#monthly').attr('checked', true).parent().removeClass('checked');
                    $("#monthlybilling_frequency").val(''),
                        $("#monthlybilling_period").val(''),
                        $("#monthlyprice").val(''),
                        $("#monthlypost_limit").val(''),
                        $("#monthlydaily_post_limit").val(''),
                        $("#monthlyplan_id").val(''),
                        $('#monthlyDetails').hide();

                });

            });

            var sub_package_id;
            $(document).on('click', '.updateGeneralInfo', function () {
                var DailyDetails = {
                    'billing_frequency': $("#billing_frequency").val(),
                    'billing_period': $("#billing_period").val(),
                    'price': $("#price").val(),
                    'post_limit': $("#post_limit").val(),
                    'daily_post_limit': $("#daily_post_limit").val(),
                    'plan_id': $("#plan_id").val(),
                };
                var WeeklyDetails = {
                    'billing_frequency': $("#weeklybilling_frequency").val(),
                    'billing_period': $("#weeklybilling_period").val(),
                    'price': $("#weeklyprice").val(),
                    'post_limit': $("#weeklypost_limit").val(),
                    'daily_post_limit': $("#weeklydaily_post_limit").val(),
                    'plan_id': $("#weeklyplan_id").val(),
                };

                var MonthlyDetails = {
                    'billing_frequency': $("#monthlybilling_frequency").val(),
                    'billing_period': $("#monthlybilling_period").val(),
                    'price': $("#monthlyprice").val(),
                    'post_limit': $("#monthlypost_limit").val(),
                    'daily_post_limit': $("#monthlydaily_post_limit").val(),
                    'plan_id': $("#monthlyplan_id").val(),
                };


                console.log("*************@@@@@@@@@@*****", DailyDetails, MonthlyDetails, WeeklyDetails);

                $.ajax({
                    url: '/admin/UpdateAjaxHandelerSubscription',
                    dataType: 'json',
                    type: 'post',
                    data: {
                        'sub_package_name': $('#sub_package_name1').val(),
                        'sub_package_type': $('#sub_package_type1').val(),
                        'quantity': $('#quantity1').val(),
                        'views_price': $('#views_price1').val(),
                        'daily_details': DailyDetails,
                        'monthly_details': MonthlyDetails,
                        'weekly_details': WeeklyDetails,
                        'sub_package_id': sub_package_id,
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


            $(document.body).on('click', '#deleteCommnet', function () {
                var obj = $(this);
                var sub_package_id = $(this).attr('data-id');
                console.log(sub_package_id);
                var remz = confirm('Are you sure want to delete ?');
                if (remz) {
                    $.ajax({
                        url: '/admin/deleteAjaxHandlersubscription',
                        type: 'post',
                        datatype: 'json',
                        data: {
                            sub_package_id: sub_package_id
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





            function testing(selectedtype, selectedPlanId = '') {
                console.log('__', selectedtype)
                $.ajax({
                    url: '/admin/GetAddSubscriptionPackages',
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

            $(document.body).on('click', '.show-details', function () {
               var sub_package_id = $(this).attr('data-id');
                console.log('++++++++++++++');
                $.ajax({
                    url: '/admin/showExtraDetailsAjaxHAndler',
                    dataType: 'json',
                    type: 'post',
                    data: {
                        'sub_package_type': $('#sub_package_type').val(),
                        'sub_package_name': $('#sub_package_name').val(),
                        'quantity': $('#quantity').val(),
                        'views_price': $('#views_price').val(),
                        'status ': $('#status').val(),
                        'sub_package_for ': $('#sub_package_for').val(),

                        'sub_package_id': sub_package_id,
                    },
                    success: function (res) {
                        console.log(res);
                        if (res['status'] == 200) {
                            $('#sub_package_type').text(res.userDetails.sub_package_type);
                            $('#sub_package_name').text(res.userDetails.sub_package_name);
                            $('#quantity').text(res.userDetails.quantity);
                            $('#sub_package_for').text(res.userDetails.sub_package_for);

                            // $('#views_price').text(res.userDetails.views_price);
                            $('#status').text(res.userDetails.status);

                        } else {
                            toastr.Success(res.msg, {timeOut: 4000});
                        }
                    }

                });
            });


        });
        $('#daily').click(function () {
            if ($(this).is(':checked'))
                $('#dailyDetails').show();
            else
                $('#dailyDetails').hide();
        });

        $('#weekly').click(function () {
            if ($(this).is(':checked'))
                $('#weeklyDetails').show();
            else
                $('#weeklyDetails').hide();
        });
        $('#monthly').click(function () {

            if ($(this).is(':checked'))
                $('#monthlyDetails').show();
            else
                $('#monthlyDetails').hide();

        });


    </script>

@endsection
