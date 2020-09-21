




<?php $__env->startSection('pagecontent'); ?>


    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="">

            <div class="row">
                <div class="col-md-12">


                    <div class="portlet-body">
                        <div class="tabs-left row">
                            <div class="col-md-12 col-xs-12">
                                <div id="a">
                                    <div class="row" style="margin-top:3%;">
                                        <div class="col-md-8 col-md-offset-2">
                                            <div class="page-head">
                                                <!-- BEGIN PAGE TITLE -->
                                                <div class="page-title">
                                                    

                                                </div>
                                                <!-- END PAGE TITLE -->

                                            </div>
                                            <a href="/admin/changePassword" name="logout" class="btn btn-success btn-circle" value="changePassword"><i class="fa fa-lock"></i>Change Password</a>
                                            <a href="/admin/editAccount/<?php echo e($data['id']); ?>" name="logout" class="btn  purple  btn-circle  pull-right" value="editmodal"><i class="icon-pencil"></i> Edit</a></br>
                                            </br>
                                            <ul class="page-breadcrumb breadcrumb">
                                                <li>
                                                    <a href="/admin/dashboard">Home</a>
                                                    <i class="icon-home"></i>
                                                </li>


                                            </ul>
                                            <table class="table table-hover table-condensed">
                                                <tbody>
                                                <tr>
                                                    <td><i class="fa fa-user"></i></td>
                                                    <td><?php echo e($data['username']); ?></td>
                                                    <td> Username</td>
                                                </tr>


                                                <tr>
                                                    <td><i class="fa fa fa-at"></i></td>
                                                    <td><?php echo e($data['email']); ?></td>
                                                    <td> E-Mail</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- End: life time stats -->
            </div>
        </div>
        <!-- END PAGE CONTENT-->
    </div>


    <!-- END CONTENT -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('pagescripts'); ?>

<?php $__env->stopSection(); ?>




<?php echo $__env->make('Admin::Layouts.adminlayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>