<?php
/**
 * Customer on-hold order email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-on-hold-order.php.
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
			<p>Vielen herzlichen Dank für Ihre Bestellung! Sobald der Betrag gebucht wird, schreiben wir Sie bezüglich der Übergabe an. Erfahrungsgemäß kann die Banküberweisung 1-3 Tage dauern.  sollten Sie längere Zeit keine Rückmeldung von uns erhalten, bitte schreiben Sie uns an <a class="wm-link" href="mailto:support@gig-games.de" target="_blank">support@gig-games.de</a> .</p>
			<section>
				<h2 style="color:#25c99e;display:block;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:18px;font-weight:bold;line-height:130%;margin:0 0 18px;text-align:left">Unsere Bankverbindung</h2>
				<h3 style="color:#25c99e;display:block;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:16px;font-weight:bold;line-height:130%;margin:16px 0 8px;text-align:left">Konstantin Sokolkov:</h3>
				<ul class="bacs-info-list">
					<li>Bank: <strong>Fidor Bank AG</strong></li>
					<li>IBAN: <strong>DE57700222000020054549</strong></li>
					<li>BIC: <strong>FDDODEMMXXX</strong></li>
				</ul>
			</section>';


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