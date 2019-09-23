<?php

/**
 * @link              https://dedevillela.com/
 * @since             0.0.1
 * @package           Easy_Events_Calendar
 *
 * @wordpress-plugin
 * Plugin Name:       Easy Events Calendar 
 * Plugin URI:        https://github.com/dedevillela/Easy-Events-Calendar
 * Description:       This is the Easy Events Calendar.
 * Version:           0.0.1
 * Author:            André Aguiar Villela
 * Author URI:        https://dedevillela.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       easy-events-calendar
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Current plugin version (using SemVer - https://semver.org)
 */
define( 'EASY_EVENTS_CALENDAR_VERSION', '0.0.1' );

/**
 * Plugin activation.
 */
function activate_easy_events_calendar() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-easy-events-calendar-activator.php';
	Easy_Events_Calendar_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-easy-events-calendar-deactivator.php
 */
function deactivate_easy_events_calendar() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-easy-events-calendar-deactivator.php';
	Easy_Events_Calendar_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_easy_events_calendar' );
register_deactivation_hook( __FILE__, 'deactivate_easy_events_calendar' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-easy-events-calendar.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    0.0.1
 */
function run_easy_events_calendar() {

	$plugin = new Easy_Events_Calendar();
	$plugin->run();

}
run_easy_events_calendar();
