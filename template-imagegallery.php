<?php
/*
Template Name: Image Gallery
*/
?>
<?php get_header(); ?>
       
    <div id="title-container">
	  <h1 class="title col-full"><?php the_title(); ?></h1>
	</div>
	 
    <div id="content" class="page col-full">
	      
		<div id="main" class="col-left">
	
			<?php if ( $woo_options[ 'woo_breadcrumbs_show' ] == 'true' ) woo_breadcrumbs(); ?>  			
		                                                                            
            <div <?php post_class(); ?>>
                
				<div class="entry">

		            <?php if (have_posts()) : the_post(); ?>
	            	<?php the_content(); ?>
		            <?php endif; ?>  

                <?php query_posts('showposts=60'); ?>
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>				
                    <?php $wp_query->is_home = false; ?>

                    <?php woo_image('single=true&class=thumbnail alignleft'); ?>
                
                <?php endwhile; endif; ?>	
                </div>

            </div><!-- /.post -->
            <div class="fix"></div>                
                                                            
		</div><!-- /#main -->
		
        <?php get_sidebar(); ?>

    </div><!-- /#content -->
		
<?php get_footer(); ?>