$(document).ready(function () {
    category();
    tollCat();
    brands();
    products();

    //fetch categories with image from database on page loaded
    function category() {
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {category:1},
            success: function (data) {
                $(".get_category").html(data);
            }
        })
    }

    //get cat for toolbars
    function tollCat() {
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {cat_tool:1},
            success: function (data) {
                $(".cat_tool").html(data);
            }
        })
    }
    
    //get Brands from db
    function brands() {
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {brands:1},
            success: function (data) {
                $(".get_brand").html(data);
            }
        })
    }

    //fetch featured products from database
    function products() {
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {getProduct:1},
            success: function (data) {
                $("#get_product").html(data);
            }
        })
    }

    //count items in cart
    count_Item();
    function count_Item() {
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {count_item:1},
            success: function (data) {
                $(".badges").html(data);
            }

        })
    }

    //show cart items in dropdown menu
    getCartItem();
    function getCartItem() {
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {Common:1,getCartItem:1},
            success: function (data) {
                $(".cart_product").html(data);

            }
        })
    }


    //add to cart
    $("body").delegate("#products", "click", function (event) {
        var pid = $(this).attr("pid");
        var quantity = $("#quant").val();
        var available = $("#qty_avail").val();
        var size = $("#size").val();
        var color = $("#color").val();
        event.preventDefault();
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {
                addToCart:1,
                proId:pid,
                quant:quantity,
                available:available,
                size:size,
                color:color
            },
            success: function (data) {
                count_Item();
                getCartItem();
                cartDetails();

            }
        })
    });

    //remove product from cart
    $("body").delegate(".remove","click",function (event) {
        event.preventDefault();
        var remove_id = $(this).attr("remove_id");

        $.ajax({
            url	:	"action.php",
            method	:	"POST",
            data	:	{removeItemFromCart:1,rid:remove_id},
            success	:	function(data){

                    getCartItem();
                    count_Item();
                    cartDetails();

            }
        })
    });

    //display cart items on cart page
    cartDetails();
    function cartDetails() {
        var pid = $(this).attr("pid");

        $.ajax({
            url: "action.php",
            method: "POST",
            data: {
                Common:1,
                checkOutDetails:1,

            },
            success: function (data) {
                $(".cartCheckout").html(data);

                if (data == "") {
                    $(".clearAll").hide();
                } else {
                    $(".clearAll").show();

                }
                net_total();
            }
        })
    }

    // delete all products from cart
    $(".clearAll").on("click",function (e) {
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {deleteAll:1},
            success: function (data) {

                    cartDetails();
                    count_Item();
                    getCartItem()

            }
        })
    });

    //update cart
   $("body").delegate(".update","click",function(event){
        event.preventDefault();

       var update_id = $(this).attr("update_id");
       var qty = $("#qty-"+update_id).val();
       var avail = $("#left-" + update_id).val();

        $.ajax({
            url	:	"action.php",
            method	:	"POST",
            data	:	{updateCartItem:1,update_id:update_id,qty:qty},
            success	:	function(data){

                cartDetails();
                getCartItem()
            }
        });


    });

    //calculate total items in cart
    $("body").delegate(".qty","keyup",function(event){
        event.preventDefault();
        var row = $(this).parent().parent().parent();
        var price = row.find('.price').val();
        var qty = row.find('.qty').val();
        if (isNaN(qty)) {
            qty = 1;
        }
        if (qty < 1) {
            qty = 1;
        }
        var total = price * qty;
        row.find('.total').val(total);
        var net_total=0;
        $('.total').each(function(){
            net_total += ($(this).val()-0);
        });
        //dynamically displays total price
       $('.net_total').html(net_total);
    });

    //calculate total cart amount
    net_total();
    function net_total(){
        var net_total = 0;
        $('.qty').each(function(){
            var row = $(this).parent().parent().parent();
            var price  = row.find('.price').val();
            var total = price * $(this).val();
            row.find('.total').val(total);
        });
        $('.total').each(function(){
            net_total += ($(this).val()-0);
        });
        //shows price on page load
        $('.net_total').html(net_total);
    }


    //wishlist
    //display wishlist items on wishlist page
    wishlistCheckout();
    function wishlistCheckout() {
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {wish:1, wishlistCheckout:1},
            success: function (data) {
                $(".wishlistCheckout").html(data);
            }
        })

    }

    //remove from wishlist
    $("body").delegate(".del-wish","click",function (e) {
        e.preventDefault();
        var del_id = $(this).attr("remove_id");
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {removeItemFromWishlist:1,deleteId:del_id},
            success: function (data) {
                if (data == "wished") {
                    iziToast.info({
                        title: 'Product',
                        message: 'successfully removed from wishlist...',
                        position: 'topRight',
                        animateInside: !1,
                        transitionIn: "fadeInLeft",
                        transitionOut: "fadeOut",
                        transitionInMobile: "fadeIn",
                        transitionOutMobile: "fadeOut",
                        timeout: 1000,
                        progressBar: !1,
                        icon: 'icon-slash'
                    });
                }
                wishlistCheckout();
                wishCount()
            }
        })
    });
    
    //total items in wishlist
    wishCount();
    function wishCount() {
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {count_wish:1},
            success: function (data) {
                $(".wished").html(data);
            }
        })
    }

    //count items in orders table
    orderCount();
    function orderCount() {
        $.ajax({
            url: "action.php",
            method: "POST",
            data:{count_orders:1},
            success: function (data) {
                $(".orders").html(data);
            }
        })
    }

    //clear all wishlist items
    $(".clearList").on("click",function () {
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {wishClear:1},
            success: function (data) {
                if (data == "wishCleared") {
                    iziToast.warning({
                        title: 'All Products',
                        message: 'successfully removed from wishlist...',
                        position: 'topRight',
                        animateInside: !1,
                        transitionIn: "fadeInLeft",
                        transitionOut: "fadeOut",
                        transitionInMobile: "fadeIn",
                        transitionOutMobile: "fadeOut",
                        timeout: 1000,
                        progressBar: !1,
                        icon: 'icon-alert-triangle'
                    });
                    wishCount();
                    wishlistCheckout()
                }

            }
        })
    });

    //add to wishlist
    $("body").delegate("#wishlists","click", function (e) {
        e.preventDefault();
        var pid = $(this).attr("pid");
        var del_id = $(this).attr("remove_id");
        var b = $(this).data("iteration") || 1,
            c  = {
                title: "Product",
                animateInside: !1,
                position: "topRight",
                progressBar: !1,
                timeout: 1000,
                transitionIn: "fadeInLeft",
                transitionOut: "fadeOut",
                transitionInMobile: "fadeIn",
                transitionOutMobile: "fadeOut"
            };
        switch (b) {
            case 1:

                $.ajax({
                    url: "action.php",
                    method: "POST",
                    data: {addToWish:1, pId:pid},
                    success: function (data) {

                    }
                });
                $(this).addClass("active"), c.class = "iziToast-success", c.message = "added to your wishlist!", c.icon = "icon-check-circle";
                break;

            case 2:

                $.ajax({
                    url: "action.php",
                    method: "POST",
                    data: {removeItemFromWishlist: 1, deleteId: del_id},
                    success: function (data) {
                    }
                });
                $(this).removeClass("active"), c.class = "iziToast-danger", c.message = "removed from your wishlist!", c.icon = "icon-slash"
        }
        iziToast.show(c), b++, b > 2 && (b = 1), $(this).data("iteration", b)
    });

    //get all products from database
    getAllProducts();
    function getAllProducts() {
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {getAllProducts:1},
            success: function (data) {
                    $(".get_all_products").html(data);
            }
        })
    }

    //list view products
    getListProducts();
    function getListProducts() {
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {getListProducts:1},
            success: function (data) {
                $(".get_list_products").html(data);
            }
        })
    }
    //pagination
    page();
    function page() {
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {page:1},
            success: function (data) {
                $(".page_no").html(data);
            }
        })
    }

    //list view pagination
    listPage();
    function listPage() {
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {list_page:1},
            success: function (data) {
                $(".page_list_no").html(data);
            }
        })
    }

    //list view pagination
    $("body").delegate("#listpage","click", function () {
        var pn = $(this).attr("page");
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {
                getListProducts:1,
                setPage2:1,
                pageNumber2:pn
            },
            success: function (data) {
                $(".get_list_products").html(data);

            }
        })
    });

    //grid pagination
    $("body").delegate("#page","click", function () {
        var pn = $(this).attr("page");
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {
                getAllProducts:1,
                setPage:1,
                pageNumber:pn
            },
            success: function (data) {
                $(".get_all_products").html(data);

            }
        })
    });

    //sort products based on brands
    $("body").delegate(".selectBrand","click", function (e) {
        e.preventDefault();
        var bid = $(this).attr("bid");
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {selectBrand:1, brand_id:bid},
            success: function (data) {
                $(".get_all_products").html(data);
            }
        })
    });
    //sort by categories
    $("body").delegate(".category","click", function (e) {
        e.preventDefault();
        var cid = $(this).attr("cid");
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {getCategory:1, cat_id:cid},
            success: function (data) {
                $(".get_all_products").html(data);
            }
        })
    });

    //sort list view page by brands
    $("body").delegate(".selectBrand","click", function (e) {
        e.preventDefault();
        var bid = $(this).attr("bid");
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {selBrand:1, brandId:bid},
            success: function (data) {
                $(".get_list_products").html(data);

            }
        })
    });
    $("body").delegate(".category","click", function (e) {
        e.preventDefault();
        var cid = $(this).attr("cid");
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {listCat:1, catId:cid},
            success: function (data) {
                $(".get_list_products").html(data);
            }
        })
    });

    //filter prices on grid view
    $(".price_filter").on("click",function (e) {
        e.preventDefault();
        var price_min_range = $(".price_range").val();
        var price_max_range = $(".price_range2").val();

        $.ajax({
            url: "action.php",
            method: "POST",
            data: {
                price_min_range:price_min_range,
                price_max_range:price_max_range
            },
            success: function (data) {
                $(".get_all_products").html(data);
            }
        })
    });

    //filter prices on list view
    $(".range_filter").on("click", function (e) {
        e.preventDefault();
        var r1 = $(".min_range").val();
        var r2 = $(".max_range").val();

        $.ajax({
            url: "action.php",
            method: "POST",
            data: {
                min_range: r1,
                max_range: r2
            },
            success: function (data) {
                $(".get_list_products").html(data);
            }
        })
    });


});

