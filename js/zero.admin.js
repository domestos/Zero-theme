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

	
	/*
		Remove Image:
		$('#profile-picture').val(''); 	  - set empty values for input of image
		$('.zero-general-form').submit(); - it is (.zero-general-form) class's name of form.
											We do imitation click on button of this form
		but imitation will work only if we correctly set the button of form for example:
		(submit_button('Save Changes ','primary', 'btnSubmit');)
		*/
	$('#remove_profile_picture').on('click', function(e){
		e.preventDefault();
		var answer = confirm("Are you sure you want to remove you profile picture?");
		if(answer == true){
			$('#profile-picture').val('');
			$('.zero-general-form').submit();
		}  
		return;
	})

});