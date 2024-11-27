

jQuery(document).ready(function($) {
    // Show modal when the Contact button or navbar Contact is clicked
    $('#contact-button, .nav-contact').click(function() {
        $('.contact-modal').fadeIn(); // Show the modal with a fade effect
    });

    // Close modal when the close button is clicked
    $('.close-modal').click(function() {
        $(this).closest('.contact-modal').fadeOut(); // Hide the modal with a fade effect
    });

    // Close the modal when clicking outside of it
    $(document).on('click', function(event) {
        if ($(event.target).is('.contact-modal')) {
            $('.contact-modal').fadeOut(); // Hide the modal with a fade effect
        }
    });
});

// Get the modal
var contactModal = document.querySelector('.contact-modal');

// Get the button that opens the modal
var contactButton = document.getElementById('contactButton');

// Get the close button
var closeModal = document.querySelector('.close-modal');

// When the user clicks on the button, open the modal
contactButton.onclick = function () {
    contactModal.style.display = "block";
};

// When the user clicks on the close button, close the modal
closeModal.onclick = function () {
    contactModal.style.display = "none";
};

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
    if (event.target === contactModal) {
        contactModal.style.display = "none";
    }
};








/****for filter** */

document.addEventListener("change", function (e) {
    if (e.target.matches("#category-filter, #year-filter")) {
        const category = document.getElementById("category-filter").value;
        const year = document.getElementById("year-filter").value;

        fetch(`${ajaxurl}?action=filter_photos&category=${category}&year=${year}`)
            .then(response => response.text())
            .then(data => {
                document.querySelector(".photo-grid").innerHTML = data;
            });
    }
});




  
    
    











