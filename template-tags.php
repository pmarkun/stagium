<?php
/*
Template Name: Tags
*/
?>
<?php get_header(); ?>
       
    <div id="title-container">
	  <h1 class="title col-full"><?php the_title(); ?></h1>
	</div>
	 
    <div id="content" class="page col-full">
	      
		<div id="main" class="fullwidth">
	
			<?php if ( $woo_options[ 'woo_breadcrumbs_show' ] == 'true' ) woo_breadcrumbs(); ?>  			
		                                                                                    
            <div <?php post_class(); ?>>
                
	            <?php if (have_posts()) : the_post(); ?>
            	<div class="entry">
            		<?php the_content(); ?>
            	</div>	            	
	            <?php endif; ?>  
	            
                <div class="tag_cloud">
        			<?php wp_tag_cloud('number=0'); ?>
    			</div>

            </div><!-- /.post -->
        
		</div><!-- /#main -->
		
    </div><!-- /#content -->
		
<?php get_footer(); ?>