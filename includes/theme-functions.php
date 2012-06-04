<?php

/*-----------------------------------------------------------------------------------

TABLE OF CONTENTS

- Register WP Menus
- Page navigation
- Post Meta
- CPT Slides
- CPT Mini-Features
- CPT Portfolio
- CPT Testimonials
- Subscribe & Connect
- Exclude Pages
- Get Post image attachments
- Show portfolio posts in tag archives
- Show post tags in portfolio item breadcrumbs

-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/* Register WP Menus */
/*-----------------------------------------------------------------------------------*/
if ( function_exists( 'wp_nav_menu') ) {
	add_theme_support( 'nav-menus' );
	register_nav_menus( array( 'primary-menu' => __( 'Primary Menu', 'woothemes' ) ) );
	register_nav_menus( array( 'top-menu' => __( 'Top Menu', 'woothemes' ) ) );
}


/*-----------------------------------------------------------------------------------*/
/* Page navigation */
/*-----------------------------------------------------------------------------------*/
if (!function_exists( 'woo_pagenav')) {
	function woo_pagenav() {

		global $woo_options;

		// If the user has set the option to use simple paging links, display those. By default, display the pagination.
		if ( array_key_exists( 'woo_pagination_type', $woo_options ) && $woo_options[ 'woo_pagination_type' ] == 'simple' ) {
			if ( get_next_posts_link() || get_previous_posts_link() ) {
		?>

            <div class="nav-entries">
                <?php next_posts_link( '<span class="nav-prev fl">'. __( '<span class="meta-nav">&larr;</span> Older posts', 'woothemes' ) . '</span>' ); ?>
                <?php previous_posts_link( '<span class="nav-next fr">'. __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'woothemes' ) . '</span>' ); ?>
                <div class="fix"></div>
            </div>

		<?php
			} // ENDIF
			
		} else {
				
			woo_pagination();
		
		} // ENDIF		 
	
	} 
}


/*-----------------------------------------------------------------------------------*/
/* Post Meta */
/*-----------------------------------------------------------------------------------*/

if (!function_exists('woo_post_meta')) {
	function woo_post_meta( ) {
?>
<p class="post-meta">
    <span class="post-date"><span class="small"><?php _e('Posted on', 'woothemes') ?></span> <?php the_time( get_option( 'date_format' ) ); ?></span>
    <span class="post-author"><span class="small"><?php _e('by', 'woothemes') ?></span> <?php the_author_posts_link(); ?></span>
    <span class="post-category"><span class="small"><?php _e('in', 'woothemes') ?></span> <?php the_category(', ') ?></span>
    <?php edit_post_link( __('{ Edit }', 'woothemes'), '<span class="small">', '</span>' ); ?>
</p>
<?php
	}
}

/*-----------------------------------------------------------------------------------*/
/* Custom Post Type - Slides */
/*-----------------------------------------------------------------------------------*/

add_action('init', 'woo_add_slides');
function woo_add_slides() 
{
  $labels = array(
    'name' => _x('Slides', 'post type general name', 'woothemes', 'woothemes'),
    'singular_name' => _x('Slide', 'post type singular name', 'woothemes'),
    'add_new' => _x('Adicionar Novo', 'slide', 'woothemes'),
    'add_new_item' => __('Adicionar Novo Slide', 'woothemes'),
    'edit_item' => __('Editar Slide', 'woothemes'),
    'new_item' => __('Novo Slide', 'woothemes'),
    'view_item' => __('Ver Slide', 'woothemes'),
    'search_items' => __('Procurar Slide', 'woothemes'),
    'not_found' =>  __('Nenhum slide encontrado', 'woothemes'),
    'not_found_in_trash' => __('Nenhum slide encontrado na lixeira', 'woothemes'), 
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => false,
    'publicly_queryable' => false,
    'show_ui' => true, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_icon' => get_template_directory_uri() .'/includes/images/slides.png',
    'menu_position' => null,
    'supports' => array('title','editor','thumbnail'/*'author','thumbnail','excerpt','comments'*/)
  ); 
  register_post_type('slide',$args);
}

