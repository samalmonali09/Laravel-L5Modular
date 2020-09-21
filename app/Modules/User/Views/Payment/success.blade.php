<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Success Message</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">


    <style>
        /* NOTE: The styles were added inline because Prefixfree needs access to your styles and they must be inlined if they are on local disk! */
        .success-message {
            text-align: center;
            max-width: 500px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .success-message__icon {
            max-width: 75px;
        }

        .success-message__title {
            color: #3DC480;
            transform: translateY(25px);
            opacity: 0;
            transition: all 200ms ease;
        }

        .active .success-message__title {
            transform: translateY(0);
            opacity: 1;
        }

        .success-message__content {
            color: #B8BABB;
            transform: translateY(25px);
            opacity: 0;
            transition: all 200ms ease;
            transition-delay: 50ms;
        }

        .active .success-message__content {
            transform: translateY(0);
            opacity: 1;
        }

        .icon-checkmark circle {
            fill: #3DC480;
            transform-origin: 50% 50%;
            transform: scale(0);
            transition: transform 200ms cubic-bezier(0.22, 0.96, 0.38, 0.98);
        }

        .icon-checkmark path {
            transition: stroke-dashoffset 350ms ease;
            transition-delay: 100ms;
        }

        .active .icon-checkmark circle {
            transform: scale(1);
        }

        p {
            color: rgba(122, 122, 122, 0.9);
        }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>

</head>

<body>

<div class="success-message">
    <svg viewBox="0 0 76 76" class="success-message__icon icon-checkmark">
        <circle cx="38" cy="38" r="36"/>
        <path fill="none" stroke="#FFFFFF" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"
              stroke-miterlimit="10" d="M17.7,40.9l10.9,10.9l28.7-28.7"/>
    </svg>
    <h1 class="success-message__title"> @if(Session::has('subscription_data')) Profile Created Successfully @else Transaction Successful @endif</h1>
    <div class="success-message__content">
        <p>{{date('d M Y H:i:s')}}</p>
        @if(Session::has('data'))
            <p><strong>#{{session('data')['orderId']}}</strong></p>
            <p>{{session('data')['itemName']}}</p>
            <p>{{session('data')['txnId']}}</p>
            <p>${{session('data')['amount']}}</p>
        @endif
        @if(Session::has('subscription_data'))
            <img src="{{session('subscription_data')['profile_image']}}"
                 style="width: 100px; border: 1px solid; box-shadow: 3px 3px #888888;" alt="profile">
            <p><strong>#{{session('subscription_data')['profile_id']}}</strong></p>
            <p>{{session('subscription_data')['description']}}</p>
            <p><b>PayPal Profile Id: </b>{{session('subscription_data')['paypal_profile_id']}}</p>
            <p><b>Price: </b>${{session('subscription_data')['price']}}</p>
            <p><b>Billing Period: </b>{{session('subscription_data')['billing_cycle']}}</p>
        @endif
        @if(Session::has('addon_data'))
            <p>{{session('addon_data')['itemName']}}</p>
            <p>{{session('addon_data')['txnId']}}</p>
            <p>${{session('addon_data')['amount']}}</p>
        @endif

    </div>
</div>

<script src="/assets/js/success.js"></script>


</body>
</html>


{{--<div id="Box">--}}
{{--<p>Order Success</p>--}}
{{--<div class="alert alert-success">--}}
{{--<strong>Thank you!</strong>--}}
{{--</div>--}}
{{--<dl class="dl-horizontal">--}}
{{--<dt>Order&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ID</dt>--}}
{{--<dd>003</dd>--}}
{{--<dt>Order Name</dt>--}}
{{--<dd>Product</dd>--}}
{{--<dt>Order&nbsp;&nbsp; Date</dt>--}}
{{--<dd>2017/8/5 20:00:00</dd>--}}
{{--</dl>--}}
{{--</div>--}}

{{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />--}}
{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>--}}
{{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>--}}

{{--<style>--}}
{{--#Box {--}}
{{--border: 1px solid red;--}}
{{--width:400px;--}}
{{--height: 500px;--}}
{{--}--}}

{{--p {--}}
{{--width:200px;--}}
{{--margin-left: 40%;--}}
{{--display: block;--}}
{{--}--}}

{{--dl dt {--}}
{{--margin-left: 0;--}}
{{--}--}}
{{--</style>--}}