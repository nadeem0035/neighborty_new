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

$('.slider-mini').slick({
    slidesToShow: 1,
    dots: false,
    infinite: true,
    cssEase: 'linear'
});




// jQuery(document).ready(function($) {
//     jQuery.getScript('http://www.geoplugin.net/javascript.gp', function()
//     {
//         var country = geoplugin_countryName();
//         var zone = geoplugin_region();
//         var district = geoplugin_city();
//         console.log("Your location is: " + country + ", " + zone + ", " + district);
//     });
// });




// $('#location-button').click(function(){
//
//     if (navigator.geolocation) {
//         navigator.geolocation.getCurrentPosition(function(position){
//             console.log(position);
//             $.get( "http://maps.googleapis.com/maps/api/geocode/json?latlng="+ position.coords.latitude + "," + position.coords.longitude +"&sensor=false", function(data) {
//                 console.log(data);
//             })
//             var img = new Image();
//             img.src = "https://maps.googleapis.com/maps/api/staticmap?center=" + position.coords.latitude + "," + position.coords.longitude + "&zoom=13&size=800x400&sensor=false";
//             $('#output').html(img);
//         });
//
//     }
// });



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


$(document).ready(function(){

    $(".search_results").click(function(){
        $("#mapHide").hide();
        $("#search_results").show();
        $(this).addClass("active");
        $('.search_results').removeClass("active");

    });

    $(".search_listing_map").click(function(){
        $("#search_results").hide();
        $("#mapHide").show();
        $(this).addClass("active");
        $('.search_listing_map').removeClass("active");
    });

});

