<?php
/**
 * This file will create admin menu page.
 */

class WPRK_Create_Admin_Page {

    public function __construct() {
        add_action( 'admin_menu', [ $this, 'create_admin_menu' ] );
        add_action('wp_before_admin_bar_render', [ $this, 'wp_admin_bar_new_item' ]);
    }

    public function create_admin_menu() {
        $capability = 'manage_options';
        $slug = 'wp-booking-app';

        add_menu_page(
            __( 'BOOKINGS', 'wp-booking-app' ),
            __( 'BOOKINGS', 'wp-booking-app' ),
            $capability,
            $slug,
            [ $this, 'menu_page_template' ],
            'dashicons-book'
        );
    }

    function wp_admin_bar_new_item() {
        global $wp_admin_bar;
        $wp_admin_bar->add_menu(array(
            'id' => 'wp-booking-app',
            'title' => __('OPEN BOOKING'),
            'href' => '/wp-admin/admin.php?page=wp-booking-app'
        ));
    }

    public function menu_page_template() {
        echo '<div class="wrap"><div id="wprk-admin-app"></div></div>';
    }

}
new WPRK_Create_Admin_Page();