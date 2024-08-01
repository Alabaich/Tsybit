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
			<div class="socNetworks">
			<?php
// Retrieve the customizer settings
$facebook_url = get_theme_mod('facebook_url', '');
$dribble = get_theme_mod('dribble', '');
$behance = get_theme_mod('behance', '');
$instagram_url = get_theme_mod('instagram_url', '');
?><?php if ( ! empty( $instagram_url ) ) : ?>
                <a href="<?php echo esc_url( $instagram_url ); ?>">
				<svg xmlns="http://www.w3.org/2000/svg" width="25" height="26" viewBox="0 0 25 26" fill="none">
  <path d="M14.177 13.6022C14.1707 13.9322 14.0666 14.2529 13.8779 14.5237C13.6891 14.7944 13.4242 15.003 13.1168 15.123C12.8093 15.2431 12.4732 15.2691 12.1509 15.1979C11.8286 15.1266 11.5348 14.9613 11.3066 14.7228C11.0784 14.4844 10.9261 14.1836 10.8691 13.8585C10.812 13.5334 10.8528 13.1987 10.9862 12.8968C11.1196 12.595 11.3396 12.3395 11.6184 12.1628C11.8971 11.9861 12.2221 11.8961 12.552 11.9043C12.9905 11.9206 13.4053 12.1069 13.7087 12.4239C14.0121 12.7409 14.18 13.1635 14.177 13.6022Z" fill="#2C2D2C"/>
  <path d="M15.3781 8.38354H9.72711C9.16794 8.38354 8.63168 8.60567 8.23629 9.00106C7.8409 9.39645 7.61877 9.93271 7.61877 10.4919V16.27C7.61877 16.5469 7.67331 16.821 7.77926 17.0768C7.88522 17.3326 8.04051 17.565 8.23629 17.7608C8.43207 17.9566 8.66449 18.1119 8.92028 18.2178C9.17608 18.3238 9.45024 18.3783 9.72711 18.3783H15.3781C15.655 18.3783 15.9292 18.3238 16.185 18.2178C16.4408 18.1119 16.6732 17.9566 16.869 17.7608C17.0647 17.565 17.22 17.3326 17.326 17.0768C17.432 16.821 17.4865 16.5469 17.4865 16.27V10.5023C17.4876 10.2246 17.4339 9.94947 17.3284 9.6926C17.223 9.43572 17.0679 9.20218 16.872 9.00535C16.6762 8.80853 16.4434 8.65229 16.1871 8.54558C15.9307 8.43888 15.6558 8.38382 15.3781 8.38354ZM12.5521 16.4283C11.9927 16.441 11.4422 16.2866 10.9709 15.985C10.4996 15.6834 10.1288 15.2482 9.90595 14.735C9.68307 14.2217 9.61816 13.6537 9.71952 13.1034C9.82088 12.5531 10.0839 12.0455 10.475 11.6453C10.8662 11.2452 11.3676 10.9706 11.9155 10.8567C12.4633 10.7429 13.0327 10.7948 13.5509 11.0059C14.0691 11.217 14.5126 11.5777 14.8249 12.042C15.1372 12.5063 15.304 13.0532 15.3042 13.6127C15.3085 13.9783 15.2406 14.3412 15.1046 14.6806C14.9686 15.02 14.7671 15.3292 14.5115 15.5907C14.2559 15.8522 13.9513 16.0607 13.6151 16.2045C13.2789 16.3482 12.9177 16.4243 12.5521 16.4283ZM15.6104 10.7981C15.5417 10.7981 15.4737 10.7844 15.4103 10.7578C15.3469 10.7312 15.2895 10.6922 15.2414 10.6431C15.1933 10.5941 15.1554 10.5359 15.1301 10.472C15.1047 10.4081 15.0924 10.3398 15.0938 10.271C15.0938 10.1313 15.1493 9.99719 15.2482 9.89834C15.347 9.79949 15.4811 9.74396 15.6209 9.74396C15.7606 9.74396 15.8947 9.79949 15.9936 9.89834C16.0924 9.99719 16.1479 10.1313 16.1479 10.271C16.15 10.3455 16.136 10.4194 16.1068 10.4879C16.0776 10.5564 16.034 10.6178 15.9789 10.6678C15.9238 10.7179 15.8585 10.7554 15.7876 10.7779C15.7166 10.8004 15.6416 10.8073 15.5677 10.7981H15.6104Z" fill="#2C2D2C"/>
  <path d="M12.5521 2.9325C9.78946 2.91869 7.13445 4.00291 5.17118 5.94665C3.20791 7.89038 2.0972 10.5344 2.08338 13.2971C2.06957 16.0598 3.15379 18.7148 5.09752 20.678C7.04126 22.6413 9.68529 23.752 12.448 23.7658C13.8159 23.7727 15.1718 23.51 16.4382 22.9928C17.7046 22.4757 18.8568 21.7141 19.8289 20.7517C20.801 19.7893 21.5741 18.6448 22.1039 17.3836C22.6337 16.1224 22.9099 14.7692 22.9167 13.4013C22.9236 12.0333 22.6609 10.6774 22.1437 9.411C21.6266 8.14458 20.865 6.99242 19.9026 6.0203C18.9401 5.04819 17.7956 4.27516 16.5345 3.74536C15.2733 3.21555 13.9201 2.93934 12.5521 2.9325ZM18.8782 16.1638C18.8811 16.6311 18.7912 17.0943 18.6137 17.5267C18.4363 17.959 18.1747 18.3518 17.8443 18.6823C17.5139 19.0128 17.1212 19.2744 16.6889 19.452C16.2566 19.6296 15.7934 19.7196 15.3261 19.7169H9.78026C9.31301 19.7195 8.84988 19.6294 8.41768 19.4519C7.98548 19.2743 7.59279 19.0128 7.26234 18.6824C6.93189 18.3521 6.67025 17.9594 6.49255 17.5273C6.31486 17.0951 6.22465 16.632 6.22713 16.1648V10.6179C6.22423 10.1506 6.31412 9.68734 6.49158 9.25501C6.66905 8.82268 6.93057 8.42988 7.26098 8.09938C7.59138 7.76887 7.98411 7.50724 8.41638 7.32965C8.84866 7.15205 9.31189 7.06203 9.77922 7.06479H15.3261C15.7933 7.06203 16.2565 7.15202 16.6887 7.32955C17.1209 7.50708 17.5136 7.76862 17.844 8.09901C18.1743 8.42941 18.4359 8.82208 18.6134 9.25429C18.7909 9.6865 18.8809 10.1496 18.8782 10.6169V16.1638Z" fill="#2C2D2C"/>
