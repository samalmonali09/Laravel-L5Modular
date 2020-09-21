<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8"/>
    <title>INSTASTATS | API</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="bond"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
          type="text/css"/>
    <link href="/GAIA/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

    <link href="/GAIA/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet"
          type="text/css"/>

    <link href="/GAIA/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="/GAIA/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->

    <!-- END PAGE LEVEL STYLES -->
    <!-- BEGIN THEME STYLES -->
    
    
    
    
    
    

    <link href="/GAIA/assets/global/css/components-md.css" id="style_components" rel="stylesheet" type="text/css"/>
    <link href="/GAIA/assets/global/css/plugins-md.css" rel="stylesheet" type="text/css"/>
    <link href="/GAIA/assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
    <link href="/GAIA/assets/admin/layout/css/themes/default2.css" rel="stylesheet" type="text/css" id="style_color"/>
    <link href="/GAIA/assets/admin/layout/css/profile.css" rel="stylesheet" type="text/css" id="style_color"/>
    
    <link href="/GAIA/assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>

    <style>
        .notinuse {
            position: relative;
            background: gray;
            padding: 30px;
            overflow: hidden;
        / / hide overflow of pseudo elements
        }

        .notinuse:before, .notinuse:after {
            position: absolute;
            content: '';
            background: red;
            display: block;
            width: 100%;
            height: 30px;
            -webkit-transform: rotate(-45deg);
            transform: rotate(-45deg);
        / / center the X vertically and horizontally: left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            margin: auto;
        }

        .notinuse:after {
            -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
        }
    </style>


    
<!-- END THEME STYLES -->

    
</head>
<body>


