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
                            <?php if(isset($data['media_image_url']) && !empty(['media_image_url'])): ?>
                                <?php if($data['package_type']==3 or $data['package_type']==0): ?>
                                    <center><img src="<?php echo e($data['media_image_url']); ?>"
                                                 style="height: 150px; width: 250px; border: 1px solid #ddd; border-radius: 4px; padding: 5px;"
                                                 class="img-responsive"></center>
                                    <hr style="border-top: 1px solid #c9c9c9;">

                                <?php elseif(isset($data['display_url']) && !empty(['display_url'])): ?>
                                    <center><img src="<?php echo e($data['display_url']); ?>"
                                                 style="height: 150px; width: 250px; border: 1px solid #ddd; border-radius: 4px; padding: 5px;"
                                                 class="img-responsive"></center>
                                    <hr style="border-top: 1px solid #c9c9c9;">

                                <?php endif; ?>
                            <?php endif; ?>



                            <?php if($data['package_type']==4 ): ?>
                                <center><img src="<?php echo e($data['media_image_url']); ?>"
                                             style="height: 150px; width: 250px; border: 1px solid #ddd; border-radius: 4px; padding: 5px;"
                                             class="img-responsive"></center>
                                <hr style="border-top: 1px solid #c9c9c9;">
                            <?php endif; ?>
                        </div>
                        <div class="col-md-12">
                            <strong>пакет</strong>
                            <div class="pull-right"><span><?php echo e($data['package_name']); ?></span>
                            </div>
                            <hr style="border-top: 1px solid #c9c9c9;">
                        </div>
                        <div class="col-md-12">
                            <strong>количество</strong>
                            <div class="pull-right"><span><?php echo e($data['quantity']); ?></span><span
                                        class="fa fa-comments"></span></div>
                            <hr style="border-top: 1px solid #c9c9c9;">
                        </div>
                        <div class="col-md-12">
                            <strong>цена</strong>
                            <div class="pull-right">
                                <span>$<?php echo e(number_format($data['price'],2)); ?></span>
                                <sup>*</sup>
                            </div>
                            <hr style="border-top: 1px solid #c9c9c9;">
                        </div>
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        

                        <div class="col-md-12">
                            <strong>Стартовый счетчик</strong>
                            <?php if($data['package_type']==0 && !empty($data['likes_count'])): ?>
                                <div class="pull-right"><span><?php echo e($data['likes_count']); ?></span></div>
                            <?php endif; ?>
                            <?php if(isset($data['followed_by']) && !empty(['followed_by'])): ?>
                                <div class="pull-right"><span><?php echo e($data['followed_by']); ?></span></div>

                            <?php endif; ?>
                            <?php if($data['package_type']==4): ?>
                                <div class="pull-right"><span><?php echo e($data['video_view_count']); ?></span></div>

                            <?php endif; ?>

                            
                            <?php if($data['package_type']==2 or $data['package_type']==3): ?>

                                <div class="pull-right"><span><?php echo e($data['comments_count']); ?></span></div>

                            <?php endif; ?>
                            <hr style="border-top: 1px solid #c9c9c9;">

                        </div>
                        <small style="color: #0b5189; margin-left: 10px;"><i><sup>*</sup> НДС (VAT) будет включен в зависимости от местоположения</i></small>
                        <br><br>


                        <form action="http://gaia.globusdemos.com/gilr/checkout/<?php echo e($checkoutToken); ?>" method="POST"
                              id="quadernoForm"
                              class="text-center">
                            <script
                                    src="https://checkout.quaderno.io/checkout.js" class="quaderno-button btn btn-lg"
                                    data-type="charge"
                                    data-key="pk_test_EutEdyk9z2z-7HA39GQn"
                                    
                                    data-charge="<?php echo e($encoded_jwt); ?>"
                                    data-gateway="paypal"
                                    data-description="Testing one time payment"
                                    data-amount="<?php echo e($data['price']*100); ?>"
                                    data-label="Оплата с PayPal"
                                    
                                    data-currency="USD">
                            </script>
                        </form>
                        
                    </div>
                    

                </div>
            </div>
        </div>
    </div>

</div>
</body>

</html>



