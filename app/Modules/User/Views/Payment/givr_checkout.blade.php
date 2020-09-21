<!DOCTYPE html>

<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style>
        #quadernoForm {
            margin-right: 37px;

        }
    </style>
</head>

<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-5 col-sm-6 col-xs-12 col-md-push-4 col-sm-push-6">
                <div class="panel panel-default">
                    <div class="panel-heading text-center" style="background-color: #cc4177;color:#e8ff4a;">
                        <h4>проверять,выписываться </h4>
                    </div>

                    <div class="panel-body" style="background: #D1D1D1; color:#1a1818;">
                        <div class="col-md-12">
                            @if(isset($data['media_image_url']) && !empty(['media_image_url']))
                                @if($data['package_type']==3 or $data['package_type']==0)
                                    <center><img src="{{$data['media_image_url']}}"
                                                 style="height: 150px; width: 250px; border: 1px solid #ddd; border-radius: 4px; padding: 5px;"
                                                 class="img-responsive"></center>
                                    <hr style="border-top: 1px solid #c9c9c9;">

                                @elseif(isset($data['display_url']) && !empty(['display_url']))
                                    <center><img src="{{$data['display_url']}}"
                                                 style="height: 150px; width: 250px; border: 1px solid #ddd; border-radius: 4px; padding: 5px;"
                                                 class="img-responsive"></center>
                                    <hr style="border-top: 1px solid #c9c9c9;">

                                @endif
                            @endif



                            @if($data['package_type']==4 )
                                <center><img src="{{$data['media_image_url']}}"
                                             style="height: 150px; width: 250px; border: 1px solid #ddd; border-radius: 4px; padding: 5px;"
                                             class="img-responsive"></center>
                                <hr style="border-top: 1px solid #c9c9c9;">
                            @endif
                        </div>
                        <div class="col-md-12">
                            <strong>пакет</strong>
                            <div class="pull-right"><span>{{$data['package_name']}}</span>
                            </div>
                            <hr style="border-top: 1px solid #c9c9c9;">
                        </div>
                        <div class="col-md-12">
                            <strong>количество</strong>
                            <div class="pull-right"><span>{{$data['quantity']}}</span><span
                                        class="fa fa-comments"></span></div>
                            <hr style="border-top: 1px solid #c9c9c9;">
                        </div>
                        <div class="col-md-12">
                            <strong>цена</strong>
                            <div class="pull-right">
                                <span>${{number_format($data['price'],2)}}</span>
                                <sup>*</sup>
                            </div>
                            <hr style="border-top: 1px solid #c9c9c9;">
                        </div>
                        {{--<div class="col-md-12">--}}
                        {{--<strong>Media</strong>--}}
                        {{--<div class="pull-right"><img src="{{$decoded['item_number']['display_url']}}"--}}
                        {{--style="height: 60px; width: 80px; margin-top: -20px;"></div>--}}
                        {{--<hr style="border-top: 1px solid #c9c9c9;">--}}
                        {{--</div>--}}
                        {{--<div class="col-md-12">--}}
                        {{--<strong>Media Url</strong>--}}
                        {{--<div class="pull-right"><span>{{$decoded['link']}}</span></div>--}}
                        {{--<hr style="border-top: 1px solid #c9c9c9;">--}}
                        {{--</div>--}}

                        <div class="col-md-12">
                            <strong>Стартовый счетчик</strong>
                            @if($data['package_type']==0 && !empty($data['likes_count']))
                                <div class="pull-right"><span>{{$data['likes_count']}}</span></div>
                            @endif
                            @if(isset($data['followed_by']) && !empty(['followed_by']))
                                <div class="pull-right"><span>{{$data['followed_by']}}</span></div>

                            @endif
                            @if($data['package_type']==4)
                                <div class="pull-right"><span>{{$data['video_view_count']}}</span></div>

                            @endif

                            {{--                            @if(isset($data['comments_count']) && !empty(['comments_count']))--}}
                            @if($data['package_type']==2 or $data['package_type']==3)

                                <div class="pull-right"><span>{{$data['comments_count']}}</span></div>

                            @endif
                            <hr style="border-top: 1px solid #c9c9c9;">

                        </div>
                        <small style="color: #0b5189; margin-left: 10px;"><i><sup>*</sup> НДС (VAT) будет включен в зависимости от местоположения</i></small>
                        <br><br>


                        <form action="http://gaia.globusdemos.com/gilr/checkout/{{$checkoutToken}}" method="POST"
                              id="quadernoForm"
                              class="text-center">
                            <script
                                    src="https://checkout.quaderno.io/checkout.js" class="quaderno-button btn btn-lg"
                                    data-type="charge"
                                    data-key="pk_test_EutEdyk9z2z-7HA39GQn"
                                    {{--data-key="pk_live_3spPDWhkzqjMDakGxxz7"--}}
                                    data-charge="{{$encoded_jwt}}"
                                    data-gateway="paypal"
                                    data-description="Testing one time payment"
                                    data-amount="{{$data['price']*100}}"
                                    data-label="Оплата с PayPal"
                                    {{--data-color="#808080"--}}
                                    data-currency="USD">
                            </script>
                        </form>
                        {{--<button type="button" class="btn btn-primary btn-lg btn-block">Pay with Paypal</button>--}}
                    </div>
                    {{--<div class="pull-right">&copy;testing BOND&trade;</div>--}}

                </div>
            </div>
        </div>
    </div>

</div>
</body>

</html>