</svg>
</a>
<?php endif; ?>
<?php if ( ! empty( $dribble ) ) : ?>
                <a href="<?php echo esc_url( $dribble ); ?>">
				<svg xmlns="http://www.w3.org/2000/svg" width="25" height="26" viewBox="0 0 25 26" fill="none">
  <mask id="mask0_128_609" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="2" y="3" width="21" height="21">
    <path d="M21.5001 13.3494C21.5016 14.5348 21.2682 15.7088 20.8134 16.8035C20.3585 17.8982 19.6912 18.8919 18.8501 19.7272C18.0158 20.56 17.0256 21.2202 15.936 21.6702C14.8465 22.1201 13.6789 22.3509 12.5001 22.3494C7.52943 22.3494 3.50013 18.3201 3.50013 13.3494C3.49698 11.0417 4.38342 8.82154 5.97513 7.15062C6.81498 6.26439 7.82684 5.55886 8.94878 5.07719C10.0707 4.59553 11.2792 4.34787 12.5001 4.34937C13.6789 4.34785 14.8465 4.57864 15.936 5.02856C17.0256 5.47849 18.0158 6.13872 18.8501 6.97152C19.6912 7.80682 20.3585 8.80053 20.8134 9.89523C21.2682 10.9899 21.5016 12.1639 21.5001 13.3494Z" fill="white" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M21.5002 13.3494C20.1871 13.3494 16.5646 12.8544 13.3223 14.2778C9.8002 15.8244 7.25005 18.2238 6.13855 19.7156" stroke="black" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M9.125 5.00366C10.5335 6.30371 13.607 9.61346 14.75 12.8994C15.893 16.1853 16.316 20.2253 16.577 21.3751" stroke="black" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M3.56934 12.2245C5.26943 12.3271 9.76988 12.4193 12.6499 11.1895C15.5299 9.95963 18.008 7.69749 18.8581 6.97974" stroke="black" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M4.17513 16.7752C4.96817 18.6949 6.39844 20.2826 8.22513 21.2712M3.50013 13.3494C3.49698 11.0417 4.38342 8.82154 5.97513 7.15062C6.81498 6.26439 7.82684 5.55886 8.94878 5.07719C10.0707 4.59553 11.2792 4.34787 12.5001 4.34937M16.1001 5.09817C17.125 5.54661 18.0576 6.18188 18.8501 6.97152C19.6912 7.80682 20.3585 8.80053 20.8134 9.89523C21.2682 10.9899 21.5016 12.1639 21.5001 13.3494C21.5001 14.4573 21.2999 15.5188 20.9331 16.4994M12.5001 22.3494C13.6789 22.3509 14.8465 22.1201 15.936 21.6702C17.0256 21.2202 18.0158 20.56 18.8501 19.7272" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
  </mask>
  <g mask="url(#mask0_128_609)">
    <path d="M1.69995 2.54932H23.2999V24.1493H1.69995V2.54932Z" fill="#2C2D2C"/>
  </g>
