








<?php $__env->startSection('INSTASTAT','active open'); ?>
<?php $__env->startSection('Instgram','active open'); ?>

<?php $__env->startSection('pageheadcontent'); ?>
    <!-- add extra css required for this page only -->

    <link rel="stylesheet" href="/GAIA/assets/datatables/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="/GAIA/assets/datatables/css/dataTables.bootstrap.css"/>
    <link rel="stylesheet" href="font-awesome-animation.min.css">
    <link rel="stylesheet" href=" 	font-awesome-animation.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome-animation/0.2.1/font-awesome-animation.min.css">
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
        Instagram  Details
    </h3>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="/admin/instagramTable">InstaStats</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="/admin/instagramTable">Instagram Profile</a>
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
                        <i class="fa fa-instagram"></i>Instagram Profile
                    </div>
                    <div class="actions">
                        <div style="float: right">
                            
                            <a href="/admin/NewAccount">
                            <button class="btn green pull-right" data-toggle="modal"
                            data-target="#addOrders" onclick="resetForm()"><i class="fa fa-plus-circle"></i>
                             Add Instagram
                            </button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">

                    <div class="table-container">
                        <div class="portlet-body">

                            <div class="table-container">
                                <table class="table table-responsive table-striped table-bordered table-hover"
                                       id="datatable_ajax">
                                    <thead>
                                    <tr role="row" class="heading">
                                        
                                        <th width=10%" style="color: #020d10">
                                            id
                                        </th>
                                        <th width="25%" style="color: #020c0f">
                                            Account Username
                                        </th>
                                        <th width="25%" style="color: #010b0d">
                                            proxy_ip
                                        </th>
                                        <th width="25%" style="color: #010b0d">
                                            proxy_port
                                        </th>
                                        <th width="15%" style="color: #010b0d">
                                            Login Session
                                        </th>
                                    
                                    
                                    

                                    <tr role="row" class="filter">
                                        

                                        
                                        <td>
                                            <input type="text" class ="form-control form-filter input-sm" title="search_instagram_accounts_id"
                                                   name="search_instagram_accounts_id">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-filter input-sm" title="search_account_username"
                                                   name="search_account_username">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-filter input-sm" title="search_proxy_ip"
                                                   name="search_proxy_ip">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-filter input-sm" title="search_proxy_port"
                                                   name="search_proxy_port ">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-filter input-sm" title="search_account_session_details" disabled
                                                   name="search_account_session_details">
                                            <button class="btn btn-xs yellow filter-submit margin-bottom" title="search"><i
                                                        class="fa fa-search"></i>
                                            </button>
                                            <button class="btn btn-xs red filter-cancel" title="refresh"><i class="fa fa-refresh"></i>
                                            </button>
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
                            "url": "/admin/InstagramAjaxHandeler" // ajax source
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
                        ]/// set first column as a default sort by asc
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
                        grid.setAjaxParam("instagram_accounts_id", grid.getSelectedRows());
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

        // $(document).ready(function () {
        //     $('#groupCheckbox').click(function () {
        //         if (this.checked) {
        //             console.log("grp checkbox is already checked");
        //             $('.orderCheckBox').each(function () {
        //                 this.checked = true;
        //                 $(this).parent().addClass('checked');
        //             });
        //         } else {
        //             console.log("not checked");
        //             $('.orderCheckBox').each(function () {
        //                 this.checked = false;
        //                 $(this).parent().removeClass('checked');
        //             });
        //         }
        //     });
        //
        //
        //
        // });

    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin::Layouts.adminlayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>