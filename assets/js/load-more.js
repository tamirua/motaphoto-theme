

jQuery(document).ready(function ($) {
    $('.load-more').on('click', function () {
        const button = $(this);
        const page = parseInt(button.data('page')) + 1;

        $.ajax({
            url: button.data('ajaxurl'), 
            type: 'POST',
            data: {
                action: 'photo-load-more',
                paged: page,
                nonce: button.data('nonce'),
            },
            beforeSend: function () {
                button.text('Loading...'); 
            },
            success: function (response) {
                if (response.success) {
                    $('#photo-gallery').append(response.data); 
                    button.text('Charge Plus'); 
                } else {
                    button.prop('disabled', true); 
                    button.text('No more photos');
                }
            },
            error: function (xhr, status, error) {
                console.error('Error loading more photos:', error); 
            },
        });
    });
});


