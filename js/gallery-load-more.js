jQuery(document).ready(function($) {
    $('#load-more-btn').on('click', function(e) {
        e.preventDefault();

        var button = $(this);
        var page = button.data('page');
        var nonce = galleryLoadMore.nonce;

        $.ajax({
            url: galleryLoadMore.ajax_url,
            type: 'POST',
            data: {
                action: 'photo_gallery_load_more', // WordPress action hook
                page: page,
                nonce: nonce
            },
            success: function(response) {
                if (response) {
                    $('#gallery-container').append(response); // Append new photos
                    button.data('page', page + 1); // Increment page
                } else {
                    button.hide(); // Hide button if no more photos
                }
            },
            error: function() {
                alert('There was an error loading more photos. Please try again.');
            }
        });
    });
});
