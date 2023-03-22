(function($) {
'use strict';



var modaleOuverte = false;
var contenuSite = "header, main, footer";

function ouvrirModale() {
    $('.modale').css('display', 'block');
    $(contenuSite).addClass('darken');
    modaleOuverte = true;
}
function fermerModale() {
    $('.modale').css('display', 'none');
    $(contenuSite).removeClass('darken');
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