/*-----------------------------------------------------------------------------------*/
/* Custom Post Type - Destaques | Notícias */
/*-----------------------------------------------------------------------------------*/

add_action('init', 'woo_add_infoboxes');
function woo_add_infoboxes() 
{
  $labels = array(
    'name' => _x('Destaques | Notícias', 'post type general name', 'woothemes'),
    'singular_name' => _x('Destaque | Notícia', 'post type singular name', 'woothemes'),
    'add_new' => _x('Adicionar novo', 'infobox', 'woothemes'),
    'add_new_item' => __('Adicionar Novo Destaque', 'woothemes'),
    'edit_item' => __('Editar Destaque', 'woothemes'),
    'new_item' => __('Adicionar Destaque', 'woothemes'),
    'view_item' => __('Ver Destaque', 'woothemes'),
    'search_items' => __('Pesquisar notícias em destaque', 'woothemes'),
    'not_found' =>  __('Nenhuma notícia encontrada em destaque', 'woothemes'),
    'not_found_in_trash' => __('Nenhuma notícia em destaque encontrada na lixeira', 'woothemes'), 
    'parent_item_colon' => ''
  );
  
  $infobox_rewrite = get_option('woo_infobox_rewrite');
  if(empty($infobox_rewrite)) $infobox_rewrite = 'infobox';
  
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'query_var' => true,
    'rewrite' => array('slug'=> $infobox_rewrite),
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_icon' => get_template_directory_uri() .'/includes/images/box.png',
    'menu_position' => null,
    'supports' => array('title','editor',/*'author','thumbnail','excerpt','comments'*/)
  ); 
  register_post_type('infobox',$args);
}

/*-----------------------------------------------------------------------------------*/
/* Custom Post Type - Destaque | Apresentações */
/*-----------------------------------------------------------------------------------*/

add_action('init', 'woo_add_apresentacoes');
function woo_add_apresentacoes() 
{
  $labels = array(
    'name' => _x('Destaques | Apresentações', 'post type general name', 'woothemes'),
    'singular_name' => _x('Destaque | Apresentação', 'post type singular name', 'woothemes'),
    'add_new' => _x('Adicionar novo', 'infobox', 'woothemes'),
    'add_new_item' => __('Adicionar Novo Destaque', 'woothemes'),
    'edit_item' => __('Editar Apresentação no Destaque', 'woothemes'),
    'new_item' => __('Adicionar Apresentação no Destaque', 'woothemes'),
    'view_item' => __('Ver Apresentação em Destaque', 'woothemes'),
    'search_items' => __('Pesquisar apresentações no destaque', 'woothemes'),
    'not_found' =>  __('Nenhuma apresentação em destaque', 'woothemes'),
    'not_found_in_trash' => __('Nenhuma apresentação em destaque lixeira', 'woothemes'), 
    'parent_item_colon' => ''
  );
  
  $apresentacoes_rewrite = get_option('woo_apresentacoes_rewrite');
  if(empty($apresentacoes_rewrite)) $apresentacoes_rewrite = 'apresentacoes';
  
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'query_var' => true,
    'rewrite' => array('slug'=> $apresentacoes_rewrite),
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_icon' => get_template_directory_uri() .'/includes/images/box.png',
    'menu_position' => null,
    'supports' => array('title','editor',/*'author','thumbnail','excerpt','comments'*/)
  ); 
  register_post_type('apresentacoes',$args);
}

/*-----------------------------------------------------------------------------------*/
/* Custom Post Type - Portfolio */
/*-----------------------------------------------------------------------------------*/

