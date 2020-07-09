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

if(!defined('HOME_URL')) define('HOME_URL', home_url());
define('GIG_TEMPLATE_DIRECTORY', get_template_directory()); // 'F:\xampp\htdocs\namenav\www\gigshop/wp-content/themes/gig-theme'
define('GIG_TEMPLATE_DIRECTORY_URI', get_template_directory_uri()); // '/wp-content/themes/gig-theme'
define('GIG_THEME_URI', get_stylesheet_directory_uri()); // '/wp-content/themes/gig-theme'

function get_gig_lang()
{
	// return @$_GET['lang'] ? $_GET['lang'] : 'de' // depricated

	$lang = preg_replace('/.*\/(..)\/.+/', "$1", $_SERVER['REQUEST_URI']);

	if (in_array($lang, ['de','en','fr','es','it','ru'])) {
		return $lang;
	}else{
		return 'de';
	}
}
define('GIG_LANG', get_gig_lang());
define('GIG_LANG_PREFIX', GIG_LANG !== 'de' ? '-' . GIG_LANG : '');


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
function twentysixteen_scripts() {
			// Load the stylesheets
		if ( is_eve_page() ) {
			// wp_enqueue_style( 'eve-bootstrap', GIG_THEME_URI . '/stylesheets/bootstrap.css' );
			// wp_enqueue_style( 'eve-owl', GIG_THEME_URI . '/stylesheets/owl.carousel.min.css' );
			wp_enqueue_style( 'eve-custom', GIG_THEME_URI . '/stylesheets/eve.css' );

			wp_enqueue_script( 'jarallax', GIG_THEME_URI . '/javascripts/jarallax.min.js', array(), false, true );
			wp_enqueue_script( 'jarallax-video', GIG_THEME_URI . '/javascripts/jarallax-video.min.js', array(), false, true );
			wp_enqueue_script( 'eve-js', GIG_THEME_URI . '/javascripts/eve.js', array('jquery'), false, true );

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

			wp_enqueue_script( 'owl', GIG_THEME_URI . '/javascripts/owl.carousel.min.js', array('jquery'), false, true );
			return;
		}
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'twentysixteen-fonts', twentysixteen_fonts_url(), array(), null );

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.4.1' );

	// Theme stylesheet.
	wp_enqueue_style( 'twentysixteen-style', GIG_THEME_URI.'/style.css', [], filemtime(__DIR__.'/style.css') );

	// Theme block stylesheet.
	wp_enqueue_style( 'twentysixteen-block-style', GIG_THEME_URI . '/css/blocks.css', array( 'twentysixteen-style' ), '20181018' );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'twentysixteen-ie', GIG_THEME_URI . '/css/ie.css', array( 'twentysixteen-style' ), '20160816' );
	wp_style_add_data( 'twentysixteen-ie', 'conditional', 'lt IE 10' );

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'twentysixteen-ie8', GIG_THEME_URI . '/css/ie8.css', array( 'twentysixteen-style' ), '20160816' );
	wp_style_add_data( 'twentysixteen-ie8', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'twentysixteen-ie7', GIG_THEME_URI . '/css/ie7.css', array( 'twentysixteen-style' ), '20160816' );
	wp_style_add_data( 'twentysixteen-ie7', 'conditional', 'lt IE 8' );

	// Load the html5 shiv.
	wp_enqueue_script( 'twentysixteen-html5', GIG_THEME_URI . '/js/html5.js', array(), '3.7.3' );
	wp_script_add_data( 'twentysixteen-html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'twentysixteen-skip-link-focus-fix', GIG_THEME_URI . '/js/skip-link-focus-fix.js', array(), '20160816', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'twentysixteen-keyboard-image-navigation', GIG_THEME_URI . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20160816' );
	}

	wp_enqueue_script( 'twentysixteen-script', GIG_THEME_URI . '/js/functions.js', array( 'jquery' ), '20160816', true );

	wp_localize_script( 'twentysixteen-script', 'screenReaderText', array(
		'expand'   => __( 'expand child menu', 'twentysixteen' ),
		'collapse' => __( 'collapse child menu', 'twentysixteen' ),
	) );
	
    wp_enqueue_style( 'dashicons' );

	if(is_front_page()) {
		wp_enqueue_script( 'tween-light', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.2/TweenLite.min.js', [], false, true );
		wp_enqueue_script( 'ease-pack', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.2/easing/EasePack.min.js', [], false, true );
		wp_enqueue_script( 'canvas-experiment', GIG_THEME_URI . '/js/canvas-experiment.js', [], false, true );
	}

	if(is_page_game()){
		wp_enqueue_script( 'flexslider', GIG_THEME_URI . '/js/jquery.flexslider.js', [], '2.7.0', true );
		wp_enqueue_style( 'flexslider', GIG_THEME_URI . '/css/flexslider.css', [], '2.7.0' );
	}

	if(!is_admin()) {
		wp_enqueue_script("jquery-ui-autocomplete", ['jquery']);
		wp_enqueue_script("jquery-ui-slider", ['jquery']);
		wp_enqueue_script( 'aqs-slider', GIG_THEME_URI . '/js/aqs-slider.js?t='.filemtime (__DIR__.'/js/aqs-slider.js'), [], '1.1.1', true );
		wp_enqueue_script( 'lazysizes', GIG_THEME_URI . '/js/lazysizes.min.js', [], '4.1.7', true );
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

				<div id="gig_eve_share" class="code_alt" code_share="&lt;script type=&quot;text/javascript&quot;&gt;(function(w,doc) {
                        if (!w.__utlWdgt ) {
                            w.__utlWdgt = true;
                            var d = doc, s = d.createElement('script'), g = 'getElementsByTagName';
                            s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
                            s.src = ('https:' == w.location.protocol ? 'https' : 'http')  + '://w.uptolike.com/widgets/v1/uptolike.js';
                            var h=d[g]('body')[0];
                            h.appendChild(s);
                        }})(window,document);
                    &lt;/script&gt;
                    &lt;div data-background-alpha=&quot;0.0&quot; 
                    data-buttons-color=&quot;#FFFFFF&quot; 
                    data-counter-background-color=&quot;#ffffff&quot; 
                    data-share-counter-size=&quot;12&quot; 
                    data-top-button=&quot;false&quot; 
                    data-share-counter-type=&quot;separate&quot; 
                    data-share-style=&quot;1&quot; data-mode=&quot;share&quot; 
                    data-like-text-enable=&quot;false&quot; 
                    data-mobile-view=&quot;false&quot; 
                    data-icon-color=&quot;#ffffff&quot; 
                    data-orientation=&quot;horizontal&quot; 
                    data-text-color=&quot;#ffffff&quot; 
                    data-share-shape=&quot;round-rectangle&quot; 
                    data-sn-ids=&quot;fb.gp.&quot; 
                    data-share-size=&quot;30&quot; 
                    data-background-color=&quot;#ffffff&quot; 
                    data-preview-mobile=&quot;false&quot; 
                    data-mobile-sn-ids=&quot;fb.gp.&quot; 
                    data-pid=&quot;1683037&quot; 
                    data-counter-background-alpha=&quot;0.0&quot; 
                    data-following-enable=&quot;false&quot; 
                    data-exclude-show-more=&quot;true&quot; 
                    data-selection-enable=&quot;false&quot; 
                    class=&quot;uptolike-buttons&quot; &gt;&lt;/div&gt;" code_alt="&lt;span class=&quot;switch&quot;&gt;mit Facebook verbunden&lt;/span&gt;">
					loading...
				</div>
				<style>
/* Switch begin */
#gig_eve_share{
	height: 80px;
	overflow: hidden;
}
#gig_eve_share.code_alt{
	background: url('<?php echo get_template_directory_uri(); ?>/images/fbs.png') -10px 21px no-repeat;
}
span.switch {
    display: inline-block;
    text-indent: -9999em;
    background: transparent url('<?php echo get_template_directory_uri(); ?>/images/ssp_sprite.png') no-repeat -70px -40px scroll;
    width: 23px;
    height: 12px;
    overflow: hidden;
    float: left;
    margin: 4px 0 0;
    padding: 0;
    cursor: pointer;
}
span.switch.on {
    background-position: -70px -52px; 
}
/* Switch end */
				</style>
				<script>
