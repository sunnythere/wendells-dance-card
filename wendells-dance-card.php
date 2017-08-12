<?php
/*
*
Plugin Name: Wendell's Dance Card
Description: plugin test
Version: 1.0
Author: Y.Alice
*
*/
if ( !defined('WPINC') ) die;

if ( !defined( 'WendellDC_NAME') ) {
  define( 'WendellDC_NAME', trim( dirname( plugin_basename( __FILE__ ) ), '/' ) );
}

if ( !defined( 'WendellDC_DIR') ) {
  define( 'WendellDC_DIR', WP_PLUGIN_DIR . '/' . WendellDC_NAME );
}

if ( file_exists( WendellDC_DIR . '/includes/class-wendells-dance.php' ) ) {
  require_once WendellDC_DIR . '/includes/class-wendells-dance.php';
}

function run_wendells_dance_card() {

    $ccafe_wdc = new Wendells_Dance_Card();
    $ccafe_wdc->run();

}

run_wendells_dance_card();
