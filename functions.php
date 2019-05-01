<?php
/**
 * Twenty Sixteen functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

/**
 * Twenty Sixteen only works in WordPress 4.4 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twentysixteen_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * Create your own twentysixteen_setup() function to override in a child theme.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentysixteen
	 * If you're building a theme based on Twenty Sixteen, use a find and replace
	 * to change 'twentysixteen' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'twentysixteen' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	// add_theme_support( 'title-tag' );

	/*
	 * Enable support for custom logo.
	 *
	 *  @since Twenty Sixteen 1.2
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 9999 );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'twentysixteen' ),
		'social'  => __( 'Social Links Menu', 'twentysixteen' ),
		'footer_menu'  => __( 'Footer Menu', 'twentysixteen' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'status',
		'audio',
		'chat',
	) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', twentysixteen_fonts_url() ) );

	// Load regular editor styles into the new block-based editor.
	add_theme_support( 'editor-styles' );

	// Load default block styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for responsive embeds.
	add_theme_support( 'responsive-embeds' );

	// Add support for custom color scheme.
	add_theme_support( 'editor-color-palette', array(
		array(
			'name'  => __( 'Dark Gray', 'twentysixteen' ),
			'slug'  => 'dark-gray',
			'color' => '#1a1a1a',
		),
		array(
			'name'  => __( 'Medium Gray', 'twentysixteen' ),
			'slug'  => 'medium-gray',
			'color' => '#686868',
		),
		array(
			'name'  => __( 'Light Gray', 'twentysixteen' ),
			'slug'  => 'light-gray',
			'color' => '#e5e5e5',
		),
		array(
			'name'  => __( 'White', 'twentysixteen' ),
			'slug'  => 'white',
			'color' => '#fff',
		),
		array(
			'name'  => __( 'Blue Gray', 'twentysixteen' ),
			'slug'  => 'blue-gray',
			'color' => '#4d545c',
		),
		array(
			'name'  => __( 'Bright Blue', 'twentysixteen' ),
			'slug'  => 'bright-blue',
			'color' => '#007acc',
		),
		array(
			'name'  => __( 'Light Blue', 'twentysixteen' ),
			'slug'  => 'light-blue',
			'color' => '#9adffd',
		),
		array(
			'name'  => __( 'Dark Brown', 'twentysixteen' ),
			'slug'  => 'dark-brown',
			'color' => '#402b30',
		),
		array(
			'name'  => __( 'Medium Brown', 'twentysixteen' ),
			'slug'  => 'medium-brown',
			'color' => '#774e24',
		),
		array(
			'name'  => __( 'Dark Red', 'twentysixteen' ),
			'slug'  => 'dark-red',
			'color' => '#640c1f',
		),
		array(
			'name'  => __( 'Bright Red', 'twentysixteen' ),
			'slug'  => 'bright-red',
			'color' => '#ff675f',
		),
		array(
			'name'  => __( 'Yellow', 'twentysixteen' ),
			'slug'  => 'yellow',
			'color' => '#ffef8e',
		),
	) );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif; // twentysixteen_setup
add_action( 'after_setup_theme', 'twentysixteen_setup' );

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'twentysixteen_content_width', 840 );
}
add_action( 'after_setup_theme', 'twentysixteen_content_width', 0 );

/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'twentysixteen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'twentysixteen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Content Bottom 1', 'twentysixteen' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'twentysixteen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Content Bottom 2', 'twentysixteen' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'twentysixteen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'twentysixteen_widgets_init' );

if ( ! function_exists( 'twentysixteen_fonts_url' ) ) :
/**
 * Register Google fonts for Twenty Sixteen.
 *
 * Create your own twentysixteen_fonts_url() function to override in a child theme.
 *
 * @since Twenty Sixteen 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function twentysixteen_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Merriweather font: on or off', 'twentysixteen' ) ) {
		$fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';
	}

	/* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'twentysixteen' ) ) {
		$fonts[] = 'Montserrat:400,700';
	}

	/* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'twentysixteen' ) ) {
		$fonts[] = 'Inconsolata:400';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'twentysixteen_javascript_detection', 0 );

/**
 * Enqueues scripts and styles.
 *
 * @since Twenty Sixteen 1.0
 */