$(document).ready(function() {

    // $("#search_form").validate({
    //     submitHandler: function(e) {
    //         e.preventDefault();
    //         var $form = $(form);
    //         $form.submit();
    //     },
    //     rules: {
    //         location: {
    //             required: true,
    //         },
    //     },
    //     messages: {
    //         location: {
    //             required: "Please enter location"
    //         },
    //     },
    //     errorPlacement: function(error, element) {
    //         $(element).closest('div').find('.help-block').html(error.html());
    //         $('#shakemediv').addClass('animated shake');
    //         $('#location').val("Los Angeles");
    //     },
    //     highlight: function(element) {
    //         $(element).closest('div').removeClass('has-success').addClass('has-error');
    //     },
    //     unhighlight: function(element, errorClass, validClass) {
    //         $(element).closest('div').removeClass('has-error').addClass('has-success');
    //         $(element).closest('div').find('.help-block').html('');
    //     }
    // });

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
            $('#location').val("Lahore");
        },
        highlight: function(element) {
            $(element).closest('div').removeClass('has-success').addClass('has-error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).closest('div').removeClass('has-error').addClass('has-success');
            $(element).closest('div').find('.help-block').html('');
        },
        submitHandler: function(e) {
            //  e.preventDefault();
             //console.log($("#search_form_adv").serialize());
             $.ajax({
                url: site_url + "search/results",
                type: "GET",
                data: $("#search_form_adv").serialize() + "&ajax=1",
                dataType: "html",
                success: function(data) {
                    //alert(data);
                    // console.log(data);
                    //ScrollMe('search_results');
                    $('#sorted_listings').html(data);
                    //applyPagination();
                    //loadSearchMap();
                    //applyHovers();
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
    //applyHovers();
    applyPagination();


    function getData(page){

        alert('getdata');

        var url = $(this).attr("data-href");
        var page = $(this).attr("pagination-page");
        var ajax = $(this).attr("ajax-page");
        var data = $("#form_for_ajax").serialize() + "&page=" + page + "&ajax=" + ajax;

        $.ajax({
            method: "POST",
            url: url,
            data: { page: page,ajax:1 },
            beforeSend: function(){
                //$('<?php echo $this->loading; ?>').show();
               // $("#filtered_search_results").html('')

            },
            success: function(data){

                alert(data);
                $("#filtered_search_results").html(data)
              //  $('<?php echo $this->loading; ?>').hide();
               // $('<?php echo $this->target; ?>').html(data);
            }
        });
    }


function applyPagination() {


    $(document).on("click", ".ajax_pagingsearc a", function(e) {
        e.preventDefault();
        var url = $(this).attr("data-href");
        var page = $(this).attr("pagination-page");
        var ajax = $(this).attr("ajax-page");
        var pageNo = Math.floor(Number(page));
        var is_map_view = $(this).parent().parent().parent().parent('#map-view').length;

        if(is_map_view > 0)
        {
            url = url.replace("results", "map_results");
        }

        if(!isNaN(pageNo)) {
            console.log('pagination activated');
                if (url != "current") {

                    var data = $("#search_listings").serialize() + "&page=" + page + "&ajax=" + ajax;

                    $.ajax({
                        type: "GET",
                        data: data,
                        url: url,

                        beforeSend: function () {
                            $('#search_loader').show();
                        },
                        success: function (msg) {

                            $("#rendered_resulsts").html(msg);
                            $('.map-list-loader-container').hide();
                        },

                        complete: function () {
                            if (is_map_view) {loadSearchMap(); }
                            $('#search_loader').hide();
                        },
                        error: function (jqXHR, exception) {
                            var msg = '';
                            if (jqXHR.status === 0) {
                                msg = 'Not connect.\n Verify Network.';
                            } else if (jqXHR.status == 404) {
                                msg = 'Requested page not found. [404]';
                            } else if (jqXHR.status == 500) {
                                msg = 'Internal Server Error [500].';
                            } else if (exception === 'parsererror') {
                                msg = 'Requested JSON parse failed.';
                            } else if (exception === 'timeout') {
                                msg = 'Time out error.';
                            } else if (exception === 'abort') {
                                msg = 'Ajax request aborted.';
                            } else {
                                msg = 'Uncaught Error.\n' + jqXHR.responseText;
                            }
                        },
                        timeout: 5000
                    });
                }
            }
            return false;
        });
}


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


/*    $("#contacthostform").submit(function() {
        alert('test')
        var data = $('#contacthostform').serialize();
        var url = site_url + 'Inbox/contact_agent/';
        $.ajax({
            type: "POST",
            url: url,
            data: data
        }).done(function( result) {
            if (result) {
                $("#contacthostform")[0].reset();
                $("#contact_response").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button>You successfully messaged your selected agent. Expect a response soon!</div>');
            } else {
                $("#contact_response").html('<div class="alert alert-danger"><button class="close" data-dismiss="alert"></button> Something wrong.Please try again.</div>');
            }
        });
        return false;
    });*/
});

function ratingsPlus()
{
    $(".colaprating").toggle();
}
$('.close').on('click', function () {
    $(".form").validate().resetForm();
   // $("#contacthostform")[0].reset.click();
});
function validateQuickContactForm(id) {
       $("#contacthostform_"+id).validate({
        ignore: "input[type='text']:hidden",
        rules: {
            'fullname': {required: true},
            'email': {required: true},
            'phone': {required: true},
            'message': {required: true},

        },
        errorPlacement: function(error, element){}
    });

    if ($("#contacthostform_"+id).valid() == true) {
        console.log('valid');

        var data = $('#contacthostform_'+id).serialize();
        var url = site_url + 'Inbox/quick_contact/';

        console.log(url);

        $.ajax({
            type: "POST",
            url: url,
            data: data
        }).done(function (result) {
            if (result) {
                $("#contacthostform_"+id)[0].reset();
                $("#contact_response_"+id).html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button>You successfully messaged your selected agent. Expect a response soon!</div>');
            } else {
                $("#contact_response_"+id).html('<div class="alert alert-danger"><button class="close" data-dismiss="alert"></button> Something wrong.Please try again.</div>');
            }
        });
        return false;
    }
}



function validateHostForm() {

    var $this = $(this);

    $("#contacthostform").validate({
        ignore: "input[type='text']:hidden",
        rules: {
            'fullname': {required: true},
            'email': {required: true},
            'phone': {required: true},
            'message': {required: true},
        },
        errorPlacement: function(error, element){}
    });

    if ($("#contacthostform").valid() == true) {

        console.log('valid');

        var data = $('#contacthostform').serialize();
        var url = site_url + 'Inbox/contact_agent/';

        console.log(url);

        $.ajax({
            url: url,
            type: "POST",
            data: data,
            dataType: "html",

            beforeSend: function() {

                $(".email_to_agent").button('loading');

            },
            success: function(result) {
                if (result) {
                    $("#contacthostform")[0].reset();
                    $("#contact_response").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button>You successfully messaged your selected agent. Expect a response soon!</div>');
                } else {
                    $("#contact_response").html('<div class="alert alert-danger"><button class="close" data-dismiss="alert"></button> Something wrong.Please try again.</div>');
                }
            },
            complete:function()
            {
                $('.email_to_agent').button('reset');
                $(".email_to_agent").prop('onclick', null);
            },
            error: function(xhr) {

                // btn.prop('disabled',false);
                alert("Error occured.please try again");
            }
        });
    }
}






function ScrollMe(id) {
    var offset = $("#" + id).offset().top - 50;
    $('html,body').animate({
        scrollTop: offset
    }, 'slow');
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
function  loadWishtlistModel(listing_id){

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

       // ignore: [],
        rules: {
            note_text: {required: true},
            create: {
                    required: $('.checkbox').not(':checked')
                },
            'wishlist_category[]': { required: true},
        },
        errorPlacement: function(error, element) {
            $('#note_text').css("border"," 1px solid red");
            if($("#create").val() == ''){
                $('.error_msgs').show();
            } else{
                $('.error_msg').show();
            }

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

                    if(result) {

                        $('.notice').html('<div  class="alert alert-success"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Your wishlist has been saved successfully </div>');
                        window.setTimeout(function () {
                            location.reload()
                        }, 3000)
                    }else{
                        $('.notice').html('<div  class="alert alert-danger"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Sorry ! something went wrong,try again </div>');
                    }


                    //$('#wishlistModal').modal('hide');
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
            }
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
$('#user_city').on('change',function(){

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
            $('select[name="user_area"]').empty();


        },
        success: function (data) {

            console.log(data.length);
            if(data.length > 0){
                $('select[name="user_area"]').empty().append('<option selected="selected" value="">Select</option>');
                $('.user_area').show();
                $.each(data, function(key, value) {
                    $('select[name="user_area"]').append('<option value="'+ value.id +'">'+ value.area_name +'</option>');
                });
            }
        },
        complete:function () {
            $('#page-loading').hide();
        }
    });
}










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

        $('#wishlist_response_'+id).html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button>Note updated successfully!</div>');
        setTimeout(function() {
            $('#wishlist_response_'+id).fadeOut('fast');
        }, 1000);

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
        }
    });
}



