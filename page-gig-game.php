<?php
/**
 * Template Name: gig-game
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */



get_header();

// if (!$steam_game || get_gig_game_url_title($steam_game['title']) !== $_GET['title']) {
if (!@$steam_game) {
	// global $wp_query;
	// $wp_query->set_404();
	// status_header(404);
	// get_header();
	get_template_part('404');
	get_footer();
	exit;
}
$home_url = home_url();
//======================
//== MY SCRIPTS BELOW ==
//======================

$steam_pics_type  = esc_sql( ($_GET['type'] === 'dlc') ? 'app' : $_GET['type'] );
$steam_appid = esc_sql( gig_to_steam($_GET['appid']) );
$steam_lang  = esc_sql( get_gig_lang() );

define('ATTR_STEAM_GAME_TITLE', 'pc spiel '.esc_attr($steam_game['title']));
$gig_pics = array_map(function($src)
{
	return $src ? '<li><img class="lazyload" data-src="'.$src.'" alt="'.ATTR_STEAM_GAME_TITLE.'""></li>' : '';
}, get_gig_game_img_urls($steam_game));

$steam_game['desc'] = insert_adv_to_desc($steam_game['desc']);

$steam_game = gig_insert_Links($steam_game);
// sa($steam_game);

$steam_popular_games = $wpdb2->get_results( "SELECT type,appid,title,reg_price as price,o_rating,o_reviews  FROM steam_{$steam_lang} WHERE type = 'app' AND o_reviews > 5 AND reg_price > 0 ORDER BY o_rating DESC LIMIT 10", ARRAY_A ); // 


$our_popular_games = $wpdb2->get_results( "SELECT type,appid,title,reg_price as price,o_rating,o_reviews  FROM steam_{$steam_lang} WHERE type = 'app' AND o_reviews > 5 AND reg_price > 0 ORDER BY o_rating DESC LIMIT 10,10", ARRAY_A ); //  AND ebay_id <> ''


$and_genres_like = get_genres_like($steam_game['genres']);

$similar_games = $wpdb2->get_results( "SELECT * FROM steam_{$steam_lang} WHERE type = 'app' AND o_reviews > 5 AND reg_price > 0 $and_genres_like LIMIT 10,10", ARRAY_A ); // 

$similar_games = array_map('gig_insert_links', $similar_games);


$template_directory_uri = get_template_directory_uri();

// sa($similar_games);
?>



<div id="primary" class="content-area content-area-w100p container-fluid page-gig-game">
	<main id="main" class="site-main" role="main">
<ul class="aqs-breadcrumbs">
	<li><a href="<?= $home_url; ?>"><?= _e('Home','gig-theme'); ?></a></li>
	<li><b>></b><a href="<?= $home_url; ?>/gig-games-filter/">games</a></li>
	<li><b>></b><?= $steam_game['genres_links']; ?></li>
	<li><b>></b><?= @$steam_game['title']; ?></li>
</ul>
<?php if($steam_game): ?>
<h1 class="block-mt gig-game-title"><?= $steam_game['title']; ?> <span class="title-stars"><?= print_stars($steam_game); ?></h1>
<div class="gig-main-row row">
	<div class="col-sm-10">
