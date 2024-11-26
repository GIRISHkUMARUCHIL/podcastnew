<?php
/**
 * Podcast RSS feed template
 *
 * @package Sonaar
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if (class_exists('Sonaar_Music')){
	exit;
}
// Hide errors.
error_reporting( 0 );

// If redirect is on, get new feed URL and redirect if setting was changed more than 48 hours ago
$redirect     = get_ironMusic_option('srpodcast_redirect_feed', '_iron_music_podcast_feed_options');
$new_feed_url = false;

if ( $redirect && $redirect == '1' ) {
	$new_feed_url = get_ironMusic_option('srpodcast_new_feed_url', '_iron_music_podcast_feed_options');
	$update_date  = get_option( 'ss_podcasting_redirect_feed_date' );
	
	//if ( $new_feed_url && $update_date ) {
	//	$redirect_date = strtotime( '+2 days', $update_date );
	//	$current_date  = time();
		
		// Redirect with 301 if it is more than 2 days since redirect was saved
	//	if ( $current_date > $redirect_date ) {
			header( 'HTTP/1.1 301 Moved Permanently' );
			header( 'Location: ' . $new_feed_url );
			exit;
	//	}
	//}
}

// Get podcast details.
$title           = get_ironMusic_option('srpodcast_data_title', '_iron_music_podcast_feed_options');
$subtitle        = get_ironMusic_option('srpodcast_data_subtitle', '_iron_music_podcast_feed_options');
$author          = get_ironMusic_option('srpodcast_data_author', '_iron_music_podcast_feed_options');
$description     = strip_tags( get_ironMusic_option('srpodcast_data_description', '_iron_music_podcast_feed_options') );
$language        = get_ironMusic_option('srpodcast_data_language', '_iron_music_podcast_feed_options');
$copyright       = get_ironMusic_option('srpodcast_data_copyright', '_iron_music_podcast_feed_options');
$owner_name      = get_ironMusic_option('srpodcast_data_owner_name', '_iron_music_podcast_feed_options');
$owner_email     = get_ironMusic_option('srpodcast_data_owner_email', '_iron_music_podcast_feed_options');
$explicit_option = get_ironMusic_option('srpodcast_explicit', '_iron_music_podcast_feed_options');
//$lastbuiltdate   = mysql2date( 'D, d M Y H:i:s +0000', get_lastpostmodified( 'GMT' ), false );

 $latest = new WP_Query(
        array(
            'post_type' => 'podcast',
            'post_status' => 'publish',
            'posts_per_page' => 1,
            'orderby' => 'modified',
            'order' => 'DESC'
        )
);
if($latest->have_posts()){
    $modified_date = $latest->posts[0]->post_modified;
}

$lastbuiltdate = mysql2date( 'D, d M Y H:i:s +0000', $modified_date, false );


if ( $explicit_option && 'on' === $explicit_option ) {
	$itunes_explicit     = 'yes';
	$googleplay_explicit = 'Yes';
} else {
	$itunes_explicit     = 'clean';
	$googleplay_explicit = 'No';
}
$complete_option = get_ironMusic_option('srpodcast_complete', '_iron_music_podcast_feed_options');
if ( $complete_option && 'on' === $complete_option ) {
	$complete = 'yes';
} else {
	$complete = '';
}

$image       = get_ironMusic_option('srpodcast_data_image', '_iron_music_podcast_feed_options');

$itunes_type = get_ironMusic_option('srpodcast_consume_order', '_iron_music_podcast_feed_options');

$category_option = get_ironMusic_option('srpodcast_data_category', '_iron_music_podcast_feed_options');

$subcategory_option = get_ironMusic_option('srpodcast_data_subcategory', '_iron_music_podcast_feed_options');

// Set RSS content type and charset headers.
header( 'Content-Type: ' . feed_content_type( 'podcast' ) . '; charset=' . get_option( 'blog_charset' ), true );

// Use `echo` for first line to prevent any extra characters at start of document.
echo '<?xml version="1.0" encoding="' . esc_attr( get_option( 'blog_charset' ) ) . '"?>' . "\n";

?>

<rss version="2.0"
	xmlns:content="http://purl.org/rss/1.0/modules/content/"
	xmlns:wfw="http://wellformedweb.org/CommentAPI/"
	xmlns:dc="http://purl.org/dc/elements/1.1/"
	xmlns:atom="http://www.w3.org/2005/Atom"
	xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
	xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
	xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd"
	xmlns:googleplay="http://www.google.com/schemas/play-podcasts/1.0"
	<?php do_action( 'rss2_ns' ); ?>
>

	<channel>
		<title><?php echo esc_html( $title ); ?></title>
		<atom:link href="<?php esc_url( self_link() ); ?>" rel="self" type="application/rss+xml" />
		<link><?php echo esc_url( apply_filters( 'sonaar_helper_feed_home_url', trailingslashit( home_url() ) ) ); ?></link>
		<description><?php echo esc_html( $description ); ?></description>
		<lastBuildDate><?php echo esc_html($lastbuiltdate); ?></lastBuildDate>
		<language><?php echo esc_html( $language ); ?></language>
		<copyright><?php echo esc_html( $copyright ); ?></copyright>
		<itunes:subtitle><?php echo esc_html( $subtitle ); ?></itunes:subtitle>
		<itunes:author><?php echo esc_html( $author ); ?></itunes:author>
<?php if ( $itunes_type ) : ?>
		<itunes:type><?php echo esc_html( $itunes_type ); ?></itunes:type>
<?php endif; ?>
		<itunes:owner>
			<itunes:name><?php echo esc_html( $owner_name ); ?></itunes:name>
			<itunes:email><?php echo esc_html( $owner_email ); ?></itunes:email>
		</itunes:owner>
		<googleplay:author><?php echo esc_html( $author ); ?></googleplay:author>
		<googleplay:email><?php echo esc_html( $owner_email ); ?></googleplay:email>
		<itunes:summary><?php echo esc_html( $description ); ?></itunes:summary>
		<googleplay:description><?php echo esc_html( $description ); ?></googleplay:description>
		<itunes:explicit><?php echo esc_html( $itunes_explicit ); ?></itunes:explicit>
		<googleplay:explicit><?php echo esc_html( $googleplay_explicit ); ?></googleplay:explicit>
<?php if ( $complete ) : ?>
		<itunes:complete><?php echo esc_html( $complete ); ?></itunes:complete>
<?php endif; ?>
<?php if ( $image ) : ?>
		<itunes:image href="<?php echo esc_url( $image ); ?>"></itunes:image>
		<googleplay:image href="<?php echo esc_url( $image ); ?>"></googleplay:image>
		<image>
			<url><?php echo esc_url( $image ); ?></url>
			<title><?php echo esc_html( $title ); ?></title>
			<link><?php echo esc_url( apply_filters( 'sonaar_helper_feed_home_url', trailingslashit( home_url() ) ) ); ?></link>
		</image>
<?php endif; ?>

<?php if($subcategory_option == "None"  || $subcategory_option == NULL || $subcategory_option == ""): ?>
		<itunes:category text="<?php echo esc_html( $category_option ); ?>" />
<?php else: ?>

		<itunes:category text="<?php echo esc_html( $category_option ); ?>">	
			<itunes:category text="<?php echo esc_html( $subcategory_option ); ?>"></itunes:category>
		</itunes:category>
<?php endif ?>

<?php
remove_action( 'rss2_head', 'rss2_site_icon' );
remove_action( 'rss2_head', 'the_generator' );

// Add RSS2 headers.
do_action( 'rss2_head' );




$default_args = array(
	'post_type'           => 'podcast',
	'post_status'         => 'publish',
	'orderby'             => 'date',
	'posts_per_page'      => -1,
	'ignore_sticky_posts' => true,
);
if (isset($_GET['terms'])){

		$default_args['tax_query'] = array(
				array(
					'taxonomy' => 'podcast-category',
					'field'    => 'slug',
					'terms'    => $_GET['terms']
				)
		);
}


$query_args = apply_filters( 'sonaar_podcast_feed_query_args', $default_args );

$qry = new WP_Query( $query_args );

if ( $qry->have_posts() ) {
	while ( $qry->have_posts() ) {
		$qry->the_post();
		
		if ( post_password_required( get_the_ID() ) ) {
			continue;
		}

		// Date recorded.
		$pub_date = esc_html( mysql2date( 'D, d M Y H:i:s +0000', get_post_time( 'Y-m-d H:i:s', true ), false ) );
		

		// Episode author. For now get author from the podcast settings, not per episode.
		//$author = esc_html( get_the_author() );


		// Episode content (with iframes removed).
		$content = get_the_content_feed( 'rss2' );
		$content = preg_replace( '/<\/?iframe(.|\s)*?>/', '', $content );

		$episode_summary = get_post_meta( get_the_ID(), 'episode_summary', true );
		if ( empty( $episode_summary ) ) {
			// iTunes summary is the full episode content, but must be shorter than 4000 characters.
			$itunes_summary = wp_strip_all_tags( strip_shortcodes(  $content ) );
			$itunes_summary = mb_substr( $itunes_summary, 0, 3999 ) ;
		} else {
			//$itunes_summary = wp_strip_all_tags( strip_shortcodes( mb_substr( $episode_summary, 0, 3999 ) ) );
			$itunes_summary = wp_strip_all_tags( strip_shortcodes( $episode_summary ) );
			$itunes_summary = mb_substr( $itunes_summary, 0, 3999 ) ;
		}
		$gp_description = $itunes_summary;



		// Episode description.
		ob_start();
		the_excerpt_rss();
		$description = ob_get_clean();

		// iTunes subtitle does not allow any HTML and must be shorter than 255 characters.
		$itunes_subtitle = strip_tags( strip_shortcodes( $description ) );
		$itunes_subtitle = str_replace( array( '>', '<', '\'', '"', '`', '[andhellip;]', '[&hellip;]', '[&#8230;]' ), array( '', '', '', '', '', '', '', '' ), $itunes_subtitle );
		$itunes_subtitle = mb_substr( $itunes_subtitle, 0, 254 );

		$episode_image = '';
		$image_id      = get_post_thumbnail_id( get_the_ID() );
		if ( $image_id ) {
			$image_att = wp_get_attachment_image_src( $image_id, 'full' );
			if ( $image_att ) {
				$episode_image = $image_att[0];
			}
		}
		$audioSrc     = "";
		$fileOrStream =  get_field('FileOrStreamPodCast', get_the_ID());
            switch ($fileOrStream) {
                case 'mp3':
                    if ( get_field('track_mp3_podcast', get_the_ID()) ) {
                        $mp3_id = get_field('track_mp3_podcast', get_the_ID());
                        $mp3_metadata = wp_get_attachment_metadata( $mp3_id['ID'] );
                        $album_filesize = ( isset( $mp3_metadata['filesize'] ) && $mp3_metadata['filesize'] !== '' )? $mp3_metadata['filesize'] : false;
                        $album_tracks_lenght = ( isset( $mp3_metadata['length_formatted'] ) && $mp3_metadata['length_formatted'] !== '' )? $mp3_metadata['length_formatted'] : false;
                        $audioSrc = wp_get_attachment_url($mp3_id['ID']);
                }
                break;

            case 'stream':
                $audioSrc = ( get_field('stream_link', get_the_ID()) !== '' )? get_field('stream_link', get_the_ID()) : false;
                $album_tracks_lenght = ( get_field('podcast_track_length', get_the_ID()) !== '' )? get_field('podcast_track_length', get_the_ID()) : false;           
                break;
            
            default:

                break;
            }

			if ($album_tracks_lenght) {    
				// Split the time string into components
				$components = explode(':', $album_tracks_lenght);
				
				// Reverse the array, because the seconds will always be last
				$components = array_reverse($components);
			
				// Add any missing components
				while (count($components) < 3) {
					array_push($components, "00");
				}

				// Reverse the array back to its original order
				$components = array_reverse($components);
			
				// Format each component as a two-digit number
				foreach ($components as $key => $component) {
					$components[$key] = sprintf('%02d', $component);
				}
			
				// Join the components into a time string and return it
				$album_tracks_lenght = implode(':', $components);
			}
	
		$audio_file     = $audioSrc;
		// If there is no enclosure then go no further.
		if ( ! isset( $audio_file ) || ! $audio_file ) {
			continue;
		}

		$duration = $album_tracks_lenght;
		if ( ! $duration ) {
			$duration = '0:00';
		}
		$size = $album_filesize;
		if ( ! $size ) {
			$size = 1;
		}

		// Episode explicit flag.
		$ep_explicit = get_post_meta( get_the_ID(), 'podcast_explicit_episode', true );
		if ( ! empty( $ep_explicit ) ) {
			$itunes_explicit_flag     = 'yes';
			$googleplay_explicit_flag = 'Yes';
		} else {
			$itunes_explicit_flag     = 'clean';
			$googleplay_explicit_flag = 'No';
		}

		// Episode block flag.
		$ep_block = get_post_meta( get_the_ID(), 'podcast_itunes_notshow', true );
		if ( ! empty( $ep_block ) ) {
			$block_flag = 'yes';
		} else {
			$block_flag = 'no';
		}

		// Tags/keywords
		$post_tags = get_the_tags( get_the_ID() );
		if ( $post_tags ) {
			$tags = array();
			foreach ( $post_tags as $tag ) {
				$tags[] = $tag->name;
			}
			if ( ! empty( $tags ) ) {
				$keywords = implode( ',', $tags );
			}
		}

		// New iTunes WWDC 2017 Tags.
	
		$itunes_episode_type   = "";
		$itunes_title          = get_post_meta( get_the_ID(), 'podcast_itunes_episode_title', true );
		$itunes_episode_number = get_post_meta( get_the_ID(), 'podcast_itunes_episode_number', true );
		$itunes_season_number  = get_post_meta( get_the_ID(), 'podcast_itunes_season_number', true );
		
		
		if (get_post_meta( get_the_ID(), 'podcast_itunes_episode_type', true ) != "null"){
			$itunes_episode_type   = get_post_meta( get_the_ID(), 'podcast_itunes_episode_type', true );
		}

		?>

		<item>
			<title><?php esc_html( the_title_rss() ); ?></title>
			<link><?php esc_url( the_permalink_rss() ); ?></link>
			<pubDate><?php echo esc_html( $pub_date ); ?></pubDate>
			<dc:creator><?php echo esc_html( $author ); ?></dc:creator>
			<guid isPermaLink="false"><?php esc_html( the_guid() ); ?></guid>
			<description><![CDATA[<?php echo $description; ?>]]></description>
			<itunes:subtitle><![CDATA[<?php echo $itunes_subtitle; ?>]]></itunes:subtitle>
		<?php if ( $keywords ) : ?>
			<itunes:keywords><?php echo $keywords; ?></itunes:keywords>
		<?php endif; ?>
		<?php if ( $itunes_episode_type ) : ?>
			<itunes:episodeType><?php echo esc_html( $itunes_episode_type ); ?></itunes:episodeType>
		<?php endif; ?>
		<?php if ( $itunes_title ) : ?>
			<itunes:title><![CDATA[<?php echo esc_html( $itunes_title ); ?>]]></itunes:title>
		<?php endif; ?>
		<?php if ( $itunes_episode_number ) : ?>
			<itunes:episode><?php echo esc_html( $itunes_episode_number ); ?></itunes:episode>
		<?php endif; ?>
		<?php if ( $itunes_season_number ) : ?>
			<itunes:season><?php echo esc_html( $itunes_season_number ); ?></itunes:season>
		<?php endif; ?>
			<content:encoded><![CDATA[<?php echo $content; ?>]]></content:encoded>
			<itunes:summary><![CDATA[<?php echo $itunes_summary; ?>]]></itunes:summary>
			<googleplay:description><![CDATA[<?php echo $gp_description; ?>]]></googleplay:description>
		<?php if ( $episode_image ) : ?>
			<itunes:image href="<?php echo esc_url( $episode_image ); ?>"></itunes:image>
			<googleplay:image href="<?php echo esc_url( $episode_image ); ?>"></googleplay:image>
		<?php endif; ?>
			<enclosure url="<?php echo esc_url( $audio_file ); ?>" length="<?php echo esc_attr( $size ); ?>" type="audio/mpeg"></enclosure>
			<itunes:explicit><?php echo esc_html( $itunes_explicit_flag ); ?></itunes:explicit>
			<googleplay:explicit><?php echo esc_html( $googleplay_explicit_flag ); ?></googleplay:explicit>
			<itunes:block><?php echo esc_html( $block_flag ); ?></itunes:block>
			<googleplay:block><?php echo esc_html( $block_flag ); ?></googleplay:block>
			<itunes:duration><?php echo esc_html( $duration ); ?></itunes:duration>
			<itunes:author><?php echo esc_html( $author ); ?></itunes:author>
		</item>
		<?php
	} // end while
} // end if
?>

	</channel>
</rss>
