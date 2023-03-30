(function($) {
'use strict';



$('.wpcf7-submit').addClass('bouton');

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

$('.fleche').hover(
    function() {
        $('.preview').css('opacity', '1');
    }, function() {
        $('.preview').css('opacity', '0');
    }
);

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