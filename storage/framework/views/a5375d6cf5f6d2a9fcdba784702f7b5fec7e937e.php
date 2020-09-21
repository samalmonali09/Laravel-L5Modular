
<?php $__env->startSection('GIVR','active open'); ?>
<?php $__env->startSection('ModuleGIVR','active open'); ?>

<?php $__env->startSection('pageheadcontent'); ?>
    <!-- add extra css required for this page only -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

    <style>

        div.checker, div.checker span, div.checker input {
            height: 100% !important;
        }

        .toggle-on.btn {
            /*padding-right: 0 !important;*/
            padding-top: 10px;
        }

        .toggle-off.btn {
            /*padding-left: 0 !important;*/
            padding-top: 10px;
        }

        .checker {
            float: right;
            right: 40px;
        }

        .btn-file {
            position: relative;
            overflow: hidden;
        }

        .btn-file input[type=file] {
            position: absolute;
            top: 0;
            right: 0;
            min-width: 100%;
            min-height: 100%;
            font-size: 100px;
            text-align: right;
            filter: alpha(opacity=0);
            opacity: 0;
            outline: none;
            background: white;
            cursor: inherit;
            display: block;
        }

        #img-upload {
            width: 40%;

        }

    </style>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('pagecontent'); ?>

    <h3 class="page-title" style="color: #0d3625">
        Module SwitchGIVR

    </h3>

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="/admin/module-statusGIVR">Module Switch </a>
            </li>
        </ul>
    </div>
    <div class="col-md-4 col-md-offset-4">
        <div class="card" style="margin: 15px; border:1px solid #ccc; padding: 20px; font-size: 16px;">

            Black Hat Module <input data-toggle="toggle" type="checkbox" id="checkbox" style="float: right;">
        </div>
    </div>
    <div class="col-md-4 col-md-offset-4">
        <p class="onmsg" style="background: #0b414d;
        display: none;
        padding: 10px;
        color: #fff;
        box-shadow: 0px 0px 5px #000000;
        position: absolute;
        margin-top: -38%;margin-right: -109%;"></p><br>

    </div>
    <br>




    <div class="col-md-6">
        <h3 style="color: #0d1217">&nbsp; &nbsp; Activity Tracker </h3>

        <div class="col-md-12">
            <p class="onmsgTrack"
               style="display:none;background: #104d40; padding: 10px; color: #fff; box-shadow: 0px 0px 5px #000000;"></p>
            <br>
        </div>
        <div class="card" style="margin: 15px; border:1px solid #ccc; padding: 10px 10px 20px 10px; font-size: 16px;">
            Activity Tracker <input data-toggle="toggle" type="checkbox" value="<?php echo e($Tracker); ?>"
                                    <?php echo ($Tracker == 'ON') ? 'checked' : ''; ?> id="Trackcheckbox"
                                    style="float: right;">
        </div>
    </div>


    <div class="col-md-6">
        <h3 style="color: #0d1217">&nbsp; Duration</h3>

        <div class="col-md-12">
            <p class="onmsgTrack"
               style="display:none;background: #104d40; padding: 10px; color: #fff; box-shadow: 0px 0px 5px #000000;"></p>
            <br>
        </div>
        <div class="card "
             style="margin: 15px; border:1px solid #ccc; padding: 10px 10px 20px 10px; font-size: 16px;">
            Duration

            <select class="durationClass pull-right">
                <option value="0">Select Time</option>
                <option value="1 sec">1 sec</option>
                <option value="10 sec">10 sec</option>
                <option value="20 sec">20 sec</option>
                <option value="30 sec">30 sec</option>
                <option value="2 min">2 min</option>
                <option value="5 min">5 min</option>
                <option value="10 min">10 min</option>
                <option value="20 min">20 min</option>
                <option value="30 min">30 min</option>
                <option value="1 hr">1 hour</option>
            </select>
        </div>
    </div>

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

    


<?php $__env->stopSection(); ?>

