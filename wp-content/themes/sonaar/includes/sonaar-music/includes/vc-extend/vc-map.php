<?php

function sonaar_row_extras() {
	$params = array(

			array(
				'type'       => 'checkbox',
				'param_name' => 'enable_responsive_options',
				'heading'    => esc_html__( 'Enable Responsive Css Box', 'js_composer' ),
				'description' => esc_html__( 'Will enable small dekstop, tablet and mobile css options', 'js_composer' ),
				'group' => esc_html__( 'Design Options', 'js_composer' ),
				'value'      => array( esc_html__( 'Yes', 'js_composer' ) => 'yes' ),
			),
			array(
				'type'       => 'responsive_css_editor',
				'heading'    => esc_html__( 'Responsive CSS Box', 'js_composer' ),
				'param_name' => 'responsive_css',
				'group'      => esc_html__( 'Responsive Options', 'js_composer' ),
				'dependency' => array(
					'element' => 'enable_responsive_options',
					'not_empty' => true,
					),
			),
			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Use gradient background?', 'js_composer' ),
				'param_name' => 'gradient_bg',
				'description' => esc_html__( 'If checked, gradient color will be used as row background color.', 'js_composer' ),
				'value' => array( esc_html__( 'Yes', 'js_composer' ) => 'yes' ),
				'group' => esc_html__( 'Design Options', 'js_composer' ),
			),
			array(
				'type' => 'gradient',
				'heading' => esc_html__( 'Gradient Picker', 'js_composer' ),
				'param_name' => 'gradient_bg_color',
				'description' => esc_html__( 'Set gradient color', 'js_composer' ),
				'dependency' => array(
					'element' => 'gradient_bg',
					'not_empty' => true,
				),
				'group' => esc_html__( 'Design Options', 'js_composer' ),
			),
			
	);

	vc_add_params( 'vc_row', $params );
}
sonaar_row_extras();

function sonaar_columns_extras() {
	$params = array(

			array(
					'type'        => 'checkbox',
					'param_name'  => 'enable_responsive_options',
					'heading'     => esc_html__( 'Enable Responsive Css Box', 'js_composer' ),
					'description' => esc_html__( 'Will enable small dekstop, tablet and mobile css options', 'js_composer' ),
					'value'       => array( esc_html__( 'Yes', 'js_composer' ) => 'yes' ),
					'group'       => esc_html__( 'Design Options', 'js_composer' ),
				),

				array(
					'type'        => 'responsive_css_editor',
					'heading'     => esc_html__( 'Responsive CSS box', 'js_composer' ),
					'param_name'  => 'responsive_css',
					'group'       => esc_html__( 'Design Options', 'js_composer' ),
					'dependency'  => array(
						'element' => 'enable_responsive_options',
						'not_empty' => true,
				),
				),
				array(
					'type'        => 'responsive_alignment',
					'param_name'  => 'align',
					'heading'     => esc_html__( 'Text align', 'js_composer' ),
					'description' => esc_html__( 'Text alignment inside the column', 'js_composer' ),
			),
	);

	vc_add_params( 'vc_column', $params );
	vc_add_params( 'vc_column_inner', $params );
}
sonaar_columns_extras();


