jQuery(document).ready(function ($)
{

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

    $("#preview_file").change(function ()
    {
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

            var formUrl = site_url + 'listings/listing_preview_image_upload';
            var formData = new FormData($('#save_preview')[0]);
            $.ajax({
                url: formUrl,
                type: 'POST',
                data: formData,
                mimeType: "multipart/form-data",
                contentType: false,
                // contentType: "application/json",
                cache: false,
                processData: false,
                dataType: 'json',

                beforeSend: function() {
                    $('.upload_btn').hide();
                    $('#listing_response').html('');
                },

                success: function (data, textSatus, jqXHR) {

                    if (data.msg == 'success') {
                        $("#listing_response").html('<div class="text-left" style="color: #3c763d"><button class="close" data-dismiss="alert"></button>Preview image uploaded successfully</div>');

                    } else {

                        var error_response = data.error;

                        $("#listing_response").html('<div class="text-left" style="color: #a94442"><button class="close" data-dismiss="alert"></button>'+error_response+'</div>');
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log('Image preview upload error');
                },
                complete: function() {
                    $('.upload_btn').show();

                }
            });


        }
    });

});


function imageIsLoaded(e)
{
    $('#previewing').attr('src', e.target.result);
    $('#previewing').attr('width', '150px');
    $('#previewing').attr('height', '150px');
}

