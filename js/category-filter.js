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
            url: ajax_object.ajax_url, // Use localized AJAX URL
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
