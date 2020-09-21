








<?php $__env->startSection('GILR','active open'); ?>
<?php $__env->startSection('GILRMTH','active open'); ?>
<?php $__env->startSection('pageheadcontent'); ?>
    <!-- add extra css required for this page only -->

    <link rel="stylesheet" href="/GAIA/assets/datatables/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="/GAIA/assets/datatables/css/dataTables.bootstrap.css"/>
    <link rel="stylesheet" type="text/css"
          href="GAIA/assets/dataTables/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
    <style>
        .link-width {
            max-width: 140px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .passwordData {
            display: none
        }
    </style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('pagecontent'); ?>
    <!-- BEGIN PAGE HEADER-->

    <h3 class="page-title" style="color: #0d3625">
        Manage Transaction
    </h3>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="/admin/manageTransaction/GILR">Get Instant Likes RU</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="/admin/manageTransaction/GILR">Manage Transaction</a>
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
                        <i class="fa fa-shopping-cart"></i>Transaction Listing
                    </div>
                    <div class="actions">

                        <div style="float: right">
                            <a href="/admin/addtransaction">

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

                                </div>
                                <table class="table table-responsive table-striped table-bordered table-hover"
                                       id="datatable_ajax">
                                    <thead>
                                    <tr role="row" class="heading">
                                        

                                        <th width="14.2%">
                                            Id
                                        </th>
                                        <th width="14.2%">
                                            Payer Email
                                        </th>
                                        <th width="14.2%">
                                            Email
                                        </th>
                                        <th width="14.2%">
                                            Transaction Id
                                        </th>

                                        <th width="14.2%">
                                            Amount
                                        </th>

                                        <th width="14.2%">
                                            Payment Time
                                        </th>
                                        <th width="14.2%">
                                            Payment Status
                                        </th>


                                    </tr>
                                    <tr role="row" class="filter">
                                        

                                        
                                        <td>
                                            <input type="text" class="form-control form-filter input-sm"
                                                   title="search_tx_id"
                                                   name="search_tx_id">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-filter input-sm"
                                                   title="search_payer_email"
                                                   name="search_payer_email">
                                        </td>

                                        <td>
                                            <input type="text" class="form-control form-filter input-sm"
                                                   title="search_email"
                                                   name="search_email">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-filter input-sm"
                                                   title="search_transaction_id"
                                                   name="search_transaction_id">
                                        </td>
                                        <td>
                                            <div class="margin-bottom-5">
                                                <input type="text" class="form-control form-filter input-sm"
                                                       title="search_amount_from"
                                                       name="search_amount_from" placeholder="From"/>
                                            </div>
                                            <input type="text" class="form-control form-filter input-sm"
                                                   title="search_amount_to"
                                                   name="search_amount_to" placeholder="To"/>
                                        </td>

                                        <td>
                                            <input type="text" class="form-control form-filter input-sm"
                                                   title="search_payment_time" disabled
                                                   name="search_payment_time">
                                        </td>

                                        <td>
                                            <select name="search_payment_status"
                                                    class="form-control form-filter input-sm"
                                                    title="search_payment_status">
                                                <option value="">select...</option>
                                                <option>success</option>
                                                <option>Completed</option>
                                            </select>

                                            <div class="margin-bottom-5">
                                                <button class="btn btn-xs yellow filter-submit margin-bottom"
                                                        title="search"><i
                                                            class="fa fa-search"></i>
                                                </button>
                                                <button class="btn btn-xs red filter-cancel" title="refresh"><i
                                                            class="fa fa-refresh"></i>
                                                </button>
                                            </div>

                                            <input type="text" class="form-control form-filter input-sm"
                                                   name="method" value="GILR" style="display: none;">
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

            
            <div id="showDetails" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" style="margin: 5% 18%;">
                    <div class="modal-content">
                        <div class="modal-header"

                             style="background: #1e4f66; color: #fff;text-align: center;">

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">More Transaction Details</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-responsive table-hover" id="viewTable">
                                        <tbody>
                                        <tr>
                                            <td colspan="2">
                                                <label> <b>Tx Type: </b></label>&nbsp; <i
                                                        class="fa fa-hand-o-right"></i><span
                                                        id="tx_type"></span>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <label> <b>Payer Email: </b></label>&nbsp;<i class="fa fa-paypal"></i>
                                                <span
                                                        id="payer_email"></span>

                                            </td>
                                        </tr>
                                        
                                        
                                        

                                        
                                        <tr>
                                            <td colspan="2">
                                                <label><b>Order Url:</b>&nbsp;&nbsp;&nbsp;&nbsp;</label><a
                                                        class="btn btn-xs default text-case link-width order_url"
                                                        href="https://instagram.com/" target="_blank"><i
                                                            style="font-size:10px"></i>&nbsp;&nbsp;</a><span
                                                        id="order_url"></span>
                                            </td>
                                        </tr>


                                        <tr>

                                        </tr>
                                        <tr>
                                        
                                        
                                        
                                        
                                        
                                        
                                            
                                                
                                                        
                                            
                                        
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <label><b>Pending Reason :</b></label>&nbsp; <span
                                                        id="pending_reason"></span>
                                            </td>
                                        </tr>
                                        </tr>
                                        <tr>

                                        <tr>
                                            <td colspan="2">
                                                <label><b>Item Desc : </b></label>&nbsp; <span id="item_desc"></span>
                                            </td>
                                        </tr>
                                        </td>
                                        </tr>
                                        <tr>
                                        
                                        
                                        
                                        <tr>
                                            <td colspan="2">
                                                <label><b>Payment Status : </b></label>&nbsp; <span
                                                        id="payment_status"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            
                                                
                                                        
                                            
                                        </tr>
                                        </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            
                            <button type="button" class="btn btn-danger" data-dismiss="modal" title="Close">Close</button>
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
            grid.setAjaxParam("method", "GILR");
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



                        "columnDefs": [
                            {orderable: true, targets: 0},
                            // {orderable: false, targets: -1}
                        ],
                        "lengthMenu": [
                            [10, 20, 50, 100, 150, -1],
                            [10, 20, 50, 100, 150, "All"] // change per page values here
                        ],
                        "pageLength": 10, // default record count per page
                        "ajax": {
                            "url": "/admin/TransactionAjaxHandeler" // ajax source

                        },
                        "order": [
                            [1, "desc"]
                        ]// set first column as a default sort by asc
                    }
                });


                // handle group actionsubmit button click
                grid.setAjaxParam("method", "GILR");
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
                grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
                    e.preventDefault();
                    var action = $(".table-group-action-input", grid.getTableWrapper());
                    if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                        grid.setAjaxParam("customActionType", "group_action");
                        grid.setAjaxParam("customActionName", action.val());
                        grid.setAjaxParam("id", grid.getSelectedRows());
                        grid.setAjaxParam("method", "GILR");
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

                //main function to initiate the module
                init: function () {

//                    initPickers();
                    handleRecords();
                }

            };


        }();


        $(document).on('click', '.filter-cancel', function () {
            grid.setAjaxParam("method", "GILR");
            $('#datatable_ajax').DataTable().ajax.reload();

        })


        // $('#groupCheckbox').click(function () {
        //     if (this.checked) {
        //         console.log("grp checkbox is already checked");
        //         $('.orderCheckBox').each(function () {
        //             this.checked = true;
        //             $(this).parent().addClass('checked');
        //
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


        var order_id;
        var tx_id;
        $(document.body).on('click', '.show-details', function (e) {
            e.preventDefault();
            order_id = $(this).attr('data-id');
            tx_id = $(this).attr('data-id');
            $.ajax({
                url: '/admin/getMoreTransactionDetails',
                dataType: 'json',
                type: 'post',
                data: {
                    'order_id': order_id,
                    'tx_id': tx_id,
                },
                success: function (res) {
                    console.log(res);
                    if (res['status'] == 200) {
                        // $('#autolikes_id').text(res.userDetails.autolikes_id === null ? 'no data available' : res.userDetails.autolikes_id);
                        $('#payer_email').text(res.userDetails.payer_email);
                        // $('#amount1').text(res.userDetails.amount);
                        $('#payment_status').text(res.userDetails.payment_status);
                        $('#tx_type').text(res.userDetails.tx_type);
                        $('.order_url').text(res.userDetails.order_url);
                        $('.order_url').attr('href', res.userDetails.order_url);
                        $('#item_desc').text(res.userDetails.item_desc === null ? 'no data available' : res.userDetails.item_desc);
                        $('#pending_reason').text(res.userDetails.pending_reason === null ? 'no data available' : res.userDetails.pending_reason);

//                         $('#extra_details').text(res.userDetails.extra_details === null ? 'no data available' : res.userDetails.extra_details);
//                         var strarray = res.userDetails.extra_details.split(',');
//                         console.log(strarray);
//                         $('#extra_details').html('');
//                         for (var i = 0; i < strarray.length; i++) {
// //                            alert(strarray[i])
//                             $('#extra_details').append(strarray[i] + '<br>');
//                         }
                    } else {
                        // toastr.error(res.msg, {timeOut: 4000});
                    }
                }

            });
        });


    </script>



<?php $__env->stopSection(); ?>


<?php echo $__env->make('Admin::Layouts.adminlayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>