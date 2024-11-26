<?php

class Iron_sonaar_Archive{
	private $_post;
	private $_ID;
	private $_post_type;
	private $_wp_query;
	private $_paged;
	private $_postTypeObject;

	private $_pageForArchives;

	private $_itemTemplate ;
	private $_enableExcerpts;
	private $_eventsFilter;
	private $_linkMode;
	private $_pageTitleIsHidden;
	private $_hasSideBar;
	private $_sideBarPosition;
	private $_sideBarArea;
	private $_showPostDate;

	private $_isoCol;
	private $_tag;
	private $_class;
	private $_caption;
	private $_next;
	private $_prev;

	private $_attributes = array();

	private $_archiveTitle;
	private $_archiveContent;
	private $_paginateMethod;

	private $_taxonomy;
	private $_term;

	public function __construct(){
		// Set global
		global $post, $post_type, $wp_query;
		$this->_post =& $post;
		$this->_post_type = $post_type;
		$this->_wp_query =& $wp_query;
		$this->_paged = get_query_var('paged') ? get_query_var('paged') : 1;

	}

	public function compile(){
		$this->_postTypeObject = get_post_type_object( $this->_post_type );

		$archivePageName = ( 'post' == $this->getPostType() ) ? get_option('page_for_posts') : Iron_sonaar::getOption('page_for_' . $this->getPostType() . 's');
		$this->_pageForArchives = get_post( $archivePageName );


		if( !is_home() && isset( $this->_wp_query->queried_object->ID ) && $this->_pageForArchives = $this->_wp_query->queried_object->ID ) {
			list( $this->_hasSideBar, $this->_sideBarPosition, $this->_sideBarArea ) = Iron_sonaar::setupDynamicSidebar( $this->_pageForArchives );
		}else if($this->_post != NULL){
			list( $this->_hasSideBar, $this->_sideBarPosition, $this->_sideBarArea ) = Iron_sonaar::setupDynamicSidebar( $this->_post->ID );
		}

		if ( is_tax() ){
			$this->_taxonomy = get_query_var('taxonomy');
			$this->_term = get_term_by( 'slug', get_query_var('term'), $this->_taxonomy );
		} elseif ( is_category() ) {
			$this->_taxonomy = 'category';
			$this->_term = get_category( get_query_var('cat') );
		} elseif ( is_tag() ) {
			$taxonomy = 'post_tag';
			$this->_term = get_term_by( 'slug', get_query_var('tag'), $this->_taxonomy );
		}

		$this->_paginateMethod = Iron_sonaar::getOption('paginate_method', null, 'posts_nav_link');

		if ( $this->_paginateMethod == 'paginate_scroll' ){
			$this->_paginateMethod = "paginate_more";
		}

		if( ( is_home() || is_archive() ) && $this->_wp_query->queried_object ){
			switch ( Iron_sonaar::getOption( 'post_archive_default_template' ) ) {
				case 'archive-posts-list':
					$this->setItemTemplate('post');
					// $this->_enableExcerpts = false;
					break;
				
				default:
					$this->setItemTemplate('post_classic');
					if(isset( $this->_wp_query->queried_object->ID)){
						$this->_enableExcerpts = Iron_sonaar::getField('enable_excerpts', $this->_wp_query->queried_object->ID);
					}
					break;
			}
		}

		if($this->_post_type == 'podcast'){
			$this->setItemTemplate('podcast_list');
		}
		

		$this->setArchiveID();

		if( $this->_postTypeObject && ! empty( $this->_postTypeObject->label ) && !is_search() ){
			if ( isset($this->_wp_query->queried_object) && isset($this->_wp_query->queried_object->ID) ) {
				$this->_archiveTitle = get_the_title( $this->_wp_query->queried_object->ID );
				$this->_archiveContent = apply_filters('sonaar_content', $this->_wp_query->queried_object->post_content);

				$postId = $this->_wp_query->queried_object->ID;

			}else if($this->_post != NULL){
				$this->_archiveTitle = $archive_title = get_the_title( $this->_post->ID );
				$this->_archiveContent = apply_filters('sonaar_content', $this->_post->post_content);
				$postId = $this->_post->ID;

			}
			if(isset($postId)){
				$this->_pageTitleIsHidden = Iron_sonaar::getField('hide_page_title', $postId );
				switch($this->getPostType()){
					case 'post':
						$this->_enableExcerpts = Iron_sonaar::getField('enable_excerpts', $postId );
						break;
					case 'event':
						$this->_eventsFilter = Iron_sonaar::getField('events_filter', $postId );
						break;
				}
			}
		}


		switch ( $this->getPostType() ) {
			case 'post':
				$this->setupTypePost();
				break;

			case 'event':
				$this->setupTypeEvent();
				break;

			case 'album':
				$this->setupTypeAlbum();
				break;

			case 'video':
				$this->setupTypeVideo();
				break;

			case 'artist':
				$this->setupTypeAlbum();
				break;

			default:
				$this->_tag = 'div';
				$this->_class = 'post-listing';
				$this->_attributes[] = 'data-callback="initGridDisplayNews"';
				$this->_caption = esc_html__('Previous Posts','sonaar');
				$this->_next = esc_html__('Next Posts','sonaar');
				$this->_prev = esc_html__('Previous Posts','sonaar');
				break;
		}

		// $this->_wp_query->query_vars["is_archive"] = true;
		$this->initAttributes();

	}

