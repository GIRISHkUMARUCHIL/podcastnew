/* global jQuery */
"use strict";
var iron_parallax = function(){
	var isChrome = ((navigator.userAgent.toLowerCase().indexOf('chrome') > -1) &&(navigator.vendor.toLowerCase().indexOf("google") > -1));
	if ( jQuery(document).width() >= 1024 ) {

		jQuery(document).on('scroll', function() {
			
			var $scrollTop = jQuery(document).scrollTop();
			var $bannerHeight = jQuery('.parallax-banner').height();
			if( $bannerHeight !== null){
				if ($scrollTop < $bannerHeight ) {

					var $bannerFromTop = Math.pow(( ( $bannerHeight - $scrollTop ) / $bannerHeight ), 1.2);
					var $scaleimg = Math.pow(( ( $bannerHeight - $scrollTop ) / $bannerHeight ), -0.1);
					if(isChrome){
						jQuery('.page-banner-bg').velocity({
							scale:$scaleimg,
							translateZ: 0,
						},{ duration: 0 });
					}
					jQuery('.page-banner-content').velocity({
						translateZ: 0,
						translateY: $scrollTop * 0.7+"px",
						opacity: $bannerFromTop
					},{ duration: 0 });

				}
			}

		});

	}
}

jQuery(document).ready(function() {
	iron_parallax()
});