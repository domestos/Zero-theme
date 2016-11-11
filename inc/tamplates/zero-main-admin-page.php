<div class="wrap">
	<h1>Main admin page </h1>
	<?php 
		//в адмін панелі показує повідомлення про успіжне виконання форми
		settings_errors(); 
	?>
	<?php 
		$picture= esc_attr(get_option('profile_picture'));
		$firstName= esc_attr(get_option('first_name'));
		$lastName= esc_attr(get_option('last_name'));
		$fullName = $firstName. '  '. $lastName;
		$profileDescription= esc_attr(get_option('description_profile'));
	 ?>

	<form method = "post" action="options.php" class = "zero-general-form">
	 	<!-- settings_fields() выводит скрытые поля формы, 
	 	поэтому она должна находиться внутри тега form: 
	 	Ничего не возвращает. Выводит на экран скрытые поля input.-->
	 	<?php settings_fields('zero-main-page-group')?>
		<!-- Выводит на экран все блоки опций, относящиеся к 
		указанной странице настроек в админ-панели.
		Выводит на экран HTML код блоков с полями формы -->	
		<?php do_settings_sections( 'zero-main-page' );?>
		<?php submit_button( '','primary', 'btnSubmit'); ?>
	</form>

	<div class="zero-sidebare-preview">
		<div class="zero-sidebare">
			<div class="image-container">
				<div id="profile-picture-preview" class="profile-picture" style = "background-image:url(<?php print $picture; ?>);">
					<img src= "" />
				</div>
			</div>
			
			<h1 class="zero-username"> <?php print $fullName; ?> </h1>
			<h2 class="class-description"> <?php print $profileDescription; ?> </h2>
			<div class="icons-wrapper"> 
			</div>
		</div>
	</div>

</div>