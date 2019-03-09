<?php
include_once "db.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Coming Soon</title>
    <?php include_once "includes/header.php"?>
</head>
<body>
<!-- Google Tag Manager (noscript)-->


<!-- Page Content-->
<div class="row no-gutters">
    <div class="col-md-6 fh-section" style="background-image: url(assets/images/coming-soon-bg.jpg);">
        <span class="overlay" style="background-color: #000; opacity: .7;"></span>
        <div class="d-flex flex-column fh-section py-5 px-3 justify-content-between">
            <div class="w-100 text-center">
                <div class="d-inline-block mb-5" style="width: 136px;">
                    <img class="d-block" src="assets/images/logo/logo.jpg" alt="GiLo">
                </div>
                <h1 class="text-white text-normal mb-3">Coming Soon...</h1>
                <h6 class="text-white opacity-80 mb-4">Our website is currently under construction. It goes live in:</h6>
                <div class="countdown countdown-inverse" data-date-time="07/30/2018 12:00:00">
                    <div class="item">
                        <div class="days">00</div><span class="days_ref">Days</span>
                    </div>
                    <div class="item">
                        <div class="hours">00</div><span class="hours_ref">Hours</span>
                    </div>
                    <div class="item">
                        <div class="minutes">00</div><span class="minutes_ref">Mins</span>
                    </div>
                    <div class="item">
                        <div class="seconds">00</div><span class="seconds_ref">Secs</span>
                    </div>
                </div>
                <div class="pt-3 hidden-md-up"><a class="btn btn-primary scroll-to" href="#notify"><i class="icon-bell"></i>&nbsp;Notify Me!</a></div>
            </div>
            <div class="w-100 text-center">
                <p class="text-white mb-2">+233 57 444 9950</p><a class="navi-link-light" href="mailto:support@unishop.com">GiLoCooperate@gmail.com</a>
                <div class="pt-3">
                    <a class="social-button shape-circle sb-facebook sb-light-skin" href="#"><i class="socicon-facebook"></i></a>
                    <a class="social-button shape-circle sb-twitter sb-light-skin" href="#"><i class="socicon-twitter"></i></a>
                    <a class="social-button shape-circle sb-instagram sb-light-skin" href="#"><i class="socicon-instagram"></i></a>
                    <a class="social-button shape-circle sb-google-plus sb-light-skin" href="#"><i class="socicon-googleplus"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 fh-section" id="notify" data-offset-top="-1">
        <div class="d-flex flex-column fh-section py-5 px-3 justify-content-center align-items-center">
            <div class="text-center" style="max-width: 500px;">
                <div class="h1 text-normal mb-3">Notify Me!</div>
                <h6 class="text-muted mb-4">Let me know when your website is live and I can start order goods. Here is my:</h6>
                <form>
                    <div class="form-group">
                        <input class="form-control" type="text" placeholder="Name" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="email" placeholder="Email Address" required>
                    </div>
                    <button class="btn btn-primary" type="submit"><i class="icon-mail"></i>&nbsp;Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Back To Top Button-->
<a class="scroll-to-top-btn" href="#"><i class="icon-chevron-up"></i></a>
<!-- Backdrop-->
<div class="site-backdrop"></div>
<!-- JavaScript (jQuery) libraries, plugins and custom scripts-->
<script src="assets/js/vendor.js"></script>
<script src="assets/js/scripts.js"></script>
</body>
</html>