@extends('Admin::Layouts.adminlayout')
@section('AUTOIG','active open')
@section('Switch','active open')

@section('pageheadcontent')
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

    <style>
        .file {
            visibility: hidden;
            position: absolute;
        }

        .adddiv1 {
            display: block;
            position: relative;
            cursor: pointer;
            overflow: hidden;
            width: 100%;
            max-width: 100%;
            height: 220px;
            padding: 5px 10px;
            font-size: 14px;
            line-height: 22px;
            color: #777;
            background-color: #FFF;
            background-image: none;
            text-align: center;
            border: 2px solid #E5E5E5;
            -webkit-transition: border-color .15s linear;
            transition: border-color .15s linear;
        }

        .adddiv {
            display: block;
            position: relative;
            cursor: pointer;
            overflow: hidden;
            width: 100%;
            max-width: 100%;
            height: 220px;
            padding: 5px 10px;
            font-size: 14px;
            line-height: 22px;
            color: #777;
            background-color: #FFF;
            background-image: none;
            text-align: center;
            border: 2px solid #E5E5E5;
            -webkit-transition: border-color .15s linear;
            transition: border-color .15s linear;
        }
    </style>



@endsection

@section('pagecontent')

    <h3 class="page-title" style="color: #0d3625">
        AUTOIG Settings &nbsp;<i class="fa fa-gear" style="font-size:22px"></i>

    </h3>

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-cog"></i>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="/admin/SettingSwitch"> Switch Setting </a>
            </li>
        </ul>
    </div>

    {{--<h3>Gift Icon </h3>--}}
    <div class="col-md-4">
        <h3 style="color: #0d1217">&nbsp; &nbsp; &nbsp;Gift Icon </h3>

        <div class="col-md-12">
            <p class="onmsg" style="display:none;background: #104d40; padding: 10px; color: #fff; box-shadow: 0px 0px 5px #000000;"></p><br>
        </div>
        <div class="card" style="margin: 15px; border:1px solid #ccc; padding: 10px 10px 20px 10px; font-size: 16px;">
            Gift Icon Module <input data-toggle="toggle" type="checkbox" value="{{$gifticon}}" <?php echo ($gifticon=='ON')?'checked':''; ?> id="giftcheckbox" style="float: right;">
        </div>
    </div>


    <div class="col-md-4">
        <h3 style="color: #0c0c0c">&nbsp; &nbsp;&nbsp;Module switch</h3>

        <div class="col-md-12">
            <p class="onmsgMod" style="display:none;background: #0f334d;padding: 10px;color: #fff;box-shadow: 0px 0px 5px #000000;"></p><br>
        </div>
        <div class="card" style="margin: 15px; border:1px solid #ccc; padding: 10px 10px 20px 10px; font-size: 16px;">
            Black Hat Module <input data-toggle="toggle" type="checkbox" value="{{$moduleswitch}}" <?php echo ($moduleswitch=='ON')?'checked':''; ?> id="Modulecheckbox" style="float: right;">
        </div>
    </div>

    {{--<h3>Emergency Switch </h3>--}}
    <div class="col-md-4">
        <h3 style="color: #0c0c0c">&nbsp;&nbsp; &nbsp;Emergency Services </h3>

        <div class="col-md-12">
            <p class="onmsg1" style="display:none;background: #0f334d;padding: 10px;color: #fff;box-shadow: 0px 0px 5px #000000;"></p><br>
        </div>
        <div class="card" style="margin: 15px; border:1px solid #ccc; padding: 10px 10px 20px 10px; font-size: 16px;">
            Emergency Switch <input data-toggle="toggle" value="{{$emergencySwitch}}" <?php echo ($emergencySwitch=='ON')?'checked':''; ?> type="checkbox" id="EmergencySwitch" style="float: right;">
        </div>
    </div>



    <br>



    <div class="col-md-6">
        <h3 style="color: #0d1217">&nbsp; &nbsp; Activity Tracker </h3>

        <div class="col-md-12">
            <p class="onmsgTrack" style="display:none;background: #104d40; padding: 10px; color: #fff; box-shadow: 0px 0px 5px #000000;"></p><br>
        </div>
        <div class="card" style="margin: 15px; border:1px solid #ccc; padding: 10px 10px 20px 10px; font-size: 16px;">
            Activity Tracker <input data-toggle="toggle" type="checkbox" value="{{$Tracker}}" <?php echo ($Tracker=='ON')?'checked':''; ?> id="Trackcheckbox" style="float: right;">
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
                <option value="10">10 sec</option>
                <option value="20">20 sec</option>
                <option value="30">30 sec</option>
                <option value="1">1 min</option>
                <option value="2">2 min</option>
                <option value="5">5 min</option>
                <option value="10">10 min</option>
                <option value="20">20 min</option>
                <option value="1">1 hour</option>
            </select>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12">
            <br>
            <h2 style="text-align: center; color: #0e0e0e;
                margin: 0 0 2% 0; ">Banners For Android </h2>
        </div>

        @if(isset($iosBanner))
            @foreach($iosBanner as $key => $val)
                <div class="col-sm-12 col-xs-12 col-md-3 col-lg-3 mrgn_bottom iosBannerClass{{$key+1}}">
                    <input type="file" id="input-file-now-custom-1 file" class="dropify oldBanner bannerIosDb{{$key}}"
                           data-default-file="{{$val['banner_image']}}" name="files[]" data-id="{{$val["banner_id"]}}" multiple/>
                    <input id="giftID" name="giftID" type="text" placeholder="URL"
                           class="form-control input-md banner_url{{$key}}" data-id="{{$val["banner_id"]}}"
                           value="{{$val['banner_url']}}">
                    <button class="addBtn disabledbtn" data-id="{{$key}}"
                       data-bid="{{$val['banner_id']}}"> Save</button>
                    <a class="RemoveBtn pull-right" data-id="{{$key}}"
                       data-bid="{{$val['banner_id']}}"></a>
                </div>
            @endforeach
        @endif


        <div class="col-sm-12 col-xs-12 col-md-3 col-lg-3 newdiv mrgn_bottom">
            <div class="adddiv">
                <span><i class="fa fa-plus" style="margin-top:45%;font-size: 30px;"></i></span>
            </div>
        </div>
    </div>

