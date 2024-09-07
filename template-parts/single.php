<?php
/**
 * The template for displaying singular post-types: posts, pages and user-defined custom post types.
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

while ( have_posts() ) :
	the_post();
	?>



<style>
      * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
      }
    </style>

    <style>
      .mainContainer {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        gap: 25px;
        padding: 0 150px;
      }

      .mainContainer .heroShadowTextContainer {
        display: flex;
        flex-direction: column;
        align-items: left;
        width: 100%;
      }

      .mainContainer .heroShadowTextContainer h1 {
        color: #2c2d2c;
        font-family: Montserrat;
        text-align: left;
        font-size: 64px;
        max-width: 800px;
        font-style: normal;
        font-weight: 800;
        line-height: 105%;
        transition: text-shadow 0.1s ease-out;
      }

      .mainContainer .heroShadowTextContainer .regularText {
        color: #808080;
        text-align: left;
        font-family: Montserrat;
        font-size: 20px;
        font-weight: 300;
        max-width: 800px;
        width: 100%;
      }

      .mainContainer .categoriesContainer {
        display: flex;
        flex-wrap: wrap;
        justify-content: left;
        align-items: left;
        width: 100%;
        gap: 25px;
      }

      .mainContainer .categoriesContainer .oneCategory {
        display: inline-flex;
        border: 1px solid #2c2d2c;
        border-radius: 25px;
        align-items: center;
        gap: 10px;
        padding: 10px 15px;
        transition: ease-in 300ms;
      }

      .mainContainer .categoriesContainer .oneCategory:hover {
        background-color: #2c2d2c;
        color: #fff;
      }

      .mainContainer .imgContainer {
        display: flex;
        width: 100%;
        align-items: start;
      }

      .mainContainer .imgContainer img {
        width: 100%;
        max-width: 850px;
        max-height: 600px;
        object-fit: cover;
        border-radius: 5px;
        height: auto;
      }

      .mainContainer .textContainer {
        display: flex;
        align-items: left;
        width: 100%;
      }

      .mainContainer .textContainer .textForNews {
        color: #808080;
        text-align: left;
        font-family: Montserrat;
        font-size: 22px;
        font-weight: 310;
        max-width: 1200px;
        width: 100%;
      }
    </style>
<main id="content" <?php post_class( 'site-main' ); ?>>

	<?php if ( apply_filters( 'hello_elementor_page_title', true ) ) : ?>
		<div class="page-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</div>
	<?php endif; ?>

    <div class="mainContainer">
      <div class="title heroShadowTextContainer">
        <h1 class="heroShadowText"><?php the_title();?></h1>
        <!-- <p class="regularText">Some subtitle for the page</p> -->
      </div>

      <!-- <div class="categoriesContainer">
        <div class="oneCategory">Investments</div>
        <div class="oneCategory">Guides</div>
        <div class="oneCategory">Accounting</div>
        <div class="oneCategory">Investments</div>
        <div class="oneCategory">Guides</div>
        <div class="oneCategory">Accounting</div>
        <div class="oneCategory">Investments</div>
      </div> -->
      <div class="imgContainer">
        <img src="<?php echo esc_url( get_the_post_thumbnail_url() ); ?>" alt="" />
      </div>
      <div class="textContainer">

          <?php the_content(); ?>

      </div>
    </div>

	<div class="page-content">
		<?php the_content(); ?>

		<?php wp_link_pages(); ?>

		<?php if ( has_tag() ) : ?>
		<div class="post-tags">
			<?php the_tags( '<span class="tag-links">' . esc_html__( 'Tagged ', 'hello-elementor' ), ', ', '</span>' ); ?>
		</div>
		<?php endif; ?>
	</div>

	<?php comments_template(); ?>

</main>

	<?php
endwhile;
