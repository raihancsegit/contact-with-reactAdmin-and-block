<?php
/**
 * Plugin Name: Contact Signup
 * Description: A plugin to allow users to sign up and display their information as contact cards.
 * Version: 1.0
 * Author: Raihan Islam
 */

if( ! defined( 'ABSPATH' ) ) : exit(); endif; // No direct access allowed.

require_once __DIR__ . '/vendor/autoload.php';

/**
* Define Plugins Contants
*/
define ( 'CONTACT_SIGNUP_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );
define ( 'CONTACT_SIGNUP_URL', trailingslashit( plugins_url( '/', __FILE__ ) ) );
if ( ! defined( 'CONTACT_SIGNUP_VERSION' ) ) define( 'CONTACT_SIGNUP_VERSION', '1.0.0' );
if ( ! defined( 'CONTACT_SIGNUP_FILE' ) ) define( 'CONTACT_SIGNUP_FILE', __FILE__ );
if ( ! define( 'CONTACT_SIGNUP_DIR_URL', plugin_dir_url( __FILE__ )) ) define( 'CONTACT_SIGNUP_DIR_URL', plugin_dir_url( __FILE__ ));

use Contact\SignUp\Plugin;
Plugin::init();

function contact_signup_enqueue_scripts() {
  
    wp_enqueue_script('contact-signup-script', CONTACT_SIGNUP_URL . 'assets/js/script.js', array('jquery'), null, true);

    // Localize script to pass PHP data to JavaScript
    wp_localize_script('contact-signup-script', 'ContactSignupData', array(
        'apiUrl' => esc_url(rest_url('contact-signup/v1/contact')),
        'nonce' => wp_create_nonce('wp_rest'),
        'predefinedHobbies' => json_encode(predefinedHobbies()),
    ));
}
add_action('wp_enqueue_scripts', 'contact_signup_enqueue_scripts');

function predefinedHobbies() {
    return ['Fishing', 'Running', 'Reading', 'Cooking', 'Traveling', 'Gardening', 'Hiking', 'Photography'];
}