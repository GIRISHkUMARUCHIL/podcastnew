<?php



/**
* Events Widget Class
*
* @since 1.6.0
* @see   Iron_Widget_Posts
* @todo  - Add advanced options
*        - Merge Videos, and Posts
*/

class Iron_Music_Widget_Events extends Iron_Music_Widget
{
    
    /**
    * Widget Defaults
    */
    
    public static $widget_defaults;
    
    
    /**
    * Register widget with WordPress.
    */
    
    function __construct ()
    {
        $widget_ops = array(
        'classname'   => 'Iron_Music_Widget_Events'
        , 'description' => esc_html_x('List upcoming or past events on your site.', 'Widget', IRON_MUSIC_TEXT_DOMAIN)
        );
        
        self::$widget_defaults = array(
            'title'        => ''
            , 'post_type'    => 'event'
            , 'number'       => get_ironMusic_option('events_per_page', '_iron_music_discography_options')
            , 'filter'		 => 'upcoming'
            , 'artists_filter' => array()
            , 'enable_artists_filter' => false
            , 'action_title' => ''
            , 'action_obj_id'  => ''
            , 'action_ext_link'  => ''
            );
            
            parent::__construct('iron-features-events', IRON_MUSIC_PREFIX . esc_html__('Events', 'Widget', IRON_MUSIC_TEXT_DOMAIN), $widget_ops);
            
            add_action( 'save_post', array($this, 'flush_widget_cache') );
            add_action( 'deleted_post', array($this, 'flush_widget_cache') );
            add_action( 'switch_theme', array($this, 'flush_widget_cache') );
    }
    
    function widget ( $args, $instance )
    {
        global $post;
        
        $cache = wp_cache_get('Iron_Music_Widget_Events', 'widget');
        
        if ( ! is_array($cache) )
            $cache = array();
        
        if ( ! isset( $args['widget_id'] ) )
            $args['widget_id'] = $this->id;
        
        if ( isset( $cache[ $args['widget_id'] ] ) ) {
            echo $cache[ $args['widget_id'] ];
            return;
        }
        
        ob_start();
        $args['before_title'] = "<span class='heading-t3'></span>".$args['before_title'];
        $args['before_title'] = str_replace('h2','h3',$args['before_title']);
        $args['after_title'] = str_replace('h2','h3',$args['after_title']);
        
        /*$args['after_title'] = $args['after_title']."<span class='heading-b3'></span>";*/
        extract($args);
        
        $instance = wp_parse_args( (array) $instance, self::$widget_defaults );

        global $eventListArg;

        $eventListArg = array(
          'hide_time' => ( isset( $instance['hide_time'] ) )?$instance['hide_time']:!get_ironMusic_option('events_show_time', '_iron_music_event_options'),
          'hide_artist' => ( isset( $instance['hide_artist'] ) )?$instance['hide_artist']:!get_ironMusic_option('events_show_artists', '_iron_music_event_options'),
          'hide_venue' => ( isset( $instance['hide_venue'] ) )?$instance['hide_venue']:false,
          'hide_city' => ( isset( $instance['hide_city'] ) )?$instance['hide_city']:false,
          'title_tag' => ( isset( $instance['titletag'] ) )? $instance['titletag']: 'h1'
        );
            
            $title      = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
            $post_type  = apply_filters( 'widget_post_type', $instance['post_type'], $instance, $this->id_base );
            $number     = ( $instance['number'] == '' )? 0 : $instance['number'] ;
            $filter 	= $instance['filter'];
            
            $meta_query = array();
            $artists_filter = $instance['artists_filter'];
            $enable_artists_filter = $instance['enable_artists_filter'];
            if(!empty($artists_filter)) {
              if(!is_array($artists_filter)) {
                $artists_filter = explode(", ", $artists_filter);   
              } 
              $meta_query = array(
                array(
                  'key'     => 'artist_at_event',
                  'value'   => implode('|',$artists_filter),
                  'compare' => 'rlike',
                ),
              );
            }
        
        // $show_date  = $instance['show_date'];
        // $thumbnails = $instance['thumbnails'];
        
        $r = new WP_Query( apply_filters( 'IronFeatures_Widget_Events_args', array(
        'post_type'           => $post_type,
        'filter'      				=> $filter,
        'artists_filter'			=> $artists_filter,
        'posts_per_page'      => -1,
        'no_found_rows'       => true,
        'post_status'         => 'publish',
        'ignore_sticky_posts' => true,
        'meta_query' => $meta_query
        ) ) );
        
        
        
        echo $before_widget;
        
        if ( ! empty( $title ) )
            echo $before_title . $title . $after_title;
        if(!empty($title)){$this->get_title_divider();}
        
        
        if( !empty($enable_artists_filter) ) {
            iron_get_events_filter($artists_filter);
        }
        ?>

  <section id="post-list" class="concerts-list" data-eventnbr="<?php echo $number ?>">

    <?php
        
        $permalink_enabled = (bool) get_option('permalink_structure');
        while ( $r->have_posts() ) :
            $r->the_post();
        $post->filter = $filter;
        get_template_part( 'items/event');
        
        endwhile;
        if(!$r->have_posts()):
        ?>

      <article class="nothing-found">
        <?php
        if($filter == 'upcoming')
          echo translateString('tr_No_upcoming_events_scheduled');
        else
          echo translateString('tr_No_events_scheduled');
        ?>
      </article>

      <?php endif; ?>
  </section>

  <ul class="pagination"></ul>


  <?php
        
        echo $after_widget;
        //echo $action;
        
        // Reset the global $the_post as this query will have stomped on it
        wp_reset_postdata();
        
        
        $cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set('IronFeatures_Widget_Events', $cache, 'widget');
    }
    
    function update ( $new_instance, $old_instance )
    {
        $instance = wp_parse_args( (array) $old_instance, self::$widget_defaults );
            
            $instance['title'] = strip_tags($new_instance['title']);
            $instance['number'] = (int) $new_instance['number'];
            $instance['filter']  = $new_instance['filter'];
            $instance['artists_filter']  = $new_instance['artists_filter'];
            $instance['action_title']  = $new_instance['action_title'];
            $instance['action_obj_id']  = $new_instance['action_obj_id'];
            $instance['action_ext_link']  = $new_instance['action_ext_link'];
            
            $this->flush_widget_cache();
            
            return $instance;
    }
    
    function flush_widget_cache ()
    {
        wp_cache_delete('IronFeatures_Widget_Events', 'widget');
    }
    
    function form ( $instance )
    {
        $instance = wp_parse_args( (array) $instance, self::$widget_defaults );
            
            $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
            $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
            $filter    = $instance['filter'];
            $artists_filter = $instance['artists_filter'];
            $action_title = $instance['action_title'];
            $action_obj_id = $instance['action_obj_id'];
            $action_ext_link = $instance['action_ext_link'];
            ?>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>">
        <?php esc_html_e('Title:', IRON_MUSIC_TEXT_DOMAIN); ?>
      </label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" placeholder="<?php esc_html_e('Upcoming Events', IRON_MUSIC_TEXT_DOMAIN); ?>"
      />
    </p>

    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>">
        <?php esc_html_e('Number of events to show:', IRON_MUSIC_TEXT_DOMAIN); ?>
      </label>
      <input id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" type="text" value="<?php echo esc_attr($number); ?>" size="3" />
    </p>

    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'filter' )); ?>">
        <?php esc_html_e('Filter By:', IRON_MUSIC_TEXT_DOMAIN); ?>
      </label>
      <select class="widefat" id="<?php echo esc_attr($this->get_field_id('filter')); ?>" name="<?php echo esc_attr($this->get_field_name('filter')); ?>">
        <option <?php echo ($filter=='upcoming' ? 'selected' : ''); ?> value="upcoming">
          <?php _ex('Upcoming Events', 'Widget', IRON_MUSIC_TEXT_DOMAIN); ?>
        </option>
        <option <?php echo ($filter=='past' ? 'selected' : ''); ?> value="past">
          <?php _ex('Past Events', 'Widget', IRON_MUSIC_TEXT_DOMAIN); ?>
        </option>
      </select>
      <p>
        <p>
          <label for="<?php echo esc_attr($this->get_field_id( 'artists_filter' )); ?>">
            <?php esc_html_e('Filter By Artists:', IRON_MUSIC_TEXT_DOMAIN); ?>
          </label>
          <select multiple class="widefat" id="<?php echo esc_attr($this->get_field_id('artists_filter')); ?>" name="<?php echo esc_attr($this->get_field_name('artists_filter')); ?>[]">
            <?php echo $this->get_object_options($artists_filter, 'artist'); ?>
          </select>
        </p>
        <p>
          <label for="<?php echo esc_attr($this->get_field_id('action_title')); ?>">
            <?php _ex('Call To Action Title:', 'Widget', IRON_MUSIC_TEXT_DOMAIN); ?>
          </label>
          <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('action_title')); ?>" name="<?php echo esc_attr($this->get_field_name('action_title')); ?>" value="<?php echo esc_attr($action_title); ?>" placeholder="<?php esc_html_e('View More', IRON_MUSIC_TEXT_DOMAIN); ?>"
          />
        </p>
        <p>
          <label for="<?php echo esc_attr($this->get_field_id('action_obj_id')); ?>">
            <?php _ex('Call To Call To Action Page:', 'Widget', IRON_MUSIC_TEXT_DOMAIN); ?>
          </label>
          <select class="widefat" id="<?php echo esc_attr($this->get_field_id('action_obj_id')); ?>" name="<?php echo esc_attr($this->get_field_name('action_obj_id')); ?>">
            <?php echo $this->get_object_options($action_obj_id); ?>
          </select>
        </p>
        <p>
          <label for="<?php echo esc_attr($this->get_field_id('action_ext_link')); ?>">
            <?php _ex('Call To Action External Link:', 'Widget', IRON_MUSIC_TEXT_DOMAIN); ?>
          </label>
          <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('action_ext_link')); ?>" name="<?php echo esc_attr($this->get_field_name('action_ext_link')); ?>" value="<?php echo esc_attr($action_ext_link); ?>" />
        </p>


        <?php
    }
} // class IronFeatures_Widget_Events





/**
* Grid Widget Class
* @since 1.6.0
* @todo  - Add options
*/

class Iron_Music_Widget_Grid extends Iron_Music_Widget
{
    //Widget Defaults
    public static $widget_defaults;
    
    //Register widget with WordPress
    function __construct ()
    {
        $widget_ops = array(
        'classname'   => 'iron_widget_grid',
        'description' => esc_html_x('A grid view of your selected albums.', 'Widget', IRON_MUSIC_TEXT_DOMAIN)
        );
        
        self::$widget_defaults = array(
            'albums'     	 => array(),
            'artists_filter' => array(),
            'column' => 3,
            'parallax' => 0,
            'parallax_speed' => '2,-2,1'
            );
            
            parent::__construct('iron-features-grid', IRON_MUSIC_PREFIX . esc_html_x('Grid', 'Widget', IRON_MUSIC_TEXT_DOMAIN), $widget_ops);
            
    }
    
