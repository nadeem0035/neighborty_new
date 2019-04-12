<footer class="footer-v2 dashboard">
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 col-xs-6">
                    <div class="footer-widget widget-contact">
                        <div class="widget-top">
                            <h3 class="widget-title"><?=$this->lang->line('our_enterprise');?></h3>
                        </div>
                        <div class="widget-body">
                            <ul class="list-unstyled">
                                <li><i class="fa fa-angle-right"></i><a href="<?= site_url('about') ?>" title=""><?=$this->lang->line('about_company');?></a></li>
                                <!--<li><i class="fa fa-angle-right"></i><a href="<?= site_url('press') ?>" title=""><?=$this->lang->line('press_release');?></a></li>-->
                                <!--<li><i class="fa fa-angle-right"></i> <a href="<?= site_url('packages') ?>" title="">Packages</a></li>
                                <li><i class="fa fa-angle-right"></i> <a href="<?= site_url('page/privacy') ?>" title="">Privacy Policy</a></li>
                                <li><i class="fa fa-angle-right"></i> <a href="<?= site_url('page/terms') ?>" title="">Terms & Conditions</a></li>-->
                                <li><i class="fa fa-angle-right"></i><a href="<?= site_url('contact') ?>" title=""><?=$this->lang->line('contact');?></a></li>
                                <li><i class="fa fa-angle-right"></i><a href="<?= site_url('advertise') ?>" title="">Advertise with Neighborty</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2 col-xs-6">
                    <div class="footer-widget widget-contact">
                        <div class="widget-top">
                            <h3 class="widget-title"><?=$this->lang->line('f_cities');?></h3>
                        </div>
                        <div class="widget-body">
                            <ul class="list-unstyled">
                                <li><i class="fa fa-angle-right"></i><a href="<?=site_url();?>search?city=1" title="Los Angeles"><?=$this->lang->line('islamabad');?></a></li>
                                <li><i class="fa fa-angle-right"></i><a href="<?=site_url();?>search?city=2" title="Santa Monica"><?=$this->lang->line('karachi');?></a></li>
                                <li><i class="fa fa-angle-right"></i><a href="<?=site_url();?>search?city=3" title="Anaheim"><?=$this->lang->line('lahore');?></a></li>
                                <li><i class="fa fa-angle-right"></i><a href="<?=site_url();?>search?city=4" title="Newport Beach"><?=$this->lang->line('rawalpindi');?></a></li>
                                <!--<li><i class="fa fa-angle-right"></i><a href="<?=site_url();?>search?city=136" title="Peshawar"><?=$this->lang->line('peshawar');?></a></li>
                                <li><i class="fa fa-angle-right"></i><a href="<?=site_url();?>search?city=114" title="Multan"><?=$this->lang->line('multan');?></a></li>-->
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3 col-xs-12">
                    <div class="footer-widget widget-contact">
                        <div class="widget-top">
                            <h3 class="widget-title"><?=$this->lang->line('contact_us');?></h3>
                        </div>
                        <div class="widget-body">
                            <ul class="list-unstyled">
                                <li><i class="fa fa-map-marker"></i> <?=$this->lang->line('address');?></li>
                                <li><i class="fa fa-phone"></i> <a href="tel:<?=$this->lang->line('phone');?>"><?=$this->lang->line('phone');?></a></li>
                                <li><i class="fa fa-envelope-o"></i> <a href="mailto:<?=$this->lang->line('e-mail');?>"><?=$this->lang->line('e-mail');?></a></li>
                            </ul>
                            <div class="foot-social">
                                <p>
                                    <a href="https://www.facebook.com/zoneypk/" target="_blank" class="btn-facebook"><i class="fa fa-facebook-square"></i></a>
                                    <a href="https://twitter.com/zoneypk" target="_blank" class="btn-twitter"><i class="fa fa-twitter-square"></i></a>
                                    <a href="https://plus.google.com/u/5/104904576541281508738" target="_blank" class="btn-google-plus"><i class="fa fa-google-plus-square"></i></a>
                                    <a href="https://www.instagram.com/zoneypk/" target="_blank" class="btn-instagram"><i class="fa fa-instagram"></i></a>
                                    <a href="https://www.pinterest.com/zoneypk/" target="_blank" class="btn-pinterest"><i class="fa fa-pinterest-square"></i></a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 col-xs-12">
                    <div class="footer-widget widget-contact">
                        <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fneighborty%2F&tabs&width=330&height=214&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=false&appId"
                                width="330" height="214" style="border:none;overflow:hidden" scrolling="no"
                                frameborder="0" allowTransparency="true"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 text-center">
                    <div class="footer-col">
                        <p>&copy; <?=$this->lang->line('zoney');?> <?=date('Y');?> - <?=$this->lang->line('all_rights_reserved');?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--end footer section-->
