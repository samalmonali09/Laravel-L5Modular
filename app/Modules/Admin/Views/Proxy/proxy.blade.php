{{--/**--}}
{{--* Created by Monali Samal.--}}
{{--* User: monali samal <monalisamal@globussoft.in>-}}
{{--* Date: 3/9/2018--}}
{{--* Time: 11:15 AM--}}
{{--*/--}}


@extends('Admin::Layouts.adminlayout')
@section('Proxy','active open')
@section('pageheadcontent')

    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.10/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="/GAIA/assets/export/buttons.dataTables.min.css">


    <style>

        #editUserModal input {
            padding: 8px;

        }


    </style>
@endsection

@section('pagecontent')



    <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title" style="color: #074c66">
        Manage Proxy
    </h3>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="/admin/proxyTable">Manage Proxy</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="/admin/proxyTable">Manage Proxy</a>
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
                        <i class="fa fa-shopping-cart"></i>Select
                    </div>
                </div>



                <li>
                    <form action="" method="post" enctype="multipart/form-data">
                        Select text file to upload: <a data-toggle="popover" data-placement="bottom"
                                                       title="INFORMATION"
                                                       data-content="create new text file and save proxies in this format=> 38.102.129.205:21257:michaisola:0vwkjsvhy8"
                                                       style="cursor:pointer;">
                        </a>
                        <input type="file" name="text_file" id="text_file">
                        <input type="submit" value="Upload Proxies" name="uploadTextFile">
                    </form>
                </li>
                <span id="loader_text" hidden>
                            <img src='/GAIA/assets/images/ajax-loading.gif'/>
                        </span>
                <li>
                    <form action="" method="post" enctype="multipart/form-data">
                        Select Excel file to upload:
                        <input type="file" name="excel_file" id="excel_file">
                        <input type="submit" value="Upload Proxies" name="uploadExcelFile">
                    </form>
                </li>
                <span id="loader" hidden>
                            {{--<img src='/GAIA/assets/images/ajax-loading.gif'/>--}}
                        </span>
                <li>
                    <span id="loader" hidden>
                            {{--<img src='/GAIA/assets/images/ajax-loading.gif'/>--}}
                        </span>


            </div>
        </div>

        <a href="/admin/addnewProxy">
            <button class="btn green pull-right" data-toggle="modal"
                    data-target="#addProxy" onclick="resetForm()"><i class="fa fa-plus-circle"></i>
                AddProxy
            </button>
        </a>
        <div class="portlet-body">
            <div class="table-container">

                <table class="table table-responsive table-striped table-bordered table-hover"
                       id="datatable_ajax">
                    <thead>
                    <th width=10%" style="color: #020d10">
                        ID&nbsp;#
                    </th>
                    <th width="10%" style="color: #020c0f">
                        port
                    </th>
                    <th width="10%" style="color: #020c0f">
                        Ip
                    </th>
                    <th width="10%" style="color: #010b0d">
                        username
                    </th>
                    <th width="10%" style="color: #010b0d">
                        password
                    </th>
                    <th width="10%" style="color: #010b0d">
                        No Of Time Used
                    </th>
                    <th width="10%" style="color: #010b0d">
                        Last Excution Time
                    </th>
                    <th width="10%" style="color: #010b0d">
                        last Time used
                    </th>

                    <th width="10%" style="color: #010b0d">
                        working_status
                    </th>
                    <th width="10%" style="color: #010b0d">
                        Delete
                    </th>

                </table>
            </div>
        </div>
    </div>
{{--Modal For ADDProxy --}}
    <div id="addProxyModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title font-green-sharp bold uppercase"><i
                                class="fa fa-plus-circle font-green-sharp"></i>&nbsp;
                        Add Proxy</h4>
                </div>
                <div class="modal-body">
                    <form class="form" role="form" id="addProxyForm">

                        <div class="form-group floating-label">
                            <label class="control-label" for="">IP</label>
                            <input type="text" class="form-control" name="ip" id="ip" placeholder=""
                                   required/>
                        </div>

                        <div class="form-group floating-label">
                            <label class="control-label" for="port">Port</label>
                            <input type="text" class="form-control" name="port" id="port1" placeholder="" required/>
                        </div>
                        <div class="form-group">
                            <div id="radioButton">
                                <input class="proxyType" type="radio" id="privateProxy" name="proxyType"
                                       value="privateProxy" checked>
                                <label for="privateProxy">Private Proxy</label>
                                <input class="proxyType" type="radio" id="publicProxy" name="proxyType"
                                       value="publicProxy">
                                <label for="publicProxy">Public Proxy</label>
                            </div>
                        </div>
                        <div id="usernamePasswordDiv">
                            <div class="form-group floating-label">
                                <label class="control-label" for="">Username</label>
                                <input type="text" class="form-control" name="username" id="username1"
                                       placeholder="" required/>
                            </div>

                            <div class="form-group floating-label">
                                <label class="control-label" for="">Password</label>
                                <input type="text" class="form-control" name="password" id="password1"
                                       placeholder="" required/>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success" id="addProxySubmitButton">
                                Save Changes
                            </button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal" id="closeButton">
                                Close
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- END PAGE CONTENT-->
@endsection
@section('pagescripts')

    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script src="/GAIA/assets/export/dataTables.buttons.min.js"></script>
    <script src="/GAIA/GAIAassets/export/buttons.flash.min.js"></script>
    <script src="/GAIA/assets/export/jszip.min.js"></script>
    <script src="/GAIA/assets/export/pdfmake.min.js"></script>
    <script src="/GAIA/assets/export/vfs_fonts.js"></script>
    <script src="/GAIA/assets/export/buttons.html5.min.js"></script>
    <script src="/GAIA/assets/export/buttons.print.min.js"></script>
    {{--<!-- Bootstrap JavaScript -->--}}
    <script type="text/javascript">

        $(document).ready(function () {
            toastr.options.positionClass = 'toast-top-center';
            toastr.options.progressBar = true;
            toastr.options.preventDuplicates = true;
            toastr.options.closeButton = true;



            $('input[type="search"]').css({'height': '5px'});


            $('#datatable_ajax').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "/admin/databaseProxy",
                "columns": [
                    {data: 'proxy_id', name: 'proxy_id'},
                    {data: 'port', name: 'port'},
                    {data: 'ip', name: 'ip'},
                    {data: 'username', name: 'username'},
                    {data: 'password', name: 'password'},
                    {data: 'proxy_hit_count', name: 'proxy_hit_count'},
                    {data: 'execution_time', name: 'execution_time'},
                    {data: 'last_used_at', name: 'last_used_at'},
                    {data: 'working_status', name: 'working_status'},
                    {data: 'delete', name: 'delete'},


                ],
                dom: 'lBfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                pageLength: 10,
                lengthMenu: [[10, 25, 50, 100, 200, -1], [10, 25, 50, 100, 200, "All"]],
                'rowCallback': function (row, data, index) {
                }
            });



            $(document.body).on('click', '#deleteCommnet', function () {
                var obj = $(this);
                var proxy_id = $(this).attr('data-id');
                console.log(proxy_id);
                var remz = confirm('Are you sure to delete Proxy');
                if (remz) {
                    $.ajax({
                        url: '/admin/deleteProxy',
                        type: 'post',
                        datatype: 'json',
                        data: {
                            proxy_id: proxy_id
                        },
                        success: function (response) {
                            response = $.parseJSON(response);
                            if (response['status'] == '200') {
                                obj.parent().parent().parent().remove();
                            }
                            else {
                                console.log(response.message);
                            }
                        }
                    });
                }
            });

            $('#addProxySubmitButton').on("click", function (event) {
                if ($('#ip').val() == '') {
                    toastr.error("please enter proxy ip address");
                    $('#ip').focus();
                    return false;
                }
                var proxyIpAddress = $('#ip').val();
                if (!(proxyIpAddress.match(/^(?:[0-9]{1,3}\.){3}[0-9]{1,3}$/))) {
                    toastr.options.preventDuplicates = true;
                    toastr.error("please enter a valid IP");
                    $('#ip').focus();
                    return false;
                }

                if ($('#port1').val() == '') {
                    toastr.error("please enter port.");
                    $('#port1').focus();
                    return false;
                }
                if (proxyTypeVal == "privateProxy") {
                    if ($('#username1').val() == '') {
                        toastr.error("please enter username");
                        $('#username1').focus();
                        return false;
                    }
                    if ($('#password1').val() == '') {
                        toastr.error("please enter password");
                        $('#password1').focus();
                        return false;
                    }
                }
                event.preventDefault();
                var Data = $('#addProxyForm').serializeArray();
                $.ajax({
                    url: '/admin/addProxy',
                    type: 'post',
                    data: {
                        formData: Data,
                    },
                    dataType: 'json',
                    success: function (response) {
                        if (response['status'] == 200) {
                            toastr.success(response.message);
                        } else {
                            toastr.error(response.message);
                        }
                        $('#closeButton').click();
                    }
                });
            });