    //Front-end display of widget
    public function widget ( $args, $instance )
    {
        global $post, $widget;
        extract($args);
        
        $instance = wp_parse_args( (array) $instance, self::$widget_defaults );
            $post_type = ( isset( $instance['grip_post_type'] ) )? $instance['grip_post_type']: 'album';
            $albums = $instance['albums'];
            $column = $instance['column'];
            $parallax_speed = $instance['parallax_speed'];
            $parallax = $instance['parallax'];
            $el_id = ( ! empty( $instance['el_id'] ) )? 'id="' . $instance['el_id'] .'"': 'id="sr_it-grid-' . uniqid() . '"';
            $grid_filter_artists = (isset($instance['grid_filter_artists']))? $instance['grid_filter_artists'] : '' ;
            $artists_filter = $instance['artists_filter'];
            
            if(!is_array($albums)) {
                $albums = explode(",", $albums);
        }
        
        
        
        $meta_query = array();
        if(!empty($grid_filter_artists)) {
            if(!is_array($artists_filter)) {
                $artists_filter = explode(", ", $artists_filter);
                $meta_query =  array(
                array(
                'key'     => 'artist_of_album',
                'value'   => implode('|',$artists_filter),
                'compare' => 'rlike',
                ),
                );
            }
        }
        
        if ( $post_type == 'album' || $post_type == 'sr_playlist' ){
            $query_args = array(
            'post_type'           => $post_type,
            'artists_filter' 	  => $artists_filter,
            'posts_per_page'      => -1,
            'no_found_rows'       => true,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true,
            'post__in' => $albums,
            'meta_query' => $meta_query,
            );
        }else{
            
            if(!is_array($artists_filter))
            $artists_filter = explode(",", $artists_filter);
            
            $query_args = array(
            'post_type'           => $post_type,
            'posts_per_page'      => -1,
            'no_found_rows'       => true,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true,
            'post__in' => $artists_filter,
            'orderby' => 'title',
            'order' => 'asc',
            );
        }
        
        
        $r = new WP_Query( $query_args );
        
        
        if ( $r->have_posts() ) :
            echo $before_widget;
        echo '<section ' . $el_id . 'class="sr_it-grid column-' . $column . '" data-parallax="' . $parallax . '" data-column="' . $column . '" data-parallax-speed="[' . $parallax_speed . ']">';
        
        
        
        
        // Si utilisé dans le single-artist ne pas consideré comme widget
        // pour ne pas afficher les albums ayant l'option
        // "Hide album within the Albums Posts template"
        
        $widget = ( !get_post_type($post) == 'artist' )? true : false ;
        
        while ( $r->have_posts() ) : $r->the_post();
        
        get_template_part( 'items/grid' );
        
        
        endwhile;
        
        echo ( isset( $action ) )? $action :'';
        echo '</section>';
        
        echo $after_widget;
        //echo $action;
        
        // Reset the global $the_post as this query will have stomped on it
        wp_reset_postdata();
        
        endif;
        wp_reset_query();
    }
    
    //Back-end widget form.
    
    public function form ( $instance ){
        $instance = wp_parse_args( (array) $instance, self::$widget_defaults );
            
            $albums = $instance['albums'];
            $artists_filter = $instance['artists_filter'];
            
            
            $all_albums = get_posts(array(
            'post_type' => 'album',
            'posts_per_page' => -1,
            'no_found_rows'  => true
            ));
            
            
            if ( !empty($all_albums) ){
                include IRON_MUSIC_DIR_PATH . 'includes/widget-form/grid.php';
        } else {
            echo wp_kses_post( '<p>'. sprintf( _x('No albums have been created yet. <a href="%s">Create some</a>.', 'Widget', IRON_MUSIC_TEXT_DOMAIN), admin_url('edit.php?post_type=album') ) .'</p>' );
        }
    }
    
    //Sanitize widget form values as they are saved.
    
    public function update ( $new_instance, $old_instance )
    {
        $instance = wp_parse_args( $old_instance, self::$widget_defaults );
            
            $instance['albums'] = $new_instance['albums'];
            $instance['artists_filter'] = $new_instance['artists_filter'];
            
            return $instance;
    }
    
} // class Iron_Widget_Grid



/**
* Podcast Archive Class
*/

//Podcast Archive
class Iron_Widget_Podcast_Archive extends Iron_Music_Widget{
    //Widget Defaults
    public static $widget_defaults;
    
    //Register widget with WordPress
    function __construct (){
        $widget_ops = array(
        'classname'   => 'iron_podcast_archive',
        'description' => esc_html_x('Podcasts Archive', 'Widget', IRON_MUSIC_TEXT_DOMAIN)
        );
        
        self::$widget_defaults = array(
          'category' => 'all'
        );

        parent::__construct('iron-podcast-archive', IRON_MUSIC_PREFIX . esc_html_x('Podcast Archive', 'Widget', IRON_MUSIC_TEXT_DOMAIN), $widget_ops);
    }
    
    //Front-end display of widget
    public function widget ( $args, $instance ){
      global $widget;
      global $podcastArchive;

      $instance = wp_parse_args( (array) $instance, self::$widget_defaults );
      $terms = $instance['category'];
      $maximumEpisodes = (isset($instance['maximum-episodes']))?$instance['maximum-episodes']:-1;
      $NumberOfEpisode = (isset($instance['number-of-episode']) && $instance['number-of-episode'] != '')?$instance['number-of-episode']:get_option('posts_per_page');
      $paginationPrevButtonsText = ( isset( $instance['prev-button-text']) )?$instance['prev-button-text']:'';
      $paginationNextButtonsText= ( isset( $instance['next-button-text']) )?$instance['next-button-text']:'';
      if( (isset($instance['hide-pagination']) && $instance['hide-pagination'] == 1) || $NumberOfEpisode == -1 ){
        $hidePagination = true;
      }else{
        $hidePagination = false;
      }
      $podcastArchive = array(
        'hide-artwork' => ( isset( $instance['hide-artwork'] ) )?$instance['hide-artwork']:Iron_sonaar::getOption('podcast_archive_hide_artwork'),
        'hide-duration' => ( isset( $instance['hide-duration'] ) )?$instance['hide-duration']:false,
        'hide-date' => ( isset( $instance['hide-date'] ) )?$instance['hide-date']:false,
        'hide-category' => ( isset( $instance['hide-category'] ) )?$instance['hide-category']:false,
        'hide-excerpt' => ( isset( $instance['hide-excerpt'] ) )?$instance['hide-excerpt']:false,
        'play-location' => ( isset( $instance['play-location'] ) )?$instance['play-location']:Iron_sonaar::getOption('podcast_archive_play_location'),
        'excerpt-lenght' => ( isset( $instance['excerpt-lenght'] ) )?$instance['excerpt-lenght']:'',
        'strip-html-excerpt' => ( isset( $instance['strip-html-excerpt'] ) )?$instance['strip-html-excerpt']:'',
        'disable-post-link' => ( isset( $instance['disable-post-link'] ) )?$instance['disable-post-link']:false, 
      );
  
        if ( ! isset( $args['widget_id'] ) )
            $args['widget_id'] = 'podcast-archive'.uniqid();

        $query_args = array(
          'post_type' => 'podcast',
          'post_status' => 'publish'
        );
        if($terms != 'all-categories'){
          $terms = explode(", ", $terms); 
          $query_args += ['tax_query' => array(
            array(
              'taxonomy' => 'podcast-category',
              'field'    => 'id',
              'terms'    => $terms
            ),
          )];
        }
        if( !$hidePagination ){
          $query_args += [ 'posts_per_page' => $maximumEpisodes ];
        }elseif($NumberOfEpisode != 'default'){
          $query_args += [ 'posts_per_page' => $NumberOfEpisode ];
        }
        extract($args);

        $r = new WP_Query( $query_args );
        $i= 0;
        if( $r->post_count <= $NumberOfEpisode){
          $hidePagination = true;
        }
        if( !$hidePagination ){
          echo '<div id="episodes-' . uniqid() . '" data-item-per-page="' . $NumberOfEpisode . '" class="sonaar-list table-list-container">';
          //echo '<input class="search" placeholder="Search" />';//Required this input for the SEARCH Feature
          echo '<div class="list">';
        }
        if ( $r->have_posts() ) :
          
          while ( $r->have_posts() ) : $r->the_post();

           if(isset($instance['category-archive']) ){
              $itemCategory = get_the_terms( $r->posts[$i]->ID, 'podcast-category');
              if( is_array($itemCategory) ){
                foreach($itemCategory as $item){
                  if( $item->name == $instance['category-archive'] ){
                    get_template_part( 'items/podcast_list' );
                  }
                }
              }
            }else{
              
              get_template_part( 'items/podcast_list' );
            }
            $i++;
          endwhile;
        endif;
        if( !$hidePagination ){
          echo '</div>'; 
          include( locate_template( 'parts/pagination.php', false, false ) );
          echo '</div>';
        }
        wp_reset_postdata();
    }

} // class Iron_Widget_Podcast_Archive



function ironFeatures_widgets_init(){
    // register_widget( 'Iron_Music_Widget_Events' );
    // register_widget( 'Iron_Music_Widget_Grid' );
    
    $iron_widgets = array(
    'Iron_Widget_Radio',
    'Iron_Widget_Terms',
    'Iron_Widget_Videos',
    'Iron_Music_Widget_Events',
    'Iron_Music_Widget_Grid',
    'Iron_Music_Widget_bandsintown',
    'Iron_Widget_Podcast_Archive',
    );

    foreach($iron_widgets as $widget) {
        register_widget($widget);
    }
}

add_action('widgets_init', 'ironFeatures_widgets_init');



/**
* Custom Widgets
*
* Widgets :
* - Iron_Widget_Radio
* - Iron_Widget_Twitter
* - Iron_Widget_Terms
* - Iron_Widget_Posts
* - Iron_Widget_Videos
* - Iron_Widget_Events
*
* @link http://codex.wordpress.org/Function_Reference/register_widget
*/



/**
* Radio Widget Class
*
* @since 1.6.0
* @todo  - Add options
*/

class Iron_Widget_Radio extends Iron_Music_Widget
{
    /**
    * Widget Defaults
    */
    
    public static $widget_defaults;
    
    
    /**
    * Register widget with WordPress.
    */
    
