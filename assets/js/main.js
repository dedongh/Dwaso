$(document).ready(function () {

    //address checkout
    $("#chk_addr").on("click", function () {

        var data = {
            "checkout_first_name" : $("#checkout-fn").val(),
            "checkout_last_name":  $("#checkout-ln").val(),
            "checkout_email": $("#checkout-email").val(),
            "checkout_phone": $("#checkout-phone").val(),
            "checkout_address1": $("#checkout-address1").val(),
            "checkout_address2" : $("#checkout-address2").val()
        };

        $.ajax({
            url: "process.php",
            method: "POST",
            data: data,

            success: function (data) {
                if (data != "passed") {
                    $("#addr_err").html(data);
                }
                if (data == "passed") {
                    $("#addr_err").html("");
                    location.href = "delivery";
                }
            }
        })
    });

   // display cart prices
    displayCartPrices();
    function displayCartPrices() {
        var rdV = $("input[name=shipping-method]:checked").val();

        $.ajax({
            url: "checkout.php",
            method: "POST",
            data: {getPrice:1, rdV:rdV},
            success: function (data) {
                $(".checkout-prices").html(data);
            }
        })
    }

    displayRecentlyViewedItems();
    function displayRecentlyViewedItems() {
        $.ajax({
            url: "checkout.php",
            method: "POST",
            data: {getViewed:1},
            success: function (data) {
                $(".viewed").html(data);
            }
        })
    }

    //sort by popularity
   $("#sorting").on("change", function () {
      var d3n = $("#sorting option:selected").val();
       //console.log(d3n);
       $.ajax({
           url: "checkout.php",
           method: "POST",
           data: {sortGridProducts:1, optGrid:d3n},
           success: function (data) {
               $(".get_all_products").html(data);
           }
       })
   });

    //sort by popularity list view
    $("#sortingL").on("change", function () {
        var d3n = $("#sortingL option:selected").val();
       // console.log(d3n);
        $.ajax({
            url: "checkout.php",
            method: "POST",
            data: {sortListProducts:1, optList:d3n},
            success: function (data) {
               $(".get_list_products").html(data);
            }
        })
    });

    $("body").delegate(".cat_clk li","click", function () {

        var clk = $(this).html();
        $(".clk_text").html(clk);
        $(".cat_search").val(clk)
    });

});