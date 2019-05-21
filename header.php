<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

//======================
//== MY SCRIPTS BELOW ==
//======================
global $wpdb2;
$wpdb2 = new wpdb( db_USER, db_PASS, db_NAME, db_HOST );

$gig_title = wp_get_document_title();
$gig_json_ld = '';
$gig_meta_desc = '';
$gig_rel_canonical = '';

if( is_page( 'game' ) ){
	global $steam_game;
	$steam_type  = esc_sql( $_GET['type'] );
	$steam_appid = esc_sql( gig_to_steam($_GET['appid']) );
	$steam_lang  = esc_sql( @$_GET['lang'] ? $_GET['lang'] : 'de' );
	$steam_game = $wpdb2->get_row( "SELECT * FROM steam_{$steam_lang} WHERE type = '$steam_type' AND appid = '$steam_appid' LIMIT 1", ARRAY_A );
	$gig_title = get_gig_title($steam_game);
	$gig_json_ld = get_gig_game_json_ld($steam_game);


	$gig_meta_desc = get_gig_meta_desc($steam_game);
	remove_action( 'wp_head', 'rel_canonical' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
	// add_action( 'wp_head', 'game_page_rel_canonical');

	$gig_rel_canonical = '<link rel="canonical" href="' . get_current_url() . '" />'.PHP_EOL;
}
// sa($_SERVER);


$home_url = get_home_url();
$template_directory_uri = get_template_directory_uri();
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link rel="preload" href="https://gig-games.de/wp-content/themes/gig-theme/css/fonts/flexslider-icon.woff">
	<?php endif; ?>
	<title><?= $gig_title; ?></title>
	<?= $gig_json_ld; ?>
	<?= $gig_meta_desc; ?>
	<?= $gig_rel_canonical; ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>


	<?php if ( is_eve_page() ) : //is eveonline ?>
		<div class="eve-header">
			<div class="container">
				<div class="row">
					<div class="col-xs-6 col-sm-3 eve-logo">
						<div class="row eve-logo-row">
							<div class="col-xs-8 eve-logo-col">
								<a href="<?= $home_url; ?>">
									<img src="<?php echo get_template_directory_uri() . '/images/eve-logo.png';?>" alt="Gig Games">
								</a>
							</div>
							<div class="col-xs-4 stamp-col">
								<a href="https://app.trustami.com/trustami-card/57cc6402cc96c5b9048b4616" class="stamp-wrapper" target="_blank">
									<img class="stamp-img stamp-in" src="<?php echo get_template_directory_uri() . '/images/stamp-in.png';?>" alt="Gig Games">
									<img class="stamp-img stamp-out" src="<?php echo get_template_directory_uri() . '/images/stamp-out.png';?>" alt="Gig Games">
								</a>
							</div>
						</div>
					</div>
					<div class="col-xs-6 col-sm-push-6 col-sm-3 eve-cart-wrap">
						<div class="eve-cart  animated">
								<?php global $woocommerce; ?>
								<div>
									<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>">
										<span class="cart-items-count"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?></span>
										<?php echo $woocommerce->cart->get_cart_total(); ?>
									</a>
								</div>

						</div>
					</div>
					<div class="col-xs-12 col-sm-pull-3 col-sm-6 eve-title">
						<?php if(is_product_category()): ?>
							<h1>EVE ONLINE<sup>®</sup></h1>
						<?php else : ?>
							<div class="h1">EVE ONLINE<sup>®</sup></div>
						<?php endif; ?>
					</div>

				</div>
			</div>
		</div>
	<?php return; endif;  //is eveonline --> ?>


<div id="page" class="site">
	<div class="site-inner">
		<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'twentysixteen' ); ?></a>

		<header id="masthead" class="site-header container-fluid" role="banner">
			<div class="gig-site-header-main row" id="aqs_search_form_wrapper">
				<div class="col-xs-12 col-sm-4 col-md-3 gig-site-branding">
					<div class="row">
						<a href="<?= $home_url; ?>" class="col-xs-8">
							<img src="<?= $template_directory_uri; ?>/images/eve-logo.png" alt="gig-eve-logo">
						</a>
						<div class="col-xs-4 stamp-col">
							<a href="https://app.trustami.com/trustami-card/57cc6402cc96c5b9048b4616" class="stamp-wrapper" target="_blank">
								<img class="stamp-img stamp-in" src="https://gig-games.de/wp-content/themes/material/images/stamp-in.png" alt="Gig Games">
								<img class="stamp-img stamp-out" src="https://gig-games.de/wp-content/themes/material/images/stamp-out.png" alt="Gig Games">
							</a>
						</div>
					</div>
				</div><!-- .site-branding -->
				<form class="col-xs-12 col-sm-4 col-md-6 aqs-search-form" id="aqs_search_form" action="<?= $home_url; ?>/gig-games-filter/">
					<input type="text" id="aqs_search_input" name="search" value="<?= esc_attr(get_query_var('search')) ?>" class="aqs-search-input" placeholder="Search..." tabindex="4" autocomplete="off">
					<button type="submit" id="searchsubmit" class="aqs-search-submit"><i class="dashicons dashicons-search"></i></button>
					<div class="aqs-search-results-wrapper">
						<div id="aqs_search_results"></div>
						<div class="get-more">
							<button type="submit">Get more results...</button>
						</div>
					</div>
				</form>
				<div class="col-xs-12 col-sm-4 col-md-3 text-right">
					<img src="<?= $template_directory_uri; ?>/images/lang-de.png" alt="" class="aqs-lang">
					<a href="#">
						<img src="<?= $template_directory_uri; ?>/images/facebook-icon.png" alt="">
					</a>
					<a href="#">
						<img src="<?= $template_directory_uri; ?>/images/google-icon.png" alt="">
					</a>
				</div>
			</div><!-- .site-header-main -->

			<div class="header-menu"><div class="w1200">
				<?php if ( has_nav_menu( 'primary' ) || has_nav_menu( 'social' ) ) : ?>
					<button id="menu-toggle" class="menu-toggle"><?php _e( 'Menu', 'twentysixteen' ); ?></button>

					<div id="site-header-menu" class="site-header-menu">
						<?php if ( has_nav_menu( 'primary' ) ) : ?>
							<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'twentysixteen' ); ?>">
								<?php
									wp_nav_menu( array(
										'theme_location' => 'primary',
										'menu_class'     => 'primary-menu',
									 ) );
								?>
							</nav><!-- .main-navigation -->
						<?php endif; ?>
					</div><!-- .site-header-menu -->
				<?php endif; ?>
			</div></div>

		</header><!-- .site-header -->

		<div id="content" class="site-content">