<div class="scroll-to-top"><i class="icon-arrow-up"></i></div>
<!--[if lt IE 9]>
<script src="assets/global/plugins/respond.min.js"></script>
<script src="assets/global/plugins/excanvas.min.js"></script>
<![endif]-->

<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAYxatVl0mCNR-6v6bUZNn4-VTCD9PqHVE" type="text/javascript"></script>
<?php if($this->router->fetch_class() == 'listings' && $this->router->fetch_method() == 'add_property'):?>

<?php add_property_js(); ?>
    <script>
        var site_url = "<?php echo base_url(); ?>";
        var base_url = "<?php echo base_url(); ?>";
    </script>
    <script>
        Dropzone.autoDiscover = false;
        var progress = '';
        $("#mydropzone").dropzone({
            addRemoveLinks: true,
            url: site_url+"listings/listing_preview_image_upload",
            init: function() {
                this.on('completemultiple', function(file, json) {
                    $('.sortable').sortable('enable');
                });
                this.on('success', function(file, json) {
                    console.log('success');
                });

                this.on('addedfile', function(file) {

                    $(".submit_property").prop('disabled', true);

                });
                this.on('drop', function(file) {
                    // console.log('drop');
                    // console.log('File',file)

                });
                this.on("totaluploadprogress", function(file, response) {
                    progress = file;

                });
                this.on("sending", function(file, xhr, formData) {
                    var value = $('#property_title').val();
                    var code = $('#unique_no').val();
                    formData.append("key", value);
                    formData.append("code",code);
                });

                this.on("dragend", function(file, response) {
                    console.log('dragend');
                    console.log(file);
                    console.log(response);

                });
                this.on("queuecomplete", function (file) {
                    if(progress ==100){
                        $(".submit_property").prop('disabled', false);
                        console.log('validate');
                        var str= '';
                        $('.dz-filename').each(function() {
                            var names =  $(this).find('span').text();
                            str += names + ',';
                        });
                        $('#files').val(str);
                        $('#img_status').attr('value','success');
                    }

                });
                this.on("reset", function (file) {
                    $('#img_status').val('');
                });
                this.on("removedfile", function(file) {

                    $.ajax(
                        {
                            url: site_url+"listings/deleteimage",
                            type: 'POST',
                            dataType:'json',
                            data: {'name':file.name},
                            beforeSend: function(){
                                console.log('before');
                            },
                            success: function (data)
                            {
                                console.log(data);

                            },
                            complete:function(data){

                                console.log('complete');
                                console.log(data);
                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                console.log('Fileupload error');
                            }
                        });


                });
            }
        });

        $("#mydropzone").sortable({
            items:'.dz-preview',
            cursor: 'move',
            opacity: 0.5,
            containment: "parent",
            distance: 20,
            tolerance: 'pointer',
            update: function(e, ui){
                console.log(e);
                console.log('ss');

            }
        });


    </script>

    <script type="text/javascript" src="<?= base_url() ?>assets/js/select2.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/js/price_plan.js"></script>

