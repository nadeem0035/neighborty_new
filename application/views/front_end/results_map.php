<?php defined( 'BASEPATH') OR exit( 'No direct script access allowed'); ?>
<body>
    <?php $this->load->view('templates/'.$topmenu); ?>


    <section id="section-body" class="houzez-body-half">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5 col-sm-5 col-xs-12 no-padding">
                    <div class="map-half fave-screen-fix">
                        <div id="houzez-gmap-main" class="fave-screen-fix">
                            <div class="mapPlaceholder">
                                <div class="loader-ripple">
                                    <div></div>
                                    <div></div>
                                </div>
                            </div>
                            <div id="map"></div>
                            <div  class="map-arrows-actions">
                                <button id="listing-mapzoomin" class="map-btn"><i class="fa fa-plus"></i> </button>
                                <button id="listing-mapzoomout" class="map-btn"><i class="fa fa-minus"></i></button>
                                <input type="text" id="google-map-search" placeholder="Google Map Search" class="map-search">
                            </div>
                            <div class="map-next-prev-actions">
                                <ul class="dropdown-menu" aria-labelledby="houzez-gmap-view">
                                    <li><a href="#" onclick="fave_change_map_type('roadmap')"><span>Roadmap</span></a></li>
                                    <li><a href="#" onclick="fave_change_map_type('satellite')"><span>Satelite</span></a></li>
                                    <li><a href="#" onclick="fave_change_map_type('hybrid')"><span>Hybrid</span></a></li>
                                    <li><a href="#" onclick="fave_change_map_type('terrain')"><span>Terrain</span></a></li>
                                </ul>
                                <button id="houzez-gmap-view" class="map-btn dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-globe"></i> <span>View</span></button>

                                <button id="houzez-gmap-prev" class="map-btn"><i class="fa fa-chevron-left"></i> <span>Prev</span></button>
                                <button id="houzez-gmap-next" class="map-btn"><span>Next</span> <i class="fa fa-chevron-right"></i></button>
                            </div>
                            <div class="map-zoom-actions">
                                <span id="houzez-gmap-location" class="map-btn"><i class="fa fa-map-marker"></i> <span>My location</span></span>
                                <span id="houzez-gmap-full" class="map-btn"><i class="fa fa-arrows-alt"></i> <span>Fullscreen</span></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-sm-7 col-xs-12 no-padding">
                    <div class="module-half fave-screen-fix">

                        <div class="advanced-search houzez-adv-price-range">
                            <form method="post" action="#">
                                <input type="hidden" id="street" name="street" value="<?=$this->input->get('street')?>" />
                                <input type="hidden" id="city" name="city" value="<?=$this->input->get('city')?>" />
                                <input type="hidden" id="state" name="state" value="<?=$this->input->get('state')?>" />
                                <input type="hidden" id="state_code" name="state_code" value="<?=$this->input->get('state_code')?>" />
                                <input type="hidden" id="country" name="country" value="<?=$this->input->get('country')?>" />
                                <input type="hidden" id="zipcode" name="zipcode" value="<?=$this->input->get('zipcode')?>" />
                                <div class="row">
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <div class="form-group table-list search-long">
                                            <div class="input-search input-icon">
                                                <input type="text" class="form-control" name="location" id="location" value="<?=$this->input->get('location')?>" placeholder="Enter an address, town, street, or zip">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <select class="selectpicker bs-select-hidden" name="type" title="Type" data-live-search="false">
                                                <option value="">Any Type</option>
                                                <option value="sale"> For Sale</option>
                                                <option value="rent"> For Rent</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <select class="selectpicker tbc-bedrooms-field" title="BEDS" name="beds" id="beds" data-live-search="true">
                                                <option value="">BEDS</option>
                                                <?php for($i = 1; $i <= 16; $i++) { ?>
                                                    <option value="<?php echo $i; ?>" <?php if($this->input->get('beds') == $i){ echo "selected"; }?>><?php echo $i; ?> Bed<?php if($i > 1) echo 's'; ?></option>
                                                <?php } ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <select name="bathrooms" id="bathrooms" class="selectpicker" data-live-search="true" >
                                                <option value="">BATHROOMS</option>
                                                <?php for($i = 1; $i <= 16; $i++) { ?>
                                                    <option value="<?php echo $i; ?>" <?php if($this->input->get('bathrooms') == $i){ echo "selected"; }?>><?php echo $i; ?> Bathrooms<?php if($i > 1) echo 's'; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <select class="selectpicker" data-live-search="true" title="Square Feet">
                                                <option>Any</option>
                                                <option>< 1000</option>
                                                <option>1000+</option>
                                                <option>1500+</option>
                                                <option>2000+</option>
                                                <option>3000+</option>
                                                <option>4000+</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-sm-2 col-xs-3" style="margin-top:23px;">
                                        <div class="form-group">
                                            <div class="radius-text-wrap">
                                                <label class="checkbox-inline">
                                                    <input value="option1" type="checkbox"> Radius: <strong><span id="area-range-text">0</span> km</strong>
                                                </label>
                                                <input type="hidden" id="area-range-value" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-5 col-xs-9" style="margin-top:22px;">
                                        <div class="radius-range-wrap">
                                            <div id="area-range-slider"></div>
                                        </div>
                                    </div>


                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                        <div class="range-advanced-main">
                                            <div class="range-text">
                                                <input type="text" class="min-price-range-hidden range-input" readonly >
                                                <input type="text" class="max-price-range-hidden range-input" readonly >
                                                <p style="color:#000;"><span class="range-title" style="color: #959595;">Price Range:</span> from <span class="min-price-range"></span> to <span class="max-price-range"></span></p>
                                            </div>
                                            <div class="range-wrap">
                                                <div class="price-range-advanced"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-xs-12">
                                        <label class="advance-trigger text-uppercase title"><i class="fa fa-plus-square"></i> Home Type </label>
                                        <div class="clearfix"></div>
                                        <div class="features-list field-expand">
                                            <?php foreach ($home_types as $home_type) { ?>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="<?= $home_type->name; ?>" id="home_type_<?=$home_type->id; ?>"  name="home_types[]" /> <?= $home_type->name; ?>
                                                </label>
                                            <?php }?>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-xs-12">
                                        <label class="advance-amenities text-uppercase title"><i class="fa fa-plus-square"></i> AMENITIES YOU NEEDED</label>
                                        <div class="clearfix"></div>
                                        <div class="features-list field-expands">
                                            <?php foreach ($amenities as $amenity) { ?>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="<?=$amenity->id;?>" id="amenity_<?=$amenity->id; ?>"  name="amenities[]" /> <?= $amenity->name; ?>
                                                </label>
                                            <?php }?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 col-xs-12">
                                        <button type="submit" class="btn btn-primary btn-block">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>


                        <div class="houzez-module">
                            <!--start list tabs-->
                            <div class="list-tabs table-list full-width">
                                <div class="tabs table-cell">
                                    <h2 class="tabs-title">Map Results</h2>
                                </div>
                                <div class="sort-tab table-cell text-right">
                                    <span class="view-btn btn-list active"><i class="fa fa-th-list"></i></span>
                                    <span class="view-btn btn-grid"><i class="fa fa-th-large"></i></span>
                                </div>
                            </div>
                            <!--end list tabs-->
                            <div class="property-listing list-view">
                                <div class="row">
                                    <?php
                                    // print_r($reviews);
                                    foreach($listings as $list) { ?>
                                        <div class="item-wrap">
                                            <div class="property-item table-list">
                                                <div class="table-cell">
                                                    <div class="figure-block">
                                                        <figure class="item-thumb">
                                                            <?php if ($list->is_featured){?>
                                                                <span class="label-featured label label-success">Featured</span>
                                                            <?php } ?>
                                                            <div class="label-wrap label-right hide-on-list">
                                                                <span class="label label-default">For <?=$list->property_type?></span>
                                                                <span class="label label-danger">Sold</span>
                                                            </div>
                                                            <div class="price hide-on-list">
                                                                <p class="price-start">Start from</p>
                                                                <h3>$350,000</h3>
                                                                <p class="rant">$<?=$list->price?></p>
                                                            </div>
                                                            <!--<a href="#" class="hover-effect">-->

                                                            <?php
                                                            // echo    $abs_path.'/assets/media/listings/search_thumbs/'.$list->image;
                                                            if(is_file($abs_path.'/assets/media/listings/search_thumbs/'.$list->image)){
                                                                if (file_exists($abs_path.'/assets/media/listings/search_thumbs/'.$list->image)) {
                                                                    $list_img=$search_img.$list->image;
                                                                }else{
                                                                    $list_img=base_url()."assets/img/placeholder.png";
                                                                }
                                                            }else{
                                                                $list_img=base_url()."assets/img/placeholder.png";
                                                            }
                                                            ?>

                                                            <a href="<?=site_url("property/".$list->slug)?>"><img src="<?=$list_img?>" alt=""></a>

                                                            <ul class="actions">
                                                                <li>
                                                                <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Favorite">
                                                                    <i class="fa fa-heart"></i>
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
                                                                <li>
                                                                <span data-toggle="tooltip" data-placement="top" title="Photos (12)">
                                                                    <i class="fa fa-camera"></i>
                                                                </span>
                                                                </li>
                                                            </ul>
                                                        </figure>
                                                    </div>
                                                </div>
                                                <div class="item-body table-cell">

                                                    <div class="body-left table-cell">
                                                        <div class="info-row">
                                                            <div class="label-wrap hide-on-grid">
                                                                <div class="label-status label label-default">For <?=$list->property_type?></div>
                                                                <span class="label label-danger">Sold</span>
                                                            </div>
                                                            <h2 class="property-title"><a href="<?=site_url("property/".$list->slug)?>" class="listing-name-custom"><?=ucwords($list->listing_name)?></a></h2>

                                                            <div class="rating">
                                                                <span class="bottom-ratings"><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span><span style="width: 70%" class="top-ratings"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span></span></span>
                                                                <?= $reviews[$list->listid]['total'] ?>
                                                            </div>

                                                            <h4 class="property-location"><?php echo $list->address_line_1.' '.$list->address_line_2.', '.$list->city_town.', '.$list->state_province.' '.$list->zip_postal_code?></h4>
                                                        </div>
                                                        <div class="info-row amenities hide-on-grid">
                                                            <p>
                                                                <span>Home Type: <?php echo $list->home_type;?></span><br>
                                                                <span>Bedrooms : <?php echo $list->bedrooms;?></span>
                                                                <span>Beds: <?php echo $list->beds;?></span>
                                                            </p>
                                                            <p>Accommodates: <?php echo $list->accommodates;?></p>
                                                            <p><?= $reviews[$list->listid]['total'] ?></ins> - Reviews</p>
                                                        </div>
                                                        <div class="info-row date hide-on-grid">
                                                            <p><i class="fa fa-user"></i> <a href="#">Elite Ocean View Realty LLC</a></p>
                                                            <p><i class="fa fa-calendar"></i> 12 Days ago </p>
                                                        </div>
                                                    </div>
                                                    <div class="body-right table-cell hidden-gird-cell">
                                                        <div class="info-row price">
                                                            <!--<p class="price-start">Start from</p>-->
                                                            <h3><?php echo "$".$list->price?></h3>
                                                            <p class="rant">Per Night</p>
                                                        </div>
                                                        <div class="info-row phone text-right">
                                                            <a href="<?=site_url("property/".$list->slug)?>" class="btn btn-primary">Details <i class="fa fa-angle-right fa-right"></i></a>
                                                            <!--<p><a href="#">+1 (786) 225-0199</a></p>-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript" src="http://beta.neighborty.com/assets/js/jquery.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAYxatVl0mCNR-6v6bUZNn4-VTCD9PqHVE"></script>
    <script type="text/javascript" src="http://beta.neighborty.com/assets/js/modernizr.custom.js"></script>
    <script type="text/javascript" src="http://beta.neighborty.com/assets/js/moment.js"></script>
    <script type="text/javascript" src="http://beta.neighborty.com/assets/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="http://beta.neighborty.com/assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="http://beta.neighborty.com/assets/js/owl.carousel.min.js"></script>
    <script type="text/javascript" src="http://beta.neighborty.com/assets/js/jquery.matchHeight-min.js"></script>
    <script type="text/javascript" src="http://beta.neighborty.com/assets/js/bootstrap-select.js"></script>
    <script type="text/javascript" src="http://beta.neighborty.com/assets/js/jquery-ui.js"></script>
    <script type="text/javascript" src="http://beta.neighborty.com/assets/js/masonry.pkgd.min.html"></script>
    <script type="text/javascript" src="http://beta.neighborty.com/assets/js/jquery.nicescroll.js"></script>
    <script type="text/javascript" src="http://beta.neighborty.com/assets/js/infobox.js"></script>
    <script type="text/javascript" src="http://beta.neighborty.com/assets/js/markerclusterer.js"></script>
    <script type="text/javascript" src="http://beta.neighborty.com/assets/js/custom.js"></script>
    <script type="text/javascript" src="http://beta.neighborty.com/assets/js/general.js"></script>
    <script type="text/javascript">

        (function($){
            var theMap;
            function initMap() {

                /* Properties Array */
                var properties = [{
                    id: 294,
                    title: "Penthouse apartment",
                    lat: "40.6879438",
                    lng: "-73.94192980000003", bedrooms: "3",
                    address:"Quincy St, Brooklyn, NY, USA",
                    bathrooms:"2",
                    bedrooms:"3",
                    icon:"http://sandbox.favethemes.com/houzez/wp-content/uploads/2016/02/x1-apartment.png",
                    id:294,
                    images_count:7,
                    lat:"40.6879438",
                    lng:"-73.94192980000003",
                    price:"<span class='item-price'>$876,000</span><span class='item-sub-price'>$7,600&#47;sq ft</span>",
                    prop_meta:"<p><span>Beds: 3</span><span>Baths: 2</span><span>Sq Ft: 2560</span></p>",
                    retinaIcon:"http://sandbox.favethemes.com/houzez/wp-content/uploads/2016/02/x2-apartment.png",
                    thumbnail:"<img src='http://placehold.it/385x258' alt='thumb'>",
                    title:"Penthouse apartment",
                    type:"Apartment",
                    url:"/"
                },
                    {
                        id: 285, title: "Confortable apartment",
                        lat: "40.72305619999999",
                        lng: "-74.03885300000002",
                        address:"Metro Plaza Dr, Jersey City, NJ 07302, USA",
                        bathrooms:"2",
                        bedrooms:"1",
                        icon:"http://sandbox.favethemes.com/houzez/wp-content/uploads/2016/02/x1-apartment.png",
                        id:285,
                        images_count:7,
                        lat:"40.72305619999999",
                        lng:"-74.03885300000002",
                        price:"<span class='item-price'>$3,700&#47;mo</span>",
                        prop_meta:"<p><span>Bed: 1</span><span>Baths: 2</span><span>Sq Ft: 1900</span></p>",
                        retinaIcon:"http://sandbox.favethemes.com/houzez/wp-content/uploads/2016/02/x2-apartment.png",
                        thumbnail:"<img src='http://placehold.it/385x258' alt='thumb'>",
                        title:"Confortable apartment",
                        type:"Apartment",
                        url:"/"
                    }];

                var myLatLng = new google.maps.LatLng(properties[0].lat,properties[0].lng);

                var houzezMapOptions = {
                    zoom: 12,
                    maxZoom: 12,
                    center: myLatLng,
                    disableDefaultUI: true,
                    scrollwheel: false,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    scroll:{x:$(window).scrollLeft(),y:$(window).scrollTop()}
                };
                var theMap = new google.maps.Map(document.getElementById("map"), houzezMapOptions);

                var markers = new Array();
                var current_marker = 0;
                var visible;

                var offset=$(theMap.getDiv()).offset();
                theMap.panBy(((houzezMapOptions.scroll.x-offset.left)/3),((houzezMapOptions.scroll.y-offset.top)/3));
                google.maps.event.addDomListener(window, 'scroll', function(){
                    var scrollY=$(window).scrollTop(),
                        scrollX=$(window).scrollLeft(),
                        scroll=theMap.get('scroll');
                    if(scroll){
                        theMap.panBy(-((scroll.x-scrollX)/3),-((scroll.y-scrollY)/3));
                    }
                    theMap.set('scroll',{x:scrollX,y:scrollY});
                });

                var mapBounds = new google.maps.LatLngBounds();

                for( i = 0; i < properties.length; i++ ) {
                    //alert('ok');
                    var marker_url = properties[i].icon;
                    var marker_size = new google.maps.Size( 44, 56 );
                    if( window.devicePixelRatio > 1.5 ) {
                        if ( properties[i].retinaIcon ) {
                            marker_url = properties[i].retinaIcon;
                            marker_size = new google.maps.Size( 84, 106 );
                        }
                    }

                    var marker_icon = {
                        url: marker_url,
                        size: marker_size,
                        scaledSize: new google.maps.Size( 44, 56 ),
                        origin: new google.maps.Point( 0, 0 ),
                        anchor: new google.maps.Point( 7, 27 )
                    };

                    // Markers
                    markers[i] = new google.maps.Marker({
                        map: theMap,
                        draggable: false,
                        position: new google.maps.LatLng(properties[0].lat,properties[0].lng),
                        icon: marker_icon,
                        title: properties[i].title,
                        animation: google.maps.Animation.DROP,
                        visible: true
                    });

                    mapBounds.extend(markers[i].getPosition());

                    var infoBoxText = document.createElement("div");
                    infoBoxText.className = 'property-item item-grid map-info-box';
                    infoBoxText.innerHTML =
                        '<div class="figure-block">'+
                        '<figure class="item-thumb">'+
                        properties[i].is_featured +
                        '<div class="price hide-on-list">'+
                        properties[i].price +
                        '</div>'+
                        '<a href="'+properties[i].url+'" tabindex="0">'+
                        properties[i].thumbnail +
                        '</a>'+
                        '<figcaption class="thumb-caption cap-actions clearfix">'+
                        '<div class="pull-right">'+
                        '<span title="" data-placement="top" data-toggle="tooltip" data-original-title="Photos">'+
                        '<i class="fa fa-camera"></i> <span class="count">('+ properties[i].images_count +')</span>'+
                        '</span>'+
                        '</div>'+
                        '</figcaption>'+
                        '</figure>'+
                        '</div>' +
                        '<div class="item-body">' +
                        '<div class="body-left">' +
                        '<div class="info-row">' +
                        '<h2 class="property-title"><a href="'+properties[i].url+'">'+properties[i].title+'</a></h2>' +
                        '<h4 class="property-location">'+properties[i].full_address+'</h4>' +
                        '</div>' +
                        '<div class="table-list full-width info-row">' +
                        '<div class="cell">' +
                        '<div class="info-row amenities">' +
                        properties[i].prop_meta +
                        '<p>'+properties[i].type+'</p>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>';


                    var infoBoxOptions = {
                        content: infoBoxText,
                        disableAutoPan: true,
                        maxWidth: 0,
                        alignBottom: true,
                        pixelOffset: new google.maps.Size( -122, -48 ),
                        zIndex: null,
                        closeBoxMargin: "0 0 -16px -16px",
                        closeBoxURL: "images/map/close.png",
                        infoBoxClearance: new google.maps.Size( 1, 1 ),
                        isHidden: false,
                        pane: "floatPane",
                        enableEventPropagation: false
                    };

                    var infobox = new InfoBox( infoBoxOptions );

                    attachInfoBoxToMarker( theMap, markers[i], infobox );

                }

                if(  document.getElementById('listing-mapzoomin') ){
                    google.maps.event.addDomListener(document.getElementById('listing-mapzoomin'), 'click', function () {
                        var current= parseInt( theMap.getZoom(),10);
                        current++;
                        if(current > 20){
                            current = 20;
                        }
                        theMap.setZoom(current);
                    });
                }


                if(  document.getElementById('listing-mapzoomout') ){
                    google.maps.event.addDomListener(document.getElementById('listing-mapzoomout'), 'click', function () {
                        var current= parseInt( theMap.getZoom(),10);
                        current--;
                        if(current < 0){
                            current = 0;
                        }
                        theMap.setZoom(current);
                    });
                }

                // Marker Clusters
                //if( googlemap_pin_cluster != 'no' ) {
                var markerClustererOptions = {
                    ignoreHidden: true,
                    maxZoom: parseInt(10),
                    styles: [{
                        textColor: '#ffffff',
                        url: 'images/map/cluster-icon.png',
                        height: 48,
                        width: 48
                    }]
                };

                var markerClusterer = new MarkerClusterer(theMap, markers, markerClustererOptions);
                //}

                theMap.fitBounds(mapBounds);

                function attachInfoBoxToMarker( map, marker, infoBox ){
                    marker.addListener('click', function() {
                        var scale = Math.pow( 2, map.getZoom() );
                        var offsety = ( (100/scale) || 0 );
                        var projection = map.getProjection();
                        var markerPosition = marker.getPosition();
                        var markerScreenPosition = projection.fromLatLngToPoint( markerPosition );
                        var pointHalfScreenAbove = new google.maps.Point( markerScreenPosition.x, markerScreenPosition.y - offsety );
                        var aboveMarkerLatLng = projection.fromPointToLatLng( pointHalfScreenAbove );
                        map.setCenter( aboveMarkerLatLng );
                        infoBox.close();
                        infoBox.open( map, marker );
                    });
                }

                jQuery('#houzez-gmap-next').click(function(){
                    current_marker++;
                    if ( current_marker > markers.length ){
                        current_marker = 1;
                    }
                    while( markers[current_marker-1].visible===false ){
                        current_marker++;
                        if ( current_marker > markers.length ){
                            current_marker = 1;
                        }
                    }
                    if( theMap.getZoom() < 15 ){
                        theMap.setZoom(15);
                    }
                    google.maps.event.trigger( markers[current_marker-1], 'click' );
                });

                jQuery('#houzez-gmap-prev').click(function(){
                    current_marker--;
                    if (current_marker < 1){
                        current_marker = markers.length;
                    }
                    while( markers[current_marker-1].visible===false ){
                        current_marker--;
                        if ( current_marker > markers.length ){
                            current_marker = 1;
                        }
                    }
                    if( theMap.getZoom() <15 ){
                        theMap.setZoom(15);
                    }
                    google.maps.event.trigger( markers[current_marker-1], 'click');
                });
                jQuery('#houzez-gmap-full').click(function() {
                    //google.maps.event.trigger(theMap, 'resize');
                    if($(this).hasClass('active')== true){
                        //alert('has');
                        google.maps.event.trigger(theMap, 'resize');
                        theMap.setOptions({
                            draggable: true,
                        });
                    }else{
                        //alert('not has');
                        google.maps.event.trigger(theMap, 'resize');
                        theMap.setOptions({
                            draggable: false,
                        });
                    }

                });


                fave_change_map_type = function(map_type){

                    if(map_type==='roadmap'){
                        theMap.setMapTypeId(google.maps.MapTypeId.ROADMAP);
                    }else if(map_type==='satellite'){
                        theMap.setMapTypeId(google.maps.MapTypeId.SATELLITE);
                    }else if(map_type==='hybrid'){
                        theMap.setMapTypeId(google.maps.MapTypeId.HYBRID);
                    }else if(map_type==='terrain'){
                        theMap.setMapTypeId(google.maps.MapTypeId.TERRAIN);
                    }
                    return false;
                };

                // Create the search box and link it to the UI element.
                //var input = document.getElementById('google-map-search');
                //var searchBox = new google.maps.places.SearchBox(input);
                //theMap.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

                // Bias the SearchBox results towards current map's viewport.
                /*theMap.addListener('bounds_changed', function() {
                 searchBox.setBounds(theMap.getBounds());
                 });*/

                //var markers_location = [];
                // Listen for the event fired when the user selects a prediction and retrieve
                // more details for that place.
                /* searchBox.addListener('places_changed', function() {
                 var places = searchBox.getPlaces();

                 if (places.length == 0) {
                 return;
                 }

                 // Clear out the old markers.
                 markers_location.forEach(function(marker) {
                 marker.setMap(null);
                 });
                 markers_location = [];

                 // For each place, get the icon, name and location.
                 var bounds = new google.maps.LatLngBounds();
                 places.forEach(function(place) {
                 var icon = {
                 url: place.icon,
                 size: new google.maps.Size(71, 71),
                 origin: new google.maps.Point(0, 0),
                 anchor: new google.maps.Point(17, 34),
                 scaledSize: new google.maps.Size(25, 25)
                 };

                 // Create a marker for each place.
                 markers_location.push(new google.maps.Marker({
                 map: theMap,
                 icon: icon,
                 title: place.name,
                 position: place.geometry.location
                 }));

                 if (place.geometry.viewport) {
                 // Only geocodes have viewport.
                 bounds.union(place.geometry.viewport);
                 } else {
                 bounds.extend(place.geometry.location);
                 }
                 });
                 theMap.fitBounds(bounds);
                 });*/

                google.maps.event.addListenerOnce(theMap, 'tilesloaded', function() {
                    $('.mapPlaceholder').hide();
                });

            }

            google.maps.event.addDomListener( window, 'load', initMap );
        })(jQuery)

    </script>