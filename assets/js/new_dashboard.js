jQuery(document).ready(function () {

    $("#geocomplete").geocomplete(
        {
            map: ".map_canvas",
            details: "#map_section",
            mapOptions: {
                scrollwheel: true
            },
            markerOptions: {
                draggable: true
            },
            types: ["geocode", "establishment"],
        });

    $(".dz-hidden-input").prop("disabled",true);

});

function toggleAmenities(val,type)
{
    if (typeof val !== 'undefined') {
        console.log(type);
        if(type =='Room' || type == 'Penthouse' || type == 'Industrial Land' ||type == 'Plot File' || type == 'Plot Form'){
            $('.amenities_list').hide();
        }else{
            $('.amenities_list').show();
        }

        if(val == 'plot'){ document.getElementById('rooms').style.display ='none'}
        else{ document.getElementById('rooms').style.display ='block'}
        composeTitleForProperty();
    }

}
function landArea()
{
    composeTitleForProperty();
}
function toggleVisibalities(){


    if (document.getElementById('houses').checked) {
        $('#plots').attr('checked', false);
        $('#commercial').attr('checked', false);
        document.getElementById('house_details').style.display = 'block';
        document.getElementById('plot_details').style.display = 'none';
        document.getElementById('commercial_details').style.display = 'none';
    }

    else if (document.getElementById('plots').checked) {
        $('#houses').attr('checked', false);
        $('#commercial').attr('checked', false);
        document.getElementById('house_details').style.display = 'none';
        document.getElementById('plot_details').style.display = 'block';
        document.getElementById('commercial_details').style.display = 'none';
    }
    else if (document.getElementById('commercial').checked) {
        $('#houses').attr('checked', false);
        $('#plots').attr('checked', false);
        document.getElementById('house_details').style.display = 'none';
        document.getElementById('plot_details').style.display = 'none';
        document.getElementById('commercial_details').style.display = 'block';
    }
    else{

        document.getElementById('house_details').style.display = 'none';
        document.getElementById('plot_details').style.display = 'none';
        document.getElementById('commercial_details').style.display = 'none';

    }

    composeTitleForProperty();
}

function initializeMap() {

    $( "#map_canvas" ).show();
    //$('.location_breadcrump').show();
    var location = new google.maps.LatLng(33.683493,73.048443);
    var custom = {
        zoom: 2,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        center: location,
        mapTypeControl:false,
        streetViewControl:false,
        navigationControlOptions: {
            style: google.maps.NavigationControlStyle.SMALL
        }
    };

    var marker;
    var map = new google.maps.Map(document.getElementById("map_canvas"), custom);
    var GMaps = new google.maps.Geocoder();

    var address = '';
    if($('#street').val() != ''){
        $("#street").val();
        address += $('#street').val() + ',';
    }

    if($('#property_area').val() != '' && $('#property_area').val() != 'other' && $('#property_area').val() != 'no_area'){

        address += $('#property_area option:selected').text() + ',';
        $('.parea').html(' >> '+ $('#property_area option:selected').text());
    }

    if($('#property_sub_area').val() != '' && $('#property_sub_area').val() != 'other' && $('#property_sub_area').val() != 'no_area'){
        address += $('#property_sub_area option:selected').text() + ',';
        $('.psub-area').html(' >> '+ $('#property_sub_area option:selected').text());
    }


    if($('#property_city option:selected').text() != ''){
        address += $('#property_city option:selected').text() + ',';
    }


    GMaps.geocode({
        "address": address
    },function(results){
        raw = results;

         for (var i=0; i < results[0].address_components.length; i++) {


            for (var j=0; j < results[0].address_components[i].types.length; j++) {


                 if (results[0].address_components[i].types[j] == "country") {
                     country = results[0].address_components[i];
                     $('#country').val(country.long_name);
                 }

                if (results[0].address_components[i].types[j] == "locality") {
                    city = results[0].address_components[i];
                    $('#city').val(city.long_name);
                }

                if (results[0].address_components[i].types[j] == "administrative_area_level_1") {
                    state = results[0].address_components[i];
                    $('#state_province').val(state.long_name);

                }


            }
         }
    });



    GMaps.geocode({ 'address': address}, function(results, status) {
        if (status == 'OK') {

            var latlng = results[0].geometry.location;
            map.setCenter(new google.maps.LatLng(latlng.lat(), latlng.lng()));
            map.setZoom(15);
            var c = map.getCenter();
            $('#latitude').val(latlng.lat());
            $('#longitude').val(latlng.lng());

            marker = new google.maps.Marker({
                position: c,
                map: map,
                draggable: true,
                icon: "https://beta.zoney.pk/assets/img/pin.png"
            });

        }
        google.maps.event.addListener(marker, 'position_changed', function () {

            var lat = marker.getPosition().lat();
            var lng = marker.getPosition().lng();

            $('#latitude').val(lat);
            $('#longitude').val(lng);
        });
    });
    google.maps.event.addDomListener(window, 'load', initializeMap);

    //createTitle();
}

