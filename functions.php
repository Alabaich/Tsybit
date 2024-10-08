<?php
/**
 * Theme functions and definitions
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'HELLO_ELEMENTOR_VERSION', '3.1.1' );

if ( ! isset( $content_width ) ) {
	$content_width = 800; // Pixels.
}

if ( ! function_exists( 'hello_elementor_setup' ) ) {
	/**
	 * Set up theme support.
	 *
	 * @return void
	 */
	function hello_elementor_setup() {
		if ( is_admin() ) {
			hello_maybe_update_theme_version_in_db();
		}

		if ( apply_filters( 'hello_elementor_register_menus', true ) ) {
			register_nav_menus( [ 'menu-1' => esc_html__( 'Header', 'hello-elementor' ) ] );
			register_nav_menus( [ 'menu-2' => esc_html__( 'Footer', 'hello-elementor' ) ] );
		}

		if ( apply_filters( 'hello_elementor_post_type_support', true ) ) {
			add_post_type_support( 'page', 'excerpt' );
		}

		if ( apply_filters( 'hello_elementor_add_theme_support', true ) ) {
			add_theme_support( 'post-thumbnails' );
			add_theme_support( 'automatic-feed-links' );
			add_theme_support( 'title-tag' );
			add_theme_support(
				'html5',
				[
					'search-form',
					'comment-form',
					'comment-list',
					'gallery',
					'caption',
					'script',
					'style',
				]
			);
			add_theme_support(
				'custom-logo',
				[
					'height'      => 100,
					'width'       => 350,
					'flex-height' => true,
					'flex-width'  => true,
				]
			);

			/*
			 * Editor Style.
			 */
			add_editor_style( 'classic-editor.css' );

			/*
			 * Gutenberg wide images.
			 */
			add_theme_support( 'align-wide' );

			/*
			 * WooCommerce.
			 */
			if ( apply_filters( 'hello_elementor_add_woocommerce_support', true ) ) {
				// WooCommerce in general.
				add_theme_support( 'woocommerce' );
				// Enabling WooCommerce product gallery features (are off by default since WC 3.0.0).
				// zoom.
				add_theme_support( 'wc-product-gallery-zoom' );
				// lightbox.
				add_theme_support( 'wc-product-gallery-lightbox' );
				// swipe.
				add_theme_support( 'wc-product-gallery-slider' );
			}
		}
	}
}
add_action( 'after_setup_theme', 'hello_elementor_setup' );

function hello_maybe_update_theme_version_in_db() {
	$theme_version_option_name = 'hello_theme_version';
	// The theme version saved in the database.
	$hello_theme_db_version = get_option( $theme_version_option_name );

	// If the 'hello_theme_version' option does not exist in the DB, or the version needs to be updated, do the update.
	if ( ! $hello_theme_db_version || version_compare( $hello_theme_db_version, HELLO_ELEMENTOR_VERSION, '<' ) ) {
		update_option( $theme_version_option_name, HELLO_ELEMENTOR_VERSION );
	}
}

if ( ! function_exists( 'hello_elementor_display_header_footer' ) ) {
	/**
	 * Check whether to display header footer.
	 *
	 * @return bool
	 */
	function hello_elementor_display_header_footer() {
		$hello_elementor_header_footer = true;

		return apply_filters( 'hello_elementor_header_footer', $hello_elementor_header_footer );
	}
}

if ( ! function_exists( 'hello_elementor_scripts_styles' ) ) {
	/**
	 * Theme Scripts & Styles.
	 *
	 * @return void
	 */
	function hello_elementor_scripts_styles() {
		$min_suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		if ( apply_filters( 'hello_elementor_enqueue_style', true ) ) {
			wp_enqueue_style(
				'hello-elementor',
				get_template_directory_uri() . '/style' . $min_suffix . '.css',
				[],
				HELLO_ELEMENTOR_VERSION
			);
		}

		if ( apply_filters( 'hello_elementor_enqueue_theme_style', true ) ) {
			wp_enqueue_style(
				'hello-elementor-theme-style',
				get_template_directory_uri() . '/theme' . $min_suffix . '.css',
				[],
				HELLO_ELEMENTOR_VERSION
			);
		}

		if ( hello_elementor_display_header_footer() ) {
			wp_enqueue_style(
				'hello-elementor-header-footer',
				get_template_directory_uri() . '/header-footer' . $min_suffix . '.css',
				[],
				HELLO_ELEMENTOR_VERSION
			);
		}
	}
}
add_action( 'wp_enqueue_scripts', 'hello_elementor_scripts_styles' );

