<?php
/*
Plugin Name: Advanced Podcast Manager with HLS Support
Description: A podcast manager plugin to manage multiple podcasts with episodes and .m3u8 streaming support.
Version: 1.3
Author: Girish Kumar
*/
function spp_enqueue_styles() {
    wp_enqueue_style('spp-styles', plugins_url('/css/spp-styles.css', __FILE__));
  
}
add_action('wp_enqueue_scripts', 'spp_enqueue_styles');

function spp_enqueue_assets() {
    wp_enqueue_script('hls-js', 'https://cdn.jsdelivr.net/npm/hls.js@latest', array(), null, true);
    wp_enqueue_script('wavesurfer-js', 'https://unpkg.com/wavesurfer.js', array(), null, true);

    wp_add_inline_script('hls-js', "
        document.addEventListener('DOMContentLoaded', function() {
            const footerPlayer = document.getElementById('footer-audio');
            const minimizedPlayer = document.getElementById('spp-minimized-player');
            const closeButton = minimizedPlayer.querySelector('.close-btn');

            // Listen for play button clicks on episodes
            document.querySelectorAll('.spp-episode-play-button').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const episodeUrl = this.getAttribute('data-episode-url');

                    if (Hls.isSupported()) {
                        const hls = new Hls();
                        hls.loadSource(episodeUrl);
                        hls.attachMedia(footerPlayer);
                    } else {
                        footerPlayer.src = episodeUrl;
                    }

                    footerPlayer.play();
                    minimizedPlayer.style.display = 'flex'; // Show the minimized player
                });
            });

            // Close button functionality
            closeButton.addEventListener('click', function() {
                minimizedPlayer.style.display = 'none';
                footerPlayer.pause();
            });
        });
    ");
}
add_action('wp_enqueue_scripts', 'spp_enqueue_assets');





// Register custom post types for Podcasts and Episodes
function spp_register_podcast_post_types() {
    register_post_type('podcast', array(
        'public' => true,
        'label' => 'Podcasts',
        'menu_icon' => 'dashicons-album',
        'supports' => array('title', 'editor', 'thumbnail'),
    ));

    register_post_type('podcast_episode', array(
        'public' => true,
        'label' => 'Episodes',
        'menu_icon' => 'dashicons-microphone',
        'supports' => array('title', 'editor', 'thumbnail'),
    ));
}
add_action('init', 'spp_register_podcast_post_types');

// Add meta box for linking Episodes to Podcasts and for Episode URL
function spp_add_episode_meta_boxes() {
    add_meta_box(
        'spp_episode_details',
        'Episode Details',
        'spp_episode_meta_box_callback',
        'podcast_episode',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'spp_add_episode_meta_boxes');

// Meta box callback function with checkboxes for multiple podcast selection
function spp_episode_meta_box_callback($post) {
    wp_nonce_field('spp_save_episode_details', 'spp_episode_details_nonce');
    $selected_podcasts = get_post_meta($post->ID, '_spp_podcast_ids', true);
    $selected_podcasts = is_array($selected_podcasts) ? $selected_podcasts : array();
    $podcasts = get_posts(array('post_type' => 'podcast', 'numberposts' => -1));

    echo '<label>Select Podcasts:</label><br>';
    foreach ($podcasts as $podcast) {
        $checked = in_array($podcast->ID, $selected_podcasts) ? 'checked' : '';
        echo '<label><input type="checkbox" name="spp_podcast_ids[]" value="' . esc_attr($podcast->ID) . '" ' . $checked . '> ' . esc_html($podcast->post_title) . '</label><br>';
    }

    $url = get_post_meta($post->ID, '_spp_episode_url', true);
    echo '<label for="spp_episode_url">Enter .m3u8 URL:</label>';
    echo '<input type="text" id="spp_episode_url" name="spp_episode_url" value="' . esc_attr($url) . '" size="25" />';
}

// Save Episode Details (Podcast link and URL)

function spp_save_episode_details($post_id) {
    if (!isset($_POST['spp_episode_details_nonce']) || !wp_verify_nonce($_POST['spp_episode_details_nonce'], 'spp_save_episode_details')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['spp_podcast_ids'])) {
        $podcast_ids = array_map('sanitize_text_field', $_POST['spp_podcast_ids']);
        update_post_meta($post_id, '_spp_podcast_ids', $podcast_ids);
    } else {
        delete_post_meta($post_id, '_spp_podcast_ids');
    }
    if (isset($_POST['spp_episode_url'])) {
        update_post_meta($post_id, '_spp_episode_url', sanitize_text_field($_POST['spp_episode_url']));
    }
}
add_action('save_post', 'spp_save_episode_details');

