<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package waterstreet
 * @since waterstreet 1.0
 */

get_header(); ?>


<?php get_sidebar(); ?>


<div id="primary" class="content-area">
	<div id="content" class="site-content" role="main">

		<div class="featured-images">


			<div id="loader"><img src="<?php echo get_template_directory_uri();?>/images/ajax-loader.gif" alt="loading"></div>

			<div id="illustrations">

				<?php
				function category_class(){
					$category = get_the_category(); 
					echo $category[0]->category_nicename;
				}


			// The Query
				$query = new WP_Query( array(
					'posts_per_page' => -1
					)
				);

				if ( $query->have_posts() ): ?>
				<?php while ( $query->have_posts() ):  ?>
				<?php $query->the_post(); ?>
				
				<div class="post-thumbnail <?php category_class();?>"> <a href="<?php the_permalink();?>">

					<?php 
					if (class_exists('MultiPostThumbnails')) {

                // Set Thumbnail
						$thumb = MultiPostThumbnails::the_post_thumbnail(get_post_type(), 'secondary-image');
						$has_thumb = MultiPostThumbnails::has_post_thumbnail(get_post_type(), 'secondary-image', strval(get_the_ID()));

                // Thumbnail exist? Else show Not Found
						if ($has_thumb) : echo $thumb; else : the_post_thumbnail(); endif;

                // Plugin not found.
					} else {

						echo "MultiPostThumbnails Not Found.";

					}
					?>


				</a>
			</div>


		<?php endwhile; ?>
	<?php endif; ?>
	
	<?php wp_reset_postdata();

	?>
</div>




</div><!-- #content .site-content -->
</div><!-- #primary .content-area -->

<?php get_footer(); ?>