function sonaar_background_position_params() {

	$params = array(

		array(
			'type' => 'dropdown',
			'param_name' => 'bg_position',
			'heading' => esc_html__( 'Background Position', 'js_composer' ),
			'value' => array(
				esc_html__( 'Default', 'js_composer' )         => '',
				esc_html__( 'Center Bottom', 'js_composer' )   => 'center bottom',
				esc_html__( 'Center Center', 'js_composer' )   => 'center center',
				esc_html__( 'Center Top', 'js_composer' )      => 'center top',
				esc_html__( 'Left Bottom', 'js_composer' )     => 'left bottom',
				esc_html__( 'Left Center', 'js_composer' )     => 'left center',
				esc_html__( 'Left Top', 'js_composer' )        => 'left top',
				esc_html__( 'Right Bottom', 'js_composer' )    => 'right bottom',
				esc_html__( 'Right Center', 'js_composer' )    => 'right center',
				esc_html__( 'Right Top', 'js_composer' )       => 'right top',
				esc_html__( 'Custom Position', 'js_composer' ) => 'custom',
			),
			'group' => esc_html__( 'Design Options', 'js_composer' ),
		),

		array(
			'type'             => 'textfield',
			'param_name'       => 'bg_pos_h',
			'heading'          => esc_html__( 'Horizontal Position', 'js_composer' ),
			'description'      => esc_html__( 'Enter custom horizontal position in px or %', 'js_composer' ),
			'group'            => esc_html__( 'Design Options', 'js_composer' ),
			'edit_field_class' => 'vc_col-sm-6',
			'dependency'  => array(
				'element' => 'bg_position',
				'value'   => 'custom'
			)
		),

		array(
			'type'             => 'textfield',
			'param_name'       => 'bg_pos_v',
			'heading'          => esc_html__( 'Vertical Position', 'js_composer' ),
			'description'      => esc_html__( 'Enter custom vertical position in px or %', 'js_composer' ),
			'group'            => esc_html__( 'Design Options', 'js_composer' ),
			'edit_field_class' => 'vc_col-sm-6',
			'dependency'  => array(
				'element' => 'bg_position',
				'value'   => 'custom'
			)
		),

		array(
			'type'        => 'textfield',
			'param_name'  => 'zindex',
			'heading'     => esc_html__( 'Z-index', 'js_composer' ),
			'description' => esc_html__( 'Add z-index for this element', 'js_composer' ),
		),

	);
	vc_add_params( 'vc_row', $params );
	vc_add_params( 'vc_row_inner', $params );
	vc_add_params( 'vc_column', $params );
	vc_add_params( 'vc_column_inner', $params );

}
sonaar_background_position_params();

	function iron_register_js_composer() {

		global $wpdb;

		require_once(IRON_MUSIC_DIR_PATH."admin/options/fields/fontawesome/field_fontawesome.php");
		$fontawesome = new Redux_Options_fontawesome(array('id'=>'fontawsome_vc_icons'), '', null);
		$font_icons = $fontawesome->icons;


function sonaar_extends_vc_custom_heading() {

	$params = array(

		array(
			'type'        => 'textfield',
			'param_name'  => 'letter_spacing',
			'heading'     => esc_html__( 'Letter Spacing', 'js_composer' ),
			'description' => esc_html__( 'Add letter spacing. eg: 2px', 'js_composer' ),
		),
		array(
			'type'       => 'checkbox',
			'param_name' => 'enable_fittext',
			'heading'    => esc_html__( 'Enable fitText', 'js_composer' ),
			'value'      => array( esc_html__( 'Yes', 'js_composer' ) => 'yes' ),
			'description' => esc_html__( 'Text will automagically resize to fit the width of the device', 'js_composer' ),
		),
		array(
			'type'        => 'textfield',
			'param_name'  => 'fittex_size',
			'heading'     => esc_html__( 'fitText Max Font Size', 'js_composer' ),
			'description' => esc_html__( 'The max font size that your text can go. ex. 75px', 'js_composer' ),
			'dependency'  => array(
				'element'   => 'enable_fittext',
				'not_empty' => true
			),
		),
		array(
			'type'       => 'checkbox',
			'param_name' => 'inline_block_display',
			'heading'    => esc_html__( 'Enable inline-block display', 'js_composer' ),
			'value'      => array( esc_html__( 'Yes', 'js_composer' ) => 'yes' ),
			'description' => esc_html__( 'Inline-block is useful if you want to apply a border or background to fit the heading.', 'js_composer' ),
		),

	);

	vc_add_params( 'vc_custom_heading', $params );
}
sonaar_extends_vc_custom_heading();


		vc_add_params('vc_single_image', array(
			array(
	            'type' => 'dropdown',
	            'heading' => esc_html__( 'Force Full Width', 'js_composer' ),
	            'param_name' => 'img_fullwidth',
				'value' => array(
					esc_html_x("No", 'VC', 'sonaar')=> 0,
					esc_html_x("Yes", 'VC', 'sonaar')=> "img_fullwidth",
				),
				'save_always' => true,
			),
        ));

        vc_add_params('vc_btn',array(
        	array(
				"type" => "post_multiselect",
				"post_type" => "album",

				"class" => "",
				"heading" => esc_html_x("Choose an album", 'VC', 'sonaar'),
				"param_name" => "albums",
				"value" => '',
				"description" => esc_html_x("Which album do you want to play when user clicks on your button ?", 'VC', 'sonaar'),
				'dependency' => array(
					'element' => 'custom_onclick',
					'not_empty' => true,
					),
		    	)
			)
		);

		vc_map( array(
		   "name" => esc_html_x("Music Player", 'VC', 'sonaar'),
		   "base" => "iron_audioplayer",
		   "class" => "",
		   "icon" => "iron_vc_icon_audio_player",
		   "category" => esc_html_x('IRON Widgets', 'VC', 'sonaar'),
		   "params" => array(
		   	  array(
		         "type" => "textfield",
		         "holder" => "div",
		         "class" => "",
		         "heading" => esc_html_x("Title of your Playlist", 'VC', 'sonaar'),
		         "param_name" => "title",
		         "value" => "",
		         "description" => '',
			  ),
			  array(
				"type" => "dropdown",
				//
				"class" => "",
				"heading" => esc_html_x("Play Last Published Playlist", 'VC', 'sonaar'),
				"param_name" => "play-latest",
				"value" => array(
				   esc_html_x("No", 'VC', 'sonaar')=> 'no',
				   esc_html_x("Yes", 'VC', 'sonaar')=> 'yes',
				 ),
				"description" => '',
				'save_always' => true,
			 ),
		      array(
		         "type" => "post_multiselect",
		         "post_type" => "album",
		         //
		         //"class" => "",
		         "admin_label" => true,
		         "heading" => esc_html_x("Albums", 'VC', 'sonaar'),
		         "param_name" => "albums",
		         "value" => '',
				 "description" => '',
				 "dependency" => array(
		        	"element" => 'play-latest',
		        	"value" => 'no'
		         )

			  ),
		      array(
		         "type" => "dropdown",
		         //
		         "class" => "",
		         "heading" => esc_html_x("Auto Play", 'VC', 'sonaar'),
		         "param_name" => "autoplay",
		         "value" => array(
	                esc_html_x("No", 'VC', 'sonaar')=> 0,
	                esc_html_x("Yes", 'VC', 'sonaar')=> 1,
	              ),
		         "description" => '',
		         'save_always' => true,
			  ),
			  array(
				"type" => "dropdown",
				//
				"class" => "",
				"heading" => esc_html_x("shuffle", 'VC', 'sonaar'),
				"param_name" => "shuffle",
				"value" => array(
				   esc_html_x("No", 'VC', 'sonaar')=> 0,
				   esc_html_x("Yes", 'VC', 'sonaar')=> 1,
				 ),
				"description" => '',
				'save_always' => true,
			 ),
		      array(
		         "type" => "dropdown",
		         //
		         "class" => "",
		         "heading" => esc_html_x("Show Playlist", 'VC', 'sonaar'),
		         "param_name" => "show_playlist",
		         "value" => array(
	                esc_html_x("No", 'VC', 'sonaar')=> 0,
	                esc_html_x("Yes", 'VC', 'sonaar')=> 1,
	              ),
		         "description" => '',
		         'save_always' => true,
		      ),
		      array(
		         "type" => "dropdown",
		         //
		         "class" => "",
		         "heading" => esc_html_x("Show album store", 'VC', 'sonaar'),
		         "param_name" => "show_album_market",
		         "value" => array(
	                esc_html_x("No", 'VC', 'sonaar')=> 0,
	                esc_html_x("Yes", 'VC', 'sonaar')=> 1,
	              ),
		         "description" => '',
		         'save_always' => true,
					),
					array(
						"type" => "dropdown",
						//
						"class" => "",
						"heading" => esc_html_x("Show Soundwave", 'VC', 'sonaar'),
						"param_name" => "show_soundwave",
						"value" => array(
								 esc_html_x("No", 'VC', 'sonaar')=> 0,
								 esc_html_x("Yes", 'VC', 'sonaar')=> 1,
							 ),
						"description" => '',
						'save_always' => true,
				 ),
		      vc_map_add_css_animation(),

		   )

		));




		vc_map( array(
		   "name" => esc_html_x("Grid", 'VC', 'sonaar'),
		   "base" => "iron_grid",
		   "class" => "",
		   "icon" => "iron_vc_icon_discography",
		   "category" => esc_html_x('IRON Widgets', 'VC', 'sonaar'),
		   "params" => array(
		   	  array(
		         "type" => "dropdown",
		         "class" => "",
		         "heading" => esc_html_x("Grid type", 'VC', 'sonaar'),
		         "admin_label" => true,
		         "param_name" => "grip_post_type",
				 "value" => array(
	                esc_html_x("Artists", 'VC', 'sonaar') => 'artist',
					esc_html_x("Playlists", 'VC', 'sonaar') => 'album'
	              ),
		         "description" => '',
		         'save_always' => true,
		      ),
		      array(
		         "type" => "dropdown",
		         "class" => "",
		         "heading" => esc_html_x("Display Grid for:", 'VC', 'sonaar'),
		         "param_name" => "grid_filter_artists",
				 			"value" => array(
	                esc_html_x("All Artists", 'VC', 'sonaar') => '',
									esc_html_x("Choose Specific Artist(s)...", 'VC', 'sonaar') => 'yes'
	              ),
		         "description" => '',
		         'save_always' => true,
		      ),
		      array(
		         "type" => "post_multiselect",
		         "post_type" => "artist",

		         "class" => "",
		         "heading" => esc_html_x("Filter by Artists", 'VC', 'sonaar'),
		         "param_name" => "artists_filter",
		         "description" => '',
		         "value" => 'null',
		         "dependency" => array(
		        	"element" => 'grid_filter_artists',
		        	"value" => 'yes'
		         )
		      ),
		      array(
		         "type" => "dropdown",

		         "class" => "",
		         "heading" => esc_html_x("Display Grid for:", 'VC', 'sonaar'),
		         "param_name" => "grid_filter_albums",
				 "value" => array(
	                esc_html_x("All Albums", 'VC', 'sonaar') => '',
					esc_html_x("Choose Specific Album(s)...", 'VC', 'sonaar') => 'yes'
	              ),
		         "description" => '',
		         'save_always' => true,
		         "dependency" => array(
		        	"element" => 'grip_post_type',
		        	"value" => 'album',
		         )
		      ),
		       array(
		         "type" => "post_multiselect",
		         "post_type" => "album",

		         "class" => "",
		         "heading" => esc_html_x("Albums", 'VC', 'sonaar'),
		         "param_name" => "albums",
		         "description" => '',
		         "value" => 'null',
		         "dependency" => array(
		        	"element" => 'grid_filter_albums',
		        	"value" => 'yes'
		        	// "not_empty" => true
		         )
		      ),
		      array(
				'type' => 'dropdown',
				'heading' => esc_html_x( 'Number of column', 'VC', 'sonaar' ),

				'param_name' => 'column',
				'value' => array(
	                esc_html_x("3 columns", 'VC', 'sonaar') => 3,
					esc_html_x("2 columns", 'VC', 'sonaar') => 2,
				),
				'save_always' => true,
			  ),
		      array(
				'type' => 'dropdown',
				'heading' => esc_html_x( 'Parallax', 'VC', 'sonaar' ),

				'param_name' => 'parallax',
				'value' => array(
	                esc_html_x("Enable", 'VC', 'sonaar') => 'yes',
					esc_html_x("Disable", 'VC', 'sonaar') => 0,
				),
				'save_always' => true,
			  ),
		      array(
		         "type" => "textfield",

		         "class" => "",
		         "heading" => esc_html_x('Speed of columns', 'VC', 'sonaar'),
		         "param_name" => "parallax_speed",
		         "value" => '2,-2,1',
		         "description" => esc_html_x('Adjust the speed of the parallax of each column by entering a value separated by a comma. Negative values accepted. (default value: 2,-2,1)', 'VC', 'sonaar'),
  				 "dependency" => array(
		        	"element" => 'parallax',
		        	'value' => 'yes',
					// 'not_empty' => true

		         ),
  				 'save_always' => true,

		    	),
		    	array(
					'type' => 'el_id',
					'heading' => esc_html_x( 'Element ID', 'VC', 'sonaar' ),
					'param_name' => 'el_id',
					'description' => esc_html_x( 'Enter element ID (Note: make sure it is unique and valid according to w3c specification).', 'VC', 'sonaar' ),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html_x( 'Extra class name', 'VC', 'sonaar' ),
					'param_name' => 'el_class',
					'description' => esc_html_x( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'VC', 'sonaar' ),
				),



		   )

		));

		vc_map( array(
		   "name" => esc_html_x("External Audio Player", 'VC', 'sonaar'),
		   "base" => "iron_soundcloud",
		   "class" => "",
		   "description"=> esc_html_x("Embed music from another platform", 'VC', 'sonaar'),
		   "icon" => "iron_vc_icon_external_audio_player",
		   "category" => esc_html_x('IRON Widgets', 'VC', 'sonaar'),
		   "params" => array(
		      array(
		         "type" => "textfield",

		         "class" => "",
		         "heading" => esc_html_x("Tracks/Playlist Url", 'VC', 'sonaar'),
		         "param_name" => "url",
		         "value" => '',
		         "description" => '',
		         'admin_label' => true,
		      ),
		      array(
		         "type" => "textfield",

		         "class" => "",
		         "heading" => esc_html_x("Width", 'VC', 'sonaar'),
		         "param_name" => "width",
		         "value" => false,
		         "description" => '',
		      ),
		      array(
		         "type" => "textfield",

		         "class" => "",
		         "heading" => esc_html_x("Height", 'VC', 'sonaar'),
		         "param_name" => "height",
		         "value" => false,
		         "description" => '',
		      ),
		      //vc_map_add_css_animation(),

		   )

		));



		vc_map( array(
		   "name" => esc_html_x("Videos", 'VC', 'sonaar'),
		   "base" => "iron_recentvideos",
		   "class" => "",
		   "icon" => "iron_vc_icon_videos",
		   "category" => esc_html_x('IRON Widgets', 'VC', 'sonaar'),
		   "params" => array(
		      array(
		         "type" => "textfield",

		         "class" => "",
		         "heading" => esc_html_x("Number of videos to show (*apply only for categories):", 'VC', 'sonaar'),
		         "param_name" => "number",
		         "value" => '',
		         "description" => '',
		      ),
		      array(
		         "type" => "taxonomy_multiselect",
		         "taxonomy" => "video-category",

		         "class" => "",
		         "heading" => esc_html_x("Select one or multiple categories", 'VC', 'sonaar'),
		         "param_name" => "category",
		         "description" => '',
		      ),
		      array(
		         "type" => "post_multiselect",
		         "post_type" => "video",
		         "class" => "",
		         "heading" => esc_html_x("Videos", 'VC', 'sonaar'),
		         "param_name" => "include",
		         "admin_label" => true,
		         "description" => '',
		      ),
		      array(
		         "type" => "post_multiselect",
		         "post_type" => "artist",

		         "class" => "",
		         "heading" => esc_html_x("Filter by Artists", 'VC', 'sonaar'),
		         "param_name" => "artists_filter",
		         "description" => '',
		      ),
		      vc_map_add_css_animation(),
		   )

		));


		vc_map( array(
		   "name" => esc_html_x("Events", 'VC', 'sonaar'),
		   "base" => "iron_events",
		   "class" => "",
		   "icon" => "iron_vc_icon_events",
		   "category" => esc_html_x('IRON Widgets', 'VC', 'sonaar'),
		   "params" => array(
		      array(
		         "type" => "textfield",

		         "class" => "",
		         "heading" => esc_html_x("Number of events to show", 'VC', 'sonaar'),
		         "param_name" => "number",
		         "value" => '',
		         "description" => '',
		      ),
		      array(
		         "type" => "dropdown",

		         "class" => "",
		         "heading" => esc_html_x("Display by", 'VC', 'sonaar'),
		         "param_name" => "filter",
		         'admin_label' => true,
				 "value" => array(
	                esc_html_x("Upcoming Events", 'VC', 'sonaar')=> 'upcoming',
					esc_html_x("Past Events", 'VC', 'sonaar') => 'past'
	              ),
		         "description" => '',
		         'save_always' => true,
		      ),
		      array(
		         "type" => "dropdown",

		         "class" => "",
		         "heading" => esc_html_x("Display Events for:", 'VC', 'sonaar'),
		         "param_name" => "events_for",
				 "value" => array(
	                esc_html_x("Show All", 'VC', 'sonaar') => '',
					esc_html_x("Choose Specific Artist(s)...", 'VC', 'sonaar') => 'yes'
	              ),
		         "description" => '',
		         'save_always' => true,
		      ),
		      array(
		         "type" => "post_multiselect",
		         "post_type" => "artist",

		         "class" => "",
		         "heading" => esc_html_x("Select One or Multiple Artist(s)", 'VC', 'sonaar'),
		         "param_name" => "artists_filter",
		         "description" => '',
		         "value" => 'null',
		         "dependency" => array(
		        	"element" => 'events_for',
		        	"value" => 'yes'
		        	// "not_empty" => true
		         )

		      ),
		      array(
		         "type" => "dropdown",

		         "class" => "",
		         "heading" => esc_html_x("Enable Artist Dropdown Filter on the front-end ", 'VC', 'sonaar'),
		         "param_name" => "enable_artists_filter",
				 "value" => array(
	                esc_html_x("No", 'VC', 'sonaar')=> '',
					esc_html_x("Yes", 'VC', 'sonaar') => 'yes'
	              ),
		         "description" => '',
		         'save_always' => true,
		      ),
		      vc_map_add_css_animation(),
		   )

		));

		vc_map( array(
			"name" => esc_html_x("BandsInTown", 'VC', 'sonaar'),
			"base" => "iron_bandsintown",
			"class" => "",
			"icon" => "iron_vc_icon_events",
			"category" => esc_html_x('IRON Widgets', 'VC', 'sonaar'),
			"params" => array(
				 array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html_x("Bandsintown Artist Name", 'VC', 'sonaar'),
						"param_name" => "band_name",
						"admin_label" => true,
						"value" => 'swans',
						"description" => '',
				 ),
				 array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => esc_html_x("Text Color", 'VC', 'sonaar'),
						"param_name" => "text_color",
						"value" => '#000000',
						"description" => '',
				 ),
				 array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => esc_html_x("Background Color", 'VC', 'sonaar'),
						"param_name" => "background_color",
						"value" => '#FFFFFF',
						"description" => '',
				 ),
				 array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => esc_html_x("Button and Link Color", 'VC', 'sonaar'),
						"param_name" => "button_color",
						"value" => '#2F95DE',
						"description" => '',
				 ),
				 array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => esc_html_x("Link Text Color", 'VC', 'sonaar'),
						"param_name" => "button_txt_color",
						"value" => '#FFFFFF',
						"description" => '',
				 ),
				 array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => esc_html_x("Link Text Color", 'VC', 'sonaar'),
						"param_name" => "button_txt_color",
						"value" => '#FFFFFF',
						"description" => '',
				 ),
				 array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html_x("Display Local Dates", 'VC', 'sonaar'),
						"param_name" => "local_dates",
						"value" => array(
							esc_html_x("No", 'VC', 'sonaar')=> false,
							esc_html_x("Yes", 'VC', 'sonaar') => true
						),
						"description" => '',
						'save_always' => true,
				 ),
				 array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html_x("Display Past Dates", 'VC', 'sonaar'),
						"param_name" => "past_dates",
						"value" => array(
							esc_html_x("Yes", 'VC', 'sonaar') => true,
							esc_html_x("No", 'VC', 'sonaar')=> false
						),
						"description" => '',
						'save_always' => true,
				 ),
				 array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html_x("Number of events", 'VC', 'sonaar'),
						"param_name" => "display_limit",
						"value" => array(
							5,10,15,20,25,30,35,40,45,50
						),
						"description" => '',
						'save_always' => true,
				 )
			)

	 ));

		if (function_exists('is_plugin_active') && is_plugin_active('nmedia-mailchimp-widget/nm_mailchimp.php')) {

			$results = $wpdb->get_results('SELECT form_id, form_name FROM '.$wpdb->prefix.'nm_mc_forms ORDER BY form_name');
			$newsletters = array();
			foreach($results as $result) {

				$name = !empty($result->form_name) ? $result->form_name : $result->form_id;
				$id = $result->form_id;

				$newsletters[$name] = $id;
			}

			vc_map( array(
			   "name" => esc_html_x("Newsletter", 'VC', 'sonaar'),
			   "base" => "iron_newsletter",
			   "class" => "",
			   "icon" => "iron_vc_icon_newsletter",
			   "category" => esc_html_x('IRON Widgets', 'VC', 'sonaar'),
			   "params" => array(
			      array(
			         "type" => "textfield",

			         "class" => "",
			         "heading" => esc_html_x("Title", 'VC', 'sonaar'),
			         "param_name" => "title",
			         "value" => esc_html_x("", 'VC', 'sonaar'),
			         "description" => '',
			      ),
			      array(
			         "type" => "textarea",

			         "class" => "",
			         "heading" => esc_html_x("Description", 'VC', 'sonaar'),
			         "param_name" => "description",
			         "value" => esc_html_x("", 'VC', 'sonaar'),
			         "description" => '',
			      ),
			      array(
			         "type" => "dropdown",

			         "class" => "",
			         "heading" => esc_html_x("Newsletters", 'VC', 'sonaar'),
			         "param_name" => "fid",
					 "value" => $newsletters,
			         "description" => '',
			         'save_always' => true,
			      ),
			      vc_map_add_css_animation(),
			   )

			));

		}

		vc_map( array(
			"name" => esc_html_x("Promotion", 'VC', 'sonaar'),
			"base" => "iron_promotion",
			"class" => "",
			"icon" => "iron_vc_icon_promobox",
			"category" => esc_html_x('IRON Widgets', 'VC', 'sonaar'),
			"params" => array(
				array(
					"param_name" => "image",
					"type" => "attach_image",
					"heading" => esc_html_x('Image', 'VC', 'sonaar'),
					"description" => '',
				),
				array(
					"heading" => esc_html_x('Title', 'VC', 'sonaar'),
					"param_name" => "title",
					"type" => "textarea",
					"admin_label" => true,
					"class" => "",
					"value" => "",
					"description" => '',
				),
		        array(
		          "param_name" => "title_tag_name",
		          "type" => "dropdown",
		          "heading" => esc_html_x("Title Tag Name", 'VC', 'sonaar'),
		          "value" => array(
		              "h3" => "h3",
		              "h2" => "h2",
		              "h4" => "h4",
		              "h5" => "h5",
		              "h6" => "h6",
					  "h1" => "h1",
					  "div"  => "div"
		          ),
		          'save_always' => true,
				),
				array(
			      "param_name" => "title_color",
			      "type" => "colorpicker",
			      "heading" => esc_html_x('Title Color', 'VC', 'sonaar'),
			      "description" => '',
			      "value" => "",
			    ),
				array(
					"param_name" => "subtitle",
					"type" => "textarea",

					"class" => "",
					"heading" => esc_html_x('Subtitle', 'VC', 'sonaar'),
					"value" => "",
					"description" => '',
				),
		        array(
		          "param_name" => "subtitle_tag_name",
		          "type" => "dropdown",
		          "heading" => esc_html_x("Subtitle Tag Name", 'VC', 'sonaar'),
		          "value" => array(
		              "h3" => "h3",
		              "h2" => "h2",
		              "h4" => "h4",
		              "h5" => "h5",
		              "h6" => "h6",
					  "h1" => "h1",
					  "div"  => "div"
		          ),
		          'save_always' => true,
				),
				array(
			      "param_name" => "subtitle_color",
			      "type" => "colorpicker",
			      "heading" => esc_html_x('Subtitle Color', 'VC', 'sonaar'),
			      "description" => '',
			      "value" => "",
			    ),
				array(
			      "param_name" => "title_align",
			      "type" => "dropdown",
			      "heading" => esc_html_x('Title Align', 'VC', 'sonaar'),
			      "value" => array(
							esc_html_x('Left', 'VC', 'sonaar') => 'left',
							esc_html_x('Center', 'VC', 'sonaar') => 'center',
							esc_html_x('Right', 'VC', 'sonaar') => 'right',
						),
			    ),
				array(
					"param_name" => "line_height",
					"type" => "textfield",

					"class" => "",
					"heading" => esc_html_x('Line height', 'VC', 'sonaar'),
					"value" => "",
					"description" => '',
				),
			    array(
			      "param_name" => "overlay_color",
			      "type" => "colorpicker",
			      "heading" => esc_html_x('Overlay Color', 'VC', 'sonaar'),
			      "description" => '',
			      "value" => "rgb(0,0,0)",
			    ),
				array(
					"param_name" => "link_page",
					"type" => "post_select",
					"post_type" => "page",

					"class" => "",
					"heading" => esc_html_x("Link Page", 'VC', 'sonaar'),
					"value" => '',
					"description" => ''
				),
				array(
					"param_name" => "link_product",
					"type" => "post_select",
					"post_type" => "product",

					"class" => "",
					"heading" => esc_html_x("Link Product", 'VC', 'sonaar'),
					"value" => '',
					"description" => ''
				),
				array(
					"param_name" => "link_external",
					"type" => "textfield",

					"class" => "",
					"heading" => esc_html_x("Link External", 'VC', 'sonaar'),
					"value" => '',
					"description" => '',
				),
				array(
			      "param_name" => "hover_animation",
			      "type" => "dropdown",
			      "heading" => esc_html_x('Hover Animation', 'VC', 'sonaar'),
			      "value" => array(
							esc_html_x('Slide', 'VC', 'sonaar') => 'slide',
							esc_html_x('Zoom', 'VC', 'sonaar') => 'zoom',
						),
			    ),
				vc_map_add_css_animation(),
			)
		));

		vc_map( array(
			"name" => esc_html_x("Image Divider", 'VC', 'sonaar'),
			"base" => "iron_image_divider",
			"class" => "",
			"icon" => "iron_vc_icon_imagedivider",
			"category" => esc_html_x('IRON Widgets', 'VC', 'sonaar'),
			"params" => array(
				array(
					"param_name" => "divider_image",
					"type" => "attach_image",
					"heading" => esc_html_x('Divider Image', 'VC', 'sonaar'),
					"admin_label" => true,
					"description" => ''
				),
		    array(
		      "param_name" => "divider_color",
		      "type" => "colorpicker",
		      "heading" => esc_html_x('Divider Color', 'VC', 'sonaar'),
		      "description" => 'If no image chosen, the default css divider will be used',
		    ),
		    array(
		      "param_name" => "divider_align",
		      "type" => "dropdown",
		      "heading" => esc_html_x('Divider Align', 'VC', 'sonaar'),
		      "value" => array(
						esc_html_x('Left', 'VC', 'sonaar') => 'left',
						esc_html_x('Center', 'VC', 'sonaar') => 'center',
						esc_html_x('Right', 'VC', 'sonaar') => 'right',
					),
				'save_always' => true,
		    ),
				array(
					"param_name" => "divider_padding_top",
					"type" => "textfield",

					"class" => "",
					"heading" => esc_html_x('Divider Padding Top', 'VC', 'sonaar'),
					"value" => "",
					"description" => '',
				),
				array(
					"param_name" => "divider_padding_bottom",
					"type" => "textfield",

					"class" => "",
					"heading" => esc_html_x('Divider Padding Bottom', 'VC', 'sonaar'),
					"value" => "",
					"description" => '',
				),
			)
		));

		vc_map( array(
			"name" => esc_html_x("Countdown", 'VC', 'sonaar'),
			"base" => "iron_countdown",
			"class" => "",
			"icon" => "iron_vc_icon_countdown",
			"category" => esc_html_x('IRON Widgets', 'VC', 'sonaar'),
			"params" => array(

				array(
					"param_name" => "end_time",
					"type" => "textfield",

					"class" => "datetimepicker",
					"heading" => esc_html_x('End Time', 'VC', 'sonaar'),
					"value" => "",
					"description" => '',
					"group" => esc_html_x('General', 'VC', 'sonaar'),
					'admin_label' => true,

				),
				array(
					"param_name" => "show_months",
					"type" => "dropdown",

					"class" => "",
					"heading" => esc_html_x('Show Months', 'VC', 'sonaar'),
					"value" => array(
						esc_html_x("No", 'VC', 'sonaar')=> 0,
						esc_html_x("Yes", 'VC', 'sonaar')=> 1,
					),
					"description" => '',
					"group" => esc_html_x('General', 'VC', 'sonaar'),
					'save_always' => true,
				),
				array(
					"param_name" => "show_days",
					"type" => "dropdown",

					"class" => "",
					"heading" => esc_html_x('Show Days', 'VC', 'sonaar'),
					"value" => array(
						esc_html_x("No", 'VC', 'sonaar')=> 0,
						esc_html_x("Yes", 'VC', 'sonaar')=> 1,
					),
					"description" => '',
					"group" => esc_html_x('General', 'VC', 'sonaar'),
					'save_always' => true,
				),
				array(
					"param_name" => "show_hours",
					"type" => "dropdown",

					"class" => "",
					"heading" => esc_html_x('Show Hours', 'VC', 'sonaar'),
					"value" => array(
						esc_html_x("No", 'VC', 'sonaar')=> 0,
						esc_html_x("Yes", 'VC', 'sonaar')=> 1,
					),
					"description" => '',
					"group" => esc_html_x('General', 'VC', 'sonaar'),
					'save_always' => true,
				),
				array(
					"param_name" => "show_minutes",
					"type" => "dropdown",

					"class" => "",
					"heading" => esc_html_x('Show Minutes', 'VC', 'sonaar'),
					"value" => array(
						esc_html_x("No", 'VC', 'sonaar')=> 0,
						esc_html_x("Yes", 'VC', 'sonaar')=> 1,
					),
					"description" => '',
					"group" => esc_html_x('General', 'VC', 'sonaar'),
					'save_always' => true,
				),
				array(
					"param_name" => "show_seconds",
					"type" => "dropdown",

					"class" => "",
					"heading" => esc_html_x('Show Seconds', 'VC', 'sonaar'),
					"value" => array(
						esc_html_x("No", 'VC', 'sonaar')=> 0,
						esc_html_x("Yes", 'VC', 'sonaar')=> 1,
					),
					"description" => '',
					"group" => esc_html_x('General', 'VC', 'sonaar'),
					'save_always' => true,
				),
				array(
					"param_name" => "show_labels",
					"type" => "dropdown",

					"class" => "",
					"heading" => esc_html_x('Show labels under countdown', 'VC', 'sonaar'),
					"value" => array(
						esc_html_x("No", 'VC', 'sonaar')=> 0,
						esc_html_x("Yes", 'VC', 'sonaar')=> 1,
					),
					"description" => '',
					"group" => esc_html_x('General', 'VC', 'sonaar'),
					'save_always' => true,
				),
/*
				array(
					"param_name" => "character_separator",
					"type" => "textfield",

					"class" => "",
					"heading" => esc_html_x('Character separator', 'VC', 'sonaar'),
					"value" => "",
					"description" => 'eg.: : \ - / _',
					"group" => esc_html_x('General', 'VC', 'sonaar'),
				),
*/
				array(
					"param_name" => "numbers_font",
					"type" => "google_fonts",

					"class" => "",
					"heading" => esc_html_x('Numbers Font Style', 'VC', 'sonaar'),
					"value" => "",
					"description" => '',
					"group" => esc_html_x('Design', 'VC', 'sonaar'),
				),
				array(
					"param_name" => "labels_font",
					"type" => "google_fonts",

					"class" => "",
					"heading" => esc_html_x('Labels Font Style', 'VC', 'sonaar'),
					"value" => "",
					"description" => '',
					"group" => esc_html_x('Design', 'VC', 'sonaar'),
				),
				array(
			      "type" => "colorpicker",
				  "heading" => esc_html_x("Font Color", 'VC', 'sonaar'),
			      "param_name" => "count_color",
			      "description" => '',
				  "value" => "#000",
				  "group" => esc_html_x('Design', 'VC', 'sonaar'),
			    ),
				array(
					"param_name" => "count_splitter",
					"type" => "textfield",

					"class" => "",
					"heading" => esc_html_x('Countdown Separator', 'VC', 'sonaar'),
					"value" => "",
					"description" => '(Examples: ":" "/" or "-")',
					"group" => esc_html_x('Design', 'VC', 'sonaar'),
				),
				array(
					"param_name" => "labels_align",
					"type" => "dropdown",

					"class" => "",
					"heading" => esc_html_x('Align labels', 'VC', 'sonaar'),
					"value" => array(
						esc_html_x("Left", 'VC', 'sonaar')=> 'left',
						esc_html_x("Center", 'VC', 'sonaar')=> 'center',
						esc_html_x("Right", 'VC', 'sonaar')=> 'right',
					),
					"description" => '',
					"group" => esc_html_x('Design', 'VC', 'sonaar'),
					'save_always' => true,

				),


				array(
					"param_name" => "numbers_font_size",
					"type" => "textfield",

					"class" => "",
					"heading" => esc_html_x('Numbers Font Size (px)', 'VC', 'sonaar'),
					"value" => "",
					"description" => '',
					"group" => esc_html_x('Desktop', 'VC', 'sonaar'),
				),
				array(
					"param_name" => "numbers_line_height",
					"type" => "textfield",

					"class" => "",
					"heading" => esc_html_x('Numbers Line Height (px)', 'VC', 'sonaar'),
					"value" => "",
					"description" => '',
					"group" => esc_html_x('Desktop', 'VC', 'sonaar'),
				),
				array(
					"param_name" => "numbers_letter_spacing",
					"type" => "textfield",

					"class" => "",
					"heading" => esc_html_x('Numbers Letter Spacing (px)', 'VC', 'sonaar'),
					"value" => "",
					"description" => '',
					"group" => esc_html_x('Desktop', 'VC', 'sonaar'),
				),
				array(
					"param_name" => "labels_font_size",
					"type" => "textfield",

					"class" => "",
					"heading" => esc_html_x('Labels Font Size (px)', 'VC', 'sonaar'),
					"value" => "",
					"description" => '',
					"group" => esc_html_x('Desktop', 'VC', 'sonaar'),
				),
				array(
					"param_name" => "labels_line_height",
					"type" => "textfield",

					"class" => "",
					"heading" => esc_html_x('Labels Line Height (px)', 'VC', 'sonaar'),
					"value" => "",
					"description" => '',
					"group" => esc_html_x('Desktop', 'VC', 'sonaar'),
				),
				array(
					"param_name" => "labels_letter_spacing",
					"type" => "textfield",

					"class" => "",
					"heading" => esc_html_x('Labels Letter Spacing (px)', 'VC', 'sonaar'),
					"value" => "",
					"description" => '',
					"group" => esc_html_x('Desktop', 'VC', 'sonaar'),
				),
				array(
					"param_name" => "numbers_spacing",
					"type" => "textfield",

					"class" => "",
					"heading" => esc_html_x('Spacing between Numbers (px)', 'VC', 'sonaar'),
					"value" => "",
					"description" => '',
					"group" => esc_html_x('Desktop', 'VC', 'sonaar'),
				),
				array(
					"param_name" => "numbers_margin",
					"type" => "textfield",

					"class" => "",
					"heading" => esc_html_x('Margin between Numbers and sub labels (px)', 'VC', 'sonaar'),
					"value" => "",
					"description" => '',
					"group" => esc_html_x('Desktop', 'VC', 'sonaar'),
				),

				array(
					"param_name" => "tablet_numbers_font_size",
					"type" => "textfield",

					"class" => "",
					"heading" => esc_html_x('Numbers Font Size (px)', 'VC', 'sonaar'),
					"value" => "",
					"description" => '',
					"group" => esc_html_x('Tablet', 'VC', 'sonaar'),
				),
				array(
					"param_name" => "tablet_numbers_line_height",
					"type" => "textfield",

					"class" => "",
					"heading" => esc_html_x('Numbers Line Height (px)', 'VC', 'sonaar'),
					"value" => "",
					"description" => '',
					"group" => esc_html_x('Tablet', 'VC', 'sonaar'),
				),
				array(
					"param_name" => "tablet_numbers_letter_spacing",
					"type" => "textfield",

					"class" => "",
					"heading" => esc_html_x('Numbers Letter Spacing (px)', 'VC', 'sonaar'),
					"value" => "",
					"description" => '',
					"group" => esc_html_x('Tablet', 'VC', 'sonaar'),
				),
				array(
					"param_name" => "tablet_labels_font_size",
					"type" => "textfield",

					"class" => "",
					"heading" => esc_html_x('Labels Font Size (px)', 'VC', 'sonaar'),
					"value" => "",
					"description" => '',
					"group" => esc_html_x('Tablet', 'VC', 'sonaar'),
				),
				array(
					"param_name" => "tablet_labels_line_height",
					"type" => "textfield",

					"class" => "",
					"heading" => esc_html_x('Labels Line Height (px)', 'VC', 'sonaar'),
					"value" => "",
					"description" => '',
					"group" => esc_html_x('Tablet', 'VC', 'sonaar'),
				),
				array(
					"param_name" => "tablet_labels_letter_spacing",
					"type" => "textfield",

					"class" => "",
					"heading" => esc_html_x('Labels Letter Spacing (px)', 'VC', 'sonaar'),
					"value" => "",
					"description" => '',
					"group" => esc_html_x('Tablet', 'VC', 'sonaar'),
				),
				array(
					"param_name" => "tablet_numbers_spacing",
					"type" => "textfield",

					"class" => "",
					"heading" => esc_html_x('Spacing between Numbers (px)', 'VC', 'sonaar'),
					"value" => "",
					"description" => '',
					"group" => esc_html_x('Tablet', 'VC', 'sonaar'),
				),
				array(
					"param_name" => "tablet_numbers_margin",
					"type" => "textfield",

					"class" => "",
					"heading" => esc_html_x('Margin between Numbers and sub labels (px)', 'VC', 'sonaar'),
					"value" => "",
					"description" => '',
					"group" => esc_html_x('Tablet', 'VC', 'sonaar'),
				),

				array(
					"param_name" => "mobile_numbers_font_size",
					"type" => "textfield",

					"class" => "",
					"heading" => esc_html_x('Numbers Font Size (px)', 'VC', 'sonaar'),
					"value" => "",
					"description" => '',
					"group" => esc_html_x('Mobile', 'VC', 'sonaar'),
				),
				array(
					"param_name" => "mobile_numbers_line_height",
					"type" => "textfield",

					"class" => "",
					"heading" => esc_html_x('Numbers Line Height (px)', 'VC', 'sonaar'),
					"value" => "",
					"description" => '',
					"group" => esc_html_x('Mobile', 'VC', 'sonaar'),
				),
				array(
					"param_name" => "mobile_numbers_letter_spacing",
					"type" => "textfield",

					"class" => "",
					"heading" => esc_html_x('Numbers Letter Spacing (px)', 'VC', 'sonaar'),
					"value" => "",
					"description" => '',
					"group" => esc_html_x('Mobile', 'VC', 'sonaar'),
				),

				array(
					"param_name" => "mobile_labels_font_size",
					"type" => "textfield",

					"class" => "",
					"heading" => esc_html_x('Labels Font Size (px)', 'VC', 'sonaar'),
					"value" => "",
					"description" => '',
					"group" => esc_html_x('Mobile', 'VC', 'sonaar'),
				),
				array(
					"param_name" => "mobile_labels_line_height",
					"type" => "textfield",

					"class" => "",
					"heading" => esc_html_x('Labels Line Height (px)', 'VC', 'sonaar'),
					"value" => "",
					"description" => '',
					"group" => esc_html_x('Mobile', 'VC', 'sonaar'),
				),
				array(
					"param_name" => "mobile_labels_letter_spacing",
					"type" => "textfield",

					"class" => "",
					"heading" => esc_html_x('Labels Letter Spacing (px)', 'VC', 'sonaar'),
					"value" => "",
					"description" => '',
					"group" => esc_html_x('Mobile', 'VC', 'sonaar'),
				),
				array(
					"param_name" => "mobile_numbers_spacing",
					"type" => "textfield",

					"class" => "",
					"heading" => esc_html_x('Spacing between Numbers (px)', 'VC', 'sonaar'),
					"value" => "",
					"description" => '',
					"group" => esc_html_x('Mobile', 'VC', 'sonaar'),
				),
				array(
					"param_name" => "mobile_numbers_margin",
					"type" => "textfield",

					"class" => "",
					"heading" => esc_html_x('Margin between Numbers and sub labels (px)', 'VC', 'sonaar'),
					"value" => "",
					"description" => '',
					"group" => esc_html_x('Mobile', 'VC', 'sonaar'),
				),


			)
		));

		vc_map( array(
			"name" => esc_html_x("Podcast Player", 'VC', 'sonaar'),
			"base" => "iron_podcastplayer",
			"class" => "",
			"icon" => "iron_vc_icon_podcast_player",
			"category" => esc_html_x('IRON Widgets', 'VC', 'sonaar'),
			"params" => array(
				array(
					"type" => "dropdown",
					//
					"class" => "",
					"heading" => esc_html_x("Play Last Published Episode", 'VC', 'sonaar'),
					"param_name" => "play-latest",
					"admin_label" => true,
					"value" => array(
					   esc_html_x("No", 'VC', 'sonaar')=> 'no',
					   esc_html_x("Yes", 'VC', 'sonaar')=> 'yes',
					 ),
					"description" => '',
					'save_always' => true,
				 ),
				 array(
				 	"heading" => esc_html_x("Episode Name/ID", 'VC', 'sonaar'),
					"type" => "post_select",
					"post_type" => "podcast",
					"admin_label" => true,
					"class" => "",
					"param_name" => "albums",
					"description" => '',
					"single" => true,
					"dependency" => array(
						"element" => 'play-latest',
						"value" => 'no'
					 )
			 	),
				 array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Use gradient background?', 'sonaar' ),
				'param_name' => 'use_gradient_bg',
				'description' => esc_html__( 'If checked, gradient color will be used as your player background color.', 'sonaar' ),
				'value' => array( esc_html__( 'Yes', 'js_composer' ) => 'yes' ),
				),
				array(
				'type' => 'gradient',
				'heading' => esc_html__( 'Gradient Picker', 'sonaar' ),
				'param_name' => 'player_gradient_bg_color',
				'description' => esc_html__( 'Background Color Gradient', 'sonaar' ),
				'dependency' => array(
					'element' => 'use_gradient_bg',
					'not_empty' => true,
				),
				
			),
			   vc_map_add_css_animation(),
 
			)
 
		 ));

	}
	add_action('init', 'iron_register_js_composer', 12);

		

