
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

    // Remplir le tableau des éléments de la galerie avec les données fullscreen-trigger
    fullscreenIcons.forEach((icon, index) => {
        galleryItems.push({
            photo: icon.getAttribute('data-photo'),
            reference: icon.getAttribute('data-reference'),
            category: icon.getAttribute('data-category'),
        });

        icon.addEventListener('click', (event) => {
            event.preventDefault();
            currentIndex = index; 
            showLightbox(currentIndex);
        });
    });

    // Fonction d’affichage du contenu de la lightbox
    function showLightbox(index) {
        const item = galleryItems[index];
        if (item) {
            lightboxImage.src = item.photo;
            lightboxReference.textContent = item.reference;
            lightboxCategory.textContent = item.category;
            lightboxOverlay.style.display = 'block';
        }
    }

    // Fermer la fonctionnalité de la lightbox
    closeLightboxButton.addEventListener('click', () => {
        lightboxOverlay.style.display = 'none';
    });

    // Fonctionnalité de la flèche suivante
    nextArrow.addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % galleryItems.length; 
        showLightbox(currentIndex);
    });

    // Fonctionnalité de la flèche précédente
    prevArrow.addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + galleryItems.length) % galleryItems.length; 
        showLightbox(currentIndex);
    });
});

