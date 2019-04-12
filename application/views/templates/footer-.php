<!--start footer section-->

<footer class="footer-v2">
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="footer-widget widget-contact">
                        <div class="widget-top">
                            <h3 class="widget-title">Company Info</h3>
                        </div>
                        <div class="widget-body">
                            <ul class="list-unstyled">
                                <li><i class="fa fa-angle-right"></i> <a href="<?= site_url('page/about')?>" title="">About Us</a></li>
                                <li><i class="fa fa-angle-right"></i><a href="<?= site_url('page/mission')?>" title="">Our Mission</a></li>
                                <li><i class="fa fa-angle-right"></i><a href="<?= site_url('page/press')?>" title="">Press</a></li>
                                <li><i class="fa fa-angle-right"></i><a href="<?= site_url('page/career')?>" title="">Careers</a></li>
                                <li><i class="fa fa-angle-right"></i><a href="<?= site_url('contact')?>" title="">Contact Us</a></li>
                                <li><i class="fa fa-angle-right"></i><a href="<?= site_url('search/results_map')?>">Results Map</a></li>
                                <!--<li><i class="fa fa-angle-right"></i><a href="<?/*= site_url('about-us-2')*/?>">About Us-2</a></li>
                                <li><i class="fa fa-angle-right"></i><a href="<?/*= site_url('about-us-3')*/?>">About Us-3</a></li>-->

                                <!--<p class="read"><a href="about-us.html">Read more <i class="fa fa-caret-right"></i></a></p>-->
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="footer-widget widget-contact">
                        <div class="widget-top">
                            <h3 class="widget-title">Learn More</h3>
                        </div>
                        <div class="widget-body">
                            <ul class="list-unstyled">
                                <li><i class="fa fa-angle-right"></i><a href="<?= site_url('page/faqs')?>" title="">FAQs</a></li>
                                <li><i class="fa fa-angle-right"></i><a href="<?= site_url('listings/add-listing')?>" title="">Add a Listing</a></li>
                                <li><i class="fa fa-angle-right"></i><a href="<?= site_url('page/legal')?>" title="">Legal</a></li>
                                <li><i class="fa fa-angle-right"></i><a href="<?= site_url('page/stories')?>" title="">Stories </a></li>
                                <li><i class="fa fa-angle-right"></i><a href="<?= site_url('page/privacy')?>">Privacy</a></li>
                                <li><i class="fa fa-angle-right"></i><a href="<?= site_url('page/terms')?>">Terms and Conditions</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="footer-widget widget-contact">
                        <div class="widget-top">
                            <h3 class="widget-title">Secure Payments</h3>
                        </div>
                        <div class="widget-body">
                            <img src="<?= base_url() ?>assets/img/payment-logo.png">
                        </div>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="footer-widget widget-contact">
                        <div class="widget-top">
                            <h3 class="widget-title">Contact Us</h3>
                        </div>
                        <div class="widget-body">
                            <ul class="list-unstyled">
                                <li><i class="fa fa-location-arrow"></i> 8901 Marmora Road, Los Angeles, CA, USA.</li>
                                <li><i class="fa fa-phone"></i>  + 61 123 456 789</li>
                                <li><i class="fa fa-envelope-o"></i> <a href="#">support@neighborty.com</a></li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3">
                    <div class="footer-col">
                        <p>&copy; Neighborty 2015 - 2017 - All Rights Reserved.</p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="footer-col foot-social text-center">
                        <p>
                            Follow us
                            <a target="_blank" class="btn-facebook" href="#"><i class="fa fa-facebook-square"></i></a>

                            <a target="_blank" class="btn-twitter" href="#"><i class="fa fa-twitter-square"></i></a>

                            <a target="_blank" class="btn-linkedin" href="#"><i class="fa fa-linkedin-square"></i></a>

                            <a target="_blank" class="btn-google-plus" href="#"><i class="fa fa-google-plus-square"></i></a>

                            <a target="_blank" class="btn-instagram" href="#"><i class="fa fa-instagram"></i></a>
                        </p>

                    </div>
                </div>
                <div class="col-md-3 col-sm-3">
                    <div class="footer-col create-by">
                        <p>Created by<a target="_blank" href="http://www.abiginc.com"><img src="<?= base_url(); ?>assets/img/logo_abiginc.png" width="100"/></a></p>
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
<!-- Modal -->
<div id="ApprovemodelWrap"></div>
<div id="ContactHostDashboardWrap"></div>
<!-- Modal -->
<div id="wishlistModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content host-modal">
            <div class="modal-header host-modal-header">
                <a data-dismiss="modal"><img class="pull-right" src="<?= base_url() ?>assets/img/close.png"></a>
                <h4 class="modal-title">SAVE TO WISHLIST</h4>
            </div>
            <div id="wishlistContent"></div>
            <div class="modal-footer host-modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAYxatVl0mCNR-6v6bUZNn4-VTCD9PqHVE"
        type="text/javascript"></script>


