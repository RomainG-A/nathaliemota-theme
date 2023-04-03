(function($) {
'use strict';



$('.wpcf7-submit').addClass('bouton');

var dureeTransitionPopup = 500;
var modale = document.getElementById('modale-container');
// var lightbox = document.getElementById('lightbox-container');
var btnFermetureModale = document.getElementById('close-modale');
var btnFermetureLightbox = document.getElementById('close-lightbox');

$('.btn-modale').click(function() {
    transitionPopup($('.modale'), 1);
});
btnFermetureModale.onclick = function() {
    transitionPopup($('.modale'), 0);
}
window.onclick = function(event) {
    if (event.target == modale) {
        transitionPopup($('.modale'), 0);
    }
}

$(document).on('click', '.btn-plein-ecran', function() {
    var image = $(this).parent().parent().prev();
    var urlImage = image.attr('src');
    var creerImage = '<img src="' + urlImage + '" alt="Image agrandie">';
    $('.lightbox__image').html(creerImage);
    transitionPopup($('.lightbox'), 1);
});
btnFermetureLightbox.onclick = function() {
    transitionPopup($('.lightbox'), 0);
}
/* window.onclick = function(event) {
    if (event.target == lightbox) {
        transitionPopup($('.lightbox'), 0);
    }
} */

function transitionPopup(element, opacity) {
    if (opacity == 1) {
        $(element).css('display', 'flex');
    }
    else if (opacity == 0) {
        setTimeout(function() {
            $(element).css('display', 'none');
        }, dureeTransitionPopup);
    }
    $(element).animate({
        opacity: opacity
    }, dureeTransitionPopup);
}



let menuMobileOrigine = $('.header-mobile').height() * (-1);
let menuOuvert = -1;
$('.header-mobile').css('margin-top', menuMobileOrigine);

$('.header__btn-menu').click(function() {
    if (menuOuvert == -1) {
        $('.header-mobile').css('opacity', '1');
        effetMenu(0, 0);
    }
    else {
        effetMenu(1, menuMobileOrigine);
        setTimeout(function() {
            $('.header-mobile').css('opacity', '0');
        }, dureeTransitionPopup);
    }
});

function effetMenu(opacite, position) {
    setTimeout(function() {
        $('.header-desktop').css('opacity', opacite);
    }, (dureeTransitionPopup / 2));
    $('.header-mobile').animate({
        'margin-top': position
    }, dureeTransitionPopup);
    menuOuvert = menuOuvert * (-1);
}



$('.interaction-photo__btn').click(function() {
    $('#form-reference input').val($('#reference-photo').text());
});



navigationPhotos($('.fleche-gauche'), $('.previous-image'));
navigationPhotos($('.fleche-droite'), $('.next-image'));
function navigationPhotos(fleche, image) {
    fleche.hover(
        function() {
            image.css('opacity', '1');
        }, function() {
            image.css('opacity', '0');
        }
    );
}



let pageActuelle = 1;

$('#btn-charger-plus').on('click', function() {
    pageActuelle ++;
    ajaxRequest(true);
});
$(document).on('change', '.js-filter-form', function(e) {
    e.preventDefault();
    pageActuelle = 1;
    ajaxRequest(false);
});

function ajaxRequest(chargerPlus) {
    var categorie = $('#categories');
    var categorieTaxonomie = categorie.attr('id');
    var categorieSelection = categorie.find('option:selected').val();
    var format = $('#format');
    var formatTaxonomie = format.attr('id');
    var formatSelection = format.find('option:selected').val();
    var ordre = $('#ordre').find('option:selected').val();
    $.ajax({
        type: 'POST',
        url: '/wp-admin/admin-ajax.php',
        dataType: 'html',
        data: {
            action: 'filter',
            categorieTaxonomie: categorieTaxonomie,
            categorieSelection: categorieSelection,
            formatTaxonomie: formatTaxonomie,
            formatSelection: formatSelection,
            orderDirection: ordre,
            page: pageActuelle
        },
        success: function(resultat) {
            if (chargerPlus) {
                $('.galerie__photos').append(resultat);
            }
            else {
                $('.galerie__photos').html(resultat);
            }
        },
        error: function(result) {
            console.warn(result);
        }
    });
}



})(jQuery);