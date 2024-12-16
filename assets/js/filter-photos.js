//Fonction pour récupérer les photos filtrées
jQuery(document).ready(function ($) {
    function fetchFilteredPhotos() {
        const category = $('#categories-dropdown .dropdown-selected').data('value');
        const format = $('#formats-dropdown .dropdown-selected').data('value');
        const year = $('#year-dropdown .dropdown-selected').data('value');

        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'filter_photos',
                category: category,
                format: format,
                year: year,
            },
            success: function (response) {
                if (response.success) {
                    $('#photo-gallery').html(response.data); 
                } else {
                    $('#photo-gallery').html('<p>No photos found.</p>'); 
                }
            },
            error: function (xhr, status, error) {
                console.error('Error fetching photos:', error);
            },
        });
    }

    $('#categories-dropdown .dropdown-option, #formats-dropdown .dropdown-option, #year-dropdown .dropdown-option').on('click', function () {
        const dropdown = $(this).closest('.custom-dropdown');
        const selectedText = $(this).text();
        const selectedValue = $(this).data('value');

        
        dropdown.find('.dropdown-selected').text(selectedText).data('value', selectedValue);

        // Déclencher la fonction de récupération de photos
        fetchFilteredPhotos();
    });
});








