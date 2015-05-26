jQuery(document).ready(function() {

	initializeIt();

	jQuery(window).bind('resize', function(){
		resize();
	});

});

jQuery(window).load(function(){
	resize();
});

var active = true;
var queue;

// Start effect (for active galleries)
function initializeIt(){
	var gallery = jQuery('#gallery');
	var images  = gallery.children('.top-show').children('.jelly_image');
	var count   = images.length;
	var speed   = gallery.data('trans');
	var wait    = gallery.data('pause');

	var pos = 0;
	images.not('#image'+pos).hide(); // Show first image
	jQuery('#image'+pos).attr('z-index', 1);
	images.not('#image'+pos).attr('z-index', 2);
	jQuery('#image'+pos).addClass('active');
	setTimeout(function(){ nextImage(++pos, count, wait, speed, 'slide'); }, wait);

}

function nextImage(pos, length, wait, speed, effect){
	var effect = typeof effect !== 'undefined' ? effect : 'slide';
    
	if(active){
		jQuery('#image'+(pos%length)).effect(effect, speed, function(){
			jQuery('#gallery .jelly_image').attr('z-index', 1);
			jQuery('#image'+((pos+1)%length)).attr('z-index', 3);
			jQuery('#image'+((pos-1)%length)).hide();
			jQuery('#gallery .jelly_image').removeClass('active');
			jQuery('#image'+(pos%length)).addClass('active');
			queue = setTimeout(function(){ nextImage(++pos, length, wait, speed, effect); }, wait);
		});
	}
}

function resize(){
  jQuery('.jelly').each(function(){
    var gallery_id = jQuery(this).attr('id');
    jQuery('#' + gallery_id + ' .top-show').css('height', getTopImageHeight(gallery_id));
	//jQuery('#' + gallery_id + ' .top-show').css('height', getTopShowHeight(gallery_id));
  });
	
}

function getTopImageHeight(gallery_id){
	return jQuery('#' + gallery_id + ' .top-show .jelly_image').height();
}


























