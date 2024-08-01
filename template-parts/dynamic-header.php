<?php
/**
 * The template for displaying header.
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! hello_get_header_display() ) {
	return;
}

$is_editor = isset( $_GET['elementor-preview'] );

$site_name = get_bloginfo( 'name' );
$tagline   = get_bloginfo( 'description', 'display' );
$header_class = did_action( 'elementor/loaded' ) ? hello_get_header_layout_class() : '';
$menu_args = [
	'theme_location' => 'menu-1',
	'fallback_cb' => false,
	'container' => false,
	'echo' => false,
];
$header_nav_menu = wp_nav_menu( $menu_args );
$header_mobile_nav_menu = wp_nav_menu( $menu_args ); // The same menu but separate call to avoid duplicate ID attributes.
?>
<header>
	<?php the_custom_logo(); ?>
	<nav class="site-navigation <?php echo esc_attr( hello_show_or_hide( 'hello_header_menu_display' ) ); ?>" aria-label="<?php echo esc_attr__( 'Main menu', 'hello-elementor' ); ?>">
				<?php
				// PHPCS - escaped by WordPress with "wp_nav_menu"
				echo $header_nav_menu; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				?>
			</nav>
	<ul>
		<li>
			<a href="">
				<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
  					<path d="M17.4999 17.5002L13.8808 13.881M13.8808 13.881C14.4998 13.2619 14.9909 12.527 15.3259 11.7181C15.661 10.9093 15.8334 10.0423 15.8334 9.16684C15.8334 8.29134 15.661 7.42441 15.326 6.61555C14.9909 5.80669 14.4998 5.07174 13.8808 4.45267C13.2617 3.8336 12.5267 3.34252 11.7179 3.00748C10.909 2.67244 10.0421 2.5 9.16659 2.5C8.29109 2.5 7.42416 2.67244 6.61531 3.00748C5.80645 3.34252 5.0715 3.8336 4.45243 4.45267C3.20215 5.70295 2.49976 7.39868 2.49976 9.16684C2.49976 10.935 3.20215 12.6307 4.45243 13.881C5.7027 15.1313 7.39844 15.8337 9.16659 15.8337C10.9347 15.8337 12.6305 15.1313 13.8808 13.881Z" stroke="#2C2D2C" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
			</a>
		</li>
	</ul>
</header>
<header id="site-header" class="site-header dynamic-header <?php echo esc_attr( $header_class ); ?>">
	
	<div class="header-inner">
		<div class="site-branding show-<?php echo esc_attr( hello_elementor_get_setting( 'hello_header_logo_type' ) ); ?>">
			<?php if ( has_custom_logo() && ( 'title' !== hello_elementor_get_setting( 'hello_header_logo_type' ) || $is_editor ) ) : ?>
				<div class="site-logo <?php echo esc_attr( hello_show_or_hide( 'hello_header_logo_display' ) ); ?>">
					<?php the_custom_logo(); ?>
				</div>
			<?php endif;

			if ( $site_name && ( 'logo' !== hello_elementor_get_setting( 'hello_header_logo_type' ) || $is_editor ) ) : ?>
				<div class="site-title <?php echo esc_attr( hello_show_or_hide( 'hello_header_logo_display' ) ); ?>">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr__( 'Home', 'hello-elementor' ); ?>" rel="home">
						<?php echo esc_html( $site_name ); ?>
					</a>
				</div>
			<?php endif;

			if ( $tagline && ( hello_elementor_get_setting( 'hello_header_tagline_display' ) || $is_editor ) ) : ?>
				<p class="site-description <?php echo esc_attr( hello_show_or_hide( 'hello_header_tagline_display' ) ); ?>">
					<?php echo esc_html( $tagline ); ?>
				</p>
			<?php endif; ?>
		</div>

		<?php if ( $header_nav_menu ) : ?>
			<nav class="site-navigation <?php echo esc_attr( hello_show_or_hide( 'hello_header_menu_display' ) ); ?>" aria-label="<?php echo esc_attr__( 'Main menu', 'hello-elementor' ); ?>">
				<?php
				// PHPCS - escaped by WordPress with "wp_nav_menu"
				echo $header_nav_menu; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				?>
			</nav>
		<?php endif; ?>
		<?php if ( $header_mobile_nav_menu ) : ?>
			<div class="site-navigation-toggle-holder <?php echo esc_attr( hello_show_or_hide( 'hello_header_menu_display' ) ); ?>">
				<button type="button" class="site-navigation-toggle">
					<span class="site-navigation-toggle-icon"></span>
					<span class="screen-reader-text"><?php echo esc_html__( 'Menu', 'hello-elementor' ); ?></span>
				</button>
			</div>
			<nav class="site-navigation-dropdown <?php echo esc_attr( hello_show_or_hide( 'hello_header_menu_display' ) ); ?>" aria-label="<?php echo esc_attr__( 'Mobile menu', 'hello-elementor' ); ?>" aria-hidden="true" inert>
				<?php
				// PHPCS - escaped by WordPress with "wp_nav_menu"
				echo $header_mobile_nav_menu; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				?>
			</nav>
		<?php endif; ?>
	</div>
</header>
