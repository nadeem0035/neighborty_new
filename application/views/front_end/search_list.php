<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
    .header_section_4.search_header .header-user ul li a, .header_section_4 .main-nav ul li a {
        line-height:55px;
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
<body>
<!--<div id="preloader">
    <div class="tb-cell">
        <div id="page-loading">
            <div></div>
            <p>Loading</p>
        </div>
    </div>
</div>-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<header id="header-section" class="header_section_4 header-main splash-header search_header hidden-sm hidden-xs" data-sticky="1">
    <div class="container-fluid">
        <?php $this->load->view('includes/menu/result_menu') ;?>
        <div class="row">
            <div class="top_area page-title breadcrumb-top hided">
                <?php
                    $property_type = $this->input->get_post('property_type');
                    $p_type = $this->input->get_post('type');
                    ?>
                <div class="page-title-left property_tabs">
                    <?php $this->load->view('includes/search/listing_search');?>
                </div>
                <div class="page-title-right">
                        <div class="view">
                            <div class="table-cell hidden-xs">
                                <label class="pull-left"><?=$this->lang->line('sr_sort_by');?>:</label>
                                <select class="pull-left" name="sort_type" id="sort_properties" title="Select Sort By">
                                    <option value="date-posted"><?=$this->lang->line('sr_bydate');?></option>
                                    <option value="low-to-high"><?=$this->lang->line('sr_byprice');?></option>
                                    <option value="high-to-low"><?=$this->lang->line('sr_byprice_d');?></option>
                                </select>
                            </div>
                            <div class="table-cell">
                                <lable class="pull-left">Show Map:</lable>
                                <label class="bs-switch">
                                    <input type="checkbox" data-toggle="toggle" class="togglebtn" name="togglebtn">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</header>
<?php $this->load->view('mobile/mobile_header') ;?>
<?php $this->load->view('mobile/mobile_search') ;?>
<div id="about-area"></div>
<?=$this->load->view('properties/search_hidden_form');?>

<section id="section-body" class="margin-top-105 no-padding">
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <!--<div class="_1vl409"></div>-->
                <div class="property-listing grid-view-3-col grid-view">
                    <div id="search_loader" class="map-list-loader-container" style="display: none">
                        <div class="map-list-loader" id=""><span class="zsg-loading-spinner"></span> Loading... </div>
                    </div>
                    <div class="" id="search_results">
                        <?php $this->load->view('front_end/index_search');  ?>
                    </div>
                </div>
            </div>

            <!--<aside class="module-half fave-screen-fix col-lg-2 col-md-3 col-sm-12 col-xs-12">
                <div class="_1vl410"></div>
                <div class="widget widget-poster-post">
                    <div class="poster poster_300x90"><a href="#"><img src="<?/*=base_url()*/?>assets/img/poster/300x90.jpg" class="img-responsive"></a></div>
                    <div class="poster poster_300x90"><a href="#"><img src="<?/*=base_url()*/?>assets/img/poster/336x280.png" class="img-responsive"></a></div>
                    <div class="poster poster_300x300"><a href="#"><img src="<?/*=base_url()*/?>assets/img/poster/336x280.png" class="img-responsive"></a></div>
                    <div class="poster poster_300x300"><a href="#"><img src="<?/*=base_url()*/?>assets/img/poster/336x280.png" class="img-responsive"></a></div>
                </div>
            </aside>-->

        </div>
    </div>
</section>




