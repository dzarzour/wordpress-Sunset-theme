<?php
/***
 * 
 * Admin page
 */

function sunset_admin_page(){
    //Generate sunset admin page
    add_menu_page('Sunset theme options', 'Sunset', 'manage_options', 'dalia_sunset', 'sunset_theme_create_page', 'dashicons-clock', 110);
    
    // Generate sunset admin sub pages(Sidebar)
    add_submenu_page( 'dalia_sunset', 'Sunset theme options', 'Sidebar', 'manage_options', 'dalia_sunset', 'sunset_theme_create_page' );

    //Generate sunset admin subpage(Theme Options)

    add_submenu_page( 'dalia_sunset', 'Theme Options', 'Theme Options', 'manage_options', 'dalia_sunset_theme_options', 'sunset_theme_support_options_page' );
    //Generate sunset admin subpage(Contact Form)
    add_submenu_page( 'dalia_sunset', 'Contact Form', 'Contact form', 'manage_options', 'dalia_sunset_contact_form', 'sunset_contact_form_page' );
  
    // Generate sunset admin sub pages(CUSTOM CSS)
    add_submenu_page( 'dalia_sunset', 'Sunset  CSS option ', 'CUSTOM CSS', 'manage_options', 'dalia_sunset_css', 'sunset_theme_css_page' );

    //Activate Custom settings
    add_action( 'admin_init', 'sunset_custom_settings');
}
add_action( 'admin_menu','sunset_admin_page');

function sunset_custom_settings(){

   

    //Sidebar  register settings
    register_setting( 'sunset-settings-group', 'profile_picture');
    register_setting( 'sunset-settings-group', 'first_name');
    register_setting( 'sunset-settings-group', 'last_name');
    register_setting( 'sunset-settings-group', 'user_description' );
    register_setting( 'sunset-settings-group', 'facebook_handler');
    register_setting( 'sunset-settings-group', 'twitter_handler','sunset_sanitize_twiiter_handler');
    register_setting( 'sunset-settings-group', 'google_handler');
    //Sidebar section
    add_settings_section( 'sunset-sidebar-options', 'Sidebar Options', 'sunset_sidebar_options', 'dalia_sunset' );
    //Sidebar Fields
    add_settings_field( 'sidebar-profile-picture', 'Profile Picture', 'sunset_sidebar_profile', 'dalia_sunset', 'sunset-sidebar-options');    
    add_settings_field( 'sidebar-name', 'Full Name', 'sunset_sidebar_name', 'dalia_sunset', 'sunset-sidebar-options');
    add_settings_field( 'description-user', 'Description ', 'description_user','dalia_sunset', 'sunset-sidebar-options' );
    add_settings_field( 'sidebar-twitter', 'Twitter handler', 'sidebar_twitter','dalia_sunset', 'sunset-sidebar-options' );
    add_settings_field( 'sidebar-facebook', 'Facebook handler', 'sidebar_facebook','dalia_sunset', 'sunset-sidebar-options' );
    add_settings_field( 'sidebar-google', 'Google handler', 'sidebar_google','dalia_sunset', 'sunset-sidebar-options' );


    //Theme support Options  register settings
    register_setting( 'sunset-theme-support-option', 'post_formats' );
    register_setting( 'sunset-theme-support-option', 'custom_header' );
    register_setting( 'sunset-theme-support-option', 'custom_background');

    add_settings_section( 'sunset-theme-options', 'Theme Options', 'sunset_theme_options', 'dalia_sunset_theme_options' );
    add_settings_field( 'post-formats', 'Post Formats', 'sunset_post_formats', 'dalia_sunset_theme_options', 'sunset-theme-options');
    add_settings_field( 'custom-header', 'Custome Header', 'sunset_custome_header','dalia_sunset_theme_options' , 'sunset-theme-options' );
    add_settings_field('custom-background', 'Custom Background', 'sunset_custom_background', 'dalia_sunset_theme_options' , 'sunset-theme-options');

    //Contact Form register settings
    register_setting( 'sunset-contact-form-option', 'activat_contact' );
    add_settings_section( 'contact-form-section', 'Contact Form', 'sunset_contact_section','dalia_sunset_contact_form');

    add_settings_field( 'activate-contact', 'Activat contact Form','sunset_activate_contact_form', 'dalia_sunset_contact_form', 'contact-form-section' );
   
    //CSS regidter settings
    register_setting( 'sunset-theme-css','sunset_css', 'sunset_sanitize_custom_css' );
    add_settings_section( 'sunset-custom-css-section', 'Custom CSS', 'sunset_custom_css_section', 'dalia_sunset_css' );
    add_settings_field( 'custom-css', 'Custom Css', 'sunset_custom_css_callback', 'dalia_sunset_css', 'sunset-custom-css-section' );

   
  
    
}

