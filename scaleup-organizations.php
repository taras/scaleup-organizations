<?php
/**
 * Plugin Name: ScaleUp Organizations
 */

define( 'SCALEUP_ORGANIZATIONS_DIR',     dirname( __FILE__ ) );
define( 'SCALEUP_ORGANIZATIONS_VER',     '0.1.0' );
define( 'SCALEUP_ORGANIZATIONS_MIN_PHP', '5.2.4' );
define( 'SCALEUP_ORGANIZATIONS_MIN_WP',  '3.4' );

include( SCALEUP_ORGANIZATIONS_DIR . '/classes/class-organizations.php' );
include( SCALEUP_ORGANIZATIONS_DIR . '/classes/class-plugin-base.php' );