add_action('init', 'woo_add_portfolio');
function woo_add_portfolio() 
{
  $labels = array(
    'name' => _x('Portfolio', 'post type general name', 'woothemes'),
    'singular_name' => _x('Item do Portfolio', 'post type singular name', 'woothemes'),
    'add_new' => _x('Adicionar Novo', 'slide', 'woothemes'),
    'add_new_item' => __('Adicionar Novo Item do Portfolio', 'woothemes'),
    'edit_item' => __('Editar Item do Portfolio', 'woothemes'),
    'new_item' => __('Novo Item do Portfolio', 'woothemes'),
    'view_item' => __('Ver Item do Portfolio', 'woothemes'),
    'search_items' => __('Procurar Itens do Portfolio', 'woothemes'),
    'not_found' =>  __('Nenhum item encontrado no Portfolio', 'woothemes'),
    'not_found_in_trash' => __('Nenhum item do Portfolio encontrado na lixeira', 'woothemes'), 
    'parent_item_colon' => ''
  );
  
  $portfolioitems_rewrite = get_option('woo_portfolioitems_rewrite');
  if(empty($portfolioitems_rewrite)) $portfolioitems_rewrite = 'portfolio-items';

  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
	'_builtin' => false,
    'show_ui' => true, 
    'query_var' => true,
    'rewrite' => array('slug'=> $portfolioitems_rewrite),
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_icon' => get_template_directory_uri() .'/includes/images/portfolio.png',
    'menu_position' => null,
    'supports' => array('title','editor','thumbnail'/*'author','excerpt','comments'*/),
	'taxonomies' => array('post_tag') // add tags so portfolio can be filtered
  ); 
  register_post_type('portfolio',$args);

}

/*-----------------------------------------------------------------------------------*/
/* Custom Post Type - Testimonials */
/*-----------------------------------------------------------------------------------*/

add_action('init', 'woo_add_testimonials');
function woo_add_testimonials() 
{
  $labels = array(
    'name' => _x('Aspas', 'post type general name', 'woothemes'),
    'singular_name' => _x('Aspa', 'post type singular name', 'woothemes'),
    'add_new' => _x('Adicionar Nova', 'infobox', 'woothemes'),
    'add_new_item' => __('Adicionar Nova Aspa', 'woothemes'),
    'edit_item' => __('Editar Aspa', 'woothemes'),
    'new_item' => __('Nova Aspa', 'woothemes'),
    'view_item' => __('Ver Aspa', 'woothemes'),
    'search_items' => __('Procurar Aspas', 'woothemes'),
    'not_found' =>  __('Nenhuma aspa encontrada', 'woothemes'),
    'not_found_in_trash' => __('Nenhuma aspa encontrada na lixeira', 'woothemes'), 
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => false,
    'publicly_queryable' => false,
    'show_ui' => true, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_icon' => get_template_directory_uri() . '/includes/images/feedback.png',
    'menu_position' => null,
    'supports' => array('title','editor',/*'author','thumbnail','excerpt','comments'*/)
  ); 
  register_post_type('testimonial',$args);
}

/*-----------------------------------------------------------------------------------*/
/* Slider Button Shortcode */
/*-----------------------------------------------------------------------------------*/

function slider_button($atts, $content = null) {
   extract(shortcode_atts(array('url' => '#'), $atts));
   return '<a class="btn" href="'.$url.'"><span>' . do_shortcode($content) . '</span></a>';
}
add_shortcode('simplebutton', 'slider_button');

/*-----------------------------------------------------------------------------------*/
/* Subscribe / Connect */
/*-----------------------------------------------------------------------------------*/

