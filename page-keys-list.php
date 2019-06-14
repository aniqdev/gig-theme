<?php
/**
 * Template Name: Keys list
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



$home_url = get_home_url();
$template_directory_uri = get_template_directory_uri();

$time = time()+(2*60*60); // + 2часа
$keys = $wpdb2->get_results("SELECT * FROM gift_keys WHERE public_date < $time ORDER BY public_date DESC LIMIT 200", ARRAY_A);
?>

<div class="container">
  <?php foreach ($keys as $key_row): ?>
  <div class="row">
    <div class="col-xs-4"><?= $key_row['key']; ?></div>
    <div class="col-xs-5" title="<?= $key_row['public_date']; ?>"><?= date('Y-m-d H:i', (string)$key_row['public_date']); ?></div>
  </div>
  <?php endforeach; ?>
</div>

<div id="primary" class="content-area content-area-w100p container-fluid">
  <main id="main" class="site-main gig-page-filter" role="main">
    <?php
    // Start the loop.
    while ( have_posts() ) : the_post();

      // Include the page content template.
      get_template_part( 'template-parts/content', 'no-title' );

      // End of the loop.
    endwhile;
    ?>
    <div class="clearfix"></div>
  </main><!-- .site-main -->

  <?php //get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->


<?php get_footer(); ?>
