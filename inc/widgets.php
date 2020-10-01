<?php 
/***
 * @package sunsettheme
 */



 class Sunset_Profile_Widget extends WP_Widget{
     //Setup the widget name and description

     public function __construct(){
         $widget_ops= array(
             'class_name'    =>'sunset-profile-widget',
             'description'   => 'Custom sunset Profile widget',

         );
         parent::__construct('sunset_profile' ,'Sunset Profile',$widget_ops);
     }

     //backend display of widget
     public function form($instance){
        echo '<p>No options for this widgets !</p><p> You can control the fields of this widgets from <a href="./admin.php?page=dalia_sunset">This is the page </a></p>';
     }
     //fromtend display widget
     public function widget($args, $instance){

        $picture = esc_attr( get_option( 'profile_picture' ) );
		$firstName = esc_attr( get_option( 'first_name' ) );
		$lastName = esc_attr( get_option( 'last_name' ) );
		$fullName = $firstName . ' ' . $lastName;
		$description = esc_attr( get_option( 'user_description' ) );
		
		$twitter_icon = esc_attr( get_option( 'twitter_handler' ) );
		$facebook_icon = esc_attr( get_option( 'facebook_handler' ) );
		$gplus_icon = esc_attr( get_option( 'gplus_handler' ) );
		
		echo $args['before_widget'];
		?>
		<div class="text-center">
			<div class="image-container">
				<div id="profile-picture-preview" class="profile-picture" style="background-image: url(<?php print $picture; ?>);"></div>
			</div>
			<h1 class="sunset-username"><?php print $fullName; ?></h1>
			<h2 class="sunset-description"><?php print $description; ?></h2>
			<div class="icons-wrapper">
				<?php if( !empty( $twitter_icon ) ): ?>
					<a href="https://twitter.com/<?php echo $twitter_icon; ?>" target="_blank"><span class="dashicons dashicons-twitter"></span></a>
				<?php endif; 
				if( !empty( $gplus_icon ) ): ?>
					<a href="https://plus.google.com/u/0/+<?php echo $gplus_icon; ?>" target="_blank"><span class="dashicons dashicons-google"></span></a>
				<?php endif; 
				if( !empty( $facebook_icon ) ): ?>
					<a href="https://facebook.com/<?php echo $facebook_icon; ?>" target="_blank"><span class="dashicons dashicons-facebook"></span></a>
				<?php endif; ?>
			</div>
		</div>
		<?php
		echo $args['after_widget'];

     }
 }
 add_action( 'widgets_init', function(){
    register_widget( 'Sunset_Profile_Widget' );
 } );

 function sunset_tag_cloud_font_change($args){
    $args['smallest']=8;
    $args['largest'] =8;
    return $args;
 }

 add_filter( 'widget_tag_cloud_args', 'sunset_tag_cloud_font_change' );



 function sunset_save_post_views($postID){
	 $metakey='sunset_posts_views';
	 $views=get_post_meta( $postID, $metakey, true );

	 $count= (empty($views)?0:$views);

	 $count++;
	 update_post_meta( $postID, $metakey, $count );

echo 'views'. $views;


 }

 remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' ,10,0);

/*popular post widgets*/

class Sunset_Popular_Posts_Widgets extends WP_Widget{
	public function __construct(){
		$widget_ops=array(
			'classname'       => 'sunset-popular-posts-widgets',
			'description'     =>'Popular posts Widgets'

		);
		parent::__construct('sunset_popular_post','Sunset Popular Post',$widget_ops);
	}


	//back-end display widgets
	public function form($instance){
		$title   =(!empty($instance['title'])?$instance['title']:'Popular posts');
		$tot     =(!empty($instance['tot'])?absint($instance['tot']):4);

		$output='<p>';
		$output='<label for="'. esc_attr( $this->get_field_id('title') ).'">Title :</label>';
		$output.='<input type="Text" class="widefat" id="'.esc_attr( $this->get_field_id('title') ).'" name="'.esc_attr( $this->get_field_name('title') ).'" value="' . esc_attr( $title ) . '"';

		$output.='</p>';

		$output.='<p>';
		$output.='<label for="'.esc_attr( $this->get_field_id('tot') ).'"> Number of Posts :</label>';
		$output.='<input type="number" class="widefat" class="'.$this->get_field_id('tot').'" name="'.$this->get_field_name('tot').'" value="' . esc_attr( $tot ) . '" ';
		

		$output.='</p>';

		echo $output;

	}
	public function update($new_instance,$old_instance){

		$instance=array();
		$instance['title']=(!empty($new_instance['title'])?strip_tags($new_instance['title']):'' );
		$instance['tot']  =(!empty($new_instance['tot'])? absint(strip_tags($new_instance['tot'])):0);
	
		return $instance;
		
	}
	//fromt -end  display of widget
	public function widget($args,$instance){
		$tot=absint($instance['tot']);


		$posts_args = array(
			'post_type'			=> 'post',
			'posts_per_page'	=> $tot,
			'meta_key'			=> 'sunset_post_views',
			'orderby'			=> 'meta_value_num',
			'order'				=> 'DESC'
		);
		
		$posts_query = new WP_Query( $posts_args );
		
		echo $args[ 'before_widget' ];
		
		if( !empty( $instance[ 'title' ] ) ):
			
			echo $args[ 'before_title' ] . apply_filters( 'widget_title', $instance[ 'title' ] ) . $args[ 'after_title' ];
			
		endif;
		
		if( $posts_query->have_posts() ):
		
		//	echo '<ul>';
				
				while( $posts_query->have_posts() ): $posts_query->the_post();
					
				echo '<div class="media">';
				echo '<div class="media-left"><img class="media-object" src="' . get_template_directory_uri() . '/img/post-' . ( get_post_format() ? get_post_format() : 'standard') . '.png" alt="' . get_the_title() . '"/></div>';
				//echo '<div class="media-body">' . get_the_title() . '</div>';
				echo '<div class="media-body"><a href="'.get_the_permalink().'">' . get_the_title() . '</a></div>';
				echo '</div>';
					
				endwhile;
				
		//	echo '</ul>';
		
		endif;
		
		echo $args[ 'after_widget' ];

	}
	
}

add_action('widgets_init',function(){
	register_widget( 'Sunset_Popular_Posts_Widgets' );
});









