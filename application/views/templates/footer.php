<?php // if($this->uri->segment(1) !='search') { ?>
<footer class="footer-v2" id="footer">
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
                                <li><i class="fa fa-map-marker"></i><?=$this->lang->line('address');?></li>
                                <li><i class="fa fa-phone"></i><a href="tel:<?=$this->lang->line('phone_n');?>"><?=$this->lang->line('phone_n');?></a></li>
                                <!--<li><i class="fa fa-mobile-phone"></i> <a href="tel:<?=$this->lang->line('cell_n');?>"><?=$this->lang->line('cell_n');?></a></li>-->
                                <li><i class="fa fa-envelope-o"></i><a href="mailto:<?=$this->lang->line('e-mail');?>"><?=$this->lang->line('e-mail');?></a></li>
                            </ul>
                            <div class="foot-social">
                                <p>
                                    <a href="https://www.facebook.com/neighborty/" target="_blank" class="btn-facebook"><i class="fa fa-facebook-square"></i></a>
                                    <a href="https://twitter.com/neighborty" target="_blank" class="btn-twitter"><i class="fa fa-twitter-square"></i></a>
                                    <!--<a href="https://plus.google.com/u/5/104904576541281508738" target="_blank" class="btn-google-plus"><i class="fa fa-google-plus-square"></i></a>-->
                                    <a href="https://www.instagram.com/neighborty_inc/" target="_blank" class="btn-instagram"><i class="fa fa-instagram"></i></a>
                                    <a href="https://www.pinterest.com/neighborty/" target="_blank" class="btn-pinterest"><i class="fa fa-pinterest-square"></i></a>
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
<?php// }?>

<button class="up btn scrolltop-btn back-top"><i class="fa fa-angle-up"></i></button>

<!--[if lt IE 9]>
<script src="assets/global/plugins/respond.min.js"></script>
<script src="assets/global/plugins/excanvas.min.js"></script>
<script type="text/javascript" async defer src="//assets.pinterest.com/js/pinit.js"></script>

<![endif]-->
<div id="ApprovemodelWrap"></div>
<div id="ContactHostDashboardWrap"></div>

<div id="wishlistModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content host-modal">
            <div class="modal-header host-modal-header">
                <h4 class="modal-title"><?=$this->lang->line('c_add_wishlist');?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i>
                </button>
            </div>
            <div id="wishlistContent"></div>
            <div class="container-fluid">
                <div class="row"><div class="col-md-12"><div class="notice"></div></div></div>
            </div>
        </div>
    </div>
</div>


<?php if($this->router->fetch_class() != 'inbox'):?>

<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAYxatVl0mCNR-6v6bUZNn4-VTCD9PqHVE"  type="text/javascript"></script>

<?php endif;?>


<?=put_js_footer(); ?>
<!-- This file has subfiles in it -->
<script type="text/javascript" src="<?= base_url() ?>assets/js/select2.min.js" ></script>
<script src="//cdn.jsdelivr.net/blazy/latest/blazy.min.js"></script>
<script src="<?=base_url();?>assets/js/progressive-image.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/js/js.cookie.min.js" ></script>
<!-- This file has subfiles in it -->

<script type=text/javascript>
    function setScreenHWCookie() {
        Cookies.set('sw', screen.width);
        Cookies.set('sh', screen.height);
        console.log(Cookies.get('sw'));
        return true;
    }
    setScreenHWCookie();
</script>

<?php if (!isset($_SERVER['HTTP_USER_AGENT']) || stripos($_SERVER['HTTP_USER_AGENT'], 'Speed Insights') === false): ?>
    <script type="text/javascript">

        $( document ).ajaxComplete(function( event, request, settings ) {
            var popover_ele = $('[data-toggle="popover"]');
            popover_ele.popover({
                placement: "top",
                trigger: "hover",
                html: true
            });
        });

        jQuery(document).ready(function($) {

            $('.basic-single').select2({
                placeholder: 'Select City...'
            });

            // site preloader -- also uncomment the div in the header and the css style for #preloader
            $(window).load(function(){
                $('#preloader').fadeOut('slow',function(){$(this).remove();});
            });


            //$('body').on('click','.heading',function(){




        });
    </script>
    <script>
        $(function(){ // document ready
            if (!!$('.getFixed').offset()) { // make sure ".sticky" element exists
                var stickyTop = $('.getFixed').offset().top; // returns number
                $(window).scroll(function(){ // scroll event
                    var windowTop = $(window).scrollTop(); // returns number
                    var CurrentWidth = 330;
                    if (stickyTop < windowTop){
                        //NEW SECTION
                        var footerAboveThirty = $('.carousel-module').offset().top - $('.getFixed').height() - 500;
                        if (windowTop > footerAboveThirty) {
                            $('.getFixed').css({ position: 'absolute', top: footerAboveThirty, width: CurrentWidth });
                        } else {
                            $('.getFixed').css({ position: 'fixed', top: 0, width:CurrentWidth });
                        }
                        //END NEW SECTION
                    } else {
                        $('.getFixed').css('position','static');
                    }
                });
            }
        });
    </script>
<?php endif; ?>

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-77014915-6" async></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-77014915-6');
</script>


<?php if($this->router->fetch_class() == 'search'  && $this->router->fetch_method() == 'index') {?>
    <script type="text/javascript" src="<?= base_url() ?>assets/js/properties.js" ></script>


    <script type="text/javascript">

        jQuery(document).ready(function () {

            $.get("https://api.ipdata.co?api-key=test", function (response) {
                console.log(response);
                console.log(response.latitude);
                console.log(response.longitude);

                Cookies.set('lat', response.latitude);
                Cookies.set('lng', response.longitude);

            }, "jsonp");

            //$('#search_city').select2().val($('#hiddeninput').val()).trigger('change.select2');
            //loadListingMap();
            //loadSearchMap();
            // initMap();


            displayPricingDropdown();

        });





    </script>

<?php } ?>

