<?php
//require_once('carousel_functions.php');

class orange_bootstrap_carousel_settings{
 
     
  function __construct() {
 
   add_action( 'admin_init', array( $this, 'page_init' ) );
  }
 
  // Register and add settings
	public function page_init() {		
		register_setting(
				'orange_slider_settings', // Option group
				'orange_slider_settings', // Option name
				array( $this, 'sanitize' ) // Sanitize
		);
		
		 
  
	}
  
  		
	// Sanitize each setting field as needed -  @param array $input Contains all settings fields as array keys
	public function sanitize( $input ) {
	  //  die( print_r($input));
		$new_input = array();
		foreach($input as $key => $var){
		   $new_input[$key] = sanitize_text_field( $input[$key] );
		}
		return $new_input;
	}
  
 public function orange_slider_animation_callback($settings,$name){
    ?>
    <select class="input input--dropdown js--animations" name="orange_slider_settings[<?php echo $name;?>]">
        <optgroup label="Attention Seekers">
          <option value="bounce" <?php echo $settings[$name]=="bounce" ? 'selected=selected':''?>>bounce</option>
          <option value="flash" <?php echo $settings[$name]=="flash" ? 'selected=selected':''?>>flash</option>
          <option value="pulse" <?php echo $settings[$name]=="pulse" ? 'selected=selected':''?>>pulse</option>
          <option value="rubberBand" <?php echo $settings[$name]=="rubberBand" ? 'selected=selected':''?>>rubberBand</option>
          <option value="shake" <?php echo $settings[$name]=="shake" ? 'selected=selected':''?>>shake</option>
          <option value="swing" <?php echo $settings[$name]=="swing" ? 'selected=selected':''?>>swing</option>
          <option value="tada" <?php echo $settings[$name]=="tada" ? 'selected=selected':''?>>tada</option>
          <option value="wobble" <?php echo $settings[$name]=="wobble" ? 'selected=selected':''?>>wobble</option>
          <option value="jello" <?php echo $settings[$name]=="jello" ? 'selected=selected':''?>>jello</option>
        </optgroup>

        <optgroup label="Bouncing Entrances">
          <option value="bounceIn" <?php echo $settings[$name]=="bounceIn" ? 'selected=selected':''?>>bounceIn</option>
          <option value="bounceInDown" <?php echo $settings[$name]=="bounceInDown" ? 'selected=selected':''?>>bounceInDown</option>
          <option value="bounceInLeft" <?php echo $settings[$name]=="bounceInLeft" ? 'selected=selected':''?>>bounceInLeft</option>
          <option value="bounceInRight" <?php echo $settings[$name]=="bounceInRight" ? 'selected=selected':''?>>bounceInRight</option>
          <option value="bounceInUp" <?php echo $settings[$name]=="bounceInUp" ? 'selected=selected':''?>>bounceInUp</option>
        </optgroup>

        <optgroup label="Bouncing Exits">
          <option value="bounceOut" <?php echo $settings[$name]=="bounceOut" ? 'selected=selected':''?>>bounceOut</option>
          <option value="bounceOutDown" <?php echo $settings[$name]=="bounceOutDown" ? 'selected=selected':''?>>bounceOutDown</option>
          <option value="bounceOutLeft" <?php echo $settings[$name]=="bounceOutLeft" ? 'selected=selected':''?>>bounceOutLeft</option>
          <option value="bounceOutRight" <?php echo $settings[$name]=="bounceOutRight" ? 'selected=selected':''?>>bounceOutRight</option>
          <option value="bounceOutUp" <?php echo $settings[$name]=="bounceOutUp" ? 'selected=selected':''?>>bounceOutUp</option>
        </optgroup>

        <optgroup label="Fading Entrances">
          <option value="fadeIn" <?php echo $settings[$name]=="fadeIn" ? 'selected=selected':''?>>fadeIn</option>
          <option value="fadeInDown" <?php echo $settings[$name]=="fadeInDown" ? 'selected=selected':''?>>fadeInDown</option>
          <option value="fadeInDownBig" <?php echo $settings[$name]=="fadeInDownBig" ? 'selected=selected':''?>>fadeInDownBig</option>
          <option value="fadeInLeft" <?php echo $settings[$name]=="fadeInLeft" ? 'selected=selected':''?>>fadeInLeft</option>
          <option value="fadeInLeftBig" <?php echo $settings[$name]=="fadeInLeftBig" ? 'selected=selected':''?>>fadeInLeftBig</option>
          <option value="fadeInRight" <?php echo $settings[$name]=="fadeInRight" ? 'selected=selected':''?>>fadeInRight</option>
          <option value="fadeInRightBig" <?php echo $settings[$name]=="fadeInRightBig" ? 'selected=selected':''?>>fadeInRightBig</option>
          <option value="fadeInUp" <?php echo $settings[$name]=="fadeInUp" ? 'selected=selected':''?>>fadeInUp</option>
          <option value="fadeInUpBig" <?php echo $settings[$name]=="fadeInUpBig" ? 'selected=selected':''?>>fadeInUpBig</option>
        </optgroup>

        <optgroup label="Fading Exits">
          <option value="fadeOut" <?php echo $settings[$name]=="fadeOut" ? 'selected=selected':''?>>fadeOut</option>
          <option value="fadeOutDown" <?php echo $settings[$name]=="fadeOutDown" ? 'selected=selected':''?>>fadeOutDown</option>
          <option value="fadeOutDownBig" <?php echo $settings[$name]=="fadeOutDownBig" ? 'selected=selected':''?>>fadeOutDownBig</option>
          <option value="fadeOutLeft" <?php echo $settings[$name]=="fadeOutLeft" ? 'selected=selected':''?>>fadeOutLeft</option>
          <option value="fadeOutLeftBig" <?php echo $settings[$name]=="fadeOutLeftBig" ? 'selected=selected':''?>>fadeOutLeftBig</option>
          <option value="fadeOutRight" <?php echo $settings[$name]=="fadeOutRight" ? 'selected=selected':''?>>fadeOutRight</option>
          <option value="fadeOutRightBig" <?php echo $settings[$name]=="fadeOutRightBig" ? 'selected=selected':''?>>fadeOutRightBig</option>
          <option value="fadeOutUp" <?php echo $settings[$name]=="fadeOutUp" ? 'selected=selected':''?>>fadeOutUp</option>
          <option value="fadeOutUpBig" <?php echo $settings[$name]=="fadeOutUpBig" ? 'selected=selected':''?>>fadeOutUpBig</option>
        </optgroup>

        <optgroup label="Flippers">
          <option value="flip" <?php echo $settings[$name]=="flip" ? 'selected=selected':''?>>flip</option>
          <option value="flipInX" <?php echo $settings[$name]=="flipInX" ? 'selected=selected':''?>>flipInX</option>
          <option value="flipInY" <?php echo $settings[$name]=="flipInY" ? 'selected=selected':''?>>flipInY</option>
          <option value="flipOutX" <?php echo $settings[$name]=="flipOutX" ? 'selected=selected':''?>>flipOutX</option>
          <option value="flipOutY" <?php echo $settings[$name]=="flipOutY" ? 'selected=selected':''?>>flipOutY</option>
        </optgroup>

        <optgroup label="Lightspeed">
          <option value="lightSpeedIn" <?php echo $settings[$name]=="lightSpeedIn" ? 'selected=selected':''?>>lightSpeedIn</option>
          <option value="lightSpeedOut" <?php echo $settings[$name]=="lightSpeedOut" ? 'selected=selected':''?>>lightSpeedOut</option>
        </optgroup>

        <optgroup label="Rotating Entrances">
          <option value="rotateIn" <?php echo $settings[$name]=="rotateIn" ? 'selected=selected':''?>>rotateIn</option>
          <option value="rotateInDownLeft" <?php echo $settings[$name]=="rotateInDownLeft" ? 'selected=selected':''?>>rotateInDownLeft</option>
          <option value="rotateInDownRight" <?php echo $settings[$name]=="rotateInDownRight" ? 'selected=selected':''?>>rotateInDownRight</option>
          <option value="rotateInUpLeft" <?php echo $settings[$name]=="rotateInUpLeft" ? 'selected=selected':''?>>rotateInUpLeft</option>
          <option value="rotateInUpRight" <?php echo $settings[$name]=="rotateInUpRight" ? 'selected=selected':''?>>rotateInUpRight</option>
        </optgroup>

        <optgroup label="Rotating Exits">
          <option value="rotateOut" <?php echo $settings[$name]=="rotateOut" ? 'selected=selected':''?>>rotateOut</option>
          <option value="rotateOutDownLeft" <?php echo $settings[$name]=="rotateOutDownLeft" ? 'selected=selected':''?>>rotateOutDownLeft</option>
          <option value="rotateOutDownRight" <?php echo $settings[$name]=="rotateOutDownRight" ? 'selected=selected':''?>>rotateOutDownRight</option>
          <option value="rotateOutUpLeft" <?php echo $settings[$name]=="rotateOutUpLeft" ? 'selected=selected':''?>>rotateOutUpLeft</option>
          <option value="rotateOutUpRight" <?php echo $settings[$name]=="rotateOutUpRight" ? 'selected=selected':''?>>rotateOutUpRight</option>
        </optgroup>

        <optgroup label="Sliding Entrances">
          <option value="slideInUp" <?php echo $settings[$name]=="slideInUp" ? 'selected=selected':''?>>slideInUp</option>
          <option value="slideInDown" <?php echo $settings[$name]=="slideInDown" ? 'selected=selected':''?>>slideInDown</option>
          <option value="slideInLeft" <?php echo $settings[$name]=="slideInLeft" ? 'selected=selected':''?>>slideInLeft</option>
          <option value="slideInRight" <?php echo $settings[$name]=="slideInRight" ? 'selected=selected':''?>>slideInRight</option>

        </optgroup>
        <optgroup label="Sliding Exits">
          <option value="slideOutUp" <?php echo $settings[$name]=="slideOutUp" ? 'selected=selected':''?>>slideOutUp</option>
          <option value="slideOutDown" <?php echo $settings[$name]=="slideOutDown" ? 'selected=selected':''?>>slideOutDown</option>
          <option value="slideOutLeft" <?php echo $settings[$name]=="slideOutLeft" ? 'selected=selected':''?>>slideOutLeft</option>
          <option value="slideOutRight" <?php echo $settings[$name]=="slideOutRight" ? 'selected=selected':''?>>slideOutRight</option>
          
        </optgroup>
        
         <optgroup label="Zoom Entrances">
          <option value="zoomIn" <?php echo $settings[$name]=="zoomIn" ? 'selected=selected':''?>>zoomIn</option>
          <option value="zoomInDown" <?php echo $settings[$name]=="zoomInDown" ? 'selected=selected':''?>>zoomInDown</option>
          <option value="zoomInLeft" <?php echo $settings[$name]=="zoomInLeft" ? 'selected=selected':''?>>zoomInLeft</option>
          <option value="zoomInRight" <?php echo $settings[$name]=="zoomInRight" ? 'selected=selected':''?>>zoomInRight</option>
          <option value="zoomInUp" <?php echo $settings[$name]=="zoomInUp" ? 'selected=selected':''?>>zoomInUp</option>
        </optgroup>
        
        <optgroup label="Zoom Exits">
          <option value="zoomOut" <?php echo $settings[$name]=="zoomOut" ? 'selected=selected':''?>>zoomOut</option>
          <option value="zoomOutDown" <?php echo $settings[$name]=="zoomOutDown" ? 'selected=selected':''?>>zoomOutDown</option>
          <option value="zoomOutLeft" <?php echo $settings[$name]=="zoomOutLeft" ? 'selected=selected':''?>>zoomOutLeft</option>
          <option value="zoomOutRight" <?php echo $settings[$name]=="zoomOutRight" ? 'selected=selected':''?>>zoomOutRight</option>
          <option value="zoomOutUp" <?php echo $settings[$name]=="zoomOutUp" ? 'selected=selected':''?>>zoomOutUp</option>
        </optgroup>

        <optgroup label="Specials">
          <option value="hinge" <?php echo $settings[$name]=="hinge" ? 'selected=selected':''?>>hinge</option>
          <option value="rollIn" <?php echo $settings[$name]=="rollIn" ? 'selected=selected':''?>>rollIn</option>
          <option value="rollOut" <?php echo $settings[$name]=="rollOut" ? 'selected=selected':''?>>rollOut</option>
        </optgroup>
      </select>
  <?php
  }
  
  
  
  
  
function carousel_settings(){
  $settings  = get_option( 'orange_slider_settings');
  settings_fields( 'orange_slider_settings' );
 // print_r($settings);
?>
<div class="wrap">
<h2>Orange slider settings</h2>

<form method="post" action="options.php">
    <?php  settings_fields( 'orange_slider_settings' );?>
    <?php  $image_sizes = get_intermediate_image_sizes();?>
    <table class="orange-slider-settings form-table">
        <tr valign="top">
        <th scope="row">Slider speed</th>
        <td>
	  <input type="text" name="orange_slider_settings[slider_speed]" value="<?php echo !empty($settings['slider_speed'])? $settings['slider_speed']: '5000'; ?>" />
	  <br><label>Enter slider speed in miliseconds.</label>
	</td>
        </tr>
         
        <tr valign="top">
        <th scope="row">Slider height</th>
        <td>
	  <input type="text" name="orange_slider_settings[slider_height]" value="<?php echo !empty($settings['slider_height'])? $settings['slider_height']: '450px'; ?>" />
	  <br><label>Enter slider height.You can enter height in pixels(eg:450px) or percentage(eg: 20%).</label>
	</td>
        </tr>
	 <tr valign="top">
        <th scope="row">Background color</th>
        <td>
	  <input type="text" name="orange_slider_settings[slider_bg_color]" class="orange-color-picker" value="<?php echo !empty($settings['slider_bg_color'])? $settings['slider_bg_color']: '#428bca'; ?>" />
	  <br><label>Select slider background color.</label>
	</td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Slider image size</th>
        <td><?php
	print '<select id="image_size" name="orange_slider_settings[image_size]">
			<option value="full"';
			if(isset( $settings['image_size'] ) && $settings['image_size'] == 'full'){
				print ' selected="selected"';
			}
			echo '>Full (default)</option>';
		foreach($image_sizes as $size){
			print '<option value="'.$size.'"';
			if(isset( $settings['image_size'] ) && $settings['image_size'] == $size){
				print ' selected="selected"';
			}
			print ">".ucfirst($size)."</option>";
		}
		print '</select>';		   
		 
		?>
	 <br><label>Select a size for your slider images. You can add custom image size for your sliders as explained <a href="https://developer.wordpress.org/reference/functions/add_image_size/" target="_blank">here</a>.</label>	
	</td>
        </tr>
	
	 <tr valign="top">
        <th scope="row">Animation styles</th>
        <td>
	   <br><label>Select different sliding styles for your slider elements here.</label>
		 <table class="form-table">
		   <tr valign="top">
                    <th scope="row">Title animation</th>
                    <th scope="row">Excerpt animation</th>
		    <th scope="row">Bullets animation</th>
		    <th scope="row">Image animation</th>
                   </tr>
		     
		  <tr valign="top">
		   <td>  <?php $this->orange_slider_animation_callback($settings,'slider_title_animation'); ?></td>
		   <td><?php $this->orange_slider_animation_callback($settings,'slider_excerpt_animation');?></td>
		   <td><?php $this->orange_slider_animation_callback($settings,'slider_bullets_animation');?></td>
		   <td><?php $this->orange_slider_animation_callback($settings,'slider_image_animation');?></td>
		 </tr>
		 
		 </table>
	</td>
        </tr>
	
    </table>
    <?php do_settings_sections( 'orange-carousel-slider-settings' ); ?>
    <?php submit_button(); ?>

</form>
</div>
<?php } 
 
        
  
  
  
}
//new orange_bootstrap_carousel_settings();