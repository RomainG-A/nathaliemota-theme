(function($) {
'use strict';



var dureeTransitionModale = 500;
var modale = document.getElementById('modale-container');
var btnFermetureModale = document.getElementById('close-modale');

$('.btn-modale').click(function() {
    $('.modale').css('display', 'flex');
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

$('.interaction-photo__btn').click(function() {
    $('#form-reference input').val($('#reference-photo').text());
});


let pageActuelle = 1;
$('#btn-charger-plus').on('click', function() {
    pageActuelle ++;
    $.ajax({
        type: 'POST',
        url: '/wp-admin/admin-ajax.php',
        dataType: 'html',
        data: {
          action: 'load_more',
          paged: pageActuelle,
        },
        success: function (res) {
          $('.galerie__photos').append(res);
        }
    });
});

console.log($('#filtre-format').val());

$('.wpcf7-submit').addClass('bouton');



})(jQuery);