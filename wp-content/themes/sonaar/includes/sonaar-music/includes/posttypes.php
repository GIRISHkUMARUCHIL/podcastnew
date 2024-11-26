<?php

add_action( 'init', 'post_type_init' );
add_action( 'init', 'setup_future_hook' );
add_filter( 'wp_insert_post_data', 'iron_pre_post_update', 10, 2 );
add_filter( 'post_updated_messages', 'events_updated_messages' );
add_filter( 'manage_edit-event_sortable_columns', 'iron_music_manage_event_sortable_columns' );
add_action( 'pre_get_posts', 'iron_music_pre_get_post_types' );
add_filter( 'posts_where', 'iron_events_where' );
add_filter( 'posts_orderby', 'iron_events_orderby' );
add_action( 'manage_event_posts_custom_column', 'iron_manage_event_custom_column', 10, 2 );
add_filter( 'manage_event_posts_columns', 'iron_music_manage_event_columns' );
add_action( 'posts_selection', 'iron_music_posts_selection' );

$iron_features_post_types = array('event', 'album', 'video','artist', 'postcast');
$iron_features_query = new stdClass();

function post_type_init() {

    $default_args = array(
        'public'              => true,
        'show_ui'             => sonaar_Trial(),
		'show_in_nav_menus'   => sonaar_Trial(),
        'has_archive'         => true,
        'query_var'           => true,
        'exclude_from_search' => false

    );
    

    /* Album Post Type (album)
   ========================================================================== */

    $album_args = $default_args;

    $album_args['labels'] = array(
          'name'               => esc_html__('Playlists', 'sonaar')
        , 'singular_name'      => esc_html__('Playlist', 'sonaar')
        , 'name_admin_bar'     => esc_html_x('Playlist', 'add new on admin bar', 'sonaar')
        , 'menu_name'          => esc_html__('Playlist', 'sonaar')
        , 'all_items'          => esc_html__('All Playlists', 'sonaar')
        , 'add_new'            => esc_html__('Add New', 'sonaar')
        , 'add_new_item'       => esc_html__('Add New Playlist', 'sonaar')
        , 'edit_item'          => esc_html__('Edit Playlist', 'sonaar')
        , 'new_item'           => esc_html__('New Playlist', 'sonaar')
        , 'view_item'          => esc_html__('View playlist', 'sonaar')
        , 'search_items'       => esc_html__('Search Playlists', 'sonaar')
        , 'not_found'          => esc_html__('No playlists found.', 'sonaar')
        , 'not_found_in_trash' => esc_html__('No playlists found in the Trash.', 'sonaar')
        , 'parent'             => esc_html__('Parent Playlist:', 'sonaar')
    );

    $album_args['supports'] = array('title','editor','excerpt','thumbnail','custom-fields','revisions', 'author');
    $slugMusic = ( get_ironMusic_option( 'discography_slug_name', '_iron_music_discography_options' ) )? get_ironMusic_option( 'discography_slug_name', '_iron_music_discography_options' ): 'playlist';
    $album_args['rewrite'] = array( 'slug'=>$slugMusic );

    $album_args['menu_icon'] = 'dashicons-media-audio';

    // dont register the menu if playlist is disable from redux option
    $enable_playlist_cpt = Iron_sonaar::getOption('enable-playlist-cpt');
    
    if( $enable_playlist_cpt || $enable_playlist_cpt === NULL)
     register_post_type( 'album' , $album_args); 


    /* Podcast Post Type (podcast)
   ========================================================================== */

   $podcast_args = $default_args;

   $podcast_args['labels'] = array(
         'name'               => esc_html__('Podcasts Episodes', 'sonaar')
       , 'singular_name'      => esc_html__('Podcast', 'sonaar')
       , 'name_admin_bar'     => esc_html_x('Podcast', 'add new on admin bar', 'sonaar')
       , 'menu_name'          => esc_html__('Podcast Episodes', 'sonaar')
       , 'all_items'          => esc_html__('All Episodes', 'sonaar')
       , 'add_new'            => esc_html__('Add New', 'sonaar')
       , 'add_new_item'       => esc_html__('Add New', 'sonaar')
       , 'edit_item'          => esc_html__('Edit Episode', 'sonaar')
       , 'new_item'           => esc_html__('New Episode', 'sonaar')
       , 'view_item'          => esc_html__('View Episode', 'sonaar')
       , 'search_items'       => esc_html__('Search Episode', 'sonaar')
       , 'not_found'          => esc_html__('No episode found.', 'sonaar')
       , 'not_found_in_trash' => esc_html__('No episode found in the Trash.', 'sonaar')
       , 'parent'             => esc_html__('Parent Episode:', 'sonaar')
   );

    $slugPodcast = ( get_ironMusic_option( 'podcast_slug_name', '_iron_music_podcast_player_options' ) )? get_ironMusic_option( 'podcast_slug_name', '_iron_music_podcast_player_options' ): 'podcast';
    $podcast_args['rewrite'] = array( 'slug'=>$slugPodcast );

   $podcast_args['supports'] = array('title','editor','excerpt','thumbnail','custom-fields','revisions','comments','author');

   $podcast_args['menu_icon'] = IRON_MUSIC_DIR_URL . 'images/podcasts.svg';

   $podcast_args['taxonomies'] = array('post_tag');

 
    /* Podcast SHOW Post Type (podcast)
    ========================================================================== */
    $podcastshow_args = $default_args;

       $podcastshow_args['labels'] = array(
             'name'               => esc_html__('Podcast Shows', 'sonaar')
           , 'singular_name'      => esc_html__('Podcast Show', 'sonaar')
           , 'name_admin_bar'     => esc_html_x('Podcast Show', 'add new on admin bar', 'sonaar')
           , 'all_items'          => esc_html__('All Shows', 'sonaar')
           , 'add_new'            => esc_html__('Add New', 'sonaar')
           , 'add_new_item'       => esc_html__('Add New', 'sonaar')
           , 'edit_item'          => esc_html__('Edit Show', 'sonaar')
           , 'new_item'           => esc_html__('New Show', 'sonaar')
           , 'view_item'          => esc_html__('View Show', 'sonaar')
           , 'search_items'       => esc_html__('Search Show', 'sonaar')
           , 'not_found'          => esc_html__('No show found.', 'sonaar')
           , 'not_found_in_trash' => esc_html__('No show found in the Trash.', 'sonaar')
           , 'parent'             => esc_html__('Parent Show:', 'sonaar')
       );
    //$podcastshow_args['show_in_menu'] = false;
    //$podcastshow_args['rewrite'] = array( 'slug' => 'show' );

    $slugPodcastshow = ( get_ironMusic_option( 'podcastshow_slug_name', '_iron_music_podcast_player_options' ) )? get_ironMusic_option( 'podcastshow_slug_name', '_iron_music_podcast_player_options' ): 'show';
    $podcastshow_args['rewrite'] = array( 'slug'=>$slugPodcastshow );
    $podcastshow_args['supports'] = array('title','editor','excerpt','thumbnail','custom-fields','revisions', 'author');
    $podcastshow_args['menu_icon'] = IRON_MUSIC_DIR_URL . 'images/podcasts.svg';

    // $existing_CPT_menu = 'edit.php?post_type=podcast';
    // $link_our_new_CPT = ;
    

    // dont register the menu if podcast is disable from redux option
    $enable_podcast_cpt = Iron_sonaar::getOption('enable-podcast-cpt');

    if( $enable_podcast_cpt || $enable_podcast_cpt === NULL){
    
        register_post_type( 'podcast' , $podcast_args);  
        register_post_type( 'podcastshow' , $podcastshow_args);
        //add_submenu_page('edit.php?post_type=podcast', 'Shows', 'All Shows', 'manage_options', 'edit.php?post_type=podcastshow');

}
  /* Artists Post Type (artist)
   ========================================================================== */

   $artists_args = $default_args;

   $artists_args['labels'] = array(

         'name'               => esc_html__('Artists', 'sonaar')
       , 'singular_name'      => esc_html__('Artist', 'sonaar')
       , 'name_admin_bar'     => esc_html_x('Artist', 'add new on admin bar', 'sonaar')
       , 'menu_name'          => esc_html__('Artists', 'sonaar')
       , 'all_items'          => esc_html__('All Artists', 'sonaar')
       , 'add_new'            => esc_html__('Add New', 'sonaar')
       , 'add_new_item'       => esc_html__('Add New', 'sonaar')
       , 'edit_item'          => esc_html__('Edit Artist', 'sonaar')
       , 'new_item'           => esc_html__('New Project', 'sonaar')
       , 'view_item'          => esc_html__('View Artist', 'sonaar')
       , 'search_items'       => esc_html__('Search Artist', 'sonaar')
       , 'not_found'          => esc_html__('No artists found.', 'sonaar')
       , 'not_found_in_trash' => esc_html__('No artists found in the Trash.', 'sonaar')
       , 'parent'             => esc_html__('Parent Artist:', 'sonaar')
   );

   $artists_args['supports'] = array('title', 'editor', 'revisions','thumbnail','comments', 'author');


   $artists_args['menu_icon'] = 'dashicons-groups';

   $artists_args['rewrite'] = array('slug'=> esc_html__('artist', 'sonaar') );

       // dont register the menu if playlist is disable from redux option
       $enable_playlist_cpt = Iron_sonaar::getOption('enable-playlist-cpt');
       
       if( $enable_playlist_cpt || $enable_playlist_cpt === NULL)
             register_post_type('artist', $artists_args); 
       

    /* Events Post Type (events)
   ========================================================================== */
    $events_args = array(
        'labels'            => array(
            'name'                => esc_html__( 'Events', 'sonaar' ),
            'singular_name'       => esc_html__( 'Events', 'sonaar' ),
            'all_items'           => esc_html__( 'All Events', 'sonaar' ),
            'new_item'            => esc_html__( 'New events', 'sonaar' ),
            'add_new'             => esc_html__( 'Add New', 'sonaar' ),
            'add_new_item'        => esc_html__( 'Add New events', 'sonaar' ),
            'edit_item'           => esc_html__( 'Edit events', 'sonaar' ),
            'view_item'           => esc_html__( 'View events', 'sonaar' ),
            'search_items'        => esc_html__( 'Search events', 'sonaar' ),
            'not_found'           => esc_html__( 'No events found', 'sonaar' ),
            'not_found_in_trash'  => esc_html__( 'No events found in trash', 'sonaar' ),
            'parent_item_colon'   => esc_html__( 'Parent events', 'sonaar' ),
            'menu_name'           => esc_html__( 'Events', 'sonaar' ),
        ),
        'public'            => true,
        'hierarchical'      => false,
        'show_ui'           => sonaar_Trial(),
        'show_in_nav_menus' => sonaar_Trial(),
        'has_archive'       => true,
        'rewrite'           => true,
        'query_var'         => true,
        'menu_icon'         => 'dashicons-calendar-alt',
        'menu_position'     => 25
    );

    $events_args['supports'] = array(
        'title',
        'editor',
        'excerpt',
        'thumbnail',
        'comments',
        'custom-fields',
        'revisions',
        'author'
    );

    $slug = ( get_ironMusic_option( 'events_slug_name', '_iron_music_event_options' ) )? get_ironMusic_option( 'events_slug_name', '_iron_music_event_options' ): 'events' ;

    $events_args['rewrite'] = array( 'slug'=>$slug );

    // dont register the menu if event is disable from redux option
    $enable_event_cpt = Iron_sonaar::getOption('enable-event-cpt');
    
    if( $enable_event_cpt || $enable_event_cpt === NULL)
        register_post_type( 'event',  $events_args );

    /* Video Post Type (video)
   ========================================================================== */

    $video_args = $default_args;

    $video_args['labels'] = array(
          'name'               => esc_html__('Videos', 'sonaar')
        , 'singular_name'      => esc_html__('Video', 'sonaar')
        , 'name_admin_bar'     => esc_html_x('Video', 'add new on admin bar', 'sonaar')
        , 'menu_name'          => esc_html__('Videos', 'sonaar')
        , 'all_items'          => esc_html__('All Videos', 'sonaar')
        , 'add_new'            => esc_html__('Add New', 'sonaar')
        , 'add_new_item'       => esc_html__('Add New Video', 'sonaar')
        , 'edit_item'          => esc_html__('Edit Video', 'sonaar')
        , 'new_item'           => esc_html__('New Video', 'sonaar')
        , 'view_item'          => esc_html__('View Video', 'sonaar')
        , 'search_items'       => esc_html__('Search Video', 'sonaar')
        , 'not_found'          => esc_html__('No videos found.', 'sonaar')
        , 'not_found_in_trash' => esc_html__('No videos found in the Trash.', 'sonaar')
        , 'parent'             => esc_html__('Parent Video:', 'sonaar')
    );

    $video_args['supports'] = array(
          'title'
        , 'editor'
        , 'excerpt'
        , 'thumbnail'
        , 'comments'
        , 'custom-fields'
        , 'revisions'
        , 'author'
    );


    $video_args['menu_icon'] = 'dashicons-format-video';

    $video_args['rewrite'] = array('slug'=> esc_html__('videos', 'sonaar'));
    

    // dont register the menu if video is disable from redux option
    $enable_video_cpt = Iron_sonaar::getOption('enable-video-cpt');
    
    if( $enable_video_cpt || $enable_video_cpt === NULL)
        register_post_type('video', $video_args);


    /* Bloc/Footer Post Type (video)
   ========================================================================== */

    register_post_type( 'block',
        array(
            'labels' => array(
                'name' => __( 'Header & Footers' ),
                'singular_name' => __( 'Header & Footer' )
            ),
            'public'            => true,
            'hierarchical'      => false,
            'show_ui'           => true,
            'show_in_nav_menus' => true,
            'has_archive'       => true,
            'rewrite'           => true,
            'query_var'         => true,
            'rewrite' => array('slug' => 'block'),
            'menu_position'=> 25,
            'menu_icon'=> 'dashicons-layout'
        )
    );

}










