{{--/**--}}
 {{--* Created by Monali Samal.--}}
 {{--* User: Monali Samal <monalisamal@globussoft.in>--}}
 {{--* Date: 3/23/2018--}}
 {{--* Time: 11:29 AM--}}
 {{--*/--}}





@extends('Admin::Layouts.adminlayout')

@section('Plan2','active open')

@section('pagecontent')
    <h3 class="page-title" style="color: #0d3625">
        Add Plans
    </h3>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                {{--<i class="fa fa-angle-right"></i>--}}
            </li>

            <li>
                <i class="fa fa-home"></i>
                <a href="/admin/PlanDatatable">Manage Plan</a>
            </li>
            <i class="fa fa-angle-right"></i>

            <li>
                <a href="/admin/AddPlan">Add Plan</a>
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


                    <form class="form" role="form" method="post" action="/admin/AddPlan">
                        <div class="form-group floating-label">
                            <label for="demo1"style="color: black">Plan Name</label>
                            <input class="form-control" id="demo1" type="plan_name" name="plan_name"  value="{{old('plan_name')}}">
                            <div class="error" style="color:red">{{ $errors->first('plan_name')}}</div>
                        </div>
                        <div class="form-group floating-label">
                            <label for="demo1"style="color: black">Plan Name Code</label>
                            <input class="form-control" id="demo1" type="plan_name_code" name="plan_name_code" value="{{old('plan_name_code')}}">
                            <div class="error" style="color:red">{{ $errors->first('plan_name_code')}}</div>
                        </div>



                        <div class="form-group floating-label">
                            <label for="demo1"style="color: black">Supplier Server Id </label>
                            <select class="form-control"  type="supplier_server_Id"  name="supplier_server_Id"  id="demo1" value="{{old('supplier_server_Id')}}">
                                <option value="{{old('supplier_server_Id')}}">select...</option>
                                <option value="igerslike">igerslike</option>
                                <option value="cheapbulksocial">cheapbulksocial</option>
                                <option value="socialpanel24">socialpanel24</option>
                                <option value="socialnator">socialnator</option>
                                <option value="followiz">followiz</option>
                                <option value="top4smm">top4smm</option>
                                <option value="KAMH">KAMH</option>
                            </select>
                            <div class="error" style="color:red">{{ $errors->first('supplier_server_Id') }}</div>
                        </div>

                        <div class="form-group floating-label">
                            <label for="demo1"style="color: black">Plan Type</label>
                            <select class="form-control" name="plan_type"  id="demo1" value="{{old('plan_type')}}">
                                <option value="{{old('plan_type')}}">select...</option>
                                <option value="Instagram Likes">Instagram Likes</option>
                                <option value="Instagram Followers">Instagram Followers</option>
                                {{--<option value="Instagram Random Comments">Instagram Random Comments</option>--}}
                                <option value="custom comments">Custom Comments</option>
                                <option value="Instagram Views"> Instagram Views</option>
                                <option value="story views">story views</option>
                                <option value="live video views">live video views</option>
                            </select>
                            <div class="error" style="color:red">{{ $errors->first('plan_type') }}</div>
                        </div>

                        <div class="form-group floating-label">
                            <label for="demo1"style="color: black">Min Quantity</label>
                            <input class="form-control" id="demo1" type="min_quantity" name="min_quantity" value="{{old('min_quantity')}}">
                            <div class="error" style="color:red">{{ $errors->first('min_quantity') }}</div>
                        </div>
                        <div class="form-group floating-label">
                            <label for="demo1"style="color: black">Max Quantity</label>
                            <input class="form-control" id="demo1" type="max_quantity" name="max_quantity" value="{{old('max_quantity')}}">
                            <div class="error" style="color:red">{{ $errors->first('max_quantity')}}</div>
                        </div>

                        <div class="form-group floating-label">
                            <label for="demo1"style="color: black">Buying Price</label>
                            <input class="form-control" id="demo1" type="buying_price" name="buying_price" value="{{old('buying_price')}}">
                            <div class="error" style="color:red">{{ $errors->first('buying_price') }}</div>
                        </div>

                        <div class="form-group floating-label">
                            <label for="demo1"style="color: black">Selling Price</label>
                            <input class="form-control" id="demo1" type="selling_price" name="selling_price" value="{{old('selling_price')}}">
                            <div class="error" style="color:red">{{ $errors->first('selling_price') }}</div>
                        </div>

                        <button type="submit" class="btn  btn-success" title="Add">Add</button>
                        <a href="{{URL::previous()}}" class="btn blue" style="margin-left:1%;" type="button" title="cancel"><i
                                    class="fa fa-arrow-circle-left"></i>
                            Back To Plan
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('pagescripts')

@endsection