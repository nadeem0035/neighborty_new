function deleteListingByUser(id){
    var url = site_url + 'listings/check_listing_booking_status';
    var data = { listing_id   :id };
    $.ajax({
        type: "POST",
        cache: false,
        url: url,
        data: data,
        async: false,
        dataType:'json',
        success: function(result) {
            if(result.res =='failure'){
                var str ="You can not delete this listing as it is already booked by Host till";
                var str1 = result.checkout;
                var result = str +" "+ str1;
                $('#display_notices').html('<div  class="alert alert-danger"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>'+result+'</div>');
            }
            else if(result.success == 'success'){
                $("#booking_row_"+id).remove();
                $('#display_notices').html('<div  class="alert alert-success"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Your listing has been deleted successfully </div>');
                window.setTimeout(function(){location.reload()},3000);
            }else{
                $('#display_notices').html('<div  class="alert alert-danger"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button> Your listing could not be deleted,Try again later </div>');

            }
        },
    });
}

function listing_avail(){
    $('#listing_response').html('<div  class="alert alert-danger"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Your package has been expired, Please upgrade your package. </div>');
    $("#listing_response").fadeOut(3000);
}


function remove_listing_by_user_id(id)
{
    if(confirm('Are you sure you want to delete?')) {
        var url = site_url + 'listings/remove_listing';
        var data = {listing_id: id};
        $.ajax({
            type: "POST",
            cache: false,
            url: url,
            data: data,
            async: false,
            //dataType:'json',
            success: function (result) {

                if (result == 'unauthorized') {
                    var str = "You are not authorized to do this action";
                    $('#display_notices').html('<div  class="alert alert-danger"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>' + str + '</div>');
                }
                else if (result == 'success') {
                    $("#booking_row_" + id).remove();
                    $('#display_notices').html('<div  class="alert alert-success"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Your listing has been deleted successfully </div>');
                    window.setTimeout(function () {
                        location.reload()
                    }, 3000);
                } else {
                    $('#display_notices').html('<div  class="alert alert-danger"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button> Your listing could not be deleted,Try again later </div>');

                }
            },
        });
    }

}
