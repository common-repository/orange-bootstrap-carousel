<?php
/*
Plugin Name: Orange Bootstrap Carousel
Plugin URI: #
Description: A custom post type for choosing images and content which outputs <a href="http://getbootstrap.com/javascript/#carousel" target="_blank">Bootstrap Carousel</a> from a shortcode. Requires Bootstrap javascript and CSS to be loaded separately.
Version: 0.0.1
Author: Nabajit Roy
Author URI: http://www.orangecoders.com
Text Domain: bootstrap-carousel
License: GPLv2
*/
require_once('carousel_functions.php');
class orange_bootstrap_carousel extends carousel_functions{
 
     
  function __construct() {
    parent::__construct();
    register_activation_hook( __FILE__, array( $this, 'install' ) );
    register_deactivation_hook( __FILE__, array( $this, 'uninstall' ) );
  }
  
  // Shortcode implementation
    function orange_slider_shortcode($atts){
	return $this->orange_slider();
    }
  
  function orange_slider(){
        $settings  = (object) get_option( 'orange_slider_settings');
	//print_r($settings);
        $id = rand(0, 999); // use a random ID so that the CSS IDs work with multiple on one page
	$args = array(
		'post_type' => 'orange-slider',
		//'posts_per_page' => '-1',
		//'orderby' => $atts['orderby'],
		//'order' => $atts['order']
	);
        // Collect the carousel content. Needs printing in two loops later (bullets and content)
	$loop = new WP_Query( $args );
	$sliders = array();
	$output = '';
	$image_animation = 'animated ' .$settings->slider_image_animation; 
	while ( $loop->have_posts() ) : $loop->the_post();
	  $meta = get_post_meta(get_the_ID());
 
	  if ( '' != $meta['slider_image'][0] ) {
	    $sliders[] =  array(
	       'post_id' =>  get_the_ID(),
	       'title' => get_the_title(),
	       'excerpt' => get_the_excerpt(),
	       'image'=>   wp_get_attachment_image( $meta['slider_image'][0], $settings->image_size , false, array( 'class' => 'img-responsive' ,'data-animation'=> 'animated ' .$settings->slider_image_animation) ), 
	       'bullets'=> maybe_unserialize($meta['bullets'][0]),
	     );
	 
	   }
        endwhile;  
  ?>
  
  <div id="orange-carousel-<?php echo $id?>" class="orange-carousel carousel slide"  data-interval="<?php echo $settings->slider_speed?>" style="background: <?php echo $settings->slider_bg_color?>">
  
  
  <?php
  // Check we actually have something to show
	 if(count($sliders) > 0){
	        $active = 1;
		$data_slide=0;
		$count = count($sliders);
		ob_start();
    ?>
  
  <!-- Indicators -->
  <ol class="carousel-indicators">
      <?php while( --$count >=0): ?>
	  <li data-target="#orange-carousel-<?php echo $id?>" data-slide-to="<?php echo $data_slide++; ?>" class="<?php $active ? print 'active':'' ?>"></li>
	 <?php $active = 0;?>
      <?php endwhile; ?> 
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox" style="max-height: <?php  echo $settings->slider_height;?>">

   <?php $active =1; ?>
    <?php foreach ($sliders as $key => $value): ?>
   
    <!--  sliders -->
    <div class="item  <?php $active ? print 'active':'' ?>"  >
      <div class="carousel-caption">
  
            <div class="col-md-6 col-sm-6 align-left">
	      <h1 data-animation="animated <?php echo $settings->slider_title_animation;?>" class="carousel-title"><?php echo $value['title'];?> </h1>
	      <h2 data-animation="animated <?php echo $settings->slider_excerpt_animation;?>" class="crousel-subtitle "><?php echo $value['excerpt'];?> </h2>
	      <ul class="list-unstyled carousel-list">
		    <?php foreach ($value['bullets'] as $key => $bullet): ?>
			<li  class="delay-<?php echo $key;?>" data-animation="animated <?php echo $settings->slider_bullets_animation;?>"><i class="fa fa-check"></i><?php echo $bullet['bullets'];?></li>
		     <?php endforeach; ?>  
               </ul>
	      
	    </div>
	    <div class="col-md-6 col-sm-6  align-left">
	     <?php echo $value['image'];?>
	    </div>
      
	   
      </div>
    </div><!-- /.item -->
    <?php $active = 0;?>
    <?php endforeach; ?>  
     
    
    
    
    
    
    
    
    

  </div><!-- /.carousel-inner -->

  <!-- Controls -->
  <a class="left carousel-control" href="#orange-carousel-<?php echo $id?>" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#orange-carousel-<?php echo $id?>" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
 
  
</div><!-- /.carousel -->
       
    <?php  
   
       // Collect the output
		$output = ob_get_contents();
		ob_end_clean();
	 }
	
	// Restore original Post Data
	wp_reset_postdata();  
	
	return $output;
       
    }    
       
       
  
  
  
  
  
  
  
}
new orange_bootstrap_carousel();