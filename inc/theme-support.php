<?php

/*
	
@package sunsettheme
	
	========================
		THEME SUPPORT OPTIONS
	========================
*/
//Post format
$options=get_option( 'post_formats');

$formats = array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' );
$output=array();
foreach($formats as $format){
    $output[]=(@$options[$format]==1?$format:'');
}
if(!empty($options)){
    add_theme_support('post-formats',$output);
}

// Custom header
$header=get_option('custom_header');
if(!empty($header)){
    add_theme_support('custom-header');
}

$background=get_option('custom_background');

if(!empty($background)){
    add_theme_support( 'custom-background');
}
add_theme_support( 'post-thumbnails' );


/*Active HTML 5 features */
$args=array('comment-list','comment-form','search-form');
add_theme_support( 'html', $args );

/* Activate Nav Menu Option */
function sunset_register_nav_menu(){
    register_nav_menu( 'primary', 'Header navigation Menu' );
}
add_action( 'after_setup_theme', 'sunset_register_nav_menu' );

/**
 * =====================
 * 
 * BLOG Sidebar FUNCTIONS
 * =====================
 */
function sunset_sidebar_init(){

    register_sidebar( array(
        'name'              =>  esc_html__('sunset Sidebar','sunsetthem'),
        'id'                =>  'sunset-sidebar',
        'description'       =>  'Dynamic sidebar',
        'before-widget'     =>  '<section id="%1$s" class="sunset-widget %2$s">',
        'after-widget'      =>  '</section>',
        'before-title'      =>  '<h2 class="sunset-widget-title">',
        'after-title'       => '</h2>'
    ) );

}
add_action( 'widgets_init','sunset_sidebar_init' );



/**
 * =====================
 * 
 * BLOG LOOP CUSTOM FUNCTIONS
 * =====================
 */
function sunset_post_meta(){
    $post_on=human_time_diff( get_the_time( 'U'), current_time( 'timestamp') );
    $categories=get_the_category();
    $separator=',';
    $output='';
    $i=1;
    if(!empty($categories)):
        foreach($categories as $category):
            if($i>1): 
                $output.=$separator;
            endif;
            $output.='<a href="'.esc_url( get_category_link( $category->term_id ) ).'" alt=" '.esc_attr( 'View all posts in %s',$category->name ).'" > '.esc_html( $category->name ).'</a>' ;
            $i++;
        endforeach;
    endif;
    return '<span class="posted-on"> Posted <a href="'.esc_url( get_permalink() ).'"> '.$post_on.' </a> ago</span> /<span class="post-in">'.$output.'</span>';
}
function sunset_posted_footer (){
    $comment_num=get_comments_number();
    if(comments_open()){
        if($comment_num>1){
            $comments=$comment_num .__('Comments','sunsetthem');
        }elseif($comment_num==0){
            $comments=__('No comments');
        }else{
            $comments=__('1 Comment','sunsettheme');
        }
        $comments=' <a href="'.get_comments_link().'">'.$comments.'</a><span class="fa fa-comments"> </span>';

    }else{
        $comments=__('Comment is closed','sunsettheme');
    }

    return '<div class="post-footer-container"><div class="row"><div class="col-xs-12 col-sm-6">'.get_the_tag_list( '<div class="tags-list"><span class="fa fa-tag "></span>', ' ', '</div>' ).'</div><div class="col-xs-12 col-sm-6 comments-link text-right"> '  .$comments.'</div></div></div>';
}


function sunset_get_attachment($num=1){
    $output='';
    if(has_post_thumbnail() && $num==1): 
        $output=wp_get_attachment_url( get_post_thumbnail_id( get_the_ID(  ) ) );
    else:
        
        $attachments= get_posts( array(
            'post_type'        =>'attachment',
            'posts_per_page'   =>$num,
            'post_parent'      => get_the_ID(  )
        ) );
        if($attachments && $num==1):
            foreach($attachments as $attachment):
                $output=wp_get_attachment_url( $attachment->ID );
            endforeach;

        elseif($attachments && $num>1):
            $output=$attachments;
            
        endif;       
        
        wp_reset_postdata(  );   
    endif;

    return $output;


    
}


function sunset_get_embeded_media( $type){

    $content=do_shortcode( apply_filters( 'the_content',  get_the_content()) );
    $embed=get_media_embedded_in_content( $content, $type );
    if(in_array('audio',$type)):
    $output= str_replace('?visual=true', '?visual=false',$embed[0]);
    else:
        $output=$embed[0];
    endif;

    return $output;
}


function sunset_grab_url(){
   if(! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/i',get_the_content(),$link)){
       return false;
   }else{
       return esc_url_raw( $link[1] );
   }
    

}


function sunset_check_paged($num=null){
    $output='';
    if(is_paged()){
        $output='page/'.get_query_var( 'paged');
    
    }
    if($num==1){
        $paged=(get_query_var('paged' )==0?1:get_query_var('paged'));
        return $paged;
    }else{
        return $output;
    }
}



function sunset_grap_current_url(){

    
    $http = ( isset( $_SERVER["HTTPS"] ) ? 'https://' : 'http://' );
	$referer = $http . $_SERVER["HTTP_HOST"];
	$archive_url = $referer . $_SERVER["REQUEST_URI"];
	
	return $archive_url;
}


/**
 * ==================================
 * 
 * Single post custom function
 * =================================
 */
function sunset_post_navigation(){
    $nav='<div class="row">';

    $prev= get_previous_post_link( '<div class="post-link-nav"> <span class=" dashicons dashicons-arrow-left-alt2"></span>%link</div>', '%title');
    $next= get_next_post_link ('<div class="post-link-nav">%link <span class=" dashicons dashicons-arrow-right-alt2"></span></div>', '%title');
    $nav.='<div class="col-xs-12 col-sm-6">'.$prev.'</div>';
    $nav.='<div class="col-xs-12 col-sm-6 text-right">'.$next.'</div>';
    $nav.='</div>';
    return $nav;

}

function sunset_share_this($content){

    if(is_single()){
    $content.=' <div class="sunset-share">
        <h4> <?php  _e("Share this via","sunsettheme")?></h4>';
         
            $title          =get_the_title();
            $permalink      =get_permalink();
            $twiiterHandler =(get_option( 'twiiter_handler')?'&amp;via='.esc_attr(get_option('twiiter_handler')): '');

            $twitter        ='https://twitter.com/intent/tweet?text='.$title.'&amp;url='.$permalink.$twiiterHandler.'';
            $facebook       ='https://facebook.com/sharer/sharer.php?u='.$permalink;
            
       

            $content.='<ul>';
            
            $content.='<li><a href="' .$twitter.'" target="_blank" rel="nofollow"><span class="dashicons dashicons-twitter"></span></a></li>';
            $content.=' <li><a href=" '. $facebook.'" rel="nofollow"><span class="dashicons dashicons-facebook"></span></a></li>';

        $content.='</ul>';

        $content.=' </div><!--sunset-share-->';
        return $content;
    }else{
        return $content;
    }
        
    
}
add_filter( 'the_content', 'sunset_share_this' );



function sunset_comments_nav(){
    require  (get_template_directory().'/inc/sunset-comments-nav.php');
}