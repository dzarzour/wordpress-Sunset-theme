<?php 
/**
 * 
 * @package sunsettheme
 * --Video post format
 */

 ?>
 <article id="post-<?php the_ID(  );?>" <?php  post_class( 'sunset-format-video');?>>
    <header class="entry-header text-center">
        <div class=" embed-responsive embed-responsive-16by9">
        <?php  echo sunset_get_embeded_media( array('video','iframe')); ?>
        </div>
         
        <?php  the_title( '<h1 class="entry-title"><a href="'. esc_url( get_permalink()).'"rel="bookmark">', '</a></h1>' )?>
        	
        <div class="entry-meta"><?php echo sunset_post_meta();?>
        </div><!-- .entry meta-->    
        
    </header>
    <div class="entry-content">
            
            <div class="entry-excerpt">
                <?php the_excerpt(  ); ?>
            </div><!--.entry-excerpt-->
            <div class="button-container text-center">
                <a href="<?php  the_permalink( );?>" class="btn btn-default  btn-sunset "><?php echo _e('Read More','sunsettheme')?></a>
            </div><!-- .button-container-->
    </div><!--.entry-content-->
    <footer class="entry-footer">
            <?php echo sunset_posted_footer();?>
    </footer>
 
 </article>