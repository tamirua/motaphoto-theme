/*jQuery(document).ready(function ($) {
    $('#load-more-btn').on('click', function (e) {
        e.preventDefault();

        var button = $(this);
        var page = button.data('page') || 1;
        var nonce = galleryLoadMore.nonce;

        $.ajax({
            url: galleryLoadMore.ajax_url,
            type: 'POST',
            data: {
                action: 'photo_gallery_load_more', // WordPress action hook
                page: page,
                nonce: nonce
            },
            success: function (response) {
                if (response) {
                    $('#gallery-container').append(response); // Append new photos
                    button.data('page', page + 1); // Increment page
                } else {
                    button.hide(); // Hide button if no more photos
                }
            },
            error: function () {
                alert('There was an error loading more photos. Please try again.');
            }
        });
    });
});*/



/*jQuery(document).ready(function($) {
    $('#load-more').on('click', function(e) {
        e.preventDefault(); // Prevent default action (if inside a form or link)

        var button = $(this);
        var page = button.data('page'); // Current page
        var ajaxurl = galleryLoadMore.ajax_url; // AJAX URL passed via wp_localize_script
        var nonce = galleryLoadMore.nonce; // Security nonce passed via wp_localize_script

        // Update the button to show loading status
        button.text('Loading...');

        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'my_load_more', // Matches the action in your PHP handler
                page: page,
                nonce: nonce,
            },
            success: function(response) {
                if (response) {
                    $('#photo-gallery').append(response); // Append new content to the gallery
                    button.data('page', page + 1); // Increment page number
                    button.text('Charge Plus'); // Reset button text
                } else {
                    button.text('No More Photos'); // No more content
                    button.prop('disabled', true); // Disable the button
                }
            },
            error: function() {
                button.text('Error, Try Again'); // Error handling
            }
        });
    });
});*/

/*jQuery(document).ready(function($) {

    
    
    

    
});*/

jQuery(document).ready(function ($) {
    $('.load-more').on('click', function () {
        const button = $(this);
        const page = parseInt(button.data('page')) + 1;

        $.ajax({
            url: button.data('ajaxurl'), // URL for the AJAX request
            type: 'POST',
            data: {
                action: 'photo-load-more',
                paged: page,
                nonce: button.data('nonce'),
            },
            beforeSend: function () {
                button.text('Loading...'); // Show loading state
            },
            success: function (response) {
                if (response.success) {
                    $('#photo-gallery').append(response.data); // Append the new photos
                    button.data('page', page); // Update the page number
                    button.text('Charge Plus'); // Reset button text
                } else {
                    button.prop('disabled', true); // Disable button if no more photos
                    button.text('No more photos');
                }
            },
            error: function (xhr, status, error) {
                console.error('Error loading more photos:', error); // Log error
            },
        });
    });
});