<div class="row gig-dis-flex">
	<div class="col-sm-6 gig-dis-flex"><div class="aqs-purplee gig-flex1">
		<!-- Place somewhere in the <body> of your page -->
		<figure id="slider" class="flexslider">
		  <ul class="slides">
		    <?= $gig_pics['img_header']; ?>
		    <?= $gig_pics['img_big1']; ?>
		    <?= $gig_pics['img_big2']; ?>
		    <?= $gig_pics['img_big3']; ?>
		    <?= $gig_pics['img_big4']; ?>
		    <!-- items mirrored twice, total of 12 -->
		  </ul>
		</figure>
		<div id="carousel" class="flexslider">
		  <ul class="slides">
		    <?= $gig_pics['img_header_s']; ?>
		    <?= $gig_pics['img_small1']; ?>
		    <?= $gig_pics['img_small2']; ?>
		    <?= $gig_pics['img_small3']; ?>
		    <?= $gig_pics['img_small4']; ?>
		    <!-- items mirrored twice, total of 12 -->
		  </ul>
		</div>
	</div></div><!-- col-sm-6 --><!-- aqs-purple -->
	<div class="col-sm-6">
		<div class="aqs-purple">
		<table class="game-specifics">
			<tr>
				<td class="l-col"><?= _e('USK-Einstufung:','gig-theme'); ?></td>
				<td class="r-col"><?= ($steam_game['usk_age']) ? $steam_game['usk_age'] : _e('Unbekannt','gig-theme');?></td>
			</tr>
			<tr>
				<td class="l-col"><?= _e('Spielmodus:','gig-theme'); ?></td>
				<td class="r-col"><?= $steam_game['specs_links']; ?></td>
			</tr>
			<tr>
				<td class="l-col"><?= _e('Downloade Site:','gig-theme'); ?></td>
				<td class="r-col">store.steampowered.com</td>
			</tr>
			<tr>
				<td class="l-col"><?= _e('Besonderheiten:','gig-theme'); ?></td>
				<td class="r-col"><?= _e('Download-Code','gig-theme'); ?></td>
			</tr>
			<tr>
				<td class="l-col"><?= _e('Tags:','gig-theme'); ?></td>
				<td class="r-col"><?= $steam_game['tags_links']; ?></td>
			</tr>
			<tr>
				<td class="l-col"><?= _e('Erscheinungsjahr:','gig-theme'); ?></td>
				<td class="r-col"><?= $steam_game['year_link']; ?></td>
			</tr>
			<tr>
				<td class="l-col"><?= _e('Plattform:','gig-theme'); ?></td>
				<td class="r-col"><?= $steam_game['os_links']; ?></td>
			</tr>
			<tr>
				<td class="l-col"><?= _e('Genre:','gig-theme'); ?></td>
				<td class="r-col"><?= $steam_game['genres_links']; ?></td>
			</tr>
			<tr>
				<td class="l-col"><?= _e('Herausgeber:','gig-theme'); ?></td>
				<td class="r-col"><?= $steam_game['publisher_link']; ?></td>
			</tr>
			<tr>
				<td class="l-col"><?= _e('Marke:','gig-theme'); ?></td>
				<td class="r-col"><?= $steam_game['developer_link']; ?></td>
			</tr>
			<tr>
				<td class="l-col"><?= _e('Regionalcode:','gig-theme'); ?></td>
				<td class="r-col"><?= _e('Regionalcode-frei','gig-theme'); ?></td>
			</tr>
			<tr>
				<td class="l-col"><?= _e('Language:','gig-theme'); ?></td>
				<td class="r-col"><?= $steam_game['lang_links']; ?></td>
			</tr>
			<tr>
				<?php if(false && $woo_id = is_in_woo($wpdb2, $steam_game['id'])): // off ?>
				<td class="woo-buy-btn" colspan="2">
					<?= do_shortcode("[add_to_cart id='$woo_id']"); ?>
				</td>
				<?php else: ?>	
				<td class="game-price price">
					<?php 
						$our_price = get_our_price($steam_game); 
						echo $our_price['price']; 
					?>
				</td>
				<td class="game-link">
					<a href="<?= $our_price['link']; ?>" target="_blank"><?= _e('ZEIGEN','gig-theme'); ?></a>
				</td>
				<?php endif; ?>	
			</tr>
		</table>
		</div>
	</div><!-- col-sm-6 -->
</div><!-- row -->
<!-- <link rel="stylesheet" href="<?= $template_directory_uri; ?>/css/flexslider.css">
<script src="<?= $template_directory_uri; ?>/js/jquery.flexslider.js"></script> -->
<script>
jQuery(function($) {
  // The slider being synced must be initialized first
  $('#carousel').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
    itemWidth: 210,
    itemMargin: 5,
    asNavFor: '#slider'
  });
 
  $('#slider').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
    sync: "#carousel"
  });
});
</script>
<div class="gig-tabs block-mt">
	<input name="gig1" class="giginp1" id="giginp11" checked="" type="radio">
	<input name="gig1" class="giginp2" id="giginp12" type="radio">
	<input name="gig1" class="giginp3" id="giginp13" type="radio">
	<label class="gig-lab1" for="giginp11"><?= _e('Spielbeschreibung','gig-theme'); ?></label>
	<label class="gig-lab2" for="giginp12"><?= _e('Aktivierungsanleitung','gig-theme'); ?></label>
	<label class="gig-lab3" for="giginp13"><?= _e('Systemanforderungen','gig-theme'); ?></label>
	<div class="gig-tab">
		<div class="tab1 gig-about-de">
			<?php // google_adv('game-desc'); ?>
			<?= $steam_game['desc']; ?><!--about-de-end-->
			<a class="gig-quelle"><?= _e('Quelle: steampowered','gig-theme'); ?></a><!--link-end-->
		</div>
		<div class="tab2">
			<?= activation_text(); ?>
		</div>
		<div class="tab3 gig-sys-de"><?= $steam_game['sys_req']; ?><!--sys-de-end-->
		</div>
	</div>