define( 'GIG_THEME_ROOT', get_stylesheet_directory_uri() );
function twentysixteen_scripts() {
			// Load the stylesheets
		if ( is_eve_page() ) {
			// wp_enqueue_style( 'eve-bootstrap', GIG_THEME_ROOT . '/stylesheets/bootstrap.css' );
			// wp_enqueue_style( 'eve-owl', GIG_THEME_ROOT . '/stylesheets/owl.carousel.min.css' );
			wp_enqueue_style( 'eve-custom', GIG_THEME_ROOT . '/stylesheets/eve.css' );

			wp_enqueue_script( 'jarallax', GIG_THEME_ROOT . '/javascripts/jarallax.min.js', array(), false, true );
			wp_enqueue_script( 'jarallax-video', GIG_THEME_ROOT . '/javascripts/jarallax-video.min.js', array(), false, true );
			wp_enqueue_script( 'eve-js', GIG_THEME_ROOT . '/javascripts/eve.js', array('jquery'), false, true );

			//load google fonts async
			$async_fonts = "WebFontConfig = {
				google: { families: [ 'Open+Sans:400,700' ] }
			  };
			  (function() {
				var wf = document.createElement('script');
				wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
				wf.type = 'text/javascript';
				wf.async = 'true';
				var s = document.getElementsByTagName('script')[0];
				s.parentNode.insertBefore(wf, s);
				})();";
			wp_add_inline_script('eve-js', $async_fonts);

			wp_enqueue_script( 'owl', GIG_THEME_ROOT . '/javascripts/owl.carousel.min.js', array('jquery'), false, true );
			return;
		}
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'twentysixteen-fonts', twentysixteen_fonts_url(), array(), null );

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.4.1' );

	// Theme stylesheet.
	wp_enqueue_style( 'twentysixteen-style', get_stylesheet_uri() );

	// Theme block stylesheet.
	wp_enqueue_style( 'twentysixteen-block-style', get_template_directory_uri() . '/css/blocks.css', array( 'twentysixteen-style' ), '20181018' );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'twentysixteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentysixteen-style' ), '20160816' );
	wp_style_add_data( 'twentysixteen-ie', 'conditional', 'lt IE 10' );

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'twentysixteen-ie8', get_template_directory_uri() . '/css/ie8.css', array( 'twentysixteen-style' ), '20160816' );
	wp_style_add_data( 'twentysixteen-ie8', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'twentysixteen-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'twentysixteen-style' ), '20160816' );
	wp_style_add_data( 'twentysixteen-ie7', 'conditional', 'lt IE 8' );

	// Load the html5 shiv.
	wp_enqueue_script( 'twentysixteen-html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
	wp_script_add_data( 'twentysixteen-html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'twentysixteen-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20160816', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'twentysixteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20160816' );
	}

	wp_enqueue_script( 'twentysixteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20160816', true );

	wp_localize_script( 'twentysixteen-script', 'screenReaderText', array(
		'expand'   => __( 'expand child menu', 'twentysixteen' ),
		'collapse' => __( 'collapse child menu', 'twentysixteen' ),
	) );

	if(is_front_page()) {
		wp_enqueue_script( 'tween-light', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.2/TweenLite.min.js', [], false, true );
		wp_enqueue_script( 'ease-pack', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.2/easing/EasePack.min.js', [], false, true );
		wp_enqueue_script( 'canvas-experiment', GIG_THEME_ROOT . '/js/canvas-experiment.js', [], false, true );
	}

	if(is_page('game')){
		wp_enqueue_script( 'flexslider', GIG_THEME_ROOT . '/js/jquery.flexslider.js', [], '2.7.0', true );
		wp_enqueue_style( 'flexslider', GIG_THEME_ROOT . '/css/flexslider.css', [], '2.7.0' );
	}

	if(!is_admin()) {
		wp_enqueue_script("jquery-ui-autocomplete", ['jquery']);
		wp_enqueue_script("jquery-ui-slider", ['jquery']);
		wp_enqueue_script( 'aqs-slider', GIG_THEME_ROOT . '/js/aqs-slider.js?t='.filemtime (__DIR__.'/js/aqs-slider.js'), [], '1.1.1', true );
		wp_enqueue_script( 'lazysizes', GIG_THEME_ROOT . '/js/lazysizes.min.js', [], '4.1.7', true );
	}

}
add_action( 'wp_enqueue_scripts', 'twentysixteen_scripts' );

/**
 * Enqueue styles for the block-based editor.
 *
 * @since Twenty Sixteen 1.6
 */
function twentysixteen_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'twentysixteen-block-editor-style', get_template_directory_uri() . '/css/editor-blocks.css' );
	// Add custom fonts.
	wp_enqueue_style( 'twentysixteen-fonts', twentysixteen_fonts_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'twentysixteen_block_editor_styles' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function twentysixteen_body_classes( $classes ) {
	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}

	// Adds a class of group-blog to sites with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of no-sidebar to sites without active sidebar.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'twentysixteen_body_classes' );

/**
 * Converts a HEX value to RGB.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function twentysixteen_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
	} else if ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function twentysixteen_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	if ( 840 <= $width ) {
		$sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';
	}

	if ( 'page' === get_post_type() ) {
		if ( 840 > $width ) {
			$sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
		}
	} else {
		if ( 840 > $width && 600 <= $width ) {
			$sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
		} elseif ( 600 > $width ) {
			$sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
		}
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'twentysixteen_content_image_sizes_attr', 10 , 2 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return array The filtered attributes for the image markup.
 */
function twentysixteen_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( 'post-thumbnail' === $size ) {
		if ( is_active_sidebar( 'sidebar-1' ) ) {
			$attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
		} else {
			$attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
		}
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'twentysixteen_post_thumbnail_sizes_attr', 10 , 3 );

/**
 * Modifies tag cloud widget arguments to display all tags in the same font size
 * and use list format for better accessibility.
 *
 * @since Twenty Sixteen 1.1
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array The filtered arguments for tag cloud widget.
 */
function twentysixteen_widget_tag_cloud_args( $args ) {
	$args['largest']  = 1;
	$args['smallest'] = 1;
	$args['unit']     = 'em';
	$args['format']   = 'list';

	return $args;
}
add_filter( 'widget_tag_cloud_args', 'twentysixteen_widget_tag_cloud_args' );

/* Add to cart */
add_filter( 'woocommerce_product_single_add_to_cart_text', 'tb_woo_custom_cart_button_text' );
add_filter( 'woocommerce_product_add_to_cart_text', 'tb_woo_custom_cart_button_text' );   
function tb_woo_custom_cart_button_text() {
		return __( 'SOFORT-KAUFEN', 'woocommerce' );
}



 function is_eve_page() {

	global $post;
	$terms = $post ? wp_get_post_terms( $post->ID, 'product_cat' ) : [];
	foreach ( $terms as $term ) $categories[] = $term->slug;

	if ( is_product() && in_array( 'eveonline', $categories ) ) {
		return true;
	}

	if ( is_product_category('eveonline') ) {
		return true;
	} else {
		return false;
	}
 }


remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

function my_theme_wrapper_start() {
  echo '<section id="main">';
}

function my_theme_wrapper_end() {
  echo '</section>';
}

add_theme_support( 'woocommerce' );

/************add cart ajax**************/

add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');

function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();

	if ( is_eve_page() ) {
		?>
		<div>
			<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>">
				<span class="cart-items-count"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?></span>
				<?php echo $woocommerce->cart->get_cart_total(); ?>
			</a>
		</div>
		<?php
	} else {
		?>
		<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>
		<?php
	}

	$fragments['a.cart-contents'] = ob_get_clean();

	return $fragments;

}

/*********** add product tab **************

add_filter( 'woocommerce_product_tabs', 'woo_new_product_tab' );
function woo_new_product_tab( $tabs ) {

	// Adds the new tab

	$tabs['test_tab'] = array(
		'title' 	=> __( 'New Product Tab1', 'woocommerce' ),
		'priority' 	=> 50,
		'callback' 	=> 'woo_new_product_tab_content'
	);

	return $tabs;

}
function woo_new_product_tab_content() {

	// The new tab content

	echo '<h2>New Product Tab2</h2>';
	echo '<p>Here\'s your new product tab.</p>';

}
********************/

/**
 * WooCommerce Extra Feature
 * --------------------------
 *
 * Change number of related products on product page
 * Set your own value for 'posts_per_page'
 *
 */
function woo_related_products_limit() {
  global $product;

	$args['posts_per_page'] = 6;
	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args' );
  function jk_related_products_args( $args ) {

	$args['posts_per_page'] = 4; // 4 related products
	$args['columns'] = 2; // arranged in 2 columns
	return $args;
}

/*
настройка визуального редактора
*/



/* ��७�� (jquery) � ������ */
// function jquery_in_footer() {
// wp_deregister_script( 'jquery' );
// wp_register_script( 'jquery', includes_url('/js/jquery/jquery.js'), array(), null, true );
// }
// add_action( 'wp_enqueue_scripts', 'jquery_in_footer' );
/* ��७�� (jquery) � ������ */

//EVE cutom scripts


add_filter( 'body_class', 'custom_class' );

function custom_class( $classes ) {
	if ( is_eve_page() ) {
		$classes[] = 'eve-template';
	}
	return $classes;
}



add_action( 'wp', 'wpdev_170663_remove_parent_theme_stuff', 0 );
function wpdev_170663_remove_parent_theme_stuff() {
	if ( is_eve_page() ) {

		//move title to top
		remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title');
		add_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_title', 5);


		//hide price from single page
		remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price');
		//hide categiries
		remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
		//hide rating single products
		remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
		//replace related products
		remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
		add_action('woocommerce_before_single_product_summary', 'woocommerce_output_related_products', 3);
		add_action('woocommerce_before_single_product_summary', 'related_wrap', 2);
		add_action('woocommerce_before_single_product_summary', 'related_wrap_after', 4);
		function related_wrap() {
			echo "<div class='row'><div class='col-xs-12 col-sm-3 eve-related'>";
		}
		function related_wrap_after() {
			echo "</div>";
		}


		//replace title
		remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
		add_action('woocommerce_before_single_product_summary', 'woocommerce_template_single_title', 6);
		add_action('woocommerce_before_single_product_summary', 'single_title_wrap', 5);
		add_action('woocommerce_before_single_product_summary', 'single_title_wrap_after', 21);
		function single_title_wrap() {
			echo "<div class='col-xs-12 col-sm-5 single_title_wrap'>";
		}
		function single_title_wrap_after() {
			echo "</div>";
		}

		//wrap summary with column
		add_action('woocommerce_single_product_summary', 'before_summary', 1);
		add_action('woocommerce_single_product_summary', 'after_summary', 51);
		function before_summary() {
			echo "<div class='col-xs-12 col-sm-4 single-product-meta'>";
		}
		function after_summary() {
			echo "</div></div><!-- .row -->";
		}

		//related mobile
		add_action('woocommerce_single_product_summary', 'woocommerce_output_related_products', 45);
		add_action('woocommerce_single_product_summary', 'related_wrap_mob', 44);
		add_action('woocommerce_single_product_summary', 'related_wrap__mob_after', 46);
		function related_wrap_mob() {
			echo "<div class='eve-related eve-related-mobile'>";
		}
		function related_wrap__mob_after() {
			echo "</div>";
		}

		//add contacts block
		add_action('woocommerce_single_product_summary', 'eve_contacts', 49);
		function eve_contacts() {
			?>
			<div class="eve-contacts">
				<div class="eve-contacts__title">kontakt</div>
				<ul>
					<li><img src="<?php echo get_template_directory_uri(); ?>/images/contacts/gears.png" alt="gear"> Support 24H/7</li>
					<li><img src="<?php echo get_template_directory_uri(); ?>/images/contacts/facebook.png" alt="facebook"> @giggamessupport</li>
					<li><img src="<?php echo get_template_directory_uri(); ?>/images/contacts/icq.png" alt="icq"> ICQ 169-900</li>
					<li><img src="<?php echo get_template_directory_uri(); ?>/images/contacts/mail.png" alt="mail"> support@gig-games.de</li>
					<li><img src="<?php echo get_template_directory_uri(); ?>/images/contacts/skype.png" alt="skype"> g.i.g-group</li>
					<li><img src="<?php echo get_template_directory_uri(); ?>/images/contacts/whatsapp.png" alt="watsapp"> +49 157 88453267</li>
				</ul>

				<script type="text/javascript">(function(w,doc) {
				if (!w.__utlWdgt ) {
					w.__utlWdgt = true;
					var d = doc, s = d.createElement('script'), g = 'getElementsByTagName';
					s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
					s.src = ('https:' == w.location.protocol ? 'https' : 'http')  + '://w.uptolike.com/widgets/v1/uptolike.js';
					var h=d[g]('body')[0];
					h.appendChild(s);
				}})(window,document);
				</script>
				<div data-background-alpha="0.0" data-buttons-color="#FFFFFF" data-counter-background-color="#ffffff" data-share-counter-size="12" data-top-button="false" data-share-counter-type="separate" data-share-style="1" data-mode="share" data-like-text-enable="false" data-mobile-view="false" data-icon-color="#ffffff" data-orientation="horizontal" data-text-color="#ffffff" data-share-shape="round-rectangle" data-sn-ids="fb.gp." data-share-size="30" data-background-color="#ffffff" data-preview-mobile="false" data-mobile-sn-ids="fb.vk.tw.wh.ok.vb." data-pid="1683037" data-counter-background-alpha="0.0" data-following-enable="false" data-exclude-show-more="true" data-selection-enable="false" class="uptolike-buttons" ></div>
			</div>
			<?php
		}

		//remove sale badge
		add_filter('woocommerce_sale_flash', 'woo_custom_hide_sales_flash');
		function woo_custom_hide_sales_flash()
		{
			return false;
		}

		//hide add to cart BadFunctionCallException
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price');
		add_action( 'woocommerce_after_shop_loop_item_title', 'custom_price');
		function custom_price() {
			?>
			<span class="price"><?php echo get_post_meta( get_the_ID(), '_text_field', true ); ?></span>
			<?php
		}

		//hide star rating

		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
		//hide add to cart BadFunctionCallException
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');
		//add variable lists to the archive products and related products
		add_action('woocommerce_after_shop_loop_item', 'woocommerce_variable_add_to_cart', 15);

		//replace thumbnails
		remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
		add_action('woocommerce_before_shop_loop_item_title', 'custom_thumbnail', 10);
		function custom_thumbnail() {
			echo '<div class="eve-product__img">';
				the_post_thumbnail('full');
			echo '</div>';
		}

		/**
		 * Trim zeros in price decimals
		 **/
		 add_filter( 'woocommerce_price_trim_zeros', '__return_true' );

	}
}


//conver dropdown to list more on https://medium.com/wordpress-knowledge/display-woocommerce-product-variation-in-table-instead-of-drop-down-4b7d31f12987
function woocommerce_variable_add_to_cart() {
	global $product, $post;
	if( $product->has_child() ) {
	$variations = $product->get_available_variations();
	?>

	<div class="eve-product__prices-wrap">
			<?php
			foreach ($variations as $key => $value) {
			?>
				<div class="product__price-item row">
					<div class="product__price">
						<?php echo $value['price_html'];?>
					</div>
					<div class="product__title">
						<?php //echo implode('/', $value['attributes']);?>
						<?php echo $value['variation_description'];?>
					</div>
					<div class="product__add">
						<form action="<?php echo esc_url( $product->add_to_cart_url() ); ?>" method="post" enctype='multipart/form-data' class="variations_form">
						<input type="hidden" name="variation_id" value="<?php echo $value['variation_id']?>" />
						<input type="hidden" name="product_id" value="<?php echo esc_attr( $post->ID ); ?>" />
						<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $post->ID ); ?>" />
						<?php
						if(!empty($value['attributes'])){
						foreach ($value['attributes'] as $attr_key => $attr_value) {
						?>
						<input type="hidden" name="<?php echo $attr_key?>" value="<?php echo $attr_value?>">
						<?php
						}
						}
						?>
						<button type="submit" class="add_to_cart_button single_add_to_cart_button" title="in den Warenkorb">+</button>
						</form>
					</div>
				</div>
			<?php
			}
			?>
	</div>
	<?php
	}
}


// Display Fields
add_action( 'woocommerce_product_options_general_product_data', 'woo_add_custom_general_fields' );

// Save Fields
add_action( 'woocommerce_process_product_meta', 'woo_add_custom_general_fields_save' );


function woo_add_custom_general_fields() {

  global $woocommerce, $post;

  echo '<div class="options_group">';

		// Text Field
		woocommerce_wp_text_input(
			array(
				'id'          => '_text_field',
				'label'       => __( 'Defalt price value', 'woocommerce' ),
				'placeholder' => 'ab 7,5€ / 500 Plex',
				'desc_tip'    => 'false',
				'description' => __( 'Enter the custom value here.', 'woocommerce' )
			)
		);

  echo '</div>';

}

function woo_add_custom_general_fields_save( $post_id ){

	// Text Field
	$woocommerce_text_field = $_POST['_text_field'];
	if( !empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_text_field', esc_attr( $woocommerce_text_field ) );


}

function myajax_data()
{
	wp_localize_script( 'twentysixteen-script', 'myajax', [
		'url' => admin_url('admin-ajax.php'),
		'home_url' => home_url()
	]);  
}
add_action( 'wp_enqueue_scripts', 'myajax_data', 99 );

if (!function_exists('steam_to_gig')) {
	function steam_to_gig($appid)
	{
		if(!$appid) return 0;
		return (int)$appid + 555555;
	}
}

if (!function_exists('gig_to_steam')){
	function gig_to_steam($appid)
	{
		if(!$appid) return 0;
		return (int)$appid - 555555;
	}
}



function aqs_ajax_search()
{
	$wpdb2 = new wpdb( db_USER, db_PASS, db_NAME, db_HOST );

	$search  = esc_sql( $_POST['search'] );
	$games = $wpdb2->get_results( "SELECT type,appid,title,reg_price as price FROM steam_de WHERE title LIKE '%{$search}%' LIMIT 5", ARRAY_A );

	echo json_encode([
		'list' => array_map(function($el)
		{
			return [
				'label' => $el['title'],
				'href' => home_url().'/game/?type='.$el['type'].'&appid='.steam_to_gig($el['appid']),
			];
		}, $games),
	]);
	wp_die();
}
add_action('wp_ajax_aqs_search', 'aqs_ajax_search');
add_action('wp_ajax_aqs_search', 'aqs_ajax_search');


function register_footer_widgets(){
	register_sidebar( array(
		'name' => 'Footer widgets',
		'id' => 'footer-widgets',
		'description' => 'Footer bottom widget panel',
		'class'         => 'gig-footer-widgets',
		'before_widget' => '<li class="footer-widget-block">',
		'after_widget' => '</li>',
		'before_title' => '<h2 class="footer-widget-title">',
		'after_title' => '</h2>',
	) );
}
add_action('widgets_init', 'register_footer_widgets');





function sa($array = [], $save = false){
	if ($save) return '<pre>' . print_r($array, true) . '</pre>';
	echo "<pre>";
	print_r($array);
	echo "</pre>";
}




function activation_text($lang = 'de')
{
	return [
		'de' => '<h3>für die Aktivierung und den Download ist natürlich die Internetverbindung erforderlich</h3>
			a) Laden Sie das Steaminstallationdatei herunter.<br>
			b) Steam installieren: Doppelklick auf die heruntergeladene Datei: SteamInstall.msi
			Folgen Sie den Anweisungen, während der Installation. Wichtig die Länderauswahl, hier legen Sie fest in welcher Sprache Steam ausgeführt werden soll (einfach das Feld vor der jeweiligen Länderauswahl anklicken). Steam wird installiert...
			<br>c) Steam Account einrichten
			Nach erfolgter Installation öffnet sich ein Fenster, wo Sie sich einen "Neuen Account erstellen" oder "In Account einloggen" können.
			Wenn Sie noch keinen Steam-Account haben, so klicken Sie bitte "Neuen Account erstellen" an.
			Lesen Sie den Nutzungsvertrag durch und stimmen dann durch anklicken auf "Ich stimme zu" zu. Die Registrierung des Benutzeraccounts bei Steam ist kostenfrei!
			Folgen Sie den weiteren Anleitungen (Erstellung von Accountname und Passwort).
			Nach Erstellung Ihres Accountnames, des Passwortes und der Angabe einer gültigen Email verfügen Sie über einen Steam-Account. Das Programm ist als Tray-Icon aktiv und ist in der Regel rechts unten in der Symbol-/Taskleiste zu finden. Um auf Steam zuzugreifen, klicken Sie rechts auf das Icon.
			<br>d) Spiel registrieren über Steam
			Im geöffneten Steam-Fenster befinden sich oberhalb mehrere Kartenreiter (Menüpunkte), einer hiervon lautet: "Spiele".
			Bitte "Meine Spiele" anklicken und es erscheinen unterhalb zwei neue Buttons "Steam-fremdes Spiel hinzufügen" und "Ein Produkt bei Steam aktivieren..."
			Bitte halten Sie den CD-Key Ihres Spieles bereit und klicken Sie auf "Ein Produkt bei Steam aktivieren..." und folgen den weiteren Anweisungen.
			<br>e) Download des Spiels
			Nach erfolgreicher Eingabe des CD-Keys wird das Spiel unterhalb "Spiele", mit dem Status: "installieren" aufgelistet. Klicken Sie auf das Spiel und der Download beginnt, das Spiel wird installiert und startet nach Beendigung automatisch.'
	][$lang];
}


