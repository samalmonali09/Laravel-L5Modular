{{--/**--}}
{{--* Created by Monali Samal--}}
{{--* User: Monali Samal<monaliSamal@globussoft.in>--}}
{{--* Date: 3/12/2018--}}
{{--* Time: 11:55 AM--}}
{{--*/--}}


@extends('Admin::Layouts.adminlayout')

@section('Proxy','active open')

@section('pagecontent')
    <h1 class="page-title" style="color:#06738b">Add Proxy</h1>
    <div class="row" style="min-height:470px;">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    {{--<h2 class="panel-title" style="color:greenyellow;">Add Users</h2>--}}
                </div>
                <div class="panel-body" style="color: #030307">

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form class="form" role="form" method="post" action="/admin/addnewProxy">


                        <div class="form-group floating-label">
                        <label for="demo1" style="color: black">Ip</label>
                        <input class="form-control" id="demo1" type="text" name="ip" required
                        value="{{old('ip')}}">

                        <div class="error" style="color:red">{{ $errors->first('ip') }}</div>

                        </div>
                        <div class="form-group floating-label">
                        <label for="demo1"style="color: black">Port</label>
                        <input class="form-control" id="demo1" type="port" name="port" required
                        value="{{old('port')}}">

                        <div class="error" style="color:red">{{ $errors->first('port') }}</div>
                        </div>

                        {{--<div class="form-group floating-label">--}}
                        {{--<label for="demo1"style="color: black">Username</label>--}}
                        {{--<input class="form-control" id="demo1" type="username" name="username"--}}
                        {{--value="{{old('port')}}">--}}

                        {{--<div class="error" style="color:red">{{ $errors->first('username') }}</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group floating-label">--}}
                        {{--<label for="demo1" style="color: black">Password </label>--}}
                        {{--<input class="form-control" id="demo1" type="password" name="password">--}}

                        {{--<div class="error" style="color:red">{{ $errors->first('password') }}</div>--}}
                        {{--</div>--}}

                        <div id="radioButton">
                            <input class="proxyType" type="radio" id="privateProxy" name="proxyType" required
                                   value="privateProxy" checked>
                            <label for="privateProxy">Private Proxy</label>
                            <input class="proxyType" type="radio" id="publicProxy" name="proxyType" required
                                   value="publicProxy" checked>
                            <label for="publicProxy">Public Proxy</label>
                        </div>

                        <div id="usernameHide">
                        <div class="form-group floating-label">
                        <label class="control-label" for="">Username</label>
                        <input type="text" class="form-control" name="username" id="username"
                        placeholder="" />
                        </div>

                        <div class="form-group floating-label">
                        <label class="control-label" for="">Password</label>
                        <input type="text" class="form-control" name="password" id="password"
                        placeholder="" />
                        </div>
                        </div>
                        <div class="form-group floating-label">
                        {{--<label for="demo1"style="color: black">proxy_type</label>--}}
                        {{--<select class="form-control" name="proxy_type"  id="demo1" style="width: 100px">--}}
                        {{--<option value="Private">Private </option>--}}
                        {{--<option value="Public">Public</option>--}}
                        {{--</select>--}}
                        {{--<div class="error" style="color:red">{{ $errors->first('proxy_type') }}</div>--}}

                        {{--</div>--}}

                        {{--<div class="form-group">--}}

                            {{--</div>--}}
                        <button type="submit" class="btn  btn-primary"><i class="fa fa-check"></i>Save</button>
                        <a href="{{URL::previous()}}" class="btn btn-warning" style="margin-left:1%;" type="button"><i
                        class="fa fa-arrow-circle-left"></i>
                        Back To Proxy
                        </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection


@section('pagescripts')



    {{--<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>--}}

    {{--<!-- Bootstrap JavaScript -->--}}
    <script type="text/javascript">
        var proxyVal = $('.proxyType').val();

            $('#usernameHide').show();
            $(document.body).on('click', '.proxyType', function () {
                if ($(this).val() == "publicProxy") {
                    $('#usernameHide').hide();
                    proxyVal = "publicProxy";
                } else {
                    $('#usernameHide').show();
                    proxyVal = "privateProxy";
                }
            });

    </script>

@endsection