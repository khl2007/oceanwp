<?php
/**
 * Footer Bottom Customizer Options
 *
 * @package OceanWP WordPress theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'OceanWP_Footer_Bottom_Customizer' ) ) :

	class OceanWP_Footer_Bottom_Customizer {

		/**
		 * Setup class.
		 *
		 * @since 1.0
		 */
		public function __construct() {

			add_action( 'customize_register', 	array( $this, 'customizer_options' ) );
			add_filter( 'ocean_head_css', 		array( $this, 'head_css' ) );

		}

		/**
		 * Customizer options
		 *
		 * @since 1.0.0
		 */
		public function customizer_options( $wp_customize ) {

			/**
			 * Section
			 */
			$section = 'ocean_footer_bottom_section';
			$wp_customize->add_section( $section , array(
				'title' 			=> esc_html__( 'Footer Bottom', 'oceanwp' ),
				'priority' 			=> 210,
			) );

			/**
			 * Enable Footer Bottom
			 */
			$wp_customize->add_setting( 'ocean_footer_bottom', array(
				'default'           	=> true,
				'sanitize_callback' 	=> false,
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'ocean_footer_bottom', array(
				'label'	   				=> esc_html__( 'Enable Footer Bottom', 'oceanwp' ),
				'type' 					=> 'checkbox',
				'section'  				=> $section,
				'settings' 				=> 'ocean_footer_bottom',
				'priority' 				=> 10,
			) ) );

			/**
			 * Footer Bottom Visibility
			 */
			$wp_customize->add_setting( 'ocean_bottom_footer_visibility', array(
				'transport' 			=> 'postMessage',
				'default'           	=> 'all-devices',
				'sanitize_callback' 	=> false,
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'ocean_bottom_footer_visibility', array(
				'label'	   				=> esc_html__( 'Visibility', 'oceanwp' ),
				'type' 					=> 'select',
				'section'  				=> $section,
				'settings' 				=> 'ocean_bottom_footer_visibility',
				'priority' 				=> 10,
				'active_callback' 		=> 'oceanwp_cac_has_footer_bottom',
				'choices' 				=> array(
					'all-devices' 			=> esc_html__( 'Show On All Devices', 'oceanwp' ),
					'hide-tablet' 			=> esc_html__( 'Hide On Tablet', 'oceanwp' ),
					'hide-mobile' 			=> esc_html__( 'Hide On Mobile', 'oceanwp' ),
					'hide-tablet-mobile' 	=> esc_html__( 'Hide On Tablet & Mobile', 'oceanwp' ),
				),
			) ) );

			/**
			 * Footer Bottom Copyright
			 */
			$wp_customize->add_setting( 'ocean_footer_copyright_text', array(
				'transport'           	=> 'postMessage',
				'default'           	=> 'Copyright [oceanwp_date] - OceanWP Theme by Nick Powered by <a href="https://wordpress.org/" title="WordPress" target="_blank">WordPress</a>',
				'sanitize_callback' 	=> false,
			) );

			$wp_customize->add_control( new OceanWP_Customizer_Textarea_Control( $wp_customize, 'ocean_footer_copyright_text', array(
				'label'	   				=> esc_html__( 'Copyright', 'oceanwp' ),
				'description'	   		=> sprintf( esc_html__( 'The following shortcodes can be added:%1$s %2$s[oceanwp_date]%3$s To show a dynamic date.%1$s %2$s[oceanwp_site_url]%3$s To add a homepage link.', 'oceanwp' ), '<br/>', '<strong>', '</strong>' ),
				'section'  				=> $section,
				'settings' 				=> 'ocean_footer_copyright_text',
				'priority' 				=> 10,
				'active_callback' 		=> 'oceanwp_cac_has_footer_bottom',
			) ) );

			/**
			 * Footer Bottom Padding
			 */
			$wp_customize->add_setting( 'ocean_bottom_footer_padding', array(
				'transport' 			=> 'postMessage',
				'sanitize_callback' 	=> false,
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'ocean_bottom_footer_padding', array(
				'label'	   				=> esc_html__( 'Padding (DECREPITATED)', 'oceanwp' ),
				'description'	   		=> esc_html__( 'This field will be removed in OceanWP 1.2.0, add your value(s) in the dimensions control below', 'oceanwp' ),
				'type' 					=> 'text',
				'section'  				=> $section,
				'settings' 				=> 'ocean_bottom_footer_padding',
				'priority' 				=> 10,
				'active_callback' 		=> 'oceanwp_cac_has_footer_bottom',
			) ) );

			/**
			 * Footer Bottom Padding
			 */
			$wp_customize->add_setting( 'ocean_bottom_footer_top_padding', array(
				'transport' 			=> 'postMessage',
				'default'           	=> '15',
				'sanitize_callback' 	=> false,
			) );
			$wp_customize->add_setting( 'ocean_bottom_footer_right_padding', array(
				'transport' 			=> 'postMessage',
				'default'           	=> '0',
				'sanitize_callback' 	=> false,
			) );
			$wp_customize->add_setting( 'ocean_bottom_footer_bottom_padding', array(
				'transport' 			=> 'postMessage',
				'default'           	=> '15',
				'sanitize_callback' 	=> false,
			) );
			$wp_customize->add_setting( 'ocean_bottom_footer_left_padding', array(
				'transport' 			=> 'postMessage',
				'default'           	=> '0',
				'sanitize_callback' 	=> false,
			) );

			$wp_customize->add_setting( 'ocean_bottom_footer_tablet_top_padding', array(
				'transport' 			=> 'postMessage',
				'sanitize_callback' 	=> false,
			) );
			$wp_customize->add_setting( 'ocean_bottom_footer_tablet_right_padding', array(
				'transport' 			=> 'postMessage',
				'sanitize_callback' 	=> false,
			) );
			$wp_customize->add_setting( 'ocean_bottom_footer_tablet_bottom_padding', array(
				'transport' 			=> 'postMessage',
				'sanitize_callback' 	=> false,
			) );
			$wp_customize->add_setting( 'ocean_bottom_footer_tablet_left_padding', array(
				'transport' 			=> 'postMessage',
				'sanitize_callback' 	=> false,
			) );

			$wp_customize->add_setting( 'ocean_bottom_footer_mobile_top_padding', array(
				'transport' 			=> 'postMessage',
				'sanitize_callback' 	=> false,
			) );
			$wp_customize->add_setting( 'ocean_bottom_footer_mobile_right_padding', array(
				'transport' 			=> 'postMessage',
				'sanitize_callback' 	=> false,
			) );
			$wp_customize->add_setting( 'ocean_bottom_footer_mobile_bottom_padding', array(
				'transport' 			=> 'postMessage',
				'sanitize_callback' 	=> false,
			) );
			$wp_customize->add_setting( 'ocean_bottom_footer_mobile_left_padding', array(
				'transport' 			=> 'postMessage',
				'sanitize_callback' 	=> false,
			) );

			$wp_customize->add_control( new OceanWP_Customizer_Dimensions_Control( $wp_customize, 'ocean_bottom_footer_padding_dimensions', array(
				'label'	   				=> esc_html__( 'Padding (px)', 'oceanwp' ),
				'section'  				=> $section,				
				'settings'   => array(
		            'desktop_top' 		=> 'ocean_bottom_footer_top_padding',
		            'desktop_right' 	=> 'ocean_bottom_footer_right_padding',
		            'desktop_bottom' 	=> 'ocean_bottom_footer_bottom_padding',
		            'desktop_left' 		=> 'ocean_bottom_footer_left_padding',
		            'tablet_top' 		=> 'ocean_bottom_footer_tablet_top_padding',
		            'tablet_right' 		=> 'ocean_bottom_footer_tablet_right_padding',
		            'tablet_bottom' 	=> 'ocean_bottom_footer_tablet_bottom_padding',
		            'tablet_left' 		=> 'ocean_bottom_footer_tablet_left_padding',
		            'mobile_top' 		=> 'ocean_bottom_footer_mobile_top_padding',
		            'mobile_right' 		=> 'ocean_bottom_footer_mobile_right_padding',
		            'mobile_bottom' 	=> 'ocean_bottom_footer_mobile_bottom_padding',
		            'mobile_left' 		=> 'ocean_bottom_footer_mobile_left_padding',
				),
				'priority' 				=> 10,
				'active_callback' 		=> 'oceanwp_cac_has_footer_bottom',
			    'input_attrs' 			=> array(
			        'min'   => 0,
			        'max'   => 500,
			        'step'  => 1,
			    ),
			) ) );

			/**
			 * Footer Bottom Background Color
			 */
			$wp_customize->add_setting( 'ocean_bottom_footer_background', array(
				'transport' 			=> 'postMessage',
				'default' 				=> '#1b1b1b',
				'sanitize_callback' 	=> false,
			) );

			$wp_customize->add_control( new OceanWP_Customizer_Color_Control( $wp_customize, 'ocean_bottom_footer_background', array(
				'label'	   				=> esc_html__( 'Background Color', 'oceanwp' ),
				'section'  				=> $section,
				'settings' 				=> 'ocean_bottom_footer_background',
				'priority' 				=> 10,
				'active_callback' 		=> 'oceanwp_cac_has_footer_bottom',
			) ) );

			/**
			 * Footer Bottom Color
			 */
			$wp_customize->add_setting( 'ocean_bottom_footer_color', array(
				'transport' 			=> 'postMessage',
				'default' 				=> '#929292',
				'sanitize_callback' 	=> false,
			) );

			$wp_customize->add_control( new OceanWP_Customizer_Color_Control( $wp_customize, 'ocean_bottom_footer_color', array(
				'label'	   				=> esc_html__( 'Text Color', 'oceanwp' ),
				'section'  				=> $section,
				'settings' 				=> 'ocean_bottom_footer_color',
				'priority' 				=> 10,
				'active_callback' 		=> 'oceanwp_cac_has_footer_bottom',
			) ) );

			/**
			 * Footer Bottom Links Color
			 */
			$wp_customize->add_setting( 'ocean_bottom_footer_link_color', array(
				'transport' 			=> 'postMessage',
				'default' 				=> '#ffffff',
				'sanitize_callback' 	=> false,
			) );

			$wp_customize->add_control( new OceanWP_Customizer_Color_Control( $wp_customize, 'ocean_bottom_footer_link_color', array(
				'label'	   				=> esc_html__( 'Links Color', 'oceanwp' ),
				'section'  				=> $section,
				'settings' 				=> 'ocean_bottom_footer_link_color',
				'priority' 				=> 10,
				'active_callback' 		=> 'oceanwp_cac_has_footer_bottom',
			) ) );

			/**
			 * Footer Bottom Links Hover Color
			 */
			$wp_customize->add_setting( 'ocean_bottom_footer_link_color_hover', array(
				'transport' 			=> 'postMessage',
				'default' 				=> '#13aff0',
				'sanitize_callback' 	=> false,
			) );

			$wp_customize->add_control( new OceanWP_Customizer_Color_Control( $wp_customize, 'ocean_bottom_footer_link_color_hover', array(
				'label'	   				=> esc_html__( 'Links Color: Hover', 'oceanwp' ),
				'section'  				=> $section,
				'settings' 				=> 'ocean_bottom_footer_link_color_hover',
				'priority' 				=> 10,
				'active_callback' 		=> 'oceanwp_cac_has_footer_bottom',
			) ) );

		}

		/**
		 * Get CSS
		 *
		 * @since 1.0.0
		 */
		public static function head_css( $output ) {
		
			// Global vars
			$bottom_top_padding 		= get_theme_mod( 'ocean_bottom_footer_top_padding', '15' );
			$bottom_right_padding 		= get_theme_mod( 'ocean_bottom_footer_right_padding', '0' );
			$bottom_bottom_padding 		= get_theme_mod( 'ocean_bottom_footer_bottom_padding', '15' );
			$bottom_left_padding 		= get_theme_mod( 'ocean_bottom_footer_left_padding', '0' );
			$tablet_top_padding 		= get_theme_mod( 'ocean_bottom_footer_tablet_top_padding' );
			$tablet_right_padding 		= get_theme_mod( 'ocean_bottom_footer_tablet_right_padding' );
			$tablet_bottom_padding 		= get_theme_mod( 'ocean_bottom_footer_tablet_bottom_padding' );
			$tablet_left_padding 		= get_theme_mod( 'ocean_bottom_footer_tablet_left_padding' );
			$mobile_top_padding 		= get_theme_mod( 'ocean_bottom_footer_mobile_top_padding' );
			$mobile_right_padding 		= get_theme_mod( 'ocean_bottom_footer_mobile_right_padding' );
			$mobile_bottom_padding 		= get_theme_mod( 'ocean_bottom_footer_mobile_bottom_padding' );
			$mobile_left_padding 		= get_theme_mod( 'ocean_bottom_footer_mobile_left_padding' );
			$bottom_background 			= get_theme_mod( 'ocean_bottom_footer_background', '#1b1b1b' );
			$bottom_color 				= get_theme_mod( 'ocean_bottom_footer_color', '#929292' );
			$bottom_link_color 			= get_theme_mod( 'ocean_bottom_footer_link_color', '#ffffff' );
			$bottom_link_color_hover 	= get_theme_mod( 'ocean_bottom_footer_link_color_hover', '#13aff0' );

			// Define css var
			$css = '';
			$padding_css = '';
			$tablet_padding_css = '';
			$mobile_padding_css = '';

			// DECREPITATED Footer bottom padding
			$bottom_padding = get_theme_mod( 'ocean_bottom_footer_padding' );
			if ( ! empty( $bottom_padding ) ) {
				$css .= '#footer-bottom{padding:'. $bottom_padding .';}';
			}

			// Footer bottom top padding
			if ( ! empty( $bottom_top_padding ) && '15' != $bottom_top_padding ) {
				$padding_css .= 'padding-top:'. $bottom_top_padding .'px;';
			}

			// Footer bottom right padding
			if ( ! empty( $bottom_right_padding ) && '0' != $bottom_right_padding ) {
				$padding_css .= 'padding-right:'. $bottom_right_padding .'px;';
			}

			// Footer bottom bottom padding
			if ( ! empty( $bottom_bottom_padding ) && '15' != $bottom_bottom_padding ) {
				$padding_css .= 'padding-bottom:'. $bottom_bottom_padding .'px;';
			}

			// Footer bottom left padding
			if ( ! empty( $bottom_left_padding ) && '0' != $bottom_left_padding ) {
				$padding_css .= 'padding-left:'. $bottom_left_padding .'px;';
			}

			// Footer bottom padding css
			if ( ! empty( $bottom_top_padding ) && '15' != $bottom_top_padding
				|| ! empty( $bottom_right_padding ) && '0' != $bottom_right_padding
				|| ! empty( $bottom_bottom_padding ) && '15' != $bottom_bottom_padding
				|| ! empty( $bottom_left_padding ) && '0' != $bottom_left_padding ) {
				$css .= '#footer-bottom{'. $padding_css .'}';
			}

			// Tablet footer bottom top padding
			if ( ! empty( $tablet_top_padding ) ) {
				$tablet_padding_css .= 'padding-top:'. $tablet_top_padding .'px;';
			}

			// Tablet footer bottom right padding
			if ( ! empty( $tablet_right_padding ) ) {
				$tablet_padding_css .= 'padding-right:'. $tablet_right_padding .'px;';
			}

			// Tablet footer bottom bottom padding
			if ( ! empty( $tablet_bottom_padding ) ) {
				$tablet_padding_css .= 'padding-bottom:'. $tablet_bottom_padding .'px;';
			}

			// Tablet footer bottom left padding
			if ( ! empty( $tablet_left_padding ) ) {
				$tablet_padding_css .= 'padding-left:'. $tablet_left_padding .'px;';
			}

			// Tablet footer bottom padding css
			if ( ! empty( $tablet_top_padding )
				|| ! empty( $tablet_right_padding )
				|| ! empty( $tablet_bottom_padding )
				|| ! empty( $tablet_left_padding ) ) {
				$css .= '@media (max-width: 768px){#footer-bottom{'. $tablet_padding_css .'}}';
			}

			// Mobile footer bottom top padding
			if ( ! empty( $mobile_top_padding ) ) {
				$mobile_padding_css .= 'padding-top:'. $mobile_top_padding .'px;';
			}

			// Mobile footer bottom right padding
			if ( ! empty( $mobile_right_padding ) ) {
				$mobile_padding_css .= 'padding-right:'. $mobile_right_padding .'px;';
			}

			// Mobile footer bottom bottom padding
			if ( ! empty( $mobile_bottom_padding ) ) {
				$mobile_padding_css .= 'padding-bottom:'. $mobile_bottom_padding .'px;';
			}

			// Mobile footer bottom left padding
			if ( ! empty( $mobile_left_padding ) ) {
				$mobile_padding_css .= 'padding-left:'. $mobile_left_padding .'px;';
			}

			// Mobile footer bottom padding css
			if ( ! empty( $mobile_top_padding )
				|| ! empty( $mobile_right_padding )
				|| ! empty( $mobile_bottom_padding )
				|| ! empty( $mobile_left_padding ) ) {
				$css .= '@media (max-width: 480px){#footer-bottom{'. $mobile_padding_css .'}}';
			}

			// Footer bottom background
			if ( ! empty( $bottom_background ) && '#1b1b1b' != $bottom_background ) {
				$css .= '#footer-bottom{background-color:'. $bottom_background .';}';
			}

			// Footer bottom color
			if ( ! empty( $bottom_color ) && '#929292' != $bottom_color ) {
				$css .= '#footer-bottom,#footer-bottom p{color:'. $bottom_color .';}';
			}

			// Footer bottom links color
			if ( ! empty( $bottom_link_color ) && '#ffffff' != $bottom_link_color ) {
				$css .= '#footer-bottom a,#footer-bottom #footer-bottom-menu a{color:'. $bottom_link_color .';}';
			}

			// Footer bottom links hover color
			if ( ! empty( $bottom_link_color_hover ) && '#13aff0' != $bottom_link_color_hover ) {
				$css .= '#footer-bottom a:hover,#footer-bottom #footer-bottom-menu a:hover{color:'. $bottom_link_color_hover .';}';
			}
				
			// Return CSS
			if ( ! empty( $css ) ) {
				$output .= '/* Footer Bottom CSS */'. $css;
			}

			// Return output css
			return $output;

		}

	}

endif;

return new OceanWP_Footer_Bottom_Customizer();