<!--<script type="text/javascript" src="<?/*= base_url() */?>assets/js/utils.js"></script>
    <script type="text/javascript" src="<?/*= base_url() */?>assets/js/intlTelInput.js"></script>
    <script type="text/javascript" src="<?/*= base_url() */?>assets/js/isValidNumber.js"></script> -->

    <script>
        $(document).ready(function() {
            $('.basic-single').select2({
                placeholder: 'Select'
            });

            $('.basic-hide-search').select2({
                placeholder: 'Select',
                minimumResultsForSearch: Infinity
            });

            $(".phone_number").on("keypress keyup blur",function (event) {
                $(this).val($(this).val().replace(/[^\d].+/, ""));
                if ((event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                }
            });

            $(".count_nbr").on("keypress keyup blur",function (event) {
                $(this).val($(this).val().replace(/[^\d].+/, ""));
                if ((event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                }
            });
        });

    </script>
    <script type="text/javascript">
        validate_fields = ["price"];
        config_options_data = {};
    </script>
    <script type="text/javascript">
        old_type_value_q = '';
        $(document).ready(function() {
            $("#price").keyup();
        });
    </script>
    <script>
        $.validator.addMethod("customphone", function(value, element){
            return ($(element).hasClass('number-invalid') && $(element).val().length != 0) ? false : true;
        }, "wrong phone number");

        $.validator.addMethod("customnum", function(value, element){
            var firstChar = $('#phone').val().substr(0, 2);
            var firstChar2 = $('#phone').val().substr(0, 1);
            console.log(firstChar);
            if(firstChar == 03 || firstChar2 == 3 ){
                return true;
            }else {
                return false;
            }

        }, "Number is not correct");
    </script>

<?php endif;?>

<?php if($this->router->fetch_class() == 'listings' && $this->router->fetch_method() == 'edit_property'):?>
    <script>
        var site_url = "<?php echo base_url(); ?>";
        var base_url = "<?php echo base_url(); ?>";
    </script>
    <?php add_property_js(); ?>
<script>
    Dropzone.autoDiscover = false;
    var progress = '';
    $("#mydropzone").dropzone({
        addRemoveLinks: true,
        url: site_url+"listings/listing_preview_image_upload",
        init: function() {
            this.on('completemultiple', function(file, json) {
                $('.sortable').sortable('enable');
            });
            this.on('success', function(file, json) {
                console.log('success');
            });

            this.on('addedfile', function(file) {

                $(".submit_property").prop('disabled', true);
                $(".edit_property").prop('disabled', true);

            });
            this.on('drop', function(file) {
               // console.log('drop');
               // console.log('File',file)

            });
            this.on("totaluploadprogress", function(file, response) {
                progress = file;

            });
            this.on("sending", function(file, xhr, formData) {
                var value = $('#property_title').val();
                var code = $('#unique_no').val();
                formData.append("key", value);
                formData.append("code",code);
            });

            this.on("dragend", function(file, response) {
                console.log('dragend');
                console.log(file);
                console.log(response);

            });
            this.on("queuecomplete", function (file) {
                if(progress ==100){
                    $(".submit_property").prop('disabled', false);
                    console.log('validate');
                    var str= '';
                    $('.dz-filename').each(function() {
                        var names =  $(this).find('span').text();
                        str += names + ',';
                    });
                    $('#files').val(str);
                    $('#img_status').attr('value','success');
                    $(".edit_property").prop('disabled', false);
                }

            });
            this.on("reset", function (file) {
               $('#img_status').val('');
            });
            this.on("removedfile", function(file) {

                $.ajax(
                    {
                        url: site_url+"listings/deleteimage",
                        type: 'POST',
                        dataType:'json',
                        data: {'name':file.name},
                        beforeSend: function(){
                            console.log('before');
                        },
                        success: function (data)
                        {
                          console.log(data);

                        },
                        complete:function(data){

                            console.log('complete');
                            console.log(data);
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            console.log('Fileupload error');
                        }
                    });


            });
            var data = $("#listimages").val();

            var array = data.split(',');
            //console.log(array);
            // Display array values on page
            if(array.length) {
                for (var i = 0; i < array.length; i++) {
                    if(array[i] !== '') {
                        var mockFile = {name: array[i], size: 88057};
                        this.options.addedfile.call(this, mockFile);
                        this.options.thumbnail.call(this, mockFile, base_url + "assets/media/properties/thumbs/" + array[i]);
                        mockFile.previewElement.classList.add('dz-success');
                        mockFile.previewElement.classList.add('dz-complete');
                    }
                }
            }

        }
    });

    $("#mydropzone").sortable({
        items:'.dz-preview',
        cursor: 'move',
        opacity: 0.5,
        containment: "parent",
        distance: 20,
        tolerance: 'pointer',
        update: function(e, ui){
            console.log(e);
            console.log('ss');

        }
    });


</script>
<?php endif;?>





<?php if ((strpos(current_url(), "appointments"))) { ?>
    <?php add_appointments_js(); ?>
    <?php
    put_js_footer();
    ?>
<script>
    // jQuery(document).ready(function ()
    // {
         //loadPlacesMap();
   // });
</script>
<?php } ?>



<script>
    //$(document).ready(function(){
        $("#add-availab-form").click(function(){
            $(".add-availab").slideToggle();
        });

  // });
</script>

<?php if($this->uri->segment(1) == 'appointments') {?>

    <?php add_appointments_js(); ?>
    <script>

       $(document).ready(function() {

        $('#calendar_old').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'listDay,listWeek,month'
            },
            views: {
                listDay: { buttonText: 'list day' },
                listWeek: { buttonText: 'list week' }
            },
            defaultView: 'month',
            defaultDate: '<?=date('Y-m-d');?>',
            navLinks: true,
            eventLimit: true,
            eventClick:  function(event, jsEvent, view) {

                 var time_from = event.timefrom;
                var time_to = event.timeto;
              //   $('#modalTitle').html(title);
                 $("#date").html(event.app_date);
              //   $("#timeform").html(event.timefrom);
              //   $("#timeto").html(event.timeto);
              //
              // //  $("#test").val(event.timeto);
              //   //$("#timeto").html(moment(event.time_to).format('HH:mm:ss'));
              //
              //
              //   $('#fullCalModal').modal();
              //
              //   setTimeout(testfun,2000);
              //
              //
              //   function testfun()
              //   {
              //       $('#arshad').html('jhg');
              //
              //
              //   }

               availibiltytime(time_from,time_to);

            },

            events: [
                <?php
                foreach ($availablity as $row)
                {

                $start_day = date('d', strtotime($row->appointment_date));
                $smonth = date('n', strtotime($row->appointment_date));
                $start_month = $smonth - 1;
                $start_year = date('Y', strtotime($row->appointment_date));

                $end_year = date('Y', strtotime($row->appointment_date));
                $end_day = date('d', strtotime($row->appointment_date));
                $emonth = date('n', strtotime($row->appointment_date));

                $end_time = $row->time_to;
                $end_month = $emonth - 1;
                ?>
                {
                    title: "<?= ucfirst($row->title);?>",
                    app_date: "<?= date('F j, Y', strtotime($row->appointment_date));?>",
                    timefrom: "<?= date('h:i A', strtotime($row->time_from));?>",
                    timeto: "<?= date('h:i A', strtotime($row->time_to));?>",
                    start: "<?= date('F j, Y h:i A', strtotime($row->appointment_date.' '.$row->time_from));?>",
                    end: "<?= date('F j, Y h:i A', strtotime($row->appointment_date.' '.$row->time_to));?>",
                    endtime: new Date(<?php echo $end_year . ',' . $end_month . ',' . $end_day; ?>),
                   // endtime: $end_time,
                    color: '#ff6e00'
                },

                <?php	}
                ?>

            ]
        });

    });

    </script>