if ( ! function_exists( 'hello_elementor_register_elementor_locations' ) ) {
	/**
	 * Register Elementor Locations.
	 *
	 * @param ElementorPro\Modules\ThemeBuilder\Classes\Locations_Manager $elementor_theme_manager theme manager.
	 *
	 * @return void
	 */
	function hello_elementor_register_elementor_locations( $elementor_theme_manager ) {
		if ( apply_filters( 'hello_elementor_register_elementor_locations', true ) ) {
			$elementor_theme_manager->register_all_core_location();
		}
	}
}
add_action( 'elementor/theme/register_locations', 'hello_elementor_register_elementor_locations' );

if ( ! function_exists( 'hello_elementor_content_width' ) ) {
	/**
	 * Set default content width.
	 *
	 * @return void
	 */
	function hello_elementor_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'hello_elementor_content_width', 800 );
	}
}
add_action( 'after_setup_theme', 'hello_elementor_content_width', 0 );

if ( ! function_exists( 'hello_elementor_add_description_meta_tag' ) ) {
	/**
	 * Add description meta tag with excerpt text.
	 *
	 * @return void
	 */
	function hello_elementor_add_description_meta_tag() {
		if ( ! apply_filters( 'hello_elementor_description_meta_tag', true ) ) {
			return;
		}

		if ( ! is_singular() ) {
			return;
		}

		$post = get_queried_object();
		if ( empty( $post->post_excerpt ) ) {
			return;
		}

		echo '<meta name="description" content="' . esc_attr( wp_strip_all_tags( $post->post_excerpt ) ) . '">' . "\n";
	}
}
add_action( 'wp_head', 'hello_elementor_add_description_meta_tag' );

// Admin notice
if ( is_admin() ) {
	require get_template_directory() . '/includes/admin-functions.php';
}

// Settings page
require get_template_directory() . '/includes/settings-functions.php';

// Header & footer styling option, inside Elementor
require get_template_directory() . '/includes/elementor-functions.php';

if ( ! function_exists( 'hello_elementor_customizer' ) ) {
	// Customizer controls
	function hello_elementor_customizer() {
		if ( ! is_customize_preview() ) {
			return;
		}

		if ( ! hello_elementor_display_header_footer() ) {
			return;
		}

		require get_template_directory() . '/includes/customizer-functions.php';
	}
}
add_action( 'init', 'hello_elementor_customizer' );

if ( ! function_exists( 'hello_elementor_check_hide_title' ) ) {
	/**
	 * Check whether to display the page title.
	 *
	 * @param bool $val default value.
	 *
	 * @return bool
	 */
	function hello_elementor_check_hide_title( $val ) {
		if ( defined( 'ELEMENTOR_VERSION' ) ) {
			$current_doc = Elementor\Plugin::instance()->documents->get( get_the_ID() );
			if ( $current_doc && 'yes' === $current_doc->get_settings( 'hide_title' ) ) {
				$val = false;
			}
		}
		return $val;
	}
}
add_filter( 'hello_elementor_page_title', 'hello_elementor_check_hide_title' );

/**
 * BC:
 * In v2.7.0 the theme removed the `hello_elementor_body_open()` from `header.php` replacing it with `wp_body_open()`.
 * The following code prevents fatal errors in child themes that still use this function.
 */
if ( ! function_exists( 'hello_elementor_body_open' ) ) {
	function hello_elementor_body_open() {
		wp_body_open();
	}
}


