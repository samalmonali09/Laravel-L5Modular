




<?php $__env->startSection('pagecontent'); ?>
    <!-- BEGIN PAGE HEADER-->

    <link rel="shortcut icon" href="favicon.ico"/>


    <h3 class="page-title" style="color: #0d3625">
        Edit Profile
    </h3>
    <?php if(session()->has('message')): ?>
        <div class="alert alert-success">
            <?php echo e(session()->get('message')); ?>

        </div>
    <?php endif; ?>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    <div class="portlet-body">
        <div class="tabs-left row">
            <div class="col-md-12 col-xs-12">
                <div id="e">
                    <div class="row" style="margin-top:3%;">
                        <div class="col-md-12">
                            <?php if(session('status')): ?>
                                <div class="alert alert-success">
                                    <?php echo e(session('status')); ?>

                                </div>
                            <?php endif; ?>
                            <?php if(session('error')): ?>
                                <div class="alert alert-dangers">
                                    <?php echo e(session('error')); ?>

                                </div>
                            <?php endif; ?>
                            <form class="form" role="form" method="post" action="/admin/editAccount/<?php echo e($result->id); ?>">
                                
                                <div class="form-group floating-label">
                                    <label for="demo1" style="color: black">First Name</label>
                                    <input class="form-control" id="demo1" type="text" name="firstname"
                                           value="<?php echo e($result->firstname); ?>">
                                    <a class="error" style="color: red"><?php echo e($errors->first('firstname')); ?></a><br>

                                </div>
                                <div class="form-group floating-label">
                                    <label for="demo1" style="color: black">Last Name</label>
                                    <input class="form-control" id="demo1" type="text" name="lastname"
                                           value="<?php echo e($result->lastname); ?>">
                                    <a class="error" style="color: red"><?php echo e($errors->first('lastname')); ?></a><br>

                                </div>
                                <div class="form-group floating-label">
                                    <label for="demo1" style="color: black">UserName</label>
                                    <input class="form-control" id="demo1" type="text" name="username"
                                           value="<?php echo e($result->username); ?>">
                                    <a class="error" style="color: red"><?php echo e($errors->first('username')); ?></a><br>


                                </div>
                                <div class="form-group floating-label">
                                    <label for="demo1"style="color: black">Email</label>
                                    <input class="form-control" id="demo1" type="email" name="email"
                                           value="<?php echo e($result->email); ?>">
                                    <a class="error" style="color: red"><?php echo e($errors->first('email')); ?></a><br>

                                </div>

                                
                            <div class="form-group">
                                <button class="btn btn-circle btn-primary"  type="submit"
                                        id="submitUpdatePassword"><i
                                            class="fa fa-arrow-circle-right"></i> Save Settings
                                </button>



                                <a href="<?php echo e(URL::previous()); ?>" class="btn btn-circle  btn-warning" style="margin-left:1%;" type="button"><i
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