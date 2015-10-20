<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

		</div><!-- #main -->
			
		<footer id="colophon" class="site-footer" role="contentinfo">
				
				<div class="site-info">
				
				<?php //do_action( 'twentythirteen_credits' ); ?>
				<div id="logo">
				<?php logo_slider();?>
				</div>
			<ul id="types">
			<li> Home </li>
			<li> About Us </li>
			<li> Contact Us </li>
			<li> FAQ </li>
			<li> PrivacyPolicy </li>
			</ul>
			</div><!-- .site-info -->
		</footer><!-- #colophon -->
	</div><!-- #page -->

	<?php wp_footer(); ?>
</body>
</html>