/*
$(document).ready(function() {
    $('#priced').tooltip();
    var ONE_TO_NINETEEN = ["One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen"];
    var TENS = ["Ten", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety"];
    var SCALES = ["Thousand", "Million", "Billion", "Trillion"];

    function isTruthy(item) {
        return !!item;
    }

    function chunk(number) {
        var thousands = [];
        while (number > 0) {
            thousands.push(number % 1000);
            number = Math.floor(number / 1000);
        }
        return thousands;
    }

    function inEnglish(number) {
        var thousands, hundreds, tens, ones, words = [];
        if (number < 20) {
            return ONE_TO_NINETEEN[number - 1];
        }
        if (number < 100) {
            ones = number % 10;
            tens = number / 10 | 0;
            words.push(TENS[tens - 1]);
            words.push(inEnglish(ones));
            return words.filter(isTruthy).join("-");
        }
        hundreds = number / 100 | 0;
        words.push(inEnglish(hundreds));
        words.push("hundred");
        words.push(inEnglish(number % 100));
        return words.filter(isTruthy).join(" ");
    }

    function appendScale(chunk, exp) {
        var scale;
        if (!chunk) {
            return null;
        }
        scale = SCALES[exp - 1];
        return [chunk, scale].filter(isTruthy).join(" ");
    }
    $("#priced").keyup(function() {
        var priceValue = $(this).val();
        priceValue = priceValue.replace(/\D/g, '');
        var string22 = chunk(priceValue).map(inEnglish).map(appendScale).filter(isTruthy).reverse().join(" ");
        $(this).attr('data-original-title', string22).tooltip('show');
    });
    $("#priced").click(function() {
        var priceValue = $(this).val();
        priceValue = priceValue.replace(/\D/g, '');
        var string22 = chunk(priceValue).map(inEnglish).map(appendScale).filter(isTruthy).reverse().join(" ");
        $(this).attr('data-original-title', string22).tooltip('show');
    });
});*/


var zlang_price_message_1 = "Price should be greater than '0'";
var zlang_price_message_2 = "Add to Price just Numbers Only";
var zlang_price_message_3 = "Price is too large. Please enter a smaller number.";
var zlang_price_base_1 = " Hundred";
var zlang_price_base_2 = " Thousand";
var zlang_price_base_3 = " Million ";
var zlang_price_base_4 = " Billion ";
var zlang_arab   = "Arab";
var zlang_crore  = "Crore";
var zlang_lakh  = "Lakh";
var zlang_hazar = "Thousand";
var zlang_and   = "and";

