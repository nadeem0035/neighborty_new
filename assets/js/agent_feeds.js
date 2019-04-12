$(document).ready(function() {
    if (window.File && window.FileList && window.FileReader) {
        $("#files").on("change", function(e) {

            var files = e.target.files,
                filesLength = files.length;
            for (var i = 0; i < filesLength; i++) {
                var f = files[i]
                var fileReader = new FileReader();
                fileReader.onload = (function(e) {
                    var file = e.target;
                    $("<span class=\"pip\">" +
                        "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                        "<span class=\"remove\">x</span>" +
                        "</span>").insertAfter("#test");

                    $('.post-box').hide();
                    $('.add-image').hide();
                    $('.table').show();
                    $('#desc').show();
                    $(".post_feed_btn").prop("disabled",false);

                    $(".remove").click(function(){
                        $(this).parent(".pip").remove();
                        $('#files').val("");
                        $('.add-image').show();
                        $(".post_feed_btn").prop("disabled",true);
                    });
                });
                fileReader.readAsDataURL(f);
            }
        });
    } else {
        alert("Your browser doesn't support to File API")
    }
});


$("textarea").keyup(function() {

    var len = $(this).val().length;

    if (len != 0) {

        $(".post_feed_btn").prop("disabled",false);
    } else {
        $(".post_feed_btn").prop("disabled",true);
    }
});



$("#write_post").submit(function(e) {

    e.preventDefault();

    var url = site_url + 'feeds/submit_feed/';

    var data = $("#write_post").serialize();
    var formData = new FormData(this);

    $.ajax({
        url : url,
        type : 'post',
        data:new FormData(this),
        processData:false,
        contentType:false,
        cache:false,
        async:false,
        success: function(data) {

           location.reload();
        },
        error: function() {
            alert("Please enter valid email id!");
        }
    });
});


$(document).on("click", '.see-more', function(e) {
    //$('.post_detail').on('click', '.see-more', function(e){
   // $('.post_detail').find('a[href="#"]').on('click', function (e) {
    e.preventDefault();
    this.expand = !this.expand;
    $(this).text(this.expand?"Click to collapse":"Click to read more");
    $(this).closest('.post_detail').find('.text-seeMore, .text-seeAll').toggleClass('text-seeMore text-seeAll');
    $('.see-more').hide();

});

$('.post-box').click(function() {
    $('.table').show();
    $('#desc').show();
    $('.add-article').hide();
    $('.add-list').hide();
    $('.post-box').hide();
    $('#postFrom').show();
});




$('.follow').click( function(e){

    e.preventDefault();
    $button = $(this);
    var follow_id =  $(this).attr("id");
    var url = site_url + "feeds/following-user";
    if($button.hasClass('following')){

        $.post(url,{Unfollow:follow_id});
        $button.removeClass('following');
        $button.removeClass('unfollow');
        $button.addClass('follow');
        $button.html('+ Follow');
        var num = parseInt($('.follower_count').text());
        $('.follower_count').text(num-1);
    } else {
        $.post(url,{follow:follow_id});
        $button.removeClass('follow');
        $button.addClass('following');
        $button.text('Following');

        var num = parseInt($('.follower_count').text());
        $('.follower_count').text(num+1);
    }
});


$('.follow').hover(function(){

    $button = $(this);
    if($button.hasClass('following')){
        $button.addClass('unfollow');
        $button.text('Unfollow');
    }
}, function(){

    if($button.hasClass('following')){
        $button.removeClass('unfollow');
        $button.text('Following');
    }
});