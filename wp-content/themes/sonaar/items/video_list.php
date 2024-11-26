<?php 
global $videoListArg;

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> data-url="<?php echo esc_url( Iron_sonaar::getField('video_url',$post->ID) ); ?>">
    <button class="sonaar-play-button" href="#">
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="12" height="12" x="0px" y="0px" viewBox="0 0 17.5 21.2" xml:space="preserve" class="sonaar-play-icon">
            <path d="M0,0l17.5,10.9L0,21.2V0z"></path> 
            <rect width="6" height="21.2"></rect>
            <rect x="11.5" width="6" height="21.2"></rect>
        </svg>
		<svg xmlns="http://www.w3.org/2000/svg" class="sonaar-play-circle" width="30" height="30">
			<circle r="40%" fill="none" stroke="black" stroke-width="6" cx="50%" cy="50%"></circle>
		</svg>
	</button>
    <header class="entry-header">
        <<?php echo $videoListArg['title_tag'] ?> class="sr_it-videolist-item-title"> <?php echo get_the_title($post->ID) ?> </<?php echo $videoListArg['title_tag'] ?>> 
    </header>
    <div class="entry-content">
        <div class="sr_it-videolist-item-artist">
        <?php
        $artistList = Iron_sonaar::getField('artist_of_video',$post->ID);
        if( $artistList != NULL){
            $artistNameList = array();
            foreach($artistList as $artistName) {
                array_push($artistNameList, get_the_title($artistName ));
            }
            $artistNameList = implode(', ', $artistNameList);
            echo wp_kses_post( $artistNameList ) ;
        }
        ?>
        </div>
        <div class="sr_it-videolist-item-date">
            <?php the_time('F j, Y'); ?>
        </div>
    </div>
</article>