    function __construct ()
    {
        $widget_ops = array(
        'classname'   => 'iron_widget_radio iron_music_player'
        , 'description' => esc_html_x('A simple radio that plays a list of songs from selected albums.', 'Widget', 'sonaar')
        );
        
        self::$widget_defaults = array(
              'title'        => ''
            , 'albums'     	 => array()
            , 'autoplay'	=> 0
            , 'show_playlist' => 0
            , 'store_title_text' => ''
            , 'action_title' => ''
            , 'action_obj_id'  => ''
            , 'action_ext_link'  => ''
            );
            
            if ( isset($_GET['load']) && $_GET['load'] == 'playlist.json' ) {
                
                add_action('init', array($this, 'print_playlist_json'));
        }
        
        parent::__construct('iron-radio', esc_html_x('sonaar: Radio Player', 'Widget', 'sonaar'), $widget_ops);
        
    }
    
    
    private function get_market( $store_title_text, $album_id = 0){
        if( $album_id == 0 )
        return;
        
        $firstAlbum = explode(',', $album_id);
        $firstAlbum = $firstAlbum[0];

        if ( Iron_sonaar::getField('alb_store_list', $firstAlbum) ){
            $output = '<div class="buttons-block"><div class="ctnButton-block">
            <div class="available-now">'; 
            if($store_title_text == NULL){
              $output .=  translateString('tr_Available_now_on');
            }else{
              $output .=  esc_html__($store_title_text);
            }
            $output .=  '</div><ul class="store-list">';
            while( has_sub_field( 'alb_store_list', $firstAlbum ) ){


                    if(get_sub_field('sr_album_icon_file') && get_sub_field('sr_album_icon_file') != ''){
                        $imageelement = '<span class="sr_svg-box">' . file_get_contents( get_sub_field('sr_album_icon_file') ) . '</span>';
                    }else{
                        $imageelement = ( get_sub_field('album_store_icon') )? '<i class="fa ' . get_sub_field('album_store_icon') . '"></i>': '';
                    }
                 
                $output .= '<li><a class="button" href="' . esc_url( get_sub_field("store_link") ) . '" target="_blank">'. $imageelement . '<span>'. get_sub_field('store_name') . '</span></a></li>';
            }
            $output .= '</ul></div></div>';
            return $output;
        }
        
       
    }

