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
        console.log(addressType);
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


function LoadUserLocationMap() {
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
    var autocompleteInput = document.getElementById('user_location');


    autocomplete = new google.maps.places.Autocomplete(autocompleteInput, autocompleteOptions);

    autocomplete.bindTo('bounds', map);
    autocomplete.addListener('place_changed', fillInUserAddress);
}

// [START region_fillform]
function fillInUserAddress() {

    // Get the place details from the autocomplete object.
    var place = autocomplete.getPlace();
    //console.log(place.address_components);
    $("#sw_lat").val("");
    $("#sw_lng").val("");
    $("#ne_lat").val("");
    $("#ne_lng").val("");
    $("#search_by_map").val("");
    // Get each component of the address from the place details
    // and fill the corresponding field on the form.
    for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];
        console.log(addressType);
        if (addressType == "street_number") {
            var val = place.address_components[i]['short_name'];
            console.log(val);
            document.getElementById('user_street').value = val;
        }
        if (addressType == "locality") {
            var val = place.address_components[i]['long_name'];
            console.log(val);
            document.getElementById('user_city').value = val;
        }
        if (addressType == "administrative_area_level_1") {
            var val = place.address_components[i]['long_name'];
            console.log(val);
            document.getElementById('user_state').value = val;
        }
        if (addressType == "administrative_area_level_1") {
            var val = place.address_components[i]['short_name'];
            console.log(val);
            document.getElementById('user_state_code').value = val;
        }
        if (addressType == "country") {
            var val = place.address_components[i]['long_name'];
            console.log(val);
            document.getElementById('user_country').value = val;
        }
        if (addressType == "postal_code") {
            var val = place.address_components[i]['short_name'];
            console.log(val);
            document.getElementById('user_zipcode').value = val;
        }

    }
}