(function($) {
	var facebook_elem = document.getElementsByClassName('utl-icon-num-0');
	function share_btns_change_title() {
		if(!document.getElementsByClassName('utl-icon-num-0').length) return;
		facebook_elem[0] && (facebook_elem[0].title = 'Share on Facebook');
	}

	var gig_eve_share = $('#gig_eve_share');
	var code_share = $(gig_eve_share.attr('code_share'));
	var code_alt   = $(gig_eve_share.attr('code_alt'));
	gig_eve_share.html(code_alt);
	gig_eve_share.on('click', '.switch', function () {
		setInterval(share_btns_change_title, 2000);
		if ($(this).hasClass('on')) {
			gig_eve_share.html(code_alt);
			gig_eve_share.addClass('code_alt');
		}else{
			gig_eve_share.append(code_share);
			gig_eve_share.removeClass('code_alt');
		}
		$(this).toggleClass('on');
	});
})(jQuery);
				</script>
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
	// foreach ($variations as $key => $value) sa($value);
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
					<div class="product__add disp-conts">
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
		'home_url' => home_url(),
		'gig_lang_prefix' => GIG_LANG_PREFIX,
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

function get_hours_dif()
{
	$wpdb2 = new wpdb( db_USER, db_PASS, db_NAME, db_HOST );

	$time = time();
	$dif = 0;
	$public_date = $wpdb2->get_results( "SELECT public_date FROM gift_keys WHERE public_date > $time ORDER BY id ASC LIMIT 1", ARRAY_A );
	$time += (2*60*60);
	if ($public_date) {
		$public_date = $public_date[0]['public_date'];
		$dif = floor((($public_date - $time) + (3*60*60)) / (60*60));
		$dif = $dif % 3;
	}else{
		$dif = 'no-next-key';
	}
	return $dif;
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
				'href' => get_gig_game_link(gig_home_url(), $el),
			];
		}, $games),
	]);
	wp_die();
}
add_action('wp_ajax_aqs_search', 'aqs_ajax_search');