    /**
    * Front-end display of widget.
    */
    public function widget ( $args, $instance )
    {
        
        $instance = wp_parse_args( (array) $instance, self::$widget_defaults );
            $elementor_widget = (bool)( isset( $instance['show_artwork'] ) )? true: false; //Return true if the widget is set in the elementor editor 
            $args['before_title'] = "<span class='heading-t3'></span>".$args['before_title'];
            $args['before_title'] = str_replace('h2','h3',$args['before_title']);
            $args['after_title'] = str_replace('h2','h3',$args['after_title']);    
            $title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
            $play_latest = ( isset( $instance['play-latest'] ) )? $instance['play-latest']: 'no';
            $albums = $instance['albums'];
            $show_album_market = (bool) ( isset( $instance['show_album_market'] ) )? $instance['show_album_market']: 0;
            $show_soundwave = (bool) ( isset( $instance['show_soundwave'] ) )? $instance['show_soundwave']: 0;
            $show_playlist = (bool)$instance['show_playlist'];
            $show_artwork= (bool)( isset( $instance['show_artwork'] ) )? $instance['show_artwork']: true; 
            $store_title_text = $instance['store_title_text'];
            $sr_it_playlist_title_tag = ( isset( $instance['titletag'] ) )? $instance['titletag']: 'h1';
            $sr_podcast_title_tag = ( isset( $instance['titletag'] ) )? $instance['titletag']: 'div';
            $autoplay = (bool)$instance['autoplay'];
            $shuffle = (bool)( isset( $instance['shuffle'] ) )? $instance['shuffle']: false;          
            $action_title = apply_filters( 'iron_widget_action_title', $instance['action_title'], $instance, $this->id_base );
            $action_obj_id = apply_filters( 'iron_widget_action_obj_id', $instance['action_obj_id'], $instance, $this->id_base );
            $action_ext_link = apply_filters( 'iron_widget_action_ext_link', $instance['action_ext_link'], $instance, $this->id_base );
            $store_buttons = array();
            $notrackskip = get_field('no_track_skip', ( is_array($albums) && isset($albums[0]) )?$albums[0]:$albums);//$albums is array in the the single palylist page
            $skin = ( isset( $instance['skin'] ) )? $instance['skin']: 'music';
            $iron_audioplayer_size = '';
            $playlist_col  = '';
            $buttons_col = '';
            $mainplayer_col = '';
            $hide_category = (bool)( isset( $instance['hide_category'] ) )? $instance['hide_category']: null; 
            $hide_duration = (bool)( isset( $instance['hide_duration'] ) )? $instance['hide_duration']: null; 
            $hide_date = (bool)( isset( $instance['hide_date'] ) )? $instance['hide_date']: null; 
            if(! isset($args['widget_id'])){
              $args['widget_id']='iron-audioplayer';
            }

            //Play latest Playlist
            if($play_latest == 'yes' || (is_array($albums) && count($albums) == 0) ){
              switch ($skin) {
                case 'podcast': 
                  $postType = 'podcast';
                  break;
                default:
                  $postType = 'album';
              }
              $latest_args = array(
                'numberposts' => 1,
                'offset' => 0,
                'category' => 0,
                'orderby' => 'post_date',
                'order' => 'DESC',
                'include' => '',
                'exclude' => '',
                'meta_key' => '',
                'meta_value' =>'',
                'post_type' => $postType,
                'post_status' => 'publish',
                'suppress_filters' => true
              );
              $recent_post = wp_get_recent_posts( $latest_args, ARRAY_A );
              if (!empty($recent_post)) {
                $albums = (string)$recent_post[0]['ID'];
                $instance['albums'] = (string)$recent_post[0]['ID'];
              }
            }
          
            if(! empty($instance['backgroundstyle'])) {
              $args['before_widget'] = str_replace('style=""','style="'. $instance['backgroundstyle'].'"',$args['before_widget']);
            }
            /***/
            
            $action = $this->action_link( $action_obj_id, $action_ext_link, $action_title);
            
            $playlist = $this->get_playlist($albums, $title);
            if ( isset($playlist['tracks']) && ! empty($playlist['tracks']) )
                $player_message = esc_html_x('Loading tracks...', 'Widget', 'sonaar');
            else
                $player_message = esc_html_x('No tracks founds...', 'Widget', 'sonaar');
            
            /***/
            
            if ( ! $playlist )
                return;
            
            if($show_playlist) {
              $args['before_widget'] = str_replace("iron_widget_radio", "iron_widget_radio playlist_enabled", $args['before_widget']);
            }
  

        echo $args['before_widget'];
        
        
        if(is_array($albums)) {
            $albums = implode(',', $albums);
        }
        
        $firstAlbum = explode(',', $albums);
        $firstAlbum = $firstAlbum[0];

        $classParent = '';        
        $classShowPlaylist = '';
        $classShowArtwork = '';
        $colShowPlaylist = '';
        $colShowPlaylist2 = '';
        if($show_playlist) {
            $classShowPlaylist = 'show-playlist';
            $colShowPlaylist = 'sonaar-grid sonaar-grid-2';
            $colShowPlaylist2 = 'sonaar-grid sonaar-grid-2'; 
        }
        if(!$show_artwork) {
          $classShowArtwork = 'sonaar-no-artwork';
      }

        /********************
        * Switch de skin class
        *********************/    
        switch ($skin) {
          case 'podcast':
            $classParent = $classShowArtwork;
            $firstAlbum = $instance['albums'];
            $iron_audioplayer = 'artwork-col';
            $artwork_col = '';
            $playlist_col = 'playlist-col';
            $buttons_col = 'buttons-col';
            $mainplayer_col ='main-player-col';
            $track = wp_get_attachment_metadata( Iron_sonaar::getField('track_mp3_podcast', $instance['albums']));
            if( !empty($track) && (isset($track['length_formatted'])) && get_field('FileOrStreamPodCast', $instance['albums']) == 'mp3' ){
              $trackLenght = $track['length_formatted'];
            }else if (get_field('FileOrStreamPodCast', $instance['albums']) == 'stream' ){
              $trackLenght = get_field('podcast_track_length', $instance['albums'] );
            }else{
              $trackLenght = '';
            }
            $hide_date = ($hide_date === null)? get_ironMusic_option('podcast_label_date', '_iron_music_podcast_player_options') : $hide_date;
            $hide_category = ($hide_category === null)? get_ironMusic_option('podcast_label_category', '_iron_music_podcast_player_options'): $hide_category;
            $hide_duration = ($hide_duration === null)? get_ironMusic_option('podcast_label_duration', '_iron_music_podcast_player_options') || $trackLenght =='': $hide_duration;
            $iron_sonaar_term = get_the_terms( $instance['albums'], 'podcast-category');
            $callToAction = get_field('podcast_calltoaction', $instance['albums']);
            break;
            
            
          case 'artist':
          $artwork_col = 'playerNowPlaying';
          $iron_audioplayer = $artwork_col;
            
          break;  


          default:
            $iron_audioplayer = 'sonaar-grid sonaar-grid-2 sonaar-grid-fullwidth-mobile';
            $iron_audioplayer_size = 'audioplayer-size';
            $artwork_col = '';
            $playlist_col = '';
            $buttons_col = '';
            $mainplayer_col ='';
            $hide_date= true;
            $hide_category= true;
            $hide_duration= true;
            break;
        }

        $show_market = ( $show_album_market )? $albums : 0 ;

        $format_playlist ='';
        foreach( $playlist['tracks'] as $track){
            $trackUrl = $track['mp3'] ;
            $showLoading = $track['loading'] ;
            
            $song_store_list = '<span class="store-list">';
            
            if(isset($track['song_store_list']) && !empty($track['song_store_list'])){

              foreach( $track['song_store_list'] as $store ){


                
                $imageelement = '';
                $download = '';
                if( $store['song_store_icon'] == 'custom-icon'){
                    if( isset($store['sr_icon_file']) && $store['sr_icon_file'] !='' ){
                        $imageelement = file_get_contents($store['sr_icon_file']);
                    }
                }else{
                    $imageelement = '<i class="fa ' . $store['song_store_icon'] . '"></i>';
                }
                if ($imageelement != '') {
                  if($store['song_store_icon'] == "fas fa-download"){
                    $download = ' download ';
                  }
                  $song_store_list .= '<a href="' . $store['store_link'] . '"' . $download . ' class="song-store" target="' . $store['store_link_target'] . '" title="' . $store['song_store_name'] . '">' . $imageelement . '</a>';
                }
              }
            }
           
            $song_store_list .= '</span>';


          $track['track_title'] = str_replace('"', '”', $track['track_title']);//Replace the ' " ' to avoid issue with the data-url-trackTitle

            $selected = ( isset($track['selected'] ) && $track['selected'] == true )? 'data-selected="selected"' : '' ;
            $store_buttons = ( !empty($track["track_store"]) )? '<a class="button" target="_blank" href="'. esc_url( $track['track_store'] ) .'">'. esc_textarea( $track['track_buy_label'] ).'</a>' : '' ;
            $format_playlist .= '<li data-audiopath="' . esc_url( $trackUrl ) . '"  '. $selected .' data-showloading="' . $showLoading .'"  data-albumTitle="' . esc_attr( $track['album_title'] ) . '" data-albumArt="' . esc_url( $track['poster'] ) . '"data-trackartists="' . esc_attr( $track['album_artist'] ) . '"data-releasedate="' . esc_attr( $track['release_date'] ) . '" data-trackTitle="' . $track['track_title'] . '">' . $song_store_list . '</li>';
        }
        $class_single = ( isset( $post ) && 'album' != get_post_type( $post->ID ) )? 'vc_col-sm-8 vc_col-sm-offset-2' : '';
        if( isset( $post ) && 'album' == get_post_type( $post->ID ) && 'single_album' == $args["widget_id"] ){
            $colShowPlaylist = 'vc_col-md-5';
            $colShowPlaylist2 = 'vc_col-md-7';
        }



        ?>
        
        <?php //If single playlist post (default template)
        if ('album' == get_post_type( get_the_id() ) && 'single_album' == $args["widget_id"] ): ?>
        <?php $title = get_the_title(get_the_id()); 
        $title = str_replace('&#', '+++', $title);//Remove the '&' to avoid issue with the data-url-playlist
        $title = str_replace('&', '++', $title);//Remove the '&' to avoid issue with the data-url-playlist
        ?>
            <div class="vc_col-sm-10 vc_col-sm-offset-1">
            <div class="iron-audioplayer <?php echo $classShowPlaylist ?>" id="<?php echo esc_attr( $args["widget_id"] ) ?>" data-autoplay="<?php echo esc_attr($autoplay) ?>" data-url-playlist="<?php echo esc_url(home_url('?load=playlist.json&amp;title="'.$title.'"&amp;albums='.$albums.'')) ?>" data-no-track-skip=" <?php echo esc_attr($notrackskip) ?>" >
              <div class="playlist">
                <ul><?php echo $format_playlist ?></ul>
              </div>
              
              <div class="track-title"></div>
              <div class="album-title"></div>
          
              <div class="player">
                <div class="currentTime"></div>
                <div class="progressLoading"></div>
                <div id="<?php echo esc_attr($args["widget_id"])?>-wave" class="wave"></div>
                <div class="totalTime"></div>
                <div class="control">
                  <a class="previous" style="opacity:0;">
                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16" height="18.34" x="0px" y="0px" viewBox="0 0 10.2 11.7" style="enable-background:new 0 0 10.2 11.7;" xml:space="preserve">
                      <polygon points="10.2,0 1.4,5.3 1.4,0 0,0 0,11.7 1.4,11.7 1.4,6.2 10.2,11.7"/>
                    </svg>
                  </a>
                  <a class="play" style="opacity:0;">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="26" height="31.47" x="0px" y="0px" viewBox="0 0 17.5 21.2" style="enable-background:new 0 0 17.5 21.2;" xml:space="preserve">
                      <path d="M0,0l17.5,10.9L0,21.2V0z"/>
            
                      <rect width="6" height="21.2"/>
                      <rect x="11.5" width="6" height="21.2"/>
                    </svg>
                  </a>
                  <a class="next" style="opacity:0;">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16" height="18.34" x="0px" y="0px" viewBox="0 0 10.2 11.7" style="enable-background:new 0 0 10.2 11.7;" xml:space="preserve">
                      <polygon points="0,11.7 8.8,6.4 8.8,11.7 10.2,11.7 10.2,0 8.8,0 8.8,5.6 0,0"/>
                    </svg>
                  </a>
                </div>
              </div>
              
            </div>
            </div>
      <?php else: ?>

      <div class="iron-audioplayer <?php echo $class_single . ' ' . $iron_audioplayer_size . ' ' . $classShowPlaylist . ' ' . $classShowArtwork . ' '. $classParent . ' '; echo ( has_post_thumbnail($firstAlbum) )?'':'no-image  ' ?>" id="<?php echo esc_attr( $args["widget_id"] )?>" data-shuffle="<?php echo esc_attr($shuffle)?>" data-soundwave="<?php echo esc_attr($show_soundwave)?>" data-autoplay="<?php echo esc_attr($autoplay)?>" data-albums="<?php echo $albums ?>" data-url-playlist="<?php echo esc_url(home_url('?load=playlist.json&amp;title='.$title.'&amp;albums='.$albums.''))?>" data-no-track-skip=" <?php echo esc_attr($notrackskip) ?>" >
            <div class="<?php echo $iron_audioplayer ?>">


              <?php if($show_artwork): ?>
              <div class="sonaar-Artwort-box">
                <div class="album">
                  <div class="album-art"><img src="<?php echo get_template_directory_uri() ?>/images/defaultpx.png" alt="album-art"></div>
                  <div class="metadata">
                    <div class="track-name"></div>
                    <div class="album-title"></div>
                </div>
                </div>
              </div>
              <?php endif ?>

              <div class="<?php echo $playlist_col ?>">
                <div class="playlist">

                <?php if (empty($sr_it_playlist_title_tag)) : $sr_it_playlist_title_tag = "h1";?> <?php endif ?>
                <?php if($skin != 'podcast'): ?>
                <<?php echo $sr_it_playlist_title_tag ?> class="sr_it-playlist-title"> <?php echo get_the_title($firstAlbum) ?> </<?php echo $sr_it_playlist_title_tag ?>> 
                <?php endif ?>  
                <?php if ( get_artists($firstAlbum) )://If Playlist has related artist?>
                  <?php 
                    //Display Artist name if the "the options Hide Artist Name" is unchecked 
                    //Or display it if the widget is a Music Player from the elementor editor.
                    if ( ! get_ironMusic_option('continuous_music_player_label_artist', '_iron_music_music_player_options') || ($skin == 'music' && $elementor_widget) ):
                    ?> 
                  <div class="sr_it-playlist-artists"><?php echo translateString('tr_by')?> 
                    <span class="sr_it-artists-value"><?php echo get_artists($firstAlbum) ?></span>
                  </div>
                  <?php endif ?>
                  <?php endif ?>
                  <?php if( (get_field('alb_release_date', $firstAlbum))):?>
                  <div class="sr_it-playlist-release-date"><?php echo translateString('tr_Release_date') ?>
                    <span class="sr_it-date-value"><?php echo get_field('alb_release_date', $firstAlbum)?></span>
                  </div>
                  <?php endif ?>
                  <ul><?php echo $format_playlist ?></ul>
                </div>
              </div>
            </div>
            
            <div class="<?php echo $buttons_col ?>"><?php echo $this->get_market( $store_title_text, $show_market ) ?></div>
            <div class="<?php echo $mainplayer_col ?>">
            <<?php echo $sr_podcast_title_tag ?> class="track-title text-center"></<?php echo $sr_podcast_title_tag ?>> 
              <?php if( $skin == 'music' ):  ?>
              <div class="album-title"></div>
              <?php endif ?>
              <div class="player">
                <div class="currentTime"></div>
                <div id="<?php echo esc_attr($args["widget_id"]) ?>-wave" class="wave"></div>
                <div class="totalTime"></div>

                <?php if($skin != 'podcast'): ?>
                <div class="control">
                  <?php if( $skin == 'music' || $args["widget_id"] == 'single_album_thumb' || $skin == 'artist'):  ?>
                  <a class="previous" style="opacity:0;">
                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16" height="18.33" x="0px" y="0px" viewBox="0 0 10.2 11.7" style="enable-background:new 0 0 10.2 11.7;" xml:space="preserve">
                      <polygon points="10.2,0 1.4,5.3 1.4,0 0,0 0,11.7 1.4,11.7 1.4,6.2 10.2,11.7"/>
                    </svg>
                  </a>
                  <?php endif ?>
                  <a class="play" style="opacity:0;">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="26" height="31.47" x="0px" y="0px" viewBox="0 0 17.5 21.2" style="enable-background:new 0 0 17.5 21.2;" xml:space="preserve">
                      <path d="M0,0l17.5,10.9L0,21.2V0z"/> 
                      <rect width="6" height="21.2"/>
                      <rect x="11.5" width="6" height="21.2"/>
                    </svg>
                  </a>
                  <?php if( $skin == 'music' || $args["widget_id"] == 'single_album_thumb' || $skin == 'artist'):  ?>
                  <a class="next" style="opacity:0;">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16" height="18.33" x="0px" y="0px" viewBox="0 0 10.2 11.7" style="enable-background:new 0 0 10.2 11.7;" xml:space="preserve">
                      <polygon points="0,11.7 8.8,6.4 8.8,11.7 10.2,11.7 10.2,0 8.8,0 8.8,5.6 0,0"/>
                    </svg>
                  </a>
                  <?php endif ?>
                </div>
                <?php endif ?>
                
              </div>


              <?php if( $skin == 'podcast'):  ?>
              <div class="sonaar-podcast-player-bottom">
                <?php if( !$hide_date || !$hide_category || !$hide_duration ):  ?>
                <div class="meta-podcast">
                  <?php if(!$hide_date):?>
                  <div class="sonaar-date"><?php echo get_the_date( '', $instance['albums'] ); ?></div>
                  <?php endif ?>

                  <?php if( $iron_sonaar_term != NULL && !$hide_category):?>
                  <div class="sonaar-category">
                    <?php foreach ($iron_sonaar_term as $key => $value): ?>
                    <a href="<?php echo get_term_link( $value->term_id, 'podcast-category') ?>">
                      <?php echo wp_kses_post( (  $key + 1 == count( $iron_sonaar_term) )? $value->name  : $value->name . ', ' ); ?> 
                    </a>
                    <?php endforeach ?>
                  </div>
                  <?php endif ?>

                  <?php if(!$hide_duration):?>
                  <div class="sonaar-duration"><?php echo  $trackLenght;  ?></div>
                  <?php endif ?>

                </div>
                <?php endif ?>
          
                <?php if($callToAction && is_array($callToAction)): ?>
                <?php foreach($callToAction as $button): ?>
                <a href="<?php echo $button['podcast_button_link'] ?>" class="sonaar-callToAction" <?php echo esc_html($button['podcast_button_target'])?'target="_blank"':''?> ><?php echo $button['podcast_button_name'] ?></a>
                <?php endforeach ?>
                <?php endif ?>
              
              </div>
              <?php endif ?>

            </div>
          
            <?php //podcast player only 
            if($skin == 'podcast'): ?>
            <div class="sonaar-play-button-box">
              <button class="sonaar-play-button play" href="#">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18" height="18" x="0px" y="0px" viewBox="0 0 17.5 21.2" xml:space="preserve" class="sonaar-play-icon">
                  <path d="M0,0l17.5,10.9L0,21.2V0z"></path> 
                  <rect width="6" height="21.2"></rect>
                  <rect x="11.5" width="6" height="21.2"></rect>
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" class="sonaar-play-circle" width="79.19" height="79.19">
                  <circle r="40%" fill="none" stroke="black" stroke-width="6" cx="50%" cy="50%"></circle>
                </svg>
              </button>
            </div>
            <?php endif ?>

          </div>

           
          <?php endif ?>





        <?php
        echo $action;
        echo $args['after_widget'];
    }
    
    /**
    * Back-end widget form.
    */
    
