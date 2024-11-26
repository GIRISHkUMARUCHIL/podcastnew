<?php
get_template_part('admin/options/fields/select/field_select');
class Redux_Options_posts_select extends Redux_Options_select {

    /**
     * Field Constructor.
     *
     * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
     *
     * @since Redux_Options 1.0.0
    */
    function __construct($field = array(), $value ='', $parent = array() ) {
        $this->field = $field;
		$this->value = $value;
		$this->args = $parent->args;

		$wp_args = wp_parse_args($this->field['args'], array('numberposts' => '-1', 'posts_per_page' => -1));

		if ( class_exists('Polylang') ) {
			$defaultLang = pll_default_language('slug');
			$wp_args = wp_parse_args($this->field['args'], array('numberposts' => '-1', 'suppress_filter' => true, 'lang' => $defaultLang ));
		}

		if ( class_exists('SitePress')) {
			global $sitepress;
			$currentLang = apply_filters( 'wpml_current_language', NULL );
			$defaultLang = apply_filters('wpml_default_language', NULL );
			$wp_args = wp_parse_args( $this->field['args'], array('numberposts' => '-1', 'suppress_filter' => true ));
			$sitepress->switch_lang($defaultLang);
		}

		$posts = get_posts($wp_args);

		$postsQuery = new WP_Query($wp_args);

		$this->field['options'][""] = esc_html__('- None -', 'sonaar');
		foreach ($postsQuery->posts as $post) {
			$this->field['options'][$post->ID] = $post->post_title;
		}

		if ( class_exists('SitePress')) {
			$sitepress->switch_lang($currentLang);
		}
    }
}
