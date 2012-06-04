<?php
if ( ! is_admin() ) {
	add_action( 'wp_print_scripts', 'woothemes_add_javascript' );
	add_action( 'wp_print_styles', 'woothemes_add_css' );
}

if ( ! function_exists( 'woothemes_add_javascript' ) ) {
	function woothemes_add_javascript( ) {
		wp_enqueue_script('jquery');    
		wp_enqueue_script( 'superfish', get_template_directory_uri() . '/includes/js/superfish.js', array( 'jquery' ) );
		wp_enqueue_script( 'general', get_template_directory_uri() . '/includes/js/general.js', array( 'jquery' ) );
		wp_enqueue_script( 'jcarousel', get_template_directory_uri() . '/includes/js/jcarousel.js', array( 'jquery' ) );
		wp_enqueue_script( 'slides', get_template_directory_uri() . '/includes/js/slides.min.jquery.js', array( 'jquery' ) );
		
		// Load the JavaScript for the slides and testimonals on the homepage.
		
		if ( is_home() ) {
			
			// Load the custom innerfade settings only if necessary.
			
			$can_fade = true;
			$timeout = 6000;
			
			$can_fade_db = get_option( 'woo_testimonials_autofade' );
			$timeout_db = get_option( 'woo_testimonials_interval' );
			
			if ( $can_fade_db == 'true' ) { $can_fade = $can_fade_db; }
			if ( $timeout != '' ) { $timeout = intval( $timeout_db ); }
		
			// Allow our JavaScript file (the general one) to see our fader setup data.
			$data = array(
						'timeout' => $timeout, 
						'can_fade' => $can_fade
						);
			
			wp_localize_script( 'general', 'woo_innerfade_settings', $data );
		}
		
		// Load the prettyPhoto JavaScript and CSS for use on the portfolio page template.
		
		if ( is_page_template('template-portfolio.php') OR 'portfolio' == get_post_type() ) {
			wp_register_script( 'prettyPhoto', get_template_directory_uri().'/includes/js/jquery.prettyPhoto.js', array( 'jquery' ) );					
			wp_register_script( 'portfolio', get_template_directory_uri().'/includes/js/portfolio.js', array( 'jquery', 'prettyPhoto' ) );
			
			wp_enqueue_script( 'prettyPhoto' );
			wp_enqueue_script( 'portfolio' );
		}
	}
}

if ( ! function_exists( 'woothemes_add_css' ) ) {
	function woothemes_add_css () {
	
		if ( is_page_template('template-portfolio.php') OR 'portfolio' == get_post_type() ) {
			wp_register_style( 'prettyPhoto', get_template_directory_uri().'/includes/css/prettyPhoto.css' );
			wp_enqueue_style( 'prettyPhoto' );
		}
	
	} // End woothemes_add_css()
}
?>