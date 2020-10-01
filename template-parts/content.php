<?php 
/**
 * 
 * @package sunsettheme
 * --standard post format
 */

 ?>
 <article id="post-<?php the_ID(  );?>" <?php  post_class( );?>>
    <header class="entry-header text-center">
        <?php  the_title( '<h1 class="entry-title"><a href="'. esc_url( get_permalink()).'"rel="bookmark">', '</a></h1>' )?>
        	
        <div class="entry-meta"><?php echo sunset_post_meta();?>
        </div><!-- .entry meta-->    
        
    </header>
    <div class="entry-content">
         
        <?php if( has_post_thumbnail() ): 
                $featured_image = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
            ?>
                
                <a class="standard-featured-link" href="<?php the_permalink(); ?>">
                <div class="standard-featured background-image"><?php the_post_thumbnail( ); ?></div>
                </a>
               
            <?php endif; ?>
          
           
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