function register_footer_widgets(){
	register_sidebar( array(
		'name' => 'Footer widgets',
		'id' => 'footer-widgets',
		'description' => 'Footer bottom widget panel',
		'class'         => 'gig-footer-widgets',
		'before_widget' => '<li class="footer-widget-block col-xs-12 col-sm-5">',
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
function xa($array = [], $save = false){
	if ($save) return '<pre>' . print_r($array, true) . '</pre>';
	echo "<pre>";
	var_export($array);
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
		return '<a href="'.gig_home_url().'/gig-games-filter'.GIG_LANG_PREFIX.'/?spec='.$el.'">'.$el.'</a>';
	}, explode(',', $game['specs'])));

	$game['tags_links'] = implode(', ', array_map(function($el){
		return '<a href="'.gig_home_url().'/gig-games-filter'.GIG_LANG_PREFIX.'/?tag='.$el.'">'.$el.'</a>';
	}, explode(',', $game['tags'])));

	$game['genres_links'] = implode(', ', array_map(function($el){
		return '<a href="'.gig_home_url().'/gig-games-filter'.GIG_LANG_PREFIX.'/?genre='.$el.'">'.$el.'</a>';
	}, explode(',', $game['genres'])));
	
	$game['lang_links'] = implode(', ', array_map(function($el){
		return '<a href="'.gig_home_url().'/gig-games-filter'.GIG_LANG_PREFIX.'/?lang='.$el.'">'.$el.'</a>';
	}, explode(',', $game['lang'])));
	
	$game['os_links'] = implode(', ', array_map(function($el){
		return '<a href="'.gig_home_url().'/gig-games-filter'.GIG_LANG_PREFIX.'/?os='.$el.'">'.$el.'</a>';
	}, explode(',', $game['os'])));

	$game['year_link'] = '<a href="'.gig_home_url().'/gig-games-filter'.GIG_LANG_PREFIX.'/?release='.$game['year'].'">'.$game['year'].'</a>';

	$game['developer_link'] = '<a href="'.gig_home_url().'/gig-games-filter'.GIG_LANG_PREFIX.'/?developer='.urlencode($game['developer']).'">'.$game['developer'].'</a>';

	$game['publisher_link'] = '<a href="'.gig_home_url().'/gig-games-filter'.GIG_LANG_PREFIX.'/?publisher='.urlencode($game['publisher']).'">'.$game['publisher'].'</a>';

	return $game;
}


function gp_insert_Links($game)
{
	return gig_insert_Links($game);
}


