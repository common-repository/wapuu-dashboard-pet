<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"><head> 
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">

<style type="text/css">  #outlook a { padding: 0; }  .ReadMsgBody { width: 100%; }  .ExternalClass { width: 100%; }  .ExternalClass * { line-height:100%; }  body { margin: 0; padding: 0; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }  table, td { border-collapse:collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; }  img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; }  p { display: block; margin: 13px 0; }</style>

<style type="text/css">  @media only screen and (max-width:480px) {    @-ms-viewport { width:320px; }    @viewport { width:320px; }  }</style>

<link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700" rel="stylesheet" type="text/css">    <style type="text/css">        @import url(https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700);    </style>

<style type="text/css">  @media only screen and (min-width:480px) {    .mj-column-per-100 { width:100%!important; }  }</style></head><body style="background: #FFFFFF;">    <div class="mj-container" style="background-color:#FFFFFF;">

<div style="margin:0px auto;max-width:600px;"><table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;" align="center" border="0"><tbody><tr><td style="text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:9px 0px 9px 0px;">

<div class="mj-column-per-100 outlook-group-fix" style="vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;">

<table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0"><tbody><tr><td style="word-wrap:break-word;font-size:0px;padding:0px 20px 0px 20px;" align="center"><div style="cursor:auto;color:#000000;font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:11px;line-height:22px;text-align:center;"><h1 style="font-family: &apos;Cabin&apos;, sans-serif; line-height: 100%;">

	
	
<?php esc_html_e('Wapuu is feeling unwell', 'wapuudp'); ?>
	
	
	</h1></div></td></tr><tr><td style="word-wrap:break-word;font-size:0px;padding:0px 20px 0px 20px;" align="left"><div style="cursor:auto;color:#000000;font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:11px;line-height:22px;text-align:left;"><p>


<?php echo '<center><img src="' . plugins_url() . '/wapuu-dashboard-pet/images/sad.png" width="150"></center>'; ?>

<?php echo '<h2>' . esc_html__( 'Your website:', 'wapuudp' ) . '</h2>'; ?>

<?php echo '<P>' . home_url() . '</P>'; ?>


<?php _e('This is an automated email from your pal, Wapuu! I just wanted to let you know there are some WordPress updates you haven&apos;t actioned yet. Please login and update so I can feel better again!', 'wapuudp'); ?>

<?php echo '<h2>' . esc_html__( 'Your pending updates', 'wapuudp' ) . '</h2>'; ?>





<?php 
	
	if (!empty($update_wordpress[0]->response)) {
		echo '<h3>' . esc_html__( 'Core updates', 'wapuudp' ) . '</h3>';
		_e('Core needs updating!');
		}
	
	
?>

<?php 
	
	if (!empty($updatedeets['plugins'])) {
		
		echo '<h3>' . esc_html__( 'Plugin updates', 'wapuudp' ) . '</h3>';
		
		foreach ($updatedeets['plugins'] as $plugin) {
			echo $plugin . '<br>'; }
		
	}
	
	
?>

<?php 
	
	if (!empty($updatedeets['themes'])) {
		
		echo '<h3>' . esc_html__( 'Theme updates', 'wapuudp' ) . '</h3>';
		
		foreach ($updatedeets['themes'] as $themes) {
			echo $themes . '<br>'; }
		}
	
	
?>


		
</p></div></td></tr><tr><td style="word-wrap:break-word;font-size:0px;padding:0px 20px 0px 20px;" align="center"><div style="cursor:auto;color:#000000;font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:11px;line-height:22px;text-align:center;"><p><span style="color:#999999;">		
			
<?php _e('If you do not wish to receive these emails please login to your WordPress site and disable them in the &quot;Settings&quot; - &quot;Wapuu Dashboard Pet&quot; page.', 'wapuudp'); ?>


		
		
</span></p></div></td></tr></tbody></table></div></td></tr></tbody></table></div><</div></body></html>