$("#price").on("keyup",function() {
    text_div = $(".price_text").eq(0);
    if( /^[0-9]+$/.test(this.value) )
    {
        purpose = $("#purpose").val();
        type_value = $("#type").val();
        if( purpose=="" || type_value=="" )
        {
            return text_div.html( get_combine_price_on_hover(this.value, 'add_new_price'));
        }
        config_options = config_options_data[ purpose ] || {};
        var obj = config_options[ type_value ];
        if( obj != undefined && this.value < obj.min_price )
            text_div.html( error_messages.min_price );
        else
            text_div.html( get_combine_price_on_hover(this.value, 'add_new_price'));
    }
    else
        text_div.html(zlang_price_message_2);
});

    function get_combine_price_on_hover(a, b) {
        return "" == getPriceText_english(a) ? getPriceText(a) : getPriceText(a) + "<br/><div class=" + b + ">" + getPriceText_english(a) + "</div>"
    }

    function getPriceText_english(a) {
        for (retText = "", a += "", price_array = a.split(","), price_length = price_array.length, a = "", i = 0; i < price_length; i++) a += price_array[i];
        return lprice = a.length, 0 == a || isNaN(a) ? retText += "" : (lprice >= 12 ? retText += a : 11 == lprice ? (retText += a.substr(0, 2) + " " + zlang_arab + " ", "00" != a.substr(2, 2) && (retText += a.substr(2, 2) + " " + zlang_crore + " "), "00" != a.substr(4, 2) && (retText += a.substr(4, 2) + " " + zlang_lakh + " "), "00" != a.substr(6, 2) && "0" != a.substr(6, 1) && (retText += zlang_and + " " + a.substr(6, 2) + " " + zlang_hazar + " "), "00" != a.substr(6, 2) && "0" == a.substr(6, 1) && (retText += zlang_and + " " + a.substr(7, 1) + " " + zlang_hazar + " ")) : 10 == lprice ? (retText += a.substr(0, 1) + " " + zlang_arab + " ", "00" != a.substr(1, 2) && (retText += a.substr(1, 2) + " " + zlang_crore + " "), "00" != a.substr(3, 2) && (retText += a.substr(3, 2) + " " + zlang_lakh + " "), "00" != a.substr(5, 2) && "0" != a.substr(5, 1) && (retText += zlang_and + " " + a.substr(5, 2) + " " + zlang_hazar + " "), "00" != a.substr(5, 2) && "0" == a.substr(5, 1) && (retText += zlang_and + " " + a.substr(6, 1) + " " + zlang_hazar + " ")) : 9 == lprice ? (retText += a.substr(0, 2) + " " + zlang_crore + " ", "00" != a.substr(2, 2) && (retText += a.substr(2, 2) + " " + zlang_lakh + " "), "00" != a.substr(4, 2) && "0" != a.substr(4, 1) && (retText += zlang_and + " " + a.substr(4, 2) + " " + zlang_hazar + " "), "00" != a.substr(4, 2) && "0" == a.substr(4, 1) && (retText += zlang_and + " " + a.substr(5, 1) + " " + zlang_hazar + " ")) : 8 == lprice ? (retText += a.substr(0, 1) + " " + zlang_crore + " ", "00" != a.substr(1, 2) && (retText += a.substr(1, 2) + " " + zlang_lakh + " "), "00" != a.substr(3, 2) && "0" != a.substr(3, 1) && (retText += zlang_and + " " + a.substr(3, 2) + " " + zlang_hazar + " "), "00" != a.substr(3, 2) && "0" == a.substr(3, 1) && (retText += zlang_and + " " + a.substr(4, 1) + " " + zlang_hazar + " ")) : 7 == lprice ? (retText += a.substr(0, 2) + " " + zlang_lakh + " ", "00" != a.substr(2, 2) && "0" != a.substr(2, 1) && (retText += zlang_and + " " + a.substr(2, 2) + " " + zlang_hazar + " "), "00" != a.substr(2, 2) && "0" == a.substr(2, 1) && (retText += zlang_and + " " + a.substr(3, 1) + " " + zlang_hazar + " ")) : 6 == lprice && (retText += a.substr(0, 1) + " " + zlang_lakh + " ", "00" != a.substr(1, 2) && "0" != a.substr(1, 1) && (retText += zlang_and + " " + a.substr(1, 2) + " " + zlang_hazar + " "), "00" != a.substr(1, 2) && "0" == a.substr(1, 1) && (retText += zlang_and + " " + a.substr(2, 1) + " " + zlang_hazar + " ")), lprice < 12 && (retText += "")), retText
    }
    function getPriceText(a) {
        for (retText = "", a += "", price_array = a.split(","), price_length = price_array.length, a = "", i = 0; i < price_length; i++) a += price_array[i];
        return a = number_format(a, 0, "", ""), lprice = a.length, 0 == a ? retText += zlang_price_message_1 : isNaN(a) ? retText += zlang_price_message_2 : (lprice >= 12 ? retText += zlang_price_message_3 : 11 == lprice ? (retText += a.substr(0, 2), retText += zlang_price_base_4, "0" != a.substr(2, 1) && (retText += a.substr(2, 3) + zlang_price_base_3), "0" == a.substr(2, 1) && "0" != a.substr(3, 1) && (retText += a.substr(3, 2) + zlang_price_base_3), "0" == a.substr(2, 1) && "0" == a.substr(3, 1) && "0" != a.substr(4, 1) && (retText += a.substr(4, 1) + zlang_price_base_3)) : 10 == lprice ? (retText += a.substr(0, 1), retText += zlang_price_base_4, "0" != a.substr(1, 1) && (retText += a.substr(1, 3) + zlang_price_base_3), "0" == a.substr(1, 1) && "0" != a.substr(2, 1) && (retText += a.substr(2, 2) + zlang_price_base_3), "0" == a.substr(1, 1) && "0" == a.substr(2, 1) && "0" != a.substr(3, 1) && (retText += a.substr(3, 1) + zlang_price_base_3)) : 9 == lprice ? (retText += a.substr(0, 3) + zlang_price_base_3, "0" != a.substr(3, 1) && (retText += a.substr(3, 3) + zlang_price_base_2), "0" == a.substr(3, 1) && "0" != a.substr(4, 1) && (retText += a.substr(4, 2) + zlang_price_base_2), "0" == a.substr(3, 1) && "0" == a.substr(4, 1) && "0" != a.substr(5, 1) && (retText += a.substr(5, 1) + zlang_price_base_2)) : 8 == lprice ? (retText += a.substr(0, 2), "00" == a.substr(2, 3) && (retText += zlang_price_base_3), "00" != a.substr(2, 3) && (retText += zlang_price_base_3), "00" != a.substr(2, 2) && "0" == a.substr(2, 1) && (retText += a.substr(3, 2) + zlang_price_base_2), "00" != a.substr(2, 2) && "0" != a.substr(2, 1) && (retText += a.substr(2, 3) + zlang_price_base_2)) : 7 == lprice ? (retText += a.substr(0, 1), retText += zlang_price_base_3, "0" != a.substr(1, 1) && (retText += a.substr(1, 3) + zlang_price_base_2), "0" == a.substr(1, 1) && "0" != a.substr(2, 1) && (retText += a.substr(2, 2) + zlang_price_base_2), "0" == a.substr(1, 1) && "0" == a.substr(2, 1) && "0" != a.substr(3, 1) && (retText += a.substr(3, 1) + zlang_price_base_2)) : 6 == lprice ? (retText += a.substr(0, 1) + zlang_price_base_1, "00" == a.substr(1, 2) && (retText += zlang_price_base_2), "00" != a.substr(1, 2) && "0" != a.substr(1, 1) && (retText += " " + a.substr(1, 2) + zlang_price_base_2), "00" != a.substr(1, 2) && "0" == a.substr(1, 1) && (retText += " " + a.substr(2, 1) + zlang_price_base_2)) : 5 == lprice ? ("00" != a.substr(0, 2) && "0" != a.substr(0, 1) && (retText += a.substr(0, 2) + zlang_price_base_2), "0" == a.substr(0, 1) && "0" != a.substr(1, 1) && (retText += a.substr(1, 1) + zlang_price_base_2)) : 4 == lprice ? "0" != a.substr(0, 1) && "00" != a.substr(0, 2) && (retText += a.substr(0, 1) + zlang_price_base_2) : lprice <= 3 && (retText += a), lprice < 12 && (retText += "")), retText
    }

    function number_format(a, b, c, d) {
        if (a = Math.round(a * Math.pow(10, b)) / Math.pow(10, b), e = a + "", f = e.split("."), f[0] || (f[0] = "0"), f[1] || (f[1] = ""), f[1].length < b) {
            for (g = f[1], i = f[1].length + 1; i <= b; i++) g += "0";
            f[1] = g
        }
        if ("" != d && f[0].length > 3) {
            for (h = f[0], f[0] = "", j = 3; j < h.length; j += 3) i = h.slice(h.length - j, h.length - j + 3), f[0] = d + i + f[0] + "";
            j = h.substr(0, h.length % 3 == 0 ? 3 : h.length % 3), f[0] = j + f[0]
        }
        return c = 0 >= b ? "" : c, f[0] + c + f[1]
    }



