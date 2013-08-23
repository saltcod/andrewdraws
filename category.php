<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package waterstreet
 * @since waterstreet 1.0
 */

get_header(); ?>
<?php get_sidebar(); ?>

<section id="primary" class="content-area">
	<div id="content" class="site-content" role="main">
		<div id="illustrations">
			<?php if ( have_posts() ) : ?>
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

			<div class="post-thumbnail"> 
				<a href="<?php the_permalink();?>">
				
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



 


				</a>
			 







		<?php endwhile; ?>


	<?php else : ?>

	<?php get_template_part( 'no-results', 'archive' ); ?>

<?php endif; ?>
</div>
</div><!-- #content .site-content -->
</section><!-- #primary .content-area -->
<?php get_footer(); ?>
