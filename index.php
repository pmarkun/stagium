<?php
	global $woo_options;
	get_header();
	
	// Determine whether or not the homepage sidebar is enabled (enabled by default).
	// Also determine the various differences in logic if the sidebar is enabled/disabled.
	$has_sidebar = true;
	$content_css_class = ' home-sidebar';
	$main_css_class = 'col-left';
	$mini_features_count = 2;
	$portfolio_count = 2;
	$apresentacoes_count = 2;
	
	if ( isset( $woo_options['woo_home_sidebar'] ) && $woo_options['woo_home_sidebar'] == 'false' ) {
		$has_sidebar = false;
		$content_css_class = '';
		$main_css_class = 'col-full';
		$mini_features_count = 3;
		$portfolio_count = 4;
		$apresentacoes_count = 4;
	}
?>
    <div id="content" class="col-full<?php echo $content_css_class; ?>">
		<div id="main" class="<?php echo $main_css_class; ?>">      
            <?php
            	if ( ! isset( $woo_options['woo_home_posts'] ) || ( isset( $woo_options['woo_home_posts'] ) && $woo_options['woo_home_posts'] == 'false' ) ) {
            		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
				  	query_posts( 'suppress_filters=0&post_type=post&paged=' . $paged );
				 
				if ( isset( $woo_options['woo_mini_features'] ) && $woo_options['woo_mini_features'] == 'true' ) {
				
					$featured_title = __( 'Why Are People Choosing Us?', 'woothemes' );
					$mini_features_number = 3;
					
					if ( isset( $woo_options['woo_sub_featured_title'] ) && $woo_options['woo_sub_featured_title'] ) {
						$featured_title = $woo_options['woo_sub_featured_title'];
					}
					
					if ( isset( $woo_options['woo_mini_features_number'] ) && $woo_options['woo_mini_features_number'] ) {
						$mini_features_number = intval( $woo_options['woo_mini_features_number'] );
					}
				
				/* Mini-Features */
			?>
			<div id="sub-featured" class="<?php echo $main_css_class; ?> section">
	        	<h2 class="section-title"><?php echo stripslashes( $featured_title ); ?></h2>
	        
	        	<?php 
	        		query_posts( 'suppress_filters=0&post_type=infobox&order=ASC&posts_per_page=' . $mini_features_number );
	        		if ( have_posts() ) { $count = 0; while ( have_posts() ) { the_post(); $count++;
	        		
					$excerpt = stripslashes( get_post_meta( $post->ID, 'mini_excerpt', true ) ); 
					$button = get_post_meta( $post->ID, 'mini_readmore', true );
					$post_class = 'post block';
					
					if ( $count % $mini_features_count == 0 ) { $post_class .= ' last'; }
				?>
	        		<div <?php post_class( $post_class ); ?>>
	        						
							<a href="<?php echo $button; ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php woo_image( 'key=mini-image&width=300&height=100&class=thumbnail aligncenter&link=img' ); ?></a>
							
							<h3 class="title"><a href="<?php echo $button; ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
							<?php if ( $excerpt ) { ?>
							<div class="entry">
	                			<?php echo $excerpt; ?>
	            			</div>
	            			<?php } ?>
	            				            			
	            	</div><!-- /.post -->
	            <?php
	            	if ( $count % $mini_features_count == 0 ) { echo '<div class="fix"></div>'; }
		        	} // End WHILE Loop
		       	} else {
		        ?>
	            	<div class="post">
	                	<p><?php _e( 'Sorry, no posts matched your criteria.', 'woothemes' ); ?></p>
	            	</div><!-- /.post -->
		        <?php } // End IF Statement ?>  
		    </div><!-- /#mini-features -->
		    <?php } // End IF Statement ?>

<?php
        		/* Destaques - Apresentações */
        		if ( isset( $woo_options['woo_apresentacoes'] ) && $woo_options['woo_apresentacoes'] == 'true' ) {
        		
        			$featured_title = __( 'Últimas Apresentações', 'woothemes' );
        			$apresentacoes_number = 4;
					
					if ( isset( $woo_options['woo_titulo_apresentacoes'] ) && $woo_options['woo_titulo_apresentacoes'] != '' ) {
						$featured_title = $woo_options['woo_titulo_apresentacoes'];
					}
					
					if ( isset( $woo_options['woo_numero_apresentacoes'] ) && $woo_options['woo_numero_apresentacoes'] != '' ) {
						$apresentacoes_number = intval( $woo_options[ 'woo_numero_apresentacoes' ] );
					}
        	?>
			<div id="apresentacoes" class="<?php echo $main_css_class; ?> section">
		        <h2 class="section-title"><?php echo stripslashes( $featured_title ); ?></h2>
	        	<?php 
	        		query_posts( 'suppress_filters=0&post_type=apresentacoes&order=ASC&posts_per_page=' . $numero_apresentacoes );
	        		if ( have_posts() ) { $count = 0; while ( have_posts() ) { the_post(); $count++;
	        		
					$excerpt = stripslashes( get_post_meta( $post->ID, 'resumo_apresentacoes', true ) ); 
					$button = get_post_meta( $post->ID, 'mais_apresentacoes', true );
					$post_class = 'post block';
					
					if ( $count % $apresentacoes_count == 0 ) { $post_class .= ' last'; }
				?>
	        		<div <?php post_class( $post_class ); ?>>
	        						
							<a href="<?php echo $button; ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php woo_image( 'key=imagem-apresentacoes&width=214&height=119&class=thumbnail aligncenter&link=img' ); ?></a>
							
							<h3 class="title"><a href="<?php echo $button; ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
							<?php if ( $excerpt ) { ?>
							<div class="entry">
	                			<?php echo $excerpt; ?>
	            			</div>
	            			<?php } ?>
					</div>
				<?php if ( $count % $apresentacoes_count == 0 ) { echo '<div class="fix"></div>'; }  ?>
		        <?php
		        	} // End WHILE Loop
		        } else {
		        ?>
	            <div class="post">
	                <p><?php _e( 'Sorry, no posts matched your criteria.', 'woothemes' ); ?></p>
	            </div><!-- /.post -->
		        <?php } // End IF Statement ?>
		        <div class="fix"></div>
		    </div>
		    <?php } // End IF Statement ?>
		    <!-- /Destaques - Apresentações -->
        	<?php
        		/* Portfolio */
        		if ( isset( $woo_options['woo_portfolio'] ) && $woo_options['woo_portfolio'] == 'true' ) {
        		
        			$featured_title = __( 'Our Latest Work', 'woothemes' );
        			$portfolio_number = 4;
					
					if ( isset( $woo_options['woo_portfolio_title'] ) && $woo_options['woo_portfolio_title'] != '' ) {
						$featured_title = $woo_options['woo_portfolio_title'];
					}
					
					if ( isset( $woo_options['woo_portfolio_number'] ) && $woo_options['woo_portfolio_number'] != '' ) {
						$portfolio_number = intval( $woo_options[ 'woo_portfolio_number' ] );
					}
        	?>
			<div id="portfolio" class="<?php echo $main_css_class; ?> section">
		        <h2 class="section-title"><?php echo stripslashes( $featured_title ); ?></h2>
		        <?php query_posts( 'suppress_filters=0&post_type=portfolio&posts_per_page=' . $portfolio_number ); ?>
		        <?php
		        	if ( have_posts() ) { $count = 0;
		        	while ( have_posts() ) { the_post(); $count++;
		        	
		        	$post_class = 'post block';
					if ( $count % $portfolio_count == 0 ) { $post_class .= ' last'; }
					
					$excerpt = woo_text_trim( get_the_excerpt(), '12');
		        ?>
					<div <?php post_class( $post_class ); ?>>
						<div class="portfolio-img">
							<a href="<?php the_permalink(); ?>" class="portfolio-link" title="<?php the_title_attribute(); ?>"><?php woo_image( 'key=portfolio-image&width=214&height=119&class=thumbnail aligncenter&link=img' ); ?></a>
						</div>
						
						<h3><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
						<?php if ( $excerpt ) { ?>
						<div class="entry">
                			<?php echo $excerpt; ?>
            			</div>
            			<?php } ?>
					</div>
				<?php if ( $count % $portfolio_count == 0 ) { echo '<div class="fix"></div>'; }  ?>
		        <?php
		        	} // End WHILE Loop
		        } else {
		        ?>
	            <div class="post">
	                <p><?php _e( 'Sorry, no posts matched your criteria.', 'woothemes' ); ?></p>
	            </div><!-- /.post -->
		        <?php } // End IF Statement ?>  
		        <div class="fix"></div>
		    </div>
		    <?php } // End IF Statement ?>
		    <!-- /Portfolio -->
    
    	    <!-- Testimonials -->   
    	    <?php if ( isset( $woo_options['woo_testimonials'] ) && $woo_options['woo_testimonials'] == 'true' ) { ?>             
            <div id="testimonials" class="<?php if ($woo_options['woo_home_sidebar'] == 'false' ) echo 'col-full '; ?>section">            
                <h2 class="section-title"><?php if ( $woo_options['woo_info_quote_title'] ) { echo stripslashes( $woo_options['woo_info_quote_title'] ); } else { _e( 'What Our Clients Say', 'woothemes' ); } ?></h2>
                <div class="quote-icon"></div>
            	<div class="quotes">
		        <?php
		        	query_posts( 'suppress_filters=0&post_type=testimonial&order=ASC&posts_per_page=20' );
		        	if ( have_posts() ) { while ( have_posts() ) { the_post();
		        	
		        	$author = get_post_meta( $post->ID, 'testimonial_author', $single = true );
		        	$url = get_post_meta( $post->ID, 'testimonial_url', $single = true );
            	?>
                	<div class="quote">
                        <blockquote><?php the_content(); ?></blockquote>
                        <?php if ( $author ) { ?><cite>&ndash; <?php echo $author; ?> <?php if ( $url ) { ?> - <a href="<?php echo $url; ?>"><?php echo $url; ?></a><?php } ?></cite><?php } // End IF Statement ?>
                    </div>
	            <?php
	            		} // End WHILE Loop
	            	} // End IF Statement	
	            ?>
	            
                </div>
            </div>
	        <?php
	        	} // End IF Statement
	        	/* End Testimonials Section */
	            } else { //End Home Posts IF Statement
	            
	            if ( get_query_var( 'paged' ) ) { $paged = get_query_var( 'paged' ); } elseif ( get_query_var( 'page' ) ) { $paged = get_query_var( 'page' ); } else { $paged = 1; }
	            
	            query_posts( 'suppress_filters=0&post_type=post&paged=' . $paged );
	            
	            if ( have_posts() ) { $count = 0; while ( have_posts() ) { the_post(); $count++;
	        ?>
            <div <?php post_class(); ?>>

                <?php if ( $woo_options['woo_post_content'] != 'content' ) { woo_image( 'width=' . $woo_options['woo_thumb_w'] . '&height=' . $woo_options['woo_thumb_h'] . '&class=thumbnail ' . $woo_options['woo_thumb_align'] ); } ?> 
                
                <h2 class="title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                <?php woo_post_meta(); ?>
                <div class="entry">
					<?php global $more; $more = 0; ?>	                                        
                    <?php if ( $woo_options['woo_post_content'] == 'content' ) { the_content( __( 'Read More...', 'woothemes' ) ); } else { the_excerpt(); } ?>
                </div>
    			<div class="fix"></div>
    			
                <div class="post-more">      
					<span class="comments"><?php comments_popup_link( __( 'Leave a comment', 'woothemes' ), __( '1 Comment', 'woothemes' ), __( '% Comments', 'woothemes' ) ); ?></span>
                	<?php if ( $woo_options['woo_post_content'] == 'excerpt' ) { ?>
					<span class="post-more-sep">&bull;</span>
                    <span class="read-more"><a href="<?php the_permalink(); ?>" title="<?php esc_attr_e( 'Continue Reading &rarr;','woothemes' ); ?>"><?php _e( 'Continue Reading &rarr;','woothemes' ); ?></a></span>
                    <?php } ?>
                </div>   
    
            </div><!-- /.post -->                                   
        <?php
        		}
        	} else {
        ?>
            <div <?php post_class(); ?>>
                <p><?php _e( 'Sorry, no posts matched your criteria.', 'woothemes' ); ?></p>
            </div><!-- /.post -->
        <?php
        	}  
            woo_pagenav();
            wp_reset_query();
			}
        ?>
		</div><!-- /#main -->
		<?php if ( isset( $woo_options['woo_home_sidebar'] ) && $woo_options['woo_home_sidebar'] == 'true' ) { get_sidebar(); } ?>
    </div><!-- /#content -->
<?php get_footer(); ?>
