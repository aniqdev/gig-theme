<br><?php

echo '<h2>'. get_admin_page_title() .'</h2>';




$order_id = 27436;
if(defined('DEV_MODE')) $order_id = 8545;

$order = wc_get_order( $order_id );

// sa($order);

// $data = $order->get_data();

// sa($data);

// $order_items = $order->get_items();

// foreach( $order_items as $item_id => $item ){
// 	sa($item);
// }

// include GIG_TEMPLATE_DIRECTORY.'/woocommerce/emails/customer-processing-order.php';
include GIG_TEMPLATE_DIRECTORY.'/woocommerce/emails/customer-processing-order-test.php';