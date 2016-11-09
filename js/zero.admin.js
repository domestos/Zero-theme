jQuery(document).ready(function($){
	//uload imege
	var  mediaUploader;
	$('#upload-button').on('click',function(e){
		e.preventDefault();
		if(mediaUploader){
			mediaUploader.open();
			return;
		}

		mediaUploader = wp.media.frames.file_frame = wp.media({
			title: 'Choose a Profile Pictures',
			button:{
				text: 'Choose Picture'
			},
			multiple: false
		});

		mediaUploader.on('select', function(){
			attachment = mediaUploader.state().get('selection').first().toJSON();
			$('#profile-picture').val(attachment.url);
			$('#profile-picture-preview').css('background-image','url('+ attachment.url +')');
		});

		mediaUploader.open();
		
	});

//	alert("ok");

	
});