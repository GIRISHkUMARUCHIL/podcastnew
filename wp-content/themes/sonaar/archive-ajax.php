<?php
	if ( have_posts() ):
		while ( have_posts() ) : the_post();
			Iron_sonaar::getTemplatePart( $iron_sonaar_archive->getItemTemplate() );
		endwhile;
	else:
		echo '<div class="search-result"><h3>'. translateString('tr_Nothing_Found') .'</h3>';
		echo '<p>'. translateString('tr_Search_keyword') .': '. get_search_query() .'</p>';
		echo '<p>'. translateString('tr_nothing_matched') .'</p></div>';
	endif;

	echo esc_url( str_replace('<a ', '<a data-rel="post-list" '.implode(' ', $attr).' class="button-more" ', get_next_posts_link( translateString('tr_More') ) ) );
?>



