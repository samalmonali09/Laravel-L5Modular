
@extends('Admin::Layouts.adminlayout')


@section($appName,'active open')
@section('AUTOIGMU','active open')
{{--@section($appName,'active open')--}}

@section('pagecontent')
    <h1 class="page-title" style="color:#06738b">Add Users</h1>
    <div class="row" style="min-height:470px;">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                </div>
                <div class="panel-body" style="color: rebeccapurple">

                    @if (session('UserMsg'))
                        <div class="alert alert-success">
                            {{ session('UserMsg') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form class="form" role="form" method="post" action="/admin/AddingUser/{{$appName}}">


                        <div class="row">

                            <div class="form-group floating-label col-md-6">
                                <label for="demo1" style="color: black">UserName</label>
                                <input class="form-control" id="demo1" type="text" name="username"
                                       value="{{old('username')}}">

                                <div class="error" style="color:red">{{ $errors->first('username') }}</div>
                            </div>

                            <div class="form-group floating-label col-md-6">
                                <label for="demo1" style="color: black">Password</label>
                                <input class="form-control" id="demo1" type="password" name="password"  value="{{old('password')}}" placeholder="password">

                                <div class="error" style="color:red">{{ $errors->first('password') }}</div>
                            </div>

                            <div class="form-group floating-label col-md-6">
                                <label for="demo1"style="color: black">Email</label>
                                <input class="form-control" id="demo1" type="email" name="email"  placeholder="email"
                                       value="{{old('email')}}">
                                <div class="error" style="color:red">{{ $errors->first('email') }}</div>
                            </div>


                            {{--<div class="form-group floating-label col-md-6">--}}
                                {{--<label for="demo1"style="color: black">Registered Through</label>--}}
                                {{--<select class="form-control" name="registered_through"  id="demo1" value="{{old('registered_through')}}">--}}
                                    {{--<option value="{{old('registered_through')}}">select...</option>--}}

                                    {{--<option value="GILE">Get Instant Likes En</option>--}}
                                    {{--<option value="GILR">Get Instant Likes Ru</option>--}}
                                    {{--<option value="GIVE">Get Instant Views En</option>--}}
                                    {{--<option value="GIVR">Get Instant  Views Ru</option>--}}
                                    {{--<option value="AUTOIG">AutoIG</option>--}}
                                    {{--<option value="instaSTAT">INSTASTATS </option>--}}
                                    {{--<option value="Instant"> Get Instant </option>--}}
                                {{--</select>--}}
                                {{--<div class="error" style="color:red">{{ $errors->first('registered_through') }}</div>--}}
                            {{--</div>--}}
                        </div>

                        <div class="col-md-6">
                            <button type="submit" class="btn  btn-primary">Submit</button>
                            <a href="{{URL::previous()}}" class="btn  btn-warning" style="margin-left:1%;" type="button"><i
                                        class="fa fa-times"></i>
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection


@section('pagescripts')

@endsection