$home_url = home_url();
function gig_home_url()
{
	global $home_url;
	return $home_url;
}


function gig_insert_Links($game)
{
	if(!$game) return $game;

	$game['specs_links'] = implode(', ', array_map(function($el){
		return '<a href="'.gig_home_url().'/gig-games-filter/?spec='.$el.'">'.$el.'</a>';
	}, explode(',', $game['specs'])));

	$game['tags_links'] = implode(', ', array_map(function($el){
		return '<a href="'.gig_home_url().'/gig-games-filter/?tag='.$el.'">'.$el.'</a>';
	}, explode(',', $game['tags'])));

	$game['genres_links'] = implode(', ', array_map(function($el){
		return '<a href="'.gig_home_url().'/gig-games-filter/?genre='.$el.'">'.$el.'</a>';
	}, explode(',', $game['genres'])));
	
	$game['lang_links'] = implode(', ', array_map(function($el){
		return '<a href="'.gig_home_url().'/gig-games-filter/?lang='.$el.'">'.$el.'</a>';
	}, explode(',', $game['lang'])));
	
	$game['os_links'] = implode(', ', array_map(function($el){
		return '<a href="'.gig_home_url().'/gig-games-filter/?os='.$el.'">'.$el.'</a>';
	}, explode(',', $game['os'])));

	$game['year_link'] = '<a href="'.gig_home_url().'/gig-games-filter/?release='.$game['year'].'">'.$game['year'].'</a>';

	$game['developer_link'] = '<a href="'.gig_home_url().'/gig-games-filter/?developer='.urlencode($game['developer']).'">'.$game['developer'].'</a>';

	$game['publisher_link'] = '<a href="'.gig_home_url().'/gig-games-filter/?publisher='.urlencode($game['publisher']).'">'.$game['publisher'].'</a>';

	return $game;
}


