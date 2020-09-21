<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AddOn Invoice</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    {{--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">--}}
    <link href="/assets/css/fa-animation/font-awesome.min.css" rel="stylesheet">
    {{--<link href="/assets/css/fa-animation/font-awesome-animation.min.css" rel="stylesheet">--}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


    {{--<link rel="stylesheet" href="css/bootstrap.css">--}}

    <style>
        /*.height {*/
        /*min-height: 200px;*/
        /*}*/

        /*.icon {*/
        /*font-size: 47px;*/
        /*color: #5CB85C;*/
        /*}*/

        /*.iconbig {*/
        /*font-size: 77px;*/
        /*color: #5CB85C;*/
        /*}*/

        .table > tbody > tr > .emptyrow {
            border-top: none;
        }

        .table > thead > tr > .emptyrow {
            border-bottom: none;
        }

        .table > tbody > tr > .highrow {
            border-top: 2px solid;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="col-md-12 col-xs-12">
                        <img src="{{$decoded['item_number']['display_url']}}"
                             style="height: 150px; width: 250px; border: 1px solid #ddd; border-radius: 4px; padding: 5px; margin-left: auto; margin-right: auto; display: block"
                             class="img-responsive" alt="{{$decoded['item_number']['order_url']}}">
                        <hr style="border-top: 1px solid #c9c9c9;">
                    </div>
                    <h3 class="text-center"><strong>Order summary</strong></h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                            <tr>
                                <td><strong>Service</strong></td>
                                <td class="text-center"><strong>Quantity</strong></td>
                                <td class="text-center"><strong>Price</strong></td>
                                {{--<td class="text-right"><strong>Total</strong></td>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($decoded['item_number']))
                                @if(isset($decoded['item_number']['likes']) && $decoded['item_number']['likes'] == "on")
                                    <tr>
                                        <td>Likes <i class="fa fa-heart faa-heart animated"></i></td>
                                        <td class="text-center">{{$decoded['item_number']['likes_quantity']}}</td>
                                        <td class="text-center">
                                            ${{$decoded['item_number']['likes_price_per_k']/1000 * $decoded['item_number']['likes_quantity']}}</td>
                                        {{--<td class="text-right">$900</td>--}}
                                    </tr>
                                @endif
                                @if(isset($decoded['item_number']['views']) && $decoded['item_number']['views'] == "on")
                                    <tr>
                                        <td>Views <i class="fa fa-eye faa-eye animated"></i></td>
                                        <td class="text-center">{{$decoded['item_number']['views_quantity']}}</td>
                                        <td class="text-center">
                                            ${{$decoded['item_number']['views_price_per_k']/1000 * $decoded['item_number']['views_quantity']}}</td>
                                        {{--<td class="text-right">$900</td>--}}
                                    </tr>
                                @endif
                                @if(isset($decoded['item_number']['comments']) && $decoded['item_number']['comments'] == "on")
                                    <tr>
                                        <td>Comments <i class="fa fa-comments faa-comments animated"></i></td>
                                        <td class="text-center">{{$decoded['item_number']['comments_quantity']}}</td>
                                        <td class="text-center">
                                            ${{$decoded['item_number']['comments_price_per_k']/1000 * $decoded['item_number']['comments_quantity']}}</td>
                                        {{--<td class="text-right">$900</td>--}}
                                    </tr>
                                @endif
                                @if(isset($decoded['item_number']['impressions']) && $decoded['item_number']['impressions'] == "on")
                                    <tr>
                                        <td>Impressions <i class="material-icons">timeline</i></td>
                                        <td class="text-center">{{$decoded['item_number']['impressions_quantity']}}</td>
                                        <td class="text-center">
                                            ${{$decoded['item_number']['impressions_price_per_k']/1000 * $decoded['item_number']['impressions_quantity']}}</td>
                                        {{--<td class="text-right">$900</td>--}}
                                    </tr>
                                @endif
                            @endif
                            <tr>
                                <td class="highrow"></td>
                                {{--<td class="highrow"></td>--}}
                                <td class="highrow text-center"><strong>Subtotal</strong></td>
                                <td class="highrow text-right">${{$decoded['item_number']['total_price']}}<sup>*</sup>
                                </td>
                            </tr>
                            <tr>
                                <td class="emptyrow" colspan="3">
                                    <small style="color: #4A4A4A; margin-left: 10px;"><i><sup>*</sup> VAT will be
                                            included based on location</i></small>
                                </td>
                                {{--<td class="emptyrow"></td>--}}
                                {{--<td class="emptyrow text-center"><strong>Shipping</strong></td>--}}
                                {{--<td class="emptyrow text-right">$20</td>--}}
                            </tr>
                            {{--<tr>--}}
                            {{--<td class="emptyrow"><i class="fa fa-barcode iconbig"></i></td>--}}
                            {{--<td class="emptyrow"></td>--}}
                            {{--<td class="emptyrow text-center"><strong>Total</strong></td>--}}
                            {{--<td class="emptyrow text-right">$978.00<sup>*</sup></td>--}}
                            {{--</tr>--}}
                            </tbody>
                        </table>
                    </div>

                    <form action="{{env('WEB_URL')}}/addoncheckout/{{$checkout_token}}" method="POST"
                          id="quadernoForm"
                          class="text-center">
                        <script
                                src="https://checkout.quaderno.io/checkout.js" class="quaderno-button btn btn-lg"
                                data-type="charge"
                                data-key="pk_test_EutEdyk9z2z-7HA39GQn"
                                data-charge="{{$encoded}}"
                                data-gateway="paypal"
                                data-description="{{$decoded['description']}}"
                                data-amount="{{$decoded['amount']}}"
                                data-label="Pay with PayPal"
                                data-color="#808080"
                                data-currency="USD">
                        </script>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>