var locations ='';
$('#property_city').on('change',function(){

    var val = $("#property_city option:selected").text();

    if(val != 'select'){

        var id = $(this).val();
        if(id){
            getCitiesArea(id);
        }else{
            $('select[name="property_area"]').empty();
            $('.property_area').hide();
            $('select[name="property_sub_area"]').empty();
            $('.property_sub_area').hide();
        }
    }

    composeTitleForProperty();


});

$('#property_area').on('change',function(){

    var val = $("#property_area option:selected").text();

    if(val != 'Select') {

        var id = $(this).val();
        $('#area_location').val(val);
        getSectorsSubAreas(id,'property_sub_area');
    }
    composeTitleForProperty();

});

$('#property_sub_area').on('change',function(){

    var val = $("#property_sub_area option:selected").val();
    var text = $("#property_sub_area option:selected").text();

    if(val) {

        var id = $(this).val();
        $('#sub_area').val(text);
        getSectorsSubAreas(id,'property_sub_sub_area');
    }
    composeTitleForProperty();

});

$('#property_sub_sub_area').on('change',function(){

    var text = $("#property_sub_sub_area option:selected").text();
    $('#sub_sub_area').val(text);

    composeTitleForProperty();

});


$('input[name="property_sub_type"]:radio').on('change', function() {


    var cat_type = $(this).val();
    var parent_id = $(this).attr("data-parent");
    var formUrl = site_url + 'listings/selectAmenities';
    if(cat_type){
        $.ajax(
            {
                url: formUrl,
                type: 'POST',
                data: {'cat_type':cat_type,parent_id:parent_id},
                beforeSend: function(){
                    $('#amenities_box').html('');
                },
                success: function (data, textSatus, jqXHR)
                {
                    $('#amenities_box').html(data);

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    console.log('Fileupload error');
                }
            });


    }
});

function getCitiesArea(val) {

    var url = site_url + 'city-area';
    $.ajax({
        type: "POST",
        url: url,
        data: {id:val},
        dataType:'json',
        beforeSend:function()
        {
           $('#page-loading').show();
            $('select[name="property_area"]').empty();
            $('#property_area').hide();
            $('select[name="property_sub_area"]').empty();
            $('#property_sub_area').hide();

        },
        success: function (data) {

            console.log(data.length);
            if(data.length > 0){
                $('select[name="property_area"]').empty().append('<option selected="selected" value="">Select</option>');
                $('.property_area').show();
                $.each(data, function(key, value) {
                    $('select[name="property_area"]').append('<option value="'+ value.id +'">'+ value.area_name +'</option>');
                });
            }
        },
        complete:function () {
            $('#page-loading').hide();
        }
    });
}

function getSectorsSubAreas(val,id) {



    var url = site_url + 'area-sectors';
    $.ajax({
        type: "POST",
        url: url,
        data: {id:val},
        dataType:'json',
        beforeSend:function()
        {
            $('.ajax_loader').show();
        },
        success: function (data) {


            $('select[name="'+id+'"]').empty().append('<option selected="selected" value="">Select</option>');
            $('.'+id).show();
            if(data != false){
                $.each(data, function(key, value) {
                    $('select[name="'+id+'"]').append('<option value="'+ value.id +'">'+ value.area_name +'</option>');
                });
            }else{
                $('.'+id).hide();
                console.log('no sectors found against this area');
            }
        },
        complete:function () {
            $('.ajax_loader').hide();
        }
    });
}

$( document ).ready(function() {

    $('#priced').on('keypress', function(ev) {

        $('#listing_location').val(locations);

        var input = $('#priced').val();
        input = input.split(',').join('');
        $('#priced').val(input);
        var keyCode = window.event ? ev.keyCode : ev.which;
        if (keyCode < 48 || keyCode > 57) {
            if (keyCode != 0 && keyCode != 8 && keyCode != 13 && !ev.ctrlKey) {
                ev.preventDefault();
            }
        }
    });

});

