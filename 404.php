<?php get_header(); ?>
       
    <div id="title-container">
	  <h1 class="title col-full"><?php _e( 'Not Found', 'woothemes' ); ?></h1>
	</div>
	 
    <div id="content" class="page col-full">
    
		<?php if ( $woo_options[ 'woo_breadcrumbs_show' ] == 'true' ) { ?>
			<div id="breadcrumbs">
				<?php woo_breadcrumbs(); ?>
			</div><!--/#breadcrumbs -->
		<?php } ?>  			

		<div id="main" class="col-left">
                                                                                
            <div <?php post_class(); ?>>

                <h1 class="title"><?php _e('Error 404 - Page not found!', 'woothemes') ?></h1>
                <p><?php _e('The page you trying to reach does not exist, or has been moved. Please use the menus or the search box to find what you are looking for.', 'woothemes') ?></p>

            </div><!-- /.post -->
                                                
        </div><!-- /#main -->

        <?php get_sidebar(); ?>

    </div><!-- /#content -->
		
<?php get_footer(); ?>