</svg>
</a>
<?php endif; ?>
<?php if ( ! empty( $behance ) ) : ?>
                <a href="<?php echo esc_url( $behance ); ?>">
				<svg xmlns="http://www.w3.org/2000/svg" width="25" height="26" viewBox="0 0 25 26" fill="none">
  <path d="M15.375 12.5055C15.2299 12.5049 15.0863 12.5346 14.9534 12.5927C14.8205 12.6508 14.7012 12.736 14.6032 12.8429C14.5051 12.9498 14.4304 13.076 14.384 13.2134C14.3375 13.3508 14.3202 13.4964 14.3333 13.6409H16.4791C16.493 13.491 16.4742 13.3399 16.424 13.198C16.3739 13.056 16.2936 12.9267 16.1887 12.8187C16.0837 12.7108 15.9566 12.6269 15.8162 12.5729C15.6757 12.5188 15.5252 12.4958 15.375 12.5055ZM9.88538 13.6617H8.60413V15.6825H9.64579C10.6875 15.6825 11.1458 15.3388 11.1458 14.6409C11.1458 13.943 10.6666 13.6617 9.88538 13.6617ZM10.7916 11.8075C10.7916 11.2555 10.427 10.9221 9.80204 10.9221H8.60413V12.7346H9.48954C10.4166 12.7346 10.7916 12.4013 10.7916 11.8075Z" fill="#2C2D2C"/>
  <path d="M12.5 2.93237C10.4398 2.93237 8.42587 3.5433 6.71286 4.6879C4.99984 5.8325 3.66471 7.45936 2.8763 9.36275C2.08789 11.2662 1.8816 13.3606 2.28353 15.3812C2.68546 17.4019 3.67755 19.2579 5.13435 20.7147C6.59115 22.1715 8.44722 23.1636 10.4679 23.5656C12.4885 23.9675 14.5829 23.7612 16.4863 22.9728C18.3897 22.1844 20.0166 20.8492 21.1612 19.1362C22.3058 17.4232 22.9167 15.4093 22.9167 13.349C22.9167 11.9811 22.6473 10.6266 22.1238 9.36275C21.6003 8.09895 20.833 6.95062 19.8657 5.98334C18.8985 5.01607 17.7501 4.24878 16.4863 3.72529C15.2225 3.20181 13.868 2.93237 12.5 2.93237ZM10.1042 16.6824H7.29171V9.91154H10.1042C11.323 9.91154 12.125 10.547 12.125 11.5782C12.1394 11.9247 12.0299 12.2649 11.8161 12.5379C11.6023 12.8109 11.2982 12.9987 10.9584 13.0678C11.1737 13.0728 11.3858 13.1217 11.5816 13.2114C11.7774 13.3012 11.9528 13.43 12.0971 13.5899C12.2415 13.7498 12.3516 13.9375 12.4209 14.1415C12.4902 14.3454 12.5171 14.5614 12.5 14.7761C12.5 15.9845 11.4584 16.6824 10.1042 16.6824ZM13.8021 10.4324H16.9271V10.9532H13.8021V10.4324ZM17.7084 14.4428H14.2709V14.5886C14.253 14.7469 14.2692 14.9072 14.3185 15.0587C14.3677 15.2102 14.4489 15.3493 14.5565 15.4668C14.6641 15.5843 14.7956 15.6773 14.9422 15.7397C15.0888 15.802 15.247 15.8322 15.4063 15.8282C15.6299 15.8629 15.8585 15.8156 16.0499 15.695C16.2414 15.5744 16.3828 15.3886 16.448 15.172H17.7084C17.5961 15.672 17.3035 16.1131 16.8865 16.411C16.4695 16.7088 15.9574 16.8425 15.448 16.7865C15.1224 16.8194 14.7936 16.7806 14.4846 16.6727C14.1757 16.5648 13.8942 16.3906 13.6598 16.1622C13.4255 15.9338 13.244 15.6568 13.1282 15.3508C13.0125 15.0447 12.9651 14.717 12.9896 14.3907V13.9324C12.9675 13.6162 13.014 13.299 13.126 13.0025C13.238 12.7059 13.4128 12.4372 13.6384 12.2145C13.8639 11.9919 14.135 11.8207 14.433 11.7127C14.731 11.6046 15.0488 11.5623 15.3646 11.5886C15.6794 11.5684 15.9949 11.6159 16.2898 11.7279C16.5848 11.8399 16.8523 12.0138 17.0743 12.2378C17.2964 12.4619 17.4679 12.7309 17.5773 13.0268C17.6866 13.3227 17.7313 13.6386 17.7084 13.9532V14.4428Z" fill="#2C2D2C"/>
</svg>
</a>
<?php endif; ?>
<?php if ( ! empty( $facebook_url ) ) : ?>
                <a href="<?php echo esc_url( $facebook_url ); ?>">
				<svg xmlns="http://www.w3.org/2000/svg" width="25" height="26" viewBox="0 0 25 26" fill="none">
  <path d="M22.9167 13.349C22.9167 7.59904 18.25 2.93237 12.5 2.93237C6.75004 2.93237 2.08337 7.59904 2.08337 13.349C2.08337 18.3907 5.66671 22.5886 10.4167 23.5574V16.474H8.33337V13.349H10.4167V10.7449C10.4167 8.73446 12.0521 7.09904 14.0625 7.09904H16.6667V10.224H14.5834C14.0105 10.224 13.5417 10.6928 13.5417 11.2657V13.349H16.6667V16.474H13.5417V23.7136C18.8021 23.1928 22.9167 18.7553 22.9167 13.349Z" fill="#2C2D2C"/>
</svg>
</a>
<?php endif; ?>
            </div>
			</div>
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
