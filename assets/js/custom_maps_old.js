function initMap() {
    var myLatLng = {
        lat: -25.363,
        lng: 131.044
    };
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 4,
        center: myLatLng
    });
    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        title: 'Hello World!'
    });
}




function applyHovers(){


    $('#agent_properties .item-wrap').hover(


        // mouse in
        function () {

            var listid = $(this).attr("data_id");
            console.log(listid);

            $(this).css({background: ""});
            var listid = $(this).attr("data_id");


            // var div = overlayMarkers[listid].div;
            // div.style.background = '#ff6e00';
            // div.style.width = '51px';
            // div.style.height = '24px';
            // div.style.border='2px solid #fff';
            // div.style.fontSize='14px';
        },
        // mouse out
        function () {

            var listid = $(this).attr("data_id");
            console.log(listid);

            //  console.log('out');
            // first we need to know which <div class="marker"></div> we hovered
            /* $(this).css({background: ""});
             var listid = $(this).attr("data_id");
             var div=overlayMarkers[listid].div;
             //   console.log(div);
             div.style.background = '';
             div.style.width = '';
             div.style.height = '';
             div.style.border='';
             div.style.fontSize='';*/
        }


    );


    //console.log(overlayMarkers);
}


// Add a Home control that returns the user to London
function HomeControl(controlDiv, map) {
    controlDiv.style.padding = '5px';
    var controlUI = document.createElement('div');
    controlUI.className = "toggle_mapsearch";
    controlDiv.appendChild(controlUI);
    // var controlLabel = document.createElement('label');
    // controlLabel.innerHTML = 'Search as I move the Map here';
    // var input = document.createElement("input");
    //input.type = "checkbox";
    //input.className = "mapsearch_checkbox";
    //input.id = "search_with_map"; // set the CSS class
    //  controlLabel.appendChild(input); // put it into the DOM
    // controlUI.appendChild(controlLabel);
}


var overlayMarkers = [];
var markersArray = [];
var map;
var listing_map;
var load_map=0;




function clearOverlays() {
    for (var i = 0; i < markersArray.length; i++ ) {
        markersArray[i].setMap(null);
    }
    markersArray.length = 0;
}

function loadSearchMap() {

    console.log('loadSearchMap');
    map = new google.maps.Map(document.getElementById('search_map'), {
        //zoom: 4,
        scrollwheel: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        draggable: false
    });
    var homeControlDiv = document.createElement('div');
    map.controls[google.maps.ControlPosition.TOP_RIGHT].push(homeControlDiv);
    loadMarkers(map, locations);
    var infowindow = null;
    google.maps.event.addListener(infowindow, 'domready', function() {
        $('.gm-style-iw').hide();
    });


    //mapMoveSearch();
}

