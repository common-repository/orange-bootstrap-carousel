jQuery( document ).ready(function() {
   
   /*Media libary function*/
    var file_frame;
    jQuery('#upload_image_button').live('click', function(podcast) {
    podcast.preventDefault();
    console.log("Hello");
    // If the media frame already exists, reopen it.
    if (file_frame) {
        file_frame.open();
        return;
    }
    // Create the media frame.
    file_frame = wp.media.frames.file_frame = wp.media({
            title: jQuery(this).data('uploader_title'),
            button: {
                  text: jQuery(this).data('uploader_button_text'),
             },
         multiple: false // Set to true to allow multiple files to be selected
    });
    // When a file is selected, run a callback.
    file_frame.on('select', function(){
        // We set multiple to false so only get one image from the uploader
         attachment = file_frame.state().get('selection').first().toJSON();
	 console.log(JSON.stringify(attachment));
         var url = attachment.url;
         
         var html ='<div class="image-block">';
	 html += '<span class="remove">X</span>';
	 html += '<img src="'+url+'" name = "slider_image" width="200">';
	 html += '<input type="hidden" value="'+attachment.id+'" name="slider_image">'
	 html += '</div>';
         jQuery('#slider-image').html(html);
       // var field = document.getElementById("slider_image");
       // field.value = url; //set which variable you want the field to have
      });
      // Finally, open the modal
      file_frame.open();
    });
     /*Media libary function ends*/
     
       jQuery('.orange-color-picker').wpColorPicker();
     
     
     
     /*Remove image function*/
      jQuery('#slider-image span').live('click', function(e) {
         e.preventDefault();
         var html = '<div class="upload-block">' ;
        
         html += '<input id="upload_image_button" class="preview button" type="button" value="Upload">';
	  html += '<input type="hidden" name="slider_image"  id="slider_image"  size = "70" value = "" />';
         html += '</div>';
        jQuery('#slider-image').html(html);
      });
     
     
     
     
     
     
     
     
     
     
       var removeButton = "  <div class='rmv-button'><p><button name='remove-bullet' id='remove'>Remove</button></p></div>";
       //jQuery('#orange-add-bullet').click(function() {
        jQuery('#slider-bullets #orange-add-bullet').live('click', function(e) {
	   var clone =jQuery('div.field-group:first').clone();
	   clone.find("input").val('');
	   
       jQuery('div.field-group:last').after(clone);
       
	   if(!jQuery('div.field-group:first').hasClass('has-rmv-button'))
	     jQuery('div.field-group:last').append(removeButton);
        });
       jQuery('#slider-bullets button[name="remove-bullet"]').live('click', function() {
       jQuery(this).closest('div.field-group').remove();
     });
       
      
       
       
       
     
     
     
     
     
});