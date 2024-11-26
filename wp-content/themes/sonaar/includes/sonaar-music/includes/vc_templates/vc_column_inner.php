<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $el_id
 * @var $width
 * @var $css
 * @var $offset
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Column_Inner
 */
$el_class = $width = $el_id = $css = $responsive_css = $bg_position = $bg_pos_h = $bg_pos_v = $zindex = $align = $offset = '';
$output = $bg_styles = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$width = wpb_translateColumnWidthToSpan( $width );
$width = vc_column_offset_class_merge( $offset, $width );

$css_classes = array(
	$this->getExtraClass( $el_class ),
	'wpb_column',
	'vc_column_container',
	$width,
	$align
);

if ( vc_shortcode_custom_css_has_property( $css, array(
	'border',
	'background',
) ) ) {
	$css_classes[] = 'vc_col-has-fill';
}
if( ! empty( $responsive_css ) ) {
	$responsive_id = uniqid('sonaar-column-responsive-');
	$column_selector = $responsive_id . ' > .vc_column-inner';
	$responsive_style = Sonaar_Responsive_Options::generate_css( $responsive_css, $column_selector );
	$css_classes[] = $responsive_id;
}
$wrapper_attributes = array();

$col_styles = array();

if( 'custom' != $bg_position && ! empty( $bg_position ) ) {
	$bg_styles = 'background-position:' . esc_attr( $bg_position ) . ' !important; ';
}
elseif( 'custom' === $bg_position ) {
	$bg_styles = 'background-position:' . esc_attr( $bg_pos_h ) . ' ' . esc_attr( $bg_pos_v ) . ' !important; ';
}

$col_styles[] = 'style="' . esc_attr( trim( $bg_styles ) ) . '"';

$z_index_style = ! empty( $zindex ) ? 'style="z-index:' . esc_attr( $zindex ) . ';"' : '';
$wrapper_attributes[] = $z_index_style;


$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}
$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
$output .= '<div class="vc_column-inner ' . esc_attr( trim( vc_shortcode_custom_css_class( $css ) ) ) . '" ' . implode( ' ', $col_styles ) . '>';
$output .= '<div class="wpb_wrapper">';
$output .= wpb_js_remove_wpautop( $content );
$output .= '</div>';
$output .= '</div>';
$output .= '</div>';

if( ! empty( $responsive_style ) ) {
	$output .= '<script type="text/javascript">'
			. '(function($) {'
				. '$("head").append("<style>' . $responsive_style . '</style>");'
			. '})(jQuery);'
		. '</script>';
}

echo $output;