function listingimageIsLoaded(e)
{
    $('#previewing').attr('src', e.target.result);
    $('#previewing').attr('width', '220px');
    $('#previewing').attr('height', '200px');
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
                $("#contact_response").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button>You successfully messaged your selected agents. Expect a response soon!</div>');
            } else {
                $("#contact_response").html('<div class="alert alert-danger"><button class="close" data-dismiss="alert"></button> Whoops! something wrong,try again later.</div>');
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


var room = 1;
function addFloor() {
    room++;
    var objTo = document.getElementById('plan_box');
    var divtest = document.createElement("tr");
    divtest.setAttribute("class", "removeclass"+room);
    var rdiv = 'removeclass'+room;
    divtest.innerHTML = '<td class="row-sort"></td><td class="sort-middle"><div class="sort-inner-block"><div class="row"><div class="col-sm-4 col-xs-6"><div class="form-group"><label for="planTitle">Plan Title</label><input name="title[]" type="text" id="planTitle" class="form-control"></div></div><div class="col-sm-4 col-xs-6"><div class="form-group"><label for="planSize">Plan Size</label><input name="size[]" type="number" id="planSize" class="form-control"></div></div><div class="col-sm-4 col-xs-6"><div class="form-group"><label for="planBedrooms">Plan Bedrooms</label><input name="beds[]" type="number" id="planBedrooms" class="form-control"></div></div><div class="col-sm-4 col-xs-6"> <div class="form-group"><label for="planBathrooms">Plan Bathrooms</label><input name="bath[]" type="number" id="planBathrooms" class="form-control"></div></div><div class="col-sm-4 col-xs-6"><div class="form-group"><label for="planPrice">Plan Price</label><input name="price[]" type="number" step="any" id="planPrice" class="form-control"></div></div><div class="col-sm-4 col-xs-6"><div class="form-group"><label for="planImage">Plan Image</label><input type="file" name="userFile[]" class="file"><div class="file-upload-block"><input name="" type="text" id="planImage" class="form-control" disabled placeholder="Upload Image"><button class="browse btn btn-primary" type="button">Select</button></div></div></div><div class="col-sm-12 col-xs-12"><label for="planDescription">Plan Description</label><textarea name="description[]" rows="4" id="planDescription" class="form-control"></textarea></div></div></div></td><td class="row-remove"><span onclick="remove_floor_plan('+ room +');" class="remove"><i class="fa fa-remove"></i></span></td>';
    objTo.prepend(divtest);
}

function remove_floor_plan(rid) {
    $('.removeclass'+rid).remove();
}

/** Add Document **/
function addDocument() {
    room++;
    var objTo = document.getElementById('add-attachment');
    var divtest = document.createElement("tr");
    divtest.setAttribute("class", "removedoc"+room);
    var rdiv = 'removedoc'+room;
    divtest.innerHTML = '<td class="row-sort"></td><td class="sort-middle"><div class="sort-inner-block"><div class="row"><div class="col-sm-6 col-xs-6"><div class="form-group"><label for="planTitle">Title</label><input name="doc_title[]" type="text" id="" class="form-control"></div></div><div class="col-sm-6 col-xs-6"><div class="form-group"><label for="planImage">Image</label><input type="file" name="docFile[]" class="file"><div class="file-upload-block"><input name="" type="text" id="planImage" class="form-control" disabled placeholder="Upload Image"><button class="browse btn btn-primary" type="button">Select</button></div></div></div></div></div></td><td class="row-remove"><span onclick="remove_more_media('+ room +');" class="remove"><i class="fa fa-remove"></i></span></td>';
    objTo.prepend(divtest);
}

function remove_more_media(rid) {
    $('.removedoc'+rid).remove();
}

$(document).on('click', '.browse', function(){
    var file = $(this).parent().parent().parent().find('.file');
    file.trigger('click');
});


$(document).on('change', '.file', function(){
    $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
});


$(document).ready(function() {
    var showChar = 150;
    var ellipsestext = "...";
    var moretext = "more >";
    var lesstext = "less";


    $('.viewmore').each(function() {
        var content = $(this).html();

        if(content.length > showChar) {

            var c = content.substr(0, showChar);
            var h = content.substr(showChar, content.length - showChar);

            var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

            $(this).html(html);
        }

    });

    $(".morelink").click(function(){
        if($(this).hasClass("less")) {
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
});

function toggleThis()
{
    $('.addMember-block').slideToggle('2000',"swing", function () {});

}


/** Delete Appointments **/

function deleteAppointment(id){

    if(confirm('Are you sure your want to delete?'))
    {
        var url = site_url + 'listings/delete_floor_plan/';

        $.ajax({
            type: "POST",
            url: url,
            data: {id:id}
        }).done(function( result) {

            if (result) {

                $('.row_'+id).hide();

                $("#response").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button> Floor has been deleted successfully!</div>');

            } else {

                $("#response").html('<div class="alert alert-danger"><button class="close" data-dismiss="alert"></button> Whoops! something wrong,try again later.</div>');

            }
        });
        return false;



    }


}

    $('#submit_form').validate({
       errorPlacement: function (error, element) {
            return true;
        },
        //errorElement: 'span',
        errorClass: 'help-block',
        focusInvalid: false,
        ignore: ":not(:visible)",
        rules: {
            listingfile: {
                required: true
            },
        },

        highlight: function (element) {
            $(element).closest('.form-group').addClass('has-error');

        },
        success: function (label) {
            label.closest('.form-group').removeClass('has-error');
            label.remove();
        },
        submitHandler: function (form) {
            form.submit();
        },

    });

$(".submit_property").click(function(){

        addvalidate();


});

$(".edit_property").click(function(){
    editvalidate();

});





    $('.selectpicker').on('bs-select-hidden.select', function () {
        $(this).trigger("focusout");
    });
/** Validate Agents Creation **/


$('#agent_registration').validate({
    errorElement: 'span',
    errorClass: 'help-block',
    focusInvalid: false,
    ignore: ":not(:visible)",
    rules: {

        first_name: {
            required: true
        },
        last_name: {
            required: true
        },
        email: {
            required: true,
            email: true
        },
        phone:{
            required: true,
        },
        designation:{
            required: true,
        },
        location:{
            required: true,
        },
        password: {
            required: true,
            minlength: 8,
            maxlength: 15,

        }
    },

    messages: {

        first_name:"Le pré nom est requis",
        last_name: "Le nom est requis",
        email: "Veuillez entrer un valide email adresse",
        phone: "Veuillez entrer un numéro de téléphone",
        designation:"Veuillez entrer la désignation",
        location: "Veuillez entrer un lieu",
        password: {
            required: "Mot de passe requis."
        }

    },

    invalidHandler: function (event, validator) {

    },

    highlight: function (element) {
        $(element)
            .closest('.form-group').addClass('has-error');
    },

    success: function (label) {
        label.closest('.form-group').removeClass('has-error');
        label.remove();
    },

    errorPlacement: function (error, element) {

        if (element.closest('.input-icon').size() === 1) {
            error.insertAfter(element.closest('.input-icon'));
        } else {
            error.insertAfter(element);
        }
    },

    submitHandler: function (form) {
        var data = $('#agent_registration').serialize();
        var url = site_url + 'agents/postAgents/';

        $.ajax({
            type: "POST",
            cache: false,
            url: url,
            data: data,
            dataType:'html',
            success: function (result) {

                console.log(result);

                if (result == 'success') {
                    console.log('success');

                    $("#response").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button>Membre de l’équipe ajouter avec succès!</div>');
                    $('#agent_registration').trigger("reset");
                    getAllMembers();

                } else if(result == 'error') {

                    console.log('errrrrrr');

                    $("#response").html('<div class="alert alert-danger"><button class="close" data-dismiss="alert"></button> Whoops! something wrong,try again later.</div>');
                }
                else{

                    console.log('resssssst');
                    $("#response").html('<div class="alert alert-danger"><button class="close" data-dismiss="alert"></button>'+result+'</div>');

                }
            },
            async: true
        });
    }
});
function AddExistingMember() {
    var data = $('#agent_exist').serialize();
    var url = site_url + 'agents/AddExistingTeamMember/';
    $.ajax({
        type: "POST",
        cache: false,
        url: url,
        data: data,
        dataType:'html',
        success: function (result) {
            if (result == 'success') {

                $("#response").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button>Membre de l’équipe ajouter avec succès!</div>');
                $('#agent_exist').trigger("reset");
                getAllMembers();
            } else if(result == 'error') {
                $("#response").html('<div class="alert alert-danger"><button class="close" data-dismiss="alert"></button> Whoops! something wrong,try again later.</div>');
            }
            else{
                $("#response").html('<div class="alert alert-danger"><button class="close" data-dismiss="alert"></button>'+result+'</div>');
            }
        },
        async: true
    });


}

function getAllMembers() {
    var url = site_url + 'agents/getAgentMembers/';
    $.ajax({
        type: "POST",
        cache: false,
        url: url,
        dataType:'html',
        beforeSend: function(){
            $("#loading").show();
        },
        success: function (result) {
            if (result) {
              $("#loading").hide();
              $('.team_members').html(result);

            } else {

                $(".team_members").html('<div class="alert alert-danger"><button class="close" data-dismiss="alert"></button> Whoops! something wrong,try again later.</div>');
            }
        },
        async: true
    });
}


/** Alert **/

$(document).on("click", ".delete_agent", function(){
//$('.delete_agent').click(function () {


    var id  = this.id;


    iziToast.show({
        color: 'light',
        icon: 'iziToast-icon ico-question revealIn',
        overlay: true,
        close: false,
        closeOnEscape: true,
        title: 'Hey',
        message: 'Are You Sure?',
        position: 'center',
        backgroundColor: 'rgba(255,249,178,0.9)',
        progressBarColor: 'rgba(255,249,178,0.9)',
        buttons: [
            ['<button><b>Yes</b></button>', function (instance, toast) {

                instance.hide(toast, { transitionOut: 'fadeOut' }, 'button');

                var url = site_url + 'agents/deleteAgent/';
                $.ajax({
                    type: "POST",
                    cache: false,
                    url: url,
                    data: {id:id},
                    dataType:'html',
                    beforeSend: function(){

                        //alert(id)
                        //$("#loading").show();
                    },
                    success: function (result) {
                        if (result) {

                            $("#member_"+id).hide(1000);

                        } else {

                           alert('Whoops! something wrong,try again later');
                        }
                    },
                    async: true
                });




            }, true],
            ['<button>N0</button>', function (instance, toast) {

                instance.hide(toast, { transitionOut: 'fadeOut' }, 'button');

            }]
        ],
    });

}); // ! .click()


//$('.agent_status').click(function () {
$(document).on("click", ".agent_status", function(){



    var id  = this.id;
    var status = $(this).attr('status');


    iziToast.show({
        color: 'light',
        icon: 'iziToast-icon ico-question revealIn',
        overlay: true,
        close: false,
        closeOnEscape: true,
        title: 'Hey',
        message: 'Are you sure to complete action?',
        position: 'center',
        backgroundColor: 'rgba(255,249,178,0.9)',
        progressBarColor: 'rgba(255,249,178,0.9)',
        buttons: [
            ['<button><b>Yes</b></button>', function (instance, toast) {

                instance.hide(toast, { transitionOut: 'fadeOut' }, 'button');

                var url = site_url + 'agents/updateAgentStatus/';
                $.ajax({
                    type: "POST",
                    cache: false,
                    url: url,
                    data: {id:id,status:status},
                    // dataType:'html',
                    beforeSend: function(){

                        //alert(id)
                        //$("#loading").show();
                    },
                    success: function (result) {

                        if (result == 'success') {

                            if(status == 1){
                                $(".status_icon_"+id).html('<i class="fa fa-times-circle-o" aria-hidden="true"></i>');
                                $(".status_icon_"+id).parents('a').css("background-color", "#f0ad4e");
                                $('#'+id).attr('status','0');
                            }


                            else{

                                $(".status_icon_"+id).html('<i class="fa fa-check-circle-o" aria-hidden="true"></i>');
                                $(".status_icon_"+id).parents('a').css("background-color", "#71c514");
                                $('#'+id).attr('status','1');
                            }



                        } else {

                            alert('Whoops! something wrong,try again later');
                        }
                    },
                    //async: true
                });




            }, true],
            ['<button>No</button>', function (instance, toast) {

                instance.hide(toast, { transitionOut: 'fadeOut' }, 'button');

            }]
        ],
    });

});


function addRecommendation() {
    $("#user_recommendation").validate({
            ignore: "input[type='text']:hidden",
            rules: {
                'poster_name': {required: true},
                'poster_email': {required: true},
                'recommendation': {required: true},

            }
        }
    );

    var url = site_url + 'agents/userRecommendation/';
    var data = $('#user_recommendation').serialize();
    $.ajax({
        type: "POST",
        cache: false,
        url: url,
        data: data,
        dataType:'html',
        beforeSend: function(){
            $("#loading").show();
        },
        success: function (result) {

            if (result == 1) {
                $("#loading").hide();
                $('#user_recommendation').trigger("reset");
                $('#response_suc').html("You successfully submitted your recommendation.");
                setTimeout(function(){
                    window.location.reload(1);
                }, 2000);

            }
            else if (result == 0) {

                $("#response_suc").html('<div class="alert alert-danger"><button class="close" data-dismiss="alert"></button> Whoops! something wrong,try again later.</div>');

            }

            else {

                $("#response").html(result);
            }
        },
        async: true
    });

}

$(document).on("click", ".liststatusupdate", function(){
    var id  = this.id;
    iziToast.show({
        color: 'light',
        icon: 'iziToast-icon ico-question revealIn',
        overlay: true,
        close: false,
        closeOnEscape: true,
        title: 'Hey',
        message: 'Are you sure for action?',
        position: 'center',
        backgroundColor: 'rgba(255,249,178,0.9)',
        progressBarColor: 'rgba(255,249,178,0.9)',
        buttons: [
            ['<button><b>Yes</b></button>', function (instance, toast) {
                instance.hide(toast, { transitionOut: 'fadeOut' }, 'button');
                var url = site_url + 'index.php/listings/delete_listing_status/';
                $.ajax({
                    type: "POST",
                    cache: false,
                    url: url,
                    data: {id:id},
                    dataType:'html',
                    success: function (result) {
                        if(result == 1) {
                            console.log('called');
                            $("#booking_row_"+id).hide();
                            $('#response')
                            .show()
                            .html('<div  class="alert alert-success"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Your listing has been deleted successfully </div>');
                             $('#response').fadeOut(3000);

                        }else {

                            $('#response').html('<div  class="alert alert-danger"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Something went wrong,please try agian later! </div>');
                        }
                    },

                });


            }, true],
            ['<button>No</button>', function (instance, toast) {

                instance.hide(toast, { transitionOut: 'fadeOut' }, 'button');

            }]
        ],
    });

});

$(document).on("click", ".soldStatusUpdate", function(){
    var id  = this.id;
    iziToast.show({
        color: 'light',
        icon: 'iziToast-icon ico-question revealIn',
        overlay: true,
        close: false,
        closeOnEscape: true,
        title: 'Hey',
        message: 'Are you sure to complete action?',
        position: 'center',
        backgroundColor: 'rgba(255,249,178,0.9)',
        progressBarColor: 'rgba(255,249,178,0.9)',
        buttons: [
            ['<button><b>Yes</b></button>', function (instance, toast) {
                instance.hide(toast, { transitionOut: 'fadeOut' }, 'button');
                var url = site_url + 'index.php/listings/sold_listing_status/';
                $.ajax({
                    type: "POST",
                    cache: false,
                    url: url,
                    data: {id:id},
                    dataType:'html',
                    success: function (result) {
                        if(result == 1) {
                          console.log('called');
                            $("#booking_row_"+id).hide();
                            $('#response')
                                .show()
                                .html('<div  class="alert alert-success"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Your listing has been mark as sold </div>');
                            $('#response').fadeOut(1000);
                           setTimeout(function(){
                                window.location.reload(1);
                            }, 3000);


                        }else {

                            $('#response').html('<div  class="alert alert-danger"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Something went wrong,please try agian later! </div>');
                        }
                    },

                });


            }, true],
            ['<button>NO</button>', function (instance, toast) {

                instance.hide(toast, { transitionOut: 'fadeOut' }, 'button');

            }]
        ],
    });

});

function appStatusCancel(id,ualid,usid) {
    iziToast.show({
        color: 'light',
        icon: 'iziToast-icon ico-question revealIn',
        overlay: true,
        close: false,
        closeOnEscape: true,
        title: 'Hey',
        message: 'Are you sure to complete action?',
        position: 'center',
        backgroundColor: 'rgba(255,249,178,0.9)',
        progressBarColor: 'rgba(255,249,178,0.9)',
        buttons: [
            ['<button><b>Yes</b></button>', function (instance, toast) {
                instance.hide(toast, {transitionOut: 'fadeOut'}, 'button');
                var url = site_url + 'index.php/appointments/app_status_cancel/';
                $.ajax({
                    type: "POST",
                    cache: false,
                    url: url,
                    data: {id: id, ualid: ualid , usid: usid},
                    dataType: 'html',
                    success: function (result) {
                        if (result == 1) {
                            console.log('called');
                            // $("#booking_row_"+id).hide();
                            $('#response')
                                .show()
                                .html('<div  class="alert alert-success"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Your Appointment has been mark as cancel</div>');
                            $('#response').fadeOut(1000);
                            setTimeout(function(){
                                window.location.reload(1);
                            }, 3000);
                        } else {

                            $('#response').html('<div  class="alert alert-danger"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Something went wrong,please try agian later! </div>');
                        }
                    },

                });
            }, true],
            ['<button>No</button>', function (instance, toast) {

                instance.hide(toast, {transitionOut: 'fadeOut'}, 'button');

            }]
        ],
    });

}

function userStatusCancel(id,listing_id) {
    iziToast.show({
        color: 'light',
        icon: 'iziToast-icon ico-question revealIn',
        overlay: true,
        close: false,
        closeOnEscape: true,
        title: 'Hey',
        message: 'Are you sure complete action?',
        position: 'center',
        backgroundColor: 'rgba(255,249,178,0.9)',
        progressBarColor: 'rgba(255,249,178,0.9)',
        buttons: [
            ['<button><b>Yes</b></button>', function (instance, toast) {
                instance.hide(toast, {transitionOut: 'fadeOut'}, 'button');
                var url = site_url + 'index.php/appointments/app_userstatus_cancel/';
                $.ajax({
                    type: "POST",
                    cache: false,
                    url: url,
                    data: {id: id, listing_id: listing_id},
                    dataType: 'html',
                    success: function (result) {
                        if (result == 1) {
                            console.log('called');
                            // $("#booking_row_"+id).hide();
                            $('#response')
                                .show()
                                .html('<div  class="alert alert-success"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Your Appointment has been mark as cancel</div>');
                            $('#response').fadeOut(1000);
                            setTimeout(function(){
                                window.location.reload(1);
                            }, 3000);


                        } else {

                            $('#response').html('<div  class="alert alert-danger"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Something went wrong,please try agian later! </div>');
                        }
                    },

                });
            }, true],
            ['<button>No</button>', function (instance, toast) {

                instance.hide(toast, {transitionOut: 'fadeOut'}, 'button');

            }]
        ],
    });

}


function appStatusConfirm(id,ualid,usid,appointment_time) {
    iziToast.show({
        color: 'light',
        icon: 'iziToast-icon ico-question revealIn',
        overlay: true,
        close: false,
        closeOnEscape: true,
        title: 'Hey',
        message: 'Are you Sure to complete action?',
        position: 'center',
        backgroundColor: 'rgba(255,249,178,0.9)',
        progressBarColor: 'rgba(255,249,178,0.9)',
        buttons: [
            ['<button><b>Yes</b></button>', function (instance, toast) {
                instance.hide(toast, {transitionOut: 'fadeOut'}, 'button');
                var url = site_url + 'index.php/appointments/app_status_confirm/';
                $.ajax({
                    type: "POST",
                    cache: false,
                    url: url,
                    data: {id: id, ualid: ualid , usid: usid, appointment_time: appointment_time},
                    dataType: 'html',
                    success: function (result) {
                        if (result == 1) {
                            console.log('called');
                            // $("#booking_row_"+id).hide();
                            $('#response')
                                .show()
                                .html('<div  class="alert alert-success"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Your Appointment has been mark as confirm</div>');
                            $('#response').fadeOut(1000);
                            setTimeout(function(){
                            window.location.reload(1);
                             }, 3000);


                        } else {

                            $('#response').html('<div  class="alert alert-danger"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Something went wrong,please try agian later! </div>');
                        }
                    },

                });
            }, true],
            ['<button>No</button>', function (instance, toast) {

                instance.hide(toast, {transitionOut: 'fadeOut'}, 'button');

            }]
        ],
    });

}

function existing_member() {
    $("#agent_exist").toggle();
    $("#agent_registration").hide();

}
function new_member() {
    $("#agent_registration").toggle();
    $("#agent_exist").hide();

}