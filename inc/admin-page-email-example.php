<br><?php

echo '<h2>'. get_admin_page_title() .'</h2>';




$order_id = 27436;
if(defined('DEV_MODE')) $order_id = 8545;

$order = wc_get_order( $order_id );

// sa($order->billing_first_name);

// $data = $order->get_data();

// sa($data);

// $order_items = $order->get_items();

// foreach( $order_items as $item_id => $item ){
// 	sa($item);
// }




echo '<h3>customer-on-hold-order</h3>';
include GIG_TEMPLATE_DIRECTORY.'/woocommerce/emails/customer-on-hold-order.php';

echo '<h3>customer-processing-order</h3>';
include GIG_TEMPLATE_DIRECTORY.'/woocommerce/emails/customer-processing-order.php';

echo '<h3>customer-completed-order</h3>';
include GIG_TEMPLATE_DIRECTORY.'/woocommerce/emails/customer-completed-order.php';