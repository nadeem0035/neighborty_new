// JavaScript Document
jQuery(document).ready(function($) {
    showMore();
    var w, mHeight, tests = $("#testimonials");
    w = tests.outerWidth();
    mHeight = 0;
    tests.find(".testimonial").each(function(index) {
        $("#t_pagers").find(".pager:eq(0)").addClass("active"); //make the first pager active initially
        if (index == 0)
            $(this).addClass("active"); //make the first slide active initially
        if ($(this).height() > mHeight) //just finding the max height of the slides
            mHeight = $(this).height();
        var l = index * w; //find the left position of each slide
        $(this).css("left", l); //set the left position
        tests.find("#test_container").height(mHeight); //make the height of the slider equal to the max height of the slides
    });
    $(".pager").on("click", function(e) { //clicking action for pagination
        e.preventDefault();
        next = $(this).index(".pager");
        clearInterval(t_int); //clicking stops the autoplay we will define later
        moveIt(next);
    });
    var t_int = setInterval(function() { //for autoplay
        var i = $(".testimonial.active").index(".testimonial");
        if (i == $(".testimonial").length - 1)
            next = 0;
        else
            next = i + 1;
        moveIt(next);
    }, 6000);
});

function moveIt(next) { //the main sliding function
    var c = parseInt($(".testimonial.active").removeClass("active").css("left")); //current position
    var n = parseInt($(".testimonial").eq(next).addClass("active").css("left")); //new position
    $(".testimonial").each(function() { //shift each slide
        if (n > c)
            $(this).animate({
                'left': '-=' + (n - c) + 'px'
            });
        else
            $(this).animate({
                'left': '+=' + Math.abs(n - c) + 'px'
            });
    });
    $(".pager.active").removeClass("active"); //very basic
    $("#t_pagers").find(".pager").eq(next).addClass("active"); //very basic
}

// For Demo purposes only (show hover effect on mobile devices)
//[].slice.call(document.querySelectorAll('a[href="#"')).forEach(function(el) {
//    el.addEventListener('click', function(ev) {
//        ev.preventDefault();
//    });
//});


$('a[href^="#!"]').on('click', function(e) {
    e.preventDefault();
    $(document).off("scroll");

    $('a').each(function() {
        $(this).removeClass('activeurl');
    })
    $(this).addClass('activeurl');
    var target = this.hash,
        menu = target;
    $target = $(target);

    $('html, body').stop().animate({
        'scrollTop': $target.offset().top + 2
    }, 600, 'swing', function() {
        window.location.hash = target;
        $(document).on("scroll", onScroll);
    });
});

function onScroll(event) {
    var scrollPos = $(document).scrollTop();
    $('#menu-center a').each(function() {
        var currLink = $(this);
        var refElement = $(currLink.attr("href"));
        if (refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
            $('#menu-center ul li a').removeClass("active");
            currLink.addClass("active");
        } else {
            currLink.removeClass("active");
        }
    });
}



$(window).scroll(function() {
    if ($(this).scrollTop() > 300) {
        $('#single-fix-menu-desktop').fadeIn();
    } else {
        $('#single-fix-menu-desktop').fadeOut();
    }
});




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

$(window).scroll(function() {
    if ($(this).scrollTop() > 200) {
        $('#sidebar-fixed').fadeIn();
    } else if ($(this).scrollTop() < 20) {
        $("#sidebar-fixed").css("margin-top", "130px");
    } else {
        $("#sidebar-fixed").css("margin-top", "-20px");
    }
});

$(window).scroll(function() {
    if ($(document).height() <= ($(window).height() + $(window).scrollTop())) {
        //Bottom Reached
        $('#sidebar-fixed').hide();
    }
});

