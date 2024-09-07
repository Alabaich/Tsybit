<?php
/*
Template Name: News
*/

get_header();

// Enqueue your custom JavaScript file for filtering
wp_enqueue_script( 'category-filter', get_template_directory_uri() . '/js/category-filter.js', array( 'jquery' ), null, true );
?>

<div class="category-filter-container">
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

<div id="posts-container">
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

<script>
    jQuery(document).ready(function($) {

// Function to fetch and display posts
function fetchPosts() {
    var selectedCategories = [];

    // Get selected categories from the checkboxes
    $('#category-filter input:checked').each(function() {
        selectedCategories.push($(this).val());
    });

    // Make AJAX request to get filtered posts
    $.ajax({
        url: ajaxurl, // WordPress AJAX handler
        type: 'POST',
        data: {
            action: 'filter_posts', // The custom action hook
            categories: selectedCategories // Send selected category IDs
        },
        beforeSend: function() {
            // You can add a loading spinner here if needed
            $('#posts-container').html('<p>Loading posts...</p>');
        },
        success: function(response) {
            $('#posts-container').html(response); // Replace posts with the response
        }
    });
}

// Event listener for checkboxes
$('#category-filter input').on('change', function() {
    fetchPosts(); // Fetch posts when the category filter is changed
});

});

</script>

<?php get_footer(); ?>
