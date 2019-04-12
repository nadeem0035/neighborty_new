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