function loadSaleMap() {

    map = new google.maps.Map(document.getElementById('sale_map'), {
        zoom: 16,
        scrollwheel: false,
        disableDefaultUI: true,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var homeControlDiv = document.createElement('div');
    var homeControl = new HomeControl(homeControlDiv, map);
    map.controls[google.maps.ControlPosition.TOP_RIGHT].push(homeControlDiv);
    loadMarkers(map, sales);
}

function loadRentMap() {
    map = new google.maps.Map(document.getElementById('rent_map'), {
        zoom: 16,
        scrollwheel: false,
         disableDefaultUI: true,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    var homeControlDiv = document.createElement('div');
    map.controls[google.maps.ControlPosition.TOP_RIGHT].push(homeControlDiv);
    loadMarkers(map, rent);
    //mapMoveSearch();
}

function loadSoldMap() {
    map = new google.maps.Map(document.getElementById('sold_map'), {
        zoom: 16,
        scrollwheel: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    var homeControlDiv = document.createElement('div');
    var homeControl = new HomeControl(homeControlDiv, map);
    map.controls[google.maps.ControlPosition.TOP_RIGHT].push(homeControlDiv);
    loadMarkers(map, sold);
    $('#sold_map').parent().parent().parent().siblings().addClass("class_name");
    //mapMoveSearch();
}



function loadListingMap() {

    console.log('load listing map');

    var bounds= new google.maps.LatLngBounds();

    map = new google.maps.Map(document.getElementById('search_listing_map'), {
        zoom: 11,
        scrollwheel: false,
        // draggable: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
    });
    var infoWindow = new google.maps.InfoWindow(), marker, i;

    for( i = 0; i < locations.length; i++ ) {

        var arr = explode(",", locations[i]);
        var position = new google.maps.LatLng(arr[1], arr[2]);
        if(arr[4] == 'rent'){ var list_icon = new google.maps.MarkerImage(site_url +"/assets/img/marker_rent.png");}
        else{ var list_icon = new google.maps.MarkerImage(site_url+ "/assets/img/marker_sale.png");}
        //map.setCenter(position);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            icon: list_icon,
            map: map,
        });
        markersArray.push(marker);

        // Add info window to marker
        var content = arr_info[arr[0]];

        google.maps.event.addListener(marker,'mouseover', (function(marker,content,infoWindow){
            return function() {
                infoWindow.setContent(content);
                infoWindow.open(map,marker);
            };
        })(marker,content,infoWindow));



        map.fitBounds(bounds);
    }
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(11);
        google.maps.event.removeListener(boundsListener);
    });

    // applyHovers();

    google.maps.event.addListenerOnce(map, 'dragend', function() {

       mapMoveSearch();

    });

}

function loadListingMapNoBounds(bounds) {

    map = new google.maps.Map(document.getElementById('search_listing_map'), {
        zoom: 11,
        scrollwheel: false,
        // draggable: false,
        //mapTypeId: google.maps.MapTypeId.ROADMAP,
    });
    var infoWindow = new google.maps.InfoWindow(), marker, i;

    for( i = 0; i < locations.length; i++ ) {

        var arr = explode(",", locations[i]);
        var position = new google.maps.LatLng(arr[1], arr[2]);
        if(arr[4] == 'rent'){ var list_icon = new google.maps.MarkerImage(site_url +"/assets/img/marker_rent.png");}
        else{ var list_icon = new google.maps.MarkerImage(site_url+ "/assets/img/marker_sale.png");}
        //map.setCenter(position);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            icon: list_icon,
            map: map,
        });
        markersArray.push(marker);
        var content = arr_info[arr[0]];
        google.maps.event.addListener(marker,'mouseover', (function(marker,content,infoWindow){
            return function() {
                infoWindow.setContent(content);
                infoWindow.open(map,marker);
            };
        })(marker,content,infoWindow));



        map.fitBounds(bounds);
    }
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(11);
        google.maps.event.removeListener(boundsListener);
    });


    google.maps.event.addListener(map, 'dragend', function() {
        mapMoveSearch();

    });
}

function mapMoveSearch() {


    var bounds =  map.getBounds();
    var sw = bounds.getSouthWest();
    var ne = bounds.getNorthEast();

    $("#sw_lat").val(sw.lat());
    $("#sw_lng").val(sw.lng());
    $("#ne_lat").val(ne.lat());
    $("#ne_lng").val(ne.lng());
    $("#search_by_map").val("true");



    $.ajax({
        url: site_url + "search/results",
        type: "GET",
        data: $("#search_form").serialize() + "&ajax=1&move=yes",
        dataType: "html",

        beforeSend: function() {
            $('#search_loader').show();
        },

        success: function(data) {
            $('#filtered_search_results').html(data);
            $('#search_loader').hide();
            loadListingMapNoBounds(bounds);
            //applyHovers();

        }, done: function(data){

            $("#sw_lat").val("");
            $("#sw_lng").val("");
            $("#ne_lat").val("");
            $("#ne_lng").val("");
            $("#search_by_map").val("");
            $('#search_loader').hide();
        }



    });

}

