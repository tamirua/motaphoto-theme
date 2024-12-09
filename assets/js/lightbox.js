//light-box
/*document.addEventListener('DOMContentLoaded', function () {
    const lightboxOverlay = document.getElementById('lightbox-overlay');
    const lightboxImage = document.getElementById('lightbox-image');
    const lightboxTitle = document.getElementById('lightbox-title');
    const prevButton = document.getElementById('prev-photo');
    const nextButton = document.getElementById('next-photo');
    const closeButton = document.getElementById('close-lightbox');
    let currentImageIndex = -1;
    let galleryImages = [];

    // Gather all gallery images
    document.querySelectorAll('.photo-link[data-lightbox="gallery"]').forEach((link, index) => {
        galleryImages.push({
            src: link.getAttribute('href'),
            title: link.getAttribute('data-lightbox-title'),
        });

        link.addEventListener('click', function (e) {
            e.preventDefault();
            currentImageIndex = index;
            openLightbox();
        });
    });

    function openLightbox() {
        const image = galleryImages[currentImageIndex];
        lightboxImage.src = image.src;
        lightboxTitle.textContent = image.title;
        lightboxOverlay.style.display = 'flex';
    }

    function closeLightbox() {
        lightboxOverlay.style.display = 'none';
    }

    function showNextImage() {
        if (currentImageIndex < galleryImages.length - 1) {
            currentImageIndex++;
            openLightbox();
        }
    }

    function showPreviousImage() {
        if (currentImageIndex > 0) {
            currentImageIndex--;
            openLightbox();
        }
    }

    closeButton.addEventListener('click', closeLightbox);
    lightboxOverlay.addEventListener('click', (e) => {
        if (e.target === lightboxOverlay) closeLightbox();
    });
    nextButton.addEventListener('click', showNextImage);
    prevButton.addEventListener('click', showPreviousImage);
});*/
/****************correct one************/




/*document.addEventListener('DOMContentLoaded', function () {
    // Open lightbox when fullscreen icon is clicked
    const fullscreenIcons = document.querySelectorAll('.icon-fullscreen');
    const lightboxOverlay = document.getElementById('lightbox-overlay');
    const lightboxImage = document.getElementById('lightbox-image');
    const lightboxReference = document.getElementById('lightbox-reference');
    const lightboxCategory = document.getElementById('lightbox-category');
    const closeLightbox = document.getElementById('close-lightbox');
    const prevArrow = document.getElementById('prev-arrow');
    const nextArrow = document.getElementById('next-arrow');
    let currentImageIndex = 0; // To track which image is currently displayed

    // Collect all image sources for navigation and their data attributes (reference and category)
    const imageElements = document.querySelectorAll('.related-photo-image');
    const imageData = Array.from(imageElements).map(img => ({
        src: img.src,
        reference: img.getAttribute('data-reference'), // Assuming reference is stored in data-reference
        category: img.getAttribute('data-category')  // Assuming category is stored in data-category
    }));

    // Open the lightbox with the clicked image
    fullscreenIcons.forEach(icon => {
        icon.addEventListener('click', function (event) {
            event.preventDefault();
            const imageUrl = icon.getAttribute('data-photo'); // Get the image URL from the data attribute

            // Find the clicked image data and set the current image index
            const foundImageIndex = imageData.findIndex(item => item.src === imageUrl);
            if (foundImageIndex !== -1) {
                currentImageIndex = foundImageIndex; // Set the current image index correctly
                openLightbox();
            } else {
                console.error('Image URL not found in imageData array');
            }
        });
    });

    // Function to open lightbox and set the current image, reference, and category
    function openLightbox() {
        const image = imageData[currentImageIndex];
        lightboxImage.src = image.src;
        lightboxReference.textContent = 'Reference: ' + (image.reference || 'N/A'); // Display reference
        lightboxCategory.textContent = 'Category: ' + (image.category || 'N/A'); // Display category
        lightboxOverlay.style.display = 'block'; // Show the lightbox overlay
    }

    // Close the lightbox
    closeLightbox.addEventListener('click', function () {
        lightboxOverlay.style.display = 'none'; // Hide the lightbox overlay
    });

    // Navigate to previous image
    prevArrow.addEventListener('click', function () {
        currentImageIndex = (currentImageIndex === 0) ? imageData.length - 1 : currentImageIndex - 1;
        openLightbox();
    });

    // Navigate to next image
    nextArrow.addEventListener('click', function () {
        currentImageIndex = (currentImageIndex === imageData.length - 1) ? 0 : currentImageIndex + 1;
        openLightbox();
    });
});*/

