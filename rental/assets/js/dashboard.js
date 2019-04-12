jQuery(document).ready(function ($) {
    $("#file").change(function () {
        var file = this.files[0];
        var imagefile = file.type;
        var match = ["image/jpeg", "image/png", "image/jpg"];
        if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2])))
        {
            alert("Please Select A valid Image File.Only jpeg, jpg and png Images type allowed");
            return false;
        }
        else
        {
            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(this.files[0]);
        }
    });

    $("#listing_file").change(function () {
        var file = this.files[0];
        var imagefile = file.type;
        var match = ["image/jpeg", "image/png", "image/jpg"];
        if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2])))
        {
            alert("Please Select A valid Image File.Only jpeg, jpg and png Images type allowed");
            return false;
        }
        else
        {
            var reader = new FileReader();
            reader.onload = listingimageIsLoaded;
            reader.readAsDataURL(this.files[0]);
        }
    });

});

function imageIsLoaded(e) {
    $('#previewing').attr('src', e.target.result);
    $('#previewing').attr('width', '150px');
    $('#previewing').attr('height', '150px');
}

function listingimageIsLoaded(e) {
    $('#previewing').attr('src', e.target.result);
    $('#previewing').attr('width', '220px');
    $('#previewing').attr('height', '200px');
}


function submitFile() {

    var formUrl = site_url + 'listings/listing_preview_image_upload';

    var formData = new FormData($('#submit_form')[0]);

    $.ajax({
        url: formUrl,
        type: 'POST',
        data: formData,
        mimeType: "multipart/form-data",
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'json',
        success: function (data, textSatus, jqXHR) {
            if (data) {
                $("#listing_response").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button>Preview image upload successfully</div>');

            } else {
                $("#listing_response").html('<div class="alert alert-danger"><button class="close" data-dismiss="alert"></button> You have some errors. Please try again.</div>');
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log('Fileupload error');
        }
    });
}



function add_reviews() {
    console.log('abv');

    $("#AddReviews").validate({
        ignore: "input[type='text']:hidden",
        rules: {
            'reviews[title]': {required: true},
            'reviews[review]': {required: true},
            'reviews[Value]': {required: true},
            'reviews[Accuracy]': {required: true},
            'reviews[Communication]': {required: true},
            'reviews[Cleanliness]': {required: true},
            'reviews[Location]': {required: true},
            'reviews[check_in]': {required: true},
        },
        errorPlacement: function (error, element) {
            $('.rateCategory').css("border", " 1px solid red");
        },
    });

    setTimeout(function () {
        $('.rateCategory').css("border", "none");
    }, 3000);

    if ($("#AddReviews").valid() == true) {

        $('.rateCategory').css("border", "none");
        var url = site_url + 'listings/AddReviews/';
        var data = $('#AddReviews').serialize();
        console.log(data);
        $.ajax({
            type: "POST",
            cache: false,
            url: url,
            data: data,
            async: false,
            success: function (result) {
                if (result) {
                    $("#AddReviews").html('Reviews Added successfully');
                } else {
                    $(".responsemessage").html('<h3>Some thing wrong! Please try again</h3>');
                }
            },
        });
    }
}

function UpcomingTripsMaps(id, lati, longi) {
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
    map = new google.maps.Map(document.getElementById("map_" + id), myOptions);

    var cityCircle = new google.maps.Circle({
        strokeColor: '#9D7F48',
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: '#9D7F48',
        fillOpacity: 0.35,
        map: map,
        center: map.center,
        radius: 250
    });

}

function TripsMaps(id, lat, long) {
        google.maps.event.addDomListener(window, 'load', UpcomingTripsMaps(id, lat, long));
    }

function ApproveModel(bid){
    var url = site_url + 'booking/ApproveModel/';
    var data = {
        bid   :bid
    };
    $.ajax({
       type: "POST",
       cache: false,
       url: url,
       data: data,
       async: false,
       success: function(result) {

        $("#ApprovemodelWrap").html(result);
        $('#approvemodel'+bid).modal('show'); 

    },
});
}

function ContactHostDashboard(bid){
    var url = site_url + 'dashboard/contactHost/';
    var data = {
        bid   :bid
    };
    $.ajax({
       type: "POST",
       cache: false,
       url: url,
       data: data,
       async: false,
       success: function(result) {

        $("#ContactHostDashboardWrap").html(result);
        $('#ContactHostDashboard'+bid).modal('show'); 

    },
});
}
$(document).on('click', '#contacthost', function (e) {
    e.preventDefault();
    var data = $('#contacthostform').serialize();
    var url = site_url + 'Inbox/contact_host/';
    $.ajax({
        type: "POST",
        cache: false,
        url: url,
        data: data,
        success: function (result) {
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


$(function () {
     $('#Manual').hide();
     $('#Calendar').hide();
    $('#availability_through').change(function () {
        if ($('#availability_through').val() == 'Calendar') {
            $('#Calendar').show();
            $('#Manual').hide();
        } else {
            $('#Calendar').hide();
            $('#Manual').show();
        }
    });
});