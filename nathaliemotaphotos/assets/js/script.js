(function($) {
'use strict';


var transitionModale = 500;
//var modaleOuverte = false;

$('.btn-modale').click(function() {
    $('.modale').css('display', 'block');
    affichageModale(1);
    //modaleOuverte = true;
});
$('.btn-close').on('click', function(e) {
    affichageModale(0);
    setTimeout(function() {
        $('.modale').css('display', 'none');
    }, transitionModale);
    //modaleOuverte = false;
    
});
/* $('.modale').on('click', function(e) {
    if (e.target != $('.modale__content') && modaleOuverte) {
        affichageModale(0);
        setTimeout(function() {
            $('.modale').css('display', 'none');
        }, transitionModale);
        modaleOuverte = false;
    }
}); */

function affichageModale(opacity) {
    $('.modale').animate({
        opacity: opacity
    }, transitionModale);
}

})(jQuery);