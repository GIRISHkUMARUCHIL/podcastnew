jQuery('.shape-selector-item').click(function() {
    jQuery('.shape-selector-item[selected]').removeAttr('selected');
    jQuery( this ).attr('selected', '');
    jQuery('input[name="separator"]').attr('value',  jQuery( this ).attr('data-value') );
});



function insideout( location) {

    if ( location == 'bottom' ){
        jQuery('.shape-selector').attr('data-location', 'bottom');
    }else{
        jQuery('.shape-selector').attr('data-location', 'top'); 
    }  
             
}
insideout(jQuery('.location option[selected="selected"]').attr('value'));


jQuery('select.location').on('change', function() {
    insideout( this.value );
});
