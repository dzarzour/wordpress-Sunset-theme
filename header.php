<?php
/**
 * @package sunsettheme
 */

?>
<!DOCTYPE html>
<html <?php language_attributes()?>>
    <head>
        <title><?php bloginfo( 'name' ); wp_title(); ?></title>
        <meta charset="<?php bloginfo( 'charset' );?>">
        <meta name="description" content="<?php bloginfo( 'description' ); ?>">
        <meta name="viewport" content="width=device-width,initial-scale=1" >
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <?php if(is_singular() && pings_open( get_queried_object()) ):
            ?> <link rel="pingback" href="<?php bloginfo( 'pingback_url' )?>"><?php
        endif;
        wp_head(  );
        $custom_css=esc_attr( get_option( 'sunset_css' ) );
        if(!empty ($custom_css)):
        echo "<style>".$custom_css."</style>";
        endif;
        ?>

    </head>
    <body <?php body_class();?>>
        <div class="sunset-sidebar sidebar-closed">
            <div class="sunset-sidebar-container">
                <a class="js-toggleSidebar sidebar-close sidebar-closed">
                    X
                </a>
                <div class="sidebar-scroll">
            <?php  get_sidebar();?>
                </div>
            </div><!--sunset-sidebar-container-->    
        </div><!-- sunset-sidebar--->
        <div class="sidebar-overlay"></div><!--sidebar-overlay-->   
            <div class="container-fluid ">
                <div class="row">
                    <div class="header-container background-image text-center" style="background-image:url(<?php  header_image();?> )">
                    <a class="js-toggleSidebar sidebar-open">
                        #
                    </a>
                        <div class="header-content table">
                            <div class="table-cell">
                                <h1 class="site-title sunset-icon">
                                <span class="sunset-logo"></span>
                                    <span class="hide"><?php bloginfo('name' ); ?></span>
                                </h1>
                                <h2 class="site-description"><?php bloginfo('description' ); ?></h2>
                            </div> <!--table-cell-->
                        </div><!--header-contente-->
                        <div class="nav-container">
                            <nav class="navbar navbar-default navbar-sunset">
                            <?php 
                            wp_nav_menu( array(

                                'theme-location' => 'primary',
                                'container'      => 'false',
                                'menu_class'     =>'nav navbar-nav', 
                                'walker'         => new Sunset_Walker_Nav_Primary()
                            ) );
                            
                            ?>
                            </nav>
                        </div><!--nav-container-->
                    </div><!--background-image-->
                </div><!-- .row -->
            
            </div><!-- .container -->
         


<?php
