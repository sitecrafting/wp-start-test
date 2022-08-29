<?php
/*
 * Plugin Name: SiteCrafting
 * Plugin URI: https://www.sitecrafting.com/
 * Description: Must-Use WordPress to code to run on all site on our upstream
 * Version: 0.1
 * Author: Coby Tamayo <ctamayo@sitecrafting.com>
 */

/*
add_filter('site_transient_update_plugins', function($updates) {
  // TODO allow automatic updates in certain environments
  // by detecting PANTHEON_ENVIRONMENT or some other mechanism

  if (isset($updates->response)) {
    // disable updating select plugins via WP Admin/WP-CLI;
    // we want devs to download plugin updates via our Pantheon upstream
    unset($updates->response['advanced-custom-fields-pro/acf.php']);
    unset($updates->response['capability-manager-enhanced/capsman-enhanced.php']);
    unset($updates->response['conifer/conifer.php']);
    unset($updates->response['events-calendar-pro/events-calendar-pro.php']);
    unset($updates->response['gravityforms/gravityforms.php']);
    unset($updates->response['presspermit-pro/presspermit-pro.php']);
    unset($updates->response['publishpress/publishpress.php']);
    unset($updates->response['publishpress-content-checklist/publishpress-content-checklist.php']);
    unset($updates->response['publishpress-multiple-authors/publishpress-multiple-authors.php']);
    unset($updates->response['publishpress-reminders/publishpress-reminders.php']);
    unset($updates->response['wicked-folders-pro/wicked-folders-pro.php']);
    unset($updates->response['wordpress-seo-premium/wp-seo-premium.php']);
  }
  return $updates;
});
*/

/*
 * Hook into Pantheon's clone_database workflow to update the Rollbar
 * environment setting, if any such setting currently exists
 */
add_action('pantheon/sitecrafting/clone_database', function(string $env) {
  $rollbarConfig = get_option('rollbar_wp');
  if ($rollbarConfig) {
    $rollbarConfig['environment'] = $env;
    update_option('rollbar_wp', $rollbarConfig);
  }
});

/*
 * Disable XML-RPC for security purposes.
 */
add_filter('xmlrpc_enabled', '__return_false');

/*
 * Ensure that Timber plugin is loaded before PublishPress plugins
 */
add_filter( "option_active_plugins", function($plugins)
{
  //  init
  $timberKey = null;
  $firstPubPressKey = null;

  //  look through plugins
  foreach($plugins as $key => $plugin) {

    //  if plugin is timber
    if(strpos($plugin, 'timber') !== false) {

      //  remember key
      $timberKey = $key;
    }

    //  if plugin is publish press & no publish press found yet
    if(strpos($plugin, 'publishpress') !== false && $firstPubPressKey == null) {

      //  remember key
      $firstPubPressKey = $key;
    }
  }

  //  if both keys found, and timber loads after publishpress
  if($timberKey && $firstPubPressKey && $timberKey > $firstPubPressKey) {

    //  get timber value
    $insertValue = $plugins[$timberKey];

    //  shift values from pubpress key to timber key
    for($i = $firstPubPressKey ; $i <= $timberKey ; $i++) {

      //  get value to move
      $moveValue = $plugins[$i];

      //  insert value
      $plugins[$i] = $insertValue;

      //  make move value the insert value
      $insertValue = $moveValue;
    }
  }

  return $plugins;
});