function setMarkers(map, locations) {
    //alert('set listing markers');
    var marker, i
    var infowindow = null;
    var bounds = new google.maps.LatLngBounds();
    var infoWindows = [];
    var NewarkHighlight;
    var mNewarkCoords = new Array;
    var triangleCoords = [
        new google.maps.LatLng(48.85332310, 2.28137680),
        new google.maps.LatLng(48.81364040, 2.27231030),
        new google.maps.LatLng(48.85668390, 2.23062600),
        new google.maps.LatLng(48.85333400, 2.36951110),
        new google.maps.LatLng(48.90587850, 2.26839970),
        new google.maps.LatLng(48.85775900, 2.38005360),
        new google.maps.LatLng(48.87413090, 2.26762860),
    ];



    for (i = 0; i < locations.length; i++) {

        var arr = explode(",", locations[i]);
        var myLatlng = new google.maps.LatLng(arr[1], arr[2]);
        //  mNewarkCoords[i] = new google.maps.LatLng(arr[1], arr[2]);

        var content = arr_info[arr[0]];

        overlay = new CustomMarker(
            myLatlng,
            map, {
                marker_id: arr[0],
                price: arr[3],
                type:arr[4],
                status:arr[5]
            }

        );
        map.setCenter(overlay.getPosition());
        bounds.extend(overlay.getPosition());
        google.maps.event.addListener(overlay, "click", (function(overlay, content, infowindow) {
            return function() {

                if (infowindow) {
                    infowindow.close();
                }
                if (infoWindows) {
                    for (var i = 0; i < infoWindows.length; i++) {
                        infoWindows[i].close();
                    }
                }
                infowindow = new google.maps.InfoWindow({
                    content: content,
                    pixelOffset: new google.maps.Size(0, 5)
                });
                infoWindows.push(infowindow);
                google.maps.event.addListener(infowindow, 'domready', function() {
                    var iwOuter = $('.gm-style-iw');
                    var iwBackground = iwOuter.prev();
                    iwBackground.children(':nth-child(2)').css({'display' : 'none'});
                    iwBackground.children(':nth-child(4)').css({'display' : 'none'});
                    iwOuter.parent().parent().css({left: '30px', top:'10px'});
                    iwBackground.children(':nth-child(1)').hide();
                    iwBackground.children(':nth-child(3)').hide();
                    iwBackground.children(':nth-child(3)').find('div').children().css({'box-shadow': 'rgba(72, 181, 233, 0.6) 0px 1px 6px', 'z-index' : '1'});
                    var iwCloseBtn = iwOuter.next();
                    iwCloseBtn.css({opacity: '1', right: '52px', top: '0px'});
                    if($('.iw-content').height() < 140){
                        $('.iw-bottom-gradient').css({display: 'none'});
                    }
                    iwCloseBtn.mouseout(function(){
                        $(this).css({opacity: '1'});
                    });
                });

                infowindow.open(map, overlay);
            };
        })(overlay, content, infowindow));
        overlayMarkers[arr[0]]=overlay;
    }


    /*  bermudaTriangle = new google.maps.Polygon({
          paths: mNewarkCoords,
          strokeColor: '#FF0000',
          strokeOpacity: 0.8,
          strokeWeight: 2,
          fillColor: '#FF0000',
          fillOpacity: 0.35
      });

      bermudaTriangle.setMap(map);*/


    /*
        var fenway = new google.maps.LatLng(48.8491237,2.3435389);
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
        myCity.setMap(map);*/


    map.fitBounds(bounds);
    var listener = google.maps.event.addListener(map, "idle", function () {
        map.setZoom(10);
        google.maps.event.removeListener(listener);
    });

}

function loadAgentMap() {
    var map;
    var lat_longs_map = new Array();
    var markers_map = new Array();
    var placesService;
    var placesAutocomplete;
    var iw_map = new google.maps.InfoWindow();
    var myLatlng = new google.maps.LatLng(37.4419, -122.1419);
    var myOptions = {
        zoom: 13,
        scrollwheel: false,
        center: myLatlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    var autocompleteOptions = {}
    var autocompleteInput = document.getElementById('agent_location');
    autocomplete = new google.maps.places.Autocomplete(autocompleteInput, autocompleteOptions);
    autocomplete.bindTo('bounds', map);
    autocomplete.addListener('place_changed', fillInAgentAddress);
}

function fillInAgentAddress() {

    var place = autocomplete.getPlace();
    for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];
        //  console.log(addressType);
        if (addressType == "street_number") {
            var val = place.address_components[i]['short_name'];
            console.log(val);
            document.getElementById('agent_street').value = val;
        }
        if (addressType == "locality") {
            var val = place.address_components[i]['long_name'];
            console.log(val);
            document.getElementById('agent_city').value = val;
        }
        if (addressType == "administrative_area_level_1") {
            var val = place.address_components[i]['long_name'];
            console.log(val);
            document.getElementById('agent_state').value = val;
        }
        if (addressType == "administrative_area_level_1") {
            var val = place.address_components[i]['short_name'];
            console.log(val);
            document.getElementById('agent_state_code').value = val;
        }
        if (addressType == "country") {
            var val = place.address_components[i]['long_name'];
            console.log(val);
            document.getElementById('agent_country').value = val;
        }
        if (addressType == "postal_code") {
            var val = place.address_components[i]['short_name'];
            console.log(val);
            document.getElementById('agent_zipcode').value = val;
        }

    }
}

