<?php
require_once('orange-bootstrap-carousel_settings.php');
class carousel_functions{
    public $post_type;
    public $settings;
    function __construct() {
          $this->post_type = 'orange-slider';
	  $this->settings = new orange_bootstrap_carousel_settings();
          add_action( 'init', array( $this, 'setup_post' ));
          add_action('add_meta_boxes', array( $this,'add_slider_metaboxes'));
          add_action('save_post', array($this,'save_orange_slider_meta'), 1, 2); // save the custom fields
          add_action('save_post', array($this,'save_podcasts_meta'), 2, 2); 
          add_action( 'admin_enqueue_scripts', array($this,'add_scripts') );
	  add_shortcode('orange-slider-shortcode', array($this,'orange_slider_shortcode'));
	  add_action( 'wp_enqueue_scripts', array($this,'add_front_end_scripts') );
	  add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
	  //Remove this on production
	   add_filter( 'pre_http_request', '__return_true', 100 );
    }
      
  
  
    function add_plugin_page(){
       add_submenu_page('edit.php?post_type=orange-slider', __('Settings', 'cpt-bootstrap-carousel'), __('Settings', 'cpt-bootstrap-carousel'), 'manage_options', 'orange-carousel-slider-settings', array( $this->settings,'carousel_settings'));
    }
  
    
    
    function add_slider_metaboxes() {
        add_meta_box(
                 'orange_slider_image',
                 __( 'Slider image', 'orange_textdomain' ),
                 array($this,'slider_image'),
                 'orange-slider'
        );
        
        add_meta_box(
                 'orange_slider_custom_fields',
                 __( 'Slider bullets', 'orange_textdomain' ),
                 array($this,'slider_custom_fields'),
                 'orange-slider'
        );
    }
    function add_scripts() {
        wp_enqueue_media();
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
	wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_style('thickbox');
        wp_enqueue_script( 'orange-slider-scripts',plugins_url('js/scripts.js', __FILE__),array( 'wp-color-picker' ), false, true );
        wp_enqueue_style('orange-slider-styles',  plugin_dir_url('orange-bootstrap-carousel') . 'orange-bootstrap-carousel/css/style.css');
    }
   
    function add_front_end_scripts() {
	wp_enqueue_script( 'bootstrap-js', plugins_url('js/bootstrap.js', __FILE__),array('jquery') );
	wp_enqueue_script( 'orange-slider-front-scripts',plugins_url('js/front-scripts.js', __FILE__), array('jquery'), '1.0.1', 'in_footer' );
	wp_enqueue_style('bootstrap-min-css',  plugins_url('css/bootstrap.min.css', __FILE__));
	wp_enqueue_style('orange-slider-animate',  plugins_url('css/animate.css', __FILE__));
	wp_enqueue_style('font-awesome-min-styles',  plugins_url('css/font-awesome.min.css', __FILE__));
	wp_enqueue_style( 'orange-slider-front-styles', plugins_url('css/front-style.css', __FILE__));
    }
    /*
    Function setup_post
    Setup a custom post type for our slider
    */
    function setup_post(){
        $labels = array(
		'name' => __('Orange Slider Images', 'ob-carousel'),
		'singular_name' => __('Orange Slider Image', 'ob-carousel'),
		'add_new' => __('Add New', 'ob-carousel'),
		'add_new_item' => __('Add New Orange Slider Image', 'ob-carousel'),
		'edit_item' => __('Edit Orange Slider Image', 'ob-carousel'),
		'new_item' => __('New Orange Slider Image', 'ob-carousel'),
		'view_item' => __('View Orange Slider Image', 'ob-carousel'),
		'search_items' => __('Search Orange Slider Images', 'ob-carousel'),
		'not_found' => __('No Orange Slider Image', 'ob-carousel'),
		'not_found_in_trash' => __('No Orange Slider Images found in Trash', 'ob-carousel'),
		'parent_item_colon' => '',
		'menu_name' => __('Orange Slider', 'ob-carousel')
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'exclude_from_search' => true,
		'publicly_queryable' => false,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'page',
		'has_archive' => true, 
		'hierarchical' => false,
		'menu_position' => 21,
		'menu_icon' => 'dashicons-images-alt',
		'supports' => array('title','excerpt','thumbnail', 'page-attributes')
	); 
	register_post_type( $this->post_type, $args);
    }
    
    
    function install(){
	add_option( 'orange_slider_settings', 
	array(
		 'slider_speed'=>'5000' ,
		 'slider_height'=>'450px' ,
		 'slider_bg_color'=> '#428bca',
		 'slider_title_animation'=>'fadeInUpBig',
		 'slider_excerpt_animation'=>'bounce',
		 'slider_bullets_animation'=>'fadeInDown',
		 'slider_image_animation'=>'fadeInUpBig',
		 
	  )
	);
    }
    
    function uninstall(){
	delete_option( 'orange_slider_settings');
    }
    
    /*
    Function add_featured_image_support
    To show featured image meta box on post creation screen
    */
   
