{{--/**--}}
{{--* Created by Monali Samal.--}}
{{--* User: Monali Samal <monalisamal@globussoft.in>--}}
{{--* Date: 3/23/2018--}}
{{--* Time: 11:29 AM--}}
{{--*/--}}


@extends('Admin::Layouts.adminlayout')

{{--@section('Plan2','active open')--}}
@section('INSTASTAT','active open')
@section('Instgram','active open')

@section('pagecontent')
    <h3 class="page-title" style="color: #0d3625">
        Add Instagram
    </h3>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
            </li>

            <li>
                <i class="fa fa-home"></i>
                <a href="/admin/InstgarmTable"> Instagram Profile</a>
            </li>
            <i class="fa fa-angle-right"></i>

            <li>
                <i class="fa fa-instagram"></i>
                <a href="/admin/NewAccount">Add Instagram</a>
            </li>
        </ul>
    </div>
    {{--<h1 class="page-title" style="color:#0a4063">Add Plans</h1>--}}
    <div class="row" style="min-height:470px;">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    {{--<h2 class="panel-title" style="color:greenyellow;">Add Users</h2>--}}
                </div>
                @if (session('planMsg'))
                    <div class="alert alert-success">
                        {{ session('planMsg') }}
                    </div>
                @elseif (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="panel-body" style="color: rebeccapurple">
                    <form class="form" role="form" method="post" action="/admin/NewAccount">

                        <div class="form-group floating-label">
                            <label for="demo1" style="color: black">Account Username </label>
                            <input class="form-control" id="demo1" type="account_username" name="account_username"
                                   value="{{old('account_username')}}">
                            <div class="error" style="color:red">{{ $errors->first('account_username')}}</div>
                        </div>
                        
                        <div class="form-group floating-label">
                            <label for="demo1" style="color: black">Account Password</label>
                            <input class="form-control" id="demo1" type="account_password" name="account_password"
                                   value="{{old('account_password')}}">
                            <div class="error" style="color:red">{{ $errors->first('account_password')}}</div>
                        </div>

                        <div class="form-group floating-label">
                            <label for="demo1" style="color: black">Proxy_IP </label>
                            <input class="form-control" id="demo1" type="proxy_ip" name="proxy_ip"
                                   value="{{old('proxy_ip')}}">
                            <div class="error" style="color:red">{{ $errors->first('proxy_ip')}}</div>
                        </div>

                        <div class="form-group floating-label">
                            <label for="demo1" style="color: black">Proxy Port </label>
                            <input class="form-control" id="demo1" type="proxy_port" name="proxy_port"
                                   value="{{old('proxy_port')}}">
                            <div class="error" style="color:red">{{ $errors->first('proxy_port')}}</div>
                        </div>

                        <div class="form-group floating-label">
                            <label for="demo1" style="color: black">Proxy_Username </label>
                            <input class="form-control" id="demo1" type="proxy_username" name="proxy_username"
                                   value="{{old('proxy_username')}}">
                            <div class="error" style="color:red">{{ $errors->first('proxy_username')}}</div>
                        </div>
                        <div class="form-group floating-label">
                            <label for="demo1" style="color: black">Proxy Password </label>
                            <input class="form-control" id="demo1" type="proxy_password" name="proxy_password"
                                   value="{{old('proxy_password')}}">
                            <div class="error" style="color:red">{{ $errors->first('proxy_password')}}</div>
                        </div>
                        <button type="submit" class="btn  btn-success" title="Add">Add</button>
                        <a href="{{URL::previous()}}" class="btn blue" style="margin-left:1%;" type="button"
                           title="cancel"><i class="fa fa-arrow-circle-left"></i>Back To Plan</a>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection


@section('pagescripts')

@endsection