$(document).ready(function() {

    // $(window).keydown(function(event){
    //     if(event.keyCode == 13) {
    //         $(".search_submit").attr("disabled", true);
    //         event.preventDefault();
    //         return false;
    //     }
    // });






});

$('#search_listing_form .term').bind('input', function(){
    $('#search_listing_form').submit();
})

$('.search_submit').click(function(){
    var p_type = [];
    $('input.chk:checkbox:checked').each(function () {
        p_type.push($(this).val());
    });
    if(p_type == ''){
        $(".rent").removeClass("active");
        $(".sale").removeClass("active");
        $(".all").addClass("active");
    }
    if(p_type.length == 2){
        $(".rent").removeClass("active");
        $(".sale").removeClass("active");
        $(".all").addClass("active");
    }
    if(p_type[0] == 'sale' && p_type[1] !== 'rent' ){
        $(".all").removeClass("active");
        $(".rent").removeClass("active");
        $(".sale").addClass("active");
    }
    if(p_type[0] == 'rent'){
        $(".all").removeClass("active");
        $(".sale").removeClass("active");
        $(".rent").addClass("active");
    }
});

$('#property_type').on('change', function(){
    var selected = $(this).val();
    $('#flag').val(selected);
});

function if_home_type_is_changed() {

    //console.log('if_hometype_is_changed');

    var hometype = ($('#type').val());
    console.log(hometype);


    if(hometype == 'plots' || hometype == 'commercial'){
        $('.bathrooms').hide();
        $('.bedrooms').hide();
        $('.beds').hide();

    }else{

        $('.bathrooms').show();
        $('.bedrooms').show();
        $('.beds').show();

    }
}


function if_value_is_changed() {

    console.log('if_value_is_changed');

    var city = ($('#search_city').val());

    console.log(city +'city');

    if(city){

        $(".search_submit").attr("disabled", false);
        city_areas(city);
    }else{
        $(".search_submit").attr("disabled", true);
    }
}


function city_areas(id)
{

    var url = site_url + 'city-areas';
    $.ajax({
        type: "POST",
        url: url,
        data: {id:id},
        dataType:'json',
        beforeSend:function()
        {
            $('#area-id').val('');
            $("#areas").prop("readonly", true);


        },
        success: function (data) {


            $("#areas").prop("readonly", false);
            $( "#areas" ).autocomplete({


                source: function(req, response) {
                    var re = $.ui.autocomplete.escapeRegex(req.term);


                    var matcher = new RegExp("^" + re, "i");
                    response($.grep(data, function(item) {
                        return matcher.test(item.value);
                    }));
                },
                select: function(event, ui) {
                  //  $("#area-id").html(ui.item ? "Selected: " + ui.item.value + ", geonameId: " + ui.item.id : "Nothing selected, input was " + this.value);
                    $('#area-id').val(ui.item.id);
                }


                // source: function( request, response ) {
                //     var matches = $.map( acList, function(acItem) {
                //
                //         console.log(acItem);
                //         if ( acItem.toUpperCase().indexOf(request.term.toUpperCase()) === 0 ) {
                //             return acItem;
                //         }
                //     });
                //     response(matches);
                // },


              //  source: data,
               // maxShowItems:10,
               //  select: function( event, ui ) {
               //      $('#area-id').val(ui.item.id);
               //  }
            });
        },
        complete:function () {

        }
    });
}