// Shortcode to display a specific podcast with its episodes
function spp_podcast_display_shortcode($atts) {
    $atts = shortcode_atts(array('id' => null), $atts, 'podcast');
    if (!$atts['id']) {
        return 'Error: No podcast ID specified.';
    }

    // Display podcast details
    $podcast = get_post($atts['id']);
    if (!$podcast) return 'Podcast not found.';

   $output = '<div class="spp-podcast">';
    $output .= '<h2>' . esc_html($podcast->post_title) . '</h2>';
    if (has_post_thumbnail($podcast->ID)) {
        $output .= get_the_post_thumbnail($podcast->ID, 'medium');
    }
    $output .= '<div>' . apply_filters('the_content', $podcast->post_content) . '</div>';

    // Display episodes linked to this podcast
    $episodes = get_posts(array(
        'post_type' => 'podcast_episode',
        'meta_query' => array(
            array(
                'key' => '_spp_podcast_ids',
                'value' => '"' . $podcast->ID . '"',
                'compare' => 'LIKE'
            )
        ),
    ));

    if ($episodes) {
        $output .= '<h3>Episodes</h3><ul>';
        foreach ($episodes as $episode) {
            $output .= '<li>' . esc_html($episode->post_title) . spp_episode_player($episode->ID) . '</li>';
        }
        $output .= '</ul>';
    } else {
        $output .= '<p>No episodes available for this podcast.</p>';
    }

    $output .= '</div>';
    return $output;
}
add_shortcode('podcast', 'spp_podcast_display_shortcode');

// Function to generate the player for an episode
function spp_episode_player($episode_id) {
    $url = get_post_meta($episode_id, '_spp_episode_url', true);
    if (empty($url)) {
        return '<p>Error: No valid URL found for this episode.</p>';
    }

    // Return a play button linked to the footer player
return '<button class="spp-episode-play-button" data-episode-url="' . esc_url($url) . '">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-play" viewBox="0 0 16 16">
        <path d="M10.804 8.697l-5.482 3.696C4.737 12.751 4 12.37 4 11.697V4.303c0-.674.737-1.054 1.322-.697l5.482 3.696a.802.802 0 0 1 0 1.394z"/>
    </svg> Play Episode
</button>';


}





// Shortcode to list all podcasts with links to their individual pages
function spp_display_all_podcasts_shortcode() {
    // Query all podcasts
    $podcasts = get_posts(array(
        'post_type' => 'podcast',
        'numberposts' => -1
    ));

    if (empty($podcasts)) {
        return '<p>No podcasts found.</p>';
    }

    // Output podcast list
    $output = '<div class="spp-all-podcasts">';
    $output .= '<h2>All Podcasts</h2><ul>';
    foreach ($podcasts as $podcast) {
        $output .= '<li>';
        $output .= '<a href="' . get_permalink($podcast->ID) . '">' . esc_html($podcast->post_title) . '</a>';
        if (has_post_thumbnail($podcast->ID)) {
            $output .= get_the_post_thumbnail($podcast->ID, 'thumbnail');
        }
        $output .= '</li>';
    }
    $output .= '</ul></div>';

    return $output;
}
add_shortcode('all_podcasts', 'spp_display_all_podcasts_shortcode');

// Modify the single podcast template to display the cover image and episodes
function spp_display_episodes_for_podcast($content) {
    if (is_singular('podcast') && in_the_loop()) {
        global $post;

        // Get the podcast cover image
        $cover_image = get_the_post_thumbnail_url($post->ID, 'full');
        if ($cover_image) {
            $content = '<div class="spp-podcast-cover" style="background-image: url(' . esc_url($cover_image) . ');"></div>';
        }

         // Get all episodes for this podcast
        $episodes = get_posts(array(
            'post_type' => 'podcast_episode',
            'meta_query' => array(
                array(
                    'key' => '_spp_podcast_ids',
                    'value' => '"' . $post->ID . '"',
                    'compare' => 'LIKE'
                )
            ),
        ));

        // Display episodes below the podcast content
        if ($episodes) {
            $content .= '<div class="spp-episodes-list">';
            foreach ($episodes as $episode) {
                $episode_thumbnail = get_the_post_thumbnail_url($episode->ID, 'thumbnail');
                $episode_title = esc_html($episode->post_title);
                $episode_player = spp_episode_player($episode->ID);  // Add the audio player for each episode

                $content .= '<div class="spp-episode-item">';
                $content .= '<div class="spp-episode-thumbnail">';
                if ($episode_thumbnail) {
                    $content .= '<img src="' . esc_url($episode_thumbnail) . '" alt="' . esc_attr($episode_title) . '" />';
                }
                $content .= '</div>';
                $content .= '<div class="spp-episode-player">';
                $content .= '<h4>' . $episode_title . '</h4>';
                $content .= $episode_player;
                $content .= '</div>';
                $content .= '</div>';
            }
            $content .= '</div>';
        } else {
            $content .= '<p>No episodes available for this podcast.</p>';
        }
    }
    return $content;
}
add_filter('the_content', 'spp_display_episodes_for_podcast');




?><?php 
// Add Minimized Player in Footer
add_action('wp_footer', function() {
    ?>
   <div id="spp-minimized-player" 
     style="
         position: fixed; 
         bottom: 0; 
         left: 0; 
         width: 100%; 
         background-image: url('https://podcast.eddy.one/wp-content/uploads/2024/11/sonic-spectrum-far-reaching-audio-frequencies-on-dark-background-ai-generated-free-photo.jpg'); 
         background-size: cover; 
         background-position: center; 
         padding: 10px; 
         color: #fff; 
         z-index: 9999; 
         display: none; 
         align-items: center; 
         justify-content: space-between;
         display: none;">


        <div>Now Playing...</div>
        <audio id="footer-audio" controls style="flex-grow: 1; max-width: 500px;">
            Your browser does not support the audio element.
        </audio>
        <button class="close-btn" style="margin-left: 10px; background: none; color: #fff; border: none; font-size: 1.5rem;">×</button>
    </div>
    <?php
});



?>