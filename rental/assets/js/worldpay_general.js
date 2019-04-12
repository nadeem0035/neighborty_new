$("#place-orde").on('click', function (e) {
    //e.preventDefault();
    $('.token').show();
    var form = document.getElementById('payment_form');

    if ($('#transaction_through').val() == 'paypal') {
        form.submit();
    } else {

        Worldpay.useOwnForm({
            'clientKey': 'T_C_5638fd05-7cc7-4677-8561-e127f5d28f73',
            'form': form,
            'reusable': true,
            'callback': function (status, response) {
                document.getElementById('paymentErrors').innerHTML = '';

                if (response.error) {
                    Worldpay.handleError(form, document.getElementById('paymentErrors'), response.error);
                } else {
                    var token = response.token;
                    Worldpay.formBuilder(form, 'input', 'hidden', 'token', token);
                    form.submit();
                }
            }
        });
    }
});
$(document).ready(function () {
    $('.token').hide();
});



$(function () {
    $('#transaction_through').change(function () {
        if ($('#transaction_through').val() == 'paypal') {
            $('#row_dim').hide();
        } else {
            $('#row_dim').show();
        }
    });
});