/*document.addEventListener('DOMContentLoaded', function () {
    const fullscreenIcons = document.querySelectorAll('.icon-fullscreen'); // All fullscreen icons
    const lightboxOverlay = document.getElementById('lightbox-overlay'); // Lightbox overlay element
    const lightboxImage = document.getElementById('lightbox-image'); // Image in the lightbox
    const lightboxReference = document.getElementById('lightbox-reference'); // Reference in lightbox
    const lightboxCategory = document.getElementById('lightbox-category'); // Category in lightbox
    const closeLightbox = document.getElementById('close-lightbox'); // Close button
    const prevArrow = document.getElementById('prev-arrow'); // Previous image arrow
    const nextArrow = document.getElementById('next-arrow'); // Next image arrow
    let currentImageIndex = 0; // To track which image is currently displayed

    // Collecting image data for navigation
    const imageElements = document.querySelectorAll('.related-photo-image');
    const imageData = Array.from(imageElements).map(img => ({
        src: img.src,
        reference: img.getAttribute('data-reference'), // Reference from data-reference attribute
        category: img.getAttribute('data-category') // Category from data-category attribute
    }));

    // Open lightbox when fullscreen icon is clicked
    fullscreenIcons.forEach(icon => {
        icon.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent default action of anchor tag
            const imageUrl = icon.getAttribute('data-photo'); // Get the image URL from data-photo attribute
            currentImageIndex = imageData.findIndex(item => item.src === imageUrl); // Set the current image index
            openLightbox(); // Open the lightbox with the current image
        });
    });

    // Function to open lightbox and set the current image, reference, and category
    function openLightbox() {
        const image = imageData[currentImageIndex]; // Get the current image data
        lightboxImage.src = image.src; // Set the image source in the lightbox
        lightboxReference.textContent = 'Reference: ' + (image.reference || 'N/A'); // Set reference
        lightboxCategory.textContent = 'Category: ' + (image.category || 'N/A'); // Set category
        lightboxOverlay.style.display = 'block'; // Show the lightbox overlay
    }

    // Close the lightbox
    closeLightbox.addEventListener('click', function () {
        lightboxOverlay.style.display = 'none'; // Hide the lightbox overlay
    });

    // Navigate to previous image
    prevArrow.addEventListener('click', function () {
        currentImageIndex = (currentImageIndex === 0) ? imageData.length - 1 : currentImageIndex - 1;
        openLightbox();
    });

    // Navigate to next image
    nextArrow.addEventListener('click', function () {
        currentImageIndex = (currentImageIndex === imageData.length - 1) ? 0 : currentImageIndex + 1;
        openLightbox();
    });
});*/

/*document.addEventListener('DOMContentLoaded', function () {
    const fullscreenIcons = document.querySelectorAll('.fullscreen-trigger'); // Fullscreen icons
    const lightboxOverlay = document.getElementById('lightbox-overlay'); // Lightbox overlay
    const lightboxImage = document.getElementById('lightbox-image'); // Lightbox image element
    const closeLightbox = document.getElementById('close-lightbox'); // Close button

    // Event listener for fullscreen icons
    fullscreenIcons.forEach(icon => {
        icon.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent default link behavior
            const imageUrl = icon.getAttribute('data-photo'); // Get image URL from data-photo
            openLightbox(imageUrl); // Open the lightbox with the image
        });
    });

    // Function to open lightbox
    function openLightbox(imageUrl) {
        lightboxImage.src = imageUrl; // Set the image source
        lightboxOverlay.style.display = 'block'; // Show the lightbox overlay
    }

    // Close lightbox when close button is clicked
    closeLightbox.addEventListener('click', function () {
        lightboxOverlay.style.display = 'none'; // Hide the lightbox overlay
        lightboxImage.src = ''; // Clear the image source
    });

    // Optional: Close lightbox when clicking outside the image
    lightboxOverlay.addEventListener('click', function (event) {
        if (event.target === lightboxOverlay) {
            lightboxOverlay.style.display = 'none'; // Hide the lightbox
            lightboxImage.src = ''; // Clear the image source
        }
    });
});*/
document.addEventListener('DOMContentLoaded', () => {
    const fullscreenIcons = document.querySelectorAll('.fullscreen-trigger');
    const lightboxOverlay = document.getElementById('lightbox-overlay');
    const lightboxImage = document.getElementById('lightbox-image');
    const lightboxReference = document.getElementById('lightbox-reference');
    const lightboxCategory = document.getElementById('lightbox-category');
    const closeLightboxButton = document.getElementById('close-lightbox');
    const nextArrow = document.getElementById('next-arrow');
    const prevArrow = document.getElementById('prev-arrow');

    let currentIndex = 0;
    const galleryItems = [];

    // Populate gallery items array with the fullscreen-trigger data
    fullscreenIcons.forEach((icon, index) => {
        galleryItems.push({
            photo: icon.getAttribute('data-photo'),
            reference: icon.getAttribute('data-reference'),
            category: icon.getAttribute('data-category'),
        });

        // Set click event for fullscreen trigger
        icon.addEventListener('click', (event) => {
            event.preventDefault();
            currentIndex = index; // Set the clicked image as the current index
            showLightbox(currentIndex);
        });
    });

    // Function to show lightbox content
    function showLightbox(index) {
        const item = galleryItems[index];
        if (item) {
            lightboxImage.src = item.photo;
            lightboxReference.textContent = item.reference;
            lightboxCategory.textContent = item.category;
            lightboxOverlay.style.display = 'block';
        }
    }

    // Close lightbox functionality
    closeLightboxButton.addEventListener('click', () => {
        lightboxOverlay.style.display = 'none';
    });

    // Next arrow functionality
    nextArrow.addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % galleryItems.length; // Loop to the first image after the last
        showLightbox(currentIndex);
    });

    // Previous arrow functionality
    prevArrow.addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + galleryItems.length) % galleryItems.length; // Loop to the last image before the first
        showLightbox(currentIndex);
    });
});

