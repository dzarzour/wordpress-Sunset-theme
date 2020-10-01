<?php 
/**
 * 
 * @package sunsettheme
 * --Image post format
 */

 ?>
 <article id="post-<?php the_ID(  );?>" <?php  post_class('sunset-format-gallery' );?>>
 
    
    <header class="entry-header text-center background-image" >
    <?php if (sunset_get_attachment()):
                $attachments= sunset_get_attachment(7);
               // var_dump($attachments);
                ?>
                <div id="post-gallery-<?php the_ID(  ); ?>" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                        <?php 
                                $i = 0;
                                foreach( $attachments as $attachment ): 
                                $active = ( $i == 0 ? ' active' : '' );
                        ?>
                        
                                <div class="item<?php echo $active; ?> background-image standard-featured" style="background-image: url( <?php echo wp_get_attachment_url( $attachment->ID ); ?> );"></div>
                        
                        <?php $i++; endforeach; ?>

                         </div> <!--carousal-inner -->
                         <a class="left carousel-control" href="#post-gallery-<?php the_ID(  );?>" role="button" data-slide="prev" >
                           <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                           <span class="sr-only"> Previous </span>
                        </a>
                        <a class=" right carousel-control" href="#post-gallery-<?php the_ID(  ); ?>" role="button" data-slide="next">
                           <span class=" glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                           <span class="sr-only"> Next </span>
                        </a>
                         
                </div><!-- .carousel-->
                
                <?php
        endif; ?>      
        <?php 
         the_title( '<h1 class="entry-title"><a href="'. esc_url( get_permalink()).'"rel="bookmark">', '</a></h1>' )
         ?>
        	
        <div class="entry-meta"><?php echo sunset_post_meta();?>
        </div><!-- .entry meta-->    
        
        <div class="entry-excerpt image-caption">
                <?php the_excerpt(  ); ?>
        </div><!--.entry-excerpt-->
           
    </header>
  
    
    <footer class="entry-footer">
            <?php echo sunset_posted_footer();?>
    </footer>
 
 </article>