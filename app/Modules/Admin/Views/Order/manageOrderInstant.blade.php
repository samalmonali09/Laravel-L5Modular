{{--/**--}}
{{--* Created by Monali Samal.--}}
{{--* User: Monali Samal<monalisamal@globussoft.in> --}}
{{--* Date: 2/22/2018--}}
{{--* Time: 11:31 AM--}}
{{--*/--}}
{{--/**--}}


@extends('Admin::Layouts.adminlayout')
@section('GIL','active open')
@section('ILMO','active open')
@section('pageheadcontent')
    <!-- add extra css required for this page only -->

    <link rel="stylesheet" href="/GAIA/assets/datatables/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="/GAIA/assets/datatables/css/dataTables.bootstrap.css"/>
    {{--<link rel="stylesheet" type="text/css" href="GAIA/assets/dataTables/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>--}}
    <link rel="stylesheet" type="text/css"
          href="/GAIA/assets/datatables/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"/>
    <link rel="stylesheet" href="/GAIA/assets/datatables/css/datetimepicker_dummy.css"/>
    <link rel="stylesheet" href="/GAIA/assets/datatables/css/datetimepicker_dummy.css"/>

    <style>
        #commentsDiv, #comments {
            padding: 5px;
            text-align: center;
            background-color: #81ee9e;
            border: solid 1px #fffcf9;
        }

        #commentsDiv {
            padding: 50px;
            display: none;
        }
        .link-width {
            max-width: 140px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>

@endsection

@section('pagecontent')
    <!-- BEGIN PAGE HEADER-->

    <h3 class="page-title" style="color: #19658b">
        Manage Orders Instant
    </h3>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="/admin/manageOrders/Instant">Manage Orders</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="/admin/manageOrders/Instant"><i class="fa fa-eye-slash"></i>Instant Orders </a>
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
                        <i class="fa fa-shopping-cart"></i>Order Listing
                    </div>
                    <div class="actions">

                        <div style="float: right">
                            <a href="/admin/ordersAdd">

                            </a>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-container">
                        <div class="portlet-body">
                            <div class="table-container">
                                <div class="table-actions-wrapper">
									<span>
									</span>
                                    <select class="table-group-action-input form-control input-inline input-small input-sm" title="select">
                                        <option value="">Select...</option>
                                        <option value="cancel_order">Cancel</option>
                                        <option value="reAdd_order">reAddOrder</option>

                                        <option value="Remove_orders">Remove_orders</option>

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
                                            Id&nbsp;
                                        </th>

                                        <th width="10%">
                                            Email
                                        </th>

                                        <th width="10%">
                                            Link
                                        </th>
                                        <th width="5%">
                                            Price
                                        </th>
                                        <th width="5%">
                                            Quantity
                                        </th>

                                        <th width="10%">
                                            Date
                                        </th>
                                        <th width="10%">
                                            Package
                                        </th>
                                        <th width="10%">
                                            Status
                                        </th>
                                        <th width="10%">
                                            <i class="fa fa-cog"></i>
                                        </th>

                                    </tr>
                                    <tr role="row" class="filter">
                                        <td>

                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-filter input-sm" title="search_order_id"
                                                   name="search_order_id">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-filter input-sm" title="search_Email"
                                                   name="search_Email">
                                        </td>

                                        <td>
                                            <input type="text" class="form-control form-filter input-sm" title="search_order_url"
                                                   name="search_order_url">
                                        </td>
                                        <td>
                                            <div class="margin-bottom-5">
                                                <input type="text" class="form-control form-filter input-sm" title="search_price_from"
                                                       name="search_price_from" placeholder="From"/>
                                            </div>
                                            <input type="text" class="form-control form-filter input-sm" title="search_price_to"
                                                   name="search_price_to" placeholder="To"/>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-filter input-sm" title="search_quantity"
                                                   name="search_quantity">
                                        </td>



                                        <td>
                                            <input type="text" class="form-control form-filter input-sm" title="search_Date" disabled
                                                   name="search_Date">
                                        </td>

                                        <td>
                                            <input type="text" class="form-control form-filter input-sm" title="search_Package"
                                                   name="search_Package">
                                        </td>
                                        <td>
                                            <select name="search_status" class="form-control form-filter input-sm" title="search_status">
                                                <option value="">select...</option>
                                                <option value="0">pending</option>
                                                <option value="1">queue</option>
                                                <option value="2">processing</option>
                                                <option value="3">completed</option>
                                                <option value="4">refunded</option>
                                                <option value="5">cancelled</option>
                                                <option value="6">failed</option>
                                            </select>
                                        </td>

                                        <td>
                                            <div class="margin-bottom-5">
                                                <button class="btn btn-xs yellow filter-submit margin-bottom" title="search"><i
                                                            class="fa fa-search" ></i>
                                                </button>
                                                <button class="btn btn-xs red filter-cancel" title="refresh"><i class="fa fa-refresh"></i>
                                                </button>
                                            </div>
                                            <input type="text" class="form-control form-filter input-sm"
                                                   name="method" value="Instant" style="display: none;">
                                        </td>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- End: life time stats -->
                </div>
            </div>




            <div id="Comment_history" class="modal fade" id="more">
                <div class="modal-dialog">
                    <div class="modal-content buylikesmodal" style="border: 3px solid;" data-animation="false">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4  class="modal-title" style="text-align: center;color:#0d3625"> Comments Details </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <ul class="list-group">
                                <li class="list-group-item center;"><span id="comments"></span></li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{--Modal For Extra Details --}}

            <div id="showDetails" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" style="margin: 5% 18%;">
                    <div class="modal-content">
                        <div class="modal-header"
                             style="background: #1e4f66; color: #fff;text-align: center;">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">More Orders Details</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">

                                <div class="col-md-10">
                                    <table class="table table-responsive table-hover" id="viewTable">
                                        <tbody>
                                        <tr>

                                        <tr>
                                            <td colspan="2">
                                                <label> <b>Url Type: </b></label>&nbsp;<i class="fa fa-link"></i> <span
                                                        id="url_type"></span>

                                            </td>
                                        </tr>

                                        <tr>
                                        <tr>
                                            <td colspan="2">
                                                <label><b>Quantity : </b></label>&nbsp; <span
                                                        id="quantity"></span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="2">
                                                <label><b>Order Url :</b></label>&nbsp; <i class="fa fa-instagram"></i><a
                                                        id="order_url" href=""  data-toggle="modal"  target="_blank"></a>

                                            </td>
                                        <tr>
                                            <td colspan="2">
                                                <label><b>End Count :</b></label>&nbsp; <span id="end_count"></span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="2">
                                                <label><b>Status :</b></label>&nbsp; <span
                                                        id="status"></span>
                                        </tr>
                                        </td>

                                        <td colspan="2">
                                            <label><b>Start Count :</b></label>&nbsp;&nbsp;<i class="fa fa-heart"></i>&nbsp; <span
                                                    id="start_count"></span>
                                            </tr>
                                        </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <label><b>Transaction Id :</b></label>&nbsp; <i class="fa fa-paypal"></i><span
                                                        id="transaction_id"></span>
                                        </tr>

                                        <tr>
                                            <td colspan="2">
                                                <label><b>Payer Email :</b></label>&nbsp; <i class="fa fa-envelop"></i><span
                                                        id="emailID"></span>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" title="close">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- END PAGE CONTENT-->
@endsection

@section('pagescripts')
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
            grid.setAjaxParam("method", "Instant");

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
                            "url": "/admin/orderAjaxHandler" // ajax source

                        },
                        "order": [
                            [1, "desc"]
                        ]// set first column as a default sort by asc
                    }
                });



                // handle group actionsubmit button click

                grid.setAjaxParam("method", "Instant");
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
                grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
                    e.preventDefault();
                    var action = $(".table-group-action-input", grid.getTableWrapper());
                    if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                        grid.setAjaxParam("customActionType", "group_action");
                        grid.setAjaxParam("customActionName", action.val());
                        grid.setAjaxParam("orderId", grid.getSelectedRows());
                        grid.setAjaxParam("method", "Instant");
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

                //main function to initiate the module
                init: function () {

//                    initPickers();
                    handleRecords();
                }

            };


        }();



        $(document).on('click','.filter-cancel',function () {
            grid.setAjaxParam("method", "Instant");
            $('#datatable_ajax').DataTable().ajax.reload();

        });
        // js For Groupbox  chack functionality
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
        // js for extra details functionality
        var order_id;
        var comment_id;
        $(document.body).on('click', '.show-details', function (e) {
            e.preventDefault();
            order_id = $(this).attr('data-id');
            comment_id = $(this).attr('data-id');

            $.ajax({
                url: '/admin/getMoreOrderDetails',
                dataType: 'json',
                type: 'post',
                data: {
                    'order_id': order_id,
                    'comment_id': comment_id,
                },
                success: function (res) {
                    console.log(res);
                    if (res['status'] == 200) {
                        $('#order_url').attr('href', res.userDetails.order_url);
                        $('#order_url').text(res.userDetails.order_url);
                        $('#status').text(res.userDetails.status);
                        $('#start_count').text(res.userDetails.start_count);
                        $('#url_type').text(res.userDetails.url_type);
                        $('#quantity').text(res.userDetails.quantity);
                        $('#end_count').text(res.userDetails.end_count);
                        $('#transaction_id').text(res.userDetails.transaction_id);
                        $('#emailID').text(res.userDetails.payer_email);

//                        $('#subscription_id').text(res.userDetails.subscription_id);
//                        $('#comment_id').text(res.userDetails.comment_id);

//                        var strarray = res.userDetails.comments.split(',');
//                        console.log(strarray);
//                        $('#commentsDiv').html('');
//                        for (var i = 0; i < strarray.length; i++) {
////                            alert(strarray[i])
//                            $('#commentsDiv').append(strarray[i] + '<br>');
//                        }

                    } else {
                        toastr.error(res.msg, {timeOut: 4000});
                    }
                }

            });
        });




        var order_id;
        var comment_id;
        $(document.body).on('click', '.comment_history', function (e) {
            e.preventDefault();
            order_id = $(this).attr('data-id');
            comment_id = $(this).attr('data-id');
            console.log(comment_id, order_id);

            $.ajax({
                url: '/admin/ShowOrderComments',
                dataType: 'json',
                type: 'post',
                data: {
                    'order_id': order_id,
                    'comment_id': comment_id
                },
                success: function (res) {
                    console.log(res);
                    if (res['status'] == 200) {
//                            var m = JSON.parse(res.userDetails.comments), comments = '';
//                            m.forEach(function (val, ind) {
//                                console.log('--------------', val);
//                                $('#comments').append(val + "<br>");
//                            })

                        $('#comments1').text(res.userDetails.comments);
                        var strarray = JSON.parse(res.userDetails.comments.split(','));
                        console.log(strarray);
                        $('#comments1').html('');
                        for (var i = 0; i < strarray.length; i++) {
                            $('#comments1').append(strarray[i] + '<br>');

                        }
//                            $('#myTable').DataTable().ajax.reload();
//                            $('#Comment_history').empty();
                    } else {
                    }
                }

            });
        });
        //
        // $('#comments').click(function () {
        //     $('#commentsDiv').slideToggle("slow");
        // });

    </script>

@endsection
