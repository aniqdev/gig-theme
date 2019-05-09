<?php
/**
 * Template Name: Genre
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */



remove_action( 'wp_head', 'rel_canonical' );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
add_action( 'wp_head', 'game_page_rel_canonical');

get_header(); ?>

<?php

// если не удалось подключиться, и нужно оборвать PHP с сообщением об этой ошибке
if( ! empty($wpdb2->error) ) wp_die( $wpdb2->error );


// echo "<pre>";
// print_r($results);
// echo "</pre>";
?>

<div id="primary" class="content-area content-area-w100p container-fluid">
	<main id="main" class="site-main gig-page-genre" role="main">
		<?php

		if (isset($_GET['genre']) && $_GET['genre']) {
			$genre = esc_sql( $_GET['genre'] );
			if (isset($_GET['release']) && (int)$_GET['release']) {
				$release = esc_sql( (int)$_GET['release'] );
				$and_year = "AND year = '$release'";
			}else{$and_year = '';}
			$count = $wpdb2->get_var( "SELECT count(*) FROM steam_de WHERE type = 'app' AND o_reviews > 5 AND genres LIKE '%$genre%' $and_year" );
			// sa($count);
			$pagination = aqs_pagination('steam_de', $count);
			$order_by = get_gp_order();
			$games = $wpdb2->get_results( "SELECT * FROM steam_de WHERE type = 'app' AND o_reviews > 5 AND genres LIKE '%$genre%' $and_year $order_by LIMIT $pagination[limit]", ARRAY_A );
			$years = $wpdb2->get_col( "SELECT year FROM steam_de WHERE type = 'app' AND year > 1000 AND o_reviews > 5 AND genres LIKE '%$genre%' GROUP BY year LIMIT 5000" );
		}else{
			$games = [];
			$genres_list = $wpdb2->get_results( "SELECT * FROM filter_values WHERE steam_table = 'steam_de' AND name = 'genres' ORDER BY count DESC", ARRAY_A );
		}
		?>
		<?php 
		if (!$games):
			gp_genres_list($genres_list);
		else:
			f_search_header($pagination, $years);
		?>
		<div class="gig-genre-list">
			<?php 
			foreach ($games as $game) {
				$game = gp_insert_Links($game);
				// echo '<li>'.$game['title'].'</li>';
				?>
				<div class="col-xs-12 col-sm-4 col-md-3 compare-card"><div class="compare-card-inner">
					<div class="fixed-height">
						<img class="image" src="//parser.gig-games.de/steam-images/<?= $game['type']; ?>s-<?= $game['appid']; ?>/header-80p.jpg" alt="<?= get_img_alt($game); ?>" title="<?= htmlspecialchars($game['title']); ?>">
					</div>
					<h3 class="title" title="<?= htmlspecialchars($game['title']); ?>"><?= $game['title']; ?></h3>
					<a class="link" href="<?= get_gig_game_link($home_url, $game); ?>">ZEIGEN</a>
					<div class="eclips">EUR <?= str_replace('.', ',', $game['reg_price']); ?></div>
					<div class="eclips" title="<?= htmlspecialchars($game['specs']); ?>"><?= $game['specs_links']; ?></div>
					<div class="eclips" title="<?= htmlspecialchars($game['tags']); ?>"><?= $game['tags_links']; ?></div>
					<div class="eclips"><?= (int)$game['year'] ? $game['year_link'] : '&nbsp;'; ?></div>
					<div class="eclips"><?= $game['os_links']; ?></div>
					<div class="eclips" title="<?= htmlspecialchars($game['genres']); ?>"><?= $game['genres_links']; ?></div>
					<div class="eclips"><?= $game['developer_link']; ?></div>
					<div class="eclips" title="<?= htmlspecialchars($game['lang']); ?>"><?= $game['lang_links']; ?></div>
				</div></div>
				<?php
			}
			?>
		</div>
		<div class="f-search-header bg-dark color-aqua row clearfix">
		   <nav class="f-pagination col-sm-4">
		   		<?= $pagination['html']; ?>
		   </nav>
		   <div class="f-sort-by col-sm-8">
		      sortieren nach: 
				<?= get_gp_sort_select(); ?>
				<?= get_gp_year_select($years); ?>
		   </div>
		</div><!-- .f-search-header -->
		<?php endif; ?>
		<?php
		if (isset($_GET['genre']) && $_GET['genre']){
			$g_post = get_page_by_path( 'genre-'.gig_sanitize($_GET['genre']), ARRAY_A, 'page');
			echo '<article class="genre-seo">';
			echo($g_post['post_content']);
			echo '</article>';
		}else{
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
		}
		?>
	</main><!-- .site-main -->
	
	<?php //get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_footer(); ?>
<?php console_log_filename(__FILE__); ?>