function my_theme_customize_register( $wp_customize ) {
    // Add Section for Contact Information
    $wp_customize->add_section( 'contact_info_section', array(
        'title'    => __( 'Contact Information', 'my_theme' ),
        'priority' => 30,
    ) );

    // Add Setting for Phone Number
    $wp_customize->add_setting( 'phone_number', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    // Add Control for Phone Number
    $wp_customize->add_control( 'phone_number', array(
        'label'   => __( 'Phone Number', 'my_theme' ),
        'section' => 'contact_info_section',
        'type'    => 'text',
    ) );

    // Add Setting for Email Address
    $wp_customize->add_setting( 'email_address', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_email',
    ) );

    // Add Control for Email Address
    $wp_customize->add_control( 'email_address', array(
        'label'   => __( 'Email Address', 'my_theme' ),
        'section' => 'contact_info_section',
        'type'    => 'email',
    ) );

    // Add Section for Social Media Links
    $wp_customize->add_section( 'social_media_section', array(
        'title'    => __( 'Social Media Links', 'my_theme' ),
        'priority' => 31,
    ) );

    // Add Setting and Control for Facebook
    $wp_customize->add_setting( 'facebook_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( 'facebook_url', array(
        'label'   => __( 'Facebook URL', 'my_theme' ),
        'section' => 'social_media_section',
        'type'    => 'url',
    ) );

	    // Add Setting and Control for Facebook
		$wp_customize->add_setting( 'behance', array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		) );
	
		$wp_customize->add_control( 'behance', array(
			'label'   => __( 'behance', 'my_theme' ),
			'section' => 'social_media_section',
			'type'    => 'url',
		) );

    // Add Setting and Control for Twitter
    $wp_customize->add_setting( 'dribble', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( 'dribble', array(
        'label'   => __( 'Ldribble', 'my_theme' ),
        'section' => 'social_media_section',
        'type'    => 'url',
    ) );

    // Add Setting and Control for Instagram
    $wp_customize->add_setting( 'instagram_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( 'instagram_url', array(
        'label'   => __( 'Instagram URL', 'my_theme' ),
        'section' => 'social_media_section',
        'type'    => 'url',
    ) );
}
add_action( 'customize_register', 'my_theme_customize_register' );



function enqueue_ajax_script() {
    // Localize the ajaxurl for frontend use
    wp_localize_script( 'category-filter', 'ajaxurl', admin_url( 'admin-ajax.php' ) );
}
add_action( 'wp_enqueue_scripts', 'enqueue_ajax_script' );

// AJAX handler for filtering posts
function filter_posts() {
    // Retrieve the selected categories from the AJAX request
    $categories = isset($_POST['categories']) ? $_POST['categories'] : array();

    // Set up the arguments for the WP_Query
    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => 10, // Adjust per page limit if necessary
        'paged'          => (get_query_var('paged')) ? get_query_var('paged') : 1,
    );

    // Add category filter to the query if categories are selected
    if (!empty($categories)) {
        $args['category__in'] = $categories;
    }

    // Query posts
    $query = new WP_Query($args);

    // Check if there are posts
    if ($query->have_posts()) {
        while ($query->have_posts()) : $query->the_post(); ?>
            <a href="<?php the_permalink(); ?>" class="post-item" style="background-image: url('<?php echo esc_url( get_the_post_thumbnail_url() ); ?>');">
                <div class="post-content">
                    <h2><?php the_title(); ?></h2>
                </div>
    </a>
        <?php endwhile;

        // WordPress pagination
        the_posts_pagination( array(
            'mid_size'  => 2,
            'prev_text' => __( '« Previous', 'textdomain' ),
            'next_text' => __( 'Next »', 'textdomain' ),
        ) );

    } else {
        echo '<p>No posts found.</p>';
    }

    wp_die(); // Required to terminate the request properly
}
add_action('wp_ajax_filter_posts', 'filter_posts'); // If logged in
add_action('wp_ajax_nopriv_filter_posts', 'filter_posts'); // If not logged in


function enqueue_category_filter_script() {
    // Enqueue the category-filter.js script
    wp_enqueue_script('category-filter', get_template_directory_uri() . '/js/category-filter.js', array('jquery'), null, true );

    // Localize the script with AJAX URL
    wp_localize_script('category-filter', 'ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php') // Localized variable for AJAX URL
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_category_filter_script');
