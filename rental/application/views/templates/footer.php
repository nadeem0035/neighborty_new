<!-- Mobile Footer goes here -->
<div class="container tbc-mobile-footer" id = "mobile-footer">
    <div class="row top-desti-mf">
        <h3>Company Info</h3>
        <a href="<?= site_url('page/about')?>" title="">About Us</a> /
        <a href="<?= site_url('page/mission')?>" title="">Our Mission</a> /
        <a href="<?= site_url('page/press')?>" title="">Press</a> /
        <a href="<?= site_url('page/career')?>" title="">Careers</a> /
        <a href="<?= site_url('contact')?>" title="">Contact Us</a> /
    </div>
    <div class="row top-desti-mf">
        <h3>Learn More</h3>
        <a href="<?= site_url('page/faqs')?>" title="">FAQs </a> /
        <a href="<?= site_url('listings/add-listing')?>" title="">Add a Listing</a> / 
        <a href="<?= site_url('page/legal')?>" title="">Legal</a> /
        <a href="<?= site_url('page/stories')?>" title="">Stories </a> 
    </div>
    <div class="row top-desti-mf">
        <h3>Follow Us</h3>
        <a href="https://www.facebook.com/stayluxus" target="_blank" title="">Facebook</a> / 
        <a href="https://twitter.com/stayluxus"  target="_blank" title="">Twitter</a> /
        <a href="https://instagram.com/stayluxus/"  target="_blank" title="">Instagram</a> /
        <a href="https://www.pinterest.com/stayluxus" target="_blank" title="">Pinterest</a>
    </div>
    <div class="row top-desti-mf">
        <h3>Secure Payments</h3>
        <img src="<?= base_url() ?>assets/img/payment-logo.png">
    </div>
        <hr class="footerhr" style="width:100%;">
        <div class="tbc-copyrights1 col-md-6 col-xs-6" ><span class="tbc-copyrights">@ Copyrights - 2015, All Rights Reserved</span></div>
        <div class="createdby col-md-6 col-xs-6"> <span>Created by </span><a target="_blank" href="http://www.abiginc.com"><img src="<?= base_url(); ?>assets/img/logo_abiginc.png" width="100"  /></a></div>
</div>
<!-- Mobile Footer goes here -->
<div class="page-footer" id="footer_section" style="background:#111111; height:100%;margin-bottom: -2%;">

<div class="container">
    <div class="page-footer-inner">
        <footer class="mobfooter">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 desktopFooterLeft">
                        <h4 class="tbc-footer-col ft-cl">Company Info</h4>
                        <div class="col-xs-12">
                            <div class="ul-ft">
                                <ul class="tbc-footer-col-inner">
                                    <li> <a href="<?= site_url('page/about')?>" title="">About Us</a> </li>
                                    <li> <a href="<?= site_url('page/mission')?>" title="">Our Mission</a> </li>
                                    <li> <a href="<?= site_url('page/press')?>" title="">Press</a> </li>
                                    <li> <a href="<?= site_url('page/career')?>" title="">Careers</a> </li>
                                    <li> <a href="<?= site_url('contact')?>" title="">Contact Us</a> </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <h4 class="tbc-footer-col ft-cl">Learn More</h4>
                        <div class="col-xs-12">
                            <div class="ul-ft">
                                <ul class="tbc-footer-col-inner">
                                    <li> <a href="<?= site_url('page/faqs')?>" title="">FAQs </a> </li>
                                    <li> <a href="<?= site_url('listings/add-listing')?>" title="">Add a Listing</a> </li>
                                    <li> <a href="<?= site_url('page/press')?>" title="">Press</a></li>
                                    <li> <a href="<?= site_url('page/legal')?>" title="">Legal</a></li>
                                    <li> <a href="<?= site_url('page/stories')?>" title="">Stories </a> </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <h4 class="tbc-footer-col ft-cl">Follow Us</h4>
                        <div class="col-xs-12">
                            <div class="ul-ft">
                                <ul class="tbc-footer-col-inner">
                                    <li><a href="https://www.facebook.com/stayluxus" target="_blank" title="">Facebook</a>
                                    </li>
                                    <li><a href="https://twitter.com/stayluxus"  target="_blank" title="">Twitter</a>
                                    </li>
                                    <li><a href="https://instagram.com/stayluxus/"  target="_blank" title="">Instagram</a>
                                    </li>
                                    <li><a href="https://www.pinterest.com/stayluxus" target="_blank" title="">Pinterest</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 desktopFooterRight">
                        <h4 class="tbc-footer-col ft-cl">Secure Payments</h4>
                        <img src="<?= base_url(); ?>assets/img/payment-logo.png">
                    </div>
                </div>
                <hr class="footerhr" style="width:100%;">
                <div class="col-md-6" ><span class="tbc-copyrights">@ Copyrights - 2015, All Rights Reserved</span></div>
                <div class="createdby col-md-6"> <span>Created by </span><a target="_blank" href="http://www.abiginc.com"><img src="<?= base_url(); ?>assets/img/logo_abiginc.png" width="100"  /></a></div>
            </div>
        </footer>
    </div>
    <div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
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

<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAYxatVl0mCNR-6v6bUZNn4-VTCD9PqHVE" type="text/javascript"></script>
<script>

    var site_url = "<?php echo base_url(); ?>"; 
    var base_url = "<?php echo base_url(); ?>";
</script>
<?php if ($this->uri->segment(2) == 'confirm-booking') { ?>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<?php } ?>
<?php
put_js_footer();
?>
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
<script>
    jQuery(document).ready(function () {

        <?= put_extra_js(); ?>



       // loadPlacesMap();
        Metronic.init();
        Layout.init();
        Demo.init();

        $.backstretch([
            base_url + "assets/media/bg/bg-1.jpg",
            base_url + "assets/media/bg/bg-2.jpg",
            base_url + "assets/media/bg/bg-3.jpg",
            base_url + "assets/media/bg/bg-4.jpg"
        ], {
            fade: 1000,
            duration: 6000
        }
        );
        $('ul.page-sidebar-menu li.active').parents('li').addClass('active');
    });
    $(document).ready(function () {
<?php if (strpos(current_url(), "booking/detail")) { ?>
            google.maps.event.addDomListener(window, 'load', bookingDetailMap(<?= $listing->latitude ?>,<?= $listing->longitude ?>));
            $("#bookingRightFixed").sticky({topSpacing: 80, bottomSpacing: 400, responsiveWidth: true, getWidthFrom: '#bookingRightFixed', center: true, className: "hey"});




    <?php
}

if ($this->router->fetch_class() !="users") {?>

          //google.maps.event.addDomListener(window, 'load', loadPlacesMap);
    <?php
}
if (strpos(current_url(), "search")) {
    ?>
            google.maps.event.addDomListener(window, 'load', loadSearchMap);
<?php } ?>
        $("ul#WishListMapSection a").on("click", function () {
            $("#wishlist_map").removeAttr("style")
        });
<?php if ($this->uri->segment(1) == 'user-wishlist' && $wishlists != '') { ?>
            google.maps.event.addDomListener(window, 'load', loadWishlistMap);
    <?php
}
if ($this->router->fetch_class() == "index" && !strpos(current_url(), "contact")) {
    ?>
            $("div#scrollfeeds").smoothDivScroll({
                autoScrollingMode: "onStart",
                hotSpotScrollingStep: 5,
                autoScrollingInterval: 50,
                hotSpotScrollingInterval: 45
            });
<?php } ?>
    });
</script>
</body>
</html>