    public function form ( $instance )
    {
        $instance = wp_parse_args( (array) $instance, self::$widget_defaults );
            
            $title = esc_attr( $instance['title'] );
            $albums = $instance['albums'];
            $show_playlist = (bool)$instance['show_playlist'];
            $autoplay = (bool)$instance['autoplay'];
            $action_title = $instance['action_title'];
            $action_obj_id = $instance['action_obj_id'];
            $action_ext_link = $instance['action_ext_link'];
            
            $all_albums = get_posts(array(
            'post_type' => 'album'
            , 'posts_per_page' => -1
            , 'no_found_rows'  => true
            ));
            
            if ( !empty( $all_albums ) ) :?>

          <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">
              <?php _ex('Title:', 'Widget', 'sonaar'); ?>
            </label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" placeholder="<?php _e('Popular Songs', 'sonaar'); ?>" />
          </p>
          <p>
            <label for="<?php echo $this->get_field_id('albums'); ?>">
              <?php _ex('Album:', 'Widget', 'sonaar'); ?>
            </label>
            <select class="widefat" id="<?php echo $this->get_field_id('albums'); ?>" name="<?php echo $this->get_field_name('albums'); ?>[]" multiple="multiple">
              <?php foreach($all_albums as $a): ?>

                <option value="<?php echo $a->ID; ?>" <?php echo (in_array($a->ID, $albums) ? ' selected="selected"' : ''); ?>>
                  <?php echo esc_attr($a->post_title); ?>
                </option>

                <?php endforeach; ?>
            </select>
          </p>

          <p>
            <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('autoplay'); ?>" name="<?php echo $this->get_field_name('autoplay'); ?>" <?php checked( $autoplay ); ?> />
            <label for="<?php echo $this->get_field_id('autoplay'); ?>">
              <?php _e( 'Auto Play' ); ?>
            </label>
            <br />
          </p>

          <p>
            <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('show_playlist'); ?>" name="<?php echo $this->get_field_name('show_playlist'); ?>" <?php checked( $show_playlist ); ?> />
            <label for="<?php echo $this->get_field_id('show_playlist'); ?>">
              <?php _e( 'Show Playlist' ); ?>
            </label>
            <br />
          </p>
          <p>
            <label for="<?php echo $this->get_field_id('action_title'); ?>">
              <?php _ex('Call To Action Title:', 'Widget', 'sonaar'); ?>
            </label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('action_title'); ?>" name="<?php echo $this->get_field_name('action_title'); ?>" value="<?php echo $action_title; ?>" placeholder="<?php _e('View More', 'sonaar'); ?>" />
          </p>
          <p>
            <label for="<?php echo $this->get_field_id('action_obj_id'); ?>">
              <?php _ex('Call To Call To Action Page:', 'Widget', 'sonaar'); ?>
            </label>
            <select class="widefat" id="<?php echo $this->get_field_id('action_obj_id'); ?>" name="<?php echo $this->get_field_name('action_obj_id'); ?>">
              <?php echo $this->get_object_options($action_obj_id); ?>
            </select>
          </p>
          <p>
            <label for="<?php echo $this->get_field_id('action_ext_link'); ?>">
              <?php _ex('Call To Action External Link:', 'Widget', 'sonaar'); ?>
            </label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('action_ext_link'); ?>" name="<?php echo $this->get_field_name('action_ext_link'); ?>" value="<?php echo $action_ext_link; ?>" />
          </p>

          <?php
            else:
                
            echo wp_kses_post( '<p>'. sprintf( _x('No albums have been created yet. <a href="%s">Create some</a>.', 'Widget', 'sonaar'), esc_url(admin_url('edit.php?post_type=album')) ) .'</p>' );
            
            endif;
    }


    /**
    * Sanitize widget form values as they are saved.
    */
    
    public function update ( $new_instance, $old_instance )
    {
        $instance = wp_parse_args( $old_instance, self::$widget_defaults );
            
            $instance['title'] = strip_tags( stripslashes($new_instance['title']) );
            $instance['albums'] = $new_instance['albums'];
            $instance['show_playlist']  = (bool)$new_instance['show_playlist'];
            $instance['autoplay']  = (bool)$new_instance['autoplay'];
            $instance['action_title']  = $new_instance['action_title'];
            $instance['action_obj_id']  = $new_instance['action_obj_id'];
            $instance['action_ext_link']  = $new_instance['action_ext_link'];
            
            return $instance;
    }
    
    /** 
    * output playlist.json
    */
    function print_playlist_json() {
        // header('Content-Type: application/json');
        $jsonData = array();
        
        $title = !empty($_GET["title"]) ? $_GET["title"] : null;
        $albums = !empty($_GET["albums"]) ? $_GET["albums"] : array();
        
        $playlist = $this->get_playlist($albums, $title);
        
        if(!is_array($playlist) || empty($playlist['tracks']))
        return;
        
        wp_send_json($playlist);
        
    }
    
    function get_playlist($album_ids = array(), $title = null) {
        
        global $post;
        
        $playlist = array();
        if(!is_array($album_ids)) {
            $album_ids = explode(",", $album_ids);
        }

        $playlist_type = 'album';

        $args = array(
        'post_type' => array('album'),
        'post_status'=> 'publish',
        'post__in' => $album_ids,
        'posts_per_page' => -1
        );

        $get_term = array();
        if (!empty($album_ids)) {
          if( get_post_type( $album_ids[0] ) == 'podcast' ){
            $playlist_type = 'podcast';
            
            $args =  array(
              'post_status'=> 'publish',
              'order' => 'DESC',
              'orderby' => 'date',
              'post_type'=> 'podcast',
              'posts_per_page' => -1
            );

            $get_term = get_the_terms( $album_ids[0], 'podcast-category');
            $terms = array();
            
            if($get_term){
              foreach ($get_term as $value) {
                array_push($terms, $value->slug);
              }
              $args['tax_query'] = array(
                array(
                  'taxonomy' => 'podcast-category',
                  'field'    => 'slug',
                  'terms'    => $terms
                )
              );
            }else{
              $args['post__in'] = $album_ids;
            }
            

          }
        }
        $albums = get_posts($args);
        

        
        $tracks = array();
        


        foreach($albums as $key => $a) {
          $album_tracks =  get_field('alb_tracklist', $a->ID );
          
          if ( $playlist_type == 'podcast' ){

            $fileOrStream =  get_field('FileOrStreamPodCast', $a->ID);
            $podcastCallToAction =  get_field('podcast_calltoaction', $a->ID);
            $thumb_id = get_post_thumbnail_id($a->ID);
            $thumb_url = wp_get_attachment_image_src($thumb_id, 'medium', true);
            
            $track_title = false;
            $album_title = false;
            $album_artist = false;
            $mp3_id = false;
            $audioSrc = '';
            $song_store_list = false;
            $showLoading = false;
            $album_tracks_lenght = false;

            


            switch ($fileOrStream) {
                case 'mp3':
                    if ( get_field('track_mp3_podcast', $a->ID) ) {
                        $mp3_id = get_field('track_mp3_podcast', $a);
                        $mp3_metadata = wp_get_attachment_metadata( $mp3_id );
                        $album_artist = ( isset( $mp3_metadata['artist'] ) && $mp3_metadata['artist'] !== '' )? $mp3_metadata['artist'] : false;
                        $album_tracks_lenght = ( isset( $mp3_metadata['length_formatted'] ) && $mp3_metadata['length_formatted'] !== '' )? $mp3_metadata['length_formatted'] : false;
                        $audioSrc = wp_get_attachment_url($mp3_id['ID']);
                        $audioSrc = str_replace("https:", "",$audioSrc);
                        $audioSrc = str_replace("http:", "",$audioSrc);
                        $showLoading = true;
                    }
                    break;

                case 'stream':
                    $audioSrc = ( get_field('stream_link', $a->ID) !== '' )? get_field('stream_link', $a->ID) : false;
                    $album_tracks_lenght = ( get_field('podcast_track_length', $a->ID) !== '' )? get_field('podcast_track_length', $a->ID) : false;           
                    break;
            
                default:
                    $album_tracks[0] = array();
                    break;
            }
    
            $album_tracks = array();
            $album_tracks[$key]["id"] = $a->ID ;
            $album_tracks[$key]["mp3"] = $audioSrc;
            $album_tracks[$key]["loading"] = true;
            $album_tracks[$key]["track_title"] = $a->post_title;
            $album_tracks[$key]["lenght"] = $album_tracks_lenght;
            $album_tracks[$key]["album_title"] = ( $get_term )? html_entity_decode( $get_term[0]->name ) : false;
            $album_tracks[$key]["album_artist"] = ( $album_artist )? $album_artist : false;
            $album_tracks[$key]["no_track_skip"] = get_field('no_track_skip',  $a->ID);
            $album_tracks[$key]["poster"] = $thumb_url[0];
            $album_tracks[$key]["release_date"] = get_the_date('', $a->ID);
            $album_tracks[$key]["song_store_list"] = $song_store_list;
            $album_tracks[$key]["podcast_calltoaction"] = $podcastCallToAction;
            $album_tracks[$key]["selected"] = ( $a->ID == $album_ids[0] )? true : false;

          }else{ //Playlist CPT (not podcast CPT)

            if ( get_field('reverse_tracklist', $a->ID) ){ 
              $album_tracks = array_reverse($album_tracks); //reverse tracklist order option
            }

            if ($album_tracks) {
                    for($i = 0 ; $i < count($album_tracks) ; $i++) {
                      
                      $fileOrStream =  $album_tracks[$i]['FileOrStream'];
                      $thumb_id = get_post_thumbnail_id($a->ID);
                      $thumb_url = wp_get_attachment_image_src($thumb_id, 'medium', true);
                      
                      $track_title = false;
                      $album_title = false;
                      $album_artist = false;
                      $mp3_id = false;
                      $audioSrc = '';
                      $song_store_list = $album_tracks[$i]["song_store_list"];
                      $showLoading = false;
                      $album_tracks_lenght = false;
                      
                      switch ($fileOrStream) {
                          case 'mp3':
                              
                              if ( isset( $album_tracks[$i]["track_mp3"] ) ) {
                                  $mp3_id = $album_tracks[$i]["track_mp3"]["id"];
                                  $mp3_metadata = wp_get_attachment_metadata( $mp3_id );
                                  $track_title = ( isset( $album_tracks[$i]["track_mp3"]["title"] ) && $album_tracks[$i]["track_mp3"]["title"] !== '' )? $album_tracks[$i]["track_mp3"]["title"] : false ;
                                  $album_title = ( isset( $mp3_metadata['album'] ) && $mp3_metadata['album'] !== '' )? $mp3_metadata['album'] : false;
                                  $album_artist = ( isset( $mp3_metadata['artist'] ) && $mp3_metadata['artist'] !== '' )? $mp3_metadata['artist'] : false;
                                  $album_tracks_lenght = ( isset( $mp3_metadata['length_formatted'] ) && $mp3_metadata['length_formatted'] !== '' )? $mp3_metadata['length_formatted'] : false;
                                  $audioSrc = str_replace("https:", "",$audioSrc);
                                  $audioSrc = str_replace("http:", "",$audioSrc);
                                  $audioSrc = wp_get_attachment_url($mp3_id);
                                  $showLoading = true;
                          }
                          
                          break;
                      case 'stream':
                          
                          $audioSrc = ( $album_tracks[$i]["stream_link"] !== '' )? $album_tracks[$i]["stream_link"] : false;
                          $track_title = ( $album_tracks[$i]["stream_title"] !== '' )? $album_tracks[$i]["stream_title"] : false;
                          $album_artist = ( $album_tracks[$i]["stream_artist"] !== '' )? $album_tracks[$i]["stream_artist"] : false;
                          $album_title = ( $album_tracks[$i]["stream_album"] !== '' )? $album_tracks[$i]["stream_album"] : false;
                          break;
                      
                      default:
                          $album_tracks[$i] = array();
                          break;
                      }
              
                      // if ( $mp3_metadata ) {
                      // 	$album_tracks[$i]["mp3_metadata"] = $mp3_metadata;
                      
                      // }

                      $album_tracks[$i] = array();
                      $album_tracks[$i]["id"] = ( $mp3_id )? $mp3_id : $i ;
                      $album_tracks[$i]["mp3"] = $audioSrc;
                      $album_tracks[$i]["loading"] = $showLoading;
                      $album_tracks[$i]["track_title"] = ( $track_title )? $track_title : "Track title ". $i;
                      $album_tracks[$i]["lenght"] = $album_tracks_lenght;
                      $album_tracks[$i]["album_title"] = ( $album_title )? $album_title : $a->post_title;
                      $album_tracks[$i]["album_artist"] = ( $album_artist )? $album_artist : get_artists($a->ID);
                      $album_tracks[$i]["poster"] = $thumb_url[0];
                      $album_tracks[$i]["release_date"] = get_field('alb_release_date', $a->ID);
                      $album_tracks[$i]["song_store_list"] = $song_store_list;
                      $album_tracks[$i]["no_track_skip"] = get_field('no_track_skip', $a->ID);
                    }
            }
        }
            if ($album_tracks) {
                $tracks = array_merge($tracks, $album_tracks);
            }
    }

    $playlist['playlist_name'] = $title;
    $playlist['type'] = $playlist_type;

    if ( empty($playlist['playlist_name']) ) $playlist['playlist_name'] = "";
    $playlist['tracks'] = $tracks;

    if ( empty($playlist['tracks']) ) $playlist['tracks'] = array();
    return $playlist;
    }


} // class Iron_Widget_Radio




