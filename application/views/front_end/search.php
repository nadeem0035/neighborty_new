<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
    .header_section_4.search_header .header-user ul li a, .header_section_4 .main-nav ul li a {
        line-height: 45px;
    }
    .toggle_mapsearch{
        padding:9px 14px !important;  background-color: rgb(255, 255, 255) !important;  box-shadow: rgba(0, 0, 0, 0.1) 0 1px 1px !important;  border-radius: 4px !important;
    }
    .toggle_mapsearch label{
        font-size:13px;  margin-bottom:0;
    }
    .toggle_mapsearch label input[type=checkbox]{
        margin-left: 8px;  margin-top: 4px;  float: right;
    }
</style>
<body style="overflow-y:hidden; overflow-x:hidden;">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <header class="header_section_4 header-main splash-header search_header hidden-sm hidden-xs" data-sticky="1">
        <div class="container-fluid">
            <?php $this->load->view('includes/menu/result_menu') ;?>
            <?php $this->load->view('includes/search/listing_search');  ?>
        </div>
    </header>

    <?php $this->load->view('mobile/mobile_header') ;?>
    <?php $this->load->view('mobile/mobile_search') ;?>


<div id="about-area"></div>

<?php /*if(!empty($listings)) { */?>
    <section id="section-body" class="houzez-body-half">

        <div class="container-fluid">
            <div class="row">
                <div class="btn-listserch">
                    <a href="#" class="search_results btn active btn-sm">List view</a>
                    <a href="#" class="search_listing_map btn btn-sm">Map view</a>
                </div>

                <div id="mapHide" class="col-md-6 col-sm-6 col-xs-12 no-padding" style="overflow:hidden;">
                    <div class="map-half fave-screen-fix">
                        <?php if(!empty($listings)) {
                            ?>
                        <div id="search_listing_map" class="fave-screen-fix listed-map searchMaps"></div>
                        <?php } else { ?>
                            <div class="mapouter">
                                <div class="gmap_canvas">
                                    <iframe width="900" height="1200" id="gmap_canvas" src="https://maps.google.com/maps?q=pakistan&t=&z=5&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                                </div>
                                <style>.mapouter{text-align:right;height:1200px;width:900px;}.gmap_canvas {overflow:hidden;background:none!important;height:1200px;width:900px;}</style>
                            </div>
                       <?php } ?>
                    </div>
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12 no-padding">
                    <div class="" id="search_results">
                        <div id="search_loader" class="map-list-loader-container" style="display: none">
                            <div class="map-list-loader" id=""><span class="zsg-loading-spinner"></span> Loading... </div>
                        </div>
                          <?php $this->load->view('front_end/search_results');  ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
   <!-- <?php /*} else { */?>
    <section class="no_results houzez-body-half" style="margin-top:50px;">
        <div class="container">
            <div class="page-main">
                <div class="article-detail text-center">
                    <h1>Don't see any homes?</h1>
                    <p>Please update your search criteria</p>
                </div>
            </div>
        </div>
    </section>

--><?php /*} */?>


