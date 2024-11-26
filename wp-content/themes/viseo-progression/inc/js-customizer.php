<?php
/**
 * Progression JS Customizer
 *
 * @package pro
 */

function progression_studios_enqueue_script() {
	
	if ( get_theme_mod( 'progression_studios_blog_pagination', 'default') == 'default' ) {
		
	   wp_add_inline_script( 'progression-plugins', '	
			jQuery(document).ready(function($) { "use strict";
		
				/* Default Isotope Load Code */
				var $container = $(".progression-blog-index-masonry").isotope();
				$container.imagesLoaded( function() {
					$(".progression-masonry-item").addClass("opacity-progression");
					$container.isotope({
						itemSelector: ".progression-masonry-item",				
						percentPosition: true,
						layoutMode: "' . esc_attr(get_theme_mod( "progression_studios_blog_masonry_fit", "fitRows")) . '" 
			 		});
				});
				/* END Default Isotope Code */
		});
		' 
		);

	}
	
	
	if ( get_theme_mod( 'progression_studios_blog_pagination') == 'infinite-scroll' ) {
		
	   wp_add_inline_script( 'progression-plugins', '	
			jQuery(document).ready(function($) { "use strict";
		
				/* Default Isotope Load Code */
				var $container = $(".progression-blog-index-masonry").isotope();
				$container.imagesLoaded( function() {
					$(".progression-masonry-item").addClass("opacity-progression");
					$container.isotope({
						itemSelector: ".progression-masonry-item",				
						percentPosition: true,
						layoutMode: "' . esc_attr(get_theme_mod( "progression_studios_blog_masonry_fit", "fitRows")) . '" 
			 		});
				});
				/* END Default Isotope Code */
				
				
				/* Begin Infinite Scroll */
				$container.infinitescroll({
				  navSelector  : ".infinite-nav-pro",  
				  nextSelector : ".nav-previous a", 
				  itemSelector : ".progression-masonry-item", 
			   		loading: {
			   		 	img: "' . esc_url( get_template_directory_uri() ) . '/images/loader.gif",
			   			 msgText: "",
			   		 	finishedMsg: "<div id=' . "'" . 'no-more-posts' . "'" . '>' . esc_html__( "No more posts", "viseo-progression" ) . '</div>",
			   		 	speed: 0, }
				  },
				  // trigger Isotope as a callback
				  function( newElements ) {
					  
					  !function(a, b) {
					      function c() {
					          function a() {
					              "undefined" != typeof _wpmejsSettings && (c = b.extend(!0, {}, _wpmejsSettings)), c.success = c.success || function(a) {
					                  var b,
					                      c;
					                  "flash" === a.pluginType && (b = a.attributes.autoplay && "false" !== a.attributes.autoplay, c = a.attributes.loop && "false" !== a.attributes.loop, b && a.addEventListener("canplay", function() {
					                      a.play()
					                  }, !1), c && a.addEventListener("ended", function() {
					                      a.play()
					                  }, !1))
					              }, b(".wp-audio-shortcode, .wp-video-shortcode").not(".mejs-container").filter(function() {
					                  return !b(this).parent().hasClass(".mejs-mediaelement")
					              }).mediaelementplayer(c)
					          }
					          var c = {};
					          return {
					              initialize: a
					          }
					      }
					      a.wp = a.wp || {}, mejs.plugins.silverlight[0].types.push("video/x-ms-wmv"), mejs.plugins.silverlight[0].types.push("audio/x-ms-wma"), a.wp.mediaelement = new c, b(a.wp.mediaelement.initialize)
					  }(window, jQuery);

					  
					  
				     $(".progression-studios-gallery").flexslider({
				 		animation: "fade",      
				 		slideDirection: "horizontal", 
				 		slideshow: false,   
				 		smoothHeight: false,
				 		slideshowSpeed: 7000,  
				 		animationSpeed: 1000,        
				 		directionNav: true,             
				 		controlNav: true,
				 		prevText: "",   
				 		nextText: "",
				     });
					  
				    	$(".progression-studios-default-blog-overlay a[data-rel^=\'prettyPhoto\'], .progression-studios-feaured-image a[data-rel^=\'prettyPhoto\']").prettyPhoto({
				  			theme: "pp_default",
				    			hook: "data-rel",
				  			opacity: 0.7,
				    			show_title: false, 
				    			deeplinking: false,
				    			overlay_gallery: false,
				    			custom_markup: "",
				  			default_width: 1100,
				  			default_height: 619,
				    		social_tools:""
				    	});
						
						$(".progression-studios-default-blog-overlay, .progression-studios-default-blog-index").fitVids();

				    var $newElems = $( newElements );
		 	
						$newElems.imagesLoaded(function(){
							
						$container.isotope( "appended", $newElems );
						$(".progression-masonry-item").addClass("opacity-progression");
						
					});

				  }
				);
			    /* END Infinite Scroll */
				
				
		});
		' 
		);

	}
	
	
	if ( get_theme_mod( 'progression_studios_blog_pagination') == 'load-more' ) {
		
	   wp_add_inline_script( 'progression-plugins', '	
			jQuery(document).ready(function($) { "use strict";
		
				/* Default Isotope Load Code */
				var $container = $(".progression-blog-index-masonry").isotope();
				$container.imagesLoaded( function() {
					$(".progression-masonry-item").addClass("opacity-progression");
					$container.isotope({
						itemSelector: ".progression-masonry-item",				
						percentPosition: true,
						layoutMode: "' . esc_attr(get_theme_mod( "progression_studios_blog_masonry_fit", "fitRows")) . '" 
			 		});
				});
				/* END Default Isotope Code */
				
				/* Begin Infinite Scroll */
				$container.infinitescroll({
					errorCallback: function(){  $(".infinite-nav-pro").delay(500).fadeOut(500, function(){ $(this).remove(); }); },
				  navSelector  : ".infinite-nav-pro",  
				  nextSelector : ".nav-previous a", 
				  itemSelector : ".progression-masonry-item", 
			   		loading: {
			   		 	img: "' . esc_url( get_template_directory_uri() ) . '/images/loader.gif",
			   			 msgText: "",
			   		 	finishedMsg: "<div id=' . "'" . 'no-more-posts' . "'" . '>' . esc_html__( "No more posts", "viseo-progression" ) . '</div>",
			   		 	speed: 0, }
				  },
				  // trigger Isotope as a callback
				  function( newElements ) {

					  !function(a, b) {
					      function c() {
					          function a() {
					              "undefined" != typeof _wpmejsSettings && (c = b.extend(!0, {}, _wpmejsSettings)), c.success = c.success || function(a) {
					                  var b,
					                      c;
					                  "flash" === a.pluginType && (b = a.attributes.autoplay && "false" !== a.attributes.autoplay, c = a.attributes.loop && "false" !== a.attributes.loop, b && a.addEventListener("canplay", function() {
					                      a.play()
					                  }, !1), c && a.addEventListener("ended", function() {
					                      a.play()
					                  }, !1))
					              }, b(".wp-audio-shortcode, .wp-video-shortcode").not(".mejs-container").filter(function() {
					                  return !b(this).parent().hasClass(".mejs-mediaelement")
					              }).mediaelementplayer(c)
					          }
					          var c = {};
					          return {
					              initialize: a
					          }
					      }
					      a.wp = a.wp || {}, mejs.plugins.silverlight[0].types.push("video/x-ms-wmv"), mejs.plugins.silverlight[0].types.push("audio/x-ms-wma"), a.wp.mediaelement = new c, b(a.wp.mediaelement.initialize)
					  }(window, jQuery);

					  
					  
				     $(".progression-studios-gallery").flexslider({
				 		animation: "fade",      
				 		slideDirection: "horizontal", 
				 		slideshow: false,   
				 		smoothHeight: false,
				 		slideshowSpeed: 7000,  
				 		animationSpeed: 1000,        
				 		directionNav: true,             
				 		controlNav: true,
				 		prevText: "",   
				 		nextText: "",
				     });
					  
				    	$(".progression-studios-default-blog-overlay a[data-rel^=\'prettyPhoto\'], .progression-studios-feaured-image a[data-rel^=\'prettyPhoto\']").prettyPhoto({
				  			theme: "pp_default",
				    			hook: "data-rel",
				  			opacity: 0.7,
				    			show_title: false, 
				    			deeplinking: false,
				    			overlay_gallery: false,
				    			custom_markup: "",
				  			default_width: 1100,
				  			default_height: 619,
				    		social_tools:""
				    	});
						
						$(".progression-studios-default-blog-overlay, .progression-studios-default-blog-index").fitVids();
					  

				    var $newElems = $( newElements );
		 	
						$newElems.imagesLoaded(function(){
							
						$container.isotope( "appended", $newElems );
						$(".progression-masonry-item").addClass("opacity-progression");
						
					});

				  }
				);
			    /* END Infinite Scroll */
				 
	 			/* PAUSE FOR LOAD MORE */
	 			$(window).unbind(".infscr");
	 			// Resume Infinite Scroll
	 			$(".nav-previous a").click(function(){
	 				$container.infinitescroll("retrieve");
	 				return false;
	 			});
	 			/* End Infinite Scroll */
			
				 
		});
		' 
		);

	}

}
add_action( 'wp_enqueue_scripts', 'progression_studios_enqueue_script' );