(function($) {
'use strict';



$('.wpcf7-submit').addClass('bouton');

var dureeTransitionPopup = 500;
var modale = document.getElementById('modale-container');
var lightbox = document.getElementById('lightbox-container');
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

$('.btn-plein-ecran').click(function() {
    var image = $(this).parent().parent().prev();
    var urlImage = image.attr('src');
    var creerImage = '<img src="' + urlImage + '" alt="Image agrandie">';
    $('.lightbox__image').html(creerImage);
    transitionPopup($('.lightbox'), 1);
});
btnFermetureLightbox.onclick = function() {
    transitionPopup($('.lightbox'), 0);
}
window.onclick = function(event) {
    if (event.target == lightbox) {
        transitionPopup($('.lightbox'), 0);
    }
}

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
    $.ajax({
        type: 'POST',
        url: '/wp-admin/admin-ajax.php',
        dataType: 'html',
        data: {
          action: 'load_more',
          paged: pageActuelle,
        },
        success: function (result) {
            $('.galerie__photos').append(result);
        }
    });
});

$(document).on('change', '.js-filter-form', function(e) {
    e.preventDefault();
    var choix = $(this).attr('id');
    var selection = $(this).find('option:selected').val();
    console.log(choix);
    console.log(selection);
    
    $.ajax({
        type: 'POST',
        url: '/wp-admin/admin-ajax.php',
        data: {
            action: 'filter',
            nomTaxonomie: choix,
            slugTaxonomie: selection
        },
        success: function(result) {
            $('.galerie__photos').html(result);
        },
        /* error: function(result) {
            console.warn(result);
        } */
    });
});

$(document).on('change', '.js-ordre-form', function(e) {
    //e.preventDefault();
    var ordre = $(this).find('option:selected').val();
    console.log(ordre);
    
    $.ajax({
        type: 'POST',
        url: '/wp-admin/admin-ajax.php',
        data: {
            action: 'order',
            orderDirection: ordre
        },
        success: function(result) {
            $('.galerie__photos').html(result);
        },
        /* error: function(result) {
            console.warn(result);
        } */
    });
});



})(jQuery);