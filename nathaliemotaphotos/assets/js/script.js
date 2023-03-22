(function($) {
'use strict';

var modaleOuverte = false;

$('.btn-modale').click(function() {
    $('.modale').css('display', 'block');
    modaleOuverte = true;
});
$('.modale').on('click', function(e) {
    if (e.target != $('.modale__content') && modaleOuverte) {
        $('.modale').css('display', 'none');
        modaleOuverte = false;
    }
});

})(jQuery);