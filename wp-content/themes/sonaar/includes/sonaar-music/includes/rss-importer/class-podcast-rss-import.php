<?php
/**
 * Import a podcast rss url.
 *
 * @package Sonaar
 */

if ( ! defined( 'WP_LOAD_IMPORTERS' ) ) {
	return;
}

/* Load WP Importer API */
require_once ABSPATH . 'wp-admin/includes/import.php';


if ( ! class_exists( 'WP_Importer' ) ) {
	$sr_class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
	if ( file_exists( $sr_class_wp_importer ) ) {
		require_once $sr_class_wp_importer;
	}
}
function sr_feed_cache_lifetime( $time ) {
	return 60;
}
function sr_feed_wp_feed_options( &$args ) {
	$args->force_feed = true;
}
if ( ! class_exists( 'Sonaar_RSS_Import' ) && class_exists( 'WP_Importer' ) ) {
	if ( ! defined( 'SIMPLEPIE_NAMESPACE_GOOGLE_PLAY' ) ) {
		define( 'SIMPLEPIE_NAMESPACE_GOOGLE_PLAY', 'http://www.google.com/schemas/play-podcasts/1.0' );
	}

	//Import RSS feed for into WP
	class Sonaar_RSS_Import extends WP_Importer {

		// Step by step process
		public function dispatch() {
			if ( empty( $_GET['step'] ) ) {
				$step = 0;
			} else {
				$step = (int) $_GET['step'];
			}
			$this->header();
			switch ( $step ) {
				case 0:
					$this->welcomemsg();
					break;
				case 1:
					$this->import();
					break;
			}
			$this->footer();
		}

		// header
		private function header() {
			echo '<div class="wrap">';
			echo '<h2>' . esc_html__( 'Import Podcast RSS', 'sonaar' ) . '</h2>';
		}

		// footer
		private function footer() {
			echo '</div>';
		}

		// First step
		private function welcomemsg() {
			echo '<div class="narrow">';
			echo '<p>' . esc_html__( 'Paste the URL link of your actual RSS feed into the field below and we will import the episodes. Before importing your RSS feed, make sure you have a valid RSS Feed. You can validate it here: https://castfeedvalidator.com/', 'sonaar' ) . '</p>';
			echo '<form enctype="multipart/form-data" action="admin.php?import=podcast-rss&amp;step=1" method="post" name="import-podcast-feed">';
			wp_nonce_field( 'podcast-import-rss' );
			echo '<table class="form-table"><tbody>';
			echo '<tr><th scope="row">' . esc_html__( 'RSS Link URL', 'sonaar' ) . '</th><td><input type="url" name="podcast_feed_url" id="podcast_feed_url" size="60" class="regular-text" required><p class="description"><label for="podcast_feed_url">' . esc_html__( 'URL link to external RSS feed.', 'sonaar' ) . '</label></p></td></tr>';
			echo '<tr><th scope="row">' . esc_html__( 'Category', 'sonaar' ) . '</th><td>';

			echo wp_dropdown_categories( array(
				'name'         => 'podcast_import_category',
				'taxonomy'     => 'podcast-category',
				'class'        => 'regular-text',
				'hide_empty'   => 0,
				'orderby'      => 'name',
				'echo'         => 0,
				'hierarchical' => 1,
				'selected'     => get_option( 'default_category' ),

			) );

			echo '<p class="description"><label for="podcast_import_podcast_category">' . esc_html__( 'In which category you want to import your podcast?', 'sonaar' ) . '</label></p></td></tr>';
			echo '<tr><th scope="row">' . esc_html__( 'Images', 'sonaar' ) . '</th><td><label for="podcast_import_attachments"><input name="podcast_import_attachments" type="checkbox" id="podcast_import_attachments" value="0"> ' . esc_html__( 'Download and import each podcast image', 'sonaar' ) . '</label><p class="description"><label for="podcast_import_attachments">' . esc_html__( 'This will set your episode featured image (make sure you don\'t have limitations like memory_limit, max_execution_time, post_max_size or upload_max_filesize from your web hosting)', 'sonaar' ) . '</label></p></td></tr>';
			echo '<tr><th scope="row">' . esc_html__( 'Podcast Settings', 'sonaar' ) . '</th><td><label for="podcast_import_settings"><input name="podcast_import_settings" type="checkbox" id="podcast_import_settings" value="0"> ' . esc_html__( 'Import podcast settings as well', 'sonaar' ) . '</label><p class="description"><label for="podcast_import_settings">' . esc_html__( 'This will import the general podcast show settings like title, author, description, cover, categories, language, etc.', 'sonaar' ) . '</label></p></td></tr>';
			echo '</tbody></table>';
			echo '<input type="submit" name="submit" id="submit" class="button button-primary" value="' . esc_html__( 'Import RSS', 'sonaar' ) . '">';
			echo '</form>';
			echo '</div>';
		}

		/**
		 * Proceed to second step
		 */
		public function import() {
			if ( ! check_admin_referer( 'podcast-import-rss' ) ) {
				wp_die( '<p>' . esc_html__( 'URL link is empty.', 'sonaar' ) . '<p>', '', array( 'back_link' => true ) );
				return false;
			}

			return self::run_import( sanitize_text_field( wp_unslash( $_POST['podcast_feed_url'] ) ), sanitize_text_field( $_POST['podcast_import_category'] ), isset( $_POST['podcast_import_attachments'] ), isset( $_POST['podcast_import_settings'] ), false, true );
		}
		private static function episode_exists( $title ) {
			global $wpdb;
			$post_title = wp_unslash( sanitize_post_field( 'post_title', $title, 0, 'db' ) );
			$args = array();
			$query = "SELECT ID FROM $wpdb->posts WHERE 1=1";
			$query .= ' AND ( post_title = %s OR post_title = %s )';
			$query .= ' AND post_type = %s';
			$args[] = $title;
			$args[] = $post_title;
			$args[] = 'podcast';
			return (int) $wpdb->get_var( $wpdb->prepare($query, $args) );
		}
		/**
		 * Run the import (cron job supported).
		 */
		public static function run_import( $feed_url, $import_category = 0, $import_attachments = false, $import_settings = false, $cron_job = true, $verbose = false ) {

			if ( $verbose ) {
				echo '<p>' . esc_html__( 'Fetching the external feed and parsing it...', 'sonaar' ) . '<p>';
			}
			/* temp decrease transient lifetime instead of the default 12 hours */
			add_filter( 'wp_feed_cache_transient_lifetime' , 'sr_feed_cache_lifetime' );
			/* use SimplePie and FeedCache for retrieval and parsing of a feed. */
			add_action( 'wp_feed_options', 'sr_feed_wp_feed_options' );
			/* use SimplePie and FeedCache */
			$feed = fetch_feed( esc_url( $feed_url ) );
			/* restore default lifetime transient */
			remove_filter( 'wp_feed_cache_transient_lifetime' , 'sr_feed_cache_lifetime' );
			remove_action( 'wp_feed_options', 'sr_feed_wp_feed_options' );

			if ( is_wp_error( $feed ) ) {
				if ( $verbose ) {
					wp_die( '<p>' . sprintf( esc_html__( 'Error occurred importing the feed: %1$s.', 'sonaar' ), esc_html( $feed->get_error_message() ) ) . '<p>', '', array( 'back_link' => true ) );
				}
				return false;
			}

			/* Import podcast settings, if required. */
			if ( $import_settings ) {
				if ( $verbose ) {
					echo '<p>' . esc_html__( 'Import podcast settings...', 'sonaar' ) . '<p>';
				}
				
				// import title.
				$tmp_title = $feed->get_title();
				if ( ! empty( $tmp_title ) ) {
					//update_ironMusic_option($feed->get_title(), 'srpodcast_data_title', '_iron_music_podcast_feed_options');
					update_ironMusic_option($tmp_title, 'srpodcast_data_title', '_iron_music_podcast_feed_options' );
				}
				// import subtitle (iTunes only).
				$podcast_subtitle = $feed->get_channel_tags( SIMPLEPIE_NAMESPACE_ITUNES, 'subtitle' );
				if ( ! empty( $podcast_subtitle ) && isset( $podcast_subtitle[0] ) && isset( $podcast_subtitle[0]['data'] ) ) {
					update_ironMusic_option($podcast_subtitle[0]['data'], 'srpodcast_data_subtitle', '_iron_music_podcast_feed_options');
				}
				// import author (iTunes only).
				$podcast_author = $feed->get_channel_tags( SIMPLEPIE_NAMESPACE_ITUNES, 'author' );
				if ( ! empty( $podcast_author ) && isset( $podcast_author[0] ) && isset( $podcast_author[0]['data'] ) ) {
					update_ironMusic_option($podcast_author[0]['data'], 'srpodcast_data_author', '_iron_music_podcast_feed_options');
				}

				// import description.
				$tmp_description = $feed->get_description();
				if ( ! empty( $tmp_description ) ) {
					update_ironMusic_option($tmp_description, 'srpodcast_data_description', '_iron_music_podcast_feed_options');
				}

				// import cover image.
				if ( $feed->get_image_url() ) {
					$podcast_cover_image = $feed->get_image_url();
				} else {
					$podcast_cover = $feed->get_channel_tags( SIMPLEPIE_NAMESPACE_ITUNES, 'image' );
					if ( ! empty( $podcast_cover ) && isset( $podcast_cover[0] ) && isset( $podcast_cover[0]['data'] ) ) {
						$podcast_cover_image = $podcast_cover[0]['data'];
					} else {
						$podcast_cover = $feed->get_channel_tags( SIMPLEPIE_NAMESPACE_GOOGLE_PLAY, 'image' );
						if ( ! empty( $podcast_cover ) && isset( $podcast_cover[0] ) && isset( $podcast_cover[0]['data'] ) ) {
							$podcast_cover_image = $podcast_cover[0]['data'];
						}
					}
				}
				if ( isset( $podcast_cover_image ) ) {
					// podcast cover in the Media Library.
					if ( $import_attachments ) {
						if ( ! function_exists( 'media_handle_sideload' ) ) {
							require_once ABSPATH . 'wp-admin/includes/image.php';
							require_once ABSPATH . 'wp-admin/includes/file.php';
							require_once ABSPATH . 'wp-admin/includes/media.php';
						}
						$file_array = array();
						preg_match( '/[^\?]+\.(jpg|jpe|jpeg|gif|png)/i', $podcast_cover_image, $matches );
						$file_array['name'] = basename( $matches[0] );

						// check if attachment exists.
						$attachment_args  = array(
							'posts_per_page' => 1,
							'post_type'      => 'attachment',
							'post_mime_type' => 'image',
							'name'           => basename( $matches[0], '.' . $matches[1] ),
						);
						$attachment_check = new Wp_Query( $attachment_args );
						if ( $attachment_check->have_posts() ) {
							if ( $verbose ) {
								echo '<p><em>' . esc_html( $file_array['name'] ) . '</em> already exists in the Media Library...</p>';
							}
							$podcast_cover_image = wp_get_attachment_url( $attachment_check->post->ID );
						} else {
							if ( $verbose ) {
								echo '<p>Downloading the <em>' . esc_html( $file_array['name'] ) . '</em> file...</p>';
							}
							$tmp                    = download_url( $podcast_cover_image );
							$file_array['tmp_name'] = $tmp;
							if ( is_wp_error( $tmp ) ) {
								if ( $verbose ) {
									echo '<p>' . sprintf( esc_html__( 'There was an error downloading %1$s: %2$s...', 'sonaar' ), esc_html( $file_array['name'] ), esc_html( $tmp->get_error_message() ) ) , '</p>';
								}
								$file_array['tmp_name'] = '';
							} else {
								$attachment_id = media_handle_sideload( $file_array, 0, basename( $matches[0], '.' . $matches[1] ) );
								if ( is_wp_error( $attachment_id ) ) {
									if ( $verbose ) {
										echo '<p>' . sprintf( esc_html__( 'There was an error uploading %1$s: %2$s...', 'sonaar' ), esc_html( $file_array['name'] ), esc_html( $attachment_id->get_error_message() ) ) , '</p>';
									}
									unlink( $file_array['tmp_name'] ); 
								} else {
									$podcast_cover_image = wp_get_attachment_url( $attachment_id );
								}
							}
						}
					}
					update_ironMusic_option($podcast_cover_image, 'srpodcast_data_image', '_iron_music_podcast_feed_options');
					
				}

				// import owner details.
				$podcast_owner = $feed->get_channel_tags( SIMPLEPIE_NAMESPACE_ITUNES, 'owner' );
				if ( ! empty( $podcast_owner ) && isset( $podcast_owner[0] ) && isset( $podcast_owner[0]['child'] ) && isset( $podcast_owner[0]['child'][ SIMPLEPIE_NAMESPACE_ITUNES ] ) ) {
					$podcast_owner = $podcast_owner[0]['child'][ SIMPLEPIE_NAMESPACE_ITUNES ];
					if ( isset( $podcast_owner['name'] ) && isset( $podcast_owner['name'][0] ) && isset( $podcast_owner['name'][0]['data'] ) ) {
						update_ironMusic_option($podcast_owner['name'][0]['data'], 'srpodcast_data_owner_name', '_iron_music_podcast_feed_options');
						
					}
					if ( isset( $podcast_owner['email'] ) && isset( $podcast_owner['email'][0] ) && isset( $podcast_owner['email'][0]['data'] ) ) {
						update_ironMusic_option($podcast_owner['email'][0]['data'] , 'srpodcast_data_owner_email', '_iron_music_podcast_feed_options');
						
					}
				} else {
					$podcast_author = $feed->get_channel_tags( SIMPLEPIE_NAMESPACE_GOOGLE_PLAY, 'author' );
					if ( ! empty( $podcast_author ) && isset( $podcast_author[0] ) && isset( $podcast_author[0]['data'] ) ) {
						update_ironMusic_option($podcast_author[0]['data'], 'srpodcast_data_author', '_iron_music_podcast_feed_options');
						
					}
					$podcast_owner = $feed->get_channel_tags( SIMPLEPIE_NAMESPACE_GOOGLE_PLAY, 'email' );
					if ( ! empty( $podcast_owner ) && isset( $podcast_owner[0] ) && isset( $podcast_owner[0]['data'] ) ) {
						update_ironMusic_option($podcast_owner[0]['data'], 'srpodcast_data_owner_email', '_iron_music_podcast_feed_options');
						
					}
				}

				// import language.
				$tmp_lang = $feed->get_language();
				if ( ! empty( $tmp_lang ) ) {
					update_ironMusic_option($tmp_lang, 'srpodcast_data_language', '_iron_music_podcast_feed_options' );
				}
				// import copyright statement.
				$tmp_copyright = $feed->get_copyright();
				if ( ! empty( $tmp_copyright ) ) {
					update_ironMusic_option($tmp_copyright, 'srpodcast_data_copyright', '_iron_music_podcast_feed_options');
				}

				// import explicit option.
				$podcast_explicit = $feed->get_channel_tags( SIMPLEPIE_NAMESPACE_ITUNES, 'explicit' );
				if ( ! empty( $podcast_explicit ) && isset( $podcast_explicit[0] ) && isset( $podcast_explicit[0]['data'] ) ) {
					if ( 'yes' === $podcast_explicit[0]['data'] ) {
						update_ironMusic_option('on', 'srpodcast_explicit', '_iron_music_podcast_feed_options');
						
					} else {
						//todo
						delete_option( 'srpodcast_explicit' );
					}
				} else {
					$podcast_explicit = $feed->get_channel_tags( SIMPLEPIE_NAMESPACE_GOOGLE_PLAY, 'explicit' );
					if ( ! empty( $podcast_explicit ) && isset( $podcast_explicit[0] ) && isset( $podcast_explicit[0]['data'] ) ) {
						if ( 'Yes' === $podcast_explicit[0]['data'] ) {
							update_ironMusic_option('on', 'srpodcast_explicit', '_iron_music_podcast_feed_options');
							
						} else {
							//todo
							delete_option( 'srpodcast_explicit' );
						}
					}
				}

				// import complete option.
				$podcast_complete = $feed->get_channel_tags( SIMPLEPIE_NAMESPACE_ITUNES, 'complete' );
				if ( ! empty( $podcast_complete ) && isset( $podcast_complete[0] ) && isset( $podcast_complete[0]['data'] ) ) {
					if ( 'yes' === $podcast_complete[0]['data'] ) {
						update_ironMusic_option('on', 'srpodcast_complete', '_iron_music_podcast_feed_options');
						
					} else {
						//todo
						delete_option( 'srpodcast_complete' );
					}
				}

				// import episode order option.
				$podcast_consume_order = $feed->get_channel_tags( SIMPLEPIE_NAMESPACE_ITUNES, 'type' );
				if ( ! empty( $podcast_consume_order ) && isset( $podcast_consume_order[0] ) && isset( $podcast_consume_order[0]['data'] ) ) {
					update_ironMusic_option($podcast_consume_order[0]['data'], 'srpodcast_consume_order', '_iron_music_podcast_feed_options');
					
				}

				// import iTunes categories.
				//todo
				$podcast_categories = $feed->get_channel_tags( SIMPLEPIE_NAMESPACE_ITUNES, 'category' );
				if ( ! empty( $podcast_categories ) && isset( $podcast_categories[0] ) ) {
					$category_index = 0;
					foreach ( $podcast_categories as $category_data ) {
						$category_value = '';
						if ( isset( $category_data['attribs'] ) && count( $category_data['attribs'] ) > 0 ) {
							$attribs = array_values( $category_data['attribs'] )[0];
							if ( count( $attribs ) > 0 && isset( $attribs['text'] ) ) {
								$category_value = $attribs['text'];
								$category_index++;
							}
						}
						if ( ! empty( $category_value ) && isset( $category_data['child'] ) && count( $category_data['child'] ) > 0 ) {
							$child_data = array_values( $category_data['child'] )[0];
							if ( count( $child_data ) > 0 && isset( $child_data['category'] ) && count( $child_data['category'] ) > 0 ) {
								$subcategory_data = $child_data['category'][0];
								if ( isset( $subcategory_data['attribs'] ) && count( $subcategory_data['attribs'] ) > 0 ) {
									$sub_attribs = array_values( $subcategory_data['attribs'] )[0];
									if ( count( $sub_attribs ) > 0 && isset( $sub_attribs['text'] ) ) {
										$category_value = $category_value . '|' . $sub_attribs['text'];
									}
								}
							}
						}
						if ( ! empty( $category_value ) ) {
							switch ( $category_index ) {
								case 1:
									update_ironMusic_option($category_value, 'srpodcast_data_category', '_iron_music_podcast_feed_options');
									delete_option( 'srpodcast_data_category2' );
									delete_option( 'srpodcast_data_category3' );
									break;

								case 2:
									update_ironMusic_option($category_value, 'srpodcast_data_category2', '_iron_music_podcast_feed_options');
									delete_option( 'srpodcast_data_category3' );
									break;

								case 3:
									update_ironMusic_option($category_value, 'srpodcast_data_category3', '_iron_music_podcast_feed_options');
									break;
							}
						}
					}
				}
			}

			if ( $verbose && $feed->get_item_quantity() > 0 ) {
				echo '<p>' . sprintf( _n( 'Checking %s RSS item...', 'Checking %s RSS items...', $feed->get_item_quantity(), 'sonaar' ), '<strong>' . esc_html( $feed->get_item_quantity() ) . '</strong>' ) . '<p>';
			}

			$item_inserted_count = 0;
			$item_updated_count  = 0;
			$item_skipped_count  = 0;
			$items               = $feed->get_items();
			foreach ( $items as $item ) {
				
				$post_title = htmlspecialchars_decode($item->get_title());
				$post_title = str_replace( array("&#039;", "&amp;"), array("'", "&"), $post_title);
				
				$episode_audio_file = '';
				$enclosures = $item->get_enclosures();
				if ( sizeof( $enclosures ) > 1 ) {
					foreach ( $enclosures as $enclosure ) {
						$enclosure_type = $enclosure->get_type();
						if ( $enclosure_type && stripos( $enclosure_type, 'audio' ) !== false) {
							$episode_audio_file = $enclosure->get_link();
						}
					}
				} else {
					$episode_audio_file = $item->get_enclosure(0)->get_link();
				}
				/* Fixed audio file url issue with achor.fm podcast feed */
				if( strpos( $episode_audio_file, 'anchor.fm') !== false){
					$audio_file = explode( 'https://',$episode_audio_file);
					if ( isset($audio_file['2']) && $audio_file['2'] != '' ) {
						$episode_audio_file = 'https://' . $audio_file[1] . urlencode('https://' . $audio_file['2']);
					}
				}
				
				$episode_audio_file = esc_sql( str_replace( '?ref=feed', '', $episode_audio_file ) );
		

				// ignore items that have no enclosure.
				if ( empty( $episode_audio_file ) ) {
					if ( $verbose ) {
						echo '<p>' . sprintf( esc_html__( 'No enclosure tag found in %1$s...', 'sonaar' ), '<em>' . esc_html( $post_title ) . '</em>' ) . '<p>';
					}
					$item_skipped_count++;
					continue;
				}


				
				$meta_input = array( 'stream_link' => $episode_audio_file );
				$meta_input['FileOrStreamPodCast'] = 'stream';
				
				if ( ! empty( $enclosure->length ) ) {
					$meta_input['episode_audio_file_size'] = (int) $enclosure->length;
				}
				$episode_duration = $item->get_item_tags( SIMPLEPIE_NAMESPACE_ITUNES, 'duration' );
				if ( ! empty( $episode_duration ) ) {
					if (strpos($episode_duration[0]['data'],':') !== false) {
						$episode_audio_file_duration = $episode_duration[0]['data'];
					}else{
						$file_duration_secs          = $episode_duration[0]['data'];
						$hours                       = floor( $file_duration_secs / 3600 ) . ':';
						$minutes                     = substr( '00' . floor( ( $file_duration_secs / 60 ) % 60 ), -2 ) . ':';
						$seconds                     = substr( '00' . $file_duration_secs % 60, -2 );
						$episode_audio_file_duration = ltrim( $hours . $minutes . $seconds, '0:0' );
					}
				}			
				if ( ! empty( $episode_audio_file_duration ) && '0' !== $episode_audio_file_duration ) {
					$meta_input['podcast_track_length'] = $episode_audio_file_duration;
				}
				$episode_type = $item->get_item_tags( SIMPLEPIE_NAMESPACE_ITUNES, 'episodeType' );
				if ( ! empty( $episode_type ) && isset( $episode_type[0] ) && isset( $episode_type[0]['data'] ) ) {
					$meta_input['podcast_itunes_episode_type'] = $episode_type[0]['data'];
				}
				$episode_number = $item->get_item_tags( SIMPLEPIE_NAMESPACE_ITUNES, 'episode' );
				if ( ! empty( $episode_number ) && isset( $episode_number[0] ) && isset( $episode_number[0]['data'] ) ) {
					$meta_input['podcast_itunes_episode_number'] = $episode_number[0]['data'];
				}
				$episode_season_number = $item->get_item_tags( SIMPLEPIE_NAMESPACE_ITUNES, 'season' );
				if ( ! empty( $episode_season_number ) && isset( $episode_season_number[0] ) && isset( $episode_season_number[0]['data'] ) ) {
					$meta_input['podcast_itunes_season_number'] = $episode_season_number[0]['data'];
				}
				$episode_title = $item->get_item_tags( SIMPLEPIE_NAMESPACE_ITUNES, 'title' );
				if ( ! empty( $episode_title ) && isset( $episode_title[0] ) && isset( $episode_title[0]['data'] ) ) {
					$meta_input['podcast_itunes_episode_title'] = $episode_title[0]['data'];
				}
				$episode_explicit = $item->get_item_tags( SIMPLEPIE_NAMESPACE_ITUNES, 'explicit' );
				if ( ! empty( $episode_explicit ) && isset( $episode_explicit[0] ) && isset( $episode_explicit[0]['data'] ) && 'yes' === $episode_explicit[0]['data'] ) {
					$meta_input['podcast_explicit_episode'] = 1;
				} else {
					$episode_explicit = $item->get_item_tags( SIMPLEPIE_NAMESPACE_GOOGLE_PLAY, 'explicit' );
					if ( ! empty( $episode_explicit ) && isset( $episode_explicit[0] ) && isset( $episode_explicit[0]['data'] ) && 'Yes' === $episode_explicit[0]['data'] ) {
						$meta_input['podcast_explicit_episode'] = 1;
					}
				}
				$episode_block = $item->get_item_tags( SIMPLEPIE_NAMESPACE_ITUNES, 'block' );
				if ( ! empty( $episode_block ) && isset( $episode_block[0] ) && isset( $episode_block[0]['data'] ) && 'yes' === $episode_block[0]['data'] ) {
					$meta_input['podcast_itunes_notshow'] = 1;
				} else {
					$episode_block = $item->get_item_tags( SIMPLEPIE_NAMESPACE_GOOGLE_PLAY, 'explicit' );
					if ( ! empty( $episode_block ) && isset( $episode_block[0] ) && isset( $episode_block[0]['data'] ) && 'yes' === $episode_block[0]['data'] ) {
						$meta_input['podcast_itunes_notshow'] = 1;
					}
				}

				$gm_date       = $item->get_gmdate();
				$post_date_gmt = strtotime( $gm_date );
				$post_date_gmt = gmdate( 'Y-m-d H:i:s', $post_date_gmt );
				$post_date     = get_date_from_gmt( $post_date_gmt );
				//$post_content  = esc_sql( str_replace( "\r\n", '', $item->get_content() ) );
				//$post_excerpt  = esc_sql( str_replace( "\r\n", '', $item->get_description() ) );
				$post_content  = ( $item->get_content() ) ? $item->get_content() : ''; // make sure post content does not return null for database insert
				$post_excerpt  = $item->get_description();



				$post_id = self::episode_exists( $post_title );
				$new_post_id = '';
				//echo $post_title . " == " . $post_id . "\r\n";
				//$post_id = post_exists( $post_title );
				if ( empty( $post_id ) ) {
					// insert new post.
					$guid        = substr( esc_sql( $item->get_id() ), 0, 250 );
					$post_status = 'publish';
					$post_type   = 'podcast';
					$post        = compact( 'post_title', 'post_date', 'post_date_gmt', 'post_content', 'post_excerpt', 'post_status', 'post_type', 'guid', 'meta_input');
					$post_id = $new_post_id = wp_insert_post( apply_filters( 'sonaar_helper_import_before_insert_post', $post ), true );

					if ( $new_post_id && ! is_wp_error( $new_post_id ) ) {
						if ( $import_category ) {
							// set the assigned category
							wp_set_object_terms($new_post_id, array( (int)$import_category ), 'podcast-category');
						}
						if ( $verbose ) {
							echo '<p>' . sprintf( esc_html__( 'Adding the %1$s podcast...', 'sonaar' ), '<em>' . esc_html( $post_title ) . '</em>' ) . '<p>';
						}
						$item_inserted_count++;
					} else {
						if ( $verbose ) {
							echo '<p>' . sprintf( esc_html__( 'Error occured while inserting the %1$s podcast: %2$s...', 'sonaar' ), '<em>' . esc_html( $post_title ) . '</em>', esc_html( $new_post_id->get_error_message() ) ) . '<p>';
						}
					}
				} elseif ( ! $cron_job ) {
					
					// update existent post media files.
					$post        = compact( 'ID', 'post_content', 'post_excerpt', 'meta_input' );
					$post['ID']  = $post_id;
					$new_post_id = wp_update_post( apply_filters( 'sonaar_helper_import_before_insert_post', $post ), true );
					if ( $new_post_id && ! is_wp_error( $new_post_id ) ) {
						if ( $verbose ) {

							echo '<p>' . sprintf( esc_html__( 'Updating the %1$s podcast audio URL...', 'sonaar' ), '<em>' . esc_html( $post_title ) . '</em>' ) . '<p>';
						}
						$item_updated_count++;
					} else {
						if ( $verbose ) {
							echo '<p>' . sprintf( esc_html__( 'Error occured while updating the %1$s podcast: %2$s...', 'sonaar' ), '<em>' . esc_html( $post_title ) . '</em>', esc_html( $new_post_id->get_error_message() ) ) . '<p>';
						}
					}
				}
		
				// download attachment to the Media Library
				if ( isset( $new_post_id ) && $new_post_id != '' && ! is_wp_error( $new_post_id ) && $import_attachments ) {
					
					/* Check Post Thumbnail Set Then new image not assign */
					if ( has_post_thumbnail( $new_post_id ) ) {
						continue;
					}
					
					$item_image_data = $item->get_item_tags( SIMPLEPIE_NAMESPACE_ITUNES, 'image' );
					if ( ! empty( $item_image_data ) && isset( $item_image_data[0] ) && isset( $item_image_data[0]['attribs'] ) && isset( $item_image_data[0]['attribs'][''] ) && isset( $item_image_data[0]['attribs']['']['href'] ) ) {
						$item_image = $item_image_data[0]['attribs']['']['href'];
					} else {
						$item_image_data = $item->get_item_tags( SIMPLEPIE_NAMESPACE_GOOGLE_PLAY, 'image' );
						if ( ! empty( $item_image_data ) && isset( $item_image_data[0] ) && isset( $item_image_data[0]['attribs'] ) && isset( $item_image_data[0]['attribs'][''] ) && isset( $item_image_data[0]['attribs']['']['href'] ) ) {
							$item_image = $item_image_data[0]['attribs']['']['href'];
						}
					}
					if ( isset( $item_image ) ) {
						if ( ! function_exists( 'media_handle_sideload' ) ) {
							require_once( ABSPATH . 'wp-admin/includes/image.php' );
							require_once( ABSPATH . 'wp-admin/includes/file.php' );
							require_once( ABSPATH . 'wp-admin/includes/media.php' );
						}
						$file_array = array();
						preg_match( '/[^\?]+\.(jpg|jpe|jpeg|gif|png)/i', $item_image, $matches );
						$file_array['name'] = basename( $matches[0] );

						// check if attachment already exists.
						$attachment_args  = array(
							'posts_per_page' => 1,
							'post_type'      => 'attachment',
							'post_mime_type' => 'image',
							'name'           => basename( $matches[0], '.' . $matches[1] ),
						);
						$attachment_check = new Wp_Query( $attachment_args );
						
						if ( $attachment_check->have_posts() ) {
							if ( $verbose ) {
								echo '<p><em>' . esc_html( $file_array['name'] ) . '</em> already exists in the Media Library...</p>';
							}
							set_post_thumbnail( $post_id, $attachment_check->post->ID );
							continue;
						} else {
							if ( $verbose ) {
								echo '<p>Downloading the <em>' . esc_html( $file_array['name'] ) . '</em> file...</p>';
							}
						}
						$tmp                    = download_url( $item_image );
						$file_array['tmp_name'] = $tmp;
						if ( is_wp_error( $tmp ) ) {
							if ( $verbose ) {
								echo '<p>' . sprintf( esc_html__( 'There was an error downloading %1$s: %2$s...', 'sonaar' ), esc_html( $file_array['name'] ), esc_html( $tmp->get_error_message() ) ) , '</p>';
							}
							$file_array['tmp_name'] = '';
							continue;
						}
						
						$attachment_id = media_handle_sideload( $file_array, $new_post_id, basename( $matches[0], '.' . $matches[1] ) );
						if ( is_wp_error( $attachment_id ) ) {
							if ( $verbose ) {
								echo '<p>' . sprintf( esc_html__( 'There was an error uploading %1$s: %2$s...', 'sonaar' ), esc_html( $file_array['name'] ), esc_html( $attachment_id->get_error_message() ) ) , '</p>';
							}
							unlink( $file_array['tmp_name'] );
							continue;
						}
						set_post_thumbnail( $post_id, $attachment_id );
					}
				}
			}
			$results = '';
			if ( $item_inserted_count > 0 ) {
				$results .= sprintf( esc_html( _n( '%s podcast', '%s podcasts', $item_inserted_count, 'sonaar' ) ), '<strong>' . $item_inserted_count . '</strong>' ) . ' ' . __( 'added', 'sonaar' ) . ', ';
				wp_cache_flush();
			}
			if ( $item_updated_count > 0 ) {
				$results .= sprintf( esc_html( _n( '%s podcast', '%s podcasts', $item_updated_count, 'sonaar' ) ), '<strong>' . $item_updated_count . '</strong>' ) . ' ' . __( 'updated', 'sonaar' ) . ', ';
			}
			if ( $item_skipped_count > 0 ) {
				$results .= sprintf( esc_html( _n( '%s podcast', '%s podcasts', $item_skipped_count, 'sonaar' ) ), '<strong>' . $item_skipped_count . '</strong>' ) . ' ' . __( 'skipped', 'sonaar' );
			}
			if ( empty( $results ) ) {
				$results = esc_html__( 'no podcasts were found', 'sonaar' );
			}
			if ( $verbose ) {
				echo '<p>' . sprintf( esc_html__( 'Import finished: %s.', 'sonaar' ), rtrim( $results, ', ' ) ) . '<p>'; // sanitized above.
				echo '<p><a href="' . esc_url( admin_url( 'edit.php?post_type=podcast' ) ) . '">' . esc_html__( 'Browse Episodes', 'sonaar' ) . '</a> <a href="' . esc_url( admin_url( 'edit.php?post_type=podcast&page=podcast_settings' ) ) . '">' . esc_html__( 'Podcast Settings', 'sonaar' ) . '</a><p>';
			}
			return true;
		}

	}

	$sonaar_rss_import = new Sonaar_RSS_Import();
	register_importer( 'podcast-rss', __( 'Podcast RSS Feed', 'sonaar' ), __( 'Import podcast episodes and settings from an RSS feed.', 'sonaar' ), array( $sonaar_rss_import, 'dispatch' ) );
}
