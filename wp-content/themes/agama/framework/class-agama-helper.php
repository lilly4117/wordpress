<?php 

// Do not allow direct access to the file.
if( ! defined( 'ABSPATH' ) ) exit;

/**
 * Agama Helper Class
 *
 * @since 1.2.9
 */
class Agama_Helper {
	
	/**
	 * Render Agama Header
	 *
	 * @since 1.2.9
	 */
	public static function get_header() {
		$header = esc_attr( get_theme_mod( 'agama_header_style', 'transparent' ) );
		switch( $header ):
			case 'transparent':
				get_template_part( 'framework/headers/header-transparent' );
			break;
			case 'sticky':
				get_template_part( 'framework/headers/header-sticky' );
			break;
			case 'default':
				get_template_part( 'framework/headers/header-default' );
			break;
		endswitch;
	}
	
	/**
	 * Render Agama Header Image
	 *
	 * @since 1.2.9
	 */
	public static function get_header_image() {
		$particles = esc_attr( get_theme_mod( 'agama_header_image_particles', true ) );
		if ( get_header_image() ) {
			echo '<div id="agama-header-image">';
				if( $particles ) {
					echo '<div id="particles-js" class="agama-particles"></div>';
				}
				echo '<a href="'. esc_url( home_url( '/' ) ) .'">';
					echo '<img src="'. esc_url( get_header_image() ) .'" class="header-image" width="'. esc_attr( get_custom_header()->width ) .'" height="'. esc_attr( get_custom_header()->height ) .'" alt="'. esc_attr( get_bloginfo( 'name', 'display' ) ) .'" />';
				echo '</a>';
			echo '</div>';
		}
	}
	
	/**
	 * Render Agama Slider
	 *
	 * @since 1.2.9
	 */
	public static function get_slider() {
		Agama_Slider::init();
	}
	
	/**
	 * Render Agama Breadcrumb
	 *
	 * @since 1.2.9
	 */
	public static function get_breadcrumb() {
		Agama_Breadcrumb::init();
	}
	
	/**
	 * Render Agama Frontpage Boxes
	 *
	 * @since 1.2.9
	 */
	public static function get_front_page_boxes() {
		Agama_Front_Page_Boxes::init();
	}
	
	/**
	 * Data Animate
	 *
	 * @since 1.2.8
	 */
	public static function get_data_animated() {
		$animated  = esc_attr( get_theme_mod( 'agama_blog_posts_load_animated', true ) );
		$animation = esc_attr( get_theme_mod( 'agama_blog_posts_load_animation', 'bounceInUp' ) );
		
		if( $animated && ! is_single() ) {
			echo ' data-animate="'. $animation .'" data-delay="100"';
		}
	}
	
	/**
	 * Generate Footer Widgets Bootstrap Class
	 *
	 * @since 1.2.9
	 */
	public static function get_fwidgets_bs_class() {
		$count = 0;
		if( is_active_sidebar( 'footer-widget-1' ) ) {
			$count++;
		}
		if( is_active_sidebar( 'footer-widget-2' ) ) {
			$count++;
		}
		if( is_active_sidebar( 'footer-widget-3' ) ) {
			$count++;
		}
		if( is_active_sidebar( 'footer-widget-4' ) ) {
			$count++;
		}
		switch( $count ) {
			case '1':
				echo esc_attr( 'col-md-12' );
			break;
			case '2':
				echo esc_attr( 'col-md-6' );
			break;
			case '3':
				echo esc_attr( 'col-md-4' );
			break;
			case '4':
				echo esc_attr( 'col-md-3' );
			break;
		}
	}
	
	/**
	 * Convert hexdec color string to rgb(a) string.
	 *
	 * @since 1.2.9
	 */
	public static function hex2rgba( $color, $opacity = false ) {
		$default = 'rgb(0,0,0)';
 
		//Return default if no color provided
		if( empty( $color ) )
			  return $default; 
	 
		//Sanitize $color if "#" is provided 
		if( $color[0] == '#' ) {
			$color = substr( $color, 1 );
		}
 
		//Check if color has 6 or 3 characters and get values
		if( strlen( $color ) == 6) {
			$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
		} elseif( strlen( $color ) == 3 ) {
			$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
		} else {
			return $default;
		}
 
		// Convert hexadec to rgb
		$rgb = array_map( 'hexdec', $hex );
 
		//Check if opacity is set(rgba or rgb)
		if( $opacity ){
			if( abs( $opacity ) > 1)
				$opacity = 1.0;
			$output = 'rgba('. implode(",",$rgb) .','. $opacity .')';
		} else {
			$output = 'rgb('. implode(",",$rgb) .')';
		}
 
		//Return rgb(a) color string
		return $output;
	}
	
	/**
	 * Get Agama Blue Contents
	 *
	 * @since 1.2.9.1
	 */
	public static function get_agama_blue_contents() {
		if( has_action( 'agama_blue_contents' ) )
			do_action( 'agama_blue_contents' );
	}
}