function addvalidate() {
    $('#addListing').validate({
        errorPlacement: function (error, element) {
            return true;
        },
        focusInvalid: false,
        ignore: ":not(:visible)",
        rules: {
            purpose: {
                required: true
            },
            property_type: {
                required: true
            },
            property_city: {
                required: true
            },
            property_area: {
                required: true
            },
            // property_sub_area: {
            //     required: true
            // },
            listing_name: {
                required: true
            },
            summary: {
                required: true
            },
            land_area: {
                required: true
            },
            unit_id: {
                required: true
            },
            bedrooms: {
                required: true
            },
            bathrooms: {
                required: true
            },
            rooms: {
                required: true
            },
            kitchen: {
                required: true
            },
            price: {
                required: true
            },
            phone: {
                required: true
            },
            img_status:{
                required:true
            }

        },

        highlight: function (element) {
            $(element).closest('.error_span').addClass('has-error');

        },
        success: function (label,element) {

            $(element).closest('.error_span').removeClass('has-error');
            label.remove();
            $(element).closest('.error_span').addClass('has-success');



        },
        submitHandler: function (form) {

            //form.submit();
            save_property(event);
        },

    });
}

function save_property(event){
    console.log('save');
    event.preventDefault();

    var data = $('#addListing').serialize();

     $.ajax({
         url: site_url+'save-property',
         type: 'POST',
         dataType:'json',
         data: data,
         //contentType: "application/json",

         beforeSend:function()
         {
             $(".submit_property").prop('disabled', true);
             var $this = $(this);
                 $this.button('loading');




         },
         success: function(response) {
            console.log(response);
             document.getElementById("addListing").reset();
             $('label').removeClass('active');
             displayNotification('success');


         },
         complete:function () {
             $(".submit_property").prop('disabled', false);

         },
         error: function(xhr, status, error) {

             console.log(xhr, status, error)

             //alert(xhr.responseText);
             displayNotification('error');
         }
     });
}



function editvalidate() {

    $('#editListing').validate({
        errorPlacement: function (error, element) {
            return true;
        },
        focusInvalid: false,
        ignore: ":not(:visible)",
        rules: {
            purpose: {
                required: true
            },
            property_type: {
                required: true
            },
            property_city: {
                required: true
            },
            property_area: {
                required: true
            },
            property_sub_area: {
                required: true
            },
            listing_name: {
                required: true
            },
            summary: {
                required: true
            },
            land_area: {
                required: true
            },
            unit_id: {
                required: true
            },
            bedrooms: {
                required: true
            },
            bathrooms: {
                required: true
            },
            rooms: {
                required: true
            },
            kitchen: {
                required: true
            },
            price: {
                required: true
            },
            phone: {
                required: true
            },
           /* img_status:{
                required:true
            }*/

        },

        highlight: function (element) {
            $(element).closest('.error_span').addClass('has-error');

        },
        success: function (label,element) {

            $(element).closest('.error_span').removeClass('has-error');
            label.remove();
            $(element).closest('.error_span').addClass('has-success');



        },
        submitHandler: function (form) {
            //form.submit();
            save_edit_property(event);
        },

    });
}


function save_edit_property(event){
    console.log('edit');
    event.preventDefault();

    var data = $('#editListing').serialize();

    $.ajax({
        url: site_url+'edit-property',
        type: 'POST',
        dataType:'json',
        data: data,
        //contentType: "application/json",

        beforeSend:function()
        {
            $(".edit_property").prop('disabled', true);
            var $this = $(this);
            $this.button('loading');
            var $this = $(this);
            $this.button('loading');

        },
        success: function(response) {
            console.log(response);
            document.getElementById("editListing").reset();
            $('label').removeClass('active');
            displayEditNotification('success');


        },
        complete:function () {
            $(".edit_property").prop('disabled', false);
            var $this = $(this);
            $this.button('');
        },
        error: function(xhr, status, error) {
            console.log(xhr, status, error)
            //alert(xhr.responseText);
            displayEditNotification('error');
        }
    });
}

function displayNotification(notice) {
    switch (notice) {
        case 'success':
        {
            $.toast({
                heading: 'Success',
                text: 'Property has been submitted successfully.',
                showHideTransition: 'slide',
                icon: 'success',
                afterHidden: function () {
                    window.location.href = site_url+"listings";

                }
            })

        }
        break;
        case 'error':
        {
            $.toast({
                heading: 'Error',
                text: 'There seems some issue,please try again later.',
                showHideTransition: 'slide',
                icon: 'Error',
            })
        }
        break;
        default:
            $.toast({
                heading: 'Error',
                text: 'There seems some server issue,please try again later.',
                showHideTransition: 'slide',
                icon: 'Error',
            })
    }

}

