<?php
/**
 * Template Name: Eve time
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

?>

    <link rel="stylesheet" href="/eve-css/app.css?t=<?= filemtime('eve-css/app.css') ?>">

  


<div class="container eve-time-wrapper">
	
<!--     <div class="row">
      <div class="large-12 columns">
        <h2 class="text-center" id="userTime"></h2>
	  </div>
		<div class="large-12 columns">
			<h2 class="text-center" id="utcTime"></h2>
		</div>
	</div> -->
	<div class="row">
		<div class="medium-6 large-centered columns">
			<h2 class="text-center">EVE Online time</h2><br>
			<form action="javascript:void(0);" id="inputEveTimeForm" >
				<label class="instructions" style="display: none;">Input EVE time for op (Dec 17,2017 16:00) & hit enter</label>
                <label class="scheduled" id="sharedlink" style="display: none;">Your scheduled op time is:</label>
				<input type="text" placeholder="Dec 17, 2017 16:00" id="inputEveTime" />
			</form>
		</div>
	</div>
	<div class="row">
		<div class="medium-6 large-centered columns">
			<div class="primary callout">
				<h3 id="inputLocalTime" class="text-center"> &nbsp;</h3>
				<p id="localTimeText" class="text-right help-text" style="display: none;">Local time</p>
			</div>
			<div class="secondary callout" id="countdownDiv" style="display: none;">
				<h3 class="text-center" id="timerCountdown"></h3>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="medium-6 large-centered columns" id="shareLinkDiv" style="display:none;">
			<div class="secondary callout">
				<input type="text" id="generatedLink" placeholder="Enter time above to share link with all your weebs." onFocus="this.select()" />
			</div>
			<br><img src="/eve-images/break.png">
		</div>
	</div>

    <div class="row" id="timeTableDiv" style="display:none;">
      <div class="large-centered columns">
		  <table role="grid" summary="A table listing the time in Eve-Online, and your local time." id="dateTimeComparisonTable">
			  <thead>The table below is based on the time when this page was loaded.
			  <tr>
				  <th width="100">+</th>
				  <th width="200">EVE</th>
				  <th width="200">Local</th>
			  </tr>
			  </thead>
			  <tbody id="dateTimeComparisonBody">
			  </tbody>
		  </table>
      </div>
    </div>

    <div class="row">
        <div class="medium-6 large-centered columns">
            <form action="javascript:void(0);" id="inputEveTimeForm" >
                <label class="scheduled" id="sharedlink" style="display: none;">Make your own op-time link: <a href="index.html" color="#FFFFFF">here</a></label>
            </form>
        </div>
    </div>
    <br><br>

    <div class="row">
        <div class="medium-6 large-centered columns">
            Have Fun!
            <br><br><img src="/eve-images/break.png">
        </div>
    </div>


    <div class="row">
        <div class="medium-6 large-centered columns">
            <i>gig-games.de</i>
        </div>

    </div>

</div>  




    <!-- <script src="/eve-js/vendor/jquery.js"></script> -->
    <script src="/eve-js/vendor/what-input.js"></script>
	<script src="/eve-js/vendor/moment.min.js"></script>
	<script src="/eve-js/vendor/countdown.min.js"></script>
	<script src="/eve-js/vendor/moment-countdown.min.js"></script>
    <script src="/eve-js/app.js?t=<?= filemtime('eve-js/app.js') ?>"></script>
	<script>
		// moment().format();
	</script>

<div id="primary" class="content-area content-area-w100p container-fluid">
	<main id="main" class="site-main gig-page-genre" role="main">
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

<?php console_log_filename(__FILE__); ?>
<?php get_footer(); ?>
