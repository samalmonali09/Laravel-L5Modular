{{--/**--}}
{{--* Created by Monali Samal.--}}
{{--* User: Monali Samal<monalisamal@globussoft.in>--}}
{{--* Date: 3/19/2018--}}
{{--* Time: 10:53 AM--}}
{{--*/--}}


@extends('Admin::Layouts.adminlayout')
{{--@section('GIVE','active open')--}}
{{--@section('GIVEMP','active open')--}}
@section($appPackage,'active open')

{{--@section('GILRMP','active open')--}}

{{--@section('AUTOIG','active open')--}}



{{--@section($appPackage,'active open')--}}


@section('pagecontent')

    <h3 class="page-title" style="color: #0d3625">
        Add Packages
    </h3>

    <div class="row" style="min-height:470px;">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                </div>
                <div class="panel-body" style="color: rebeccapurple">

                    @if (session('packageMsg'))
                        <div class="alert alert-success">
                            {{ session('packageMsg') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                        <form class="form" role="form" method="post" action="/admin/AddingPackages/{{$appPackage}}">

                        <div class="form-group floating-label">
                            <label for="demo1" style="color: black">Package Name</label>
                            <input class="form-control" id="demo1" type="package_name" name="package_name"   value="{{old('package_name')}}">
                            <div class="error" style="color:red">{{ $errors->first('package_name')}}</div>
                        </div>
                        <div class="form-group floating-label">
                            <label for="demo1" style="color: black">Package Type</label>
                            <select class="form-control packagedata" name="package_type" id="demo1" value="{{old('package_type')}}">
                                <option value="" selected>Select Package Type</option>

                                <option value="likes" type="0">like</option>
                                <option value="followers" type="1">followers</option>
                                <option value="random comments" type="2">random comments</option>
                                <option value="custom comments" type="3"> custom comments</option>
                                <option value="views" type="4">views</option>
                                <option value="story views" type="5">story views</option>
                                <option value="live video views" type="6">live video views</option>
                            </select>
                            <div class="error" style="color:red">{{ $errors->first('package_type') }}</div>
                        </div>

                        <div class="form-group floating-label">
                            <label for="demo1" style="color: black">Plan Name</label>
                            <select class="form-control select2 package_type" name="plan_id" id="plan_id">
                                <option value="{{old('plan_id')}}" selected>Select Plan</option>

                                @if(isset($plans))
                                    @foreach($plans as $plan)
                                        <option value="{{$plan['plan_id']}}">{{$plan['plan_name']}}</option>
                                    @endforeach

                                @else
                                    There is no any plan to select
                                @endif
                            </select>
                            <div class="error" style="color:red">{{ $errors->first('plan_name') }}</div>
                        </div>

                        <div class="form-group floating-label">
                            <label for="demo1" style="color: black">Quantity</label>
                            <input class="form-control" id="demo1" type="quantity" name="quantity"  value="{{old('quantity')}}">

                            <div class="error" style="color:red">{{ $errors->first('quantity') }}</div>
                        </div>

                        <div class="form-group floating-label">
                            <label for="demo1" style="color: black">Price</label>
                            <input class="form-control" id="demo1" type="price" name="price"  value="{{old('price')}}">

                            <div class="error" style="color:red">{{ $errors->first('price') }}</div>
                        </div>




                        <button type="submit" class="btn  yellow" title="Add">Add</button>
                        <a href="{{URL::previous()}}"  class="btn  blue" style="margin-left:1%;" type="button"><i
                                    class="fa fa-times"></i>
                            Cancel
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('pagescripts')
    <script type="text/javascript">

        $(document).ready(function () {
            var selectedtype = $(".packagedata option:selected").attr('type');
            if (selectedtype !== undefined) {
                jshfbghbgfs(selectedtype)
            }
        });

        $(".packagedata").change(function () {

            jshfbghbgfs($(".packagedata option:selected").attr('type'))
        });

        function jshfbghbgfs(selectedtype) {

            $.ajax({
                url: '/admin/GetAddPackages',
                dataType: 'json',
                type: 'post',
                data: {type: selectedtype},
                success: function (response) {

                    if (response['status'] == 200) {
                        console.log('>>>>>>>>', response.data)

                        var data = ''
                        $.each(response.data, function (index, value) {

                            // data += '<option value="' + value.plan_id + '">' + value.plan_name + ("-&nbsp;")+ value.max_quantity +'</option>';
                            data += '<option value="' + value.plan_id + '">' + value.plan_name + ("&nbsp;") +'</option>';
                        })
                        $(".package_type").empty().append(data);
                    }
                }
            })
        }
        function prettifyNumber(value) {
            var thousand = 1000;
            var million = 1000000;
            var billion = 1000000000;
            var trillion = 1000000000000;
            if (value < thousand) {
                return String(value);
            }

            if (value >= thousand && value <= 1000000) {
                return Math.round(value / thousand) + 'k';
            }

            if (value >= million && value <= billion) {
                return Math.round(value / million) + 'M';
            }

            if (value >= billion && value <= trillion) {
                return Math.round(value / billion) + 'B';
            }

            else {
                return Math.round(value / trillion) + 'T';
            }
        }


    </script>


@endsection