
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-success">
        {{ session('error') }}
    </div>
@endif
<html>
<head>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>


<meta charset="UTF-8">
<style>
    table{
        border-collapse:collapse;
        width: 100%;
    }
    table,th,td{

        border: 2px solid black;

    }
    th {
        background-color: #64af32;
        color: white;
    }
</style>
<center>
    <br><h1 style="color: #31b0d5">Regd page </h1>
    <form action="/admin/register" method="post"><br><br>
        {{ csrf_field() }}
        <td>
            <tr>
                <td>Full_Name:</td>
            </tr>
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <input type="text" name="firstname" placeholder="Enter Your firstname" align="center"value="{!! old('firstname') !!}">
            <span class="error">{{$errors->first('firstname')}}</span><br>

        <td>LastName:</td>
        <input type="text" name="lastname" placeholder="Enter Your lastname" align="center"value="{!! old('lastname') !!}">
        <span class="error">{{$errors->first('lastname')}}</span><br>

        <td>UserName</td>
        <input type="text" name="username" placeholder="Enter Your username" align="center"value="{!! old('username') !!}">
        <span class="error">{{$errors->first('username')}}</span><br>

        <td>Email:</td>
        <input type="text" name="email" placeholder="Enter Your Email" value="{!! old('email') !!}"required>
        <span class="error">{{$errors->first('email')}}</span><br>

        <td>device_id:</td>

        <input type="text" name="device_id" placeholder="Enter Your device_id" align="center"value="{!! old('device_id') !!}">
        <span class="error">{{$errors->first('device_id')}}</span><br>

        <td>status</td>
        <input type="text" name="status" placeholder="Enter Your status" align="center"value="{!! old('status') !!}">
        <span class="error">{{$errors->first('status')}}</span><br>

        <td>Password</td>
        <input type="password" name="password"   placeholder="Enter Your Password" value="{!! old('password') !!}">
        <span class="error">{{$errors->first('password')}}</span><br>


        {{--<td>Role</td>--}}
        {{--<input type="password" name="role"   placeholder="Enter Your Password" value="{!! old('role') !!}">--}}
        {{--<span class="error">{{$errors->first('role')}}</span><br>--}}

        <td>Registered_through</td>
        <input type="registered_through" name="registered_through"   placeholder="Enter Your registered_through" value="{!! old('registered_through') !!}">
        <span class="error">{{$errors->first('registered_through')}}</span><br>

        <td>device_type</td>
        <input type="device_type" name="device_type"   placeholder="Enter Your 	device_type" value="{!! old('device_type') !!}">
        <span class="error">{{$errors->first('device_type')}}</span><br>


        <td>rated_app</td>
        <input type="device_type" name="rated_app"   placeholder="Enter Your rated_app" value="{!! old('rated_app') !!}">
        <span class="error">{{$errors->first('rated_app')}}</span><br>

        <td>user_free_package</td>
        <input type="user_free_package" name="user_free_package" placeholder="Enter Your user_free_package" value="{!! old('user_free_package') !!}">
        <span class="error">{{$errors->first('user_free_package	')}}</span><br>



        {{--<td>Confm_pass:</td>--}}

        {{--<input type="confm_pass" name="confm_pass"placeholder="Enter Your conform password"value="{!! old('confm_pass') !!}">--}}
        {{--<span class="error">{{$errors->first('confm_pass')}}</span><br>--}}

        <button type="submit"  style="color: #286090" class="btn btn-success ">SIGNUP</button><br><br>
        </td>
        {{--<a href="http://localhost.messazon.com/user/login"  style="color: #2ca02c" class="btn-block"><button> Login</button></a><br><br>--}}
        {{--<a href="http://localhost.messazon.com/user/logout"  style="color: #2ca02c" class="btn-block"><button> logout</button></a><br><br>--}}

        <a href="{{env('APP_URL')}}//"style="color: #31b0d5">Back to home page</a><br><br>

    </form>
</center>

</body>
</html>