<?php
put_js_footer();
?>
<script>
    jQuery(document).ready(function () {
        loadPlacesMap();
    });
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
    var site_url = "<?php echo base_url(); ?>";
    var base_url = "<?php echo base_url(); ?>";
</script>
<?php if ($this->uri->segment(2) == 'confirm-booking') { ?>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<?php } ?>




<script type="text/javascript" src="<?= base_url() ?>assets/js/moment.js"></script>

<script type="text/javascript" src="<?= base_url() ?>assets/js/markerclusterer.js"></script>




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

$(document).ready(function(){
    $('.owl-carousel').owlCarousel({
        items : 2,
        lazyLoad : false,
        lazyFollow : true,
        autoHeight : true,
        navigation : true,
        navigationText : ["prev","next"],
        rewindNav : true,
        scrollPerPage : false,


    });


});


</script>
<script>
 //   $(document).ready(function () {
        //loadPlacesMap();
//        Metronic.init();
//        Layout.init();
//        Demo.init();
  //= put_extra_js();
//        $.backstretch([
//            base_url + "assets/media/bg/bg-1.jpg",
//            base_url + "assets/media/bg/bg-2.jpg",
//            base_url + "assets/media/bg/bg-3.jpg",
//            base_url + "assets/media/bg/bg-4.jpg"
//        ], {
//            fade: 1000,
//            duration: 6000
//        }
//        );
//        $('ul.page-sidebar-menu li.active').parents('li').addClass('active');
//    });
    $(document).ready(function () {
<?php if (strpos(current_url(), "booking/detail")) { ?>
//            google.maps.event.addDomListener(window, 'load', bookingDetailMap(<?//= $listing->latitude ?>//,<?//= $listing->longitude ?>//));
//            $("#bookingRightFixed").sticky({topSpacing: 80, bottomSpacing: 400, responsiveWidth: true, getWidthFrom: '#bookingRightFixed', center: true, className: "hey"});




    <?php
}

if ($this->router->fetch_class() !="users") {?>

          //google.maps.event.addDomListener(window, 'load', loadPlacesMap);
    <?php
}
 ?>
        $("ul#WishListMapSection a").on("click", function () {
            $("#wishlist_map").removeAttr("style")
        });
<?php if ($this->uri->segment(1) == 'user-wishlist' && $wishlists != '') { ?>
           // google.maps.event.addDomListener(window, 'load', loadWishlistMap);
    <?php
}
if ($this->router->fetch_class() == "index" && !strpos(current_url(), "contact")) {
    ?>
//            $("div#scrollfeeds").smoothDivScroll({
//                autoScrollingMode: "onStart",
//                hotSpotScrollingStep: 5,
//                autoScrollingInterval: 50,
//                hotSpotScrollingInterval: 45
//            });
<?php } ?>
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
    // alert('not');
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
            $('#save_button').attr('disabled', 'disabled');
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

/*window.onload=function()
{
    window.setTimeout( function()
    {
        save_application();
    }, 5000);
};
*/
    /* About me => occupants */
    occupantsDiv = $('#occupants');

    // if( occupantsCount == '' )
    if( typeof occupantsCount == 'undefined' )
    {
        occupantsCount = 0;
    }

    $('#add_occupant').click(function()
    {
        if( occupantsCount == '5' )
        {
            $('#add_occupant').attr('disabled', true);
            return false;
        }
        else
        {
            $('#add_occupant').removeAttr('disabled');
        }

        occupantsCount++;
        $('input#a_occupant_count').val(occupantsCount);

        if( occupantsCount == '5' )
        {
            $('#add_occupant').attr('disabled', true);
        }

        if( occupantsCount == 1)
        {
            occupantsDiv.append('<div id="occupant_'+occupantsCount+'"><h4>Other Occupant #'+occupantsCount+'</h4>'+
            '<div class="form-group col-md-6">'+
            '<label class="control-label" for="fullname">Full Name</label>'+
            '<input type="text" class="form-control custom-host-input" name="a_occupant_name_'+occupantsCount+'" value="" placeholder="John Smith">'+
            '</div>'+
            '<div class="form-group col-md-6">'+
            '<label class="control-label" for="fullname">Phone Number</label>'+
            '<input type="text" class="form-control custom-host-input" name="a_occupant_phone_'+occupantsCount+'" value="" placeholder="(555) 555-5555 ext. 55555">'+
            '</div>'+
            '</div>');
        }
        else
        {
            occupantsDiv.append('<div id="occupant_'+occupantsCount+'"><h4>Other Occupant #'+occupantsCount+' <a class="btn btn-danger btn-sm remove_occupants"><span title="Delete" class="glyphicon glyphicon-trash"></span></a></h4>'+
            '<div class="form-group col-md-6">'+
            '<label class="control-label" for="fullname">Full Name</label>'+
            '<input type="text" class="form-control custom-host-input" name="a_occupant_name_'+occupantsCount+'" value="" placeholder="John Smith">'+
            '</div>'+
            '<div class="form-group col-md-6">'+
            '<label class="control-label" for="fullname">Phone Number</label>'+
            '<input type="text" class="form-control custom-host-input" name="a_occupant_phone_'+occupantsCount+'" value="" placeholder="(555) 555-5555 ext. 55555">'+
            '</div>'+
            '</div>');
        }

        return false;

    });

    //Remove button
    $(document).on('click', '.remove_occupants', function()
    {
        /*if( occupantsCount > 2 )
        {
            // $(this).closest('div').remove();
        }*/
        // alert(occupantsCount);
        $('div#occupant_'+occupantsCount).remove();
        if( occupantsCount >= '5' )
        {
            $('#add_occupant').removeAttr('disabled');
        }
        occupantsCount--;
        $('input#a_occupant_count').val(occupantsCount);
        return false;
    });


    /* Residences */
    $("input[name$='r_current_housing_type']").click(function()
    {
        var show_r_current_housing_type = $(this).val();
        if( show_r_current_housing_type == 'Rented' )
        {
            $("input[name$='r_current_monthly_rent']").attr('required');
            $("#current_housing_rented").show();
        }
        else
        {
            $("input[name$='r_current_monthly_rent']").removeAttr('required');
            $("#current_housing_rented").hide();
        }
    });

    $("input[name$='r_previous_housing_type']").click(function()
    {
        var show_r_previous_housing_type = $(this).val();
        // alert(show_r_previous_housing_type);
        if( show_r_previous_housing_type == 'Rented' )
        {
            $("input[name$='r_previous_address']").attr('required');
            $("input[name$='r_previous_move_in_date']").attr('required');
            $("input[name$='r_previous_monthly_rent']").attr('required');
            $("#previous_housing_rented_none").show();
            $("#previous_housing_rented").show();
        }
        if( show_r_previous_housing_type == 'None' )
        {
            $("input[name$='r_previous_address']").removeAttr('required');
            $("input[name$='r_previous_move_in_date']").removeAttr('required');
            $("input[name$='r_previous_monthly_rent']").removeAttr('required');
            $("#previous_housing_rented_none").hide();
        }
        if( show_r_previous_housing_type == 'Owned' )
        {
            $("input[name$='r_previous_address']").attr('required');
            $("input[name$='r_previous_move_in_date']").attr('required');
            $("input[name$='r_previous_monthly_rent']").removeAttr('required');
            $("#previous_housing_rented_none").show();
            $("#previous_housing_rented").hide();
        }
    });

    /* Occupation */
    $("input[name$='o_current_status']").click(function()
    {
        var show_o_current_status = $(this).val();
        if( show_o_current_status == 'Employed' )
        {
            $("input[name$='o_current_employer']").attr('required');
            $("input[name$='o_current_job_title']").attr('required');
            $("input[name$='o_current_monthly_salary']").attr('required');
            $("input[name$='o_current_manager_name']").attr('required');
            $("input[name$='o_current_manager_phone_no']").attr('required');
            $("input[name$='o_current_start_date']").attr('required');

            $("input[name$='o_current_monthly_income_source']").removeAttr('required');
            $("input[name$='o_current_monthly_income']").removeAttr('required');

            $("#o_employed").show();
            $("#o_other").hide();
        }
        else
        {
            $("input[name$='o_current_employer']").removeAttr('required');
            $("input[name$='o_current_job_title']").removeAttr('required');
            $("input[name$='o_current_monthly_salary']").removeAttr('required');
            $("input[name$='o_current_manager_name']").removeAttr('required');
            $("input[name$='o_current_manager_phone_no']").removeAttr('required');
            $("input[name$='o_current_start_date']").removeAttr('required');

            $("input[name$='o_current_monthly_income_source']").attr('required');
            $("input[name$='o_current_monthly_income']").attr('required');

            $("#o_employed").hide();
            $("#o_other").show();
        }
    });

    $("input[name$='o_previous_status']").click(function()
    {
        var show_o_previous_status = $(this).val();
        if( show_o_previous_status == 'Employed' )
        {
            $("input[name$='o_previous_employer']").attr('required');
            $("input[name$='o_previous_job_title']").attr('required');
            $("input[name$='o_previous_monthly_salary']").attr('required');
            $("input[name$='o_previous_manager_name']").attr('required');
            $("input[name$='o_previous_manager_phone_no']").attr('required');
            $("input[name$='o_previous_start_date']").attr('required');

            $("input[name$='o_previous_monthly_income_source']").removeAttr('required');
            $("input[name$='o_previous_monthly_income']").removeAttr('required');

            $("#o_previous_employed").show();
            $("#o_previous_other").hide();
        }
        else
        {
            $("input[name$='o_previous_employer']").removeAttr('required');
            $("input[name$='o_previous_job_title']").removeAttr('required');
            $("input[name$='o_previous_monthly_salary']").removeAttr('required');
            $("input[name$='o_previous_manager_name']").removeAttr('required');
            $("input[name$='o_previous_manager_phone_no']").removeAttr('required');
            $("input[name$='o_previous_start_date']").removeAttr('required');

            $("input[name$='o_previous_monthly_income_source']").attr('required');
            $("input[name$='o_previous_monthly_income']").attr('required');

            $("#o_previous_employed").hide();
            $("#o_previous_other").show();
        }

        if( show_o_previous_status == 'None' )
        {
            $("input[name$='o_previous_employer']").removeAttr('required');
            $("input[name$='o_previous_job_title']").removeAttr('required');
            $("input[name$='o_previous_monthly_salary']").removeAttr('required');
            $("input[name$='o_previous_manager_name']").removeAttr('required');
            $("input[name$='o_previous_manager_phone_no']").removeAttr('required');
            $("input[name$='o_previous_start_date']").removeAttr('required');

            $("input[name$='o_previous_monthly_income_source']").removeAttr('required');
            $("input[name$='o_previous_monthly_income']").removeAttr('required');

            $("#o_previous_employed").hide();
            $("#o_previous_other").hide();
        }

    });

    /* Additional Information */
    $("input[name$='ai_pets']").click(function()
    {
        var show_ai_pets_status = $(this).val();
        if( show_ai_pets_status == 'Yes' )
        {
            $("#ask_pets_details").show();
        }
        else
        {
            $("#ask_pets_details").hide();
        }
    });

    $("input[name$='ai_furniture']").click(function()
    {
        var show_ai_furniture_status = $(this).val();
        if( show_ai_furniture_status == 'Yes' )
        {
            $("#ask_furniture_details").show();
        }
        else
        {
            $("#ask_furniture_details").hide();
        }
    });

    $("input[name$='ai_bedbugs']").click(function()
    {
        var show_ai_bedbugs_status = $(this).val();
        if( show_ai_bedbugs_status == 'Yes' )
        {
            $("#ask_bedbugs_details").show();
        }
        else
        {
            $("#ask_bedbugs_details").hide();
        }
    });

    $("input[name$='ai_evicted']").click(function()
    {
        var show_ai_evicted_status = $(this).val();
        if( show_ai_evicted_status == 'Yes' )
        {
            $("#ask_evicted_details").show();
        }
        else
        {
            $("#ask_evicted_details").hide();
        }
    });

    $("input[name$='ai_bankruptcy']").click(function()
    {
        var show_ai_bankruptcy_status = $(this).val();
        if( show_ai_bankruptcy_status == 'Yes' )
        {
            $("#ask_bankruptcy_details").show();
        }
        else
        {
            $("#ask_bankruptcy_details").hide();
        }
    });

    $("input[name$='ai_illegal_drugs']").click(function()
    {
        var show_ai_illegal_drugs_status = $(this).val();
        if( show_ai_illegal_drugs_status == 'Yes' )
        {
            $("#ask_illegal_drugs_details").show();
        }
        else
        {
            $("#ask_illegal_drugs_details").hide();
        }
    });


    /* Financial */
    $('#f_dont_have_account').change(function()
    {
        if(this.checked)
        {
            $('#ask_for_bank').hide().fadeOut('slow');
        }
        else
        {
            $('#ask_for_bank').show().fadeIn('slow');
        }
    });

    banksDiv = $('#banks');
    if( typeof banksCount == 'undefined' )
    {
        banksCount = 0;
    }

    $('#add_bank').click(function()
    {
        if( banksCount == '5' )
        {
            $('#add_bank').attr('disabled', true);
            return false;
        }
        else
        {
            $('#add_bank').removeAttr('disabled');
        }

        banksCount++;
        $('input#f_bank_count').val(banksCount);
        if( banksCount == '5' )
        {
            $('#add_bank').attr('disabled', true);
        }

        if( banksCount == 1)
        {
            banksDiv.append('<div id="bank_'+banksCount+'"><h4>Bank Account #'+banksCount+'</h4>'+
            '<div class="row">'+
                '<div class="form-group col-md-6">'+
                    '<label class="control-label" for="">Bank Name</label>'+
                    '<input type="text" class="form-control custom-host-input" name="f_bank_name_'+banksCount+'" placeholder="Bank" required>'+
                '</div>'+
                '<div class="form-group col-md-6">'+
                    '<label class="control-label" for="">Bank Address</label>'+
                    '<input type="text" class="form-control custom-host-input" name="f_bank_address_'+banksCount+'" placeholder="123 Main St Suite 400" required>'+
                '</div>'+
                '<div class="form-group col-md-4">'+
                    '<label class="control-label" for="">Account Number</label>'+
                    '<input type="email" class="form-control custom-host-input" name="f_account_number_'+banksCount+'" placeholder="987654321" required>'+
                '</div>'+
                '<div class="form-group col-md-4">'+
                    '<label class="control-label" for="">Account Balance (Approx)</label>'+
                    '<input type="number" class="form-control custom-host-input" name="f_account_balance_'+banksCount+'" placeholder="$" required>'+
                '</div>'+
                '<div class="form-group col-md-4">'+
                    '<label class="control-label" for="">Account Type</label>'+
                    '<select name="f_account_type_'+banksCount+'" class="form-control" required>'+
                    '<option value="Checking">Checking</option>'+
                    '<option value="Checking">Savings</option>'+
                    '</select>'+
                    //<input type="date" class="form-control custom-host-input" name="f_account_type_'+banksCount+'" placeholder="  ">'+
                '</div>'+
            '</div>');
        }
        else
        {
            banksDiv.append('<div id="bank_'+banksCount+'"><h4>Bank Account #'+banksCount+'<a class="btn btn-danger btn-sm remove_banks"><span title="Delete" class="glyphicon glyphicon-trash"></span></a></h4>'+
            '<div class="row">'+
                '<div class="form-group col-md-6">'+
                    '<label class="control-label" for="">Bank Name</label>'+
                    '<input type="text" class="form-control custom-host-input" name="f_bank_name_'+banksCount+'" placeholder="Bank" required>'+
                '</div>'+
                '<div class="form-group col-md-6">'+
                    '<label class="control-label" for="">Bank Address</label>'+
                    '<input type="text" class="form-control custom-host-input" name="f_bank_address_'+banksCount+'" placeholder="123 Main St Suite 400" required>'+
                '</div>'+
                '<div class="form-group col-md-4">'+
                    '<label class="control-label" for="">Account Number</label>'+
                    '<input type="email" class="form-control custom-host-input" name="f_account_number_'+banksCount+'" placeholder="987654321" required>'+
                '</div>'+
                '<div class="form-group col-md-4">'+
                    '<label class="control-label" for="">Account Balance (Approx)</label>'+
                    '<input type="number" class="form-control custom-host-input" name="f_account_balance_'+banksCount+'" placeholder="$" required>'+
                '</div>'+
                '<div class="form-group col-md-4">'+
                    '<label class="control-label" for="">Account Type</label>'+
                    '<select name="f_account_type_'+banksCount+'" class="form-control" required>'+
                    '<option value="Checking">Checking</option>'+
                    '<option value="Savings">Savings</option>'+
                    '</select>'+
                    //<input type="date" class="form-control custom-host-input" name="f_account_type_'+banksCount+'" placeholder="  ">'+
                '</div>'+
            '</div>');
        }

        return false;

    });

    //Remove button
    $(document).on('click', '.remove_banks', function()
    {
        $('div#bank_'+banksCount).remove();
        if( banksCount >= '5' )
        {
            $('#add_bank').removeAttr('disabled');
        }
        banksCount--;
        $('input#f_bank_count').val(banksCount);
        return false;
    });

    /* Misc. */

    loansDiv = $('#loans');
    if( typeof loansCount == 'undefined' )
    {
        loansCount = 0;
    }

    $('#add_loan').click(function()
    {
        if( loansCount == '5' )
        {
            $('#add_loan').attr('disabled', true);
            return false;
        }
        else
        {
            $('#add_loan').removeAttr('disabled');
        }

        loansCount++;
        $('input#f_loans_count').val(loansCount);
        if( loansCount == '5' )
        {
            $('#add_loan').attr('disabled', true);
        }

        if( loansCount == 1)
        {
            loansDiv.append('<div id="loan_'+loansCount+'"><h4>Loan #'+loansCount+'</h4>'+
            '<div class="row">'+
                '<div class="form-group col-md-3">'+
                    '<label class="control-label" for="">Creditor Name</label>'+
                    '<input type="text" class="form-control custom-host-input" name="m_loan_creditor_name_'+loansCount+'" placeholder="Bank">'+
                '</div>'+
                '<div class="form-group col-md-3">'+
                    '<label class="control-label" for="">Creditor Address</label>'+
                    '<input type="text" class="form-control custom-host-input" name="m_loan_creditor_address_'+loansCount+'" placeholder="123 Main St Suite 400">'+
                '</div>'+
                '<div class="form-group col-md-3">'+
                    '<label class="control-label" for="">Phone Number</label>'+
                    '<input type="email" class="form-control custom-host-input" name="m_loan_phone_no_'+loansCount+'" placeholder="987654321">'+
                '</div>'+
                '<div class="form-group col-md-3">'+
                    '<label class="control-label" for="">Monthly Payment</label>'+
                    '<input type="number" class="form-control custom-host-input" name="m_loan_monthly_payment_'+loansCount+'" placeholder="$">'+
                '</div>'+
            '</div>');
        }
        else
        {
            loansDiv.append('<div id="loan_'+loansCount+'"><h4>Loan #'+loansCount+'<a class="btn btn-danger btn-sm remove_loans"><span title="Delete" class="glyphicon glyphicon-trash"></span></a></h4>'+
            '<div class="row">'+
                '<div class="form-group col-md-3">'+
                    '<label class="control-label" for="">Creditor Name</label>'+
                    '<input type="text" class="form-control custom-host-input" name="m_loan_creditor_name_'+loansCount+'" placeholder="Bank">'+
                '</div>'+
                '<div class="form-group col-md-3">'+
                    '<label class="control-label" for="">Creditor Address</label>'+
                    '<input type="text" class="form-control custom-host-input" name="m_loan_creditor_address_'+loansCount+'" placeholder="123 Main St Suite 400">'+
                '</div>'+
                '<div class="form-group col-md-3">'+
                    '<label class="control-label" for="">Phone Number</label>'+
                    '<input type="email" class="form-control custom-host-input" name="m_loan_phone_no_'+loansCount+'" placeholder="987654321">'+
                '</div>'+
                '<div class="form-group col-md-3">'+
                    '<label class="control-label" for="">Monthly Payment</label>'+
                    '<input type="number" class="form-control custom-host-input" name="m_loan_monthly_payment_'+loansCount+'" placeholder="$">'+
                '</div>'+
            '</div>');
        }

        return false;

    });

    //Remove button
    $(document).on('click', '.remove_loans', function()
    {
        $('div#loan_'+loansCount).remove();
        if( loansCount >= '5' )
        {
            $('#add_loan').removeAttr('disabled');
        }
        loansCount--;
        $('input#f_loans_count').val(loansCount);
        return false;
    });


    vehiclesDiv = $('#vehicles');
    if( typeof vehiclesCount == 'undefined' )
    {
        vehiclesCount = 0;
    }

    $('#add_vehicle').click(function()
    {
        if( vehiclesCount == '5' )
        {
            $('#add_vehicle').attr('disabled', true);
            return false;
        }
        else
        {
            $('#add_vehicle').removeAttr('disabled');
        }
        vehiclesCount++;
        $('input#f_vehicles_count').val(vehiclesCount);
        if( vehiclesCount == '5' )
        {
            $('#add_vehicle').attr('disabled', true);
        }

        if( vehiclesCount == 1)
        {
            vehiclesDiv.append('<div id="vehicle_'+vehiclesCount+'"><h4>Vehicle #'+vehiclesCount+'</h4>'+
            '<div class="row">'+
                '<div class="form-group col-md-3">'+
                    '<label class="control-label" for="">Make</label>'+
                    '<input type="text" class="form-control custom-host-input" name="m_vehicle_make_'+vehiclesCount+'" placeholder="DeLorean">'+
                '</div>'+
                '<div class="form-group col-md-2">'+
                    '<label class="control-label" for="">Model</label>'+
                    '<input type="text" class="form-control custom-host-input" name="m_vehicle_model_'+vehiclesCount+'" placeholder="DMC-12">'+
                '</div>'+
                '<div class="form-group col-md-2">'+
                    '<label class="control-label" for="">Year</label>'+
                    '<input type="email" class="form-control custom-host-input" name="m_vehicle_year_'+vehiclesCount+'" placeholder="YYYY">'+
                '</div>'+
                '<div class="form-group col-md-2">'+
                    '<label class="control-label" for="">Color</label>'+
                    '<input type="number" class="form-control custom-host-input" name="m_vehicle_color_'+vehiclesCount+'" placeholder="Silver">'+
                '</div>'+
                '<div class="form-group col-md-3">'+
                    '<label class="control-label" for="">License Plate</label>'+
                    '<input type="number" class="form-control custom-host-input" name="m_vehicle_license_plate_'+vehiclesCount+'" placeholder="3CZV657">'+
                '</div>'+
            '</div>');
        }
        else
        {
            vehiclesDiv.append('<div id="vehicle_'+vehiclesCount+'"><h4>Vehicle #'+vehiclesCount+'<a class="btn btn-danger btn-sm remove_vehicles"><span title="Delete" class="glyphicon glyphicon-trash"></span></a></h4>'+
            '<div class="row">'+
                '<div class="form-group col-md-3">'+
                    '<label class="control-label" for="">Make</label>'+
                    '<input type="text" class="form-control custom-host-input" name="m_vehicle_make_'+vehiclesCount+'" placeholder="DeLorean">'+
                '</div>'+
                '<div class="form-group col-md-2">'+
                    '<label class="control-label" for="">Model</label>'+
                    '<input type="text" class="form-control custom-host-input" name="m_vehicle_model_'+vehiclesCount+'" placeholder="DMC-12">'+
                '</div>'+
                '<div class="form-group col-md-2">'+
                    '<label class="control-label" for="">Year</label>'+
                    '<input type="email" class="form-control custom-host-input" name="m_vehicle_year_'+vehiclesCount+'" placeholder="YYYY">'+
                '</div>'+
                '<div class="form-group col-md-2">'+
                    '<label class="control-label" for="">Color</label>'+
                    '<input type="number" class="form-control custom-host-input" name="m_vehicle_color_'+vehiclesCount+'" placeholder="Silver">'+
                '</div>'+
                '<div class="form-group col-md-3">'+
                    '<label class="control-label" for="">License Plate</label>'+
                    '<input type="number" class="form-control custom-host-input" name="m_vehicle_license_plate_'+vehiclesCount+'" placeholder="3CZV657">'+
                '</div>'+
            '</div>');
        }
        return false;

    });

    //Remove button
    $(document).on('click', '.remove_vehicles', function()
    {
        $('div#vehicle_'+vehiclesCount).remove();
        if( vehiclesCount >= '5' )
        {
            $('#add_vehicle').removeAttr('disabled');
        }
        vehiclesCount--;
        $('input#f_vehicles_count').val(vehiclesCount);
        return false;
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


function calculate_form_wieght_onload(form_id, output_id)
{
    // calculate_form_wieght(form_id, output_id);

    var cntreq = 0;
    var cntvals = 0;
    $('form#'+form_id+' input').each(function(i, val)
    {
        if($(this).attr('required') == 'required')
        {
            cntreq++;
            if($(this).val() != '')
            {
                $(this).removeClass("highlight");
                cntvals++;
            }
            else
            {
                $(this).addClass("highlight");
            }
        }
    });
    var count = (cntvals/cntreq)*100;
    $('#'+output_id).empty();


    if( isNaN(count) )
    {
        $('#'+output_id).html('0%');
        return false;
    }

    if( count == '100')
        $('#'+output_id).html('<i class="fa fa-check"></i>');
    else
        $('#'+output_id).html(Math.round(count)+'%');


    calculate_whole_form_wieght();
}

function calculate_form_wieght(form_id, output_id)
{

    // alert('1');
    $('form#'+form_id+' input').on('change', function()
    {
        // alert('2');
        var cntreq = 0;
        var cntvals = 0;
        $('form#'+form_id+' input').each(function(i, val)
        {
            if($(this).attr('required') == 'required')
            {
                cntreq++;
                if($(this).val() != '')
                {
                    $(this).removeClass("highlight");
                    cntvals++;
                }
                else
                {
                    $(this).addClass("highlight");
                }
            }
        });
        var count = (cntvals/cntreq)*100;
        $('#'+output_id).empty();

        if( isNaN(count) )
        {
            $('#'+output_id).html('0%');
            return false;
        }

        if( count == '100')
            $('#'+output_id).html('<i class="fa fa-check"></i>');
        else
            $('#'+output_id).html(Math.round(count)+'%');
        // $('#'+output_id).append(count+'%');

        calculate_whole_form_wieght();
    });
}


function calculate_whole_form_wieght()
{

    /*$('input').on('change', function()
    {*/
        // alert('2');
        var cntreq = 0;
        var cntvals = 0;
        $('input').each(function(i, val)
        {
            if($(this).attr('required') == 'required')
            {
                cntreq++;
                if($(this).val() != '')
                {
                    $(this).removeClass("highlight");
                    cntvals++;
                }
                else
                {
                    $(this).addClass("highlight");
                }
            }
        });
        var count = (cntvals/cntreq)*100;
        $('#total_count').empty();

        if( isNaN(count) )
        {
            $('#total_count').html('0%');
            return false;
        }

        if( count == '100')
        {
            $('#total_count').html('<i class="fa fa-check"></i>');
            $('#whole_form_weight').html('100% COMPLETE');
        }
        else
        {
            $('#total_count').html(Math.round(count)+'%');
            $('#whole_form_weight').html(Math.round(count)+'% COMPLETE');
        }
        // $('#'+output_id).append(count+'%');

        // save_application();
    /*});*/
}

calculate_form_wieght('about_me', 'about_me_weight');
calculate_form_wieght('residences', 'residences_weight');
calculate_form_wieght('occupation', 'occupation_weight');
calculate_form_wieght('references', 'references_weight');
calculate_form_wieght('additional', 'additional_weight');
calculate_form_wieght('financial', 'financial_weight');
calculate_form_wieght('misc', 'misc_weight');

calculate_form_wieght_onload('about_me', 'about_me_weight');
calculate_form_wieght_onload('residences', 'residences_weight');
calculate_form_wieght_onload('occupation', 'occupation_weight');
calculate_form_wieght_onload('references', 'references_weight');
calculate_form_wieght_onload('additional', 'additional_weight');
calculate_form_wieght_onload('financial', 'financial_weight');
calculate_form_wieght_onload('misc', 'misc_weight');

calculate_whole_form_wieght();

// alert('dfsdfsd');
</script>
<?php
}

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