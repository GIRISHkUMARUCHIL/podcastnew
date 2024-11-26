<?php
	global $widget;
	$grid_post_thumbnail = wp_get_attachment_image_url(get_post_thumbnail_id( $post->ID ), 'large');
	$grid_release_date = Iron_sonaar::getField( 'alb_release_date', $post->ID );
	$grid_artist_of_album = get_field('artist_of_album', $post->ID );

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <a title="<?php echo get_the_title( $post->ID )?>" href="<?php echo get_the_permalink( $post->ID ) ?>">
    <img src="<?php echo $grid_post_thumbnail ?>"></img>
	    <div class="sr_it-hoverable">
		    <header class="entry-header">
		    	<span class="sr_it-meta">
		    		<?php if($grid_release_date):?>
		    		<time class="entry-date released"><?php echo $grid_release_date ?></time>
		    		<?php endif ?>
		    	</span>
		        <h1 class="sr_it-item-title"><?php echo get_the_title( $post->ID )?></h1>
		        <?php if( !empty($grid_artist_of_album) ):?>
		        <span class="author"><?php echo get_the_title( $grid_artist_of_album[0] ) ; ?></span>
		        <?php endif ?>
		    	<button><?php echo translateString('tr_listen'); ?></button>
		    </header>
	    </div>
    </a>
</article>