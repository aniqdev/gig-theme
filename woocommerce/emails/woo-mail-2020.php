<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />
		<title><?php echo get_bloginfo( 'name', 'display' ); ?></title>
	</head>
	<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">

<style>
.wm-container{
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
	font-size: 14px;
	line-height: 150%;
    color: #eaeaea;
	max-width: 700px;
	margin: auto;
	background: #0b3658;
    padding: 25px;
    border: 1px solid transparent;
}
.wm-container p{
	margin: 16px 0;
	font-size: 14px;
}
.wm-container p,
.wm-container td{
    color: #eaeaea;
}
.wm-container a{
	color: #23c299
}
.wm-header{
	width: 100%;
	margin-bottom: 50px;
}
.wm-menu{
    color: #25c99e;
    text-align: center;
    background: #042b4a;
    padding: 8px 15px;
}
.wm-menu-item{
	display: inline-block;
	width: 32%;
	text-decoration: none;
	min-width: 135px;
}
.block-header,
.wm-link,
.highl{
    color: #25c99e;
}
.order-table{
    width: 100%;
	margin: 60px 0;
}
.order-table .wm-td{
	text-align: left;
}
.wm-container .wm-small{
	font-size: 12px;
	line-height: 16px;
}
.order_item img{
	max-width: 120px;
}
.bacs-info-list{
	padding: 5px 25px 10px;
}
.order_item td:first-child{
	max-width: 20%;
}
</style>

<div class="wm-container">
	<table class="wm-header">
		<tr>
			<td>
				<img class="gig-games-logo" src="https://gig-games.de/wp-content/themes/gig-theme/images/eve-logo.png" alt="gig-eve-logo">
			</td>
			<td>
				<div class="wm-menu">
					<a href="<?= HOME_URL; ?>/my-account/" target="_blank" class="wm-menu-item">Mein&nbsp;Account</a>
					<a href="<?= HOME_URL; ?>/my-account/orders/" target="_blank" class="wm-menu-item">Meine&nbsp;Bestellungen</a>
					<a href="<?= HOME_URL; ?>" target="_blank" class="wm-menu-item">gig-games.de</a>
				</div>
			</td>
		</tr>
	</table>
<?php echo $heading;
if (!isset($hide_order) || $hide_order === false): ?>
	<h3 class="block-header">Einzelheiten Ihrer Bestellung (#<?= $order->get_order_number(); ?>):</h3>
	<table class="order-table" cellspacing="0" cellpadding="0" border="0">
<?php
$items = $order->get_items();
foreach ( $items as $item_id => $item ) :
	$product       = $item->get_product();
	$sku           = '';
	$purchase_note = '';
	$image         = '';
	$image_size = [ 100, 100 ];
	if ( is_object( $product ) ) {
		$sku           = $product->get_sku();
		$purchase_note = $product->get_purchase_note();
		$image         = $product->get_image( $image_size );
	}
?>
	<tr class="order_item">
		<td>
			<?= wp_kses_post( $image ); ?>
		</td>
		<td class="wm-td">
			<?php echo wp_kses_post( $item->get_name() );	?>
		 x 
			<?php
				$qty          = $item->get_quantity();
				$refunded_qty = $order->get_qty_refunded_for_item( $item_id );

				if ( $refunded_qty ) {
					$qty_display = '<del>' . esc_html( $qty ) . '</del> <ins>' . esc_html( $qty - ( $refunded_qty * -1 ) ) . '</ins>';
				} else {
					$qty_display = esc_html( $qty );
				}
				echo $qty_display;
			?>
		</td>
		<td class="wm-td">
			<?php echo wp_kses_post( $order->get_formatted_line_subtotal( $item ) ); ?>
		</td>
	</tr>
<?php endforeach; ?>

		</tbody>
		<tfoot>
			<?php
			$item_totals = $order->get_order_item_totals();

			if ( $item_totals ) {
				$i = 0;
				foreach ( $item_totals as $total ) {
					$i++;
					?>
					<tr>
						<th class="wm-td" scope="row" colspan="2"><?php echo wp_kses_post( $total['label'] ); ?></th>
						<td class="wm-td"><?php echo wp_kses_post( $total['value'] ); ?></td>
					</tr>
					<?php
				}
			}
			if ( $order->get_customer_note() ) {
				?>
				<tr>
					<th class="wm-td" scope="row" colspan="2"><?php esc_html_e( 'Note:', 'woocommerce' ); ?></th>
					<td class="wm-td"><?php echo wp_kses_post( nl2br( wptexturize( $order->get_customer_note() ) ) ); ?></td>
				</tr>
				<?php
			}
			?>
	</table>
<?php endif; ?>
	<h3 class="block-header">So läuft die Übergabe:</h3>
	<ul>
		<li>1. Sie schreiben uns an <a class="wm-link" href="mailto:support@gig-games.de" target="_blank">support@gig-games.de</a> an.</li>
		<li>2. Wir vereinbaren einen Termin.</li>
		<li>3. Sie kommen mit Ihrem Char online und die Übergabe findet statt.</li>
	</ul>
	<p>Haben Sie Lust ein anderes Spiel zu spielen? <a href="https://gig-games.de/keys-list/">Hier</a> veröffentlichen wir regelmäßig zufällige kostenlose Steamschlüssel</p>
	<p>Außerdem pflegen wir Spieldatenbank (aktuell sind es über 40000 PC Spiele). Nutzen Sie unseren <a href="https://gig-games.de/gig-games-filter/">Gamefinder</a> um vielleicht ein anderes Spiel zu finden.</p>
	<p>
		Mit besten grüßen <br>
		<a class="wm-link" href="http://gig-games.de" target="_blank">gig-games.de</a> Team
	</p><br><br>
	<p class="wm-small">Bitte beachten Sie: Diese E-Mail dient lediglich der Bestätigung des Einganges Ihrer Bestellung und stellt noch keine Annahme Ihres Angebotes auf Abschluss eines Kaufvertrages dar. Ihr Kaufvertrag für einen Artikel kommt zu Stande, wenn wir Ihre Bestellung annehmen, indem wir Ihnen eine E-Mail mit der Benachrichtigung zusenden, dass der Artikel an Sie abgeschickt wurde.</p>
	<p class="wm-small">Dies ist eine automatisch versendete Nachricht. Bitte antworten Sie nicht auf dieses Schreiben, da die Adresse nur zur Versendung von E-Mails eingerichtet ist.</p>
</div>

	</body>
</html>