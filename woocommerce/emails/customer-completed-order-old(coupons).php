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

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * @hooked WC_Emails::email_header() Output the email header
 */
do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<?php /* translators: %s: Customer first name */ ?>
<p><?php printf( esc_html__( 'Hi %s,', 'woocommerce' ), esc_html( $order->get_billing_first_name() ) ); ?></p>
<?php /* translators: %s: Site title */ 
	$cat_ids = cco_get_cat_ids_by_order($order);
	if (in_array(EVE_CAT_ID, $cat_ids)) { // 
		$coupon_code = ($order->get_id()+2)*3;
		$generated = cco_coupon_code_generation( $coupon_code );
	}else{
		$generated = false;
	}
?>
<p>
<?php if(!$generated): ?>
	<?php esc_html_e( 'We have finished processing your order.', 'woocommerce' ); ?>
<?php else: ?>
	Wir hoffen, dass Sie zufrieden geblieben sind und freuen uns Ihnen wieder behilflich sein zu dürfen. 
</p><p>
	5% Gutschein für Ihre nächste Bestellung - <?= $coupon_code; ?>  (gültig für die nächsten 40 Tagen).
<?php endif; ?>
</p>
<?php

/*
 * @hooked WC_Emails::order_details() Shows the order details table.
 * @hooked WC_Structured_Data::generate_order_data() Generates structured data.
 * @hooked WC_Structured_Data::output_structured_data() Outputs structured data.
 * @since 2.5.0
 */
do_action( 'woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email );

/*
 * @hooked WC_Emails::order_meta() Shows order meta data.
 */
do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email );

/*
 * @hooked WC_Emails::customer_details() Shows customer details
 * @hooked WC_Emails::email_address() Shows email address
 */
do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email );

/**
 * Show user-defined additonal content - this is set in each email's settings.
 */
if ( $additional_content ) {
	echo wp_kses_post( wpautop( wptexturize( $additional_content ) ) );
}

/*
 * @hooked WC_Emails::email_footer() Output the email footer
 */
do_action( 'woocommerce_email_footer', $email );
















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