<?php } ?>


<script>
    function availibiltytime(time_from,time_to)
    {
        var url = site_url + 'booking/availability_popup_canelnder/';
        var data = { time_from:time_from ,time_to: time_to};
        console.log(data);
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            success: function (result) {
               $('#availbiliti').html(result);
                $('#fullCalModal').modal();
            }
        });

     }
</script>


<?php if ((strpos(current_url(), "detail")) && $mapjs) { ?>
    <script type="text/javascript">
        var map = null;
        var panorama = null;
        var fenway = new google.maps.LatLng(<?=$listing->latitude ?>, <?=$listing->longitude ?>);
        var mapOptions = {
            center: fenway,
            zoom: 12
        };
        var panoramaOptions = {
            position: fenway,
            pov: {
                heading: 34,
                pitch: 10
            }
        };
        var tabsHeight = function() {
            //jQuery(".detail-media .tab-content").css('min-height',jQuery("#gallery").innerHeight());
            jQuery("#map,#street-map").css('min-height',jQuery(".detail-media #gallery").innerHeight());
        };

        jQuery(window).on('load',function(){
            tabsHeight();
        });
        jQuery(window).on('resize',function(){
            tabsHeight();
        });
        function initialize() {

            map = new google.maps.Map(document.getElementById('map'), mapOptions);
            panorama = new google.maps.StreetViewPanorama(document.getElementById('street-map'), panoramaOptions);
            map.setStreetView(panorama);
        }
        jQuery('a[href="#gallery"]').on('shown.bs.tab', function (e) {
            $('.slide').unslick();
            $('.slideshow-nav').unslick();
            $('.slide').slick(houzez_detail_slider_main_settings());
            $('.slideshow-nav').slick(houzez_detail_slider_nav_settings());
        });

        jQuery('a[href="#map"]').on('shown.bs.tab', function (e) {
            var center = panorama.getPosition();
            google.maps.event.trigger(map, "resize");
            map.setCenter(center);
        });
        jQuery('a[href="#street-map"]').on('shown.bs.tab', function (e) {
            fenway = panorama.getPosition();
            panoramaOptions.position = fenway;
            panorama = new google.maps.StreetViewPanorama(document.getElementById('street-map'), panoramaOptions);
            map.setStreetView(panorama);
        });
        google.maps.event.addDomListener(window, 'load', initialize);


    </script>
<?php } ?>




