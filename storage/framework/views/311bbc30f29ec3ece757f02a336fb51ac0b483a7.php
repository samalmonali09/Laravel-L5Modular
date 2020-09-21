<!DOCTYPE html>

<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-5 col-sm-6 col-xs-12 col-md-push-4 col-sm-push-6">
                <div class="panel panel-default">
                    <div class="panel-heading text-center" style="background-color: #cc4177;color:#e8ff4a;">
                        <h4>Checkout</h4>
                    </div>
                    <div class="panel-body" style="background: #D1D1D1; color:#1a1818;">

                        <div class="col-md-12">
                            <img src="<?php echo e($decoded['item_number']['display_url']); ?>"
                                 style="height: 150px; width: 250px; border: 1px solid #ddd; border-radius: 4px; padding: 5px;" class="img-responsive">
                            <hr style="border-top: 1px solid #c9c9c9;">
                        </div>

                        <div class="col-md-12">
                            <strong>Package</strong>
                            <div class="pull-right"><span><?php echo e($decoded['package_details']['package_name']); ?></span>
                            </div>
                            <hr style="border-top: 1px solid #c9c9c9;">
                        </div>
                        <div class="col-md-12">
                            <strong>Quantity</strong>
                            <div class="pull-right"><span><?php echo e($decoded['package_details']['quantity']); ?></span><span
                                        class="fa fa-comments"></span></div>
                            <hr style="border-top: 1px solid #c9c9c9;">
                        </div>
                        <div class="col-md-12">
                            <strong>Price</strong>
                            <div class="pull-right">
                                <span>$<?php echo e(number_format($decoded['package_details']['price'],2)); ?></span>
                                <sup>*</sup>
                            </div>
                            <hr style="border-top: 1px solid #c9c9c9;">
                        </div>
                        
                            
                            
                                                         
                            
                        
                        
                        
                        
                        
                        
                        <div class="col-md-12">
                            <strong>Start Count</strong>
                            <div class="pull-right"><span><?php echo e($decoded['item_number']['start_count']); ?></span></div>
                            <hr style="border-top: 1px solid #c9c9c9;">
                        </div>

                        <small style="color: #a08d8d; margin-left: 10px;"><i><sup>*</sup> VAT will be included based on location</i></small>
                        <br><br>


                        <form action="<?php echo e(env('APP_URL')); ?>/checkout/<?php echo e($checkout_token); ?>" method="POST"
                              id="quadernoForm"
                              class="text-center">
                            <script
                                    src="https://checkout.quaderno.io/checkout.js" class="quaderno-button btn btn-lg"
                                    data-type="charge"
                                    data-key="pk_test_EutEdyk9z2z-7HA39GQn"
                                    data-charge="<?php echo e($encoded); ?>"
                                    data-gateway="paypal"
                                    data-description="Testing one time payment for AUTOIG"
                                    data-amount="<?php echo e($decoded['amount']); ?>"
                                    data-label="Pay with PayPal"
                                    
                                    data-currency="USD">
                            </script>
                        </form>
                        
                    </div>
                    <div class="pull-right">&copy;testing BOND&trade;</div>

                </div>
            </div>
        </div>
    </div>

</div>
</body>

</html>



