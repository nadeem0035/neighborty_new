<div class="row">
    <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12 no-padding">
        <div class="map-half fave-screen-fix">
            <?php if(!empty($listings)) {
                ?>
                <div id="search_listing_map" class="fave-screen-fix listed-map searchMaps" style="width:100%; height:100%"></div>
            <?php } else { ?>
                <div class="mapouter">
                    <div class="gmap_canvas">
                        <iframe width="100%" height="100%" id="gmap_canvas" src="https://maps.google.com/maps?q=pakistan&t=&z=5&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                    </div>
                    <style>.mapouter{text-align:right;height:100%;width:100%;}.gmap_canvas {overflow:hidden;background:none!important;height:1600px;width:900px;}</style>
                </div>

            <?php } ?>
        </div>
    </div>

    <div class="col-lg-7 col-md-6 col-sm-12 col-xs-12 padding-right-none">
        <div class="module-half fave-screen-fix">

                <div id="search_results">
                    <?php $this->load->view('front_end/search_results');  ?>
                </div>

        </div>
    </div>
</div>



