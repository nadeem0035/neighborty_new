$("#togglebtn").change(function(){
    if ($('#togglebtn:checkbox:checked').length > 0) {
        
        $('.footer-v2').hide();
        showMapview();
    }
    else {

        showListview();
        $('.footer-v2').show();
    }
})

function showMapview()
{
    var url = site_url + 'search-with-map';


    var data = $('#search_listings').serialize()+ "&ajax=1" ;

    $.ajax({
        type: "POST",
        url: url,
        data: data,
       // dataType:'json',
        beforeSend:function()
        {
            $('#togglebtn').prop('disabled',true);

        },
        success: function (data) {


            $('#search_results').html(data);
            $(window).resize();

            $('#togglebtn').prop('disabled',false);

        },
        complete:function () {
            loadSearchMap();
            //$('#page-loading').hide();
        }
    });
}

function showListview() {
    var url = site_url + 'search';


    var data = $('#search_listings').serialize()+ "&ajax=1" ;

    $.ajax({
        type: "POST",
        url: url,
        data: data,
        // dataType:'json',
        beforeSend:function()
        {

        },
        success: function (data) {


            $('#search_results').html('<div id="search_items"><div class="houzez-module padding-top-10"><div class="list-grid-area"><div id="content-area"> <div id="filtered_search_results"> <div id="agent_properties">' +
                '<div class="" id="rendered_resulsts">'+data+'</div></div></div></div></div></div>');
            $(window).resize();
            loadSearchMap();

        },
        complete:function () {
            //$('#page-loading').hide();
        }
    });
}


//Sort Search Results
$(document).on("change", "#sort_properties", function(e) {


    e.preventDefault();
    var sort_type = $(this).val();
    //sortForm
    var data = $('#search_listings').serialize()+ "&ajax=1" + "&sort_type="+sort_type;
    var url = site_url + 'search/index/';
    $.ajax({
        type: "POST",
        cache: false,
        url: url,
        data: data,
        async:false,
        beforeSend: function(){
            $("#search_loader").show();
        },
        complete: function(){
            $("#search_loader").hide();
        },
        success: function(result) {

            if (result) {
                $('#rendered_resulsts').html(result);
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
        }
    });

});

// $(document).on("click", ".ajax_pagingsearc a", function(e) {
//     e.preventDefault();
//     var url = $(this).attr("data-href");
//     var page = $(this).attr("pagination-page");
//     var ajax = $(this).attr("ajax-page");
//     var pageNo = Math.floor(Number(page));
//
//     if(!isNaN(pageNo)) {
//         console.log('pagination activated12312');
//         if (url != "current") {
//             var data = $("#search_listings").serialize() + "&page=" + page + "&ajax=" + ajax;
//
//           //  console.log(data)
//             $.ajax({
//                 type: "GET",
//                 data: data,
//                 url: url,
//
//                 beforeSend: function () {
//                     $('#search_loader').show();
//                 },
//                 success: function (msg) {
//                     $("#rendered_resulsts").html(msg);
//                     $('.map-list-loader-container').hide();
//
//
//                 },
//
//                 complete: function () {
//                     $('#search_loader').hide();
//                     loadSearchMap();
//                 },
//                 error: function (jqXHR, exception) {
//
//                     //alert(jqXHR.status);
//
//                     var msg = '';
//                     if (jqXHR.status === 0) {
//                         msg = 'Not connect.\n Verify Network.';
//                     } else if (jqXHR.status == 404) {
//                         msg = 'Requested page not found. [404]';
//                     } else if (jqXHR.status == 500) {
//                         msg = 'Internal Server Error [500].';
//                     } else if (exception === 'parsererror') {
//                         msg = 'Requested JSON parse failed.';
//                     } else if (exception === 'timeout') {
//                         msg = 'Time out error.';
//                     } else if (exception === 'abort') {
//                         msg = 'Ajax request aborted.';
//                     } else {
//                         msg = 'Uncaught Error.\n' + jqXHR.responseText;
//                     }
//                 },
//                 timeout: 5000
//             });
//
//
//         }
//     }
//     return false;
// });

function filterProperties(anchorLink,ptype){

    //console.log(anchorLink+ptype);

   // var view_type = $('.page_view').val();

    // if(view_type == 'list')
    // {
    //
    //     $(".btn-grid").removeClass('active');
    //     $(".btn-list").addClass('active');
    //
    // }else{
    //
    //
    //     $(".btn-grid").addClass('active');
    //     $(".btn-list").removeClass('active');
    // }

    $(".btn-link").removeClass("active");
    $(anchorLink).addClass("active");

    if(ptype =='any'){
        $('#sort_list_type').val('');
        $("#sort_lisitng_type").val('any');
        $('#view_property').val('any');
    }
    else if(ptype =='rent'){
        $('#sort_list_type').val('rent');
        $("#sort_lisitng_type").val('rent');
        $('#view_property').val('rent');

    }
    else{
        $('#sort_list_type').val('sale');
        $("#sort_lisitng_type").val('sale');
        $('#view_property').val('sale');

    }
    var data = $('#search_listings').serialize()+ "&ajax=" + 1 + "&property_type=" + ptype;
    var url = site_url + 'search/index/';

    $.ajax({
        type: "POST",
        cache: false,
        url: url,
        data:data,
        beforeSend: function(){
            $("#search_loader").show();
        },
        success: function(result) {
            $("#search_loader").hide();
            if (result) {

                $('#rendered_resulsts').html(result);
            }

        },
        complete:function () {
            locations ='';
            $('#total_count').html( $('#count_records').text());
           // locations = JSON.parse($("#repid").text());
         //    $("#repid").html('');

           // console.log(locations);

            //clearMarkers();
            //composeMarkers(locations);
        }
    });
}

