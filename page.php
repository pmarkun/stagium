<?php get_header(); ?>

<?php global $woo_options; ?>

           

    <div id="title-container">

	  <h1 class="title col-full"><?php the_title(); ?></h1>

	</div>

	 

    <div id="content" class="page col-full">

        

		<div id="main" class="col-left">

	

		<?php if ( $woo_options[ 'woo_breadcrumbs_show' ] == 'true' ) woo_breadcrumbs(); ?>  			

	           

        <?php if (have_posts()) : $count = 0; ?>

        <?php while (have_posts()) : the_post(); $count++; ?>

            

            <?php if ( get_option( 'woo_subnav' ) == 'true' ) { ?>		

			<div id="sub_nav">		

				<?php $exclude = woo_exclude_pages(); ?>

				<?php wp_page_menu('show_home=1&sort_column=menu_order&depth=1&title_li=&exclude=' . $exclude . ',' . get_option( 'woo_exclude_pages_subnav' ) ); ?>

			</div><!-- /sub_nav -->

			<?php } ?>

                                                                    

            <div <?php post_class(); ?>>



                <div class="entry">

                	<?php the_content(); ?>



					<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'woothemes' ), 'after' => '</div>' ) ); ?>

               	</div><!-- /.entry -->



				<?php edit_post_link( __( '{ Edit }', 'woothemes' ), '<span class="small">', '</span>' ); ?>

                

            </div><!-- /.post -->

            

            <?php $comm = $woo_options[ 'woo_comments' ]; if ( ($comm == "page" || $comm == "both") ) : ?>

                <?php comments_template(); ?>

            <?php endif; ?>

                                                

		<?php endwhile; else: ?>

			<div <?php post_class(); ?>>

            	<p><?php _e( 'Sorry, no posts matched your criteria.', 'woothemes' ) ?></p>

            </div><!-- /.post -->

        <?php endif; ?>  

        

		</div><!-- /#main -->



        <?php get_sidebar(); ?>



    </div><!-- /#content -->

		

<?php get_footer(); ?>