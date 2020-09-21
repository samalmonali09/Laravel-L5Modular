{{--Log In Blade Page --}}
        <!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="author" content=""/>
    <title></title>
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/images/favicone.png"/>
    <link rel="icon" type="image/png" href="/assets/images/favicone.png"/>
    <link rel="stylesheet" href="/assets/css/Loginstyle.css">
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">--}}

    <style>
        .check {
            color: #999;
            font-size: 15px;
            position: relative;

        }

        .check pre {
            position: relative;
            padding-left: 30px;
            font-family: "Roboto", sans-serif;
        }

        .check pre:after {
            content: '';
            width: 18px;
            height: 18px;
            border: 2px solid #fff;
            position: absolute;
            left: 0;
            top: -2px;
            border-radius: 0%;
            box-sizing: border-box;
            -ms-box-sizing: border-box;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
        }

        .check input[type="checkbox"] {
            cursor: pointer;
            position: absolute;
            width: 50%;
            height: 100%;
            z-index: 1;
            opacity: 0;
            filter: alpha(opacity=0);
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)"
        }

        .check input[type="checkbox"]:checked + pre {
            /*       */
        }

        .check input[type="checkbox"]:checked + pre:before {
            content: '';
            width: 9px;
            height: 4px;
            position: absolute;
            border: 2px solid #fff;
            border-top-width: 2px;
            border-right-width: 2px;
            border-top-style: solid;
            border-right-style: solid;
            border-top-color: rgb(255, 255, 255);
            border-right-color: rgb(255, 255, 255);
            left: 4px;
            top: 3px;
            -webkit-transform: rotate(-45deg);
            transform: rotate(-45deg);
            border-top: none;
            border-right: none;
            background: transparent;

        }

        .alert.alert-danger {
            color: white;
        }

        .alert.alert-success {
            color: white;
        }

    </style>
</head>

<body>
<div class="login-page">


    <img src="/assets/images/logo.png" width="100%">
    <div class="form " style="margin-top: 10%;">
        {{--<div class="alert alert-info" style="color:red;">Invalid Credentials. </div>--}}

        <form class="register-form" method="post" action="/admin/forgotpassword">

            <!--                <img src="/assets/images/logo.png" width="40%">-->
            <span style="background-color:transparent;color:white;font-size: 25px;">Forgot Password</span>

            <span id="ResetPassword" type="password" name="password" type="submit" value="submit">Please check your email
            </span>


        {{--<span id="ResetPassword">Please check your mail for Reset Password link--}}
        {{--</span>--}}
        {{--<input type="submit" >--}}
        {{--<div class="message" style="text-align: left;width: 50%"><a href="#">Back to Login?</a></div>--}}
        <!--
            <img src="/assets/images/logo.png" width="40%">
            <span style="background-color:transparent;color:white;">Sign Up</span>
            <input type="text" placeholder="First Name" />
            <input type="text" placeholder="Last Name" />
            <input type="text" placeholder="Mobile Number" />
            <input type="text" placeholder="Email" />
            <input type="password" placeholder="Password" />
            <button id="SignUp">Sign Up</button>
            <p class="message"><a href="#">Already have account?</a></p>
-->
        </form>
        <form class="login-form acrylic" method="post">


            {{--@if(Session::has('message'))--}}
            @if (session('status'))
                <div class="alert alert-success">

                    <div class="alert alert-info alert-dismissible fade in">
                        {{--<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>--}}
                        <strong></strong> Reset password link has been sent, Please check your email.
                    </div>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
        @endif
            {{--@endif--}}
        <!--               <img src="/assets/images/logo.png" width="40%">-->
            <span style="background-color:transparent;color:white;font-size: 25px;">Login</span>
            <input type="email" name="email" placeholder="Email" />
            <a class="error" style="color: #4fbbd7">{{$errors->first('email')}}</a><br><br>

            <input type="password" name="password" placeholder="Password" />
            <a class="error" style="color: #4fbbd7">{{$errors->first('password')}}</a><br><br>


            <div class="checkbox" style="text-align: left;color: #fff;margin-top: 4%;width: 50%;">
                <label class="check inline">
                    <input type="checkbox" name="optionenter" value="">
                    <pre style="color:#fff;font-size: 14px;">Remember Me</pre>
                </label>

                <!--                    <input name="remember" type="checkbox" value="Remember Me" style="width: 5% !important;margin: 0;"> Remember Me-->

            </div>
            <div class="register message" style="text-align: right;margin-top:-12%;font-size: 14px; color:#fff;"><a
                        href="/admin/forgotpassword">Forgot
                    Password?</a></div>
                {{--<div class="message" style="text-align: right;margin-top:-12%;font-size: 14px;"><a href="/admin/forgotpassword">Forgot--}}
                        {{--Password?</a></div>--}}

            <button id="SignIn" type="submit" value="submit" style="margin-top: 5%;">Login</button>

            <!--                <div class="message" style="text-align: left;width: 50%"><a href="#">Forgot Password?</a></div>-->

        </form>
        <form class="Forgot-form acrylic">

        </form>


    </div>
</div>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>--}}
{{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>--}}
<script>

$(document).ready(function () {

    window.history.pushState(null, "", window.location.href);
    window.onpopstate = function () {
        window.history.pushState(null, "", window.location.href);
    };
})
//    $('.message a').click(function () {
//        $('form').animate({
//            height: "toggle",
//            opacity: "toggle"
//        }, "slow");
//    });


</script>


<!--
<script>
    $(document).ready(function () {
        $(".message1").click(function () {
            $(".register-form , .login-form ").hide(1500);
            $(".Forgot-form ").show(1500);
        });
        $(".message").click(function () {
            //                $(".register-form ").show(1500);
            $(".Forgot-form ").hide();
        });
        $(".backtoLogin").click(function () {
            //                $(".register-form ").show(1500);
            $(".register-form ").hide();
            $('.login-form ').show(1000);
        });
    });
</script>
-->

</body>

</html>