<?php if ($this->uri->segment(2) == 'confirm_package' OR $this->uri->segment(2) == 'confirm_payment') { ?>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script>
        $(document).ready(function(){
            Stripe.setPublishableKey('pk_test_xPZWkOwAOn3NQjrBINmr62fk'); $("input[type='radio']").click(function(){ var val = $(this).attr("value");if(val == "paypal"){ ;$("#stripe_box").fadeOut("slow");}else{$("#stripe_box").fadeIn("slow")}});
        });
    </script>

<?php } ?>


<script>

    function is_location_valid(address) {
        var geocoder = new google.maps.Geocoder();

        geocoder.geocode( {"address": address}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK)
            {
                $(".search_submit").attr("disabled", false);
                $('#notice').html('');
            }
            else
            {
                $('#notice').attr('style','color:#a94442');
                $('#notice').html('Please select a valid address from the suggestions');
                $(".search_submit").attr("disabled", true);
            }
        });
    }
</script>

<?php if($this->router->fetch_class() != 'inbox'):?>
<?php if(!$this->agent->is_mobile() ){ ?>

        <script type="text/javascript">
            jQuery(document).ready(function () {
                $('.gm-style-iw').parent().parent().parent().siblings().addClass("class_name");
               // loadPlacesMap();
            //    applyHovers();
            });

        </script>
<?php } else{ ?>

        <script type="text/javascript">
            jQuery(document).ready(function () {
                $('.gm-style-iw').parent().parent().parent().siblings().addClass("class_name");
               // loadMobileMap();
                applyHovers();
            });

        </script>
<?php } ?>


<?php endif;?>

<?php if ((strpos(current_url(), "property")) && $mapjs) { ?>

    <script type="text/javascript">
        var map = null;
        var panorama = null;
        var myLatLng = {lat: <?=$listing->latitude ?>, lng: <?=$listing->longitude ?>};
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
        var tabsHeight = function () {
            jQuery("#map,#street-map").css('min-height', jQuery(".detail-media #gallery").innerHeight());
        };

        jQuery(window).on('load', function () {
            tabsHeight();
        });
        jQuery(window).on('resize', function () {
            tabsHeight();
        });

        function initialize() {

            map = new google.maps.Map(document.getElementById('map'), mapOptions);
           // test = new google.maps.LatLng(<?=$listing->latitude ?>, <?=$listing->longitude ?>);
            var myCity = new google.maps.Circle({
                center: fenway,
               // radius: Math.sqrt(fenway) * 10,
                radius: 1500,
                strokeColor: "#00aeef",
                strokeOpacity: 0.9,
                strokeWeight: 2,
                fillColor: "#00aeef",
                fillOpacity: 0.2
            });

            myCity.setMap(map);
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
    var bLazy = new Blazy({
        container: '#search_items '
        , success: function(){
           //
        }
    });





</script>


<?php if ($this->uri->segment(1) == 'contact') { ?>

    <script type="text/javascript">
        $(".contact_select").select2();
        $(".agent_language").select2();
    </script>
<?php } ?>

<?php if ($this->uri->segment(2) == 'confirm_package' OR $this->uri->segment(2) == 'confirm_payment') { ?>
    <!--<script type="text/javascript" src="https://js.stripe.com/v2/"></script>-->
    <!--<script type="text/javascript" src="https://js.squareup.com/v2/paymentform"></script>-->
<?php } ?>



<script>
    $(function () {
        var window_height = $(window).height();
        var page_height = $(document).height();
        var header_height = $("#header").height();
        var footer_height = $("#footer_section").height();
        var active_height = window_height - header_height - footer_height - 250;
        if (page_height > 768) {
            $(".blog-content").css('min-height', active_height + 'px');
        }


    });
    <?php if ($this->uri->segment(2) !== 'edit') { ?>
    $(document).ready(function () {
        $('.owl-carousel').owlCarousel(
            {
                items: 2,
                lazyLoad: false,
                lazyFollow: true,
                autoHeight: true,
                navigation: true,
                navigationText: ["prev", "next"],
                rewindNav: true,
                scrollPerPage: false,
            });
    });
    <?php } ?>

    <?php if ($this->uri->segment(1) == 'listings') { ?>
    $(document).on("click", "#viewApp", function() {
        console.log("master");
        applicants_id = $(this).attr("data-applicant-id");
        $("#applicants_"+applicants_id).toggle("fast");
    });

    $(document).on("click", ".link", function() {
        $('.tab-content div').hide();
        $('#' + $(this).data('rel')).addClass('in active').show();

    });


    <?php } ?>

</script>

<script>
    jQuery(document).ready(function($) {
        <?= put_extra_js(); ?>
    });
</script>
<?php

if (isset($custom_js)) {
    if (is_array($custom_js)) {
        foreach ($custom_js as $js) {
            if (stristr($js, '<script'))
                print $js;
            else {
                print '<script type="text/javascript">';
                print $js;
                print '</script>';
            }
        }
    } else {
        if (stristr($custom_js, '<script'))
            print $custom_js;
        else {
            print '<script type="text/javascript">';
            print $custom_js;
            // print str_ireplace('mha-script', 'script', $custom_js);
            print '</script>';
        }
    }
}
if (isset($js_code)) {
    if (stristr($js_code, '<script'))
        echo $js_code;
    else {
        echo '<script type="text/javascript">';
        echo $js_code;
        echo '</script>';
    }
}
?>
</body>
</html>