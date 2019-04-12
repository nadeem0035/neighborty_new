<?php defined( 'BASEPATH') OR exit( 'No direct script access allowed'); ?>
<link href="<?=base_url()?>assets/css/slick.css" rel="stylesheet" type="text/css" />
<body>
    <?php $this->load->view('templates/'.$topmenu); ?>
    <?php $this->load->view('templates/quick_searchform'); ?>
    <section id="section-body">
        <!--start detail top-->
        <div class="detail-top detail-top-grid no-margin">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <div class="header-detail table-list">
                            <div class="header-left">
                                <ol class="breadcrumb">
                                    <li><a href="#"><i class="fa fa-home"></i></a></li>
                                    <li><a href="#">Library</a></li>
                                    <li class="active">Data</li>
                                </ol>
                                <h1>
                                    Oceanfront Villa With Pool
                                    <span class="label-wrap hidden-sm hidden-xs">
                                        <span class="label label-primary">For Sale</span>
                                        <span class="label label-danger">Sold</span>
                                    </span>
                                </h1>
                                <address class="property-address">7601 East Treasure Drive, Miami Beach, FL 33141</address>
                            </div>
                            <div class="header-right">
                                <ul class="actions">
                                    <li class="share-btn">
                                        <div class="share_tooltip tooltip_left fade">
                                            <a href="#" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;"><i class="fa fa-facebook"></i></a>
                                            <a href="#" onclick="if(!document.getElementById('td_social_networks_buttons')){window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;}"><i class="fa fa-twitter"></i></a>

                                            <a href="#" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;"><i class="fa fa-pinterest"></i></a>

                                            <a href="#" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;"><i class="fa fa-linkedin"></i></a>

                                            <a href="#" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;"><i class="fa fa-google-plus"></i></a>
                                            <a href="#"><i class="fa fa-envelope"></i></a>
                                        </div>
                                        <span data-placement="right" data-toggle="tooltip" data-original-title="share"><i class="fa fa-share-alt"></i></span>
                                    </li>
                                    <li>
                                        <span><i class="fa fa-heart-o"></i></span>
                                    </li>
                                </ul>
                                <span class="item-price">$575,000</span>
                                <span class="item-sub-price">$21,000/mo</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end detail top-->
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 container-contentbar">
                    <div class="detail-media detail-top-slideshow">
                        <div class="tab-content">

                            <div id="gallery" class="tab-pane fade in active">
                                                    <span class="label-wrap visible-sm visible-xs">
                                                        <span class="label label-primary">For Sale</span>
                                                    <span class="label label-danger">Sold</span>
                                                </span>
                                <div class="slideshow">
                                    <div class="slideshow-main">
                                        <div class="slide">
                                            <div>
                                                <img src="<?=base_url()?>assets/img/popup-slider/inner-bath-room-1-1170x738.jpg" width="810" height="430" alt="Slide show">
                                            </div>
                                            <div>
                                                <img src="<?=base_url()?>assets/img/popup-slider/inner-bath-room-1-1170x738.jpg" width="810" height="430" alt="Slide show">
                                            </div>
                                            <div>
                                                <img src="<?=base_url()?>assets/img/popup-slider/inner-bath-room-1-1170x738.jpg" width="810" height="430" alt="Slide show">
                                            </div>
                                            <div>
                                                <img src="<?=base_url()?>assets/img/popup-slider/inner-bath-room-1-1170x738.jpg" width="810" height="430" alt="Slide show">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slideshow-nav-main">
                                        <div class="slideshow-nav">
                                            <div>
                                                <img src="<?=base_url()?>assets/img/popup-slider/inner-bath-room-1-1170x738.jpg" width="100" height="70" alt="Slide show thumb">
                                            </div>
                                            <div>
                                                <img src="<?=base_url()?>assets/img/popup-slider/inner-bath-room-1-1170x738.jpg" width="100" height="70" alt="Slide show thumb">
                                            </div>
                                            <div>
                                                <img src="<?=base_url()?>assets/img/popup-slider/inner-bath-room-1-1170x738.jpg" width="100" height="70" alt="Slide show thumb">
                                            </div>
                                            <div>
                                                <img src="<?=base_url()?>assets/img/popup-slider/inner-bath-room-1-1170x738.jpg" width="100" height="70" alt="Slide show thumb">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="map" class="tab-pane fade"></div>
                            <div id="street-map" class="tab-pane fade"></div>

                        </div>
                        <div class="media-tabs">
                            <ul class="media-tabs-list">
                                <li class="popup-trigger" data-placement="bottom" data-toggle="tooltip" data-original-title="View Photos">
                                    <a href="#gallery" data-toggle="tab">
                                        <i class="fa fa-camera"></i>
                                    </a>
                                </li>
                                <li data-placement="bottom" data-toggle="tooltip" data-original-title="Map View">
                                    <a href="#map" data-toggle="tab">
                                        <i class="fa fa-map"></i>
                                    </a>
                                </li>
                                <li data-placement="bottom" data-toggle="tooltip" data-original-title="Street View">
                                    <a href="#street-map" data-toggle="tab">
                                        <i class="fa fa-street-view"></i>
                                    </a>
                                </li>
                            </ul>
                            <ul class="actions">
                                <li class="share-btn">
                                    <div class="share_tooltip tooltip_left fade">
                                        <a href="#" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;"><i class="fa fa-facebook"></i></a>
                                        <a href="#" onclick="if(!document.getElementById('td_social_networks_buttons')){window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;}"><i class="fa fa-twitter"></i></a>

                                        <a href="#" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;"><i class="fa fa-pinterest"></i></a>

                                        <a href="#" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;"><i class="fa fa-linkedin"></i></a>

                                        <a href="#" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;"><i class="fa fa-google-plus"></i></a>
                                        <a href="#"><i class="fa fa-envelope"></i></a>
                                    </div>
                                    <span data-placement="right" data-toggle="tooltip" data-original-title="share"><i class="fa fa-share-alt"></i></span>
                                </li>
                                <li>
                                    <span><i class="fa fa-heart-o"></i></span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="detail-bar" style="margin-top:35px;">

                        <!--start detail content tabber-->
                        <div class="detail-content-tabber">
                            <!--start detail tabs-->
                            <ul class="detail-tabs">
                                <li class="active">Description</li>
                                <li>Address</li>
                                <li>Features</li>
                                <li>Detail</li>
                                <li>Floor Plan</li>
                                <li>VIDEO</li>
                            </ul>
                            <!--end detail tabs-->

                            <!--start tab-content-->
                            <div class="tab-content">
                                <div class="tab-pane fade in active">
                                    <div class="property-description detail-block">
                                        <div class="detail-title">
                                            <h2 class="title-left">Description</h2>
                                            <div class="title-right">
                                                <a href="#">Flag this listing <i class="fa fa-flag"></i></a>
                                            </div>
                                        </div>
                                        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, condimentum feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. </p>
                                        <p>Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. </p>
                                    </div>
                                </div>
                                <div class="tab-pane fade">
                                    <div class="detail-address detail-block">
                                        <div class="detail-title">
                                            <h2 class="title-left">Address</h2>
                                            <div class="title-right">
                                                <a href="#">Open on Google Maps <i class="fa fa-map-marker"></i></a>
                                            </div>
                                        </div>
                                        <ul class="list-three-col">
                                            <li><strong>Address:</strong> 7601 East Treasure Drive</li>
                                            <li><strong>City:</strong> Miami Beach</li>
                                            <li><strong>State/Country:</strong> Florida</li>
                                            <li><strong>Zip:</strong> 33139</li>
                                            <li><strong>Country:</strong> United States</li>
                                            <li><strong>Neighbourhood:</strong> Miami</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-pane fade">
                                    <div class="detail-features detail-block">
                                        <div class="detail-title">
                                            <h2 class="title-left">Features</h2>
                                        </div>
                                        <ul class="list-three-col list-features">
                                            <li><a href="#"><i class="fa fa-check"></i>Air Conditioning</a></li>
                                            <li><a href="#"><i class="fa fa-check"></i>Barbeque</a></li>
                                            <li><a href="#"><i class="fa fa-check"></i>Dryer</a></li>
                                            <li><a href="#"><i class="fa fa-check"></i>Gym</a></li>
                                            <li><a href="#"><i class="fa fa-check"></i>Laundry</a></li>
                                            <li><a href="#"><i class="fa fa-check"></i>Lawn</a></li>
                                            <li><a href="#"><i class="fa fa-check"></i>Microwave</a></li>
                                            <li><a href="#"><i class="fa fa-check"></i>Outdoor Shower</a></li>
                                            <li><a href="#"><i class="fa fa-check"></i>Refrigerator</a></li>
                                            <li><a href="#"><i class="fa fa-check"></i>Sauna</a></li>
                                            <li><a href="#"><i class="fa fa-check"></i>Swimming Pool</a></li>
                                            <li><a href="#"><i class="fa fa-check"></i>TV Cable</a></li>
                                            <li><a href="#"><i class="fa fa-check"></i>Washer</a></li>
                                            <li><a href="#"><i class="fa fa-check"></i>WiFi</a></li>
                                            <li><a href="#"><i class="fa fa-check"></i>Window Coverings</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-pane fade">
                                    <div class="detail-list detail-block">
                                        <div class="detail-title">
                                            <h2 class="title-left">Detail</h2>
                                            <div class="title-right">
                                                <p>Information last updated on 11/29/2015 12:00 AM</p>
                                            </div>
                                        </div>
                                        <div class="alert alert-info">
                                            <ul class="list-three-col">
                                                <li><strong>Property ID:</strong> HZ33</li>
                                                <li><strong>Price:</strong> $670,000</li>
                                                <li><strong>Property Size:</strong> 1200 Sq Ft</li>
                                                <li><strong>Bedrooms:</strong> 4</li>
                                                <li><strong>Bathrooms:</strong> 2</li>
                                                <li><strong>Garage:</strong> 1</li>
                                                <li><strong>Garage Size:</strong> 200 SqFt</li>
                                                <li><strong>Year Built:</strong> 2016-01-09</li>
                                            </ul>
                                        </div>
                                        <div class="detail-title-inner">
                                            <h4 class="title-inner">Additional details</h4>
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

                                <div class="tab-pane fade">
                                    <div class="property-plans detail-block">
                                        <div class="detail-title">
                                            <h2 class="title-left">Floor plans</h2>
                                        </div>
                                        <div class="accord-block">
                                            <div class="accord-tab">
                                                <h3>Floor Plan A</h3>
                                                <ul>
                                                    <li>Size: <strong>1,234 sqft</strong></li>
                                                    <li>Beds: <strong>4</strong></li>
                                                    <li>Baths: <strong>3</strong></li>
                                                    <li>Price: <strong>$1,200/mo</strong></li>
                                                </ul>
                                                <div class="expand-icon active"></div>
                                            </div>
                                            <div class="accord-content" style="display: block">
                                                <img src="images/floor-image.png" alt="img" width="400" height="436">
                                            </div>
                                            <div class="accord-tab">
                                                <h3>Floor Plan B</h3>
                                                <ul>
                                                    <li>Size: <strong>1,234 sqft</strong></li>
                                                    <li>Beds: <strong>4</strong></li>
                                                    <li>Baths: <strong>3</strong></li>
                                                    <li>Price: <strong>$1,200/mo</strong></li>
                                                </ul>
                                                <div class="expand-icon"></div>
                                            </div>
                                            <div class="accord-content">
                                                <img src="images/floor-image.png" alt="img" width="400" height="436">
                                            </div>
                                            <div class="accord-tab">
                                                <h3>Floor Plan C</h3>
                                                <ul>
                                                    <li>Size: <strong>1,234 sqft</strong></li>
                                                    <li>Beds: <strong>4</strong></li>
                                                    <li>Baths: <strong>3</strong></li>
                                                    <li>Price: <strong>$1,200/mo</strong></li>
                                                </ul>
                                                <div class="expand-icon"></div>
                                            </div>
                                            <div class="accord-content">
                                                <img src="images/floor-image.png" alt="img" width="400" height="436">
                                            </div>
                                        </div>
                                        <div class="detail-title-inner">
                                            <h4 class="title-inner">Property Documents</h4>
                                        </div>
                                        <ul class="document-list">
                                            <li>
                                                <div class="pull-left">
                                                    <i class="fa fa-file-o"></i> Property plan PDF
                                                </div>
                                                <div class="pull-right">
                                                    <a href="#">DOWNLOAD</a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="pull-left">
                                                    <i class="fa fa-file-o"></i> Brochure PDF
                                                </div>
                                                <div class="pull-right">
                                                    <a href="#">DOWNLOAD</a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-pane fade">
                                    <div class="property-video detail-block">
                                        <div class="detail-title">
                                            <h2 class="title-left">Video</h2>
                                        </div>
                                        <div class="video-block">
                                            <a href="https://www.youtube.com/watch?v=QK66RK7ogKU" data-fancy="property_video" title="YouTube demo">
                                                <span class="play-icon"><img src="images/icons/video-play-icon.png" alt="YouTube demo" width="70" height="50"></span>
                                                <img src="images/property-detail/video/villa-1-810x430.jpg" alt="thumb" class="video-thumb">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end tab-content-->
                        </div>


                        <div class="next-prev-block clearfix">
                            <div class="prev-box pull-left">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="#">
                                            <img src="<?=base_url()?>assets/img/listings/07_385x258.jpg" class="media-object" alt="image" width="100" height="75">
                                        </a>
                                    </div>
                                    <div class="media-body media-middle">
                                        <h3 class="media-heading"><a href="#"><i class="fa fa-angle-left"></i> PREVIOUS PROPERTY</a></h3>
                                        <h4>Villa For Sale</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="next-box pull-right">
                                <div class="media">
                                    <div class="media-body media-middle text-right">
                                        <h3 class="media-heading"><a href="#">PREVIOUS PROPERTY <i class="fa fa-angle-right"></i></a></h3>
                                        <h4>Villa For Sale</h4>
                                    </div>
                                    <div class="media-right">
                                        <a href="#">
                                            <img src="<?=base_url()?>assets/img/listings/07_385x258.jpg" class="media-object" alt="image" width="100" height="75">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 col-md-offset-0 col-sm-offset-3 container-sidebar">
                    <aside id="sidebar" class="sidebar-white">
                        <div class="widget widget-contact">
                            <div class="widget-body">
                                <div class="form-small">
                                    <div class="media agent-media">
                                        <div class="media-left">
                                            <a href="#">
                                                <img src="<?=base_url()?>assets/img/agents/01-350x350.jpg" class="media-object" alt="image" width="74" height="74">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading">CONTACT AGENT</h4>
                                            <ul>
                                                <li><i class="fa fa-user"></i> Kenneth Phllips</li>
                                                <li><i class="fa fa-phone"></i> (987) 654 3210</li>
                                            </ul>
                                            <a href="#" class="view">View my listing</a>
                                        </div>
                                    </div>
                                    <form>
                                        <div class="form-group">
                                            <input class="form-control" type="text" placeholder="Your Name">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" type="text" placeholder="Phone">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" type="email" placeholder="Email">
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control" rows="5" placeholder="Location"></textarea>
                                        </div>
                                        <button class="btn btn-secondary btn-block">Request info</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="widget widget-recommend">
                            <div class="widget-top">
                                <h3 class="widget-title">We recommend</h3>
                            </div>
                            <div class="widget-body">
                                <div class="media">
                                    <div class="media-left">
                                        <figure class="item-thumb">
                                            <a class="hover-effect" href="#">
                                                <img src="<?=base_url()?>assets/img/listings/07_385x258.jpg" width="100" height="75" alt="thumb">
                                            </a>
                                        </figure>
                                    </div>
                                    <div class="media-body">
                                        <h3 class="media-heading"><a href="#">Apartment Oceanview</a></h3>
                                        <h4>$350,000</h4>
                                        <div class="amenities">
                                            <p>3 beds • 2 baths • 1,238 sqft</p>
                                            <p>Single Family Home</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="media-left">
                                        <figure class="item-thumb">
                                            <a class="hover-effect" href="#">
                                                <img src="<?=base_url()?>assets/img/listings/07_385x258.jpg" width="100" height="75" alt="thumb">
                                            </a>
                                        </figure>
                                    </div>
                                    <div class="media-body">
                                        <h3 class="media-heading"><a href="#">Apartment Oceanview</a></h3>
                                        <h4>$350,000</h4>
                                        <div class="amenities">
                                            <p>3 beds • 2 baths • 1,238 sqft</p>
                                            <p>Single Family Home</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="media-left">
                                        <figure class="item-thumb">
                                            <a class="hover-effect" href="#">
                                                <img src="<?=base_url()?>assets/img/listings/07_385x258.jpg" width="100" height="75" alt="thumb">
                                            </a>
                                        </figure>
                                    </div>
                                    <div class="media-body">
                                        <h3 class="media-heading"><a href="#">Apartment Oceanview</a></h3>
                                        <h4>$350,000</h4>
                                        <div class="amenities">
                                            <p>3 beds • 2 baths • 1,238 sqft</p>
                                            <p>Single Family Home</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="widget widget-slider">
                            <div class="widget-top">
                                <h3 class="widget-title">Featured Properties Slider</h3>
                            </div>
                            <div class="widget-body">
                                <div class="property-widget-slider">
                                    <div class="item">
                                        <div class="figure-block">
                                            <figure class="item-thumb">
                                                <span class="label-featured label label-success">Featured</span>
                                                <div class="label-wrap label-right">
                                                    <span class="label-status label label-default">For Rent</span>

                                                    <span class="label label-danger">Hot Offer</span>
                                                </div>
                                                <a href="#" class="hover-effect">
                                                    <img src="<?=base_url()?>assets/img/listings/07_385x258.jpg" width="370" height="202" alt="thumb">
                                                </a>
                                                <div class="price">
                                                    <span class="item-price">$350,000</span>
                                                </div>
                                                <ul class="actions">
                                                    <li>
                                                    <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Favorite">
                                                        <i class="fa fa-heart-o"></i>
                                                    </span>
                                                    </li>
                                                    <li class="share-btn">
                                                        <div class="share_tooltip fade">
                                                            <a target="_blank" href="#"><i class="fa fa-facebook"></i></a>
                                                            <a target="_blank" href="#"><i class="fa fa-twitter"></i></a>
                                                            <a target="_blank" href="#"><i class="fa fa-google-plus"></i></a>
                                                            <a target="_blank" href="#"><i class="fa fa-pinterest"></i></a>
                                                        </div>
                                                        <span title="" data-placement="top" data-toggle="tooltip" data-original-title="share"><i class="fa fa-share-alt"></i></span>
                                                    </li>
                                                </ul>
                                            </figure>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="figure-block">
                                            <figure class="item-thumb">
                                                <span class="label-featured label label-success">Featured</span>
                                                <div class="label-wrap label-right">
                                                    <span class="label-status label label-default">For Rent</span>

                                                    <span class="label label-danger">Hot Offer</span>
                                                </div>
                                                <a href="#" class="hover-effect">
                                                    <img src="<?=base_url()?>assets/img/listings/07_385x258.jpg" width="370" height="202" alt="thumb">
                                                </a>
                                                <div class="price">
                                                    <span class="item-price">$350,000</span>
                                                </div>
                                                <ul class="actions">
                                                    <li>
                                                    <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Favorite">
                                                        <i class="fa fa-heart-o"></i>
                                                    </span>
                                                    </li>
                                                    <li class="share-btn">
                                                        <div class="share_tooltip fade">
                                                            <a target="_blank" href="#"><i class="fa fa-facebook"></i></a>
                                                            <a target="_blank" href="#"><i class="fa fa-twitter"></i></a>
                                                            <a target="_blank" href="#"><i class="fa fa-google-plus"></i></a>
                                                            <a target="_blank" href="#"><i class="fa fa-pinterest"></i></a>
                                                        </div>
                                                        <span title="" data-placement="top" data-toggle="tooltip" data-original-title="share"><i class="fa fa-share-alt"></i></span>
                                                    </li>
                                                </ul>
                                            </figure>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="figure-block">
                                            <figure class="item-thumb">
                                                <span class="label-featured label label-success">Featured</span>
                                                <div class="label-wrap label-right">
                                                    <span class="label-status label label-default">For Rent</span>

                                                    <span class="label label-danger">Hot Offer</span>
                                                </div>
                                                <a href="#" class="hover-effect">
                                                    <img src="<?=base_url()?>assets/img/listings/07_385x258.jpg" width="370" height="202" alt="thumb">
                                                </a>
                                                <div class="price">
                                                    <span class="item-price">$350,000</span>
                                                </div>
                                                <ul class="actions">
                                                    <li>
                                                    <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Favorite">
                                                        <i class="fa fa-heart-o"></i>
                                                    </span>
                                                    </li>
                                                    <li class="share-btn">
                                                        <div class="share_tooltip fade">
                                                            <a target="_blank" href="#"><i class="fa fa-facebook"></i></a>
                                                            <a target="_blank" href="#"><i class="fa fa-twitter"></i></a>
                                                            <a target="_blank" href="#"><i class="fa fa-google-plus"></i></a>
                                                            <a target="_blank" href="#"><i class="fa fa-pinterest"></i></a>
                                                        </div>
                                                        <span title="" data-placement="top" data-toggle="tooltip" data-original-title="share"><i class="fa fa-share-alt"></i></span>
                                                    </li>
                                                </ul>
                                            </figure>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>

    <div id="lightbox-popup-main" class="fade">
        <div class="lightbox-popup">
            <div class="popup-inner">
                <div class="lightbox-left">
                    <div class="lightbox-header">
                        <div class="header-title">
                            <p>
                                <span>
                                    <img src="images/logo-houzez-white.png" width="86" height="13" alt="logo">
                                </span>
                                <span class="hidden-xs">
                                    Oceanfront Villa With Pool - 7601 East Treasure Drive, Miami Beach, FL 33141
                                </span>
                            </p>
                        </div>
                        <div class="header-actions">
                            <ul class="actions">
                                <li class="share-btn">
                                    <div class="share_tooltip tooltip_left fade">
                                        <a href="#" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;"><i class="fa fa-facebook"></i></a>
                                        <a href="#" onclick="if(!document.getElementById('td_social_networks_buttons')){window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;}"><i class="fa fa-twitter"></i></a>

                                        <a href="#" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;"><i class="fa fa-pinterest"></i></a>

                                        <a href="#" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;"><i class="fa fa-linkedin"></i></a>

                                        <a href="#" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;"><i class="fa fa-google-plus"></i></a>
                                        <a href="#"><i class="fa fa-envelope"></i></a>
                                    </div>
                                    <span><i class="fa fa-share-alt"></i></span>
                                </li>
                                <li>
                                    <span><i class="fa fa-heart-o"></i></span>
                                </li>
                                <li class="lightbox-expand visible-xs compress">
                                    <span><i class="fa fa-envelope-o"></i></span>
                                </li>
                                <li class="lightbox-close">
                                    <span><i class="fa fa-close"></i></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="gallery-area">
                        <div class="slider-placeholder">
                            <div class="loader-inner">
                                <span class="fa fa-spin fa-spinner"></span> Loading Slider...
                            </div>
                        </div>
                        <div class="expand-icon lightbox-expand hidden-xs"></div>
                        <div class="gallery-inner">
                            <div class="lightbox-slide slide-animated">
                                <div>
                                    <img src="images/property-detail/popup-slider/inner-living-room-1-1170x738.jpg" alt="Lightbox Slider" width="1170" height="525">
                                </div>
                                <div>
                                    <img src="images/property-detail/popup-slider/inner-living-room-2-1170x738.jpg" alt="Lightbox Slider" width="1170" height="525">
                                </div>
                                <div>
                                    <img src="images/property-detail/popup-slider/inner-living-room-3-1170x738.jpg" alt="Lightbox Slider" width="1170" height="525">
                                </div>
                                <div>
                                    <img src="images/property-detail/popup-slider/inner-bed-room-1-1170x738.jpg" alt="Lightbox Slider" width="1170" height="525">
                                </div>
                                <div>
                                    <img src="images/property-detail/popup-slider/inner-bath-room-1-1170x738.jpg" alt="Lightbox Slider" width="1170" height="525">
                                </div>
                                <div>
                                    <img src="images/property-detail/popup-slider/inner-pool-1-1170x738.jpg" alt="Lightbox Slider" width="1170" height="525">
                                </div>
                                <div>
                                    <img src="images/property-detail/popup-slider/inner-studio-room-1-1170x738.jpg" alt="Lightbox Slider" width="1170" height="525">
                                </div>
                            </div>
                        </div>
                        <div class="lightbox-slide-nav visible-xs">
                            <button class="lightbox-arrow-left lightbox-arrow"><i class="fa fa-angle-left"></i></button>
                            <p class="lightbox-nav-title">Luxury apartment bay view</p>
                            <button class="lightbox-arrow-right lightbox-arrow"><i class="fa fa-angle-right"></i></button>
                        </div>
                    </div>
                </div>
                <div class="lightbox-right fade in">
                    <div class="lightbox-header hidden-xs">
                        <div class="header-title">
                            <p>$575,000 or $21,000/mo</p>
                        </div>
                        <div class="header-actions">
                            <ul class="actions">
                                <li class="lightbox-close">
                                    <span><i class="fa fa-close"></i></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="agent-area">
                        <div class="form-small">
                            <div class="agent-media-head">
                                <h4 class="head-left">Contact info</h4>
                                <a href="#" class="head-right">View my listing</a>
                            </div>
                            <div class="media agent-media">
                                <div class="media-left">
                                    <a href="#">
                                        <img width="100" height="100" alt="image" class="media-object" src="images/avatars/03_100x100.jpg">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <dl>
                                        <dt>CONTACT AGENT</dt>
                                        <dd><i class="fa fa-user"></i> Brittany Watkins</dd>
                                        <dd><i class="fa fa-phone"></i> 321 456 9874</dd>
                                    </dl>
                                    <ul class="profile-social">
                                        <li><a class="btn-facebook" href="#" target="_blank"><i class="fa fa-facebook-square"></i></a></li>
                                        <li><a class="btn-twitter" href="#" target="_blank"><i class="fa fa-twitter-square"></i></a></li>
                                        <li><a class="btn-linkedin" href="#" target="_blank"><i class="fa fa-linkedin-square"></i></a></li>
                                        <li><a class="btn-google-plus" href="#" target="_blank"><i class="fa fa-google-plus-square"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <h4 class="form-small-title"> Inquire about this property </h4>
                            <form>
                                <div class="form-group">
                                    <input type="text" placeholder="Your Name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="text" placeholder="Phone" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="email" placeholder="Email" class="form-control">
                                </div>
                                <div class="form-group">
                                    <textarea placeholder="Location" rows="2" class="form-control"></textarea>
                                </div>
                                <button class="btn btn-secondary btn-block">Request info</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript" src="<?=base_url()?>assets/js/slick.min.js"></script>
    <script type="text/javascript">
        var map = null;
        var panorama = null;
        var fenway = new google.maps.LatLng(25.762449, -80.188872);
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