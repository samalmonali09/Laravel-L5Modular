



<?php $__env->startSection($appName,'active open'); ?>
<?php $__env->startSection('AUTOIGMU','active open'); ?>


<?php $__env->startSection('pagecontent'); ?>
    <h1 class="page-title" style="color:#06738b">Add Users</h1>
    <div class="row" style="min-height:470px;">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                </div>
                <div class="panel-body" style="color: rebeccapurple">

                    <?php if(session('UserMsg')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session('UserMsg')); ?>

                        </div>
                    <?php endif; ?>
                    <?php if(session('error')): ?>
                        <div class="alert alert-danger">
                            <?php echo e(session('error')); ?>

                        </div>
                    <?php endif; ?>
                    <form class="form" role="form" method="post" action="/admin/AddingUser/<?php echo e($appName); ?>">


                        <div class="row">

                            <div class="form-group floating-label col-md-6">
                                <label for="demo1" style="color: black">UserName</label>
                                <input class="form-control" id="demo1" type="text" name="username"
                                       value="<?php echo e(old('username')); ?>">

                                <div class="error" style="color:red"><?php echo e($errors->first('username')); ?></div>
                            </div>

                            <div class="form-group floating-label col-md-6">
                                <label for="demo1" style="color: black">Password</label>
                                <input class="form-control" id="demo1" type="password" name="password"  value="<?php echo e(old('password')); ?>" placeholder="password">

                                <div class="error" style="color:red"><?php echo e($errors->first('password')); ?></div>
                            </div>

                            <div class="form-group floating-label col-md-6">
                                <label for="demo1"style="color: black">Email</label>
                                <input class="form-control" id="demo1" type="email" name="email"  placeholder="email"
                                       value="<?php echo e(old('email')); ?>">
                                <div class="error" style="color:red"><?php echo e($errors->first('email')); ?></div>
                            </div>


                            
                                
                                
                                    

                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                
                                
                            
                        </div>

                        <div class="col-md-6">
                            <button type="submit" class="btn  btn-primary">Submit</button>
                            <a href="<?php echo e(URL::previous()); ?>" class="btn  btn-warning" style="margin-left:1%;" type="button"><i
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

<?php $__env->stopSection(); ?>


<?php $__env->startSection('pagescripts'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin::Layouts.adminlayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>