$(document).ready(function() {




    $("#search_form").validate({


        submitHandler: function(e) {
            e.preventDefault();
            var $form = $(form);
            $form.submit();
        },
        rules: {
            location: {
                required: true,
            },
        },
        messages: {
            location: {
                required: "Please enter location"
            },
        },
        errorPlacement: function(error, element) {
            $(element).closest('div').find('.help-block').html(error.html());
            $('#shakemediv').addClass('animated shake');
            $('#location').val("Lahore");
        },
        highlight: function(element) {
            $(element).closest('div').removeClass('has-success').addClass('has-error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).closest('div').removeClass('has-error').addClass('has-success');
            $(element).closest('div').find('.help-block').html('');
        }
    });


    //SEARCH RESULTS FORM
    $("#search_form_adv").validate({
        rules: {
            location: {
                required: true,
            },
        },
        messages: {
            location: {
                required: "Please enter location"
            },
        },
        errorPlacement: function(error, element) {
            $(element).closest('div').find('.help-block').html(error.html());
            $('#shakemediv').addClass('animated shake');
            $('#location').val("Los Angeles");
        },
        highlight: function(element) {
            $(element).closest('div').removeClass('has-success').addClass('has-error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).closest('div').removeClass('has-error').addClass('has-success');
            $(element).closest('div').find('.help-block').html('');
        },
        submitHandler: function(e) {
            //	e.preventDefault();
            //console.log($("#search_form_adv").serialize());

            $.ajax({
                url: site_url + "search/results",
                type: "GET",
                data: $("#search_form_adv").serialize() + "&ajax=1",
                dataType: "html",

                success: function(data) {
                    //console.log(data);
                    ScrollMe('search_results');
                    $('#search_results').html(data);
                    applyPagination();
                    loadSearchMap();
					applyHovers();
                }
            });
            return false;


        },
    });


        $(".effect-goliath figcaption").click(function() {
            var url = $(this).attr("data-href");
           //alert(url);
		   window.location.href = url;
		});

applyHovers();

    applyPagination();



    $("#more_link").click(function() {
        $("#more_filters").toggle("slow");
    });



    jQuery.ajaxSetup({
        beforeSend: function() {
            $("#search_results").addClass("loading");
        },
        complete: function() {
            $("#search_results").removeClass("loading");
        }
    });


    $("#contacthostform").submit(function() {
        var data = $('#contacthostform').serialize();
        var url = site_url + 'Inbox/contact_host/';
        $.ajax({
            type: "POST",
            cache: false,
            url: url,
            data: data,
            success: function(result) {
                if (result) {
                    $("#contact_response").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button> Message send successfully.</div>');
                } else {
                    $("#contact_response").html('<div class="alert alert-danger"><button class="close" data-dismiss="alert"></button> Something wrong.Please try again.</div>');
                }

            },
            async: false
        });
        return false;
    });
    
    $("#contactus_form").validate({
        focusInvalid: false,
        submitHandler: function (form) {
            var data = $('#contactus_form').serialize();
            var url = site_url + 'Index/contact_form/';
            $.ajax({
                type: "POST",
                cache: false,
                url: url,
                data: data,
                success: function (result) {
                    if (result) {
                        $("#res_mesg").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button> Your Message sent successfully.</div>');
                        $('#contactus_form').trigger("reset");
                    } else {
                        $("#res_mesg").html('<div class="alert alert-danger"><button class="close" data-dismiss="alert"></button> Something wrong.Please try again.</div>');
                    }
                    
                },
                async: false
            });
            return false;
        }
    });

//    $("#contactus_form").submit(function() {
//        var data = $('#contactus_form').serialize();
//        var url = site_url + 'Index/contact_form/';
//        $.ajax({
//            type: "POST",
//            cache: false,
//            url: url,
//            data: data,
//            success: function(result) {
//                if (result) {
//                    $("#res_mesg").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button> Your Message sent successfully.</div>');
//                } else {
//                    $("#res_mesg").html('<div class="alert alert-danger"><button class="close" data-dismiss="alert"></button> Something wrong.Please try again.</div>');
//                }
//                $('#contactus_form').trigger("reset");
//            },
//            async: false
//        });
//        return false;
//    });

});

    function applyPagination() {
        $(".ajax_pagingsearc a").click(function() {
            var url = $(this).attr("data-href");
            var page = $(this).attr("pagination-page");
            var ajax = $(this).attr("ajax-page");
            if (url != "current") {
                $.ajax({
                    type: "GET",
                    data: $("#search_form_adv").serialize() + "&page=" + page + "&ajax=" + ajax,
                    url: url,
                    success: function(msg) {
                        console.log("DATA LOADED FROM AJAX FOR PAGE " + page);
                        console.log("=======================================================================================");
                        $("#search_results").html(msg);
                        applyPagination();
                        loadSearchMap();
						applyHovers();
						$("#search_map").sticky({ topSpacing:20, bottomSpacing:400, center:true, className:"hey" });
                    }
                });
            }
            return false;
        });
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

     function ScrollMe(id) {
        var offset = $("#" + id).offset().top - 50;
        $('html,body').animate({
            scrollTop: offset
        }, 'slow');
    } 

 // Add a Home control that returns the user to London
function HomeControl(controlDiv, map) {
	controlDiv.style.padding = '5px';
	var controlUI = document.createElement('div');
	controlUI.className = "toggle_mapsearch"; 
	controlDiv.appendChild(controlUI);
	var controlLabel = document.createElement('label');
	controlLabel.innerHTML = 'Search as I move the Map';
	
	var input = document.createElement("input");
	input.type = "checkbox";
	input.className = "mapsearch_checkbox"; 
	input.id = "search_with_map"; // set the CSS class
	controlLabel.appendChild(input); // put it into the DOM
	controlUI.appendChild(controlLabel);

}
     var overlayMarkers = [];
	 var map;
	 var load_map=0;
	 
function mapMoveSearch() {

	google.maps.event.addDomListener(map,"idle",function() {
		if ($('#search_with_map').is(":checked")){
			var bounds =  map.getBounds();
			var sw = bounds.getSouthWest();
			var ne = bounds.getNorthEast();
	
			$("#sw_lat").val(sw.lat());
			$("#sw_lng").val(sw.lng());
			$("#ne_lat").val(ne.lat());
			$("#ne_lng").val(ne.lng());
			$("#search_by_map").val("true");
			console.log("Checked TRUE");


            $.ajax({
                url: site_url + "search/results",
                type: "GET",
                data: $("#search_form_adv").serialize() + "&ajax=1",
                dataType: "html",

                success: function(data) {
                    //console.log(data);
                    ScrollMe('search_results');
                    $('#search_results').html(data);
                    applyPagination();
                    loadSearchMap();
					applyHovers();
					console.log($("#search_by_map").val());
					
                }, done: function(data){


					$("#sw_lat").val("");
					$("#sw_lng").val("");
					$("#ne_lat").val("");
					$("#ne_lng").val("");
					$("#search_by_map").val("");
					
					if($("#search_by_map").val()==="true"){
						//$('#search_by_map').prop('checked', true);
						$('#search_with_map').attr('checked', true);
						$("#search_with_map").prop("checked", true);
					}
				}
            });




			
		}
		
	});

}

function loadSearchMap() {
    map = new google.maps.Map(document.getElementById('search_map'), {
        zoom: 4,
        scrollwheel: false,
        // center: new google.maps.LatLng(-39.92, 151.25),
       // disableDefaultUI: true,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
 	// Create a DIV to hold the control and call HomeControl()
  	var homeControlDiv = document.createElement('div');
  	var homeControl = new HomeControl(homeControlDiv, map);
	//  homeControlDiv.index = 1;
	map.controls[google.maps.ControlPosition.TOP_RIGHT].push(homeControlDiv);
	
	setMarkers(map, locations);
	
	$("#search_map").sticky({ topSpacing:20, bottomSpacing:400, center:true, className:"hey" });
	mapMoveSearch();
}



function loadWishlistMap() {

    map = new google.maps.Map(document.getElementById('listing_map'), {
        zoom: 4,
        scrollwheel: false,
        // center: new google.maps.LatLng(-39.92, 151.25),
       // disableDefaultUI: true,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    // Create a DIV to hold the control and call HomeControl()
    // var homeControlDiv = document.createElement('div');
    //var homeControl = new HomeControl(homeControlDiv, map);
    //  homeControlDiv.index = 1;
    // map.controls[google.maps.ControlPosition.TOP_RIGHT].push(homeControlDiv);

   // alert(locations);
    
    setMarkers(map, locations);
    
    //$("#listing_map").sticky({ topSpacing:20, bottomSpacing:400, center:true, className:"hey" });

    google.maps.event.addDomListener(map,"idle",function() {
      
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



		//SAVING ALL OVERLAY MARKERS		
		overlayMarkers[arr[0]]=overlay;
		
        //===============================================================================================

        //		var content = arr_info[arr[0]];
        //		
        //		var infowindow = new google.maps.InfoWindow()
        //		
        //		google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){ 
        //		return function() {
        //			infowindow.setContent(content);
        //			infowindow.open(map,marker);
        //		};
        //		})(marker,content,infowindow)); 

    }
	//now fit the map to the newly inclusive bounds
map.fitBounds(bounds);
}


function bookingDetailMap(lati, longi) {
    var map; // Global declaration of the map
    var lat_longs_map = new Array();
    var markers_map = new Array();
    var placesService;
    var placesAutocomplete;

    var iw_map = new google.maps.InfoWindow();


    var myLatlng = new google.maps.LatLng(lati, longi);
    var myOptions = {
        scrollwheel: false,
        zoom: 14,
        center: myLatlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById("map"), myOptions);

    var cityCircle = new google.maps.Circle({
        strokeColor: '#FF0000',
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: '#FF0000',
        fillOpacity: 0.35,
        map: map,
        center: map.center,
        radius: 500
    });

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

    autocomplete = new google.maps.places.Autocomplete(autocompleteInput, autocompleteOptions);
    autocomplete.bindTo('bounds', map);
    autocomplete.addListener('place_changed', fillInAddress);

}
// [START region_fillform]
function fillInAddress() {
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
            document.getElementById('street').value = val;
        }
        if (addressType == "locality") {
            var val = place.address_components[i]['long_name'];
            console.log(val);
            document.getElementById('city').value = val;
        }
        if (addressType == "administrative_area_level_1") {
            var val = place.address_components[i]['long_name'];
            console.log(val);
            document.getElementById('state').value = val;
        }
        if (addressType == "administrative_area_level_1") {
            var val = place.address_components[i]['short_name'];
            console.log(val);
            document.getElementById('state_code').value = val;
        }
        if (addressType == "country") {
            var val = place.address_components[i]['long_name'];
            console.log(val);
            document.getElementById('country').value = val;
        }
        if (addressType == "postal_code") {
            var val = place.address_components[i]['short_name'];
            console.log(val);
            document.getElementById('zipcode').value = val;
        }
        //    if (addressType=="locality") {
        //      var val = place.address_components[i]['locality'];
        //      document.getElementById('city').value = val;
        //    }
        //    if (addressType=="locality") {
        //      var val = place.address_components[i]['locality'];
        //      document.getElementById('city').value = val;
        //    }
    }
}


function explode(delimiter, string, limit) {
    //  discuss at: http://phpjs.org/functions/explode/
    // original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    //   example 1: explode(' ', 'Kevin van Zonneveld');
    //   returns 1: {0: 'Kevin', 1: 'van', 2: 'Zonneveld'}

    if (arguments.length < 2 || typeof delimiter === 'undefined' || typeof string === 'undefined') return null;
    if (delimiter === '' || delimiter === false || delimiter === null) return false;
    if (typeof delimiter === 'function' || typeof delimiter === 'object' || typeof string === 'function' || typeof string ===
        'object') {
        return {
            0: ''
        };
    }
    if (delimiter === true) delimiter = '1';

    // Here we go...
    delimiter += '';
    string += '';

    var s = string.split(delimiter);

    if (typeof limit === 'undefined') return s;

    // Support for limit
    if (limit === 0) limit = 1;

    // Positive limit
    if (limit > 0) {
        if (limit >= s.length) return s;
        return s.slice(0, limit - 1)
            .concat([s.slice(limit - 1)
                .join(delimiter)
            ]);
    }

    // Negative limit
    if (-limit >= s.length) return [];

    s.splice(s.length + limit);
    return s;
}


/** Wishlists*/

function loadWishtlistModel(listing_id){
    var url = site_url + 'wishlist/';
    var data = {
        listing_id   :listing_id
    };
    $.ajax({
       type: "POST",
       cache: false,
       url: url,
       data: data,
       async: false,
       success: function(result) {

        $("#wishlistContent").html(result);
        $('#wishlistModal').modal('show'); 

    },
});
}

// New Wishlist
function showfields(){

   $(".create_new").hide();
   $('.new_wishlist .form').show();
}
    // Add Wishlist Category
    function addWishlistCategory(){

        $("#category").validate({
            rules: {
                wishlist_name: {required: true},
            },
            errorPlacement: function(error, element) {
                $('#wishlist_name').css("border"," 1px solid red");
            },
        });

        if($("#category").valid()==true){

            var url  = site_url+'wishlist/addWishlistCategories/';
            var name = $('#wishlist_name').val();
            var visibility = $('#visibility').val();
            var data = {
                name   :name,
                visibility:visibility
            };

            $.ajax({
                type: "POST",
                cache: false,
                url: url,
                data: data,
                async: false,
                success: function(result) {
                    if(result){
                        console.log('test');
                        var url = site_url + 'wishlist/wishlistCategories/';
                        $.ajax({
                            type: "POST",
                            cache: false,
                            url: url,
                            data: data,
                            async: false,
                            success: function(result) {
                                $(".form").hide();
                                $('#wishlist_name').val("");
                                $("#wishlist_dropdown").html(result);
                            }
                        });
                    }
                },
            });
        }
    }
   // Add Wishlist
   function addWishlist(){

    $(".form").hide();

    $("#wishlistForm").validate({
        rules: {
            note_text: {required: true},
            'wishlist_category[]': { required: true},
        },
        errorPlacement: function(error, element) {
            $('#note_text').css("border"," 1px solid red");
            $('.error_msg').show();
        },
    });

    if($("#wishlistForm").valid()==true){

        var data = $('#wishlistForm').serialize();
        var url = site_url + 'wishlist/createWishlist/';
        $.ajax({
            type: "POST",
            cache: false,
            url: url,
            data: data,
            async:false,
            success: function(result) {
                if (result) {
                    $('#wishlistModal').modal('hide');
                }

            },
        });
    }
}

function addNewCategory(){

    var data = $('#newWishList').serialize();
    var url = site_url + 'wishlist/addWishlistCategories/';
    $("#newWishList").validate({
        rules: {
            name: {required: true},
        },
        errorPlacement: function(error, element) {
            $('#name').css("border"," 1px solid red");
        },
    });
    if($("#newWishList").valid()==true){

        $.ajax({
            type: "POST",
            cache: false,
            url: url,
            data: data,
            success: function(result) {
                if (result) {
                    $('#newWishlist').modal('hide');
                    location.reload()

                } 

            },
        });
    }
}

    // Delete Wishlist Listing

    function removeWishList(listing_id){

        var url = site_url + 'wishlist/remove_wishlist/';
        var data = { listing_id:listing_id };

        $.ajax({
            type: "POST",
            cache: false,
            url: url,
            data: data,
            async: false,

            success: function(result) {
                $("#wishListsRow_"+listing_id).remove();
                $('.wishlist_notice').show();
                window.setTimeout(function(){location.reload()},3000)
            }
        });
    }

    //update user Wishlist Category

    function updateWishCat(id){

        var data  = { id: id };

        $(".info").hide();
        var url  = site_url + 'wishlist/category_details/';
        $.ajax({
            type: "POST",
            cache: false,
            url: url,
            data: data,
            async: false,
            success: function(result) {
               $('#wishlist_container').html(result);
           }
       });
    }

    // Update Wishlist Cateogry

    function updateWishlistCat(){

        $("#updateCat").validate({
            rules: {
                name: {required: true},
            },
            errorPlacement: function(error, element) {

                $('#name').css("border"," 1px solid red");

            },
        });

        if($("#updateCat").valid()==true){

            var data = $('#updateCat').serialize();
            var url = site_url + 'wishlist/update_Wishlist_category/';
            $.ajax({
                type: "POST",
                cache: false,
                url: url,
                data: data,
                async:false,

                beforeSend: function() {
                   $(".loader").show();
                   $("#wishlistrow").hide();
                },
                success: function(result) {
                    if (result) {
                        $('#name').css("border"," 1px solid #e5e5e5");
                        $('#wishlistModal').modal('hide');
                        $('#name').val(result);
                        $('.ListName').text(result);
                    }

                },
                complete:function(){
                  $(".loader").hide();
                  $("#wishlistrow").show();
                }
            });
        }
    }

    // Delete Wishlist Category
    function deleteWishlistCategory(id){

        var url = site_url + 'wishlist/remove_wishlist_category/';
        var data = { id:id };

        $.ajax({
            type: "POST",
            cache: false,
            url: url,
            data: data,
            async: false,

            success: function(result) {
                if(result) {
                    $("#wishlists_category_" + id).remove();
                    $('#display_notices').html('<div  class="alert alert-success"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Your wishlist category has been deleted successfully </div>');
                    window.setTimeout(function () {
                        location.reload()
                    }, 3000)
                }else{
                    $('#display_notices').html('<div  class="alert alert-danger"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Sorry ! something went wrong,try again </div>');
                }
            }
        });

    }

   // update User Note
   
   function updateUserNote(id){

    var note = $('#message_note_'+id).val();
    var url = site_url + 'wishlist/update_note/';
    $.ajax({
        type: "POST",
        cache: false,
        url: url,
        data: { id : id ,note : note },
        async:false,

        beforeSend: function() {
           $(".loader").show();
           $('#message_note_'+id).css("display","none");
       },
       success: function(result) {
        if (result) {
            var url = site_url + 'wishlist/get_updated_note/';
            $.ajax({
                type: "POST",
                cache: false,
                url: url,
                data: {id:id},
                async:false,
                success: function(result) {

                    if (result) {
                        $('#message_note_'+id).html(result);

                    }

                },
            });
        }
       },
       complete: function() {
        $(".loader").hide();
        $('#message_note_'+id).css("display","block");
    }
      });
   }

    function navigateLink(id){
      window.open(id, '_blank');
    }

    function getTrasnactions(id){
        var url = site_url + 'users/get_tranactions_by_date/';
        $.ajax({
                type: "POST",
                cache: false,
                url: url,
                data: {id:id},
                async:false,
                success: function(result) {

                    if (result) {
                        $("#transcation_div").html(result);

                    }
                },
            });
    }

    /** Load Page Date */

    $(function(){
        
        $('#sidebar_nav li a').on('click', function(){
            var url = site_url + 'pages/load_page_data/';
            var slug = $(this).attr("id");
            console.log(slug);
            $(this).parent().addClass('selected').siblings().removeClass('selected');
            if(slug =="add-listing"){window.location = site_url + 'listings/add-listing'}
            else if(slug=="contact") {window.location = site_url + 'contact' } else{

            $.ajax({
                    type: "POST",
                    cache: false,
                    url: url,
                    data: {slug:slug},
                    async:false,
                    success: function(result) {

                    if (result) {
                        $('.my-profile').html(result);
                        if(slug=="press"){  showMore()}
                    }



                    },
                });
}
        });
    });
    
    function withdraw_amount(){
        $("#widthdraw_form").validate({
            rules: {
                withdraw_amount: {required: true,number: true},
                recipient_email: {required: true,email: true},
            },
            errorPlacement: function(error, element) {
                $('#withdraw_amount').css("border"," 1px solid red");
                 $('#recipient_email').css("border"," 1px solid red");
            },
        });
        if($("#widthdraw_form").valid()==true){
                 $('#withdraw_amount').css("border"," none");
                 $('#recipient_email').css("border"," none");
                 var url = site_url + 'users/verify_funds_amount/';
                 var requested_amount = $('#withdraw_amount').val();
                  $.ajax({
                    type: "POST",
                    cache: false,
                    url: url,
                    async:false,
                    success: function(result) {
                        var available_amount = parseInt(result);
                        if(requested_amount <= available_amount){
                            var data = $('#widthdraw_form').serialize();
                            var url = site_url + 'users/widthdraw_funds/';
                             $.ajax({
                                type: "POST",
                                cache: false,
                                url: url,
                                data: data,
                                async:true,
                                 dataType: 'html',
                                success: function(result) {
                                    if (result) {
                                        setTimeout(function(){
                                            $('#widthdraw').modal('hide');
                                        }, 3000);
                                        $('#widthdraw_success').show();
                                         window.setTimeout(function(){location.reload()},4000)
                                    }

                                },
                            });  

                        }else {
                            $('#widthdraw_notice').show();
                            window.setTimeout(function(){location.reload()},4000)
                        }
                    },
                });


    }
}
    function showMore() {
      var showChar = 90;
      var ellipsestext = "...";
      var moretext = "Show more >";
      var lesstext = "Show less";
      $('.more').each(function () {

          var content = $(this).html();
          if (content.length > showChar) {
              //console.log('test');
              var c = content.substr(0, showChar);
              var h = content.substr(showChar, content.length - showChar);
              console.log(h);
              var html = c + '<span class="moreellipses">' + ellipsestext + '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
              //alert(html);
              //console.log(html);
              $(this).html(html);
          }

      });
      $(".morelink").click(function () {
          if ($(this).hasClass("less")) {
              $(this).removeClass("less");
              $(this).html(moretext);
          } else {
              $(this).addClass("less");
              $(this).html(lesstext);
          }
          $(this).parent().prev().toggle();
          $(this).prev().toggle();
          return false;
      });
  }
