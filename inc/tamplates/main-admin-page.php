<div class="wrap">
	<h1>Main admin page </h1>
	<?php 
		//в адмін панелі показує повідомлення про успіжне виконання форми
		settings_errors(); 
	?>
<?php 
		//$picture= esc_attr(get_option('profile_picture'));
		$firstName= esc_attr(get_option('first_name'));
		$lastName= esc_attr(get_option('last_name'));
		$fullName = $firstName. '  '. $lastName;
		//$zeroDescription= esc_attr(get_option('zero_description'));
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


</div>