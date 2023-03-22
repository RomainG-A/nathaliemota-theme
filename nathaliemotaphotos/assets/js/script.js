(function($) {
'use strict';

var modaleOuverte = false;

$('.btn-modale').click(function() {
    if (!modaleOuverte) {
        $('.modale').css('display', 'block');
        modaleOuverte = true;
    }
    else {
        $('.modale').css('display', 'none');
        modaleOuverte = false; 
    }
});
$('main, footer').click(function() {
    if (modaleOuverte) {
        $('.modale').css('display', 'none');
    modaleOuverte = false;
    }
});

})(jQuery);