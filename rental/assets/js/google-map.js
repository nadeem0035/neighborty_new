jQuery(document).ready(function () {
        $("#geocomplete").geocomplete({
          map: ".map_canvas",
          details: "#map_section",
          markerOptions: {
            draggable: true
          }
        });
        
        $("#geocomplete").bind("geocode:dragged", function(event, latLng){
         // $("input[name=lat]").val(latLng.lat());
        //  $("input[name=lng]").val(latLng.lng());
          $("#geocomplete").geocomplete("find", latLng.toString());
         // $("#reset").show();
        });
        
        
        $("#reset").click(function(){
          $("#geocomplete").geocomplete("resetMarker");
          $("#reset").hide();
          return false;
        });
        
        $("#find").click(function(){
          $("#geocomplete").trigger("geocode");
        }).click();
      });
