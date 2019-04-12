<?php defined( 'BASEPATH') OR exit( 'No direct script access allowed'); ?>
<body>
<?php $this->load->view('templates/'.$topmenu); ?>
<?php $this->load->view('templates/quick_searchform'); ?>

<!--<div class="header-media">
    <div class="banner-parallax" style="height: 400px;">
        <div class="banner-bg-wrap">
            <div class="banner-inner" style="background-image: url(<?/*=base_url();*/?>/assets/img/inner-page-banner.jpg);">
                <div class="banner-caption">
                    <h1>About Neighborty</h1>
                    <h2>A Real Estate Portal You Can Trust</h2>
                </div>
            </div>
        </div>
    </div>
</div>-->

<section id="section-body">
    <div class="container">

        <div class="page-title breadcrumb-top">
            <div class="row">
                <div class="col-sm-12">
                    <ol class="breadcrumb">
                        <li><a href="/"><i class="fa fa-home"></i></a></li>
                        <li class="active">About Neighborty</li>
                    </ol>
                    <div class="page-title-left">
                        <h2>About Neighborty</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!--<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 col-md-offset-0 col-sm-offset-3 container-sidebar">
                <aside id="sidebar">

                    <div class="widget widget-categories">
                        <div class="widget-top">
                            <h3 class="widget-title">Browse</h3>
                        </div>
                        <div class="widget-body">
                            <ul>
                                <li><a href="#">What is neighborty?</a></li>
                                <li><a href="#">Mission Statement</a> </li>
                                <li><a href="#">Who it's for</a> </li>
                                <li><a href="#">Features</a> </li>
                            </ul>
                        </div>
                    </div>

                </aside>
            </div>--> <!-- Left Column -->

            <!--<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 container-contentbar">-->
            <div class="page-main">



                <section class="advanced-search-mobile visible-xs visible-sm">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <form>
                                    <div class="single-search-wrap">
                                        <div class="single-search-inner advance-btn">
                                            <button class="table-cell text-left" type="button"><i class="fa fa-gear"></i></button>
                                        </div>
                                        <div class="single-search-inner single-search">

                                            <input type="text" class="form-control table-cell" name="search" placeholder="Search">
                                        </div>
                                        <div class="single-search-inner single-seach-btn">
                                            <button class="table-cell text-right" type="submit"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>

                                    <div class="advance-fields">
                                        <div class="row">
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <select class="selectpicker" data-live-search="false" title="All Cities">
                                                        <option>City 1</option>
                                                        <option>City 2</option>
                                                        <option>City 3</option>
                                                        <option>City 4</option>
                                                        <option>City 5</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <select class="selectpicker" data-live-search="false" title="All Areas">
                                                        <option>Area 1</option>
                                                        <option>Area 2</option>
                                                        <option>Area 3</option>
                                                        <option>Area 4</option>
                                                        <option>Area 5</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <select class="selectpicker" data-live-search="false" title="All Status">
                                                        <option>Status 1</option>
                                                        <option>Status 2</option>
                                                        <option>Status 3</option>
                                                        <option>Status 4</option>
                                                        <option>Status 5</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <select class="selectpicker" data-live-search="false" title="All Types">
                                                        <option>Type 1</option>
                                                        <option>Type 2</option>
                                                        <option>Type 3</option>
                                                        <option>Type 4</option>
                                                        <option>Type 5</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-6">
                                                <div class="form-group">
                                                    <div class="input-group">
                                            <span class="input-group-btn">
                                                  <button type="button" class="btn btn-number" disabled="disabled" data-type="minus" data-field="count_beds">
                                                      <i class="fa fa-minus"></i>
                                                  </button>
                                            </span>
                                                        <input type="text" name="count_beds" class="form-control input-number" value="1" data-min="1" data-max="10" placeholder="Beds">
                                                        <span class="input-group-btn">
                                                  <button type="button" class="btn btn-number" data-type="plus" data-field="count_beds">
                                                      <i class="fa fa-plus"></i>
                                                  </button>
                                            </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-6">
                                                <div class="form-group">
                                                    <div class="input-group">
                                            <span class="input-group-btn">
                                                  <button type="button" class="btn btn-number" disabled="disabled" data-type="minus" data-field="count_baths">
                                                      <i class="fa fa-minus"></i>
                                                  </button>
                                            </span>
                                                        <input type="text" name="count_baths" class="form-control input-number" value="1" data-min="1" data-max="10" placeholder="Baths">
                                                        <span class="input-group-btn">
                                                  <button type="button" class="btn btn-number" data-type="plus" data-field="count_baths">
                                                      <i class="fa fa-plus"></i>
                                                  </button>
                                            </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" value="" name="min-area" placeholder="Min Area (sqft)">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" value="" name="max-area" placeholder="Max Area (sqft)">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-xs-12">
                                                <div class="range-advanced-main">
                                                    <div class="range-text">
                                                        <input type="text" class="min-price-range-hidden range-input" readonly >
                                                        <input type="text" class="max-price-range-hidden range-input" readonly >
                                                        <p><span class="range-title">Price Range:</span> from <span class="min-price-range"></span> to <span class="max-price-range"></span></p>
                                                    </div>
                                                    <div class="range-wrap">
                                                        <div class="price-range-advanced"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-xs-12">
                                                <label class="advance-trigger"><i class="fa fa-plus-square"></i> Other Features </label>
                                            </div>
                                            <div class="col-sm-12 col-xs-12 features-list ">
                                                <div class="field-expand">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" value="option1"> Feature
                                                    </label>
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" value="option2"> Feature
                                                    </label>
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" value="option3"> Feature
                                                    </label>
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" value="option1"> Feature
                                                    </label>
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" value="option2"> Feature
                                                    </label>
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" value="option3"> Feature
                                                    </label>
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" value="option1"> Feature
                                                    </label>
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" value="option2"> Feature
                                                    </label>
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" value="option3"> Feature
                                                    </label>
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" value="option1"> Feature
                                                    </label>
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" value="option2"> Feature
                                                    </label>
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" value="option3"> Feature
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-xs-12">
                                                <button type="submit" class="btn btn-secondary btn-block"><i class="fa fa-search pull-left"></i> Search</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
                <!--end advanced search section-->



































                <!--start section page body-->
                <section id="section-body">

                    <!--start detail content-->
                    <section class="section-detail-content">
                        <div class="container">
                            <div class="row">

                                <div class="detail-bar">

                                    <!--start detail content tabber-->
                                    <div class="detail-content-tabber">
                                        <!--start detail tabs-->
                                        <ul class="detail-tabs">
                                            <li class="active">What is Neighborty</li>
                                            <li>Mission Statement</li>
                                            <li>Who it's for</li>
                                            <li>Features</li>
                                        </ul>
                                        <!--end detail tabs-->

                                        <!--start tab-content-->
                                        <div class="tab-content">
                                            <div class="tab-pane fade in active">
                                                <div class="property-description detail-block">
                                                    <div class="detail-title">
                                                        <h2 class="title-left">What is Neighborty</h2>
                                                        <div class="title-right">
                                                            <!--<a href="#">Flag this listing <i class="fa fa-flag"></i></a>-->
                                                        </div>
                                                    </div>
                                                    <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, condimentum feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. </p>
                                                    <p>Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. </p>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque ut lacinia ex. Curabitur iaculis elit lorem, vitae fringilla turpis ultricies vel. Mauris pretium fermentum est, eget tincidunt massa dignissim sed. Donec vulputate a augue at tincidunt. Fusce scelerisque quam arcu, vitae dictum leo volutpat tempor. Curabitur commodo vulputate ex id posuere. Phasellus at condimentum purus. Praesent et dictum ante. Proin sed ipsum non nisl pretium tempus quis et augue. Morbi ullamcorper, dolor eu accumsan aliquet, nibh nisl molestie odio, at lobortis sapien nisl interdum arcu.</p>
                                                    <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, condimentum feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. </p>
                                                    <p>Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. </p>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque ut lacinia ex. Curabitur iaculis elit lorem, vitae fringilla turpis ultricies vel. Mauris pretium fermentum est, eget tincidunt massa dignissim sed. Donec vulputate a augue at tincidunt. Fusce scelerisque quam arcu, vitae dictum leo volutpat tempor. Curabitur commodo vulputate ex id posuere. Phasellus at condimentum purus. Praesent et dictum ante. Proin sed ipsum non nisl pretium tempus quis et augue. Morbi ullamcorper, dolor eu accumsan aliquet, nibh nisl molestie odio, at lobortis sapien nisl interdum arcu.</p>

                                                    <hr>
                                                    <!--start agents carousel module-->
                                                    <div id="agents-carousel-module">
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="module-title-nav clearfix">
                                                                        <div>
                                                                            <h2>Meet our Staff</h2>
                                                                            <h4 class="sub-title">Carousel</h4>
                                                                        </div>
                                                                        <!--<div class="module-nav">
                                                                            <button class="btn btn-sm btn-crl-agents-prev">Prev</button>
                                                                            <button class="btn btn-sm btn-crl-agents-next">Next</button>
                                                                        </div>-->
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <div id="agents-carousel" class="agents-carousel">
                                                                        <div class="item">
                                                                            <div class="agents-block">
                                                                                <figure class="auther-thumb">
                                                                                    <img src="<?=base_url();?>/assets/img/agents-agencies/03-150x150.jpg" alt="thumb" width="150" height="150" class="img-circle">
                                                                                </figure>
                                                                                <div class="web-logo text-center">
                                                                                    <img src="<?=base_url();?>/assets/img/houzez-logo-grey.png" alt="logo">
                                                                                </div>
                                                                                <div class="block-body">
                                                                                    <p class="auther-info">
                                                                                        <span class="text-primary">Samuel Palmer</span>
                                                                                        <span>Founder &amp; CEO, Realty Properties Inc.</span>
                                                                                    </p>

                                                                                    <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. luctus ligula ac faucibus faucibus. Cras in nisi in turpis eleifend vehicula at at massa. Vivamus aliquet porttitor odio.</p>
                                                                                    <a href="#" class="view">View Profile</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="item">
                                                                            <div class="agents-block">
                                                                                <figure class="auther-thumb">
                                                                                    <img src="<?=base_url();?>/assets/img/agents-agencies/04-150x150.jpg" alt="thumb" width="150" height="150" class="img-circle">
                                                                                </figure>
                                                                                <div class="web-logo text-center">
                                                                                    <img src="<?=base_url();?>/assets/img/houzez-logo-grey.png" alt="logo">
                                                                                </div>
                                                                                <div class="block-body">
                                                                                    <p class="auther-info">
                                                                                        <span class="text-primary">Vincent Fuller</span>
                                                                                        <span>Company Agent, Cool Houses Inc.</span>
                                                                                    </p>

                                                                                    <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. luctus ligula ac faucibus faucibus. Cras in nisi in turpis eleifend vehicula at at massa. Vivamus aliquet porttitor odio.</p>
                                                                                    <a href="#" class="view">View Profile</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="item">
                                                                            <div class="agents-block">
                                                                                <figure class="auther-thumb">
                                                                                    <img src="<?=base_url();?>/assets/img/agents-agencies/01-150x150.jpg" alt="thumb" width="150" height="150" class="img-circle">
                                                                                </figure>
                                                                                <div class="web-logo text-center">
                                                                                    <img src="<?=base_url();?>/assets/img/houzez-logo-grey.png" alt="logo">
                                                                                </div>
                                                                                <div class="block-body">
                                                                                    <p class="auther-info">
                                                                                        <span class="text-primary">Michelle Ramirez</span>
                                                                                        <span>Company Agent, Realtory Inc.</span>
                                                                                    </p>

                                                                                    <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. luctus ligula ac faucibus faucibus. Cras in nisi in turpis eleifend vehicula at at massa. Vivamus aliquet porttito.</p>
                                                                                    <a href="" class="view">View Profile</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="item">
                                                                            <div class="agents-block">
                                                                                <figure class="auther-thumb">
                                                                                    <img src="<?=base_url();?>/assets/img/agents-agencies/02-150x150.jpg" alt="thumb" width="150" height="150" class="img-circle">
                                                                                </figure>
                                                                                <div class="web-logo text-center">
                                                                                    <img src="<?=base_url();?>/assets/img/houzez-logo-grey.png" alt="logo">
                                                                                </div>
                                                                                <div class="block-body">
                                                                                    <p class="auther-info">
                                                                                        <span class="blue">Brittany Watkins</span>
                                                                                        <span>Company Agent, Smart Houses Inc.</span>
                                                                                    </p>

                                                                                    <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. luctus ligula ac faucibus faucibus. Cras in nisi in turpis eleifend vehicula at at massa. Vivamus aliquet porttitor odio.</p>
                                                                                    <a href="#" class="view">View Profile</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end agents carousel module-->


                                                </div>
                                            </div>
                                            <div class="tab-pane fade">
                                                <div class="detail-address detail-block">
                                                    <div class="detail-title">
                                                        <h2 class="title-left">Mission Statement</h2>
                                                        <div class="title-right">
                                                            <!--<a href="#">Open on Google Maps <i class="fa fa-map-marker"></i></a>-->
                                                        </div>
                                                    </div>
                                                    <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, condimentum feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. </p>
                                                    <p>Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. </p>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque ut lacinia ex. Curabitur iaculis elit lorem, vitae fringilla turpis ultricies vel. Mauris pretium fermentum est, eget tincidunt massa dignissim sed. Donec vulputate a augue at tincidunt. Fusce scelerisque quam arcu, vitae dictum leo volutpat tempor. Curabitur commodo vulputate ex id posuere. Phasellus at condimentum purus. Praesent et dictum ante. Proin sed ipsum non nisl pretium tempus quis et augue. Morbi ullamcorper, dolor eu accumsan aliquet, nibh nisl molestie odio, at lobortis sapien nisl interdum arcu.</p>
                                                    <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, condimentum feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. </p>
                                                    <p>Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. </p>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque ut lacinia ex. Curabitur iaculis elit lorem, vitae fringilla turpis ultricies vel. Mauris pretium fermentum est, eget tincidunt massa dignissim sed. Donec vulputate a augue at tincidunt. Fusce scelerisque quam arcu, vitae dictum leo volutpat tempor. Curabitur commodo vulputate ex id posuere. Phasellus at condimentum purus. Praesent et dictum ante. Proin sed ipsum non nisl pretium tempus quis et augue. Morbi ullamcorper, dolor eu accumsan aliquet, nibh nisl molestie odio, at lobortis sapien nisl interdum arcu.</p>


                                                    <hr>
                                                    <h3>Meet our team</h3>

                                                    <div class="about-team-main">
                                                        <div class="row">
                                                            <div class="col-sm-3 col-xs-6">
                                                                <div class="about-team-block">
                                                                    <figure>
                                                                        <img class="aligncenter" src="<?=base_url();?>/assets/img/04-300x300.jpg" alt="agent-3" width="300" height="300">
                                                                        <figcaption>
                                                                            <strong>Martin Moore</strong><br>
                                                                            Executive Director
                                                                        </figcaption>
                                                                    </figure>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3 col-xs-6">
                                                                <div class="about-team-block">
                                                                    <figure>
                                                                        <img class="aligncenter" src="<?=base_url();?>/assets/img/05-300x300.jpg" alt="agent-3" width="300" height="300">
                                                                        <figcaption>
                                                                            <strong>Emily Austin</strong><br>
                                                                            Marketing Director
                                                                        </figcaption>
                                                                    </figure>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3 col-xs-6">
                                                                <div class="about-team-block">
                                                                    <figure>
                                                                        <img class="aligncenter" src="<?=base_url();?>/assets/img/02-300x300.jpg" alt="agent-3" width="300" height="300">
                                                                        <figcaption>
                                                                            <strong>Donna Reed</strong><br>
                                                                            Customer Care
                                                                        </figcaption>
                                                                    </figure>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3 col-xs-6">
                                                                <div class="about-team-block">
                                                                    <figure>
                                                                        <img class="aligncenter" src="<?=base_url();?>/assets/img/03-350x350.jpg" alt="agent-3" width="300" height="300">
                                                                        <figcaption>
                                                                            <strong>Russell Price</strong><br>
                                                                            Creative Director
                                                                        </figcaption>
                                                                    </figure>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>













                                                </div>

                                            </div>
                                            <div class="tab-pane fade">
                                                <div class="detail-features detail-block">
                                                    <div class="detail-title">
                                                        <h2 class="title-left">Who it's For?</h2>
                                                    </div>
                                                    <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, condimentum feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. </p>
                                                    <p>Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. </p>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque ut lacinia ex. Curabitur iaculis elit lorem, vitae fringilla turpis ultricies vel. Mauris pretium fermentum est, eget tincidunt massa dignissim sed. Donec vulputate a augue at tincidunt. Fusce scelerisque quam arcu, vitae dictum leo volutpat tempor. Curabitur commodo vulputate ex id posuere. Phasellus at condimentum purus. Praesent et dictum ante. Proin sed ipsum non nisl pretium tempus quis et augue. Morbi ullamcorper, dolor eu accumsan aliquet, nibh nisl molestie odio, at lobortis sapien nisl interdum arcu.</p>
                                                    <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, condimentum feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. </p>
                                                    <p>Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. </p>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque ut lacinia ex. Curabitur iaculis elit lorem, vitae fringilla turpis ultricies vel. Mauris pretium fermentum est, eget tincidunt massa dignissim sed. Donec vulputate a augue at tincidunt. Fusce scelerisque quam arcu, vitae dictum leo volutpat tempor. Curabitur commodo vulputate ex id posuere. Phasellus at condimentum purus. Praesent et dictum ante. Proin sed ipsum non nisl pretium tempus quis et augue. Morbi ullamcorper, dolor eu accumsan aliquet, nibh nisl molestie odio, at lobortis sapien nisl interdum arcu.</p>

                                                    <div class="video-block">
                                                        <a href="https://www.youtube.com/watch?v=QK66RK7ogKU" data-fancy="property_video" title="YouTube demo">
                                                            <span class="play-icon"><img src="<?=base_url();?>/assets/img/video-play-icon.png" alt="YouTube demo" width="70" height="50"></span>
                                                            <img src="<?=base_url();?>/assets/img/villa-1-810x430.jpg" alt="thumb" class="video-thumb">
                                                        </a>
                                                    </div>

                                                </div>

                                            </div>
                                            <div class="tab-pane fade">
                                                <div class="detail-list detail-block">
                                                    <div class="detail-title">
                                                        <h2 class="title-left">Features</h2>
                                                        <div class="title-right">
                                                            <!--<p>Information last updated on 11/29/2015 12:00 AM</p>-->
                                                        </div>
                                                    </div>
                                                    <div class="alert alert-info">
                                                        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, condimentum feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. </p>
                                                        <p>Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. </p>

                                                        <h4>Searching for an Apartment</h4>

                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque ut lacinia ex. Curabitur iaculis elit lorem, vitae fringilla turpis ultricies vel. Mauris pretium fermentum est, eget tincidunt massa dignissim sed. Donec vulputate a augue at tincidunt. Fusce scelerisque quam arcu, vitae dictum leo volutpat tempor. Curabitur commodo vulputate ex id posuere. Phasellus at condimentum purus. Praesent et dictum ante. Proin sed ipsum non nisl pretium tempus quis et augue. Morbi ullamcorper, dolor eu accumsan aliquet, nibh nisl molestie odio, at lobortis sapien nisl interdum arcu.</p>
                                                        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, condimentum feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. </p>

                                                        <h4>Applying directly for the Apartment</h4>

                                                        <p>Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. </p>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque ut lacinia ex. Curabitur iaculis elit lorem, vitae fringilla turpis ultricies vel. Mauris pretium fermentum est, eget tincidunt massa dignissim sed. Donec vulputate a augue at tincidunt. Fusce scelerisque quam arcu, vitae dictum leo volutpat tempor. Curabitur commodo vulputate ex id posuere. Phasellus at condimentum purus. Praesent et dictum ante. Proin sed ipsum non nisl pretium tempus quis et augue. Morbi ullamcorper, dolor eu accumsan aliquet, nibh nisl molestie odio, at lobortis sapien nisl interdum arcu.</p>

                                                        <h4>Making an Appointment to View the Apartment</h4>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque ut lacinia ex. Curabitur iaculis elit lorem, vitae fringilla turpis ultricies vel. Mauris pretium fermentum est, eget tincidunt massa dignissim sed. Donec vulputate a augue at tincidunt. Fusce scelerisque quam arcu, vitae dictum leo volutpat tempor. Curabitur commodo vulputate ex id posuere. Phasellus at condimentum purus. Praesent et dictum ante. Proin sed ipsum non nisl pretium tempus quis et augue. Morbi ullamcorper, dolor eu accumsan aliquet, nibh nisl molestie odio, at lobortis sapien nisl interdum arcu.</p>
                                                        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, condimentum feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. </p>

                                                    </div>
                                                    <div class="detail-title-inner">
                                                        <h4 class="title-inner">Additional Features</h4>
                                                    </div>
                                                    <ul class="list-three-col">
                                                        <li><strong>Deposit:</strong> 20%</li>
                                                        <li><strong>Pool Size:</strong> 300 Sqft</li>
                                                        <li><strong>Last remodel year:</strong> 1987</li>
                                                        <li><strong>Amenities:</strong> Clubhouse</li>
                                                        <li><strong>Additional Rooms::</strong> Guest Bath</li>
                                                        <li><strong>Equipment:</strong> Grill - Gas</li>
                                                    </ul>
                                                </div>
                                            </div>

                                        </div>
                                        <!--end tab-content-->
                                    </div>
                                    <!--end detail content tabber-->

                                </div>


                            </div>
                        </div>
                    </section>
                    <!--end detail content-->

                </section>
                <!--end section page body-->



                <!--<div class="article-detail">
                    <h3>What is Neighborty</h3>
                    <p><strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</strong></p>
                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <hr>
                    <h3>Mission Statement</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <hr>
                    <h3>Meet our team</h3>

                    <div class="about-team-main">
                        <div class="row">
                            <div class="col-sm-3 col-xs-6">
                                <div class="about-team-block">
                                    <figure>
                                        <img class="aligncenter" src="<?/*=base_url();*/?>/assets/img/04-300x300.jpg" alt="agent-3" width="300" height="300">
                                        <figcaption>
                                            <strong>Martin Moore</strong><br>
                                            Executive Director
                                        </figcaption>
                                    </figure>
                                </div>
                            </div>
                            <div class="col-sm-3 col-xs-6">
                                <div class="about-team-block">
                                    <figure>
                                        <img class="aligncenter" src="<?/*=base_url();*/?>/assets/img/05-300x300.jpg" alt="agent-3" width="300" height="300">
                                        <figcaption>
                                            <strong>Emily Austin</strong><br>
                                            Marketing Director
                                        </figcaption>
                                    </figure>
                                </div>
                            </div>
                            <div class="col-sm-3 col-xs-6">
                                <div class="about-team-block">
                                    <figure>
                                        <img class="aligncenter" src="<?/*=base_url();*/?>/assets/img/02-300x300.jpg" alt="agent-3" width="300" height="300">
                                        <figcaption>
                                            <strong>Donna Reed</strong><br>
                                            Customer Care
                                        </figcaption>
                                    </figure>
                                </div>
                            </div>
                            <div class="col-sm-3 col-xs-6">
                                <div class="about-team-block">
                                    <figure>
                                        <img class="aligncenter" src="<?/*=base_url();*/?>/assets/img/03-350x350.jpg" alt="agent-3" width="300" height="300">
                                        <figcaption>
                                            <strong>Russell Price</strong><br>
                                            Creative Director
                                        </figcaption>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>-->
            </div>
            <!--</div>--> <!-- Right Column -->

        </div> <!-- row -->
    </div> <!-- container -->
</section> <!-- section -->