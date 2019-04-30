<?php 
/**
 * The template for displaying Full Width pages.
 *
 * Template Name: Activation
 *
 * @package Theme_Material
 */
?>

<?php get_header(); ?>

	<div class="main-content col-md-9" role="main">
		<?php while( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<!-- Article header -->
				<header class="entry-header"> <?php
					// If the post has a thumbnail and it's not password protected
					// then display the thumbnail
					if ( has_post_thumbnail() && ! post_password_required() ) : ?>
						<figure class="entry-thumbnail"><?php the_post_thumbnail(); ?></figure>
					<?php endif; ?>

					<h1><?php the_title(); ?></h1>
				</header> <!-- end entry-header -->

				<!-- Article content -->
<div class="entry-content">

<!--=========================== activate page begin ===================================-->
		<div class="gigactiv woocommerce">
<!--==============================================================-->
			<input type="radio" name="stage1" class="actinp" id="actinp1">
			<input type="radio" name="stage1" class="actinp" id="actinp2">
			<label for="actinp1" class="activ-stage1">
				<div class="activ-inner">So eröffnen Sie ein Steam, Origin, oder Uplaykonto</div>
			</label>
			<div class="activ-cont"><div class="activ-cont-inner activ-cont-inner1">
				<a href="https://store.steampowered.com/join/" class="button" rel="nofollow" target="_blank">Steam</a>
				<a href="https://signin.ea.com/p/web/create?execution=e218326658s1&amp;initref=https%3A%2F%2Faccounts.ea.com%3A443%2Fconnect%2Fauth%3Fscope%3Dbasic.identity%2Bbasic.persona%2Bsignin%2Boffline%26redirect_uri%3Dhttps%253A%252F%252Fwww.origin.com%252Foauth%252Flogin%253Flpu%253Dtrue%2526ru%253D%252Fde-de%252Fstore%252F%253Flogin%253DWyIiXQ%253D%253D%26locale%3Dde_DE%26display%3Dweb%252Fcreate%26response_type%3Dcode%26client_id%3Dlive.origin.com#panel-splash" class="button" rel="nofollow" target="_blank">Origin</a>
				<a href="https://uplay.ubi.com/#!/de-DE/" class="button" rel="nofollow" target="_blank">Uplay</a>
			</div></div>
<!--==============================================================-->
			<label for="actinp2" class="activ-stage1">
				<div class="activ-inner">So aktivieren Sie ein Spiel</div>
			</label>
			<div class="activ-cont"><div class="activ-cont-inner activ-cont-inner2">

				<input type="radio" name="stage2" class="actinp" id="actinp21">
				<input type="radio" name="stage2" class="actinp" id="actinp22">
				<input type="radio" name="stage2" class="actinp" id="actinp23">
				<label for="actinp21" class="activ-stage2 button">Steam</label>
				<label for="actinp22" class="activ-stage2 button">Origin</label>
				<label for="actinp23" class="activ-stage2 button">Uplay</label>
				<div class="cont-inner gig-activ-steam">
					<h4>Sie haben per E-Mail erhalten</h4>
					<input type="radio" name="stage3" class="actinp" id="actinp31">
					<input type="radio" name="stage3" class="actinp" id="actinp32">
					<input type="radio" name="stage3" class="actinp" id="actinp33">
					<label for="actinp31" class="activ-stage3">
						<h5>Aktivierungsschlüssel</h5>
						<img src="//gig-games.de/wp-content/uploads/activationpage/images/stage2-1.jpg" alt="">
					</label>
					<label for="actinp32" class="activ-stage3">
						<h5>Steamgift</h5>
						<img src="//gig-games.de/wp-content/uploads/activationpage/images/stage2-2.jpg" alt="">
					</label>
					<label for="actinp33" class="activ-stage3">
						<h5>Aktivierungslink</h5>
						<img src="//gig-games.de/wp-content/uploads/activationpage/images/stage2-3.jpg" alt="">
					</label>
					<ul class="activ-steam activ-steam1">
						<li><p>1. Starten Sie das Steamprogramm</p>
							<p>das finden Sie auf Ihrem Desktop</p>
							<p><img src="//gig-games.de/wp-content/uploads/activationpage/images/steam11.jpg" alt=""></p>
							<p>oder in der Programmleiste</p>
							<p><img src="//gig-games.de/wp-content/uploads/activationpage/images/steam12.jpg" alt=""></p>
						</li>
						<li>
							<p>2. melden Sie sich an</p>
							<p><img src="//gig-games.de/wp-content/uploads/activationpage/images/steam13.jpg" alt=""></p>
						</li>
						<li>
							<p>3. Klicken Sie auf „SPIEL HINZUFÜGEN“ und dann auf „Ein Produkt bei Steam aktivieren…“</p>
							<p><img src="//gig-games.de/wp-content/uploads/activationpage/images/steam14.jpg" alt=""></p>
						</li>
						<li>
							<p>4. Fügen Sie den Schlüssel, den Sie über E-Mail erhalten haben, ein und klicken Sie auf „WEITER“. Danach erscheint das Spiel in Ihrer Steambibliothek, wo Sie es nun herunterladen und installieren können.</p>
							<p><img src="//gig-games.de/wp-content/uploads/activationpage/images/steam15.jpg" alt=""></p>
						</li>
					</ul>
					<ul class="activ-steam activ-steam2">
						<li>
							<p>1. Melden Sie sich bei Steam über Browser an </p>
							<p><img src="//gig-games.de/wp-content/uploads/activationpage/images/steam21.jpg" alt=""></p>
						</li>
						<li>
							<p>2. Klicken Sie den  Aktivierungslink, den Sie über E-Mail erhalten haben, an</p>
						</li>
						<li>
							<p>3. Nehmen Sie das Steamgift an. Danach erscheint das Spiel in Ihrer Steambibliothek, wo Sie es nun herunterladen und installieren können.</p>
							<p><img src="//gig-games.de/wp-content/uploads/activationpage/images/steam22.jpg" alt=""></p>
						</li>
					</ul>
					<ul class="list-unstyled activ-steam activ-steam3">
						<li>
							<h5>Klicken Sie den Link an. Was sehen Sie?</h5>
							<p class="text-center">oder</p>
							<input type="radio" name="stage4" class="actinp" id="actinp41">
							<input type="radio" name="stage4" class="actinp" id="actinp42">
							<label for="actinp41"><img src="//gig-games.de/wp-content/uploads/activationpage/images/oder1.jpg" alt="" class="oder1"></label>
							<label for="actinp42"><img src="//gig-games.de/wp-content/uploads/activationpage/images/oder2.jpg" alt="" class="oder2"></label>
							<ul class="humble humble1">
								<li>
									<p>1. Geben Sie bitte Ihre eMailAdresse in das Feld  ein, wiederholen Sie die Eingabe und bestätigen Sie es durch Betätigung des Buttons „Claim“. An diese eMailAdresse wird daraufhin ein weiterer Link verschickt. </p>
								</li>
								<li>
									<p>2. Melden Sie sich bei Steam über Browser an</p>
								</li>
								<li>
									<p>3. Klicken Sie den neunen Aktivierungslink, den Sie über eMail erhalten haben an</p>
								</li>
								<li>
									<p>4. Melden Sie sich bei Steam über Browser an </p>
									<p><img src="//gig-games.de/wp-content/uploads/activationpage/images/steam31.jpg" alt=""></p>
								</li>
								<li>
									<p>5. Klicken Sie den  Aktivierungslink, den Sie über E-Mail erhalten haben, an</p>
								</li>
								<li>
									<p>6. Klicken Sie einfach den  Button „Steam“ an. Danach erscheint das Spiel in Ihrer Steambibliothek, wo Sie es nun herunterladen und installieren können. </p>
									<p><img src="//gig-games.de/wp-content/uploads/activationpage/images/steam32.jpg" alt=""></p>
								</li>
							</ul>
							<ul class="humble humble2">
								<li>
									<p>1. Melden Sie sich bei Steam über Browser an </p>
									<p><img src="//gig-games.de/wp-content/uploads/activationpage/images/steam31.jpg" alt=""></p>
								</li>
								<li>
									<p>2. Klicken Sie den  Aktivierungslink, den Sie über E-Mail erhalten haben, an</p>
								</li>
								<li>
									<p>3. Klicken Sie einfach den  Button „Steam“ an. Danach erscheint das Spiel in Ihrer Steambibliothek, wo Sie es nun herunterladen und installieren können. </p>
									<p><img src="//gig-games.de/wp-content/uploads/activationpage/images/steam32.jpg" alt=""></p>
								</li>
							</ul>
						</li>
					</ul>
				</div>
				<div class="cont-inner gig-activ-origin">
					<ul>
						<li>
							<p>1. Starten Sie Origin und melden Sie sich an</p>
							<p><img src="//gig-games.de/wp-content/uploads/activationpage/images/origin1.jpg" alt=""></p>
						</li>
						<li>
							<p>2. Klicken Sie oben links auf „Origin“ und dann auf „Produktcode einlösen“</p>
							<p><img src="//gig-games.de/wp-content/uploads/activationpage/images/origin2.jpg" alt=""></p>
						</li>
						<li>
							<p>3. Geben Sie den über E-Mail erhaltenen Aktivierungsschlüssel ein. Danach erscheint das Spiel unter „MEINE SPIELE“, wo Sie es nun herunterladen und installieren können.</p>
							<p><img src="//gig-games.de/wp-content/uploads/activationpage/images/origin3.jpg" alt=""></p>
						</li>
					</ul>
				</div>
				<div class="cont-inner gig-activ-uplay">
					<ul>
						<li>
							<p>1. Starten Sie Uplay und melden Sie sich an</p>
							<p><img src="//gig-games.de/wp-content/uploads/activationpage/images/uplay1.jpg" alt=""></p>
						</li>
						<li>
							<p>2. Klicken Sie oben links auf „SPIELE“ und dann auf „Produkt aktivieren“</p>
							<p><img src="//gig-games.de/wp-content/uploads/activationpage/images/uplay2.jpg" alt=""></p>
						</li>
						<li>
							<p>3. Geben Sie den über E-Mail erhaltenen Aktivierungsschlüssel ein. Danach erscheint das Spiel unter „SPIELE“, wo Sie es nun herunterladen und installieren können.</p>
							<p><img src="//gig-games.de/wp-content/uploads/activationpage/images/uplay3.jpg" alt=""></p>
						</li>
					</ul>
				</div>
			</div></div>
<!--==============================================================-->
		</div>
<!--=========================== activate page end ===================================-->

				</div> <!-- end entry-content -->

				<!-- Article footer -->
				<footer class="entry-footer">
					<?php 
						if ( is_user_logged_in() ) {
							echo '<p class="page-edit"><i class="fa fa-pencil-square-o"></i>';
							edit_post_link( __( 'Edit', 'material' ), '<span class="meta-edit">', '</span>' );
							echo '</p>';
						}
					?>
				</footer> <!-- end entry-footer -->
			</article>

			<?php comments_template(); ?>
		<?php endwhile; ?>
	</div> <!-- end main-content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>