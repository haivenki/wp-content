<?php
/**
 * Gateway Actions
 *
 * @package     EDD
 * @subpackage  Gateways
 * @copyright   Copyright (c) 2015, Pippin Williamson
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.7
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Processes gateway select on checkout. Only for users without ajax / javascript
 *
 * @since 1.7
 *
 * @param $data
 */
function edd_process_gateway_select( $data ) {
	if( isset( $_POST['gateway_submit'] ) ) {
		wp_redirect( add_query_arg( 'payment-mode', $_POST['payment-mode'] ) ); exit;
	}
}
add_action( 'edd_gateway_select', 'edd_process_gateway_select' );

/**
 * Loads a payment gateway via AJAX
 *
 * @since 1.3.4
 * @return void
 */
function edd_load_ajax_gateway() {
	if ( isset( $_POST['edd_payment_mode'] ) ) {
		do_action( 'edd_purchase_form' );
		exit();
	}
}
add_action( 'wp_ajax_edd_load_gateway', 'edd_load_ajax_gateway' );
add_action( 'wp_ajax_nopriv_edd_load_gateway', 'edd_load_ajax_gateway' );

/**
 * Sets an error on checkout if no gateways are enabled
 *
 * @since 1.3.4
 * @return void
 */
function edd_no_gateway_error() {
	$gateways = edd_get_enabled_payment_gateways();

	if ( empty( $gateways ) && edd_get_cart_total() > 0 )
		edd_set_error( 'no_gateways', __( 'You must enable a payment gateway to use Easy Digital Downloads', 'easy-digital-downloads' ) );
	else
		edd_unset_error( 'no_gateways' );
}
add_action( 'init', 'edd_no_gateway_error' );