/**
* Terms Widget Class
*
* @since 1.6.0
*/
class Iron_Widget_Terms extends Iron_Music_Widget
{
    /**
    * Widget Defaults
    */
    
    public static $widget_defaults;
    
    
    /**
    * Register widget with WordPress.
    */
    
    function __construct ()
    {
        $widget_ops = array(
        'classname'   => 'iron_widget_terms'
        , 'description' => esc_html_x('A list or dropdown of terms', 'Widget', 'sonaar')
        );
        
        self::$widget_defaults = array(
            'title'        => ''
            , 'taxonomy'     => 'category'
            , 'count'        => 0
            , 'hierarchical' => 0
            , 'dropdown'     => 0
            );
            
            parent::__construct('iron-terms', esc_html__('sonaar: Terms', 'sonaar'), $widget_ops);
    }
    
    function widget ( $args, $instance )
    {
        $instance = wp_parse_args( (array) $instance, self::$widget_defaults );
            $args['before_title'] = "<span class='heading-t3'></span>".$args['before_title'];
            $args['before_title'] = str_replace('h2','h3',$args['before_title']);
            $args['after_title'] = str_replace('h2','h3',$args['after_title']);
            /*$args['after_title'] = $args['after_title']."<span class='heading-b3'></span>";*/
            extract( $args );
            
            $title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
            $taxonomy = $instance['taxonomy'];
            $c = $instance['count'];
            $h = $instance['hierarchical'];
            $d = $instance['dropdown'];
            
            echo $before_widget;
            if ( $title )
                echo sprintf( $before_title, '' ) . $title . $after_title;
        if(!empty($title)){$this->get_title_divider();}
        
        $term_args = array(
        'taxonomy'           => $taxonomy
        , 'orderby'            => 'name'
        , 'order'              => 'ASC'
        , 'hide_empty'         => 1
        , 'show_count'         => $c
        , 'hierarchical'       => $h
        , 'title_li'           => false
        , 'depth'              => 0
        , 'style'              => 'list'
        , 'orderby'            => 'name'
        , 'use_desc_for_title' => 1
        , 'child_of'           => 0
        , 'exclude'            => ''
        , 'exclude_tree'       => ''
        , 'current_category'   => 0
        );
        
        $terms = get_terms( $taxonomy, array( 'orderby' => 'name', 'hierarchical' => $h ) );
        
        if ( $d ) :
            $term_args['show_option_none'] = esc_html__('Select Term', 'sonaar');
        
        ?>
            <select id="tax-<?php echo esc_attr($taxonomy); ?>" class="terms-dropdown" name="<?php echo esc_attr($this->get_field_name('taxonomy')); ?>">
              <option>
                <?php echo esc_attr($term_args['show_option_none']); ?>
              </option>
              <?php
        foreach ( $terms as $term ) {
            echo '<option value="' . esc_attr($term->term_id) . '">'. esc_attr($term->name) . ( $c ? ' (' . $term->count . ')' : '' ) . '</option>';
        }
        ?>
            </select>

            <script>
              /* <![CDATA[ */
              var dropdown = document.getElementById('tax-<?php echo esc_attr($taxonomy); ?>');

              function onCatChange() {
                if (dropdown.options[dropdown.selectedIndex].value > 0) {
                  location.href = "<?php echo home_url('/'); ?>/?taxonomy=<?php echo esc_url($taxonomy); ?>&term=" + dropdown.options[dropdown.selectedIndex].value;
                }
              }
              dropdown.onchange = onCatChange;
              /* ]]> */
            </script>

            <?php
        else :
            $taxonomy_object = get_taxonomy( $taxonomy );
        
        $term_args['show_option_all'] = $taxonomy_object->labels->all_items;
        
        $posts_page = ( 'page' == get_option('show_on_front') && get_option('page_for_posts') ) ? get_permalink( get_option('page_for_posts') ) : sonaar_music_get_option('page_for_' . $taxonomy_object->object_type[0] . 's');
        $posts_page = esc_url( $posts_page );
        ?>
              <ul class="terms-list">
                <li><a href="<?php echo esc_url($posts_page); ?>"><i class="fa-solid fa-plus"></i> <?php echo esc_html($term_args['show_option_all']); ?></a></li>
                <?php
        
        foreach ( $terms as $term ) {
            echo '<li><a href="' . esc_url(get_term_link( $term, $taxonomy )) . '"><i class="fa-solid fa-plus"></i> ' . $term->name . ( $c ? ' <small>(' . $term->count . ')</small>' : '' ) . '</a></li>';
        }
        ?>
              </ul>
              <?php
        endif;
        
        echo $after_widget;
        echo ( isset( $action ) )? esc_attr( $action ) : '';
    }
    
    function update ( $new_instance, $old_instance )
    {
        $instance = wp_parse_args( $old_instance, self::$widget_defaults );
            
            $instance['title'] = strip_tags($new_instance['title']);
            $instance['taxonomy'] = stripslashes($new_instance['taxonomy']);
            $instance['count'] = !empty($new_instance['count']) ? 1 : 0;
            // $instance['hierarchical'] = !empty($new_instance['hierarchical']) ? 1 : 0;
            $instance['dropdown'] = !empty($new_instance['dropdown']) ? 1 : 0;
            
            return $instance;
    }
    
    function form ( $instance )
    {
        $instance = wp_parse_args( (array) $instance, self::$widget_defaults );
            
            $title = esc_attr( $instance['title'] );
            $count = (bool) $instance['count'];
            $dropdown = (bool) $instance['dropdown'];
            $taxonomy = esc_attr( $instance['taxonomy'] );
            
            # Get taxonomiues
            $taxonomies = get_taxonomies( array( 'public' => true ) );
            
            # If no taxonomies exists
            if ( ! $taxonomies ) {
                echo '<p>'. esc_html__('No taxonomies have been created yet.', 'sonaar') .'</p>';
                return;
        }
        
        ?>
                <p>
                  <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                    <?php esc_html_e('Title:', 'sonaar'); ?>
                  </label>
                  <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" placeholder="<?php esc_html_e('Categories', 'sonaar'); ?>"
                  />
                </p>

                <p>
                  <label for="<?php echo esc_attr($this->get_field_id('taxonomy')); ?>">
                    <?php esc_html_e('Select Taxonomy:', 'sonaar'); ?>
                  </label>
                  <select id="<?php echo esc_attr($this->get_field_id('taxonomy')); ?>" name="<?php echo esc_attr($this->get_field_name('taxonomy')); ?>">
                    <?php
        foreach ( $taxonomies as $tax ) {
            $tax = get_taxonomy($tax);
            echo '<option value="' . $tax->name . '"' . selected( $taxonomy, $tax->name, false ) . '>'. $tax->label . '</option>';
        }
        ?>
                  </select>
                </p>

                <p>
                  <input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id('dropdown')); ?>" name="<?php echo esc_attr($this->get_field_name('dropdown')); ?>" <?php checked( $dropdown ); ?> />
                  <label for="<?php echo esc_attr($this->get_field_id('dropdown')); ?>">
                    <?php esc_html_e('Display as dropdown', 'sonaar'); ?>
                  </label>
                  <br />

                  <input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id('count')); ?>" name="<?php echo esc_attr($this->get_field_name('count')); ?>" <?php checked( $count ); ?> />
                  <label for="<?php echo esc_attr($this->get_field_id('count')); ?>">
                    <?php esc_html_e('Show post counts', 'sonaar'); ?>
                  </label>
                  <br />
                  <?php
        
    }
    
} // class Iron_Widget_Terms





/**
* Videos Widget Class
*
* @since 1.6.0
* @see   Iron_Widget_Posts
* @todo  - Add advanced options
*/

class Iron_Widget_Videos extends Iron_Music_Widget
{
    /**
    * Widget Defaults
    */
    
    public static $widget_defaults;
    
    
    /**
    * Register widget with WordPress.
    */
    
    function __construct ()
    {
        
        $widget_ops = array(
        'classname'   => 'iron_widget_videos'
        , 'description' => esc_html_x('The most recent videos on your site.', 'Widget', 'sonaar')
        );
        
        self::$widget_defaults = array(
            'title'        => ''
            , 'post_type'    => 'video'
            , 'view'		 => 'video_list'
            , 'category'	 => array()
            , 'include'	 => array()
            , 'artists_filter'	 => array()
            //, 'video_link_type'	 => ''
            , 'number'       => -1
            , 'action_title' => ''
            , 'action_obj_id'  => ''
            , 'action_ext_link'  => ''
            );
            
            parent::__construct('iron-recent-videos', esc_html_x('sonaar: Videos', 'Widget', 'sonaar'), $widget_ops);
            
            add_action( 'save_post', array($this, 'flush_widget_cache') );
            add_action( 'deleted_post', array($this, 'flush_widget_cache') );
            add_action( 'switch_theme', array($this, 'flush_widget_cache') );
    }
    
