<?php
/**
 * Template Name: Filter
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
?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="<?= $template_directory_uri; ?>/css/ebay-filter.css">


<div class="gig-filter" id="filter_app_here"></div>


<script>
var $ = jQuery;
var scriptURL = '<?= $template_directory_uri; ?>/js/';

for(var crs="src",
  load_scr=[
    scriptURL+'bootstrap-multiselect.js',
    scriptURL+'bootstrap.min.js',
    scriptURL+'react.min.js',
    scriptURL+'react-dom.min.js',
    scriptURL+'babel.min.js',
    scriptURL+'ebay-filter.js?v=1.25']
   ,i=0;i<=load_scr.length-1;i++){
   		if(i === load_scr.length-1)document.write("<script type='text/babel' "+crs+"="+load_scr[i]+">\x3c/script>");
   		else document.write("<script type='text/javascript' "+crs+"="+load_scr[i]+">\x3c/script>");
	}
</script>



<?php get_footer(); ?>