function console_log($text='', $print = true)
{
    // if(!defined('DEV_MODE')) return '';

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
	if(false && $res){ // off
		$ret['price'] = '<s>€'.str_replace('.', ',', $steam_game['reg_price']).'</s>'
		.'<br>€'.str_replace('.', ',', $res['price']);
		$ret['link'] = get_partner_link('https://www.ebay.de/itm/'.$res['item_id']);
		$ret['isset_our_price'] = true;
	}else{
		$ret['price'] = '€'.str_replace('.', ',', $steam_game['reg_price']);
		if ($steam_game['reg_price'] == -1) {
			$ret['price'] = '<span title="unbekannt" class="dashicons dashicons-lock" style="font-size: 50px;"></span>';
		}
		$ret['link'] = 'https://rover.ebay.com/rover/1/707-53477-19255-0/1?icep_id=114&ipn=icep&toolid=20004&campid=5338465470&mpre=https%3A%2F%2Fwww.ebay.de%2Fsch%2FPC-Videospiele%2F1249%2Fi.html%3F_from%3DR40%26_nkw%3D'.rawurlencode(rawurlencode($steam_game['title'])).'%26_dcat%3D1249%26Plattform%3DPC%26rt%3Dnc%26_trksid%3Dp2045573.m1684';
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
	return $home_url.'/game'.GIG_LANG_PREFIX.'/?type='.$steam_game['type'].'&appid='.steam_to_gig($steam_game['appid']).'&title='.get_gig_game_url_title($steam_game['title']);
}

function get_img_alt(&$game)
{
	return htmlspecialchars($game['title']).' cd steam key günstig';
}

function get_gig_game_meta_desc(&$game)
{
	$limit = (150-(strlen($game['title']) + 29));

	if($limit < 5) $limit = 0;

	$description = str_replace('<h2>Über dieses Spiel</h2>', '', $game['desc']);

	$description = trim(strip_tags($description));

	$description = substr(' '.$description, 0, $limit);

	$meta_description = '<meta name="description" content="Günstige Preise für '.$game['title'].' finden.'.$description.'...">';
	// 'Название игры + preisvergleich pc spiel + computerspiel + steam + текст из описания''

	return $meta_description;
}

function get_gig_game_meta_keywords(&$game)
{
	return '<meta name="keywords" content="'.$game['title'].', steam, pc spiele, computerspiele, günstig, billig, vergleich, preisvergleich, cd key, code">';
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
			$atts = 'style="display:block;height:300px;"
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
			     data-ad-client="ca-pub-4009372254971170" 
			     '.$atts.'></ins>
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
	      	<span class="f-sort-by-words">sortieren nach:</span>
			<?= get_gp_sort_select(); ?>
			<?= get_gp_year_select($years); ?>
	   </div>
	</div><!-- .f-search-header -->
<?php }


function gp_genres_list(&$genres_list)
{
	echo '<ul class="gp-genres-list">';
	foreach ($genres_list as $genre) {
		echo '<li class="col-xs-12 col-sm-4 col-md-3"><a class="eclips" title="'.esc_attr($genre['value']).'" href="?genre='.$genre['value'].'">'.$genre['value'].'</a></li>';
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

function get_gig_title($steam_game)
{
	$game_name = htmlentities($steam_game['title']);
	if ($steam_game['genres']) {
		$genre = htmlentities(explode(',', $steam_game['genres'])[0]);
	}else{
		$genre = '';
	}
	return substr("$game_name | $genre | günstig PC-Spiele Vergleich", 0, 70);
}

function get_gig_game_json_ld(&$game)
{
	$images = get_gig_game_img_urls($game);
	$desc = htmlentities(strip_tags($game['desc']));
	$pos = strpos($desc, 'eses Produkt');
	if(!$pos) $pos = strpos($desc, 'dieses Spiel');
	if($pos) $desc = trim(substr($desc, $pos + 12));
	if (($game['o_reviews'])) {
		$agreg_rat = '"aggregateRating": {
			"@type" : "AggregateRating",
			"ratingValue" : "'.$game['o_rating'].'",
			"reviewCount" : "'.$game['o_reviews'].'",
			"worstRating" : "0",
			"bestRating" : "100"
		},';
	}else{
		$agreg_rat = '"aggregateRating": {
			"@type" : "AggregateRating",
			"ratingValue" : "'.$game['o_rating'].'",
			"worstRating" : "0",
			"bestRating" : "100"
		},';
	}
return '
<script type="application/ld+json">
{
	"@context" : "http://schema.org",
	"@type" : "Product",
	"name" : "'.htmlentities($game['title']).'",
	"image" : [
		"'.$images['img_header'].'",
		"'.$images['img_big1'].'",
		"'.$images['img_big2'].'",
		"'.$images['img_big3'].'",
		"'.$images['img_big4'].'"
	],
	"description" : "'.$desc.'",
	"brand" : {
		"@type" : "Brand",
		"name" : "'.htmlentities($game['developer']).'"
	},
	"sku" : "'.$game['id'].'",
	'.$agreg_rat.'
	"offers" : {
		"@type" : "Offer",
	    "price": "'.$game['reg_price'].'",
	    "priceCurrency": "EUR",
    	"availability": "https://schema.org/InStock",
		"url" : "'.get_gig_game_link(gig_home_url(), $game).'",
	    "seller": {
	      "@type": "Organization",
	      "name": "'.htmlentities($game['publisher']).'"
	    }
	}
}
</script>';
}


function get_gig_game_BreadcrumbList_json_ld(&$game)
{
	$genre = urlencode(explode(',', $game['genres'])[0]);
	return '
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [{
    "@type": "ListItem",
    "position": 1,
    "name": "Genres",
    "item": "https://gig-games.de/genres/"
  },{
    "@type": "ListItem",
    "position": 2,
    "name": "'.$genre.'",
    "item": "https://gig-games.de/genres/?genre='.$genre.'"
  },{
    "@type": "ListItem",
    "position": 3,
    "name": "Ann Leckie",
    "item": "'.get_gig_game_link(gig_home_url(), $game).'"
  }]
}
</script>';
}

