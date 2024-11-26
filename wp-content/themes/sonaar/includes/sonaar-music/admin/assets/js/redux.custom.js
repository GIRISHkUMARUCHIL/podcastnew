
jQuery(document).ready(function ($) {

	$('#single_post_default_sidebar, #single_video_default_sidebar, #single_event_default_sidebar, #single_discography_default_sidebar').parents('tr').css('border','none')
	$('#single_post_default_sidebar, #single_video_default_sidebar, #single_event_default_sidebar, #single_discography_default_sidebar').parents('tr').find('th,td').css('padding-bottom', '0')


	$('body.post-new-php.post-type-podcast #acf-field-banner_inherit_setting-1').attr('checked','checked');
});