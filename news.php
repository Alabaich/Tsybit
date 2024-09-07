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

/* Hide the checkbox */
#category-filter input[type="checkbox"] {
    display: none;
}

/* Style the label */
#category-filter label {
    display: inline-block;
    padding: 5px 10px;
    background-color: white;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    cursor: pointer;
    margin-right: 10px; /* Optional: spacing between labels */
    transition: all 0.3s ease; /* Smooth transition for changes */
}

/* Change style when checkbox is checked */
#category-filter input[type="checkbox"]:checked + label {
    background-color: transparent;
    box-shadow: none;
    border: 1px solid black;
}

/* Container for the posts */
#posts-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 15px;
}

/* Style each post item */
.post-item {
    position: relative;
    height: 500px; /* Default height */
    background-size: cover;
    background-position: center;
    border-radius: 10px;
    overflow: hidden;
}

/* Style for mobile */
@media (max-width: 768px) {
    .post-item {
        height: 300px; /* Mobile height */
    }
}

/* Content block at the bottom of the post item */
.post-content {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    padding: 10px;
    background: rgba(0, 0, 0, 0.5); /* 50% black background */
    color: white;
    text-align: center;
}

/* Style post title */
.post-content h2 {
    margin: 0;
    font-size: 18px;
    font-weight: bold;
}

/* Ensure link styling is correct */
.post-content a {
    color: white;
    text-decoration: none;
}

.post-content a:hover {
    text-decoration: underline;
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
            <input type="checkbox" id="category-<?php echo esc_attr( $category->term_id ); ?>" name="category[]" value="<?php echo esc_attr( $category->term_id ); ?>">
            <label for="category-<?php echo esc_attr( $category->term_id ); ?>">
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
            <a href="<?php the_permalink(); ?>" class="post-item" style="background-image: url('<?php echo esc_url( get_the_post_thumbnail_url() ); ?>');">
                <div class="post-content">
                    <h2><?php the_title(); ?></h2>
                </div>
    </a>
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
