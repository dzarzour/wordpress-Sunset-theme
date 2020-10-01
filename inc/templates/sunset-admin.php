<h1> Sunset theme options</h1>
<?php settings_errors();?>
<?php 
$pic = esc_attr( get_option( 'profile_picture' ) );
$FirstName=esc_attr( get_option( 'first_name' ) ) ; 
$LasttName=esc_attr( get_option( 'last_name' ) ) ;
$fullName=$FirstName.'  '. $LasttName;
$desc_user= esc_attr( get_option('user_description'));



?>

<div class="sunset-sidebar-preview">
    <div class="sunset-sidebar">
        <div class="image-container">
        <div id="profile-picture-preview" class="profile-picture" style="background-image: url(<?php echo $pic; ?>)"></div>
        
        </div>
        <h1 class=sunset-username><?php echo  $fullName ?></h1>
        <h2 class="sunset-description"><?php echo$desc_user?></h2>
        <div class="icons-wrapper">
			
		</div>
    </div>



</div>


<form method="post" action="options.php" class="sunset-general-form">
<?php 
 settings_fields( 'sunset-settings-group' );
 do_settings_sections( 'dalia_sunset' );
 submit_button('Save Changes','primary','btnsubmit');
?>
</form>




