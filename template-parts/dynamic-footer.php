<?php
/**
 * The template for displaying footer.
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$is_editor = isset( $_GET['elementor-preview'] );
$site_name = get_bloginfo( 'name' );
$tagline   = get_bloginfo( 'description', 'display' );
$footer_class = did_action( 'elementor/loaded' ) ? hello_get_footer_layout_class() : '';
$footer_nav_menu = wp_nav_menu( [
	'theme_location' => 'menu-2',
	'fallback_cb' => false,
	'container' => false,
	'echo' => false,
] );
?>
<footer class="pageWidth">
	<span class="goToTop">
	<svg xmlns="http://www.w3.org/2000/svg" width="23" height="12" viewBox="0 0 23 12" fill="none">
  		<path d="M0.5 11.1502C0.5 11.3241 0.573847 11.5022 0.717198 11.6357C1.0039 11.9027 1.47305 11.9027 1.75975 11.6357L11.5728 2.49666L21.2424 11.5022C21.5291 11.7692 21.9983 11.7692 22.285 11.5022C22.5717 11.2352 22.5717 10.7982 22.285 10.5312L12.094 1.03619C11.8073 0.769185 11.3382 0.769185 11.0515 1.03619L0.717198 10.6607C0.569503 10.7982 0.5 10.9722 0.5 11.1502Z" fill="black"/>
	</svg>
	</span>
	<div class="innerFooter">
		<div class="newsletter">
			<p>
			Subscribe to our Newsletter and save 10% on services
			</p>
			<div class="newsletterForm"> </div>
		</div>
		<div class="logoAndMenu">
			<?php the_custom_logo(); ?>
			<nav class="site-navigation <?php echo esc_attr( hello_show_or_hide( 'hello_footer_menu_display' ) ); ?>" aria-label="<?php echo esc_attr__( 'Footer menu', 'hello-elementor' ); ?>">
				<?php
				// PHPCS - escaped by WordPress with "wp_nav_menu"
				echo $footer_nav_menu; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				?>
			</nav>
		</div>
		<div class="rightSocialNetworksTerms">
			<p>© 2024 Tsybit.</p>
			<ul class="socNetworks">
				<li></li>
				<li></li>
				<li></li>
				<li></li>
			</ul>
			<ul class="Terms">
				<li></li>
				<li></li>
				<li></li>
			</ul>
		</div>
	</div>
</footer>

<script>
document.querySelector('.goToTop').addEventListener('click', function() {
  window.scrollTo({
    top: 0,
    behavior: 'smooth'
  });
});
</script>
<!-- <footer id="site-footer" class="site-footer dynamic-footer <?php echo esc_attr( $footer_class ); ?>">
	<div class="footer-inner">
		<div class="site-branding show-<?php echo esc_attr( hello_elementor_get_setting( 'hello_footer_logo_type' ) ); ?>">
			<?php if ( has_custom_logo() && ( 'title' !== hello_elementor_get_setting( 'hello_footer_logo_type' ) || $is_editor ) ) : ?>
				<div class="site-logo <?php echo esc_attr( hello_show_or_hide( 'hello_footer_logo_display' ) ); ?>">
					<?php the_custom_logo(); ?>
				</div>
			<?php endif;

			if ( $site_name && ( 'logo' !== hello_elementor_get_setting( 'hello_footer_logo_type' ) ) || $is_editor ) : ?>
				<div class="site-title <?php echo esc_attr( hello_show_or_hide( 'hello_footer_logo_display' ) ); ?>">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr__( 'Home', 'hello-elementor' ); ?>" rel="home">
						<?php echo esc_html( $site_name ); ?>
					</a>
				</div>
			<?php endif;

			if ( $tagline || $is_editor ) : ?>
				<p class="site-description <?php echo esc_attr( hello_show_or_hide( 'hello_footer_tagline_display' ) ); ?>">
					<?php echo esc_html( $tagline ); ?>
				</p>
			<?php endif; ?>
		</div>

		<?php if ( $footer_nav_menu ) : ?>
			<nav class="site-navigation <?php echo esc_attr( hello_show_or_hide( 'hello_footer_menu_display' ) ); ?>" aria-label="<?php echo esc_attr__( 'Footer menu', 'hello-elementor' ); ?>">
				<?php
				// PHPCS - escaped by WordPress with "wp_nav_menu"
				echo $footer_nav_menu; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				?>
			</nav>
		<?php endif; ?>

		<?php if ( '' !== hello_elementor_get_setting( 'hello_footer_copyright_text' ) || $is_editor ) : ?>
			<div class="copyright <?php echo esc_attr( hello_show_or_hide( 'hello_footer_copyright_display' ) ); ?>">
				<p><?php echo wp_kses_post( hello_elementor_get_setting( 'hello_footer_copyright_text' ) ); ?></p>
			</div>
		<?php endif; ?>
	</div>
</footer> -->
