
jQuery(document).ready(function ($) {
    $('.load-more').on('click', function () {
        const button = $(this);
        const page = parseInt(button.data('page')); 
        const maxPages = button.data('max-pages'); 

        //Empêcher la demande si nous sommes déjà sur la dernière page
        if (page >= maxPages) {
            button.prop('disabled', true); 
            button.text('No more photos'); 
            return; 
        }

        $.ajax({
            url: button.data('ajaxurl'),
            type: 'POST',
            data: {
                action: 'photo-load-more',
                paged: page + 1, 
                nonce: button.data('nonce'),
            },
            beforeSend: function () {
                button.text('Loading...'); 
            },
            success: function (response) {
                if (response.success) {
                    $('#photo-gallery').append(response.data.html); 
                    button.data('page', response.data.next_page); 

                    // S’il n’y a plus de pages, désactivez le bouton
                    if (response.data.next_page >= response.data.max_pages) {
                        button.prop('disabled', true);
                        button.text('No more photos');
                    } else {
                        button.text('Charge Plus'); 
                    }
                } else {
                    button.prop('disabled', true); 
                    button.text('No more photos');
                }
            },
            error: function (xhr, status, error) {
                console.error('Error loading more photos:', error);
                button.text('Error loading photos');
            },
        });
    });
});