// custom css functions
function sunset_custom_css_callback(){
   
   $css=get_option( 'sunset_css');
    $css=(empty($css)?'/* Sunset Theme Custom CSS */' : $css );
   
    echo '<div id="customCss">'.$css.'</div><textarea id="sunset_css" name="sunset_css"  style="display:none;visibility:hidden">'.$css.'</textarea>';
   

	
	
}

function sunset_custom_css_section(){
    //echo "section css";
}

function sunset_sanitize_custom_css($input){
    $output=esc_textarea( $input );
    return $output;
}
//Contact form functions

function sunset_contact_section(){
    echo 'Activate and Deactivate the Built-in Contact Form';
}
function sunset_activate_contact_form(){
   $option=get_option( 'activat_contact' );
   $checked=(@$option==1?'checked':'');
   echo'<label><input  type="checkbox" id="activat_contact" name="activat_contact" value="1" '.$checked.'/>Active Sunset contact form </label>';
}

//theme supoort options function 

function sunset_post_formats(){
    $options=get_option('post_formats');
    $formats=array('aside','gallery','link','image','quote','status','video','audio','chat');
    $output='';
    foreach($formats as $format){
        $checked=  ( @$options[$format] ==1  ? 'checked' :'');
       
      $output .= '<label><input type="checkbox" id="'.$format.'" name="post_formats['.$format.']" value="1" '.$checked.' /> '.$format.'</label><br>';
    }
    echo $output;
}
function sunset_custome_header(){
    $options=get_option( 'custom_header');
    $checked=(@$options==1?'checked':'');
    echo '<label><input type="checkbox" id="custom_header" name="custom_header" value="1" '.$checked.'> Activate  Custom header</label>';

}
function sunset_custom_background(){
    $options=get_option( 'custom_background' );
    $checked=(@$options==1?'checked':'');
    echo '<label><input type="checkbox" id="custom_background" name="custom_background" value="1" '.$checked.'/>Activate Custom background </label>';
}


function sunset_theme_options(){
    echo 'Activate and Deactivate specific Theme Support Options';
}

//Sidebar callback functions

function sunset_sidebar_options(){
    echo "Custimize Sidebar Options";
}

function sunset_sidebar_profile() {
    
     $picture = esc_attr( get_option( 'profile_picture' ) );
    if(!empty($picture)){    
	echo '<input type="button" class="button button-secondary" value="Replace Profile Picture" id="upload-button"><input type="hidden" id="profile-picture" name="profile_picture" value="'.$picture.'" /><input type="button" class="button button-secondary" value="Remove" id="remove-picture">';

    }else{
        echo '<input type="button" class="button button-secondary" value="Upload Profile Picture" id="upload-button"><input type="hidden" id="profile-picture" name="profile_picture" value="" />';
    }
	
}
function sunset_sidebar_name(){
    $FirstName=esc_attr( get_option( 'first_name' ) ) ; 
    $LasttName=esc_attr( get_option( 'last_name' ) ) ;
    echo '<input type="text" name="first_name" value="'.$FirstName.'"  placeholder="First Name" />
          <input type="text" name="last_name"  value="'.$LasttName.'"  placeholder="Last Name" /> 
    ';
}
function description_user(){
    $desc_user= esc_attr( get_option('user_description'));
    echo '<input type="text" name="user_description"  value="'.$desc_user.'" placeholder="Description"><p class="description">Write something smart.</p>';
}

function sidebar_facebook(){
    
    $facebookhandler=esc_attr( get_option( 'facebook_handler' ) ) ;
    echo '<input type="text"   name="facebook_handler" value="'.$facebookhandler.'"  placeholder="facebook Name" />';

}
function sidebar_twitter(){
    $twiiterhandler=esc_attr( get_option( 'twitter_handler' ) ) ;
    echo '<input type="text" name="twitter_handler" value="'.$twiiterhandler.'"  placeholder="Twitter Name" />
    <p class="description"> Input your twitter name without @ character.</p>
    ';

}
function sidebar_google(){
    $googlehandler=esc_attr( get_option( 'google_handler' ) ) ;
    echo '<input type="text" name="google_handler" value="'.$googlehandler.'"  placeholder="Google Name" />';

}

//Sanitize settings 
function sunset_sanitize_twiiter_handler($input){
$output=sanitize_text_field( $input );
$output=str_replace('@','',$output);
return $output;


}


//Template submenu functions

function sunset_theme_create_page(){
    //generte create page
    require_once get_template_directory().'/inc/templates/sunset-admin.php';
}

function sunset_theme_support_options_page(){
    require get_template_directory().'/inc/templates/sunset-theme-support.php';
    
}
function sunset_contact_form_page(){
    require get_template_directory().'/inc/templates/sunset-contact-form.php';
}
function sunset_theme_css_page(){
     require get_template_directory(  ).'/inc/templates/sunset-custom-css.php';
}