function loadPlacesMap() {

    var map; // Global declaration of the map
    var lat_longs_map = new Array();
    var markers_map = new Array();
    var placesService;
    var placesAutocomplete;
    var iw_map = new google.maps.InfoWindow();
    var myLatlng = new google.maps.LatLng(37.4419, -122.1419);
    var myOptions = {
        zoom: 13,
        scrollwheel: false,
        center: myLatlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    var autocompleteOptions = {}
    var autocompleteInput = document.getElementById('location');
 //   var mobileInput = document.getElementById('mobile_location');
    var agent_input = document.getElementById('agent_location');
    autocomplete = new google.maps.places.Autocomplete(autocompleteInput, autocompleteOptions);
    autocomplete_agent = new google.maps.places.Autocomplete(agent_input, autocompleteOptions);
  //  autocomplete = new google.maps.places.Autocomplete(mobileInput, autocompleteOptions);
    autocomplete.bindTo('bounds', map);
    autocomplete_agent.bindTo('bounds', map);
    autocomplete.addListener('place_changed', fillInAddress);
   // autocomplete.addListener('place_changed', address_for_mobile_screen);
}

function fillInAddress() {

    $('.search_submit').prop('disabled', false);
    var place = autocomplete.getPlace();
    $("#sw_lat").val("");
    $("#sw_lng").val("");
    $("#ne_lat").val("");
    $("#ne_lng").val("");
    $("#search_by_map").val("");
    for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];
        console.log(addressType);
        if (addressType == "street_number") {
            var val = place.address_components[i]['short_name'];
            document.getElementById('street').value = val;
        }
        if (addressType == "locality") {
            var val = place.address_components[i]['long_name'];
            document.getElementById('city').value = val;
        }
        if (addressType == "administrative_area_level_1") {
            var val = place.address_components[i]['long_name'];
            document.getElementById('state').value = val;
        }
        if (addressType == "country") {
            var val = place.address_components[i]['long_name'];
            document.getElementById('country').value = val;
        }
        if (addressType == "postal_code") {
            var val = place.address_components[i]['short_name'];
            document.getElementById('zipcode').value = val;
        }

    }
}

function address_for_mobile_screen() {

    $('.search_submit').prop('disabled', false);
    var place = autocomplete.getPlace();
    $("#sw_lat").val("");
    $("#sw_lng").val("");
    $("#ne_lat").val("");
    $("#ne_lng").val("");
    $("#search_by_map").val("");
    for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];
        console.log(addressType);
        if (addressType == "street_number") {
            var val = place.address_components[i]['short_name'];
            document.getElementById('mobile_street').value = val;
        }
        if (addressType == "locality") {
            var val = place.address_components[i]['long_name'];
            document.getElementById('mobile_city').value = val;
        }
        if (addressType == "administrative_area_level_1") {
            var val = place.address_components[i]['long_name'];
            document.getElementById('mobile_state').value = val;
        }
        if (addressType == "country") {
            var val = place.address_components[i]['long_name'];
            document.getElementById('mobile_country').value = val;
        }
        if (addressType == "postal_code") {
            var val = place.address_components[i]['short_name'];
            document.getElementById('mobile_zipcode').value = val;
        }

    }
}



function loadMarkers(map, locations) {

    var marker, i
    var infowindow = null;
    var bounds = new google.maps.LatLngBounds();
    var infoWindows = [];
    for (i = 0; i < locations.length; i++) {
        var arr = explode(",", locations[i]);
        //console.log(arr[1]+","+arr[2]+","+arr[0]+","+arr[3])
        var myLatlng = new google.maps.LatLng(arr[1], arr[2]);

        var content = arr_info[arr[0]];

        //===========================================================================================
        overlay = new CustomMarker(
            myLatlng,
            map, {
                marker_id: arr[0],
                price: arr[3],
                type:arr[4],
                status:arr[5]
            }
        );
        map.setCenter(overlay.getPosition());
        //extend the bounds to include each marker's position
        bounds.extend(overlay.getPosition());

        google.maps.event.addListener(overlay, "click", (function(overlay, content, infowindow) {
            return function() {


                if (infowindow) {
                    infowindow.close();
                }
                if (infoWindows) {
                    for (var i = 0; i < infoWindows.length; i++) {
                        infoWindows[i].close();
                    }
                }
                infowindow = new google.maps.InfoWindow({
                    content: content,
                    pixelOffset: new google.maps.Size(20, 5)
                });
                //add infowindow to array
                infoWindows.push(infowindow);
                infowindow.open(map, overlay);
            };
        })(overlay, content, infowindow));
        overlayMarkers[arr[0]]=overlay;

    }
    map.fitBounds(bounds);
}