    function widget ( $args, $instance )
    {
        
        $cache = wp_cache_get('iron_widget_videos', 'widget');
        
        if ( ! is_array($cache) )
            $cache = array();
        
        if ( ! isset( $args['widget_id'] ) )
            $args['widget_id'] = $this->id;
        
        if ( isset( $cache[ $args['widget_id'] ] ) ) {
            echo $cache[ $args['widget_id'] ];
            return;
        }
        
        ob_start();
        $args['before_title'] = "<span class='heading-t3'></span>".$args['before_title'];
        $args['before_title'] = str_replace('h2','h3',$args['before_title']);
        $args['after_title'] = str_replace('h2','h3',$args['after_title']);
        extract($args);
        $instance = wp_parse_args( (array) $instance, self::$widget_defaults );

        global $videoListArg;

        $videoListArg = array(
          'title_tag' => ( isset( $instance['titletag'] ) )? $instance['titletag']: 'h1'
        );
         
        $title      = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
        $post_type  = apply_filters( 'widget_post_type', $instance['post_type'], $instance, $this->id_base );
        $number     = $instance['number'];
        $category   = $instance['category'];
        $include   = $instance['include'];
        $view     	= 'video_list';

        $artists_filter = $instance['artists_filter'];
        $meta_query = array();
        if ( isset( $instance['hide_title'] ) ) {
          $iron_sonaar_hide_page_title = $instance['hide_title'];
        }
        if(!is_array($artists_filter)) {
          $artists_filter = explode(",", $artists_filter);
          $meta_query =  array(
            array(
            'key'     => 'artist_of_video',
            'value'   => implode('|',$artists_filter),
            'compare' => 'rlike',
            ),
          );
        }
        
      
        
        global $iron_sonaar_link_mode;
        
        
        $query_args = array(
        'post_type'         	=> $post_type,
        'artists_filter'		=> $artists_filter,
        'posts_per_page'    	=> $number,
        'no_found_rows'     	=> true,
        'post_status'       	=> 'publish',
        'ignore_sticky_posts'	=> true,
        'meta_query'			=> $meta_query,
        'hide_page_title' =>''
        );

        //IF taxonomy-video-category page
        if ( is_tax( 'video-category') ) {
          $query_args['tax_query'] = 	array(
            array(
                'taxonomy' => 'video-category',
                'terms'    => get_queried_object()->term_id,
            )
          );
          $title = get_queried_object()->name;
        }
        
        if(!empty($include)) {
            
            if(!is_array($include)) {
                $include = explode(",", $include);
            }
            $query_args["post__in"] = $include;
            
            $category = false;
            $number = false;
        }
        
        
        $tax_query = array();
        
        if(!empty($category)) {
            
            if(!is_array($category)) {
                $category = explode(",", $category);
            }
            $tax_query[] = array(
            'taxonomy' => 'video-category',
            'field' => 'id',
            'terms' => $category,
            'operator'=> 'IN'
            );
            
        }
        
        if(!empty($tax_query))
        $query_args["tax_query"] = $tax_query;
        
        $r = new WP_Query( apply_filters( 'iron_widget_posts_args', $query_args ) );
        
        if ( $r->have_posts() ) :
            echo $before_widget;
        ?>

                            <div class="sr_it-videolist-container <?php echo esc_attr($view); ?>">

                              <?php if ( ! empty( $title ) ):?>
                                <div class="page-title<?php echo (Iron_sonaar::isPageTitleUppercase() == true) ? 'uppercase' : ''; ?>">
                                  <h1><?php echo $title ?></h1>
                                </div>
                                <?php endif ?>
                                  <?php if( $view == 'video_list' ):?>
                                    <div class="sr_it-videolist-col2">
                                      <div class="sr_it-videolist-screen">
                                        <?php echo wp_oembed_get( Iron_sonaar::getField('video_url',$r->posts[0]->ID) ); ?>
                                      </div>
                                    </div>
                                    <?php endif ?>

                                      <div class=" <?php echo ( $view == 'video_list' )? 'sr_it-videolist-list sr_it-videolist-col1' : 'listing-section' ;?> <?php echo ( empty( $iron_sonaar_hide_page_title ) )? 'sr_it-videolist-spacer' : ''; ?>">

                                        <?php if( $view == 'video_list' ):?>
                                          <div id="sr_it-perfectscrollbar">
                                            <?php endif ?>
                                              <?php while($r->have_posts()): $r->the_post(); ?>
                                                <?php //$iron_sonaar_link_mode = $video_link_type;?>
                                                  <?php get_template_part('items/' . $view ) ?>
                                                    <?php endwhile ?>
                                                      <?php wp_reset_query() ?>
                                                        <?php if( $view == 'video_list' ):?>
                                          </div>
                                          <?php endif ?>
                                      </div>


                            </div>

                            <?php
                
                echo $after_widget;
                
                // Reset the global $the_post as this query will have stomped on it
                wp_reset_postdata();
                
                endif;
                $cache[$args['widget_id']] = ob_get_flush();
                wp_cache_set('iron_widget_videos', $cache, 'widget');
        }
        
        function update ( $new_instance, $old_instance )
        {
            $instance = wp_parse_args( (array) $old_instance, self::$widget_defaults );
                
                $instance['title'] = strip_tags($new_instance['title']);
                $instance['number'] = (int) $new_instance['number'];
                $instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
                $instance['view'] = $new_instance['view'];
                $instance['category'] = $new_instance['category'];
                $instance['include'] = $new_instance['include'];
                $instance['artists_filter'] = $new_instance['artists_filter'];
                $instance['action_title']  = $new_instance['action_title'];
                $instance['action_obj_id']  = $new_instance['action_obj_id'];
                $instance['action_ext_link']  = $new_instance['action_ext_link'];
                
                $this->flush_widget_cache();
                
                return $instance;
        }
        
        function flush_widget_cache ()
        {
            wp_cache_delete('iron_widget_videos', 'widget');
        }
        
