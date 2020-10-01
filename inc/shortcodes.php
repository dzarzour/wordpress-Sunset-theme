<?php

/*
	
@package sunsettheme
	
	========================
		Short codes OPTIONS
	========================
*/

function sunset_tooltip($atts,$content=null){
    // [tooltip  placement="top" title="This is is the title"]This is the content[/tooltip]

    //get the attributes 
    $atts=shortcode_atts(
         //$pairs:array,
         array(
             'placement' =>  'top',
             'title'     =>   ''
         ),
         // $atts:array,
         $atts,
         // $shortcode:string
         'tooltip'
    );
    //return HTML
    $title=($atts['title']=='')?$content:$atts['title'];
    return '<span class="sunset-tooltip" data-toggle="tooltip" data-placement="'.$atts['placement'].'" title="'.$title.'" >'.$content.'</span>';


}
add_shortcode( 'tooltip', 'sunset_tooltip' );

function sunset_popover($atts,$content=null){

    //[popover placement="top" title=""][/popover]
    $atts=shortcode_atts( 
        //$pairs:array,
        array(
            'placement'    =>'top',
            'title'        =>'',
            'trigger'      => 'click',
            'content'      =>''
        ),
        $atts,
        'popover' 
        //$atts:array, 
        //$shortcode:string
     );

    /* return '<span data-toggle="popover" data-trigger="focus"data-placement="'.$atts['placement'].'" data-title="'.$atts['title'].'"> '.$content.'</span>';*/
    return '<span  class="sunset-popover" data-toggle="popover" data-trigger="'.$atts['trigger'].'" data-content="'.$atts['content'].'" >'.$content.'</span>';

}
add_shortcode( 'popover', 'sunset_popover' );


function sunset_contact_form($atts,$content=null){
    //[contact_form]
    $atts=shortcode_atts( 
            array(), 
            $atts,
            'contact_form' 
        );
        ob_start();
            include 'templates/contact-form.php';

        return ob_get_clean();    
}
add_shortcode( 'contact_form', 'sunset_contact_form' );