@endsection

@section('pagescripts')

    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"></script>


    <script>
        $(document).ready(function () {
            toastr.options.positionClass = 'toast-top-center';
            toastr.options.progressBar = true;
            toastr.options.preventDuplicates = true;
            toastr.options.closeButton = true;

            $('input[type="search"]').css({'height': '5px'});
            $('.toggle').removeClass('btn-primary');


        });


        {{--if ('{{$status}}' === 'ON') {--}}
        {{--$('#giftcheckbox').prop("checked", true);--}}
        {{--}--}}




        $(document).ready(function () {

            var time='{{$time}}';
            console.log(time);
            // if(time = $('.durationClass').text()){
            $(".durationClass :selected").text(time);
            // }
            // Basic
            $('.dropify').dropify();

            // Translated
            $('.dropify-fr').dropify({
                messages: {
                    default: 'Glissez-déposez un fichier ici ou cliquez',
                    replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                    remove: 'Supprimer',
                    error: 'Désolé, le fichier trop volumineux'
                }
            });

            // Used events
            var drEvent = $('#input-file-events').dropify();

            drEvent.on('dropify.beforeClear', function (event, element) {
                return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
            });

            drEvent.on('dropify.afterClear', function (event, element) {
                alert('File deleted');
            });

            drEvent.on('dropify.errors', function (event, element) {
                console.log('Has Errors');
            });

            var drDestroy = $('#input-file-to-destroy').dropify();
            drDestroy = drDestroy.data('dropify')
            $('#toggleDropify').on('click', function (e) {
                e.preventDefault();
                if (drDestroy.isDropified()) {
                    drDestroy.destroy();
                } else {
                    drDestroy.init();
                }
            })
        });
    </script>
    <script>
        $(document).ready(function () {
            var i = 0;

            var imagePath = [],
                imageUrl = [];
            $(document).on('click', '.adddiv', function () {
                i++;
                var contents = '<div class="col-sm-12 col-xs-12 col-md-3 col-lg-3 mrgn_bottom">' +
                    '<input id="input-file-now-custom-2-' + i + '" class="dropify newBanner newBannerIos" data-default-file="" type="file">' +
                    '<input id="giftID_' + i + '" name="giftID_' + i + '" type="text" placeholder="URL" class="form-control input-md">' +
                    '<button class="NewBtnIos disabledbtn" data-id="" data-bid=""> Save</button>' +
                    '</div>';

                $(".newdiv").before(contents);
                $('#input-file-now-custom-2-' + i).dropify();

            });
            var j = 0;
            $(document).on('click', '.adddiv1', function () {
                j++;
                var contents = '<div class="col-sm-12 col-xs-12 col-md-3 col-lg-3 mrgn_bottom">' +
                    '<input id="input-file-now-custom-1-' + j + '" class="dropify newBanner newBannerAnd" data-default-file="" type="file">' +
                    '<input id="giftID_' + j + '" name="giftID_' + j + '" type="text" placeholder="URL" class="form-control input-md">' +
                    '<a class="NewaddBtnAndroid disabledbtn" data-id="" data-bid=""> Save</a>' +
                    '</div>';

                $(".newdiv1").before(contents);
                $('#input-file-now-custom-1-' + j).dropify();
            });
            $(document).ready(function () {
                $("#giftcheckbox").change(function () {
                    var message = ''

                    if (this.checked) {
                        message = 'ON';
                        $('.onmsg').show();
                        setTimeout(function () {
                            $('.onmsg').hide();
                        }, 2000);
                        $(".onmsg").html("<b>pop-up</b> will be displayed in app ");
                        console.log('++++++++++++');
                        niche_id = 1;

                    } else {
                        console.log('______________');
                        message = 'OFF';
                        $('.onmsg').show();
                        setTimeout(function () {
                            $('.onmsg').hide();
                        }, 2000)
                        niche_id = 0;
                        $(".onmsg").html("app will OFF  <b>pop-up</b>");

                    }
                    $.ajax({
                        url: '/admin/SettingSwitch',
                        dataType: 'json',
                        type: 'post',
                        data: {
                            'GiftIcon': message
                        },


                    })

                });

                {{--if ('{{$status1}}' === 'ON') {--}}
                {{--$('#EmergencySwitch').prop("checked", true);--}}
                {{--}--}}

                $(document).ready(function () {
                    $("#EmergencySwitch").change(function () {
                        var message = '';

                        if (this.checked) {
                            message = 'ON';
                            $('.onmsg1').show();
                            setTimeout(function () {
                                $('.onmsg1').hide();
                            }, 2000)
                            $(".onmsg1").html("<b>pop-up</b> will be displayed in app ");
                            console.log('++++++++++++')
                            niche_id = 1;

                        } else {
                            console.log('______________')
                            message = 'OFF';
                            $('.onmsg1').show();
                            setTimeout(function () {
                                $('.onmsg1').hide();
                            }, 2000);
                            niche_id = 0;
                            $(".onmsg1").html("app will OFF  <b>pop-up</b>");

                        }
                        $.ajax({
                            url: '/admin/SettingSwitch',
                            dataType: 'json',
                            type: 'post',
                            data: {
                                'EmergencySwitch': message
                            },


                        })

                    });


                });


                {{--if ('{{$status2}}' === 'ON') {--}}
                {{--$('#Modulecheckbox').prop("checked", true);--}}
                {{--}--}}
                $(document).ready(function () {
                    $("#Modulecheckbox").change(function () {
                        var message = '';

                        if (this.checked) {
                            message = 'ON';
                            $('.onmsgMod').show();
                            setTimeout(function () {
                                $('.onmsgMod').hide();
                            }, 2000);
                            $(".onmsgMod").html("<b>pop-up</b> will be displayed in app ");
                            console.log('++++++++++++')
                            // niche_id = 1;

                        } else {
                            console.log('______________');
                            message = 'OFF';
                            $('.onmsgMod').show();
                            setTimeout(function () {
                                $('.onmsgMod').hide();
                            }, 2000);
                            // niche_id = 0;
                            $(".onmsgMod").html("app will OFF  <b>pop-up</b>");

                        }
                        $.ajax({
                            url: '/admin/SettingSwitch',
                            dataType: 'json',
                            type: 'post',
                            data: {
                                'module_switchAUTOIG': message
                            },


                        })

                    });
                    //
                    // $("#Trackcheckbox").change(function () {
                    //     var message = ''
                    //
                    //     if (this.checked) {
                    //         message = 'ON';
                    //         $('.onmsgTrack').show();
                    //         setTimeout(function () {
                    //             $('.onmsgTrack').hide();
                    //         }, 2000);
                    //         $(".onmsgTrack").html("<b>pop-up</b> will be displayed in app ");
                    //         console.log('++++++++++++');
                    //         niche_id = 1;
                    //
                    //     } else {
                    //         console.log('______________');
                    //         message = 'OFF';
                    //         $('.onmsgTrack').show();
                    //         setTimeout(function () {
                    //             $('.onmsgTrack').hide();
                    //         }, 2000)
                    //         niche_id = 0;
                    //         $(".onmsgTrack").html("app will OFF  <b>pop-up</b>");
                    //
                    //     }
                    //     $.ajax({
                    //         url: '/admin/SettingSwitch',
                    //         dataType: 'json',
                    //         type: 'post',
                    //         data: {
                    //             'Activity_tracker': message
                    //         },
                    //
                    //
                    //     })
                    //
                    // });


                    var time = '';
                    $(".durationClass").on('change', function () {
                        time = $(this).val();
                    });


                    $("#Trackcheckbox").change(function () {
                        $('#Trackcheckbox').parent().addClass('trckerClassBtn');
                        if (time == 0) {
                            alert('please select time');
                            $('.trckerClassBtn').removeClass('btn-primary').addClass('btn-default off');
                        } else {
                            $('.trckerClassBtn').addClass('btn-primary').removeClass('btn-default off');
                            var message = '';
                            if (this.checked) {
                                message = 'ON';
                                $('.onmsgTrack').show();
                                setTimeout(function () {
                                    $('.onmsgTrack').hide();
                                }, 2000);
                                $(".onmsgTrack").html("<b>pop-up</b> will be displayed in app ");
                                console.log('++++++++++++');
                                niche_id = 1;

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

                            $.ajax({
                                url: '/admin/SettingSwitch',
                                dataType: 'json',
                                type: 'post',
                                data: {
                                    'Activity_tracker': message,
                                    'time': time
                                },
                            })
                        }

                    });
                });
            });

            $('.addBtn').click(function () {

                var count = $(this).attr('data-id');
                var bannerId = $(this).attr('data-bid');
                var formData = new FormData();
                formData.append('file', $('.bannerIosDb' + count)[0].files[0]);

                formData.append('bannerUrl', $('.banner_url' + count).val());
                formData.append('bannerId', bannerId);

                $.ajax({
                    url: '/admin/imageupdateAutoig',
                    dataType: 'json',
                    async: false,
                    type: 'post',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        console.log(response);
                        toastr.success(response.msg);
//                        location.reload();

                    }
                });

            });



            $(document.body).on('change', '.newBanner', function () {
                console.log("image is changed , now upload it ");
                var formData = new FormData();
                formData.append('file', $(this)[0].files[0]);
                uploadImg(formData).done(function (response) {
                    imagePath.push(response.data);
                    console.log(formData);
                });

            });

            function uploadImg(file) {
                console.log('inside upload img', file);
                return $.ajax({
                    url: '/admin/singleImageAutoig',
                    dataType: 'json',
                    async: false,
                    type: 'post',
                    data: file,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        console.log('===================================', response);
                        toastr.success(response.msg);

                    },
                });
            }

            $(document.body).on('click', '.NewBtnIos', function () {
                $('.NewBtnIos').attr('disabled',true);

                var bannerUrl = $(this).siblings('input').val();
                var fromdata = new FormData();
                fromdata.append('file', $('.newBannerIos')[0].files[0]);
                fromdata.append('bannerUrl', bannerUrl);
                console.log('===============', bannerUrl, fromdata);

                $.ajax({
                    url: "/admin/insertImageBannerAutoig",
                    dataType: 'json',
                    async: false,
                    type: 'post',
                    data: fromdata,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        response = $.parseJSON(response);

                        toastr.success(response.msg);

                        console.log(response);
//                        toastr.success(response.msg);

                        location.reload();

                    }
                });
            });
            $(document.body).on('click','.dropify-clear',function () {
                var banner_id= $(this).parent().next().attr('data-id');
                var message=confirm('Are You sure to delete image');

                if(message) {

                    $.ajax({
                        url: '/admin/deleteAjaxHandlerImageAutoig',
                        type: 'post',
                        datatype: 'json',
                        data: {
                            banner_id: banner_id
                        },
                        success: function (response) {
                            response = $.parseJSON(response);
                            if (response['status'] == '200') {
                                toastr.success(response.message);
                                location.reload();
                            }
                            else {
                                console.log(response.message);
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
