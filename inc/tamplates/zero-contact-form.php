<div class="wrap">
	<h1>Zero Contact Form </h1>

	<?php 
		//в адмін панелі показує повідомлення про успіжне виконання форми
		//$picture= esc_attr(get_option('profile_picture'));
		settings_errors(); 
	?>

	<form method = "post" action="options.php" class = "zero-general-form">
	 
		<?php settings_fields('zero-contact-options-group'); ?>
		<?php do_settings_sections( 'zero-contact-form' ); ?>
		<?php submit_button( ); ?>
	</form>
</div>
