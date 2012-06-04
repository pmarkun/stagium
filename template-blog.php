<?php
/*
Template Name: Blog
*/
?>
<?php get_header(); ?>
<?php global $woo_options; ?>

    <!-- #content Starts -->
	<?php woo_content_before(); ?>
	
    <div id="title-container">
	  <h1 class="title col-full"><?php the_title(); ?></h1>
	</div>
	 
    <div id="content" class="page col-full">
	          
        <!-- #main Starts -->
        <div id="main" class="col-left">      

		<?php if ( $woo_options[ 'woo_breadcrumbs_show' ] == 'true' ) woo_breadcrumbs(); ?>  			
        					
        <?php if ( get_query_var('paged') ) $paged = get_query_var('paged'); elseif ( get_query_var('page') ) $paged = get_query_var('page'); else $paged = 1; ?>
        <?php query_posts("post_type=post&paged=$paged"); ?>
        <?php if (have_posts()) : $count = 0; while (have_posts()) : the_post(); $count++; ?>
                                                                    
            <!-- Post Starts -->
            <div <?php post_class(); ?>>

                <?php if ( $woo_options[ 'woo_post_content' ] != "content" ) woo_image('width='.$woo_options[ 'woo_thumb_w' ].'&height='.$woo_options[ 'woo_thumb_h' ].'&class=thumbnail '.$woo_options[ 'woo_thumb_align' ]); ?> 
                
                <h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                
                <?php woo_post_meta(); ?>
                
                <div class="entry">
					<?php global $more; $more = 0; ?>	                                        
                    <?php if ( $woo_options[ 'woo_post_content' ] == "content" ) the_content(__('Leia Mais...', 'woothemes')); else the_excerpt(); ?>
                </div>
    			<div class="fix"></div>
    			
                <div class="post-more">      
					<span class="comments"><?php comments_popup_link(__('Deixe um comentário', 'woothemes'), __('1 Comentário', 'woothemes'), __('% Comentários', 'woothemes')); ?></span>
                	<?php if ( $woo_options[ 'woo_post_content' ] == "excerpt" ) { ?>
					<span class="post-more-sep">&bull;</span>
                    <span class="read-more"><a href="<?php the_permalink() ?>" title="<?php _e('Continue Lendo &rarr;','woothemes'); ?>"><?php _e('Continue Lendo &rarr;','woothemes'); ?></a></span>
                    <?php } ?>
                </div>   
    
            </div><!-- /.post -->
                                                
        <?php endwhile; else: ?>
            <div <?php post_class(); ?>>
                <p><?php _e('Sorry, no posts matched your criteria.', 'woothemes') ?></p>
            </div><!-- /.post -->
        <?php endif; ?>  
    
            <?php woo_pagenav(); ?>
			<?php wp_reset_query(); ?>                

        </div><!-- /#main -->
            
		<?php get_sidebar(); ?>

    </div><!-- /#content -->    
		
<?php get_footer(); ?>