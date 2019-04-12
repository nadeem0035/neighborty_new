function setapp(id) {
// $(document).ready(function () {
//         var user_id = "<?php $listing->user_id;?>";
    var user_id = id;
        var url = site_url + 'booking/calendar_appointments/'+id;
        $("#my-calendar").zabuto_calendar({
            action: function () {
                return myDateFunction(this.id,user_id, false);
            },
            language: 'en',
            action_nav: function () {
                return myNavFunction(this.id);
            },
            today: true,
            show_days:true,
            //  show_next:true,
            //  show_previous:false,
            ajax: {
                url: url,
                modal: true,
                "badge":true,
            }
        });
        function myNavFunction(id) {
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
        }
        function myDateFunction(id,user_id, fromModal) {
            $("#calender_div").removeClass().addClass("col-md-6");
            var date = $("#" + id).data("date");
            var hasEvent = $("#" + id).data("hasEvent");
            if (hasEvent && !fromModal) {
                var furl = site_url + 'booking/get_appointment_hours/'+user_id;
                $.ajax({
                    type: "POST",
                    cache: false,
                    url: furl,
                    data: { date:date},
                    async:true,
                    dataType: 'html',
                    beforeSend: function() {
                        $('.ajax-loader_icon').show();
                    },
                    success: function(result) {
                        $('#form-div').show();
                        $('#waqas').html(result)
                    },
                    error: function(xhr) { // if error occured
                        alert("Error occured.please try again");
                    },
                    complete: function() {
                        $('.ajax-loader_icon').hide();
                    }
                });
            }else{

                $('#form-div').hide();
                $("#calender_div").removeClass().addClass("col-md-12");
            }
        }
    }