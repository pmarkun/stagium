<?php 

/*-----------------------------------------------------------------------------------

TABLE OF CONTENTS

- Add custom styling to HEAD
- Add custom typograhpy to HEAD
- Add layout to body_class output
- Featured Slider Settings
- Single Portfolio Gallery Settings

-----------------------------------------------------------------------------------*/


add_action('woo_head','woo_custom_styling');			// Add custom styling to HEAD
add_action('woo_head','woo_custom_typography');			// Add custom typography to HEAD
add_filter('body_class','woo_layout_body_class');		// Add layout to body_class output


/*-----------------------------------------------------------------------------------*/
/* Add Custom Styling to HEAD */
/*-----------------------------------------------------------------------------------*/
if (!function_exists('woo_custom_styling')) {
	function woo_custom_styling() {
	
		global $woo_options;
		
		$output = '';
		// Get options
		$body_color = $woo_options[ 'woo_body_color' ];
		$body_img = $woo_options[ 'woo_body_img' ];
		$body_repeat = $woo_options[ 'woo_body_repeat' ];
		$body_position = $woo_options[ 'woo_body_pos' ];
		$link = $woo_options[ 'woo_link_color' ];
		$hover = $woo_options[ 'woo_link_hover_color' ];
		$button = $woo_options[ 'woo_button_color' ];
			
		// Add CSS to output
		if ($body_color)
			$output .= '#wrapper {background:'.$body_color.'}' . "\n";
			
		if ($body_img)
			$output .= '#wrapper {background-image:url('.$body_img.')}' . "\n";

		if ($body_img && $body_repeat && $body_position)
			$output .= '#wrapper {background-repeat:'.$body_repeat.'}' . "\n";

		if ($body_img && $body_position)
			$output .= '#wrapper {background-position:'.$body_position.'}' . "\n";

		if ($link)
			$output .= 'a {color:'.$link.'}' . "\n";

		if ($hover)
			$output .= 'a:hover, .post-more a:hover, .post-meta a:hover, .post p.tags a:hover {color:'.$hover.'}' . "\n";

		if ($button) {
			$output .= 'a.button, a.comment-reply-link, #commentform #submit, #contact-page .submit, #connect .newsletter-form .submit {background:'.$button.';border-color:'.$button.'}' . "\n";
			$output .= 'a.button:hover, a.button.hover, a.button.active, a.comment-reply-link:hover, #commentform #submit:hover, #contact-page .submit:hover, #connect .newsletter-form .submit {background:'.$button.';opacity:0.9;}' . "\n";
		}
		
		// Output styles
		if (isset($output) && $output != '') {
			$output = strip_tags($output);
			$output = "<!-- Woo Custom Styling -->\n<style type=\"text/css\">\n" . $output . "</style>\n";
			echo $output;
		}
			
	}
} 

/*-----------------------------------------------------------------------------------*/
/* Add custom typograhpy to HEAD */
/*-----------------------------------------------------------------------------------*/
if (!function_exists('woo_custom_typography')) {
	function woo_custom_typography() {
	
		// Get options
		global $woo_options;
				
		// Reset	
		$output = '';
		
		// Add Text title and tagline if text title option is enabled
		if ( $woo_options[ 'woo_texttitle' ] == "true" ) {		
			
			if ( $woo_options[ 'woo_font_site_title' ] )
				$output .= '#logo .site-title a {'.woo_generate_font_css($woo_options[ 'woo_font_site_title' ]).'}' . "\n";	
			if ( $woo_options[ 'woo_font_tagline' ] )
				$output .= '#logo .site-description {'.woo_generate_font_css($woo_options[ 'woo_font_tagline' ]).'}' . "\n";	
		}

		if ( $woo_options[ 'woo_typography' ] == "true") {
			
			if ( $woo_options[ 'woo_font_body' ] )
				$output .= 'body { '.woo_generate_font_css($woo_options[ 'woo_font_body' ], '1.5').' }' . "\n";	

			if ( $woo_options[ 'woo_font_nav' ] )
				$output .= '#navigation, #navigation .nav a { '.woo_generate_font_css($woo_options[ 'woo_font_nav' ], '1.4').' }' . "\n";	

			if ( $woo_options[ 'woo_font_post_title' ] )
				$output .= '#title-container h1.title { '.woo_generate_font_css($woo_options[ 'woo_font_post_title' ]).' }' . "\n";	
		
			if ( $woo_options[ 'woo_font_post_meta' ] )
				$output .= '.post-meta { '.woo_generate_font_css($woo_options[ 'woo_font_post_meta' ]).' }' . "\n";	

			if ( $woo_options[ 'woo_font_post_entry' ] )
				$output .= '.entry, .entry p { '.woo_generate_font_css($woo_options[ 'woo_font_post_entry' ], '1.5').' } h1, h2, h3, h4, h5, h6 { font-family: \''.stripslashes($woo_options[ 'woo_font_post_entry' ]['face']).'\', sans-serif; }'  . "\n";	

			if ( $woo_options[ 'woo_font_widget_titles' ] )
				$output .= '.widget h3 { '.woo_generate_font_css($woo_options[ 'woo_font_widget_titles' ]).' }'  . "\n";	

		// Add default typography Google Font
		} else {
		
			$woo_options['woo_just_face'] = array('face' => 'PT Sans');
			$output .= 'h1, h2, h3, h4, h5, h6, .widget h3, .post .title, .nav a, .section .post .title, .archive_header { '.woo_generate_font_css($woo_options['woo_just_face']).' }' . "\n";			
		}

		// Output styles
		if (isset($output) && $output != '') {
		
			// Enable Google Fonts stylesheet in HEAD
			if (function_exists('woo_google_webfonts')) woo_google_webfonts();
			
			$output = "\n<!-- Woo Custom Typography -->\n<style type=\"text/css\">\n" . $output . "</style>\n";
			echo $output;
			
		}
			
	}
} 

