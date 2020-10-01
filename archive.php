<?php
/**
 * @package sunsettheme
 */

 get_header();

 ?>
 <div id="primary" class="content-area">
        <h2 class="text-center"> <?php echo get_the_archive_title(  ); ?></h2>
    <main id="main" class="site-main" role="main">
        <?php  if(is_paged()): ?>
        <div class="container  text-center container-load-previous" >
            <a  class="btn  sunset-load-more " data-prev="1" data-page="<?php echo sunset_check_paged(1);?>" data-archive="<?php  echo sunset_grap_current_url(); ?>" data-url="<?php echo admin_url('admin-ajax.php'); ?>"><span class="glyphicon glyphicon-refresh " ><span class="text"> Load Previous</span></span></a>
        </div> <!-- .container-->
        <?php endif;?>
        <div class="container sunset-posts-container">
            <?php 
                if(have_posts(  )):
                    echo '<div class="page-limit" data-page="'. $_SERVER["REQUEST_URI"] .' ">';
                    while(have_posts(  )):the_post(  );

                        get_template_part( 'template-parts/content', get_post_format(  ) );
                    endwhile;
                    echo "</div>";
                endif;
            
            ?>

           
        </div><!-- .container-->
        <div class="container  text-center" >
            <a  class="btn  sunset-load-more " data-page="<?php echo sunset_check_paged();?>" data-archive="<?php echo sunset_grap_current_url(); ?>"data-url="<?php echo admin_url('admin-ajax.php'); ?>"><span class="glyphicon glyphicon-refresh " ><span class="text"> Load More</span></span></a>
        </div> <!-- .container-->
        
        
    </main>
 </div><!-- #primary-->
 
 
 <?php
 get_footer();