if (!function_exists('woo_subscribe_connect')) {
	function woo_subscribe_connect($widget = 'false', $title = '', $form = '', $social = '') {

		global $woo_options;

		// Setup title
		if ( $widget != 'true' )
			$title = $woo_options[ 'woo_connect_title' ];

		// Setup related post (not in widget)
		$related_posts = '';
		if ( $woo_options[ 'woo_connect_related' ] == "true" AND $widget != "true" )
			$related_posts = do_shortcode('[related_posts limit="5"]');

?>
	<?php if ( $woo_options[ 'woo_connect' ] == "true" OR $widget == 'true' ) : ?>
	<div id="connect">
		<h3 class="title"><?php if ( $title ) echo $title; else _e('Subscribe','woothemes'); ?></h3>

		<div <?php if ( $related_posts != '' ) echo 'class="col-left"'; ?>>
			<p><?php if ($woo_options[ 'woo_connect_content' ] != '') echo stripslashes($woo_options[ 'woo_connect_content' ]); else _e('Subscribe to our e-mail newsletter to receive updates.', 'woothemes'); ?></p>

			<?php if ( $woo_options[ 'woo_connect_newsletter_id' ] != "" AND $form != 'on' ) : ?>
			<form class="newsletter-form<?php if ( $related_posts == '' ) echo ' fl'; ?>" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $woo_options[ 'woo_connect_newsletter_id' ]; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
				<input class="email" type="text" name="email" value="<?php _e('E-mail','woothemes'); ?>" onfocus="if (this.value == '<?php _e('E-mail','woothemes'); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('E-mail','woothemes'); ?>';}" />
				<input type="hidden" value="<?php echo $woo_options[ 'woo_connect_newsletter_id' ]; ?>" name="uri"/>
				<input type="hidden" value="<?php bloginfo('name'); ?>" name="title"/>
				<input type="hidden" name="loc" value="en_US"/>
				<input class="submit" type="submit" name="submit" value="<?php _e('Submit', 'woothemes'); ?>" />
			</form>
			<?php endif; ?>

			<?php if ( $woo_options['woo_connect_mailchimp_list_url'] != "" AND $form != 'on' AND $woo_options['woo_connect_newsletter_id'] == "" ) : ?>
			<!-- Begin MailChimp Signup Form -->
			<div id="mc_embed_signup">
				<form class="newsletter-form<?php if ( $related_posts == '' ) echo ' fl'; ?>" action="<?php echo $woo_options['woo_connect_mailchimp_list_url']; ?>" method="post" target="popupwindow" onsubmit="window.open('<?php echo $woo_options['woo_connect_mailchimp_list_url']; ?>', 'popupwindow', 'scrollbars=yes,width=650,height=520');return true">
					<input type="text" name="EMAIL" class="required email" value="<?php _e('E-mail','woothemes'); ?>"  id="mce-EMAIL" onfocus="if (this.value == '<?php _e('E-mail','woothemes'); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('E-mail','woothemes'); ?>';}">
					<input type="submit" value="<?php _e('Submit', 'woothemes'); ?>" name="subscribe" id="mc-embedded-subscribe" class="btn submit button">
				</form>
			</div>
			<!--End mc_embed_signup-->
			<?php endif; ?>

			<?php if ( $social != 'on' ) : ?>
			<div class="social<?php if ( $related_posts == '' AND $woo_options[ 'woo_connect_newsletter_id' ] != "" ) echo ' fr'; ?>">
		   		<?php if ( $woo_options[ 'woo_connect_rss' ] == "true" ) { ?>
		   		<a href="<?php if ( $woo_options[ 'woo_feed_url' ] ) { echo $woo_options[ 'woo_feed_url' ]; } else { echo get_bloginfo_rss('rss2_url'); } ?>" class="subscribe"><img width="32" height="32" src="<?php echo get_template_directory_uri(); ?>/images/ico-social-rss.png" title="<?php _e('Subscribe to our RSS feed', 'woothemes'); ?>" alt=""/></a>

		   		<?php } if ( $woo_options[ 'woo_connect_twitter' ] != "" ) { ?>
		   		<a href="<?php echo $woo_options[ 'woo_connect_twitter' ]; ?>" class="twitter"><img width="32" height="32" src="<?php echo get_template_directory_uri(); ?>/images/ico-social-twitter.png" title="<?php _e('Follow us on Twitter', 'woothemes'); ?>" alt=""/></a>

		   		<?php } if ( $woo_options[ 'woo_connect_facebook' ] != "" ) { ?>
		   		<a href="<?php echo $woo_options[ 'woo_connect_facebook' ]; ?>" class="facebook"><img width="32" height="32" src="<?php echo get_template_directory_uri(); ?>/images/ico-social-facebook.png" title="<?php _e('Connect on Facebook', 'woothemes'); ?>" alt=""/></a>

		   		<?php } if ( $woo_options[ 'woo_connect_youtube' ] != "" ) { ?>
		   		<a href="<?php echo $woo_options[ 'woo_connect_youtube' ]; ?>" class="youtube"><img width="32" height="32" src="<?php echo get_template_directory_uri(); ?>/images/ico-social-youtube.png" title="<?php _e('Watch on YouTube', 'woothemes'); ?>" alt=""/></a>

		   		<?php } if ( $woo_options[ 'woo_connect_flickr' ] != "" ) { ?>
		   		<a href="<?php echo $woo_options[ 'woo_connect_flickr' ]; ?>" class="flickr"><img width="32" height="32" src="<?php echo get_template_directory_uri(); ?>/images/ico-social-flickr.png" title="<?php _e('See photos on Flickr', 'woothemes'); ?>" alt=""/></a>

		   		<?php } if ( $woo_options[ 'woo_connect_linkedin' ] != "" ) { ?>
		   		<a href="<?php echo $woo_options[ 'woo_connect_linkedin' ]; ?>" class="linkedin"><img width="32" height="32" src="<?php echo get_template_directory_uri(); ?>/images/ico-social-linkedin.png" title="<?php _e('Connect on LinkedIn', 'woothemes'); ?>" alt=""/></a>

		   		<?php } if ( $woo_options[ 'woo_connect_delicious' ] != "" ) { ?>
		   		<a href="<?php echo esc_url( $woo_options['woo_connect_delicious'] ); ?>" class="delicious"><img width="32" height="32" src="<?php echo get_template_directory_uri(); ?>/images/ico-social-delicious.png" title="<?php _e('Discover on Delicious', 'woothemes'); ?>" alt=""/></a>

		   		<?php } if ( $woo_options[ 'woo_connect_googleplus' ] != "" ) { ?>
		   		<a href="<?php echo esc_url( $woo_options['woo_connect_googleplus'] ); ?>" class="googleplus"><img width="32" height="32" src="<?php echo get_template_directory_uri(); ?>/images/ico-social-googleplus.png" title="<?php _e('View Google+ profile', 'woothemes'); ?>" alt=""/></a>

				<?php } ?>
			</div>
			<?php endif; ?>

		</div><!-- col-left -->

		<?php if ( $woo_options[ 'woo_connect_related' ] == "true" AND $related_posts != '' ) : ?>
		<div class="related-posts col-right">
			<h4><?php _e('Related Posts:', 'woothemes'); ?></h4>
			<?php echo $related_posts; ?>
		</div><!-- col-right -->
		<?php wp_reset_query(); endif; ?>

        <div class="fix"></div>
	</div>
	<?php endif; ?>
<?php
	}
}


