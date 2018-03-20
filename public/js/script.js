// Effet Smoothscroll sur le bouton voir tout les chapitres 

$(document).ready(function() {
    $('#allChapter').on('click', function() { // Au clic sur un élément
        var page = $(this).attr('href'); // Page cible
        var speed = 1500; // Durée de l'animation (en ms)
        $('html, body').animate( { scrollTop: $(page).offset().top }, speed ); // Go
        return false;
    });
});