function gp_insert_Links($game)
{
	if(!$game) return $game;

	$game['specs_links'] = implode(', ', array_map(function($el){
		return '<a href="'.gig_home_url().'/gig-games-filter/?spec='.$el.'">'.$el.'</a>';
	}, explode(',', $game['specs'])));

	$game['tags_links'] = implode(', ', array_map(function($el){
		return '<a href="'.gig_home_url().'/gig-games-filter/?tag='.$el.'">'.$el.'</a>';
	}, explode(',', $game['tags'])));

	$game['genres_links'] = implode(', ', array_map(function($el){
		return '<a href="'.gig_home_url().'/gig-games-filter/?genre='.$el.'">'.$el.'</a>';
	}, explode(',', $game['genres'])));
	
	$game['lang_links'] = implode(', ', array_map(function($el){
		return '<a href="'.gig_home_url().'/gig-games-filter/?lang='.$el.'">'.$el.'</a>';
	}, explode(',', $game['lang'])));
	
	$game['os_links'] = implode(', ', array_map(function($el){
		return '<a href="'.gig_home_url().'/gig-games-filter/?os='.$el.'">'.$el.'</a>';
	}, explode(',', $game['os'])));

	$game['year_link'] = '<a href="'.gig_home_url().'/gig-games-filter/?release='.$game['year'].'">'.$game['year'].'</a>';

	$game['developer_link'] = '<a href="'.gig_home_url().'/gig-games-filter/?developer='.urlencode($game['developer']).'">'.$game['developer'].'</a>';

	$game['publisher_link'] = '<a href="'.gig_home_url().'/gig-games-filter/?publisher='.urlencode($game['publisher']).'">'.$game['publisher'].'</a>';

	return $game;
}


