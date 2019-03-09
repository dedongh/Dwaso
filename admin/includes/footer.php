<!-- Backdrop-->
<div class="site-backdrop"></div>
<script src="../assets/js/jquery.js"></script>
<script src="../assets/js/vendor.js"></script>
<script src="../assets/js/scripts.js"></script>
<script src="../assets/js/iziToast.min.js"></script>
<!-- Customizer scripts-->
<script src="../assets/customizer/customizer.js"></script>

<script>
    function get_child_options(selected) {
        if (typeof selected === "undefined") {
            var selected = "";
        }
        var parentID = $("#ct").val();

        $.ajax({
            url: "parsers/child_categories.php",
            method: "POST",
            data: {parentID : parentID, selected:selected},
            success: function (data) {
                $("#cc").html(data);
            },
            error: function () {
                alert("An Error occurred with Child Options")
            }
        })
    }

    $('select[name="category"]').change(function () {
        get_child_options();
    });

    function load_unseen_notification(view = "") {
        $.ajax({
            url: "parsers/notification.php",
            method: "POST",
            data: {view:view},
            dataType: "json",
            success: function (data) {
                $(".notes").html(data.notification);
                if (data.unseen_notification > 0) {
                    $(".not_cnt").html(data.unseen_notification)
                }
            }
        })
    }

    load_unseen_notification();
    $(document).on("click", ".not_clk", function () {
        $(".not_cnt").html("");
        load_unseen_notification("yes")
    });

    setInterval(function () {
        load_unseen_notification();
    }, 5000)

</script>
