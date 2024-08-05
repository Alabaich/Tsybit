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
        <li id="searchIcon">
            <a href="#" onclick="toggleSearchForm(event);">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <path d="M17.4999 17.5002L13.8808 13.881M13.8808 13.881C14.4998 13.2619 14.9909 12.527 15.3259 11.7181C15.661 10.9093 15.8334 10.0423 15.8334 9.16684C15.8334 8.29134 15.661 7.42441 15.326 6.61555C14.9909 5.80669 14.4998 5.07174 13.8808 4.45267C13.2617 3.8336 12.5267 3.34252 11.7179 3.00748C10.909 2.67244 10.0421 2.5 9.16659 2.5C8.29109 2.5 7.42416 2.67244 6.61531 3.00748C5.80645 3.34252 5.0715 3.8336 4.45243 4.45267C3.20215 5.70295 2.49976 7.39868 2.49976 9.16684C2.49976 10.935 3.20215 12.6307 4.45243 13.881C5.7027 15.1313 7.39844 15.8337 9.16659 15.8337C10.9347 15.8337 12.6305 15.1313 13.8808 13.881Z" stroke="#2C2D2C" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </li>
    </ul>
    <!-- Search Form -->
    <div id="searchContainer" class="search-container">
        <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
            <label>
                <input type="search" class="search-field" placeholder="<?php echo esc_attr_x('Search …', 'placeholder'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
            </label>
            <button type="submit" class="search-submit"><?php echo _x('Search', 'submit button'); ?></button>
        </form>
    </div>
</header>

<script>
    function toggleSearchForm(event) {
        event.preventDefault();
        const searchContainer = document.getElementById('searchContainer');
        searchContainer.classList.toggle('active');
        
        // Focus the search field when the search form is displayed
        if (searchContainer.classList.contains('active')) {
            document.querySelector('.search-field').focus();
        }
    }

    function handleClickOutside(event) {
        const searchContainer = document.getElementById('searchContainer');
        const searchIcon = document.getElementById('searchIcon');
        if (!searchContainer.contains(event.target) && !searchIcon.contains(event.target)) {
            searchContainer.classList.remove('active');
        }
    }

    // Attach the click event to the document
    document.addEventListener('click', handleClickOutside);
</script>




<header class="headerMobile">
<?php the_custom_logo(); ?>
<span onclick="openMenu();" class="openButton">
<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
  <path d="M3.75 7.5H26.25M3.75 15H26.25M3.75 22.5H26.25" stroke="#2C2D2C" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
</span>

<span onclick="closeMenu();" class="closeButton">
<svg xmlns="http://www.w3.org/2000/svg" width="31" height="31" viewBox="0 0 31 31" fill="none">
  <g clip-path="url(#clip0_155_313)">
    <path fill-rule="evenodd" clip-rule="evenodd" d="M15.4999 17.2677L22.5712 24.3389C22.8069 24.5666 23.1227 24.6926 23.4504 24.6898C23.7782 24.6869 24.0917 24.5555 24.3234 24.3237C24.5552 24.0919 24.6866 23.7784 24.6895 23.4507C24.6923 23.1229 24.5663 22.8072 24.3387 22.5714L17.2674 15.5002L24.3387 8.42894C24.5663 8.19318 24.6923 7.87743 24.6895 7.54969C24.6866 7.22194 24.5552 6.90842 24.3234 6.67666C24.0917 6.4449 23.7782 6.31344 23.4504 6.31059C23.1227 6.30775 22.8069 6.43374 22.5712 6.66144L15.4999 13.7327L8.42865 6.66144C8.19184 6.43937 7.87792 6.31814 7.55331 6.32341C7.22871 6.32869 6.91889 6.46004 6.68941 6.68968C6.45993 6.91932 6.3288 7.22923 6.32376 7.55384C6.31872 7.87845 6.44016 8.19228 6.6624 8.42894L13.7324 15.5002L6.66115 22.5714C6.54176 22.6867 6.44654 22.8247 6.38102 22.9772C6.31551 23.1297 6.28103 23.2937 6.27959 23.4597C6.27815 23.6257 6.30977 23.7903 6.37262 23.9439C6.43548 24.0975 6.52829 24.2371 6.64566 24.3544C6.76302 24.4718 6.90259 24.5646 7.05621 24.6275C7.20983 24.6903 7.37443 24.7219 7.5404 24.7205C7.70638 24.7191 7.8704 24.6846 8.02291 24.6191C8.17541 24.5536 8.31334 24.4583 8.42865 24.3389L15.4999 17.2677Z" fill="#2C2D2C"/>
  </g>
  <defs>
    <clipPath id="clip0_155_313">
      <rect width="30" height="30" fill="white" transform="translate(0.5 0.5)"/>
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
		menu.style.display = "flex"
		closeM.style.display = "block"
		openM.style.display = "none"
	}

	let closeMenu = () => {
		menu.style.display = "none"
		openM.style.display = "block"
		closeM.style.display = "none"
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
