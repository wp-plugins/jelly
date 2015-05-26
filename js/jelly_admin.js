var jelly_uploader;

jQuery(document).ready(function(){
	activateDeletes();

	jQuery('.image-button').click(function(e) {
		e.preventDefault();
		uploader(jQuery(this).data('count'));
		activateDeletes();
	});
});


function uploader(count){
	//jQuery('#new_image_path'+id).val('Clicked');

	//If the uploader object has already been created, reopen the dialog
	if (jelly_uploader) {
		jelly_uploader.open();
		return;
	}

	//Extend the wp.media object
	jelly_uploader = wp.media.frames.file_frame = wp.media({
		title: 'Choose Image',
		button: {
		text: 'Choose Image'
		},
		multiple: false
	});

	//When a file is selected, grab the URL and set it as the text field's value
	jelly_uploader.on('select', function() {
		attachment = jelly_uploader.state().get('selection').first().toJSON();
		//var url = '';
		//url = attachment['url'];
		//jQuery('#new_image_path'+id).val(url);
		jQuery('#new_image').parent().parent().before(newImage(attachment.url));
		activateDeletes();
	});

	//Open the uploader dialog
	jelly_uploader.open();
}

function newImage(url){
	var number = jQuery('.image-button').data('count');
	jQuery('.image-button').data('count', ++number);
	var image = jQuery('.jelly-image-table').data('deleteImage');

	return '<tr class=\'jelly-image-row\'>'
			+ '<td>'
				+ '<img src=\'' + url + '\' class=\'jelly-image-preview\' />'
				+ '<input type=\'hidden\' name=\'jelly_options[path_' + number + ']\' value=\'' + url + '\' />'
			+ '</td>'
			+ '<td>'
				+ '<input id=\'jelly_text_image_' + number + '\' class=\'jelly-image-link\' name=\'jelly_options[link_' + number + ']\' size=\'30\' type=\'text\' placeholder=\'Insert link here (e.g. http://lumne.net)\' />'
			+ '</td>'
			+ '<td><img src=\'' + image + '\' id=\'delete_' + number + '\' class=\'delete-image\' /></td>'
		+ '</tr>';
}

function activateDeletes(){
	jQuery('.delete-image').click(function(){
		jQuery(this).parent().parent().remove();
		//jQuery('.image-button').data('count', jQuery('.jelly-image-row').length);
	});
}