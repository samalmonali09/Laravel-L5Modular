@extends('Admin::Layouts.adminlayout')
@section('Proxy3','active open')
@section('pageheadcontent')
    <link rel="stylesheet" type="text/css" href="/GAIA/assets/export/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.10/css/jquery.dataTables.css">


@endsection

@section('pagecontent')
    <h1 class="page-title">Manage Proxies</h1>
    <div class="row" style="min-height:470px;">

        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title" style="padding-top:0.6%;">Proxy Configuration</h3>
                    <div class="panel-tool-options" style="margin-top: 20px;">

                    </div>
                </div>

                <div class="panel-body" style="margin-top:10px;">
                    <div class="form-group">
                        <label class="control-label col-md-3">Active Proxy Source</label>
                        <div class="col-md-9">
                            <div class="margin-bottom-10 col-md-3">
                                <label for="option1">Database Proxies</label>
                                <input id="option1" type="radio" name="radio1" value="1"
                                       class="make-switch switch-radio1"
                                       @if(isset($proxyConfig) && $proxyConfig['proxy_option'] == 1) checked @endif>
                            </div>
                            <div class="margin-bottom-10 col-md-3">
                                <label for="option2">Data Center IP</label>
                                <a data-toggle="popover" data-placement="right" title=""
                                   data-trigger="hover"
                                   data-content="luminati.io"
                                   style="cursor:pointer;"><i class="fa fa-question-circle"></i>
                                </a>
                                <input id="option2" type="radio" name="radio1" value="2"
                                       class="make-switch switch-radio1"
                                       @if(isset($proxyConfig) && $proxyConfig['proxy_option'] == 2) checked @endif>
                                {{--<span style="cursor:pointer;" class="" id="luminatiSettings">&nbsp;&nbsp;&nbsp;&nbsp; <i--}}
                                {{--class="fa fa-cog"--}}
                                {{--style="font-size:20px; margin-top: 11px; position: absolute;"></i></span>--}}
                            </div>
                            <div class="margin-bottom-10 col-md-3">
                                <label for="option3">Residential IP</label>
                                <a data-toggle="popover" data-placement="right" title=""
                                   data-trigger="hover"
                                   data-content="luminati.io"
                                   style="cursor:pointer;"><i class="fa fa-question-circle"></i>
                                </a>
                                <input id="option3" type="radio" name="radio1" value="3"
                                       class="make-switch switch-radio1"
                                       @if(isset($proxyConfig) && $proxyConfig['proxy_option'] == 3) checked @endif>
                                {{--<span style="cursor:pointer;" class="" id="luminatiSettings">&nbsp;&nbsp;&nbsp;&nbsp; <i--}}
                                {{--class="fa fa-cog"--}}
                                {{--style="font-size:20px; margin-top: 11px; position: absolute;"></i></span>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title" style="padding-top:0.6%;">Proxy Lists</h3>

                    <div class="panel-tool-options" style="margin-top: 20px;">
                        <div class="col-md-4 pull-left">
                             <span id="Loader1" hidden>
                            <img src='/assets/images/ajax-loading.gif'/>
                        </span>
                            <form action="" method="post" enctype="multipart/form-data">
                                Select text file to upload: <a data-toggle="popover" data-placement="bottom"
                                                               title="INFORMATION"
                                                               data-content="create new text file and save proxies in this format=> 38.102.129.205:21257:michaisola:0vwkjsvhy8"
                                                               style="cursor:pointer;">
                                </a>
                                <input type="file" name="text_file" id="text_file">
                                <input type="submit" value="Upload Proxies" name="uploadTextProxies"
                                       style="margin-top: 10px;">
                            </form>


                        </div>
                        <div class="col-md-4 pull-left">
                              <span id="Loader" hidden>
                            <img src='/assets/images/ajax-loading.gif'/>
                        </span>
                            <form action="" method="post" enctype="multipart/form-data col-md-6 pull-left">
                                Select Excel file to upload:
                                <input type="file" name="excel_file" id="excel_file">
                                <input type="submit" value="Upload Proxies" name="uploadExcelProxy"
                                       style="margin-top: 10px;">
                            </form>


                        </div>
                        <div class="col-md-4 pull-left" id="sel">
                            {{--<div class="table-group-actions pull-right">--}}
                            <button class="btn btn-primary delete_all" style="margin-top: 20px;"
                                    data-url="{{ url('myproductsDeleteAll') }}">Delete All Selected
                            </button>
                            <button id="addRow" class="btn btn-success btn-raised" data-toggle="modal"
                                    style="color: #0c3b5b;margin-top: 20px;" data-target="#addProxyModal"><i
                                        class="fa fa-plus-circle"></i> Add
                                Proxy
                            </button>
                        </div>
                    </div>
                </div>
                <div class="panel-body" style="margin-top:10px;">
                    <div class="table-responsive">
                        <table id="DataTable"
                               class="table table-striped table-bordered table-hover dataTables-example"

                               style="margin-top:2%;">
                            <thead style="color: #020200">
                            <tr>
                                <th width="50px"><input type="checkbox" id="master"></th>
                                <th>ID</th>
                                <th>IP</th>
                                <th>Port</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>No. of times used</th>
                                <th>Last execution time(secs)</th>
                                <th>Last used at</th>
                                <th>Status</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Modal for AddProxies-->
    <div id="addProxyModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-header" style="background: #4989bc; color: #fff;text-align: center;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Add Proxy</h4>
                    </div>

                </div>
                <div class="modal-body">
                    <form class="form" role="form" id="AddNewProxy">

                        <div class="form-group floating-label">
                            <label class="control-label" for="">IP</label>
                            <input type="text" class="form-control" name="ip" id="ip" placeholder=""
                                   required/>
                        </div>

                        <div class="form-group floating-label">
                            <label class="control-label" for="port">Port</label>
                            <input type="text" class="form-control" name="port" id="port" placeholder="" required/>
                        </div>
                        <div class="form-group">
                            <div id="radioButton">
                                <input class="proxyTypeField" type="radio" id="privateProxy" name="proxyType"
                                       value="privateProxy" checked>
                                <label for="privateProxy">Private Proxy</label>
                                <input class="proxyTypeField" type="radio" id="publicProxy" name="proxyType"
                                       value="publicProxy">
                                <label for="publicProxy">Public Proxy</label>
                            </div>
                        </div>
                        <div id="privateProxyButtonHide">
                            <div class="form-group floating-label">
                                <label class="control-label" for="">Username</label>
                                <input type="text" class="form-control" name="username" id="username"
                                       placeholder="" required/>
                            </div>

                            <div class="form-group floating-label">
                                <label class="control-label" for="">Password</label>
                                <input type="text" class="form-control" name="password" id="password"
                                       placeholder="" required/>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success" id="SubmitButton">
                                Save Changes
                            </button>
                            <button type="button" class="btn btn-warning" data-dismiss="modal" id="closeButton">
                                <i class="fa fa-arrow-circle-left"></i> Back To Proxy
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

    {{--<div id="selectLuminatiOpt" class="modal fade" tabindex="-1" role="dialog">--}}
    {{--<div class="modal-dialog">--}}
    {{--<div class="modal-content">--}}
    {{--<div class="modal-header" style="background: linear-gradient(-45deg, #7b4397, #69b1dc); color: #fff;">--}}
    {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span--}}
    {{--aria-hidden="true">&times;</span></button>--}}
    {{--<h4 class="modal-title" style="font-size: 17px;">Select Luminati Option <i--}}
    {{--class="fa fa-check-circle"--}}
    {{--aria-hidden="true"--}}
    {{--style=" color: #ffc000; font-size: 22px; margin-top: 10px;"></i>--}}
    {{--</h4>--}}
    {{--</div>--}}
    {{--<div class="modal-body">--}}
    {{--<div class="row">--}}
    {{--<div class="col-md-12">--}}
    {{--<legend>Zone <a data-toggle="popover" data-placement="right" title="Info"--}}
    {{--data-trigger="hover"--}}
    {{--data-content="Fetching media script will run through the selected zone proxies."--}}
    {{--style="cursor:pointer;"><i class="fa fa-question-circle"></i>--}}
    {{--</a></legend>--}}
    {{--<fieldset id="radioHtml">--}}
    {{--<label for="radio-1">Data Center IP</label>--}}
    {{--<input type="radio" name="radio-1" id="radio-1" checked>--}}
    {{--<label for="radio-2">Residential IP</label>--}}
    {{--<input type="radio" name="radio-1" id="radio-2">--}}
    {{--</fieldset>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="modal-footer" style="background-color: #557386">--}}
    {{--<button type="button" class="btn btn-danger" data-dismiss="modal" id="exit">Exit</button>--}}
    {{--<button type="button" class="btn btn-success" id="save">Save</button>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<!-- /.modal-content -->--}}
    {{--</div>--}}
    {{--<!-- /.modal-dialog -->--}}
    {{--</div>--}}
@endsection


@section('pagescripts')
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.10/js/jquery.dataTables.js"></script>
    {{--<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>--}}
    <script src="/GAIA/assets/export/dataTables.buttons.min.js"></script>
    <script src="/GAIA/GAIAassets/export/buttons.flash.min.js"></script>
    <script src="/GAIA/assets/export/jszip.min.js"></script>
    <script src="/GAIA/assets/export/pdfmake.min.js"></script>
    <script src="/GAIA/assets/export/vfs_fonts.js"></script>
    <script src="/GAIA/assets/export/buttons.html5.min.js"></script>
    <script src="/GAIA/assets/export/buttons.print.min.js"></script>

    <script>
        $(document).ready(function () {
            $('[data-toggle="popover"]').popover();


            $('#luminatiSettings').click(function () {
                $('#selectLuminatiOpt').modal("show");
            });

            $(".bootstrap-switch").click(function () {
                let proxy_type = $('input[name="radio1"]:checked').val();
                $.ajax({
                    url: '/saveProxyConfiguration',
                    data: {proxy_type: proxy_type},
                    dataType: 'json',
                    type: 'get',
                    success: function (response) {
                        toastr.options.positionClass = "toast-top-center";
                        toastr.options.preventDuplicates = true;
                        toastr.options.closeButton = true;
                        if (response['status'] == 200) {
                            toastr.success(response.message);
                        } else
                            toastr.success(response.message);
                    }
                });

            });

            // $("input[name='radio1']").bootstrapSwitch({});


            // $('#save').click(function () {
            //     $.ajax({
            //         url: '',
            //         data: '',
            //         dataType: 'json',
            //         type: 'get',
            //         success: function () {
            //
            //
            //         }
            //     });
            // });

            var grid;
            var TabelDetails = function () {
                grid = $('#DataTable').DataTable({
                    processing: true,
                    destroy: true,
                    serverSide: true,
                    ajax: '/admin/ProxiesAjaxDatables',
                    columns: [
                        {data: 'check', name: 'check', orderable: false, searchable: false},
                        {data: 'proxy_id', name: 'proxy_id'},
                        {data: 'ip', name: 'ip'},
                        {data: 'port', name: 'port'},
                        {data: 'username', name: 'username'},
                        {data: 'password', name: 'password'},
                        {data: 'proxy_hit_count', name: 'proxy_hit_count'},
                        {data: 'execution_time', name: 'execution_time'},
                        {data: 'last_used_at', name: 'last_used_at'},
                        {data: 'working_status', name: 'working_status'},
                        {data: 'delete', name: 'delete'},
                    ],
                    order: [[1, 'desc']],

                    dom: 'lBfrtip',
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ],
                    pageLength: 10,
                    lengthMenu: [[10, 25, 50, 100, 200, -1], [10, 25, 50, 100, 200, "All"]],
                    'rowCallback': function (row, data, index) {

//                        if (data.executionTime > 2) {
//                            $(row).find('td:eq(2)').parent().css('background-color', 'lightgoldenrodyellow');
//                        }
////                        console.log($(row).find('td:eq(8)').text());
//                        if ($(row).find('td:eq(8)').text() == 'Inactive') {
//                            $(row).find('td:eq(2)').parent().css('background-color', 'pink');
//
//                        }
                    }

                });

            };

            TabelDetails();

            $('input[name=uploadExcelProxy]').click(function (e) {
                e.preventDefault();
                var excelFile = new FormData();
                excelFile.append('excel_file', $('input[name=excel_file]')[0].files[0]);
                $.ajax({
                    beforeSend: function () {
                        $('#Loader').show();
                    },
                    complete: function () {
                        $('#Loader').hide();
                    },
                    url: '/admin/ProxiesIntoDB',

                    type: 'post',
                    dataType: 'json',
                    data: excelFile,
                    contentType: false,
                    processData: false,
                    success: function (res) {

                        if (res['status'] == 200) {
                            toastr.success(res.message);
                            // $('#DataTable').DataTable().ajax.reload();
                            $('#excel_file').css('display', 'none');


                            TabelDetails();
                        } else {
                            toastr.info(res.message);
                        }
                    }

                });
            });

            $('input[name=uploadTextProxies]').click(function (e) {
                e.preventDefault();
                var textFile = new FormData();
                textFile.append('text_file', $('input[name=text_file]')[0].files[0]);
                $.ajax({
                    beforeSend: function () {
                        $('#Loader1').show();
                    },
                    complete: function () {
                        $('#Loader1').hide();
                    },
                    url: '/admin/TextFileIntoDB',
                    type: 'post',
                    dataType: 'json',
                    data: textFile,
                    contentType: false,
                    processData: false,
                    success: function (response) {

                        if (response['status'] == 200) {
                            // $('#text_file').parent().removeClass('file');
                            $('#text_file').css('display', 'none');


                            toastr.success(response.message);


                            TabelDetails();
                        } else {
                            toastr.info(response.message);
                        }
                    }

                });
            });

            //change the status of proxy (active /inactive proxy)
            $(document).on('click', '.changeStatus', function () {
                var obj = $(this);
                var status = ($(this).hasClass("btn-success")) ? 'I' : 'A';
                //            document.write(status);die;
                var msg = (status == 'I') ? 'Deactivate' : 'Activate';
                var current_element = $(this);

                var messageBox = confirm('Are you sure to status Change ');
                if (messageBox) {

                    $.ajax({
                        url: '/admin/changeProxyStatusAjaxHandler',
                        type: 'POST',
                        datatype: 'json',
                        data: {
                            id: $(current_element).attr('data-id'),
                            status: status
                        },
                        success: function (response) {
                            response = $.parseJSON(response);
                            if (response['status'] == '200') {
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
                                grid.ajax.reload(null, false);

                            } else {
                                toastr.error(response.message);
                            }
                        }
                    });
                }
            });

            setInterval(function () {
                grid.ajax.reload(null, false);
            }, 60000);

        });
    </script>

    <script>
        //        var proxyTypeVal;
        $(document).ready(function () {
            proxyTypeVal = $('.proxyTypeField').val();
            toastr.options.positionClass = "toast-top-center";
            toastr.options.preventDuplicates = true;
            toastr.options.closeButton = true;
            toastr.options.progressBar = true;


            $(document.body).on('keypress', '#ip', function (e) {
                if (e.which != 8 && e.which != 0 && e.which != 46 && (e.which < 48 || e.which > 57)) {
                    toastr.options.preventDuplicates = true;
                    //display error message
                    toastr.error('Please enter integer value only.', {timeOut: 3000});
                    $(this).focus();
                    return false;
                }
            });

            $(document.body).on('keypress', '#port', function (e) {
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                    toastr.options.preventDuplicates = true;
                    //display error message
                    toastr.error('Please enter integer value only.', {timeOut: 3000});
                    $(this).focus();
                    return false;
                }
            });

            //add Proxies to the grid
            $('#SubmitButton').on("click", function (event) {
                if ($('#ip').val() == '') {
                    toastr.error("Please enter a valid  ip address");
                    $('#ip').focus();
                    return false;
                }
                var proxyIpAddress = $('#ip').val();
                if (!(proxyIpAddress.match(/^(?:[0-9]{1,3}\.){3}[0-9]{1,3}$/))) {
                    toastr.options.preventDuplicates = true;
                    toastr.error("Please enter a valid Ip code");
                    $('#ip').focus();
                    return false;
                }

                if ($('#port').val() == '') {
                    toastr.error("please enter port.");
                    $('#port').focus();
                    return false;
                }

                if (proxyTypeVal == "privateProxy") {
                    if ($('#username').val() == '') {
                        toastr.error("please enter username");
                        $('#username').focus();
                        return false;
                    }
                    if ($('#password').val() == '') {
                        toastr.error("please enter password");
                        $('#password').focus();
                        return false;
                    }
                }
                event.preventDefault();
                var formData = $('#AddNewProxy').serializeArray();
                $.ajax({
                    url: '/admin/addProxy',
                    type: 'post',
                    data: {
                        formData: formData,
                    },
                    dataType: 'json',
                    success: function (response) {
                        if (response['status'] == 200) {
                            toastr.success(response.message);
                            $('#DataTable').DataTable().ajax.reload();
                            $('#closeButton').click();
                        } else {
                            toastr.error(response.message);
                        }
                    }
                });
            });

            //Delete proxy details from the table
            $(document.body).on('click', '.deleteProxy', function () {
                var obj = $(this);
                var proxyId = $(this).attr('data-pid');
                var messageBox = confirm('Are you sure want to delete ? ');
                if (messageBox) {
                    $.ajax({
                        url: '/admin/deleteProxyAjaxHandler',
                        type: 'post',
                        dataType: 'json',
                        data: {proxyId: proxyId},
                        success: function (response) {
                            if (response['status'] == 200) {
                                obj.parent().parent().remove();
                                toastr.success(response.msg);
                            }
                            else
                                toastr.error(response.msg);

                        }

                    });
                }
            });


            $(document).ready(function () {
                $('#addProxyModal').on('hidden.bs.modal', function (e) {
                    $('#ip').val('');
                    $('#port').val('');
                    $('#username').val('');
                    $('#password').val('');
                    $('#radioButton').val('');
                });

            });


            //Hide Username and Password field , if proxyType is public
            $('#privateProxyButtonHide').show();
            $(document.body).on('click', '.proxyTypeField', function () {
                if ($(this).val() == "publicProxy") {
                    $('#privateProxyButtonHide').hide();
                    proxyTypeVal = "publicProxy";
                } else {
                    $('#privateProxyButtonHide').show();
                    proxyTypeVal = "privateProxy";
                }
            });


            $('#master').on('click', function (e) {

                if ($(this).is(':checked', true)) {
                    $(".sub_chk").prop('checked', true);

                } else {

                    $(".sub_chk").prop('checked', false);

                }

            });
            //Delete Daata

            $('.delete_all').on('click', function (e) {
                var allVals = [];
                $(".sub_chk:checked").each(function () {
                    allVals.push($(this).attr('data-id'));
                });

                console.log('---------all values ---------', allVals);


                if (allVals.length <= 0) {
                    alert("Please select row.");
                } else {
                    var check = confirm("Are you sure you want to delete this row?");
                    if (check == true) {
                        var join_selected_values = allVals.join(",");

                        // console.log(join_selected_values);
                        // return false;

                        $.ajax({

                            url: '/admin/myproductsDeleteAll',
                            type: 'post',
                            data: 'proxy_id=' + join_selected_values,
                            success: function (data) {
                                if (data['success']) {
                                    $(".sub_chk:checked").each(function () {
                                        $(this).parents("tr").remove();


                                        // obj.parent().parent().remove();

                                    });
                                    $('#DataTable').DataTable().ajax.reload();
                                    $('#master').parent().removeClass('checked');


                                    alert(data['success']);
                                } else if (data['error']) {

                                    alert(data['error']);

                                } else {

                                    alert('Whoops Something went wrong!!');
                                }
                            },
                            error: function (data) {

                                alert(data.responseText);
                            }

                        });
                        $.each(allVals, function (index, value) {

                            $('table tr').filter("[data-row-id='" + value + "']").remove();
                        });
                    }
                }
            });


            // $('[data-toggle=confirmation]').confirmation({
            //
            //     rootSelector: '[data-toggle=confirmation]',
            //
            //     onConfirm: function (event, element) {
            //
            //         element.trigger('confirm');
            //     }
            // });


        });
    </script>
@endsection