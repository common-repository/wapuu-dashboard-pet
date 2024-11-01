<h2 class="nav-tab-wrapper">
    <a href="?page=WDPet-options" class="nav-tab">General</a>
    <a href="?page=WDPet-display" class="nav-tab">Display</a>
    <a href="?page=WDPet-add" class="nav-tab">Additional Options</a>
    <a href="?page=WDPet-updates" class="nav-tab nav-tab-active">Update Log</a>

</h2>
<p>
<div style="width: 90%; background-color: #296788; border-radius: 25px; display: block; margin: auto;"> <img src="https://wapuudashboardpet.com/wp/wp-content/uploads/2018/09/ban2.png" style="display: block; width:50%; padding:10px; margin: auto; background-color: #296788;" title="Wapuu Dashboard Pet"> </div>
</p>

<div class="wrap">
<div id="col-container">
<div class="col-wrap">
<div class="inside">
<div id="col-left">

<?php


	echo '<h1>' . esc_html__( 'About', 'wapuudp' ) . '</h1>';


echo '<p>' . esc_html__( 'Wapuu Dashboard Pet is a WordPress plugin featuring a cute little Wapuu that lives inside your WordPress admin panel.', 'wapuudp' ) . '</p>';

echo '<p>' . esc_html__( 'Keep Wapuu happy and healthy by keeping your site happy and healthy.', 'wapuudp' ) . '</p>';

echo 'Website: <a  href="https://wapuudashboardpet.com" target="_blank">WapuuDashboardPet.com</a></br> Support forums: <a  href="https://wordpress.org/support/plugin/wapuu-dashboard-pet" target="_blank">WordPress.org</a></p>';


?>

</div>

<div id="col-right">
<div class="col-wrap">
<div class="postbox" style="padding:20px;">
<?php

$wdp_lines = file(WP_CONTENT_DIR . '/plugins/wapuu-dashboard-pet/readme.txt');
$wdp_first3 = str_replace("=", "", array_slice($wdp_lines, 33, 60));
echo implode("<br>", $wdp_first3);

?>

</div>

<?php

echo '<p align="right"> Brought to you by <a  href="https://34sp.com/wordpress-hosting" target="_blank">34SP.com</a>, where Wapuus are always happy! </p>'

?>

</div></div></div></div></div></div>

