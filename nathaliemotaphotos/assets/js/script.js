(function($) {
'use strict';



var modaleOuverte = false;

function ouvrirModale() {
    $('.modale').css('display', 'block');
    modaleOuverte = true;
}
function fermerModale() {
    $('.modale').css('display', 'none');
    modaleOuverte = false; 
}

$('.btn-modale').click(function() {
    if (!modaleOuverte) {
        ouvrirModale();
    }
    else {
        fermerModale();
    }
});
$('main, footer').click(function() {
    if (modaleOuverte) {
        fermerModale();
    }
});

})(jQuery);