<?php $__env->startSection('pagescripts'); ?>
    

    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <script>

        $(document).ready(function () {
            toastr.options.positionClass = 'toast-top-center';
            toastr.options.progressBar = true;
            toastr.options.preventDuplicates = true;
            toastr.options.closeButton = true;

            $('input[type="search"]').css({'height': '5px'});

            

            // $('.toggle').addClass('btn-primary');
            // $('.toggle').removeClass('btn-primary');
            var timeVal='<?php echo e($time); ?>';
            console.log(timeVal);

            $(".durationClass :selected").text(timeVal);

        });

        if ('<?php echo e($status); ?>' === 'ON') {
            $('#checkbox').prop("checked", true);
        }


        $(document).ready(function () {


            $(document).on('change', '.btn-file :file', function () {
                var input = $(this),
                    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                input.trigger('fileselect', [label]);
            });

            $('.btn-file :file').on('fileselect', function (event, label) {

                var input = $(this).parents('.input-group').find(':text'),
                    log = label;

                if (input.length) {
                    input.val(log);
                } else {
                    if (log) alert(log);
                }

            });

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#img-upload').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#imgInp").change(function () {
                readURL(this);
            });

//            $('#checkbox').on('switchChange.bootstrapSwitch', function (e, data) {
            $("#checkbox").change(function () {
                var message = '';
                //
                if (this.checked) {
                    message = 'ON'
                    $('.onmsg').show();
                    setTimeout(function () {
                        $('.onmsg').hide();
                    }, 2000)
                    $(".onmsg").html("<b>pop-up</b> will be displayed in app ");
                    console.log('++++++++++++')

                } else {
                    console.log('______________')
                    message = 'OFF'
                    $('.onmsg').show();
                    setTimeout(function () {
                        $('.onmsg').hide();
                    }, 2000)
                    $(".onmsg").html("app will OFF  <b>pop-up</b>");

                }
                $.ajax({
                    url: '/admin/ModuleSwitchGIVR',
                    dataType: 'json',
                    type: 'post',
                    data: {
                        'module_switchGIVR': message
                    },


                })

            });


            $(".saveButton").click(function () {
                console.log("image is changed , now upload it ");

                var formData = new FormData();
                formData.append('file', $('#imgInp')[0].files[0]);
                uploadImg(formData).done(function (response) {
                    imagePath.push(response.data);
                    console.log(formData);
                });

            });

            function uploadImg(file) {

                console.log('inside upload img', file);
                return $.ajax({
                    url: '/admin/GIVRImageProfile',
                    dataType: 'json',
                    async: false,
                    type: 'post',
                    data: file,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        console.log('====================', response);
                        toastr.success(response.msg);

                    },
                });
            }

            var time = '';
            $(".durationClass").on('change', function () {
                time = $(this).val();
                console.log(time);
            });


            $("#Trackcheckbox").change(function () {
                console.log($(this).parent().addClass('trckerClassBtn'));
                $(this).parent().addClass('trckerClassBtn');
                console.log($(this).parent().hasClass('btn-primary'));
                var message = '';
                if (this.checked) {
                    message = 'ON';
                    $('.onmsgTrack').show();
                    setTimeout(function () {
                        $('.onmsgTrack').hide();
                    }, 2000);
                    $(".onmsgTrack").html("<b>pop-up</b> will be displayed in app ");
                    console.log('++++++++++++');

                } else {
                    console.log('______________');
                    message = 'OFF';
                    $('.onmsgTrack').show();
                    setTimeout(function () {
                        $('.onmsgTrack').hide();
                    }, 2000)
                    niche_id = 0;
                    $(".onmsgTrack").html("app will OFF  <b>pop-up</b>");

                }
                if ($(this).parent().hasClass('btn-primary')) {
                    $('.trckerClassBtn').removeClass('btn-primary').addClass('btn-default off');
                    if (time == 0) {
                        alert('please select time');
                        $('.trckerClassBtn').removeClass('btn-primary').addClass('btn-default off');
                    } else {
                        $('.trckerClassBtn').addClass('btn-primary').removeClass('btn-default off');

console.log('==================',message,time);
                        $.ajax({
                            url: '/admin/ActivityTrackerGIVR',
                            dataType: 'json',
                            type: 'post',
                            data: {
                                'Activity_trackerGIVR': message,
                                'time': time
                            }
                        })
                    }
                } else {
                    console.log('==================',message,0);
                    $.ajax({
                        url: '/admin/ActivityTrackerGIVR',
                        dataType: 'json',
                        type: 'post',
                        data: {
                            'Activity_trackerGIVR': message,
                            'time': 0
                        }
                    })
                }

            });


        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin::Layouts.adminlayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>