<?php 
/**
 * @package sunset
 * ==============================
 * 
 * Remove Generator Version Number
 * =============================
 */
/**Remove   version strings from css and js */
 function sunset_remove_wp_version_strings($src){
     global $wp_version;
     parse_str(parse_url($src,PHP_URL_QUERY),$query);
     if(!empty($query['ver']) && $query['ver']===$wp_version){
         $src=remove_query_arg( 'ver', $src );

     }
     return $src;

 }
 add_filter( 'script_loader_src','sunset_remove_wp_version_strings');
 add_action('style_loader_src','sunset_remove_wp_version_strings');


 /* remove metatag generator from header */
 function sunset_remove_meta_version(){
     return '';
 }
 add_filter( 'the_generator','sunset_remove_meta_version' );