function get_gig_game_Logo_json_ld()
{
	return '
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "url": "https://gig-games.de",
  "logo": "https://gig-games.de/images/gig-games-logo.jpg"
}
</script>';
}

function get_gig_game_Social_json_ld()
{
	return '
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Person",
  "name": "gig-games",
  "url": "https://gig-games.de",
  "sameAs": [
    "https://www.facebook.com/giggamessupport/"
  ]
}
</script>';
}


function get_gig_game_img_urls(&$game)
{
	
	$type  = ($game['type'] === 'dlc') ? 'app' : $game['type'];

	$pics_arr = explode(',', $game['pics']);

	$img_dir_path = '//parser.gig-games.de/steam-images/'.$type.'s-'.$game['appid'];

	return[
		'img_header'   => (in_array('header-80p.jpg', $pics_arr)) ? $img_dir_path.'/header-80p.jpg' : '',
		'img_header_s' => (in_array('header-210x98.jpg', $pics_arr)) ? $img_dir_path.'/header-210x98.jpg' : '',

		'img_small1' => (in_array('thumb-1-s.jpg', $pics_arr)) ? $img_dir_path.'/thumb-1-s.jpg' : '',
		'img_small2' => (in_array('thumb-2-s.jpg', $pics_arr)) ? $img_dir_path.'/thumb-2-s.jpg' : '',
		'img_small3' => (in_array('thumb-3-s.jpg', $pics_arr)) ? $img_dir_path.'/thumb-3-s.jpg' : '',
		'img_small4' => (in_array('thumb-4-s.jpg', $pics_arr)) ? $img_dir_path.'/thumb-4-s.jpg' : '',

		'img_big1' => (in_array('thumb-1-m.jpg', $pics_arr)) ? $img_dir_path.'/thumb-1-m.jpg' : '',
		'img_big2' => (in_array('thumb-2-m.jpg', $pics_arr)) ? $img_dir_path.'/thumb-2-m.jpg' : '',
		'img_big3' => (in_array('thumb-3-m.jpg', $pics_arr)) ? $img_dir_path.'/thumb-3-m.jpg' : '',
		'img_big4' => (in_array('thumb-4-m.jpg', $pics_arr)) ? $img_dir_path.'/thumb-4-m.jpg' : '',
	];
}


function print_stars(&$game)
{
	if(!$game['o_reviews']) return '&nbsp;';
	?>
	<span class="tP9Zud"> 
		<span aria-hidden="true"><?= $game['o_rating']; ?>&nbsp;%</span> 
		<div class="Hk2yDb KsR1A" aria-label="Рейтинг: 4.5 из 5" role="img">
			<span style="width:<?= $game['o_rating']; ?>%"></span>
		</div> 
		<span>(<?= $game['o_reviews']; ?>)</span> 
	</span>
<?php
}


