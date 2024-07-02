<?php 
namespace Contact\SignUp;
class Settings {
    public static function init() {
        add_action( 'admin_menu', [ __CLASS__, 'create_admin_menu' ] );
    }

    public static function create_admin_menu(){
        $capability = 'manage_options';
        $slug = 'contact-signup';

        add_menu_page(
            __( 'Contact Signup', 'contact-signup' ),
            __( 'Contact Signup', 'contact-signup' ),
            $capability,
            $slug,
            [ __CLASS__, 'menu_page_template' ],
            'dashicons-buddicons-replies'
        );
    }
    public static function menu_page_template(){
        echo '<div class="wrap"><div id="contactSignup-admin-app"></div></div>';
    }
}