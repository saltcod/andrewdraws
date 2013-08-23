<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package waterstreet
 * @since waterstreet 1.0
 */
?>

<div id="secondary" class="widget-area" role="complementary">

   <header id="masthead">
	<a href="<?php echo site_url(); ?>"><img src="<?php echo get_template_directory_uri();?>/assets/header.jpg"></a>
   </header>


  <div id="side-links">

	  <a class="about" href="/about"></a>	

	  	 <img src="<?php echo get_template_directory_uri();?>/assets/nav-dots.png">

			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
	  
	 	 <img src="<?php echo get_template_directory_uri();?>/assets/nav-dots.png">


	  	<?php /* Print out the next/prev on single pages only */ 
	  		if (is_single() ) { waterstreet_content_nav( 'nav-above' );}   ?>

	  
  </div>

	  <div id="email">
		<a class="buy" href="/buy"></a>
		<img class="side-bottom-border" src="/wp-content/uploads/2013/07/footer_border.jpg">
		<a class="email-link" href="/contact"></a>
	  </div>
 
</div>