
{{--Created by  Monali Samal
      * @author Monali Samal (monalisamal@globussoft.in)
--}}

@extends('Admin::Layouts.adminlayout')

@section('pagecontent')
    <!-- BEGIN PAGE HEADER-->

    <link rel="shortcut icon" href="favicon.ico"/>


    <h3 class="page-title" style="color: #0d3625">
        Edit Profile
    </h3>
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    <div class="portlet-body">
        <div class="tabs-left row">
            <div class="col-md-12 col-xs-12">
                <div id="e">
                    <div class="row" style="margin-top:3%;">
                        <div class="col-md-12">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-dangers">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <form class="form" role="form" method="post" action="/admin/editAccount/{{$result->id}}">
                                {{--<h2 style="color:#06738b">Add Users Form</h2>--}}
                                <div class="form-group floating-label">
                                    <label for="demo1" style="color: black">First Name</label>
                                    <input class="form-control" id="demo1" type="text" name="firstname"
                                           value="{{ $result->firstname }}">
                                    <a class="error" style="color: red">{{$errors->first('firstname')}}</a><br>

                                </div>
                                <div class="form-group floating-label">
                                    <label for="demo1" style="color: black">Last Name</label>
                                    <input class="form-control" id="demo1" type="text" name="lastname"
                                           value="{{ $result->lastname }}">
                                    <a class="error" style="color: red">{{$errors->first('lastname')}}</a><br>

                                </div>
                                <div class="form-group floating-label">
                                    <label for="demo1" style="color: black">UserName</label>
                                    <input class="form-control" id="demo1" type="text" name="username"
                                           value="{{ $result->username }}">
                                    <a class="error" style="color: red">{{$errors->first('username')}}</a><br>


                                </div>
                                <div class="form-group floating-label">
                                    <label for="demo1"style="color: black">Email</label>
                                    <input class="form-control" id="demo1" type="email" name="email"
                                           value="{{ $result->email }}">
                                    <a class="error" style="color: red">{{$errors->first('email')}}</a><br>

                                </div>

                                {{--<button type="submit" class="btn btn-circle btn-success btn-raised btn-block">Sign Up</button>--}}
                            <div class="form-group">
                                <button class="btn btn-circle btn-primary"  type="submit"
                                        id="submitUpdatePassword"><i
                                            class="fa fa-arrow-circle-right"></i> Save Settings
                                </button>



                                <a href="{{URL::previous()}}" class="btn btn-circle  btn-warning" style="margin-left:1%;" type="button"><i
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
    </div>




    <!-- END PAGE CONTENT-->
@endsection
@section('pagescripts')

@endsection


