function novaposhtaValidate(evt) {
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode( key );
    var regex = /[0-9]|\./;
    if( !regex.test(key) ) {
        theEvent.returnValue = false;
        if(theEvent.preventDefault) theEvent.preventDefault();
    }
}

$(document).ready(function () {
    $('input[name="default_city_new"]').autocomplete({
        source: "/phpshop/modules/novaposhta/ajax/search_city.php",
        minLength: 2,
        autoFocus: true,
        open: function(event,ui){
            if($(".ui-autocomplete > li").length === 1) {
                $('input[name="default_city_new"]').val( $(".ui-menu-item-wrapper").html() );
                $(".ui-autocomplete").hide();
            } else {
                $(".ui-autocomplete").show();
            }
        }
    });
    $('input[name="city_sender_new"]').autocomplete({
        source: "/phpshop/modules/novaposhta/ajax/search_city.php",
        minLength: 2,
        autoFocus: true,
        open: function(event,ui){
            if($(".ui-autocomplete > li").length === 1) {
                $('input[name="city_sender_new"]').val( $(".ui-menu-item-wrapper").html() );
                $(".ui-autocomplete").hide();
            } else {
                $(".ui-autocomplete").show();
            }
        }
    });
});