{{--/**--}}
{{--* Created by Monali Samal.--}}
{{--* User: Monali Samal--}}
{{--* Date: 2/23/2018--}}
{{--* Time: 1:10 PM--}}
{{--*/--}}


@extends('Admin::Layouts.adminlayout')
@section('AUTOIG','active open')
@section('Niche','active open')

@section('pageheadcontent')
    <!-- add extra css required for this page only -->

    <link rel="stylesheet" href="/GAIA/assets/datatables/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="/GAIA/assets/datatables/css/dataTables.bootstrap.css"/>
    <link rel="shortcut icon" href="favicon.ico"/>




@endsection


@section('pagecontent')
    <!-- BEGIN PAGE HEADER-->

    <h3 class="page-title" style="color: #0d3625">
        Niche List
    </h3>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="/admin/NicheTable">AUTOIG</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="/admin/NicheTable">Niche List</a>
            </li>
        </ul>

        {{--<p class="onmsg" style="background: #49c6f5;--}}
        {{--padding: 10px;--}}
        {{--color: #fff;--}}
        {{--box-shadow: 0px 0px 5px #000000;--}}
        {{--position: absolute;--}}
        {{--margin-top: -4%;margin-left:1%;"></p>--}}
        <form class="pull-right">
            <p class="onmsg" style="background: #49c6f5;
        display: none;
        padding: 10px;
        color: #fff;
        box-shadow: 0px 0px 5px #000000;
        position: absolute;
        margin-top: -4%;margin-right:1%;"></p>
            {{--<p class="onmsg"></p>--}}
            <label for="flip-checkbox-1">Status</S>:</label>
            <input data-role="flipswitch" name="flip-checkbox-1" id="checkbox" class="make-switch"
                   type="checkbox" value="" <?php echo ($status)?'checked':false?> ></form>
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
                        <i class="fa fa-shopping-cart"></i> Niche Listing
                    </div>
                    <div class="actions">
                        <div style="float: right">
                            <a href="/admin/AddNiche">
                                <button class="btn green pull-right" data-toggle="modal" title="Add Niche"
                                        data-target="#addOrders" onclick="resetForm()"><i class="fa fa-plus-circle"></i>
                                    Add Niche
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-container">
                        {{--<div class="table-actions-wrapper">--}}
                        {{--<span>--}}
                        {{--</span>--}}
                        {{--<select class="table-group-action-input form-control input-inline input-small input-sm">--}}
                        {{--<option value="">Select...</option>--}}
                        {{--<option value="inactive">inactive</option>--}}
                        {{--<option value="active">active</option>--}}

                        {{--</select>--}}
                        {{--<button class="btn btn-sm blue table-group-action-submit"><i class="fa fa-check"></i>--}}
                        {{--</button>--}}
                        {{--</div>--}}

                        <table class="table table-responsive table-striped table-bordered table-hover"
                               id="datatable_ajax">
                            <thead>
                            <tr role="row" class="heading">
                                {{--<th width="5%"><input type="checkbox" id="groupCheckbox"></th>--}}

                                <th width="15%">
                                    Id
                                </th>
                                <th width="20%">
                                    Niche
                                </th>
                                <th width="25%">
                                    Total Account
                                </th>
                                <th width="20%">
                                    Status
                                </th>
                                <th widt="25%">
                                    Actions
                                </th>
                            </tr>
                            <tr role="row" class="filter">
                                {{--<td>--}}

                                {{--</td>--}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" title="search_niche_id"
                                           name="search_niche_id">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" title="search_niche"
                                           name="search_niche">
                                </td>

                                <td>
                                    <input type="text" class="form-control form-filter input-sm" title="search_total_account"
                                           name="search_total_account">
                                </td>

                                <td>
                                    <select name="search_status" class="form-control form-filter input-sm" title="search_status">
                                        <option value="">select...</option>
                                        <option value="0">hide</option>
                                        <option value="1">show</option>
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
    <div id="editUserModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header" style="background: linear-gradient(-45deg, #661422, #66125a); color: #fff;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Niche</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-11">
                            <form id="editProfileForm">
                                <table class="table table-responsive table-hover" id="viewTable">
                                    <tbody>
                                    <tr>
                                        <td colspan="2">
                                            Niche:
                                        </td>
                                        <td colspan="2">
                                            <strong><input type="text" class="form-control" name="niche"
                                                           id="niche" placeholder="niche" required/> </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            Total Account:
                                        </td>
                                        <td colspan="2">
                                            <strong><input type="text" class="form-control" name="total_account"
                                                           id="total_account" placeholder="total_account"
                                                           required/> </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            Status
                                        </td>
                                        <td colspan="2">
                                            <strong><select class="form-control col-md-3" name="status" id="status">
                                                    <option value="0">hide</option>
                                                    <option value="1">show</option>
                                                </select></strong>

                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success  updateGeneralInfo"><span>Save Changes </span>
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
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



    <script src="/GAIA/assets/datatables/js/datatable.js"></script>
    <script src="/GAIA/assets/datatables/js/jquery.dataTables.min.js"></script>
    <script src="/GAIA/assets/datatables/js/dataTables.bootstrap.js"></script>
    <script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>


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
                            "url": "/admin/NicheAjaxHandler" // ajax source
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


            $(document.body).on('click', '.changeStatus', function () {
                var obj = $(this);

                var ButtonStatus = obj.hasClass('label-success') ? '0' : '1';

                if (ButtonStatus=='0') {

                    console.log("button status is clicked");
                    var remz = confirm('Are you sure to changeStatus ');
                    if (remz) {
                        $.ajax({
                            url: '/admin/buttonChangeAjax',
                            dataType: 'json',
                            type: 'post',
                            data: {niche_id: $(this).attr('data-Id'), status: ButtonStatus},
                            success: function (response) {
                                console.log(response);
                                if (response['status'] == 200) {

                                    if (ButtonStatus == 0) {
                                        obj.removeClass('label-success');
                                        obj.addClass('label-danger');
                                        obj.text('hide');
                                    } else {
                                        obj.removeClass('label-danger');
                                        obj.addClass('label-success');
                                        obj.text('show');
                                    }
                                    toastr.success(response.message);

                                } else {

                                }
                            }
                        });
                    }
                }
            });


            var niche_id;
            $(document).on('click', '.editUserdetails', function () {
                console.log(' data Continue --------------------=======================', $(this).attr('data-id'));
                niche_id = $(this).attr('data-id');
                $.ajax({
                    url: '/admin/EditAjaxHandlerNiche',
                    dataType: 'json',
                    type: 'post',
                    data: {niche_id: niche_id},

                    success: function (res) {

                        console.log(res);
                        var userDetails = res.data;
                        if (res['status'] == 200) {

                            $('#niche').val(userDetails.niche);
                            $('#total_account').val(userDetails.total_account);
                            $('#status').val(userDetails.status);
                        } else {
                            toastr.error(res.msg, {timeOut: 4000});
                        }
                    }

                });
            });


            var niche_id;
            $(document).on('click', '.updateGeneralInfo', function () {

                $.ajax({
                    url: '/admin/UpdateAjaxHandelerNiche',
                    dataType: 'json',
                    type: 'post',
                    data: {
                        'niche': $('#niche').val(),
                        'total_account': $('#total_account').val(),
                        'status': $('#status').val(),
                        'niche_id': niche_id,
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
                var niche_id = $(this).attr('data-id');
                console.log(niche_id);
                var remz = confirm('Are you sure to delete Niche');
                if (remz) {
                    $.ajax({
                        url: '/admin/deleteAjaxHandlerNiche',
                        type: 'post',
                        datatype: 'json',
                        data: {
                            niche_id: niche_id
                        },
                        success: function (response) {
                            response = $.parseJSON(response);

                            if (response['status'] == '200') {
                                // toastr.success(res.message);

                                obj.parent().parent().parent().remove();
                            }
                            else {
                                console.log(response.message);
                            }
                        }
                    });
                }
            });


            // CKEDITOR.replace('summary-ckeditor');
            $('.onmsg').hide();
            if ($("#checkbox").val() == 'ON') {
                $('#checkbox').prop('checked', true);
            }


            $('#checkbox').on('switchChange.bootstrapSwitch', function (e, data) {

                var niche_id = '';


                var message = ''

                if (this.checked) {
                    message = 'ON'
                    $('.onmsg').show();
                    setTimeout(function () {
                        $('.onmsg').hide();
                    }, 2000)
                    $(".onmsg").html("<b>pop-up</b> will be displayed in app ");
                    console.log('++++++++++++')
                    niche_id = 1;

                } else {
                    console.log('______________')
                    message = 'OFF'
                    $('.onmsg').show();
                    setTimeout(function () {
                        $('.onmsg').hide();
                    }, 2000)
                    niche_id = 0;
                    $(".onmsg").html("app will OFF  <b>pop-up</b>");

                }
                $.ajax({
                    url: '/admin/switchActionAjax',
                    dataType: 'json',
                    type: 'post',
                    data: {
                        niche_id: niche_id

                    },
                    success: function (response) {


                        if (response['status'] == '200') {

                            $('#datatable_ajax').DataTable().ajax.reload();
                        }
                        else {
                            console.log(response.message);
                        }

                    }
                })
            });


        });

    </script>

@endsection
