<?php 

// wp_redirect(home_url().'/wp-admin/admin.php?page=pult-page', 302);
// exit();

echo '<br><h2>'. get_admin_page_title() .'</h2>';

$bacs_info  = get_option( 'woocommerce_bacs_accounts');
sa($bacs_info);

global $wp_filter;
sa($wp_filter['woocommerce_email_subject_new_order']);


/*
 * goes in theme functions.php or a custom plugin
 *
 * Subject filters: 
 *   woocommerce_email_subject_new_order
 *   woocommerce_email_subject_customer_processing_order
 *   woocommerce_email_subject_customer_completed_order
 *   woocommerce_email_subject_customer_invoice
 *   woocommerce_email_subject_customer_note
 *   woocommerce_email_subject_low_stock
 *   woocommerce_email_subject_no_stock
 *   woocommerce_email_subject_backorder
 *   woocommerce_email_subject_customer_new_account
 *   woocommerce_email_subject_customer_invoice_paid
 **/
echo '<hr>woocommerce_email_subject_new_order';
// add_filter('woocommerce_email_subject_new_order', function( $subject, $order ) { echo $subject; }, 1, 2);
// do_action('woocommerce_email_subject_new_order');