</div><!-- .gig-tabs -->
	</div>
	<div class="col-sm-2 gig-dis-flex">
		<div class="adv-sidebar aqs-purple gig-flex1">
			<?php google_adv('adv-sidebar'); ?>
		</div>
	</div>
</div><!-- gig-main-row -->
<?php endif; // if($steam_game) ?>

<?php if($steam_popular_games): ?>
<div class="similar-games block-mt">
	<h2><?= _e('Beliebte Spiele','gig-theme'); ?></h2>
	<div class="aqs-slider-wrapper" id="aqs_slider_wrapper">
		<ul class="aqs-slider" id="aqs_slider">
			<?php foreach ($steam_popular_games as $key => $game): 
				if (false && $key === 1) {
					echo '<li><div class="game-card aqs-purple" style="width: 100%; height:262px">';
				 	google_adv('carousel-1');
				 	echo '</div></li>';
				 	continue;
				 } ?>
				<li>
					<div class="game-card aqs-purple">
						<img class="image lazyload" data-src="//parser.gig-games.de/steam-images/<?= $game['type']; ?>s-<?= $game['appid']; ?>/header-180x84.jpg" alt="<?= get_img_alt($game); ?>" title="<?= htmlspecialchars($game['title']); ?>">
						<h3 class="title"><?= $game['title']; ?></h3>
						<div class="price">€<?= $game['price']; ?></div>
						<a class="link" href="<?= get_gig_game_link($home_url, $game); ?>"><?= _e('ZEIGEN','gig-theme'); ?></a>
						<div class="stars"><?php print_stars($game); ?></div>
					</div>
				</li>
			<?php endforeach; ?>
		</ul>
		<div class="aqs-slider-controls">
			<button class="aqs-purple" id="aqs_prev">←</button>
			<button class="aqs-purple" id="aqs_next">→</button>
		</div>
	</div><!-- aqs-slider-wrapper -->
</div><!-- similar-games -->
<script>
document.addEventListener("DOMContentLoaded", function() {
	document.all.aqs_slider.aqs_slider({
		prev: document.all.aqs_prev,
		next: document.all.aqs_next,
	});
});
</script>
<?php endif; // if($steam_popular_games) ?>

