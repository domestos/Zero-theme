
  <h1>Zero Sidebar Option </h1> 	
<?php 
	//в адмін панелі показує повідомлення про успіжне виконання форми
	settings_errors(); 
?>

<?php 
	$picture= esc_attr(get_option('profile_picture'));
	$firstName= esc_attr(get_option('first_name'));
	$lastName= esc_attr(get_option('last_name'));
	$fullName = $firstName. '  '. $lastName;
	$zeroDescription= esc_attr(get_option('zero_description'));
 ?>


<form method = "post" action="options.php" class = "zero-general-form">
 
	<?php settings_fields('zero-setting-group'); ?>
	<?php do_settings_sections( 'zero-theme' ); ?>
	<?php submit_button( ); ?>
</form>


<div class="zero-sidebare-preview">
	<div class="zero-sidebare">
		<div class="image-container">
			<div id="profile-picture-preview" class="profile-picture" style = "background-image:url(<?php print $picture; ?>);">
				<img src= "" />
			</div>
		</div>
		
		<h1 class="zero-username"> <?php print $fullName; ?> </h1>
		<h2 class="class-description"> <?php print $zeroDescription; ?> </h2>
		<div class="icons-wrapper"> 
		</div>
	</div>
</div>