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
<header class="pageWidth pcHeader">
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

<header class="headerMobile">
<?php the_custom_logo(); ?>
<span onclick="openMenu();" class="openButton">
<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
  <path d="M2.25 4.5H15.75M2.25 9H15.75M2.25 13.5H15.75" stroke="#2C2D2C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
</span>

<span onclick="closeMenu();" class="closeButton">
<svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
  <g clip-path="url(#clip0_155_313)">
    <path fill-rule="evenodd" clip-rule="evenodd" d="M9.49999 10.5606L13.7427 14.8034C13.8842 14.94 14.0736 15.0156 14.2703 15.0139C14.4669 15.0122 14.655 14.9333 14.7941 14.7942C14.9332 14.6552 15.012 14.4671 15.0137 14.2704C15.0155 14.0738 14.9399 13.8843 14.8032 13.7429L10.5605 9.50011L14.8032 5.25736C14.9399 5.11591 15.0155 4.92646 15.0137 4.72981C15.012 4.53316 14.9332 4.34505 14.7941 4.206C14.655 4.06694 14.4669 3.98807 14.2703 3.98636C14.0736 3.98465 13.8842 4.06024 13.7427 4.19686L9.49999 8.43961L5.25724 4.19686C5.11515 4.06362 4.9268 3.99089 4.73204 3.99405C4.53728 3.99721 4.35138 4.07602 4.2137 4.21381C4.07601 4.35159 3.99733 4.53754 3.9943 4.7323C3.99128 4.92707 4.06415 5.11537 4.19749 5.25736L8.43949 9.50011L4.19674 13.7429C4.12511 13.812 4.06797 13.8948 4.02866 13.9863C3.98936 14.0778 3.96867 14.1762 3.9678 14.2758C3.96694 14.3754 3.98591 14.4742 4.02362 14.5663C4.06133 14.6585 4.11702 14.7422 4.18744 14.8127C4.25786 14.8831 4.3416 14.9388 4.43377 14.9765C4.52595 15.0142 4.62471 15.0332 4.72429 15.0323C4.82387 15.0314 4.92229 15.0107 5.01379 14.9714C5.1053 14.9321 5.18805 14.875 5.25724 14.8034L9.49999 10.5606Z" fill="#2C2D2C"/>
  </g>
  <defs>
    <clipPath id="clip0_155_313">
      <rect width="18" height="18" fill="white" transform="translate(0.5 0.5)"/>
    </clipPath>
  </defs>
</svg>
</span>
</header>

<div class="bottomHeader">
<nav class="site-navigation <?php echo esc_attr( hello_show_or_hide( 'hello_header_menu_display' ) ); ?>" aria-label="<?php echo esc_attr__( 'Main menu', 'hello-elementor' ); ?>">
				<?php
				// PHPCS - escaped by WordPress with "wp_nav_menu"
				echo $header_nav_menu; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				?>
			</nav>
			<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label>
        <span class="screen-reader-text"><?php echo _x('Search for:', 'label'); ?></span>
        <input type="search" class="search-field" placeholder="<?php echo esc_attr_x('Search …', 'placeholder'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
    </label>
    <button type="submit" class="search-submit"><?php echo _x('Search', 'submit button'); ?></button>
</form>

</div>

<script>
	let openM = document.querySelector(".openButton")
	let closeM = document.querySelector(".closeButton")

	let menu = document.querySelector(".bottomHeader")

	let openMenu = () => {
		menu.styles.display = "block"
	}

	let closeMenu = () => {
		menu.styles.display = "none"
	}
</script>
<!-- <header id="site-header" class="site-header dynamic-header <?php echo esc_attr( $header_class ); ?>">
	
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
</header> -->
