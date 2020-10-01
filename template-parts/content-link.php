<?php

/*
	
@package sunsettheme
-- Link Post Format

*/

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'sunset-format-link' ); ?>>
	
	<header class="entry-header text-center">
		
		<?php 
			$link = sunset_grab_url();
			the_title( '<h1 class="entry-title"><a href="' . $link . '" target="_blank">', '<div class="fa fa-link"></div></a></h1>'); 
		?>
		
	</header>

</article>