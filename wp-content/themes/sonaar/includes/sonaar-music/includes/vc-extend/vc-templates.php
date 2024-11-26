<?php

add_filter( 'vc_load_default_templates', 'sonaar_reset_default_templates' ); // Hook in
function sonaar_reset_default_templates( $data ) {
    return array(); // This will remove all default templates. Basically you should use native PHP functions to modify existing array and then return it.
}

function sonaar_add_default_templates() {

	$templates = sonaar_vc_templates();
	return array_map( 'vc_add_default_templates', $templates );
}
sonaar_add_default_templates();

function sonaar_vc_templates() {

    $templates = array();
	/*************
    // ARTIST CATEGORY
  	**************/
  	//--
  	$data = array();
	$data['name'] = esc_html__( 'Artist 1', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/artist_01.jpg';
	$data['sort_name'] = 'Artist with soundcloud and social media';
	$data['custom_class'] = 'artist audioplayers';
	$data['content'] = <<<CONTENT
[vc_row full_width="stretch_row" css=".vc_custom_1511819306311{margin-top: 100px !important;margin-bottom: 100px !important;}" el_class="sonaar-templates-artist01"][vc_column][vc_single_image source="external_link" img_fullwidth="0" custom_src="https://assets.sonaar.io/vc_templates/artist_01.jpg"][vc_custom_heading text="Raymayor" font_container="tag:h1|text_align:left" use_theme_fonts="yes" fit_bg_text="0" css=".vc_custom_1511818031061{margin-bottom: 10px !important;}"][vc_row_inner][vc_column_inner el_class="center-mobile"][vc_btn title="" style="custom" custom_background="" custom_text="#000000" i_icon_fontawesome="fa fa-facebook" add_icon="true" link="url:%2F%2Ffacebook.com||target:%20_blank|"][vc_btn title="" style="custom" custom_background="" custom_text="#000000" i_icon_fontawesome="fa fa-twitter" add_icon="true" link="url:%2F%2Ftwitter.com||target:%20_blank|"][vc_btn title="" style="custom" custom_background="" custom_text="#000000" i_icon_fontawesome="fa fa-soundcloud" add_icon="true" link="url:%2F%2Fsoundcloud.com||target:%20_blank|"][vc_btn title="" style="custom" custom_background="" custom_text="#000000" i_icon_fontawesome="fa fa-instagram" add_icon="true" link="url:%2F%2Finstagram.com||target:%20_blank|"][/vc_column_inner][/vc_row_inner][vc_column_text]<p style="text-align: center;"><iframe src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/playlists/41031863&amp;color=ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false" width="100%" height="450" frameborder="no" scrolling="no"></iframe></p>[/vc_column_text][vc_btn title="An Optional Button Here" style="outline-custom" outline_custom_color="#000000" outline_custom_hover_background="#000000" outline_custom_hover_text="#ffffff" shape="round" size="lg" align="center" css=".vc_custom_1511819064876{margin-top: 50px !important;}"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;
	//--
  	$data = array();
	$data['name'] = esc_html__( 'Artist 2', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/artist_02.jpg';
	$data['sort_name'] = 'Very simple artist photo and play button';
	$data['custom_class'] = 'artist audioplayers';
	$data['content'] = <<<CONTENT
[vc_row full_width="stretch_row" equal_height="yes" content_placement="middle" css=".vc_custom_1511821231833{margin-top: 75px !important;}" el_class="sonaar-templates-artist02"][vc_column width="1/2"][vc_single_image source="external_link" external_style="vc_box_shadow_3d" img_fullwidth="0" custom_src="https://assets.sonaar.io/vc_templates/artist_01.jpg"][/vc_column][vc_column width="1/2"][vc_custom_heading text="Raymayor" use_theme_fonts="yes" fit_bg_text="0" css=".vc_custom_1511820593182{margin-bottom: 10px !important;}"][vc_row_inner css=".vc_custom_1511820403303{padding-right: 10px !important;padding-left: 10px !important;}"][vc_column_inner el_class="center-mobile"][vc_btn title="" style="custom" custom_background="#000000" custom_text="#ffffff" shape="round" size="sm" i_icon_fontawesome="fa fa-facebook" add_icon="true" link="url:%2F%2Ffacebook.com||target:%20_blank|"][vc_btn title="" style="custom" custom_background="#000000" custom_text="#ffffff" shape="round" size="sm" i_icon_fontawesome="fa fa-twitter" add_icon="true" link="url:%2F%2Ftwitter.com||target:%20_blank|"][vc_btn title="" style="custom" custom_background="#000000" custom_text="#ffffff" shape="round" size="sm" i_icon_fontawesome="fa fa-soundcloud" add_icon="true" link="url:%2F%2Fsoundcloud.com||target:%20_blank|"][vc_btn title="" style="custom" custom_background="#000000" custom_text="#ffffff" shape="round" size="sm" i_icon_fontawesome="fa fa-instagram" add_icon="true" link="url:%2F%2Finstagram.com||target:%20_blank|"][/vc_column_inner][/vc_row_inner][vc_btn title="Play Album" style="outline-custom" outline_custom_color="#3ea031" outline_custom_hover_background="#3ea031" outline_custom_hover_text="#ffffff" shape="round" size="lg" albums="2192" custom_onclick="true"][vc_btn title="View Profile" style="outline-custom" outline_custom_color="#3ea031" outline_custom_hover_background="#3ea031" outline_custom_hover_text="#ffffff" shape="round" size="lg"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;
	/*************
    // BIOGRAPHY CATEGORY
  	**************/
  	//--
  	$data = array();
	$data['name'] = esc_html__( 'Biography 1', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/biography-1.jpg';
	$data['sort_name'] = 'Biography';
	$data['custom_class'] = 'biography';
	$data['content'] = <<<CONTENT
[vc_row full_width="stretch_row" css_animation="fadeIn"][vc_column][vc_custom_heading text="Bio" font_container="tag:h3|text_align:center" use_theme_fonts="yes" fit_bg_text="1" css=".vc_custom_1511475629918{margin-bottom: 70px !important;border-bottom-width: 2px !important;padding-bottom: 12px !important;border-bottom-color: #848484 !important;border-bottom-style: solid !important;}"][vc_row_inner][vc_column_inner width="1/2"][vc_custom_heading text="ABOUT ME" font_container="tag:div|font_size:21px|text_align:left|line_height:24px" use_theme_fonts="yes" fit_bg_text="0" el_class="color1_txt sr-letter-spacing-6"][vc_custom_heading text="The song
of my heart" font_container="tag:div|font_size:67px|text_align:left|line_height:67px" use_theme_fonts="yes" fit_bg_text="0" el_class="color1_txt iron-responsive" css=".vc_custom_1511475616919{margin-top: 15px !important;margin-bottom: 35px !important;}"][vc_column_text]Hope Turner is a Amercicain indie singer, songwriter, and recording artist. With a modern indie sound, her last EP, Morning Shore exemplifies her eclectic style, which spans from soulful ballads to addictive pop tunes. Through her expressive lyrics she’s able to capture life’s moments and inspire her audience.[/vc_column_text][vc_single_image source="external_link" img_fullwidth="0" css=".vc_custom_1511472879063{margin-top: 25px !important;}" custom_src="https://assets.sonaar.io/vc_templates/signature01.png"][/vc_column_inner][vc_column_inner width="1/2"][vc_single_image source="external_link" img_fullwidth="0" custom_src="https://assets.sonaar.io/vc_templates/girl01.jpg"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;
  	//--		
	$data = array();
	$data['name'] = esc_html__( 'Biography 2', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/biography-2.jpg';
	$data['sort_name'] = 'Biography';
	$data['custom_class'] = 'biography';
	$data['content'] = <<<CONTENT
[vc_row iron_row_type="full_width" iron_remove_padding_medium="tabletnopadding" iron_remove_padding_small="" iron_overlay_pattern="" iron_parallax="" iron_bg_video="" css=".vc_custom_1509121489327{margin-top: 100px !important;margin-bottom: 100px !important;}"][vc_column][vc_custom_heading text="ABOUT" font_container="tag:h4|font_size:18px|text_align:center|line_height:20px" use_theme_fonts="yes" fit_bg_text="0" css=".vc_custom_1510160663951{margin-bottom: 50px !important;}"][vc_custom_heading text="Sonaar &amp; The Bands" font_container="tag:h1|font_size:36px|text_align:center|line_height:34px" use_theme_fonts="yes" fit_bg_text="0" css=".vc_custom_1509120218711{margin-bottom: -20px !important;}"][vc_custom_heading text="A journey that changed my life." font_container="tag:h1|font_size:34px|text_align:center|line_height:36px" google_fonts="font_family:Playfair%20Display%3Aregular%2Citalic%2C700%2C700italic%2C900%2C900italic|font_style:400%20italic%3A400%3Aitalic" fit_bg_text="0"][/vc_column][/vc_row][vc_row full_width="stretch_row_content_no_spaces" iron_row_type="full_width" iron_remove_padding_medium="tabletnopadding" iron_remove_padding_small="" iron_overlay_pattern="" iron_parallax="" iron_bg_video="" css=".vc_custom_1509463311290{background-position: 0 0 !important;background-repeat: repeat !important;}"][vc_column el_class=".nopadding "][vc_single_image source="external_link" img_fullwidth="0" custom_src="https://assets.sonaar.io/vc_templates/hero01.jpg"][/vc_column][/vc_row][vc_row iron_row_type="full_width" iron_remove_padding_medium="tabletnopadding" iron_remove_padding_small="" iron_overlay_pattern="" iron_parallax="" iron_bg_video="" css=".vc_custom_1491998717774{margin-top: 100px !important;margin-bottom: 100px !important;padding-right: 10px !important;padding-left: 10px !important;}"][vc_column][vc_custom_heading text="IT START WITH -" font_container="tag:h4|font_size:18px|text_align:left|line_height:20px" use_theme_fonts="yes" fit_bg_text="0" el_class=".costumespacing1" css=".vc_custom_1510160775612{margin-bottom: -15px !important;}"][vc_custom_heading text="An endless passion for music
for discovery, for people, for life." font_container="tag:h3|font_size:30px|text_align:left|line_height:38px" use_theme_fonts="yes" fit_bg_text="0" el_class=".costumespacing1"][vc_empty_space height="10px"][vc_row_inner gap="30" iron_bg_video=""][vc_column_inner width="1/2"][vc_column_text css=".vc_custom_1511476354985{margin-right: 4px !important;}"] When ipsum dolor sit amet, consectetur adipiscing elit. libero sit amet malesu ada vitae nulla sit amet blandit. Pellentesque sit finibus mag amet interdum diam. In non arcu non dolor iaculis magna sittesetincidunt id ac mauris. Donec vulputate tortor lorem. Suspendisse gravida mattis leo. Suspendisse potenti. Fusce finibus magna sittese amet malesuada lobortis. Etiam in consequat augue, ac faucibus massa. Nullam commodo libero sit amet dictum mattis. Donecodes facilisis pretium risus, semper vehicula magna convallis nec. Nunc congue ex nec enim facilisis, id tristique dolor vehicula. Nulla consect etur mollis odio, et condimentum sem. Aliquam ut quam sit amet lacus sagittis euismod non eu erat. Donec ac libero non nunc commodo porta. Donec vulputate tortor lorem. Suspendisse gravida mattis leo. Suspendisse potenti. Fusce finibus magna sittese amet malesuada lobortis. Etiam in consequat augue, ac faucibus massa. Nullam commodo libero sit amet dictum mattis. Donecodes facilisis pretium risus, semper vehicula magna convallis nec. Nunc congue ex nec enim facilisis, id tristique dolor vehicula.[/vc_column_text][/vc_column_inner][vc_column_inner width="1/2"][vc_column_text css=".vc_custom_1429213065231{margin-left: 4px !important;}"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut malesuada vitae nulla sit amet blandit. Pellentesque sit amet interdum diam. In non arcu non dolor iac ulis tincidunt id ac mauris. Donec vulputate tortor lorem. Suspendisse gravida mattis leo. Suspendisse potenti. Fusce finibus magna sit amet malesuada lobortis. Etiam in consequat augue, ac faucibus massa. Nullam commodo libero sit amet dictum mattis. Donec facilisis pretium risus, semper vehicula magna convallis nec. Faucibus massa. Nullam com modo libero sit amet dictum mattis. Pellentesque sit amet interdum diam. In non arcu non dolor iaculis tincidunt id ac mauris. Pellentesque sit amet interdum diam. In non arcu non dolor iaculis.Donec vulputate tortor lorem. Suspendisse gravida mattis leo. Suspendisse potenti. Fusce finibus magna sittese amet malesuada lobortis. Etiam in consequat augue, ac faucibus massa. Nullam commodo libero sit amet dictum mattis. Donecodes facilisis pretium risus, semper vehicula magna convallis nec. Nunc congue ex nec enim facilisis, id tristique dolor vehicula.[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;
  	//--	
	$data = array();
	$data['name'] = esc_html__( 'Biography 3', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/biography-3.jpg';
	$data['sort_name'] = 'Biography';
	$data['custom_class'] = 'biography';
	$data['content'] = <<<CONTENT
[vc_row full_height="yes" content_placement="middle" iron_row_type="in_container" iron_remove_padding_medium="tabletnopadding" iron_remove_padding_small="mobilenopadding" iron_overlay_pattern="" iron_parallax="" iron_bg_video="" css=".vc_custom_1510161473070{margin-bottom: 150px !important;}"][vc_column][vc_custom_heading text="About me" font_container="tag:h1|text_align:center" use_theme_fonts="yes" fit_bg_text="0"][vc_empty_space height="26px"][vc_custom_heading text="IT NEVER ENDS" font_container="tag:h4|font_size:18px|text_align:center|line_height:20px" use_theme_fonts="yes" fit_bg_text="0" el_class=".costumespacing1" css=".vc_custom_1510161309931{margin-bottom: -15px !important;}"][vc_custom_heading text="Passion never dies. It grows
stronger every day." font_container="tag:h3|font_size:30px|text_align:center|line_height:38px" use_theme_fonts="yes" fit_bg_text="0"][vc_column_text css=".vc_custom_1509121416703{padding-right: 5% !important;padding-left: 5% !important;}"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut malesuada vitae nulla sit amet blandit. Pellentesque sit amet interdum diam. In non arcu non dolor iac ulis tincidunt id ac mauris. Donec vulputate tortor lorem. Suspendisse gravida mattis leo. Suspendisse potenti. Fusce finibus magna sit amet malesuada lobortis. Etiam in consequat augue, ac faucibus massa. Nullam commodo libero sit amet dictum mattis. Donec facilisis pretium risus, semper vehicula magna convallis nec. Faucibus massa. Nullam com modo libero sit amet dictum mattis. Pellentesque sit amet interdum diam. In non arcu non dolor iaculis tincidunt id ac mauris. Pellentesque sit amet interdum diam. In non arcu non dolor iaculis.Donec vulputate tortor lorem. Suspendisse gravida mattis leo. Suspendisse potenti. Fusce finibus magna sittese amet malesuada lobortis. Etiam in consequat augue, ac faucibus massa. Nullam commodo libero sit amet dictum mattis. Donecodes facilisis pretium risus, semper vehicula magna convallis nec. Nunc congue ex nec enim facilisis, id tristique dolor vehicula.[/vc_column_text][vc_single_image source="external_link" alignment="center" img_fullwidth="0" css=".vc_custom_1511478911795{margin-top: 75px !important;margin-bottom: 75px !important;}" custom_src="https://assets.sonaar.io/vc_templates/signature01.png"][vc_btn title="CONTACT ME" style="outline-custom" outline_custom_color="#ca8837" outline_custom_hover_background="#ca8837" outline_custom_hover_text="#ffffff" size="lg" align="center" link="url:..%2Fcontact|||" css=".vc_custom_1510683523467{margin-top: 70px !important;}" el_class="style1-button"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;
  	//--	
	$data = array();
	$data['name'] = esc_html__( 'Biography 4', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/biography-4.jpg';
	$data['sort_name'] = 'Biography';
	$data['custom_class'] = 'biography';
	$data['content'] = <<<CONTENT
[vc_row full_width="stretch_row" css_animation="fadeIn" iron_row_type="full_width" iron_remove_padding_medium="tabletnopadding" iron_remove_padding_small="" iron_overlay_pattern="" iron_parallax="" iron_bg_video="" css=".vc_custom_1511480116287{background-image: url(https://assets.sonaar.io/vc_templates/hero02.gif) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}" el_class="sonaar-templates-biography-4-textoverlay"][vc_column][vc_row_inner equal_height="yes" content_placement="middle" iron_bg_video="" css=".vc_custom_1508625965078{margin-top: 150px !important;}"][vc_column_inner width="1/2"][vc_custom_heading text="DJ SONAAR<sup>®</sup>" font_container="tag:h3|font_size:36px|text_align:right|line_height:17px" use_theme_fonts="yes" fit_bg_text="0"][vc_custom_heading text="MEET THE BEAT" font_container="tag:h3|font_size:36px|text_align:right|color:%23c8ffc3|line_height:43px" use_theme_fonts="yes" fit_bg_text="0" css=".vc_custom_1508506718811{margin-top: -25px !important;}"][vc_column_text css=".vc_custom_1508770834090{padding-top: 12px !important;padding-bottom: 50px !important;}"]<p style="text-align: right;">JOSHUA GOLDEN, BETTER KNOWN BY HIS STAGE NAME DJ SONAAR, IS AN UK DUBSTEP MUSIC PRODUCER AND DJ. SONAAR DEBUTED IN 2011 WITH THE TRACK "DOWNBEAT", WHICH WAS RELEASED ON SONAAR MUSIC RECORDS. HIS DEBUT EP WAS IN TOP 5 OF THE BEATPORT DUBSTEP CHARTS FOR OVER 8 WEEKS. AT THE END OF THE YEAR, HIS MUSIC AND REMIXES WERE LICENSED TO COMPILATIONS ON LABELS LIKE WARNER AND MINISTRY OF SOUND.</p>[/vc_column_text][vc_single_image source="external_link" alignment="right" img_fullwidth="0" custom_src="https://assets.sonaar.io/vc_templates/signature02.png"][/vc_column_inner][vc_column_inner width="1/2"][vc_single_image source="external_link" alignment="right" img_fullwidth="0" custom_src="https://assets.sonaar.io/vc_templates/man01.png"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;	
  	//--	
	$data = array();
	$data['name'] = esc_html__( 'Biography 5', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/biography-5.jpg';
	$data['sort_name'] = 'Biography';
	$data['custom_class'] = 'biography';
	$data['content'] = <<<CONTENT
[vc_row full_width="stretch_row_content_no_spaces" content_placement="middle" iron_row_type="full_width" iron_remove_padding_medium="tabletnopadding" iron_remove_padding_small="" iron_overlay_pattern="" iron_parallax="" iron_bg_video="" css=".vc_custom_1511481734547{background-color: #ffffff !important;background-position: center !important;background-repeat: no-repeat !important;background-size: contain !important;}" el_class="sonaar-templates-biography-5"][vc_column width="1/2" css=".vc_custom_1510072594417{padding-right: 20% !important;padding-left: 20% !important;}"][vc_custom_heading text="Biography" font_container="tag:h2|font_size:30px|text_align:left|color:%23be0c53" use_theme_fonts="yes" fit_bg_text="0"][vc_empty_space height="9px"][vc_column_text]<span style="color: #000000;">If it’s music’s prerogative to change with the times, Kronoxx is the master of djing. He’s inspired the masses, rewired a worldwide passion for dance music and set a new precedent for fan interaction along the way. Add a who’s who list of collaborators, remixes, global live credentials and a side line in professional Kung Fu and there is still no rarer breed of superstar DJ than Kronoxx.</span>[/vc_column_text][vc_single_image source="external_link" img_fullwidth="0" css=".vc_custom_1511481583882{margin-top: 60px !important;}" custom_src="https://assets.sonaar.io/vc_templates/signature03.png"][/vc_column][vc_column width="1/2" css=".vc_custom_1510070580045{background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_single_image source="external_link" alignment="right" img_fullwidth="0" custom_src="https://assets.sonaar.io/vc_templates/photo01.jpg"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;	
  	//--	
	$data = array();
	$data['name'] = esc_html__( 'Biography 6', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/biography-6.jpg';
	$data['sort_name'] = 'Biography';
	$data['custom_class'] = 'biography';
	$data['content'] = <<<CONTENT
[vc_row full_width="stretch_row" equal_height="yes" css_animation="none" iron_row_type="full_width" iron_remove_padding_small="mobilenopadding" css=".vc_custom_1511555763715{background-image: url(https://assets.sonaar.io/vc_templates/bg_pattern_cartographer.png?id=) !important;}" el_class="sonaar_templates_bg_pattern"][vc_column css=".vc_custom_1461607904543{padding-top: 140px !important;}"][vc_row_inner equal_height="yes" content_placement="bottom" css=".vc_custom_1511553443056{background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_column_inner width="5/12"][vc_custom_heading text="PUT YOUR NAME HERE" font_container="tag:h2|font_size:86px|text_align:left|color:%23ff0000|line_height:70px" use_theme_fonts="yes" fit_bg_text="0" css=".vc_custom_1511553750473{border-bottom-width: 8px !important;padding-bottom: 70px !important;border-bottom-color: #ff0000 !important;border-bottom-style: solid !important;}"][vc_single_image source="external_link" img_fullwidth="0" css=".vc_custom_1511553609073{margin-top: -85px !important;margin-left: -20px !important;}" custom_src="https://assets.sonaar.io/vc_templates/signature04.png"][vc_column_text css=".vc_custom_1511556070544{padding-top: 30px !important;padding-bottom: 10px !important;}"]<span style="color: #ffffff;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate.</span>[/vc_column_text][vc_btn title="LEARN MORE" style="outline-custom" outline_custom_color="#ffffff" outline_custom_hover_background="#ffffff" outline_custom_hover_text="#000000" shape="round" size="lg" align="left" css=".vc_custom_1511555596171{margin-top: 30px !important;margin-bottom: 30px !important;}"][vc_empty_space height="100px"][/vc_column_inner][vc_column_inner width="7/12" css=".vc_custom_1511553953652{background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_single_image source="external_link" alignment="right" img_fullwidth="0" custom_src="https://assets.sonaar.io/vc_templates/man01.png"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;	
  	//--	
	$data = array();
	$data['name'] = esc_html__( 'Biography 7', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/biography-7.jpg';
	$data['sort_name'] = 'Biography';
	$data['custom_class'] = 'biography';
	$data['content'] = <<<CONTENT
	[vc_row full_width="stretch_row_content_no_spaces" iron_row_type="full_width" css=".vc_custom_1515445475280{margin-bottom: 150px !important;background-image: url(https://assets.sonaar.io/vc_templates/bio-bg.jpg) !important;background-position: 0 0 !important;background-repeat: no-repeat !important;}" el_class=".sonaar-templates-biography-7"][vc_column][vc_row_inner gap="35" css=".vc_custom_1456788182214{margin-top: 250px !important;}"][vc_column_inner][vc_custom_heading text="When words leave off music begins." font_container="tag:h1|font_size:36px|text_align:left|color:%23b51639|line_height:42px" use_theme_fonts="yes" fit_bg_text="0"][vc_separator color="custom" align="align_left" accent_color="#b51639"][vc_custom_heading text="MY STORY" font_container="tag:h3|font_size:12px|text_align:left|color:%23b51639|line_height:12px" use_theme_fonts="yes" fit_bg_text="0" css=".vc_custom_1515446947312{margin-top: 30px !important;}"][/vc_column_inner][/vc_row_inner][vc_row_inner gap="35" css=".vc_custom_1456788103810{margin-top: 125px !important;}"][vc_column_inner width="1/2"][vc_column_text]<p id="dropcap" style="text-align: justify;"><span class="dropcap">M</span>usic neutra paleo man bun. Portland deep v art party, freegan meh occupy 8-bit pinterest venmo tote bag knausgaard schlitz chia. Hella irony butcher distillery, pinterest letterpress DIY chia meggings seitan schlitz street art single-origin coffee trust fund. Small batch kickstarter banjo austin etsy mixtape. Listicle yuccie tacos, deep v celiac hoodie poutine flannel DIY pickled sustainable synth marfa polaroid. Dreamcatcher austin chambray.</p>[/vc_column_text][/vc_column_inner][vc_column_inner width="1/2"][vc_column_text]<p style="text-align: justify;">Squid migas cardigan vegan. Humblebrag meggings pug microdosing banjo tofu semiotics fixie. Literally dreamcatcher kitsch vinyl banjo tofu. Flexitarian hella waistcoat, keytar gluten-free meggings single-origin coffee green juice. Williamsburg organic lumbersexual, intelligentsia neutra cold-pressed cray franzen man bun next level food truck.</p>[/vc_column_text][/vc_column_inner][/vc_row_inner][vc_row_inner gap="35"][vc_column_inner][vc_single_image source="external_link" img_fullwidth="0" custom_src="https://assets.sonaar.io/vc_templates/signature05.png"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;	


	/*************
    // AUDIOPLAYER CATEGORY
  	**************/
  	//--
  	$data = array();
	$data['name'] = esc_html__( 'MP3 Player - Minimal', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/audioplayer-01.jpg';
	$data['sort_name'] = 'MP3 Audio Player';
	$data['custom_class'] = 'audioplayers';
	$data['content'] = <<<CONTENT
[vc_row full_width="stretch_row" iron_row_type="in_container" iron_remove_padding_medium="tabletnopadding" iron_id="music" css=".vc_custom_1511540992271{padding-top: 75px !important;padding-bottom: 75px !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_column][vc_custom_heading text="LISTEN TO MY NEW MIX" font_container="tag:h3|text_align:center|color:%23497274" use_theme_fonts="yes" css_animation="fadeInUp" fit_bg_text="0" css=".vc_custom_1510680257787{margin-top: 40px !important;}"][vc_row_inner][vc_column_inner][iron_audioplayer title="My Album Name" albums="2192" autoplay="0" show_playlist="0" show_album_market="1" css_animation="fadeInUp"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;
	//--
  	$data = array();
	$data['name'] = esc_html__( 'MP3 Player - With Tracklist', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/audioplayer-02.jpg';
	$data['sort_name'] = 'MP3 Audio Player';
	$data['custom_class'] = 'audioplayers';
	$data['content'] = <<<CONTENT
[vc_row full_width="stretch_row" iron_row_type="in_container" iron_remove_padding_medium="tabletnopadding" iron_id="music" css=".vc_custom_1511540992271{padding-top: 75px !important;padding-bottom: 75px !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_column][vc_custom_heading text="LISTEN TO MY NEW MIX" font_container="tag:h3|text_align:center|color:%23497274" use_theme_fonts="yes" css_animation="fadeInUp" fit_bg_text="0" css=".vc_custom_1510680257787{margin-top: 40px !important;}"][vc_row_inner][vc_column_inner][iron_audioplayer title="My Album Name" albums="2192" autoplay="0" show_playlist="1" show_album_market="1" css_animation="fadeInUp"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;
	//--
	$data = array();
	$data['name'] = esc_html__( 'MP3 Player - With Side Infos', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/audioplayer_withreview.jpg';
	$data['sort_name'] = 'MP3 Audio Player';
	$data['custom_class'] = 'audioplayers';
	$data['content'] = <<<CONTENT
[vc_row full_width="stretch_row" gap="35" equal_height="yes" css_animation="fadeIn" iron_row_type="in_container" iron_remove_padding_small="mobilenopadding" css=".vc_custom_1511547156728{margin-top: 75px !important;margin-bottom: 75px !important;}" el_class="sonaar_templates_audioplayer001"][vc_column width="1/3" css=".vc_custom_1511547255116{background-position: 0 0 !important;background-repeat: no-repeat !important;}"][vc_custom_heading text="CHROME
CRYING" font_container="tag:h2|font_size:52px|text_align:left|line_height:42px" use_theme_fonts="yes" fit_bg_text="0"][vc_custom_heading text="NEW EP AVAILABLE" font_container="tag:h5|font_size:12px|text_align:left|line_height:14px" use_theme_fonts="yes" fit_bg_text="0" css=".vc_custom_1511545374172{margin-top: -20px !important;padding-bottom: 20px !important;}"][vc_separator color="white" border_width="6"][vc_column_text css=".vc_custom_1511545557986{padding-top: 18px !important;padding-bottom: 25px !important;}"]A lovingly crafted tribute to one of NYC’s biggest influences featuring lush orchestral arrangements from DJ Sonaar. This is fresh and powerful.[/vc_column_text][vc_separator color="white" border_width="2"][vc_single_image source="external_link" img_fullwidth="0" css=".vc_custom_1511545998147{padding-top: 25px !important;padding-bottom: 8px !important;padding-left: 7px !important;}" custom_src="https://assets.sonaar.io/vc_templates/icon_5stars.png"][vc_custom_heading text="<i>`` His most solid opus ``</i>" font_container="tag:h3|font_size:24px|text_align:left|line_height:21px" use_theme_fonts="yes" fit_bg_text="0"][vc_column_text css=".vc_custom_1511547310622{margin-top: -10px !important;padding-bottom: 25px !important;}"]– John Doe[/vc_column_text][vc_separator color="white"][vc_custom_heading text="GET IT TODAY" font_container="tag:h4|font_size:30px|text_align:left|line_height:28px" use_theme_fonts="yes" fit_bg_text="0" css=".vc_custom_1511546591939{padding-top: 25px !important;}"][vc_btn title="BUY NOW $9.99" style="outline-custom" outline_custom_color="#ffffff" outline_custom_hover_background="#ffffff" outline_custom_hover_text="#000000" shape="square" size="lg" align="left"][/vc_column][vc_column width="2/3" css=".vc_custom_1511547274428{padding-top: 30px !important;background-position: 0 0 !important;background-repeat: no-repeat !important;}"][iron_audioplayer title="My Album Name" albums="2192" autoplay="0" show_playlist="0" show_album_market="1"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;
	//--
  	$data = array();
	$data['name'] = esc_html__( 'SoundCloud Player', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/audioplayer_soundcloud.jpg';
	$data['sort_name'] = 'SoundCloud Player';
	$data['custom_class'] = 'audioplayers';
	$data['content'] = <<<CONTENT
[vc_row css=".vc_custom_1511543621379{margin-top: 75px !important;}"][vc_column][vc_custom_heading text="My SoundCloud Album" font_container="tag:h2|text_align:center" use_theme_fonts="yes" fit_bg_text="0"][vc_custom_heading text="BY ARTIST NAME HERE" font_container="tag:h4|font_size:12px|text_align:center" use_theme_fonts="yes" fit_bg_text="0"][iron_image_divider divider_align="center" divider_padding_top="30"][vc_column_text css=".vc_custom_1511543510695{margin-top: 50px !important;margin-bottom: 50px !important;}"]</p><p style="text-align: center;"><iframe src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/playlists/41031863&amp;color=ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false" width="100%" height="450" frameborder="no" scrolling="no"></iframe></p>[/vc_column_text][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;
	//--
  	$data = array();
	$data['name'] = esc_html__( 'Spotify Player', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/audioplayer_spotify.jpg';
	$data['sort_name'] = 'Spotify Player';
	$data['custom_class'] = 'audioplayers';
	$data['content'] = <<<CONTENT
[vc_row css=".vc_custom_1511543621379{margin-top: 75px !important;}"][vc_column][vc_custom_heading text="My Spotify Album" font_container="tag:h2|text_align:center" use_theme_fonts="yes" fit_bg_text="0"][vc_custom_heading text="BY ARTIST NAME HERE" font_container="tag:h4|font_size:12px|text_align:center" use_theme_fonts="yes" fit_bg_text="0"][iron_image_divider divider_align="center" divider_padding_top="30"][vc_column_text css=".vc_custom_1511543812579{margin-top: 50px !important;margin-bottom: 50px !important;}"]<p style="text-align: center;"><iframe src="https://embed.spotify.com/?uri=spotify%3Aalbum%3A4llZzMDzP0sYoRro9Ypbmi" width="80%" height="750" frameborder="0"></iframe></p>[/vc_column_text][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;
	//--
  	$data = array();
	$data['name'] = esc_html__( 'BandCamp Player', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/audioplayer_bandcamp.jpg';
	$data['sort_name'] = 'BandCamp Player';
	$data['custom_class'] = 'audioplayers';
	$data['content'] = <<<CONTENT
[vc_row css=".vc_custom_1511543621379{margin-top: 75px !important;}"][vc_column][vc_custom_heading text="My BandCamp Album" font_container="tag:h2|text_align:center" use_theme_fonts="yes" fit_bg_text="0"][vc_custom_heading text="BY ARTIST NAME HERE" font_container="tag:h4|font_size:12px|text_align:center" use_theme_fonts="yes" fit_bg_text="0"][iron_image_divider divider_align="center" divider_padding_top="30"][vc_column_text css=".vc_custom_1511544145606{margin-top: 50px !important;margin-bottom: 50px !important;}"]<p style="text-align: center;"><iframe style="border: 0; width: 350px; height: 470px;" src="https://bandcamp.com/EmbeddedPlayer/album=3320850204/size=large/bgcol=ffffff/linkcol=0687f5/tracklist=false/transparent=true/" width="300" height="150" seamless=""><a href="http://deadobies.bandcamp.com/album/montr-al-ud">Montreal Sud by Dead Obies</a></iframe></p>[/vc_column_text][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;
  	//--		
	
	/*************
    // BANNER CATEGORY
  	**************/
   	//-- 	
  	$data = array();
	$data['name'] = esc_html__( 'Quote and Signature 1', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/banner-01.jpg';
	$data['sort_name'] = 'Banners';
	$data['custom_class'] = 'banners';
	$data['content'] = <<<CONTENT
[vc_row full_width="stretch_row" content_placement="middle" css=".vc_custom_1511493168465{background-image: url(https://sonaar-clone-maximejutras.c9users.io/wp-content/uploads/2017/11/event_banner.jpg?id=95) !important;}"][vc_column][vc_row_inner content_placement="middle" gap="35"][vc_column_inner width="1/2"][vc_custom_heading text="One good thing about music, when it hits you, you feel no pain." font_container="tag:h2|font_size:42px|text_align:left|line_height:42px" use_theme_fonts="yes" fit_bg_text="0"][vc_column_text]Singing is my passion, my first love and the secret of my energy. It gives me a great joy to see audiences enjoying with me. When I sing, I can feel romance in everything around me.[/vc_column_text][vc_single_image source="external_link" img_fullwidth="0" custom_src="http://assets.sonaar.io/vc_templates/signature02.png" css=".vc_custom_1511493008723{margin-top: 20px !important;margin-bottom: 20px !important;}"][/vc_column_inner][vc_column_inner width="1/2"][vc_single_image source="external_link" img_fullwidth="0" custom_src="http://assets.sonaar.io/vc_templates/photo01.jpg" css=".vc_custom_1511492877779{margin-top: 20px !important;margin-bottom: 20px !important;}"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;		
   	//-- 	
  	$data = array();
	$data['name'] = esc_html__( 'Quote and Signature 2', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/banner-02.jpg';
	$data['sort_name'] = 'Banners';
	$data['custom_class'] = 'banners';
	$data['content'] = <<<CONTENT
[vc_row full_width="stretch_row" parallax="content-moving" iron_row_type="full_width" iron_parallax="parallax" css=".vc_custom_1511562099702{margin-top: 75px !important;margin-bottom: 75px !important;padding-top: 150px !important;padding-bottom: 150px !important;background-image: url(https://assets.sonaar.io/vc_templates/hero_03_piano.jpg) !important;}"][vc_column][vc_row_inner][vc_column_inner][vc_empty_space height="30px"][vc_custom_heading text="Where words fail, music speaks" font_container="tag:h2|font_size:64px|text_align:center|color:%23ffffff|line_height:54px" use_theme_fonts="yes" fit_bg_text="0"][vc_custom_heading text="I could crawl into the space between the notes and curl my back to loneliness.<br />Music was my refuge." font_container="tag:h3|font_size:18px|text_align:center|color:%23ffffff|line_height:18px" use_theme_fonts="yes" fit_bg_text="0"][vc_single_image source="external_link" alignment="center" img_fullwidth="0" custom_src="https://assets.sonaar.io/vc_templates/signature04.png" css=".vc_custom_1511558198956{margin-top: 50px !important;}"][vc_btn title="Learn More" style="outline-custom" outline_custom_color="#ffffff" outline_custom_hover_background="#ffffff" outline_custom_hover_text="#000000" shape="round" size="lg" align="center" css=".vc_custom_1511558371374{margin-top: 30px !important;}"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;
	//-- 	
  	$data = array();
	$data['name'] = esc_html__( 'Shop Banner 1', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/banner-shop01.jpg';
	$data['sort_name'] = 'Banners';
	$data['custom_class'] = 'banners shop';
	$data['content'] = <<<CONTENT
[vc_row full_width="stretch_row_content_no_spaces" equal_height="yes" content_placement="middle" gradient_bg="yes" css=".vc_custom_1515534750529{margin-top: 100px !important;margin-bottom: 100px !important;}" el_class="sonaar-templates-banner-shop1" gradient_bg_color="linear-gradient(100deg,rgb(225, 14, 80) 0%,rgb(247, 205, 176) 88.8%)|background-size: auto auto;background-position: 50% 50%;background-repeat: repeat;background-attachment: scroll;background-origin: border-box;background-clip: border-box;"][vc_column width="1/2" css=".vc_custom_1510782539137{background-image: url(https://assets.sonaar.io/vc_templates/banner-shop-cocomo-tee.png) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][/vc_column][vc_column width="1/2" css=".vc_custom_1500323487513{margin-top: 100px !important;margin-bottom: 80px !important;padding-left: 40px !important;}"][vc_custom_heading text="Get 10% Off
Your First Order" font_container="tag:h3|font_size:50px|text_align:left|color:%23ffffff|line_height:60px" use_theme_fonts="yes" fit_bg_text="0"][vc_btn title="shop now" style="outline-custom" outline_custom_color="#ffffff" outline_custom_hover_background="#ffffff" outline_custom_hover_text="#000000" shape="square" size="lg" align="left" i_align="right" i_type="material" i_icon_material="vc-material vc-material-arrow_forward" add_icon="true" link="url:%23|||" el_class="promo-button" css=".vc_custom_1511741134652{margin-top: 30px !important;}"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;		
	//-- 	
  	$data = array();
	$data['name'] = esc_html__( 'Banner with Video Background', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/rowvideobackground01.jpg';
	$data['sort_name'] = 'Banner with Video Background';
	$data['custom_class'] = 'banners';
	$data['content'] = <<<CONTENT
[vc_row full_width="stretch_row" video_bg="yes" video_bg_url="https://www.youtube.com/watch?v=JNQ5VvvSTC0" css=".vc_custom_1511814874578{padding-top: 250px !important;padding-bottom: 250px !important;}"][vc_column][vc_custom_heading text="PUT YOUR TITLE HERE" font_container="tag:h1|text_align:center|color:%23ffffff" use_theme_fonts="yes" fit_bg_text="0"][vc_custom_heading text="WITH A VERY NICE SLOGAN HERE" font_container="tag:h3|font_size:21px|text_align:center|color:%23ffffff|line_height:18px" use_theme_fonts="yes" fit_bg_text="0" css=".vc_custom_1511815989602{margin-top: -20px !important;}"][vc_btn title="Your Cool Button" style="outline-custom" outline_custom_color="#ffffff" outline_custom_hover_background="#ffffff" outline_custom_hover_text="#000000" shape="round" size="lg" align="center" css=".vc_custom_1511815830318{margin-top: 50px !important;margin-bottom: 50px !important;}"][vc_custom_heading text="<strong>Instruction:</strong> Edit this container's row by clicking the ``pen`` icon, then you will see the URL to insert your own YouTube Video. See screenshot: http://d.pr/i/hzCUqU
Please note that background video won't work on mobile device. You can set an image fallback by going to the design options tab.
You can delete this block after you understand how it works. " font_container="tag:p|font_size:12px|text_align:center|color:%23ffffff|line_height:14px" use_theme_fonts="yes" fit_bg_text="1" link="url:http%3A%2F%2Fd.pr%2Fi%2FhzCUqU||target:%20_blank|" css=".vc_custom_1511816107859{margin-top: 50px !important;margin-bottom: 50px !important;padding-top: 50px !important;padding-right: 50px !important;padding-bottom: 50px !important;padding-left: 50px !important;background-color: rgba(10,10,10,0.5) !important;*background-color: rgb(10,10,10) !important;}"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;
	//-- 	
	$data = array();
	$data['name'] = esc_html__( 'Banner with Gradient Background 01', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/banner-gradient_01.jpg';
	$data['sort_name'] = 'Banners';
	$data['custom_class'] = 'banners';
	$data['content'] = <<<CONTENT
[vc_row full_width="stretch_row_content" gradient_bg="yes" gradient_bg_color="linear-gradient(317deg,rgb(88, 197, 125) 1.9%,rgb(101, 215, 202) 100%)|background-size: auto auto;background-position: 50% 50%;background-repeat: repeat;background-attachment: scroll;background-origin: border-box;background-clip: border-box;" css=".vc_custom_1515533544692{padding-top: 90px !important;padding-right: 20px !important;padding-bottom: 90px !important;padding-left: 20px !important;}"][vc_column][vc_custom_heading text="The Future of Music" font_container="tag:h2|font_size:66px|text_align:center|color:%23ffffff|line_height:55px" use_theme_fonts="yes" enable_fittext="yes" fittex_size="66px" css=".vc_custom_1515533554685{margin-top: 10px !important;}"][vc_custom_heading text="Explore our curated playlists and discover stunning beats and tracks." font_container="tag:div|font_size:22px|text_align:center|color:%23ffffff|line_height:26px" use_theme_fonts="yes" css=".vc_custom_1515533566633{margin-bottom: 10px !important;}"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;
	//-- 	
	$data = array();
	$data['name'] = esc_html__( 'Banner with Gradient Background 02', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/banner-gradient_02.jpg';
	$data['sort_name'] = 'Banners';
	$data['custom_class'] = 'banners';
	$data['content'] = <<<CONTENT
[vc_row full_width="stretch_row_content" gradient_bg="yes" gradient_bg_color="linear-gradient(317deg,rgb(250, 198, 136) 1.9%,rgb(130, 117, 220) 100%)|background-size: auto auto;background-position: 50% 50%;background-repeat: repeat;background-attachment: scroll;background-origin: border-box;background-clip: border-box;" css=".vc_custom_1515533307949{padding-top: 90px !important;padding-right: 20px !important;padding-bottom: 90px !important;padding-left: 20px !important;}"][vc_column][vc_custom_heading text="The Future of Music" font_container="tag:h2|font_size:66px|text_align:center|color:%23ffffff|line_height:55px" use_theme_fonts="yes" enable_fittext="yes" fittex_size="66px" css=".vc_custom_1515533173082{margin-top: 10px !important;}"][vc_custom_heading text="Explore our curated playlists and discover stunning beats and tracks." font_container="tag:div|font_size:22px|text_align:center|color:%23ffffff|line_height:26px" use_theme_fonts="yes" css=".vc_custom_1515533183746{margin-bottom: 10px !important;}"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;
	//-- 	
	$data = array();
	$data['name'] = esc_html__( 'Banner with Gradient Background 03', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/banner-gradient_03.jpg';
	$data['sort_name'] = 'Banners';
	$data['custom_class'] = 'banners';
	$data['content'] = <<<CONTENT
[vc_row full_width="stretch_row_content" gradient_bg="yes" gradient_bg_color="linear-gradient(317deg,rgb(109, 89, 245) 2.6%,rgb(120, 198, 240) 100%)|background-size: auto auto;background-position: 50% 50%;background-repeat: repeat;background-attachment: scroll;background-origin: border-box;background-clip: border-box;" css=".vc_custom_1515533739039{padding-top: 90px !important;padding-right: 20px !important;padding-bottom: 90px !important;padding-left: 20px !important;}"][vc_column][vc_custom_heading text="The Future of Music" font_container="tag:h2|font_size:66px|text_align:center|color:%23ffffff|line_height:55px" use_theme_fonts="yes" enable_fittext="yes" fittex_size="66px" css=".vc_custom_1515533554685{margin-top: 10px !important;}"][vc_custom_heading text="Explore our curated playlists and discover stunning beats and tracks." font_container="tag:div|font_size:22px|text_align:center|color:%23ffffff|line_height:26px" use_theme_fonts="yes" css=".vc_custom_1515533566633{margin-bottom: 10px !important;}"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;
	//-- 	
	$data = array();
	$data['name'] = esc_html__( 'Banner 2 columns 01', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/banner-2columns_1.jpg';
	$data['sort_name'] = 'Banners';
	$data['custom_class'] = 'banners';
	$data['content'] = <<<CONTENT
[vc_row equal_height="yes" content_placement="middle" el_class="sonaar-templates-banner-2columns-1" css=".vc_custom_1519936945984{margin-top: 50px !important;margin-bottom: 80px !important;}"][vc_column width="1/3" css=".vc_custom_1518644054185{padding-right: 0px !important;}" align="text-lg-right text-md-right text-sm-center text-xs-center"][vc_custom_heading text="WELCOME
TO OUR
STUDIO" font_container="tag:h2|font_size:72px|text_align:right|color:%2300ad8e|line_height:68px" google_fonts="font_family:Oswald%3A200%2C300%2Cregular%2C500%2C600%2C700|font_style:700%20bold%20regular%3A700%3Anormal"][/vc_column][vc_column width="2/3" enable_responsive_options="yes" css=".vc_custom_1518644071646{padding-right: 10px !important;padding-left: 40px !important;}" responsive_css="padding_right_tablet:20|padding_left_tablet:20|padding_right_mobile:15|padding_left_mobile:15" align="text-sm-center text-xs-center"][vc_column_text css=".vc_custom_1518640841929{padding-right: 15px !important;padding-left: 15px !important;}"]<span style="color: #d7d7d7;">We are a recording studio located in New York City. We cover everything from epic original tracks to talent management, licensing, sound recording and design.</span>[/vc_column_text][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;
	
	
	/*************
    // CONTACT CATEGORY
  	**************/
   	//-- 	
  	$data = array();
	$data['name'] = esc_html__( 'Contact 1', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/contact-1.jpg';
	$data['sort_name'] = 'Contact';
	$data['custom_class'] = 'contact form';
	$data['content'] = <<<CONTENT
	[vc_row full_width="stretch_row" content_placement="middle" el_class="whitetext" css=".vc_custom_1511539542000{background-image: url(https://assets.sonaar.io/vc_templates/hero_03_piano.jpg?id=) !important;}"][vc_column][vc_row_inner equal_height="yes" gap="25" css=".vc_custom_1509379926995{padding-right: 90px !important;padding-left: 90px !important;}"][vc_column_inner][vc_custom_heading text="Contact" font_container="tag:h1|text_align:left" use_theme_fonts="yes" fit_bg_text="0"][/vc_column_inner][/vc_row_inner][vc_row_inner content_placement="top" gap="25" css=".vc_custom_1509379676433{padding-right: 90px !important;padding-left: 90px !important;}"][vc_column_inner width="1/2" css=".vc_custom_1509379766788{margin-bottom: 40px !important;}"][vc_column_text css=".vc_custom_1509631003385{margin-bottom: 70px !important;}" el_class="whitetext"]</p>
<h2>Address &amp; Contact</h2>
<p><strong>SoundRise HQ</strong></p>
<p>PO Box 4296</p>
<p>Montreal</p>
<p>H4C 2V7</p>
<p>General Inquiries</p>
<p><a href="mailto:info@soundrise.com">info@soundrise.com</a></p>
<p>Interested in joining us ?</p>
<p><a href="mailto:jobs@soundrise.com">jobs@soundrise.com</a>[/vc_column_text][vc_column_text css=".vc_custom_1509379723898{margin-bottom: 70px !important;}"]</p>
<h2>Say something here or delete me.</h2>
<p>We are now only accepting demos in digital form. Please email <a href="mailto:demo@soundrise.com">demos@soundrise.com</a> with links to MP3 files. Please remember to include contact details within the email body and keep your submission short and sweet, best tracks first.[/vc_column_text][/vc_column_inner][vc_column_inner width="1/2" css=".vc_custom_1509379612620{margin-bottom: 70px !important;}"][contact-form-7 id="4"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]

CONTENT;
	$templates[] = $data;	
   	//-- 	
  	$data = array();
	$data['name'] = esc_html__( 'Contact 2', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/contact-2.jpg';
	$data['sort_name'] = 'Contact';
	$data['custom_class'] = 'contact form';
	$data['content'] = <<<CONTENT
	[vc_row content_placement="top"][vc_column][vc_row_inner css=".vc_custom_1511489703113{padding-top: 90px !important;padding-right: 90px !important;padding-left: 90px !important;}"][vc_column_inner][vc_custom_heading text="Contact" font_container="tag:h1|text_align:left" use_theme_fonts="yes" fit_bg_text="0" css=".vc_custom_1509378682054{border-bottom-width: 2px !important;padding-bottom: 20px !important;border-bottom-color: #ffffff !important;border-bottom-style: solid !important;}"][/vc_column_inner][/vc_row_inner][vc_row_inner css=".vc_custom_1511489714121{padding-right: 90px !important;padding-bottom: 90px !important;padding-left: 90px !important;}"][vc_column_inner width="1/3"][vc_column_text]
<h2>Address &amp; Contact</h2>
<strong>SoundRise HQ</strong>
PO Box 4296
Montreal QC
H4C 2V7

General Inquiries
<a href="mailto:info@soundrise.com">info@soundrise.com</a>

Interested in joining us ?
<a href="mailto:jobs@soundrise.com">jobs@soundrise.com</a>[/vc_column_text][/vc_column_inner][vc_column_inner width="2/3"][contact-form-7 id="79"][/vc_column_inner][/vc_row_inner][vc_row_inner css=".vc_custom_1511489720048{padding-right: 90px !important;padding-bottom: 90px !important;padding-left: 90px !important;}"][vc_column_inner][vc_custom_heading text="Say something here or delete me" font_container="tag:h1|text_align:left" use_theme_fonts="yes" fit_bg_text="0" css=".vc_custom_1509378975531{border-bottom-width: 2px !important;padding-bottom: 20px !important;border-bottom-color: #ffffff !important;border-bottom-style: solid !important;}"][vc_column_text]We are now only accepting demos in digital form. Please email <a href="mailto:demo@soundrise.com">demos@soundrise.com</a> with links to MP3 files (but NO MP3 email attachments please!), SoundCloud pages, or websites. Please remember to include contact details within the email body and keep your submission short and sweet, best tracks first.

Please don't chase us for a response. If we like it we will get in touch with you.[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;	
   	//-- 	
  	$data = array();
	$data['name'] = esc_html__( 'Contact 3', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/contact-3.jpg';
	$data['sort_name'] = 'Contact';
	$data['custom_class'] = 'contact form';
	$data['content'] = <<<CONTENT
[vc_row css=".vc_custom_1511816674435{margin-top: 100px !important;margin-bottom: 100px !important;}"][vc_column][vc_row_inner][vc_column_inner width="3/4" css=".vc_custom_1508863871994{margin-bottom: 75px !important;}"][vc_custom_heading text="Say Hello" use_theme_fonts="yes" fit_bg_text="0"][vc_separator color="custom" align="align_left" border_width="2" accent_color="#ffffff"][vc_empty_space height="25px"][vc_column_text css=".vc_custom_1511816972207{margin-bottom: 30px !important;}"]<h5 style="text-transform: uppercase;">Whether you have an interesting project or just want to say hi, feel free to shoot me a message.</h5>[/vc_column_text][contact-form-7 id="735"][/vc_column_inner][vc_column_inner width="1/4"][vc_custom_heading text="Contact" use_theme_fonts="yes" fit_bg_text="0"][vc_separator color="custom" align="align_left" border_width="2" accent_color="#ffffff"][vc_empty_space height="35px"][vc_column_text]<h4 style="text-align: left;">Booking Info</h4><h5 style="text-align: left;">Patrick Taylor<a href="mailto:hello@email.com" target="_blank" rel="noopener">hello@email.com</a><br>t+ 514-555-9075</h5>[/vc_column_text][vc_empty_space][vc_column_text]<h4 style="text-align: left;">Management</h4><h5>Mike Smith<a href="mailto:hello@email.com" target="_blank" rel="noopener">hello@email.com</a><br>t+ 514-555-9075</h5>[/vc_column_text][vc_empty_space][vc_column_text]<h4 style="text-align: left;">Press Contact</h4><h5>Shanie McDavid<a href="mailto:hello@email.com" target="_blank" rel="noopener">hello@email.com</a><br>t+ 514-555-9075</h5>[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;		
   	//-- 	
  	$data = array();
	$data['name'] = esc_html__( 'Contact 4', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/contact-4.jpg';
	$data['sort_name'] = 'Contact';
	$data['custom_class'] = 'contact team';
	$data['content'] = <<<CONTENT
[vc_row full_width="stretch_row" parallax="content-moving" iron_row_type="in_container" iron_remove_padding_medium="" iron_remove_padding_small="" iron_overlay_pattern="" iron_parallax="" iron_bg_video="" iron_id="contact" css=".vc_custom_1511491229246{padding-top: 300px !important;padding-bottom: 300px !important;background-image: url(https://assets.sonaar.io/vc_templates/hero02.jpg) !important;}"][vc_column][vc_custom_heading text="CONTACT / BOOKING" font_container="tag:h3|text_align:center" use_theme_fonts="yes" css_animation="fadeInUp" fit_bg_text="0" css=".vc_custom_1510693093892{margin-top: 40px !important;margin-bottom: 70px !important;}"][vc_row_inner equal_height="yes" gap="30" iron_bg_video="" css=".vc_custom_1510677981518{margin-top: 40px !important;}" el_class="contactus"][vc_column_inner width="1/3" css=".vc_custom_1510678022093{margin-bottom: 40px !important;border-top-width: 2px !important;border-bottom-width: 6px !important;padding-bottom: 30px !important;background-color: rgba(0,0,0,0.5) !important;*background-color: rgb(0,0,0) !important;border-top-color: #ffffff !important;border-top-style: solid !important;border-bottom-color: #ffffff !important;border-bottom-style: solid !important;}"][vc_custom_heading text="PRESS" font_container="tag:h3|font_size:12px|text_align:center" use_theme_fonts="yes" css_animation="fadeInUp" fit_bg_text="1" fit_bg_align="fit_bg_center" css=".vc_custom_1510675712194{padding-top: 8px !important;padding-right: 70px !important;padding-bottom: 8px !important;padding-left: 70px !important;background-color: #497274 !important;}" el_class=".letterspacing20px"][vc_custom_heading text="GILL" font_container="tag:h2|text_align:center" use_theme_fonts="yes" css_animation="fadeInUp" fit_bg_text="0" css=".vc_custom_1510614452727{margin-top: 45px !important;margin-bottom: 0px !important;}"][vc_custom_heading text="CHRISTOPHER" font_container="tag:h2|text_align:center" use_theme_fonts="yes" css_animation="fadeInUp" fit_bg_text="0" css=".vc_custom_1510614447773{margin-top: 0px !important;margin-bottom: 28px !important;}"][vc_column_text css_animation="fadeInUp"]</p>
<p style="text-align: center;">t+ 1-514-666-9078<br />
<a href="mailto:contact@sonaar.com">contact@sonaar.com</a></p>
<p>[/vc_column_text][/vc_column_inner][vc_column_inner width="1/3" css=".vc_custom_1510678062642{margin-bottom: 40px !important;border-top-width: 2px !important;border-bottom-width: 6px !important;padding-bottom: 30px !important;background-color: rgba(0,0,0,0.5) !important;*background-color: rgb(0,0,0) !important;border-top-color: #ffffff !important;border-top-style: solid !important;border-bottom-color: #ffffff !important;border-bottom-style: solid !important;}"][vc_custom_heading text="BOOKING" font_container="tag:h3|font_size:12px|text_align:center" use_theme_fonts="yes" css_animation="fadeInUp" fit_bg_text="1" fit_bg_align="fit_bg_center" css=".vc_custom_1510675717698{padding-top: 8px !important;padding-right: 70px !important;padding-bottom: 8px !important;padding-left: 70px !important;background-color: #497274 !important;}" el_class=".letterspacing20px "][vc_custom_heading text="MAX" font_container="tag:h2|text_align:center" use_theme_fonts="yes" css_animation="fadeInUp" fit_bg_text="0" css=".vc_custom_1510614472059{margin-top: 45px !important;margin-bottom: 0px !important;}"][vc_custom_heading text="PACCIORETTY" font_container="tag:h2|text_align:center" use_theme_fonts="yes" css_animation="fadeInUp" fit_bg_text="0" css=".vc_custom_1510614477373{margin-top: 0px !important;margin-bottom: 28px !important;}"][vc_column_text css_animation="fadeInUp"]</p>
<p style="text-align: center;">t+ 1-514-666-9078<br />
<a href="mailto:contact@sonaar.com">contact@sonaar.com</a></p>
<p>[/vc_column_text][/vc_column_inner][vc_column_inner width="1/3" css=".vc_custom_1510678068249{margin-bottom: 40px !important;border-top-width: 2px !important;border-bottom-width: 6px !important;padding-bottom: 30px !important;background-color: rgba(0,0,0,0.5) !important;*background-color: rgb(0,0,0) !important;border-top-color: #ffffff !important;border-top-style: solid !important;border-bottom-color: #ffffff !important;border-bottom-style: solid !important;}"][vc_custom_heading text="LABEL" font_container="tag:h3|font_size:12px|text_align:center" use_theme_fonts="yes" css_animation="fadeInUp" fit_bg_text="1" fit_bg_align="fit_bg_center" css=".vc_custom_1510675723080{padding-top: 8px !important;padding-right: 70px !important;padding-bottom: 8px !important;padding-left: 70px !important;background-color: #497274 !important;}" el_class=".letterspacing20px "][vc_custom_heading text="RICK" font_container="tag:h2|text_align:center" use_theme_fonts="yes" css_animation="fadeInUp" fit_bg_text="0" css=".vc_custom_1510614498622{margin-top: 45px !important;margin-bottom: 0px !important;}"][vc_custom_heading text="McDONAUGH" font_container="tag:h2|text_align:center" use_theme_fonts="yes" css_animation="fadeInUp" fit_bg_text="0" css=".vc_custom_1510614504509{margin-top: 0px !important;margin-bottom: 28px !important;}"][vc_column_text css_animation="fadeInUp"]</p>
<p style="text-align: center;">t+ 1-514-666-9078<br />
<a href="mailto:contact@sonaar.com">contact@sonaar.com</a></p>
<p>[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;
   	//-- 	
	$data = array();
	$data['name'] = esc_html__( 'Contact 5', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/contact-5.jpg';
	$data['sort_name'] = 'Contact';
	$data['custom_class'] = 'contact team';
	$data['content'] = <<<CONTENT
[vc_row full_width="stretch_row" css_animation="fadeIn" iron_row_type="full_width" iron_remove_padding_medium="" iron_remove_padding_small="mobilenopadding" iron_overlay_pattern="" iron_parallax="" iron_bg_video="" css=".vc_custom_1515611344144{padding-top: 45px !important;padding-bottom: 150px !important;background-position: 0 0 !important;background-repeat: no-repeat !important;}" iron_id="contact"][vc_column][vc_row_inner iron_bg_video=""][vc_column_inner css=".vc_custom_1515610451035{padding-left: 1px !important;}"][vc_custom_heading text="Contact" font_container="tag:h2|font_size:131px|text_align:left|line_height:120px" use_theme_fonts="yes" enable_fittext="yes" fit_bg_text="0" css=".vc_custom_1515611354252{margin-bottom: 20px !important;padding-bottom: 24px !important;}"][/vc_column_inner][/vc_row_inner][vc_row_inner iron_bg_video="" css=".vc_custom_1462823099855{padding-top: 55px !important;padding-bottom: 55px !important;}"][vc_column_inner width="1/3" css=".vc_custom_1515610373404{padding-top: 50px !important;padding-right: 1px !important;padding-left: 1px !important;}"][vc_custom_heading text="Mgmt" font_container="tag:h3|font_size:48px|text_align:left|line_height:48px" use_theme_fonts="yes" fit_bg_text="0" css=".vc_custom_1515683248180{margin-top: 0px !important;margin-bottom: 0px !important;border-bottom-width: 1px !important;padding-bottom: 27px !important;border-bottom-style: dashed !important;}"][vc_column_text css=".vc_custom_1515683403266{border-bottom-width: 1px !important;padding-top: 10px !important;padding-bottom: 14px !important;border-bottom-style: dashed !important;}"]Leila Kandera
T+ 1-514-666-9078[/vc_column_text][vc_column_text css=".vc_custom_1515683755987{border-bottom-width: 1px !important;padding-top: 14px !important;padding-bottom: 12px !important;border-bottom-style: dashed !important;}"]Kandera@mgm.com[/vc_column_text][/vc_column_inner][vc_column_inner width="1/3" css=".vc_custom_1460741720726{padding-top: 50px !important;padding-right: 1px !important;padding-left: 1px !important;}"][vc_custom_heading text="Booking" font_container="tag:h3|font_size:48px|text_align:left|line_height:48px" use_theme_fonts="yes" fit_bg_text="0" css=".vc_custom_1515683555954{margin-top: 0px !important;margin-bottom: 0px !important;border-bottom-width: 1px !important;padding-bottom: 27px !important;border-bottom-style: dashed !important;}"][vc_column_text css=".vc_custom_1515683617261{border-bottom-width: 1px !important;padding-top: 10px !important;padding-bottom: 14px !important;border-bottom-style: dashed !important;}"]Leila Kandera
T+ 1-514-666-9078[/vc_column_text][vc_column_text css=".vc_custom_1515683768950{border-bottom-width: 1px !important;padding-top: 14px !important;padding-bottom: 12px !important;border-bottom-style: dashed !important;}"]Kandera@mgm.com[/vc_column_text][/vc_column_inner][vc_column_inner width="1/3" css=".vc_custom_1515610384041{padding-top: 50px !important;padding-right: 1px !important;padding-left: 1px !important;}"][vc_custom_heading text="Press" font_container="tag:h3|font_size:48px|text_align:left|line_height:48px" use_theme_fonts="yes" fit_bg_text="0" css=".vc_custom_1515683593805{margin-top: 0px !important;margin-bottom: 0px !important;border-bottom-width: 1px !important;padding-bottom: 27px !important;border-bottom-style: dashed !important;}"][vc_column_text css=".vc_custom_1515683698126{border-bottom-width: 1px !important;padding-top: 10px !important;padding-bottom: 14px !important;border-bottom-style: dashed !important;}"]Leila Kandera
T+ 1-514-666-9078[/vc_column_text][vc_column_text css=".vc_custom_1515683776841{border-bottom-width: 1px !important;padding-top: 14px !important;padding-bottom: 12px !important;border-bottom-style: dashed !important;}"]Kandera@mgm.com[/vc_column_text][/vc_column_inner][/vc_row_inner][vc_row_inner iron_bg_video=""][vc_column_inner css=".vc_custom_1515610464491{padding-top: 50px !important;padding-right: 1px !important;padding-left: 1px !important;}"][vc_custom_heading text="Inquiries" font_container="tag:h3|font_size:48px|text_align:left|line_height:48px" use_theme_fonts="yes" fit_bg_text="0" css=".vc_custom_1515683820900{margin-top: 0px !important;margin-bottom: 0px !important;border-bottom-width: 1px !important;padding-bottom: 27px !important;border-bottom-style: dashed !important;}"][vc_column_text css=".vc_custom_1515683889525{border-bottom-width: 1px !important;padding-top: 27px !important;padding-bottom: 34px !important;border-bottom-style: dashed !important;}"]inquiries@thegrid.com[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

	/*************
    // TEAM BOOKING
  	**************/
	//-- 	
	$data = array();
	$data['name'] = esc_html__( 'Booking 1', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/booking_1.jpg';
	$data['sort_name'] = 'Booking';
	$data['custom_class'] = 'contact form';
	$data['content'] = <<<CONTENT
<p>[vc_row equal_height="yes" content_placement="top" enable_responsive_options="yes" css=".vc_custom_1520025678751{margin-top: 50px !important;margin-bottom: 80px !important;}" responsive_css="padding_right_mobile:15|padding_left_mobile:15" el_class="sonaar-templates-booking-1"][vc_column width="1/3" css=".vc_custom_1518803101033{margin-bottom: 100px !important;}" align="text-lg-right text-md-right text-sm-center text-xs-center"][vc_custom_heading text="BOOK YOUR<br />
SESSION NOW" font_container="tag:h2|font_size:72px|text_align:right|color:%2300ad8e|line_height:68px" google_fonts="font_family:Oswald%3A200%2C300%2Cregular%2C500%2C600%2C700|font_style:700%20bold%20regular%3A700%3Anormal"][vc_column_text]Our business hours are<br />
Monday to Friday<br />
from 8 am to 6 pm</p>
<p>Have any questions?<br />
<a href="mailto:someone@example.com?Subject=Hello%20again" target="_blank" rel="noopener">Contact us</a> today.[/vc_column_text][/vc_column][vc_column width="2/3" enable_responsive_options="yes" css=".vc_custom_1518803134086{margin-top: 50px !important;padding-right: 10px !important;padding-left: 40px !important;}" responsive_css="padding_right_tablet:20|padding_left_tablet:20|padding_right_mobile:15|padding_left_mobile:15" align="text-sm-center text-xs-center"][vc_column_text][contact-form-7 id="2997"][/vc_column_text][/vc_column][/vc_row]</p>
CONTENT;
	$templates[] = $data;
	
	/*************
    // TEAM CATEGORY
  	**************/
  	//--
	$data = array();
	$data['name'] = esc_html__( 'Team 1', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/team-1.jpg';
	$data['sort_name'] = 'TEAM';
	$data['custom_class'] = 'team';
	$data['content'] = <<<CONTENT
[vc_row el_class="about" css=".vc_custom_1491933607452{margin-top: -150px !important;}"][vc_column][vc_row_inner gap="35"][vc_column_inner][vc_custom_heading text="Team" font_container="tag:h1|text_align:left" use_theme_fonts="yes" fit_bg_text="0"][/vc_column_inner][/vc_row_inner][vc_row_inner gap="35" css=".vc_custom_1491931653738{margin-bottom: 60px !important;}"][vc_column_inner width="1/2"][vc_column_text]
<h2><strong>Artist Management &amp; Direction</strong></h2>
<strong>Stephan Sheppard</strong>
Artist management &amp; Direction - Business development
<a href="mailto:ssheppard@sonaar.com">ssheppard@sonaar.com</a>

<strong>Michael Seemore</strong>
Artist management &amp; Direction - Label
<a href="mailto:mseemore@sonaar.com">mseemore@sonaar.com</a>

<strong>Ben Dubmore</strong>
Artist management &amp; Direction - Events
<a href="mailto:bdubmore@sonaar.com">bdubmore@sonaar.com</a>

<strong>Isabel Chan</strong>
Management
<a href="mailto:ichan@sonaar.com">ichan@sonaar.com</a>[/vc_column_text][/vc_column_inner][vc_column_inner width="1/2"][vc_column_text]
<h2><strong>Administration</strong></h2>
<strong>Mark Stone</strong>
Director - Finance &amp; Administration
<a href="mailto:mstone@sonaar.com">mstone@sonaar.com</a>

<strong>Micheal Flinn</strong>
Administration &amp; Merchandising
<a href="mailto:mflinn@sonaar.com">mflinn@sonaar.com</a>

<strong>Perry Larose</strong>
Accounting
<a href="mailto:plarose@sonaar.com">plarose@sonaar.com</a>[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

	/*************
    // BAND MEMBERS
  	**************/
  	//--
	$data = array();
	$data['name'] = esc_html__( 'Band Members 1', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/band-members_1.jpg';
	$data['sort_name'] = 'Band Members';
	$data['custom_class'] = 'band_members';
	$data['content'] = <<<CONTENT
[vc_row gap="35" css=".vc_custom_1516047457545{padding-right: 20px !important;padding-left: 20px !important;}" el_class="sonaar-templates-team"][vc_column width="1/3"][vc_single_image source="external_link" alignment="center" img_fullwidth="0" custom_src="https://assets.sonaar.io/vc_templates/member-man1.jpg"][vc_custom_heading text="William Sheer" font_container="tag:h2|font_size:38px|text_align:left|line_height:42px" use_theme_fonts="yes" css=".vc_custom_1516050802590{margin-bottom: 5px !important;}"][vc_custom_heading text="Lead Guitar" font_container="tag:h2|font_size:22px|text_align:left|line_height:22px" use_theme_fonts="yes" css=".vc_custom_1516050607414{margin-top: 0px !important;margin-bottom: 20px !important;}"][vc_column_text css=".vc_custom_1516050623019{margin-top: 15px !important;margin-bottom: 15px !important;}"]William Sheer is an American artist signed to Sonaar Records. Sheer has released music under various guises, including FTK SoundSystem, Black Retro Star and The Crystal Ark, as well as collaborative work with DJ Funk. Sheer lives in NYC and eat one banana every day.[/vc_column_text][/vc_column][vc_column width="1/3"][vc_single_image source="external_link" alignment="center" img_fullwidth="0" custom_src="https://assets.sonaar.io/vc_templates/member-girl1.jpg"][vc_custom_heading text="DJ Ultrasonic" font_container="tag:h2|font_size:38px|text_align:left|line_height:42px" use_theme_fonts="yes" css=".vc_custom_1516050854819{margin-bottom: 5px !important;}"][vc_custom_heading text="Lead Vocal" font_container="tag:h2|font_size:22px|text_align:left|line_height:22px" use_theme_fonts="yes" css=".vc_custom_1516050661659{margin-top: 0px !important;margin-bottom: 20px !important;}"][vc_column_text css=".vc_custom_1516050696285{margin-top: 15px !important;margin-bottom: 15px !important;}"]DJ Ultrasonic is s DJ, singer and songwriter. Her most well-known musical project is Sonaar Music, which first gained attention with its single “Edge” in 2015 before releasing her eponymous debut album in February 2018. She have 4 toes and likes potatoes and tomatoes.[/vc_column_text][/vc_column][vc_column width="1/3"][vc_single_image source="external_link" alignment="center" img_fullwidth="0" custom_src="https://assets.sonaar.io/vc_templates/member-man2.jpg"][vc_custom_heading text="John Ryder" font_container="tag:h2|font_size:38px|text_align:left|line_height:42px" use_theme_fonts="yes" css=".vc_custom_1516050875158{margin-bottom: 5px !important;}"][vc_custom_heading text="Drum machine, Synths" font_container="tag:h2|font_size:22px|text_align:left|line_height:22px" use_theme_fonts="yes" css=".vc_custom_1516050729113{margin-top: 0px !important;margin-bottom: 20px !important;}"][vc_column_text css=".vc_custom_1516050740926{margin-top: 15px !important;margin-bottom: 15px !important;}"]John Ryder is a musician who has recorded and toured with artists like The Faints, Grimskank and Nuclear Band. He is notable for his experimental and whimsical approach to music to produce unusual sounds and builds his own instruments . Ryder rides an horse.[/vc_column_text][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;
	//--
	$data = array();
	$data['name'] = esc_html__( 'Band Members 2', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/band-members_2.jpg';
	$data['sort_name'] = 'Band Members';
	$data['custom_class'] = 'band_members';
	$data['content'] = <<<CONTENT
[vc_row gap="35" css=".vc_custom_1516047457545{padding-right: 20px !important;padding-left: 20px !important;}" el_class="sonaar-templates-team"][vc_column width="1/3"][vc_single_image source="external_link" alignment="center" external_style="vc_box_circle" img_fullwidth="0" custom_src="https://assets.sonaar.io/vc_templates/member-man1.jpg"][vc_custom_heading text="William Sheer" font_container="tag:h2|font_size:38px|text_align:left|line_height:42px" use_theme_fonts="yes" css=".vc_custom_1516050802590{margin-bottom: 5px !important;}"][vc_custom_heading text="Lead Guitar" font_container="tag:h2|font_size:22px|text_align:left|line_height:22px" use_theme_fonts="yes" css=".vc_custom_1516050607414{margin-top: 0px !important;margin-bottom: 20px !important;}"][vc_column_text css=".vc_custom_1516050623019{margin-top: 15px !important;margin-bottom: 15px !important;}"]William Sheer is an American artist signed to Sonaar Records. Sheer has released music under various guises, including FTK SoundSystem, Black Retro Star and The Crystal Ark, as well as collaborative work with DJ Funk. Sheer lives in NYC and eat one banana every day.[/vc_column_text][/vc_column][vc_column width="1/3"][vc_single_image source="external_link" alignment="center" external_style="vc_box_circle" img_fullwidth="0" custom_src="https://assets.sonaar.io/vc_templates/member-girl1.jpg"][vc_custom_heading text="DJ Ultrasonic" font_container="tag:h2|font_size:38px|text_align:left|line_height:42px" use_theme_fonts="yes" css=".vc_custom_1516050854819{margin-bottom: 5px !important;}"][vc_custom_heading text="Lead Vocal" font_container="tag:h2|font_size:22px|text_align:left|line_height:22px" use_theme_fonts="yes" css=".vc_custom_1516050661659{margin-top: 0px !important;margin-bottom: 20px !important;}"][vc_column_text css=".vc_custom_1516050696285{margin-top: 15px !important;margin-bottom: 15px !important;}"]DJ Ultrasonic is s DJ, singer and songwriter. Her most well-known musical project is Sonaar Music, which first gained attention with its single “Edge” in 2015 before releasing her eponymous debut album in February 2018. She have 4 toes and likes potatoes and tomatoes.[/vc_column_text][/vc_column][vc_column width="1/3"][vc_single_image source="external_link" alignment="center" external_style="vc_box_circle" img_fullwidth="0" custom_src="https://assets.sonaar.io/vc_templates/member-man2.jpg"][vc_custom_heading text="John Ryder" font_container="tag:h2|font_size:38px|text_align:left|line_height:42px" use_theme_fonts="yes" css=".vc_custom_1516050875158{margin-bottom: 5px !important;}"][vc_custom_heading text="Drum machine, Synths" font_container="tag:h2|font_size:22px|text_align:left|line_height:22px" use_theme_fonts="yes" css=".vc_custom_1516050729113{margin-top: 0px !important;margin-bottom: 20px !important;}"][vc_column_text css=".vc_custom_1516050740926{margin-top: 15px !important;margin-bottom: 15px !important;}"]John Ryder is a musician who has recorded and toured with artists like The Faints, Grimskank and Nuclear Band. He is notable for his experimental and whimsical approach to music to produce unusual sounds and builds his own instruments . Ryder rides an horse.[/vc_column_text][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;
	//--
	$data = array();
	$data['name'] = esc_html__( 'Band Members 3', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/band-members_3.jpg';
	$data['sort_name'] = 'Band Members';
	$data['custom_class'] = 'band_members';
	$data['content'] = <<<CONTENT
[vc_row gap="35" css=".vc_custom_1516072650139{padding-right: 20px !important;padding-left: 20px !important;}" el_class="sonaar-templates-members"][vc_column width="1/3"][vc_single_image source="external_link" alignment="center" img_fullwidth="0" custom_src="https://assets.sonaar.io/vc_templates/member-man1.jpg"][vc_custom_heading text="William Sheer" font_container="tag:h2|font_size:38px|text_align:left|line_height:42px" use_theme_fonts="yes" css=".vc_custom_1516050802590{margin-bottom: 5px !important;}"][vc_custom_heading text="Lead Guitar" font_container="tag:h2|font_size:22px|text_align:left|line_height:22px" use_theme_fonts="yes" css=".vc_custom_1516050607414{margin-top: 0px !important;margin-bottom: 20px !important;}"][vc_btn title="Twitter" style="custom" custom_background="rgba(0,0,0,0.01)" custom_text="" align="left" i_icon_fontawesome="fa fa-twitter" add_icon="true" link="url:%2F%2Ftwitter.com||target:%20_blank|" css=".vc_custom_1516049429945{margin-bottom: 0px !important;}"][vc_btn title="Facebook" style="custom" custom_background="rgba(0,0,0,0.01)" custom_text="" align="left" i_icon_fontawesome="fa fa-facebook" add_icon="true" link="url:%2F%2Ffacebook.com||target:%20_blank|" css=".vc_custom_1516049442758{margin-bottom: 0px !important;}"][vc_btn title="Instagram" style="custom" custom_background="rgba(0,0,0,0.01)" custom_text="" align="left" i_icon_fontawesome="fa fa-instagram" add_icon="true" link="url:%2F%2Finstagram.com||target:%20_blank|" css=".vc_custom_1516049453401{margin-bottom: 0px !important;}"][vc_btn title="SoundCloud" style="custom" custom_background="rgba(0,0,0,0.01)" custom_text="" align="left" i_icon_fontawesome="fa fa-soundcloud" add_icon="true" link="url:%2F%2Fsoundcloud.com||target:%20_blank|" css=".vc_custom_1516049468018{margin-bottom: 0px !important;}"][vc_column_text css=".vc_custom_1516050623019{margin-top: 15px !important;margin-bottom: 15px !important;}"]William Sheer is an American artist signed to Sonaar Records. Sheer has released music under various guises, including FTK SoundSystem, Black Retro Star and The Crystal Ark, as well as collaborative work with DJ Funk. Sheer lives in NYC and eat one banana every day.[/vc_column_text][/vc_column][vc_column width="1/3"][vc_single_image source="external_link" alignment="center" img_fullwidth="0" custom_src="https://assets.sonaar.io/vc_templates/member-girl1.jpg"][vc_custom_heading text="DJ Ultrasonic" font_container="tag:h2|font_size:38px|text_align:left|line_height:42px" use_theme_fonts="yes" css=".vc_custom_1516050854819{margin-bottom: 5px !important;}"][vc_custom_heading text="Lead Vocal" font_container="tag:h2|font_size:22px|text_align:left|line_height:22px" use_theme_fonts="yes" css=".vc_custom_1516050661659{margin-top: 0px !important;margin-bottom: 20px !important;}"][vc_btn title="Twitter" style="custom" custom_background="rgba(0,0,0,0.01)" custom_text="" align="left" i_icon_fontawesome="fa fa-twitter" add_icon="true" link="url:%2F%2Ftwitter.com||target:%20_blank|" css=".vc_custom_1516049429945{margin-bottom: 0px !important;}"][vc_btn title="Facebook" style="custom" custom_background="rgba(0,0,0,0.01)" custom_text="" align="left" i_icon_fontawesome="fa fa-facebook" add_icon="true" link="url:%2F%2Ffacebook.com||target:%20_blank|" css=".vc_custom_1516049442758{margin-bottom: 0px !important;}"][vc_btn title="Instagram" style="custom" custom_background="rgba(0,0,0,0.01)" custom_text="" align="left" i_icon_fontawesome="fa fa-instagram" add_icon="true" link="url:%2F%2Finstagram.com||target:%20_blank|" css=".vc_custom_1516049453401{margin-bottom: 0px !important;}"][vc_btn title="SoundCloud" style="custom" custom_background="rgba(0,0,0,0.01)" custom_text="" align="left" i_icon_fontawesome="fa fa-soundcloud" add_icon="true" link="url:%2F%2Fsoundcloud.com||target:%20_blank|" css=".vc_custom_1516049468018{margin-bottom: 0px !important;}"][vc_column_text css=".vc_custom_1516050696285{margin-top: 15px !important;margin-bottom: 15px !important;}"]DJ Ultrasonic is s DJ, singer and songwriter. Her most well-known musical project is Sonaar Music, which first gained attention with its single “Edge” in 2015 before releasing her eponymous debut album in February 2018. She have 4 toes and likes potatoes and tomatoes.[/vc_column_text][/vc_column][vc_column width="1/3"][vc_single_image source="external_link" alignment="center" img_fullwidth="0" custom_src="https://assets.sonaar.io/vc_templates/member-man2.jpg"][vc_custom_heading text="John Ryder" font_container="tag:h2|font_size:38px|text_align:left|line_height:42px" use_theme_fonts="yes" css=".vc_custom_1516050875158{margin-bottom: 5px !important;}"][vc_custom_heading text="Drum machine, Synths" font_container="tag:h2|font_size:22px|text_align:left|line_height:22px" use_theme_fonts="yes" css=".vc_custom_1516050729113{margin-top: 0px !important;margin-bottom: 20px !important;}"][vc_btn title="Twitter" style="custom" custom_background="rgba(0,0,0,0.01)" custom_text="" align="left" i_icon_fontawesome="fa fa-twitter" add_icon="true" link="url:%2F%2Ftwitter.com||target:%20_blank|" css=".vc_custom_1516049429945{margin-bottom: 0px !important;}"][vc_btn title="Facebook" style="custom" custom_background="rgba(0,0,0,0.01)" custom_text="" align="left" i_icon_fontawesome="fa fa-facebook" add_icon="true" link="url:%2F%2Ffacebook.com||target:%20_blank|" css=".vc_custom_1516049442758{margin-bottom: 0px !important;}"][vc_btn title="Instagram" style="custom" custom_background="rgba(0,0,0,0.01)" custom_text="" align="left" i_icon_fontawesome="fa fa-instagram" add_icon="true" link="url:%2F%2Finstagram.com||target:%20_blank|" css=".vc_custom_1516049453401{margin-bottom: 0px !important;}"][vc_btn title="SoundCloud" style="custom" custom_background="rgba(0,0,0,0.01)" custom_text="" align="left" i_icon_fontawesome="fa fa-soundcloud" add_icon="true" link="url:%2F%2Fsoundcloud.com||target:%20_blank|" css=".vc_custom_1516049468018{margin-bottom: 0px !important;}"][vc_column_text css=".vc_custom_1516050740926{margin-top: 15px !important;margin-bottom: 15px !important;}"]John Ryder is a musician who has recorded and toured with artists like The Faints, Grimskank and Nuclear Band. He is notable for his experimental and whimsical approach to music to produce unusual sounds and builds his own instruments . Ryder rides an horse.[/vc_column_text][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;
	//--
	$data = array();
	$data['name'] = esc_html__( 'Band Members 4', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/band-members_4.jpg';
	$data['sort_name'] = 'Band Members';
	$data['custom_class'] = 'band_members';
	$data['content'] = <<<CONTENT
[vc_row css=".vc_custom_1516052760405{margin-top: 40px !important;margin-right: 5px !important;margin-bottom: 40px !important;margin-left: 5px !important;}" el_class="sonaar-templates-team"][vc_column width="1/3" css=".vc_custom_1516045298825{margin-bottom: 10px !important;}"][vc_single_image source="external_link" alignment="center" img_fullwidth="0" custom_src="https://assets.sonaar.io/vc_templates/member-girl1.jpg"][/vc_column][vc_column width="2/3" css=".vc_custom_1516045334377{margin-bottom: 10px !important;}"][vc_custom_heading text="DJ Ultrasonic" font_container="tag:h2|font_size:48px|text_align:left|line_height:48px" use_theme_fonts="yes" css=".vc_custom_1516051866907{margin-top: 15px !important;margin-bottom: 5px !important;}"][vc_custom_heading text="Lead Vocal" font_container="tag:h2|font_size:22px|text_align:left|line_height:22px" use_theme_fonts="yes" css=".vc_custom_1516051575554{margin-top: 0px !important;margin-bottom: 20px !important;}"][vc_column_text css=".vc_custom_1516053534022{margin-top: 15px !important;margin-bottom: 30px !important;}"]DJ Ultrasonic is s DJ, singer and songwriter. Her most well-known musical project is Sonaar Music, which first gained attention with its single “Edge” in 2015 before releasing her eponymous debut album in February 2018. She have 4 toes and likes potatoes and tomatoes.[/vc_column_text][vc_btn title="Twitter" style="custom" custom_background="" custom_text="" i_icon_fontawesome="fa fa-twitter" add_icon="true" link="url:%2F%2Ftwitter.com||target:%20_blank|" css=".vc_custom_1516053126241{margin-right: 0px !important;margin-left: 0px !important;}"][vc_btn title="Facebook" style="custom" custom_background="" custom_text="" i_icon_fontawesome="fa fa-facebook" add_icon="true" link="url:%2F%2Ffacebook.com||target:%20_blank|" css=".vc_custom_1516053257997{margin-right: 0px !important;margin-left: 0px !important;}"][vc_btn title="Instagram" style="custom" custom_background="" custom_text="" i_icon_fontawesome="fa fa-instagram" add_icon="true" link="url:%2F%2Finstagram.com||target:%20_blank|" css=".vc_custom_1516053322608{margin-right: 0px !important;margin-left: 0px !important;}"][vc_btn title="SoundCloud" style="custom" custom_background="" custom_text="" i_icon_fontawesome="fa fa-soundcloud" add_icon="true" link="url:%2F%2Fsoundcloud.com||target:%20_blank|" css=".vc_custom_1516053364423{margin-right: 0px !important;margin-left: 0px !important;}"][/vc_column][/vc_row][vc_row css=".vc_custom_1516052776765{margin-top: 40px !important;margin-right: 5px !important;margin-bottom: 40px !important;margin-left: 5px !important;}" el_class="sonaar-templates-team"][vc_column width="1/3" css=".vc_custom_1516045226379{margin-bottom: 10px !important;}"][vc_single_image source="external_link" alignment="center" img_fullwidth="0" custom_src="https://assets.sonaar.io/vc_templates/member-man1.jpg"][/vc_column][vc_column width="2/3" css=".vc_custom_1516045237720{margin-bottom: 10px !important;}"][vc_custom_heading text="William Sheer" font_container="tag:h2|font_size:48px|text_align:left|line_height:48px" use_theme_fonts="yes" css=".vc_custom_1516051874277{margin-top: 15px !important;margin-bottom: 5px !important;}"][vc_custom_heading text="Lead Guitar" font_container="tag:h2|font_size:22px|text_align:left|line_height:22px" use_theme_fonts="yes" css=".vc_custom_1516051552610{margin-top: 0px !important;margin-bottom: 20px !important;}"][vc_column_text css=".vc_custom_1516053540052{margin-top: 15px !important;margin-bottom: 30px !important;}"]William Sheer is an American artist signed to Sonaar Records. Sheer has released music under various guises, including FTK SoundSystem, Black Retro Star and The Crystal Ark, as well as collaborative work with DJ Funk. Sheer lives in NYC and eat one banana every day.[/vc_column_text][vc_btn title="Twitter" style="custom" custom_background="" custom_text="" i_icon_fontawesome="fa fa-twitter" add_icon="true" link="url:%2F%2Ftwitter.com||target:%20_blank|" css=".vc_custom_1516053126241{margin-right: 0px !important;margin-left: 0px !important;}"][vc_btn title="Facebook" style="custom" custom_background="" custom_text="" i_icon_fontawesome="fa fa-facebook" add_icon="true" link="url:%2F%2Ffacebook.com||target:%20_blank|" css=".vc_custom_1516053257997{margin-right: 0px !important;margin-left: 0px !important;}"][vc_btn title="Instagram" style="custom" custom_background="" custom_text="" i_icon_fontawesome="fa fa-instagram" add_icon="true" link="url:%2F%2Finstagram.com||target:%20_blank|" css=".vc_custom_1516053322608{margin-right: 0px !important;margin-left: 0px !important;}"][vc_btn title="SoundCloud" style="custom" custom_background="" custom_text="" i_icon_fontawesome="fa fa-soundcloud" add_icon="true" link="url:%2F%2Fsoundcloud.com||target:%20_blank|" css=".vc_custom_1516053364423{margin-right: 0px !important;margin-left: 0px !important;}"][/vc_column][/vc_row][vc_row css=".vc_custom_1516052788020{margin-top: 40px !important;margin-right: 5px !important;margin-bottom: 40px !important;margin-left: 5px !important;}" el_class="sonaar-templates-team"][vc_column width="1/3" css=".vc_custom_1516045306794{margin-bottom: 10px !important;}"][vc_single_image source="external_link" alignment="center" img_fullwidth="0" custom_src="https://assets.sonaar.io/vc_templates/member-man2.jpg"][/vc_column][vc_column width="2/3" css=".vc_custom_1516045343766{margin-bottom: 10px !important;}"][vc_custom_heading text="John Ryder" font_container="tag:h2|font_size:48px|text_align:left|line_height:48px" use_theme_fonts="yes" css=".vc_custom_1516051881451{margin-top: 15px !important;margin-bottom: 5px !important;}"][vc_custom_heading text="Drum machine, Synths" font_container="tag:h2|font_size:22px|text_align:left|line_height:22px" use_theme_fonts="yes" css=".vc_custom_1516051620362{margin-top: 0px !important;margin-bottom: 20px !important;}"][vc_column_text css=".vc_custom_1516053546735{margin-top: 15px !important;margin-bottom: 30px !important;}"]John Ryder is a musician who has recorded and toured with artists like The Faints, Grimskank and Nuclear Band. He is notable for his experimental and whimsical approach to music to produce unusual sounds and builds his own instruments . Ryder rides an horse.[/vc_column_text][vc_btn title="Twitter" style="custom" custom_background="" custom_text="" i_icon_fontawesome="fa fa-twitter" add_icon="true" link="url:%2F%2Ftwitter.com||target:%20_blank|" css=".vc_custom_1516053126241{margin-right: 0px !important;margin-left: 0px !important;}"][vc_btn title="Facebook" style="custom" custom_background="" custom_text="" i_icon_fontawesome="fa fa-facebook" add_icon="true" link="url:%2F%2Ffacebook.com||target:%20_blank|" css=".vc_custom_1516053257997{margin-right: 0px !important;margin-left: 0px !important;}"][vc_btn title="Instagram" style="custom" custom_background="" custom_text="" i_icon_fontawesome="fa fa-instagram" add_icon="true" link="url:%2F%2Finstagram.com||target:%20_blank|" css=".vc_custom_1516053322608{margin-right: 0px !important;margin-left: 0px !important;}"][vc_btn title="SoundCloud" style="custom" custom_background="" custom_text="" i_icon_fontawesome="fa fa-soundcloud" add_icon="true" link="url:%2F%2Fsoundcloud.com||target:%20_blank|" css=".vc_custom_1516053364423{margin-right: 0px !important;margin-left: 0px !important;}"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;
	//--
	$data = array();
	$data['name'] = esc_html__( 'Band Members 5', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/band-members_5.jpg';
	$data['sort_name'] = 'Band Members';
	$data['custom_class'] = 'band_members';
	$data['content'] = <<<CONTENT
[vc_row gap="35" css=".vc_custom_1516072650139{padding-right: 20px !important;padding-left: 20px !important;}" el_class="sonaar-templates-members"][vc_column width="1/3"][vc_single_image source="external_link" alignment="center" img_fullwidth="0" custom_src="https://assets.sonaar.io/vc_templates/member-man1.jpg"][vc_custom_heading text="William Sheer" font_container="tag:h2|font_size:38px|text_align:left|line_height:42px" use_theme_fonts="yes" css=".vc_custom_1516050802590{margin-bottom: 5px !important;}"][vc_custom_heading text="Lead Guitar" font_container="tag:h2|font_size:22px|text_align:left|line_height:22px" use_theme_fonts="yes" css=".vc_custom_1516050607414{margin-top: 0px !important;margin-bottom: 20px !important;}"][vc_btn title="Twitter" style="custom" custom_background="rgba(0,0,0,0.01)" custom_text="" align="left" i_icon_fontawesome="fa fa-twitter" add_icon="true" link="url:%2F%2Ftwitter.com||target:%20_blank|" css=".vc_custom_1516049429945{margin-bottom: 0px !important;}"][vc_btn title="Facebook" style="custom" custom_background="rgba(0,0,0,0.01)" custom_text="" align="left" i_icon_fontawesome="fa fa-facebook" add_icon="true" link="url:%2F%2Ffacebook.com||target:%20_blank|" css=".vc_custom_1516049442758{margin-bottom: 0px !important;}"][vc_btn title="Instagram" style="custom" custom_background="rgba(0,0,0,0.01)" custom_text="" align="left" i_icon_fontawesome="fa fa-instagram" add_icon="true" link="url:%2F%2Finstagram.com||target:%20_blank|" css=".vc_custom_1516049453401{margin-bottom: 0px !important;}"][vc_btn title="SoundCloud" style="custom" custom_background="rgba(0,0,0,0.01)" custom_text="" align="left" i_icon_fontawesome="fa fa-soundcloud" add_icon="true" link="url:%2F%2Fsoundcloud.com||target:%20_blank|" css=".vc_custom_1516049468018{margin-bottom: 0px !important;}"][vc_column_text css=".vc_custom_1516050623019{margin-top: 15px !important;margin-bottom: 15px !important;}"]William Sheer is an American artist signed to Sonaar Records. Sheer has released music under various guises, including FTK SoundSystem, Black Retro Star and The Crystal Ark, as well as collaborative work with DJ Funk. Sheer lives in NYC and eat one banana every day.[/vc_column_text][/vc_column][vc_column width="1/3"][vc_single_image source="external_link" alignment="center" img_fullwidth="0" custom_src="https://assets.sonaar.io/vc_templates/member-girl1.jpg"][vc_custom_heading text="DJ Ultrasonic" font_container="tag:h2|font_size:38px|text_align:left|line_height:42px" use_theme_fonts="yes" css=".vc_custom_1516050854819{margin-bottom: 5px !important;}"][vc_custom_heading text="Lead Vocal" font_container="tag:h2|font_size:22px|text_align:left|line_height:22px" use_theme_fonts="yes" css=".vc_custom_1516050661659{margin-top: 0px !important;margin-bottom: 20px !important;}"][vc_btn title="Twitter" style="custom" custom_background="rgba(0,0,0,0.01)" custom_text="" align="left" i_icon_fontawesome="fa fa-twitter" add_icon="true" link="url:%2F%2Ftwitter.com||target:%20_blank|" css=".vc_custom_1516049429945{margin-bottom: 0px !important;}"][vc_btn title="Facebook" style="custom" custom_background="rgba(0,0,0,0.01)" custom_text="" align="left" i_icon_fontawesome="fa fa-facebook" add_icon="true" link="url:%2F%2Ffacebook.com||target:%20_blank|" css=".vc_custom_1516049442758{margin-bottom: 0px !important;}"][vc_btn title="Instagram" style="custom" custom_background="rgba(0,0,0,0.01)" custom_text="" align="left" i_icon_fontawesome="fa fa-instagram" add_icon="true" link="url:%2F%2Finstagram.com||target:%20_blank|" css=".vc_custom_1516049453401{margin-bottom: 0px !important;}"][vc_btn title="SoundCloud" style="custom" custom_background="rgba(0,0,0,0.01)" custom_text="" align="left" i_icon_fontawesome="fa fa-soundcloud" add_icon="true" link="url:%2F%2Fsoundcloud.com||target:%20_blank|" css=".vc_custom_1516049468018{margin-bottom: 0px !important;}"][vc_column_text css=".vc_custom_1516050696285{margin-top: 15px !important;margin-bottom: 15px !important;}"]DJ Ultrasonic is s DJ, singer and songwriter. Her most well-known musical project is Sonaar Music, which first gained attention with its single “Edge” in 2015 before releasing her eponymous debut album in February 2018. She have 4 toes and likes potatoes and tomatoes.[/vc_column_text][/vc_column][vc_column width="1/3"][vc_single_image source="external_link" alignment="center" img_fullwidth="0" custom_src="https://assets.sonaar.io/vc_templates/member-man2.jpg"][vc_custom_heading text="John Ryder" font_container="tag:h2|font_size:38px|text_align:left|line_height:42px" use_theme_fonts="yes" css=".vc_custom_1516050875158{margin-bottom: 5px !important;}"][vc_custom_heading text="Drum machine, Synths" font_container="tag:h2|font_size:22px|text_align:left|line_height:22px" use_theme_fonts="yes" css=".vc_custom_1516050729113{margin-top: 0px !important;margin-bottom: 20px !important;}"][vc_btn title="Twitter" style="custom" custom_background="rgba(0,0,0,0.01)" custom_text="" align="left" i_icon_fontawesome="fa fa-twitter" add_icon="true" link="url:%2F%2Ftwitter.com||target:%20_blank|" css=".vc_custom_1516049429945{margin-bottom: 0px !important;}"][vc_btn title="Facebook" style="custom" custom_background="rgba(0,0,0,0.01)" custom_text="" align="left" i_icon_fontawesome="fa fa-facebook" add_icon="true" link="url:%2F%2Ffacebook.com||target:%20_blank|" css=".vc_custom_1516049442758{margin-bottom: 0px !important;}"][vc_btn title="Instagram" style="custom" custom_background="rgba(0,0,0,0.01)" custom_text="" align="left" i_icon_fontawesome="fa fa-instagram" add_icon="true" link="url:%2F%2Finstagram.com||target:%20_blank|" css=".vc_custom_1516049453401{margin-bottom: 0px !important;}"][vc_btn title="SoundCloud" style="custom" custom_background="rgba(0,0,0,0.01)" custom_text="" align="left" i_icon_fontawesome="fa fa-soundcloud" add_icon="true" link="url:%2F%2Fsoundcloud.com||target:%20_blank|" css=".vc_custom_1516049468018{margin-bottom: 0px !important;}"][vc_column_text css=".vc_custom_1516050740926{margin-top: 15px !important;margin-bottom: 15px !important;}"]John Ryder is a musician who has recorded and toured with artists like The Faints, Grimskank and Nuclear Band. He is notable for his experimental and whimsical approach to music to produce unusual sounds and builds his own instruments . Ryder rides an horse.[/vc_column_text][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;
	//--
	$data = array();
	$data['name'] = esc_html__( 'Band Members 6', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/band-members_6.jpg';
	$data['sort_name'] = 'Band Members';
	$data['custom_class'] = 'band_members team';
	$data['content'] = <<<CONTENT
[vc_row gap="35" css=".vc_custom_1516199562194{padding-right: 20px !important;padding-left: 20px !important;}"][vc_column width="1/3"][vc_single_image source="external_link" alignment="center" external_style="vc_box_circle" img_fullwidth="0" custom_src="https://assets.sonaar.io/vc_templates/member-man1.jpg" css=".vc_custom_1516199459223{padding-right: 10px !important;padding-left: 10px !important;}"][vc_custom_heading text="William Sheer" font_container="tag:h2|font_size:38px|text_align:center|line_height:42px" use_theme_fonts="yes" css=".vc_custom_1516199365947{margin-bottom: 5px !important;}"][vc_custom_heading text="Lead Guitar" font_container="tag:h2|font_size:22px|text_align:center|line_height:22px" use_theme_fonts="yes" css=".vc_custom_1516199372891{margin-top: 0px !important;margin-bottom: 20px !important;}"][/vc_column][vc_column width="1/3"][vc_single_image source="external_link" alignment="center" external_style="vc_box_circle" img_fullwidth="0" custom_src="https://assets.sonaar.io/vc_templates/member-girl1.jpg" css=".vc_custom_1516199478136{padding-right: 10px !important;padding-left: 10px !important;}"][vc_custom_heading text="DJ Ultrasonic" font_container="tag:h2|font_size:38px|text_align:center|line_height:42px" use_theme_fonts="yes" css=".vc_custom_1516199378804{margin-bottom: 5px !important;}"][vc_custom_heading text="Lead Vocal" font_container="tag:h2|font_size:22px|text_align:center|line_height:22px" use_theme_fonts="yes" css=".vc_custom_1516199385566{margin-top: 0px !important;margin-bottom: 20px !important;}"][/vc_column][vc_column width="1/3"][vc_single_image source="external_link" alignment="center" external_style="vc_box_circle" img_fullwidth="0" custom_src="https://assets.sonaar.io/vc_templates/member-man2.jpg" css=".vc_custom_1516199498614{padding-right: 10px !important;padding-left: 10px !important;}"][vc_custom_heading text="John Ryder" font_container="tag:h2|font_size:38px|text_align:center|line_height:42px" use_theme_fonts="yes" css=".vc_custom_1516199391884{margin-bottom: 5px !important;}"][vc_custom_heading text="Drum machine, Synths" font_container="tag:h2|font_size:22px|text_align:center|line_height:22px" use_theme_fonts="yes" css=".vc_custom_1516199397188{margin-top: 0px !important;margin-bottom: 20px !important;}"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;
	//--
	$data = array();
	$data['name'] = esc_html__( 'Band Member Fullwidth', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/band-member-fullwidth.jpg';
	$data['sort_name'] = 'Band Members';
	$data['custom_class'] = 'band_members';
	$data['content'] = <<<CONTENT
[vc_row full_width="stretch_row_content_no_spaces" equal_height="yes" content_placement="middle" gradient_bg="yes" gradient_bg_color="linear-gradient(317deg,rgb(74, 232, 165) 0%,rgb(45, 196, 232) 73%)|background-size: auto auto;background-position: 50% 50%;background-repeat: repeat;background-attachment: scroll;background-origin: border-box;background-clip: border-box;"][vc_column width="1/2" enable_responsive_options="yes" css=".vc_custom_1516135742072{background-image: url(https://assets.sonaar.io/vc_templates/member-girl1.jpg?id=) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}" responsive_css="padding_bottom_mobile:425" el_class="sonaar-templates-member-pic"][/vc_column][vc_column width="1/2" enable_responsive_options="yes" css=".vc_custom_1516136275279{padding-top: 4vw !important;padding-right: 8vw !important;padding-bottom: 4vw !important;padding-left: 8vw !important;}" responsive_css="padding_top_mobile:60|padding_bottom_mobile:60"][vc_custom_heading text="DJ Ultrasonic" font_container="tag:h2|font_size:42px|text_align:left|line_height:48px" use_theme_fonts="yes" css=".vc_custom_1516136476699{margin-bottom: 5px !important;}"][vc_custom_heading text="Lead Vocal" font_container="tag:h2|font_size:22px|text_align:left|line_height:22px" use_theme_fonts="yes" css=".vc_custom_1516136436513{margin-top: 5px !important;margin-bottom: 35px !important;}"][vc_column_text]DJ Ultrasonic is s DJ, singer and songwriter. Her most well-known musical project is Sonaar Music, which first gained attention with its single “Edge” in 2015 before releasing her eponymous debut album in February 2018. She have 4 toes and likes potatoes and tomatoes.[/vc_column_text][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;
	//--
	$data = array();
	$data['name'] = esc_html__( 'Band Member Offset', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/band-member-offset.jpg';
	$data['sort_name'] = 'Band Members';
	$data['custom_class'] = 'band_members';
	$data['content'] = <<<CONTENT
[vc_row equal_height="yes" content_placement="middle" enable_responsive_options="yes" gradient_bg="yes" gradient_bg_color="linear-gradient(317deg,rgb(74, 232, 165) 0%,rgb(45, 196, 232) 54.7%)|background-size: auto auto;background-position: 50% 50%;background-repeat: repeat;background-attachment: scroll;background-origin: border-box;background-clip: border-box;" css=".vc_custom_1516138967518{margin-top: 75px !important;margin-left: 140px !important;}" responsive_css="margin_top_mobile:0|margin_right_mobile:0|margin_left_mobile:0"][vc_column width="1/2" enable_responsive_options="yes" css=".vc_custom_1516138492687{margin-top: -75px !important;margin-bottom: 95px !important;margin-left: -140px !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}" responsive_css="margin_top_mobile:0|margin_right_mobile:0|margin_bottom_mobile:0|margin_left_mobile:0|padding_right_mobile:0|padding_left_mobile:0"][vc_single_image source="external_link" img_fullwidth="0" custom_src="https://assets.sonaar.io/vc_templates/member-girl1.jpg"][/vc_column][vc_column width="1/2" enable_responsive_options="yes" css=".vc_custom_1516137955273{padding-top: 60px !important;padding-right: 60px !important;padding-bottom: 80px !important;}" responsive_css="padding_right_mobile:25|padding_left_mobile:25"][vc_custom_heading text="DJ Ultrasonic" font_container="tag:h2|font_size:42px|text_align:left|line_height:48px" use_theme_fonts="yes" css=".vc_custom_1516136476699{margin-bottom: 5px !important;}"][vc_custom_heading text="Lead Vocal" font_container="tag:h2|font_size:22px|text_align:left|line_height:22px" use_theme_fonts="yes" css=".vc_custom_1516136436513{margin-top: 5px !important;margin-bottom: 35px !important;}"][vc_column_text]DJ Ultrasonic is s DJ, singer and songwriter. Her most well-known musical project is Sonaar Music, which first gained attention with its single “Edge” in 2015 before releasing her eponymous debut album in February 2018. She have 4 toes and likes potatoes and tomatoes.[/vc_column_text][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;
	
	/*************
    // VIDEO CATEGORY
  	**************/
   	//-- 	
  	$data = array();
	$data['name'] = esc_html__( 'Video Player - YouTube', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/videoplayer_youtube.jpg';
	$data['sort_name'] = 'Youtube';
	$data['custom_class'] = 'videos';
	$data['content'] = <<<CONTENT
[vc_row css=".vc_custom_1511549094072{margin-top: 75px !important;}"][vc_column][vc_custom_heading text="Video" font_container="tag:h2|text_align:center" use_theme_fonts="yes" css_animation="fadeInUp" fit_bg_text="0"][iron_image_divider divider_align="center" divider_padding_top="20" divider_padding_bottom="30" divider_color="#ffffff"][vc_custom_heading text="TITLE OF YOUR VIDEO HERE" font_container="tag:h4|font_size:12px|text_align:center" use_theme_fonts="yes" css_animation="fadeInUp" fit_bg_text="0"][vc_video link="https://www.youtube.com/watch?v=fKopy74weus" align="center" css_animation="fadeIn" css=".vc_custom_1511548911890{margin-top: 30px !important;}"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;	

   	//-- 	
  	$data = array();
	$data['name'] = esc_html__( 'Video Player - Vimeo', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/videoplayer_vimeo.jpg';
	$data['sort_name'] = 'Vimeo';
	$data['custom_class'] = 'videos';
	$data['content'] = <<<CONTENT
[vc_row css=".vc_custom_1511549094072{margin-top: 75px !important;}"][vc_column][vc_custom_heading text="Video" font_container="tag:h2|text_align:center" use_theme_fonts="yes" css_animation="fadeInUp" fit_bg_text="0"][iron_image_divider divider_align="center" divider_padding_top="20" divider_padding_bottom="30" divider_color="#ffffff"][vc_custom_heading text="TITLE OF YOUR VIDEO HERE" font_container="tag:h4|font_size:12px|text_align:center" use_theme_fonts="yes" css_animation="fadeInUp" fit_bg_text="0"][vc_video link="https://vimeo.com/228450702" align="center" css_animation="fadeIn" css=".vc_custom_1511549446502{margin-top: 30px !important;}"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;	
 	//-- 	
  	$data = array();
	$data['name'] = esc_html__( 'Video Player - With Infos', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/videoplayer_youtube_titles.jpg';
	$data['sort_name'] = 'Youtube';
	$data['custom_class'] = 'videos';
	$data['content'] = <<<CONTENT
[vc_row full_width="stretch_row" css=".vc_custom_1511551587996{margin-top: 75px !important;}"][vc_column][vc_row_inner][vc_column_inner][vc_video link="https://www.youtube.com/watch?v=fKopy74weus" align="center" css_animation="fadeIn" css=".vc_custom_1511548911890{margin-top: 30px !important;}"][/vc_column_inner][/vc_row_inner][vc_row_inner equal_height="yes" content_placement="top" css=".vc_custom_1511552137716{margin-top: 50px !important;padding-bottom: 20px !important;}"][vc_column_inner width="1/3"][vc_separator color="white" border_width="6" css_animation="fadeInUp" css=".vc_custom_1511552104169{margin-bottom: 20px !important;}"][vc_custom_heading text="TITLE OF YOUR VERY NICE VIDEO HERE" use_theme_fonts="yes" css_animation="fadeInUp" fit_bg_text="0"][vc_btn title="View All Videos" style="outline-custom" outline_custom_color="#ffffff" outline_custom_hover_background="#ffffff" outline_custom_hover_text="#000000" shape="square" size="lg" align="left" css_animation="fadeIn" link="url:%23|||" css=".vc_custom_1511552152450{margin-top: 20px !important;margin-bottom: 20px !important;}"][/vc_column_inner][vc_column_inner width="2/3"][vc_separator color="white" border_width="6" css_animation="fadeInUp" css=".vc_custom_1511552108935{margin-bottom: 20px !important;}"][vc_column_text css_animation="fadeInUp" css=".vc_custom_1511552392058{margin-top: 20px !important;}"]Get Imagine Dragons’ new album Evolve, ft. ‘Believer,’ ‘Thunder,’ ‘Whatever It Takes’ and ‘Walking The Wire,’ today: http://smarturl.it/EvolveID

Directed by Matt Eastin[/vc_column_text][/vc_column_inner][/vc_row_inner][vc_separator color="white" css_animation="fadeInUp"][vc_separator color="white" css_animation="fadeInUp"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;
   	//-- 	
  	$data = array();
	$data['name'] = esc_html__( 'Video Player - Simple Grid', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/videoplayer_youtube_grid.jpg';
	$data['sort_name'] = 'Youtube';
	$data['custom_class'] = 'videos';
	$data['content'] = <<<CONTENT
[vc_row css=".vc_custom_1511549094072{margin-top: 75px !important;}"][vc_column][vc_custom_heading text="Latest Videos" font_container="tag:h2|text_align:center" use_theme_fonts="yes" css_animation="fadeInUp" fit_bg_text="0"][iron_image_divider divider_align="center" divider_padding_top="20" divider_padding_bottom="75" divider_color="#ffffff"][vc_row_inner gap="30"][vc_column_inner width="1/2"][vc_video link="https://www.youtube.com/watch?v=fKopy74weus"][/vc_column_inner][vc_column_inner width="1/2"][vc_video link="https://www.youtube.com/watch?v=KGziD2V8Ppw"][/vc_column_inner][/vc_row_inner][vc_row_inner gap="30" css=".vc_custom_1511550040332{margin-bottom: 30px !important;}"][vc_column_inner width="1/2"][vc_video link="https://www.youtube.com/watch?v=7wtfhZwyrcc"][/vc_column_inner][vc_column_inner width="1/2"][vc_video link="https://www.youtube.com/watch?v=U5x96y4mApI"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;		
	
	/*************
    // FOOTER CATEGORY
  	**************/
   	//-- 	
  	$data = array();
	$data['name'] = esc_html__( 'Footer 01', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/footer_01.jpg';
	$data['sort_name'] = 'Footer';
	$data['custom_class'] = 'footers';
	$data['content'] = <<<CONTENT
[vc_section css=".vc_custom_1511801299890{margin-top: 100px !important;background-color: #000000 !important;background-position: 0 0 !important;background-repeat: repeat !important;}" el_class="sonaar-templates-footer01"][vc_row css_animation="none" css=".vc_custom_1511123946276{padding-top: 50px !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_column][vc_custom_heading text="BE SOCIAL" font_container="tag:h2|font_size:36px|text_align:center|color:%23ffffff|line_height:36px" use_theme_fonts="yes" fit_bg_text="0"][vc_single_image source="external_link" alignment="center" img_fullwidth="0" css=".vc_custom_1511801185842{margin-top: 60px !important;margin-bottom: 60px !important;}" custom_src="https://assets.sonaar.io/vc_templates/divider_white.png"][vc_row_inner][vc_column_inner][vc_btn title="" style="custom" custom_background="#ffffff" custom_text="#000000" shape="round" size="lg" i_icon_fontawesome="fa fa-facebook" add_icon="true" link="url:%2F%2Ffacebook.com||target:%20_blank|"][vc_btn title="" style="custom" custom_background="#ffffff" custom_text="#000000" shape="round" size="lg" i_icon_fontawesome="fa fa-twitter" add_icon="true" link="url:%2F%2Ftwitter.com||target:%20_blank|"][vc_btn title="" style="custom" custom_background="#ffffff" custom_text="#000000" shape="round" size="lg" i_icon_fontawesome="fa fa-soundcloud" add_icon="true" link="url:%2F%2Fsoundcloud.com||target:%20_blank|"][vc_btn title="" style="custom" custom_background="#ffffff" custom_text="#000000" shape="round" size="lg" i_icon_fontawesome="fa fa-youtube" add_icon="true" link="url:%2F%2Fyoutube.com||target:%20_blank|"][vc_btn title="" style="custom" custom_background="#ffffff" custom_text="#000000" shape="round" size="lg" i_icon_fontawesome="fa fa-instagram" add_icon="true" link="url:%2F%2Finstagram.com||target:%20_blank|"][/vc_column_inner][/vc_row_inner][vc_column_text el_class="footercredit" css=".vc_custom_1511801899051{margin-top: 100px !important;}"]<p style="text-align: center;">2018 © COPYRIGHT @ SONAAR.IO -  ALL RIGHTS RESERVED - WEBSITE BY YOURCOMPANY.COM</p>[/vc_column_text][/vc_column][/vc_row][/vc_section]
CONTENT;
	$templates[] = $data;			
   	//-- 	
  	$data = array();
	$data['name'] = esc_html__( 'Footer 02', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/footer_02.jpg';
	$data['sort_name'] = 'Footer';
	$data['custom_class'] = 'footers';
	$data['content'] = <<<CONTENT
[vc_section el_class="sonaar-templates-footer02"][vc_row css_animation="none" css=".vc_custom_1508769214613{padding-top: 50px !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_column][vc_row_inner css=".vc_custom_1493915284068{margin-bottom: 80px !important;}"][vc_column_inner width="1/3" css=".vc_custom_1494613742561{margin-top: 100px !important;padding-right: 12px !important;padding-left: 12px !important;}"][vc_custom_heading text="Get in touch" font_container="tag:h3|font_size:36px|text_align:left|line_height:40px" use_theme_fonts="yes" fit_bg_text="0" css=".vc_custom_1511803399748{margin-bottom: 18px !important;}"][iron_image_divider divider_align="left" divider_color="#ffffff"][vc_column_text css=".vc_custom_1493917184757{padding-top: 14px !important;}"]4000, Park Avenue East, Suite 400[/vc_column_text][vc_column_text css=".vc_custom_1493917198740{padding-top: 14px !important;}"]New York City, NY[/vc_column_text][vc_column_text css=".vc_custom_1493917209866{padding-top: 14px !important;}"]93834, United States[/vc_column_text][vc_column_text css=".vc_custom_1493917220858{padding-top: 14px !important;}"]P. +1 514 522-5672[/vc_column_text][vc_column_text css=".vc_custom_1508512422568{padding-top: 14px !important;}"]<a href="mailto:info@soundrise.com">info@soundrise.com</a>[/vc_column_text][/vc_column_inner][vc_column_inner width="1/3" css=".vc_custom_1494613731667{margin-top: 100px !important;padding-right: 12px !important;padding-left: 12px !important;}"][vc_custom_heading text="Follow us" font_container="tag:h3|font_size:36px|text_align:left|line_height:40px" use_theme_fonts="yes" fit_bg_text="0" css=".vc_custom_1511803406203{margin-bottom: 18px !important;}"][iron_image_divider divider_align="left" divider_padding_bottom="15" divider_color="#ffffff"][vc_btn title="Twitter" style="custom" custom_background="" custom_text="#ffffff" size="lg" align="left" i_icon_fontawesome="fa fa-twitter" add_icon="true" link="url:%2F%2Ftwitter.com||target:%20_blank|"][vc_btn title="Facebook" style="custom" custom_background="" custom_text="#ffffff" size="lg" align="left" i_icon_fontawesome="fa fa-facebook" add_icon="true" link="url:%2F%2Ffacebook.com||target:%20_blank|"][vc_btn title="Instagram" style="custom" custom_background="" custom_text="#ffffff" size="lg" align="left" i_icon_fontawesome="fa fa-instagram" add_icon="true" link="url:%2F%2Finstagram.com||target:%20_blank|"][vc_btn title="SoundCloud" style="custom" custom_background="" custom_text="#ffffff" size="lg" align="left" i_icon_fontawesome="fa fa-soundcloud" add_icon="true" link="url:%2F%2Fsoundcloud.com||target:%20_blank|"][/vc_column_inner][vc_column_inner width="1/3" css=".vc_custom_1494613705545{margin-top: 100px !important;padding-right: 12px !important;padding-left: 12px !important;}"][vc_custom_heading text="Newsletter" font_container="tag:h3|font_size:36px|text_align:left|line_height:40px" use_theme_fonts="yes" fit_bg_text="0" css=".vc_custom_1511803411358{margin-bottom: 18px !important;}"][iron_image_divider divider_align="left" divider_color="#ffffff"][vc_column_text css=".vc_custom_1493925383715{margin-top: 25px !important;margin-bottom: 25px !important;}"]♫ Grab our Monthly Newsletter and stay tuned[/vc_column_text][vc_column_text css=".vc_custom_1497301922989{margin-top: 25px !important;margin-bottom: 25px !important;}"][mc4wp_form][/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row][vc_column][vc_column_text el_class="sponsor-logo" css=".vc_custom_1509654046544{padding-bottom: 100px !important;}"]<a href="//sonaar.io"><img class="alignnone wp-image-2210 size-full" src="https://assets.sonaar.io/vc_templates/logo-mobi.png" alt="" width="64" height="55" /></a><a href="//sonaar.io"><img class="alignnone wp-image-2209 size-full" src="https://assets.sonaar.io/vc_templates/logo-trackr.png" alt="" width="107" height="19" /></a><a href="//sonaar.io"><img class="alignnone wp-image-2208 size-full" src="https://assets.sonaar.io/vc_templates/logo-rise.png" alt="" width="59" height="66" /></a><a href="//sonaar.io"><img class="alignnone wp-image-2207 size-full" src="https://assets.sonaar.io/vc_templates/logo-esound.png" alt="" width="135" height="24" /></a><a href="//sonaar.io"><img class="alignnone wp-image-2206 size-full" src="https://assets.sonaar.io/vc_templates/logo-itmusic.png" alt="" width="124" height="48" /></a><a href="//sonaar.io"><img class="alignnone wp-image-2205 size-full" src="https://assets.sonaar.io/vc_templates/logo-soundrise.png" alt="" width="146" height="34" /></a>[/vc_column_text][/vc_column][/vc_row][vc_row content_placement="middle" css=".vc_custom_1509078817601{padding-top: 10px !important;padding-bottom: 20px !important;background-color: #000000 !important;}"][vc_column][vc_column_text el_class="footercredit"]<p style="text-align: center;">2018 © COPYRIGHT @ <a href="https://sonaar.io">SONAAR.IO</a> -  ALL RIGHTS RESERVED - WEBSITE BY <a href="https://sonaar.io">YOURCOMPANY.COM</a></p>[/vc_column_text][/vc_column][/vc_row][/vc_section]
CONTENT;
	$templates[] = $data;			
   	//-- 	
  	$data = array();
	$data['name'] = esc_html__( 'Footer 03', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/footer_03.jpg';
	$data['sort_name'] = 'Footer';
	$data['custom_class'] = 'footers';
	$data['content'] = <<<CONTENT
[vc_section el_class="sonaar-templates-footer03"][vc_row][vc_column][vc_row_inner css=".vc_custom_1511805019109{padding-top: 50px !important;padding-right: 50px !important;padding-bottom: 0px !important;padding-left: 50px !important;background-color: rgba(0,0,0,0.8) !important;*background-color: rgb(0,0,0) !important;}" el_class="footer-radius"][vc_column_inner el_class="center-mobile" width="1/2"][vc_single_image source="external_link" img_fullwidth="0" custom_src="https://assets.sonaar.io/vc_templates/signature01.png"][/vc_column_inner][vc_column_inner el_class="align-right" width="1/2"][vc_btn title="" style="custom" custom_background="" custom_text="#ffffff" i_icon_fontawesome="fa fa-soundcloud" add_icon="true" link="url:%2F%2Fsoundcloud.com||target:%20_blank|"][vc_btn title="" style="custom" custom_background="" custom_text="#ffffff" i_icon_fontawesome="fa fa-facebook" add_icon="true" link="url:%2F%2Ffacebook.com||target:%20_blank|"][vc_btn title="" style="custom" custom_background="" custom_text="#ffffff" i_icon_fontawesome="fa fa-instagram" add_icon="true" link="url:%2F%2Finstagram.com||target:%20_blank|"][vc_btn title="" style="custom" custom_background="" custom_text="#ffffff" i_icon_fontawesome="fa fa-twitter" add_icon="true" link="url:%2F%2Ftwitter.com||target:%20_blank|"][/vc_column_inner][/vc_row_inner][vc_row_inner css=".vc_custom_1511216641532{padding-top: 0px !important;padding-right: 50px !important;padding-bottom: 50px !important;padding-left: 50px !important;background-color: rgba(0,0,0,0.8) !important;*background-color: rgb(0,0,0) !important;}"][vc_column_inner][vc_column_text css_animation="none" css=".vc_custom_1511215986537{padding-top: 25px !important;}"]<p style="text-transform: uppercase; font-size: 11px; text-align: center;"><span style="color: #ffffff;">2017 © Copyright @ SONAAR.IO -  All Rights Reserved - Website by YourCompany.com</span></p>[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][/vc_section]
CONTENT;
	$templates[] = $data;		
   	//-- 	
  	$data = array();
	$data['name'] = esc_html__( 'Footer 04', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/footer_04.jpg';
	$data['sort_name'] = 'Footer';
	$data['custom_class'] = 'footers';
	$data['content'] = <<<CONTENT
[vc_section el_class="sonaar-templates-footer04"][vc_row css=".vc_custom_1511036811973{margin-top: 100px !important;padding-top: 100px !important;padding-bottom: 100px !important;background-image: url(https://assets.sonaar.io/vc_templates/footer-bg01.jpg) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}" el_class="footer-withimage"][vc_column][vc_row_inner][vc_column_inner][vc_custom_heading text="Newsletter" font_container="tag:h3|font_size:48px|text_align:center|color:%23ffffff" use_theme_fonts="yes" css_animation="fadeInUp" fit_bg_text="0"][vc_custom_heading text="Grab our Monthly Newsletter and stay tuned" font_container="tag:p|font_size:14px|text_align:center|color:%23ffffff|line_height:12px" use_theme_fonts="yes" css_animation="fadeInDown" fit_bg_text="0" css=".vc_custom_1511807077580{margin-bottom: 35px !important;}"][vc_column_text css_animation="fadeInUp"][mc4wp_form id="1306"][/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row full_width="stretch_row_content" equal_height="yes" content_placement="middle" css=".vc_custom_1511807602532{padding-top: 10px !important;padding-bottom: 20px !important;background-color: #000000 !important;}"][vc_column css_animation="none" width="1/3" css=".vc_custom_1510674882383{margin-top: 50px !important;}"][vc_single_image source="external_link" alignment="center" css_animation="none" img_fullwidth="0" css=".vc_custom_1511807319227{margin-bottom: 50px !important;}" custom_src="https://assets.sonaar.io/vc_templates/logo_sonaar-dark.png"][/vc_column][vc_column css_animation="none" width="1/3"][vc_btn title="" style="custom" custom_background="#000000" custom_text="#ffffff" shape="round" size="lg" i_icon_fontawesome="fa fa-facebook" add_icon="true" link="url:%2F%2Ffacebook.com||target:%20_blank|"][vc_btn title="" style="custom" custom_background="#000000" custom_text="#ffffff" shape="round" size="lg" i_icon_fontawesome="fa fa-twitter" add_icon="true" link="url:%2F%2Ftwitter.com||target:%20_blank|"][vc_btn title="" style="custom" custom_background="#000000" custom_text="#ffffff" shape="round" size="lg" i_icon_fontawesome="fa fa-soundcloud" add_icon="true" link="url:%2F%2Fsoundcloud.com||target:%20_blank|"][vc_btn title="" style="custom" custom_background="#000000" custom_text="#ffffff" shape="round" size="lg" i_icon_fontawesome="fa fa-youtube" add_icon="true" link="url:%2F%2Fyoutube.com||target:%20_blank|"][vc_btn title="" style="custom" custom_background="#000000" custom_text="#ffffff" shape="round" size="lg" i_icon_fontawesome="fa fa-instagram" add_icon="true" link="url:%2F%2Finstagram.com||target:%20_blank|"][/vc_column][vc_column width="1/3"][vc_column_text css_animation="none" el_class="footercredit"]<p style="text-align: center;">WEBSITE BY <a href="https://sonaar.io">YOURCOMPANY.COM</a></p>[/vc_column_text][/vc_column][/vc_row][/vc_section]
CONTENT;
	$templates[] = $data;
   	//-- 	
  	$data = array();
	$data['name'] = esc_html__( 'Footer 05', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/footer_05.jpg';
	$data['sort_name'] = 'Footer';
	$data['custom_class'] = 'footers';
	$data['content'] = <<<CONTENT
[vc_section el_class="sonaar-templates-footer05"][vc_row css_animation="none" css=".vc_custom_1511810692928{padding-top: 50px !important;background-color: #e3e0e5 !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_column][vc_row_inner css=".vc_custom_1493915284068{margin-bottom: 80px !important;}"][vc_column_inner width="1/3" css=".vc_custom_1511810676236{padding-right: 12px !important;padding-left: 12px !important;}"][vc_custom_heading text="Get in touch" font_container="tag:h4|font_size:36px|text_align:left|line_height:40px" use_theme_fonts="yes" fit_bg_text="0" css=".vc_custom_1511811251553{margin-bottom: 18px !important;}"][iron_image_divider divider_align="left"][vc_column_text css=".vc_custom_1493917184757{padding-top: 14px !important;}"]4000, Park Avenue East, Suite 400[/vc_column_text][vc_column_text css=".vc_custom_1493917198740{padding-top: 14px !important;}"]New York City, NY[/vc_column_text][vc_column_text css=".vc_custom_1493917209866{padding-top: 14px !important;}"]93834, United States[/vc_column_text][vc_column_text css=".vc_custom_1493917220858{padding-top: 14px !important;}"]P. +1 514 522-5672[/vc_column_text][vc_column_text css=".vc_custom_1508512422568{padding-top: 14px !important;}"]<a href="mailto:info@soundrise.com">info@soundrise.com</a>[/vc_column_text][/vc_column_inner][vc_column_inner width="1/3" css=".vc_custom_1511810680812{padding-right: 12px !important;padding-left: 12px !important;}"][vc_custom_heading text="Follow us" font_container="tag:h4|font_size:36px|text_align:left|line_height:40px" use_theme_fonts="yes" fit_bg_text="0" css=".vc_custom_1511811268081{margin-bottom: 18px !important;}"][iron_image_divider divider_align="left" divider_padding_bottom="15"][vc_btn title="Twitter" style="custom" custom_background="" custom_text="#4e4951" size="lg" align="left" i_icon_fontawesome="fa fa-twitter" add_icon="true" link="url:%2F%2Ftwitter.com||target:%20_blank|"][vc_btn title="Facebook" style="custom" custom_background="" custom_text="#4e4951" size="lg" align="left" i_icon_fontawesome="fa fa-facebook" add_icon="true" link="url:%2F%2Ffacebook.com||target:%20_blank|"][vc_btn title="Instagram" style="custom" custom_background="" custom_text="#4e4951" size="lg" align="left" i_icon_fontawesome="fa fa-instagram" add_icon="true" link="url:%2F%2Finstagram.com||target:%20_blank|"][vc_btn title="SoundCloud" style="custom" custom_background="" custom_text="#4e4951" size="lg" align="left" i_icon_fontawesome="fa fa-soundcloud" add_icon="true" link="url:%2F%2Fsoundcloud.com||target:%20_blank|"][/vc_column_inner][vc_column_inner width="1/3" css=".vc_custom_1511810686011{padding-right: 12px !important;padding-left: 12px !important;}"][vc_custom_heading text="Newsletter" font_container="tag:h4|font_size:36px|text_align:left|line_height:40px" use_theme_fonts="yes" fit_bg_text="0" css=".vc_custom_1511811272975{margin-bottom: 18px !important;}"][iron_image_divider divider_align="left"][vc_column_text css=".vc_custom_1493925383715{margin-top: 25px !important;margin-bottom: 25px !important;}"]♫ Grab our Monthly Newsletter and stay tuned[/vc_column_text][vc_column_text css=".vc_custom_1497301922989{margin-top: 25px !important;margin-bottom: 25px !important;}"][mc4wp_form][/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row css=".vc_custom_1511811351882{padding-top: 50px !important;padding-bottom: 50px !important;background-color: #4e4951 !important;}"][vc_column][vc_column_text el_class="sponsor-logo" css=".vc_custom_1511811358109{padding-bottom: 50px !important;}"]<a href="//sonaar.io"><img class="alignnone wp-image-2210 size-full" src="https://assets.sonaar.io/vc_templates/logo-mobi.png" alt="" width="64" height="55" /></a><a href="//sonaar.io"><img class="alignnone wp-image-2209 size-full" src="https://assets.sonaar.io/vc_templates/logo-trackr.png" alt="" width="107" height="19" /></a><a href="//sonaar.io"><img class="alignnone wp-image-2208 size-full" src="https://assets.sonaar.io/vc_templates/logo-rise.png" alt="" width="59" height="66" /></a><a href="//sonaar.io"><img class="alignnone wp-image-2207 size-full" src="https://assets.sonaar.io/vc_templates/logo-esound.png" alt="" width="135" height="24" /></a><a href="//sonaar.io"><img class="alignnone wp-image-2206 size-full" src="https://assets.sonaar.io/vc_templates/logo-itmusic.png" alt="" width="124" height="48" /></a><a href="//sonaar.io"><img class="alignnone wp-image-2205 size-full" src="https://assets.sonaar.io/vc_templates/logo-soundrise.png" alt="" width="146" height="34" /></a>[/vc_column_text][vc_column_text el_class="footercredit" css=".vc_custom_1511810824960{margin-top: 50px !important;}"]<p style="text-align: center; color: #fff;">2018 © COPYRIGHT @ <a href="https://sonaar.io">SONAAR.IO</a> -  ALL RIGHTS RESERVED - WEBSITE BY <a href="https://sonaar.io">YOURCOMPANY.COM</a></p>[/vc_column_text][/vc_column][/vc_row][/vc_section]
CONTENT;
	$templates[] = $data;
	//-- 	
	$data = array();
	$data['name'] = esc_html__( 'Footer 06', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/footer_06.jpg';
	$data['sort_name'] = 'Footer';
	$data['custom_class'] = 'footers';
	$data['content'] = <<<CONTENT
[vc_row full_width="stretch_row" css=".vc_custom_1515184889056{padding-top: 100px !important;padding-bottom: 30px !important;background-image: url(https://assets.sonaar.io/vc_templates/footer-bg01.jpg?id=) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}" el_class="footer-withimage"][vc_column][vc_row_inner css=".vc_custom_1514999360524{margin-bottom: 75px !important;}"][vc_column_inner width="1/2" enable_responsive_options="yes" align="text-lg-right text-sm-center" css=".vc_custom_1514999452134{padding-right: 50px !important;}" responsive_css="margin_right_tablet:15|margin_left_tablet:15|margin_right_mobile:15|margin_left_mobile:15"][vc_custom_heading text="Newsletter" font_container="tag:h3|text_align:center|color:%23ffffff" use_theme_fonts="yes" css_animation="fadeInUp" enable_fittext="yes" fit_bg_text="0" fittex_size="48px"][vc_custom_heading text="Grab our Monthly Newsletter and stay tuned" font_container="tag:p|font_size:14px|text_align:center|color:%23ffffff|line_height:12px" use_theme_fonts="yes" css_animation="fadeInDown" fit_bg_text="0" css=".vc_custom_1511807077580{margin-bottom: 35px !important;}"][/vc_column_inner][vc_column_inner width="1/2" enable_responsive_options="yes" align="text-lg-left text-sm-center" css=".vc_custom_1514999458926{padding-left: 50px !important;}" responsive_css="padding_right_tablet:15|padding_left_tablet:15|padding_right_mobile:15|padding_left_mobile:15"][vc_column_text css_animation="fadeInUp"][mc4wp_form id="1306"][/vc_column_text][/vc_column_inner][/vc_row_inner][vc_column_text el_class="footercredit"]<p style="text-align: center;">2018 © COPYRIGHT @ SONAAR.IO -  ALL RIGHTS RESERVED - WEBSITE BY <a href="https://sonaar.io" target="_blank" rel="noopener">SONAAR.IO</a></p>[/vc_column_text][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;
	//-- 	
	$data = array();
	$data['name'] = esc_html__( 'Footer 07', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/footer_07.jpg';
	$data['sort_name'] = 'Footer';
	$data['custom_class'] = 'footers';
	$data['content'] = <<<CONTENT
[vc_section full_width="stretch_row" el_class="sonaar-templates-footer07" css=".vc_custom_1519941376229{background-color: #000000 !important;}"][vc_row full_width="stretch_row_content" equal_height="yes" content_placement="middle" css=".vc_custom_1519940348255{margin-top: 30px !important;padding-top: 10px !important;padding-bottom: 20px !important;}"][vc_column css_animation="none" align="text-lg-center text-md-center text-sm-center text-xs-center"][vc_btn title="" style="custom" custom_background="#000000" custom_text="#dfd9df" shape="round" size="lg" i_icon_fontawesome="fa fa-twitter" add_icon="true" link="url:%2F%2Ftwitter.com||target:%20_blank|" css=".vc_custom_1518710011793{margin-right: 40px !important;margin-left: 40px !important;}"][vc_btn title="" style="custom" custom_background="#000000" custom_text="#dfd9df" shape="round" size="lg" i_icon_fontawesome="fa fa-facebook" add_icon="true" link="url:%2F%2Ffacebook.com||target:%20_blank|" css=".vc_custom_1518710023558{margin-right: 40px !important;margin-left: 40px !important;}"][vc_btn title="" style="custom" custom_background="#000000" custom_text="#ffffff" shape="round" size="lg" i_icon_fontawesome="fa fa-instagram" add_icon="true" link="url:%2F%2Finstagram.com||target:%20_blank|" css=".vc_custom_1518710034043{margin-right: 40px !important;margin-left: 40px !important;}"][vc_btn title="" style="custom" custom_background="#000000" custom_text="#dfd9df" shape="round" size="lg" i_icon_fontawesome="fa fa-soundcloud" add_icon="true" link="url:%2F%2Fsoundcloud.com||target:%20_blank|" css=".vc_custom_1518710043746{margin-right: 40px !important;margin-left: 40px !important;}"][/vc_column][/vc_row][vc_row full_width="stretch_row" css=".vc_custom_1519940570785{margin-top: 75px !important;margin-right: 35px !important;margin-bottom: 45px !important;margin-left: 25px !important;}"][vc_column enable_responsive_options="yes" offset="vc_col-lg-4 vc_col-md-4 vc_col-xs-12" align="text-lg-left text-md-center text-sm-center text-xs-center" css=".vc_custom_1518732597758{margin-bottom: 50px !important;}" responsive_css="margin_bottom_mobile:30"][vc_custom_heading text="NEWSLETTER" font_container="tag:h2|font_size:36px|text_align:left|color:%23dfd9df|line_height:36px" use_theme_fonts="yes" enable_fittext="yes" letter_spacing="2px" css=".vc_custom_1518729902060{margin-top: 10px !important;margin-bottom: 12px !important;}" fittex_size="36px"][vc_custom_heading text="STAY TUNED WITH OUR MAILING LIST" font_container="tag:div|font_size:16px|text_align:left|color:%23dfd9df|line_height:18px" google_fonts="font_family:Montserrat%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2Cregular%2Citalic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic|font_style:500%20bold%20regular%3A500%3Anormal" letter_spacing="1px"][/vc_column][vc_column enable_responsive_options="yes" align="text-lg-left text-md-center text-sm-center text-xs-center" offset="vc_col-lg-8 vc_col-md-8 vc_col-xs-12" css=".vc_custom_1518732345002{padding-right: 0px !important;padding-left: 0px !important;}" responsive_css="padding_right_desktop:15|padding_left_desktop:15|padding_right_tablet:15|padding_left_tablet:15"][vc_column_text css_animation="none"][mc4wp_form id="1306"][/vc_column_text][/vc_column][/vc_row][vc_row css_animation="none" css=".vc_custom_1518748910174{margin-top: 20px !important;margin-bottom: 70px !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_column][vc_column_text el_class="footercredit"]
<p style="text-align: center;"><span style="color: #ffffff;">2018 © SONAAR MUSIC - music wordpress theme by</span> <a href="//sonaar.io" target="_blank" rel="noopener">sonaar.io</a></p>
[/vc_column_text][/vc_column][/vc_row][/vc_section]
CONTENT;
	$templates[] = $data;
	//-- 	
	$data = array();
	$data['name'] = esc_html__( 'Social media footer', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/social_media_footer.jpg';
	$data['sort_name'] = 'Footer';
	$data['custom_class'] = 'footers';
	$data['content'] = <<<CONTENT
[vc_section el_class="sonaar-templates-social-media-footer"][vc_row full_width="stretch_row_content" content_placement="middle" css=".vc_custom_1514998753613{padding-top: 25px !important;padding-bottom: 5px !important;background-color: #dfd9df !important;}"][vc_column css_animation="none" css=".vc_custom_1515186825533{margin-left: 50px !important;}" align="text-lg-center text-md-center text-sm-center text-xs-center"][vc_btn title="" style="custom" custom_background="#dfd9df" custom_text="#3f3f3f" shape="round" size="lg" i_icon_fontawesome="fa fa-facebook" add_icon="true" link="url:%2F%2Ffacebook.com||target:%20_blank|" css=".vc_custom_1515187534526{margin-right: 20px !important;margin-left: 20px !important;}"][vc_btn title="" style="custom" custom_background="#dfd9df" custom_text="#3f3f3f" shape="round" size="lg" i_icon_fontawesome="fa fa-twitter" add_icon="true" link="url:%2F%2Ftwitter.com||target:%20_blank|" css=".vc_custom_1515187549034{margin-right: 20px !important;margin-left: 20px !important;}"][vc_btn title="" style="custom" custom_background="#dfd9df" custom_text="#3f3f3f" shape="round" size="lg" i_icon_fontawesome="fa fa-soundcloud" add_icon="true" link="url:%2F%2Fsoundcloud.com||target:%20_blank|" css=".vc_custom_1515187460109{margin-right: 20px !important;margin-left: 20px !important;}"][vc_btn title="" style="custom" custom_background="#dfd9df" custom_text="#3f3f3f" shape="round" size="lg" i_icon_fontawesome="fa fa-youtube" add_icon="true" link="url:%2F%2Fyoutube.com||target:%20_blank|" css=".vc_custom_1515187448630{margin-right: 20px !important;margin-left: 20px !important;}"][vc_btn title="" style="custom" custom_background="#dfd9df" custom_text="#3f3f3f" shape="round" size="lg" i_icon_fontawesome="fa fa-instagram" add_icon="true" link="url:%2F%2Finstagram.com||target:%20_blank|" css=".vc_custom_1515187437765{margin-right: 20px !important;margin-left: 20px !important;}"][/vc_column][/vc_row][/vc_section]
CONTENT;
	$templates[] = $data;
	
	/*************
	// MISC CATEGORY
  	**************/
   	//-- 	
	$data = array();
	$data['name'] = esc_html__( 'Square pictures on 4 columns', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/pics-4columns.jpg';
	$data['sort_name'] = 'Picture';
	$data['custom_class'] = 'misc';
	$data['content'] = <<<CONTENT
[vc_row full_width="stretch_row_content" gap="20"][vc_column width="1/4" align="text-lg-center text-md-center text-sm-center text-xs-center" css=".vc_custom_1515099776362{margin-bottom: 10px !important;padding-right: 0px !important;padding-left: 0px !important;}"][vc_single_image source="external_link" external_img_size="900x900" alignment="center" css_animation="fadeIn" img_fullwidth="0" custom_src="https://assets.sonaar.io/vc_templates/photo-bw_01.jpg"][/vc_column][vc_column width="1/4" align="text-lg-center text-md-center text-sm-center text-xs-center" css=".vc_custom_1515099803801{margin-bottom: 10px !important;padding-right: 0px !important;padding-left: 0px !important;}"][vc_single_image source="external_link" external_img_size="900x900" alignment="center" css_animation="fadeIn" img_fullwidth="0" custom_src="https://assets.sonaar.io/vc_templates/photo-bw_02.jpg"][/vc_column][vc_column width="1/4" align="text-lg-center text-md-center text-sm-center text-xs-center" css=".vc_custom_1515099811372{margin-bottom: 10px !important;padding-right: 0px !important;padding-left: 0px !important;}"][vc_single_image source="external_link" external_img_size="900x900" alignment="center" css_animation="fadeIn" img_fullwidth="0" custom_src="https://assets.sonaar.io/vc_templates/photo-bw_03.jpg"][/vc_column][vc_column width="1/4" align="text-lg-center text-md-center text-sm-center text-xs-center" css=".vc_custom_1515099817539{margin-bottom: 10px !important;padding-right: 0px !important;padding-left: 0px !important;}"][vc_single_image source="external_link" external_img_size="900x900" alignment="center" css_animation="fadeIn" img_fullwidth="0" custom_src="https://assets.sonaar.io/vc_templates/photo-bw_04.jpg"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;
	//-- 	
	$data = array();
	$data['name'] = esc_html__( 'Square pictures on 3 columns', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/pics-3columns.jpg';
	$data['sort_name'] = 'Picture';
	$data['custom_class'] = 'misc';
	$data['content'] = <<<CONTENT
[vc_row full_width="stretch_row_content" gap="20"][vc_column width="1/3" align="text-lg-center text-md-center text-sm-center text-xs-center" css=".vc_custom_1515099776362{margin-bottom: 10px !important;padding-right: 0px !important;padding-left: 0px !important;}"][vc_single_image source="external_link" external_img_size="900x900" alignment="center" css_animation="fadeIn" img_fullwidth="0" custom_src="https://assets.sonaar.io/vc_templates/photo-bw_01.jpg"][/vc_column][vc_column width="1/3" align="text-lg-center text-md-center text-sm-center text-xs-center" css=".vc_custom_1515099803801{margin-bottom: 10px !important;padding-right: 0px !important;padding-left: 0px !important;}"][vc_single_image source="external_link" external_img_size="900x900" alignment="center" css_animation="fadeIn" img_fullwidth="0" custom_src="https://assets.sonaar.io/vc_templates/photo-bw_02.jpg"][/vc_column][vc_column width="1/3" align="text-lg-center text-md-center text-sm-center text-xs-center" css=".vc_custom_1515099811372{margin-bottom: 10px !important;padding-right: 0px !important;padding-left: 0px !important;}"][vc_single_image source="external_link" external_img_size="900x900" alignment="center" css_animation="fadeIn" img_fullwidth="0" custom_src="https://assets.sonaar.io/vc_templates/photo-bw_03.jpg"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;
	//-- 	
	$data = array();
	$data['name'] = esc_html__( 'Countdown', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/countdown-01.jpg';
	$data['sort_name'] = 'Countdown';
	$data['custom_class'] = 'misc';
	$data['content'] = <<<CONTENT
	[vc_row full_width="stretch_row_content_no_spaces" content_placement="bottom" gradient_bg="yes" css=".vc_custom_1515449295115{padding-top: 10vh !important;}" gradient_bg_color="linear-gradient(to bottom right,rgb(141, 255, 242) 0%,rgb(36, 187, 170) 100%)|background-size: cover;background-position: 50% 50%;background-repeat: repeat;background-attachment: fixed;background-origin: border-box;background-clip: border-box;"][vc_column width="1/4" align="text-lg-left" offset="vc_hidden-sm vc_hidden-xs"][vc_single_image source="external_link" img_fullwidth="0" el_class="flipimg" custom_src="https://assets.sonaar.io/vc_templates/artist-profile_1.png"][/vc_column][vc_column align="text-lg-center" css=".vc_custom_1514996318506{padding-bottom: 225px !important;}" offset="vc_col-lg-6 vc_col-md-6"][vc_custom_heading text="NEXT EVENT" font_container="tag:h3|text_align:center|color:%23ffffff" use_theme_fonts="yes" inline_block_display="yes" css=".vc_custom_1515449177040{margin-bottom: 75px !important;}"][vc_custom_heading text="MONTREAL, QC" font_container="tag:h2|text_align:center|color:%237738ba" use_theme_fonts="yes" enable_fittext="yes" fittex_size="78px"][iron_countdown end_time="2018-08-31 19:03" show_months="0" show_days="0" show_hours="1" show_minutes="1" show_seconds="1" show_labels="1" numbers_font="font_family:Monoton%3Aregular|font_style:400%20regular%3A400%3Anormal" labels_font="font_family:Montserrat%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2Cregular%2Citalic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic|font_style:400%20regular%3A400%3Anormal" count_color="#ffffff" count_splitter=" :" labels_align="center" numbers_font_size="64" labels_font_size="14" numbers_spacing="30" numbers_margin="30" tablet_numbers_font_size="64" tablet_labels_font_size="14" mobile_numbers_font_size="32" mobile_labels_font_size="12"][vc_btn title="View All Dates" style="custom" custom_background="#7738ba" custom_text="#ffffff" shape="round" size="lg" align="center" i_align="right" i_type="typicons" i_icon_typicons="typcn typcn-arrow-right" add_icon="true" link="url:%23|||" css=".vc_custom_1515449278751{margin-top: 30px !important;}"][/vc_column][vc_column width="1/4" offset="vc_hidden-sm vc_hidden-xs"][vc_single_image source="external_link" alignment="right" img_fullwidth="0" custom_src="https://assets.sonaar.io/vc_templates/artist-profile_2.png"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;
	//-- 	
	$data = array();
	$data['name'] = esc_html__( 'Text and image 01', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/text-image_01.jpg';
	$data['sort_name'] = 'Text';
	$data['custom_class'] = 'misc';
	$data['content'] = <<<CONTENT
[vc_row full_width="stretch_row_content_no_spaces" equal_height="yes" content_placement="middle"][vc_column width="1/2" bg_position="center top" css=".vc_custom_1515616227300{background-image: url(https://assets.sonaar.io/vc_templates/dj_and_crowd.jpg) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_custom_heading text="We are

Sonaar" font_container="tag:div|font_size:60px|text_align:center|color:%23ffffff|line_height:68px" use_theme_fonts="yes" enable_fittext="yes" css=".vc_custom_1515615059021{padding-top: 150px !important;padding-bottom: 150px !important;}" fittex_size="65px"][/vc_column][vc_column width="1/2" enable_responsive_options="yes" css=".vc_custom_1515615876502{padding-top: 100px !important;padding-right: 100px !important;padding-bottom: 100px !important;padding-left: 100px !important;}" responsive_css="padding_top_desktop:75|padding_right_desktop:75|padding_bottom_desktop:75|padding_left_desktop:75|padding_top_tablet:50|padding_right_tablet:25|padding_bottom_tablet:50|padding_left_tablet:25|padding_right_mobile:25|padding_left_mobile:25"][vc_custom_heading text="The future of Music" font_container="tag:h3|font_size:38px|text_align:left|line_height:42px" use_theme_fonts="yes" css=".vc_custom_1515616919535{margin-top: 0px !important;margin-bottom: 50px !important;}"][vc_custom_heading text="About Us" font_container="tag:h4|font_size:24px|text_align:left|line_height:28px" use_theme_fonts="yes" css=".vc_custom_1515615618498{margin-top: 30px !important;}"][vc_column_text]Tantum autem cuique tribuendum, primum quantum ipse efficere possis, deinde etiam quantum ille quem diligas atque adiuves, sustinere. Non enim neque tu possis, quamvis excellas, omnes tuos ad honores amplissimos perducere, ut Scipio P. Rupilium potuit consulem efficere, fratrem eius L. non potuit. Quod si etiam possis quidvis deferre ad alterum, videndum est tamen, quid ille possit sustinere.[/vc_column_text][vc_custom_heading text="About Music" font_container="tag:h4|font_size:24px|text_align:left|line_height:28px" use_theme_fonts="yes" css=".vc_custom_1515615604779{margin-top: 30px !important;}"][vc_column_text]Ibi victu recreati et quiete, postquam abierat timor, vicos opulentos adorti equestrium adventu cohortium, quae casu propinquabant, nec resistere planitie porrecta conati digressi sunt retroque concedentes omne iuventutis robur relictum in sedibus acciverunt.[/vc_column_text][vc_custom_heading text="About Sonaar" font_container="tag:h4|font_size:24px|text_align:left|line_height:28px" use_theme_fonts="yes" css=".vc_custom_1515615612553{margin-top: 30px !important;}"][vc_column_text]Vbi curarum abiectis ponderibus aliis tamquam nodum et codicem difficillimum Caesarem convellere nisu valido cogitabat, eique deliberanti cum proximis clandestinis conloquiis et nocturnis qua vi, quibusve commentis id fieret, antequam effundendis rebus pertinacius incumberet confidentia, acciri mollioribus scriptis per simulationem tractatus publici nimis urgentis eundem placuerat Gallum, ut auxilio destitutus sine ullo interiret obstaculo.[/vc_column_text][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;
	//-- 	
	$data = array();
	$data['name'] = esc_html__( 'Text and image 02', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/text-image_02.jpg';
	$data['sort_name'] = 'Text';
	$data['custom_class'] = 'misc';
	$data['content'] = <<<CONTENT
[vc_row full_width="stretch_row_content_no_spaces" equal_height="yes" content_placement="middle" gradient_bg="yes" gradient_bg_color="linear-gradient(317deg,rgb(65, 54, 65) 2.6%,rgb(20, 20, 20) 100%)|background-size: auto auto;background-position: 50% 50%;background-repeat: repeat;background-attachment: scroll;background-origin: border-box;background-clip: border-box;"][vc_column width="1/2" bg_position="center top" css=".vc_custom_1515616227300{background-image: url(https://assets.sonaar.io/vc_templates/dj_and_crowd.jpg) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_custom_heading text="We are

Sonaar" font_container="tag:div|font_size:60px|text_align:center|color:%23ffffff|line_height:68px" use_theme_fonts="yes" enable_fittext="yes" css=".vc_custom_1515615059021{padding-top: 150px !important;padding-bottom: 150px !important;}" fittex_size="65px"][/vc_column][vc_column width="1/2" enable_responsive_options="yes" css=".vc_custom_1515615876502{padding-top: 100px !important;padding-right: 100px !important;padding-bottom: 100px !important;padding-left: 100px !important;}" responsive_css="padding_top_desktop:75|padding_right_desktop:75|padding_bottom_desktop:75|padding_left_desktop:75|padding_top_tablet:50|padding_right_tablet:25|padding_bottom_tablet:50|padding_left_tablet:25|padding_right_mobile:25|padding_left_mobile:25"][vc_custom_heading text="The future of Music" font_container="tag:h3|font_size:38px|text_align:left|color:%23ffffff|line_height:42px" use_theme_fonts="yes" css=".vc_custom_1515617330470{margin-top: 0px !important;margin-bottom: 50px !important;}"][vc_custom_heading text="About Us" font_container="tag:h4|font_size:24px|text_align:left|color:%23ffffff|line_height:28px" use_theme_fonts="yes" css=".vc_custom_1515617340380{margin-top: 30px !important;}"][vc_column_text]<span style="color: #ffffff;">Tantum autem cuique tribuendum, primum quantum ipse efficere possis, deinde etiam quantum ille quem diligas atque adiuves, sustinere. Non enim neque tu possis, quamvis excellas, omnes tuos ad honores amplissimos perducere, ut Scipio P. Rupilium potuit consulem efficere, fratrem eius L. non potuit. Quod si etiam possis quidvis deferre ad alterum, videndum est tamen, quid ille possit sustinere.</span>[/vc_column_text][vc_custom_heading text="About Music" font_container="tag:h4|font_size:24px|text_align:left|color:%23ffffff|line_height:28px" use_theme_fonts="yes" css=".vc_custom_1515617350562{margin-top: 30px !important;}"][vc_column_text]<span style="color: #ffffff;">Ibi victu recreati et quiete, postquam abierat timor, vicos opulentos adorti equestrium adventu cohortium, quae casu propinquabant, nec resistere planitie porrecta conati digressi sunt retroque concedentes omne iuventutis robur relictum in sedibus acciverunt.</span>[/vc_column_text][vc_custom_heading text="About Sonaar" font_container="tag:h4|font_size:24px|text_align:left|color:%23ffffff|line_height:28px" use_theme_fonts="yes" css=".vc_custom_1515617360475{margin-top: 30px !important;}"][vc_column_text]<span style="color: #ffffff;">Vbi curarum abiectis ponderibus aliis tamquam nodum et codicem difficillimum Caesarem convellere nisu valido cogitabat, eique deliberanti cum proximis clandestinis conloquiis et nocturnis qua vi, quibusve commentis id fieret, antequam effundendis rebus pertinacius incumberet confidentia, acciri mollioribus scriptis per simulationem tractatus publici nimis urgentis eundem placuerat Gallum, ut auxilio destitutus sine ullo interiret obstaculo.</span>[/vc_column_text][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;
	//-- 	
	$data = array();
	$data['name'] = esc_html__( 'Text on 2 columns + image 01', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/text-2columns-image_01.jpg';
	$data['sort_name'] = 'Text';
	$data['custom_class'] = 'misc';
	$data['content'] = <<<CONTENT
[vc_row css=".vc_custom_1515604319268{padding-top: 75px !important;padding-bottom: 75px !important;}"][vc_column width="7/12" css=".vc_custom_1515604434252{margin-right: 15px !important;margin-left: 15px !important;}"][vc_custom_heading text="The Future of Music" use_theme_fonts="yes"][vc_row_inner css=".vc_custom_1515602480892{padding-top: 25px !important;}"][vc_column_inner width="1/2" css=".vc_custom_1515602516634{margin-bottom: 20px !important;padding-right: 30px !important;padding-left: 0px !important;}"][vc_column_text]Ciliciam vero, quae Cydno amni exultat, Tarsus nobilitat, urbs perspicabilis hanc condidisse Perseus memoratur, Iovis filius et Danaes, vel certe ex Aethiopia profectus Sandan quidam nomine vir opulentus et nobilis et Anazarbus auctoris vocabulum referens, et Mopsuestia vatis illius domicilium Mopsi, quem a conmilitio.

Argonautarum cum aureo vellere direpto redirent, errore abstractum delatumque.[/vc_column_text][/vc_column_inner][vc_column_inner width="1/2" css=".vc_custom_1515602524918{margin-bottom: 20px !important;padding-right: 30px !important;padding-left: 0px !important;}"][vc_column_text]Ardeo, mihi credite, Patres conscripti (id quod vosmet de me existimatis et facitis ipsi) incredibili quodam amore patriae, qui me amor et subvenire olim impendentibus periculis maximis cum dimicatione.

Capitis, et rursum, cum omnia tela undique esse intenta in patriam viderem, subire coegit atque excipere unum pro universis. Hic me meus in rem publicam animus pristinus ac perennis cum.[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][vc_column width="5/12" css=".vc_custom_1515604489043{margin-right: 15px !important;margin-left: 15px !important;}"][vc_single_image source="external_link" external_img_size="full" alignment="center" img_fullwidth="0" custom_src="https://assets.sonaar.io/vc_templates/artist-profile_2.png"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;
	//-- 	
	$data = array();
	$data['name'] = esc_html__( 'Text on 2 columns + image 02', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/text-2columns-image_02.jpg';
	$data['sort_name'] = 'Text';
	$data['custom_class'] = 'misc';
	$data['content'] = <<<CONTENT
[vc_row full_width="stretch_row" gradient_bg="yes" css=".vc_custom_1515606778600{padding-top: 75px !important;padding-bottom: 75px !important;}" gradient_bg_color="linear-gradient(317deg,rgb(65, 54, 65) 2.6%,rgb(20, 20, 20) 100%)|background-size: auto auto;background-position: 50% 50%;background-repeat: repeat;background-attachment: scroll;background-origin: border-box;background-clip: border-box;"][vc_column width="7/12" css=".vc_custom_1515604434252{margin-right: 15px !important;margin-left: 15px !important;}"][vc_custom_heading text="The Future of Music" font_container="tag:h2|text_align:left|color:%23ffffff" use_theme_fonts="yes"][vc_row_inner css=".vc_custom_1515602480892{padding-top: 25px !important;}"][vc_column_inner width="1/2" css=".vc_custom_1515602516634{margin-bottom: 20px !important;padding-right: 30px !important;padding-left: 0px !important;}"][vc_column_text]<span style="color: #ffffff;">Ciliciam vero, quae Cydno amni exultat, Tarsus nobilitat, urbs perspicabilis hanc condidisse Perseus memoratur, Iovis filius et Danaes, vel certe ex Aethiopia profectus Sandan quidam nomine vir opulentus et nobilis et Anazarbus auctoris vocabulum referens, et Mopsuestia vatis illius domicilium Mopsi, quem a conmilitio.</span>

<span style="color: #ffffff;">Argonautarum cum aureo vellere direpto redirent, errore abstractum delatumque.</span>[/vc_column_text][/vc_column_inner][vc_column_inner width="1/2" css=".vc_custom_1515602524918{margin-bottom: 20px !important;padding-right: 30px !important;padding-left: 0px !important;}"][vc_column_text]<span style="color: #ffffff;">Ardeo, mihi credite, Patres conscripti (id quod vosmet de me existimatis et facitis ipsi) incredibili quodam amore patriae, qui me amor et subvenire olim impendentibus periculis maximis cum dimicatione.</span>

<span style="color: #ffffff;">Capitis, et rursum, cum omnia tela undique esse intenta in patriam viderem, subire coegit atque excipere unum pro universis. Hic me meus in rem publicam animus pristinus ac perennis cum.</span>[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][vc_column width="5/12" css=".vc_custom_1515604489043{margin-right: 15px !important;margin-left: 15px !important;}"][vc_single_image source="external_link" external_img_size="full" alignment="center" img_fullwidth="0" custom_src="https://assets.sonaar.io/vc_templates/man01.png"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;
	//-- 	
	$data = array();
	$data['name'] = esc_html__( 'Text and button' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/studio-intro.jpg';
	$data['sort_name'] = 'Text';
	$data['custom_class'] = 'misc';
	$data['content'] = <<<CONTENT
[vc_row full_width="stretch_row" full_height="yes" css=".vc_custom_1519939619960{padding-top: 50px !important;padding-bottom: 50px !important;background-image: url(https://assets.sonaar.io/vc_templates/studio-bg.jpg?id=) !important;}" el_class="sonaar-templates-studio-intro"][vc_column width="1/4"][/vc_column][vc_column width="1/2" align="text-lg-center text-md-center text-sm-center text-xs-center" css=".vc_custom_1518624270633{padding-right: 22px !important;padding-left: 22px !important;}"][vc_custom_heading text="Studio A" font_container="tag:h2|text_align:center|color:%23ffffff" use_theme_fonts="yes" inline_block_display="yes" css=".vc_custom_1519938420573{margin-bottom: 26px !important;border-bottom-width: 7px !important;padding-bottom: 15px !important;border-bottom-style: solid !important;}"][vc_column_text css=".vc_custom_1519938430135{margin-bottom: 55px !important;}"]The adjoining acoustic room is set up to accommodate up to 30 musicians and boasts a neutral acoustic. This means that equipment like our full drum kit and Yamaha C7 grand piano can be set up to provide the best possible sound. A complete microphone selection and a wide range of vintage outboard audio equipment ensures that our flagship Studio A has everything you need for an outstanding recording experience.[/vc_column_text][vc_btn title="BOOK YOUR SESSION" style="custom" custom_background="#00ad8e" custom_text="#ffffff" shape="round" link="url:https%3A%2F%2Fdemo.sonaar.io%2Fstudio%2Fbooking%2F|||"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;
	//-- 	
	$data = array();
	$data['name'] = esc_html__( 'Feature list 01' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/feature-list_01.jpg';
	$data['sort_name'] = 'Feature';
	$data['custom_class'] = 'misc';
	$data['content'] = <<<CONTENT
[vc_row equal_height="yes" content_placement="middle" el_class="sonaar-templates-banner-2columns-1" css=".vc_custom_1519936945984{margin-top: 50px !important;margin-bottom: 80px !important;}"][vc_column width="1/3" css=".vc_custom_1518644054185{padding-right: 0px !important;}" align="text-lg-right text-md-right text-sm-center text-xs-center"][vc_custom_heading text="FULL MUSIC
SERVICES" font_container="tag:h2|font_size:72px|text_align:right|color:%2300ad8e|line_height:68px" google_fonts="font_family:Oswald%3A200%2C300%2Cregular%2C500%2C600%2C700|font_style:700%20bold%20regular%3A700%3Anormal"][/vc_column][vc_column width="2/3" enable_responsive_options="yes" css=".vc_custom_1518644071646{padding-right: 10px !important;padding-left: 40px !important;}" responsive_css="padding_right_tablet:20|padding_left_tablet:20|padding_right_mobile:15|padding_left_mobile:15" align="text-sm-center text-xs-center"][vc_column_text css=".vc_custom_1520022750425{padding-right: 15px !important;padding-left: 15px !important;}"]A dedicated producer and creative director team follow your project through from start to finish for a seamless service experience.[/vc_column_text][/vc_column][/vc_row][vc_row gap="30" css=".vc_custom_1518808812896{margin-bottom: 100px !important;}"][vc_column width="1/3"][vc_icon icon_fontawesome="fa fa-music" color="white" align="center"][vc_column_text]
<h3 style="text-align: center;">ORIGINAL MUSIC
COMPOSITION</h3>
<p style="text-align: center;">Our roster of real-deal artists-composers and producers runs deep. Our roster of real-deal artists-composers and producers runs deep.</p>
[/vc_column_text][/vc_column][vc_column width="1/3"][vc_icon icon_fontawesome="fa fa-television" color="white" align="center"][vc_column_text]
<h3 style="text-align: center;">RADIO &amp; TV ADVERTISING</h3>
<p style="text-align: center;">From musical composition, recording and creative sound design to final mix and delivery, we will make your commercials stand out.[/vc_column_text][/vc_column][vc_column width="1/3"][vc_icon icon_fontawesome="fa fa-microphone" color="white" align="center"][vc_column_text]
<h3 style="text-align: center;">PROFESSIONAL SCORE RECORDING</h3>
<p style="text-align: center;">Unique, own-able sound signatures for brands. Our music supervisors get it, and then they clear it.</p>
[/vc_column_text][/vc_column][/vc_row][vc_row gap="30" css=".vc_custom_1518808836593{margin-bottom: 100px !important;}"][vc_column width="1/3"][vc_icon icon_fontawesome="fa fa-users" color="white" align="center"][vc_column_text]
<h3 style="text-align: center;">TALENT
SERVICES</h3>
<p style="text-align: center;">Our network of top-tier talent around the world is our superpower. We manage singer, bands and artist all around the globe</p>
[/vc_column_text][/vc_column][vc_column width="1/3"][vc_icon icon_fontawesome="fa fa-file-image-o" color="white" align="center"][vc_column_text]
<h3 style="text-align: center;">ARTIST AND
ALBUM RECORDING</h3>
<p style="text-align: center;">From musical composition, recording and creative sound design to final mix and delivery, we will make your  commercials stand out.[/vc_column_text][/vc_column][vc_column width="1/3"][vc_icon icon_fontawesome="fa fa-signal" color="white" align="center"][vc_column_text]
<h3 style="text-align: center;">CUSTOM
SOLUTIONS</h3>
<p style="text-align: center;">We are creative and we provide adaptable services for any kind of musical production. Try us today</p>
[/vc_column_text][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;
	//-- 	
	$data = array();
	$data['name'] = esc_html__( 'Feature list 02' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/feature-list_02.jpg';
	$data['sort_name'] = 'Feature';
	$data['custom_class'] = 'misc';
	$data['content'] = <<<CONTENT
<p>[vc_row gap="30" css=".vc_custom_1518808812896{margin-bottom: 100px !important;}"][vc_column width="1/3"][vc_icon icon_fontawesome="fa fa-music" color="white" align="center"][vc_column_text]</p>
<h3 style="text-align: center;">ORIGINAL MUSIC<br />
COMPOSITION</h3>
<p style="text-align: center;">Our roster of real-deal artists-composers and producers runs deep. Our roster of real-deal artists-composers and producers runs deep.</p>
<p>[/vc_column_text][/vc_column][vc_column width="1/3"][vc_icon icon_fontawesome="fa fa-television" color="white" align="center"][vc_column_text]</p>
<h3 style="text-align: center;">RADIO &amp; TV ADVERTISING</h3>
<p style="text-align: center;">From musical composition, recording and creative sound design to final mix and delivery, we will make your commercials stand out.[/vc_column_text][/vc_column][vc_column width="1/3"][vc_icon icon_fontawesome="fa fa-microphone" color="white" align="center"][vc_column_text]</p>
<h3 style="text-align: center;">PROFESSIONAL SCORE RECORDING</h3>
<p style="text-align: center;">Unique, own-able sound signatures for brands. Our music supervisors get it, and then they clear it.</p>
<p>[/vc_column_text][/vc_column][/vc_row][vc_row gap="30" css=".vc_custom_1518808836593{margin-bottom: 100px !important;}"][vc_column width="1/3"][vc_icon icon_fontawesome="fa fa-users" color="white" align="center"][vc_column_text]</p>
<h3 style="text-align: center;">TALENT<br />
SERVICES</h3>
<p style="text-align: center;">Our network of top-tier talent around the world is our superpower. We manage singer, bands and artist all around the globe</p>
<p>[/vc_column_text][/vc_column][vc_column width="1/3"][vc_icon icon_fontawesome="fa fa-file-image-o" color="white" align="center"][vc_column_text]</p>
<h3 style="text-align: center;">ARTIST AND<br />
ALBUM RECORDING</h3>
<p style="text-align: center;">From musical composition, recording and creative sound design to final mix and delivery, we will make your commercials stand out.[/vc_column_text][/vc_column][vc_column width="1/3"][vc_icon icon_fontawesome="fa fa-signal" color="white" align="center"][vc_column_text]</p>
<h3 style="text-align: center;">CUSTOM<br />
SOLUTIONS</h3>
<p style="text-align: center;">We are creative and we provide adaptable services for any kind of musical production. Try us today</p>
<p>[/vc_column_text][/vc_column][/vc_row]</p>
CONTENT;
		$templates[] = $data;
	//-- 	
	$data = array();
	$data['name'] = esc_html__( 'Buttons into video box' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/buttons-into-video-box.jpg';
	$data['sort_name'] = 'button';
	$data['custom_class'] = 'misc';
	$data['content'] = <<<CONTENT
[vc_row content_placement="middle" video_bg="yes" video_bg_url="https://www.youtube.com/watch?v=cWwEST3YuHo&t=3s" css_animation="fadeInUp" bg_position="center center" iron_row_type="full_width" iron_remove_padding_medium="tabletnopadding" iron_remove_padding_small="" iron_overlay_pattern="" iron_parallax="" iron_bg_video="" iron_id="videos" css=".vc_custom_1520284266233{margin-top: 50px !important;}" el_class="video-background-2buttons"][vc_column align="text-lg-center"][vc_row_inner][vc_column_inner enable_responsive_options="yes" css=".vc_custom_1517435495666{border-top-width: 12px !important;border-right-width: 12px !important;border-bottom-width: 12px !important;border-left-width: 12px !important;padding-top: 100px !important;padding-bottom: 100px !important;border-left-color: #eeee22 !important;border-left-style: solid !important;border-right-color: #eeee22 !important;border-right-style: solid !important;border-top-color: #eeee22 !important;border-top-style: solid !important;border-bottom-color: #eeee22 !important;border-bottom-style: solid !important;}" responsive_css="border_top_mobile:0|border_right_mobile:0|border_bottom_mobile:0|border_left_mobile:0" align="text-lg-center"][vc_custom_heading text="OFFICIAL PLAYLIST" font_container="tag:div|font_size:72px|text_align:center|color:%23ffffff|line_height:72px" google_fonts="font_family:Special%20Elite%3Aregular|font_style:400%20regular%3A400%3Anormal" inline_block_display="yes" css=".vc_custom_1517412884870{padding-top: 15px !important;padding-right: 20px !important;padding-bottom: 15px !important;padding-left: 20px !important;background-color: #000000 !important;}"][vc_empty_space height="1px"][vc_custom_heading text="CURATED BY SONAAR" font_container="tag:h2|font_size:21px|text_align:center|color:%23ccda00" google_fonts="font_family:Special%20Elite%3Aregular|font_style:400%20regular%3A400%3Anormal" css_animation="fadeInUp" inline_block_display="yes" fit_bg_text="0" css=".vc_custom_1520285381406{margin-top: -1px !important;padding-top: 5px !important;padding-right: 15px !important;padding-bottom: 5px !important;padding-left: 15px !important;background-color: #000000 !important;}"][vc_empty_space height="1px"][vc_btn title="LISTEN NOW" style="custom" custom_background="#ccda00" custom_text="#0a0a0a" shape="square" size="lg" i_icon_fontawesome="fa fa-play-circle" css_animation="fadeInUp" albums="2080" add_icon="true" custom_onclick="true" css=".vc_custom_1520285369727{margin-top: 30px !important;margin-right: 10px !important;margin-left: 10px !important;}" link="url:%23|||"][vc_btn title="SUBSCRIBE" style="custom" custom_background="#ccda00" custom_text="#0a0a0a" shape="square" size="lg" i_icon_fontawesome="fa fa-play-circle" css_animation="fadeInUp" add_icon="true" css=".vc_custom_1520285356146{margin-top: 30px !important;margin-right: 10px !important;margin-left: 10px !important;}" link="url:%23|||"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

	/*************
	// HEADING CATEGORY
  	**************/
   	//-- 	
	$data = array();
	$data['name'] = esc_html__( 'Align left underlined heading', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/underlined_heading-01.jpg';
	$data['sort_name'] = 'Heading';
	$data['custom_class'] = 'headings';
	$data['content'] = <<<CONTENT
[vc_row css=".vc_custom_1515182768108{margin-left: 10px !important;}"][vc_column align="text-sm-center text-xs-center"][vc_custom_heading text="Underlined Heading" use_theme_fonts="yes" inline_block_display="yes" css=".vc_custom_1515176234464{border-bottom-width: 8px !important;padding-bottom: 18px !important;border-bottom-style: solid !important;}"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;
	//-- 	
	$data = array();
	$data['name'] = esc_html__( 'Align center underlined heading', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/underlined_heading-02.jpg';
	$data['sort_name'] = 'Heading';
	$data['custom_class'] = 'headings';
	$data['content'] = <<<CONTENT
[vc_row][vc_column align="text-lg-center text-md-center text-sm-center text-xs-center"][vc_custom_heading text="Underlined Heading" use_theme_fonts="yes" inline_block_display="yes" css=".vc_custom_1515176234464{border-bottom-width: 8px !important;padding-bottom: 18px !important;border-bottom-style: solid !important;}"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;
	//-- 	
	$data = array();
	$data['name'] = esc_html__( 'Bold heading with button', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/bold_heading_button.jpg';
	$data['sort_name'] = 'Heading';
	$data['custom_class'] = 'headings';
	$data['content'] = <<<CONTENT
[vc_row full_width="stretch_row_content" content_placement="middle" css=".vc_custom_1515178596314{margin-top: 15px !important;margin-right: 15px !important;margin-bottom: 15px !important;margin-left: 15px !important;padding-top: 25px !important;padding-right: 30px !important;padding-bottom: 25px !important;padding-left: 30px !important;background-color: #000000 !important;}"][vc_column width="1/2" align="text-lg-left text-md-left text-sm-center text-xs-center"][vc_custom_heading text="Heading" font_container="tag:h2|font_size:74px|text_align:left|color:%23ffffff|line_height:70px" use_theme_fonts="yes" fit_bg_text="0" css=".vc_custom_1515178555632{margin-top: 20px !important;margin-bottom: 20px !important;}"][/vc_column][vc_column width="1/2" align="text-lg-right text-md-right text-sm-center text-xs-center"][vc_btn title="View All details" style="outline-custom" outline_custom_color="#ffffff" outline_custom_hover_background="#ffffff" outline_custom_hover_text="#000000" shape="square" size="lg" link="url:%23|||" css=".vc_custom_1515178388304{margin-bottom: 0px !important;}"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;
	//-- 	
	$data = array();
	$data['name'] = esc_html__( '2 headings boxed full-width', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/2-headings-boxed.jpg';
	$data['sort_name'] = 'Promotion';
	$data['custom_class'] = 'headings';
	$data['content'] = <<<CONTENT
[vc_row full_width="stretch_row_content_no_spaces" equal_height="yes" content_placement="middle" el_class="followus"][vc_column width="1/2" enable_responsive_options="yes" css=".vc_custom_1514924959736{background-color: #f0a5a9 !important;}" responsive_css="padding_left_desktop:20|padding_right_tablet:15|padding_left_tablet:15|padding_right_mobile:15|padding_left_mobile:15"][vc_custom_heading text="FOLLOW" font_container="tag:h4|font_size:87px|text_align:center|color:%23ffffff|line_height:87px" google_fonts="font_family:Monoton%3Aregular|font_style:400%20regular%3A400%3Anormal" enable_fittext="yes" fittex_size="87px" css=".vc_custom_1514924965971{padding-top: 70px !important;padding-bottom: 70px !important;}"][/vc_column][vc_column width="1/2" enable_responsive_options="yes" css=".vc_custom_1514920724539{background-color: #70ddc7 !important;}" responsive_css="padding_right_desktop:20|padding_right_tablet:15|padding_left_tablet:15|padding_right_mobile:15|padding_left_mobile:15"][vc_custom_heading text="SONAAR" font_container="tag:h4|font_size:87px|text_align:center|color:%23ffffff|line_height:87px" google_fonts="font_family:Monoton%3Aregular|font_style:400%20regular%3A400%3Anormal" enable_fittext="yes" fittex_size="87px" css=".vc_custom_1515173469094{padding-top: 70px !important;padding-bottom: 70px !important;}"][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;
	//-- 	
	$data = array();
	$data['name'] = esc_html__( 'Bold heading 1', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/bold-heading_1.jpg';
	$data['sort_name'] = 'Heading';
	$data['custom_class'] = 'headings';
	$data['content'] = <<<CONTENT
<p>[vc_row full_width="stretch_row" el_class="sonaar-templates-heading-bold-1"][vc_column align="text-lg-center"][vc_row_inner css=".vc_custom_1517368194465{margin-top: 40px !important;background-color: #ccda00 !important;}"][vc_column_inner][vc_custom_heading text="BOLD" font_container="tag:div|font_size:96px|text_align:center|color:%23ffffff|line_height:96px" google_fonts="font_family:Oswald%3A200%2C300%2Cregular%2C500%2C600%2C700|font_style:700%20bold%20regular%3A700%3Anormal" inline_block_display="yes" css=".vc_custom_1520026579407{padding-right: 20px !important;padding-left: 20px !important;background-color: #000000 !important;}"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]</p>
CONTENT;
	$templates[] = $data;
		
	
	/*************
	// EVENT LIST CATEGORY
  	**************/
	//-- 	
	$data = array();
	$data['name'] = esc_html__( 'Tour dates with video background', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/event-list_01.jpg';
	$data['sort_name'] = 'Tour dates';
	$data['custom_class'] = 'events_list';
	$data['content'] = <<<CONTENT
[vc_section el_class="sonaar-templates-event-list-01"][vc_row full_width="stretch_row" iron_row_type="full_width" iron_remove_padding_medium="" iron_remove_padding_small="" iron_overlay_pattern="" iron_parallax="" iron_bg_video="" css=".vc_custom_1510612555172{padding-bottom: 30px !important;background-color: #497274 !important;}"][vc_column][/vc_column][/vc_row][vc_row full_width="stretch_row" full_height="yes" video_bg="yes" video_bg_url="https://www.youtube.com/watch?v=JNQ5VvvSTC0" iron_row_type="full_width" iron_remove_padding_medium="tabletnopadding" iron_remove_padding_small="mobilenopadding" iron_overlay_pattern="" iron_parallax="" iron_bg_video="bg_video" iron_bg_video_mp4="http://irontemplates.com/marketing/common/videos/video_crowd.mp4" iron_bg_video_webm="http://irontemplates.com/marketing/common/videos/video_crowd.webm" iron_bg_video_poster="324" iron_id="events" css=".vc_custom_1510615270028{padding-top: 50px !important;padding-bottom: 50px !important;}"][vc_column][vc_custom_heading text="UPCOMING SHOWS" font_container="tag:h3|font_size:30px|text_align:center|color:%23497274|line_height:32px" use_theme_fonts="yes" css_animation="fadeInUp" fit_bg_text="0"][vc_custom_heading text="NEXT SHOW" font_container="tag:h2|font_size:76px|text_align:center|color:%23ffffff|line_height:68px" use_theme_fonts="yes" css_animation="fadeInUp" fit_bg_text="1" fit_bg_align="fit_bg_center" css=".vc_custom_1515450874985{margin-top: 50px !important;margin-bottom: 10px !important;padding-top: 6px !important;padding-right: 30px !important;padding-bottom: 8px !important;padding-left: 30px !important;background-color: #497274 !important;}"][iron_countdown end_time="2018-07-31 00:00" show_months="0" show_days="1" show_hours="1" show_minutes="1" show_seconds="1" show_labels="1" numbers_font="font_family:Poppins%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2Cregular%2Citalic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic|font_style:700%20bold%20regular%3A700%3Anormal" labels_font="font_family:Poppins%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2Cregular%2Citalic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic|font_style:300%20light%20regular%3A300%3Anormal" count_color="#ffffff" count_splitter="-" labels_align="center" numbers_font_size="76" numbers_line_height="76" numbers_letter_spacing="1" labels_font_size="14" labels_line_height="18" labels_letter_spacing="0" numbers_margin="10" tablet_numbers_font_size="54" tablet_numbers_line_height="54" tablet_numbers_letter_spacing="1" tablet_labels_font_size="14" tablet_labels_line_height="17" tablet_labels_letter_spacing="0" tablet_numbers_margin="8" mobile_numbers_font_size="36" mobile_numbers_line_height="36" mobile_numbers_letter_spacing="1" mobile_labels_font_size="12" mobile_labels_line_height="14" mobile_labels_letter_spacing="0" mobile_numbers_margin="6" now_time_type="timezone" months_label="Month" days_label="Days" hours_label="Hours" minutes_label="Minutes" seconds_label="Seconds"][vc_empty_space height="80px"][iron_events number="-1" filter="upcoming" events_for="" enable_artists_filter="" css_animation="fadeInUp"][/vc_column][/vc_row][vc_row full_width="stretch_row" iron_row_type="full_width" iron_remove_padding_medium="" iron_remove_padding_small="" iron_overlay_pattern="" iron_parallax="" iron_bg_video="" css=".vc_custom_1510612563130{padding-bottom: 30px !important;background-color: #497274 !important;}"][vc_column][/vc_column][/vc_row][/vc_section]
CONTENT;
	$templates[] = $data;

	//-- 	
	$data = array();
	$data['name'] = esc_html__( 'Tour dates with image background', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/event-list_02.jpg';
	$data['sort_name'] = 'Tour dates';
	$data['custom_class'] = 'events_list';
	$data['content'] = <<<CONTENT
[vc_row full_width="stretch_row" full_height="yes" iron_row_type="full_width" iron_remove_padding_medium="tabletnopadding" iron_remove_padding_small="" iron_overlay_pattern="" iron_parallax="" iron_bg_video="" css=".vc_custom_1515518706221{padding-top: 100px !important;padding-bottom: 100px !important;background-image: url(https://assets.sonaar.io/vc_templates/bg-gray-triangles.jpg) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}" el_class="sonaar-templates-event-list-01"][vc_column][vc_custom_heading text="Upcoming events" font_container="tag:h3|text_align:center" use_theme_fonts="yes" fit_bg_text="0"][vc_custom_heading text="INFINITY &amp; KRONOXX WORLD TOUR" font_container="tag:h2|font_size:40px|text_align:center|line_height:80px" use_theme_fonts="yes" fit_bg_text="0"][vc_row_inner css=".vc_custom_1510070247065{margin-top: 30px !important;}"][vc_column_inner][iron_events filter="upcoming" events_for="" enable_artists_filter="" action_title="+ View all events" action_obj_id="3810"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

	
	/*************
	// NEWSLETTER CATEGORY
  	**************/
	//-- 	
	$data = array();
	$data['name'] = esc_html__( 'Newsletter 01', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/newsletter_01.jpg';
	$data['sort_name'] = 'Newsletter';
	$data['custom_class'] = 'newsletter form';
	$data['content'] = <<<CONTENT
[vc_row full_width="stretch_row" css=".vc_custom_1515524301617{padding-top: 100px !important;padding-bottom: 100px !important;}"][vc_column][vc_custom_heading text="Newsletter" font_container="tag:h3|text_align:center" use_theme_fonts="yes" css_animation="fadeInUp" fit_bg_text="0"][vc_custom_heading text="Grab our Monthly Newsletter and stay tuned" font_container="tag:p|font_size:14px|text_align:center|line_height:12px" use_theme_fonts="yes" css_animation="fadeInDown" fit_bg_text="0" css=".vc_custom_1515524035295{margin-bottom: 35px !important;}"][vc_column_text css_animation="fadeInUp"][mc4wp_form id="1062"][/vc_column_text][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

	//-- 	
	$data = array();
	$data['name'] = esc_html__( 'Newsletter 02', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/newsletter_02.jpg';
	$data['sort_name'] = 'Newsletter';
	$data['custom_class'] = 'newsletter form';
	$data['content'] = <<<CONTENT
[vc_row css=".vc_custom_1515526108750{padding-top: 60px !important;padding-bottom: 60px !important;}"][vc_column][vc_row_inner][vc_column_inner width="1/2" enable_responsive_options="yes" align="text-lg-right text-sm-center" css=".vc_custom_1514999452134{padding-right: 50px !important;}" responsive_css="margin_right_tablet:15|margin_left_tablet:15|margin_right_mobile:15|margin_left_mobile:15"][vc_custom_heading text="Newsletter" font_container="tag:h3|text_align:center" use_theme_fonts="yes" css_animation="fadeInUp" enable_fittext="yes" fit_bg_text="0"][vc_custom_heading text="Grab our Monthly Newsletter and stay tuned" font_container="tag:p|font_size:14px|text_align:center|line_height:12px" use_theme_fonts="yes" css_animation="fadeInDown" fit_bg_text="0" css=".vc_custom_1515525706867{margin-bottom: 35px !important;}"][/vc_column_inner][vc_column_inner width="4/12" enable_responsive_options="yes" align="text-lg-left text-sm-center" css=".vc_custom_1514999458926{padding-left: 50px !important;}" responsive_css="padding_right_tablet:15|padding_left_tablet:15|padding_right_mobile:15|padding_left_mobile:15"][vc_column_text css_animation="fadeInUp"][mc4wp_form id="1062"][/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

	//-- 	
	$data = array();
	$data['name'] = esc_html__( 'Newsletter 03', 'sonaar' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/newsletter_03.jpg';
	$data['sort_name'] = 'Newsletter';
	$data['custom_class'] = 'newsletter form';
	$data['content'] = <<<CONTENT
[vc_row full_width="stretch_row_content" css=".vc_custom_1515526964671{padding-top: 70px !important;padding-bottom: 60px !important;background-image: url(https://assets.sonaar.io/vc_templates/bg-newsletter.jpg) !important;}"][vc_column][vc_row_inner][vc_column_inner width="1/2" enable_responsive_options="yes" align="text-lg-right text-sm-center" css=".vc_custom_1514999452134{padding-right: 50px !important;}" responsive_css="margin_right_tablet:15|margin_left_tablet:15|margin_right_mobile:15|margin_left_mobile:15"][vc_custom_heading text="Newsletter" font_container="tag:h3|text_align:center|color:%23ffffff" use_theme_fonts="yes" css_animation="fadeInUp" enable_fittext="yes" fit_bg_text="0"][vc_custom_heading text="Grab our Monthly Newsletter and stay tuned" font_container="tag:p|font_size:14px|text_align:center|color:%23ffffff|line_height:12px" use_theme_fonts="yes" css_animation="fadeInDown" fit_bg_text="0" css=".vc_custom_1515526949330{margin-bottom: 35px !important;}"][/vc_column_inner][vc_column_inner width="4/12" enable_responsive_options="yes" align="text-lg-left text-sm-center" css=".vc_custom_1514999458926{padding-left: 50px !important;}" responsive_css="padding_right_tablet:15|padding_left_tablet:15|padding_right_mobile:15|padding_left_mobile:15"][vc_column_text css_animation="fadeInUp"][mc4wp_form id="1062"][/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;

	/*************
	// PODCAST CATEGORY
  	**************/
	//-- 	
	$data = array();
	$data['name'] = esc_html__( 'Podcast show header' );
	$data['disabled'] = true; //disable it to not show in the default tab
	$data['image_path'] = IRON_MUSIC_DIR_URL . 'includes/vc-extend/assets/img-templates/podcast_show_header.jpg';
	$data['sort_name'] = 'Podcast';
	$data['custom_class'] = 'podcast';
	$data['content'] = <<<CONTENT
[vc_row enable_responsive_options="yes" css=".vc_custom_1538424862404{padding-top: 50px !important;padding-right: 50px !important;padding-bottom: 50px !important;padding-left: 50px !important;background-color: #ffffff !important;}" responsive_css="padding_top_desktop:15|padding_right_desktop:0|padding_bottom_desktop:0|padding_left_desktop:0|padding_top_tablet:15|padding_right_tablet:0|padding_bottom_tablet:0|padding_left_tablet:0|padding_top_mobile:15|padding_right_mobile:0|padding_bottom_mobile:0|padding_left_mobile:0"][vc_column width="1/3"][vc_single_image source="featured_image" img_size="large" img_fullwidth="0"][/vc_column][vc_column width="2/3"][vc_custom_heading source="post_title" font_container="tag:h1|text_align:left" use_theme_fonts="yes"][vc_row_inner][vc_column_inner][vc_single_image source="external_link" external_img_size="40 x 40" external_style="vc_box_circle" img_fullwidth="0" el_class="host-avatar" custom_src="https://assets.sonaar.io/vc_templates/member-man2.jpg"][vc_custom_heading text="Hosted by Mr. Sonaar" font_container="tag:p|text_align:left" use_theme_fonts="yes" inline_block_display="yes" el_class="host-name"][/vc_column_inner][/vc_row_inner][vc_column_text css=".vc_custom_1538418825886{margin-top: 20px !important;}"]An outstanding fiction podcast series set in a cabine at the end of an unknown valley. Every week, Mr. Sonaar provides gooey tales of horror stories, dark humour, and weirdo sci-fi. So put down your caliber and free up your mind. You won't be disappointed by this weekly show.[/vc_column_text][vc_row_inner css=".vc_custom_1538418659020{margin-top: 30px !important;}"][vc_column_inner][vc_btn title="Website" style="flat" shape="round" color="black" size="sm" i_icon_fontawesome="fa fa-link" add_icon="true" link="url:https%3A%2F%2Fgoogle.com||target:%20_blank|"][vc_btn title="Subscribe" style="flat" shape="round" color="black" size="sm" i_icon_fontawesome="fa fa-podcast" add_icon="true" link="url:%23link-to-your-rss-feed-here||target:%20_blank|"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
CONTENT;
	$templates[] = $data;




	return $templates;
}