function get_gig_open_graph(&$game, $url, $desc)
{
	$description = str_replace('<h2>Über dieses Spiel</h2>', '', $game['desc']);
	$description = trim(strip_tags($description));
	$description = substr($description, 0, 250);

	$images = get_gig_game_img_urls($game);
	$image = 'http:'.str_replace('-80p', '', $images['img_header']);

	// <meta property="fb:app_id"             content="1234567890" />
	return '
	<meta property="og:url"                content="'.$url.'" />
	<meta property="og:type"               content="website" />
	<meta property="og:title"              content="'.esc_attr($game['title']).'" />
	<meta property="og:description"        content="'.esc_attr($description).'" />
	<meta property="og:image"              content="'.$image.'" />
	<meta property="og:image:width"        content="460" />
	<meta property="og:image:height"       content="215" />';
 
}

function is_page_game()
{
	if(is_page('game')) return true;
	if(is_page('game-de')) return true;
	if(is_page('game-ru')) return true;
	if(is_page('game-en')) return true;
	return false;
}


function langs_cork()
{
	return '<li class="lang-item lang-item-59 lang-item-de lang-item-first current-lang"><a lang="de-DE" hreflang="de-DE" href="https://gig-games.de/cart/"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAALCAIAAAD5gJpuAAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAGzSURBVHjaYvTxcWb4+53h3z8GZpZff/79+v3n/7/fDAz/GHAAgABi+f37e3FxOZD1Dwz+/v3z9y+E/AMFv3//+Qumfv9et241QACxMDExAVWfOHkJJAEW/gUEP0EQDn78+AHE/gFOQJUAAcQiy8Ag8O+fLFj1n1+/QDp+/gQioK7fP378+vkDqOH39x9A/RJ/gE5lAAhAYhzcAACCQBDkgRXRjP034R0IaDTZTFZn0DItot37S94KLOINerEcI7aKHAHE8v/3r/9//zIA1f36/R+o4tevf1ANYNVA9P07RD9IJQMDQACxADHD3z8Ig4GMHz+AqqHagKp//fwLVA0U//v7LwMDQACx/LZiYFD7/5/53/+///79BqK/EMZ/UPACSYa/v/8DyX9A0oTxx2EGgABi+a/H8F/m339BoCoQ+g8kgRaCQvgPJJiBYmAuw39hxn+uDAABxMLwi+E/0PusRkwMvxhBGoDkH4b/v/+D2EDyz///QB1/QLb8+sP0lQEggFh+vGXYM2/SP6A2Zoaf30Ex/J+PgekHwz9gQDAz/P0FYrAyMfz7wcDAzPDtFwNAgAEAd3SIyRitX1gAAAAASUVORK5CYII=" title="Deutsch" alt="Deutsch" width="16" height="11"></a></li>
	<li class="lang-item lang-item-63 lang-item-ru no-translation"><a lang="ru-RU" hreflang="ru-RU" href="https://gig-games.de/ru/main-2019-ru/"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAALCAIAAAD5gJpuAAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAE2SURBVHjaYvz69T8DAvz79w9CQVj/0MCffwwAAcQClObiAin6/x+okxHMgPCAbOb//5n+I4EXL74ABBALxGSwagTjPzbAyMgItAQggBg9Pf9nZPx//x7kjL9////9C2QAyf9//qCQQCQkxFhY+BEggFi2b/+nq8v46BEDSPQ3w+8//3//BqFfv9BJeXmQEwACCOSkP38YgHy4Bog0RN0vIOMXVOTPH6Cv/gEEEEgDxFKgHEgDXCmGDUAE1AAQQCybGZg1f/d8//XsH0jTn3+///z79RtE/v4NZfz68xfI/vOX+4/0ZoZFAAHE4gYMvD+3/v2+h91wCANo9Z+/jH9VxBkYAAKIBRg9TL//MEhKAuWAogxgZzGC2CCfgUggAoYdGAEVAwQQ41egu5AQAyoXTQoIAAIMAD+JZR7YOGEWAAAAAElFTkSuQmCC" title="Русский" alt="Русский" width="16" height="11"></a></li>
	<li class="lang-item lang-item-76 lang-item-en no-translation"><a lang="en-US" hreflang="en-US" href="https://gig-games.de/en/main-2019-en/"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAALCAIAAAD5gJpuAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAflJREFUeNpinDRzn5qN3uFDt16+YWBg+Pv339+KGN0rbVP+//2rW5tf0Hfy/2+mr99+yKpyOl3Ydt8njEWIn8f9zj639NC7j78eP//8739GVUUhNUNuhl8//ysKeZrJ/v7z10Zb2PTQTIY1XZO2Xmfad+f7XgkXxuUrVB6cjPVXef78JyMjA8PFuwyX7gAZj97+T2e9o3d4BWNp84K1NzubTjAB3fH0+fv6N3qP/ir9bW6ozNQCijB8/8zw/TuQ7r4/ndvN5mZgkpPXiis3Pv34+ZPh5t23//79Rwehof/9/NDEgMrOXHvJcrllgpoRN8PFOwy/fzP8+gUlgZI/f/5xcPj/69e/37//AUX+/mXRkN555gsOG2xt/5hZQMwF4r9///75++f3nz8nr75gSms82jfvQnT6zqvXPjC8e/srJQHo9P9fvwNtAHmG4f8zZ6dDc3bIyM2LTNlsbtfM9OPHH3FhtqUz3eXX9H+cOy9ZMB2o6t/Pn0DHMPz/b+2wXGTvPlPGFxdcD+mZyjP8+8MUE6sa7a/xo6Pykn1s4zdzIZ6///8zMGpKM2pKAB0jqy4UE7/msKat6Jw5mafrsxNtWZ6/fjvNLW29qv25pQd///n+5+/fxDDVbcc//P/zx/36m5Ub9zL8+7t66yEROcHK7q5bldMBAgwADcRBCuVLfoEAAAAASUVORK5CYII=" title="English" alt="English" width="16" height="11"></a></li>';
}