function console_log($text='', $print = true)
{
    if(!defined('DEV_MODE')) return '';

    $text = '<script>console.log(`'.print_r(esc_sql($text),1).'`)</script>';

    if ($print) echo $text;
    else return $text;
}

// use: console_log_filename(__FILE__);
function console_log_filename($file_path, $rtrn = false)
{
    if(!defined('DEV_MODE')) return '';

    $arr = explode('\\', $file_path);
    $file_name = end($arr);

    if ($rtrn) return console_log($file_name, false);
    console_log($file_name);
}

function get_partner_link($url){
	return 'https://rover.ebay.com/rover/1/707-53477-19255-0/1?icep_id=114&ipn=icep&toolid=20004&campid=5338243349&mpre='.rawurlencode($url);
}

function get_our_price($steam_game)
{
	global $wpdb2;
	$steam_link = esc_sql($steam_game['link']);
	$res = $wpdb2->get_row( "SELECT price,item_id FROM ebay_prices WHERE item_id = (select ebay_id from games where steam_link = '$steam_link' limit 1) LIMIT 1", ARRAY_A );

	$ret = [];
	if($res){
		$ret['price'] = '<s>€'.str_replace('.', ',', $steam_game['reg_price']).'</s>'
		.'<br>€'.str_replace('.', ',', $res['price']);
		$ret['link'] = get_partner_link('https://www.ebay.de/itm/'.$res['item_id']);
		$ret['isset_our_price'] = true;
	}else{
		$ret['price'] = '€'.str_replace('.', ',', $steam_game['reg_price']);
		$ret['link'] = 'https://rover.ebay.com/rover/1/707-53477-19255-0/1?icep_id=114&ipn=icep&toolid=20004&campid=5338465470&mpre=https%3A%2F%2Fwww.ebay.de%2Fsch%2FPC-Videospiele%2F1249%2Fi.html%3F_from%3DR40%26_nkw%3D'.rawurlencode($steam_game['title']).'%26_dcat%3D1249%26Plattform%3DPC%26rt%3Dnc%26_trksid%3Dp2045573.m1684';
		$ret['isset_our_price'] = false;
	}
	return $ret;
}


