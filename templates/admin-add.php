<h2 class="nav-tab-wrapper">
    <a href="?page=WDPet-options" class="nav-tab">General</a>
    <a href="?page=WDPet-display" class="nav-tab">Display</a>
    <a href="?page=WDPet-add" class="nav-tab nav-tab-active">Additional Options</a>
    <a href="?page=WDPet-updates" class="nav-tab">Update Log</a>

</h2>
<p>
<div style="width: 90%; background-color: #296788; border-radius: 25px; display: block; margin: auto;"> <img src="<?php echo plugins_url() . '/wapuu-dashboard-pet/images/banner.png' ?>" style="display: block; width:50%; padding:10px; margin: auto; background-color: #296788;" title="Wapuu Dashboard Pet"> </div>
</p>

<div class="wrap">


<?php


	echo '<h1>' . esc_html__( 'Wapuu Dashboard Pet - Additional Options', 'wapuudp' ) . '</h1>';


?>

<form method='post' action='options.php'>

<?php echo '<h2>' . esc_html__( 'Post reminder', 'wapuudp' ) . '</h2>';

settings_fields( 'WDPet-postnag' );
do_settings_sections( 'WDPet-postnag' );

    $defaultnumber = get_option('wapapostnag');
    if( $defaultnumber == "")
    {
        $defaultnumber = '0';
    }

echo '<p>' . esc_html__( 'Do you need that extra push to keep your content up to date? Wapuu can help you to keep track of how often you are posting to your blog!', 'wapuudp' ) . '</p>';

echo '<p>' . esc_html__( 'You can specify how often you want to post to your blog below and Wapuu will become a little sad if you fail to meet your blogging goal. Keep him happy by posting content regularly!', 'wapuudp' ) . '</p>';

echo '<p><b>' . esc_html__( 'If you do not want Wapuu to monitor how often you post, set this value to 0.', 'wapuudp' ) . '</b></p>';

echo esc_html__( 'How many days should go by before Wapuu gets sad?:' ); ?> <input type='number' name='wapapostnag' value='<?php echo $defaultnumber; ?>' />

<?php submit_button(__('Save settings', 'wapuudp')) ;



?> </form>

<form method='post' action='options.php'>




<?php echo '<h2>' . esc_html__( 'Pending comment tracking', 'wapuudp' ) . '</h2>';

settings_fields( 'WDPet-comnag' );
do_settings_sections( 'WDPet-comnag' );

echo '<p>' . esc_html__( 'Do you want Wapuu to keep an eye on your comment maintenance?', 'wapuudp' ) . '</p>';

echo '<p>' . esc_html__( 'Too many pending comments stored in your database can slow your site down, so Wapuu wants to help you keep this at a level that is reasonable to you.', 'wapuudp' ) . '</p>';

echo '<p><b>' . esc_html__( 'If you do not want Wapuu to monitor your comments, set this value to "Disabled".', 'wapuudp' ) . '</b></p>';

echo esc_html__( 'How many pending comments should be allowed before Wapuu gets sad:' ); ?>

 <select name="wapacomnag">
    <option <?php if (get_option('wapacomnag') == 0){ echo 'selected';} ?> value="0">Disabled</option>
    <option <?php if (get_option('wapacomnag') == 50){ echo 'selected';} ?> value="50">50</option>
    <option <?php if (get_option('wapacomnag') == 100){ echo 'selected';} ?> value="100">100</option>
    <option <?php if (get_option('wapacomnag') == 500){ echo 'selected';} ?> value="500">500</option>
  </select>

<?php submit_button(__('Save settings', 'wapuudp')) ;



?> </form>




</div>

<?php

echo '<p align="right" style="margin-right:20px;"> Brought to you by <a  href="https://34sp.com/wordpress-hosting" target="_blank">34SP.com</a>, where Wapuus are always happy! </p>'

?>