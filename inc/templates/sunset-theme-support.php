<?php

/*
	
@package sunsettheme
	
	========================
		THEME SUPPORT OPTIONS
	========================
*/
?>
<h1>Sunset Theme Support</h1>
<?php settings_errors(); ?>
<form method="post" action="options.php" class="sunset-general-form"> 
    <?php settings_fields( 'sunset-theme-support-option' )?>
    <?php do_settings_sections( 'dalia_sunset_theme_options' );?>
    <?php submit_button()?>

</form>