<?php
/*
    Plugin Name: Screets Extras
    Plugin URI: https://screets.io
    Description: My extra hooks, styles and scripts.
    Version: 1.0.0
    Author: Screets
    Author URI: https://screets.io
    Requires at least: 4.0
    Tested up to: 4.9.5
    Text Domain: sxtras
    Domain Path: /languages
*/

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'SXTRAS_VERSION', '1.0.0' );
define( 'SXTRAS_URL', plugins_url( basename( plugin_dir_path( __FILE__ ) ), basename( __FILE__ ) ) );


/**
 * Add custom script and styles.
 * 
 * @since Screets Extras (1.0.0)
 */
function fn_sxtras_scripts() 
{
    // 
    // Loads custom JavaScript file.
    // 
    wp_register_script(
        'screets-extras',
        SXTRAS_URL . '/extras.js',
        null,
        SXTRAS_VERSION
    );
    wp_enqueue_script( 'screets-extras' );


    // 
    // Loads custom style file (uncomment below code to load custom styles).
    // 
    /*wp_register_style(
        'screets-extras',
        SXTRAS_URL . '/extras.css',
        null,
        SXTRAS_VERSION
    );
    wp_enqueue_style( 'screets-extras' );*/
}

/**
 * Add custom scripts for Screets Live Chat plugin.
 * 
 * @since Screets Extras (1.0.0)
 */
function fn_sxtras_livechat_scripts( $assets ) 
{
    $assets[] = array( 
        'type' => 'js', 
        'src' => SXTRAS_URL . '/extras-livechat.js?v=' . time() 
    );

    return $assets;
}

// 
// Front-end only.
// 
if( ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' ) ) {
    add_action( 'wp_enqueue_scripts', 'fn_sxtras_scripts' );

    // Add custom scripts for Screets Live Chat plugin
    add_filter( 'lcx_widget_assets', 'fn_sxtras_livechat_scripts', 100, 1 );
}