function getProperty(anchorLink,ptype,id){

    $(".navTabs li").removeClass("active");
    $(anchorLink).addClass("active");
    $(anchorLink).closest('li').addClass('active');

    if(ptype == 'all'){

        $('#search_map').show();
        $('#select_all').show();
        $('#sold_map').hide();
        $('#rent_map').hide();
        $('#sale_map').hide();
        $('#select_sale').hide();
        $('#select_rent').hide();
        $('#select_sold').hide();

    }

    if(ptype == 'sale'){

       /* $('#search_map').hide();
        $('#sold_map').hide();
        $('#rent_map').hide();
        $('#sale_map').show();*/
        $('#select_sale').show();
        $('#select_rent').hide();
        $('#select_sold').hide();
        $('#select_all').hide();

    }


    if(ptype == 'rent'){

        /*$('#search_map').hide();
        $('#sold_map').hide();
        $('#rent_map').show();*/
        $('#select_rent').show();
        $('#sale_map').hide();
        $('#select_sale').hide();
        $('#select_sold').hide();
        $('#select_all').hide();
    }

    if(ptype == 'sold'){

        /*$('#search_map').hide();
        $('#sold_map').show();
        $('#rent_map').hide();*/
        $('#select_rent').hide();
        $('#sale_map').hide();
        $('#select_sale').hide();
        $('#select_sold').show();
        $('#select_all').hide();
    }


}

$("#search_listing_form").submit(function(e) {


    var form = $(this);
    var url = form.attr('action');

    $.ajax({
        type: "POST",
        url: url,
        data: form.serialize(),
        success: function(data)
        {
            $('#rendered_resulsts').html(data);
        },
        complete:function () {

            locations ='';
            $('#total_count').html( $('#count_records').text());

            if($("#repid").text() != ''){

                locations = JSON.parse($("#repid").text());
                //console.log(locations);
                $("#repid").html('');
                clearMarkers();
                composeMarkers(locations);

                console.log('akjsdfh')
            }
            else{

                clearMarkers();
                var lat = $("#lat").val();
                var lng = $("#lng").val();

                map.setCenter(new google.maps.LatLng(lat, lng));
                map.setZoom(9);

            }

        }
    });

    e.preventDefault();
})



/** Load Page Date */

