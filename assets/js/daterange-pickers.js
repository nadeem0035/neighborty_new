var ComponentsPickers = function () {

    var handleDatePickers = function () {

        if (jQuery().datepickerbs) {

            var nowTemp = new Date();
            var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

            var checkin = $('#checkin').datepickerbs({
                onRender: function (date) {
                    return date.valueOf() < now.valueOf() ? 'disabled' : '';
                }
            }).on('changeDate', function (ev) {
                if (ev.date.valueOf() > checkout.date.valueOf()) {
                    var newDate = new Date(ev.date)
                    newDate.setDate(newDate.getDate() + 1);
                    checkout.setValue(newDate);
                }
                checkin.hide();
                $('#checkout')[0].focus();
            }).data('datepickerbs');
            var checkout = $('#checkout').datepickerbs({
                onRender: function (date) {
                    return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
                }
            }).on('changeDate', function (ev) {
                checkout.hide();
            }).data('datepickerbs');

            //Scond

            var checkin2 = $('#checkin2').datepickerbs({
                onRender: function (date) {
                    return date.valueOf() < now.valueOf() ? 'disabled' : '';
                }
            }).on('changeDate', function (ev) {
                if (ev.date.valueOf() > checkout2.date.valueOf()) {
                    var newDate = new Date(ev.date)
                    newDate.setDate(newDate.getDate() + 1);
                    checkout2.setValue(newDate);
                }
                checkin2.hide();
                $('#checkout2')[0].focus();
            }).data('datepickerbs');
            var checkout2 = $('#checkout2').datepickerbs({
                onRender: function (date) {
                    return date.valueOf() <= checkin2.date.valueOf() ? 'disabled' : '';
                }
            }).on('changeDate', function (ev) {
                checkout2.hide();
            }).data('datepickerbs');

            $('.date-picker').datepickerbs({
                orientation: "left",
                autoclose: true,
            });
            //$('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
        }

        /* Workaround to restrict daterange past date select: http://stackoverflow.com/questions/11933173/how-to-restrict-the-selectable-date-ranges-in-bootstrap-datepicker */
    }


    var handleDateRangePickers = function () {
        if (!jQuery().daterangepicker) {
            return;
        }

        $('#defaultrange').daterangepicker({
            opens: (Metronic.isRTL() ? 'left' : 'right'),
            format: 'MM/DD/YYYY',
            separator: ' to ',
            startDate: moment().subtract(29,'days'),
            endDate: moment(),
            minDate: '01/01/2012',
            maxDate: '12/31/2018',
        },
                function (start, end) {
                    $('#defaultrange input').val(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                }
        );

        $('#defaultrange_modal').daterangepicker({
            opens: (Metronic.isRTL() ? 'left' : 'right'),
            format: 'MM/DD/YYYY',
            separator: ' to ',
            startDate: moment().subtract(29,'days'),
            endDate: moment(),
            minDate: '01/01/2012',
            maxDate: '12/31/2018',
        },
                function (start, end) {
                    $('#defaultrange_modal input').val(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                }
        );

        // this is very important fix when daterangepicker is used in modal. in modal when daterange picker is opened and mouse clicked anywhere bootstrap modal removes the modal-open class from the body element.
        // so the below code will fix this issue.
        $('#defaultrange_modal').on('click', function () {
            if ($('#daterangepicker_modal').is(":visible") && $('body').hasClass("modal-open") == false) {
                $('body').addClass("modal-open");
            }
        });

        $('#reportrange').daterangepicker({
            opens: (Metronic.isRTL() ? 'left' : 'right'),
            startDate: moment().subtract(29,'days'),
            endDate: moment(),
            minDate: '01/01/2012',
            maxDate: '12/31/2014',
            dateLimit: {
                days: 60
            },
            showDropdowns: true,
            showWeekNumbers: true,
            timePicker: false,
            timePickerIncrement: 1,
            timePicker12Hour: true,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1,'days'), moment().subtract(1,'days')],
                'Last 7 Days': [moment().subtract(6,'days'), moment()],
                'Last 30 Days': [moment().subtract(29,'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1,'month').startOf('month'), moment().subtract(1,'month').endOf('month')]
            },
            buttonClasses: ['btn'],
            applyClass: 'green',
            cancelClass: 'default',
            format: 'MM/DD/YYYY',
            separator: ' to ',
            locale: {
                applyLabel: 'Apply',
                fromLabel: 'From',
                toLabel: 'To',
                customRangeLabel: 'Custom Range',
                daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                firstDay: 1
            }
        },
        function (start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
        );
        //Set the initial state of the picker label
        $('#reportrange span').html(moment().subtract(29,'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
    }


    return {
        //main function to initiate the module
        init: function () {
            handleDatePickers();
            handleDateRangePickers();
        }
    };

}();