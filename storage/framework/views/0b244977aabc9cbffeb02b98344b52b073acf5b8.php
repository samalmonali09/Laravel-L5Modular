









<?php $__env->startSection('AUTOIG','active open'); ?>
<?php $__env->startSection('SPAUTOIG','active open'); ?>

<?php $__env->startSection('pagecontent'); ?>



    <h3 class="page-title" style="color: #0d3625">
        Subscription Package
    </h3>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="/admin/SubscriptionDatatable">AUTOIG</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="/admin/AddSubcription">Add Subscription Packages</a>
            </li>
        </ul>
    </div>
    <h1 class="page-title" style="color:#0a4063">Add Subscription</h1>
    <div class="row" style="min-height:470px;">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    
                </div>

                <div class="panel-body">
                    <?php if(session('packageMsg')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session('packageMsg')); ?>

                        </div>
                    <?php endif; ?>
                    <?php if(session('error')): ?>
                        <div class="alert alert-danger">
                            <?php echo e(session('error')); ?>

                        </div>
                    <?php endif; ?>


                    <form class="form" role="form" method="post" action="/admin/AddSubcription">
                        <div class="row">

                            <div class="form-group floating-label col-md-6">
                                <label for="demo1" style="color: black">sub_package_name</label>
                                <input class="form-control" id="demo1" type="text" name="sub_package_name"
                                       value="<?php echo e(old('sub_package_name')); ?>">

                                <div class="error" style="color:red"><?php echo e($errors->first('sub_package_name')); ?></div>
                            </div>


                            <div class="form-group floating-label col-md-6">
                                <label for="demo1" style="color: black">Quantity</label>
                                <input class="form-control" id="demo1" type="quantity" name="quantity"
                                       placeholder="quantity"
                                       value="<?php echo e(old('quantity')); ?>">

                                <div class="error" style="color:red"><?php echo e($errors->first('quantity')); ?></div>
                            </div>
                            <div class="form-group floating-label col-md-6">
                                <label for="demo1" style="color: black">sub_package_type</label>
                                <select class="form-control" name="sub_package_type" id="demo1" value="<?php echo e(old('sub_package_type')); ?>" >
                                    <option value="<?php echo e(old('sub_package_type')); ?>">select...</option>
                                    <option value="autolikes">autolikes</option>
                                    <option value="autoviews">autoviews</option>
                                </select>
                                <div class="error" style="color:red"><?php echo e($errors->first('sub_package_type')); ?></div>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group floating-label col-md-6">
                                        <div> <input class="packageType" type="checkbox" id="daily" name="daily_details"/>

                                            <label  for="daily" for="DailyPost">Daily</label>
                                            
                                            <div id="dailyDetails" class="form-group floating-label col-md-12" hidden>
                                                <div class="form-group floating-label">
                                                    <label class="control-label" style="color: black" for=""><i
                                                                class="fa fa-dollar"></i>Price:&nbsp;&nbsp;&nbsp;</label>
                                                    <input type="text" class="form-control" name="daily_price" id="price"  min="1" max=""
                                                           placeholder=""  value="<?php echo e(old('daily_price')); ?>" />
                                                    <div class="error" style="color:red"><?php echo e($errors->first('daily_price')); ?></div>

                                                </div>

                                                <div class="form-group floating-label col-md-6 offset-md-6">
                                                    <label class="control-label" style="color: black" for="">Billing Frequency: [Day]</label>
                                                    <input type="text" class="form-control" name="daily_billing_frequency" min="1" max=""
                                                           id="billing_frequency"
                                                           placeholder=""   value="<?php echo e(old('daily_billing_frequency')); ?>" />
                                                    <div class="error" style="color:red"><?php echo e($errors->first('daily_billing_frequency')); ?></div>

                                                </div>


                                                <div class="form-group floating-label col-md-6">
                                                    <label class="control-label" style="color: black"
                                                           for="">PostLimit:&nbsp;&nbsp;</label>
                                                    <input type="text" class="form-control" name="daily_post_limit" id="post_limit"
                                                           min="1" max="" placeholder="" value="<?php echo e(old('daily_post_limit')); ?>" />
                                                    <div class="error" style="color:red"><?php echo e($errors->first('daily_post_limit')); ?></div>

                                                </div>


                                                <div class="form-group floating-label col-md-6">
                                                    <label class="control-label" style="color: black" for="">Daily_post_limit:&nbsp;&nbsp;</label>
                                                    <input type="text" class="form-control" name="daily_daily_post_limit" min="1" max=""
                                                           id="daily_post_limit"
                                                           placeholder=""  value="<?php echo e(old('daily_daily_post_limit')); ?>" />
                                                    <div class="error" style="color:red"><?php echo e($errors->first('daily_daily_post_limit')); ?></div>


                                                </div>


                                                <div class="form-group floating-label col-md-6">
                                                    <label class="control-label" style="color: black" for="">Plan_id:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                                    
                                                    
                                                    <select class="form-control select2" name="plan_id" id="plan_id"  value="<?php echo e(old('plan_id')); ?>" >
                                                        <option  value="<?php echo e(old('plan_id')); ?>" selected>Select Plan</option>

                                                        <?php if(isset($plans)): ?>
                                                            <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($plan['plan_id']); ?>"><?php echo e($plan['plan_name']); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                        <?php else: ?>
                                                            There is no any plan to select
                                                        <?php endif; ?>
                                                    </select>
                                                    <div class="error" style="color:red"><?php echo e($errors->first('plan_id')); ?></div>


                                                </div>
                                            </div>

                                        </div>
                                        <div><input class="packageType" type="checkbox" id="weekly" name="weekly_details">
                                            <label  for ="weekly" for="WeeklyPost">Weekly</label>

                                            <div id="weeklyDetails" class="form-group floating-label col-md-12" hidden>
                                                <div class="form-group floating-label">
                                                    <label class="control-label" style="color: black" for=""><i
                                                                class="fa fa-dollar"></i>Price:&nbsp;&nbsp;&nbsp;</label>
                                                    <input type="text" class="form-control" name="weekly_price" id="price" min="1" max=""
                                                           step="any"placeholder=""  value="<?php echo e(old('weekly_price')); ?>"/>
                                                    <div class="error" style="color:red"><?php echo e($errors->first('weekly_price')); ?></div>


                                                </div>

                                                <div class="form-group floating-label col-md-6">
                                                    <label class="control-label" style="color: black" for="">Billing Frequency: [Week]</label>
                                                    <input type="text" class="form-control" name="weekly_billing_frequency" min="1" max
                                                           id="billing_frequency" value="<?php echo e(old('weekly_billing_frequency')); ?>"
                                                           placeholder=""/>
                                                    <div class="error" style="color:red"><?php echo e($errors->first('weekly_billing_frequency')); ?></div>


                                                </div>
                                                <div class="form-group floating-label col-md-6">
                                                    <label class="control-label" style="color: black"
                                                           for="">PostLimit:&nbsp;&nbsp;</label>
                                                    <input type="text" class="form-control" name="weekly_post_limit" id="post_limit"
                                                           min="1" max=""  placeholder="" value="<?php echo e(old('weekly_post_limit')); ?>"/>
                                                    <div class="error" style="color:red"><?php echo e($errors->first('weekly_post_limit')); ?></div>

                                                </div>

                                                <div class="form-group floating-label col-md-6">
                                                    <label class="control-label" style="color: black" for="">Daily_post_limit:&nbsp;&nbsp;</label>
                                                    <input type="text" class="form-control" name="weekly_daily_post_limit" min="1" max=""
                                                           id="daily_post_limit" value="<?php echo e(old('weekly_daily_post_limit')); ?>"
                                                           placeholder=""/>
                                                    <div class="error" style="color:red"><?php echo e($errors->first('weekly_daily_post_limit')); ?></div>


                                                </div>
                                                <div class="form-group floating-label col-md-6">
                                                    <label class="control-label" style="color: black" for="">Plan_id:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                                    
                                                    


                                                    <select class="form-control select2" name="weekly_plan_id" id="plan_id" value="<?php echo e(old('weekly_plan_id')); ?>">
                                                        <option value="" selected>Select Plan</option>

                                                        <?php if(isset($plans)): ?>
                                                            <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($plan['plan_id']); ?>"><?php echo e($plan['plan_name']); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                        <?php else: ?>
                                                            There is no any plan to select
                                                        <?php endif; ?>
                                                    </select>
                                                    <div class="error" style="color:red"><?php echo e($errors->first('weekly_plan_id')); ?></div>


                                                </div>
                                            </div>

                                        </div>
                                        <div><input class="packageType" type="checkbox" id="monthly" name="monthly_details">
                                            <label  for="monthly"for="MonthlyPost">Monthly</label>
                                            <div id="monthlyDetails" class="form-group floating-label col-md-12" hidden>
                                                <div class="form-group floating-label">
                                                    <label class="control-label" style="color: black" for=""><i
                                                                class="fa fa-dollar"></i>Price:&nbsp;&nbsp;&nbsp;</label>
                                                    <input type="text" class="form-control" name="monthly_price" id="price" min="1" max="" value="<?php echo e(old('monthly_price')); ?>"
                                                           step="any"    placeholder=""/>
                                                    <div class="error" style="color:red"><?php echo e($errors->first('monthly_price')); ?></div>

                                                    

                                                </div>

                                                <div class="form-group floating-label col-md-6">
                                                    <label class="control-label" style="color: black" for="">Billing Frequency: [Month]</label>
                                                    <input type="text" class="form-control" name="monthly_billing_frequency" min="1" max=""  value="<?php echo e(old('monthly_billing_frequency')); ?>"
                                                           id="billing_frequency"
                                                           placeholder=""/>
                                                    <div class="error" style="color:red"><?php echo e($errors->first('monthly_billing_frequency')); ?></div>

                                                    

                                                </div>
                                                <div class="form-group floating-label col-md-6">
                                                    <label class="control-label" style="color: black"
                                                           for="">PostLimit:&nbsp;&nbsp;</label>
                                                    <input type="text" class="form-control" name="monthly_post_limit" id="post_limit"
                                                           min="1" max=""  placeholder="" value="<?php echo e(old('monthly_post_limit')); ?>"/>
                                                    <div class="error" style="color:red"><?php echo e($errors->first('monthly_post_limit')); ?></div>

                                                </div>

                                                <div class="form-group floating-label col-md-6">
                                                    <label class="control-label" style="color: black" for="">Daily_post_limit:&nbsp;&nbsp;</label>
                                                    <input type="text" class="form-control" name="monthly_daily_post_limit" min="1" max="" value="<?php echo e(old('monthly_daily_post_limit')); ?>"
                                                           id="daily_post_limit"
                                                           placeholder=""/>
                                                    <div class="error" style="color:red"><?php echo e($errors->first('monthly_daily_post_limit')); ?></div>


                                                </div>
                                                <div class="form-group floating-label col-md-6">
                                                    <label class="control-label" style="color: black" for="">Plan_id:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                                    
                                                    
                                                    <select class="form-control select2" name="monthly_plan_id" id="plan_id" value="<?php echo e(old('monthly_plan_id')); ?>">
                                                        <option value="" selected>Select Plan</option>
                                                        <?php if(isset($plans)): ?>
                                                            <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($plan['plan_id']); ?>"><?php echo e($plan['plan_name']); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                        <?php else: ?>
                                                            There is no any plan to select
                                                        <?php endif; ?>
                                                    </select>
                                                    <div class="error" style="color:red"><?php echo e($errors->first('monthly_plan_id')); ?></div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        
                        <fieldset class="question" class="form-group floating-label col-md-6">
                            <label for="coupon_question" style="color: black">Views:&nbsp;&nbsp;&nbsp;</label>
                            <input id="coupon_question" class="form-control" type="checkbox" name="coupon_question"/>
                            

                            <span class="item-text"></span>
                        </fieldset>

                        <fieldset class="answer" class="form-group floating-label col-md-6" hidden>
                            <label for="coupon_field" style="color: black">Views_per_post:&nbsp;&nbsp;</label>
                            <input type="text" class="form-control" name="views_per_post"  id="views_per_post"  value="<?php echo e(old('views_per_post')); ?>" /><br>
                            <div class="error" style="color:red"><?php echo e($errors->first('views_per_post')); ?></div>

                        </fieldset>

                        <fieldset class="answer" class="form-group floating-label col-md-6" hidden>
                            <label for="coupon_field" style="color: black">Views_plan_id:&nbsp;&nbsp;&nbsp;</label>

                            <select class="form-control select2" name="views_plan_id" id="views_plan_id" value="<?php echo e(old('views_plan_id')); ?>" >
                                <option value="" selected>Select Plan</option>
                                <?php if(isset($plans)): ?>
                                    <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($plan['plan_id']); ?>"><?php echo e($plan['plan_name']); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php else: ?>
                                    There is no any plan to select
                                <?php endif; ?>
                            </select>
                            <div class="error" style="color:red"><?php echo e($errors->first('views_plan_id')); ?></div>

                        </fieldset>

                        <fieldset class="answer" class="form-group floating-label col-md-6" hidden>
                            <label for="coupon_field" style="color: black">Views_price:&nbsp;&nbsp;&nbsp;</label>

                            <input type="text" class="form-control" name="views_price" id="views_price" value="<?php echo e(old('views_price')); ?>"
                                   placeholder="" />
                            <div class="error" style="color:red"><?php echo e($errors->first('views_price')); ?></div>

                        </fieldset>
                        <div class="col-md-6">

                            <button type="submit" class="btn  btn-primary" title="Add"><i
                                        class="fa fa-refresh"></i>Add</button>


                            <a href="<?php echo e(URL::previous()); ?>" class="btn  blue" style="margin-left:1%;" type="button" title="cancel"><i
                                        class="fa fa-times"></i>
                                Cancel
                            </a>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('pagescripts'); ?>
    <script type="text/javascript">

        var Package = $('.packageType').val();

        $('#packagename').show();
        $(document.body).on('click', '.packageType', function () {
            if ($(this).val() == "MonthlyPost") {
                $('#packagename').hide();
                Package = "WeeklyPost";
            } else {
                $('#packagename').show();
                Package = "DailyPost";
            }

        });


        // $(function (e) {
        $("#coupon_question").on("click", function () {
            // $("#coupon_question").click( function () {
            // $("input:checkbox:checked").attr("checked", "");
            if ($(this).is(':checked'))
                $(".answer").show();
            else
                $(".answer").hide();
        });
        // });





        $('#daily').click(function () {
            if ($(this).is(':checked'))
                $('#dailyDetails').show();
            else
                $('#dailyDetails').hide();
        });

        $('#weekly').click(function () {
            if ($(this).is(':checked'))
                $('#weeklyDetails').show();
            else
                $('#weeklyDetails').hide();
        });
        $('#monthly').click(function () {

            if ($(this).is(':checked'))
                $('#monthlyDetails').show();
            else
                $('#monthlyDetails').hide();


        });

        function showViewError(id) {
            $('#'+id).trigger('click');
        }

        function showError(id) {
            $('#'+id).trigger('click');
        }
        function showWeekError(id) {
            $('#'+id).trigger('click');
        }

        function showMonthError(id) {
            $('#'+id).trigger('click');
        }

        $(document).ready(function () {
                    <?php if(\Session::has('errorDiv')): ?>
            var id = '<?php \Session::get('errorDiv') ?>';
            showError('daily');
            <?php endif; ?>
        })
        $(document).ready(function () {
                    <?php if(\Session::has('errorDiv1')): ?>
            var id = '<?php \Session::get('errorDiv1') ?>';
            showWeekError('weekly');
            <?php endif; ?>
        })
        $(document).ready(function () {
                    <?php if(\Session::has('errorDiv2')): ?>
            var id = '<?php \Session::get('errorDiv2') ?>';
            showMonthError('monthly');
            <?php endif; ?>
        })

        $(document).ready(function () {
                    <?php if(\Session::has('errorDiv3')): ?>
            var id = '<?php \Session::get('errorDiv3') ?>';
            showViewError('coupon_question');
            <?php endif; ?>
        })

    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin::Layouts.adminlayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>