function gig_lang_switcher()
{
	if(defined('DEV_MODE')) return langs_cork();

	if(!function_exists('pll_the_languages')) return '';
	$switcher = pll_the_languages([
		'echo' => 0,
		'show_flags' => 1,
		'show_names' => 0,
		//'display_names_as' => 'slug', // 'name' or 'slug'
	]);

	if ($_SERVER['QUERY_STRING']) {
		$switcher = str_replace('/">', '/?'.$_SERVER['QUERY_STRING'].'">', $switcher);
	}

	return $switcher;
}

function pf_get_steam_table()
{
	return 'steam_' . GIG_LANG;
}



function get_eve_open_graph()
{
	$the_title = trim(get_the_title());
	$url = '';
	$title = '';
	$description = '';
	$image = '';

	if ($the_title === 'ISK') {
		$url = 'https://gig-games.de/shop/mmorpg/eveonline-isk/';
		$title = 'EVE Online Währung ISK günstig kaufen';
		$description = 'ISK ist die virtuelle Währung in Eve Online. Wenn man genügend davon auf seinem Spielkonto hat, kann man das Leben in EVE um einiges leichter machen. Für die meisten wirtschaftlichen Transaktionen braucht man ISK. Sei es Kauf von Schiffen, Waffen, zahlreichen Spielgegenstände oder sogar Charaktere.';
		$image = 'https://gig-games.de/wp-content/uploads/2015/01/isk.png';
	}elseif($the_title === 'PLEX'){
		$url = 'https://gig-games.de/shop/mmorpg/eveonline-plex/';
		$title = 'EVE Online PLEX günstig kaufen, Abonnement verlängern';
		$description = 'Plex – Spielgegenstand, den man für die Abonnementverlängerung (500 für 30 Tage) verwenden kann. Außerdem werden Plexkarten im Spiel gehandelt und können  ca. 2,4 – 2,6 Millionen ISK kosten.';
		$image = 'https://gig-games.de/wp-content/uploads/2017/04/plex-1.png';
	}elseif($the_title === 'Injector'){
		$url = 'https://gig-games.de/shop/mmorpg/eve-online-skill-injector/';
		$title = 'EVE Online Large Skill-Injector günstig kaufen';
		$description = 'Skill Injector, kann man zur Verbesserung eines EVE Online Charakters anwenden. Außerdem werden Skill Injectors im Spiel gehandelt und kosten je Stück ca. 630-650 Millionen ISK.';
		$image = 'https://gig-games.de/wp-content/uploads/2017/04/skill-injector-2.png';
	}

	// console_log('=========');
	// console_log($the_title);
	// console_log('=========');

	// <meta property="fb:app_id"             content="1234567890" />
	return '
	<meta property="og:url"                content="'.$url.'" />
	<meta property="og:type"               content="product" />
	<meta property="og:title"              content="'.esc_attr($title).'" />
	<meta property="og:description"        content="'.esc_attr($description).'" />
	<meta property="og:image"              content="'.$image.'" />
	<meta property="og:image:width"        content="320" />
	<meta property="og:image:height"       content="350" />';
 
}


