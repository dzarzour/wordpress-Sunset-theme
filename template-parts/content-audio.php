<?php 
/**
 * 
 * @package sunsettheme
 * --Audio post format
 */

 ?>
 <article id="post-<?php the_ID(  );?>" <?php  post_class('sunset-format-audio' );?>>
    <header class="entry-header text-center">
        <?php  the_title( '<h1 class="entry-title"><a href="'. esc_url( get_permalink()).'"rel="bookmark">', '</a></h1>' )?>
        	
        <div class="entry-meta"><?php echo sunset_post_meta();?>
        </div><!-- .entry meta-->    
        
    </header>
    <div class="entry-content">
          <?php 
        //  $content=do_shortcode( apply_filters( 'the_content', $post->post_content) );
        //  $embed=get_media_embedded_in_content( $content, array('audio','iframe') );
        //    echo str_replace('?visual=true','?visual=false', $embed[0]);
        echo sunset_get_embeded_media( array('audio','iframe'));
          ?>
    </div><!--.entry-content-->
    <footer class="entry-footer">
            <?php echo sunset_posted_footer();?>
    </footer>
 
 </article>