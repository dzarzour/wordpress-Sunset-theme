 <?php 
        if( get_comment_pages_count() >1  && get_option( 'page_comments')):
            ?>
                <nav  class="comments-navigation" role="navigation">
                    <h3><?php esc_html_e('Comments Navigation','sunsettheme'); ?></h3>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="post-link-nav"> 
                                <span class=" dashicons dashicons-arrow-left-alt2"></span>
                            <?php  previous_comments_link( esc_html__('Older comments' ,'sunsettheme') );?>   
                            </div> 
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="post-link-nav"> 
                                <span class=" dashicons dashicons-arrow-right-alt2"></span>
                            <?php  next_comments_link( esc_html__('Newer comments' ,'sunsettheme') );?>   
                            </div> 
                        </div>      
                    </div>
                   
                </nav>
            
            <?php
        endif;