function is_in_woo($wpdb2, $steam_de_id)
{
	return false; // отключена возможность добавления товара в корзину
	$res = $wpdb2->get_results( "SELECT woo_id FROM games WHERE woo_id <> '' AND steam_link = (select link from steam_de where id = '$steam_de_id' LIMIT 1) LIMIT 1", ARRAY_A );
	// sa($res);
	if (isset($res[0]['woo_id'])) {
		return $res[0]['woo_id'];
	}else{
		return false;
	}
}


// Utility function that check if coupon exist
function does_coupon_exist( $coupon_code ) {
    global $wpdb;

    $value = $wpdb->get_var( "
        SELECT ID
        FROM {$wpdb->prefix}posts
        WHERE post_type = 'shop_coupon'
        AND post_name = '".strtolower($coupon_code)."'
        AND post_status = 'publish';
    ");

    return $value > 0 ? true : false;
}


function coupon_code_generation( $order_id, $coupon_code ){

    // Check that coupon code not exists
    if( ! does_coupon_exist( $coupon_code ) ) {

        if (filter_var(trim($order_id), FILTER_VALIDATE_EMAIL)) {
        	$customer_email = [ trim($order_id) ];
        }else{
	        // Get the instance of the WC_Order object
	        $order = wc_get_order( $order_id );
	        // Customer billing email
        	$customer_email = [ $order->get_billing_email() ]; 
        }

        ## --- Coupon settings --- ##
        $discount_type  = 'percent'; // Type
        $coupon_amount  = '10'; // Amount
        $product_categories_names = [];
        $date_expires = '2019-07-31';

        // Convert to term IDs
        $term_ids = array();
        foreach( $product_categories_names as $term_name ) {
            if ( term_exists( $term_name, 'product_cat' ) )
                $term_ids[] = get_term_by( 'name', $term_name, 'product_cat' )->term_id;
        }

        ## --- Coupon settings --- ##


        // Get a new instance of the WC_Coupon object
        $coupon = new WC_Coupon();
        // Set the necessary coupon data
        $coupon->set_code( $coupon_code );
        $coupon->set_discount_type( $discount_type );
        $coupon->set_amount( $coupon_amount );
        if( is_array($term_ids) && sizeof($term_ids) > 0 )
            $coupon->set_product_categories( $term_ids );
        $coupon->set_email_restrictions( $customer_email );
        $coupon->set_individual_use( true );
        $coupon->set_usage_limit( 1 );
        $coupon->set_usage_limit_per_user( 1 );
        $coupon->set_limit_usage_to_x_items( 1 );
        $coupon->set_date_expires( date( "Y-m-d H:i:s", strtotime($date_expires) ) );

        // Save the data
        $post_id = $coupon->save();
    }
    return isset($post_id) && $post_id > 0;
}


function _esc_attr($str)
{
	 htmlspecialchars($str, ENT_QUOTES);
}


if(1 || defined('DEV_MODE')) {
	add_action('admin_menu', function(){
		add_menu_page( 'Дополнительные настройки сайта', 'Пульт', 'manage_options', 'pult-page', 'init_pult_page', '', 33 );
		add_submenu_page( 'pult-page', 'Email example', 'Email example', 'manage_options', 'email-example-page', 'init_email_example_page' ); 

	});
}

function init_pult_page(){
	include_once GIG_TEMPLATE_DIRECTORY . '/inc/admin-page-pult.php';
}

function init_email_example_page() {
	include_once GIG_TEMPLATE_DIRECTORY . '/inc/admin-page-email-example.php';
}

