<?php
/**
 * 
 * @package sunsetthem
 * 
 */
if(post_password_required(  )){
    return;
}

?>
<div id="comments" class="comments-area">
<?php  if(have_comments()): 
        //we have comments
        
        ?>
        <h2 class="comments-title">
        <?php
        printf(
            esc_html( _nx('One Comment on &ldquo; %2$s&rdquo;', '%1$s Comments on &ldquo; %2$s &rdquo;', get_comments_number(),'comments title','sunsettheme')),
            number_format_i18n(  get_comments_number()), 
            '<span>'. get_The_title().'</span>'
        );
        
        ?>
        </h2>
        <?php
            echo sunset_comments_nav();
        
        ?>
        <ol class="comment-list">
        <?php 
            $args=array(
                'walker'                    =>null,
                'max_depth'                 =>'',
                'style'                     =>'ol',
                'callback'                  => null,
                'end-callback'              =>null,
                'type'                      =>'all',
                'reply_text'                =>'Reply',
                'page'                      =>'',
                'per_page'                  =>3,
                'avatar_size'               =>64,
                'reverse_top_level'         =>null,
                'reverse_children'          =>'',
                'format'                    =>'html5',
                'short_ping'                =>false,
                'echo'                      =>true

            );
            wp_list_comments( $args);
        ?>
        
        </ol>

        <?php
       
        ?>
        <?php

        if(!comments_open( ) && get_comments_number()):
            ?> 
                <p class="no-comments"><?php esc_html_e( 'Comments are  closed','sunsettheme' );?> </p>            
            
            <?php

        endif;
    endif;
?>
    <?php

    $fields=array(
        'author'    =>'<div class="form-group "><label for="authors">'.__('Name','sunsettheme').'</label><span class="required">*</span><input id="author" name="author" type="text" class="form-control" value="'.esc_attr( $commenter['comment_author'] ) .'" required="required"/></div>',

        'email'    =>'<div class="form-group"><label for="email">     '.__('Email','sunsettheme').'</label><span class="required">*</span><input id="email" name="email" type="text" class="form-control" value="'.esc_attr( $commenter['comment_author_email'] ).'" required="required"></div>'

    );
    $args=array(
        'class_submit'    => 'btn btn-lg btn-warning btn-block',
        'label_submit'    => 'Submit Comment',
        'comment_field'   => '<div class="form-group"><label for="comment">'._x( 'comment', 'sunsettheme' ).'</label><textarea row="4" class="form-control" required="required" name="comment" id="comment"></textarea></div>',
        'fields'          => apply_filters( 'comment_form_default_fields', $fields),
    );
    
    comment_form($args);?>
</div><!--comments-area-->