function get_genres_like($steam_genres)
{
	$and_genres_like = '';
	if ($steam_genres) {
		$steam_genres = explode(',', $steam_genres);
		$first_genre = esc_sql($steam_genres[0]);
		$and_genres_like = " AND genres LIKE '%{$first_genre}%' ";
		if (isset($steam_genres[1])) {
			$second_genre = esc_sql($steam_genres[1]);
			$and_genres_like = " AND (genres LIKE '%{$first_genre}%' OR genres LIKE '%{$second_genre}%') ";
		}
	}
	return $and_genres_like;
}
//
//  aqs sanitize  START =========================================================
//
//taken from wordpress
function gig_utf8_uri_encode( $utf8_string, $length = 0 ) {
	$unicode = '';
	$values = array();
	$num_octets = 1;
	$unicode_length = 0;

	$string_length = strlen( $utf8_string );
	for ($i = 0; $i < $string_length; $i++ ) {

		$value = ord( $utf8_string[ $i ] );

		if ( $value < 128 ) {
			if ( $length && ( $unicode_length >= $length ) )
				break;
			$unicode .= chr($value);
			$unicode_length++;
		} else {
			if ( count( $values ) == 0 ) $num_octets = ( $value < 224 ) ? 2 : 3;

			$values[] = $value;

			if ( $length && ( $unicode_length + ($num_octets * 3) ) > $length )
				break;
			if ( count( $values ) == $num_octets ) {
				if ($num_octets == 3) {
					$unicode .= '%' . dechex($values[0]) . '%' . dechex($values[1]) . '%' . dechex($values[2]);
					$unicode_length += 9;
				} else {
					$unicode .= '%' . dechex($values[0]) . '%' . dechex($values[1]);
					$unicode_length += 6;
				}

				$values = array();
				$num_octets = 1;
			}
		}
	}

	return $unicode;
}

//taken from wordpress
function gig_seems_utf8($str) {
	$length = strlen($str);
	for ($i=0; $i < $length; $i++) {
		$c = ord($str[$i]);
		if ($c < 0x80) $n = 0; # 0bbbbbbb
		elseif (($c & 0xE0) == 0xC0) $n=1; # 110bbbbb
		elseif (($c & 0xF0) == 0xE0) $n=2; # 1110bbbb
		elseif (($c & 0xF8) == 0xF0) $n=3; # 11110bbb
		elseif (($c & 0xFC) == 0xF8) $n=4; # 111110bb
		elseif (($c & 0xFE) == 0xFC) $n=5; # 1111110b
		else return false; # Does not match any model
		for ($j=0; $j<$n; $j++) { # n bytes matching 10bbbbbb follow ?
			if ((++$i == $length) || ((ord($str[$i]) & 0xC0) != 0x80))
				return false;
		}
	}
	return true;
}

