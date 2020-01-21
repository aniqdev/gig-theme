<?php
/**
 * Customer completed order email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-completed-order.php.
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


$cat_ids = cco_get_cat_ids_by_order($order);
$coupon_code = ($order->get_id()+2)*3;
if (in_array(EVE_CAT_ID, $cat_ids)) { // 
	$generated = cco_coupon_code_generation( $coupon_code );
}else{
	$generated = false;
}
// var_dump($coupon_code);


$heading = '<p>Hallo '.esc_html( $order->get_billing_first_name() ).',</p>
            <p>Wir hoffen, dass Sie zufrieden geblieben sind und freuen uns Ihnen wieder behilflich sein zu dürfen.</p>';

if (defined('DEV_MODE') || $generated) {
    $heading .= '<p><span class="highl">5% Gutschein</span> für Ihre nächste Bestellung lautet <span class="highl">'.$coupon_code.'</span> (gültig für die nächsten 40 Tagen).</p>';
}



$content = wc_get_template_html( 'emails/woo-mail-2020.php', [ 'order' => $order, 'heading' => $heading, 'hide_order' => true ] );

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









// Utility function that check if coupon exist
function cco_does_coupon_exist( $coupon_code ) {
    global $wpdb;

    $value = $wpdb->get_var( "
        SELECT ID
        FROM {$wpdb->prefix}posts
        WHERE post_type = 'shop_coupon'
        AND post_name = '".strtolower($coupon_code)."'
        AND post_status = 'publish';
    ");

    return $value > 0 ? true : false;
}


function cco_coupon_code_generation( $coupon_code, $customer_email = '' ){

    // Check that coupon code not exists
    if( ! cco_does_coupon_exist( $coupon_code ) ) {

        // Get a new instance of the WC_Coupon object
        $coupon = new WC_Coupon();
        // Set the necessary coupon data
        $coupon->set_code( $coupon_code );
        $coupon->set_discount_type( 'percent' );
        $coupon->set_amount( '5' );
        $coupon->set_product_categories( EVE_CAT_ID );
        // $coupon->set_email_restrictions( $customer_email );
        $coupon->set_individual_use( true );
        $coupon->set_usage_limit( 1 );
        // $coupon->set_usage_limit_per_user( 1 );
        // $coupon->set_limit_usage_to_x_items( 1 );
        $date_expires = date('Y-m-d', time()+60*60*24*40); // 40 days
        $coupon->set_date_expires( date( "Y-m-d H:i:s", strtotime($date_expires) ) );

        // Save the data
        $post_id = $coupon->save();
    }
    return isset($post_id) && $post_id > 0;
}



function cco_get_cat_ids_by_order($order)
{
	$items = $order->get_items();
    $cat_ids = [];
    foreach ($items as $item) {
        $terms = get_the_terms( $item['product_id'], 'product_cat' );
        foreach ( $terms as $term ) {
            // Categories by term_id
            $cat_ids[] = $term->term_id;
        }
    }
    return $cat_ids;
}