<script>
    $(function() {
        var window_height = $(window).height();
        var page_height   = $(document).height();
        var header_height = $("#header").height();
        var footer_height = $("#footer_section").height();
        var active_height = window_height-header_height-footer_height-250;
        if(page_height > 768){
            $(".blog-content").css('min-height',active_height+'px');
        }
    });
</script>
<?php
if( $this->uri->segment(1) == 'apply' )
{
    ?>


    <script type="text/javascript">
        function array2object(form_id)
        {
            if( form_id.length == 0 )
                return false;

            var form = $('form#'+form_id).serializeArray();
            var final_data = {};
            $(form).each(function(index, obj)
            {
                final_data[obj.name] = obj.value;
            });

            return final_data;
        }

        function save_application()
        {
            // console.log('Method called');
             //alert('not');
            var locked = $('#request_status').val();

            // alert(locked);
            if( locked == 'yes' )
            {
                return false;
            }

            var form_data = {
                about_me            : array2object('about_me'),
                residences          : array2object('residences'),
                occupation          : array2object('occupation'),
                references          : array2object('references'),
                additional          : array2object('additional'),
                financial           : array2object('financial'),
                misc                : array2object('misc'),
            };

            $.ajax({
                url : '<?=site_url('do');?>',
                type : 'POST',
                // data : $('form#form_about_me').serialize(),
                data : form_data,
                beforeSend: function()
                {
                    $('#request_status').val('yes');
                    //$('#save_button').attr('disabled', 'disabled');
                },
                success: function(data)
                {
                    $('#request_status').val('no');
                    $('#save_button').removeAttr('disabled');
                    // alert('sent');
                    // $('#testing_response').html(data);
                }
            });
            return false;
        }

        $(document).ready(function()
        {
            setInterval( function()
            {
                save_application();
            }, 10000 );
        });




        $('#next-section').click(function()
        {
            $('ul.apply-tabs > li.active').next('li').trigger('click');
        });
        // to implement previous tab button
        /*$('#prev-section').click(function()
        {
            $('ul.apply-tabs > li.active').prev('li').trigger('click');
        });*/

    </script>
    <?php
}

echo "<script> $(document).ready(function() {";
put_extra_js();
echo "});</script>";

if(isset($custom_js))
{
    if( is_array($custom_js) )
    {
        foreach($custom_js as $js)
        {
            if( stristr($js, '<script') )
                print $js;
            else
            {
                print '<script type="text/javascript">';
                print $js;
                print '</script>';
            }
        }
    }
    else
    {
        if( stristr($custom_js, '<script') )
            print $custom_js;
        else
        {
            print '<script type="text/javascript">';
            print $custom_js;
            print '</script>';
        }
    }
}
if(isset($js_code))
{
    if( stristr($js_code, '<script') )
        echo $js_code;
    else
    {
        echo '<script type="text/javascript">';
        echo $js_code;
        echo '</script>';
    }
}
?>
</body>
</html>