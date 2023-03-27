(function($) {
'use strict';



var dureeTransitionModale = 500;
var modale = document.getElementById('modale-container');
var btnFermetureModale = document.getElementById('close-modale');

$('.btn-modale').click(function() {
    $('.modale').css('display', 'block');
    transitionModale(1);
});
btnFermetureModale.onclick = function() {
    fermetureModale();
}
window.onclick = function(event) {
    if (event.target == modale) {
        fermetureModale();
    }
}

function fermetureModale() {
    transitionModale(0);
    setTimeout(function() {
        $('.modale').css('display', 'none');
    }, dureeTransitionModale);
}
function transitionModale(opacity) {
    $('.modale').animate({
        opacity: opacity
    }, dureeTransitionModale);
}

$('.contact-photo__btn').click(function() {
    $('#form-reference input').val($('#reference-photo').text());
});



$('.wpcf7-submit').addClass('bouton');


})(jQuery);