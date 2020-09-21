









<?php $__env->startSection('Comments','active open'); ?>

<?php $__env->startSection('pagecontent'); ?>
    <h3 class="page-title" style="color: #074c66">
        Manage Comments
    </h3>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="/admin/commentTable">Manage Comment</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="/admin/addingComments">Adding comments</a>
            </li>
        </ul>
    </div>
    <h1 class="page-title" style="color:#1e8d8f">Add Comments</h1>
    <div class="row" style="min-height:470px;">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                </div>
                <div class="panel-body" style="color: rebeccapurple">
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
                    <?php if(Session::has('message')): ?>
                        <?php if(session('status')=='Success'): ?>
                            <div style="color:#e4140c;"><b><?php echo e(session('status')); ?></b> <?php echo e(Session::get('message')); ?> <a
                                        href="/admin/commentTable">Go Back</a></div>
                        <?php elseif(session('status')=='Error'): ?>
                            <div style="color:#308f10;"><b><?php echo e(session('status')); ?></b> <?php echo e(Session::get('message')); ?></div>
                        <?php endif; ?>
                    <?php endif; ?>


                    <form class="form" role="form" method="post" action="/admin/addingComments">
                        
                        <div class="form-group floating-label">
                            <label for="demo1" style="color: black">Comment_group_name</label>
                            <input class="form-control" id="demo1" type="comment_group_name"  placeholder="comment_group_name" name="comment_group_name" required
                                   value="<?php echo e(old('comment_group_name')); ?> ">

                            <div class="error" style="color:red"><?php echo e($errors->first('comment_group_name')); ?></div>
                        </div>


                        <div class="form-group floating-label">
                            <label for="demo1" style="color: black">Comments</label>
                            <textarea class="form-control" id="demo1" type="text" name="comments[]" rows="10" cols="50" required
                                      value="<?php echo e(old('comments')); ?>"></textarea>

                            <div class="error" style="color:red"><?php echo e($errors->first('comments')); ?></div>
                        </div>


                        <button type="submit" class="btn  btn-primary"><i class="fa fa-check"></i>Save Changes</button>

                        <a href="<?php echo e(URL::previous()); ?>" class="btn  btn-warning" style="margin-left:1%;" type="button"><i
                                    class="fa fa-times"></i>
                            Cancel
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('pagescripts'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin::Layouts.adminlayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>