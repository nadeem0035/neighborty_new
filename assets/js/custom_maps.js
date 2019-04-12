
var overlayMarkers = [];
var markersArray = [];
var map;
var listing_map;
var load_map=0;
var bounds;
var infoWindow;
var marker;
var i;
//var brussels = [];


function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: -34.397, lng: 150.644},
        zoom: 8
    });
}




function composeMarkers(locations)
{


    bounds= new google.maps.LatLngBounds();
    infoWindow = new google.maps.InfoWindow(), marker, i;


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

            // brussels[i] = new google.maps.LatLng(arr[1], arr[2]);



        }

        map.fitBounds(bounds);

}

function clearMarkers(map) {
    for (i in markersArray) {
        markersArray[i].setMap(null);
    }
}



function loadSearchMap() {

console.log('loadSearchMap');

    map = new google.maps.Map(document.getElementById('search_listing_map'), {
        zoom: 10,
        scrollwheel: false,
        fullscreenControl:false,
        streetViewControl: false,
        mapTypeControl:false,

        zoomControlOptions: {
            position: google.maps.ControlPosition.TOP_RIGHT
        },

        styles:[
            {
                "featureType": "landscape.man_made",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#f7f1df"
                    }
                ]
            },
            {
                "featureType": "landscape.natural",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#d0e3b4"
                    }
                ]
            },
            {
                "featureType": "landscape.natural.terrain",
                "elementType": "geometry",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "poi",
                "elementType": "labels",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "poi.business",
                "elementType": "all",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "poi.medical",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#fbd3da"
                    }
                ]
            },
            {
                "featureType": "poi.park",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#bde6ab"
                    }
                ]
            },
            {
                "featureType": "road",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "road",
                "elementType": "labels",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#ffe15f"
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "color": "#efd151"
                    }
                ]
            },
            {
                "featureType": "road.arterial",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#ffffff"
                    }
                ]
            },
            {
                "featureType": "road.local",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "black"
                    }
                ]
            },
            {
                "featureType": "transit.station.airport",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#cfb2db"
                    }
                ]
            },
            {
                "featureType": "water",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#a2daf2"
                    }
                ]
            }
        ]
    });


    if (typeof locations === 'undefined') {


        console.log('empty ');

        map.setCenter(new google.maps.LatLng(30.3753, 69.3451));
        map.setZoom(6);


    }
    else{

        var homeControlDiv = document.createElement('div');
        var homeControl = new HomeControl(homeControlDiv, map);
        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(homeControlDiv);

        var autocompleteOptions = {}
        var autocompleteInput = document.getElementById('location');

        autocomplete = new google.maps.places.Autocomplete(autocompleteInput, autocompleteOptions);

        autocomplete.bindTo('bounds', map);
        autocomplete.addListener('place_changed', fillInAddress);

        composeMarkers(locations);
        mapMoveSearch();

    }


}

function HomeControl(controlDiv, map) {
    controlDiv.style.padding = '10px';
    var controlUI = document.createElement('div');
    controlUI.className = "toggle_mapsearch";
    controlDiv.appendChild(controlUI);
    var controlLabel = document.createElement('label');
    controlLabel.innerHTML = 'Search as I move the Map';

    var input = document.createElement("input");
    input.type = "checkbox";
    input.className = "mapsearch_checkbox";
   // input.checked ="checked";
    input.id = "search_with_map";
    controlLabel.appendChild(input);
    controlUI.appendChild(controlLabel);

}

function mapMoveSearch() {

    google.maps.event.addDomListener(map,"idle",function() {
        if ($('#search_with_map').is(":checked")){

            var bounds =  map.getBounds();
            var sw = bounds.getSouthWest();
            var ne = bounds.getNorthEast();
            var ne = bounds.getNorthEast();
            $("#sw_lat").val(sw.lat());
            $("#sw_lng").val(sw.lng());
            $("#ne_lat").val(ne.lat());
            $("#ne_lng").val(ne.lng());
            $("#search_by_map").val("true");
            var ptype = $('#view_property').val();
            if(ptype == '')
                ptype = 'any';

            $.ajax({
                url: site_url + "search/index",
                type: "GET",
                data: $("#search_listings").serialize()+ "&ajax=" + 1 + "&type=" + ptype,
                dataType: "html",
                beforeSend: function() {
                    $('#search_loader').show();
                },

                success: function(data) {
                    console.log(locations.length);
                    $('#rendered_resulsts').html(data);
                    $('#search_loader').hide();
                    $('#total_count').html( $('#count_records').text());
                    locations = JSON.parse($("#repid").text());
                    $('#total_count').html(locations.length);

                }, done: function(data){

                    // $("#sw_lat").val("");
                    // $("#sw_lng").val("");
                    // $("#ne_lat").val("");
                    // $("#ne_lng").val("");
                    // $("#search_by_map").val("");
                    // $('#search_loader').hide();
                }



            });

        }

    });

}