<div class="container">
    <div id="exTab1" class="container">
        <ul class="nav nav-pills">
            <li class="active" id="firstTab">
                <a href="#1a" data-toggle="tab">API Docs</a>
            </li>
            <li id="secondTab">
                <a href="#2a" data-toggle="tab">Service Lists</a>
            </li>
            <li>
                <a href="#3a" data-toggle="tab">Status Codes &amp; Errors</a>
            </li>
            <li>
                <a href="/user/exampleDoc">Response Examples</a>
            </li>
        </ul>

        <div class="tab-content clearfix" style="background-color: #428bca;">
            
            <div class="tab-pane active" id="1a">

                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-legal font-green-sharp"></i>
                                    <span class="caption-subject font-green-sharp bold uppercase">Send a POst request to service link with mentioned
                                        Params</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="row" style="margin-top:1%;">
                                    <div class="col-md-12">
                                        <div class="panel-group" id="accordion" role="tablist"
                                             aria-multiselectable="true">

                                            <div class="panel panel-default">
                                                <div class="panel-heading" role="tab" id="headingOne">
                                                    <h4 class="panel-title">
                                                        <a role="button" data-toggle="collapse"
                                                           data-parent="#accordion" href="#collapseOne"
                                                           aria-expanded="true" aria-controls="collapseOne">
                                                            1. to register user
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseOne" class="panel-collapse collapse in"
                                                     role="tabpanel" aria-labelledby="headingOne">
                                                    <div class="panel-body">
                                                        <div class="row" style="margin-top:1%;">
                                                            <div class="col-md-12">
                                                                <ul class="purchase">
                                                                    <b>Service Link :</b>
                                                                    <pre>http://api.gaia.globusdemos.com/instastats/signup</pre>
                                                                    <b>Required Fields</b>
                                                                    <ul>
                                                                        <li>
                                                                            <small><b>email</b> - Your email id
                                                                            </small>
                                                                        </li>
                                                                        <li>
                                                                            <small><b>username</b> - Username (should
                                                                                not contain @)
                                                                            </small>
                                                                        </li>
                                                                        <li>
                                                                            <small><b>password</b> - Password</small>
                                                                        </li>
                                                                        <li>
                                                                            <small><b>password_confirmation</b></small>
                                                                        </li>
                                                                        <li>
                                                                            <small><b>device_type</b> - 1 for android 2
                                                                                for iOS
                                                                            </small>
                                                                        </li>
                                                                        <li>
                                                                            <small><b>device_id</b></small>
                                                                        </li>


                                                                    </ul>
                                                                    <b>Response: </b>
                                                                    <pre>{"code": 200, "message": "User registration successful, please activate the account using the OTP sent in email.", "error": null, "data": { "email": "saurabh.kumar@globussoft.in" }}</pre>


                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="panel panel-default">
                                                <div class="panel-heading" role="tab" id="headingTwo">
                                                    <h4 class="panel-title">
                                                        <a class="collapsed" role="button"
                                                           data-toggle="collapse" data-parent="#accordion"
                                                           href="#collapseTwo" aria-expanded="false"
                                                           aria-controls="collapseTwo">
                                                            2. to activate account
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseTwo" class="panel-collapse collapse"
                                                     role="tabpanel" aria-labelledby="headingTwo">
                                                    <div class="panel-body">
                                                        <div class="row" style="margin-top:1%;">
                                                            <div class="col-md-12">
                                                                <ul class="purchase">
                                                                    <b>Service Link :</b>
                                                                    <pre>http://api.gaia.globusdemos.com/instastats/activateAccount</pre>
                                                                    <b>Required Fields</b>
                                                                    <ul>
                                                                        <li>
                                                                            <small><b>email</b>- email
                                                                            </small>
                                                                        </li>
                                                                        <li>
                                                                            <small><b>otp</b>- valid otp</small>
                                                                        </li>
                                                                    </ul>

                                                                    <b><a onclick="$('#responseDiv2').slideToggle()">Response: </a></b>
                                                                    <div id="responseDiv2" style="display: none;">

                                                                        <pre>{
    "code": 200,
    "message": "Account has been activated.",
    "error": null,
    "data": {
        "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUz...",
        "id": 129,
        "username": "bond",
        "email": "saurabh.kumar@globussoft.in"
    }
}</pre>
                                                                    </div>

                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="panel panel-default">
                                                <div class="panel-heading" role="tab" id="headingThree">
                                                    <h4 class="panel-title">
                                                        <a class="collapsed" role="button"
                                                           data-toggle="collapse" data-parent="#accordion"
                                                           href="#collapseThree" aria-expanded="false"
                                                           aria-controls="collapseThree">
                                                            3. for user login
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseThree" class="panel-collapse collapse"
                                                     role="tabpanel" aria-labelledby="headingThree">
                                                    <div class="panel-body">
                                                        <div class="row" style="margin-top:1%;">
                                                            <div class="col-md-12">
                                                                <ul class="purchase">
                                                                    <b>Service Link :</b>
                                                                    <pre>http://api.gaia.globusdemos.com/instastats/login</pre>
                                                                    <b>Required Fields</b>
                                                                    <ul>
                                                                        <li>
                                                                            <small><b>emailOrUsername</b>- email or
                                                                                username
                                                                            </small>
                                                                        </li>
                                                                        <li>
                                                                            <small><b>password</b>- password</small>
                                                                        </li>

                                                                    </ul>
                                                                    <b>Response: </b>
                                                                    <pre>{ "code": 200, "message": "Login successful.", "error": null, "data": { "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.ey...", "id": 129, "username": "bond", "email": "saurabh.kumar@globussoft.in" } }</pre>

                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="panel panel-default">
                                                <div class="panel-heading" role="tab" id="headingFour">
                                                    <h4 class="panel-title">
                                                        <a class="collapsed" role="button"
                                                           data-toggle="collapse" data-parent="#accordion"
                                                           href="#collapseFour" aria-expanded="false"
                                                           aria-controls="collapseFour">
                                                            4. to recover password
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseFour" class="panel-collapse collapse"
                                                     role="tabpanel" aria-labelledby="headingFour">
                                                    <div class="panel-body">
                                                        <div class="row" style="margin-top:1%;">
                                                            <div class="col-md-12">
                                                                <ul class="purchase">
                                                                    <b>Service Link :</b>
                                                                    <pre>http://api.gaia.globusdemos.com/instastats/recoverPassword</pre>
                                                                    <b>--------------</b>
                                                                    <dd>to get OTP</dd>
                                                                    <b>Required Fields</b>
                                                                    <ul>
                                                                        <li>
                                                                            <small><b>method</b>- getOTP
                                                                            </small>
                                                                        </li>
                                                                        <li>
                                                                            <small><b>email</b> - email
                                                                            </small>
                                                                        </li>
                                                                    </ul>
                                                                    <b><a onclick="$('#responseDiv4').slideToggle()">Response: </a></b>

                                                                    <div id="responseDiv4" style="display: none;">

                                                                    <pre>{
    "code": 200,
    "message": "OTP has been sent to mail. Please enter the otp to confirm your identity.",
    "error": null,
    "data": {
        "email": "saurabh.kumar@globussoft.in"
    }
}</pre>
                                                                    </div>
                                                                    <br>
                                                                    <b>--------------</b>
                                                                    <dd>to verify OTP</dd>
                                                                    <b>Required Fields</b>
                                                                    <ul>
                                                                        <li>
                                                                            <small><b>method</b>- verifyOTP
                                                                            </small>
                                                                        </li>
                                                                        <li>
                                                                            <small><b>email</b>- email
                                                                            </small>
                                                                        </li>
                                                                        <li>
                                                                            <small><b>otp</b> - valid otp
                                                                            </small>
                                                                        </li>
                                                                        <li>
                                                                            <small><b>newPassword</b> - new password
                                                                            </small>
                                                                        </li>
                                                                        <li>
                                                                            <small><b>newPassword_confirmation</b>
                                                                            </small>
                                                                        </li>
                                                                    </ul>
                                                                    <b>Response:</b>
                                                                    <pre>{ "code": 200, "message": "Password has been changed, login again.", "error": null, "data": null }</pre>
                                                                </ul>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="panel panel-default">
                                                <div class="panel-heading" role="tab" id="headingFive">
                                                    <h4 class="panel-title">
                                                        <a class="collapsed" role="button"
                                                           data-toggle="collapse" data-parent="#accordion"
                                                           href="#collapseFive" aria-expanded="false"
                                                           aria-controls="collapseFive">
                                                            5. <s>to reset password</s>(not in use)
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseFive" class="panel-collapse collapse"
                                                     role="tabpanel" aria-labelledby="headingFive">
                                                    <div class="panel-body">
                                                        <div class="row" style="margin-top:1%;">
                                                            <div class="col-md-12">
                                                                <ul class="purchase notinuse">
                                                                    <b>Service Link :</b>
                                                                    <pre>http://api.gaia.globusdemos.com/instastats/resetPassword</pre>
                                                                    <b>Required Fields</b>
                                                                    <ul>
                                                                        <li>
                                                                            <small><b>token</b>- token sent in verify
                                                                                otp response
                                                                            </small>
                                                                        </li>
                                                                        <li>
                                                                            <small><b>newPassword</b> - new password to
                                                                                set
                                                                            </small>
                                                                        </li>
                                                                        <li>
                                                                            <small><b>newPassword_confirmation</b> -
                                                                                re-type password
                                                                            </small>
                                                                        </li>
                                                                    </ul>
                                                                    <b>Response: </b>
                                                                    <pre>{ "code": 200, "message": "Password has been changed, login again.", "error": null, "data": null }</pre>
                                                                </ul>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel panel-default">
                                                <div class="panel-heading" role="tab" id="headingSix">
                                                    <h4 class="panel-title">
                                                        <a class="collapsed" role="button"
                                                           data-toggle="collapse" data-parent="#accordion"
                                                           href="#collapseSix" aria-expanded="false"
                                                           aria-controls="collapseFive">
                                                            6. to get the profile basic details
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseSix" class="panel-collapse collapse"
                                                     role="tabpanel" aria-labelledby="headingSix">
                                                    <div class="panel-body">
                                                        <div class="row" style="margin-top:1%;">
                                                            <div class="col-md-12">
                                                                <ul class="purchase">
                                                                    <b>Service Link :</b>
                                                                    <pre>http://api.gaia.globusdemos.com/instastats/getProfileDetails</pre>
                                                                    <b>Required Fields</b>
                                                                    <ul>
                                                                        <li>
                                                                            <small><b>access_token</b>- valid token
                                                                            </small>
                                                                        </li>
                                                                    </ul>
                                                                    <b><a onclick="$('#responseDiv6').slideToggle()">Response: </a></b>

                                                                    <div id="responseDiv6" style="display: none;">
                                                                    <pre>{
    "code": 200,
    "message": "Profile details.",
    "error": null,
    "data": {
        "id": 128,
        "firstname": null,
        "lastname": null,
        "username": "bond",
        "email": "saurabh.kumar@globussoft.in",
        "role": 1,
        "status": 1,
        "profile_pic": null,
        "registered_through": 6,
        "device_type": 2,
        "device_id": "saurabhishere",
        "user_free_package": 0,
        "rated_app": 0,
        "created_at": "2018-04-10 03:47:35",
        "updated_at": "2018-04-10 03:47:35",
        "iat": 1523368808
    }
}
                                                                    </pre>
                                                                    </div>
                                                                </ul>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="panel panel-default">
                                                <div class="panel-heading" role="tab" id="headingSeven">
                                                    <h4 class="panel-title">
                                                        <a class="collapsed" role="button"
                                                           data-toggle="collapse" data-parent="#accordion"
                                                           href="#collapseSeven" aria-expanded="false"
                                                           aria-controls="collapseFive">
                                                            7. add instagram account (insta login)
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseSeven" class="panel-collapse collapse"
                                                     role="tabpanel" aria-labelledby="headingSeven">
                                                    <div class="panel-body">
                                                        <div class="row" style="margin-top:1%;">
                                                            <div class="col-md-12">
                                                                <ul class="purchase">
                                                                    <b>Service Link :</b>
                                                                    <pre>http://api.gaia.globusdemos.com/instastats/addAccount</pre>
                                                                    <b>Required Fields</b>
                                                                    <ul>

                                                                        <li>
                                                                            <small><b>username</b>- insta username
                                                                            </small>
                                                                        </li>
                                                                        <li>
                                                                            <small><b>password</b>- insta password</small>
                                                                        </li>
                                                                        <li>
                                                                            <small><b>device_id</b>- device id</small>
                                                                        </li>
                                                                        <li>
                                                                            <small><b>device_type</b>- 1 for android 2
                                                                                for iOS
                                                                            </small>
                                                                        </li>

                                                                    </ul>
                                                                    <b><a onclick="$('#responseDiv7').slideToggle()">Response1
                                                                            (when checkpoint verification
                                                                            required): </a></b>

                                                                    <div id="responseDiv7" style="display: none;">
                                                                    <pre>{
    "code": 423,
    "message": "Please verify your account.",
    "error": "checkpoint required, suspicious login attempt",
    "data": {
        "checkpoint_token": "eyJ0eXAiOiJKV..."
    }
}
                                                                    </pre>
                                                                    </div>
                                                                    <b><a onclick="$('#responseDiv7b').slideToggle()">Response2
                                                                            (when login is success): </a></b>

                                                                    <div id="responseDiv7b" style="display: none;">
                                                                    <pre>{
    "code": 200,
    "message": "Account added successfully.",
    "error": null,
    "data": {
        "id": "2210222772",
        "full_name": "saurabh",
        "profile_pic_url": "https://scontent-iad3-1.cdninstagram.com/vp/e689a3fbb0bd25f16d180cf3b14215b1/5B5F3959/t51.2885-19/s150x150/11370988_1176513122364123_1879305072_a.jpg",
        "biography": "Bad Boy Gone Worse !!!",
        "followers_count": 1706,
        "followings_count": 173,
        "post_count": 15,
        "image_post": 14,
        "video_post": 1,
        "likes_count": 29740,
        "followers_gained": 0,
        "non_followers_count": 0,
        "username": "saurabh_bond",
        "account_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6InNhdXJhYmhfYm9uZCIsImRldmljZV9pZCI6InNhdXJhYmhpc2hlcmUiLCJkZXZpY2VfdHlwZSI6MiwiaW5zX3VzZXJfaWQiOjF9.Djb41Ed3xSv2-8-TGfw_sSDg1AMibh6VPhLRhEKvDH8"
    }
}
                                                                    </pre>
                                                                    </div>

                                                                </ul>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>


                                            <div class="panel panel-default">
                                                <div class="panel-heading" role="tab" id="headingEight">
                                                    <h4 class="panel-title">
                                                        <a class="collapsed" role="button"
                                                           data-toggle="collapse" data-parent="#accordion"
                                                           href="#collapseEight" aria-expanded="false"
                                                           aria-controls="collapseEight">
                                                            8. verify account
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseEight" class="panel-collapse collapse"
                                                     role="tabpanel" aria-labelledby="headingEight">
                                                    <div class="panel-body">
                                                        <div class="row" style="margin-top:1%;">
                                                            <div class="col-md-12">
                                                                <ul class="purchase">
                                                                    <b>Service Link :</b>
                                                                    <pre>http://api.gaia.globusdemos.com/instastats/verifyAccount</pre>
                                                                    <b>--------------</b>
                                                                    <dd>to get code</dd>
                                                                    <b>Required Fields</b>
                                                                    <ul>

                                                                        <li>
                                                                            <small><b>checkpoint_token</b></small>
                                                                        </li>
                                                                        <li>
                                                                            <small><b>choice</b> - way to receive code (0= via phone 1= email)</small>
                                                                        </li>
                                                                        <li>
                                                                            <small><b>method</b> -  getCode</small>
                                                                        </li>
                                                                    </ul>
                                                                    <b><a onclick="$('#responseDiv8a').slideToggle()">Response: </a></b>

                                                                    <div id="responseDiv8a" style="display: none;">

                                                                    <pre>{
    "code": 200,
    "message": "Enter the 6-digit code we sent to the number ending in: 6324.",
    "error": null,
    "data": {
        "checkpoint_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6InNhdXJhYmhfYm9uZCIsInBhc3N3b3JkIjoiaW5zdGFzdGF0cyIsImRldmljZV9pZCI6InNhdXJhYmhpc2hlcmUiLCJkZXZpY2VfdHlwZSI6IjIiLCJjaGVja3BvaW50X3VybCI6IlwvY2hhbGxlbmdlXC8yMjEwMjIyNzcyXC9ZTnRiRjc0a21UXC8iLCJzZXNzaW9uX2RldGFpbHMiOiJtaWQ9V3VpemlRQUJBQUdabXcyaWlsNXg3M0xkWjAzbTtpZ19wcj0xO2lnX3Z3PTY2Nztjc3JmdG9rZW49cHg1dGRjS09EQTZQbXFLaTNENTFXOHNHVnpWS3RiQUo7aWdfZGF1X2Rpc21pc3M9MTUyNTE5OTc1NjsiLCJicm93c2VyX2RldGFpbHMiOiJJbnN0YWdyYW0gMTAuMzMuMCBBbmRyb2lkICgyMlwvNi4wLjE7IDU3N2RwaTsgMTQ0MHgyNTYwOyBMZW5vdm87IExlbm92byBBODA1ZTsgYWlycGxheWVwOyBlbl9VUykifQ._rJ0eX9UiGtrDEQo3AUQ6Z3sFEB-NewAx9F6joVrm2E"
    }
}</pre>
                                                                    </div>
                                                                    <br>
                                                                    <b>--------------</b>
                                                                    <dd>to verify security code</dd>
                                                                    <b>Required Fields</b>
                                                                    <ul>
                                                                        <li>
                                                                            <small><b>checkpoint_token</b></small>
                                                                        </li>
                                                                        <li>
                                                                            <small><b>security_code</b> - code sent by instagram.</small>
                                                                        </li>
                                                                        <li>
                                                                            <small><b>method</b> -  verifyCode</small>
                                                                        </li>
                                                                    </ul>
                                                                    <b><a onclick="$('#responseDiv8b').slideToggle()">Response: </a></b>

                                                                    <div id="responseDiv8b" style="display: none;">

                                                                        <pre>{
    "code": 200,
    "message": "Account added successfully.",
    "error": null,
    "data": {
        "id": "2210222772",
        "full_name": "saurabh",
        "profile_pic_url": "https://scontent-iad3-1.cdninstagram.com/vp/e689a3fbb0bd25f16d180cf3b14215b1/5B5F3959/t51.2885-19/s150x150/11370988_1176513122364123_1879305072_a.jpg",
        "biography": "Bad Boy Gone Worse !!!",
        "followers_count": 1706,
        "followings_count": 173,
        "post_count": 15,
        "image_post": 14,
        "video_post": 1,
        "likes_count": 29740,
        "followers_gained": 0,
        "non_followers_count": 0,
        "username": "saurabh_bond",
        "account_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6InNhdXJhYmhfYm9uZCIsImRldmljZV9pZCI6InNhdXJhYmhpc2hlcmUiLCJkZXZpY2VfdHlwZSI6MiwiaW5zX3VzZXJfaWQiOjF9.Djb41Ed3xSv2-8-TGfw_sSDg1AMibh6VPhLRhEKvDH8"
    }
}
                                                                        </pre>
                                                                    </div>

                                                                </ul>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="panel panel-default">
                                                <div class="panel-heading" role="tab" id="headingNine">
                                                    <h4 class="panel-title">
                                                        <a class="collapsed" role="button"
                                                           data-toggle="collapse" data-parent="#accordion"
                                                           href="#collapseNine" aria-expanded="false"
                                                           aria-controls="collapseNine">
                                                            9. get non-follower lists (who didn't follow back)
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseNine" class="panel-collapse collapse"
                                                     role="tabpanel" aria-labelledby="headingNine">
                                                    <div class="panel-body">
                                                        <div class="row" style="margin-top:1%;">
                                                            <div class="col-md-12">
                                                                <ul class="purchase">
                                                                    <b>Service Link :</b>
                                                                    <pre>api.gaia.globusdemos.com/instastats/getNonFollowerDetails</pre>
                                                                    <b>Required Fields</b>
                                                                    <ul>
                                                                        <li>
                                                                            <small><b>account_token</b>- valid token (sent in addAccount/verifyAccoun response)
                                                                            </small>
                                                                        </li>
                                                                    </ul>
                                                                    <b><a onclick="$('#responseDiv9').slideToggle()">Response: </a></b>

                                                                    <div id="responseDiv9" style="display: none;">
                                                                    <pre>{
    "code": 200,
    "message": "Non followers list.",
    "error": null,
    "data": [
        {
            "id": "331491005",
            "username": "mirzasaniar"
        },
        {
            "id": "6182466053",
            "username": "vikashsingh.singh.5"
        }
     ]
}</pre>
                                                                    </div>

                                                                </ul>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="panel panel-default">
                                                <div class="panel-heading" role="tab" id="headingTen">
                                                    <h4 class="panel-title">
                                                        <a class="collapsed" role="button"
                                                           data-toggle="collapse" data-parent="#accordion"
                                                           href="#collapseTen" aria-expanded="false"
                                                           aria-controls="collapseTen">
                                                            10. refresh account (to get recent count)
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseTen" class="panel-collapse collapse"
                                                     role="tabpanel" aria-labelledby="headingTen">
                                                    <div class="panel-body">
                                                        <div class="row" style="margin-top:1%;">
                                                            <div class="col-md-12">
                                                                <ul class="purchase">
                                                                    <b>Service Link :</b>
                                                                    <pre>api.gaia.globusdemos.com/instastats/refreshAccount</pre>
                                                                    <b>Required Fields</b>
                                                                    <ul>
                                                                        <li>
                                                                            <small><b>account_token</b>- valid token (sent in addAccount/verifyAccoun response)
                                                                            </small>
                                                                        </li>
                                                                    </ul>
                                                                    <b><a onclick="$('#responseDiv10').slideToggle()">Response: </a></b>

                                                                    <div id="responseDiv10" style="display: none;">
                                                                    <pre>{
    "code": 200,
    "message": "Account with latest count.",
    "error": null,
    "data": {
        "ins_user_id": 1,
        "username": "saurabh_bond",
        "id": 2210222772,
        "full_name": "saurabh",
        "profile_pic_url": "https://scontent-syd2-1.cdninstagram.com/vp/94e27ea7214188cb165c7e3f55d6b772/5B86C659/t51.2885-19/s150x150/11370988_1176513122364123_1879305072_a.jpg",
        "biography": "Bad Boy Gone Worse !!!",
        "followers_count": 1705,
        "followings_count": 173,
        "post_count": 15,
        "image_post": 14,
        "video_post": 1,
        "likes_count": 29739,
        "followers_gained": 0,
        "non_followers_count": 63,
        "account_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6InNhdXJhYmhfYm9uZCIsImRldmljZV9pZCI6InNhdXJhYmhpc2hlcmUiLCJkZXZpY2VfdHlwZSI6MiwiaW5zX3VzZXJfaWQiOjF9.Djb41Ed3xSv2-8-TGfw_sSDg1AMibh6VPhLRhEKvDH8"
    }
}</pre>
                                                                    </div>

                                                                </ul>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End: life time stats -->
                    </div>
                </div>
            </div>
            <div class="tab-pane" style="color:#000;" id="2a">
                <h3>Service list with params.</h3>

                <div class="row">
                    <div class="col-md-12">

                        <div class="portlet light">

                            <div class="portlet-body" style="margin-bottom: 4%;">
                                <div class="well">
                                    <table class="table table-striped table-bordered table-hover" id="datatable_ajax">
                                        <thead>
                                        <tr role="row" class="heading">
                                            <th width="">#</th>
                                            <th width="">Service URL</th>
                                            <th width="">Params</th>
                                            <th width="">Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>
                                                <i class="fa fa-instagram"></i>&nbsp;http://api.gaia.globusdemos.com/instastats/signup
                                            </td>
                                            <td></td>
                                            <td>
                                                <span class="badge badge-success text-case">Working</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>
                                                <i class="fa fa-instagram"></i>&nbsp;http://api.gaia.globusdemos.com/instastats/activateAccount
                                            </td>
                                            <td></td>
                                            <td>
                                                <span class="badge badge-danger text-case">Working</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>
                                                <i class="fa fa-instagram"></i>&nbsp;http://api.gaia.globusdemos.com/instastats/login
                                            </td>
                                            <td></td>
                                            <td>
                                                <span class="badge badge-danger text-case">Working</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4 a</td>
                                            <td>
                                                <i class="fa fa-instagram"></i>&nbsp;http://api.gaia.globusdemos.com/instastats/recoverPassword
                                            </td>
                                            <td></td>
                                            <td>
                                                <span class="badge badge-danger text-case">Working</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4 b</td>
                                            <td>
                                                <i class="fa fa-instagram"></i>&nbsp;http://api.gaia.globusdemos.com/instastats/recoverPassword
                                            </td>
                                            <td></td>
                                            <td>
                                                <span class="badge badge-danger text-case">Working</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>
                                                <i class="fa fa-instagram"></i>&nbsp;http://api.gaia.globusdemos.com/instastats/resetPassword
                                            </td>
                                            <td></td>
                                            <td>
                                                <span class="badge badge-danger text-case">Working</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>
                                                <i class="fa fa-instagram"></i>&nbsp;http://api.gaia.globusdemos.com/instastats/getProfileDetails
                                            </td>
                                            <td></td>
                                            <td>
                                                <span class="badge badge-danger text-case">Working</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>7</td>
                                            <td>
                                                <i class="fa fa-instagram"></i>&nbsp;http://api.gaia.globusdemos.com/instastats/updateProfile
                                            </td>
                                            <td></td>
                                            <td>
                                                <span class="badge badge-danger text-case">Working</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>8</td>
                                            <td>
                                                <i class="fa fa-instagram"></i>&nbsp;http://api.gaia.globusdemos.com/instastats/updatePassword
                                            </td>
                                            <td></td>
                                            <td>
                                                <span class="badge badge-danger text-case">Working</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>9</td>
                                            <td>
                                                <i class="fa fa-instagram"></i>&nbsp;http://api.gaia.globusdemos.com/instastats/changeAvatar
                                            </td>
                                            <td></td>
                                            <td>
                                                <span class="badge badge-danger text-case">Working</span>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                        </div>
                        <!-- End: life time stats -->
                    </div>
                </div>
            </div>


            <div class="tab-pane" style="color:#000;" id="3a">
                <h3>Status Codes and Errors</h3>

                <div class="row">
                    <div class="col-md-12">

                        <div class="portlet light">

                            <div class="portlet-body" style="margin-bottom: 4%;">
                                <div class="well">


                                    <div class="content">


                                        <p>Failed requests will always return an error response, including a
                                            response code, a message explaining the reason for the error, If you have
                                            still doubt check the response examples that may troubleshoot the problem OR
                                            contact us - saurabh.kumar@globussoft.in</p>

                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <th>Response Code</th>
                                                <th>Reason</th>
                                                <th>Description</th>
                                            </tr>

                                            <tr>
                                                <td>400</td>
                                                <td>Error , bad request</td>
                                                <td>This error indicates bad request Or some internal error has
                                                    occurred.
                                                    This error comes with proper error message. Please check the messgae
                                                    and correct it.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>401</td>
                                                <td>Unauthorized, accessToken not matched.</td>
                                                <td>It will come when the request method is not proper Or the
                                                    access_token is not valid.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>404</td>
                                                <td>Not found, routes not found</td>
                                                <td>Error comes when the service URL is not proper. Please cross-check
                                                    the service link.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>405</td>
                                                <td>method not allowed</td>
                                                <td>Only request through POST method is allowed.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>412</td>
                                                <td>precondition failed, validation error</td>
                                                <td>Validation error , when you pass invalid or wrong arguments Or you
                                                    miss to pass some parameter.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>200</td>
                                                <td>ACCEPTED / OK / Success &#9786;</td>
                                                <td>YOur Request accepted and processed successfully.</td>
                                            </tr>

                                            </tbody>
                                        </table>

                                    </div>


                                </div>
                            </div>


                        </div>
                        <!-- End: life time stats -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="page-footer" style="margin-left: 100px;">
    <div class="page-footer-inner">
        2018 &copy; GAIA INSTASTATS API
    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
<!-- END FOOTER -->

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>

<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->

<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="/GAIA/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="/GAIA/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="/GAIA/assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<script>
    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core componets
        Layout.init(); // init layout
        Demo.init(); // init demo features

//        InstaPanel.init(); // init InstaPanel core components
//        Layout.init(); // init current layout
//        Demo.init(); // init demo features
    });

    $('#changeTab').click(function () {
        console.log("change tab is clicked");
        $('#firstTab').removeClass("active");
        $('#secondTab').addClass("active");

    });
</script>
</body>
</html>