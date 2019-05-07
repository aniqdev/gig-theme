<?php
/**
 * Template Name: Full Width Main
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */



get_header(); ?>

<?php

// если не удалось подключиться, и нужно оборвать PHP с сообщением об этой ошибке
if( ! empty($wpdb2->error) )
	wp_die( $wpdb2->error );

$games = $wpdb2->get_results( "SELECT type,appid,title,reg_price as price,o_rating,o_reviews  FROM steam_de WHERE type = 'app' AND o_reviews > 5  ORDER BY o_rating DESC LIMIT 5000", ARRAY_A ); // AND reg_price > 0

// echo "<pre>";
// print_r($results);
// echo "</pre>";
?>

<div id="primary" class="content-area content-area-w100p container-fluid">
	<main id="main" class="site-main" role="main">
		<div class="aqs-canvas row">
			<div class="col-sm-2"></div>
			<?php if(!iz_mobile()): ?>
			<div class="col-sm-8" id="many_games_wrapper">
				<div class="animation-wrapper-3">
				    <canvas id="animation-visual-canvas-3"></canvas>
				    <?php
$home_url = home_url();
foreach ($games as $game) {
	$gig_game_link = get_gig_game_link($home_url, $game);
	echo '<a href="'.$gig_game_link.'" title="'.htmlspecialchars($game['title']).'" data-price="'.$game['price'].'" data-appid="'.$game['appid'].'" target="_blank"></a>'.PHP_EOL;
}
				    ?>
				</div>
			</div>
			<?php endif; ?>
			<div class="col-sm-2">
				<div class="hoverd-game">
					<img class="hg-img" id="hg_img" src="<?= get_template_directory_uri(); ?>/images/eve-logo.png" alt="">
					<h2 class="hg-title" id="hg_title"></h2>
					<div class="hg-price">€<span id="hg_price">00.00</span></div>
				</div>
			</div>
		</div>
<script>
(function($) {
var for_title = document.all.hg_title;
var for_price = document.all.hg_price;
var for_img = document.all.hg_img;
$('#many_games_wrapper').on('mouseover', 'a', function() {
	for_title.innerHTML = this.title;
	for_price.innerHTML = this.dataset.price;
	for_img.src = '//parser.gig-games.de/steam-images/apps-'+this.dataset.appid+'/header.jpg'
});
})(jQuery);
</script>
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the page content template.
			get_template_part( 'template-parts/content-no-title', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}

			// End of the loop.
		endwhile;
		?>

	</main><!-- .site-main -->
	
	<?php //get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_footer(); ?>
<?php console_log_filename(__FILE__); ?>