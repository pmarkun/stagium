<?php get_header(); ?>

<?php global $woo_options; ?>

       

    <div id="title-container">

	  <h1 class="title col-full"><?php the_title(); ?></h1>

	</div>

	 

    <div id="content" class="col-full">

            

		<div id="main" class="col-left">



       	<?php if ( $woo_options[ 'woo_breadcrumbs_show' ] == 'true' ) woo_breadcrumbs(); ?>  	

				           

        <?php if (have_posts()) : $count = 0; ?>

        <?php while (have_posts()) : the_post(); $count++; ?>

        

			<div <?php post_class(); ?>>

                		

				<?php echo woo_embed( 'width=580' ); ?>

                <?php if ( $woo_options[ 'woo_thumb_single' ] == "true" && !woo_embed( '')) woo_image( 'width='.$woo_options[ 'woo_single_w' ].'&height='.$woo_options[ 'woo_single_h' ].'&class=thumbnail '.$woo_options[ 'woo_thumb_single_align' ]); ?>

                                                

                <div class="entry">

                	<?php the_content(); ?>

					<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Páginas:', 'woothemes' ), 'after' => '</div>' ) ); ?>

				</div>



                <?php woo_post_meta(); ?>

									

				<?php the_tags( '<p class="tags">'.__( 'Tags: ', 'woothemes' ), ' ', '</p>' ); ?>

                                

            </div><!-- .post -->



			<?php if ( $woo_options[ 'woo_post_author' ] == "true" ) { ?>

				<div class="fix"></div>

			<?php } ?>



			<?php woo_subscribe_connect(); ?>



	        <div id="post-entries">

	            <div class="nav-prev fl"><?php previous_post_link( '%link', '<span class="meta-nav">&larr;</span> %title' ) ?></div>

	            <div class="nav-next fr"><?php next_post_link( '%link', '%title <span class="meta-nav">&rarr;</span>' ) ?></div>

	            <div class="fix"></div>

	        </div><!-- #post-entries -->

            

            <?php $comm = $woo_options[ 'woo_comments' ]; if ( ($comm == "post" || $comm == "both") ) : ?>

                <?php comments_template( '', true); ?>

            <?php endif; ?>

                                                

		<?php endwhile; else: ?>

			<div <?php post_class(); ?>>

            	<p><?php _e( 'Sorry, no posts matched your criteria.', 'woothemes' ) ?></p>

			</div><!-- .post -->             

       	<?php endif; ?>  

        

		</div><!-- #main -->



        <?php get_sidebar(); ?>



    </div><!-- #content -->

		

<?php get_footer(); ?>