//function sanitize_title_with_dashes taken from wordpress
function gig_sanitize($title) {
	$title = strip_tags($title);
	// Preserve escaped octets.
	$title = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', '---$1---', $title);
	// Remove percent signs that are not part of an octet.
	$title = str_replace('%', '', $title);
	// Restore octets.
	$title = preg_replace('|---([a-fA-F0-9][a-fA-F0-9])---|', '%$1', $title);

	if (gig_seems_utf8($title)) {
		if (function_exists('mb_strtolower')) {
			$title = mb_strtolower($title, 'UTF-8');
		}
		$title = gig_utf8_uri_encode($title, 200);
	}

	$title = strtolower($title);
	$title = preg_replace('/&.+?;/', '', $title); // kill entities
	$title = str_replace('.', '-', $title);
	$title = preg_replace('/[^%a-z0-9 _-]/', '', $title);
	$title = preg_replace('/\s+/', '-', $title);
	$title = preg_replace('|-+|', '-', $title);
	$title = trim($title, '-');

	return $title;
}
//
//  aqs sanitize  END =========================================================
//
function get_gig_game_url_title($title)
{
	return 'preisvergleich-cd-steam-key-'.gig_sanitize($title);
}

function get_gig_game_link($home_url, &$steam_game)
{
	return $home_url.'/game/?type='.$steam_game['type'].'&appid='.steam_to_gig($steam_game['appid']).'&title='.get_gig_game_url_title($steam_game['title']);
}

function get_img_alt($game)
{
	return htmlspecialchars($game['title']).' cd steam key günstig';
}

function get_gig_meta_desc($game)
{
	$limit = (150-(strlen($game['title']) + 29));

	if($limit < 5) $limit = 0;

	$description = str_replace('<h2>Über dieses Spiel</h2>', '', $game['desc']);

	$description = trim(strip_tags($description));

	$description = substr(' '.$description, 0, $limit);

	$meta_description = '<meta name="description" content="Günstige Preise für '.$game['title'].' finden.'.$description.'">';

	return $meta_description;
}


function google_adv($fabrica, $to_return = false)
{
	switch ($fabrica) {
		case 'carousel-1': // g 1 karusel
			$atts = 'style="display:block;height:100%;"
			     data-ad-slot="2849284536"
			     data-ad-format="auto"
			     data-full-width-responsive="true"';
			break;

		case 'game-desc': // g after 2 br
			$atts = 'style="display:block"
			     data-ad-slot="2031683422"
			     data-ad-format="auto"
			     data-full-width-responsive="true"';
			break;

		case 'adv-sidebar': // g pravii verhniii 160 x 600
			$atts = 'style="display:inline-block;width:160px;height:600px"
			     data-ad-slot="8217817826"';
			break;

		case 'pop-games':
			$atts = 'style="display:inline-block;width:100%;height:600px"
			     data-ad-slot="3013592605';
			break;
		
		default:
			$atts = '';
			break;
	}
	$adv = '<ins class="adsbygoogle"
			     data-ad-client="ca-pub-4009372254971170" '.
			     $atts.
			'></ins>
			<script>(adsbygoogle = window.adsbygoogle || []).push({});</script>';
	if($to_return) return $adv;
	echo $adv;
}


function google_adv_script()
{
	echo '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>';
}


function insert_adv_to_desc($desc)
{
	$arr = explode('<br>', $desc);
	foreach ($arr as $key => &$value) {
		if ($key === 2) {
			$value = google_adv('game-desc', true).$value;
		}
	}
	$desc = implode('<br>', $arr);
	// sa($arr);

	// если меньше 2 брейков
	if (count($arr) < 3) {
		$desc .= google_adv('game-desc', true);
	}
	return $desc;
}


/*** Редирект страниц картинок на home_url ***/
add_action('template_redirect', 'template_redirect_attachment');
function template_redirect_attachment() { 
    // Если это вложение то перейдем на страницу home_url:   
    if (is_attachment()) {     
        wp_redirect(home_url(), 301);  
    } 
}


class QueryString
{
	private $query_string = '';

    private static $instance = null;

    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

	function __construct()
	{
		$this->query_string = $_SERVER['QUERY_STRING'];
	}


	public function __toString()
    {
        return $this->query_string;
    }


	public function set($name = '', $value = '')
	{
		parse_str($this->query_string, $query_arr);
		$query_arr[$name] = $value;
		$query = http_build_query($query_arr);
		$this->query_string = preg_replace('/%5B[0-9]+%5D/simU', '[]', $query);

		return $this;
	}


	public function del($name = '', $value = '')
	{
		parse_str($this->query_string, $query_arr);

		if ($name) {
			unset($query_arr[$name]);
		}elseif ($value) {
			foreach ($query_arr as $k => $val) {
				if ($val === $value) {
					unset($query_arr[$k]);
				}
			}
		}

		$query = http_build_query($query_arr);
		$this->query_string = preg_replace('/%5B[0-9]+%5D/simU', '[]', $query);

		return $this;
	}


	public function give()
	{
		return $this->query_string;
	}
}


function aqs_hrefR($arr = []){
	$qs_obj = QueryString::getInstance();
	foreach ($arr as $key => $val) $qs_obj->set($key,$val);
	return '?'.$qs_obj->give();
}

function aqs_pagination($table_name, $count = false){
	$qs_obj = QueryString::getInstance();

	if(!$count) return [
		'html' => 'no results',
		'epilog' => '',
		'limit' => '0,0',
	];
	$offset = @$_GET['offset'] ? (int)$_GET['offset'] : 0;
	$limit = @$_GET['limit'] ? (int)$_GET['limit'] : 12;
	if($limit > 500) $limit = 500;
	$offset_prev = $offset - $limit;
	if($offset_prev < 0) $offset_prev = 0;
	$offset_next = $offset + $limit;
	if($offset_next > $count) $offset_next = $offset;
	//var_dump($count/$limit);
	$str =
	'<ul class="op-pagination">
	    <li>
	      <a href="?'.$qs_obj->SET('offset',$offset_prev)->SET('limit',$limit)->give().'" aria-label="Previous">
	        <span aria-hidden="true">&laquo;</span>
	      </a>
	    </li>';
	for ($i=-4; $i <= 4; $i++) {
		$inoffset = $offset + ($limit * $i);
		$num = floor($inoffset / $limit + 1);
		$b = $count - $inoffset;
		$a = $b - $limit + 1;
		if($a < 0) $a = 1;
		if ($inoffset < 0) {
			continue;
		}elseif ($inoffset > $count) {
			break;
		} elseif ($inoffset == $offset) {
			$str .= '<li class="active"><a class="curren" title="'.$a.'-'.$b.'">'.$num.'</a></li>';
			$epilog = $a.'-'.$b.' of '.$count.' results';
		}else{
			$str .= '<li><a href="'.aqs_hrefR(['offset'=>$inoffset,'limit'=>$limit]).'" title="'.$a.'-'.$b.'">'.$num.'</a></li>';
		}
	}
	$str .= '<li>
	      <a href="?'.$qs_obj->SET('offset',$offset_next)->SET('limit',$limit)->give().'" aria-label="Next">
	        <span aria-hidden="true">&raquo;</span>
	      </a>
	    </li>
	  </ul>';

	return [
		'html' => $str,
		'epilog' => @$epilog,
		'limit' => $offset.','.$limit,
	];
}

