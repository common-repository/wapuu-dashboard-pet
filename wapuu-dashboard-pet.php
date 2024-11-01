<?php

/*
Plugin Name: Wapuu Dashboard Pet
Plugin URI: https://wapuudashboardpet.com
Description: Adds a digital pet to your site who lives off your updates.
Author: 34SP.com
Version: 1.3.5
Author URI: https://34sp.com
*/



  class WapuuDashboardPet{

    /**
     * LOADS IN PRIMARY ACTIONS
     *
     * @since 1.0.0
     *
     * @return true
     */
    function load(){

        add_action('admin_init', array($this, 'admin_init'));
        add_action('admin_menu', array($this, 'admin_menu'));
        add_action('WDPet_Weekly', array($this,'weekly_email'));

      }

    /**
     * LOAD ADMIN INIT AND REGISTER OPTIONS
     *
     * @since 1.0.0
     *
     * @return true
     */
    function admin_init(){

        register_setting('WDPet-email', 'wapaemail');
        register_setting('WDPet-loc', 'wapaloc');
        register_setting('WDPet-postnag', 'wapapostnag');
        register_setting('WDPet-comnag', 'wapacomnag');

        add_action('admin_footer_text', array($this,'plugin_display'));

      }

    /**
     * ADD THE WapuuDashboardPet OPTIONS PAGES
     *
     * @since 1.3.0
     *
     * @return true
     */

    function admin_menu(){

        add_options_page('Wapuu Dashboard Pet Options', 'Wapuu Dashboard Pet', 'manage_options', 'WDPet-options', array($this,'options'));

        add_submenu_page(null, 'Wapuu Display', 'Wapuu Display', 'manage_options', 'WDPet-display', array($this,'display'));
        add_submenu_page(null, 'Wapuu Updates', 'Wapuu Updates', 'manage_options', 'WDPet-updates', array($this,'displayupdates'));
        add_submenu_page(null, 'Wapuu Additions', 'Wapuu Additions', 'manage_options', 'WDPet-add', array($this,'displayadd'));

      }

    function options(){

        $WDP_options_page = plugin_dir_path(__FILE__);
        include_once $WDP_options_page . 'templates/admin-page.php';

      }

    function display(){

        $WDP_options_page = plugin_dir_path(__FILE__);
        include_once $WDP_options_page . 'templates/admin-display.php';

      }

    function displayupdates(){

        $WDP_options_page = plugin_dir_path(__FILE__);
        include_once $WDP_options_page . 'templates/admin-updates.php';

      }

    function displayadd(){
        $WDP_options_page = plugin_dir_path(__FILE__);
        include_once $WDP_options_page . 'templates/admin-add.php';

      }

    /**
     * CRON ACTIVATION
     *
     * @since 1.1.2
     *
     * @return true
     */

    function cron_activation(){

        if (wp_next_scheduled('WDPet_Daily')) {
            wp_clear_scheduled_hook('WDPet_Daily');
        }

        if (!wp_next_scheduled('WDPet_Weekly')) {
            wp_schedule_event(time(), 'weekly', 'WDPet_Weekly');
        }

      }

    /**
     * Deactivation Commands
     *
     * @since 1.3.3
     *
     * @return true
     */
    function wdp_deactivation(){

        wp_clear_scheduled_hook('WDPet_Weekly');
        delete_option('wapaloc');
        delete_option('wapaemail');
        delete_option('wapapostnag');
      }

    /**
     * RETRIEVE UPDATE DATA
     *
     * @since 1.0.0
     *
     * @return true
     */

    function get_updates(){

        $WDP_updates_plugin_count = 0;
        $WDP_updates_core_count   = 0;
        $WDP_updates_theme_count  = 0;

        $update_plugins = get_site_transient('update_plugins');
        if (!empty($update_plugins->response)) {
            $WDP_updates_plugin_count = count($update_plugins->response);
        }
        $update_themes = get_site_transient('update_themes');
        if (!empty($update_themes->response)) {
            $WDP_updates_theme_count = count($update_themes->response);
        }
        $update_wordpress = $this->get_core_updates(array(
            'dismissed' => false
        ));
        if
        (!empty($update_wordpress) && !in_array($update_wordpress[0]->response, array(
            'development',
            'latest'
            )) && current_user_can('update_core')) {
            $WDP_updates_core_count = 3;
        }


        return $WDP_updates_plugin_count + $WDP_updates_core_count + $WDP_updates_theme_count;
        }

    /**
     * RETRIEVE DETAILED UPDATE DATA
     *
     * @since 1.1.0
     *
     * @return true
     */
    function get_update_details(){

        $return = array();

        $update_plugins = get_site_transient('update_plugins');

        if (!empty($update_plugins->response) && is_array($update_plugins->response)) {
            $return['plugins'] = array();
            foreach ($update_plugins->response as $plugin => $data) {
                $return['plugins'][] = $data->slug;
            }
        }

        $update_themes = get_site_transient('update_themes');
        if (!empty($update_themes->response) && is_array($update_themes->response)) {
            $return['themes'] = array();
            foreach ($update_themes->response as $theme => $data) {
                $return['themes'][] = $data['theme'];
            }

        }


        $update_wordpress = $this->get_core_updates(array(
            'dismissed' => false
        ));
        if (!empty($update_wordpress[0]->response)) {
            $return['core'] = 'WordPress Core needs updating!';
        }
        return $return;
      }


    /**
     * Weekly EMAIL WHEN WAPUU IS SICK
     *
     * @since 1.0.0
     *
     * @return true
     */
    function weekly_email(){

        $WDP_updates_total = $this->get_updates();

        if ($WDP_updates_total >= 1) {
            if (get_option('wapaemail') != '') {

                $updatedeets = $this->get_update_details();

                ob_start();

                include_once(plugin_dir_path(__FILE__) . 'templates/emailtemplate.php');

                $message = ob_get_contents();

                ob_end_clean();

                wp_mail(get_option('wapaemail'), 'Uh oh! Wapuu is feeling unwell!', $message, $headers = 'Content-Type: text/html; charset=UTF-8');
            }
        }
      }

    /**
     * DISPLAY THE VARIOUS WAPUU IMAGES
     *
     * @since 1.0.0
     *
     * @return true
     */
    public function plugin_display($size = false){

        switch (true) {
            // Posts and comments disabled //
            case get_option('wapapostnag') == 0 && get_option('wapacomnag') == 0:
                $WDP_updates_total = $this->get_updates();
                break;

            // Posts enabled comments disabled //
            case get_option('wapapostnag') !== 0 && get_option('wapacomnag') == 0:
                $WDP_updates_total = $this->get_updates() + $this->postnag_total();
                break;

            // Posts disabled comments enabled //
            case get_option('wapapostnag') == 0 && get_option('wapacomnag') !== 0:
                $WDP_updates_total = $this->get_updates() + $this->get_pending_comments();
                break;

            // Posts and comments enabled //
            case get_option('wapapostnag') !== 0 && get_option('wapacomnag') !== 0:
                $WDP_updates_total = $this->get_updates() + $this->get_pending_comments() + $this->postnag_total();
                break;
        }

        switch (true) {
            case $WDP_updates_total >= 10:
                return $this->image('dead', 'Wapuu feeling very unwell because you have a lot of pending updates', $size);
                break;

            case $WDP_updates_total >= 5:
                return $this->image('verysick', 'Wapuu feeling very unwell because you have a lot of pending updates', $size);
                break;

            case $WDP_updates_total >= 3:
                return $this->image('sick', 'Wapuu is feeling unwell because you have a few pending updates', $size);
                break;

            case $WDP_updates_total >= 1:
                return $this->image('sad', 'Wapuu is feeling sad, is it time to update your site?', $size);
                break;

            case $WDP_updates_total >= 0:
                return $this->image('happy', 'Wapuu is feeling happy and healthy', $size);
                break;
        }
      }

    /**
     * DISPLAY WAPUU IN THE ADMIN BAR
     *
     * @since 1.2.0
     *
     * @return true
     */

    function wapuu_node($wp_admin_bar){

        $args = array(
            'id' => 'wapuu-node',
            'title' => $this->plugin_display('small'),
            'href' => admin_url('options-general.php?page=WDPet-options'),
            'meta' => array(
                'class' => 'wapuu-node-class'
            )
        );
        $wp_admin_bar->add_node($args);
      }


    /**
     * DISPLAYS WapuuDashboardPet
     *
     * @since 1.0.0
     *
     * @param string $status image name
     * @return echo HTML image tag
     */
    public function image($status, $alttext, $size = false){


        if (get_option('wapaloc') == 'top') {
            if ('small' === $size) {
                return '<img src="' . plugins_url() . '/wapuu-dashboard-pet/images/mini-' . $status . '.svg" title="' . $alttext . '" style="height: 25px; padding-top:3px;">';
            }

        } elseif (get_option('wapaloc') == 'bottom') {
            return '<a href=options-general.php?page=WDPet-options><img src="' . plugins_url() . '/wapuu-dashboard-pet/images/' . $status . '.png" title="' . $alttext . '" style="position: absolute; right:0px; width: 200px; padding-right: 20px;"></a>';

        } else {

            if ('small' === $size) {
                return '<img src="' . plugins_url() . '/wapuu-dashboard-pet/images/mini-' . $status . '.svg" title="' . $alttext . '" style="height: 25px; padding-top:3px;">';
            }

            return '<a href=options-general.php?page=WDPet-options><img src="' . plugins_url() . '/wapuu-dashboard-pet/images/' . $status . '.png" title="' . $alttext . '" style="position: absolute; right:0px; width: 200px; padding-right: 20px;"></a>';

        }
      }

    /**
     * GET UPDATES TAKEN FROM https://developer.wordpress.org/reference/functions/get_core_updates/
     *
     * @since 1.2.4
     *
     * @return array or boolean
     */


    private function get_core_updates($options = array()){

        $options = array_merge(array(
            'available' => true,
            'dismissed' => false
        ), $options);
        $dismissed = get_site_option('dismissed_update_core');

        if (!is_array($dismissed)) {
            $dismissed = array();
        }

        $from_api = get_site_transient('update_core');

        if (!isset($from_api->updates) || !is_array($from_api->updates)) {
            return false;
        }

        $updates = $from_api->updates;
        $result  = array();
        foreach ($updates as $update) {
            if ($update->response == 'autoupdate') {
                continue;
            }

            if (array_key_exists($update->current . '|' . $update->locale, $dismissed)) {
                if ($options['dismissed']) {
                    $update->dismissed = true;
                    $result[]          = $update;
                }
            } else {
                if ($options['available']) {
                    $update->dismissed = false;
                    $result[]          = $update;
                }
            }
        }
        return $result;
    }

    /**
     * GET PENDING POST COUNT TAKEN FROM https://developer.wordpress.org/reference/functions/get_pending_comments_num/
     *
     * @since 1.3.3
     *
     * @return boolean
     */


    function get_pending_comments_num($post_id)
    {
        global $wpdb;

        $single = false;
        if (!is_array($post_id)) {
            $post_id_array = (array) $post_id;
            $single        = true;
        } else {
            $post_id_array = $post_id;
        }
        $post_id_array = array_map('intval', $post_id_array);
        $post_id_in    = "'" . implode("', '", $post_id_array) . "'";

        $pending = $wpdb->get_results("SELECT comment_post_ID, COUNT(comment_ID) as num_comments FROM $wpdb->comments WHERE comment_post_ID IN ( $post_id_in ) AND comment_approved = '0' GROUP BY comment_post_ID", ARRAY_A);

        if ($single) {
            if (empty($pending)) {
                return 0;
            } else {
                return absint($pending[0]['num_comments']);
            }
        }

        $pending_keyed = array();

        // Default to zero pending for all posts in request
        foreach ($post_id_array as $id) {
            $pending_keyed[$id] = 0;
        }

        if (!empty($pending)) {
            foreach ($pending as $pend) {
                $pending_keyed[$pend['comment_post_ID']] = absint($pend['num_comments']);
            }
        }
        return $pending_keyed;
    }


    /**
     * POST NAG TIME MANAGEMENT
     *
     * @since 1.3.0
     *
     * @return time difference in days between now and last post.
     */

    function GetLastPostId(){

        global $wpdb;

        $query = "SELECT ID FROM $wpdb->posts WHERE post_status='publish' AND post_type='post' ORDER BY ID DESC LIMIT 0,1";

        $result = $wpdb->get_results($query);
        $row    = $result[0];
        $id     = $row->ID;

        return $id;
    }


    function human_time_diff($from, $to = '')
    {
        if (empty($to)) {
            $to = time();
        }

        $diff = (int) abs($to - $from);

        $days = round($diff / DAY_IN_SECONDS);
        if ($days < 1) {
            $days = 0;
        }

        $since = sprintf(_n('%s', '%s', $days), $days);

        return apply_filters('human_time_diff', $since, $diff, $from, $to);
    }



    function postnag_total(){

        $WDP_postnag_total_check = $this->human_time_diff(get_post_time($d = 'U', $gmt = false, $post = $this->GetLastPostId(), $translate = false), current_time('timestamp')) - $WDP_postnag_check = get_option('wapapostnag');


        if ($WDP_postnag_total_check >= 1) {
            $WDP_postnag_total = 2;
        } else {
            $WDP_postnag_total = 0;
        }
        return $WDP_postnag_total;
      }



    function get_pending_comments(){

        $posts = get_posts(array(
            'posts_per_page' => -1,
            'fields' => 'ids'
        ));

        $postlist = implode(', ', $posts);


        $pendingposts = $this->get_pending_comments_num($postlist);

        if ($pendingposts < get_option('wapacomnag')) {
            $pendingpostcounter = 0;
        } else {
            $pendingpostcounter = 1;
        }
        return $pendingpostcounter;
    }
  }




$WapuuDashboardPet = new WapuuDashboardPet();

add_action('wp_loaded', array($WapuuDashboardPet,'load'));
add_action('upgrader_process_complete', array($WapuuDashboardPet,'cron_activation'), 10, 2);

  if (get_option('wapaloc') == 'top') {

      add_action('admin_bar_menu', array($WapuuDashboardPet,'wapuu_node'), 150);}

  elseif (get_option('wapaloc') == 'both') {

       add_action('admin_bar_menu', array($WapuuDashboardPet,'wapuu_node'), 150);

}



register_activation_hook(__FILE__, array(
    $WapuuDashboardPet,
    'cron_activation'
));
register_deactivation_hook(__FILE__, array(
    $WapuuDashboardPet,
    'wdp_deactivation'
));
