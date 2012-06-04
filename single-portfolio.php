<?php get_header(); ?>
<?php global $woo_options, $post; ?>

    <?php
    		$featured_title = __('Portfolio', 'woothemes');
    
    		if ( is_array( $woo_options ) && @$woo_options['woo_single_portfolio_title'] ) {
						$featured_title = $woo_options[ 'woo_single_portfolio_title' ];
					}
	?>
					
    <div id="title-container">
	  <h1 class="title col-full"><?php echo $featured_title ?></h1>
	</div>
	 
    <div id="content" class="col-full">
        
		<div id="main" class="col-full"> 

	       	<?php if ( $woo_options[ 'woo_breadcrumbs_show' ] == 'true' ) woo_breadcrumbs(); ?>  	
		           
            <?php if (have_posts()) : $count = 0; ?>
            <?php while (have_posts()) : the_post(); $count++; ?>
                                                                        
                <div <?php post_class(); ?>>
               <?php $portfolio_gallery = $woo_options[ 'woo_portfolio_gallery' ] == 'true'; ?>
               
               <?php echo woo_embed( 'width=540' ); ?>
               
                <?php if ( $portfolio_gallery && !woo_embed('')) { ?>
                	<div id="gallery">
					<?php
						$gallery = do_shortcode('[gallery size="thumbnail" columns="4"]');
						
						if ( $gallery ) {
						
							// include('includes/gallery.php'); // Photo gallery
							
							$tpl_gallery = '';
							$tpl_gallery = locate_template( array( 'includes/gallery.php' ) );
							
							if ( $tpl_gallery ) {
							
								include( $tpl_gallery );
							
							} // End IF Statement
							
						} else {
							woo_image('key=portfolio-image&width=540&class=portfolio-img');  
						}
					?>
					</div>
					
					<?php } elseif ( !woo_embed('')) { ?><!-- End If portfolio_gallery -->
					
					<div id="gallery">
					<div class="entry">
                    	<?php woo_image('key=portfolio-image&width=540&class=portfolio-img'); ?>
					</div>
					</div>
					<?php } ?>
					
					<?php $testimonial = get_post_meta($post->ID, 'testimonial', true); ?>
               		<?php $testimonial_author = get_post_meta($post->ID, 'testimonial_author', true); ?>
               		<?php $url = get_post_meta($post->ID, 'url', true); ?>

					<div id="portfolio-content">
						<h2><?php the_title(); ?></h2>
						
						<?php the_tags( '<p class="tags">'.__( '', 'woothemes' ), ' ', '</p>' ); ?>
						
                    	<div class="entry">	
	                	<?php the_content(); ?>
	                	 <?php if ( $url ) { ?><a class="button" href="<?php echo $url; ?>"><?php _e( 'Visit Website', 'woothemes' ); ?></a><?php } ?>
	               	</div><!-- /.entry -->
	               	
	               	<?php if ( $testimonial) { ?>               
	               	<div id="testimonial">
	               	<h3><?php _e( 'Client Testimonial', 'woothemes' ); ?></h3>
	               	<div class="quote">
                        <?php if ( $testimonial ) { ?><blockquote><?php echo $testimonial; ?></blockquote><?php } // End IF Statement ?>
                        <?php if ( $testimonial_author ) { ?><cite>&ndash; <?php echo $testimonial_author; ?> <?php if ( $url ) { ?> - <a href="<?php echo $url; ?>"><?php echo $url; ?></a><?php } ?></cite><?php } // End IF Statement ?>
                    </div>	               	
	               	</div>
	               	<?php } ?><!-- End If -->
	               	
	               	</div><!-- /#portfolio-content -->
					<div class="fix"></div>
					<?php edit_post_link( __('{ Edit }', 'woothemes'), '<span class="small">', '</span>' ); ?>
                </div><!-- /.post -->
                                                                    
			<?php endwhile; else: ?>
				<div class="post">
                	<p><?php _e('Sorry, no posts matched your criteria.', 'woothemes') ?></p>
                </div><!-- /.post -->
            <?php endif; ?>  
        
		</div><!-- /#main -->

    </div><!-- #content -->
		
<?php get_footer(); ?>