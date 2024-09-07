<?php
/*
Template Name: News
*/

get_header();

// Enqueue your custom JavaScript file for filtering
wp_enqueue_script( 'category-filter', get_template_directory_uri() . '/js/category-filter.js', array( 'jquery' ), null, true );
?>

<style>
    .category-filter-container{
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        gap: 25px;
    }

    .category-filter-container form{
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
    }

    #category-filter input[type="checkbox"] {
    display: none;
}

/* Style the label */
#category-filter label {
    display: inline-block;
    padding: 10px 5px;
    background-color: white;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    cursor: pointer;
    margin-right: 10px; /* Optional: spacing between labels */
    transition: all 0.3s ease; /* Smooth transition for changes */
}

/* Change style when checkbox is checked */
#category-filter input[type="checkbox"]:checked + label {
    background-color: transparent;
    box-shadow: 0 0 0 rgba(0, 0, 0, 0);
    border: 1px solid black;
}
</style>

<div class="category-filter-container pageWidth">
    <h2><?php the_title(); ?></h2>
    <form id="category-filter">
        <?php
        // Get all categories
        $categories = get_categories();
        foreach ( $categories as $category ) :
        ?>
            <label>
                <input type="checkbox" name="category[]" value="<?php echo esc_attr( $category->term_id ); ?>">
                <?php echo esc_html( $category->name ); ?>
            </label>
        <?php endforeach; ?>
    </form>
</div>

<div id="posts-container" class="pageWidth">
    <?php
    // Display posts (default query)
    $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 10,
        'paged' => $paged,
    );

    $query = new WP_Query( $args );


    if ( $query->have_posts() ) :
        while ( $query->have_posts() ) : $query->the_post(); ?>
            <div class="post-item">
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <div class="post-excerpt"><?php the_excerpt(); ?></div>
            </div>
        <?php endwhile;

        // WordPress built-in pagination
        the_posts_pagination( array(
            'mid_size'  => 2,
            'prev_text' => __( '« Previous', 'textdomain' ),
            'next_text' => __( 'Next »', 'textdomain' ),
        ) );
    else :
        echo '<p>No posts found.</p>';
    endif;

    wp_reset_postdata();
    ?>
</div>

<?php get_footer(); ?>