/*-----------------------------------------------------------------------------------*/
/* Exclude Pages */
/*-----------------------------------------------------------------------------------*/

function woo_exclude_pages() {
	$exclude = '';	
	return $exclude;
}

/*-----------------------------------------------------------------------------------*/
/* Get Post image attachments */
/*-----------------------------------------------------------------------------------*/
/* 
Description:

This function will get all the attached post images that have been uploaded via the 
WP post image upload and return them in an array. 

*/
function woo_get_post_images($offset = 1) {
	
	// Arguments
	$repeat = 100; 				// Number of maximum attachments to get 
	$photo_size = 'large';		// The WP "size" to use for the large image

	if ( !is_array($args) ) 
		parse_str( $args, $args );
	extract($args);

	global $post;

	$id = get_the_id();
	$attachments = get_children( array(
	'post_parent' => $id,
	'numberposts' => $repeat,
	'post_type' => 'attachment',
	'post_mime_type' => 'image',
	'order' => 'ASC', 
	'orderby' => 'menu_order date')
	);
	if ( !empty($attachments) ) :
		$output = array();
		$count = 0;
		foreach ( $attachments as $att_id => $attachment ) {
			$count++;  
			if ($count <= $offset) continue;
			$url = wp_get_attachment_image_src($att_id, $photo_size, true);	
			if ( $url[0] != $exclude )
				$output[] = array( "url" => $url[0], "caption" => $attachment->post_excerpt );
		}  
	endif; 
	return $output;
}