    function slider_image(){ 
        global $post;
        // Noncename needed to verify where the data originated
        echo '<input type="hidden" name="podcastmeta_noncename" id="podcastmeta_noncename" value="'. wp_create_nonce(plugin_basename(__FILE__)).'" />';
 
        $attachment_id = get_post_meta($post -> ID, $key = 'slider_image', true);
 
	$img = wp_get_attachment_image( $attachment_id, 'thumbnail'  );
         ?>
      
    
        <div id="slider-image" >
          <?php   if(!empty($attachment_id)) :  ?>
           <div class="image-block">
               <span class="remove">X</span>
	       <?php echo  $img; ?>
                <input type="hidden" value="<?php echo $attachment_id; ?>" name="slider_image">
            </div>
             <?php else:  ?>
            <div class="upload-block">
		
               
               <input id = "upload_image_button" class="preview button" type = "button" value = "Upload">
		<input type="hidden" name="slider_image" class="slider_image"  size = "70" value = "" />
            </div>
         <?php endif;  ?>
        </div>   
  <?php }
  
  
  function slider_custom_fields( $object, $box ){
   ?>
  <?php wp_nonce_field( basename( __FILE__ ), 'slider-bullets' ); ?>
  <?php  $slider_bullets=   get_post_meta( $object->ID, 'bullets', true )  ; ?>
  <?php// print_r($slider_bullets); ?>
  
   <p>Please enter bullets for your slider.</p>
  <div id="slider-bullets" class="group-fields clear">
  <?php   if(!empty($slider_bullets)) :  ?>
  <?php   foreach($slider_bullets as $bullet => $value)  :  ?>
 <div class="field-group has-rmv-button clear">
   <div class="bullets">
   
       <label for="recipes-field-post"><?php _e( "Bullet", 'orange-slider' ); ?></label>
	     <p>
          <input class="widefat" type="text" name="bullets[]"  value="<?php echo $value['bullets'] ; ?>" size="70" />
        </p>
   </div> 
 
    <div class='rmv-button'><p><button id='remove'>Remove</button></p></div>
	<div class="clear"> </div>
  </div>
 <?php endforeach;  ?>
 <?php else:  ?>
   <div class="field-group clear">
    <div class="bullets">
       <label for="recipes-field-post"><?php _e( "Bullet", 'orange-slider' ); ?></label>
	 <p><input class="orange-bullet" type="text" name="bullets[]" value="" size="70" /> </p>
    </div> 
   
  </div>
  <?php endif;  ?>
  
   <div class="add-more clear">
	 <p>
          <input type="button" name="orange-slider-class" id="orange-add-bullet" value="Add more" />
        </p>
   </div> 

  <?php
  }
  
    //Saving the file
   function save_orange_slider_meta($post_id, $post) {
        //
       /* Verify the nonce before proceeding. */
       if ( !isset( $_POST['slider-bullets'] )  ){
             //print_r( basename( __FILE__ ));
     
             //|| !wp_verify_nonce( $_POST['recipes-field-group'], basename( __FILE__ ) )
             
      
              return $post_id;
       }
        
     
       /* Get the post type object. */
       $post_type = get_post_type_object($post->post_type  );
     // die(print_r( $_POST));
       /* Check if the current user has permission to edit the post. */
       if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
         return $post_id;
       $bullets = array();
        
       foreach($_POST['bullets'] as $key => $val){
               if(!empty( $_POST['bullets'][ $key]))
                $bullets[] = array( 'bullets' => $_POST['bullets'][ $key]  )  ;
     
       }
     
       /* Get the posted data and sanitize it for use as an HTML class. */
       $new_meta_value = ( isset( $bullets ) ?   $bullets : '' );
      //die(print_r(    $new_meta_value ) );
       /* Get the meta key. */
       $meta_key = 'bullets';
     
       /* Get the meta value of the custom field key. */
       $meta_value = get_post_meta( $post_id, $meta_key, true );
     //die(print_r(  $meta_value));
       /* If a new meta value was added and there was no previous value, add it. */
       if ( $new_meta_value && '' == $meta_value )
         add_post_meta( $post_id, $meta_key, $new_meta_value, true );
     
       /* If the new meta value does not match the old value, update it. */
       elseif ( $new_meta_value && $new_meta_value != $meta_value )
         update_post_meta( $post_id, $meta_key, $new_meta_value );
     
       /* If there is no new meta value but an old value exists, delete it. */
       elseif ( '' == $new_meta_value && $meta_value )
         delete_post_meta( $post_id, $meta_key, $meta_value );
   }
    
    
    
    //Saving the file
    function save_podcasts_meta($post_id, $post) {
        if (!wp_verify_nonce($_POST['podcastmeta_noncename'], plugin_basename(__FILE__))) {
            return $post -> ID;
        }
        if (!current_user_can('edit_post', $post -> ID))
            return $post -> ID;
        $slider_image = $_POST['slider_image'];
 
             if ($post -> post_type == 'revision') return; 
            if (get_post_meta($post -> ID, 'slider_image', FALSE)) { // If the custom field already has a value it will update
                update_post_meta($post -> ID, 'slider_image', $slider_image);
            } else { // If the custom field doesn't have a value it will add
                add_post_meta($post -> ID, 'slider_image', $slider_image);
            }
            if (!$slider_image) delete_post_meta($post -> ID, 'slider_image'); // Delete if blank value
 
    }
  
  
}
?>