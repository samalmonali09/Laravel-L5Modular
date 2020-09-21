{{--/**--}}
{{--* Created by Monali Samal.--}}
{{--* User: Monali Samal <monalisamal@globussoft.in>--}}
{{--* Date: 3/7/2018--}}
{{--* Time: 1:18 PM--}}
{{--*/--}}


@extends('Admin::Layouts.adminlayout')

@section('Comments','active open')

@section('pagecontent')
    <h3 class="page-title" style="color: #074c66">
        Manage Comments
    </h3>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="/admin/commentTable">Manage Comment</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="/admin/addingComments">Adding comments</a>
            </li>
        </ul>
    </div>
    <h1 class="page-title" style="color:#1e8d8f">Add Comments</h1>
    <div class="row" style="min-height:470px;">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                </div>
                <div class="panel-body" style="color: rebeccapurple">
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
                    @if(Session::has('message'))
                        @if(session('status')=='Success')
                            <div style="color:#e4140c;"><b>{{session('status')}}</b> {{Session::get('message')}} <a
                                        href="/admin/commentTable">Go Back</a></div>
                        @elseif(session('status')=='Error')
                            <div style="color:#308f10;"><b>{{session('status')}}</b> {{Session::get('message')}}</div>
                        @endif
                    @endif


                    <form class="form" role="form" method="post" action="/admin/addingComments">
                        {{--<h2 style="color:#06738b">Add Users Form</h2>--}}
                        <div class="form-group floating-label">
                            <label for="demo1" style="color: black">Comment_group_name</label>
                            <input class="form-control" id="demo1" type="comment_group_name"  placeholder="comment_group_name" name="comment_group_name" required
                                   value="{{old('comment_group_name')}} ">

                            <div class="error" style="color:red">{{ $errors->first('comment_group_name') }}</div>
                        </div>


                        <div class="form-group floating-label">
                            <label for="demo1" style="color: black">Comments</label>
                            <textarea class="form-control" id="demo1" type="text" name="comments[]" rows="10" cols="50" required
                                      value="{{old('comments')}}"></textarea>

                            <div class="error" style="color:red">{{ $errors->first('comments') }}</div>
                        </div>


                        <button type="submit" class="btn  btn-primary"><i class="fa fa-check"></i>Save Changes</button>

                        <a href="{{URL::previous()}}" class="btn  btn-warning" style="margin-left:1%;" type="button"><i
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

@endsection