function loadListingMapNoBounds(bounds) {

    map = new google.maps.Map(document.getElementById('search_listing_map'), {
        //zoom: 11,
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
        map.setCenter(position);
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

function setMarkers(map, locations) {

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

            }
        );
       // map.setCenter(overlay.getPosition());
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





    }
    //now fit the map to the newly inclusive bounds
    map.fitBounds(bounds);
}

function applyHovers(){
    $('#search_results .package-list-cn').hover(
        // mouse in
        function () {
            // first we need to know which <div class="marker"></div> we hovered

            $(this).css({background: "#2d2d2d"});
            var listid = $(this).attr("data_id");

            //console.log(overlayMarkers[listid].div);
            //overlayMarkers[listid].setAnimation(google.maps.Animation.BOUNCE);
            var div=overlayMarkers[listid].div;
            div.style.background = '#a4864f';
            div.style.width = '40px';
            div.style.height = '19px';
            div.style.border='1px solid #876c3e';
            div.style.fontSize='12px';

        },
        // mouse out
        function () {
            // first we need to know which <div class="marker"></div> we hovered
            $(this).css({background: "#000000"});
            var listid = $(this).attr("data_id");
            var div=overlayMarkers[listid].div;
            div.style.background = '#888';
            div.style.width = '38px';
            div.style.height = '18px';
            div.style.border='1px solid #555';
            div.style.fontSize='11px';

        }

    );
}


function loadMobileMap() {

    console.log('loadmobile');

    var mobile_map;
    var myLatlng = new google.maps.LatLng(37.4419, -122.1419);
    var myOptions = {
        zoom: 13,
        scrollwheel: false,
        center: myLatlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }

    mobile_map = new google.maps.Map(document.getElementById("mobile_canvas"), myOptions);
    var autocompleteOptions = {}
    var mobileInput = document.getElementById('mobile_location');
    autocomplete_mobile = new google.maps.places.Autocomplete(mobileInput, autocompleteOptions);
    autocomplete_mobile.bindTo('bounds', mobile_map);
    autocomplete_mobile.addListener('place_changed', fillInAddress);
}


function loadPlacesMap() {
    console.log('loadPlacesMap');
    var map;
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
    autocomplete = new google.maps.places.Autocomplete(autocompleteInput, autocompleteOptions);
    autocomplete.bindTo('bounds', map);
    autocomplete.addListener('place_changed', fillInAddress);
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
           // document.getElementById('lat').value = place.geometry.location.lat();
           // document.getElementById('lng').value = place.geometry.location.lng();

        }
        if (addressType == "postal_code") {
            var val = place.address_components[i]['short_name'];
            document.getElementById('zipcode').value = val;
        }


    }
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

function loadListingMap() {

    window.map = new google.maps.Map(document.getElementById('search_listing_map'), {
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    //var infowindow = new google.maps.InfoWindow();
    var infoWindow = new google.maps.InfoWindow(), marker, i;
    var bounds = new google.maps.LatLngBounds();

    for (i = 0; i < locations.length; i++) {
        var arr = explode(",", locations[i]);

        if(arr[4] == 'rent'){

            var list_icon = new google.maps.MarkerImage(site_url +"/assets/img/marker_rent.png");
        }
        else {

            var list_icon = new google.maps.MarkerImage(site_url+ "/assets/img/marker_sale.png");
        }

        marker = new google.maps.Marker({
            position: new google.maps.LatLng(arr[1], arr[2]),
            map: map,
            icon: list_icon
        });


        // Add info window to marker
        var content = arr_info[arr[0]];

        google.maps.event.addListener(marker,'mouseover', (function(marker,content,infoWindow){
            return function() {
                infoWindow.setContent(content);
                infoWindow.open(map,marker);
            };
        })(marker,content,infoWindow));



        map.fitBounds(bounds);

        bounds.extend(marker.position);

    }



    var listener = google.maps.event.addListener(map, "idle", function () {
        map.setZoom(12);
        google.maps.event.removeListener(listener);
    });


    google.maps.event.addListenerOnce(map, 'dragend', function() {
        mapMoveSearch();

    });



}