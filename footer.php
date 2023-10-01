<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package JE-MA
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="footer-menus">
				<nav class="footer-navigation">
					<?php wp_nav_menu( array('theme_location' => 'footer')); ?>
				</nav>
		</div><!-- .footer-menus -->
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'je-ma' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'je-ma' ), 'WordPress' );
				?>
			</a>
			<span class="sep"> | </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'je-ma' ), 'je-ma', '<a href="https://tinyurl.com/sorryjonathon">Mohamed Ahmed and Josh Esteban</a>' );
				?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
