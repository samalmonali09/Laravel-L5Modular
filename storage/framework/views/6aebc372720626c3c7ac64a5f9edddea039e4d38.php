



<?php $__env->startSection('pagecontent'); ?>
    <!-- BEGIN PAGE HEADER-->

    <link rel="shortcut icon" href="favicon.ico"/>


    <h2 class="page-title" style="color: #19658b">
        Change Password Admin
    </h2>

    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    <div class="portlet-body">
        <div class="tabs-left row">
            <div class="col-md-12 col-xs-12">
                <div id="e">
                    <div class="row" style="margin-top:3%;">
                        <div class="col-md-12">
                            <div>
                                <?php if(session('status')): ?>
                                    <div class="alert alert-success">
                                        <?php echo e(session('status')); ?>

                                    </div>
                                <?php endif; ?>
                                <?php if(session('error')): ?>
                                    <div class="alert alert-danger">
                                        <?php echo e(session('error')); ?>

                                    </div>
                                <?php endif; ?>

                            </div>
                            <form class="" role="form" id="changePassword" action="/admin/changePassword" method="post">
                                <div class="form-group">
                                    <label class="">Old Password</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><span
                                                    class="fa fa-unlock"></span></div>
                                        <input type="password" class="form-control" id="oldPassword"
                                               name="password"
                                               placeholder="Your Current Password" value=""/>
                                        <a class="error" style="color: red"><?php echo e($errors->first('password')); ?></a><br>

                                    </div>
                                    <span style="color: red" id="oldPasswordError"></span>
                                </div>
                                <div class="form-group">
                                    <label class="">New Password</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="fa fa-lock"></span>
                                        </div>
                                        <input type="password" class="form-control" id="newPassword"
                                               name="newpassword" placeholder="New Password"
                                               value=""/>
                                        <a class="error" style="color: red"><?php echo e($errors->first('newpassword')); ?></a><br>

                                    </div>
                                    <span style="color: red" id="newPasswordError"></span>
                                </div>
                                <div class="form-group">
                                    <label class="">Confirm Password</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><span
                                                    class="fa fa-unlock-alt"></span>
                                        </div>
                                        <input type="password" class="form-control"
                                               id="conformNewPassword"
                                               name="confirmpassword"
                                               placeholder="Confirm New Password" value=""/>
                                        <a class="error"
                                           style="color: red"><?php echo e($errors->first('confirmpassword')); ?></a><br>

                                    </div>
                                    <span style="color: red" id="conformNewPasswordError"></span>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-circle btn-primary" type="submit"
                                            id="submitUpdatePassword"><i
                                                class="fa fa-arrow-circle-right"></i> Save Settings
                                    </button>
                                    
                                    


                                    

                                    <a href="<?php echo e(URL::previous()); ?>" class="btn btn-circle  btn-warning"
                                       style="margin-left:1%;" type="button"><i
                                                class="fa fa-times"></i>
                                        Cancel
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- END PAGE CONTENT-->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('pagescripts'); ?>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('Admin::Layouts.adminlayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>