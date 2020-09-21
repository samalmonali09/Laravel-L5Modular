









<?php $__env->startSection('AUTOIG','active open'); ?>
<?php $__env->startSection('Niche','active open'); ?>
<?php $__env->startSection('pagecontent'); ?>

    <h3 class="page-title" style="color: #0d3625">
        Niche List
    </h3>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="/admin/NicheTable">AUTOIG</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="/admin/AddNiche"> Add Niche </a>
            </li>
        </ul>
    </div>
    <h1 class="page-title" style="color:#0a4063">Add Niche</h1>
    <div class="row" style="min-height:470px;">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    
                </div>

                <div class="panel-body">
                    <?php if(session('planMsg')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session('planMsg')); ?>

                        </div>
                    <?php endif; ?>
                    <?php if(session('error')): ?>
                        <div class="alert alert-danger">
                            <?php echo e(session('error')); ?>

                        </div>
                    <?php endif; ?>

                        <form class="form" role="form" method="post" action="/admin/AddNiche">
                            <div class="form-group floating-label" center>
                                <label for="demo1"style="color: black">Niche</label>
                                <input class="form-control" id="demo1" type="niche" name="niche" >
                                <div class="error" style="color:red"><?php echo e($errors->first('niche')); ?></div>
                            </div>
                            
                                
                                
                                
                            

                            <button type="submit" class="btn  btn-success">Add</button>
                            <a href="<?php echo e(URL::previous()); ?>" class="btn blue" style="margin-left:1%;" type="button"><i
                                        class="fa fa-arrow-circle-left"></i>
                                Back To Niche
                            </a>
                        </form>

                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('pagescripts'); ?>
    <script type="text/javascript">
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin::Layouts.adminlayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>