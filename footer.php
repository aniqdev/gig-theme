<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

	<?php if ( is_eve_page() ) : //is eveonline ?>
		<footer class="site-footer">
			<div class="container">
				<div class="row footer-flex">
					<div class="col-xs-12 col-sm-3 eve-copy">
						gig-games © 2017 all rights reserved 
					</div>
					<div class="col-xs-12 col-sm-7 footer-menu">
						<nav class="eve-footer-nav">
							<ul>
								<li><a href="/agb/">AGB, Widerrufsbelehrung</a></li>
								<li><a href="/impressum/">Impressum</a></li>
								<li><a href="/datenschutz/">Datenschutz</a></li>
							</ul>
						</nav>
					</div>
					<div class="col-xs-12 col-sm-2 eve-designed">
						<img src="<?php echo get_stylesheet_directory_uri() . '/images/webstudio.png'; ?>" alt="Köln webstudio">
					</div>
				</div>
			</div>
		</footer>
		<?php wp_footer(); ?>
	<?php return; endif; ?>



		</div><!-- .site-content -->
	</div><!-- .site-inner -->
</div><!-- .site -->

<footer id="colophon" class="gig-site-footer container-fluid" role="contentinfo">
	<div class="w1200">
		<div class="row">
			<?php if ( has_nav_menu( 'footer_menu' ) ) : ?>
				<nav class="aqs-footer-menu col-sm-7" role="navigation" aria-label="<?php esc_attr_e( 'Footer Social Links Menu', 'twentysixteen' ); ?>">
					<?php
						wp_nav_menu( [
							'theme_location' => 'footer_menu',
							'menu_class'     => 'aqs-footer-menu-list',
							'depth'          => 1,
						] );
					?>
				</nav><!-- .social-navigation -->
			<?php endif; ?>

			<div class="site-info col-sm-5 text-right">
				<a href="http://koeln-webstudio.de/">Created by Köln Webstudio</a> ©
				<a href="/">gig-games 2004-<?= date("Y"); ?></a>
			</div><!-- .site-info -->
		</div>
		<!-- footer-widgets -->
		<ul class="gig-footer-widget">
			<?php if (function_exists('dynamic_sidebar')) dynamic_sidebar('footer-widgets'); ?>
		</ul>
		<!-- /footer-widgets -->
	</div>
</footer><!-- .site-footer .container-fluid -->

<!-- <div class="aqs-cookies-modal">
	<div class="acm-wrapper">
		<div class="acm-inner" id="acm_inner">

		</div>
	</div>
</div> -->

<template id="acm_template_main">
	<div class="acm-header">
		<h3 class="-title">Мы ценим Вашу приватность!</h3>
	</div>
	<div class="acm-body">
		<p>Мы и наши партнеры используем такие технологии, как файлы cookie, и обрабатываем персональные данные, такие как IP-адрес или информацию браузера, для персонализации рекламы, которую вы видите. Это помогает нам показывать вам более релевантную рекламу и улучшает вашу работу в интернете. Мы также используем эти данные для измерения результатов или настройки содержания нашего веб-сайта. Поскольку мы ценим вашу конфиденциальность, мы просим вашего разрешения на использование этих технологий. Вы всегда можете изменить или отозвать свое согласие позже в разделе "Политика конфиденциальности".</p>
		<ul>
			<li>Хранение информации и доступ</li>
			<li>Персонализация</li>
			<li>Выбор рекламы, доставка, отчетность</li>
			<li>Подбор контента, доставка, отчетность</li>
			<li>Измерение</li>
		</ul>
	</div>
	<div class="acm-footer">
		<div class="row acm-buttons">
			<div class="col-xs-6"><button id="acm_accept_all">Принять все</button></div>
			<div class="col-xs-6"><button>Отклонить все</button></div>
		</div>
		<div class="acm-links text-center">
			<a href="#">Настроить выбор</a> | 
			<a href="#">Подробнее</a>
		</div>
	</div>
</template>

<template id="acm_template_settings">
	<div class="acm-header">
		<h3 class="-title">Настроить выбор</h3>
	</div>
	<div class="acm-body">
		<p>На этой странице вы найдете более подробную информацию о целях обработки данных и вендорах, которые осуществляют свою деятельность на наших веб-сайтах.</p>
		<ul>
			<li>Хранение информации и доступ</li>
			<li>Персонализация</li>
			<li>Выбор рекламы, доставка, отчетность</li>
			<li>Подбор контента, доставка, отчетность</li>
			<li>Измерение</li>
		</ul>
	</div>
	<div class="acm-footer">
		<div class="row acm-buttons">
			<div class="col-xs-6"><button id="acm_accept_all">Принять все</button></div>
			<div class="col-xs-6"><button>Отклонить все</button></div>
		</div>
		<div class="acm-links text-center">
			<a href="#">Настроить выбор</a> | 
			<a href="#">Подробнее</a>
		</div>
	</div>
</template>

<?php wp_footer(); ?>
</body>
</html>
