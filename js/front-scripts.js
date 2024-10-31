jQuery( document ).ready(function() {
    
    var $orangeCarousel = jQuery('.orange-carousel');
    $orangeCarousel.carousel();   
    var $firstAnimatingElems = $orangeCarousel.find('.item:first').find('[data-animation ^= "animated"]');
    animate($firstAnimatingElems);
    $orangeCarousel.on('slide.bs.carousel', function (e) {
      var $animatingElems = jQuery(e.relatedTarget).find("[data-animation ^= 'animated']");
      animate($animatingElems);
    });
    
    function animate(elems) {
        var animEndEv = 'webkitAnimationEnd animationend';
        elems.each(function () {
          var $this = jQuery(this),
              $animationType = $this.data('animation');
 
          $this.addClass($animationType).one(animEndEv, function () {
            $this.removeClass($animationType);
          });
        });
    }
 
});