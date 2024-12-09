

jQuery(document).ready(function ($) {
        // Show modal when the Contact navigation <li> is clicked
        $('.contact-nav-link').on('click', function (event) {
            event.preventDefault(); // Prevent default action
            console.log('Contact button clicked'); // Debugging log
        // Get the photo reference from the button's data attribute
        const photoReference = $(this).data('photo-ref');

        // Insert the reference into the RÉF.PHOTO field in the form
        const referenceField = $('#photo-reference-field'); // Target the field by ID
        if (referenceField.length) {
            referenceField.val(photoReference); // Set the value of the field
        }


            $('.contact-modal').addClass('is-visible'); 
            $('.modal-salon').addClass('is-visible'); 
        });
    
        // Close modal when the close button is clicked
        $('.close-modal').on('click', function () {
            $('.contact-modal').removeClass('is-visible'); 
            $('.modal-salon').removeClass('is-visible'); 
        });
    
        // Close modal when clicking outside the modal content
        $(document).on('click', function (event) {
            if ($(event.target).is('.contact-modal')) {
                $('.contact-modal').removeClass('is-visible'); // Hide the modal
                $('.modal-salon').removeClass('is-visible'); // Hide the modal content
            }
        });
    
        console.log('Script is running');

        //menu burger
        const menuToggle = $('#menu-toggle');
        const mainMenu = $('.main-menu');
    
        if (menuToggle.length && mainMenu.length) {
            menuToggle.on('click', function () {
                $(this).toggleClass('open');
                mainMenu.toggleClass('open');
            });
        }

    
    
});

        
        
        
        
    
      
            
    
    
    
    
    
    
        
   
    
    








    /****for filter** */

   /* document.addEventListener("change", function (e) {
        if (e.target.matches("#category-filter, #year-filter")) {
            const category = document.getElementById("category-filter").value;
            const year = document.getElementById("year-filter").value;

            fetch(`${galleryLoadMore.ajax_url}?action=filter_photos&category=${category}&year=${year}`)
                .then(response => response.text())
                .then(data => {
                    document.querySelector(".photo-grid").innerHTML = data;
                });
        }
    });

    //for filter


    function fetchPhotos(page = 1) {
        const filters = {
            category: $('#categories-filter').val(),
            format: $('#formats-filter').val(),
            order: $('#year-filter').val(),
        };

        $.ajax({
            url: my_ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'fetch_photos',
                filters,
                page,
            },
            beforeSend: function () {
                $('#load-more').text('Loading...');
            },
            success: function (response) {
                if (page === 1) {
                    $('#photo-gallery').html(response);
                } else {
                    $('#photo-gallery').append(response);
                }
                $('#load-more').text('Charger Plus').data('page', page);
            },
        });
    }

    // Trigger on filter change
    $('#categories-filter, #formats-filter, #year-filter').change(function () {
        fetchPhotos(1);
    });

    // Load more button
    $('#load-more').click(function () {
        const nextPage = $(this).data('page') + 1;
        fetchPhotos(nextPage);
    });
    console.log(galleryLoadMore.ajax_url); */// Should display the admin-ajax.php URL

/* i have to insert the close of jquqry*/





  
    
    