<?php if($similar_games): ?>
<div class="compare-table-wrapper block-mt">
<h2><?= _e('Spielvergleich Mit ähnlichen Produkten vergleichen','gig-theme'); ?></h2>
<div class="compare-table aqs-purple">
	<div class="attributes-wrapper col-xs-4 col-sm-3">
		<!-- <div class="offset fixed-height"></div> -->
		<div class="aqs-slider-controls">
			<button class="aqs-purple" id="aqs_prevv">←</button>
			<button class="aqs-purple" id="aqs_nextt">→</button>
		</div>
		<div class="attributes">
			<div class="eclips"><?= _e('Preis:','gig-theme'); ?></div>
			<div class="eclips"><?= _e('USK-Einstufung:','gig-theme'); ?></div>
			<div class="eclips"><?= _e('Spielmodus:','gig-theme'); ?></div>
			<div class="eclips"><?= _e('Downloade Site:','gig-theme'); ?></div>
			<div class="eclips"><?= _e('Besonderheiten:','gig-theme'); ?></div>
			<div class="eclips"><?= _e('Tags:','gig-theme'); ?></div>
			<div class="eclips"><?= _e('Erscheinungsjahr:','gig-theme'); ?></div>
			<div class="eclips"><?= _e('Plattform:','gig-theme'); ?></div>
			<div class="eclips"><?= _e('Genre:','gig-theme'); ?></div>
			<div class="eclips"><?= _e('Herausgeber:','gig-theme'); ?></div>
			<div class="eclips"><?= _e('Marke:','gig-theme'); ?></div>
			<div class="eclips"><?= _e('Regionalcode:','gig-theme'); ?></div>
			<div class="eclips"><?= _e('Language:','gig-theme'); ?></div>
		</div>
	</div>
	<div class="col-xs-8 col-sm-9">
		<div class="row" id="compare_slider">
			<?php foreach ($similar_games as $key => $game): 
				if ($key === 1 && false) {
					echo '<div class="col-xs-6 col-sm-4 compare-card">';
				 	google_adv('pop-games');
				 	echo '</div>';
				 	continue;
				 } ?>

				<div class="col-xs-6 col-sm-4 compare-card">
					<div class="fixed-height">
						<img class="image lazyload" data-src="//parser.gig-games.de/steam-images/<?= $game['type']; ?>s-<?= $game['appid']; ?>/header-256x120.jpg" alt="<?= get_img_alt($game); ?>" title="<?= htmlspecialchars($game['title']); ?>">
					</div>
					<h3 class="title" title="<?= htmlspecialchars($game['title']); ?>"><?= $game['title']; ?></h3>
					<a class="link" href="<?= get_gig_game_link($home_url, $game); ?>"><?= _e('ZEIGEN','gig-theme'); ?></a>
					<div class="eclips stars"><?php print_stars($game); ?></div>
					<div class="eclips">EUR <?= str_replace('.', ',', $game['reg_price']); ?></div>
					<div class="eclips"><?= ($game['usk_age']) ? $game['usk_age'] : 'Unbekannt';?></div>
					<div class="eclips" title="<?= htmlspecialchars($game['specs']); ?>"><?= $game['specs']; ?></div>
					<div class="eclips">store.steampowered.com</div>
					<div class="eclips"><?= _e('Download-Code','gig-theme'); ?></div>
					<div class="eclips" title="<?= htmlspecialchars($game['tags']); ?>"><?= $game['tags']; ?></div>
					<div class="eclips"><?= $game['year']; ?></div>
					<div class="eclips"><?= $game['os']; ?></div>
					<div class="eclips" title="<?= htmlspecialchars($game['genres']); ?>"><?= $game['genres']; ?></div>
					<div class="eclips"><?= $game['publisher']; ?></div>
					<div class="eclips"><?= $game['developer']; ?></div>
					<div class="eclips"><?= _e('Regionalcode-frei','gig-theme'); ?></div>
					<div class="eclips" title="<?= htmlspecialchars($game['lang']); ?>"><?= $game['lang']; ?></div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div><!-- row compare-table -->
</div><!-- compare-table-wrapper -->
<script>
document.addEventListener("DOMContentLoaded", function() {
	document.all.compare_slider.aqs_slider({
		prev: document.all.aqs_prevv,
		next: document.all.aqs_nextt,
	});
});
</script>
<?php endif; //if($similar_games) ?>

<?php if($our_popular_games): ?>
<div class="latest-news block-mt"><div class="w1200">
<div class="similar-games similar-games-bottom block-mt">
	<h2><?= _e('Beliebte Spiele','gig-theme'); ?></h2>
	<div class="aqs-slider-wrapper" id="aqs_slider_wrapper">
		<ul class="aqs-slider" id="aqs_slider2">
			<?php foreach ($our_popular_games as $game): ?>
				<li>
					<div class="game-card aqs-purple">
						<img class="image lazyload" data-src="//parser.gig-games.de/steam-images/<?= $game['type']; ?>s-<?= $game['appid']; ?>/header-180x84.jpg" alt="<?= get_img_alt($game); ?>" title="<?= htmlspecialchars($game['title']); ?>">
						<div class="stars"><?php print_stars($game); ?></div>
						<h3 class="title"><?= $game['title']; ?></h3>
						<div class="price">€<?= $game['price']; ?></div>
						<a class="link" href="<?= get_gig_game_link($home_url, $game); ?>"><?= _e('ZEIGEN','gig-theme'); ?></a>
					</div>
				</li>
			<?php endforeach; ?>
		</ul>
		<div class="aqs-slider-controls">
			<button class="aqs-purple" id="aqs_prev2">←</button>
			<button class="aqs-purple" id="aqs_next2">→</button>
		</div>
	</div><!-- aqs-slider-wrapper -->
