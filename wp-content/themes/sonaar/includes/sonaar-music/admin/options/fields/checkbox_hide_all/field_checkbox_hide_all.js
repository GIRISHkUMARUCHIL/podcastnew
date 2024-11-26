jQuery(document).ready(function(){
	
	jQuery('.redux-opts-checkbox-hide-all').each(function(){
		if(!jQuery(this).is(':checked')){
			jQuery(this).closest('tr').nextAll('tr:not(.sonaar-redux-unhide)').hide();
		}
	});
	
	jQuery('.redux-opts-checkbox-hide-all').click(function(){
			jQuery(this).closest('tr').nextAll('tr:not(.sonaar-redux-unhide)').fadeToggle('slow');
	});
	
});
