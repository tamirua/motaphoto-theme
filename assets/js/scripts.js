

jQuery(document).ready(function ($) {
        $('.contact-nav-link').on('click', function (event) {
            event.preventDefault(); 
            console.log('Contact button clicked'); 
        // Obtenir la référence de la photo à partir de l’attribut data du bouton
        const photoReference = $(this).data('photo_reference');

        // Insérer la référence dans le RÉF. Champ PHOTO dans le formulaire
        const referenceField = $('#photo-reference-field'); 
        if (referenceField.length) {
            referenceField.val(photoReference); 
        }


            $('.contact-modal').addClass('is-visible'); 
            $('.modal-salon').addClass('is-visible'); 
        });
    
        // Fermer la fenêtre modale lorsque l’on clique sur le bouton de fermeture
        $('.close-modal').on('click', function () {
            $('.contact-modal').removeClass('is-visible'); 
            $('.modal-salon').removeClass('is-visible'); 
        });
    
        // Fermer la fenêtre modale lorsque vous cliquez en dehors du contenu modal
        $(document).on('click', function (event) {
            if ($(event.target).is('.contact-modal')) {
                $('.contact-modal').removeClass('is-visible'); 
                $('.modal-salon').removeClass('is-visible'); 
            }
        });
    
        console.log('Script is running');
            
const menuToggle = document.getElementById('menu-toggle');
const navLinks = document.querySelector('.nav-links');


menuToggle.addEventListener('click', () => {

    navLinks.classList.toggle('active');
    menuToggle.classList.toggle('open');
});





// Ouvrez le modal et pré-remplissez le champ de référence sur le bouton de contact, sur cliquez
$('.contact-button').on('click', function (event) {
    event.preventDefault();

    const photoReference = $(this).data('photo-ref'); 
    const referenceField = $('#photo-reference-field'); 
        if (referenceField.length) {
            referenceField.val(photoReference); 
        }

        $('.contact-modal').addClass('is-visible'); 
        $('.modal-salon').addClass('is-visible'); 
    });

    // Fermer la logique modale
    $('.close-modal').on('click', function () {
        $('.contact-modal').removeClass('is-visible');
        $('.modal-salon').removeClass('is-visible');
    });

    // Fermer le modal en cliquant en dehors du contenu
    $(document).on('click', function (event) {
        if ($(event.target).is('.contact-modal')) {
            $('.contact-modal').removeClass('is-visible');
            $('.modal-salon').removeClass('is-visible');
        }
    });
 

});


//Pour les options de liste déroulante du fabricant de filtres
document.addEventListener("DOMContentLoaded", function () {
   
    const dropdowns = document.querySelectorAll('.custom-dropdown');
    dropdowns.forEach(function (dropdown) {
      const selected = dropdown.querySelector('.dropdown-selected');
      const options = dropdown.querySelector('.dropdown-options');
      
      
      selected.addEventListener('click', function () {
        dropdown.classList.toggle('open');
      });
      
      // Sélection de l’option de poignée
      const optionItems = options.querySelectorAll('.dropdown-option');
      optionItems.forEach(function (option) {
        option.addEventListener('click', function () {
          const value = option.getAttribute('data-value');
          const label = option.textContent;
          
          
          selected.textContent = label;
          
          
          optionItems.forEach(function (item) {
            item.classList.remove('selected');
          });
          option.classList.add('selected');
          
          
          dropdown.classList.remove('open');
  
          
          const event = new CustomEvent('filterChange', { detail: { value: value, filter: dropdown.id } });
          document.dispatchEvent(event);
        });
      });
    });
  
    
    document.addEventListener('click', function (event) {
        if (!event.target.closest('.custom-dropdown')) {
            dropdown.classList.remove('open');
            if (!dropdown.querySelector('.dropdown-option.selected')) {
                selected.textContent = placeholder; // Reset to placeholder
            }
        }
    });
  });


 








  




        
        
        
        
    
      
            
    
    
    
    
    
    
        
   
    
    








    

  
    
    