	private function setArchiveID(){
		if($this->_post != null){
			$this->_ID = $this->_post->ID;
		}
	}

	private function setupTypePost(){
		$this->_tag = 'div';

		switch($this->getItemTemplate()){
			case 'post_classic':
				$this->_class = 'articles-classic';
				break;
			case 'post':
				$this->_class = 'listing-section news';
				break;
			default:
				$this->_class = 'listing-section news';
		}

		$this->_caption = esc_html__('Previous','sonaar');
		$this->_next = esc_html__('Previous','sonaar');
		$this->_prev = esc_html__('Next','sonaar');
	}

	private function setupTypeEvent(){
		if(empty($this->_archiveTitle)) { $this->_archiveTitle = $this->_postTypeObject->labels->name; }
		$this->_tag = 'section';
		$this->_class = 'concerts-list';
		$this->_attributes[] = 'data-active="' . ( empty($_GET['id']) ? '' : $_GET['id'] ) . '"';
		$this->_attributes[] = 'data-callback="initEventCenter,initCountdownCenter,initDisableTimers"';
		$this->_caption = esc_html__('More Events','sonaar');
		$this->_next = esc_html__('Next Events','sonaar');
		$this->_prev = esc_html__('Previous Events','sonaar');
	}

	private function setupTypeAlbum(){
		if(empty($this->_archiveTitle)) { $this->_archiveTitle = $this->_postTypeObject->labels->name; }
		$this->_tag = 'div';
		$this->_class = 'two_column_album';
		$this->_attributes[] = 'data-callback="initGridDisplayAlbum,initHeadsetCenter"';
		$this->_caption = esc_html__('More Albums','sonaar');
		$this->_next = esc_html__('Next Albums','sonaar');
		$this->_prev = esc_html__('Previous Albums','sonaar');
	}

	private function setupTypeVideo(){
		$this->_tag = 'div';
		$this->_class = 'listing-section videos';
		$this->_attributes[] = 'data-callback="initGridDisplayVideo,initVideoLinks"';
		$this->_caption = esc_html__('More Videos','sonaar');
		$this->_next = esc_html__('Next Videos','sonaar');
		$this->_prev = esc_html__('Previous Videos','sonaar');
	}

	public function setPostType( $value ){
		$this->_post_type = $value;
	}

	public function getPostType(){
		return $this->_post_type;
	}


	public function setItemTemplate( $value ){
		$this->_itemTemplate = $value;
	}

	public function setIsoCol( $value ){
		$this->_isoCol = $value;
	}

	public function getIsoCol(){
		return $this->_isoCol;
	}

	public function getItemTemplate(){
		if ( $this->_itemTemplate === null ){
			return $this->_post_type;
		}
		return $this->_itemTemplate;
	}