        function form ( $instance )
        {
            $instance = wp_parse_args( (array) $instance, self::$widget_defaults );
                
                $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
                $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
                $view      = $instance['view'];
                $category   = $instance['category'];
                $include   = $instance['include'];
                $artists_filter = $instance['artists_filter'];
                $video_link_type  = $instance['video_link_type'];
                $action_title = $instance['action_title'];
                $action_obj_id = $instance['action_obj_id'];
                $action_ext_link = $instance['action_ext_link'];
                ?>
                              <p>
                                <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>">
                                  <?php esc_html_e('Title:', 'sonaar'); ?>
                                </label>
                                <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" placeholder="<?php esc_html_e('Videos', 'sonaar'); ?>"
                                />
                              </p>

                              <p>
                                <label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>">
                                  <?php esc_html_e('Number of videos to show (*apply only for categories):', 'sonaar'); ?>
                                </label>
                                <input id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" type="text" value="<?php echo esc_attr($number); ?>" size="3" />
                              </p>

                              <p>
                                <label for="<?php echo esc_attr($this->get_field_id('category')); ?>">
                                  <?php echo esc_html_x('Select one or multiple categories:', 'Widget', 'sonaar'); ?>
                                </label>
                                <select class="widefat" id="<?php echo esc_attr($this->get_field_id('category')); ?>" name="<?php echo esc_attr($this->get_field_name('category')); ?>[]" multiple="mutiple">
                                  <?php echo $this->get_taxonomy_options($category, 'video-category'); ?>
                                </select>
                              </p>

                              <p>
                                <label for="<?php echo esc_attr($this->get_field_id('include')); ?>">
                                  <?php echo esc_html_x('Or Manually Select Videos:', 'Widget', 'sonaar'); ?>
                                </label>
                                <select class="widefat" id="<?php echo esc_attr($this->get_field_id('include')); ?>" name="<?php echo esc_attr($this->get_field_name('include')); ?>[]" multiple="mutiple">
                                  <?php echo $this->get_object_options($include, 'video'); ?>
                                </select>
                              </p>
                              <p>
                                <label for="<?php echo esc_attr($this->get_field_id( 'artists_filter' )); ?>">
                                  <?php esc_html_e('Filter By Artists:', 'sonaar'); ?>
                                </label>
                                <select multiple class="widefat" id="<?php echo esc_attr($this->get_field_id('artists_filter')); ?>" name="<?php echo esc_attr($this->get_field_name('artists_filter')); ?>[]">
                                  <?php echo $this->get_object_options($artists_filter, 'artist'); ?>
                                </select>
                              </p>
                                      <p>
                                        <label for="<?php echo esc_attr($this->get_field_id('action_title')); ?>">
                                          <?php echo esc_html_x('Call To Action Title:', 'Widget', 'sonaar'); ?>
                                        </label>
                                        <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('action_title')); ?>" name="<?php echo esc_attr($this->get_field_name('action_title')); ?>" value="<?php echo esc_attr($action_title); ?>" placeholder="<?php esc_html_e('View More', 'sonaar'); ?>"
                                        />
                                      </p>
                                      <p>
                                        <label for="<?php echo esc_attr($this->get_field_id('action_obj_id')); ?>">
                                          <?php echo esc_html_x('Call To Call To Action Page:', 'Widget', 'sonaar'); ?>
                                        </label>
                                        <select class="widefat" id="<?php echo esc_attr($this->get_field_id('action_obj_id')); ?>" name="<?php echo esc_attr($this->get_field_name('action_obj_id')); ?>">
                                          <?php echo $this->get_object_options($action_obj_id); ?>
                                        </select>
                                      </p>
                                      <p>
                                        <label for="<?php echo esc_attr($this->get_field_id('action_ext_link')); ?>">
                                          <?php echo esc_html_x('Call To Action External Link:', 'Widget', 'sonaar'); ?>
                                        </label>
                                        <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('action_ext_link')); ?>" name="<?php echo esc_attr($this->get_field_name('action_ext_link')); ?>" value="<?php echo esc_attr($action_ext_link); ?>" />
                                      </p>
                                      <?php
        }
    } // class Iron_Widget_Videos
    
    
    class Iron_Music_Widget_bandsintown extends Iron_Music_Widget{
        //Widget Defaults
        public static $widget_defaults;
        
        //Register widget with WordPress
        function __construct (){
            
            $widget_ops = array(
            'classname'   => 'iron_widget_bandsintown',
            'description' => esc_html_x('A Bandsintown Tour Dates Widget', 'Widget', IRON_MUSIC_TEXT_DOMAIN)
            );
            
            self::$widget_defaults = array(
                'band_name' => 'Swans',
                'text_color' => '#000000',
                'background_color' => '#FFFFFF',
                'button_color' => '#2F95DE',
                'button_txt_color' => '#FFFFFF',
                'local_dates' => false,
                'past_dates' => true,
                'display_limit' => 15
                );
                
                parent::__construct('iron-bandsintown', IRON_MUSIC_PREFIX . esc_html_x('Bandsintown Tour Dates Widget', 'Widget', IRON_MUSIC_TEXT_DOMAIN), $widget_ops);
                
        }
        


        //Front-end display of widget
        public function widget ( $args, $instance )
        {
            global $post, $widget;
            
            $instance = wp_parse_args( (array) $instance, self::$widget_defaults );
                
            echo '
            <script charset="utf-8" src="https://widget.bandsintown.com/main.min.js"></script>
            <a class="bit-widget-initializer"
            data-artist-name="'. $instance['band_name'] .'"
            data-display-local-dates="'. $instance['local_dates'] .'"
            data-display-past-dates="'. $instance['past_dates'] .'"
            data-auto-style="false"
            data-text-color="'. $instance['text_color'] .'"
            data-link-color="'. $instance['button_color'] .'"
            data-popup-background-color="'. $instance['background_color'] .'"
            data-background-color="'. $instance['background_color'] .'"
            data-display-limit="'. $instance['display_limit'] .'"
            data-link-text-color="'. $instance['button_txt_color'] .'"></a>';



        }
        
        //Back-end widget form.
        
        public function form ( $instance ){
            $instance = wp_parse_args( (array) $instance, self::$widget_defaults );
                include IRON_MUSIC_DIR_PATH . 'includes/widget-form/bandsintown.php';
        }
        
        //Sanitize widget form values as they are saved.
        
        public function update ( $new_instance, $old_instance )
        {
            $instance = wp_parse_args( $old_instance, self::$widget_defaults );
                
                $instance['band_name'] = $new_instance['band_name'];
                $instance['text_color'] = $new_instance['text_color'];
                $instance['background_color'] = $new_instance['background_color'];
                $instance['button_color'] = $new_instance['button_color'];
                $instance['button_txt'] = $new_instance['button_txt'];
                $instance['local_dates'] = $new_instance['local_dates'];
                $instance['past_dates'] = $new_instance['past_dates'];
                $instance['display_limit'] = $new_instance['display_limit'];
                
                return $instance;
        }
        
    } // class Iron_Widget_Grid
    
    
    
    /**
    * Iron_Widget_Ios_Slider Class
    *
    * @since 1.6.0
    * @see   Iron_Widget_Ios_Slider
    */
    
    class Iron_Widget_Ios_Slider extends Iron_Music_Widget
    {
        /**
        * Widget Defaults
        */
        
        public static $widget_defaults;
        
        
        /**
        * Register widget with WordPress.
        */
        
        function __construct (){
            $widget_ops = array(
            'classname'   => 'iron_widget_iosslider'
            , 'description' => esc_html_x('Touch Enabled, Responsive jQuery Horizontal Image Slider/Carousel.', 'Widget', 'sonaar')
            );
            
            self::$widget_defaults = array(
                'title'        => ''
                , 'id'     	 => ''
                );
                
                
                add_action('wp_enqueue_scripts', array(&$this, 'enqueue_scripts'));
                
                parent::__construct('iron-ios-slider', esc_html_x('sonaar: IOS Slider', 'Widget', 'sonaar'), $widget_ops);
                
        }
        
        /**
        * Front-end display of widget.
        */
        
        public function widget ( $args, $instance )
        {
            $args['before_title'] = "<span class='heading-t3'></span>".$args['before_title'];
            $args['before_title'] = str_replace('h2','h3',$args['before_title']);
            $args['after_title'] = str_replace('h2','h3',$args['after_title']);
            extract($args);
            
            $instance = wp_parse_args( (array) $instance, self::$widget_defaults );
                
                $title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
                $id = $instance['id'];
                $uniqid = uniqid();
                
                echo $args['before_widget'];
                
                if ( ! empty( $title ) )
                    echo $args['before_title'] . esc_html($title) . $args['after_title'];;
            if(!empty($title)){$this->get_title_divider();}
            
            if(empty($id))
            return;
            
            
            $height = get_field('slider_height', $id);
            $photos = get_field('slider_photos', $id);
            
            if(empty($photos))
            return;
            ?>

                                        <section class="iosSliderWrap" style="height:<?php echo esc_attr($height); ?>px">
                                          <div class="sliderContainer" style="max-height:<?php echo esc_attr($height); ?>px">

                                            <!-- slider container -->
                                            <div class="iosSlider" id="<?php echo esc_attr($uniqid); ?>">

                                              <!-- slider -->
                                              <div class="slider">

                                                <!-- slides -->
                                                <?php foreach($photos as $photo): ?>
                                                  <div class="item">
                                                    <?php
            $link = null;
            $target = "_self";
            $link_type = $photo["slide_link_type"];
            
            if($link_type == 'internal' && !empty($photo["slide_link"])) {
                
                $link = $photo["slide_link"];
                $target = "_self";
                
            }else if($link_type == 'external' && !empty($photo["slide_link_external"])) {
                
                $link = $photo["slide_link_external"];
                $target = "_blank";
                
            }
            
            ?>

                                                      <div class="inner" style="background-image: url(<?php echo esc_url($photo["photo_file"]); ?>)">

                                                        <div class="selectorShadow"></div>

                                                        <?php if($link): ?>
                                                          <a target="<?php echo esc_attr($target); ?>" href="<?php echo esc_url($link); ?>">
                                                            <?php endif; ?>


                                                              <?php if(!empty($photo["photo_text_1"])) : ?>
                                                                <div class="text1"><span><?php echo esc_html($photo["photo_text_1"]); ?></span></div>
                                                                <?php endif; ?>
                                                                  <?php if(!empty($photo["photo_text_2"])) : ?>
                                                                    <div class="text2"><span><?php echo esc_html($photo["photo_text_2"]); ?></span></div>
                                                                    <?php endif; ?>


                                                                      <?php if($link): ?>
                                                          </a>
                                                          <?php endif; ?>

                                                      </div>

                                                  </div>
                                                  <?php endforeach; ?>

                                              </div>

                                            </div>
                                          </div>
                                        </section>

                                        <script>
                                          jQuery(document).ready(function($) {
                                            /* some custom settings */
                                            $('.iosSlider#<?php echo esc_js($uniqid); ?>').iosSlider({
                                              desktopClickDrag: true,
                                              snapToChildren: true,
                                              infiniteSlider: true,
                                              snapSlideCenter: true,
                                              navSlideSelector: '.sliderContainer .slideSelectors .item',
                                              navPrevSelector: '.sliderContainer .slideSelectors .prev',
                                              navNextSelector: '.sliderContainer .slideSelectors .next',
                                              onSlideComplete: slideComplete,
                                              onSliderLoaded: sliderLoaded,
                                              onSlideChange: slideChange,
                                              autoSlide: true,
                                              scrollbar: true,
                                              scrollbarContainer: '.sliderContainer .scrollbarContainer',
                                              scrollbarMargin: '0',
                                              scrollbarBorderRadius: '0',
                                              keyboardControls: true
                                            });

                                            function slideChange(args) {

                                              $('.sliderContainer .slideSelectors .item').removeClass('selected');
                                              $('.sliderContainer .slideSelectors .item:eq(' + (args.currentSlideNumber - 1) + ')').addClass('selected');

                                            }

                                            function slideComplete(args) {

                                              if (!args.slideChanged) return false;

                                              $(args.sliderObject).find('.text1, .text2').attr('style', '');

                                              $(args.currentSlideObject).find('.text1').animate({
                                                right: '100px',
                                                opacity: '0.8'
                                              }, 400, 'easeOutQuint');

                                              $(args.currentSlideObject).find('.text2').delay(200).animate({
                                                right: '50px',
                                                opacity: '0.8'
                                              }, 400, 'easeOutQuint');

                                            }

                                            function sliderLoaded(args) {

                                              $(args.sliderObject).find('.text1, .text2').attr('style', '');

                                              $(args.currentSlideObject).find('.text1').animate({
                                                right: '100px',
                                                opacity: '0.8'
                                              }, 400, 'easeOutQuint');

                                              $(args.currentSlideObject).find('.text2').delay(200).animate({
                                                right: '50px',
                                                opacity: '0.8'
                                              }, 400, 'easeOutQuint');

                                              slideChange(args);

                                            }

                                          });
                                        </script>
                                        <?php
            
            echo $args['after_widget'];
            
        }
        
        /**
        * Back-end widget form.
        */
        
        public function form ( $instance )
        {
            $instance = wp_parse_args( (array) $instance, self::$widget_defaults );
                
                $title = esc_attr( $instance['title'] );
                $id = $instance['id'];
                
                $all_sliders = get_posts(array(
                'post_type' => 'iosslider'
                , 'posts_per_page' => -1
                , 'no_found_rows'  => true
                ));
                
                
                if ( !empty($all_sliders) ) :
                    ?>
                                          <p>
                                            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                                              <?php echo esc_html_x('Title:', 'Widget', 'sonaar'); ?>
                                            </label>
                                            <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($title); ?>" placeholder="<?php esc_html_e('Popular Songs', 'sonaar'); ?>"
                                            />
                                          </p>
                                          <p>
                                            <label for="<?php echo esc_attr($this->get_field_id('id')); ?>">
                                              <?php echo esc_html_x('IOS Sliders:', 'Widget', 'sonaar'); ?>
                                            </label>
                                            <select class="widefat" id="<?php echo esc_attr($this->get_field_id('id')); ?>" name="<?php echo esc_attr($this->get_field_name('id')); ?>">
                                              <?php foreach($all_sliders as $s): ?>

                                                <option value="<?php echo esc_attr($s->ID); ?>" <?php echo (($s->ID == $id) ? ' selected="selected"' : ''); ?>>
                                                  <?php echo esc_attr($s->post_title); ?>
                                                </option>

                                                <?php endforeach; ?>
                                            </select>
                                          </p>


                                          <?php
                
                else :
                    
                echo wp_kses_post( '<p>'. sprintf( esc_html_x('No photo albums have been created yet. <a href="%s">Create some</a>.', 'Widget', 'sonaar'), esc_url(admin_url('edit.php?post_type=photo-album')) ) .'</p>' );
                
                endif;
                
                
        }
        
        /**
        * Sanitize widget form values as they are saved.
        */
        
        public function update ( $new_instance, $old_instance )
        {
            $instance = wp_parse_args( $old_instance, self::$widget_defaults );
                
                $instance['title'] = strip_tags( stripslashes($new_instance['title']) );
                $instance['id'] = $new_instance['id'];
                
                return $instance;
        }
        
        function enqueue_scripts() {
            
            if ( is_admin() || in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php')) ) return;
            
            wp_enqueue_script('iosslider', IRON_PARENT_URL.'/js/jquery.iosslider.min.js', array('jquery'), null, true);
            
        }
        
        
    }
    // class Iron_Widget_Ios_Slider