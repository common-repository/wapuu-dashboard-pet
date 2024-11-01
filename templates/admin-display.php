

<h2 class="nav-tab-wrapper">
    <a href="?page=WDPet-options" class="nav-tab">General</a>
    <a href="?page=WDPet-display" class="nav-tab nav-tab-active">Display</a>
    <a href="?page=WDPet-add" class="nav-tab">Additional Options</a>
    <a href="?page=WDPet-updates" class="nav-tab">Update Log</a>

</h2>

<p>
<div style="width: 90%; background-color: #296788; border-radius: 25px; display: block; margin: auto;"> <img src="<?php echo plugins_url() . '/wapuu-dashboard-pet/images/banner.png' ?>" style="display: block; width:50%; padding:10px; margin: auto; background-color: #296788;" title="Wapuu Dashboard Pet"> </div>
</p>

<div class="wrap">

<?php


	echo '<h1>' . esc_html__( 'Wapuu Dashboard Pet - Display Options', 'wapuudp' ) . '</h1>';

	?>

<form method='post' action='options.php'>

<?php echo '<h2>' . esc_html__( 'Location', 'wapuudp' ) . '</h2>';

settings_fields( 'WDPet-loc' );
do_settings_sections( 'WDPet-loc' );

echo '<p>' . esc_html__( 'You can use the buttons below to change the location of Wapuu. The choices are in the top admin menu or in your admin footer.', 'wapuudp' ) . '</p>'; ?>

<p><input type='radio' name='wapaloc' value='top' <?php checked('top', get_option('wapaloc'), true); ?> /> Top - Admin bar </p>
<p><input type='radio' name='wapaloc' value='bottom' <?php checked('bottom', get_option('wapaloc'), true); ?> /> Bottom - Footer area </p>
<p><input type='radio' name='wapaloc' value='both' <?php checked('both', get_option('wapaloc'), true); ?> /> Both </p>

<?php submit_button(__('Save settings', 'wapuudp')) ; ?>  </form> </div>


<?php

echo '<p align="right" style="margin-right:20px;"> Brought to you by <a  href="https://34sp.com/wordpress-hosting" target="_blank">34SP.com</a>, where Wapuus are always happy! </p>'

?>