// 
function slctd($name, $value){ return @$_GET[$name] === $value ? ' selected ' : ''; }

function get_gp_sort_select()
{
  $qs_obj = QueryString::getInstance();

  return '<select class="f-select" onchange="location = this.value;">
    <option value="?'.$qs_obj->set('order_by','reviews_desc')->give().'"'.slctd('order_by','reviews_desc').'>bekannteste zuerst</option>
    <option value="?'.$qs_obj->set('order_by','rating_desc' )->give().'"'.slctd('order_by','rating_desc' ).'>höchste Bewertung zuerst</option>
    <option value="?'.$qs_obj->set('order_by','rating_asc'  )->give().'"'.slctd('order_by','rating_asc'  ).'>niedrigste Bewertung zuerst</option>
    <option value="?'.$qs_obj->set('order_by','price_asc'   )->give().'"'.slctd('order_by','price_asc'   ).'>günstigste zuerst</option>
    <option value="?'.$qs_obj->set('order_by','price_desc'  )->give().'"'.slctd('order_by','price_desc'  ).'>teuerste zuerst</option>
  </select>';
}

function get_gp_year_select($years = [])
{
  $qs_obj = QueryString::getInstance();
  $qs_obj->set('offset', '0');

  $options = [];

  foreach ($years as $year) {
  	$options[] = '<option value="?'.$qs_obj->set('release',$year)->give().'"'.slctd('release',$year).'>'.$year.'</option>';
  }

  $options = implode(PHP_EOL, $options);

  return '<select class="f-select" onchange="location = this.value;">
    <option value="?'.$qs_obj->set('release','year')->give().'"'.slctd('release','year').'>Jahr</option>
    '.$options.'
  </select>';
}

function get_gp_order()
{
	switch (@$_GET['order_by']) {
		case 'reviews_asc': return 'ORDER BY o_reviews ASC';
		case 'reviews_desc': return 'ORDER BY o_reviews DESC';
		case 'rating_asc': return 'ORDER BY o_rating ASC';
		case 'rating_desc': return 'ORDER BY o_rating DESC';
		case 'price_asc': return 'ORDER BY ebay_price ASC';
		case 'price_desc': return 'ORDER BY ebay_price DESC';
		case 'advantage_asc': return 'ORDER BY advantage ASC';
		case 'advantage_desc': return 'ORDER BY advantage DESC';
		
		default: return 'ORDER BY o_reviews DESC'; // первое значение из селекта get_gp_sorting()
	}
}

// wp_update_nav_menu_item( $menu_id = 0, $menu_item_db_id = 0, [
// 		'menu-item-object-id'   => 0,
// 		'menu-item-object'      => '',
// 		'menu-item-parent-id'   => 1,
// 		'menu-item-position'    => 1,
// 		'menu-item-type'        => 'custom',
// 		'menu-item-title'       => 'asdf',
// 		'menu-item-url'         => '?asdf=sdf',
// 		'menu-item-description' => 'asdf',
// 		'menu-item-attr-title'  => 'qwerty',
// 		'menu-item-target'      => 'sf',
// 		'menu-item-classes'     => 'new',
// 		'menu-item-xfn'         => '',
// 		'menu-item-status'      => '',
// 		] );


function f_search_header(&$pagination, &$years)
{ ?>
	<div class="f-search-header bg-dark color-aqua clearfix">
	   <nav class="f-pagination f-float-l">
	   		<?= $pagination['html']; ?>
	   </nav>
	   <div class="f-sort-by">
	      	sortieren nach:
			<?= get_gp_sort_select(); ?>
			<?= get_gp_year_select($years); ?>
	   </div>
	</div><!-- .f-search-header -->
<?php }


function gp_genres_list(&$genres_list)
{
	echo '<ul class="gp-genres-list">';
	foreach ($genres_list as $genre) {
		echo '<li class="col-xs-12 col-sm-4 col-md-3"><a href="?genre='.$genre['value'].'">'.$genre['value'].'</a></li>';
	}
	echo '</ul>';
}


function iz_mobile()
{
	foreach (['iPhone', 'Android', 'webOS', 'BlackBerry', 'iPod', 'Nokia'] as $os) {
	  if (strpos($_SERVER['HTTP_USER_AGENT'], $os) !== false) {
	    return true;
	  }
	}
	return false;
}

function get_current_url()
{
	return $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
}

function game_page_rel_canonical()
{
	echo '<link rel="canonical" href="' . get_current_url() . '" />'.PHP_EOL;
}

// if( is_page( 'game' ) ){
// 	remove_action( 'wp_head', 'rel_canonical');
// 	add_action( 'wp_head', 'game_page_rel_canonical');
// 	console_log('is_page( game )');
// }else{

// 	console_log('NOT is_page( game )');
// }
// 	remove_action( 'wp_loaded', 'rel_canonical',15);
// 	add_action( 'wp_head', 'game_page_rel_canonical');