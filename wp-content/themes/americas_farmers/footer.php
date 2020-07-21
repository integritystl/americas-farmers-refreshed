<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package americas_farmers
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">

		<div class="footer-main">
			<div class="social-container">
				<?php
					$footerLogo = get_field('logo_image', 'option');
				?>
				<img class="logo" src="<?php echo $footerLogo ?>">
				<ul class="social-links">
					<li>
						<a href="<?php the_field('facebook_link', 'option')?>" target="_blank" class="social_facebook" aria-label="America's Farmers Facebook" rel="noopener"><i class="fab fa-facebook-f"></i></i></a>
					</li>
					<li>
						<a href="<?php the_field('twitter_link', 'option')?>" target="_blank" class="social_twitter"  aria-label="America's Farmers Twitter" rel="noopener"><i class="fab fa-twitter"></i></a>
					</li>
					<li>
						<a href="<?php the_field('instagram_link', 'option')?>" target="_blank" class="social_instagram"  aria-label="America's Farmers Instagram" rel="noopener"><i class="fab fa-instagram"></i></i></a>
					</li>
					<li>
						<a href="<?php the_field('youtube_link', 'option')?>" target="_blank" class="social_youtube"  aria-label="America's Farmers YouTube" rel="noopener"><i class="fab fa-youtube"></i></a>
					</li>
				</ul>
			</div>
			<div class="quick-links">
				<h5>Quick Links</h5>
				<?php
					wp_nav_menu( array(
						'theme_location' => 'footer-menu',
						'menu_id'        => 'footer-menu',
					) );
				?>
			</div>
			<div class="form-container">
			<!-- <p>Sign up to stay informed about our programs.</p> -->
				<div class="footer-newsletter">
						<?php echo do_shortcode(get_field('footer_newsletter', 'option')); ?>
				</div>

				<?php $textOptIn = get_field('text_opt_in', 'option'); ?>
				<?php if ($textOptIn) :?>
					<p><?php echo $textOptIn; ?></p>
				<?php endif ;?>
			</div>
		</div>
		<div class="footer-utility">
			<div class="container">
				<?php
						wp_nav_menu( array(
							'theme_location' => 'footer-utility-menu',
							'menu_id'        => 'footer-utility-menu',
						) );
				?>
				<div class="footer-copyright">
					<p><span>&copy;2002 - <?php echo date("Y"); ?></span> <?php the_field('footer_copyright', 'option'); ?></p>
				</div>
			</div>
		</div>

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php
	//Partial for Search Modal
	get_template_part('template-parts/modal', 'search');
wp_footer(); ?>

</body>
</html>
