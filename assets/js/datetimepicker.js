/*  Date Time picker
 /* ------------------------------------------------------------------------ */

var date_ele = $('.date-time');
if(date_ele.length > 0) {
    date_ele.datetimepicker({
       /* maxDate: '0',
        disabledTimeIntervals: [[moment(), moment().hour(24).minutes(0).seconds(0)]],*/
        format: 'YYYY-MM-DD HH:mm:ss',
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down",
            left: "fa fa-arrow-left"
        }
    });
}
var date_ele = $('.adddate');
if(date_ele.length > 0) {
    date_ele.datetimepicker({
        format: 'YYYY-MM-DD',
        minDate:new Date(),
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down",
            left: "fa fa-arrow-left"
        }
    });
}
var date_ele = $('.addtime');
if(date_ele.length > 0) {
    date_ele.datetimepicker({
       /* maxDate: '0',
        disabledTimeIntervals: [[moment(), moment().hour(12).minutes(0).seconds(0)]],*/
        stepping: 15,
        format: 'hh:mm A',
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down",
            left: "fa fa-arrow-left"
        }
    });
}

