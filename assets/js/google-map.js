jQuery(document).ready(function ()
{

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

  $("#geocomplete").bind("geocode:dragged", function(event, latLng)
  {
    // alert('sdfdsfsdfsd');
    $("input[name=lat]").val(latLng.lat());
    $("input[name=lng]").val(latLng.lng());
    // $("#geocomplete").geocomplete( "find", latLng.toString() );

    $.ajax({
      type: 'post',
      dataType: "jsonp",
      crossdomain: true,
      url: 'https://maps.googleapis.com/maps/api/geocode/json',
      data: {
        key: 'AIzaSyCEKsF0Pz8vV9Th4F2rjc6lgrSYBzwQkbw',
        latlng: latLng.lat() + "," + latLng.lng()
      },
      success: function (json)
      {
        alert(json);
        //show on page
      },
      async: false,
      error: function ()
      {
         console.log()
      }
    });

    $("#geocomplete").geocomplete("find", latLng.lat() + "," + latLng.lng() );
    // $("#reset").show();
  });

  $("#reset").click(function()
  {
    $("#geocomplete").geocomplete("resetMarker");
    $("#reset").hide();
    return false;
  });

  $("#find").click(function()
  {
    $("#geocomplete").trigger("geocode");
  }).click();



});
