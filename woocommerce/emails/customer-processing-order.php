<?php
/**
 * Customer processing order email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-processing-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates/Emails
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;




$heading = '<p>Hallo '.esc_html( $order->get_billing_first_name() ).',</p>
			<p>Vielen herzlichen Dank für Ihre Bestellung! Schreiben Sie uns bitte an <a class="wm-link" href="mailto:support@gig-games.de" target="_blank">support@gig-games.de</a> wann die Übergabe stattfinden soll.</p>';


$content = wc_get_template_html( 'emails/woo-mail-2020.php', array( 'order' => $order, 'heading' => $heading ) );

$emogrifier_class = '\\Pelago\\Emogrifier';
if ( ! class_exists( $emogrifier_class ) ) {
	include_once ABSPATH . 'wp-content/plugins/woocommerce/includes/libraries/class-emogrifier.php';
}
try {
	$emogrifier = new $emogrifier_class( $content );
	$content    = $emogrifier->emogrify();
} catch ( Exception $e ) {
	// echo $e->getMessage();
	// $logger = wc_get_logger();
	// $logger->error( $e->getMessage(), array( 'source' => 'emogrifier' ) );
}

echo $content;