function displayEditNotification(notice) {
    switch (notice) {
        case 'success':
        {
            $.toast({
                heading: 'Success',
                text: 'Property has been Updated successfully.',
                showHideTransition: 'slide',
                icon: 'success',
               afterHidden: function () {
                    window.location.href = site_url+"listings";

                }
            })

        }
        break;
        case 'error':
        {
            $.toast({
                heading: 'Error',
                text: 'There seems some issue,please try again later.',
                showHideTransition: 'slide',
                icon: 'Error',
            })
        }
        break;
        default:
            $.toast({
                heading: 'Error',
                text: 'There seems some server issue,please try again later.',
                showHideTransition: 'slide',
                icon: 'Error',
            })
    }

}


function composeTitleForProperty() {

    var title ='';
    var property_city='';
    var property_sub_area='';
    var property_landarea='';
    var property_city_area;
    var purpose = $('input[name=purpose]:checked').val();
    var property_type = $('input[name=property_type]:checked').val();
    var property_sub_type = $('input[name=property_sub_type]:checked').val();
    var city = $("#property_city option:selected").text();
    var city_area = $("#property_area option:selected").text();
    var sub_area = $("#property_sub_area option:selected").text();
    var sector_sub_area = $("#property_sub_sub_area option:selected").text();
    var unit_id = $("#unit_id option:selected").text();
    var land_area = $("#land_area").val();

    if(city_area !='Select'){ city_area = $("#property_area option:selected").text();} else { city_area = ''; }

    if(sub_area !='Select'){ sub_area = $("#property_sub_area option:selected").text(); }else{ sub_area = ''; }

    if(sector_sub_area !='Select'){ sector_sub_area = $("#property_sub_sub_area option:selected").text();}else{ sector_sub_area = ''; }

    if(purpose && !property_type && !property_sub_type){ title='';title += 'Property for ' +purpose;}
    if(purpose && property_type && !property_sub_type){title='';title += property_type +' for ' +purpose;}
    if(purpose && property_type && property_sub_type){title='';title += property_sub_type +' for ' +purpose;}

    if(unit_id && land_area){property_landarea=''; property_landarea = land_area +' '+unit_id+' ';}

    if(city){ property_city ='';property_city = ' in '+city +' ';}else{ property_city ='';}

    if(city_area){ property_city_area ='';property_city_area = ' '+city_area +' ';} else { property_city_area ='';}

    if(sub_area){ property_sub_area = '';property_sub_area = sub_area +' '; }else{ property_sub_area =''; }

    if(sector_sub_area){ sector_sub_area ='';sector_sub_area = sector_sub_area +' '; }else{ sector_sub_area =''; }

    if((purpose !== null && purpose !== '' && purpose !== undefined) || (property_type !== null && property_type !== '' && property_type !== undefined) || (property_sub_type !== null && property_sub_type !== '' && property_sub_type !== undefined) ){

       $('#property_title').val(property_landarea + title + property_city + property_city_area + property_sub_area + sector_sub_area);
    }

    if(purpose && property_type && property_sub_type)
    {
        $('.zoney_gallery').show();
        $(".dz-hidden-input").prop("disabled",false);

    }

}


jQuery(document).ready(function () {

    var val = $("input[name='property_type']:checked").val();
    console.log(val);
    if (val == 'homes') {
        $('#plots').attr('checked', false);
        $('#commercial').attr('checked', false);
        document.getElementById('house_details').style.display = 'block';
        document.getElementById('plot_details').style.display = 'none';
        document.getElementById('commercial_details').style.display = 'none';
    }

    else if (val == 'plots') {
        $('#houses').attr('checked', false);
        $('#commercial').attr('checked', false);
        document.getElementById('house_details').style.display = 'none';
        document.getElementById('plot_details').style.display = 'block';
        document.getElementById('commercial_details').style.display = 'none';
    }
    else if (val == 'commercial') {
        $('#houses').attr('checked', false);
        $('#plots').attr('checked', false);
        document.getElementById('house_details').style.display = 'none';
        document.getElementById('plot_details').style.display = 'none';
        document.getElementById('commercial_details').style.display = 'block';
    }
    else{
        document.getElementById('house_details').style.display = 'none';
        document.getElementById('plot_details').style.display = 'none';
        document.getElementById('commercial_details').style.display = 'none';
    }


});