</div><!-- similar-games -->
</div></div>
<script>
document.addEventListener("DOMContentLoaded", function() {
	document.all.aqs_slider2.aqs_slider({
		prev: document.all.aqs_prev2,
		next: document.all.aqs_next2,
	});
});
</script>
<?php endif; //if($our_popular_games) ?>

<?php function news_block(){ ?>
<div class="latest-news block-mt"><div class="w1200">
	<h2>Neueste Nachrichten</h2>
	<div id="news_slider" class="news-slider">
		<div class="news-slide aqs-purple">
			<img class="lazyload" data-src="//parser.gig-games.de/steam-images/apps-11020/header.jpg" alt="">
			<div class="date">20 Dezember 2018</div>
			<h3 class="title text-center">Optio, quae quis!</h3>
			<div class="short-info text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi, architecto corporis repudiandae ratione dolorum expedita vitae iusto aspernatur quos magni modi minima veniam quidem fugiat iure odit. Optio, quae quis!</div>
		</div>
		<div class="news-slide aqs-purple">
			<img src="//parser.gig-games.de/steam-images/apps-11040/header.jpg" alt="">
			<div class="date">20 Dezember 2018</div>
			<h3 class="title text-center">Optio, quae quis!</h3>
			<div class="short-info text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio animi dolores alias vel. Explicabo, quisquam itaque obcaecati officiis enim iure laboriosam praesentium, beatae optio rem labore modi quo ipsam cum!</div>
		</div>
		<div class="news-slide aqs-purple">
			<img src="//parser.gig-games.de/steam-images/apps-11050/header.jpg" alt="">
			<div class="date">20 Dezember 2018</div>
			<h3 class="title text-center">Optio, quae quis!</h3>
			<div class="short-info text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores saepe soluta aperiam ut facere ea ab optio nemo alias, voluptate, sunt labore delectus culpa eligendi, vitae, magni reiciendis tempora facilis.</div>
		</div>
		<div class="news-slide aqs-purple">
			<img src="//parser.gig-games.de/steam-images/apps-110500/header.jpg" alt="">
			<div class="date">20 Dezember 2018</div>
			<h3 class="title text-center">Optio, quae quis!</h3>
			<div class="short-info text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione ullam odio, similique dolorum temporibus in dolores iure exercitationem, velit illo nisi, eum? Placeat animi illo ullam inventore quae, unde maiores!</div>
		</div>
		<div class="news-slide aqs-purple">
			<img src="//parser.gig-games.de/steam-images/apps-110600/header.jpg" alt="">
			<div class="date">20 Dezember 2018</div>
			<h3 class="title text-center">Optio, quae quis!</h3>
			<div class="short-info text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam, vitae at ducimus pariatur doloremque nulla nam explicabo soluta, veritatis eaque. Minima excepturi dolor rerum nobis, quas quisquam tenetur nam officiis.</div>
		</div>
		<div class="news-slide aqs-purple">
			<img src="//parser.gig-games.de/steam-images/apps-110400/header.jpg" alt="">
			<div class="date">20 Dezember 2018</div>
			<h3 class="title text-center">Optio, quae quis!</h3>
			<div class="short-info text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod amet reiciendis, consequatur placeat in! Quisquam atque suscipit commodi fugit facere at laborum optio hic. Fugit consequuntur, provident. Voluptas, quis, ipsam.</div>
		</div>
		<div class="news-slide aqs-purple">
			<img src="//parser.gig-games.de/steam-images/apps-110800/header.jpg" alt="">
			<div class="date">20 Dezember 2018</div>
			<h3 class="title text-center">Optio, quae quis!</h3>
			<div class="short-info text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto nesciunt ex dolores nam, labore pariatur excepturi perspiciatis doloribus voluptatum in commodi, deserunt veniam optio, saepe quos. Neque consequatur labore ab.</div>
		</div>
	</div>
	<div class="aqs-slider-controls">
		<button class="aqs-purple" id="news_prevv">←</button>
		<button class="aqs-purple" id="news_nextt">→</button>
	</div>
</div></div>
<script>
document.addEventListener("DOMContentLoaded", function() {
	document.all.news_slider.aqs_slider({
		prev: document.all.news_prevv,
		next: document.all.news_nextt,
	});
});
</script>
<?php } // news_block()?>
	</main><!-- .site-main -->
	
	<?php //get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php 
google_adv_script();
get_footer();
?>
<?php console_log_filename(__FILE__); ?>
