<?php

if ( is_admin()) {
	include 'rational-option-page/class.rational-option-page.php';
	$ironFeatures_pages = new SR_RationalOptionPages();
		/*
		// Set up available category options BEFORE AUGUST 2019
		$category_options = array(
			'Arts'                       => __( 'Arts', 'sonaar' ),
			'Business'                   => __( 'Business', 'sonaar' ),
			'Comedy'                     => __( 'Comedy', 'sonaar' ),
			'Education'                  => __( 'Education', 'sonaar' ),
			'Games & Hobbies'            => __( 'Games & Hobbies', 'sonaar' ),
			'Government & Organizations' => __( 'Government & Organizations', 'sonaar' ),
			'Health'                     => __( 'Health', 'sonaar' ),
			'Kids & Family'              => __( 'Kids & Family', 'sonaar' ),
			'Music'                      => __( 'Music', 'sonaar' ),
			'News & Politics'            => __( 'News & Politics', 'sonaar' ),
			'Religion & Spirituality'    => __( 'Religion & Spirituality', 'sonaar' ),
			'Science & Medicine'         => __( 'Science & Medicine', 'sonaar' ),
			'Society & Culture'          => __( 'Society & Culture', 'sonaar' ),
			'Sports & Recreation'        => __( 'Sports & Recreation', 'sonaar' ),
			'Technology'                 => __( 'Technology', 'sonaar' ),
			'TV & Film'                  => __( 'TV & Film', 'sonaar' ),
		);
		*/
		// Set up available category options AFTER AUGUST 2019
		$category_options = array(
			'Arts'                       => __( 'Arts', 'sonaar' ),
			'Business'                   => __( 'Business', 'sonaar' ),
			'Comedy'                     => __( 'Comedy', 'sonaar' ),
			'Education'                  => __( 'Education', 'sonaar' ),
			'Fiction'                  	 => __( 'Fiction', 'sonaar' ),
			'Government' 				 => __( 'Government', 'sonaar' ),
			'Health & Fitness'           => __( 'Health & Fitness', 'sonaar' ),
			'History'           		 => __( 'History', 'sonaar' ),
			'Kids & Family'              => __( 'Kids & Family', 'sonaar' ),
			'Leisure'           		 => __( 'Leisure', 'sonaar' ),
			'Music'                      => __( 'Music', 'sonaar' ),
			'News'           			 => __( 'News', 'sonaar' ),
			'Religion & Spirituality'    => __( 'Religion & Spirituality', 'sonaar' ),
			'Science'        			 => __( 'Science', 'sonaar' ),
			'Society & Culture'          => __( 'Society & Culture', 'sonaar' ),
			'Sports'        			 => __( 'Sports', 'sonaar' ),
			'Technology'                 => __( 'Technology', 'sonaar' ),
			'True Crime'                 => __( 'True Crime', 'sonaar' ),
			'TV & Film'                  => __( 'TV & Film', 'sonaar' ),
		);
		$subcategory_options = array(
			'None'                       => __( '-- None --', 'sonaar' ),

			'Books'                      => __( 'Arts > Books', 'sonaar' ),
			'Design'                     => __( 'Arts > Design', 'sonaar' ),
			'Fashion & Beauty'           => __( 'Arts > Fashion & Beauty', 'sonaar' ),
			'Food'                       => __( 'Arts > Food', 'sonaar' ),
			'Performing Arts'            => __( 'Arts > Performing Arts', 'sonaar' ),
			'Visual Arts'                => __( 'Arts > Visual Arts', 'sonaar' ),

			'Careers'                    => __( 'Business > Careers', 'sonaar' ),
			'Enterpreneurship'           => __( 'Business > Enterpreneurship', 'sonaar' ),
			'Investing'                  => __( 'Business > Investing', 'sonaar' ),
			'Management'                 => __( 'Business > Management', 'sonaar' ),
			'Marketing'                  => __( 'Business > Marketing', 'sonaar' ),
			'Non-profit'                 => __( 'Business > Non-profit', 'sonaar' ),

			'Comedy Interviews'          => __( 'Comedy > Comedy Interviews', 'sonaar' ),
			'Improv'                     => __( 'Comedy > Improv', 'sonaar' ),
			'Standup'                    => __( 'Comedy > Standup', 'sonaar' ),

			'Courses'                    => __( 'Education > Courses', 'sonaar' ),
			'How to'                     => __( 'Education > How to', 'sonaar' ),
			'Language Learning'          => __( 'Education > Language Learning', 'sonaar' ),
			'Self Improvement'           => __( 'Education > Self Improvement', 'sonaar' ),

			'Comedy Fiction'             => __( 'Fiction > Comedy Fiction', 'sonaar' ),
			'Drama'                      => __( 'Fiction > Drama', 'sonaar' ),
			'Science Fiction'            => __( 'Fiction > Science Fiction', 'sonaar' ),

			'Alternative Health'         => __( 'Health & Fitness > Alternative Health', 'sonaar' ),
			'Fitness'                    => __( 'Health & Fitness > Fitness', 'sonaar' ),
			'Medicine'                   => __( 'Health & Fitness > Medicine', 'sonaar' ),
			'Mental Health'              => __( 'Health & Fitness > Mental Health', 'sonaar' ),
			'Nutrition'                  => __( 'Health & Fitness > Nutrition', 'sonaar' ),
			'Sexuality'                  => __( 'Health & Fitness > Sexuality', 'sonaar' ),

			'Education for Kids'         => __( 'Kids & Family > Education for Kids', 'sonaar' ),
			'Parenting'                  => __( 'Kids & Family > Parenting', 'sonaar' ),
			'Pets & Animals'             => __( 'Kids & Family > Pets & Animals', 'sonaar' ),
			'Stories for Kids'           => __( 'Kids & Family > Stories for Kids', 'sonaar' ),

			'Animation & Manga'          => __( 'Leisure > Animation & Manga', 'sonaar' ),
			'Automotive'                 => __( 'Leisure > Automotive', 'sonaar' ),
			'Aviation'                   => __( 'Leisure > Aviation', 'sonaar' ),
			'Crafts'                     => __( 'Leisure > Crafts', 'sonaar' ),
			'Games'                      => __( 'Leisure > Games', 'sonaar' ),
			'Hobbies'                    => __( 'Leisure > Hobbies', 'sonaar' ),
			'Home & Garden'              => __( 'Leisure > Home & Garden', 'sonaar' ),
			'Video Games'                => __( 'Leisure > Video Games', 'sonaar' ),

			'Music Commentary'           => __( 'Music > Music Commentary', 'sonaar' ),
			'Music History'              => __( 'Music > Music History', 'sonaar' ),
			'Music Interviews'           => __( 'Music > Music Interviews', 'sonaar' ),

			'Business News'              => __( 'News > Business News', 'sonaar' ),
			'Daily News'                 => __( 'News > Daily News', 'sonaar' ),
			'Entertainment News'         => __( 'News > Entertainment News', 'sonaar' ),
			'News Commentary'            => __( 'News > News Commentary', 'sonaar' ),
			'Politics'                   => __( 'News > Politics', 'sonaar' ),
			'Sports News'                => __( 'News > Sports News', 'sonaar' ),
			'Tech News'                  => __( 'News > Tech News', 'sonaar' ),

			'Buddhism'                   => __( 'Religion & Spirituality > Buddhism', 'sonaar' ),
			'Christianity'               => __( 'Religion & Spirituality > Christianity', 'sonaar' ),
			'Hinduism'                   => __( 'Religion & Spirituality > Hinduism', 'sonaar' ),
			'Islam'                      => __( 'Religion & Spirituality > Islam', 'sonaar' ),
			'Judaism'                    => __( 'Religion & Spirituality > Judaism', 'sonaar' ),
			'Religion'                   => __( 'Religion & Spirituality > Religion', 'sonaar' ),
			'Spirituality'               => __( 'Religion & Spirituality > Spirituality', 'sonaar' ),
			'Buddhism'                   => __( 'Religion & Spirituality > Buddhism', 'sonaar' ),


			'Astronomy'                  => __( 'Science > Astronomy', 'sonaar' ),
			'Chemistry'                  => __( 'Science > Chemistry', 'sonaar' ),
			'Earth Sciences'             => __( 'Science > Earth Sciences', 'sonaar' ),
			'Life Sciences'              => __( 'Science > Life Sciences', 'sonaar' ),
			'Mathematics'                => __( 'Science > Mathematics', 'sonaar' ),
			'Natural Sciences'           => __( 'Science > Natural Sciences', 'sonaar' ),
			'Nature'                   	 => __( 'Science > Nature', 'sonaar' ),
			'BuddhPhysicssm'             => __( 'Science > Physics', 'sonaar' ),
			'Social Sciences'            => __( 'Science > Social Sciences', 'sonaar' ),

			'Documentary'                => __( 'Society & Culture > Documentary', 'sonaar' ),
			'Personal Journals'          => __( 'Society & Culture > Personal Journals', 'sonaar' ),
			'Philosophy'                 => __( 'Society & Culture > Philosophy', 'sonaar' ),
			'Places & Travel'            => __( 'Society & Culture > Places & Travel', 'sonaar' ),
			'Relationships'              => __( 'Society & Culture > Relationships', 'sonaar' ),

			'Baseball'                   => __( 'Sports > Baseball', 'sonaar' ),
			'Basketball'                 => __( 'Sports > Basketball', 'sonaar' ),
			'Cricket'                    => __( 'Sports > Cricket', 'sonaar' ),
			'Fantasy Sports'             => __( 'Sports > Fantasy Sports', 'sonaar' ),
			'Football'                   => __( 'Sports > Football', 'sonaar' ),
			'Golf'                   	 => __( 'Sports > Golf', 'sonaar' ),
			'Hockey'                     => __( 'Sports > Hockey', 'sonaar' ),
			'Rugby'                      => __( 'Sports > Rugby', 'sonaar' ),
			'Running'                    => __( 'Sports > Running', 'sonaar' ),
			'Soccer'                     => __( 'Sports > Soccer', 'sonaar' ),
			'Swimming'                   => __( 'Sports > Swimming', 'sonaar' ),
			'Tennis'                     => __( 'Sports > Tennis', 'sonaar' ),
			'Volleyball'                 => __( 'Sports > Volleyball', 'sonaar' ),
			'Wilderness'                 => __( 'Sports > Wilderness', 'sonaar' ),
			'Wrestling'                  => __( 'Sports > Wrestling', 'sonaar' ),

			'After Shows'                => __( 'TV & Film > After Shows', 'sonaar' ),
			'Film History'               => __( 'TV & Film > Film History', 'sonaar' ),
			'Film Interviews'            => __( 'TV & Film > Film Interviews', 'sonaar' ),
			'Film Reviews'               => __( 'TV & Film > Film Reviews', 'sonaar' ),
			'TV Reviews'                 => __( 'TV & Film > TV Reviews', 'sonaar' ),


		);
		// Set up available sub-category options.
		$subcategory_options_notused = array(

			'' => __( '-- None --', 'sonaar' ),

			'Design'           => array(
				'label' => __( 'Design', 'sonaar' ),
				'group' => __( 'Arts', 'sonaar' ),
			),
			'Fashion & Beauty' => array(
				'label' => __( 'Fashion & Beauty', 'sonaar' ),
				'group' => __( 'Arts', 'sonaar' ),
			),
			'Food'             => array(
				'label' => __( 'Food', 'sonaar' ),
				'group' => __( 'Arts', 'sonaar' ),
			),
			'Literature'       => array(
				'label' => __( 'Literature', 'sonaar' ),
				'group' => __( 'Arts', 'sonaar' ),
			),
			'Performing Arts'  => array(
				'label' => __( 'Performing Arts', 'sonaar' ),
				'group' => __( 'Arts', 'sonaar' ),
			),
			'Visual Arts'      => array(
				'label' => __( 'Visual Arts', 'sonaar' ),
				'group' => __( 'Arts', 'sonaar' ),
			),

			'Business News'          => array(
				'label' => __( 'Business News', 'sonaar' ),
				'group' => __( 'Business', 'sonaar' ),
			),
			'Careers'                => array(
				'label' => __( 'Careers', 'sonaar' ),
				'group' => __( 'Business', 'sonaar' ),
			),
			'Investing'              => array(
				'label' => __( 'Investing', 'sonaar' ),
				'group' => __( 'Business', 'sonaar' ),
			),
			'Management & Marketing' => array(
				'label' => __( 'Management & Marketing', 'sonaar' ),
				'group' => __( 'Business', 'sonaar' ),
			),
			'Shopping'               => array(
				'label' => __( 'Shopping', 'sonaar' ),
				'group' => __( 'Business', 'sonaar' ),
			),

			'Education'            => array(
				'label' => __( 'Education', 'sonaar' ),
				'group' => __( 'Education', 'sonaar' ),
			),
			'Education Technology' => array(
				'label' => __( 'Education Technology', 'sonaar' ),
				'group' => __( 'Education', 'sonaar' ),
			),
			'Higher Education'     => array(
				'label' => __( 'Higher Education', 'sonaar' ),
				'group' => __( 'Education', 'sonaar' ),
			),
			'K-12'                 => array(
				'label' => __( 'K-12', 'sonaar' ),
				'group' => __( 'Education', 'sonaar' ),
			),
			'Language Courses'     => array(
				'label' => __( 'Language Courses', 'sonaar' ),
				'group' => __( 'Education', 'sonaar' ),
			),
			'Training'             => array(
				'label' => __( 'Training', 'sonaar' ),
				'group' => __( 'Education', 'sonaar' ),
			),

			'Automotive'  => array(
				'label' => __( 'Automotive', 'sonaar' ),
				'group' => __( 'Games & Hobbies', 'sonaar' ),
			),
			'Aviation'    => array(
				'label' => __( 'Aviation', 'sonaar' ),
				'group' => __( 'Games & Hobbies', 'sonaar' ),
			),
			'Hobbies'     => array(
				'label' => __( 'Hobbies', 'sonaar' ),
				'group' => __( 'Games & Hobbies', 'sonaar' ),
			),
			'Other Games' => array(
				'label' => __( 'Other Games', 'sonaar' ),
				'group' => __( 'Games & Hobbies', 'sonaar' ),
			),
			'Video Games' => array(
				'label' => __( 'Video Games', 'sonaar' ),
				'group' => __( 'Games & Hobbies', 'sonaar' ),
			),

			'Local'      => array(
				'label' => __( 'Local', 'sonaar' ),
				'group' => __( 'Government & Organizations', 'sonaar' ),
			),
			'National'   => array(
				'label' => __( 'National', 'sonaar' ),
				'group' => __( 'Government & Organizations', 'sonaar' ),
			),
			'Non-Profit' => array(
				'label' => __( 'Non-Profit', 'sonaar' ),
				'group' => __( 'Government & Organizations', 'sonaar' ),
			),
			'Regional'   => array(
				'label' => __( 'Regional', 'sonaar' ),
				'group' => __( 'Government & Organizations', 'sonaar' ),
			),

			'Alternative Health'  => array(
				'label' => __( 'Alternative Health', 'sonaar' ),
				'group' => __( 'Health', 'sonaar' ),
			),
			'Fitness & Nutrition' => array(
				'label' => __( 'Fitness & Nutrition', 'sonaar' ),
				'group' => __( 'Health', 'sonaar' ),
			),
			'Self-Help'           => array(
				'label' => __( 'Self-Help', 'sonaar' ),
				'group' => __( 'Health', 'sonaar' ),
			),
			'Sexuality'           => array(
				'label' => __( 'Sexuality', 'sonaar' ),
				'group' => __( 'Health', 'sonaar' ),
			),

			'Buddhism'     => array(
				'label' => __( 'Buddhism', 'sonaar' ),
				'group' => __( 'Religion & Spirituality', 'sonaar' ),
			),
			'Christianity' => array(
				'label' => __( 'Christianity', 'sonaar' ),
				'group' => __( 'Religion & Spirituality', 'sonaar' ),
			),
			'Hinduism'     => array(
				'label' => __( 'Hinduism', 'sonaar' ),
				'group' => __( 'Religion & Spirituality', 'sonaar' ),
			),
			'Islam'        => array(
				'label' => __( 'Islam', 'sonaar' ),
				'group' => __( 'Religion & Spirituality', 'sonaar' ),
			),
			'Judaism'      => array(
				'label' => __( 'Judaism', 'sonaar' ),
				'group' => __( 'Religion & Spirituality', 'sonaar' ),
			),
			'Other'        => array(
				'label' => __( 'Other', 'sonaar' ),
				'group' => __( 'Religion & Spirituality', 'sonaar' ),
			),
			'Spirituality' => array(
				'label' => __( 'Spirituality', 'sonaar' ),
				'group' => __( 'Religion & Spirituality', 'sonaar' ),
			),

			'Medicine'         => array(
				'label' => __( 'Medicine', 'sonaar' ),
				'group' => __( 'Science & Medicine', 'sonaar' ),
			),
			'Natural Sciences' => array(
				'label' => __( 'Natural Sciences', 'sonaar' ),
				'group' => __( 'Science & Medicine', 'sonaar' ),
			),
			'Social Sciences'  => array(
				'label' => __( 'Social Sciences', 'sonaar' ),
				'group' => __( 'Science & Medicine', 'sonaar' ),
			),

			'History'           => array(
				'label' => __( 'History', 'sonaar' ),
				'group' => __( 'Society & Culture', 'sonaar' ),
			),
			'Personal Journals' => array(
				'label' => __( 'Personal Journals', 'sonaar' ),
				'group' => __( 'Society & Culture', 'sonaar' ),
			),
			'Philosophy'        => array(
				'label' => __( 'Philosophy', 'sonaar' ),
				'group' => __( 'Society & Culture', 'sonaar' ),
			),
			'Places & Travel'   => array(
				'label' => __( 'Places & Travel', 'sonaar' ),
				'group' => __( 'Society & Culture', 'sonaar' ),
			),

			'Amateur'               => array(
				'label' => __( 'Amateur', 'sonaar' ),
				'group' => __( 'Sports & Recreation', 'sonaar' ),
			),
			'College & High School' => array(
				'label' => __( 'College & High School', 'sonaar' ),
				'group' => __( 'Sports & Recreation', 'sonaar' ),
			),
			'Outdoor'               => array(
				'label' => __( 'Outdoor', 'sonaar' ),
				'group' => __( 'Sports & Recreation', 'sonaar' ),
			),
			'Professional'          => array(
				'label' => __( 'Professional', 'sonaar' ),
				'group' => __( 'Sports & Recreation', 'sonaar' ),
			),

			'Gadgets'         => array(
				'label' => __( 'Gadgets', 'sonaar' ),
				'group' => __( 'Technology', 'sonaar' ),
			),
			'Tech News'       => array(
				'label' => __( 'Tech News', 'sonaar' ),
				'group' => __( 'Technology', 'sonaar' ),
			),
			'Podcasting'      => array(
				'label' => __( 'Podcasting', 'sonaar' ),
				'group' => __( 'Technology', 'sonaar' ),
			),
			'Software How-To' => array(
				'label' => __( 'Software How-To', 'sonaar' ),
				'group' => __( 'Technology', 'sonaar' ),
			),
		);



	$ironFeatures_pages_options = array(
	    array(
	        'page_title'    => esc_html__('Audio Players & Events Settings','sonaar'),
	        'menu_title'    => esc_html__('Audio Players & Events Settings','sonaar'),
	        'capability'    => 'manage_options',
	        'menu_slug'     => 'sonaar',
	        'icon_url'      => IRON_MUSIC_DIR_URL . '/images/ironlogo.svg',
	        'position'      => '9999999999999999999999999999',
			'subpages'		=> array(
				array(
					'page_title'	=> esc_html__('Music Player','sonaar'),
					'menu_title' 	=> esc_html__('Music Player','sonaar'),
					'capability'    => 'manage_options',
					'menu_slug'     => 'iron_music_music_player',
					'sections'		=> array(
						array(
							'id' 	=> 'iron_music_player',
							'title'	=> esc_html__('Music Player Widget', 'sonaar'),
							'fields'=> array(
								array(
									'id' => 'music_player_playlist',
									'type' => 'typography',
									'title' => esc_html__('Tracklist Typography', 'sonaar'),
									//'description' => esc_html__('This is for the tracklist in the ', 'sonaar'),
									'value' => array(
										'font' => '',
										'font-readable' => '',
										'weight' => '',
										'size' => '16px',
										'color' => 'rgb(0, 0, 0)',
									)
								),
								array(
									'id' => 'music_player_featured_color',
									'type' => 'text',
									'title' => esc_html__('Tracklist Controls & Icons', 'sonaar'),
									'description' => esc_html__('Color of the tracklist play/pause buttons & Icons', 'sonaar'),
									'class' => 'color',
									'value' => 'rgb(0, 0, 0)'
								),
								array(
									'id' => 'music_player_icon_color',
									'type' => 'text',
									'title' => esc_html__('Audio Player Controls', 'sonaar'),
									'description' => esc_html__('Color of the previous/play/pause/next buttons on the player widget', 'sonaar'),
									'class' => 'color',
									'value' => 'rgb(127, 127, 127)'
								),
								array(
									'id' => 'music_player_progress_color',
									'type' => 'text',
									'title' => esc_html__('SoundWave Progress Bar', 'sonaar'),
									'class' => 'color',
									'value' => 'rgb(13, 237, 180)'
								),
								array(
									'id' => 'artist_player_typography',
									'type' => 'typography',
									'title' => esc_html__('Artist Player Typography', 'sonaar'),
									'description' => esc_html__('For the featured player in the Artist Single Page', 'sonaar'),
									'value' => array(
										'font' => '',
										'font-readable' => '',
										'weight' => '',
										'size' => '',
										'color' => '',
									)
								),
								array(
									'id' => 'music_player_timeline_color',
									'type' => 'text',
									'title' => esc_html__('Artist Player Background', 'sonaar'),
									'description' => esc_html__('For the featured player in the Artist Single Page', 'sonaar'),
									'class' => 'color',
									'value' => 'rgb(31, 31, 31)'
								),
							)
						),
						array(
							'id' 	=> 'iron_music_continuous_player',
							'title'	=> esc_html__('Sticky Player', 'sonaar'),
							'fields'=> array(
								array(
									'id' => 'continuous_music_player_label',
									'type' => 'typography',
									'title' => esc_html__('Typography', 'sonaar'),
									'value' => array(
										'font' => '',
										'font-readable' => '',
										'weight' => '',
										'size' => '16px',
										'color' => 'rgb(0, 0, 0)',
									)
								),
								array(
									'id' => 'continuous_music_player_featured_color',
									'type' => 'text',
									'title' => esc_html__('Featured Color', 'sonaar'),
									'class' => 'color',
									'value' => 'rgb(255, 255, 255)'
								),
								array(
									'id' => 'continuous_music_player_label_color',
									'type' => 'text',
									'title' => esc_html__('Label and Button', 'sonaar'),
									'class' => 'color',
									'value' => 'rgb(0, 0, 0)'
								),
								array(
									'id' => 'continuous_music_player_timeline_bar',
									'type' => 'text',
									'title' => esc_html__('SoundWave Bars', 'sonaar'),
									'class' => 'color',
									'value' => 'rgb(150, 150, 150)'
								),
								array(
									'id' => 'continuous_mobile_progress_bar',
									'type' => 'text',
									'title' => esc_html__('Mobile Progress Bar', 'sonaar'),
									'class' => 'color',
									'value' => ''
								),
								array(
									'id' => 'continuous_music_player_progress_bar',
									'type' => 'text',
									'title' => esc_html__('SoundWave Progress Bars', 'sonaar'),
									'class' => 'color',
									'value' => 'rgb(150, 150, 150)'
								),
								array(
									'id' => 'continuous_music_player_background',
									'type' => 'text',
									'title' => esc_html__('Player Background', 'sonaar'),
									'class' => 'color',
									'value' => 'rgb(0, 0, 0)'
								),
								array(
									'id' => 'continuous_music_player_label_artist',
									'type' => 'checkbox',
									'title' => esc_html__('Hide Artist Name in the player/playlist', 'sonaar'),
									'checked' => true
								),

								array(
									'id' => 'continuous_music_player_playlist_icon',
									'type' => 'checkbox',
									'title' => esc_html__('Hide Playlist Icon in the Footer Player ', 'sonaar'),
									'checked' => true
								),
							)
						)
					)
				),
				array(
					'page_title'	=> esc_html__('Podcast Player','sonaar'),
					'menu_title' 	=> esc_html__('Podcast Player','sonaar'),
					'capability'    => 'manage_options',
					'menu_slug'     => 'iron_music_podcast_player',
					'sections'		=> array(
						array(
							'id' 	=> 'iron_podcast_general',
							'title'	=> esc_html__('Podcast General Settings', 'sonaar'),
							'fields'=> array(
								array(
									'id'    => 'podcast_slug_name',
									'title' => esc_html__('Podcast Slug Name','sonaar'),
									'type'  => 'text',
									'description' => esc_html__('eg: http://www.domain.com/SLUG-NAME/podcast-title','sonaar'),
									'value' => 'podcast'
								),
								array(
									'id'    => 'podcastshow_slug_name',
									'title' => esc_html__('Podcast Show Slug Name','sonaar'),
									'type'  => 'text',
									'description' => esc_html__('eg: http://www.domain.com/SLUG-NAME/podcastshow-title','sonaar'),
									'value' => 'show'
								),
								array(
									'id' => 'podcast_label_date',
									'type' => 'checkbox',
									'title' => esc_html__('Hide Date', 'sonaar'),
									'checked' => true,
								),
								array(
									'id' => 'podcast_label_category',
									'type' => 'checkbox',
									'title' => esc_html__('Hide Category', 'sonaar'),
									'checked' => true
								),
								array(
									'id' => 'podcast_label_duration',
									'type' => 'checkbox',
									'title' => esc_html__('Hide Duration', 'sonaar'),
									'checked' => true
								),
							)
						),
						array(
							'id' 	=> 'iron_podcast_player',
							'title'	=> esc_html__('Podcast Player Widget', 'sonaar'),
							'fields'=> array(
								array(
									'id' => 'podcast_player_typograpy',
									'type' => 'typography',
									'title' => esc_html__('Typography', 'sonaar'),
									'description' => esc_html__('Choose a font, font size and color', 'sonaar'),
									'value' => array(
										'font' => '',
										'font-readable' => '',
										'weight' => '',
										'size' => '18px',
										'color' => 'rgb(0, 0, 0)',
									)
								),
								array(
									'id' => 'podcast_player_background_color_from',
									'type' => 'text',
									'title' => esc_html__('Background Color [from]', 'sonaar'),
									'description' => esc_html__('Choose a color to start the gradient', 'sonaar'),
									'class' => 'color',
									'value' => 'rgb(0, 0, 0)'
								),
								array(
									'id' => 'podcast_player_background_color_to',
									'type' => 'text',
									'title' => esc_html__('Background Color [to]', 'sonaar'),
									'description' => esc_html__('Choose a color to finish the gradient', 'sonaar'),
									'class' => 'color',
									'value' => 'rgb(0, 0, 0)'
								),
								array(
									'id' => 'podcast_player_button_color',
									'type' => 'text',
									'title' => esc_html__('Button Colors', 'sonaar'),
									'class' => 'color',
									'value' => 'rgb(0, 0, 0)'
								),
								array(
									'id' => 'podcast_player_icon_color',
									'type' => 'text',
									'title' => esc_html__('Play Button', 'sonaar'),
									'class' => 'color',
									'value' => 'rgb(127, 127, 127)'
								),
								array(
									'id' => 'podcast_player_timeline_color',
									'type' => 'text',
									'title' => esc_html__('SoundWave Color Bars', 'sonaar'),
									'class' => 'color',
									'value' => 'rgb(31, 31, 31)'
								),
								/*array(
									'id' => 'podcast_player_progress_color',
									'type' => 'text',
									'title' => esc_html__('SoundWave Progress Bar', 'sonaar'),
									'class' => 'color',
									'value' => 'rgb(13, 237, 180)'
								),*/
								
							)
						),
						array(
							'id' 	=> 'podcast_continuous_player',
							'title'	=> esc_html__('Sticky Player', 'sonaar'),
							'fields'=> array(
								array(
									'id' => 'podcast_skip_button',
									'type' => 'checkbox',
									'title' => esc_html__('Disable Backward/Forward Skip Buttons', 'sonaar'),
									'checked' => false
								),
								array(
									'id' => 'podcast_speed_rate_button',
									'type' => 'checkbox',
									'title' => esc_html__('Disable Audio Speed Rate Button', 'sonaar'),
									'checked' => false
								)
							)
						)
					)
				),
				array(
					'page_title'	=> esc_html__('Podcast Feed','sonaar'),
					'menu_title' 	=> esc_html__('Podcast Feed','sonaar'),
					'capability'    => 'manage_options',
					'menu_slug'     => 'iron_music_podcast_feed',
					'sections'      => array(
						array(
							'id'    => 'iron_podcast',
							'title' => esc_html__('Feed Settings','sonaar'),
							'description' => sprintf( __( 'This data will be used in the feed for your podcast so your listeners will know more about it before they subscribe. Your RSS Feed URL is: http://<strong>yourdomain.com</strong>/feed/podcast/ URL to share and publish your feed on any podcasting services and readers (including iTunes).', 'sonaar' ), '<br/><em>', '</em>' ),
							'fields'=> array(
								array(
									'id'          => 'srpodcast_disable_rss',
									'title' => esc_html__('Disable this RSS Feed', 'sonaar'),
									'description' => __( 'This will disable the RSS feed generated by your theme', 'sonaar' ),
									'type'        => 'checkbox',
									'value'       => '',
								),
								array(
									'id'          => 'srpodcast_data_title',
									'title' => esc_html__('Podcast Title', 'sonaar'),
									'description' => __( 'Your podcast title.', 'sonaar' ),
									'type'        => 'text',
									//'value'     => get_bloginfo( 'name' ),
									'placeholder' => 'Enter your Podcast show title here'
									
								),
								array(
									'id'          => 'srpodcast_data_subtitle',
									'title' => esc_html__('Podcast subtitle', 'sonaar'),
									'description' => __( 'Your podcast subtitle.', 'sonaar' ),
									'type'        => 'text',
									'value'     => get_bloginfo( 'description' ),
									'placeholder' => get_bloginfo( 'description' ),
								),
								array(
									'id'          => 'srpodcast_data_description',
									'title' => esc_html__('Description of your podcast', 'sonaar'),
									'description' => __( 'A description/summary of your podcast - no HTML allowed.', 'sonaar' ),
									'type'        => 'textarea',
									'value'     => get_bloginfo( 'description' ),
									'placeholder' => get_bloginfo( 'description' ),					
								),
								array(
									'id'          => 'srpodcast_data_author',
									'title' => esc_html__('Podcast Author Name', 'sonaar'),
									'description' => __( 'Your podcast author.', 'sonaar' ),
									'type'        => 'text',
									'value'     => get_bloginfo( 'name' ),
									'placeholder' => get_bloginfo( 'name' ),
								),
								array(
									'id'          => 'srpodcast_data_image',
									'title' => esc_html__('Podcast Show Cover Image', 'sonaar'),
									'description' => __( 'Must be in a jpg format with a minimum size of 1400x1400px. This file repesent your show image cover in the podcast readers', 'sonaar' ),
									'type'        => 'file',
									'value'     => '',
									'placeholder' => '',
								),
								array(
									'id'          => 'srpodcast_data_owner_name',
									'title' => esc_html__('Podcast owner name', 'sonaar'),
									'description' => __( 'Podcast owner\'s name.', 'sonaar' ),
									'type'        => 'text',
									'value'     => get_bloginfo( 'name' ),
									'placeholder' => get_bloginfo( 'name' ),
								),
								array(
									'id'          => 'srpodcast_data_owner_email',
									'title' => esc_html__('Podcast owner email', 'sonaar'),
									'description' => __( 'Podcast owner\'s email address.', 'sonaar' ),
									'type'        => 'text',
									'value'     => get_bloginfo( 'admin_email' ),
									'placeholder' => get_bloginfo( 'admin_email' ),
								),
								array(
									'id'          => 'srpodcast_data_language',
									'title' => esc_html__('Podcast Language', 'sonaar'),
									'description' => sprintf( __( 'Your podcast\'s language in %1$sISO-639-1 format%2$s.', 'sonaar' ), '<a href="' . esc_url( 'http://www.loc.gov/standards/iso639-2/php/code_list.php' ) . '" target="' . wp_strip_all_tags( '_blank' ) . '">', '</a>' ),
									'type'        => 'text',
									'value'     => get_bloginfo( 'language' ),
									'placeholder' => get_bloginfo( 'language' ),
																),
								array(
									'id'          => 'srpodcast_data_copyright',
									'title' => esc_html__('Podcast copyright', 'sonaar'),
									'description' => __( 'Copyright line for your podcast.', 'sonaar' ),
									'type'        => 'text',
									'value'     => '&#xA9; ' . date( 'Y' ) . ' ' . get_bloginfo( 'name' ),
									'placeholder' => '&#xA9; ' . date( 'Y' ) . ' ' . get_bloginfo( 'name' ),
								),
								array(
									'id'          => 'srpodcast_data_category',
									'title' => esc_html__('Podcast category', 'sonaar'),
									'description' => __( 'Your podcast category.', 'sonaar' ),
									'type'        => 'select',
									'options'     => $category_options,
									'value'     => '',
								),
								array(
									'id'          => 'srpodcast_data_subcategory',
									'title' => esc_html__('Podcast subcategory (Optional)', 'sonaar'),
									'description' => __( 'Attention! Make sure you choose a subcategory that belong to the choosen Category above otherwise Apple will reject it. ', 'sonaar' ),
									'type'        => 'select',
									'options'     => $subcategory_options,
									'value'     => '',

								),
								array(
									'id'          => 'srpodcast_explicit',
									'title' => esc_html__('Is your podcast explicit?', 'sonaar'),
									'description' => sprintf(__( 'To mark this podcast as an explicit podcast, check this box. Explicit content rules can be found %s.', 'sonaar' ), '<a href="https://discussions.apple.com/thread/1079151">here</a>'),
									'type'        => 'checkbox',
									'value'     => '',
								),
								array(
									'id'          => 'srpodcast_complete',
									'title' => esc_html__('Is your podcast complete?', 'sonaar'),
									'description' => __( 'Mark if this podcast is complete or not. Only do this if no more episodes are going to be added to this feed.', 'sonaar' ),
									'type'        => 'checkbox',
									'value'     => '',
								),
								/**
								 * New iTunes Tag Announced At WWDC 2017
								 */
								array(
									'id'          => 'srpodcast_consume_order',
									'title' => esc_html__('Show type', 'sonaar'),
									'description' => sprintf( __( 'The order your podcast episodes will be listed. %1$sMore details here.%2$s', 'sonaar' ), '<a href="' . esc_url( 'https://castos.com/ios-11-podcast-tags/' ) . '" target="' . wp_strip_all_tags( '_blank' ) . '">', '</a>' ),
									'type'        => 'select',
									'options'     => array(
										'episodic' => __( 'Episodic', 'sonaar' ),
										'serial'   => __( 'Serial', 'sonaar' )
									),
									'value'     => '',
								),
								array(
									'id'          => 'srpodcast_redirect_feed',
									'title' => esc_html__('Redirect this feed to a new URL', 'sonaar'),
									'description' => sprintf( __( 'Redirect your feed to a new URL (specified below).', 'sonaar' ), '<br/>' ),
									'type'        => 'checkbox',
									'value'     => '',
									
								),
								array(
									'id'          => 'srpodcast_new_feed_url',
									'title' => esc_html__('New podcast feed URL', 'sonaar'),
									'description' => __( 'Your podcast feed\'s new URL.', 'sonaar' ),
									'type'        => 'text',
									'value'     => '',
									'placeholder' => __( 'New feed URL', 'sonaar' ),
								),
								array(
									'id'          => 'srpodcast_itunes_url',
									'title' => esc_html__('iTunes URL', 'sonaar'),
									'description' => __( 'Your podcast\'s iTunes URL.', 'sonaar' ),
									'type'        => 'text',
									'value'     => '',
									'placeholder' => __( 'iTunes URL', 'sonaar' ),
								),
								array(
									'id'          => 'srpodcast_stitcher_url',
									'title' => esc_html__('Sticher URL', 'sonaar'),
									'description' => __( 'Your podcast\'s Stitcher URL.', 'sonaar' ),
									'type'        => 'text',
									'value'     => '',
									'placeholder' => __( 'Stitcher URL', 'sonaar' ),
								),
								array(
									'id'          => 'srpodcast_google_play_url',
									'title' => esc_html__('Google Play URL', 'sonaar'),
									'description' => __( 'Your podcast\'s Google Play URL.', 'sonaar' ),
									'type'        => 'text',
									'value'     => '',
									'placeholder' => __( 'Google Play URL', 'sonaar' ),
								),
								array(
									'id'          => 'srpodcast_hiderssbutton',
									'title' => esc_html__('Hide RSS Feed Button', 'sonaar'),
									'description' => __( 'This will hide the RSS feed button', 'sonaar' ),
									'type'        => 'checkbox',
									'value'     => '',
								),
							)
						),
					),
				),
				array(
					'page_title'	=> esc_html__('Playlist','sonaar'),
					'menu_title' 	=> esc_html__('Playlist','sonaar'),
					'capability'    => 'manage_options',
					'menu_slug'     => 'iron_music_discography',
					'sections'      => array(
						array(
							'id'    => 'iron_discography',
							'title' => esc_html__('Playlist Settings','sonaar'),
							'fields'=> array(
								// text input
								array(
									'id'    => 'discography_slug_name',
									'title' => esc_html__('Playlist Slug Name','sonaar'),
									'type'  => 'text',
									'description' => esc_html__('eg: http://www.domain.com/SLUG-NAME/album-title','sonaar'),
									'value' => 'albums'
								),
							)
						),
					),
				),
				array(
					'page_title'	=> esc_html__('Events','sonaar'),
					'menu_title' 	=> esc_html__('Events','sonaar'),
					'capability'    => 'manage_options',
					'menu_slug'     => 'iron_music_event',
					'sections'      => array(
						array(
							'id'    => 'iron_events',
							'title' => esc_html__('General Settings','sonaar'),
							'fields'=> array(
								// text input
								array(
									'id'    => 'events_slug_name',
									'title' => esc_html__('Events slug name','sonaar'),
									'type'  => 'text',
									'description' => esc_html__('eg: http://www.domain.com/SLUG/event-title','sonaar'),
									'value' => 'event'
								),
								array(
									'id' => 'events_per_page',
									'type' => 'text',
									'title' => esc_html__('How many events per page ?', 'sonaar'),
									'description' => esc_html__('This setting apply on your event page template.', 'sonaar'),
									'value' => '10'
								),
								array(
									'id' => 'events_show_time',
									'type' => 'checkbox',
									'title' => esc_html__('Show Time', 'sonaar'),
									'value' => '0',
								),
								array(
									'id' => 'events_show_artists',
									'type' => 'checkbox',
									'title' => esc_html__('Show Artist Name', 'sonaar'),
									'value' => '1'
								),
							)
						),
						array(
							'id'    => 'iron_events_items',
							'title' => esc_html__('Look and Feel','sonaar'),
							'fields'=> array(
								array(
									'id' => 'events_item_typography',
									'type' => 'typography',
									'title' => esc_html__('Title Typography', 'sonaar'),
									'description' => esc_html__('Choose a font, font size and color', 'sonaar'),
									'value' => array(
										'font' => '',
										'font-readable' => '',
										'weight' => '',
										'size' => '30px',
										'color' => 'rgb(0, 0, 0)',
									)
								),
								array(
									'id'    => 'events_items_letterspacing',
									'type'  => 'text',
									'title' => esc_html__('Letter Spacing', 'sonaar'),
									'description' => esc_html__('enter value with px (eg: 2px)','sonaar'),
									'value' => '0px'
								),
								array(
									'id' => 'events_item_content_typography',
									'type' => 'typography',
									'title' => esc_html__('Content Typography', 'sonaar'),
									'description' => esc_html__('Choose a font, font size and color', 'sonaar'),
									'value' => array(
										'font' => '',
										'font-readable' => '',
										'weight' => '',
										'size' => '14px',
										'color' => 'rgb(0, 0, 0)',
									)
								),
								array(
									'id' => 'events_item_bg_color',
									'type' => 'text',
									'class' => 'color',
									'title' => esc_html__('Item Background Color', 'sonaar'),
									'value' => 'rgb(255, 255, 255)'
								),
								array(
									'id' => 'events_item_hover_bg_color',
									'type' => 'text',
									'class' => 'color',
									'title' => esc_html__('Item Hover Background Color', 'sonaar'),
									'value' => 'rgb(43, 43, 43)'
								),
								array(
									'id' => 'events_item_hover_text_color',
									'type' => 'text',
									'class' => 'color',
									'title' => esc_html__('Item Hover Text Color', 'sonaar'),
									'value' => 'rgb(255, 255, 255)'
								),
								array(
									'id' => 'events_outline_colors',
									'type' => 'text',
									'class' => 'color',
									'title' => esc_html__('Outline Color', 'sonaar'),
									'description' => esc_html__('For separators', 'sonaar'),
									'value' => 'rgb(43, 43, 43)'
								),
								array(
									'id'    => 'events_items_padding',
									'type'  => 'text',
									'title' => esc_html__('Padding between items', 'sonaar'),
									'description' => esc_html__('enter value with px. eg: 5px','sonaar'),
									'value' => '20px'
								),
							),
						),
						array(
							'id'    => 'iron_events_buttons',
							'title' => esc_html__('Button','sonaar'),
							'fields'=> array(
								array(
									'id' => 'events_button_more_info',
									'type' => 'checkbox',
									'title' => esc_html__('Show "More Info" button', 'sonaar'),
									'value' => '1'
								),
								array(
									'id' => 'events_buttons_text_color',
									'type' => 'text',
									'class' => 'color',
									'title' => esc_html__('Button Text Color', 'sonaar'),
									'value' => 'rgb(255, 255, 255)'
								),
								array(
									'id' => 'events_buttons_bg_color',
									'type' => 'text',
									'class' => 'color',
									'title' => esc_html__('Button Background Color', 'sonaar'),
									'value' => 'rgb(000, 000, 000)'
								),
								array(
									'id' => 'events_buttons_hover_text_color',
									'type' => 'text',
									'class' => 'color',
									'title' => esc_html__('Button Hover Text Color', 'sonaar'),
									'value' => 'rgb(255, 255, 255)'
								),
								array(
									'id' => 'events_buttons_hover_bg_color',
									'type' => 'text',
									'class' => 'color',
									'title' => esc_html__('Button Hover Background Color', 'sonaar'),
									'value' => 'rgb(000, 000, 000)'
								),
							),
						),
						array(
							'id'    => 'iron_events_countdown',
							'title' => esc_html__('Countdown','sonaar'),
							'fields'=> array(
								array(
									'id' => 'events_show_countdown_rollover',
									'type' => 'checkbox',
									'title' => esc_html__('Show countdown on rollover', 'sonaar'),
									'description' => esc_html__('When option is checked, an animated countdown will be shown when user rollover your event. This global setting may be overridden in each of your individual events.', 'sonaar'),
								),
								array(
									'id' => 'events_countdown_typography',
									'type' => 'typography',
									'title' => esc_html__('Typography', 'sonaar'),
									'description' => esc_html__('Choose a font, font size and color', 'sonaar'),
									'value' => array(
										'font' => '',
										'font-readable' => '',
										'weight' => '',
										'size' => '21px',
										'color' => 'rgb(255, 255, 255)',
									)
								),
								array(
									'id'    => 'events_countdown_letterspacing',
									'type'  => 'text',
									'title' => esc_html__('Letter Spacing', 'sonaar'),
									'description' => esc_html__('enter value with px','sonaar'),
									'value' => '0px'
								),
								array(
									'id' => 'events_countdown_bg_color',
									'type' => 'text',
									'class' => 'color',
									'title' => esc_html__('Background Color', 'sonaar'),
									'value' => 'rgb(143, 34, 75)'
								),
							),
						),
						array(
							'id'    => 'iron_events_filter',
							'title' => esc_html__('Artist Dropdown','sonaar'),
							'fields'=> array(
								array(
									'id' => 'events_filter',
									'type' => 'checkbox',
									'title' => esc_html__('Show Artist Dropdown', 'sonaar'),
									'description' => esc_html__('Show an artist dropdown selector above your list of events. If you have multiple artists, this can be usefull to filter your events by artists. This option only apply in pages that use the "Event Posts" template.','sonaar'),
									'switch' => true,
								),
								array(
									'id' => 'events_filter_typography',
									'type' => 'typography',
									'title' => esc_html__('Label Typography', 'sonaar'),
									'description' => esc_html__('Choose a font, font size and color', 'sonaar'),
									'value' => array(
										'font' => '',
										'font-readable' => '',
										'weight' => '',
										'size' => '15px',
										'color' => 'rgb(43, 43, 43)',
									)
								),
								array(
									'id'    => 'events_filter_letterspacing',
									'type'  => 'text',
									'title' => esc_html__('Label Letter Spacing', 'sonaar'),
									'description' => esc_html__('enter value with px (eg: 2px)','sonaar'),
									'value' => '0px'
								),
								array(
									'id' => 'events_filter_bg_color',
									'type' => 'text',
									'class' => 'color',
									'title' => esc_html__('Background Color', 'sonaar'),
									'value' => 'rgb(240, 240, 240)'
								),
								array(
									'id' => 'events_filter_outline_color',
									'type' => 'text',
									'class' => 'color',
									'title' => esc_html__('Event filter Outline Color', 'sonaar'),
									'description' => esc_html__('For dropdown outlines and arrow color', 'sonaar'),
									'value' => 'rgb(0, 0, 0)'
								),
							)
						),

					),
				),
				array(
					'page_title'	=> 'Import / Export',
					'menu_title' 	=> 'Import / Export',
					'capability'    => 'manage_options',
					'menu_slug'     => 'iron_music_import_export',
					'sections'      => array(
						array(
							'id'    => 'iron_import_export',
							'title' => esc_html__('Import / Export','sonaar'),
							'fields' => array(
								array(
									'id' => 'import_html',
									'title' => esc_html__('Data to import', 'sonaar'),
									'type' => 'html',
									'data' => '<textarea class="import"></textarea><br><button class="btn import">Import data</button>'
								),
								array(
									'id' => 'export_html',
									'title' => esc_html__('Data to export', 'sonaar'),
									'type' => 'htmlExport',
									'export_options' => array(
										'_iron_music_event_options',
								        '_iron_music_music_player_options',
								        '_iron_music_podcast_player_options',
								        '_iron_music_podcast_feed_options',
								        '_iron_music_discography_options'
								    )
								),
							)
						),
					),
				),
			),
	    ),
	);


	$ironFeatures_pages->pages( $ironFeatures_pages_options );

}