$(function(){
        $('#sidebar_nav li a').on('click', function(){
            var url = site_url + 'pages/load_page_data/';
            var slug = $(this).attr("id");
          //  console.log(slug);
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
        // Sort By Agents Properties
        $('#sort_agents').change(function () {
            var sorttype =$(this).val();
            var agent_id = $('#agent_id').val();
            var type = $('#type').val();
            var url = site_url + 'agents/detail/';
            $.ajax({
                type: "POST",
                cache: false,
                url: url,
                data: {sorttype:sorttype,agent_id:agent_id,type:type},
                async:false,
                success: function(result) {
                    if (result) {
                        $('.property-listing').html(result);
                        $('[data-toggle="tooltip"]').tooltip();
                        var tip_action = $('.actions li');
                        tip_action.on('click',function(){
                            var tip_this = $(this);
                            if(tip_this.children('.share_tooltip').hasClass('in')){
                                tip_this.children('.share_tooltip').removeClass('in');
                            }else{
                                tip_action.children('.share_tooltip').removeClass('in');
                                tip_this.children('.share_tooltip').addClass('in');
                            }
                        });
                    }
                },
            });
        });

        //Sort Agent Properties
        $('#sort_agent_properties').change(function () {
            var sorttype =$(this).val();
            var agent_id = $('#agent_id').val();
            var ptype = $(".property_tabs li a.active").attr('id');
            var url = site_url + 'agents/detail/';
            $.ajax({
                type: "POST",
                cache: false,
                url: url,
                data: {sorttype:sorttype,agent_id:agent_id,ptype:ptype},
                async:false,
                beforeSend: function(){
                    $("#loading").show();
                },
                complete: function(){
                    $("#loading").hide();
                },
                success: function(result) {
                    $('#search_partial').html(result);
                    if (result) {
                        $('#agent_properties').html(result);
                      //  $('.property-listing').html(result);
                      $('[data-toggle="tooltip"]').tooltip();
                      var tip_action = $('.actions li');
                      tip_action.on('click',function(){
                        var tip_this = $(this);
                        if(tip_this.children('.share_tooltip').hasClass('in')){
                            tip_this.children('.share_tooltip').removeClass('in');
                        }else{
                            tip_action.children('.share_tooltip').removeClass('in');
                            tip_this.children('.share_tooltip').addClass('in');
                        }
                    });
                  }
              },
          });
        });
    });


function advertise() {


    $('#advertise_form').validate({
        rules: {
            name: {
                minlength: 2,
                required: true
            },
            email: {
                required: true,
                email: true
            },
            message: {
                minlength: 2,
                required: true
            }
        },
        errorPlacement: function(error, element) {
            // Override error placement to not show error messages beside elements //
        },
        highlight: function (element) {
            $(element).closest('div').removeClass('has-success').addClass('has-error');
        },

        success: function (element) {
            element.text('OK!').addClass('valid')
                .closest('div').removeClass('has-error').addClass('has-success');

        },
        submitHandler: function (form) {

            saveRequest(event);

        }
    });
}



function premiumListingRequest() {


    $('#listing_request_form').validate({
        rules: {package: { required: true}, message: {required: true }},
        errorPlacement: function(error, element) {
            // Override error placement to not show error messages beside elements //
        },
        highlight: function (element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },

        success: function (element) {
            console.log('success');
           // $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
            element.text('OK!').addClass('valid').closest('.form-group').removeClass('has-error').addClass('has-success');

        },
        submitHandler: function (form) {

            savePremiumListingRequest(event);

        }
    });
}


function savePremiumListingRequest(event){

    event.preventDefault();

    var data = $('#listing_request_form').serialize();
    var txt = 'Premium Listing Request sent successfully'

    $.ajax({
        url: site_url+'premium-listing-request',
        type: 'POST',
        dataType:'json',
        data: data,

        beforeSend:function()
        {
            $(".advertise_btn").prop('disabled', true);
            var $this = $(this);
            $this.button('loading');

        },
        success: function(response) {

            document.getElementById("listing_request_form").reset();
            displayToast('success',txt);

        },
        complete:function () {
            $(".modal.in").modal("hide");
            $(".advertise_btn").prop('disabled', false);

        },
        error: function(xhr, status, error) {
            console.log(xhr, status, error)

            displayToast('error');
        }
    });
}


function displayToast(notice,txt=null) {
    switch (notice) {
        case 'success':
        {
            $.toast({
                heading: 'Success',
                text: txt,
                showHideTransition: 'slide',
                icon: 'success',

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

$(function () {
    $('#requestModel').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var code = button.data('id');
        var modal = $(this);
        modal.find('#listing_id').val(code);
    });
});


function saveRequest(event){

    event.preventDefault();

    var data = $('#advertise_form').serialize();
    var txt = 'Ad request submitted successfully';
    $.ajax({
        url: site_url+'save-advertisement-request',
        type: 'POST',
        dataType:'json',
        data: data,

        beforeSend:function()
        {
            $(".advertise_btn").prop('disabled', true);
            var $this = $(this);
            $this.button('loading');

        },
        success: function(response) {

            document.getElementById("advertise_form").reset();
            displayToast('success',txt);

        },
        complete:function () {
            $(".modal.in").modal("hide");
            $(".advertise_btn").prop('disabled', false);

        },
        error: function(xhr, status, error) {
            console.log(xhr, status, error)

            displayToast('error');
        }
    });
}


function applyProperty() {

    $("#apply_property").validate({
        rules: {
            note_text: {
                required: true
            },
            is_check: {
                required: true
            }
        },
        messages: {
            note_text: {
                required: "Please enter note"
            },
            is_check: {
                required: "Please confirm your  Application is complated."
            }
        },
        errorPlacement: function(error, element) {
            $(element).closest('div').find('.help-block').html(error.html());
            $('.submit-host-textbar').addClass('animated shake');

        },
        highlight: function(element) {
            $(element).closest('div').removeClass('has-success').addClass('has-error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).closest('div').removeClass('has-error').addClass('has-success');
            $(element).closest('div').find('.help-block').html('');
        },
        submitHandler: function(e) {

             var url = site_url + 'agents/ApplyProperty/';
             var data = $('#apply_property').serialize();

                $.ajax({
                    type: "POST",
                   // cache: false,
                    url: url,
                    data: data,
                  //  async: false,

                   beforeSend: function() {

                      $(".apply_property_class").button('loading');

                   },

                   success: function (result) {

                        if (result ==1 )
                        {
                           $('#apply_property')[0].reset();
                           $(".alert").html('<p>Application sent successfully</p>');
                           $('.alert').show();

                            $(".apply_property_class").prop('onclick', null);
                            $(".apply_property_class").html('Applied');

                        }
                        else if(result == 0){
                            $(".alert").html('<p>Youy have already applied this listing</p>');
                        }
                        else{
                            $(".alert").html('<p>Something wrong! Please try again</p>');

                        }

                   },
                   error: function(xhr) {

                         alert("Error occured.please try again");
                   }


                });

         }
    });
}

function view_phone(id) {

    console.log(id);
    var $this = $(this);

    $.ajax({
        url: site_url + "agents/showPhoneNumber",
        type: "POST",
        data: {id:id},
        dataType: "html",

        beforeSend: function() {

            $(".view_phone_no").button('loading');

             // btn.prop('disable', true);

        },
        success: function(result) {
             //$this.button('reset');
            $('.view_phone_no').fadeOut(1000);
            $(".view_phone_no").button('reset');
            $(".phoneno").html(result);
           $(".view_phone_no").prop('onclick', null);

        },
        error: function(xhr) {

             //btn.prop('disable',false);
            alert("Error occured.please try again");
        }
    });
}

function contactAgent() {
    $("#contact_agent").validate({
        rules: {
            poster_name: {
                required: true
            },
            poster_email: {
                required: true
            },
            poster_phone: {
                required: true
            },
            reason_to_contact: {
                required: true
            },
            message: {
                required: true
            },
        },
        messages: {
            poster_name: {
                required: "Please enter your full name"
            },
            poster_email: {
                required: "Please enter your email"
            },
            poster_phone: {
                required: "Please enter your phone"
            },
            reason_to_contact: {
                required: "Please select your reason to contact"
            },
            note_text: {
                required: "Please enter your message"
            }
        },
        errorPlacement: function(error, element) {
            $(element).closest('div').find('.help-block').html(error.html());
            $('.submit-host-textbar').addClass('animated shake');

        },
        highlight: function(element) {
            $(element).closest('div').removeClass('has-success').addClass('has-error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).closest('div').removeClass('has-error').addClass('has-success');
            $(element).closest('div').find('.help-block').html('');
        },
        submitHandler: function(e) {

            var url = site_url + 'agents/contant_agent/';
            var data = $('#contact_agent').serialize();

            $.ajax({
                type: "POST",
                // cache: false,
                url: url,
                data: data,
                //  async: false,

                beforeSend: function() {

                    $(".apply_property_class").button('loading');
                    $(".btn_cancel").prop('onclick', null);

                },

                success: function (result) {



                    if (result == 'sent' )
                    {
                        $('#contact_agent')[0].reset();
                        $(".alert").html('Massage has been sent successfully.');
                        $('.alert').show();
                        $('#contact_agent').hide();

                        $(".apply_property_class").prop('onclick', null);
                        $(".apply_property_class").html('Send');

                    }

                    else{
                        $(".alert").html('<p>Something wrong! Please try again</p>');

                    }

                },
                error: function(xhr) {

                    alert("Error occured.please try again");
                }


            });

        }
    });

}

function add_reviews() {

    $("#AddReviews").validate({
        ignore: "input[type='text']:hidden",
        rules: {
            'reviews[review]': {required: true},
            'reviews[service_provided]': {required: true},
            'reviews[service_years]': {required: true},
            'reviews[address]': {required: true},
            'chkb': {
                required: true
            }
        },

        messages: {

            'chkb': {
                required: "Please certify the truth of this review."
            }

        },
        errorPlacement: function (error, element) {
            $('.rateCat').css("border", " 1px solid red");
            if (element.attr("name") == "chkb") {
                error.insertAfter($('#register_chkb_error'));
            }
        },




    });

    if ($("#AddReviews").valid() == true) {
        $('.rateCat').css("border", "none");
        var url = site_url + 'agents/AddReviews/';
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
                    $("#AddReviews").html('<h3>Some thing wrong! Please try again</h3>');
                }
            }
        });
    }
}

function sendCountryToAjax(country) {
    var url = site_url + 'listings/detect_listing_location/';

    var price;
    var mnt;
    $.ajax({
        type: "POST",
        cache: false,
        data:{ country:country},
        url: url,
        async:false,
        success: function(result) {

             price = result.split(',')[0];
             mnt = result.split(',')[1];

            $('#price').attr("placeholder", "Price in Rs");
            $('#sqrft').attr("placeholder", "Area in " + mnt);

            $("#currency_type").val(price);
            $("#measurement_type").val(mnt);

           console.log(price + mnt);
        }
    });


}

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
  // Share posts on social media popup
var popupSize = {
    width: 780,
    height: 550
};


/* ------------------------------------------------------------------------ */


/** Add Appointments **/

$("#add_appointment").submit(function() {
    var time_to = jQuery('input[name="time_to"]').val();
    var time_from = jQuery('input[name="time_from"]').val();
    var currentDate = new Date();
    var theDate = (currentDate.getMonth() + 1) + '/' + currentDate.getDate() + '/' + currentDate.getFullYear();
    var timeStart = new Date(theDate + ' ' + time_from).getHours();
    var timeEnd = new Date(theDate  + ' ' + time_to).getHours();
    //Calulate the time difference
    var hourDiff = timeEnd - timeStart;
    if (hourDiff > 1) {
        var data = $('#add_appointment').serialize();
        var url = site_url + 'appointments/add_availability/';
        $.ajax({
            type: "POST",
            url: url,
            data: data
        }).done(function (result) {
            if (result) {
                $(".availability_form")[0].reset();
                $("#response").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button> Your appointments has been added successfully!</div>');
                setTimeout(function () {
                    location.reload();
                }, 3000);
            } else {
                $("#response").html('<div class="alert alert-danger"><button class="close" data-dismiss="alert"></button> Whoops! something wrong,try again later.</div>');
            }
        });

     }else{
         $("#timeres").html('<div class="alert alert-danger"><button class="close" data-dismiss="alert"></button>minimum time should be One hour</div>');
         $("#timeres").fadeOut(2000);
     }
     return false;

});

/** Set Appointment **/

$("#set_appointment").submit(function() {

    var data = $('#set_appointment').serialize();
    var url = site_url + 'appointments/set_appointment/';
    $.ajax({
        type: "POST",
        url: url,
        data: data
    }).done(function( result) {
        if (result) {
            $("#set_appointment")[0].reset();
            $("#responsemessage").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button> Your appointments has been set successfully!</div>');
        } else {
            $("#responsemessage").html('<div class="alert alert-danger"><button class="close" data-dismiss="alert"></button> Whoops! something wrong,try again later.</div>');
        }
    });
    return false;
});

$(document).ready(function(){


    $('#current_living').change(function(){
        if(this.checked)
            $('#prev_res').show();
        else
            $('#prev_res').hide();

    });

    $('#location').blur(function () {
        $(this).val(
            $.trim($(this).val())
        );
    });

});

function validate_search_form() {

    $("#search_form").validate({
        submitHandler: function (e) {

            $("input").each(function(index, obj){
                if($(obj).val() == "") {
                    $(obj).remove();
                }
            });


          //  e.preventDefault();
            var $form = $(form);
            $form.submit();
        },
        rules: {
            location: {
                required: {
                    depends:function(){
                        $(this).val($.trim($(this).val()));
                        return true;
                    }
                },
                location: true
            }

        },
        messages: {
            location: {
                required: "Please select a valid address based on our suggestions"
            }
        },
        errorPlacement: function (error, element) {
            $(element).closest('div').find('.help-block').html(error.html());
            $('#shakemediv').addClass('animated shake');
           // $('#location').val("Los Angeles, CA, United States");
        },
        highlight: function (element) {
            $(element).closest('div').removeClass('has-success').addClass('has-error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).closest('div').removeClass('has-error').addClass('has-success');
            $(element).closest('div').find('.help-block').html('');
        }
    });
}

$('#agent_search').click(function(e) {

        e.preventDefault();
        var btn = $(this);
        $.ajax({
            url: site_url + "agents/searchByFilters",
            type: "POST",
            data: $("#agent_search_form").serialize(),
            dataType: "html",

            beforeSend: function() {
                $('.ajax-loader_icon').show();
                btn.prop('disabled', true);

            },
            success: function(result) {
                $('.ajax-loader_icon').hide();
                $('#content-area').html(result);
                btn.prop('disabled',false);

            },
            error: function(xhr) {

                btn.prop('disabled',false);
                alert("Error occured.please try again");
            }
        });
});

$('.agent_contact_info').click(function(e) {

    console.log('agent_info');

    e.preventDefault();

    var btn = $(this);
    var id = btn.attr('id');

    $.ajax({
        url: site_url + "agents/update_topup_balance",
        type: "POST",
        data: {id:id},
        dataType: "html",

        beforeSend: function() {

            btn.prop('disabled', true);

        },
        success: function(result) {
            if(result < 5){
                $("#agentInfo").modal('show');
            }
            else{
                $("#companyInfo").modal('show');
            }

            btn.prop('disabled',false);

        },
        error: function(xhr) {

            btn.prop('disabled',false);
            alert("Error occured.please try again");
        }
    });
});




// ======================== START TAB FUNCTION LISTS =========================//



// $(document).ready(function(){
//     setTimeout(function() {
//
//         $(".som-cl").trigger('click');
//         $('#search_form').attr('action', site_url+'agents/searchByFilters');
//     },5);
//
// });




var count = 0;


$('li').click(function(e){


    $('input[placeholder], textarea[placeholder]').blur();
    var k = $(this).attr('id');
    $('#looking_for').attr('value', k);

    if (k == 'rent') {
        $("#location").attr("placeholder", "Localisation").blur();
    }
    else if (k == 'sell') {
        $("#location").attr("placeholder", "Localisation").blur();
    }
    else if (k == 'any') {
        $("#location").attr("placeholder", "Localisation").blur();

    }
});

$('.agent_tab_swticher').click(function(e){

    var search_type = $(this).attr('id');
    console.log(search_type);

    e.preventDefault();
    e.stopPropagation();
    $('.za-track-event').removeClass('za-track-event').addClass('search-tab');
    $(this).addClass('za-track-event').removeClass('search-tab');


});

$('.tab_swticher').change(function(e){



    //count += 1;

    var search_type = $(this).val();
    console.log(search_type);

    //if(count > 1){

        if(search_type == 'any'){
           // $('.splash-inner-media').css("background-image", "url("+site_url+"assets/img/landing-bedroom.jpg)");

            $('#search_form').attr('action', site_url+'search');
        }else{
           // $('.splash-inner-media').css("background-image", "url("+site_url+"assets/img/landing-img.jpg)");
            $('#search_form').attr('action', site_url+'agents/searchByFilters');
        }



   // }

    e.preventDefault();
    e.stopPropagation();
    $('.za-track-event').removeClass('za-track-event').addClass('search-tab');
    $(this).addClass('za-track-event').removeClass('search-tab');


});

// ========================== END TAB FUNCTION LISTS =========================//

function IfQuickContactForm() {
    $('#msg_responce')
        .show()
        .html('<div  class="alert alert-danger"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>You must be logged in to Send the Message.</div>');
    // $('#msg_responce').fadeOut(2000);


}

function validatelatlon() {


    setTimeout(function() {

        $('#warning').html('');
        var lat = document.getElementById("lat").value;
        var lng = document.getElementById('lng').value;

        console.log(lat + lng);

        var regex = new RegExp("^-?([1-8]?[1-9]|[1-9]0)\.{1}\d{1,6}");

        if (lat < -90 || lat > 90) {

            $('#geocomplete').val('');
            $('#route').val('');
            $('#street_address').val('');
            $('#locality').val('');
            $('#administrative_area_level_1').val('');
            $('#postal_code').val('');
            $('#country').val('');

            $('#warning').html('<span class="alert alert-warning" style="display: block;margin-bottom: 0">Invalid Location address,please add valid location.</span>');

        }
        else if (lng < -180 || lng > 180) {
            $('#warning').html('<span class="alert alert-warning" style="display: block;margin-bottom: 0">Invalid Location address,please add valid location.</span>');
        }
        else if (lat == "" || lng == "") {
            $('#warning').html('<span class="alert alert-warning" style="display: block;margin-bottom: 0">Invalid Location address,please add valid location.</span>');
        }

    },500);




}

function view_application(title,dataURL) {

        $("#model_title").empty();
        $("#model_title").html(title);
        $("#pop-viewApp").modal({show:true});
        $("#loaded_data").load( dataURL );
        $("div.apply_tab").each(function()
        {
            $(this).removeClass("in");
            $(this).removeClass("active");
        });
        $(".login-tabs li").each(function()
        {
            $(this).removeClass("active");
            $(".login-tabs li#about_me").addClass("active");
        });


}




function varify()
{
    $(".verify").attr("disabled","disabled");
    $(".resend-code").attr("disabled","disabled");
    $.ajax({
        type: "POST",
        url: site_url + "confirm",
        data:{code: $("#code").val()},
        success: function(data){
            {
                if(data == 'success'){

                    window.location = site_url +"login";

                }else{
                    $('#not_validated').show();
                    $('#not_validated').html(data);
                }

            }
            $(".verify").removeAttr("disabled");
            $(".resend-code").removeAttr("disabled");
        }
    });

}
function cahnge_value_read_more() {

    var read_text = ($('#readmore').text());
    if(read_text == 'Read More »'){
        $('#readmore').text('Read Less »');
    } else {
        $('#readmore').text('Read More »');
    }


}


function reSendCode()
{


    $(".verify").attr("disabled","disabled");
    $(".resend-code").attr("disabled","disabled");
    $.ajax({
        type: "POST",
        url: site_url + "resend-code",
        dataType: "json",
        data:{ },
        success: function(data){

            if(data.res == 'success'){

                $('.notice').html('<div class="alert warn alert-warning">'+data.msg+'</div>')
            }
            else {

                $('.notice').html('<div class="alert warn alert-warning">'+data.msg+'</div>')
            }

            $(".verify").removeAttr("disabled");
            $(".resend-code").removeAttr("disabled");
        }
    });


}










