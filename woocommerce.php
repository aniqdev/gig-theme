<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

// переадресаци я с глвной на страницу евы
// if (is_front_page()) {
// 	wp_redirect( 'https://gig-games.de/produkt-kategorie/mmorpg/eveonline/' );
// 	exit();
// }
?>
<script>console.log('woocommerce.php')</script>
<?php get_header(); ?>

<?php if( is_product_category('eveonline') ) : ?>

	<div class="main-content" role="main">
		<div class='eve-top jarallax' data-jarallax='{"speed": 0.8, "noAndroid": true}' data-jarallax-video="mp4:<?php echo get_template_directory_uri(); ?>/video/main_video.mp4">
			<div class="container">

				<?php if ( have_posts() ) : ?>
					<?php woocommerce_content(); ?>
				<?php endif; ?>
			</div>
		</div>
		<div class="eve-bot">
			<div class="container">
				<div class="eve-universum eve-bot__section">
					<div class="h1">EVE ONLINE<sup>®</sup> Universum</div>
					<div class="content">
						Das Spielgeschehen findet in der fernen Zukunft statt. In Zukunft entdecken Menschen im Weltraum ein Wurmloch, das in die unbekannten Regionen des Universums führt. Das Wurmloch nennt man „EVE Gate“. Die Menschen beginnen eine Kolonisation, es gibt eine aktive Besiedlung und Erkundung unbekannter Planeten. Doch nach einiger Zeit als Folge der Katastrophe wird der Tunnel geschlossen, und jede Verbindung mit der Erde wird unmöglich. Die Kolonien sind gezwungen um Ihr Überleben zu kämpfen. Schließlich bilden sich aus der Nachkommen von den ersten Siedlern vier Fraktionen, die sich an die neuen Umstände angepasst haben du sich im EVE Universum weiterentwickeln.
					</div>
				</div>
				<div class="eve-video eve-bot__section">
					<div class="h1">EVE ONLINE<sup>®</sup> video</div>
					<div class="row">
						<div class="col-xs-12 col-sm-4">
							<div class='embed-container'><iframe src='https://www.youtube.com/embed/uqoxRcP5kbo' frameborder='0' allowfullscreen></iframe></div>
						</div>
						<div class="col-xs-12 col-sm-4">
							<div class='embed-container'><iframe src='https://www.youtube.com/embed/nrwffiIB5ok' frameborder='0' allowfullscreen></iframe></div>
						</div>
						<div class="col-xs-12 col-sm-4">
							<div class='embed-container'><iframe src='https://www.youtube.com/embed/DxTeR5pDBeA' frameborder='0' allowfullscreen></iframe></div>
						</div>
					</div>
				</div>
				<div class="eve-kosten eve-bot__section">
					<div class="h1">EVE ONLINE<sup>®</sup> kosten</div>
					<div class="content">
						Das EVE Online<sup>®</sup> Client, Erweiterungen und Updates sind kostenlos. Man bezahlt ein Monatliches Abonnement. Seit 2016 können Spieler auch über Alpha-Klonstatus kostenfrei im Spiel anmelden. Bei dem kostenlosen Klonstatus sind die Entwicklungsmöglichkeiten des Charakters eingeschränkt. Dennoch kann man an allen Spielgeschehnissen teilnehmen: handeln, kämpfen, Raumschiffe fliegen, mit anderen Spieler kommunizieren. Wenn man sich für kostenpflichtiges Klonstatus entscheidet, kann man immer Omerga Klon aktivieren. Es gibt drei Möglichkeiten die Spielzeit zu bezahlen: man bezahlt direkt das monatlich Abonnement, man kauft Plexe von CCP oder, die günstigste Variante, man kauft Plexe im Spiel für ISK, die man selbst im Spiel erwirtschaftet hat. Charaktere auf diesen Accounts können alle Skills des Spiels mit erhöhter Trainingsgeschwindigkeit erlernen. Wenn man sich plötzlich umentscheidet und den Abonnement nicht zahlen kann/will, bekommt man wieder Alpha-Klonstatus, dabei kann man zwar EVE Online<sup>®</sup> weiterspiele aber nur bestimmte Schiffe fliegen und nur beschränkt weiter Skills entwickeln.
					</div>
				</div>
				<div class="eve-slider eve-bot__section">
					<div class="h1">EVE ONLINE<sup>®</sup> Bilder</div>
					<div class="owl-carousel eve-owl owl-theme">
						<img src="<?php echo get_template_directory_uri() . '/images/slider/1.jpg'; ?>" alt="eve online">
						<img src="<?php echo get_template_directory_uri() . '/images/slider/2.jpg'; ?>" alt="eve online">
						<img src="<?php echo get_template_directory_uri() . '/images/slider/3.jpg'; ?>" alt="eve online">
						<img src="<?php echo get_template_directory_uri() . '/images/slider/4.jpg'; ?>" alt="eve online">
						<img src="<?php echo get_template_directory_uri() . '/images/slider/5.jpg'; ?>" alt="eve online">
					</div>
				</div>
			</div>
		</div>
	</div> <!-- end main-content -->

<?php else : ?>
	<div class="main-content col-md-9" role="main">
        	<?php if ( have_posts() ) : ?>
                <?php woocommerce_content(); ?>
            <?php endif; ?>
	</div> <!-- end main-content -->

	<?php if (!is_eve_page()) : ?>
		<?php get_sidebar(); ?>
	<?php endif; ?>
<?php endif; ?>

<?php get_footer(); ?>