	public function initAttributes(){
		$this->_attributes[] = 'data-type="' . esc_attr( $this->getPostType() ) . '"';
		$this->_attributes[] = 'data-page="' . esc_attr( $this->_paged ) . '"';
		if ( ! empty($this->_term) && ! is_wp_error( $this->_term ) ){
			$this->_attributes[] = 'data-taxonomy="' . $this->_taxonomy . '"';
			$this->_attributes[] = 'data-term="' . $this->_term->term_id . '"';
		}

		$this->_attributes[] = 'data-paginate="' . esc_attr($this->getPaginateMethod()) . '"';
		$this->_attributes[] = 'data-template="' . esc_attr($this->getItemTemplate()) . '"';
		$this->_attributes[] = 'data-excerpts="' . esc_attr($this->_enableExcerpts) . '"';
		$this->_attributes[] = 'data-postdate="' . esc_attr($this->_showPostDate) . '"';
		$this->_attributes[] = 'data-eventsfilter="' . esc_attr($this->_eventsFilter) . '"';
		$this->_attributes[] = 'data-isocol="' . esc_attr($this->_isoCol) . '"';
		$this->_attributes[] = 'data-caption="' . esc_attr($this->_caption) . '"';
	}

	public function getAttributesList(){
		return implode(' ', $this->_attributes );
	}

	public function getPaginateMethod(){
		return $this->_paginateMethod;
	}

	public function getArchiveTitle(){
		if ( ! empty($this->_term) && ! is_wp_error( $this->_term ) ){
			return $this->_term->name;
		}

		if ( is_day() ){
			return $this->_archiveTitle = sprintf( esc_html__('Daily Archives: %s', 'sonaar'), get_the_date() );
		}

		if ( is_month() ) {
			return $this->_archiveTitle = sprintf( esc_html__('Monthly Archives: %s', 'sonaar'), get_the_date( esc_html_x('F Y', 'monthly archives date format', 'sonaar') ) );
		}

		if ( is_year() ) {
			return $this->_archiveTitle = sprintf( esc_html__('Yearly Archives: %s', 'sonaar'), get_the_date( esc_html_x('Y', 'yearly archives date format', 'sonaar') ) );
		}

		if ( is_search() || !empty($_GET["s"])) {
			return $this->_archiveTitle = sprintf( esc_html__('Search Results', 'sonaar'));
		}
		if ( is_author() ){
			$iron_sonaar_author = ( $this->_post )? $this->_post->post_author : $this->_wp_query->get_queried_object()->ID;
			return $this->_archiveTitle = get_the_author_meta( 'nicename', $iron_sonaar_author );
		}

		if ( is_tag() ) {
			return $this->_archiveTitle = $this->_wp_query->query['tag'];
		}
		if ( is_home() ) {
			return $this->_archiveTitle = '';
		}
		return $this->_post->post_title;

	}

	public function getArchiveID(){
		return $this->_ID;
	}

	public function get404message(){
		switch ( $this->getPostType() ) {
			case 'event':
				echo '<div class="search-result"><h3>'.esc_html__('No events at this time', 'sonaar').'</h3>';
				echo '<p>'.esc_html__('Check back at a later time', 'sonaar').'</p></div>';
				break;

			default:
					echo '<div class="search-result"><h3>'. translateString('tr_Nothing_Found') .'</h3>';
					echo '<p>'. translateString('tr_Search_keyword') .': '.get_search_query().'</p>';
					echo '<p>'. translateString('tr_nothing_matched') .'</p></div>';
				break;
		}
	}

	public function getArchiveContent(){
		if( is_day() || is_month() || is_year() || is_search() || is_home() || is_archive() || is_tax() || is_category() || is_tag() ){
			return '';
		}
		return $this->_archiveContent;
	}

	public function hasTitle(){
		return !$this->_pageTitleIsHidden;
	}

	public function hasSidebar(){
		return (bool)$this->_hasSideBar;
	}

	public function getSideBarPosition(){
		return $this->_sideBarPosition;
	}

	public function getSideBarArea(){
		return $this->_sideBarArea;
	}

	public function getTag(){
		return $this->_tag;
	}

	public function getClass(){
		return $this->_class;
	}


	public function getPrev(){
		return $this->_prev;
	}

	public function getNext(){
		return $this->_next;
	}

	public function displayDate(){
		return $this->_showPostDate;
	}

	public function enableExcerpts(){
		return $this->_enableExcerpts;
	}

	public function changeQuery(){
		// Prevent extra database query by enabling permalink structure
		if ( $this->_post_type !== get_post_type() ){
			if( empty($_GET["s"]) ) {
				$this->_pageForArchives = $this->_post;
				query_posts( array('post_type' => $this->_post_type, 'paged' => $this->_paged ) );
			}
		}
	}
}