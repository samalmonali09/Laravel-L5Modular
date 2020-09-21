{{--/**--}}
{{--* Created by Monali Samal.--}}
{{--* User: Monali Samal <monalisamal@globussoft.in>--}}
{{--* Date: 3/23/2018--}}
{{--* Time: 11:29 AM--}}
{{--*/--}}


@extends('Admin::Layouts.adminlayout')

@section('AUTOIG','active open')
@section('Niche','active open')
@section('pagecontent')

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
                <a href="/admin/AddNiche"> Add Niche </a>
            </li>
        </ul>
    </div>
    <h1 class="page-title" style="color:#0a4063">Add Niche</h1>
    <div class="row" style="min-height:470px;">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    {{--<h2 class="panel-title" style="color:greenyellow;">Add Users</h2>--}}
                </div>

                <div class="panel-body">
                    @if (session('planMsg'))
                        <div class="alert alert-success">
                            {{ session('planMsg') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                        <form class="form" role="form" method="post" action="/admin/AddNiche">
                            <div class="form-group floating-label" center>
                                <label for="demo1"style="color: black">Niche</label>
                                <input class="form-control" id="demo1" type="niche" name="niche" >
                                <div class="error" style="color:red">{{ $errors->first('niche')}}</div>
                            </div>
                            {{--<div class="form-group floating-label">--}}
                                {{--<label for="demo1"style="color: black">total_account</label>--}}
                                {{--<input class="form-control" id="demo1" type="total_account" name="total_account" >--}}
                                {{--<div class="error" style="color:red">{{ $errors->first('total_account')}}</div>--}}
                            {{--</div>--}}

                            <button type="submit" class="btn  btn-success">Add</button>
                            <a href="{{URL::previous()}}" class="btn blue" style="margin-left:1%;" type="button"><i
                                        class="fa fa-arrow-circle-left"></i>
                                Back To Niche
                            </a>
                        </form>

                </div>
            </div>
        </div>
    </div>

@endsection


@section('pagescripts')
    <script type="text/javascript">
    </script>

@endsection