// changeStatus  JS Functionality ...................................
            $(document).on('click', '.changeStatus', function () {
                var obj = $(this);
                var working_status = ($(this).hasClass("btn-success")) ? 'I' : 'A';
                var msg = (working_status == 'I') ? 'Deactivate' : 'Activate';
                var current_element = $(this);
                var messageBox = confirm('Are you sure to status Change ');
                if (messageBox) {
                    $.ajax({
                        url: '/admin/satusProxy',
                        type: 'POST',
                        datatype: 'json',
                        data: {
                            proxy_id: $(current_element).attr('data-id'),
                            working_status: working_status
                        },
                        success: function (response) {
                            response = $.parseJSON(response);
                            if (response['status'] == '200') {
                                if (obj.hasClass('btn-info'))
                                    obj.removeClass('btn-info');

                                if (obj.hasClass('btn-success')) {
                                    obj.removeClass('btn-success');
                                    obj.addClass('btn-danger');
                                    obj.text('Inactive');
                                } else {
                                    obj.removeClass('btn-danger');
                                    obj.addClass('btn-success');
                                    obj.text('Active');
                                }
                                toastr.success(response.message);
                            } else {
                                toastr.error(response.message);
                            }
                        }
                    });
                }
            });
            $('input[name=uploadExcelFile]').click(function (e) {
                e.preventDefault();
                var excelFile = new FormData();
                excelFile.append('excel_file', $('input[name=excel_file]')[0].files[0]);
                $.ajax({
                    beforeSend: function () {
                        $('#loader').show();
                    },
                    complete: function () {
                        $('#loader').hide();
                    },
                    url: '/admin/ProxiesIntoDB',
                    type: 'post',
                    dataType: 'json',
                    data: excelFile,
                    contentType: false,
                    processData: false,
                    success: function (response) {

                        if (response['status'] == 200) {
                            toastr.success(response.message);
                        } else {
                            toastr.info(response.message);
                        }
                    }
                });
            });


            $('input[name=uploadTextFile]').click(function (e) {
                e.preventDefault();
                var textFile = new FormData();
                textFile.append('text_file', $('input[name=text_file]')[0].files[0]);
                $.ajax({
                    beforeSend: function () {
                        $('#loader1').show();
                    },

                    complete: function () {
                        $('#loader1').hide();
                    },

                    url: '/admin/TextFileIntoDB',
                    type: 'post',
                    dataType: 'json',
                    data: textFile,
                    contentType: false,
                    processData: false,
                    success: function (response) {

                        if (response['status'] == 200) {
                            console.log(response);
                            toastr.success(response.message);
                            Datatables();
                        } else {
                            toastr.info(response.message);
                        }
                    }

                });
            });


        });
    </script>


@endsection