function events_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['events'] = array(
		0 => '', // Unused. Messages start at index 1.

		1 => wp_kses(sprintf( __('Events updated. <a target="_blank" href="%s">View events</a>', 'sonaar'), esc_url( $permalink ) ),get_allowed_html()),
		2 => esc_html__('Custom field updated.', 'sonaar'),
		3 => esc_html__('Custom field deleted.', 'sonaar'),
		4 => esc_html__('Events updated.', 'sonaar'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( esc_html__('Events restored to revision from %s', 'sonaar'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => wp_kses(sprintf( __('Events published. <a href="%s">View events</a>', 'sonaar'), esc_url( $permalink ) ),get_allowed_html()),
		7 => esc_html__('Events saved.', 'sonaar'),
		8 => wp_kses(sprintf( __('Events submitted. <a target="_blank" href="%s">Preview events</a>', 'sonaar'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),get_allowed_html()),
		9 => wp_kses(sprintf( __('Events scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview events</a>', 'sonaar'),
		// translators: Publish box date format, see http://php.net/date
		date_i18n( esc_html__( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),get_allowed_html()),
		10 => wp_kses(sprintf( __('Events draft updated. <a target="_blank" href="%s">Preview events</a>', 'sonaar'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),get_allowed_html()),
	);

	return $messages;
}






/*-----------------------------------------------------------------------------------*/
/* Post Type Sorting & Filtering
/*-----------------------------------------------------------------------------------*/

function iron_music_pre_get_post_types ( $query ){
    global $iron_features_post_types, $iron_features_query, $post;

    $post_type = $query->get('post_type');
    $posts_per_page = $query->get('posts_per_page');

    if ( $query->get('taxonomy') == 'events-category') {
        $post_type = 'event';
    }


    if (  !is_admin() ) {
        if ( !isset( $iron_features_query ) ) $iron_features_query = new stdClass();
        $iron_features_query->post_type = $post_type ;


        if ( empty($posts_per_page) || $posts_per_page == 0 ) {
            switch ($post_type) {
                case 'event':
                    $posts_per_page = get_ironMusic_option('events_per_page', '_iron_music_event_options');
                    break;
               /* case 'album':
                    $posts_per_page = get_ironMusic_option('albums_per_page', '_iron_music_discography_options');
                    break;*/

                default:
                    $posts_per_page = get_option('posts_per_page');
                    break;
            }
            
           $query->set( 'posts_per_page',  $posts_per_page);
        }
    }


    if ( (!is_admin() || ( defined('DOING_AJAX') && DOING_AJAX ) ) && ( $post_type == 'event' || $post_type == 'album' ) ) {

        $artists_filter = array();
        if(!empty($post->ID)) {
            $artists_filter = get_post_meta( $post->ID , 'artists_filter', true );
        }
        if(empty($artists_filter)) {
            $artists_filter = $query->get('artists_filter');
        }


        $key = false;
        if($post_type == 'event') {

            $key = 'artist_events';

        }else if($post_type == 'album') {

            $key = 'artist_discography';

        }


        if(!empty($key) && !empty($artists_filter)) {

            $artist_posts = array();
            foreach($artists_filter as $artist) {

                $posts = get_field($key, $artist);

                if ( is_array( $posts ) ) {
                    $artist_posts = array_merge($artist_posts, $posts);
                }
            }

            $query->set('post__in', $artist_posts);


        }

    }


    if ( 'album' == $post_type && !is_admin() ) {

        $query->set( 'posts_per_page', -1 );

    }

    if ( 'event' == $post_type && !is_admin() && !is_preview() ){
        if ( !isset( $iron_features_query ) ) $iron_features_query = new stdClass();
        $iron_features_query->is_main_query = $query->is_main_query();

        $order = $query->get('order');
        $orderby = $query->get('orderby');



        if ( is_admin() && ! $query->get('ajax') ) {

            // Furthest to Oldest
            if ( empty( $order ) )
                $query->set('order', 'ASC');

            if ( empty( $orderby ) )
                $query->set('orderby', 'date');

        } else {

            if(empty($query->query_vars['filter'])) {
                $filter = get_field('events_filter', get_the_id());
                if(empty($filter)) {
                    $filter  = ( empty( $_POST['eventsfilter'] ) ? 'upcoming' : sanitize_key($_POST['eventsfilter']) );
                }

                $query->query_vars['filter'] = $filter;
            }

            $filter = $query->query_vars['filter'];
            $iron_features_query->query_vars['filter'] = $filter;

            // reset Post Status
            if( property_exists($query, 'post_status') && $query['post_status'] != 'draft')
                $query->set('post_status', array('publish'));

        }


    }

}



function iron_events_where ( $where = '' ){
    global $wpdb, $iron_features_query, $wp_query;
    
    if( is_single() && ( isset( $iron_features_query->post_type ) && $iron_features_query->post_type != 'event' ) )
        return $where;

    if( is_single() && ( isset( $iron_features_query->post_type ) && $iron_features_query->post_type == 'event' ) && ( isset( $wp_query->query['post_type'] ) && $wp_query->query['post_type'] == 'event' ) )
        return $where;

    if( is_admin() )
        return $where;

    if( isset( $iron_features_query->post_type ) && $iron_features_query->post_type != 'event' )
        return $where;

    if ( is_single() && ( isset( $iron_features_query->post_type ) && $iron_features_query->is_main_query && $iron_features_query->post_type != 'event' ) && ( $wp_query->query_vars['post_type'] == $iron_features_query->post_type )  )
        return $where;

    if (empty($iron_features_query->query_vars['filter']))
        return $where;


    if( !empty( $wp_query->query ) && ( isset( $wp_query->query['post_type'] ) && $wp_query->query['post_type'] !== 'event' ) && empty($iron_features_query->query_vars['filter']) )
        return $where;

    if ( isset( $iron_features_query->query_vars ) ){

        if( $iron_features_query->query_vars['filter'] == 'past') {
            $where .= " AND ($wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_status != 'future') AND DATE ($wpdb->posts.post_date) < '" . date_i18n('Y-m-d 00:00:00') . "'";

        }else{
            $where .= " AND ($wpdb->posts.post_status = 'publish' OR $wpdb->posts.post_status = 'future') AND DATE ($wpdb->posts.post_date) >= '" . date_i18n('Y-m-d 00:00:00') . "'";
        }
    }
    return $where;
}




function iron_events_orderby($orderby) {
    global $iron_features_query, $wpdb, $wp_query;


    if( is_single() && ( isset( $iron_features_query->post_type ) && $iron_features_query->post_type != 'event' ) )
        return $orderby;

    if (is_admin())
        return $orderby;

    if( isset( $iron_features_query->post_type ) && $iron_features_query->post_type != 'event' )
        return $orderby;

    if (empty($iron_features_query->query_vars['filter']))
        return $orderby;

    if( $iron_features_query->query_vars['filter'] == 'past'){

        $orderby = $wpdb->prefix."posts.post_date DESC";

    }else{

        $orderby = $wpdb->prefix."posts.post_date ASC";

    }

    return $orderby;
}



function iron_music_posts_selection ()
{
    $iron_features_query = (object) array();
}



function setup_future_hook() {
// Replace native future_post function with replacement
    remove_action('future_event','_future_post_hook');
    add_action('future_event','iron_music_publish_future_post_now');
}

function iron_music_publish_future_post_now($id) {
// Set new post's post_status to "publish" rather than "future."
    if(!empty($_POST["post_type"]) && $_POST["post_type"] == "event")
        wp_publish_post($id);
}






/*-----------------------------------------------------------------------------------*/
/* Event Management
/*-----------------------------------------------------------------------------------*/

function iron_music_manage_event_columns ($columns)
{
    unset( $columns['date'] );
    unset( $columns['comments'] );

    $iron_cols = array(
        'event_date'    => esc_html__('Date', 'sonaar'),
        'event_city'    => esc_html__('City', 'sonaar'),
        'event_venue'   => esc_html__('Venue', 'sonaar'),
        'event_artists'   => esc_html__('Artist(s)', 'sonaar'),

    );

    /*if ( function_exists('ironMusic_array_insert') )
        $columns = ironMusic_array_insert($columns, $iron_cols, 'date', 'after');
    else*/
        $columns = array_merge($columns, $iron_cols);


    $columns['title'] = esc_html__('Event', 'sonaar');  // Renamed first column

    return $columns;
}




// Events: Display Custom Columns

function iron_manage_event_custom_column ($column, $post_id)
{
    switch ($column)
    {
        case 'event_date':
            global $mode;

            $post = get_post( $post_id );
            setup_postdata( $post );

            if ( '0000-00-00 00:00:00' == $post->post_date ) {
                $t_time = $h_time = esc_html__('Unpublished', 'sonaar');
            } else {
                $t_time = get_the_time( esc_html__('Y/m/d g:i:s A', 'sonaar') );

                $h_time = date_i18n( get_option('date_format') . ' ' . get_option('time_format'), get_post_time('U', false, $post_id) );
            }

            echo '<abbr title="' . $t_time . '">' . apply_filters( 'post_date_column_time', $h_time, $post, 'event_date', $mode ) . '</abbr>';
        break;

        case 'event_city':
            $post_meta = get_post_meta( $post_id, 'event_city' );
            if ( ! empty( $post_meta ) )
                echo get_post_meta( $post_id, 'event_city', true );
            else
                echo esc_html__('N/A', 'sonaar');


            break;

        case 'event_venue':
            $post_meta = get_post_meta( $post_id, 'event_venue' );
            if ( ! empty( $post_meta ) )
                echo get_post_meta( $post_id, 'event_venue', true);
            else
                echo esc_html__('N/A', 'sonaar');
            break;

        case 'event_artists':
            $post_meta = get_post_meta( $post_id, 'artist_at_event' );

            if ( ! empty( $post_meta[0] ) ){
                foreach ($post_meta[0] as $key => $artist) {
                    $title = ( $key == 0 )? '' : ', ' ;
                    $title .= get_the_title($artist);
                    echo $title;
                }
            }else{
                echo esc_html__('N/A', 'sonaar');
            }
            break;

        default:
            break;

    }
}




// Events: Register Custom Columns as Sortable

function iron_music_manage_event_sortable_columns ($columns)
{
    $columns['event_date']  = 'date';
    // $columns['event_city']  = 'event_city';
    // $columns['event_venue'] = 'event_venue';

    return $columns;
}



/*-----------------------------------------------------------------------------------*/
/* Discography Management
/*-----------------------------------------------------------------------------------*/

// Album: Icon


function iron_music_manage_album_columns ($columns)
{
    $iron_cols = array(
        'alb_tracklist'    => esc_html__('# Tracks', 'sonaar')
        , 'alb_store_list'   => esc_html__('# Stores', 'sonaar')
        , 'icon'   => esc_html__('Featured Image', 'sonaar')
    );

    if ( function_exists('ironMusic_array_insert') )
        $columns = ironMusic_array_insert($columns, $iron_cols, 'date', 'before');
    else
        $columns = array_merge($columns, $iron_cols);


    $iron_cols = array(
        'icon' => ''
    );

    if ( function_exists('ironMusic_array_insert') )
        $columns = ironMusic_array_insert($columns, $iron_cols, 'title', 'before');
    else
        $columns = array_merge($columns, $iron_cols);

    $columns['date'] = esc_html__('Published', 'sonaar');   // Renamed date column

    return $columns;
}



add_filter('manage_album_posts_columns', 'iron_music_manage_album_columns');



// Discography: Display Custom Columns

function iron_music_manage_album_custom_column ($column, $post_id)
{
    switch ($column)
    {

        case 'alb_tracklist':
            if ( $list = get_field('alb_tracklist', $post_id) )
                echo count($list);
            else
                echo esc_html__('N/A', 'sonaar');
            break;

        case 'alb_store_list':
            if ( $list = get_field('alb_store_list', $post_id) )
                echo count($list);
            else
                echo esc_html__('N/A', 'sonaar');
            break;
        case 'icon':
            $att_title = _draft_or_post_title();
?>
                <a href="<?php echo esc_url(get_edit_post_link( $post_id, true )); ?>" title="<?php echo esc_attr( sprintf( esc_html__('Edit &#8220;%s&#8221;', 'sonaar'), $att_title ) ); ?>"><?php

                    if ( $thumb = get_the_post_thumbnail( $post_id, array(75, 75) ) )
                        echo $thumb;
                    else
                        echo '<img width="60" height="75" src="' . wp_mime_type_icon('image/jpeg') . '" alt="">';
                ?></a>
<?php
            break;
    }
}

add_action('manage_album_posts_custom_column', 'iron_music_manage_album_custom_column', 10, 2);

/*-----------------------------------------------------------------------------------*/
/* Artist Management
/*-----------------------------------------------------------------------------------*/

// Album: Icon


function iron_music_manage_artist_columns ($columns)
{
    $iron_cols = array(
        'icon'   => esc_html__('Featured Image', 'sonaar')
    );

    if ( function_exists('ironMusic_array_insert') )
        $columns = ironMusic_array_insert($columns, $iron_cols, 'date', 'before');
    else
        $columns = array_merge($columns, $iron_cols);


    $iron_cols = array(
        'icon' => ''
    );

    if ( function_exists('ironMusic_array_insert') )
        $columns = ironMusic_array_insert($columns, $iron_cols, 'title', 'before');
    else
        $columns = array_merge($columns, $iron_cols);

    $columns['date'] = esc_html__('Published', 'sonaar');   // Renamed date column

    return $columns;
}



add_filter('manage_artist_posts_columns', 'iron_music_manage_artist_columns');



// Podcast: Display Custom Columns

function iron_music_manage_artist_custom_column ($column, $post_id)
{
    switch ($column)
    {
          case 'icon':
            $att_title = _draft_or_post_title();
?>
                <a href="<?php echo esc_url(get_edit_post_link( $post_id, true )); ?>" title="<?php echo esc_attr( sprintf( esc_html__('Edit &#8220;%s&#8221;', 'sonaar'), $att_title ) ); ?>"><?php

                    if ( $thumb = get_the_post_thumbnail( $post_id, array(75, 75) ) )
                        echo $thumb;
                    else
                        echo '<img width="60" height="75" src="' . wp_mime_type_icon('image/jpeg') . '" alt="">';
                ?></a>
<?php
            break;
    }
}

add_action('manage_artist_posts_custom_column', 'iron_music_manage_artist_custom_column', 10, 2);
/*-----------------------------------------------------------------------------------*/
/* Podcast Management
/*-----------------------------------------------------------------------------------*/

// Album: Icon


function iron_music_manage_podcast_columns ($columns)
{
    $iron_cols = array(
        'icon'   => esc_html__('Featured Image', 'sonaar')
    );

    if ( function_exists('ironMusic_array_insert') )
        $columns = ironMusic_array_insert($columns, $iron_cols, 'date', 'before');
    else
        $columns = array_merge($columns, $iron_cols);


    $iron_cols = array(
        'icon' => ''
    );

    if ( function_exists('ironMusic_array_insert') )
        $columns = ironMusic_array_insert($columns, $iron_cols, 'title', 'before');
    else
        $columns = array_merge($columns, $iron_cols);

    $columns['date'] = esc_html__('Published', 'sonaar');   // Renamed date column

    return $columns;
}



add_filter('manage_podcast_posts_columns', 'iron_music_manage_podcast_columns');



// Podcast: Display Custom Columns

function iron_music_manage_podcast_custom_column ($column, $post_id)
{
    switch ($column)
    {

        case 'icon':
            $att_title = _draft_or_post_title();
?>
                <a href="<?php echo esc_url(get_edit_post_link( $post_id, true )); ?>" title="<?php echo esc_attr( sprintf( esc_html__('Edit &#8220;%s&#8221;', 'sonaar'), $att_title ) ); ?>"><?php

                    if ( $thumb = get_the_post_thumbnail( $post_id, array(75, 75) ) )
                        echo $thumb;
                    else
                        echo '<img width="60" height="75" src="' . wp_mime_type_icon('image/jpeg') . '" alt="">';
                ?></a>
<?php
            break;
    }
}

add_action('manage_podcast_posts_custom_column', 'iron_music_manage_podcast_custom_column', 10, 2);

/*-----------------------------------------------------------------------------------*/
/* Video Management
/*-----------------------------------------------------------------------------------*/

function iron_music_manage_video_columns ($columns)
{
    $iron_cols = array(
        'icon' => ''
    );

    if ( function_exists('ironMusic_array_insert') )
        $columns = ironMusic_array_insert($columns, $iron_cols, 'title', 'before');
    else
        $columns = array_merge($columns, $iron_cols);

    $columns['date'] = __('Published', 'sonaar'); // Renamed date column

    return $columns;
}

add_filter('manage_video_posts_columns', 'iron_music_manage_video_columns');


// Videos: Display Custom Columns

function iron_music_manage_video_custom_column ($column, $post_id)
{
    switch ($column)
    {
        case 'icon':
            $att_title = _draft_or_post_title();
?>
                <a href="<?php echo esc_url(get_edit_post_link( $post_id, true )); ?>" title="<?php echo esc_attr( sprintf( __('Edit &#8220;%s&#8221;', 'sonaar'), $att_title ) ); ?>"><?php
                    if ( $thumb = get_the_post_thumbnail( $post_id, array(80, 60) ) )
                        echo $thumb;
                    else
                        echo '<img width="46" height="60" src="' . wp_mime_type_icon('image/jpeg') . '" alt="">';
                ?></a>
<?php
            break;
    }
}

add_action('manage_video_posts_custom_column', 'iron_music_manage_video_custom_column', 10, 2);








/**
 * Custom Taxonomies
 *
 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
 */

$iron_taxonomies = array();

function iron_music_register_taxonomies ()
{
    global $iron_taxonomies;
    $playlist_cat = (!class_exists('Sonaar_Music')) ? 'playlist-category' : 'playlist_cat';
    $iron_taxonomies = array( 'video-category', $playlist_cat, 'artist-category', 'podcast-category');

    $args = array(
          'public'            => true
        , 'show_ui'           => true
        , 'show_in_nav_menus' => true
        , 'show_in_admin_bar' => false
        , 'show_admin_column' => true
        , 'show_tagcloud'     => false
        , 'query_var'         => false
        , 'rewrite'           => true
        , 'hierarchical'      => true
        , 'sort'              => false
    );


/* Video Categories (video-categories)
   ========================================================================== */

    $labels = array(
          'name'          => esc_html_x('Video Categories',     'Taxonomy : name',          'sonaar')
        , 'all_items'     => esc_html_x('All Categories',       'Taxonomy : all_items',     'sonaar')
        , 'singular_name' => esc_html_x('Category',             'Taxonomy : singular_name', 'sonaar')
        , 'add_new_item'  => esc_html_x('Add New Category',     'Taxonomy : add_new_item',  'sonaar')
        , 'not_found'     => esc_html_x('No categories found.', 'Taxonomy : not_found',     'sonaar')
    );

    $args['labels'] = $labels;


    register_taxonomy('video-category', 'video', $args);


/* Discography Categories (discography-categories)
   ========================================================================== */

    $labels = array(
          'name'          => esc_html_x('Playlist Categories', 'Taxonomy : name',          'sonaar')
        , 'all_items'     => esc_html_x('All Categories',       'Taxonomy : all_items',     'sonaar')
        , 'singular_name' => esc_html_x('Category',             'Taxonomy : singular_name', 'sonaar')
        , 'add_new_item'  => esc_html_x('Add New Category',     'Taxonomy : add_new_item',  'sonaar')
        , 'not_found'     => esc_html_x('No categories found.', 'Taxonomy : not_found',     'sonaar')
    );

    $args['labels'] = $labels;
    $args['rewrite'] = array(
        'with_front' => false
    );
    $playlist_cat = (!class_exists('Sonaar_Music')) ? 'playlist-category' : 'playlist_cat';
    register_taxonomy($playlist_cat, 'album', $args);


/* Podcast Categories
========================================================================== */

    $labels = array(
        'name'          => esc_html_x('Podcast Categories', 'Taxonomy : name',          'sonaar')
    , 'all_items'     => esc_html_x('All Categories',       'Taxonomy : all_items',     'sonaar')
    , 'singular_name' => esc_html_x('Category',             'Taxonomy : singular_name', 'sonaar')
    , 'add_new_item'  => esc_html_x('Add New Category',     'Taxonomy : add_new_item',  'sonaar')
    , 'not_found'     => esc_html_x('No Categories found.', 'Taxonomy : not_found',     'sonaar')
    );

    $args['labels'] = $labels;

    $podcast_cat = (!class_exists('Sonaar_Music')) ? 'podcast-category' : 'podcast_cat';
    register_taxonomy($podcast_cat, 'podcast', $args);
    //unregister_taxonomy('podcast-shows');

/* Podcast-Show Categories
========================================================================== */

    $labels = array(
        'name'          => esc_html_x('Show Category', 'Taxonomy : name',          'sonaar')
    , 'all_items'     => esc_html_x('All Categories',       'Taxonomy : all_items',     'sonaar')
    , 'singular_name' => esc_html_x('Category',             'Taxonomy : singular_name', 'sonaar')
    , 'add_new_item'  => esc_html_x('Add New Category',     'Taxonomy : add_new_item',  'sonaar')
    , 'not_found'     => esc_html_x('No Categories found.', 'Taxonomy : not_found',     'sonaar')
    );

    $args['labels'] = $labels;

    register_taxonomy('podcastshow-category', 'podcastshow', $args);
    

/*
    $labels = array(
        'name'          => esc_html_x('Podcast Shows', 'Taxonomy : name',          'sonaar')
    , 'all_items'     => esc_html_x('All Shows',       'Taxonomy : all_items',     'sonaar')
    , 'singular_name' => esc_html_x('Show',             'Taxonomy : singular_name', 'sonaar')
    , 'add_new_item'  => esc_html_x('Add New Show',     'Taxonomy : add_new_item',  'sonaar')
    , 'not_found'     => esc_html_x('No Show found.', 'Taxonomy : not_found',     'sonaar')
    );

    $args['labels'] = $labels;

    register_taxonomy('podcast-shows', 'podcast', $args);
*/
/* Artists Categories (photo-album-categories)
   ========================================================================== */

    $labels = array(
          'name'          => esc_html_x('Artists Categories',   'Taxonomy : name',          'sonaar')
        , 'all_items'     => esc_html_x('All Categories',       'Taxonomy : all_items',     'sonaar')
        , 'singular_name' => esc_html_x('Category',             'Taxonomy : singular_name', 'sonaar')
        , 'add_new_item'  => esc_html_x('Add New Category',     'Taxonomy : add_new_item',  'sonaar')
        , 'not_found'     => esc_html_x('No categories found.', 'Taxonomy : not_found',     'sonaar')
    );

    $args['labels'] = $labels;


    register_taxonomy('artist-category', 'artist', $args);


/* Events Categories (photo-album-categories)
   ========================================================================== */

    $labels = array(
          'name'          => esc_html_x('Events Categories',   'Taxonomy : name',          'sonaar')
        , 'all_items'     => esc_html_x('All Categories',       'Taxonomy : all_items',     'sonaar')
        , 'singular_name' => esc_html_x('Category',             'Taxonomy : singular_name', 'sonaar')
        , 'add_new_item'  => esc_html_x('Add New Category',     'Taxonomy : add_new_item',  'sonaar')
        , 'not_found'     => esc_html_x('No categories found.', 'Taxonomy : not_found',     'sonaar')
    );

    $args['labels'] = $labels;


    register_taxonomy('events-category', 'event', $args);

}

add_action('init', 'iron_music_register_taxonomies');

function iron_music_post_class_terms ( $classes = array() )
{
    global $post, $iron_taxonomies;


    global $post;

    foreach ( $iron_taxonomies as $tax )
    {
        if ( is_object_in_taxonomy( $post->post_type, $tax ) )
        {
            $terms = get_the_terms($post->ID, $tax);

            foreach ( (array) $terms as $term ) {
                if ( empty($term->slug ) )
                    continue;
                $classes[] = sanitize_html_class($tax, 'tax') . '-' . sanitize_html_class($term->slug, $term->term_id);
            }
        }
    }

    return $classes;
}

add_filter('post_class', 'iron_music_post_class_terms');



function iron_pre_post_update( $data, $postarr ){

        if ($data['post_type'] == 'event' && $data['post_status'] == 'future') {
            $data['post_status'] = 'publish';
        }

        if ( $data['post_type'] == 'album' && !empty( $postarr['acf']['field_548d3d6715e41'] ) ) {
            update_post_meta( $postarr['ID'], 'artist_of_album_string', sr_outputPostTitleList($postarr['acf']['field_548d3d6715e41']));
        }


        return $data;
}

if (function_exists('vc_set_default_editor_post_types')) {
   	vc_set_default_editor_post_types(
   		array(
   			'page',
			'event',
			'album',
			'artist',
      'video',
      'podcast',
      'podcastshow',
			'block'
   		)
   	);
}