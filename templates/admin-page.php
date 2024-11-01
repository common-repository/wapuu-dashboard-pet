<h2 class="nav-tab-wrapper">
    <a href="?page=WDPet-options" class="nav-tab nav-tab-active">General</a>
    <a href="?page=WDPet-display" class="nav-tab">Display</a>
    <a href="?page=WDPet-add" class="nav-tab">Additional Options</a>
    <a href="?page=WDPet-updates" class="nav-tab">Update Log</a>

</h2>
<p>
<div style="width: 90%; background-color: #296788; border-radius: 25px; display: block; margin: auto;"> <img src="<?php echo plugins_url() . '/wapuu-dashboard-pet/images/banner.png' ?>" style="display: block; width:50%; padding:10px; margin: auto; background-color: #296788;" title="Wapuu Dashboard Pet"> </div>
</p>



<div class="wrap">
<div id="col-container">
<div id="col-left">
<div class="col-wrap">
<div class="inside">

<?php echo '<h1>' . esc_html__( 'Wapuu Dashboard Pet', 'wapuudp' ) . '</h1>';

echo '<p>' . esc_html__( 'Wapuu is your friendly dashboard virtual pet who monitors the health of your site by making sure your backups are ran and WordPress is kept up to date.', 'wapuudp' ) . '</p>';

echo '<h2>' . esc_html__( 'Email notifications', 'wapuudp' ) . '</h2>';

echo '<p>' . esc_html__( 'You can enable notifications from Wapuu which will send you a daily email if they are not feeling well. This allows you to keep on top of your updates easier. To disable updates simply clear your email from the field.', 'wapuudp' ) . '</p>';

echo '<p>' . esc_html__( 'If Wapuu needs to get in touch, what email address would you like to be contacted on?', 'wapuudp' ) . '</p>';



?>
<form method='post' action='options.php'>

<?php

settings_fields( 'WDPet-email' );
do_settings_sections( 'WDPet-email' );


?>

<p><input type='email' name='wapaemail' value='<?php echo get_option('wapaemail'); ?>' /></p>


<?php submit_button(__('Save settings', 'wapuudp')) ; ?>  </form>


</div></div></div></div>

<div id="col-right">
<div class="col-wrap">
<div class="wrap"><div class="postbox" style="padding:20px;">




<?php





echo '<h1>' . esc_html__( "Wapuu health report", 'wapuudp' ) . '</h1>';

echo '<p>' . esc_html__( "Here you can check on Wapuu's status and get feedback on what aspects of your site are making them happy, as well as what they don't like.", 'wapuudp' ) . '</p>';

$WapuuDashboardPet = new WapuuDashboardPet();

$adminupdates = $WapuuDashboardPet->get_update_details();

$update_wordpress = get_core_updates( array('dismissed' => false) );

	if ( ! empty( $update_wordpress ) && ! in_array( $update_wordpress[0]->response, array('development', 'latest') ) && current_user_can('update_core') ) {
		echo '<h3>' . esc_html__( 'Core updates', 'wapuudp' ) . '</h3>';
		_e( '<font color="red"size="6" padding-right:5px;>✘</font> ' . '<font style="
  vertical-align: middle; margin: 0px;">Core needs updating! Update WordPress to cheer Wapuu up!</font>');

    echo '<a href="update-core.php"><i>Click here to manage and run your updates!</i></a></font>';

		}else{

		echo '<h3>' . esc_html__( 'Core updates', 'wapuudp' ) . '</h3>';
		_e('<font color="green" size="6" style="
  vertical-align: middle; margin: 0px;"> ✓ </font> <font style="
  vertical-align: middle; margin: 0px;"> Core is up to date! This makes Wapuu happy! </font>');

		}

	if (!empty($adminupdates['themes'])) {

		echo '<h3>' . esc_html__( 'Theme updates', 'wapuudp' ) . '</h3>';
		echo _e( '<p>Wapuu would feel better if the following Themes were updated soon:</p>' );

		foreach ($adminupdates['themes'] as $themes) {
			echo '<font color="red"size="6" style="
  vertical-align: middle; padding-right:5px;">✘</font> <font style="
  vertical-align: middle; margin: 0px;">' . $themes . '</font><br><br>'; }

    echo '<a href="update-core.php"><i>Click here to manage and run your updates!</i></a></font>';

		}else{

		echo '<h3>' . esc_html__( 'Theme updates', 'wapuudp' ) . '</h3>';
		_e('<font color="green"size="6" style="
  vertical-align: middle; margin: 0px;"> ✓ </font> <font style="
  vertical-align: middle; margin: 0px;">All themes are up to date! Wapuu loves this!</font>');




		}


	if (!empty($adminupdates['plugins'])) {

		echo '<h3>' . esc_html__( 'Plugin updates', 'wapuudp' ) . '</h3>';
		echo _e( '<p>Wapuu is feeling a little sad about the following pending plugin updates:</p>' );

		foreach ($adminupdates['plugins'] as $plugin) {
			echo '<font color="red"size="6" style="
  vertical-align: middle; margin: 0px; padding-right:5px;">✘</font> <font style="
  vertical-align: middle; margin: 0px;">' . $plugin . '</font><br><br>'; }

  echo '<a href="update-core.php"><i>Click here to manage and run your updates!</i></a></font>';

		}else{

		echo '<h3>' . esc_html__( 'Plugin updates', 'wapuudp' ) . '</h3>';
		_e('<font color="green"size="6" style="
  vertical-align: middle; margin: 0px;"> ✓ </font> <font style="
  vertical-align: middle; margin: 0px;">All plugins are up to date! Wapuu thinks that is amazing!</font>');

		}

		?>


<?php


if ($WapuuDashboardPet->postnag_total() > 1 & get_option('wapapostnag') != 0) {

		echo '<h3>' . esc_html__( 'Content updates', 'wapuudp' ) . '</h3>';
		_e('<font color="red"size="6" style="
  vertical-align: middle; padding-right:5px;">✘</font> <font style="
  vertical-align: middle; margin: 0px;">Wapuu is kinda sad you have not posted in a while, is it about time you updated your content? - <a href="edit.php"><i>Get posting!</i></a></font>');

}

if ($WapuuDashboardPet->get_pending_comments() == 1 & get_option('wapacomnag') != 0) {

		echo '<h3>' . esc_html__( 'Pending comments', 'wapuudp' ) . '</h3>';
		_e('<font color="red"size="6" style="
  vertical-align: middle; padding-right:5px;">✘</font> <font style="
  vertical-align: middle; margin: 0px;">Wapuu is saddened by the amount of pending comments your site has, approve or delete them to keep Wapuu happy? - <a href="edit-comments.php"><i>Manage comments</i></a></font></br>');

}




?> </br></div>

<?php

echo '<p align="right"> Brought to you by <a  href="https://34sp.com/wordpress-hosting" target="_blank">34SP.com</a>, where Wapuus are always happy! </p>'

?>

</div></div></div></div>

