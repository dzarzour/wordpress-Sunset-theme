
<?php  settings_errors();?>

<p> Use this short code to activate the contact form inside a page or post</p><code>[contact_form]</code>
<form method="post" action=options.php>
    <?php settings_fields( 'sunset-contact-form-option' )?>
    <?php do_settings_sections( 'dalia_sunset_contact_form' )?>
    <?php submit_button();?>
</form>