// Returns proper font css output
if (!function_exists( 'woo_generate_font_css')) {
	function woo_generate_font_css($option, $em = '1') {

		// Test if font-face is a Google font
		global $google_fonts;
		foreach ( $google_fonts as $google_font ) {
					
			// Add single quotation marks to font name and default arial sans-serif ending
			if ( $option[ 'face' ] == $google_font[ 'name' ] )
				$option[ 'face' ] = "'" . $option[ 'face' ] . "', arial, sans-serif";		
		
		} // END foreach
		
		if ( !@$option["style"] && !@$option["size"] && !@$option["unit"] && !@$option["color"] )
			return 'font-family: '.stripslashes($option["face"]).';'; 
		else
			return 'font:'.$option["style"].' '.$option["size"].$option["unit"].'/'.$em.'em '.stripslashes($option["face"]).';color:'.$option["color"].';';
	}
}

// Output stylesheet and custom.css after custom styling
remove_action('wp_head', 'woothemes_wp_head');
add_action('woo_head', 'woothemes_wp_head');


/*-----------------------------------------------------------------------------------*/
/* Add layout to body_class output */
/*-----------------------------------------------------------------------------------*/
if (!function_exists('woo_layout_body_class')) {
	function woo_layout_body_class($classes) {
		
		global $woo_options;
		$layout = $woo_options[ 'woo_site_layout' ];

		// Set main layout on post or page
		if ( is_singular() ) {
			global $post;
			$single = get_post_meta($post->ID, '_layout', true);
			if ( $single != "" AND $single != "layout-default" ) 
				$layout = $single;
		}
		
		// Add layout to $woo_options array for use in theme
		$woo_options[ 'woo_layout' ] = $layout;
		
		// Add classes to body_class() output 
		$classes[] = $layout;
		return $classes;						
					
	}
}

/*-----------------------------------------------------------------------------------*/
/* Featured Slider Settings */
/*-----------------------------------------------------------------------------------*/

add_filter('woo_head', 'woo_slider_options');
function woo_slider_options() { 
	
	global $woo_options;
	
	if ( isset( $woo_options['woo_slider'] ) && $woo_options['woo_slider'] == 'true' && ( is_home() || is_front_page() ) && ! is_paged() ) { ?>
	
		<script type="text/javascript">
			jQuery( window ).load(function(){
						
				jQuery( 'body.home #slides' ).slides({
					preload: true,
					preloadImage: '<?php echo get_template_directory_uri(); ?>/images/loading.png',
					autoHeight: true,
					effect: '<?php echo $woo_options['woo_slider_effect']; ?>',
					container: 'slides_container',
					<?php if ( isset( $woo_options['woo_slider_random'] ) && $woo_options['woo_slider_random'] == 'true' ): ?>			
					randomize: true,
					<?php endif; ?>
					<?php if ( isset( $woo_options['woo_slider_hover'] ) && $woo_options['woo_slider_hover'] == 'true' ): ?>			
					hoverPause: true,
					<?php endif; ?>
					<?php if ( isset( $woo_options['woo_slider_auto'] ) && $woo_options['woo_slider_auto'] == 'true' ): ?>
					play: <?php echo $woo_options['woo_slider_interval'] * 1000; ?>,
					<?php endif; ?>			
					slideSpeed: <?php echo $woo_options['woo_slider_speed'] * 1000; ?>,
					fadeSpeed: <?php echo $woo_options['woo_fade_speed'] * 1000; ?>,
					<?php if ( isset( $woo_options['woo_slider_nextprev'] ) && $woo_options['woo_slider_nextprev'] == 'true' ): ?>
					generateNextPrev: true,
					<?php endif; ?>
					generatePagination: false,
					crossfade: true
				});
								
			});
		</script>
				
	<?php } // End IF Statement

}

/*-----------------------------------------------------------------------------------*/
/* Single Portfolio Gallery Settings */
/*-----------------------------------------------------------------------------------*/

add_filter('woo_head', 'woo_portfolio_options');
	function woo_portfolio_options() { 
	
	global $woo_options;  ?>
		<script type="text/javascript">
			jQuery(window).load(function(){
			jQuery("#slides.gallery").slides({
				<?php
					$autoStart = 0;
					$slidespeed = 600;
					if ( get_option("woo_slider_auto") == "true" ) 
		   				$autoStart = get_option("woo_slider_interval") * 1000;
					else 
		   				$autoStart = 0;
					if ( get_option("woo_slider_speed") <> "" ) 
						$slidespeed = get_option("woo_slider_speed") * 1000;
				?>
		autoStart: <?php echo $autoStart; ?>, 
		slideSpeed: <?php echo $slidespeed; ?>, 
		autoHeight: true, 
		generatePagination: false, 
		paginationClass: 'pagination'
	});
});

		</script>
	<?php }

/*-----------------------------------------------------------------------------------*/
/* END */
/*-----------------------------------------------------------------------------------*/
?>