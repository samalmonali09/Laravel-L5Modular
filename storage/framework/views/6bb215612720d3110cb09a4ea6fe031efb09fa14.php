

<?php $__env->startSection('GILE','active'); ?>
<?php $__env->startSection('GILEFN','active'); ?>

<?php $__env->startSection('pagecontent'); ?>
    <!-- BEGIN PAGE HEADER-->

    <link rel="shortcut icon" href="favicon.ico"/>

    <?php if(session('status')): ?>
        <div class="alert alert-info">
            <?php echo e(session('status')); ?>

        </div>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <div class="alert alert-success">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>
    <h3 class="page-title"  style="color: #06738b">
        Flash Message
        <small>Popup screen for mobile</small>
    </h3>
    <form class="pull-right">
        <p class="onmsg" style="background: #49c6f5;
           padding: 10px;
           color: #fff;
           box-shadow: 0px 0px 5px #000000;
           position: absolute;
           margin-top: -4%;margin-left:1%;"></p>

        <label for="flip-checkbox-1">Flash Message Status</S>:</label>
        <input data-role="flipswitch" value="<?php echo e($msg_status); ?>" name="flip-checkbox-1" id="checkbox" class="make-switch"
               type="checkbox">    </form>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    <div class="portlet-body">
        <div class="tabs-left row">
            <div class="col-md-12 col-xs-12">
                
                
                
                
                
                
                
                
                
                
                <div class="row" >
                    <div class="col-lg-12">
                        <div class="row">
                            <form method="post" >
                                <div class="form-group ">
                                    <label for="summary-ckeditor">Body</label>
                                    <textarea name="summary" required class="form-control"  id="summary-ckeditor"><?php echo e($data); ?></textarea>
                                </div>
                                <button type="submit" class="btn btn-success">Submit</button>
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
    
    <script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
    <script>

        CKEDITOR.replace('summary-ckeditor');
        $('.onmsg').hide();
        if ($("#checkbox").val() == 'ON') {
            $('#checkbox').prop('checked', true);
        }


        $('#checkbox').on('switchChange.bootstrapSwitch', function (e, data) {
            var message = ''

            if (this.checked) {
                message = 'ON'
                $('.onmsg').show();
                setTimeout(function () {
                    $('.onmsg').hide();
                }, 2000)
                $(".onmsg").html("<b>pop-up</b> will be displayed in app ");

            } else {
                message = 'OFF'
                $('.onmsg').show();
                setTimeout(function () {
                    $('.onmsg').hide();
                }, 2000)

                $(".onmsg").html("app will open without  <b>pop-up</b>");

            }
            $.ajax({
                url: '/admin/flash-message-status',
                dataType: 'json',
                type: 'post',
                data: {
                    'registered_through': message
                },


            })

        });
    </script>
<?php $__env->stopSection(); ?>






<?php echo $__env->make('Admin::Layouts.adminlayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>