/*-----------------------------------------------------------------------------------*/
/* Remove Meta From Array (Portfolio Single) */
/*-----------------------------------------------------------------------------------*/

	/* woo_remove_meta_from_array()
	 *
	 * Checks for data from each of the $meta_fields as removes
	 * it from the $array.
	 *
	 * Params:
	 * Array $array (required)
	 * Array $meta_fields (required)
	------------------------------------------------------------*/
	
	function woo_remove_meta_from_array ( $array, $meta_fields ) {
	
		global $post;
	
		// Make sure we've got the right data types.
		foreach ( array( $array, $meta_fields ) as $a ) {
		
			if ( ! is_array( $a ) ) { return; } // End IF Statement
		
		} // End FOREACH Loop
	
		// This is the custom code where we strip out all the images that are listed in custom meta fields.
		// 2011-01-05.
		
		$image_meta_fields = $meta_fields;
		
		$non_gallery_images = array();
			
		// If "upload" custom fields exist, check them for data on the current entry.
		
		if ( count( $image_meta_fields ) ) {
		
			foreach ( $image_meta_fields as $im ) {
			
				$_value = get_post_meta( $post->ID, $im, true );
				
				if ( $_value ) {
				
					$non_gallery_images[] = $_value;
				
				} // End IF Statement
			
			} // End FOREACH Loop
		
		} // End IF Statement
		
		// If we have non-gallery images and attachments, begin our custom processing.
		
		if ( count( $non_gallery_images ) && count( $array ) ) {
		
			foreach ( $array as $k => $v ) {
			
				if ( in_array( $v->guid, $non_gallery_images ) ) {
				
					unset( $array[$k] );
				
				} // End IF Statement
			
			} // End FOREACH Loop
		
		} // End IF Statement
		
		return $array;
	
	} // End woo_remove_meta_from_array()


add_filter( 'pre_get_posts', 'woo_show_portfolio_in_tag' );


/*-----------------------------------------------------------------------------------*/
/* Show portfolio posts in tag archives */
/*-----------------------------------------------------------------------------------*/
/*------------------------------------------------------------------------------------
 woo_show_portfolio_in_tag()
 -------------------------------------------------------------------------------------
 
 * Make sure `portfolio` posts display
 * in `post_tag` archives as well as
 * the default post types.
-------------------------------------------------------------------------------------*/

function woo_show_portfolio_in_tag ( $query ) {

   if ( $query->is_tag ) { $query->set( 'post_type', array( 'post', 'portfolio' ) ); }
   
   return $query;

} // End woo_show_portfolio_in_tag()

/*-----------------------------------------------------------------------------------*/
/* Show post tags in portfolio item breadcrumbs */
/* Modify woo_breadcrumbs() Arguments Specific to this Theme */
/*-----------------------------------------------------------------------------------*/

add_filter( 'woo_breadcrumbs_args', 'woo_filter_breadcrumbs_args', 10 );

if ( ! function_exists( 'woo_filter_breadcrumbs_args' ) ) {
	function woo_filter_breadcrumbs_args( $args ) {
	
		$args['singular_portfolio_taxonomy'] = 'post_tag';
	
		return $args;
	
	} // End woo_filter_breadcrumbs_args()
}

/*-----------------------------------------------------------------------------------*/
/* MISC */
/*-----------------------------------------------------------------------------------*/



?>
