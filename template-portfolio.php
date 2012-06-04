<?php
/*
Template Name: Portfolio
*/

	global $woo_options;
	get_header();
?>
       
    <div id="title-container">
	  <h1 class="title col-full"><?php the_title(); ?></h1>
	</div>
	 
    <div id="content" class="page col-full">
	  
		<?php if ( $woo_options[ 'woo_breadcrumbs_show' ] == 'true' ) { ?>
			<div id="breadcrumbs">
				<?php woo_breadcrumbs(); ?>
			</div><!--/#breadcrumbs -->
		<?php } ?> 
		 			
		<?php
			if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } elseif ( get_query_var('page') ) { $paged = get_query_var('page'); } else { $paged = 1; }
			$args = array(
							'post_type' => 'portfolio', 
							'paged' => $paged, 
							'meta_key' => 'portfolio-image', 
							'posts_per_page' => -1
						);
			query_posts( $args );
			 
			rewind_posts();
		?>

		<div id="main" class="fullwidth"> 
				           
		    <div id="portfolio" class="col-full">
		    	
		    	<!-- Tags -->
				<?php
					$terms = $woo_options['woo_portfolio_tags'];
					if ( $terms ) {
						$terms_string = '';
						
						foreach ( explode( ', ', $terms ) as $t ) {
							$tag = trim( $t );
							$tag = str_replace (" ", "-", $tag);	
							$tag = str_replace ("/", "-", $tag);
							$tag = strtolower ( $tag );
							$terms_string .= ' <a rel="' . $tag . '" href="#' . $tag . '" title="' . ucwords( $t ) . '">' . ucwords( $t ) . '</a>';
						} // End FOREACH Loop
				?>
		    	<div id="port-tags">
		            <div class="fl">
		                <span class="port-cat"><?php _e('Select a category:', 'woothemes'); ?> <a href="#" rel="all" class="current"><?php _e( 'All','woothemes' ); ?></a><?php echo $terms_string; ?></span>
		            </div>
			      	<div class="fix"></div>
			    </div>
			      
				<?php } ?>
				<!-- /Tags -->
				<div class="portfolio">
		        <?php if ( have_posts() ) : while (have_posts()) : the_post(); $count++; ?>
		        <?php 
					// Portfolio tags class
					$porttag = ""; 
					$posttags = get_the_tags(); 
					if ($posttags) { 
						foreach($posttags as $tag) { 
							$tag = $tag->name;
							$tag = str_replace (" ", "-", $tag);	
							$tag = str_replace ("/", "-", $tag);
							$tag = strtolower ( $tag );
							$porttag .= $tag . ' '; 
						} 
					}
					
					$excerpt = woo_text_trim( get_the_excerpt(), '12');
										
				?>
					<div class="group post portfolio-img <?php echo trim( $porttag ); ?>">
									
					<?php if ( woo_image('key=portfolio-image&return=true') ) : 

                    	// Check if there is a gallery in post
						// woo_get_post_images is offset by 1 by default. Setting to offset by 0 to show all images
                    	$gallery = woo_get_post_images('0');
                    	$large =  get_post_meta( $post->ID, 'portfolio-image', true );
                    	if ( $gallery ) {
                    		// Get first uploaded image in gallery
                    		$large = $gallery[0]['url'];
                    		$caption = $gallery[0]['caption'];
	                    } 
	                    
	                    // Check for a post thumbnail, if support for it is enabled.
	                    if ( ( $woo_options['woo_post_image_support'] == 'true' ) && current_theme_supports( 'post-thumbnails' ) ) {
	                    	$image_id = get_post_thumbnail_id( $post->ID );
	                    	if ( intval( $image_id ) > 0 ) {
	                    		$large_data = wp_get_attachment_image_src( $image_id, 'large' );
	                    		if ( is_array( $large_data ) ) {
	                    			$large = $large_data[0];
	                    		}
	                    	}
	                    }
	                    
	                    $lightbox_url = get_post_meta( $post->ID, 'lightbox-url', true );
	                    
	                    // See if lightbox-url custom field has a value
	                    if ( $lightbox_url != '' ) {
	                    	$large = $lightbox_url;
	                    }
	                    
	                    // Set rel on anchor to show lightbox
                  		$rel = 'rel="lightbox['. $post->ID .']"';
					 ?>
	                    
                    <a <?php echo $rel; ?> title="<?php echo $caption; ?>" href="<?php echo $large; ?>" class="thumb">
						<?php woo_image('key=portfolio-image&width=214&height=119&link=img&alt=' . esc_attr( get_the_title() ) . ''); ?>
                    </a>
					<h3><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
                    
                    <?php 
                    	// Output image gallery for lightbox
                    	if ( $gallery ) {
	                    	foreach ( array_slice( $gallery, 1 ) as $img => $attachment ) {
	                    		echo '<a '.$rel.' title="'.$attachment['caption'].'" href="'.$attachment['url'].'" class="gallery-image"></a>';	                    
	                    	}
	                    	unset( $gallery );
	                    }
                    endif; ?>
					
					<?php if ( $excerpt ) { ?><div class="excerpt"><?php echo $excerpt; ?></div><?php } ?>
					</div>
		        
		        <?php endwhile; else : ?>
		        
				<div class="post">
				     <p class="note">You need to setup the <strong>Portfolio</strong> options and select a category for your portfolio posts.</p>
                </div><!-- /.post -->
		        
		        <?php endif; ?>  
				</div>	        		        
			
		    </div><!-- /#portfolio -->
                                                            
            <?php woo_pagenav(); ?>
		</div><!-- /#main -->

    </div><!-- /#content -->
		
<?php get_footer(); ?>