var Inbox = function ()
{

    var content = $('.inbox-content');
    var loading = $('.inbox-loading');
    var listListing = '';

    var loadInbox = function (el, name)
    {


        if (name == 'inbox')
        {
            var url = site_url + 'inbox/inbox/';
        }
        else if (name == 'sent')
        {
            var url = site_url + 'inbox/sent/';
        }
        else if (name == 'applications')
        {
            var url = site_url + 'inbox/applications/';
        }
        else if (name == 'appointments')
        {
            var url = site_url + 'inbox/appointments/';
        }
        var title = $('.inbox-nav > li.' + name + ' a').attr('data-title');


        loading.show();
        content.html('');
        toggleButton(el);

        $.ajax(
        {
            type: "POST",
            cache: false,
            url: url,
            dataType: "html",
            success: function (res)
            {
                toggleButton(el);

                $('.inbox-nav > li.active').removeClass('active');
                $('.inbox-nav > li.' + name).addClass('active');
                $('.inbox-header > h3').text(title);

                loading.hide();
                content.html(res);
                if (Layout.fixContentHeight)
                {
                    Layout.fixContentHeight();
                }
                Metronic.initUniform();
            },
            error: function (xhr, ajaxOptions, thrownError)
            {
                toggleButton(el);
            },
            async: false
        });

    }

    var loadMessage = function (el, name, resetMenu)
    {


        if (name == 'inbox') {
            var url = site_url + 'inbox/inbox_view/';
        } else if (name == 'sent') {
            var url = site_url + 'inbox/sent_view/';
        } else if (name == 'applications') {
            var url = site_url + 'inbox/application_view/';
        } else if (name == 'appointments') {
            var url = site_url + 'inbox/appointment_view/';
        }
        var title = $('.inbox-nav > li.' + name + ' a').attr('data-title');




        loading.show();
        content.html('');
        toggleButton(el);

        var message_id = el.attr("data-messageid");

        $.ajax({
            type: "POST",
            cache: false,
            url: url,
            dataType: "html",
            data: {'message_id': message_id},
            success: function (res)
            {
                toggleButton(el);

                if (resetMenu) {
                    $('.inbox-nav > li.active').removeClass('active');
                }
                $('.inbox-header > h3').text('See message');

                loading.hide();
                content.html(res);
                Layout.fixContentHeight();
                Metronic.initUniform();
            },
            error: function (xhr, ajaxOptions, thrownError)
            {
                toggleButton(el);
            },
            async: false
        });

    }

    var initWysihtml5 = function () {
        $('.inbox-wysihtml5').wysihtml5({
            "stylesheets": ["../../assets/js/wysiwyg-color.css"]
        });
    }

    var initFileupload = function () {

        $('#fileupload').fileupload({
            // Uncomment the following to send cross-domain cookies:
            //xhrFields: {withCredentials: true},
            url: '../../assets/js/jquery-file-upload/server/php/',
            autoUpload: true
        });

        // Upload server status check for browsers with CORS support:
        if ($.support.cors) {
            $.ajax({
                url: '../../assets/js/jquery-file-upload/server/php/',
                type: 'HEAD'
            }).fail(function () {
                $('<span class="alert alert-error"/>')
                        .text('Upload server currently unavailable - ' +
                                new Date())
                        .appendTo('#fileupload');
            });
        }
    }

    var loadReply = function (el) {
        var message_id = $(el).attr("data-messageid");

        var url = site_url + 'inbox/reply/';

        loading.show();
        content.html('');
        toggleButton(el);

        // load the form via ajax
        $.ajax({
            type: "POST",
            cache: false,
            data: {'message_id': message_id},
            url: url,
            dataType: "html",
            success: function (res)
            {
                toggleButton(el);

                $('.inbox-nav > li.active').removeClass('active');
                $('.inbox-header > h3').text('Reply');

                loading.hide();
                content.html(res);

            },
            error: function (xhr, ajaxOptions, thrownError)
            {
                toggleButton(el);
            },
            async: false
        });
    }

    var sendreply = function (el) {

        var url = site_url + 'inbox/send_reply/';
        var data = $("#reply_compose").serialize()

        loading.show();
        content.html('');
        toggleButton(el);

        // load the form via ajax
        $.ajax({
            type: "POST",
            cache: false,
            data: data,
            url: url,
            success: function (res)
            {
                toggleButton(el);

                $('.inbox-nav > li.active').removeClass('active');
                $('.inbox-header > h3').text('Reply');

                loading.hide();
                if (res) {
                    content.html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button> Message send successfully.</div>');
                } else {
                    content.html('<div class="alert alert-danger"><button class="close" data-dismiss="alert"></button> You have some form errors. Please try again.</div>');
                }

            },
            error: function (xhr, ajaxOptions, thrownError)
            {
                toggleButton(el);
            },
            async: false
        });
    }

    var loadSearchResults = function (el) {
        var url = site_url + 'inbox/messages/';

        loading.show();
        content.html('');
        toggleButton(el);

        $.ajax({
            type: "POST",
            cache: false,
            url: url,
            dataType: "html",
            success: function (res)
            {
                toggleButton(el);

                $('.inbox-nav > li.active').removeClass('active');
                $('.inbox-header > h3').text('Search');

                loading.hide();
                content.html(res);
                Layout.fixContentHeight();
                Metronic.initUniform();
            },
            error: function (xhr, ajaxOptions, thrownError)
            {
                toggleButton(el);
            },
            async: false
        });
    }

    var handleCCInput = function () {
        var the = $('.inbox-compose .mail-to .inbox-cc');
        var input = $('.inbox-compose .input-cc');
        the.hide();
        input.show();
        $('.close', input).click(function () {
            input.hide();
            the.show();
        });
    }

    var handleBCCInput = function () {

        var the = $('.inbox-compose .mail-to .inbox-bcc');
        var input = $('.inbox-compose .input-bcc');
        the.hide();
        input.show();
        $('.close', input).click(function () {
            input.hide();
            the.show();
        });
    }

    var toggleButton = function (el) {
        if (typeof el == 'undefined') {
            return;
        }
        if (el.attr("disabled")) {
            el.attr("disabled", false);
        } else {
            el.attr("disabled", true);
        }
    }

    return {
        //main function to initiate the module
        init: function () {

            // handle compose btn click
            $('.inbox').on('click', '.compose-btn a', function () {
                loadCompose($(this));
            });

            // handle discard btn
            $('.inbox').on('click', '.inbox-discard-btn', function (e) {
                e.preventDefault();
                loadInbox($(this), listListing);
            });

            // handle reply and forward button click
            $('.inbox').on('click', '.reply-btn', function () {
                loadReply($(this));
            });

            // handle view message
            $('.inbox-content').on('click', '.view-inbox', function () {
                loadMessage($(this), 'inbox');
            });

            $('.inbox-content').on('click', '.view-sent', function () {
                loadMessage($(this), 'sent');
            });

            $('.inbox-content').on('click', '.view-application', function () {
                loadMessage($(this), 'applications');
            });

            $('.inbox-content').on('click', '.view-appointment', function () {
                loadMessage($(this), 'appointments');
            });

            // handle inbox listing
            $('.inbox-nav > li.inbox > a').click(function () {
                loadInbox($(this), 'inbox');
            });

            // handle sent listing
            $('.inbox-nav > li.sent > a').click(function () {
                loadInbox($(this), 'sent');
            });

            // handle draft listing
            $('.inbox-nav > li.applications > a').click(function () {
                loadInbox($(this), 'applications');
            });

            // handle trash listing
            $('.inbox-nav > li.appointments > a').click(function () {
                loadInbox($(this), 'appointments');
            });


            $('.inbox-content').on('click', '#send_reply', function () {
                sendreply($(this));
            });

            //handle compose/reply cc input toggle
            $('.inbox-content').on('click', '.mail-to .inbox-cc', function () {
                handleCCInput();
            });

            //handle compose/reply bcc input toggle
            $('.inbox-content').on('click', '.mail-to .inbox-bcc', function () {
                handleBCCInput();
            });

            //handle loading content based on URL parameter
            if (Metronic.getURLParameter("a") === "view") {
                loadMessage();
            } else if (Metronic.getURLParameter("a") === "compose") {
                loadCompose();
            } else {
                $('.inbox-nav > li.inbox > a').click();
            }

        }

    };

}();