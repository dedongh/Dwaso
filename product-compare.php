<?php
include_once "db.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Product Comparison</title>
    <?php include_once "includes/header.php" ?>
</head>
<body>
<!-- Google Tag Manager (noscript)-->


<!--Header-->
<?php  include_once "includes/nav.php"; ?>
<!-- Page Title-->
<div class="page-title">
    <div class="container">
        <div class="column">
            <h1>Product Comparison</h1>
        </div>
        <div class="column">
            <ul class="breadcrumbs">
                <li><a href="#">Home</a>
                </li>
                <li class="separator">&nbsp;</li>
                <li>Product Comparison</li>
            </ul>
        </div>
    </div>
</div>
<!--Page Content-->
<div class="container padding-bottom-2x mb-2">
    <div class="comparison-table">
        <table class="table table-bordered">
            <thead class="bg-secondary">
            <tr>
                <td class="align-middle">
                    <select class="form-control" id="compare-criteria">
                        <option>Comparison Criteria</option>
                        <option>Summary</option>
                        <option>General</option>
                        <option>Multimedia</option>
                        <option>Performance</option>
                        <option>Design</option>
                        <option>Display</option>
                        <option>Storage</option>
                        <option>Camera</option>
                        <option>Battery</option>
                        <option>Price &amp; Rating</option>
                    </select>
                    <div class="pt-3">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="differences">
                            <label class="custom-control-label" for="differences">Show differences only</label>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="comparison-item">
                        <span class="remove-item"><i class="icon-x"></i></span><a class="comparison-item-thumb" href="#"><img src="assets/images/shop/comparison/th01.jpg" alt="Apple iPhone X"></a><a class="comparison-item-title" href="#">Apple iPhone X</a><a class="btn btn-outline-primary btn-sm" href="#" data-toast data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-check-circle" data-toast-title="Product" data-toast-message="successfuly added to cart!">Add to Cart</a></div>
                </td>
                <td>
                    <div class="comparison-item"><span class="remove-item"><i class="icon-x"></i></span><a class="comparison-item-thumb" href="#"><img src="assets/images/shop/comparison/th02.jpg" alt="Google Pixel 2 XL"></a><a class="comparison-item-title" href="#">Google Pixel 2 XL</a><a class="btn btn-outline-primary btn-sm" href="#" data-toast data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-check-circle" data-toast-title="Product" data-toast-message="successfully added to cart!">Add to Cart</a></div>
                </td>
                <td>
                    <div class="comparison-item"><span class="remove-item"><i class="icon-x"></i></span><a class="comparison-item-thumb" href="#"><img src="assets/images/shop/comparison/th03.jpg" alt="Samsung Galaxy S9+"></a><a class="comparison-item-title" href="#">Samsung Galaxy S9+</a><a class="btn btn-outline-primary btn-sm" href="#" data-toast data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-check-circle" data-toast-title="Product" data-toast-message="successfully added to cart!">Add to Cart</a></div>
                </td>
            </tr>
            </thead>
            <tbody>
            <tr class="bg-secondary">
                <th class="text-uppercase">Summary</th>
                <td><span class="text-medium">&nbsp;Apple iPhone X&nbsp;</span></td>
                <td><span class="text-medium">&nbsp;Google Pixel 2 XL&nbsp;</span></td>
                <td><span class="text-medium">&nbsp;Samsung Galaxy S9+&nbsp;</span></td>
            </tr>
            <tr>
                <th>Performance</th>
                <td>Hexa Core</td>
                <td>Octa Core</td>
                <td>Octa Core</td>
            </tr>
            <tr>
                <th>Display</th>
                <td>5.8" (14.73 cm)</td>
                <td>6.0" (15.24 cm)</td>
                <td>6.2" (15.75 cm)</td>
            </tr>
            <tr>
                <th>Storage</th>
                <td>64 GB</td>
                <td>64 GB</td>
                <td>64 GB</td>
            </tr>
            <tr>
                <th>Camera</th>
                <td>12 MP</td>
                <td>12.2 MP</td>
                <td>12 MP</td>
            </tr>
            <tr>
                <th>Battery</th>
                <td>2716 mAh</td>
                <td>3520 mAh</td>
                <td>3500 mAh</td>
            </tr>
            <tr class="bg-secondary">
                <th class="text-uppercase">General</th>
                <td><span class="text-medium">&nbsp;Apple iPhone X&nbsp;</span></td>
                <td><span class="text-medium">&nbsp;Google Pixel 2 XL&nbsp;</span></td>
                <td><span class="text-medium">&nbsp;Samsung Galaxy S9+&nbsp;</span></td>
            </tr>
            <tr>
                <th>Quick Charging</th>
                <td>Yes</td>
                <td>Yes</td>
                <td>Yes</td>
            </tr>
            <tr>
                <th>Operating System</th>
                <td>iOS v11.0.1</td>
                <td>Android v8.0 (Oreo)	</td>
                <td>Android v8.0 (Oreo)	</td>
            </tr>
            <tr>
                <th>Sim Slots</th>
                <td>Single SIM, GSM</td>
                <td>Single SIM, GSM</td>
                <td>Dual SIM, GSM+GSM</td>
            </tr>
            <tr>
                <th>Launch Date</th>
                <td>November 3, 2017 (Official)</td>
                <td>November 15, 2017 (Official)</td>
                <td>March 16, 2018 (Official)</td>
            </tr>
            <tr>
                <th>Sim Size</th>
                <td>SIM1: Nano</td>
                <td>SIM1: Nano</td>
                <td>SIM1: Nano SIM2: Nano (Hybrid)</td>
            </tr>
            <tr>
                <th>Network</th>
                <td>4G: Available (supports Indian bands) 3G: Available, 2G: Available</td>
                <td>4G: Available (supports Indian bands) 3G: Available, 2G: Available</td>
                <td>4G: Available (supports Indian bands) 3G: Available, 2G: Available</td>
            </tr>
            <tr>
                <th>Fingerprint Sensor</th>
                <td>No</td>
                <td>Yes</td>
                <td>Yes</td>
            </tr>
            <tr class="bg-secondary">
                <th class="text-uppercase">Multimedia</th>
                <td><span class="text-medium">&nbsp;Apple iPhone X&nbsp;</span></td>
                <td><span class="text-medium">&nbsp;Google Pixel 2 XL&nbsp;</span></td>
                <td><span class="text-medium">&nbsp;Samsung Galaxy S9+&nbsp;</span></td>
            </tr>
            <tr>
                <th>Loudspeaker</th>
                <td>Yes</td>
                <td>Yes</td>
                <td>Yes</td>
            </tr>
            <tr>
                <th>FM Radio</th>
                <td>No</td>
                <td>No</td>
                <td>No</td>
            </tr>
            <tr>
                <th>Audio Jack</th>
                <td>Lightning</td>
                <td>3.5 mm</td>
                <td>3.5 mm</td>
            </tr>
            <tr class="bg-secondary">
                <th class="text-uppercase">Performance</th>
                <td><span class="text-medium">&nbsp;Apple iPhone X&nbsp;</span></td>
                <td><span class="text-medium">&nbsp;Google Pixel 2 XL&nbsp;</span></td>
                <td><span class="text-medium">&nbsp;Samsung Galaxy S9+&nbsp;</span></td>
            </tr>
            <tr>
                <th>Chipset</th>
                <td>Apple A11 Bionic</td>
                <td>Qualcomm Snapdragon 835 MSM8998</td>
                <td>Samsung Exynos 9 Octa 9810	</td>
            </tr>
            <tr>
                <th>Graphics</th>
                <td>Apple GPU (three-core graphics)</td>
                <td>Adreno 540</td>
                <td>Mali-G72 MP18</td>
            </tr>
            <tr>
                <th>Processor</th>
                <td>Hexa Core (2.53 GHz, Dual core, Monsoon + 1.42 GHz, Quad core, Mistral)</td>
                <td>Octa core (2.45 GHz, Quad core, Kryo 280 + 1.9 GHz, Quad core, Kryo 280)</td>
                <td>Octa core (2.7 GHz, Quad core, M2 Mongoose + 1.7 GHz, Quad core, Cortex A53)</td>
            </tr>
            <tr>
                <th>Architecture</th>
                <td>64 bit</td>
                <td>64 bit</td>
                <td>64 bit</td>
            </tr>
            <tr>
                <th>RAM</th>
                <td>3 GB</td>
                <td>4 GB</td>
                <td>6 GB</td>
            </tr>
            <tr class="bg-secondary">
                <th class="text-uppercase">Design</th>
                <td><span class="text-medium">&nbsp;Apple iPhone X&nbsp;</span></td>
                <td><span class="text-medium">&nbsp;Google Pixel 2 XL&nbsp;</span></td>
                <td><span class="text-medium">&nbsp;Samsung Galaxy S9+&nbsp;</span></td>
            </tr>
            <tr>
                <th>Build Material</th>
                <td>Case: AluminiumBack: Mineral Glass</td>
                <td>Case: AluminiumBack: Aluminium</td>
                <td>Case: AluminiumBack: Mineral Glass</td>
            </tr>
            <tr>
                <th>Thickness</th>
                <td>7.7 mm</td>
                <td>7.9 mm</td>
                <td>8.5 mm</td>
            </tr>
            <tr>
                <th>Width</th>
                <td>70.9 mm</td>
                <td>76.7 mm</td>
                <td>73.8 mm</td>
            </tr>
            <tr>
                <th>Height</th>
                <td>143.6 mm</td>
                <td>157.9 mm</td>
                <td>158.1 mm</td>
            </tr>
            <tr>
                <th>Weight</th>
                <td>174 grams</td>
                <td>175 grams</td>
                <td>189 grams</td>
            </tr>
            <tr>
                <th>Waterproof</th>
                <td>Yes Water resistant (up to 30 minutes in a depth of 1 meter), IP67</td>
                <td>Yes Water resistant (up to 30 minutes in a depth of 1 meter), IP67</td>
                <td>Yes Water resistant (up to 30 minutes in a depth of 1.5 meter), IP68</td>
            </tr>
            <tr>
                <th>Colors</th>
                <td>Silver, Space Grey</td>
                <td>Black, Black and White</td>
                <td>Midnight Black, Coral Blue, Lilac Purple</td>
            </tr>
            <tr class="bg-secondary">
                <th class="text-uppercase">Display</th>
                <td><span class="text-medium">&nbsp;Apple iPhone X&nbsp;</span></td>
                <td><span class="text-medium">&nbsp;Google Pixel 2 XL&nbsp;</span></td>
                <td><span class="text-medium">&nbsp;Samsung Galaxy S9+&nbsp;</span></td>
            </tr>
            <tr>
                <th>Display Type</th>
                <td>OLED</td>
                <td>P-OLED</td>
                <td>Super AMOLED</td>
            </tr>
            <tr>
                <th>Pixel Density</th>
                <td>463 ppi</td>
                <td>537 ppi</td>
                <td>531 ppi</td>
            </tr>
            <tr>
                <th>Screen Protection</th>
                <td>Yes</td>
                <td>Corning Gorilla Glass v5</td>
                <td>Corning Gorilla Glass v5</td>
            </tr>
            <tr>
                <th>Screen Size</th>
                <td>5.8 inches (14.73 cm)</td>
                <td>6.0 inches (15.24 cm)</td>
                <td>6.2 inches (15.75 cm)	</td>
            </tr>
            <tr>
                <th>Screen Resolution</th>
                <td>1125 x 2436 pixels</td>
                <td>1440 x 2880 pixels</td>
                <td>1440 x 2960 pixels	</td>
            </tr>
            <tr>
                <th>Touch Screen</th>
                <td>Yes 3D Touch Touchscreen, Multi-touch</td>
                <td>Yes Capacitive Touchscreen, Multi-touch</td>
                <td>Yes Capacitive Touchscreen, Multi-touch</td>
            </tr>
            <tr class="bg-secondary">
                <th class="text-uppercase">Storage</th>
                <td><span class="text-medium">&nbsp;Apple iPhone X&nbsp;</span></td>
                <td><span class="text-medium">&nbsp;Google Pixel 2 XL&nbsp;</span></td>
                <td><span class="text-medium">&nbsp;Samsung Galaxy S9+&nbsp;</span></td>
            </tr>
            <tr>
                <th>Internal Memory</th>
                <td>64 GB</td>
                <td>64 GB</td>
                <td>64 GB</td>
            </tr>
            <tr>
                <th>Expandable Memory</th>
                <td>No</td>
                <td>No</td>
                <td>Yes Up to 400 GB</td>
            </tr>
            <tr class="bg-secondary">
                <th class="text-uppercase">Camera</th>
                <td><span class="text-medium">&nbsp;Apple iPhone X&nbsp;</span></td>
                <td><span class="text-medium">&nbsp;Google Pixel 2 XL&nbsp;</span></td>
                <td><span class="text-medium">&nbsp;Samsung Galaxy S9+&nbsp;</span></td>
            </tr>
            <tr>
                <th>Settings</th>
                <td>Exposure compensation, ISO control</td>
                <td>Exposure compensation, ISO control</td>
                <td>Exposure compensation</td>
            </tr>
            <tr>
                <th>Aperture</th>
                <td>F2.2</td>
                <td>F2.4</td>
                <td>F1.7</td>
            </tr>
            <tr>
                <th>Camera Features</th>
                <td>10 x Digital Zoom, Optical Zoom, Auto Flash, Face detection, Touch to focus</td>
                <td>Fixed Focus</td>
                <td>Wide Angle Selfie</td>
            </tr>
            <tr>
                <th>Image Resolution</th>
                <td>4000 x 3000 Pixels</td>
                <td>4000 x 3000 Pixels</td>
                <td>4000 x 3000 Pixels</td>
            </tr>
            <tr>
                <th>Sensor</th>
                <td>BSI Sensor</td>
                <td>CMOS image sensor</td>
                <td>CMOS image sensor</td>
            </tr>
            <tr>
                <th>Autofocus</th>
                <td>Yes</td>
                <td>No</td>
                <td>Yes</td>
            </tr>
            <tr>
                <th>Shooting Modes</th>
                <td>Continuous Shooting, High Dynamic Range mode (HDR), Burst mode</td>
                <td>Continuous Shooting, High Dynamic Range mode (HDR)</td>
                <td>Continuous Shooting, High Dynamic Range mode (HDR)</td>
            </tr>
            <tr>
                <th>Optical Image Stabilisation</th>
                <td>Yes Dual optical image stabilization</td>
                <td>Yes</td>
                <td>Yes</td>
            </tr>
            <tr>
                <th>Flash</th>
                <td>Yes Retina Flash</td>
                <td>Yes Dual LED Flash</td>
                <td>Yes LED Flash</td>
            </tr>
            <tr class="bg-secondary">
                <th class="text-uppercase">Battery</th>
                <td><span class="text-medium">&nbsp;Apple iPhone X&nbsp;</span></td>
                <td><span class="text-medium">&nbsp;Google Pixel 2 XL&nbsp;</span></td>
                <td><span class="text-medium">&nbsp;Samsung Galaxy S9+&nbsp;</span></td>
            </tr>
            <tr>
                <th>Talktime</th>
                <td>Up to 21 Hours(3G)</td>
                <td>Up to 24 Hours(3G)</td>
                <td>Up to 25 Hours(3G)</td>
            </tr>
            <tr>
                <th>Quick Charging</th>
                <td>Yes Fast, 50 % in 30 minutes</td>
                <td>Yes</td>
                <td>Yes</td>
            </tr>
            <tr>
                <th>Wireless Charging</th>
                <td>Yes</td>
                <td>No</td>
                <td>Yes</td>
            </tr>
            <tr>
                <th>Type</th>
                <td>Li-ion</td>
                <td>Li-ion</td>
                <td>Li-ion</td>
            </tr>
            <tr>
                <th>Capacity</th>
                <td>2716 mAh</td>
                <td>3520 mAh</td>
                <td>3500 mAh</td>
            </tr>
            <tr class="bg-secondary">
                <th class="text-uppercase">Price &amp; Rating</th>
                <td><span class="text-medium">&nbsp;Apple iPhone X&nbsp;</span></td>
                <td><span class="text-medium">&nbsp;Google Pixel 2 XL&nbsp;</span></td>
                <td><span class="text-medium">&nbsp;Samsung Galaxy S9+&nbsp;</span></td>
            </tr>
            <tr>
                <th>Price</th>
                <td>₵4,939.99</td>
                <td>₵2,849.99</td>
                <td>₵3,839.99</td>
            </tr>
            <tr>
                <th>Rating</th>
                <td>4.5/5</td>
                <td>4/5</td>
                <td>4/5</td>
            </tr>
            <tr>
                <th></th>
                <td><a class="btn btn-outline-primary btn-sm btn-block" href="#" data-toast data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-check-circle" data-toast-title="Product" data-toast-message="successfully added to cart!">Add to Cart</a></td>
                <td><a class="btn btn-outline-primary btn-sm btn-block" href="#" data-toast data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-check-circle" data-toast-title="Product" data-toast-message="successfully added to cart!">Add to Cart</a></td>
                <td><a class="btn btn-outline-primary btn-sm btn-block" href="#" data-toast data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-check-circle" data-toast-title="Product" data-toast-message="successfully added to cart!">Add to Cart</a></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<!--footer-->
<?php include_once "includes/footer.php"?>

</body>
</html>